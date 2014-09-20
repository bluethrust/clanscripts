<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/saintsrow/saintsrowmenu.php");
$themeMenusObj = new SaintsRowMenu($mysqli);

$btThemeObj->setThemeName("Saints Row");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/saintsrow/jqueryui/jquery-ui-1.9.2.custom.css'>");
$btThemeObj->addHeadItem("saintsrowjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/saintsrow/saintsrow.js'></script>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>
	<div class='bottom-right-character'></div>
	<div class='bottom-left-character'></div>
	<div class='background-gradient'></div>
	
	<div class='logoBar'></div>


	<div class='wrapper'>
		<div class='headerDiv'>
		
			<div class='logoDiv'><img src='<?php echo $MAIN_ROOT; ?>themes/saintsrow/images/logo.png'></div>
		
			<div class='loginDiv'>
				
				<?php $themeMenusObj->displayMenu(2); ?>
			
			</div>
		
		
		</div>
	
	
		<div class='menuBarContainer'>
		
			<div class='menuBarShadow'></div>
			<div class='menuBarShadowBG'></div>
			<div class='menuBarBG'></div>
			<div class='menuBarLeft'></div>
			<div class='menuBarTape'></div>
			<div class='menuBarGrunge'></div>
		
			<div class='menuBarLinksContainer'>
			
				<?php $themeMenusObj->displayMenu(3); ?>
				
			
			</div>
		
		
		</div>
	
		<div class='mainSiteContainer'>
			<div class='leftMenuDiv'>
				<?php $themeMenusObj->displayMenu(0); ?>
			</div>
			
			<div class='rightMenuDiv'>
				<?php $themeMenusObj->displayMenu(1); ?>
			</div>
			
			<div class='centerContentDiv'>
			<?php include(BASE_DIRECTORY."include/clocks.php"); ?>