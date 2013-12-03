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

// Config File
$prevFolder = "../";

include($prevFolder."_setup.php");

include_once($prevFolder."classes/member.php");
include_once($prevFolder."classes/forumboard.php");

$consoleObj = new ConsoleOption($mysqli);
$boardObj = new ForumBoard($mysqli);
$member = new Member($mysqli);
$postMemberObj = new Member($mysqli);

$categoryObj = new BasicOrder($mysqli, "forum_category", "forumcategory_id");
$categoryObj->set_assocTableName("forum_board");
$categoryObj->set_assocTableKey("forumboard_id");


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


// Start Page
$PAGE_NAME = "Forum - ";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");

// Check Private Forum

if($websiteInfo['privateforum'] == 1 && !constant("LOGGED_IN")) {
	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."login.php';</script>");
}

$memberInfo = array();




$LOGGED_IN = false;
if($member->select($_SESSION['btUsername']) && $member->authorizeLogin($_SESSION['btPassword'])) {
	$memberInfo = $member->get_info_filtered();
	$LOGGED_IN = true;

}



echo "
	<div class='breadCrumbTitle'>Forum</div>
	<div class='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
		<a href='".$MAIN_ROOT."'>Home</a> > Forum
	</div>
	
	<table class='forumTable'>
";


$result = $mysqli->query("SELECT forumcategory_id FROM ".$dbprefix."forum_category ORDER BY ordernum DESC");
while($row = $result->fetch_assoc()) {
	$arrForumCats[] = $row['forumcategory_id'];
	
	$categoryObj->select($row['forumcategory_id']);
	$catInfo = $categoryObj->get_info_filtered();
	$arrBoards = $categoryObj->getAssociateIDs("ORDER BY sortnum");
	$dispBoards = "";
	foreach($arrBoards as $boardID) {
		
		$boardObj->select($boardID);
		
		if($boardObj->memberHasAccess($memberInfo)) {
			$boardInfo = $boardObj->get_info_filtered();
			$arrForumTopics = $boardObj->getForumTopics();
			
			$newTopicBG = "";
			$dispNewTopicIMG = "";
			
			if($LOGGED_IN && $boardObj->hasNewTopics($memberInfo['member_id'])) {
				$dispNewTopicIMG = " <img style='margin-left: 5px' src='".$MAIN_ROOT."themes/".$THEME."/images/forum-new.png' title='New Posts!'>";
				$newTopicBG = " boardNewPostBG";
			}
			
			// Get Last Post Display Info
			if(count($arrForumTopics) > 0) {
				$boardObj->objPost->select($arrForumTopics[0]);
				$firstPostInfo = $boardObj->objPost->get_info_filtered();
				
				$boardObj->objTopic->select($firstPostInfo['forumtopic_id']);
				$lastPostID = $boardObj->objTopic->get_info("lastpost_id");
				
				$boardObj->objPost->select($lastPostID);
				$lastPostInfo = $boardObj->objPost->get_info_filtered();
				
				$postMemberObj->select($lastPostInfo['member_id']);
				
				$dispLastPost = "<div class='boardLastPostTitle'><a href='viewtopic.php?tID=".$firstPostInfo['forumtopic_id']."#".$lastPostID."' title='".$firstPostInfo['title']."'>".$firstPostInfo['title']."</a></div>by ".$postMemberObj->getMemberLink()."<br>".getPreciseTime($lastPostInfo['dateposted']);
			}
			else {
				$dispLastPost = "<div style='text-align: center'>No Posts</div>";	
			}
			
			$dispTopicCount = $boardObj->countTopics();
			$dispPostCount = $boardObj->countPosts();
			
			$dispBoards .= "
				<tr class='boardRows'>
					<td class='boardName dottedLine".$newTopicBG."'><a href='viewboard.php?bID=".$boardInfo['forumboard_id']."'>".$boardInfo['name']."</a>".$dispNewTopicIMG."<br><span class='boardDescription'>".$boardInfo['description']."</span></td>
					<td class='dottedLine boardLastPost".$newTopicBG."'>".$dispLastPost."</td>
					<td class='dottedLine boardTopicCount".$newTopicBG."' align='center'>".$dispTopicCount."</td>
					<td class='dottedLine boardTopicCount".$newTopicBG."' align='center'>".$dispPostCount."</td>
				
				</tr>
			";
			
		}

	}
	
	
	if($dispBoards != "") {
	
		echo "
			<tr>
				<td colspan='4' class='boardCategory'>
					".$catInfo['name']."
				</td>
			</tr>
			<tr>
				<td class='boardTitles-Name'>Forum:</td>
				<td class='boardTitles-LastPost' style='border-left: 0px'>Last Post:</td>
				<td class='boardTitles-TopicCount' style='border-left: 0px'>Topics:</td>
				<td class='boardTitles-TopicCount' style='border-left: 0px'>Posts:</td>
			</tr>
		";
		echo $dispBoards;
		
		echo "<tr><td colspan='4'><br></td></tr>";
	
	}
	
	
}

if($result->num_rows == 0) {

	echo "
		
		<div class='shadedBox' style='width: 40%; margin: 20px auto'>
			<p class='main' align='center'>
				No boards have been made yet!
			</p>
		</div>
	
	";
	
}


echo "</table>";


?>


<?php
include($prevFolder."themes/".$THEME."/_footer.php");
?>