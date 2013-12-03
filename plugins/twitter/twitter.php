<?php
	
	include_once("basic.php");

	class Twitter extends Basic {
		

		
		public $requestTokenURL = "https://api.twitter.com/oauth/request_token";
		public $authorizeURL = "https://api.twitter.com/oauth/authorize";
		public $authenticateURL = "https://api.twitter.com/oauth/authenticate";
		public $accessTokenURL = "https://api.twitter.com/oauth/access_token";
		public $tweetURL = "https://api.twitter.com/1.1/statuses/update.json";
		public $twitterInfoURL = "https://api.twitter.com/1.1/account/verify_credentials.json";
		public $arrParameters;
		public $oauthTokenSecret;
		public $oauthToken;
		
		protected $consumerKey;
		protected $consumerSecret;
		
		
		protected $lastSig;
		protected $lastSignKey;
		protected $lastAuthHeader;
		public $httpCode;
		
		
		public function __construct($sqlConnection, $setConsumerKey, $setConsumerSecret) {
			
			
			$this->MySQL = $sqlConnection;
			$this->strTableName = "twitter";
			$this->strTableKey = "twitter_id";
			
			
			$this->consumerKey = $setConsumerKey;
			$this->consumerSecret = $setConsumerSecret;
			$this->arrParameters['oauth_consumer_key'] = $setConsumerKey;
			$this->arrParameters['oauth_signature_method'] = "HMAC-SHA1";
			$this->arrParameters['oauth_version'] = "1.0";

			
			
		}
		
		// Plugin Functions
		
		
		public function hasTwitter($memID) {

			if(is_numeric($memID)) {
			
				$query = "SELECT twitter_id FROM ".$this->MySQL->get_tablePrefix()."twitter WHERE member_id = ?";
				$result = $this->MySQL->prepare($query);
				if($result->execute(array($memID))) {
					
					
					
				}
			
			}
			
		}
		
		
		// Twitter connection functions below	
		
		public function generateNonce() {
			
			return md5(uniqid(rand().time(), true));
	
		}
		
		public function generateSignature($httpMethod, $reqURL) {
			
			ksort($this->arrParameters);
			$arrEncodedString = array();
			
			
			
			foreach($this->arrParameters as $key => $value) {
				
				$encodedString = "";
				
				$encodedKey = rawurlencode($key."=");
				$encodedValue = rawurlencode($value);
				
				$encodedString = $encodedKey.$encodedValue;
				$arrEncodedString[] = $encodedString;
			}
			
			$paramString = implode(rawurlencode("&"), $arrEncodedString);
			
			$sigString = strtoupper($httpMethod)."&".rawurlencode($reqURL)."&".$paramString;

			$this->lastSig = $sigString;
			
			$signingKey = rawurlencode($this->consumerSecret)."&".rawurlencode($this->oauthTokenSecret);
			
			$this->lastSignKey = $signingKey;
			
			$returnVal = base64_encode(hash_hmac("sha1", $sigString, $signingKey, true));
			
			return $returnVal;
			
		}
		
		public function prepareAuthHeader() {

			ksort($this->arrParameters);
			
			// Prepare Authorization Header
			
			foreach($this->arrParameters as $key => $value) {
			
				$arrHeaderParams[] = rawurlencode($key)."=\"".rawurlencode($value)."\"";
			
			}
			
			
			$arrHeader = array();
			$arrHeader[] = "Authorization: OAuth ".implode(", ", $arrHeaderParams);

			return $arrHeader;
			
		}
		
		
		public function getRequestToken($setCallBackURL = "") {
			
			if($setCallBackURL != "") {
				$this->callbackURL = $setCallBackURL;	
			}
			
			$this->arrParameters['oauth_callback'] = rawurlencode($this->callbackURL);
			$this->arrParameters['oauth_timestamp'] = time();
			$this->arrParameters['oauth_nonce'] = $this->generateNonce();
			$this->arrParameters['oauth_signature'] = $this->generateSignature("POST", $this->requestTokenURL);
			
			$this->arrParameters['oauth_callback'] = $this->callbackURL;
			
			$arrHeader = $this->prepareAuthHeader();
			
			
			$response = $this->httpRequest($this->requestTokenURL, "POST", $arrHeader);
			
			if($this->httpCode == 200) {
				
				$returnVal = $response;
				
				
			}
			else {
				
				$returnVal = false;
				
			}
			
			
			unset($this->arrParameters['oauth_callback']);
			
			return $returnVal;
			
		}
		
		public function getAccessToken($setOauthToken, $oauthVerifier) {
			
			if($setOauthToken != "") {
				$this->oauthToken = $setOauthToken;	
			}
			
			
			$this->arrParameters['oauth_token'] = $this->oauthToken;
			$this->arrParameters['oauth_timestamp'] = time();
			$this->arrParameters['oauth_nonce'] = $this->generateNonce();
			$this->arrParameters['oauth_verifier'] = $oauthVerifier;
			$this->arrParameters['oauth_signature'] = $this->generateSignature("POST", $this->accessTokenURL);
			
			unset($this->arrParameters['oauth_verifier']);
			
			$arrHeader = $this->prepareAuthHeader();
			
			
			$this->lastAuthHeader = $arrHeader;
			

			$response = $this->httpRequest($this->accessTokenURL, "POST", $arrHeader, urlencode("oauth_verifier=".$oauthVerifier));
			
			
			if($this->httpCode == 200) {
			
				$returnVal = $response;
			
			
			}
			else {
			
				$returnVal = false;
			
			}
		
			
			return $returnVal;
			
			
		}
		
		
		public function sendTweet($tweet) {
			
			$this->arrParameters['oauth_token'] = $this->oauthToken;
			$this->arrParameters['oauth_timestamp'] = time();
			$this->arrParameters['oauth_nonce'] = $this->generateNonce();
			$this->arrParameters['status'] = rawurlencode($tweet);
			$this->arrParameters['oauth_signature'] = $this->generateSignature("POST", $this->tweetURL);
			
			unset($this->arrParameters['status']);

			
			$arrHeader = $this->prepareAuthHeader();			
			
			$response = $this->httpRequest($this->tweetURL, "POST", $arrHeader, "status=".urlencode($tweet));
			
			if($this->httpCode == 200) {
				$returnVal = $response;
			}
			else {
				$returnVal = false;
			}
			
			return $returnVal;
			
		}
		
		public function getTwitterInfo() {
			

			$this->arrParameters['oauth_token'] = $this->oauthToken;
			$this->arrParameters['oauth_timestamp'] = time();
			$this->arrParameters['oauth_nonce'] = $this->generateNonce();
			$this->arrParameters['oauth_signature'] = $this->generateSignature("GET", $this->twitterInfoURL);
			
			$arrHeader = $this->prepareAuthHeader();
			
			
			$this->lastAuthHeader = $arrHeader;
			
			
			$response = $this->httpRequest($this->twitterInfoURL, "GET", $arrHeader);
			
			
			if($this->httpCode == 200) {
			
				$returnVal = json_decode($response, true);
			
			
			}
			else {
			
				$returnVal = false;
			
			}
			
			
			return $returnVal;		
			
		}
		
		public function httpRequest($url, $method, $headers=array(), $postfields=array()) {
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			
			if($method == "POST") {
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
			}
			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLINFO_HEADER_OUT, true);
			
			
			$result = curl_exec($ch);
			$info = curl_getinfo($ch);
			
			$this->httpCode = $info['http_code'];
			
			return $result;
			
		}
		
		
		
		
	}

?>