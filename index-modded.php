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
$prevFolder = "";

include_once($prevFolder."_setup.php");
include_once($prevFolder."classes/forumpost.php");
include_once($prevFolder."themes/tec/imageslider.php");

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

$EXTERNAL_JAVASCRIPT .= "
<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
<link rel='stylesheet' type='text/css' href='themes/tec/style-hp.css'>
<script type='text/javascript' src='".$MAIN_ROOT."themes/tec/imageslider.js'></script>
";

// Start Page
$PAGE_NAME = "";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");

include($prevFolder."themes/tec/hp-boxes.php");
?>

<div id='hp_newsContainer' class='hp_newsContainer'>
	
</div>
<div class='hp_midRowSection'>
	<div class='hp_midRowBox'>
		<div class='hp_midRowBox_top'>
			<p>Recent Matches</p>
			
			<div class='hp_midRowBox_viewmore'>view more</div>
			
		</div>
		<div class='hp_midRowBox_content'>
		
			<div class='hp_midRowBox_contentRow'>
				<div class='hp_midRowBox_contentRowIcon'><img src='images/transparent.png' class='hp_icon_news'></div>
				<div class='hp_midRowBox_contentRowText'>Test</div>

				<div class='hp_midRowBox_contentRowStatsBox'>2-0</div>
					
			</div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
		
		</div>
	</div>
	<div class='hp_midRowBox'>
		<div class='hp_midRowBox_top'>
			<p>Recent Discussions</p>
		
			<div class='hp_midRowBox_viewmore'><a href='forum'>view more</a></div>
		</div>
		<div class='hp_midRowBox_content'>
			<?php 
				$arrForumPosts = hpForumDiscusions();
				$forumPostObj = new ForumPost($mysqli);
				$forumTopicObj = new Basic($mysqli, "forum_topic", "forumtopic_id");
				$i=1;
				foreach($arrForumPosts as $forumPostID) {
					
					$forumPostObj->select($forumPostID);
					$forumTopicObj->select($forumPostObj->get_info("forumtopic_id"));
					$forumTopicPostID = $forumTopicObj->get_info("forumpost_id");
					$forumPostObj->select($forumTopicPostID);
					$forumPostReplies = $forumTopicObj->get_info("replies");
					$forumPostInfo = $forumPostObj->get_info_filtered();
					echo "
						<div class='hp_midRowBox_contentRow'>
							<div class='hp_midRowBox_contentRowIcon'><img src='images/transparent.png' class='hp_icon_forum'></div>
							<div class='hp_midRowBox_contentRowText'><a href='".$MAIN_ROOT."forum/viewtopic.php?tID=".$forumPostInfo['forumtopic_id']."#".$forumPostID."'>".$forumPostInfo['title']."</a></div>
			
							<div class='hp_midRowBox_contentRowStatsBox'>".$forumPostReplies."</div>
								
						</div>
					
					";
					
					$i++;
					
					if($i < 6) {
						echo "<div class='hp_midRowBox_contentRowSep'></div>";				
					}
					
				}
				
				for($x=$i;$i<6;$i++) {
					
					echo "
					
						<div class='hp_midRowBox_contentRow'>
							<div class='hp_midRowBox_contentRowIcon'><img src='images/transparent.png' class='hp_icon_forum'></div>
							<div class='hp_midRowBox_contentRowText'>-</div>
			
							<div class='hp_midRowBox_contentRowStatsBox'>-</div>
								
						</div>
					
					";
					
					if($x < 5) {
						echo "<div class='hp_midRowBox_contentRowSep'></div>";
					}
					
				}
			
			?>
		
		</div>
	</div>
	<div class='hp_midRowBox'>
		<div class='hp_midRowBox_top'>
			<p>LAN News</p>
			<div class='hp_midRowBox_viewmore'>view more</div>
		</div>
		<div class='hp_midRowBox_content'>
		
			<div class='hp_midRowBox_contentRow'></div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
			<div class='hp_midRowBox_contentRowSep'></div>
			<div class='hp_midRowBox_contentRow'></div>
		
		</div>
	</div>
</div>

<?php 
$imageSliderObj = new ImageSlider($mysqli);

$imageSliderObj->dispHomePageImage("hp_newsContainer", true);

include($prevFolder."themes/".$THEME."/_footer.php"); ?>