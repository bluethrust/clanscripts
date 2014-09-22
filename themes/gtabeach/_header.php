<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/gtabeach/gtabeachmenu.php");
$themeMenusObj = new GTABeachMenu($mysqli);

$btThemeObj->setThemeName("GTA Beach");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->addHeadItem("gtabeachjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/gtabeach/gtabeach.js'></script>");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>
	<div class='cloudBG'></div>
	<div class='bottom-right-image'></div>
	<div class='bottom-left-image'></div>
	
	<div class='left-character-1' id='leftCharacterBG-1' style='display: none'></div>
	<div class='right-character-1' id='rightCharacterBG-1' style='display: none'></div>
	
	<div class='left-character-2' id='leftCharacterBG-2' style='display: none'></div>
	<div class='right-character-2' id='rightCharacterBG-2' style='display: none'></div>
	
	
	<?php
		if($LOGGED_IN && $arrLoginInfo['pmAlert'] == 1) {
			echo "
				<div id='starsPMAlert'>
					<img src='".$MAIN_ROOT."themes/gtabeach/images/layout/stars.gif'>
				</div>
			";
		}
	?>
	<div id='phoneDiv'>	
		
		<?php $themeMenusObj->displayMenu(2); ?>
		
		<div id='phoneCloseDiv'></div>
	
	</div>
	
	<div class='wrapper'>
		<div class='headerDiv'>
			<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a>	
		</div>
		
		<div class='topMenuDiv'>
			<?php $themeMenusObj->displayMenu(0); ?>		
		</div>
		
		<div class='mainContentDiv'>
			<div class='rightContentDiv'>
				
				<?php $themeMenusObj->displayMenu(1); ?>		
				
				<div style='clear: both'></div>
			</div>
			<div class='leftContentDiv'>
			<?php include(BASE_DIRECTORY."include/clocks.php"); ?>