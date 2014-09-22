<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/ghost/ghostmenu.php");
$themeMenusObj = new GhostMenu($mysqli);

$btThemeObj->setThemeName("Ghost");

$btThemeObj->menusObj = $themeMenusObj;

$btThemeObj->addHeadItem("ghostjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/ghost/ghost.js'></script>");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>


	<div class='bottom-left-character'></div>
	<div class='right-grunge'></div>
	<div class='boxBG'></div>
	<div class='left-character'></div>
	<div class='left-grunge'></div>
	
	<div class='crosshairLine'></div>
	
	<div class='wrapper'>
	<div class='headerDiv'>
	
		<div class='logoDiv'><img src='<?php echo $MAIN_ROOT; ?>themes/ghost/images/logo.png'></div>
	
		<div class='crosshairDiv'></div>
		<div class='ghostSkull'></div>
		
		<div class='loginSection'>
		
			<?php $themeMenusObj->displayMenu(2); ?>
			
		</div>
	</div>
	
	<div class='topMenuDiv'>
	
		<?php $themeMenusObj->displayMenu(3); ?>

	</div>
	
	<div class='bodyDiv'>
	
		<div class='leftMenuDiv'>
			<?php $themeMenusObj->displayMenu(0); ?>
		</div>
		<div class='rightMenuDiv'>
		
			<?php $themeMenusObj->displayMenu(1); ?>
		
		</div>
		<div class='centerContentDiv'>
		<?php include(BASE_DIRECTORY."include/clocks.php"); ?>
							