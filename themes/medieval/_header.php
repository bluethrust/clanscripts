<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/medieval/medievalmenu.php");
$themeMenusObj = new MedievalBlueMenu($mysqli);

$btThemeObj->setThemeName("Medieval Blue");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/medieval/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Overlock+SC' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>
	<div id='toolTip'></div>
	<div id='toolTipWidth'></div>

		<div class='mainSiteContainer'>

		<table class='mainSiteTable'>
			<tr>
				<td class='mainSiteLeft' valign='top'>
					<table class='layoutContentTable'>
						<tr>
							<td class='top-left-table'></td><td class='top-table'></td><td class='top-right-table'></td>
						</tr>
						<tr>
							<td class='left-table'></td>
							<td valign='top' class='center-table'>
							<?php include(BASE_DIRECTORY."include/clocks.php"); ?>