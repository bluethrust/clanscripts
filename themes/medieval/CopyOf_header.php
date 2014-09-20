<?php

include_once($prevFolder."classes/member.php");
include_once($prevFolder."classes/rank.php");
include_once($prevFolder."classes/consoleoption.php");
include_once($prevFolder."classes/game.php");
include_once($prevFolder."classes/shoutbox.php");

$dispLoginBox = "
	<form action='".$MAIN_ROOT."login.php' method='post' id='medievalLoginForm' style='padding: 0px; margin: 0px'>
		<div class='loginSection'>
			<div class='loginUsernameImg'></div>
			<div class='loginTextBox'><input type='textbox' class='textBox' name='user' style='width: 150px; font-size: 14px'></div>
			<div class='loginPasswordImg'></div>
			<div class='loginTextBox'><input type='password' class='textBox' name='pass' style='width: 150px; font-size: 14px'></div>
			
			<div class='loginButtonSection'>
				<div class='loginRememberMeImg'></div>
				<div class='loginRememberMeBoxContainer'>
					<img src='".$MAIN_ROOT."images/transparent.png' class='loginRememberBoxImg' id='rememberMeBoxImg'>
				</div>
				
				
				<div class='loginButtonContainer'>
					
					<img src='".$MAIN_ROOT."images/transparent.png' class='loginButtonImg' id='btnLogin'>
				
				</div>
				
				
			</div>
			<div style='clear: both'></div>
		</div>
		<input type='hidden' name='rememberme' id='rememberme' value='0'>
		<input type='submit' name='submit' name='submit' id='btnRealSubmit' value='1' style='display: none'>
		</form>
		
		<script type='text/javascript'>
		
		$(document).ready(function() {
			$('#rememberMeBoxImg').click(function() {
				if($('#rememberme').val() == 0) {
					$('#rememberMeBoxImg').removeClass('loginRememberBoxImg').addClass('loginRememberBoxImg_checked');
					$('#rememberme').val('1');
				}
				else {
					$('#rememberMeBoxImg').removeClass('loginRememberBoxImg_checked').addClass('loginRememberBoxImg');
					$('#rememberme').val('0');
				}
			});
			
			$('#btnLogin').click(function() {
				$('#btnRealSubmit').click();
			});
			
			
		});
	
	</script>
		
		
";

$mainShoutboxObj = new Shoutbox($mysqli, "news", "news_id");

$mainShoutboxObj->strDivID = "mainShoutbox";
$mainShoutboxObj->intDispWidth = 135;
$mainShoutboxObj->intDispHeight = 300;


