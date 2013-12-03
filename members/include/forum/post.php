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



include_once("../classes/forumboard.php");

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
$forumAttachmentsCID = $consoleObj->findConsoleIDByName("Post Forum Attachments");

$consoleObj->select($forumAttachmentsCID);

$blnCheckForumAttachments = $member->hasAccess($consoleObj);
$consoleObj->select($cID);

if($blnCheckForumAttachments) {
	include_once($prevFolder."classes/download.php");
	include_once($prevFolder."classes/downloadcategory.php");
	$attachmentObj = new Download($mysqli);
	$downloadCatObj = new DownloadCategory($mysqli);
	$downloadCatObj->selectBySpecialKey("forumattachments");
	$forumAttachmentCatID = $downloadCatObj->get_info("downloadcategory_id");
}

$boardObj = new ForumBoard($mysqli);

$categoryObj = new BasicOrder($mysqli, "forum_category", "forumcategory_id");
$categoryObj->set_assocTableName("forum_board");
$categoryObj->set_assocTableKey("forumboard_id");


if(!$boardObj->select($_GET['bID']) || ($boardObj->select($_GET['bID']) && !$boardObj->memberHasAccess($memberInfo))) {
	echo "<script type='text/javascript'>window.location = '".$MAIN_ROOT."members'</script>";
	exit();
}


