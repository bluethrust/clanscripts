<?php

/*
 * Bluethrust Clan Scripts v4
 * Copyright 2012
 *
 * Author: Bluethrust Web Development
 * E-mail: support@bluethrust.com
 * Website: http://www.bluethrust.com
 *
 * License: http://www.bluethrust.com/license.php
 *
 */


if(!isset($member) || substr($_SERVER['PHP_SELF'], -11) != "console.php") {
	exit();
}
else {
	$memberInfo = $member->get_info_filtered();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}


include_once("../classes/game.php");

$cID = $_GET['cID'];

$intEditProfileCID = $consoleObj->findConsoleIDByName("Edit Profile");

$dispError = "";
$countErrors = 0;

$gameObj = new Game($mysqli);
$arrGames = $gameObj->getGameList();
$gameStatsObj = new Basic($mysqli, "gamestats", "gamestats_id");
$memberGameStatObj = new Basic($mysqli, "gamestats_members", "gamestatmember_id");

if($_POST['submit']) {
	
	$mysqli->query("DELETE FROM ".$dbprefix."gamestats_members WHERE member_id = '".$memberInfo['member_id']."'");
	foreach($arrGames as $gameID) {
		
		if($member->playsGame($gameID)) {
		
			$gameObj->select($gameID);
			
			$arrGameStats = $gameObj->getAssociateIDs("ORDER BY ordernum");
			foreach($arrGameStats as $gameStatsID) {
				echo $gameStatsID."<br>";
				$gameStatsObj->select($gameStatsID);
				
				if($gameStatsObj->get_info("stattype") == "input") {
					
					$statType = "statvalue";
					if($gameStatsObj->get_info("textinput") == 1) {
						$statType = "stattext";	
					}
					
					$postVal = "stat_".$gameStatsID;
					
					if($memberGameStatObj->addNew(array("gamestats_id", "member_id", $statType, "dateupdated"), array($gameStatsID, $memberInfo['member_id'], $_POST[$postVal], time()))) {
						
						echo "
						
							<div style='display: none' id='successBox'>
							<p align='center'>
							Successfully Edited Game Stats
							</p>
							</div>
							
							<script type='text/javascript'>
							popupDialog('Edit My Game Stats', '".$MAIN_ROOT."members', 'successBox');
							</script>
					
						";
						
					}
					else {
						$countErrors++;
						$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
					}
					
					
				}

			}
		
			
		}
		
	}
	
	
}


if(!$_POST['submit']) {
	
	$dispGamesPlayed = "
		<tr>
			<td class='main' colspan='2' align='center'>
				<p style='font-size: italic'>
					There are no games added to the website.  Please ask the website administrator to add some!
				</p>
			</td>
		</tr>
	";
	
	$countGamesPlayed = 0;
	if(count($arrGames) > 0) {
		$dispGamesPlayed = "";
		
		foreach($arrGames as $gameID) {
			
			if($member->playsGame($gameID)) {
				$countGamesPlayed++;
				$gameObj->select($gameID);
				$dispGamesPlayed .= "
					<tr>
						<td colspan='2' class='main'><br>
							<b>".$gameObj->get_info_filtered("name")."</b>
							<div class='dottedLine' style='width: 90%; padding-top: 3px'></div>
						</td>
					</tr>
				";
				
				$arrGameStats = $gameObj->getAssociateIDs("ORDER BY ordernum");
				foreach($arrGameStats as $gameStatsID) {
					
					$gameStatsObj->select($gameStatsID);
					
					$gameStatInfo = $gameStatsObj->get_info_filtered();
					if($gameStatInfo['stattype'] == "input") {
						
						$textBoxWidth = "30px";
						$blnText = false;
						if($gameStatInfo['textinput'] == 1) {
							$textBoxWidth = "200px";	
							$blnText = true;
						}
						
						$gameStatValue = $member->getGameStatValue($gameStatsID, $blnText);
						$dispGamesPlayed .= "
							<tr>
								<td class='formLabel' valign='top'>".$gameStatInfo['name'].":</td>
								<td class='main' valign='top'><input type='text' class='textBox' name='stat_".$gameStatsID."' value='".$gameStatValue."' style='width: ".$textBoxWidth."'></td>
							</tr>
						
						";
					
					}
					
				}
				
			}

		}
		
		if($dispGamesPlayed != "") {
			
			$dispGamesPlayed .= "
				<tr>
					<td class='main' colspan='2' align='center'><br>
						<input type='submit' name='submit' value='Save' style='width: 100px' class='submitButton'>
					</td>
				</tr>
			";
			
		}
		
	}
	
	if($countGamesPlayed == 0 && count($arrGames) > 0) {

		$dispGamesPlayed = "
		
		<tr>
			<td class='main' colspan='2' align='center'>
				<div style='width: 40%; margin-left: auto; margin-right: auto' class='shadedBox'>
				<p style='font-size: italic' align='center'>
					You need to set which games you play in your <a href='".$MAIN_ROOT."members/console.php?cID=".$intEditProfileCID."'>profile</a>!
				</p>
				</div>
			</td>
		</tr>
		
		";
		
	}
	
	
	echo "
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post'>
			<div class='formDiv'>
				Use the form below to edit your game stats.
				<table class='formTable'>
					".$dispGamesPlayed."
				</table>
			
			</div>
		</form>
	";
	
}



?>