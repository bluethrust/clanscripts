<?php

// Check for Objects

if(!isset($consoleOptionObj)) {
	$consoleOptionObj = new ConsoleOption($mysqli);
}

if(!isset($memberObj)) {
	$memberObj = new Member($mysqli);
}



// SPECIAL MENU COMPONENTS


// Shoutbox
$arrShoutBoxIDs = array();

$manageNewsCID = $consoleOptionObj->findConsoleIDByName("Manage News");

$consoleOptionObj->select($manageNewsCID);

if($memberObj->hasAccess($consoleOptionObj)) {
	$shoutBoxEditLink = $MAIN_ROOT."members/console.php?cID=".$manageNewsCID."&newsID=";
	$shoutBoxDeleteLink = $MAIN_ROOT."members/include/news/include/deleteshoutpost.php";

}

$postShoutboxCID = $consoleOptionObj->findConsoleIDByName("Post in Shoutbox");

$consoleOptionObj->select($postShoutboxCID);

if($memberObj->hasAccess($consoleOptionObj)) {
	$shoutBoxPostLink = $MAIN_ROOT."members/include/news/include/postshoutbox.php";
}


$arrSpecialMenuItems = array();

// TOP PLAYERS

$arrSpecialMenuItems['top-players'] = "<a href='".$MAIN_ROOT."top-players/recruiters.php'><div class='menuLink'>Recruiters</div></a>";
$hpGameObj = new Game($mysqli);
$arrGames = $hpGameObj->getGameList();
foreach($arrGames as $gameID) {
	$hpGameObj->select($gameID);
	$arrSpecialMenuItems['top-players'] .= "<a href='".$MAIN_ROOT."top-players/game.php?gID=".$gameID."'><div class='menuLink'>".$hpGameObj->get_info_filtered("name")."</div></a>";
}


// NEWEST MEMBERS

$arrSpecialMenuItems['newmembers'] = "<div style='margin-left: 3px; margin-right: 3px; margin-top: 0px; margin-bottom: 0px'>";
$menuMemberObj = new Member($mysqli);
$menuMemberRankObj = new Rank($mysqli);
$counter = 0;
$result = $mysqli->query("SELECT member_id FROM ".$dbprefix."members WHERE rank_id != '1' ORDER BY datejoined DESC LIMIT 3");
while($row = $result->fetch_assoc()) {
	$addCSS = "";
	if($counter == 0) {
		$addCSS = " alternateBGColor";
		$counter = 1;
	}
	else {
		$counter = 0;	
	}
	$arrSpecialMenuItems['newmembers'] .= "<div class='dottedLine ".$addCSS."' style='padding: 5px 5px'>";
	$menuMemberObj->select($row['member_id']);
	$newestMemberInfo = $menuMemberObj->get_info_filtered();
	$checkURL = parse_url($newestMemberInfo['profilepic']);
	if((!isset($checkURL['scheme']) || $checkURL['scheme'] == "") && $newestMemberInfo['profilepic'] != "") {
		$newestMemberInfo['profilepic'] = $MAIN_ROOT.$newestMemberInfo['profilepic'];	
	}
	elseif($newestMemberInfo['profilepic'] == "") {
		$newestMemberInfo['profilepic'] = $MAIN_ROOT."themes/simpletech/images/defaultprofile.png";
	}
	
	$menuMemberRankObj->select($newestMemberInfo['rank_id']);
	$arrSpecialMenuItems['newmembers'] .= "<div style='float: left; width: 42px'><img src='".$newestMemberInfo['profilepic']."' style='width: 34px; height: 45px; border: solid black 1px'></div>";
	$arrSpecialMenuItems['newmembers'] .= "<div style='float: left; padding-left: 8px; width: 82px'><div style='font-size: 11px; overflow: hidden; text-overflow: ellipsis; width: 82px'>".$menuMemberObj->getMemberLink()."</div><div class='main' style='width: 82px; overflow: hidden; text-overflow: ellipsis'>".$menuMemberRankObj->get_info_filtered("name")."</div></div>";
	$arrSpecialMenuItems['newmembers'] .= "<div style='clear: both'></div>";
	$arrSpecialMenuItems['newmembers'] .= "</div>";
}
$arrSpecialMenuItems['newmembers'] .= "<div style='clear: both'></div></div>";


