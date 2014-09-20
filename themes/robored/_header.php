<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/robored/roboredmenu.php");
$themeMenusObj = new RoboRedMenu($mysqli);

$btThemeObj->setThemeName("Robo Red");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/robored/jqueryui/jquery-ui-1.9.2.custom.min.css'>");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>
	
		
	
		<div class='checkerBoardBG'></div>		
		
		<div class='mainSiteDiv'>
		
			<div class='logoDiv'><a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a></div>
		
		
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
									
									<?php $themeMenusObj->displayMenu(0); ?>
									
								</td>
								<td valign='top'>
								<?php include(BASE_DIRECTORY."include/clocks.php"); ?>