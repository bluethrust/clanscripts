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

include($prevFolder."_setup.php");
include($prevFolder."classes/member.php");
include_once($prevFolder."classes/rank.php");
include_once($prevFolder."classes/profilecategory.php");
include_once($prevFolder."classes/profileoption.php");
include_once($prevFolder."classes/game.php");


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

if($member->select($_GET['mID'])) {
	
	$memberInfo = $member->get_info_filtered();
	$member->addProfileView();
	$member->autoAwardMedals();
	$member->autoPromote();
	
}
else {
	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."';</script>");	
}



// Start Page
$PAGE_NAME = $memberInfo['username']."'s Profile - ";
$dispBreadCrumb = "";
include($prevFolder."themes/".$THEME."/_header.php");

// Check Private Profiles

if($websiteInfo['privateprofile'] == 1 && !constant("LOGGED_IN")) {
	die("<script type='text/javascript'>window.location = '".$MAIN_ROOT."login.php';</script>");
}



$member->select($_GET['mID']);
$memberInfo = $member->get_info_filtered();

$rankObj = new Rank($mysqli);
$rankObj->select($memberInfo['rank_id']);

$rankInfo = $rankObj->get_info_filtered();

if($memberInfo['profilepic'] == "") {
	$dispProfileImage = $MAIN_ROOT."themes/".$THEME."/images/defaultprofile.png";
}
else {
	$dispProfileImage = $memberInfo['profilepic'];
}

$dispSendPM = "";
if(constant("LOGGED_IN")) {
	$dispSendPM = "
		<div class='dottedLine' style='padding: 3px 0px'></div>
		
		<p align='center'>
			<b><a href='".$MAIN_ROOT."members/privatemessages/compose.php?toID=".$memberInfo['member_id']."'>Send Private Message</a></b>
		</p>
	
	";
}

$dispSocialMedia = "";

if($memberInfo['facebook'] != "") {
	
	$dispSocialMedia .= "<a href='".$memberInfo['facebook']."' target='_blank'><img src='".$MAIN_ROOT."themes/".$THEME."/images/socialmedia/facebook.png' width='24' height='24' style='margin-right: 5px'></a>";
	
}

if($memberInfo['twitter'] != "") {

	$dispSocialMedia .= "<a href='http://www.twitter.com/".$memberInfo['twitter']."' target='_blank'><img src='".$MAIN_ROOT."themes/".$THEME."/images/socialmedia/twitter.png' width='24' height='24' style='margin-right: 5px'></a>";

}

if($memberInfo['youtube'] != "") {

	$dispSocialMedia .= "<a href='http://www.youtube.com/user/".$memberInfo['youtube']."' target='_blank'><img src='".$MAIN_ROOT."themes/".$THEME."/images/socialmedia/youtube.png' width='24' height='24' style='margin-right: 5px'></a>";

}

if($memberInfo['googleplus'] != "") {

	$dispSocialMedia .= "<a href='".$memberInfo['googleplus']."' target='_blank'><img src='".$MAIN_ROOT."themes/".$THEME."/images/socialmedia/googleplus.png' width='24' height='24' style='margin-right: 5px'></a>";

}

if($memberInfo['twitch'] != "") {
	
	$dispSocialMedia .= "<a href='http://www.twitch.tv/".$memberInfo['twitch']."' target='_blank'><img src='".$MAIN_ROOT."themes/".$THEME."/images/socialmedia/twitch.png' width='24' height='24' style='margin-right: 5px'></a>";
	
}



if($dispSocialMedia != "") {
	
	$addBar = "<div class='dottedLine' style='padding: 3px 0px; margin-bottom: 3px'></div><b>Follow Me:</b><br><p align='center'>";
	$dispSocialMedia = $addBar.$dispSocialMedia."</p>";
	
}


$dispRecruiter = "Unknown";
if($member->select($memberInfo['recruiter'])) {
	$dispRecruiter = $member->getMemberLink();
}
elseif($memberInfo['recruiter'] == 0) {
	$dispRecruiter = "Website Admin";
}

$member->select($memberInfo['member_id']);
$arrRecruits = $member->countRecruits(true);
$totalRecruits = count($arrRecruits);

foreach($arrRecruits as $recruitID) {
	
	$member->select($recruitID);
	$arrDispRecruits[] = $member->getMemberLink();
	
	
}

$dispRecruits = implode(", ", $arrDispRecruits);


