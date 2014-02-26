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


// Config File
$prevFolder = "../";

include($prevFolder."_setup.php");

include_once($prevFolder."classes/member.php");
include_once($prevFolder."classes/forumboard.php");
include_once($prevFolder."classes/downloadcategory.php");
include_once($prevFolder."classes/download.php");

$consoleObj = new ConsoleOption($mysqli);
$boardObj = new ForumBoard($mysqli);
$member = new Member($mysqli);

$postMemberObj = new Member($mysqli);
$posterRankObj = new Rank($mysqli);

$intPostTopicCID = $consoleObj->findConsoleIDByName("Post Topic");
$intManagePostsCID = $consoleObj->findConsoleIDByName("Manage Forum Posts");

$categoryObj = new BasicOrder($mysqli, "forum_category", "forumcategory_id");
$categoryObj->set_assocTableName("forum_board");
$categoryObj->set_assocTableKey("forumboard_id");

$downloadCatObj = new DownloadCategory($mysqli);
$attachmentObj = new Download($mysqli);

$downloadCatObj->selectBySpecialKey("forumattachments");



$ipbanObj = new Basic($mysqli, "ipban", "ipaddress");

if($ipbanObj->select($IP_ADDRESS, false)) {
	$ipbanInfo = $ipbanObj->get_info();

	if(time() < $ipbanInfo['exptime'] OR $ipbanInfo['exptime'] == 0) {
		die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."banned.php';</script>");
	}
	else {
		$ipbanObj->delete();
	}

}


if(!$boardObj->objTopic->select($_GET['tID'])) {
	echo "
	<script type='text/javascript'>window.location = 'index.php';</script>
	";
	exit();
}

$topicInfo = $boardObj->objTopic->get_info();
$boardObj->select($topicInfo['forumboard_id']);
$boardObj->objPost->select($topicInfo['forumpost_id']);
$boardInfo = $boardObj->get_info_filtered();

$postInfo = $boardObj->objPost->get_info_filtered();

$boardObj->objPost->select($topicInfo['lastpost_id']);
$lastPostInfo = $boardObj->objPost->get_info_filtered();

$EXTERNAL_JAVASCRIPT .= "<script type='text/javascript' src='".$MAIN_ROOT."js/ace/src-min-noconflict/ace.js' charset='utf-8'></script>";


// Image and Signuature Size Settings
$setMaxImageWidthUnit = ($websiteInfo['forum_imagewidthunit'] == "%") ? "%" : "px";
$setMaxImageWidth = ($websiteInfo['forum_imagewidth'] > 0) ? "max-width: ".$websiteInfo['forum_imagewidth'].$setMaxImageWidthUnit : "";

$setMaxImageHeightUnit = ($websiteInfo['forum_imageheightunit'] == "%") ? "%" : "px";
$setMaxImageHeight = ($websiteInfo['forum_imageheight'] > 0) ? "max-height: ".$websiteInfo['forum_imageheight'].$setMaxImageHeightUnit : "";

$setMaxSigWidthUnit = ($websiteInfo['forum_sigwidthunit'] == "%") ? "%" : "px";
$setMaxSigWidth = ($websiteInfo['forum_sigwidth'] > 0) ? "max-width: ".$websiteInfo['forum_sigwidth'].$setMaxSigWidthUnit : "";

$setMaxSigHeightUnit = ($websiteInfo['forum_sigheightunit'] == "%") ? "%" : "px";
$setMaxSigHeight = ($websiteInfo['forum_sigheight'] > 0) ? "max-height: ".$websiteInfo['forum_sigheight'].$setMaxSigHeightUnit : "";

$editForumCSS = "";

if($setMaxImageWidth != "" || $setMaxImageHeight != "") {
	$editForumCSS .= "
		.boardPostInfo img {
			".$setMaxImageWidth.";
			".$setMaxImageHeight.";
		}	
	";
}

if($setMaxSigWidth != "" || $setMaxSigHeight != "") {
	$editForumCSS .= "
		.forumSignatureContainer img {
			".$setMaxSigWidth.";
			".$setMaxSigHeight.";
		}	
	";
}


