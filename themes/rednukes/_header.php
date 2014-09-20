<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/rednukes/rednukesmenu.php");
$themeMenusObj = new RedNukesMenu($mysqli);

$btThemeObj->setThemeName("Red Nukes");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/rednukes/jqueryui/css/jquery-ui-1.9.2.custom.css'>");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>

		<div style='display: none'><img src='<?php echo $MAIN_ROOT; ?>themes/rednukes/images/login-button_hover.png'></div>
	
	
		<div class='mainWrapper'>
		
		
		
			<div class='mainContentBox'>
				<table align='center' border='0' cellspacing='0' cellpadding='0' width='988'>
					<tr>
						<td align='center' colspan='3'>
							
							<?php $themeMenusObj->displayMenu(3); ?>
						</td>
					</tr>
					<tr>
						<td class='contentTopBG'></td>
					</tr>
					<tr>
						<td class='contentMain'>
						
						
						
						
							<table align='center' width='950' cellspacing='0' cellpadding='0' style='margin-top: 10px'>
						<tr>
							<td width='145' valign='top' class='menulinks'>
								
								<?php $themeMenusObj->displayMenu(0); ?>
								
							</td>
							<td width='655' valign='top' class='main'>
							<?php include(BASE_DIRECTORY."include/clocks.php"); ?>

