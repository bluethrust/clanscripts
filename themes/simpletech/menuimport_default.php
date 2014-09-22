<?php

include("../../_setup.php");
include("../../classes/member.php");

$member = new Member($mysqli);
$consoleObj = new ConsoleOption($mysqli);

$websiteSettingsCID = $consoleObj->findConsoleIDByName("Website Settings");
$consoleObj->select($websiteSettingsCID);

if(!isset($_SESSION['btUsername']) || !isset($_SESSION['btPassword']) || !$member->select($_SESSION['btUsername']) || ($member->select($_SESSION['btUsername']) && !$member->authorizeLogin($_SESSION['btPassword'])) || ($member->select($_SESSION['btUsername']) && $member->authorizeLogin($_SESSION['btPassword']) && !$member->hasAccess($consoleObj))) {
	header("HTTP/1.0 404 Not Found");
	exit();
}


$menuSQL = "
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES(7, 60, 'code', '<div style=''display: inline-block''><a href=''[MAIN_ROOT]signup.php''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''signUpIMG''></a></div>');

INSERT INTO `menuitem_custompage` (`menucustompage_id`, `menuitem_id`, `custompage_id`, `prefix`, `linktarget`, `textalign`) VALUES(3, 19, 12, '', '', 'left');
INSERT INTO `menuitem_custompage` (`menucustompage_id`, `menuitem_id`, `custompage_id`, `prefix`, `linktarget`, `textalign`) VALUES(2, 18, 11, '', '', 'left');

INSERT INTO `menuitem_image` (`menuimage_id`, `menuitem_id`, `imageurl`, `width`, `height`, `link`, `linktarget`, `imagealign`) VALUES(1, 59, 'images/menu/menuitem_5225505f8c4ee.png', 0, 0, '', '', 'left');

INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(1, 1, 'index.php', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(3, 8, 'news', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(4, 9, 'members.php', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(5, 10, 'ranks.php', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(6, 11, 'squads', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(7, 12, 'tournaments', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(8, 13, 'events', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(9, 14, 'medals.php', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(10, 15, 'diplomacy', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(11, 16, 'diplomacy/request.php', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(12, 20, 'forum', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(13, 21, 'signup.php', '', '', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES(29, 45, 'forgotpassword.php', '', '', 'left');

INSERT INTO `menuitem_shoutbox` (`menushoutbox_id`, `menuitem_id`, `width`, `height`, `percentwidth`, `percentheight`, `textboxwidth`) VALUES(3, 58, 0, 0, 0, 0, 0);

INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(3, 2, 'mainMenuIMG', 1, 'customcode', '<a href=''[MAIN_ROOT]''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''mainMenuIMG'' id=''mainMenuIMG''></a>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(2, 2, 'topPlayersIMG', 2, 'customcode', '<img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''topPlayersIMG'' id=''topPlayersIMG''>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(14, 1, 'Forum Activity', 1, 'customcode', '<p style=''padding: 0px; margin: 0px'' align=''center''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''menuForumActivityIMG''></p>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(9, 0, 'Shoutbox', 1, 'customcode', '<p style=''padding: 0px; margin: 0px'' align=''center''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''menuShoutboxIMG''></p>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(15, 1, 'New Members', 2, 'customcode', '<p style=''padding: 0px; margin: 0px'' align=''center''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''menuNewMembersIMG''></p>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(16, 2, 'newsMenuIMG', 3, 'customcode', '<a href=''[MAIN_ROOT]news''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''newsMenuIMG'' id=''newsMenuIMG''></a>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(17, 2, 'membersMenuIMG', 4, 'customcode', '<a href=''[MAIN_ROOT]members.php''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''membersMenuIMG'' id=''membersMenuIMG''></a>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(18, 2, 'forumMenuIMG', 5, 'customcode', '<a href=''[MAIN_ROOT]forum''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''forumMenuIMG'' id=''forumMenuIMG''></a>', 0, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(19, 2, 'logInMenuIMG', 6, 'customcode', '<img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''logInMenuIMG'' id=''logInMenuIMG''>', 2, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(20, 2, 'myAccountMenuIMG', 7, 'customcode', '<div style=''position: relative''>\r\n<a href=''[MAIN_ROOT]members''><img src=''[MAIN_ROOT]themes/simpletech/images/transparent.png'' class=''myAccountMenuIMG'' id=''myAccountMenuIMG''></a>\r\n<div class=''loggedInAlert'' id=''loggedInAlert''></div>\r\n</div>', 1, 0);
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES(21, 3, 'LoggedIn/Out', 1, 'customcode', '', 0, 0);

INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(3, 2, 'Top Players Links', 'top-players', 0, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(1, 3, 'Home', 'link', 1, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(8, 3, 'News', 'link', 3, 0, 0, 2);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(9, 3, 'Members', 'link', 4, 0, 0, 3);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(10, 3, 'Ranks', 'link', 5, 0, 0, 4);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(11, 3, 'Squads', 'link', 6, 0, 0, 5);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(12, 3, 'Tournaments', 'link', 7, 0, 0, 6);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(13, 3, 'Events', 'link', 8, 0, 0, 7);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(14, 3, 'Medals', 'link', 9, 0, 0, 8);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(15, 3, 'Diplomacy', 'link', 10, 0, 0, 9);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(16, 3, 'Req. Diplomacy', 'link', 11, 0, 0, 10);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(19, 3, 'Rules', 'custompage', 3, 0, 0, 11);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(18, 3, 'History', 'custompage', 2, 0, 0, 12);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(20, 3, 'Forum', 'link', 12, 0, 0, 13);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(21, 3, 'Sign Up', 'link', 13, 2, 0, 14);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(45, 3, 'Forgot Password', 'link', 29, 2, 0, 15);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(56, 14, 'Forum Activity', 'forumactivity', 0, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(57, 15, 'Newest Members', 'newestmembers', 0, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(58, 9, 'Shoutbox', 'shoutbox', 3, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(59, 21, 'Logged In', 'image', 1, 1, 0, 2);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(60, 21, 'Sign Up', 'customcode', 7, 2, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(61, 20, 'Logged In', 'login', 0, 0, 0, 1);
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES(62, 19, 'Log In', 'login', 0, 2, 0, 1);

";


$menuSQL = str_replace("INSERT INTO `", "INSERT INTO `".$dbprefix, $menuSQL);


$emptyMenusSQL = "TRUNCATE `".$dbprefix."menuitem_customblock`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_custompage`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_image`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_link`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menuitem_shoutbox`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menu_category`;";
$emptyMenusSQL .= "TRUNCATE `".$dbprefix."menu_item`;";


$fullSQL = $emptyMenusSQL.$menuSQL;

if($mysqli->multi_query($fullSQL)) {


	do {
		if($result = $mysqli->store_result()) {
			$result->free();
		}
	}
	while($mysqli->next_result());
	
	echo "Menus restored to default!";
	
	
}

?>

