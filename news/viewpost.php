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
include($prevFolder."classes/member.php");
include_once($prevFolder."classes/rank.php");
include_once($prevFolder."classes/news.php");

// Classes needed for index.php


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

$member = new Member($mysqli);
$newsObj = new News($mysqli);
$consoleObj = new ConsoleOption($mysqli);

if(isset($_GET['nID']) && $newsObj->select($_GET['nID'])) {
	
	$newsInfo = $newsObj->get_info_filtered();
	
	$member->select($_SESSION['btUsername']);
	$memberInfo = $member->get_info_filtered();
	$privateNewsCID = $consoleObj->findConsoleIDByName("View Private News");
	$consoleObj->select($privateNewsCID);
	// Check Login
	$LOGIN_FAIL = true;
	if($member->authorizeLogin($_SESSION['btPassword'])) {
		
		$LOGIN_FAIL = false;
		// Check Private News
		if($newsInfo['newstype'] == 2 && !$member->hasAccess($consoleObj)) {
			die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."';</script>");
		}

	}
	elseif($newsInfo['newstype'] == 2) {
		die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."';</script>");
	}
	
	
}
else {
	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."';</script>");
}


// Start Page
$PAGE_NAME = $newsInfo['postsubject']." - News - ";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");

$memberInfo = "";
if(!$LOGIN_FAIL) {
	$memberInfo = $member->get_info_filtered();
}
?>

<div class='breadCrumbTitle'><?php echo $newsInfo['postsubject']; ?></div>
<div class='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
	<a href='<?php echo $MAIN_ROOT; ?>'>Home</a> > <a href='<?php echo $MAIN_ROOT; ?>news'>News</a> > <?php echo $newsInfo['postsubject']; ?>
</div>


<?php

$member->select($newsInfo['member_id']);
$posterInfo = $member->get_info_filtered();

if($posterInfo['avatar'] == "") {
	$posterInfo['avatar'] = $MAIN_ROOT."themes/".$THEME."/images/defaultavatar.png";
}
else {
	$posterInfo['avatar'] = $MAIN_ROOT.$posterInfo['avatar'];	
}

if($row['newstype'] == 1) {
	$dispNewsType = " - <span class='publicNewsColor' style='font-style: italic'>public</span>";
}
elseif($row['newstype'] == 2) {
	$dispNewsType = " - <span class='privateNewsColor' style='font-style: italic'>private</span>";
}
elseif($row['newstype'] == 3) {
	$dispNewsType = "";
}


$checkHTMLConsoleObj = new ConsoleOption($mysqli);
$htmlNewsCID = $checkHTMLConsoleObj->findConsoleIDByName("HTML in News Posts");
$checkHTMLConsoleObj->select($htmlNewsCID);


if($member->select($newsInfo['lasteditmember_id'])) {
	$checkHTMLAccess = $member->hasAccess($checkHTMLConsoleObj);
	$dispLastEditTime = getPreciseTime($newsInfo['lasteditdate']);
	$dispLastEdit = "<span style='font-style: italic'>last edited by ".$member->getMemberLink()." - ".$dispLastEditTime."</span>";
}


$member->select($newsInfo['member_id']);

if(!isset($checkHTMLAccess)) { $checkHTMLAccess = $member->hasAccess($checkHTMLConsoleObj); }

$dispNews = ($checkHTMLAccess) ? parseBBCode($newsObj->get_info("newspost")) : nl2br(parseBBCode($newsInfo['newspost']));

echo "

	<div class='newsDiv'>
		
		<div class='postInfo'>
			<div style='float: left'><img src='".$posterInfo['avatar']."' class='avatarImg'></div>
			<div style='float: left; margin-left: 15px'>posted by ".$member->getMemberLink()." - ".getPreciseTime($newsInfo['dateposted']).$dispNewsType."<br>
			<span class='subjectText'>".$newsInfo['postsubject']."</span></div>
			<div style='clear: both'></div>
		</div>
		<br>
		<div class='dottedLine' style='margin-top: 5px'></div>
		<div class='postMessage'>
			".$dispNews."
		</div>
		<div class='dottedLine' style='margin-top: 5px; margin-bottom: 5px'></div>
		<div class='main' style='margin-top: 0px; margin-bottom: 10px; padding-left: 5px'>".$dispLastEdit."</div>
	</div>

	<div style='padding-left: 15px'>
	";


$postCommentCID = $consoleObj->findConsoleIDByName("Post Comment");
$consoleObj->select($postCommentCID);

if($member->select($memberInfo['member_id'])) {
	if($member->hasAccess($consoleObj)) {
	
		echo "
	
		<p class='main' style='font-weight: bold; padding: 0px; margin-bottom: 2px'>Post Comment:</p>
		<textarea class='textBox' id='commenttext' style='width: 95%; height: 80px'></textarea>
		<p align='right' style='padding: 0px; margin-top: 5px; padding-right: 25px'><input type='button' class='submitButton' id='postcomment' value='Post'></p>
	
		<script type='text/javascript'>
		
			$(document).ready(function() {
			
				$('#postcomment').click(function() {
				
					$('#commentsDiv').hide();
					$('#loadingSpiral').show();
					$.post('".$MAIN_ROOT."members/include/news/postcomment.php', { nID: ".$newsInfo['news_id'].", comment: $('#commenttext').val() }, function(data) {
						
						$('#loadingSpiral').hide();
						$('#commentsDiv').html(data);
						$('#commentsDiv').fadeIn(250);
						$('#commenttext').val('');
						
					});
			
				});
				
			});
		
		
			function deleteComment(intCommentID) {
			
				$(document).ready(function() {
					
					$('#commentsDiv').hide();
					$('#loadingSpiral').show();
				
					$.post('".$MAIN_ROOT."members/include/news/deletecomment.php', { commentID: intCommentID }, function(data) {
					
						$('#loadingSpiral').hide();
						$('#commentsDiv').html(data);
						$('#commentsDiv').fadeIn(250);

					
					});
				
				});
			
			}
			
			
		</script>
		
		";
	
	}
}

echo "
		<p class='largeFont' style='font-weight: bold; padding-bottom: 0px; margin-bottom: 2px'>Comments (<span id='commentCount'>".$newsObj->countComments()."</span>)<a name='comments'></a></p>
		<div class='dottedLine' style='width: 95%'></div>

		<div id='loadingSpiral' class='loadingSpiral'>
			<p align='center'>
				<img src='".$MAIN_ROOT."themes/".$THEME."/images/loading-spiral.gif'><br>Loading
			</p>
		</div>
		";
$arrComments = $newsObj->getComments();
include("comments.php");
	echo "</div>";

include($prevFolder."themes/".$THEME."/_footer.php");


?>