// LATEST FORUM ACTIVITY
$forumActivityObj = new ForumBoard($mysqli);
$arrSpecialMenuItems['forumactivity'] = "<div style='margin-left: 3px; margin-right: 3px; margin-top: 0px; margin-bottom: 0px'>";
$counter = 0;
$postCount = 0;

$result = $mysqli->query("SELECT * FROM ".$dbprefix."forum_post ORDER BY dateposted DESC");
while($row = $result->fetch_assoc()) {
	$blnShowPost = false;
	$forumActivityObj->objTopic->select($row['forumtopic_id']);
	$menuTopicInfo = $forumActivityObj->objTopic->get_info_filtered();
	$forumActivityObj->objPost->select($menuTopicInfo['forumpost_id']);
	$menuTopicPostInfo = $forumActivityObj->objPost->get_info_filtered();
	$forumActivityObj->select($menuTopicInfo['forumboard_id']);
	$menuBoardInfo = $forumActivityObj->get_info_filtered();
	if($menuBoardInfo['accesstype'] == 0) {
		$blnShowPost = true;
		$postCount++;
	}
	elseif($menuBoardInfo['accesstype'] == 1 && LOGGED_IN && $forumActivityObj->memberHasAccess($memberInfo)) {
		$blnShowPost = true;
		$postCount++;
	}
	
	
	if($blnShowPost) {
		$addCSS = "";
		if($counter == 0) {
			$addCSS = " alternateBGColor";
			$counter = 1;
		}
		else {
			$counter = 0;
		}
		$arrSpecialMenuItems['forumactivity'] .= "<div class='dottedLine ".$addCSS."' style='padding: 5px 5px'>";
		$menuMemberObj->select($row['member_id']);
		$forumMemberInfo = $menuMemberObj->get_info_filtered();
		$checkURL = parse_url($forumMemberInfo['avatar']);
		if((!isset($checkURL['scheme']) || $checkURL['scheme'] == "") && $forumMemberInfo['avatar'] != "") {
			$forumMemberInfo['avatar'] = $MAIN_ROOT.$forumMemberInfo['avatar'];
		}
		elseif($forumMemberInfo['avatar'] == "") {
			$forumMemberInfo['avatar'] = $MAIN_ROOT."themes/simpletech/images/defaultavatar.png";
		}
		
		$arrSpecialMenuItems['forumactivity'] .= "<div style='float: left; width: 35px'><img src='".$forumMemberInfo['avatar']."' style='width: 30px; height: 30px; border: solid black 1px'></div>";
		$arrSpecialMenuItems['forumactivity'] .= "<div class='main' style='float: left; width: 94px'><div style='font-size: 11px; overflow: hidden; white-space:nowrap; text-overflow: ellipsis; width:94px'><a href='".$MAIN_ROOT."forum/viewtopic.php?tID=".$row['forumtopic_id']."#".$row['forumpost_id']."'>".$menuTopicPostInfo['title']."</a></div><div style='overflow: hidden; white-space:nowrap; text-overflow: ellipsis; width:94px'>by ".$menuMemberObj->getMemberLink()."</div><span style='font-size: 10px'>".getPreciseTime($row['dateposted'])."</span></div>";
		$arrSpecialMenuItems['forumactivity'] .= "<div style='clear: both'></div></div>";
	}
	
	if($postCount == 3) {
		break;	
	}
}
$arrSpecialMenuItems['forumactivity'] .= "</div>";



define('SPECIAL_MENU_ITEM', serialize($arrSpecialMenuItems));


$LOGGED_IN = LOGGED_IN;

