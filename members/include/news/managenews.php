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

include_once("../classes/news.php");

$cID = $_GET['cID'];

$dispError = "";
$countErrors = 0;

$newsObj = new News($mysqli);


if(isset($_GET['newsID']) && $newsObj->select($_GET['newsID'])) {

	$newsInfo = $newsObj->get_info_filtered();

	
	echo "
	
	<script type='text/javascript'>
	$(document).ready(function() {
	$('#breadCrumb').html(\"<a href='".$MAIN_ROOT."'>Home</a> > <a href='".$MAIN_ROOT."members'>My Account</a> > <a href='".$MAIN_ROOT."members/console.php?cID=".$cID."'>".$consoleTitle."</a> > <b>Edit Post:</b> ".$newsInfo['postsubject']."\");
	});
	</script>
	";
	
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
		//  3 - Shoutbox
	
		if($_POST['newstype'] != 1 && $_POST['newstype'] != 2 && $_POST['newstype'] != 3) {
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
	
		if($_POST['hpsticky'] != 1) {
			$_POST['hpsticky'] = 0;	
		}
	
		if($countErrors == 0) {
			$time = time();
			$arrColumns = array("newstype", "postsubject", "newspost", "lasteditmember_id", "lasteditdate", "hpsticky");
			$arrValues = array($_POST['newstype'], $_POST['subject'], $_POST['message'], $memberInfo['member_id'], $time, $_POST['hpsticky']);
	
			
			if($newsObj->update($arrColumns, $arrValues)) {
	
				echo "
				<div style='display: none' id='successBox'>
				<p align='center'>
				Successfully Edited News Post!
				</p>
				</div>
	
				<script type='text/javascript'>
				popupDialog('Manage News - Edit Post', '".$MAIN_ROOT."members/console.php?cID=".$cID."', 'successBox');
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
	
		
		$selectPrivateNews = "";
		if($newsInfo['newstype'] == 2) {
			$selectPrivateNews = " selected";
		}
		
		$selectHPSticky = "";
		if($newsInfo['hpsticky'] == 1) {
			$selectHPSticky = " checked";	
		}
	
		echo "
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."&newsID=".$newsInfo['news_id']."' method='post'>
			<div class='formDiv'>
		";
		
		
		if($dispError != "") {
			echo "
			<div class='errorDiv'>
			<strong>Unable to edit news because the following errors occurred:</strong><br><br>
			$dispError
			</div>
			";
		}
	
		echo "

			Use the form below to edit the selected news post.<br><br>
				
				<table class='formTable'>
			";
		
			if($newsInfo['newstype'] != 3) {
				
				echo "
					<tr>
						<td class='formLabel'>News Type:</td>
						<td class='main'><select name='newstype' class='textBox' id='newsType' onchange='updateTypeDesc()'><option value='1'>Public</option><option value='2'".$selectPrivateNews.">Private</option></select><span class='tinyFont' style='padding-left: 10px' id='typeDesc'></span></td>
					</tr>
					<tr>
						<td class='formLabel'>Pin to Homepage: <a href='javascript:void(0)' onmouseover=\"showToolTip('Pinning a news post to the homepage will show the post under the Announcments section, instead of the Latest News section.')\" onmouseout='hideToolTip()'>(?)</a></td>
						<td class='main'><input type='checkbox' name='hpsticky' value='1'".$selectHPSticky."></td>
					</tr>
					<tr>
						<td class='formLabel'>Subject:</td>
						<td class='main'><input type='text' name='subject' value='".$newsInfo['postsubject']."' class='textBox' style='width: 250px'></td>
					</tr>
				";
				
			}
			else {
				echo "<input type='hidden' name='newstype' value='3'><input type='hidden' name='subject' value='Shoutbox Post'>";	
			}
			
			echo "
					<tr>
						<td class='formLabel' valign='top'>Message:</td>
						<td class='main'>
							<textarea  style='width: 80%' rows='15' id='tinymceTextArea' class='textBox' name='message'>".$newsInfo['newspost']."</textarea>
						</td>
					</tr>
					<tr>
						<td class='main' align='center' colspan='2'><br><br>
							<input type='submit' name='submit' value='Edit Post' class='submitButton' style='width: 125px'>
						</td>
					</tr>
				</table>
				
			</div>
		</form>
		
		<script type='text/javascript'>
		
		";
		
		$checkHTMLConsoleObj = new ConsoleOption($mysqli);
		$htmlNewsCID = $checkHTMLConsoleObj->findConsoleIDByName("HTML in News Posts");
		$checkHTMLConsoleObj->select($htmlNewsCID);
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
	
	
}
else {
	
	
	$postNewsCID = $consoleObj->findConsoleIDByName("Post News");
	
	echo "
	
		<p align='right' class='main' style='padding-right: 20px'>
			&raquo; <a href='".$MAIN_ROOT."members/console.php?cID=".$postNewsCID."'>Post News</a> &laquo;
		</p>
	
		<div id='loadingSpiral' class='loadingSpiral'>
			<p align='center'>
				<img src='".$MAIN_ROOT."themes/".$THEME."/images/loading-spiral.gif'><br>Loading
			</p>
		</div>
		<div id='deleteMessage' style='display: none'></div>
		<div id='displayNewsDiv'>
	
	
	
		</div>
		
		
		<script type='text/javascript'>
		
			$(document).ready(function() {
		
			
				$('#displayNewsDiv').hide();
				$('#loadingSpiral').show();
			
				$.post('".$MAIN_ROOT."members/include/news/include/newslist.php', { }, function(data) {
				
				
					$('#displayNewsDiv').html(data);
					$('#loadingSpiral').hide();
					$('#displayNewsDiv').fadeIn(250);
				
				
				});

			});
			
			
			
			
			function deleteNews(newsID) {
			
				$(document).ready(function() {
				
					$.post('".$MAIN_ROOT."members/include/news/include/delete.php', { nID: newsID }, function(data) {
					
					
						$('#deleteMessage').dialog({
					
							title: 'Manage News - Delete Post',
							width: 400,
							modal: true,
							zIndex: 9999,
							resizable: false,
							show: 'scale',
							buttons: {
								'Yes': function() {
									
									$('#loadingSpiral').show();
									$('#displayNewsDiv').hide();
									$(this).dialog('close');
									$.post('".$MAIN_ROOT."members/include/news/include/delete.php', { nID: newsID, confirm: 1 }, function(data1) {
										$('#displayNewsDiv').html(data1);
										$('#loadingSpiral').hide();
										$('#displayNewsDiv').fadeIn(400);	
									});
								
								},
								'Cancel': function() {
								
									$(this).dialog('close');
								
								}
							}
						});
					
					
					
					
						
						$('#deleteMessage').html(data);
						
					
					
					
					});
				
				});
			
			}
		
		</script>
		
	";
	
	
	
}




?>