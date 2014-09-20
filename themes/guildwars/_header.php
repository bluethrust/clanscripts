<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/guildwars/guildwarsmenu.php");
$themeMenusObj = new GuildWarsMenu($mysqli);

$btThemeObj->setThemeName("Guild Wars");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".MAIN_ROOT."themes/guildwars/jqueryui/jquery-ui-1.10.3.custom.css'>");
$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Cinzel|Overlock+SC' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->addHeadItem("guildwarsjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/guildwars/guildwars.js'></script>");

$zombieEyes = $themeMenusObj->data['pmAlert'] == 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>

	<?php
		$dispAltBG = "";
		if($zombieEyes) {
			$dispAltBG = "-alt";	
		}
	?>

	<div class='top-left-character'></div>
	<div class='top-right-character<?php echo $dispAltBG; ?>'></div>
	
	<div class='wrapper'>
		<div class='main-character-bg<?php echo $dispAltBG; ?>'></div>
		
		<div class='top-left-grunge'></div>
		<div class='pattern-bg'></div>
		
		<div class='topBar'>
		
			<div class='loginSection'>
				<?php $themeMenusObj->displayMenu(2); ?>
			</div>
		
			
		</div>
		
		<div class='headerDiv'>
			<div class='topMenuLinks'>
				<?php $themeMenusObj->displayMenu(3); ?>
			</div>
			<div class='logoDiv'>
				<a href='<?php echo $MAIN_ROOT; ?>'><img src='<?php echo $websiteInfo['logourl']; ?>'></a>
				<div class='logoLightDiv'></div>
			</div>
		</div>
		
		<div class='mainSiteContentDiv'>
		
		
			<div class='leftMenuDiv'>
				<?php $themeMenusObj->displayMenu(0); ?>
			</div>
			
			<div class='rightMenuDiv'>
			
				<?php $themeMenusObj->displayMenu(1); ?>
			
			</div>
		
			<div class='centerContentDiv'>
			<?php include(BASE_DIRECTORY."include/clocks.php"); ?>