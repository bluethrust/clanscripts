<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/minecraft/minecraftmenu.php");
$themeMenusObj = new MinecraftMenu($mysqli);

$btThemeObj->setThemeName("Minecraft");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/minecraft/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
$btThemeObj->addHeadItem("mcfont", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/minecraft/mcfont/stylesheet.css'>");
$btThemeObj->moveHeadItem("mcfont", 1);
$btThemeObj->addHeadItem("minecraftjs", "<script type='text/javascript' src='".$MAIN_ROOT."themes/minecraft/minecraft.js'></script>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<?php $btThemeObj->displayHead(); ?>
</head>
<body>

<div class='wrapper'>
	<div class='headerDiv'>
	<div class='grassBlockBar'></div>
	
	<div class='skyBG'></div>
	
	<div class='sunDiv'></div>
	
	
	<div class='loginDiv'>
	
		<?php $themeMenusObj->displayMenu(2); ?>
		
	</div>
	
	<div class='logoDiv'><a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a></div>
	</div>
	
	<div class='mainSiteContainer'>
	
		<table class='contentTable'>
			<tr>
				<td class='topLeft'></td>
				<td class='top'></td>
				<td class='topRight'></td>
			</tr>
			<tr>
				<td class='left'></td>
				<td class='mainContent'>
	
	
					<table class='innerContentTable'>
						<tr>
							<td class='menuColumn' valign='top'>
								
								<?php
									// LEFT MENU SECTION
									$themeMenusObj->displayMenu(0);
								
								?>
								
							</td>
							<td class='main' valign='top'>
							<?php include(BASE_DIRECTORY."include/clocks.php"); ?>