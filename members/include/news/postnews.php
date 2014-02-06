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


$checkHTMLConsoleObj = new ConsoleOption($mysqli);
$htmlNewsCID = $checkHTMLConsoleObj->findConsoleIDByName("HTML in News Posts");
$checkHTMLConsoleObj->select($htmlNewsCID);
$blnAllowHTML = $member->hasAccess($checkHTMLConsoleObj);

if($_POST['submit']) {
	
	if($blnAllowHTML) {
		$_POST['message'] = str_replace("<?", "", $_POST['message']);
		$_POST['message'] = str_replace("?>", "", $_POST['message']);
		$_POST['message'] = str_replace("<script", "", $_POST['message']);
		$_POST['message'] = str_replace("</script>", "", $_POST['message']);
	}
	
	// Check News Type
	//	1 - Public
	// 	2 - Private
	
	if($_POST['newstype'] != 1 && $_POST['newstype'] != 2) {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You selected an invalid news type.<br>";
	}
	
	
	// Check Subject
	
	if(trim($_POST['subject']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You must enter a news subject.<br>";
	}
	
	// Check Message
	
	if(trim($_POST['message']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not make a blank news post.<br>";
	}
	
	// Check HP Pin
	if($_POST['hpsticky'] != 1) {
		$_POST['hpsticky'] = 0;	
	}
	
	if($countErrors == 0) {
		$time = time();
		$arrColumns = array("member_id", "newstype", "dateposted", "postsubject", "newspost", "hpsticky");
		$arrValues = array($memberInfo['member_id'], $_POST['newstype'], $time, $_POST['subject'], $_POST['message'], $_POST['hpsticky']);
	
		$newsPost = new Basic($mysqli, "news", "news_id");
		if($newsPost->addNew($arrColumns, $arrValues)) {
	
			echo "
			<div style='display: none' id='successBox'>
			<p align='center'>
			Successfully Posted News!
			</p>
			</div>
	
			<script type='text/javascript'>
			popupDialog('Post News', '".$MAIN_ROOT."members', 'successBox');
			</script>
	
			";
	
		}
		else {
			$countErrors++;
			$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to database! Please contact the website administrator.<br>";
		}
	
	
	}
	
	if($countErrors > 0) {
		$_POST = filterArray($_POST);
		$_POST['submit'] = false;
	}
	
	
	
}


if(!$_POST['submit']) {
	
	echo "
	<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."' method='post'>
		<div class='formDiv'>
		";
	
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to post news because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
			Use the form below to post news.<br><br>
				
				<table class='formTable'>
					<tr>
						<td class='formLabel'>News Type:</td>
						<td class='main'><select name='newstype' class='textBox' id='newsType' onchange='updateTypeDesc()'><option value='1'>Public</option><option value='2'>Private</option></select><span class='tinyFont' style='padding-left: 10px' id='typeDesc'></span></td>
					</tr>
					<tr>
						<td class='formLabel'>Pin to Homepage: <a href='javascript:void(0)' onmouseover=\"showToolTip('Pinning a news post to the homepage will show the post under the Announcments section, instead of the Latest News section.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='checkbox' name='hpsticky' value='1'></td>
					</tr>
					<tr>
						<td class='formLabel'>Subject:</td>
						<td class='main'><input type='text' name='subject' value='".$_POST['subject']."' class='textBox' style='width: 250px'></td>
					</tr>
					<tr>
						<td class='formLabel' valign='top'>Message:</td>
						<td class='main'>
							<textarea id='tinymceTextArea' style='width: 80%' rows='15' class='textBox' name='message'>".$_POST['message']."</textarea>
						</td>
					</tr>
					<tr>
						<td class='main' align='center' colspan='2'><br><br>
							<input type='submit' name='submit' value='Post News' class='submitButton' style='width: 125px'>
						</td>
					</tr>
				</table>
				
			</div>
		</form>
		
		<script type='text/javascript'>
		
			";
		
		if($blnAllowHTML) {
	
			echo "
			
				$('document').ready(function() {
					$('#tinymceTextArea').tinymce({
				
						script_url: '".$MAIN_ROOT."js/tiny_mce/tiny_mce.js',
						theme: 'advanced',
						plugins: 'autolink,emotions',
						theme_advanced_buttons1: 'bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,|,bullist,numlist,|,link,unlink,image,emotions,|,quotebbcode,codebbcode,',
						theme_advanced_buttons2: 'forecolorpicker,fontselect,fontsizeselect',
						theme_advanced_resizing: true,
						content_css: '".$MAIN_ROOT."themes/".$THEME."/btcs4.css',
						theme_advanced_statusbar_location: 'none',
						style_formats: [
							{title: 'Quote', inline : 'div', classes: 'forumQuote'}
						
						],
						setup: function(ed) {
							ed.addButton('quotebbcode', {
								
								title: 'Insert Quote',
								image: '".$MAIN_ROOT."js/tiny_mce/quote.png',
								onclick: function() {
									ed.focus();
									innerText = ed.selection.getContent();
									
									ed.selection.setContent('[quote]'+innerText+'[/quote]');
								}
							});
							
							ed.addButton('codebbcode', {
								
								title: 'Insert Code',
								image: '".$MAIN_ROOT."js/tiny_mce/code.png',
								onclick: function() {
									ed.focus();
									innerText = ed.selection.getContent();
									
									ed.selection.setContent('[code]'+innerText+'[/code]');
								}
							
							});
						}
					});
					
				});
			
			";
			
		}
		
		echo "
		
			function updateTypeDesc() {
				$(document).ready(function() {
					$('#typeDesc').hide();
					if($('#newsType').val() == \"1\") {
						$('#typeDesc').html('<i>Share this news for the world to see!</i>');
					}
					else {
						$('#typeDesc').html('<i>Only show this post to members!</i>');
					}
					$('#typeDesc').fadeIn(250);
				
				});
			}
			
			updateTypeDesc();
		</script>
	
	
	
	";
	
}