function dispMenu($intSectionNum) {
	global $MAIN_ROOT, $LOGGED_IN, $mysqli, $shoutBoxPostLink, $shoutBoxDeleteLink, $shoutBoxEditLink, $arrShoutBoxIDs, $websiteInfo, $arrLoginInfo;
	
	echo "<div id='menuSection_".$intSectionNum."'>";
	$menuCatObj = new MenuCategory($mysqli);
	$menuItemObj = new MenuItem($mysqli);
	$customPageObj = new Basic($mysqli, "custompages", "custompage_id");
	$customFormObj = new CustomForm($mysqli);
	$downloadCatObj = new Basic($mysqli, "downloadcategory", "downloadcategory_id");
	
	if($LOGGED_IN) {
		$intMenuAccessType = 1;
	}
	else {
		$intMenuAccessType = 2;
	}
	
	$arrMenuCategories = $menuCatObj->getCategories($intSectionNum, $intMenuAccessType);
	
	$topMenuCounter = 0;
	
	foreach($arrMenuCategories as $menuCatID) {
				
		$menuCatObj->select($menuCatID);
		$menuCatInfo = $menuCatObj->get_info();
		$arrMenuItems = $menuItemObj->getItems($menuCatInfo['menucategory_id'], $intMenuAccessType);
	
		$addDropdownMenu = (count($arrMenuItems) > 0) ? " data-showmenu='topMenu_".$topMenuCounter."' " : "";

		if($intSectionNum == 0 || $intSectionNum == 1) {
			echo "<div class='sideMenuInnerDiv'>";
		}
		elseif($intSectionNum == 2) {
			echo "<div class='topMenuSection' ".$addDropdownMenu." data-hoverimg='".str_replace(" ","-",$menuCatInfo['name'])."'>";
		}
		
		
		if($menuCatInfo['headertype'] == "image") {
			echo "<img src='".$MAIN_ROOT.$menuCatInfo['headercode']."' class='menuHeaderImg'>";
		}
		else {
			
			$menuCatInfo['headercode'] = str_replace("[MAIN_ROOT]", $MAIN_ROOT, $menuCatInfo['headercode']);
			$menuCatInfo['headercode'] = str_replace("[MEMBER_ID]", $arrLoginInfo['memberID'], $menuCatInfo['headercode']);
			$menuCatInfo['headercode'] = str_replace("[MEMBERUSERNAME]", $arrLoginInfo['memberUsername'], $menuCatInfo['headercode']);
			$menuCatInfo['headercode'] = str_replace("[MEMBERRANK]", $arrLoginInfo['memberRank'], $menuCatInfo['headercode']);
			$menuCatInfo['headercode'] = str_replace("[PMLINK]", $arrLoginInfo['pmLink'], $menuCatInfo['headercode']);
			$menuCatInfo['headercode'] = str_replace("[FORUMLINK]", $websiteInfo['forumurl'], $menuCatInfo['headercode']);
			
			echo $menuCatInfo['headercode'];
		}

		if($intSectionNum == 2 && $addDropdownMenu != "") {
			echo "<div class='topMenuLinksDiv' id='topMenu_".$topMenuCounter."'>";
			$topMenuCounter++;
		}
		
		
		foreach($arrMenuItems as $menuItemID) {
			$menuItemObj->select($menuItemID);
			$menuItemInfo = $menuItemObj->get_info();
	
			$menuItemInfo['itemtype'] = ($menuItemInfo['itemtype'] == "customcode" || $menuItemInfo['itemtype'] == "customformat") ? "customblock" : $menuItemInfo['itemtype'];
			
			switch($menuItemInfo['itemtype']) {
				case "link":
					$menuItemObj->objLink->select($menuItemInfo['itemtype_id']);
					$menuLinkInfo = $menuItemObj->objLink->get_info();
					$checkURL = parse_url($menuLinkInfo['link']);
					if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
						$menuLinkInfo['link'] = $MAIN_ROOT.$menuLinkInfo['link'];
					}
					
					if($intSectionNum == 2) {
						echo "<a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'><div class='menuLink' style='text-align: ".$menuLinkInfo['textalign']."'>".$menuLinkInfo['prefix'].$menuItemInfo['name']."</div></a>";
					}
					else {
						echo "<a href='".$menuLinkInfo['link']."' target='".$menuLinkInfo['linktarget']."'>".$menuLinkInfo['prefix'].$menuItemInfo['name']."</a><br>";		
					}
					
					break;
				case "top-players":
					$dispTopPlayers = unserialize(SPECIAL_MENU_ITEM);
					echo $dispTopPlayers['top-players'];
					break;
				case "customform":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$menuCustomFormInfo = $menuItemObj->objCustomPage->get_info();
					$customFormObj->select($menuCustomFormInfo['custompage_id']);
					echo "<a href='".$MAIN_ROOT."customform.php?pID=".$menuCustomFormInfo['custompage_id']."' target='".$menuCustomFormInfo['linktarget']."'><div class='menuLink' style='text-align: ".$menuCustomFormInfo['textalign']."'>".$menuCustomFormInfo['prefix'].$customFormObj->get_info_filtered("name")."</div></a>";
					break;
				case "custompage":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$menuCustomPageInfo = $menuItemObj->objCustomPage->get_info();
					$customPageObj->select($menuCustomPageInfo['custompage_id']);
					echo "<a href='".$MAIN_ROOT."custompage.php?pID=".$menuCustomPageInfo['custompage_id']."' target='".$menuCustomPageInfo['linktarget']."'><div class='menuLink' style='text-align: ".$menuCustomPageInfo['textalign']."'>".$menuCustomPageInfo['prefix'].$customPageObj->get_info_filtered("pagename")."</div></a>";
					break;
				case "downloads":
					$menuItemObj->objCustomPage->select($menuItemInfo['itemtype_id']);
					$menuDownloadLinkInfo = $menuItemObj->objCustomPage->get_info();
					$downloadCatObj->select($menuDownloadLinkInfo['custompage_id']);
					echo "<a href='".$MAIN_ROOT."downloads/index.php?catID=".$menuDownloadLinkInfo['custompage_id']."' target='".$menuDownloadLinkInfo['linktarget']."'><div class='menuLink' style='text-align: ".$menuDownloadLinkInfo['textalign']."'>".$menuDownloadLinkInfo['prefix'].$downloadCatObj->get_info_filtered("name")."</div></a>";
					break;
				case "customblock":
					$menuItemObj->objCustomBlock->select($menuItemInfo['itemtype_id']);
					$menuCustomBlockInfo = $menuItemObj->objCustomBlock->get_info();
					
					$menuCustomBlockInfo['code'] = str_replace("[MAIN_ROOT]", $MAIN_ROOT, $menuCustomBlockInfo['code']);
					$menuCustomBlockInfo['code'] = str_replace("[MEMBER_ID]", $arrLoginInfo['memberID'], $menuCustomBlockInfo['code']);
					$menuCustomBlockInfo['code'] = str_replace("[MEMBERUSERNAME]", $arrLoginInfo['memberUsername'], $menuCustomBlockInfo['code']);
					$menuCustomBlockInfo['code'] = str_replace("[MEMBERRANK]", $arrLoginInfo['memberRank'], $menuCustomBlockInfo['code']);
					$menuCustomBlockInfo['code'] = str_replace("[PMLINK]", $arrLoginInfo['pmLink'], $menuCustomBlockInfo['code']);
					$menuCustomBlockInfo['code'] = str_replace("[FORUMLINK]", $websiteInfo['forumurl'], $menuCustomBlockInfo['code']);
					
					echo $menuCustomBlockInfo['code'];
					break;
				case "image":
					$menuItemObj->objImage->select($menuItemInfo['itemtype_id']);
					$menuImageInfo = $menuItemObj->objImage->get_info();
					$checkURL = parse_url($menuItemInfo['imageurl']);
					if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
						$menuImageInfo['imageurl'] = $MAIN_ROOT.$menuImageInfo['imageurl'];
					}
	
					$dispSetWidth = "";
					if($menuImageInfo['width'] != 0) {
						$dispSetWidth = "width: ".$menuImageInfo['width']."px; ";	
					}
					
					$dispSetHeight = "";
					if($menuImageInfo['height'] != 0) {
						$dispSetHeight = "height: ".$menuImageInfo['height']."px; ";
					}
					
					echo "<div style='text-align: ".$menuImageInfo['imagealign']."; display: inline-block'>";
					if($menuImageInfo['link'] != "") {
	
						$checkURL = parse_url($menuImageInfo['link']);
						if(!isset($checkURL['scheme']) || $checkURL['scheme'] = "") {
							$menuImageInfo['link'] = $MAIN_ROOT.$menuImageInfo['link'];
						}
	
						echo "<a href='".$menuImageInfo['link']."' target='".$menuImageInfo['linktarget']."'><img src='".$menuImageInfo['imageurl']."' style='".$dispSetWidth.$dispSetHeight."' title='".$menuItemInfo['name']."'></a>";
					}
					else {
						echo "<img src='".$menuImageInfo['imageurl']."' title='".$menuItemInfo['name']."' style='".$dispSetWidth.$dispSetHeight."'>";
					}
	
					echo "</div>";
					break;
				case "shoutbox":
					$menuItemObj->objShoutbox->select($menuItemInfo['itemtype_id']);
					$menuShoutboxInfo = $menuItemObj->objShoutbox->get_info();
					if($menuShoutboxInfo['width'] == 0) {
						$menuShoutboxInfo['width'] = "155";
					}
	
					$blnShoutboxWidthPercent = false;
					if($menuShoutboxInfo['percentwidth'] == 1) {
						$blnShoutboxWidthPercent = true;
					}
					
					if($menuShoutboxInfo['height'] == 0) {
						$menuShoutboxInfo['height'] = "350";
					}
	
	
					$blnShoutboxHeightPercent = false;
					if($menuShoutboxInfo['percentheight'] == 1) {
						$blnShoutboxHeightPercent = true;
					}
	
					$mainShoutboxObj = new Shoutbox($mysqli, "news", "news_id");
					$newShoutBoxID = uniqid("mainShoutBox_");
					$arrShoutBoxIDs[] = $newShoutBoxID;
					$mainShoutboxObj->strDivID = $newShoutBoxID;
					$mainShoutboxObj->strEditLink = $shoutBoxEditLink;
					$mainShoutboxObj->strDeleteLink = $shoutBoxDeleteLink;
					$mainShoutboxObj->strPostLink = $shoutBoxPostLink;
	
					echo $mainShoutboxObj->dispShoutbox($menuShoutboxInfo['width'], $menuShoutboxInfo['height'], $blnShoutboxWidthPercent, $menuShoutboxInfo['textboxwidth'], $blnShoutboxHeightPercent);
					
					echo "
					
						<script type='text/javascript'>
						
							$(document).ready(function() {
									$('#".$newShoutBoxID."').animate({
										scrollTop:$('#".$newShoutBoxID."')[0].scrollHeight
									}, 1000);
								
					
								$('#".$newShoutBoxID."_message').keypress(function(eventObj) {
									if(eventObj.which == 13) {
										if($('#".$newShoutBoxID."_message').val() != \"\") {
											$('#".$newShoutBoxID."_postShoutbox input[type=button]').click();
										}
										return false;
									}
									else {
										return true;
									}
								});					
							
							
							});
						
						</script>
					
					";
					
					
					break;
				case "newestmembers":
					$dispNewMembers = unserialize(SPECIAL_MENU_ITEM);
					echo $dispNewMembers['newmembers'];
					break;
				case "forumactivity":
					$dispNewMembers = unserialize(SPECIAL_MENU_ITEM);
					echo $dispNewMembers['forumactivity'];
					break;
				case "login":
					echo constant("LOGIN_BOX");
					break;
			}
	
	
		}
		
		
		if($intSectionNum == 2 && $addDropdownMenu != "") {
			echo "</div>";	
		}
		
		if($intSectionNum == 0 || $intSectionNum == 1 || $intSectionNum == 2) {
			echo "</div>";
		}
		
	}
	
	echo "</div>";
}


$memberObj = "";
$rankObj = "";
$memberInfo = "";
$rankInfo = "";
?>