$boardInfo = $boardObj->get_info_filtered();
$blnPostReply = false;
$addToForm = "";
if(isset($_GET['tID']) && $boardObj->objTopic->select($_GET['tID'])) {
	$blnPostReply = true;
	$topicInfo = $boardObj->objTopic->get_info();
	
	// Check if topic is actually in the selected board
	if($topicInfo['forumboard_id'] != $boardInfo['forumboard_id']) {
		echo "<script type='text/javascript'>window.location = '".$MAIN_ROOT."members'</script>";
		exit();
	}
	elseif($topicInfo['lockstatus'] == 1) {

		echo "
			<div id='lockedMessage' style='display: none'>
				<p class='main' align='center'>
					This topic is locked!
				</p>
			</div>
			<script type='text/javascript'>
				$(document).ready(function() {
					$('#lockedMessage').dialog({
						title: 'Post Reply - Locked!',
						show: 'scale',
						modal: true,
						width: 400,
						zIndex: 999999,
						resizable: false,
						buttons: {
							'OK': function() {
								$(this).dialog('close');
							}
						},
						close: function(event, ui) {
							window.location = '".$MAIN_ROOT."forum/viewtopic.php?tID=".$topicInfo['forumtopic_id']."'						
						}
					
					});

				});
			</script>
		";
		
		exit();
		
	}
	
	
	$boardObj->objPost->select($topicInfo['forumpost_id']);
	$postInfo = $boardObj->objPost->get_info_filtered();
	$dispTopicName = "<tr><td colspan='2' class='largeFont'><b>".$postInfo['title']."</b><input type='hidden' id='postSubject' value='".$postInfo['title']."'><br><br></td></tr>";
	$addToForm = "&tID=".$_GET['tID'];
	echo "
	<script type='text/javascript'>
		$(document).ready(function() {
			$('#breadCrumbTitle').html(\"Post Reply\");
			$('#breadCrumb').html(\"<a href='".$MAIN_ROOT."'>Home</a> > <a href='".$MAIN_ROOT."forum'>Forum</a> > <a href='".$MAIN_ROOT."forum/viewboard.php?bID=".$_GET['bID']."'>".$boardInfo['name']."</a> > Post Reply\");
			$('#consoleTopBackButton').attr('href', '".$MAIN_ROOT."forum/viewtopic.php?bID=".$_GET['bID']."&tID=".$_GET['tID']."');
			$('#consoleBottomBackButton').attr('href', '".$MAIN_ROOT."forum/viewtopic.php?bID=".$_GET['bID']."&tID=".$_GET['tID']."');
			$('title').html(\"Post Reply - ".filterText($websiteInfo['clanname'])."\");
		});
	</script>
	";
	$postActionWord = "reply";
	
}
else {
	
	echo "
	<script type='text/javascript'>
		$(document).ready(function() {
			$('#breadCrumb').html(\"<a href='".$MAIN_ROOT."'>Home</a> > <a href='".$MAIN_ROOT."forum'>Forum</a> > <a href='".$MAIN_ROOT."forum/viewboard.php?bID=".$_GET['bID']."'>".$boardInfo['name']."</a> > Post Topic\");
			$('#consoleTopBackButton').attr('href', '".$MAIN_ROOT."forum/viewboard.php?bID=".$_GET['bID']."');
			$('#consoleBottomBackButton').attr('href', '".$MAIN_ROOT."forum/viewboard.php?bID=".$_GET['bID']."');
		});
	</script>
	";
	
	$dispTopicName = "
	<tr>
		<td class='formLabel'>Topic:</td>
		<td class='main'><input type='text' name='topicname' id='postSubject' class='textBox' value='".$_POST['topicname']."' style='width: 250px'></td>
	</tr>
	";
	
	$postActionWord = "topic";
}

$dispQuote = "";
if(isset($_GET['quote']) && $boardObj->objPost->select($_GET['quote'])) {
	$quotedInfo = $boardObj->objPost->get_info_filtered();
	$quotedMember = new Member($mysqli);
	$quotedMember->select($quotedInfo['member_id']);

	$dispQuote = "
	[quote]<a href='".$MAIN_ROOT."forum/viewtopic.php?tID=".$quotedInfo['forumtopic_id']."#".$quotedInfo['forumpost_id']."'>Originally posted by ".$quotedMember->get_info_filtered("username").":</a><br>".$boardObj->objPost->get_info("message")."<br>[/quote]";
}


$dispError = "";
$countErrors = 0;

if($_POST['submit']) {

	$_POST['wysiwygHTML'] = str_replace("<?", "&lt;?", $_POST['wysiwygHTML']);
	$_POST['wysiwygHTML'] = str_replace("?>", "?&gt;", $_POST['wysiwygHTML']);
	$_POST['wysiwygHTML'] = str_replace("<script", "&lt;script", $_POST['wysiwygHTML']);
	$_POST['wysiwygHTML'] = str_replace("</script>", "&lt;/script&gt;", $_POST['wysiwygHTML']);


	
	
	if(!$blnPostReply && trim($_POST['topicname']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not enter a blank topic title.<br>";	
	}
	

	if(trim($_POST['wysiwygHTML']) == "") {
		$countErrors++;
		$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> You may not make a blank post.<br>";
	}
	
	
	if($blnCheckForumAttachments) {
		$arrDownloadID = array();
		$arrDLColumns = array("downloadcategory_id", "member_id", "dateuploaded", "filename", "mimetype", "filesize", "splitfile1", "splitfile2");
		for($i=1;$i<=$_POST['numofattachments'];$i++) {
				
			$tempPostName = "forumattachment_".$i;
			if($_FILES[$tempPostName]['name'] != "" && $attachmentObj->uploadFile($_FILES[$tempPostName], $prevFolder."downloads/files/forumattachment/", $forumAttachmentCatID)) {
				
				$splitFiles = $attachmentObj->getSplitNames();
				$fileSize = $attachmentObj->getFileSize();
				$mimeType = $attachmentObj->getMIMEType();
				
				$arrDLValues = array($forumAttachmentCatID, $memberInfo['member_id'], time(), $_FILES[$tempPostName]['name'], $mimeType, $fileSize, "downloads/files/forumattachment/".$splitFiles[0], "downloads/files/forumattachment/".$splitFiles[1]);
				
				if($attachmentObj->addNew($arrDLColumns, $arrDLValues)) {
					$arrDownloadID[] = $attachmentObj->get_info("download_id");
				}	
			}
			elseif($_FILES[$tempPostName]['name'] != "") {
				$countErrors++;
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to upload attachment #".$i.": ".$_FILES[$tempPostName]['name'].".<br>";
			}
			
		}
	}
	
	
	if($countErrors == 0) {
		
		if(!$blnPostReply) {
			// New Topic
			$arrTopicColumns = array("forumboard_id");
			$arrTopicValues = array($_GET['bID']);

			if($boardObj->objTopic->addNew($arrTopicColumns, $arrTopicValues)) {

				$_GET['tID'] = $boardObj->objTopic->get_info("forumtopic_id");
				
			}
			else {
				$countErrors++;
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to create new topic.<br>";
			}
		}
			
		if($countErrors == 0) {
		
			$arrPostColumns = array("member_id", "dateposted", "title", "message", "forumtopic_id");
			$arrPostValues = array($memberInfo['member_id'], time(), $_POST['topicname'], $_POST['wysiwygHTML'], $_GET['tID']);
			
			if($boardObj->objPost->addNew($arrPostColumns, $arrPostValues)) {
				// New Post Sucessfull --> Update Topic Info
				$newPostID = $boardObj->objPost->get_info("forumpost_id");
				$arrTopicColumns = array("lastpost_id");
				$arrTopicValues = array($newPostID);
				if(!$blnPostReply) {
					// New Topic --> Need to set initial post id
					$arrTopicColumns[] ="forumpost_id";
					$arrTopicValues[] = $newPostID;
				}
				else {
					// Reply --> Need to increase reply count
					$newReplyCount = $topicInfo['replies']+1;
					$arrTopicColumns[] = "replies";
					$arrTopicValues[] = $newReplyCount;					
				}

				if($boardObj->objTopic->update($arrTopicColumns, $arrTopicValues)) {
					
					echo "
					
						<script type='text/javascript'>
							window.location = '".$MAIN_ROOT."forum/viewtopic.php?tID=".$_GET['tID']."';
						</script>
						
					";
					
					
					if($blnCheckForumAttachments) {
						$forumAttachmentObj = new Basic($mysqli, "forum_attachments", "forumattachment_id");
						foreach($arrDownloadID as $downloadID) {
							$forumAttachmentObj->addNew(array("download_id", "forumpost_id"), array($downloadID, $newPostID));
						}
					}
					
				}
				else {
					// Unable to update topic
					$countErrors++;
					$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
					
				}

			}
			else {
				// Unable to make post
				$countErrors++;
				$dispError .= "&nbsp;&nbsp;&nbsp;<b>&middot;</b> Unable to save information to the database.  Please contact the website administrator.<br>";
			}
			
			
			
		}

		
	}
	
	
	if($countErrors > 0) {

		$_POST['submit'] = false;
		$_POST['wysiwygHTML'] = addslashes($_POST['wysiwygHTML']);
		$_POST['topicname'] = filterText($_POST['topicname']);
		
	}
	
}

if(!$_POST['submit']) {
	
	echo "
	
		<form action='".$MAIN_ROOT."members/console.php?cID=".$cID."&bID=".$_GET['bID'].$addToForm."' enctype='multipart/form-data' method='post'>
			<div class='formDiv'>
			";
	
	if($dispError != "") {
		echo "
		<div class='errorDiv'>
		<strong>Unable to post ".$postActionWord." because the following errors occurred:</strong><br><br>
		$dispError
		</div>
		";
	}
	
	echo "
				<table class='formTable'>
					".$dispTopicName."
					<tr>
						<td class='formLabel' valign='top'>Message:</td>
						<td class='main' valign='top'>
							<textarea id='tinymceTextArea' name='wysiwygHTML' style='width: 80%' rows='15'>".$dispQuote.$_POST['wysiwygHTML']."</textarea>
						</td>
					</tr>
					";
	
	if($blnCheckForumAttachments) {
		
		echo "
		
			<tr>
				<td class='formLabel' valign='top' >Attachments:</td>
				<td class='main'>
					<div id='attachmentsDiv' style='margin-bottom: 10px'>
						<input type='file' name='forumattachment_1' class='textBox' style='border: 0px'>
					</div>
					<a href='javascript:void(0)' id='addMoreAttachments'>Add More Attachments</a>
					<input type='hidden' id='numOfAttachments' value='1' name='numofattachments'>
				</td>
			</tr>
		
		";

	}
	
	echo "
					<tr>
						<td colspan='2' align='center' class='main'><br>
							<input type='submit' name='submit' value='Post' class='submitButton' style='width: 100px'><br><br>
							<input type='button' id='btnPreview' value='Preview Post' class='submitButton' style='width: 100px'>
						</td>
					</tr>
				</table>
			</div>
			<div id='loadingSpiral' class='loadingSpiral'>
				<p align='center'>
					<img src='".$MAIN_ROOT."themes/".$THEME."/images/loading-spiral.gif'><br>Loading
				</p>
			</div>
			<div id='previewPost'></div>
		</form>
	
		
		<script type='text/javascript'>

			var numOfAttachments = 1;
		
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
			
				$('#addMoreAttachments').click(function() {
					numOfAttachments++;
					
					if(numOfAttachments <= ".ini_get("max_file_uploads").") {

						$('#attachmentsDiv').append(\"<br><input type='file' name='forumattachment_\"+numOfAttachments+\"' class='textBox' style='border: 0px'>\");
						$('#numOfAttachments').val(numOfAttachments);
					
					}
					else {
						$('#addMoreAttachments').html('Maximum number of attachments reached!');		
					}
					
					$('#testattachments').html($('#attachmentsDiv').html());
					
				});
				
				$('#btnPreview').click(function() {
				
					$('#loadingSpiral').show();
					$.post('".$MAIN_ROOT."members/include/forum/include/previewpost.php', { wysiwygHTML: $('#tinymceTextArea').val(), previewSubject: $('#postSubject').val() }, function(data) {
						$('#previewPost').hide();
						$('#previewPost').html(data);
						$('#loadingSpiral').hide();
						$('#previewPost').fadeIn(250);
					
						$('html, body').animate({
							scrollTop:$('#previewPost').offset().top
						}, 1000);
						
					});
				
				});
				

			});
			
		</script>
		
		
	";
	
}


?>