$dispLastLogin = "Never Logged In";


if($memberInfo['lastlogin'] != 0) {
	$dispLastLogin = getPreciseTime($memberInfo['lastlogin']);
}

$dispLastSeen = "Never Logged In";
if($memberInfo['lastseen'] != 0) {
	$dispLastSeen = getPreciseTime($memberInfo['lastseen']);	
}

$dispLastPromotion = "Never Promoted";
if($memberInfo['lastpromotion'] != 0) {
	$dispLastPromotion = getPreciseTime($memberInfo['lastpromotion']);
}

$dispLastDemotion = "Never Demoted";
if($memberInfo['lastdemotion'] != 0) {
	$dispLastDemotion = getPreciseTime($memberInfo['lastdemotion']);
}


$dispDaysInClan = round((time()-$memberInfo['datejoined'])/86400);


if((time()-$memberInfo['lastseen']) < 600) {
	$dispOnlineStatus = "<span style='margin-top: 1px'><img src='".$MAIN_ROOT."themes/".$THEME."/images/onlinedot.png' title='Online!'></span>";
}
else {
	$dispOnlineStatus = "<img src='".$MAIN_ROOT."themes/".$THEME."/images/offlinedot.png' title='Offline'>";
	
	if($memberInfo['loggedin'] == 1) {
		$member->select($memberInfo['member_id']);
		$member->update(array("loggedin"), array(0));	
	}
	
}

$dispRankImg = "";
if($rankInfo['imageurl'] != "") {
	$dispRankImg = "
		<div class='main' style='text-align: center; margin-top: 5px; width: 150px; padding: 0px'>
			<img src='".$rankInfo['imageurl']."' width='".$rankInfo['imagewidth']."' height='".$rankInfo['imageheight']."'>
		</div>
	";
}


$dispBirthday = "";
if($memberInfo['birthday'] != 0) {
	
	$formatBirthday = date("M j, Y", $memberInfo['birthday']);
	$calcAge = floor((time()-$memberInfo['birthday'])/(31536000));
	$dispBirthday = "<br><br>
	<b>Birthday:</b><br>
	".$formatBirthday."<br><br>
	<b>Age:</b> ".$calcAge;
	
}

if($memberInfo['lastseenlink'] == "") {
	$dispLastSeenLink = "No Where";	
}
else {
	$member->select($memberInfo['member_id']);
	$dispLastSeenLink = $member->get_info("lastseenlink");	
}


?>

<div class='breadCrumbTitle'><div style='display: inline-block'><?php echo $memberInfo['username']; ?>'s Profile</div><div style='display: inline-block; margin-left: 8px; vertical-align: middle'><?php echo $dispOnlineStatus; ?></div></div>
<div class='breadCrumb' style='padding-top: 0px; margin-top: 0px'>
<a href='<?php echo $MAIN_ROOT; ?>'>Home</a> > <a href='<?php echo $MAIN_ROOT; ?>members.php'>Members</a> > <?php echo $memberInfo['username']; ?>'s Profile
</div>

