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
	$memberInfo = $member->get_info();
	$consoleObj->select($_GET['cID']);
	if(!$member->hasAccess($consoleObj)) {
		exit();
	}
}


$cID = $_GET['cID'];



$dispError = "";
$countErrors = 0;

$arrSelectPosts = array(10, 25, 50, 75, 100);

if($_POST['submit']) {
	
	// Check Topics Per Page
	if(!in_array($_POST['defaulttopics'], $arrSelectPosts)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid default topics per page.<br>";	
	}
	
	// Check Posts Per Page
	if(!in_array($_POST['defaultposts'], $arrSelectPosts)) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid default posts per page.<br>";
	}
	
	if($_POST['showrank'] == 1) {
		// Check Rank Width
		if(!is_numeric($_POST['rankwidth'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Rank width must be a numeric value. ".$_POST['rankwidth']."<br>";
		}
		
		// Check Rank Height
		if(!is_numeric($_POST['rankheight'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Rank height must be a numeric value.<br>";
		}
	}
	
	if($_POST['showmedals']) {
		// Check Medal Width
		if(!is_numeric($_POST['medalwidth'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Medal width must be a numeric value.<br>";
		}
		
		// Check Medal Height
		if(!is_numeric($_POST['medalheight'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Medal height must be a numeric value.<br>";
		}
		
		// Check Medal Count
		if(!is_numeric($_POST['medalcount'])) {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Medal count must be a numeric value.<br>";
		}
	}
	
	if($countErrors == 0) {
		$setRankWidthUnit = ($_POST['rankwidthunit'] == "px") ? "px" : "#";
		$setRankHeightUnit = ($_POST['rankheightunit'] == "px") ? "px" : "#";
		$setMedalWidthUnit = ($_POST['medalwidthunit'] == "px") ? "px" : "#";
		$setMedalHeightUnit = ($_POST['medalheightunit'] == "px") ? "px" : "#";
		
		$setShowRank = ($_POST['showrank'] == 1) ? 1 : 0;
		$setShowMedals = ($_POST['showmedals'] == 1) ? 1 : 0;
		
		$arrRankColumns = array();
		$arrRankValues = array();
		if($setShowRank == 1) {
			$arrRankColumns = array("forum_rankwidth", "forum_rankheight", "forum_rankwidthunit", "forum_rankheightunit");
			$arrRankValues = array($_POST['rankwidth'], $_POST['rankheight'], $setRankWidthUnit, $setRankHeightUnit);
		}
		
		$arrMedalColumns = array();
		$arrMedalValues = array();
		if($setShowMedals == 1) {
			$arrMedalColumns = array("forum_medalwidth", "forum_medalheight", "forum_medalwidthunit", "forum_medalheightunit", "forum_medalcount");
			$arrMedalValues = array($_POST['medalwidth'], $_POST['medalheight'], $setMedalWidthUnit, $setMedalHeightUnit, $_POST['medalcount']);
		}
		
		$arrColumns = array_merge(array("forum_topicsperpage", "forum_postsperpage", "forum_showrank", "forum_showmedal"), $arrRankColumns, $arrMedalColumns);
		$arrValues = array_merge(array($_POST['defaultopics'], $_POST['defaultposts'], $setShowRank, $setShowMedals), $arrRankValues, $arrMedalValues);
		
		if($webInfoObj->update($arrColumns, $arrValues)) {
			
			echo "
			
				<div style='display: none' id='successBox'>
					<p align='center'>
						Successfully Saved Forum Settings!
					</p>
				</div>
				
				<script type='text/javascript'>
					popupDialog('Forum Settings', '".$MAIN_ROOT."members/index.php?select=".$consoleInfo['consolecategory_id']."', 'successBox');
				</script>
			
			";
			
		}
		else {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
		}
	
	}
	
	if($countErrors > 0) {
		$_POST['submit'] = false;
	}
	
}

if(!$_POST['submit']) {
	
	
	foreach($arrSelectPosts as $value) {
		$selectPosts[$value] = ($websiteInfo['forum_postsperpage'] == $value) ? " selected" : "";
	}
	
	foreach($arrSelectPosts as $value) {
		$selectTopics[$value] = ($websiteInfo['forum_topicsperpage'] == $value) ? " selected" : "";
	}
	
	$checkShowRank = ($websiteInfo['forum_showrank'] == 1) ? " checked" : "";
	$checkShowMedals = ($websiteInfo['forum_showmedal'] == 1) ? " checked" : "";
	
	echo "
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post'>
		<div class='formDiv'>
		
		";
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to save forum settings because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
		Use the form below to modify your forum's settings.<br>
			<table class='formTable'>
				<tr>
					<td class='formLabel dottedLine' colspan='2'>General Settings</td>
				</tr>
				<tr>
					<td class='formLabel'>Default Topics Per Page:</td>
					<td class='main'>
						<select name='defaulttopics' class='textBox'>
							<option value='10'".$selectPosts[10].">10</option>
							<option value='25'".$selectPosts[25].">25</option>
							<option value='50'".$selectPosts[50].">50</option>
							<option value='75'".$selectPosts[75].">75</option>
							<option value='100'".$selectPosts[100].">100</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class='formLabel'>Default Posts Per Page:</td>
					<td class='main'>
						<select name='defaultposts' class='textBox'>
							<option value='10'".$selectPosts[10].">10</option>
							<option value='25'".$selectPosts[25].">25</option>
							<option value='50'".$selectPosts[50].">50</option>
							<option value='75'".$selectPosts[75].">75</option>
							<option value='100'".$selectPosts[100].">100</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class='formLabel dottedLine' colspan='2'><br>Rank Display Settings</td>
				</tr>
				<tr>
					<td class='formLabel'>Show Rank: <a href='javascript:void(0)' onmouseover=\"showToolTip('Check the box to the right to show a member\'s rank below their post count on forum posts.')\" onmouseout='hideToolTip()'>(?)</a></td>
					<td class='main'><input type='checkbox' id='showRank' name='showrank' value='1'".$checkShowRank."></td>
				</tr>
				<tr>
					<td class='formLabel'>Rank Width:</td>
					<td class='main'><input type='text' id='rankWidth' name='rankwidth' style='width: 50px' value='".$websiteInfo['forum_rankwidth']."' class='textBox'> <select name='rankwidthunit' id='rankWidthUnit' class='textBox'><option value='px'>px</option><option value='%'>%</option></select></td>
				</tr>
				<tr>
					<td class='formLabel'>Rank Width:</td>
					<td class='main'><input type='text' id='rankHeight' name='rankheight' style='width: 50px' value='".$websiteInfo['forum_rankheight']."' class='textBox'> <select name='rankheightunit' id='rankHeightUnit' class='textBox'><option value='px'>px</option><option value='%'>%</option></select></td>
				</tr>
				<tr>
					<td class='formLabel dottedLine' colspan='2'><br>Medal Display Settings</td>
				</tr>
				<tr>
					<td class='formLabel'>Show Medals: <a href='javascript:void(0)' onmouseover=\"showToolTip('Check the box to the right to list a member\'s medals below their post count on forum posts.')\" onmouseout='hideToolTip()'>(?)</a></td>
					<td class='main'><input type='checkbox' id='showMedals' name='showmedals' value='1'".$checkShowMedals."></td>
				</tr>
				<tr>
					<td class='formLabel'>Medal Width:</td>
					<td class='main'><input type='text' name='medalwidth' id='medalWidth' style='width: 50px' value='".$websiteInfo['forum_medalwidth']."' class='textBox'> <select name='medalwidthunit' class='textBox' id='medalWidthUnit'><option value='px'>px</option><option value='%'>%</option></select></td>
				</tr>
				<tr>
					<td class='formLabel'>Medal Width:</td>
					<td class='main'><input type='text' name='medalheight' id='medalHeight' style='width: 50px' value='".$websiteInfo['forum_medalheight']."' class='textBox'> <select name='medalheightunit' class='textBox' id='medalHeightUnit'><option value='px'>px</option><option value='%'>%</option></select></td>
				</tr>
				<tr>
					<td class='formLabel'>Medal Count: <a href='javascript:void(0)' onmouseover=\"showToolTip('Use this field to set how many medal\'s to show.  If left blank, 5 medals will show.')\" onmouseout='hideToolTip()'>(?)</a></td>
					<td class='main'><input type='text' name='medalcount' id='medalCount' class='textBox' style='width: 50px' value='".$websiteInfo['forum_medalcount']."'></td>
				</tr>
				<tr>
					<td class='main' align='center' colspan='2'><br><input type='submit' name='submit' value='Save' class='submitButton'></td>
				</tr>
			</table>
		
		</div>
		</form>
		<script type='text/javascript'>
		
			function clickShowRank() {
				if($('#showRank').is(':checked')) {
					$('#rankWidth').removeAttr('disabled');
					$('#rankHeight').removeAttr('disabled');
					$('#rankWidthUnit').removeAttr('disabled');
					$('#rankHeightUnit').removeAttr('disabled');
				}
				else {
					$('#rankWidth').attr('disabled', 'disabled');
					$('#rankHeight').attr('disabled', 'disabled');
					$('#rankWidthUnit').attr('disabled', 'disabled');
					$('#rankHeightUnit').attr('disabled', 'disabled');
				}
			}
			
			
			function clickShowMedals() {
				if($('#showMedals').is(':checked')) {
					$('#medalWidth').removeAttr('disabled');
					$('#medalHeight').removeAttr('disabled');
					$('#medalWidthUnit').removeAttr('disabled');
					$('#medalHeightUnit').removeAttr('disabled');
					$('#medalCount').removeAttr('disabled');
				}
				else {
					$('#medalWidth').attr('disabled', 'disabled');
					$('#medalHeight').attr('disabled', 'disabled');
					$('#medalWidthUnit').attr('disabled', 'disabled');
					$('#medalHeightUnit').attr('disabled', 'disabled');
					$('#medalCount').attr('disabled', 'disabled');
				}
			}
		
		
			$(document).ready(function() {
			
				$('#showRank').click(function() {
				
					clickShowRank();
				
				});
				
				$('#showMedals').click(function() {
				
					clickShowMedals();
				
				});
				
			});
		
			clickShowMedals();
			clickShowRank();
		</script>
	
	";
	
	
}



?>