if($editForumCSS != "") {
	$EXTERNAL_JAVASCRIPT .= "	
		<style>
			".$editForumCSS."		
		</style>
	";
}



// Start Page
$PAGE_NAME = $postInfo['title']." - ".$boardInfo['name']." - ";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");

// Check Private Forum

if($websiteInfo['privateforum'] == 1 && !constant("LOGGED_IN")) {
	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."login.php';</script>");
}


$blnShowAttachments = false;
if((constant('LOGGED_IN') == true && $downloadCatObj->get_info("accesstype") == 1) || $downloadCatObj->get_info("accesstype") == 0) {
	$blnShowAttachments = true;
}

$memberInfo = array();


$LOGGED_IN = false;
$NUM_PER_PAGE = 25;
if($member->select($_SESSION['btUsername']) && $member->authorizeLogin($_SESSION['btPassword'])) {
	$memberInfo = $member->get_info_filtered();
	$LOGGED_IN = true;
	$NUM_PER_PAGE = $memberInfo['postsperpage'];
	
	if(!$member->hasSeenTopic($topicInfo['forumtopic_id']) && ($lastPostInfo['dateposted']+(60*60*24*7)) > time()) {
		$mysqli->query("INSERT INTO ".$dbprefix."forum_topicseen (member_id, forumtopic_id) VALUES ('".$memberInfo['member_id']."', '".$topicInfo['forumtopic_id']."')");
	}

}

if($NUM_PER_PAGE == 0) {
	$NUM_PER_PAGE = 25;
}


if(!$boardObj->memberHasAccess($memberInfo)) {
	echo "
	<script type='text/javascript'>window.location = 'index.php';</script>
	";
	exit();
}

$arrUpdateViewsColumn = array("views");
$newViewCount = $topicInfo['views']+1;
$arrUpdateViewsValue = array($newViewCount);
$boardObj->objTopic->update($arrUpdateViewsColumn, $arrUpdateViewsValue);

$totalPostsSQL = $mysqli->query("SELECT forumpost_id FROM ".$dbprefix."forum_post WHERE forumtopic_id = '".$topicInfo['forumtopic_id']."' ORDER BY dateposted");

$totalPosts = $totalPostsSQL->num_rows;


if(!isset($_GET['pID']) || !is_numeric($_GET['pID'])) {
	$intOffset = 0;
	$_GET['pID'] = 1;
}
else {
	$intOffset = $NUM_PER_PAGE*($_GET['pID']-1);
}

$blnPageSelect = false;

// Count Pages
$NUM_OF_PAGES = ceil($totalPosts/$NUM_PER_PAGE);

if($NUM_OF_PAGES == 0) {
	$NUM_OF_PAGES = 1;	
}

if($_GET['pID'] > $NUM_OF_PAGES) {

	echo "
	<script type='text/javascript'>window.location = 'viewtopic.php?tID=".$_GET['tID']."';</script>
	";
	exit();

}

// Check for Next button
$dispNextPage = "";
if($_GET['pID'] < $NUM_OF_PAGES) {
	$dispNextPage = "<b><a href='viewtopic.php?tID=".$_GET['tID']."&pID=".($_GET['pID']+1)."'>Next</a> &raquo;</b>";
	$blnPageSelect = true;
}

// Check for Previous button
$dispPreviousPage = "";
if(($_GET['pID']-1) > 0) {
	$dispPreviousPage = "<span style='padding-right: 10px'><b>&laquo; <a href='viewtopic.php?tID=".$_GET['tID']."&pID=".($_GET['pID']-1)."'>Previous</a></b></span>";
	$blnPageSelect = true;
}


for($i=1; $i<=$NUM_OF_PAGES; $i++) {
	$selectPage = "";
	if($i == $_GET['pID']) {
		$selectPage = " selected";
	}
	$pageoptions .= "<option value='".$i."'".$selectPage.">".$i."</option>";
}

