<?php
//as1d1f
include_once($prevFolder."classes/member.php");
include_once($prevFolder."classes/rank.php");
include_once($prevFolder."classes/consoleoption.php");
include_once($prevFolder."classes/game.php");
include_once($prevFolder."classes/shoutbox.php");

// LOG IN BOX - NOT LOGGED IN 
// (CONTINUE BELOW TO EDIT THE BOX WHEN LOGGED IN)
$dispLoginBox = "
<tr>
	<td align='center' style='padding-top: 8px'><img src='".$MAIN_ROOT."themes/bluefade/images/transparent.png' class='menu_LogIn'></td>
</tr>
<tr>
	<td class='menuTop' align='center'><td>
</tr>
<tr>
	<form action='".$MAIN_ROOT."login.php' method='post'>
		<td class='menuContent'>
			<b>Username:</b><br>
			<input type='text' name='user' class='textBox' style='width: 125px'><br>
			<b>Password:</b><br>
			<input type='password' name='pass' class='textBox' style='width: 125px'><br>
			Remember Me: <input type='checkbox' value='1' name='rememberme' class='checkBox'><br>
			<input type='submit' name='submit' class='submitButton' value='Log In'>
		</td>
	</form>
</tr>
<tr>
	<td class='menuBottom'></td>
</tr>
";


$mainShoutboxObj = new Shoutbox($mysqli, "news", "news_id");

$mainShoutboxObj->strDivID = "mainShoutbox";
$mainShoutboxObj->intDispWidth = 124;
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
			
			
			// LOG IN BOX - LOGGED IN
			$dispLoginBox = "
			<tr>
				<td align='center' style='padding-top: 8px'><img src='".$MAIN_ROOT."themes/bluefade/images/transparent.png' class='menu_LoggedIn'></td>
			</tr>
			<tr>
				<td class='menuTop' align='center'><td>
			</tr>
			<tr>
				<td class='menuContent'>
					 <b>Account Name:</b>
					  <a href='".$MAIN_ROOT."profile.php?mID=".$memberID."'>".$memberUsername."</a><br>
					<hr style='width: 125px; margin: 6px 1px; padding: 0px; border: dotted gray 1px'>
					 <b>Rank:</b><br>
					  ".$memberRank."<br>
					<hr style='width: 125px; margin: 6px 1px; padding: 0px; border: dotted gray 1px'>
					 <b>Member Options:</b><br>
					  <b>·</b> <a href='".$MAIN_ROOT."members'>My Account</a><br>
					  <b>·</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$pmCID."'>PM Inbox ".$dispPMCount."</a><br>
					  <b>·</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>
				</td>
			</tr>
			<tr>
				<td class='menuBottom'></td>
			</tr>
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
<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/bluefade/style.css'>
<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/bluefade/btcs4.css'>
<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>js/css/jquery-ui-1.8.17.custom.css'>
<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-1.6.4.min.js'></script>
<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-ui-1.8.17.custom.min.js'></script>
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


<div class='characterBG'></div>
<div class='blueBarBG'></div>
<div class='logo'></div>


<div class='contentContainer'>

	<table align='center' border='0' cellspacing='0' cellpadding='0' width='985'>
		<tr>
			<td class='topLeftContentBox'></td>
			<td class='topContentBox'></td>
			<td class='topRightContentBox'></td>
		</tr>
		<tr>
			<td class='leftContentBox'></td>
			<td class='contentBoxMain'>
				<table align='center' border='0' cellspacing='0' cellpadding='0' width='960'>
					<tr>
						<td width='148' valign='top'>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='148'>
								<tr>
									<td align='center' style='padding-top: 8px'><img src='<?php echo $MAIN_ROOT; ?>themes/bluefade/images/transparent.png' class='menu_MainMenu'></td>
								</tr>
								<tr>
									<td class='menuTop' align='center'><td>
								</tr>
								<tr>
									<td class='menuContent'>
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
												echo "<b>·</b> <a href='".$MAIN_ROOT."signup.php'>Sign Up</a><br>";
											}
										?>
										
									</td>
								</tr>
								<tr>
									<td class='menuBottom'></td>
								</tr>
								
														
								<!-- WHERE TOURNAMENTS? AND STATISTICS SECTIONS WILL GO -->
								
								<tr>
									<td align='center' style='padding-top: 8px'><img src='<?php echo $MAIN_ROOT; ?>themes/bluefade/images/transparent.png' class='menu_TopPlayers'></td>
								</tr>
								<tr>
									<td class='menuTop' align='center'><td>
								</tr>
								<tr>
									<td class='menuContent'>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>top-players/recruiters.php'>Recruiters</a><br>
										<?php
											$hpGameObj = new Game($mysqli);
											$arrGames = $hpGameObj->getGameList();
											foreach($arrGames as $gameID) {
												$hpGameObj->select($gameID);
												echo "<b>&middot;</b> <a href='".$MAIN_ROOT."top-players/game.php?gID=".$gameID."'>".$hpGameObj->get_info_filtered("name")."</a><br>";
											}
										?>
									</td>
								</tr>
								<tr>
									<td class='menuBottom'></td>
								</tr>
								
								<tr>
									<td align='center' style='padding-top: 8px'><img src='<?php echo $MAIN_ROOT; ?>themes/bluefade/images/transparent.png' class='menu_Forum'></td>
								</tr>
								<tr>
									<td class='menuTop' align='center'><td>
								</tr>
								<tr>
									<td class='menuContent'><b>·</b> <a href='<?php echo $websiteInfo['forumurl']; ?>'>Enter the Forum</a></td>
								</tr>
								<tr>
									<td class='menuBottom'></td>
								</tr>
								
							</table>
						</td>
						<td width='664' valign='top' class='main'>
						<!-- CONTENT START -->						
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
								<div class='gradientBox' style='text-align: left; width: 650px; margin: 8px auto 2px auto; padding: 3px; height: 14px; font-weight: bold; font-size: 11px'>
								".$displaydate."
							</div>
							</div>
							<div class='main'>
								<p align='center' style='margin: 0px; padding: 0px'>
									<span class='main' style='color: lime; font-weight: bold'>Eastern Time: <span id='showEasternTime'></span></span> || <span class='main' style='color: gold; font-weight: bold'>Central Time: <span id='showCentralTime'></span></span> || <span class='main' style='color: slateblue; font-weight: bold'>Mountain Time: <span id='showMountainTime'></span></span> || <span class='main' style='color: steelblue; font-weight: bold'>Pacific Time: <span id='showPacificTime'></span></span>
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