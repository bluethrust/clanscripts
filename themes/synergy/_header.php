<?php
include($prevFolder."themes/include_header.php");
include($prevFolder."themes/synergy/synergymenu.php");
$themeMenusObj = new SynergyMenu($mysqli);

$btThemeObj->setThemeName("Synergy");

$btThemeObj->menusObj = $themeMenusObj;
$btThemeObj->addHeadItem("googlefont", "<link href='https://fonts.googleapis.com/css?family=Aldrich' rel='stylesheet' type='text/css'>");
$btThemeObj->moveHeadItem("googlefont", 1);
$btThemeObj->addHeadItem("synergyjs", "<script type='text/javascript' src='".MAIN_ROOT."themes/synergy/synergy.js'></script>");
?>
<!DOCTYPE html>
<html>
	<head>
		<?php $btThemeObj->displayHead(); ?>
	</head>
<body>

<div id='userpanel'>		
<a href='<?php echo $MAIN_ROOT; ?>'><div id='logo'></div></a>
<?php $themeMenusObj->displayMenu(2); ?>
</div>

<div id='links'>		
<a href="<?php echo $MAIN_ROOT; ?>"><div id='title'></div></a>
<div id='gap2'></div>
<ul id="nav">
<li><a href="<?php echo $MAIN_ROOT; ?>news">News</a></li>
<li><a href="<?php echo $MAIN_ROOT; ?>members.php">Members</a></li>
<li><a href="<?php echo $websiteInfo['forumurl']; ?>">Forum</a></li>
<li><a href="<?php echo $MAIN_ROOT; ?>events">Events</a></li>
<li><a href="<?php echo $MAIN_ROOT; ?>squads">Squads</a></li>
<li><a href="<?php echo $MAIN_ROOT; ?>signup.php">Apply</a></li></ul>
<div id='cap'></div>
</div>

<div id='datetime'>
<div id='dtleft'></div>
<div id='dtcenter'>
<?php 

	function synergyWorldClocks() {
		global $clockObj, $websiteInfo;
		
		echo "
		<span id='thedate'>".date($websiteInfo['date_format'])."</span>
		<span id='thetime'>
		 &rarr;
		";
		
		$clockObj->displayClocks();
		
		echo "
			</span>
		
		";
		
	}
	$hooksObj->removeHook("worldclock-display", "displayDefaultWorldClock");
	$hooksObj->addHook("worldclock-display", "synergyWorldClocks");
	include(BASE_DIRECTORY."include/clocks.php"); 

?>		
</div>
<div id='dtright'></div>
</div>

<div id='sepline'></div>

<div id="colmask">
<div id="colmid">
<div id="colright">
<div id="col1wrap">
<div id="col1pad">
<div id="col1">