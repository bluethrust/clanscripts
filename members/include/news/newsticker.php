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



if($_POST['submit']) {
	
	$setBoldText = 0;
	$setItalicText = 0;
	
	if($_POST['boldtext'] == 1) {
		$setBoldText = 1;
	}
	
	if($_POST['italictext'] == 1) {
		$setItalicText = 1;	
	}
	
	$arrColumns = array("newsticker", "newstickercolor", "newstickersize", "newstickerbold", "newstickeritalic");
	$arrValues = array($_POST['newsticker'], $_POST['newstickercolor'], $_POST['fontsize'], $setBoldText, $setItalicText);
	
	if($webInfoObj->update($arrColumns, $arrValues)) {
	
		echo "
		<div style='display: none' id='successBox'>
			<p align='center'>
				Successfully Updated News Ticker!
			</p>
		</div>
		
		<script type='text/javascript'>
			popupDialog('Modify News Ticker', '".$MAIN_ROOT."members/index.php?select=".$consoleInfo['consolecategory_id']."', 'successBox');
		</script>
		
		";
		
		
		
	}
	else {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to database! Please contact the website administrator.<br>";
	}

	
	if($countErrors > 0) {
		
		$_POST = filterArray($_POST);
		$websiteInfo['newsticker'] = $_POST['newsticker'];
		$websiteInfo['newstickercolor'] = $_POST['newstickercolor'];
		$_POST['submit'] = false;

	}

}


if(!$_POST['submit']) {
	
	if($websiteInfo['newstickerbold'] == 1) {
		$checkBold = " checked";	
	}
	
	if($websiteInfo['newstickeritalic'] == 1) {
		$checkItalic = " checked";	
	}
	
	
	echo "
	
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post'>
			<div class='formDiv'>
			";
	
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to save news ticker because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	
	
	echo "
				Use the form below to set what displays in the news ticker on the home page.
				<table class='formTable'>
					<tr>
						<td class='formLabel'>News Ticker: <a href='javascript:void(0)' onmouseover=\"showToolTip('Leave blank to turn off this feature.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='text' class='textBox' value='".$websiteInfo['newsticker']."' style='width: 250px' name='newsticker'></td>
					</tr>
					<tr>
						<td class='main' colspan='2'><br>
							<b>Display Settings:</b>
							<div class='dottedLine' style='margin-top: 3px; margin-bottom: 5px; width: 90%'></div>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Color:</td>
						<td class='main'><input type='text' class='textBox' value='".$websiteInfo['newstickercolor']."' style='width: 100px' name='newstickercolor' id='newsTickerColor'></td>
					</tr>
					<tr>
						<td class='formLabel'>Font Size:</td>
						<td class='main'>
							<select name='fontsize' class='textBox' id='ntFontSize'>
								<option value=''>Default</option>
								<option value='10'>10px</option>
								<option value='12'>12px</option>
								<option value='14'>14px</option>
								<option value='16'>16px</option>
								<option value='18'>18px</option>
								<option value='20'>20px</option>
								<option value='22'>22px</option>
								<option value='24'>24px</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class='formLabel'>Bold Text:</td>
						<td class='main'><input type='checkbox' name='boldtext' value='1'".$checkBold."></td>
					</tr>
					<tr>
						<td class='formLabel'>Italic Text:</td>
						<td class='main'><input type='checkbox' name='italictext' value='1'".$checkItalic."></td>
					</tr>
					<tr>
						<td class='main' colspan='2' align='center'><br>
						
							<input type='submit' name='submit' value='Save' class='submitButton'>
						
						</td>
					</tr>
				
				</table>
			
			</div>
		</form>
		
		
		<script type='text/javascript'>
		
		
			$(document).ready(function() {
				$('#newsTickerColor').miniColors({
					change: function(hex, rgb) { }
				});
				
				
				$('#ntFontSize').val('".$websiteInfo['newstickersize']."');
				
			});
		
		</script>
	";
	
	
}


?>