if(isset($_SESSION['btUsername']) AND isset($_SESSION['btPassword'])) {

	$memberObj = new Member($mysqli);
	if($memberObj->select($_SESSION['btUsername'])) {

		if($memberObj->authorizeLogin($_SESSION['btPassword'])) {
			define("LOGGED_IN", true);

			$memberInfo = $memberObj->get_info();
			$memberUsername = $memberInfo['username'];
			$memberID = $memberInfo['member_id'];

			if($memberInfo['loggedin'] == 0) {
				$memberObj->update(array("loggedin"), array(1));
			}





			$actualPageNameLoc = strrpos($PAGE_NAME," - ");
			$actualPageName = substr($PAGE_NAME, 0, $actualPageNameLoc);

			if($PAGE_NAME == "") {
				$actualPageName = "Home Page";
			}

			if(trim($_SERVER['HTTPS']) == "" || $_SERVER['HTTPS'] == "off") {
				$dispHTTP = "http://";
			}
			else {
				$dispHTTP = "https://";
			}

			$lastSeenLink = "<a href='".$dispHTTP.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."'>".$actualPageName."</a>";
			$arrUpdateColLastSeen = array("lastseen", "lastseenlink");
			$arrUpdateValLastSeen = array(time(), $lastSeenLink);

			if((time()-$memberInfo['lastlogin']) > 3600) {
				$arrUpdateColLastSeen[] = "lastlogin";
				$arrUpdateValLastSeen[] = time();
			}

			$memberObj->update($arrUpdateColLastSeen, $arrUpdateValLastSeen);


			$rankObj = new Rank($mysqli);
			$rankObj->select($memberInfo['rank_id']);
			$rankInfo = $rankObj->get_info();
			$memberRank = $rankInfo['name'];

			$consoleOptionObj = new ConsoleOption($mysqli);

			// Shoutbox

			$manageNewsCID = $consoleOptionObj->findConsoleIDByName("Manage News");

			$consoleOptionObj->select($manageNewsCID);

			if($memberObj->hasAccess($consoleOptionObj)) {
				$mainShoutboxObj->strEditLink = $MAIN_ROOT."members/console.php?cID=".$manageNewsCID."&newsID=";
				$mainShoutboxObj->strDeleteLink = $MAIN_ROOT."members/include/news/include/deleteshoutpost.php";

			}

			$postShoutboxCID = $consoleOptionObj->findConsoleIDByName("Post in Shoutbox");

			$consoleOptionObj->select($postShoutboxCID);

			if($memberObj->hasAccess($consoleOptionObj)) {
				$mainShoutboxObj->strPostLink = $MAIN_ROOT."members/include/news/include/postshoutbox.php";
			}


			// PMs

			$pmCID = $consoleOptionObj->findConsoleIDByName("Private Messages");


			$totalPMs = $memberObj->countPMs();
			$totalNewPMs = $memberObj->countPMs(true);

			if($totalNewPMs > 0) {
				$dispPMCount = "<b>(".$totalNewPMs.")</b> <img src='".$MAIN_ROOT."themes/".$THEME."/images/pmalert.gif'>";
			}
			else {
				$dispPMCount = "(".$totalPMs.")";
			}


			$memberObj = "";
			$rankObj = "";
			$memberInfo = "";
			$rankInfo = "";
			
			
			
			
			
			$dispLoginBox = "
				<div class='loggedInSection'>
					<div class='loggedInImg'></div>
					<div class='loggedInInfo'>
						<div style='float: left'>
							<b>Account Name:</b> <a href='".$MAIN_ROOT."profile.php?mID=".$memberID."'>".$memberUsername."</a><br>
							<b>Rank:</b> ".$memberRank."
						</div>
						<div style='float: right; margin-left: 75px; text-align: center'>
						<b><u>Member Options:</u></b><br>
						<a href='".$MAIN_ROOT."members'>My Account</a> - <a href='".$MAIN_ROOT."members/console.php?cID=".$pmCID."'>PM Inbox ".$dispPMCount."</a> - <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
						</div>
						
						
						<div style='clear: both'></div>
					</div>
				</div>
			";


		}
		
	}
		
		
}
		
			
			
			
if(!defined("LOGGED_IN")) {
	define("LOGGED_IN", false);
}

$hitCountObj = new Basic($mysqli, "hitcounter", "hit_id");
$hitCountObj->addNew(array("ipaddress", "dateposted", "pagename"), array($IP_ADDRESS, time(), $PAGE_NAME));

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title><?php echo $PAGE_NAME.$CLAN_NAME; ?></title>
		
		<link href='http://fonts.googleapis.com/css?family=Overlock+SC' rel='stylesheet' type='text/css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/style.css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/btcs4.css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/medieval/jqueryui/jquery-ui-1.9.2.custom.min.css'>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-1.6.4.min.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-ui-1.8.17.custom.min.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/main.js'></script>
			<?php if(isset($EXTERNAL_JAVASCRIPT))
			        echo $EXTERNAL_JAVASCRIPT; ?>
	</head>
<body>
	<div id='toolTip'></div>
	<div id='toolTipWidth'></div>

		<div class='mainSiteContainer'>

		<table class='mainSiteTable'>
			<tr>
				<td class='mainSiteLeft' valign='top'>
					<table class='layoutContentTable'>
						<tr>
							<td class='top-left-table'></td><td class='top-table'></td><td class='top-right-table'></td>
						</tr>
						<tr>
							<td class='left-table'></td>
							<td valign='top' class='center-table'>