<?php
$zombieEyes = false;

/*
 * Set the $dispLoginBox variable to the code you want to be used to display what the user will see when
* they are not logged in (i.e. a login form!)1
*/

$dispLoginBox = "
<form action='".$MAIN_ROOT."login.php' method='post' style='padding: 0px; margin: 0px'>
<div class='rememberMe_Off' id='rememberMeDiv'></div>
		
	<div id='rememberMeSwitch'></div>
	
	<div class='loginBox'>
	
		<div class='loginUsernameDiv'>
			<input type='text' name='user' class='loginTextBox'>
		</div>
		<div class='loginPasswordDiv'>
			<input type='password' name='pass' class='loginTextBox'>
		</div>
		
	</div>
	
	<div id='loginSign'></div>
	
	<input type='hidden' id='txtRememberMe' value='0' name='rememberme'>
	<input type='submit' name='submit' id='btnSubmit' style='display: none'>
</form>
";


/*
 * - dispLoggedIn Function -
*
* Set the $dispLoggedinBox variable inside the function to the code that you want to be used
* for the logged in portion of the layout.  Use the array $arrLoginInfo inside the function
* to display a logged in member information.
*
* Will return the variable $dispLoggedinBox
*
*/

function dispLoggedIn($arrLoginInfo) {
	global $MAIN_ROOT;

	/*
	 $arrLoginInfo['memberID'] = $memberID;
	$arrLoginInfo['memberUsername'] = $memberUsername;
	$arrLoginInfo['memberRank'] = $memberRank;
	$arrLoginInfo['pmCID'] = $pmCID;
	$arrLoginInfo['pmCount'] = $dispPMCount;
	*/

	
	$dispLoggedinBox = "
	
		<div class='loggedInBox'>
		
			<div style='float: left; width: 48%; overflow: hidden; text-overflow: ellipsis; height: 28px'>
			<b>Account Name:</b><br>
			<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
			</div>
			<div style='float: right; width: 48%; overflow: hidden; text-overflow: ellipsis; height: 28px'>
			<b>Rank:</b><br>
			".$arrLoginInfo['memberRank']."
			</div>
			<div style='clear: both'></div>
			<div style='margin-top: 3px'>
				<b>Member Options:</b>
				<p align='center' style='margin: 0px; padding: 0px'>
					<a href='".$MAIN_ROOT."members'>My Account</a> - 
					<a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a> - 
					<a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a>
				</p>
			</div>
		</div>
	";
	
	/*
		<div class='loggedInIMG'></div>
		<div class='menuLinks' style='padding-left: 8px'>
			<b>Account Name:</b><br>
			<a href='".$MAIN_ROOT."profile.php?mID=".$arrLoginInfo['memberID']."'>".$arrLoginInfo['memberUsername']."</a>
			<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
			<b>Rank:</b><br>
			".$arrLoginInfo['memberRank']."
			<hr style='width: 135px; margin: 6px 1px; padding: 0px; border: dotted whitesmoke 1px'>
			<b>Member Options:</b><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members'>My Account</a><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members/console.php?cID=".$arrLoginInfo['pmCID']."'>PM Inbox ".$arrLoginInfo['pmCountDisp']."</a><br>
			<b>&middot;</b> <a href='".$MAIN_ROOT."members/signout.php'>Sign Out</a><br>		
		</div>
	
	";
	*/
	
	
	return $dispLoggedinBox;
}


$setShoutBoxDIV = "mainShoutbox";
$setShoutBoxWidth = 155;
$setShoutBoxHeight = 400;


