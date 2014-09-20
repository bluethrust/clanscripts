<?php

include($prevFolder."themes/battlecity/_logindisplay.php");
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/battlecity/_menus.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title><?php echo $PAGE_NAME.$CLAN_NAME; ?></title>
		<link href='https://fonts.googleapis.com/css?family=PT+Mono|Oxygen+Mono' rel='stylesheet' type='text/css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/battlecity/jqueryui/jquery-ui-1.9.2.custom.min.css'>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-1.6.4.min.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/jquery-ui-1.8.17.custom.min.js'></script>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/battlecity/btcs4.css'>
		<link rel='stylesheet' type='text/css' href='<?php echo $MAIN_ROOT; ?>themes/battlecity/style.css'>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>themes/battlecity/battlecity.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/main.js'></script>
		<script type='text/javascript' src='<?php echo $MAIN_ROOT; ?>js/imageslider.js'></script>
			<?php if(isset($EXTERNAL_JAVASCRIPT))
			        echo $EXTERNAL_JAVASCRIPT; ?>
	</head>
	<body>
		<div class='left-building-bg'></div>
		<div class='top-right-bg'></div>
		
		<div class='right-building-bg'></div>
		<div class='top-left-bg'></div>
		<div class='top-left-bg2'></div>
		<div class='bottom-center-bg'></div>
		<div class='top-gradient-bg'></div>
		<div class='bottom-gradient-bg'></div>
		<div class='pattern-bg'></div>
		<div class='gradientBall'></div>
	
		<div class='wrapper'>
		<div class='headerDiv'>
		
			<div class='dogTagsDiv'>
				<?php dispMenu(2); ?>
			</div>
			<div class='logoDiv'><a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a></div>
			
			<div class='topMenuDiv'>
				<?php dispMenu(3); ?>
			</div>
		</div>
	
	
		<div class='bodyDiv'>
			
			<div class='leftMenuDiv'>
			
				<?php dispMenu(0); ?>
			
			</div>
			
			<div class='rightMenuDiv'>
				<?php dispMenu(1); ?>
			</div>
			<div class='centerContentWrapper'>
				<div class='centerContentBGDiv'>
					<div class='centerContentMainDiv'>
					
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