<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/zombie/zombiemenu.php");
$themeMenusObj = new ZombieMenu($mysqli);

$btThemeObj->setThemeName("Zombified");

$btThemeObj->menusObj = $themeMenusObj;

$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Carrois+Gothic+SC' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->updateHeadItem("jquery-ui-css", "<link rel='stylesheet' type='text/css' href='".$MAIN_ROOT."themes/zombie/jqueryui/jquery-ui-1.9.2.custom.min.css'>");

$zombieEyes = ($themeMenusObj->data['pmAlert'] == 1);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
	<body>

	
		
	
		<div id='skullBG'></div>
		<?php
			if($zombieEyes) {
				echo "<div class='topRightZombieBG_PM'></div>";
			}
			else {
				echo "<div class='topRightZombieBG'></div>";
			}
			
		?>
		
		<div class='bottomLeftZombieBG'></div>
		
		<div class='linePatternBG'></div>
		
		<div class='logoLineBG'></div>
		
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
								<td valign='top' class='menuColumn'>
									<?php $themeMenusObj->displayMenu(0); ?>
								</td>
								<td valign='top'>
								<?php include(BASE_DIRECTORY."include/clocks.php"); ?>						