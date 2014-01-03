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
$memberInfo = array();

	

$member->select($_SESSION['btUsername']);
$memberInfo = $member->get_info_filtered();
$privateNewsCID = $consoleObj->findConsoleIDByName("View Private News");
$consoleObj->select($privateNewsCID);
// Check Login
$LOGIN_FAIL = true;
if($member->authorizeLogin($_SESSION['btPassword'])) {

	$LOGIN_FAIL = false;
	// Check Private News

}




// Start Page
$PAGE_NAME = "News - ";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");
?>

<div class='breadCrumbTitle'>News</div>
<div class='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
	<a href='<?php echo $MAIN_ROOT; ?>'>Home</a> > News
</div>



<?php

$showPrivateSQL = "";
if(LOGGED_IN) {
	$showPrivateSQL = " OR newstype = '2'";
}

$result = $mysqli->query("SELECT * FROM ".$dbprefix."news WHERE newstype = '1'".$showPrivateSQL." ORDER BY dateposted DESC");

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

		
		if($member->select($row['lasteditmember_id'])) {
		
			$dispLastEditTime = getPreciseTime($row['lasteditdate']);
			$dispLastEdit = "<span style='font-style: italic'>last edited by ".$member->getMemberLink()." - ".$dispLastEditTime."</span>";
		}
		
		$member->select($row['member_id']);
		
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

	<div class='shadedBox' style='width: 300px; margin-top: 50px; margin-bottom: 25px; margin-left: auto; margin-right: auto'>
		<p class='main' align='center'>
			<i>There are currently no news posts!</i>
		</p>
	</div>

	";

}


?>



<?php include($prevFolder."themes/".$THEME."/_footer.php"); ?>