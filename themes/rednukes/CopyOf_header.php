<?php

include_once($prevFolder."classes/member.php");
include_once($prevFolder."classes/rank.php");
include_once($prevFolder."classes/consoleoption.php");
include_once($prevFolder."classes/game.php");
include_once($prevFolder."classes/shoutbox.php");

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' id='loginForm' style='padding: 0px; margin: 0px'>
<div class='memberLogin'>
	<div class='loginBoxContent'>
		<div style='margin-bottom: 10px'><img src='".$MAIN_ROOT."themes/rednukes/images/username.png' style='margin-right: 12px;'> <input type='text' name='user' id='loginUserTextBox' class='textBox' style='width: 140px; height: 20px; '></div>
		<img src='".$MAIN_ROOT."themes/rednukes/images/password.png' style='margin-right: 10px'> <input type='password' name='pass' id='loginPasswordTextBox' class='textBox' style='width: 140px; height: 20px'><br>
	</div>
	
	<div class='loginBoxButton'>
		<a href='javascript:void(0)' onclick='clickLogin()'><img src='".$MAIN_ROOT."themes/rednukes/images/login-button.png' onmouseover=\"src='".$MAIN_ROOT."themes/rednukes/images/login-button_hover.png'\" onmouseout=\"src='".$MAIN_ROOT."themes/rednukes/images/login-button.png'\"></a>
	</div>
</div>
</form>
			
			
<script type='text/javascript'>
	function clickLogin() {
		$(document).ready(function() {
			$.post('".$MAIN_ROOT."login.php', { submit: 1, user: $('#loginUserTextBox').val(), pass: $('#loginPasswordTextBox').val() }, function(data) {
				window.location = '".$MAIN_ROOT."login.php';
			});
		});
	}
</script>

";

$mainShoutboxObj = new Shoutbox($mysqli, "news", "news_id");

$mainShoutboxObj->strDivID = "mainShoutbox";
$mainShoutboxObj->intDispWidth = 140;
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
			
			<div class='loggedIn'>
				<div class='loggedInBoxContent'>
				<p align='center' style='padding-bottom: 2px; margin-bottom: 0px'><b>You are logged in</b></p>
					<table align='center' border='0' cellspacing='0' cellpadding='0' width='282'>
						<tr>
							<td class='tinyFont' valign='top'>
							<b>Rank:</b> ".$memberRank."<br><span style='font-size: 1px'><br></span>
							<b>User:</b> <a href='".$MAIN_ROOT."profile.php?mID=".$memberID."'>".$memberUsername."</a><br><br>
							</td>
							<td class='tinyFont' valign='top'>
							<b>·</b> <a href='".$MAIN_ROOT."members/console.php'>My Account</a><br><span style='font-size: 1px'><br></span>
							<b>·</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$pmCID."'>PM Inbox ".$dispPMCount."</a><br><span style='font-size: 1px'><br></span>
							<b>·</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>
							</td>
						</tr>
					</table>
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
		<title><?php echo $PAGE_NAME.$CLAN_NAME; ?></title>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/rednukes/style.css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/rednukes/btcs4.css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/rednukes/jqueryui/css/jquery-ui-1.9.2.custom.css'>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-1.6.4.min.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>themes/rednukes/jqueryui/js/jquery-ui-1.9.2.custom.min.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/main.js'></script>
		<?php if(isset($EXTERNAL_JAVASCRIPT))
		        echo $EXTERNAL_JAVASCRIPT; ?>
	</head>
	<body>
		<div id='toolTip'></div>
		<div id='toolTipWidth'></div>
		
		<audio id='notificationSound'>
			<source src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/notification.mp3'></source>
			<source src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/notification.ogg'></source>
		</audio>
		
		
		<div style='display: none'><img src='<?php echo $MAIN_ROOT; ?>themes/rednukes/images/login-button_hover.png'></div>
	
	
		<div class='mainWrapper'>
		
		
		
			<div class='mainContentBox'>
				<table align='center' border='0' cellspacing='0' cellpadding='0' width='988'>
					<tr>
						<td class='contentTopBG'></td>
					</tr>
					<tr>
						<td class='contentMain'>
						
						
						
						
							<table align='center' width='950' cellspacing='0' cellpadding='0' style='margin-top: 10px'>
						<tr>
							<td width='145' valign='top' class='menulinks'>
								<img src='<?php echo $MAIN_ROOT; ?>themes/rednukes/images/menu/main.png'><br><span style='font-size: 3px'><br></span>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>'>Home</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>news'>News</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>members.php'>Members</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>ranks.php'>Ranks</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>squads'>Squads</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>tournaments'>Tournaments</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>diplomacy'>Diplomacy</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>medals.php'>Medals</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=11'>History</a><br>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=12'>Rules</a><br>

								
								
								<?php
									if($websiteInfo['memberregistration'] == 0 && constant('LOGGED_IN') != true) {
										echo "&nbsp;&nbsp;<b>·</b> <a href='".$MAIN_ROOT."signup.php'>Sign Up</a><br>";
									}
								?>
								<br>
							
								<img src='<?php echo $MAIN_ROOT; ?>themes/rednukes/images/menu/topplayers.png'><br><span style='font-size: 3px'><br></span>
								  <b>·</b> <a href='<?php echo $MAIN_ROOT; ?>top-players/recruiters.php'>Recruiters</a><br>
								<?php
									$hpGameObj = new Game($mysqli);
									$arrGames = $hpGameObj->getGameList();
									foreach($arrGames as $gameID) {
										$hpGameObj->select($gameID);
										echo "  <b>·</b> <a href='".$MAIN_ROOT."top-players/game.php?gID=".$gameID."'>".$hpGameObj->get_info_filtered("name")."</a><br>";
									}
								?>
								<br>
								<img src='<?php echo $MAIN_ROOT; ?>themes/rednukes/images/menu/forum.png'><br><span style='font-size: 3px'><br></span>
								  <b>·</b> <a href='<?php echo $websiteInfo['forumurl']; ?>' target='_blank'>Enter the Forum</a><br>
								<br>
								
							</td>
							<td width='655' valign='top' class='main'>
							
							
							
							<?php 
$displaydate = date("l, F j, Y"); 

$east = gmdate("g:i A", time()+((-5+date("I"))*3600));
$central = gmdate("g:i A", time()+((-6+date("I"))*3600));
$mountain = gmdate("g:i A", time()+((-7+date("I"))*3600));
$pacific = gmdate("g:i A", time()+((-8+date("I"))*3600));
?>

<table align='center' width='640' cellspacing='1' cellpadding='2' border='0'>
<tr>
<td style="border: solid darkred 1px" class='main' background='<?php echo $MAIN_ROOT; ?>themes/rednukes/images/gradient.jpg'>
<b><?php echo $displaydate; ?></b>
</td>
</tr>
<tr>
<td class='tinyFont' align='center' style="border-width: 0px">
<span style='color:#336600'><b>Eastern Time: <?php echo $east; ?></b></span> || <span style='color:gold'><b>Central Time: <?php echo $central; ?></b></span> || <span style='color:slateblue'><b>Mountain Time: <?php echo $mountain; ?></b></span> || <span style='color:#333333'><b>Pacific Time: <?php echo $pacific; ?></b></span>
</td>
</tr>
</table>