$dispPageSelectTop = "";
$dispPageSelectBottom = "";
if($blnPageSelect) {
	$dispPageSelectTop = "
	<p style='margin: 0px'><b>Page:</b> <select id='pageSelectTop' class='textBox'>".$pageoptions."</select> <input type='button' id='btnPageSelectTop' class='submitButton' value='GO' style='width: 40px'></p>
	<p style='margin: 0px; margin-top: 3px'>".$dispPreviousPage.$dispNextPage."</p>

	";

	$dispPageSelectBottom = "<div style='float: left'>
	<p style='margin: 0px'><b>Page:</b> <select id='pageSelectBottom' class='textBox'>".$pageoptions."</select> <input type='button' id='btnPageSelectBottom' class='submitButton' value='GO' style='width: 40px'></p>
	<p style='margin: 0px; margin-top: 3px; text-align: left'>".$dispPreviousPage.$dispNextPage."</p>
	</div>
	";
}

echo "
<div class='breadCrumbTitle'>".$postInfo['title']."</div>
<div class='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
<a href='".$MAIN_ROOT."'>Home</a> > <a href='index.php'>Forum</a> > <a href='viewboard.php?bID=".$boardInfo['forumboard_id']."'>".$boardInfo['name']."</a> > ".$postInfo['title']."
</div>

";

$blnManagePosts = false;
$dispManagePosts = "";
if($LOGGED_IN) {
	if($topicInfo['lockstatus'] == 0) {
		$dispPostReply = "<b>&raquo; <a href='".$MAIN_ROOT."members/console.php?cID=".$intPostTopicCID."&bID=".$topicInfo['forumboard_id']."&tID=".$topicInfo['forumtopic_id']."'>POST REPLY</a> &laquo;</b>";
	}
	else {
		$dispPostReply = "<b>&raquo; LOCKED &laquo;</b>";	
	}
	
	$consoleObj->select($intManagePostsCID);
	if($boardObj->memberIsMod($memberInfo['member_id']) || $member->hasAccess($consoleObj)) {
		$blnManagePosts = true;
		
		if($topicInfo['stickystatus'] == 0) {
			$dispManagePosts .= "<b>&raquo <a href='".$MAIN_ROOT."members/console.php?cID=".$intManagePostsCID."&tID=".$topicInfo['forumtopic_id']."&action=sticky'>STICKY TOPIC</a> &laquo;</b>&nbsp;&nbsp;&nbsp;";
		}
		else {
			$dispManagePosts .= "<b>&raquo <a href='".$MAIN_ROOT."members/console.php?cID=".$intManagePostsCID."&tID=".$topicInfo['forumtopic_id']."&action=sticky'>UNSTICKY TOPIC</a> &laquo;</b>&nbsp;&nbsp;&nbsp;";
		}
		
		
		if($topicInfo['lockstatus'] == 0) {
			$dispManagePosts .= "<b>&raquo <a href='".$MAIN_ROOT."members/console.php?cID=".$intManagePostsCID."&tID=".$topicInfo['forumtopic_id']."&action=lock'>LOCK TOPIC</a> &laquo;</b>&nbsp;&nbsp;&nbsp;";
		}
		else {
			$dispManagePosts .= "<b>&raquo <a href='".$MAIN_ROOT."members/console.php?cID=".$intManagePostsCID."&tID=".$topicInfo['forumtopic_id']."&action=lock'>UNLOCK TOPIC</a> &laquo;</b>&nbsp;&nbsp;&nbsp;";
		}
		
		$dispManagePosts .= "<b>&raquo <a href='javascript:void(0)' onclick='deleteTopic()'>DELETE TOPIC</a> &laquo;</b>&nbsp;&nbsp;&nbsp;";

	}


}




echo "
<table class='forumTable' style='margin-top: 25px'>
	<tr>
		<td class='main' valign='bottom'>
			".$dispPageSelectTop."
		</td>
		<td class='main' align='right' valign='bottom'>
			".$dispManagePosts.$dispPostReply."
		</td>
	</tr>
</table>

<table class='forumTable'>	
";

