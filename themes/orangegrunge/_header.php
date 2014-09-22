<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/orangegrunge/orangegrungemenu.php");
$themeMenusObj = new OrangeGrungeMenu($mysqli);

$btThemeObj->setThemeName("Orange Grunge");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/orangegrunge/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>
	<div id='toolTip'></div>
	<div id='toolTipWidth'></div>

	
	
	<!-- Start Logo Section -->
		<div class='logoDiv'><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/logo.png'><br><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/logo2.png'></div>
		<div class='left-orange-line'><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/layout/left-line.png'></div>
		<div class='right-orange-line'><img src='<?php echo $MAIN_ROOT; ?>themes/orangegrunge/images/layout/right-line.png'></div>
	<!-- End Logo Section -->
	
	
	<div class='mainSiteContainer'>
		<table class='mainLayoutTable'>
			<tr>
				<td class='top-left-corner'>&nbsp;</td>
				<td class='top-side'></td>
				<td class='top-right-corner'>&nbsp;</td>
			</tr>
			<tr>
				<td class='left-side'></td>
				<td class='mainContentBox' valign='top'>
	
					
					
					<table class='mainInnerTable'>
						<tr>
							<td class='menuColumn' valign='top'>
								
								<?php $themeMenusObj->displayMenu(0); ?>
								
							</td>
							<td class='contentColumn' valign='top'>
							<?php include(BASE_DIRECTORY."include/clocks.php"); ?>
							