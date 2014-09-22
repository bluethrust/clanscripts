INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('3', '0', 'Main Menu', '1', 'customcode', '<div class=\'navigationMenu\'></div>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('2', '0', 'Top Players', '2', 'customcode', '<div class=\'topplayersMenu\'></div>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('16', '0', 'Poll', '3', 'customcode', '<img src=\'[MAIN_ROOT]themes/bluenova/images/layout/poll.png\'>', '0', '1');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('14', '0', 'Forum Activity', '4', 'customcode', '<div class=\'forumActivityMenu\'></div>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('9', '1', 'Shoutbox', '1', 'customcode', '<div class=\'shoutboxMenu\'></div>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('15', '1', 'New Members', '2', 'customcode', '<div class=\'newMembersMenu\'></div>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('12', '2', 'Login', '1', 'customcode', '', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('13', '3', 'Quick Links', '1', 'customcode', '', '0', '0');

INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('3', '2', 'Top Players Links', 'top-players', '0', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('1', '3', 'Home', 'link', '1', '0', '0', '2');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('8', '3', 'News', 'link', '3', '0', '0', '3');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('9', '3', 'Members', 'link', '4', '0', '0', '4');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('10', '3', 'Ranks', 'link', '5', '0', '0', '5');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('11', '3', 'Squads', 'link', '6', '0', '0', '6');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('12', '3', 'Tournaments', 'link', '7', '0', '0', '7');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('13', '3', 'Events', 'link', '8', '0', '0', '8');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('14', '3', 'Medals', 'link', '9', '0', '0', '9');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('15', '3', 'Diplomacy', 'link', '10', '0', '0', '10');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('16', '3', 'Diplomacy Request', 'link', '11', '0', '0', '11');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('19', '3', 'Rules', 'custompage', '3', '0', '0', '12');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('18', '3', 'History', 'custompage', '2', '0', '0', '13');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('20', '3', 'Forum', 'link', '12', '0', '0', '14');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('21', '3', 'Sign Up', 'link', '13', '2', '0', '15');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('45', '3', 'Forgot Password', 'link', '29', '2', '0', '16');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('47', '9', 'Shoutbox', 'shoutbox', '2', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('46', '12', 'Login', 'login', '0', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('50', '13', 'News', 'customcode', '1', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('51', '13', 'Members', 'customcode', '2', '0', '0', '2');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('52', '13', 'Tournaments', 'customcode', '3', '0', '0', '3');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('53', '13', 'Squads', 'customcode', '4', '0', '0', '4');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('54', '13', 'Events', 'customcode', '5', '0', '0', '5');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('55', '13', 'Forum', 'customcode', '6', '0', '0', '6');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('56', '14', 'Forum Activity', 'forumactivity', '0', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('57', '15', 'Newest Members', 'newestmembers', '0', '0', '0', '1');

INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('1', '50', 'code', '<a href=\'[MAIN_ROOT]news\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'newsButton\' alt=\'News\'></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('2', '51', 'code', '<a href=\'[MAIN_ROOT]members.php\'><img class=\'membersButton\' src=\'[MAIN_ROOT]images/transparent.png\' alt=\'Members\'></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('3', '52', 'code', '<a href=\'[MAIN_ROOT]tournaments\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'tournamentsButton\' alt=\'Tournaments\'></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('4', '53', 'code', '<a href=\'[MAIN_ROOT]squads\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'squadsButton\' alt=\'Squads\'></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('5', '54', 'code', '<a href=\'[MAIN_ROOT]events\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'eventsButton\' alt=\'Events\'></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('6', '55', 'code', '<a href=\'[MAIN_ROOT]forum\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'forumButton\' alt=\'Forum\'></a>');

INSERT INTO `menuitem_custompage` (`menucustompage_id`, `menuitem_id`, `custompage_id`, `prefix`, `linktarget`, `textalign`) VALUES ('3', '19', '12', '<b>&middot;</b> ', '', 'left');
INSERT INTO `menuitem_custompage` (`menucustompage_id`, `menuitem_id`, `custompage_id`, `prefix`, `linktarget`, `textalign`) VALUES ('2', '18', '11', '<b>&middot;</b> ', '', 'left');


INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('1', '1', 'index.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('3', '8', 'news', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('4', '9', 'members.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('5', '10', 'ranks.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('6', '11', 'squads', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('7', '12', 'tournaments', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('8', '13', 'events', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('9', '14', 'medals.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('10', '15', 'diplomacy', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('11', '16', 'diplomacy/request.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('12', '20', 'forum', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('13', '21', 'signup.php', '', '<b>&middot;</b> ', 'left');
INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES ('29', '45', 'forgotpassword.php', '', '<b>&middot;</b> ', 'left');

INSERT INTO `menuitem_shoutbox` (`menushoutbox_id`, `menuitem_id`, `width`, `height`, `percentwidth`, `percentheight`, `textboxwidth`) VALUES ('2', '47', '0', '0', '0', '0', '0');
