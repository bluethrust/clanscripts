<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/armygreen/armygreenmenu.php");
$themeMenusObj = new ArmyGreenMenu($mysqli);

$btThemeObj->setThemeName("Army Green");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Exo' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->addHeadItem("armygreenjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/armygreen/armygreen.js'></script>");
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/armygreen/jqueryui/jquery-ui-1.9.2.custom.min.css'>");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>
	
		
	
		<div class='mainSiteContainer'>
		<div class='mainSiteInnerContainer'>
			
			<div class='contentContainer'>
				

				<table class='siteContentTable' style='width: 100%'>
					<tr>
						<td class='topLeft'></td>
						<td class='topBG'></td>
						<td class='topRight'></td>
					</tr>
					<tr>
						<td class='leftBG'></td>
						<td class='contentSection'>
						<?php include(BASE_DIRECTORY."include/clocks.php"); ?>