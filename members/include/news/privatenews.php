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

	include_once("../classes/news.php");
	$manageNewsCID = $consoleObj->findConsoleIDByName("Manage News");
	$postNewsCID = $consoleObj->findConsoleIDByName("Post News");

	
	$dispPostNews = "";
	$dispManageNews = "";
	
	
	if($consoleObj->select($postNewsCID) && $member->hasAccess($consoleObj)) {
	
		$dispPostNews = "&raquo; <a href='".$MAIN_ROOT."members/console.php?cID=".$postNewsCID."'>Post News</a> &laquo; &nbsp; ";
	}
	
	if($consoleObj->select($manageNewsCID) && $member->hasAccess($consoleObj)) {
		$dispManageNews = "&raquo; <a href='".$MAIN_ROOT."members/console.php?cID=".$manageNewsCID."'>Manage News</a> &laquo;";
	}
	
	$consoleObj->select($cID);
	$newsObj = new News($mysqli);
	echo "
	
		<p align='right' class='main' style='padding-right: 20px'>
			".$dispPostNews.$dispManageNews."
		</p>
	
	";


	$result = $mysqli->query("SELECT * FROM ".$dbprefix."news WHERE newstype = '2' ORDER BY dateposted DESC");
	
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			$newsObj->select($row['news_id']);
			$member->select($row['member_id']);
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
			
			echo "
			
				<div class='newsDiv' id='newsDiv_".$row['news_id']."'>
					<div class='postInfo'>
						<div style='float: left'><img src='".$posterInfo['avatar']."' class='avatarImg'></div>
						<div style='float: left; margin-left: 15px'>posted by ".$member->getMemberLink()." - ".getPreciseTime($row['dateposted']).$dispNewsType."<br>
						<span class='subjectText'>".filterText($row['postsubject'])."</span></div>
						<div style='clear: both'></div>
					</div>
					<br>
					<div class='dottedLine' style='margin-top: 5px'></div>
					<div class='postMessage'>
						".nl2br(parseBBCode(filterText($row['newspost'])))."
					</div>
					<div class='dottedLine' style='margin-top: 5px; margin-bottom: 5px'></div>
					<div class='main' style='margin-top: 0px; margin-bottom: 10px; padding-left: 5px'>".$dispLastEdit."</div>
					<p style='padding: 0px; margin: 0px' align='right'><b><a href='".$MAIN_ROOT."news/viewpost.php?nID=".$row['news_id']."#comments'>Comments (".$newsObj->countComments().")</a></b></p>
				</div>

			";
			
			
		}
		
	}
	else {
		
		echo "
		
			<div class='shadedBox' style='width: 300px; margin-left: auto; margin-right: auto'>
				<p class='main' align='center'>
					<i>There are currently no private news posts!</i>
				</p>
			</div>
		
		";
		
	}


?>