<div style='position: relative; margin-left: auto; margin-right: auto; width: 95%; margin-top: 15px; border: s'>
	<div class='main userProfileLeft'>
	
		<p align='center'><img src='<?php echo $dispProfileImage; ?>' width='150' height='200' class='solidBox' style='padding: 0px; margin: 0px auto'></p>
		<?php echo $dispRankImg; ?>
		<div class='formTitle userProfileLeftBoxWidth' style='margin-top: 5px'>
			<b>Profile Information:</b>
		</div>
		<div class='solidBox tinyFont userProfileLeftBoxWidth' style='margin: 0px; border-top-width: 0px'>
			<b>Last Seen:</b><br>
			<?php echo $dispLastSeen; ?> on<br>
			<?php echo $dispLastSeenLink; ?>
			<br><br>
			<b>Date Recruited:</b><br>
			<?php echo getPreciseTime($memberInfo['datejoined']); ?><br><br>
			<b>Profile Views:</b> <?php echo number_format($memberInfo['profileviews']); ?>
			<?php echo $dispBirthday; ?>
			<?php echo $dispSocialMedia; ?>
			<?php echo $dispSendPM; ?>
			
		
		</div>
	
	
	
	</div>


	<div class='main userProfileRight'>
		
		
		<div class='formTitle' style='text-align: center'>User Information</div>
	
		<table class='profileTable' style='border-top-width: 0px'>
			<tr>
				<td class='profileLabel alternateBGColor'>Username:</td>
				<td class='main' style='padding-left: 10px'><?php echo $memberInfo['username']; ?></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Rank:</td>
				<td class='main' style='padding-left: 10px'><?php echo $rankInfo['name']; ?></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Recruited By:</td>
				<td class='main' style='padding-left: 10px'><?php echo $dispRecruiter; ?></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Recruits: <?php echo $totalRecruits; ?></td>
				<td class='main' style='padding-left: 10px'><marquee scrollamount='3'><?php echo $dispRecruits; ?></marquee></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Last Log In:</td>
				<td class='main' style='padding-left: 10px'><?php echo $dispLastLogin; ?></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Times Logged In:</td>
				<td class='main' style='padding-left: 10px'><?php echo $memberInfo['timesloggedin']; ?></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Last Promotion:</td>
				<td class='main' style='padding-left: 10px'><?php echo $dispLastPromotion; ?></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Last Demotion:</td>
				<td class='main' style='padding-left: 10px'><?php echo $dispLastDemotion; ?></td>
			</tr>
			<tr>
				<td class='profileLabel alternateBGColor'>Days In Clan:</td>
				<td class='main' style='padding-left: 10px'><?php echo $dispDaysInClan; ?></td>
			</tr>
		</table>
	
		<?php
			$profileCatObj = new ProfileCategory($mysqli);
			$profileOptionObj = new ProfileOption($mysqli);
			
			$member->select($memberInfo['member_id']);
			
			$result = $mysqli->query("SELECT * FROM ".$dbprefix."profilecategory ORDER BY ordernum DESC");
			while($row = $result->fetch_assoc()) {
		
				$profileCatObj->select($row['profilecategory_id']);
				
				$arrProfileOptions = $profileCatObj->getAssociateIDs("ORDER BY sortnum");
				
				
				echo "
					<div class='formTitle' style='text-align: center; margin-top: 20px'>".$profileCatObj->get_info_filtered("name")."</div>
					<table class='profileTable' style='border-top-width: 0px'>
				";
				
				foreach($arrProfileOptions as $profileOptionID) {
					
					$profileOptionObj->select($profileOptionID);
					
					
					echo "
					
					<tr>
						<td class='profileLabel alternateBGColor' valign='top'>".$profileOptionObj->get_info_filtered("name").":</td>
						<td class='main' style='padding-left: 10px' valign='top'>".$member->getProfileValue($profileOptionID)."</td>
					</tr>
					
					";
					
				}
				
				echo "</table>";
			}
			
			
			$gameObj = new Game($mysqli);
			$gameStatObj = new Basic($mysqli, "gamestats", "gamestats_id");
			$dispGamesPlayed = "";
			$arrGames = $gameObj->getGameList();
			foreach($arrGames as $gameID) {
				if($member->playsGame($gameID)) {
					$gameObj->select($gameID);
					
					$dispGameStats = "";
					$arrGameStats = $gameObj->getAssociateIDs("ORDER BY ordernum");
					foreach($arrGameStats as $gameStatID) {
						$gameStatObj->select($gameStatID);
						if($gameStatObj->get_info_filtered("hidestat") == 0) {
							
							
							if($gameStatObj->get_info_filtered("stattype") == "calculate") {
								$dispGameStats .= "<b>".$gameStatObj->get_info_filtered("name").":</b> ".$gameObj->calcStat($gameStatID, $member)."<br>";
							}
							else {
								$dispGameStats .= "<b>".$gameStatObj->get_info_filtered("name").":</b> ".$member->getGameStatValue($gameStatID)."<br>";
							}
							
						}
					}
					
					$dispGamesPlayed .= "
						<tr>
							<td class='profileLabel alternateBGColor' valign='top'>
								".$gameObj->get_info_filtered("name").":
							</td>
							<td class='main' style='padding-left: 10px' valign='top'>
								".$dispGameStats."<br>						
							</td>
						</tr>
					";
				
				}
			}
			
			
			if($dispGamesPlayed != "") {
				
				echo "

					<div class='formTitle' style='text-align: center; margin-top: 20px'>Game Statistics</div>
					<table class='profileTable' style='border-top-width: 0px'>
					".$dispGamesPlayed."</table>";

			}
			
			
			$arrSquads = $member->getSquadList();
			$squadObj = new Basic($mysqli, "squads", "squad_id");
			$dispSquads = "";
			
			foreach($arrSquads as $squadID) {
				
				$squadObj->select($squadID);
				$squadInfo = $squadObj->get_info_filtered();
				
				if($squadInfo['logourl'] != "") {
					$dispSquads .= "<a href='".$MAIN_ROOT."squads/profile.php?sID=".$squadID."'><img src='".$squadInfo['logourl']."' class='squadLogo'></a><div class='dottedLine' style='width: 90%; margin-top: 20px; margin-bottom: 20px'></div>";
				}
				else {
					$dispSquads .= "<span class='largeFont'><b><a href='".$MAIN_ROOT."squads/profile.php?sID=".$squadID."'>".$squadInfo['name']."</a></b><div class='dottedLine' style='width: 90%; margin-top: 20px; margin-bottom: 20px'></div>";
				}
			}
			
			if($dispSquads != "") {
				
				echo "
					<div class='formTitle' style='text-align: center; margin-top: 20px'>Squads</div>
					<table class='profileTable' style='border-top-width: 0px'>
						<tr>
							<td class='main' align='center'>
								<p>
									".$dispSquads."
								</p>
							</td>
						</tr>
					</table>
				";
				
				
			}
			
			
			$arrMedals = $member->getMedalList(false, $websiteInfo['medalorder']);
			$medalObj = new Medal($mysqli);
			
			if(count($arrMedals) > 0) {
				
				foreach($arrMedals as $medalID) {
					
					$medalObj->select($medalID);
					$medalInfo = $medalObj->get_info_filtered();
					
					if($medalInfo['imagewidth'] == 0) {
						$imgInfo = getimagesize($medalObj->getLocalImageURL());
						$medalInfo['imagewidth'] = $imgInfo[0];
					}
					
					if($medalInfo['imageheight'] == 0) {
						$imgInfo = getimagesize($medalObj->getLocalImageURL());
						$medalInfo['imageheight'] = $imgInfo[1];
					}
					
					$result = $mysqli->query("SELECT * FROM ".$dbprefix."medals_members WHERE member_id = '".$memberInfo['member_id']."' AND medal_id = '".$medalInfo['medal_id']."'");
					$row = $result->fetch_assoc();
					
					$dispDateAwarded = "<b>Date Awarded:</b><br>".getPreciseTime($row['dateawarded']);
					
					$dispReason = "";
					if($row['reason'] != "") {
						$dispReason = "<br><br><b>Awarded for:</b><br>".filterText($row['reason']);	
					}
					
					$dispMedalMessage = "<b>".$medalInfo['name']."</b><br><br>".$dispDateAwarded.$dispReason;
					
					$tempArr = array("width" => $medalInfo['imagewidth'], "height" => $medalInfo['imageheight'], "url" => $medalInfo['imageurl'], "message" => $dispMedalMessage);
					$arrDispMedals[] = $tempArr;
				}
				
				
				
				
				$jsonMedals = json_encode($arrDispMedals);
				
				echo "
				<div class='formTitle' style='position: relative; text-align: center; margin-top: 20px'>Medals</div>
					<table class='profileTable' id='medalTable' style='border-top-width: 0px'>
						<tr>
							<td class='main' align='center'>
								<p>
									<div id='medalDiv'>
									
									</div>
								</p>
							</td>
						</tr>
					</table>
				
					
					<script type='text/javascript'>
						var arrMedals = ".$jsonMedals."
						var medalHTML = \"\";
						var divWidth = $('#medalTable').width();
						var countWidth = 0;
						var arrMessage = [];
						
						$(document).ready(function() {
							
							$.each(arrMedals, function(i, val) {
								
								countWidth += parseInt(val.width);
								if(countWidth > divWidth) {
									medalHTML += \"<br><br>\";
									countWidth = 0;
								}
								
								
								
								arrMessage[i] = val.message;
								//alert(arrMessage[i]);
								medalHTML += \"<img src='\"+val.url+\"' width='\"+val.width+\"' height='\"+val.height+\"' style='margin: 0px 20px' onmouseover='showToolTip(arrMessage[\"+i+\"])' onmouseout='hideToolTip()'>\";

							});
						
							$('#medalDiv').html(medalHTML);
							
						});
						
					</script>
				";
				
			}
			
		?>
	
	
	</div>
	
</div>

<?php

include($prevFolder."themes/".$THEME."/_footer.php");


?>