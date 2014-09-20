<?php

include($prevFolder."themes/include_header.php");
include($prevFolder."themes/lol/btlolthememenu.php");
$themeMenusObj = new btLoLThemeMenu($mysqli);

$btThemeObj->setThemeName("League of Legends");

$btThemeObj->menusObj = $themeMenusObj;

$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);

$btThemeObj->addHeadItem("loljs", "<script type='text/javascript' src='".MAIN_ROOT."themes/lol/lol.js'></script>");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>

	<div class='imageBGContainer'>
		<div class='imageBG'></div>
		<div class='imageBGGradient'></div>
	</div>

	<div class='leftCharacterBG'></div>
	<div class='rightCharacterBG'></div>
	
	<div class='headerDiv'>
	
		<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a>
	
	</div>
	
	<div class='topMenuContainer'>
		<div class='topMenuLeftCorner'></div>
		<div class='topMenuRightCorner'></div>
		
		<?php $themeMenusObj->displayMenu(1); ?>
	
	</div>
	
	<div class='bodyDiv'>
		
		<div class='bodyMainContent'>
			<?php include(BASE_DIRECTORY."include/clocks.php"); ?>