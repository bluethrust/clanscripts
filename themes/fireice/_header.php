<?php

include($prevFolder."themes/include_header.php");
include($prevFolder."themes/fireice/fireicemenu.php");
$themeMenusObj = new FireIceMenu($mysqli);

$btThemeObj->setThemeName("Fire & Ice");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->addHeadItem("fireicejs", "<script type='text/javascript' src='".MAIN_ROOT."themes/fireice/fireice.js'></script>");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>
	
	<div class='wrapper'>

		<div class='contentBox'>

			<div class='headerDiv'>
			
				<div class='logoContainer'>
					<div class='logoDiv'>
						<img src='<?php echo $MAIN_ROOT; ?>themes/fireice/images/logo.png'>
					</div>
				</div>
			
				<div class='loginContainer'>
					<div class='loginDiv'>
					
						<?php $themeMenusObj->displayMenu(2); ?>
						
					</div>
				</div>
			
			</div>


			<div class='innerContentBox'>
				
				
				<div class='topMenuDiv'>
					<?php $themeMenusObj->displayMenu(3); ?>
				</div>
				
			
				<div class='leftMenuDiv'>
					<?php $themeMenusObj->displayMenu(0); ?>
					
				</div>

				<div class='rightMenuDiv'>
				
					<?php $themeMenusObj->displayMenu(1); ?>
					
					
				
				</div>
	
				<div class='mainSiteContentDiv'>
				<?php include(BASE_DIRECTORY."include/clocks.php"); ?>