$countManagablePosts = 0;
$result = $mysqli->query("SELECT forumpost_id FROM ".$dbprefix."forum_post WHERE forumtopic_id = '".$topicInfo['forumtopic_id']."' ORDER BY dateposted LIMIT ".$intOffset.", ".$NUM_PER_PAGE);
while($row = $result->fetch_assoc()) {
	$boardObj->objPost->select($row['forumpost_id']);
	$postInfo = $boardObj->objPost->get_info_filtered();
	$postMemberObj->select($postInfo['member_id']);
	$postMemberInfo = $postMemberObj->get_info_filtered();
	$postMessage = $boardObj->objPost->get_info("message");
	
	$postMessage = str_replace("<?", "&lt;?", $postMessage);
	$postMessage = str_replace("?>", "?&gt;", $postMessage);
	$postMessage = str_replace("<script", "&lt;script", $postMessage);
	$postMessage = str_replace("</script>", "&lt;/script&gt;", $postMessage);
	
	
	$dispPostedOn = "";
	if((time()-$postInfo['dateposted']) > (60*60*24)) {
		$dispPostedOn = " on";
	}
	
	$checkURL = parse_url($postMemberInfo['avatar']);
	
	if($postMemberInfo['avatar'] == "") {
		$postMemberInfo['avatar'] = $MAIN_ROOT."themes/".$THEME."/images/defaultavatar.png";	
	}
	elseif(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
		$postMemberInfo['avatar'] = $MAIN_ROOT.$postMemberInfo['avatar'];
	}
	
	$posterRankObj->select($postMemberInfo['rank_id']);
	$posterRankInfo = $posterRankObj->get_info_filtered();
	
	$dispLastEdit = "";
	if($postInfo['lastedit_date'] != 0) {
		$postMemberObj->select($postInfo['lastedit_member_id']);
		$dispLastEdit = "<br><br><span class='tinyFont' style='font-style: italic'>Last edited by ".$postMemberObj->getMemberLink()." - ".getPreciseTime($postInfo['lastedit_date'])."</span>";	
		$postMemberObj->select($postInfo['member_id']);
	}
	
	
	$dispRankWidth = ($websiteInfo['forum_rankwidth'] <= 0) ? "" : "width: ".$websiteInfo['forum_rankwidth'].$websiteInfo['forum_rankwidthunit'].";";
	$dispRankHeight = ($websiteInfo['forum_rankheight'] <= 0) ? "" : "height: ".$websiteInfo['forum_rankheight'].$websiteInfo['forum_rankheightunit'].";";
	$dispRankDimensions = ($dispRankWidth != "" || $dispRankHeight != "") ? " style='".$dispRankWidth.$dispRankHeight."'" : "";
	$dispRankIMG = ($websiteInfo['forum_showrank'] == 1 && $posterRankInfo['rank_id'] != 1) ? "<div id='forumShowRank' style='text-align: center'><img src='".$posterRankInfo['imageurl']."'".$dispRankDimensions."></div>" : "";
	$dispMedals = "";
	if($websiteInfo['forum_showmedal'] == 1) {
		
		$medalObj = new Medal($mysqli);
		$medalCount = ($websiteInfo['forum_medalcount'] == 0) ? 5 : $websiteInfo['forum_medalcount'];
		
		$arrMedals = $postMemberObj->getMedalList(false, $websiteInfo['medalorder']);
		
		$dispMedalWidth = ($websiteInfo['forum_medalwidth'] <= 0) ? "" : "width: ".$websiteInfo['forum_medalwidth'].$websiteInfo['forum_medalwidthunit'].";";
		$dispMedalHeight = ($websiteInfo['forum_medalheight'] <= 0) ? "" : "height: ".$websiteInfo['forum_medalheight'].$websiteInfo['forum_medalheightunit'].";";
		$dispMedalDimensions = ($dispMedalWidth != "" || $dispMedalHeight != "") ?  " style='".$dispMedalWidth.$dispMedalHeight."'" : "";
		
		$i = 1;
		foreach($arrMedals as $medalID) {
			$medalObj->select($medalID);
			$medalInfo = $medalObj->get_info_filtered();
			$resultMedal = $mysqli->query("SELECT * FROM ".$dbprefix."medals_members WHERE member_id = '".$postMemberInfo['member_id']."' AND medal_id = '".$medalInfo['medal_id']."'");
			$rowMedal = $resultMedal->fetch_assoc();
			
			$dispDateAwarded = "<b>Date Awarded:</b><br>".getPreciseTime($rowMedal['dateawarded']);
			
			$dispReason = "";
			if($rowMedal['reason'] != "") {
				$dispReason = "<br><br><b>Awarded for:</b><br>".filterText($rowMedal['reason']);
			}
			
			$dispMedalMessage = "<b>".$medalInfo['name']."</b><br><br>".$dispDateAwarded.$dispReason;
			
			
			$dispMedals .= "<div style='text-align: center; margin: 5px 0px'><img src='".$medalInfo['imageurl']."'".$dispMedalDimensions." onmouseover=\"showToolTip('".$dispMedalMessage."')\" onmouseout='hideToolTip()'></div>";
			
			$i++;
			if($i > $medalCount) { break; }
		}
		
		
	}
	
	$setAvatarWidth = ($websiteInfo['forum_avatarwidth'] > 0) ? $websiteInfo['forum_avatarwidth'] : "50";
	$setAvatarWidthUnit = ($websiteInfo['forum_avatarwidthunit'] == "%") ? "%" : "px";
	
	$setAvatarHeight = ($websiteInfo['forum_avatarheight'] > 0) ? $websiteInfo['forum_avatarheight'] : "50";
	$setAvatarHeightUnit = ($websiteInfo['forum_avatarheightunit'] == "%") ? "%" : "px";
	
	$dispForumPostText = ($websiteInfo['forum_linkimages'] == 1) ? autoLinkImage(parseBBCode($postMessage)) : parseBBCode($postMessage);
	
	echo "
		<tr>
			<td class='boardPosterInfo' valign='top'><a name='".$postInfo['forumpost_id']."'></a>
				<div id='forumShowPosterName'>
				<span class='boardPosterName'>".$postMemberObj->getMemberLink()."</span><br>
				".$posterRankInfo['name']."
				</div>
				<div id='forumShowAvatar'><img src='".$postMemberInfo['avatar']."' style='width: ".$setAvatarWidth.$setAvatarWidthUnit."; height: ".$setAvatarHeight.$setAvatarHeightUnit."; margin-top: 5px; margin-bottom: 5px'></div>
				<div id='forumShowPostCount'>Posts: ".$postMemberObj->countForumPosts()."</div>
				".$dispRankIMG."
				<div id='forumShowMedals'>".$dispMedals."</div>
			</td>
			<td class='boardPostInfo' valign='top'>
			<div class='postTime'>Posted".$dispPostedOn." ".getPreciseTime($postInfo['dateposted'])."</div>
			
			".$dispForumPostText.$dispLastEdit."
			
			</td>
		</tr>
		";
	
	$arrAttachments = $boardObj->objPost->getPostAttachments();
	
	
	if(count($arrAttachments) > 0 && $blnShowAttachments) {

		echo "
			<tr>
				<td class='boardPosterInfoExtra'></td>
				<td class='boardPostExtraRow'>
					<div class='forumAttachmentsContainer'>
						<b>Attachments:</b><br>
					";
				
				foreach($arrAttachments as $downloadID) {
					$attachmentObj->select($downloadID);
					$attachmentInfo = $attachmentObj->get_info_filtered();
					$addS = ($attachmentInfo['downloadcount'] != 1) ? "s" : "";
					$dispFileSize = $attachmentInfo['filesize']/1024;
					
					if($dispFileSize < 1) {
						$dispFileSize = $attachmentInfo['filesize']."B";	
					}
					elseif(($dispFileSize/1024) < 1) {
						$dispFileSize = round($dispFileSize, 2)."KB";	
					}
					else {
						$dispFileSize = round(($dispFileSize/1024),2)."MB";
					}
					
					echo "<a href='".$MAIN_ROOT."downloads/file.php?dID=".$downloadID."'>".$attachmentInfo['filename']."</a> - downloaded ".$attachmentInfo['downloadcount']." time".$addS." - ".$dispFileSize."<br>";
					
				}
		
				echo "
					</div>
				</td>
			</tr>
		";
		
	}

	
	if($postMemberInfo['forumsignature'] != "" && $websiteInfo['forum_hidesignatures'] == 0) {
		echo "
		<tr>
			<td class='boardPosterInfoExtra'></td>
			<td class='boardPostExtraRow'>
				<div class='forumSignatureContainer'>".parseBBCode($postMemberObj->get_info("forumsignature"))."</div>
			</td>
		</tr>
		";
	}
	
	
	echo "
		<tr>
			<td class='boardPosterInfoFooter'></td>
			<td class='boardPostInfoFooter'>
				";
		
		if($blnManagePosts || $postMemberInfo['member_id'] == $memberInfo['member_id']) {

			echo "&raquo; <a href='".$MAIN_ROOT."members/console.php?cID=".$intManagePostsCID."&pID=".$postInfo['forumpost_id']."'>EDIT POST</a> &laquo;&nbsp&nbsp;&nbsp;";
			echo "&raquo; <a href='javascript:void(0)' onclick=\"deletePost('".$postInfo['forumpost_id']."')\">DELETE POST</a> &laquo;&nbsp&nbsp;&nbsp;";
			$countManagablePosts++;
			
		}
		
		if($LOGGED_IN && $topicInfo['lockstatus'] == 0) { 
			echo "&raquo; <a href='".$MAIN_ROOT."members/console.php?cID=".$intPostTopicCID."&bID=".$topicInfo['forumboard_id']."&tID=".$topicInfo['forumtopic_id']."&quote=".$postInfo['forumpost_id']."'>QUOTE</a> &laquo;"; 
		}
		
	echo "
			</td>
		</tr>
		<tr>
			<td colspan='2' style='font-size: 5px'><br></td>
		</tr>
	
	";
	
	
}