include($prevFolder."themes/include_header.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title><?php echo $PAGE_NAME.$CLAN_NAME; ?></title>
	<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/minecraft/jqueryui/jquery-ui-1.9.2.custom.min.css'>
	<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-1.6.4.min.js'></script>
	<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-ui-1.8.17.custom.min.js'></script>
	<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/minecraft/mcfont/stylesheet.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/minecraft/btcs4.css'>
	<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/minecraft/style.css'>
	<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>themes/minecraft/minecraft.js'></script>
	<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/main.js'></script>
		<?php if(isset($EXTERNAL_JAVASCRIPT))
		        echo $EXTERNAL_JAVASCRIPT; ?>
</head>
<body>

<div class='wrapper'>
	<div class='headerDiv'>
	<div class='grassBlockBar'></div>
	
	<div class='skyBG'></div>
	
	<div class='sunDiv'></div>
	
	
	<div class='loginDiv'>
	
		<?php echo $dispLoginBox; ?>
		
	</div>
	
	<div class='logoDiv'><a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $MAIN_ROOT; ?>themes/minecraft/images/logo.png'></a></div>
	</div>
	
	<div class='mainSiteContainer'>
	
		<table class='contentTable'>
			<tr>
				<td class='topLeft'></td>
				<td class='top'></td>
				<td class='topRight'></td>
			</tr>
			<tr>
				<td class='left'></td>
				<td class='mainContent'>
	
	
					<table class='innerContentTable'>
						<tr>
							<td class='menuColumn' valign='top'>
								<img src='<?php echo $MAIN_ROOT; ?>themes/minecraft/images/layout/menu/mainmenu.png'>
								<div class='menuLinks'>
									<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>'>Home</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>news'>News</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>members.php'>Members</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>ranks.php'>Ranks</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>squads'>Squads</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>tournaments'>Tournaments</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>events'>Events</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>medals.php'>Medals</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>diplomacy'>Diplomacy</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>diplomacy/request.php'>Diplomacy Request</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=11'>History</a><br>
										<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>custompage.php?pID=12'>Rules</a><br>
										<b>&middot;</b> <a href='<?php echo $websiteInfo['forumurl']; ?>'>Forum</a>
											
										<?php
											if($websiteInfo['memberregistration'] == 0 && constant('LOGGED_IN') != true) {
												echo "<br><b>&middot;</b> <a href='".$MAIN_ROOT."signup.php'>Sign Up</a><br>";
											}
										?>
								
								</div>
								<img src='<?php echo $MAIN_ROOT; ?>themes/minecraft/images/layout/menu/topplayers.png'>
								<div class='menuLinks'>
									<b>&middot;</b> <a href='<?php echo $MAIN_ROOT; ?>top-players/recruiters.php'>Recruiters</a><br>
										<?php
											$hpGameObj = new Game($mysqli);
											$arrGames = $hpGameObj->getGameList();
											foreach($arrGames as $gameID) {
												$hpGameObj->select($gameID);
												echo "<b>&middot;</b> <a href='".$MAIN_ROOT."top-players/game.php?gID=".$gameID."'>".$hpGameObj->get_info_filtered("name")."</a><br>";
											}
										?>
								</div>
							</td>
							<td class='main' valign='top'>
							
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
								<div class='gradientBox' style='text-align: left; width: 97%; margin: 0px auto 2px auto; padding: 3px; height: 14px; font-weight: bold; font-size: 11px'>
								".$displaydate."
							</div>
							</div>
							<div class='main' style='margin-bottom: 15px'>
								<p align='center' style='margin: 0px; padding: 0px'>
									<span class='main' style='color: lime; font-weight: bold'>Eastern Time: <span id='showEasternTime'></span></span> || <span class='main' style='color: gold; font-weight: bold'>Central Time: <span id='showCentralTime'></span></span> || <span class='main' style='color: #1E90FF; font-weight: bold'>Mountain Time: <span id='showMountainTime'></span></span> || <span class='main' style='color: #E9967A; font-weight: bold'>Pacific Time: <span id='showPacificTime'></span></span>
								</p>
							</div>
							<script type='text/javascript'>
								displayClock(".$eastHour.", ".$eastMinutes.", 'showEasternTime');
								displayClock(".$centralHour.", ".$centralMinutes.", 'showCentralTime');
								displayClock(".$mountainHour.", ".$mountainMinutes.", 'showMountainTime');
								displayClock(".$pacificHour.", ".$pacificMinutes.", 'showPacificTime');
							</script>
							";