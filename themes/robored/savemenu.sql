INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('3', '0', 'Main Menu', '1', 'customcode', '<img src=\'[MAIN_ROOT]images/transparent.png\' class=\'mainMenuIMG\'>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('2', '0', 'Top Players', '2', 'customcode', '<img src=\'[MAIN_ROOT]images/transparent.png\' class=\'topPlayersIMG\'>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('18', '0', 'Poll', '3', 'customcode', '<img src=\'[MAIN_ROOT]themes/robored/images/layout/poll.png\'>', '0', '1');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('14', '0', 'Forum Activity', '4', 'customcode', '<img src=\'[MAIN_ROOT]images/transparent.png\' class=\'forumActivityIMG\'>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('16', '1', 'Login', '1', 'customcode', '<img src=\'[MAIN_ROOT]images/transparent.png\' class=\'logInIMG\'>', '2', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('12', '1', 'Logged In', '2', 'customcode', '<img src=\'[MAIN_ROOT]images/transparent.png\' class=\'loggedInIMG\'>', '1', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('9', '1', 'Shoutbox', '3', 'customcode', '<img src=\'[MAIN_ROOT]images/transparent.png\' class=\'shoutBoxIMG\'>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('15', '1', 'New Members', '4', 'customcode', '<img src=\'[MAIN_ROOT]images/transparent.png\' class=\'newMembersIMG\'>', '0', '0');
INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES ('17', '2', 'Quick Links', '1', 'customcode', '', '0', '0');

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
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('56', '14', 'Forum Activity', 'forumactivity', '0', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('57', '15', 'Newest Members', 'newestmembers', '0', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('59', '16', 'Log In', 'login', '0', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('60', '17', 'News', 'customcode', '1', '0', '0', '1');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('61', '17', 'Members', 'customcode', '2', '0', '0', '2');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('62', '17', 'Tournaments', 'customcode', '3', '0', '0', '3');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('63', '17', 'Squads', 'customcode', '4', '0', '0', '4');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('64', '17', 'Events', 'customcode', '5', '0', '0', '5');
INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES ('65', '17', 'Forum', 'customcode', '6', '0', '0', '6');

INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('1', '60', 'code', '<a href=\'[MAIN_ROOT]news\'><div class=\'menuBarItem\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'menuNewsIMG\'></div></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('2', '61', 'code', '<a href=\'[MAIN_ROOT]members.php\'><div class=\'menuBarItem\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'menuMembersIMG\'></div></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('3', '62', 'code', '<a href=\'[MAIN_ROOT]tournaments\'><div class=\'menuBarItem\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'menuTournamentsIMG\'></div></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('4', '63', 'code', '<a href=\'[MAIN_ROOT]squads\'><div class=\'menuBarItem\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'menuSquadsIMG\'></div></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('5', '64', 'code', '<a href=\'[MAIN_ROOT]events\'><div class=\'menuBarItem\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'menuEventsIMG\'></div></a>');
INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES ('6', '65', 'code', '<a href=\'[FORUMLINK]\'><div class=\'menuBarItem\'><img src=\'[MAIN_ROOT]images/transparent.png\' class=\'menuForumIMG\'></div></a>');

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
