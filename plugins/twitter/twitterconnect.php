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
		
		
		if(!$twitterObj->authorizeLogin($oauthArray['oauth_token'], $oauthArray['oauth_token_secret'])) {
		
			$twitterObj->addNew($arrColumns, $arrValues);
			
		}
		else {

			echo "
			
				<div class='shadedBox' style='margin-left: auto; margin-right: auto; width: 50%'>
					<p class='main' align='center'>
						The chosen twitter account is already associated with a member on this site!<br><br>
						<a href='".$MAIN_ROOT."members/console.php?cID=".$_GET['cID']."'>Retry</a>
					</p>
				</div>
			
			";
			
		}
		
	}
	else {

		echo "
		
			<div class='shadedBox' style='margin-left: auto; margin-right: auto; width: 50%'>
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
	$twitterObj->hasTwitter($memberInfo['member_id']);
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
			
			<div class='shadedBox' style='margin-left: auto; margin-right: auto; width: 50%'>
				<p class='main' align='center'>
					Unable to connect account!  Please Try Again.<br><br>
					<a href='".$MAIN_ROOT."members/console.php?cID=".$_GET['cID']."'>Retry</a>
				</p>
			</div>
		
		";
		
	}
	
}
elseif($twitterObj->hasTwitter($memberInfo['member_id'])) {
	// MEMBER ALREADY HAS TWITTER CONNECTED
	
	$twitterObj->oauthToken = $twitterObj->get_info("oauth_token");
	$twitterObj->oauthTokenSecret = $twitterObj->get_info("oauth_tokensecret");
	
	
	if((time()-$twitterObj->get_info("lastupdate")) > 1800) {
		$twitterInfo = $twitterObj->getTwitterInfo();
		
		$arrColumns = array("lastupdate", "username", "name", "description", "followers", "following", "tweets", "profilepic", "lasttweet_id");
		$arrValues = array(time(), $twitterInfo['screen_name'], $twitterInfo['name'], $twitterInfo['description'], $twitterInfo['followers_count'], $twitterInfo['friends_count'], $twitterInfo['statuses_count'], $twitterInfo['profile_image_url_https'], $twitterInfo['status']['id_str']);
		
		$twitterObj->update($arrColumns, $arrValues);
	}
	
	$twitterInfo = $twitterObj->get_info_filtered();

	
	
	echo "
	
		<div class='formDiv'>
	
			<table class='formTable'>
				<tr>
					<td colspan='2'>
						<div class='main dottedLine' style='margin-bottom: 20px; padding-bottom: 3px'>
							<b>Connected:</b>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
		
						<div class='shadedBox' style='margin-left: auto; margin-right: auto; width: 50%; overflow: auto'>
							
							<div style='float: left'>
								<img src='".str_replace("_normal", "_bigger", $twitterInfo['profilepic'])."' class='solidBox' style='padding: 0px'>
							</div>
							<div class='largeFont' style='float: left; margin-left: 10px'>
								<b><span class='breadCrumbTitle' style='padding: 0px'>".$twitterInfo['name']."</span></b><br>
								<a href='http://twitter.com/".$twitterInfo['username']."' target='_blank'>@".$twitterInfo['username']."</a>
								<p class='main'>".$twitterInfo['description']."</p>
								
								<div class='main' style='position: relative; overflow: auto'>
									<div style='float: left; margin-left: 10px'><a href='http://twitter.com/".$twitterInfo['username']."' target='_blank'><b>".number_format($twitterInfo['tweets'],0)."</b><br>TWEETS</a></div>
									<div style='float: left; margin-left: 10px'><a href='http://twitter.com/".$twitterInfo['username']."/following' target='_blank'><b>".number_format($twitterInfo['following'],0)."</b><br>FOLLOWING</a></div>
									<div style='float: left; margin-left: 10px'><a href='http://twitter.com/".$twitterInfo['username']."/followers' target='_blank'><b>".number_format($twitterInfo['followers'],0)."</b><br>FOLLOWERS</a></div>
								</div>
								
							</div>
				
						</div>
						<div style='font-style: italic; text-align: center; margin-top: 3px; margin-left: auto; margin-right: auto; position: relative' class='main'>
							Last updated ".getPreciseTime($twitterInfo['lastupdate'])."
							<p class='largeFont' style='font-style: normal; font-weight: bold' align='center'>
								<a href='".$MAIN_ROOT."members/console.php?cID=".$_GET['cID']."disconnect=1'>DISCONNECT ACCOUNT</a>
							</p>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan='2'><br><br>
						<div class='main dottedLine' style='margin-bottom: 2px; padding-bottom: 3px'>
							<b>Profile Display Options:</b>
						</div>
						<div style='padding-left: 3px; margin-bottom: 15px'>
							Use the form below to set which items from Twitter will show in your profile.
						</div>
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Show Feed:</td>
					<td class='main'><input type='checkbox' name='showfeed' value='1'></td>
				</tr>
				<tr>
					<td class='formLabel'>Embed Last Tweet:</td>
					<td class='main'><input type='checkbox' name='embedlasttweet' value='1'></td>
				</tr>
				<tr>
					<td class='formLabel'>Show Info Card: <a href='javascript:void(0)' onmouseover=\"showToolTip('An example of the Info Card is shown in the &quot;Connected&quot; section above.')\" onmouseout='hideToolTip()'>(?)</a></td>
					<td class='main'><input type='checkbox' name='showinfo' value='1'></td>
				</tr>
				<tr>
					<td colspan='2'><br>
						<div class='main dottedLine' style='margin-bottom: 2px; padding-bottom: 3px'>
							<b>Log In Options:</b>
						</div>
						<div style='padding-left: 3px; margin-bottom: 15px'>
							Check the box below to allow logging into this website through twitter.
						</div>
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Allow Log In:</td>
					<td class='main'><input type='checkbox' name='allowlogin' value='1'></td>
				</tr>
				<tr>
					<td class='main' colspan='2' align='center'><br>
						<input type='submit' name='submit' value='Save' class='submitButton'>
					</td>
				</tr>
			</table>
			<br>
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