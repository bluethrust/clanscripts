<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/bluenova/bluenovamenu.php");
$themeMenusObj = new BlueNovaMenu($mysqli);

$btThemeObj->setThemeName("Blue Nova");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/bluenova/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->addHeadItem("bluenovajs", "<script type='text/javascript' src='".MAIN_ROOT."themes/bluenova/bluenova.js'></script>");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>
	
	<div id='toolTip'></div>
	<div id='toolTipWidth'></div>
	
	<div class='wrapper'>
		
			<div class='headerDiv'>
				<div class='logo'><a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a></div>
	
				<div class='loginDiv'>
					
					<?php $themeMenusObj->displayMenu(2); ?>
					
				</div>
			</div>

			<div class='effectBG'></div>


			<div class='mainSiteDiv'>


			<div class='quickLinksDiv'>
			
				<?php $themeMenusObj->displayMenu(3); ?>
			
			</div>

			
			
			<table class='mainContentTable'>
				<tr>
					<td class='top-left'></td>
					<td class='top'></td>
					<td class='top-right'></td>
				</tr>
				<tr>
					<td class='left'></td>
					<td class='mainContent'>
					
						<table class='innerContentTable'>
							<tr>
								<td class='menuColumn' valign='top'>
								
									<?php $themeMenusObj->displayMenu(0); ?>
									
								</td>
								<td valign='top' style='margin: 0px; padding: 0px 10px'>
								<?php include(BASE_DIRECTORY."include/clocks.php"); ?>
									