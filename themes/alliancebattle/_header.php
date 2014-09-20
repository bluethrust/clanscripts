<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/alliancebattle/alliancebattlemenu.php");
$themeMenusObj = new AllianceBattleMenu($mysqli);

$btThemeObj->setThemeName("Alliance Battle");

$btThemeObj->menusObj = $themeMenusObj;

$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Fenix' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>
	<div class='layout-gradient-bottom'></div>
	<div class='layout-pattern-bg'></div>
	<div class='layout-ice-bg'></div>
	<div class='layout-fire-bottom'></div>
	<div class='layout-fire-top'></div>
	<div class='layout-top-light'></div>
	
	<div class='wrapper'>
		<div class='headerDiv'>
			<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a>
		</div>
		
		<div class='topMenuDiv'>
			<?php $themeMenusObj->displayMenu(2); ?>
		</div>
		
		<div class='mainBodyDiv'>
			<div class='mainBody_LeftCorner'></div>
			<div class='mainBody_RightCorner'></div>
			<div class='mainBody_TopBorderWrapper'>
				<div class='mainBody_TopBorder'></div>
			</div>
			<div class='mainBody_LeftBorder'><div class='mainBody_BorderFade'></div></div>
			<div class='mainBody_RightBorder'><div class='mainBody_BorderFade'></div></div>
			
			
			
			<div class='leftMenuDiv'>
				<?php $themeMenusObj->displayMenu(0); ?>
			</div>
			<div class='rightMenuDiv'>
				<?php $themeMenusObj->displayMenu(1); ?>			
			</div>
			<div class='centerContentWrapper'>
			<?php include(BASE_DIRECTORY."include/clocks.php"); ?>