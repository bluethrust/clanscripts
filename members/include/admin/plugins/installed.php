<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2014
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */

if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {


	include_once("../../../../_setup.php");
	include_once("../../../../classes/member.php");
	include_once("../../../../classes/rank.php");
	include_once("../../../../classes/btplugin.php");
	
	$consoleObj = new ConsoleOption($mysqli);
	
	$cID = $consoleObj->findConsoleIDByName("Plugin Manager");
	$consoleObj->select($cID);
	
	$member = new Member($mysqli);
	$member->select($_SESSION['btUsername']);
	
	if(!$member->authorizeLogin($_SESSION['btPassword']) || !$member->hasAccess($consoleObj)) {
		exit();
	}
	
	$pluginObj = new btPlugin($mysqli);
	
}

echo "<table class='formTable' style='margin-top: 0px; border-spacing: 0px'>";

	$result = $mysqli->query("SELECT * FROM ".$dbprefix."plugins ORDER BY name");
	
	if($result->num_rows == 0) {
		
		echo "
			<tr>
				<td colspan='2'>
					<div class='shadedBox' style='width: 50%; margin: 20px auto'>
						<p class='main' align='center'>
							There are no plugins installed.
						</p>
					</div>
				</td>
			</tr>
		";
		
	}

	$x = 0;
	while($row = $result->fetch_assoc()) {
		
		if($x == 0) {
			$x = 1;
			$addCSS = "";	
		}
		else {
			$x = 0;
			$addCSS = " alternateBGColor";	
		}
		
		$arrInstalledPlugins[] = $row['filepath'];
		echo "
			<tr>
				<td class='dottedLine main manageList".$addCSS."'>".$row['name']."</td>
				<td align='center' class='dottedLine main manageList".$addCSS."' style='width: 12%'><a href='".$MAIN_ROOT."plugins/".$row['filepath']."/settings.php'><img src='".$MAIN_ROOT."themes/".$THEME."/images/buttons/edit.png' class='manageListActionButton' title='Settings'></a></td>
				<td align='center' class='dottedLine main manageList".$addCSS."' style='width: 12%'><a id='uninstallPlugin' style='cursor: pointer' data-plugin='".$row['filepath']."' data-clicked='0'><img src='".$MAIN_ROOT."themes/".$THEME."/images/buttons/delete.png' class='manageListActionButton' title='Uninstall'></a></td>
			</tr>		
		";
		
	}

	echo "</table>
	
	<script type='text/javascript'>
	
		$(document).ready(function() {
		
			$(\"a[id='uninstallPlugin']\").click(function() {
				
				if($(this).attr('data-clicked') == 0) {
					$(this).html(\"<img src='".$MAIN_ROOT."themes/".$THEME."/images/loading-spiral.gif' class='manageListActionButton'>\");
					$(this).attr('data-clicked', 1);
					$(this).css('cursor', 'default');
					
					$.post('".$MAIN_ROOT."plugins/'+$(this).attr('data-plugin')+'/uninstall.php', { pluginDir: $(this).attr('data-plugin') }, function(data) {
					
					
					});
				
				}
			
			});
		
		});
	
	</script>
	";
?>