echo "
<tr>
	<td class='main' colspan='2' align='right'>
		".$dispPageSelectBottom.$dispManagePosts.$dispPostReply."
		<div style='clear: both'></div>
	</td>
</tr>
</table>


";



if($blnPageSelect) {
	echo "
		<script type='text/javascript'>
	
			$(document).ready(function() {
				$('#btnPageSelectTop, #btnPageSelectBottom').click(function() {
					
					var jqPageSelect = \"#pageSelectBottom\";
					var intNewPage = 0;
					
					if($(this).attr('id') == \"btnPageSelectTop\") {
						jqPageSelect = \"#pageSelectTop\";
					}
					
					intNewPage = $(jqPageSelect).val();
					
					window.location = 'viewtopic.php?tID=".$_GET['tID']."&pID='+intNewPage;
					
				});
			});
		</script>
	";
}

if($blnManagePosts) {
	echo "
		<div id='confirmDeleteTopicDiv' style='display: none'>
			<p align='center' class='main'>
				Are you sure you want to delete this topic?<br><br>
				All posts will be deleted within the topic as well.
			</p>
		</div>
		<script type='text/javascript'>
			function deleteTopic() {
			
				$(document).ready(function() {
	
					$('#confirmDeleteTopicDiv').dialog({
						title: 'Delete Topic - Confirm Delete',
						show: 'scale',
						zIndex: 99999,
						width: 400,
						resizable: false,
						modal: true,
						buttons: {
							'Yes': function() {
								$(this).dialog('close');
								window.location = '".$MAIN_ROOT."members/console.php?cID=".$intManagePostsCID."&tID=".$topicInfo['forumtopic_id']."&action=delete'
							},
							'Cancel': function() {
								$(this).dialog('close');
							}
						}
					
					});
				
				});
	
			}
		</script>
	";
}


if($countManagablePosts > 0) {
	echo "
	
	<div id='confirmDeleteDiv' style='display: none'>
			<p align='center' class='main'>
				Are you sure you want to delete this post?<br><br>
			</p>
		</div>
		<script type='text/javascript'>
			function deletePost(intPostID) {
			
				$(document).ready(function() {
	
					$('#confirmDeleteDiv').dialog({
						title: 'Delete Post - Confirm Delete',
						show: 'scale',
						zIndex: 99999,
						width: 400,
						resizable: false,
						modal: true,
						buttons: {
							'Yes': function() {
								$(this).dialog('close');
								window.location = '".$MAIN_ROOT."members/console.php?cID=".$intManagePostsCID."&pID='+intPostID+'&action=delete'
							},
							'Cancel': function() {
								$(this).dialog('close');
							}
						}
					
					});
				
				});
	
			}
		</script>
	";
	
}

include($prevFolder."themes/".$THEME."/_footer.php");
?>