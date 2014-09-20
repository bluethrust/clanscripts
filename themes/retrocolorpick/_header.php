<?php

include($prevFolder."themes/include_header.php");
include($prevFolder."themes/retrocolorpick/retrocolorpickmenu.php");
$themeMenusObj = new RetroColorPickMenu($mysqli);

$btThemeObj->setThemeName("RetroColorPick");

$btThemeObj->menusObj = $themeMenusObj;

$arrPossibleThemeColors = array("red", "blue", "green", "pink", "orange", "gray");
$rcpThemeColor = $_SESSION['rcpThemeColor'];


if(!isset($rcpThemeColor) && isset($_COOKIE['rcpThemeColor'])) {
	$rcpThemeColor = $_COOKIE['rcpThemeColor'];	
}


if(!isset($rcpThemeColor) || !in_array($rcpThemeColor, $arrPossibleThemeColors)) {
	$rcpThemeColor = "blue";	
}
elseif(in_array($rcpThemeColor, $arrPossibleThemeColors) && (!isset($_COOKIE['rcpThemeColor']) || (isset($_COOKIE['rcpThemeColor']) && ($_COOKIE['rcpThemeColorExpire']-time()) < 86400))) {
	$rcpColorPickExpTime = time()+((60*60*24)*5);
	setcookie("rcpThemeColor", $rcpThemeColor, $rcpColorPickExpTime);
	setcookie("rcpThemeColorExpire", $rcpColorPickExpTime, $rcpColorPickExpTime);
}


$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".$MAIN_ROOT."themes/retrocolorpick/images/theme/".$rcpThemeColor."/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
$btThemeObj->updateHeadItem("mainstyle", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/retrocolorpick/style.php'>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>
	
		<table class='mainSiteTable' cellpadding='0' cellspacing='0'>
			<tr>
				<td colspan='3' align='right' style='padding: 3px'>
					<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/transparent.png' onclick="rcpThemeChangeColor('red')" id='colorButton_red'>
					<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/transparent.png' onclick="rcpThemeChangeColor('blue')" id='colorButton_blue'>
					<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/transparent.png' onclick="rcpThemeChangeColor('green')" id='colorButton_green'>
					<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/transparent.png' onclick="rcpThemeChangeColor('orange')" id='colorButton_orange'>
					<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/transparent.png' onclick="rcpThemeChangeColor('gray')" id='colorButton_gray'>
					<img src='<?php echo $MAIN_ROOT; ?>themes/<?php echo $THEME; ?>/images/transparent.png' onclick="rcpThemeChangeColor('pink')" id='colorButton_pink'>
				</td>
			</tr>
			<tr>
				<td colspan='3' align='center' class='logoTD'><img src='<?php echo $MAIN_ROOT; ?>themes/retrocolorpick/images/theme/<?php echo $rcpThemeColor; ?>/logo.png'></td>
			</tr>
			<tr>
				<td class='navMenu' valign='top' style='border-top: 0px'>
					<?php $themeMenusObj->displayMenu(0); ?>
				</td>
				<td class='mainSiteContent' valign='top' style='border-width: 0px 0px 1px 0px'>
				<?php include(BASE_DIRECTORY."include/clocks.php"); ?>
				