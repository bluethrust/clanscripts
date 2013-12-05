<?php
	
	include_once("basic.php");

	ini_set("display_errors", 1);
	
	class Twitter extends Basic {
		

		// SET CONSUMER KEY AND CONSUMER SECRET
		protected $consumerKey = "Usg8F5rw4lNlx01jDty8A";
		protected $consumerSecret = "uXuhU1hFWWBLZMN5DJAPbaU2ejlE1YrmqGkNF31YsQ";
		
		
		
		public $requestTokenURL = "https://api.twitter.com/oauth/request_token";
		public $authorizeURL = "https://api.twitter.com/oauth/authorize";
		public $authenticateURL = "https://api.twitter.com/oauth/authenticate";
		public $accessTokenURL = "https://api.twitter.com/oauth/access_token";
		public $tweetURL = "https://api.twitter.com/1.1/statuses/update.json";
		public $twitterInfoURL = "https://api.twitter.com/1.1/account/verify_credentials.json";
		public $arrParameters;
		public $oauthTokenSecret;
		public $oauthToken;
		
		protected $callbackURL;
		
		public $lastHTTPRequestInfo;
		public $lastResponse;
		
		protected $lastSig;
		protected $lastSignKey;
		public $lastAuthHeader;
		public $httpCode;
		
		
		public function __construct($sqlConnection) {
			
			
			$this->MySQL = $sqlConnection;
			$this->strTableName = $this->MySQL->get_tablePrefix()."twitter";
			$this->strTableKey = "twitter_id";

			$this->arrParameters['oauth_consumer_key'] = $this->consumerKey;
			$this->arrParameters['oauth_signature_method'] = "HMAC-SHA1";
			$this->arrParameters['oauth_version'] = "1.0";

			
			
		}
		
		// Plugin Functions
		
		
		public function hasTwitter($memID) {


			$returnVal = false;
			if(is_numeric($memID)) {
				
				
				$query = "SELECT twitter_id FROM ".$this->MySQL->get_tablePrefix()."twitter WHERE member_id = '".$memID."'";
				$result = $this->MySQL->query($query);
				
				if($result->num_rows > 0) {
					
					$row = $result->fetch_assoc();
					$this->select($row['twitter_id']);
					
					$returnVal = true;	
					
				}
				
			
			}

			
			return $returnVal;
			
		}
		
		
		public function authorizeLogin($oauth_token, $oauth_token_secret) {
			
			$returnVal = false;
			
			if(isset($oauth_token) && isset($oauth_token_secret)) {
				
				$oauth_token = $this->MySQL->real_escape_string($oauth_token);
				$oauth_token_secret = $this->MySQL->real_escape_string($oauth_token_secret);
				
				
				$result = $this->MySQL->query("SELECT twitter_id FROM ".$this->strTableName." WHERE oauth_token = '".$oauth_token."' AND oauth_tokensecret = '".$oauth_token_secret."'");
				
				if($result->num_rows > 0) {
				
					$row = $result->fetch_assoc();
					$this->select($row['twitter_id']);
					
					
					$returnVal = true;
				}

				
			}
			
			
			return $returnVal;
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
			
			$arrPost = array();
			$arrPost['oauth_verifier'] = $oauthVerifier;
			$response = $this->httpRequest($this->accessTokenURL, "POST", $arrHeader, $arrPost);
			
			$this->lastResponse = $response;
			
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
			
			
			$this->lastHTTPRequestInfo = $info;
			
			$this->httpCode = $info['http_code'];
			
			return $result;
			
		}
		
		
		
		
	}

?>