<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2014
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */

if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {
	exit();
}
else {
	$memberInfo = $member->get_info_filtered();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}

if(trim($_SERVER['HTTPS']) == "" || $_SERVER['HTTPS'] == "off") {
	$dispHTTP = "http://";
}
else {
	$dispHTTP = "https://";
}

include_once("../plugins/twitter/twitter.php");


$twitterObj = new Twitter($mysqli);

if(isset($_GET['oauth_token']) && isset($_GET['oauth_verifier']) && $_GET['oauth_token'] == $_SESSION['btOauth_Token'] && !$twitterObj->hasTwitter($memberInfo['member_id'])) {
	// CALLBACK
	$twitterObj->oauthTokenSecret = $_SESSION['btOauth_Token_Secret'];
	$response = $twitterObj->getAccessToken($_GET['oauth_token'], $_GET['oauth_verifier']);
	
	if($twitterObj->httpCode == 200) {
		parse_str($response, $oauthArray);
		$arrColumns = array("member_id", "oauth_token", "oauth_tokensecret");
		$arrValues = array($memberInfo['member_id'], $oauthArray['oauth_token'], $oauthArray['oauth_token_secret']);
		
		$twitterObj->addNew($arrColumns, $arrValues);
		
	}
	else {
		echo "
		
			<div style='solidBox' style='margin-left: auto; margin-right: auto; width: 50%'>
				<p class='main' align='center'>
					Unable to connect account!  Please Try Again.<br><br>
					<a href='".$MAIN_ROOT."members/console.php?cID=".$_GET['cID']."'>Retry</a>
				</p>
			</div>
		
		";
	}
	
	
}
elseif(!$twitterObj->hasTwitter($memberInfo['member_id'])) {
	// CONNECT
			
	$response = $twitterObj->getRequestToken($dispHTTP.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
	
	if($response !== false) {
		parse_str($response, $arrOutput);	
		
		$_SESSION['btOauth_Token'] = $arrOutput['oauth_token'];
		$_SESSION['btOauth_Token_Secret'] = $arrOutput['oauth_token_secret'];
		
		echo "
		
			<script type='text/javascript'>
			
				window.location = '".$twitterObj->authorizeURL."?oauth_token=".$arrOutput['oauth_token']."';
			
			</script>
		
		";
		
	}
	else {
		
		echo "
		
			<script type='text/javascript'>
			
				window.location = '".$dispHTTP.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."';
			
			</script>
		
		";
		
	}
	
}
elseif($twitterObj->hasTwitter($memberInfo['member_id'])) {
	// MEMBER ALREADY HAS TWITTER CONNECTED
	
	echo "
	
		<div style='solidBox' style='margin-left: auto; margin-right: auto; width: 50%'>
			<p class='main' align='center'>
				You already have your twitter account connected!
			</p>
		</div>
	
	";
	
	
}
else {
	echo "
	
		<script type='text/javascript'>
			
			window.location = '".$MAIN_ROOT."members';
		
		</script>
	
	";
}



?>