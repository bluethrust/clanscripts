<?php


$setShoutBoxDIV = "mainShoutbox";
$setShoutBoxWidth = 155;
$setShoutBoxHeight = 400;


include($prevFolder."themes/include_header.php");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<title><?php echo $PAGE_NAME.$CLAN_NAME; ?></title>
		<link href='http://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/bluenova/jqueryui/jquery-ui-1.9.2.custom.min.css'>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-1.6.4.min.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-ui-1.8.17.custom.min.js'></script>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/bluenova/btcs4.css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/bluenova/style.css'>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>themes/bluenova/bluenova.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/main.js'></script>
			<?php if(isset($EXTERNAL_JAVASCRIPT))
			        echo $EXTERNAL_JAVASCRIPT; ?>
	</head>
	<body>
	
	<div id='toolTip'></div>
	<div id='toolTipWidth'></div>
	
	<div class='wrapper'>
		
			<div class='headerDiv'>
				<div class='logo'><a href='index.php'><img src='<?php echo $MAIN_ROOT; ?>themes/bluenova/images/layout/logo.png'></a></div>
	
				<div class='loginDiv'>
					
					<?php echo $dispLoginBox; ?>
					
				</div>
			</div>

			<div class='effectBG'></div>


			<div class='mainSiteDiv'>


			<div class='quickLinksDiv'>
			
				<a href='<?php echo $MAIN_ROOT; ?>news'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='newsButton' alt='News'></a>
				<a href='<?php echo $MAIN_ROOT; ?>members.php'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='membersButton' alt='Members'></a>
				<a href='<?php echo $MAIN_ROOT; ?>tournaments'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='tournamentsButton' alt='Tournaments'></a>
				<a href='<?php echo $MAIN_ROOT; ?>squads'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='squadsButton' alt='Squads'></a>
				<a href='<?php echo $MAIN_ROOT; ?>events'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='eventsButton' alt='Events'></a>
				<a href='<?php echo $websiteInfo['forumurl']; ?>'><img src='<?php echo $MAIN_ROOT; ?>images/transparent.png' class='forumButton' alt='Forum'></a>
				
			
			</div>

			
			
			<table class='mainContentTable'>
				<tr>
					<td class='top-left'></td>
					<td class='top'></td>
					<td class='top-right'></td>
				</tr>
				<tr>
					<td class='left'></td>
					<td class='mainContent'>
					
						<table class='innerContentTable'>
							<tr>
								<td class='menuColumn' valign='top'>
								
									<div class='navigationMenu'></div>
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
									
									<div class='topplayersMenu'></div>
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
								<td valign='top' style='margin: 0px; padding: 0px 10px'>
								
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
									