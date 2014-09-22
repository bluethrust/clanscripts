<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/rockyice/rockyicemenu.php");
$themeMenusObj = new RockyIceMenu($mysqli);

$btThemeObj->setThemeName("Rocky Ice");

$btThemeObj->menusObj = $themeMenusObj;

$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->addHeadItem("rockyicejs", "<script type='text/javascript' src='".MAIN_ROOT."themes/rockyice/rockyice.js'></script>");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>

	<div class='highlightBG'></div>
	<div class='topIceBG'></div>
	
	<div class='leftStripe'></div>
	<div class='rightStripe'></div>
	<div class='topLeftImg'></div>
	<div class='blueCircleImg'></div>
	<div class='bottomBlueImg'></div>
	
	<div class='headerDiv'>
		<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a>
	</div>
	<div class='bodyDiv'>
		<div class='topMenuDiv'>
			
			<div id='topMenuHighlight'></div>
			
			<div class='topMenuItemDiv'>

			<!-- Top Menu -->
				<?php $themeMenusObj->displayMenu(3); ?>
			</div>
			
			<div class='topMenuHorizontalLine'>
				<div class='horizontalLineShadeLeft'></div>
				<div class='horizontalLineShadeRight'></div>		
			</div>
			
		</div>
	
	
	
		<div class='leftMenuDiv'>
		
			<!-- Left Menu -->
			<?php $themeMenusObj->displayMenu(0); ?>
		</div>
		<div class='rightMenuDiv'>
		
			<!-- Right Menu -->
			<?php $themeMenusObj->displayMenu(1); ?>
		</div>
		<div class='centerContentWrapper'>
			<?php include(BASE_DIRECTORY."include/clocks.php"); ?>