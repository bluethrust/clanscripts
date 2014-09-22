<?php

include_once($prevFolder."classes/member.php");
include_once($prevFolder."classes/rank.php");
include_once($prevFolder."classes/consoleoption.php");
include_once($prevFolder."classes/game.php");
include_once($prevFolder."classes/shoutbox.php");

$dispLoginBox = "
	<form action='".$MAIN_ROOT."login.php' method='post' style='margin: 0px; padding: 0px'>
	<img src='".$MAIN_ROOT."themes/orangegrunge/images/menu/memberlogin.png' style='margin-bottom: 3px'><br>
	<b>Username:</b><br>
	<input type='text' name='user' class='textBox' style='width: 125px'><br>
	<b>Password:</b><br>
	<input type='password' name='pass' class='textBox' style='width: 125px'><br>
	Remember Me: <input type='checkbox' value='1' name='rememberme' class='checkBox'><br>
	<input type='submit' name='submit' class='submitButton' value='Log In'>
	</form>
";

$mainShoutboxObj = new Shoutbox($mysqli, "news", "news_id");

$mainShoutboxObj->strDivID = "mainShoutbox";
$mainShoutboxObj->intDispWidth = 145;
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
				<img src='".$MAIN_ROOT."themes/orangegrunge/images/menu/loggedin.png' style='margin-bottom: 3px'><br>
				&nbsp;&nbsp;<b>Account Name:</b><br>
				&nbsp;&nbsp;<a href='".$MAIN_ROOT."profile.php?mID=".$memberID."'>".$memberUsername."</a>
				&nbsp;&nbsp;<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				&nbsp;&nbsp;<b>Rank:</b><br>
				&nbsp;&nbsp;".$memberRank."
				&nbsp;&nbsp;<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
				&nbsp;&nbsp;<b>Member Options:</b><br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".$MAIN_ROOT."members'>My Account</a><br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$pmCID."'>PM Inbox ".$dispPMCount."</a><br>
				&nbsp;&nbsp;<b>&middot;</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>		
			
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
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/style.css'>
			<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/btcs4.css'>
			<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/jqueryui/jquery-ui-1.9.2.custom.min.css'>
			<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-1.6.4.min.js'></script>
			<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-ui-1.8.17.custom.min.js'></script>
			<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/main.js'></script>
			<?php if(isset($EXTERNAL_JAVASCRIPT))
			        echo $EXTERNAL_JAVASCRIPT; ?>
	</head>
	<body>
	<div id='toolTip'></div>
	<div id='toolTipWidth'></div>

	
	
	<!-- Start Logo Section -->
		<div class='logoDiv'><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/logo.png'><br><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/logo2.png'></div>
		<div class='left-orange-line'><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/layout/left-line.png'></div>
		<div class='right-orange-line'><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/layout/right-line.png'></div>
	<!-- End Logo Section -->
	
	
	<div class='mainSiteContainer'>
		<table class='mainLayoutTable'>
			<tr>
				<td class='top-left-corner'>&nbsp;</td>
				<td class='top-side'></td>
				<td class='top-right-corner'>&nbsp;</td>
			</tr>
			<tr>
				<td class='left-side'></td>
				<td class='mainContentBox' valign='top'>
	
					
					
					<table class='mainInnerTable'>
						<tr>
							<td class='menuColumn' valign='top'>
								<img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/menu/mainmenu.png' style='margin-bottom: 3px'><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>'>Home</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>news'>News</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>members.php'>Members</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>ranks.php'>Ranks</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>squads'>Squads</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>tournaments'>Tournaments</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>medals.php'>Medals</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>diplomacy'>Diplomacy</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>diplomacy/request.php'>Diplomacy Request</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=11'>History</a><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=12'>Rules</a><br>
								
								<?php
									if($websiteInfo['memberregistration'] == 0 && constant('LOGGED_IN') != true) {
										echo "&nbsp;&nbsp;<b>·</b> <a href='".$MAIN_ROOT."signup.php'>Sign Up</a><br>";
									}
								?>
								
								<br><br>
								
								<img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/menu/topplayers.png' style='margin-bottom: 3px'><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>top-players/recruiters.php'>Recruiters</a><br>
								<?php
									$hpGameObj = new Game($mysqli);
									$arrGames = $hpGameObj->getGameList();
									foreach($arrGames as $gameID) {
										$hpGameObj->select($gameID);
										echo "&nbsp;&nbsp;<b>&middot;</b> <a href='".$MAIN_ROOT."top-players/game.php?gID=".$gameID."'>".$hpGameObj->get_info_filtered("name")."</a><br>";
									}
								?>
								
								<br><br>
								
								<img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/menu/forum.png' style='margin-bottom: 3px'><br>
								&nbsp;&nbsp;<b>&middot;</b> <a href='<?php echo $websiteInfo['forumurl']; ?>'>Enter the Forum</a><br>
								
							</td>
							<td class='contentColumn' valign='top'>
							
							<?php
							
							// Get UTC TIME
							$utcTime = time();
						
							// Clock Display
							$displaydate = date("l, F j, Y"); 

							$easternDate = new DateTime(date("Y-m-d"), new DateTimeZone('America/New_York'));
							$eastOffset = $easternDate->getOffset();
							$eastTime = ($utcTime+$eastOffset);
							$eastHour = gmdate("G", $eastTime);
							$eastMinutes = gmdate("i", $eastTime);

							$centralDate = new DateTime(date("Y-m-d"), new DateTimeZone('America/Chicago'));
							$centralOffset = $centralDate->getOffset();
							$centralTime = ($utcTime+$centralOffset);
							$centralHour = gmdate("G", $centralTime);
							$centralMinutes = gmdate("i", $centralTime);

							$mountainDate = new DateTime(date("Y-m-d"), new DateTimeZone('America/Denver'));
							$mountainOffset = $mountainDate->getOffset();
							$mountainTime = ($utcTime+$mountainOffset);
							$mountainHour = gmdate("G", $mountainTime);
							$mountainMinutes = gmdate("i", $mountainTime);

							$pacificDate = new DateTime(date("Y-m-d"), new DateTimeZone('America/Los_Angeles'));
							$pacificOffset = $pacificDate->getOffset();
							$pacificTime = ($utcTime+$pacificOffset);
							$pacificHour = gmdate("G", $pacificTime);
							$pacificMinutes = gmdate("i", $pacificTime);
							
							echo "
							<div style='text-align: center'>
								<div class='gradientBox' style='text-align: left; width: 99%; margin: 0px auto 2px auto; padding: 3px; height: 14px; font-weight: bold; font-size: 11px'>
								".$displaydate."
							</div>
							</div>
							<div class='main' style='margin-bottom: 15px'>
								<p align='center' style='margin: 0px; padding: 0px'>
									<span class='main' style='color: lime; font-weight: bold'>Eastern Time: <span id='showEasternTime'></span></span> || <span class='main' style='color: gold; font-weight: bold'>Central Time: <span id='showCentralTime'></span></span> || <span class='main' style='color: #EE82EE; font-weight: bold'>Mountain Time: <span id='showMountainTime'></span></span> || <span class='main' style='color: #B0E0E6; font-weight: bold'>Pacific Time: <span id='showPacificTime'></span></span>
								</p>
							</div>
							<script type='text/javascript'>
								displayClock(".$eastHour.", ".$eastMinutes.", 'showEasternTime');
								displayClock(".$centralHour.", ".$centralMinutes.", 'showCentralTime');
								displayClock(".$mountainHour.", ".$mountainMinutes.", 'showMountainTime');
								displayClock(".$pacificHour.", ".$pacificMinutes.", 'showPacificTime');
							</script>
							";
						
						?>
							
							