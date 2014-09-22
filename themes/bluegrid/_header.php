<?php

include($prevFolder."themes/include_header.php");
include($prevFolder."themes/bluegrid/bluegridmenu.php");
$themeMenusObj = new BlueGridMenu($mysqli);

$btThemeObj->setThemeName("Blue Grid");

$btThemeObj->menusObj = $themeMenusObj;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>
	
		<div class='topLeftGrid'></div>
		<div class='topRightGrid'></div>
		<div class='bottomLeftGrid'></div>
		
		<div class='wrapper'>
			<div class='headerDiv'>
			
				<div class='logoDiv'>
					<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'><div class='logoGlow'></div></a>
				</div>
				<div class='topMenuDiv'><div class='topMenuGlow'></div><?php $themeMenusObj->displayMenu(2); ?></div>
			</div>
		
			<div class='bodyDiv'>
				<div class='bodyTopLine'></div>
				<div class='bodyLeftLine'><div class='bodyGradientLine'></div><div class='bodyGradientLineShadow'></div></div>
				<div class='bodyRightLine'><div class='bodyGradientLine'></div><div class='bodyGradientLineShadow'></div></div>
				
				<div class='bodyCorners bodyLeftCornersSide'></div>
				<div class='bodyCorners bodyLeftCornersTop'></div>
				<div class='bodyLeftCornerCover'></div>
				
				<div class='bodyCorners bodyRightCornersSide'></div>
				<div class='bodyCorners bodyRightCornersTop'></div>
				<div class='bodyRightCornerCover'></div>
				
				
				<div class='leftMenuDiv'>
					<?php $themeMenusObj->displayMenu(0); ?>				
				</div>
				<div class='rightMenuDiv'>
					<?php $themeMenusObj->displayMenu(1); ?>
				</div>
				<div class='centerContentDiv'>
				<?php include(BASE_DIRECTORY."include/clocks.php"); ?>