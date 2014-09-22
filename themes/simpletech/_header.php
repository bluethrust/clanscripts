<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/simpletech/simpletechmenu.php");
$themeMenusObj = new SimpleTechMenu($mysqli);

$btThemeObj->setThemeName("Simple Tech");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/simpletech/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
$btThemeObj->addHeadItem("simpletechjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/simpletech/simpletech.js'></script>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>
<div class='background-texture'></div>
	<div class='topBar'></div>
	
	
	<div class='wrapper'>
		<div class='headerDiv'>
			<div class='topMenuLeft'><?php $themeMenusObj->displayMenu(3); ?></div>
		
			<div class='topMenuContainer'><?php $themeMenusObj->displayMenu(2); ?></div>
		</div>
		<div class='leftSiteContainer'>
			<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a>
			
			
			
			<div class='leftLeftContainer'><?php $themeMenusObj->displayMenu(0); ?></div>
			<div class='leftRightContainer'><?php $themeMenusObj->displayMenu(1); ?></div>
		</div>
		<div class='mainSiteContentDiv'>
		<?php include(BASE_DIRECTORY."include/clocks.php"); ?>