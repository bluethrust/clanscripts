<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/tf2blue/tf2bluemenu.php");
$themeMenusObj = new TF2BlueMenu($mysqli);

$btThemeObj->setThemeName("TF2 Blue");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->addHeadItem("tf2bluejs", "<script type='text/javascript' src='".MAIN_ROOT."themes/tf2blue/tf2blue.js'></script>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>

		<div class='patternOverlay'></div>
	
	<div class='wrapper'>
		<div class='headerDiv'>
		
			<div class='logoDiv'><img src='<?php echo $MAIN_ROOT; ?>themes/tf2blue/images/logo.png'></div>
			<div class='loginAreaDiv'>
			
				<?php $themeMenusObj->displayMenu(2); ?>
				
				
			</div>
		
		
			<div class='topMenuDiv'>
				
				<div class='topMenuBG'></div>
				<div class='topMenuLeftBG'></div>
				<div class='topMenuRightBG'></div>
				
				<div class='topMenuItemsWrapper'>
					<?php $themeMenusObj->displayMenu(3); ?>
				</div>
				
			</div>
		
		</div>
		
		<div class='mainSiteContentDiv'>
		
			<div class='leftMenuSection'>
				<?php $themeMenusObj->displayMenu(0); ?>
			</div>
			<div class='rightMenuSection'>
				<?php $themeMenusObj->displayMenu(1); ?>
			</div>
			<div class='mainSiteSection'>
			<?php include(BASE_DIRECTORY."include/clocks.php"); ?>