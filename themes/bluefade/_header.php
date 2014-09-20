<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/bluefade/bluefademenu.php");
$themeMenusObj = new BlueFadeMenu($mysqli);


$btThemeObj->setThemeName("Blue Fade");
$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".$MAIN_ROOT."js/css/jquery-ui-1.8.17.custom.css'>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php $btThemeObj->displayHead(); ?>
</head>
<body>


<div class='characterBG'></div>
<div class='blueBarBG'></div>
<div class='logo'></div>


<div class='contentContainer'>

	<table align='center' border='0' cellspacing='0' cellpadding='0' width='985'>
		<tr>
			<td class='topLeftContentBox'></td>
			<td class='topContentBox'></td>
			<td class='topRightContentBox'></td>
		</tr>
		<tr>
			<td class='leftContentBox'></td>
			<td class='contentBoxMain'>
				<table align='center' border='0' cellspacing='0' cellpadding='0' width='960'>
					<tr>
						<td width='148' valign='top'>
							<table align='center' border='0' cellspacing='0' cellpadding='0' width='148'>
								<?php echo $themeMenusObj->displayMenu(0); ?>								
							</table>
						</td>
						<td width='664' valign='top' class='main'>
						<!-- CONTENT START -->						
						<?php include(BASE_DIRECTORY."include/clocks.php"); ?>