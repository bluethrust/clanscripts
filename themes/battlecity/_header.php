<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/battlecity/battlecitymenu.php");
$themeMenusObj = new BattleCityMenu($mysqli);

$btThemeObj->setThemeName("Battle City");

$btThemeObj->menusObj = $themeMenusObj;

$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=PT+Mono|Oxygen+Mono' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/battlecity/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
$btThemeObj->addHeadItem("battlecityjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/battlecity/battlecity.js'></script>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
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
				<?php $themeMenusObj->displayMenu(2); ?>
			</div>
			<div class='logoDiv'><a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a></div>
			
			<div class='topMenuDiv'>
				<?php $themeMenusObj->displayMenu(3); ?>
			</div>
		</div>
	
	
		<div class='bodyDiv'>
			
			<div class='leftMenuDiv'>
			
				<?php $themeMenusObj->displayMenu(0); ?>
			
			</div>
			
			<div class='rightMenuDiv'>
				<?php $themeMenusObj->displayMenu(1); ?>
			</div>
			<div class='centerContentWrapper'>
				<div class='centerContentBGDiv'>
					<div class='centerContentMainDiv'>
					<?php include(BASE_DIRECTORY."include/clocks.php"); ?>