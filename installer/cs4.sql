CREATE TABLE IF NOT EXISTS `app_components` (
  `appcomponent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `componenttype` varchar(25) NOT NULL,
  `required` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`appcomponent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=202 ;

INSERT INTO `app_components` (`appcomponent_id`, `name`, `componenttype`, `required`, `ordernum`) VALUES(1, 'Main Game', 'select', 0, 2);
INSERT INTO `app_components` (`appcomponent_id`, `name`, `componenttype`, `required`, `ordernum`) VALUES(10, 'Real Name', 'input', 1, 5);
INSERT INTO `app_components` (`appcomponent_id`, `name`, `componenttype`, `required`, `ordernum`) VALUES(8, 'About Yourself', 'largeinput', 0, 4);
INSERT INTO `app_components` (`appcomponent_id`, `name`, `componenttype`, `required`, `ordernum`) VALUES(9, 'Games Played', 'multiselect', 0, 1);
INSERT INTO `app_components` (`appcomponent_id`, `name`, `componenttype`, `required`, `ordernum`) VALUES(11, 'Country', 'select', 0, 3);

CREATE TABLE IF NOT EXISTS `app_selectvalues` (
  `appselectvalue_id` int(11) NOT NULL AUTO_INCREMENT,
  `appcomponent_id` int(11) NOT NULL,
  `componentvalue` varchar(255) NOT NULL,
  PRIMARY KEY (`appselectvalue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(1, 4, 'Haha');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(2, 4, 'No');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(3, 4, 'Yes');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(4, 0, 'test');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(11, 1, 'Minecraft');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(10, 1, 'Call of Duty');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(12, 1, 'Starcraft');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(13, 1, 'WOW');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(14, 9, 'Call Of Duty');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(15, 9, 'Starcraft');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(16, 9, 'WOW');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(17, 11, 'Canada');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(18, 11, 'China');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(19, 11, 'England');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(20, 11, 'Mexico');
INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES(21, 11, 'USA');

CREATE TABLE IF NOT EXISTS `app_values` (
  `appvalue_id` int(11) NOT NULL AUTO_INCREMENT,
  `appcomponent_id` int(11) NOT NULL,
  `memberapp_id` int(11) NOT NULL,
  `appvalue` text NOT NULL,
  PRIMARY KEY (`appvalue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `console` (
  `console_id` int(11) NOT NULL AUTO_INCREMENT,
  `consolecategory_id` int(11) NOT NULL,
  `pagetitle` varchar(255) NOT NULL,
  `filename` text NOT NULL,
  `sortnum` int(11) NOT NULL,
  `adminoption` int(11) NOT NULL,
  `sep` int(11) NOT NULL,
  `defaultconsole` int(11) NOT NULL,
  `hide` int(1) NOT NULL,
  PRIMARY KEY (`console_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(1, 1, 'Add New Rank', 'admin/addrank.php', 1, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(2, 1, 'Manage Ranks', 'admin/manageranks.php', 2, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(5, 2, 'Add Member', 'membermanagement/addmember.php', 1, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(6, 2, 'Promote Member', 'membermanagement/promotemember.php', 6, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(7, 2, 'Demote Member', 'membermanagement/demotemember.php', 7, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(8, 2, 'Set Member''s Rank', 'membermanagement/setrank.php', 8, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(9, 1, 'Add New Medal', 'admin/addmedal.php', 6, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(10, 1, 'Manage Medals', 'admin/managemedals.php', 7, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(11, 3, 'Edit Profile', 'editprofile.php', 2, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(12, 1, '-separator-', '', 28, 1, 1, 0, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(20, 2, 'Disable a Member', 'membermanagement/disablemember.php', 2, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(14, 1, 'Add Games Played', 'admin/addgamesplayed.php', 9, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(15, 1, 'Manage Games Played', 'admin/managegamesplayed.php', 10, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(19, 1, '-separator-', '', 8, 1, 1, 0, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(17, 1, 'Add Custom Pages', 'admin/addcustompages.php', 12, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(18, 1, 'Manage Custom Pages', 'admin/managecustompages.php', 13, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(21, 2, 'Delete Member', 'membermanagement/deletemember.php', 4, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(22, 1, 'Add New Rank Category', 'admin/addrankcategory.php', 3, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(23, 1, 'Manage Rank Categories', 'admin/managerankcategories.php', 4, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(24, 1, '-separator-', '', 5, 1, 1, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(25, 1, 'Add Console Option', 'admin/addconsoleoption.php', 16, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(33, 1, 'Manage Console Categories', 'admin/manageconsolecategories.php', 19, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(32, 1, 'Add New Console Category', 'admin/addconsolecategory.php', 18, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(31, 1, 'Manage Console Options', 'admin/manageconsole.php', 17, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(65, 1, 'Add Profile Option', 'admin/addprofileoption.php', 24, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(51, 1, '-separator-', '', 11, 1, 1, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(52, 1, '-separator-', '', 14, 1, 1, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(54, 1, '-separator-', '', 20, 1, 1, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(55, 1, 'Add Download Category', 'admin/adddownloadcategory.php', 21, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(56, 1, 'Manage Download Categories', 'admin/managedownloadcategories.php', 22, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(62, 1, 'Website Settings', 'admin/sitesettings.php', 30, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(61, 1, 'Modify Current Theme', 'admin/edittheme.php', 29, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(60, 1, '-separator-', '', 23, 1, 1, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(63, 1, 'Add Profile Category', 'admin/addprofilecategory.php', 26, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(64, 1, 'Manage Profile Categories', 'admin/manageprofilecategories.php', 27, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(66, 1, 'Manage Profile Options', 'admin/manageprofileoptions.php', 25, 1, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(83, 9, 'Manage News', 'news/managenews.php', 2, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(82, 9, 'Post News', 'news/postnews.php', 1, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(70, 2, '-separator-', '', 5, 0, 1, 0, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(71, 7, 'Create a Squad', 'squads/create.php', 1, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(72, 7, 'View Your Squads', 'squads/index.php', 4, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(73, 7, 'Apply to a Squad', 'squads/apply.php', 2, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(74, 7, 'View Squad Invitations', 'squads/viewinvites.php', 3, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(75, 8, 'Create a Tournament', 'tournaments/create.php', 1, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(76, 8, 'Manage Tournaments', 'tournaments/manage.php', 2, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(77, 8, 'Manage My Matches', 'tournaments/managematches.php', 3, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(78, 3, 'Private Messages', 'privatemessages/index.php', 3, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(84, 9, 'View Private News', 'news/privatenews.php', 3, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(80, 3, 'Edit My Game Stats', 'editmygamestats.php', 1, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(85, 9, 'Post Comment', 'news/postcomment.php', 0, 0, 0, 1, 1);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(86, 2, 'Undisable Member', 'membermanagement/undisablemember.php', 3, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(87, 10, 'Award Medal', 'medals/awardmedal.php', 1, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(88, 10, 'Revoke Medal', 'medals/revokemedal.php', 2, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(89, 3, 'Change Password', 'changepassword.php', 4, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(90, 2, '-separator-', '', 9, 0, 1, 0, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(91, 2, 'Reset Member Password', 'membermanagement/resetpassword.php', 13, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(92, 3, 'View Logs', 'logs.php', 5, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(93, 9, 'Post in Shoutbox', 'news/postshoutbox.php', 0, 0, 0, 1, 1);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(96, 2, 'Registration Options', 'membermanagement/registrationoptions.php', 10, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(97, 2, 'Member Application', 'membermanagement/memberapplication.php', 11, 0, 0, 1, 0);
INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES(98, 2, 'View Member Applications', 'membermanagement/viewapplications.php', 12, 0, 0, 1, 0);

CREATE TABLE IF NOT EXISTS `consolecategory` (
  `consolecategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `adminoption` int(1) NOT NULL,
  PRIMARY KEY (`consolecategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES(1, 'Administrator Options', 0, 1);
INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES(2, 'Member Management', 4, 0);
INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES(3, 'Account Options', 6, 0);
INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES(9, 'News', 5, 0);
INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES(7, 'Squads', 2, 0);
INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES(8, 'Tournaments', 1, 0);
INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES(10, 'Medals', 3, 0);

CREATE TABLE IF NOT EXISTS `console_members` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `console_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `allowdeny` int(1) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `custompages` (
  `custompage_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) NOT NULL,
  `pageinfo` text NOT NULL,
  PRIMARY KEY (`custompage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

INSERT INTO `custompages` (`custompage_id`, `pagename`, `pageinfo`) VALUES(11, 'History', '<p style="text-align: center;">This is the clan history.</p>\n<p style="text-align: center;">&nbsp;</p>\n<p style="text-align: center;">This is actually just a custom page...</p>');
INSERT INTO `custompages` (`custompage_id`, `pagename`, `pageinfo`) VALUES(12, 'Rules', '<p style="text-align: center;">This is the clan rules page.</p>\n<p style="text-align: center;">&nbsp;</p>\n<p style="text-align: center;">This is actually just a custom page...</p>');

CREATE TABLE IF NOT EXISTS `downloadcategory` (
  `downloadcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`downloadcategory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `downloads` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `downloadcategory_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateuploaded` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `downloadcount` int(11) NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `download_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `downloadcategory_id` int(11) NOT NULL,
  `extension` varchar(255) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `failban` (
  `failban_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  PRIMARY KEY (`failban_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `gamesplayed` (
  `gamesplayed_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `imageurl` text NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`gamesplayed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `gamesplayed` (`gamesplayed_id`, `name`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`) VALUES(8, 'Call of Duty', '/cs4git/images/gamesplayed/game_508dc503812e7.png', 60, 15, 2);
INSERT INTO `gamesplayed` (`gamesplayed_id`, `name`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`) VALUES(2, 'Starcraft 2', '/cs4/images/gamesplayed/game_4f9dc59c97b06.png', 48, 48, 5);
INSERT INTO `gamesplayed` (`gamesplayed_id`, `name`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`) VALUES(5, 'Starcraft', '/cs4/images/gamesplayed/game_4fc70ad0a7ab8.gif', 28, 14, 3);
INSERT INTO `gamesplayed` (`gamesplayed_id`, `name`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`) VALUES(7, 'Minecraft', '/cs4git/images/gamesplayed/game_501f58d5683e4.png', 32, 32, 1);
INSERT INTO `gamesplayed` (`gamesplayed_id`, `name`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`) VALUES(9, 'World of Warcraft', '/cs4git/images/gamesplayed/game_508dc7963ba36.png', 0, 0, 4);

CREATE TABLE IF NOT EXISTS `gamesplayed_members` (
  `gamemember_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamesplayed_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`gamemember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `gamesplayed_members` (`gamemember_id`, `gamesplayed_id`, `member_id`) VALUES(2, 2, 13);

CREATE TABLE IF NOT EXISTS `gamestats` (
  `gamestats_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamesplayed_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `stattype` varchar(15) NOT NULL,
  `calcop` varchar(3) NOT NULL,
  `firststat_id` int(11) NOT NULL,
  `secondstat_id` int(11) NOT NULL,
  `decimalspots` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `hidestat` int(11) NOT NULL,
  `textinput` int(11) NOT NULL,
  PRIMARY KEY (`gamestats_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(1, 8, 'K/D Ratio', 'calculate', 'div', 2, 3, 2, 0, 0, 0);
INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(2, 8, 'Kills', 'input', '', 0, 0, 0, 1, 0, 0);
INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(3, 8, 'Deaths', 'input', '', 0, 0, 0, 2, 0, 0);
INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(4, 5, 'Wins', 'input', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(5, 5, 'Losses', 'input', '', 0, 0, 0, 1, 0, 0);
INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(6, 2, 'Wins', 'input', '', 0, 0, 0, 0, 0, 0);
INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(7, 2, 'Losses', 'input', '', 0, 0, 0, 1, 0, 0);
INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES(8, 9, 'Level', 'input', '', 0, 0, 0, 0, 0, 0);

CREATE TABLE IF NOT EXISTS `gamestats_members` (
  `gamestatmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamestats_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `statvalue` decimal(65,30) NOT NULL,
  `stattext` varchar(255) NOT NULL,
  `dateupdated` int(11) NOT NULL,
  PRIMARY KEY (`gamestatmember_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `hitcounter` (
  `hit_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(25) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `pagename` varchar(255) NOT NULL,
  PRIMARY KEY (`hit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=199 ;

INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(1, '::1', 1356151337, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(2, '::1', 1356152351, 'Member Application - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(3, '::1', 1356153707, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(4, '::1', 1356153716, 'Website Settings - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(5, '::1', 1356154027, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(6, '::1', 1356208177, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(7, '::1', 1356208185, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(8, '::1', 1356208185, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(9, '::1', 1356314586, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(10, '::1', 1356315202, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(11, '::1', 1356315202, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(12, '::1', 1356315237, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(13, '::1', 1356315241, 'Manage Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(14, '::1', 1356315242, 'Manage Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(15, '::1', 1356315572, 'Manage Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(16, '::1', 1356315573, 'Add New Medal - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(17, '::1', 1356315581, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(18, '::1', 1356315694, 'Manage Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(19, '::1', 1356315696, 'Manage Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(20, '::1', 1356315705, 'Manage Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(21, '::1', 1356316410, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(22, '::1', 1356316410, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(23, '::1', 1356316416, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(24, '::1', 1356316427, 'Undisable Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(25, '::1', 1356316431, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(26, '::1', 1356316436, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(27, '::1', 1356316446, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(28, '::1', 1356316449, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(29, '::1', 1356316465, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(30, '::1', 1356316467, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(31, '::1', 1356316486, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(32, '::1', 1356316488, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(33, '::1', 1356316490, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(34, '::1', 1356316495, 'Add New Medal - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(35, '::1', 1356316906, 'Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(36, '::1', 1356317006, 'Add New Medal - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(37, '::1', 1356317009, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(38, '::1', 1356317015, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(39, '::1', 1356317016, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(40, '::1', 1356317023, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(41, '::1', 1356317026, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(42, '::1', 1356317035, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(43, '::1', 1356317037, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(44, '::1', 1356317051, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(45, '::1', 1356317053, 'Add Member - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(46, '::1', 1356317057, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(47, '::1', 1356317057, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(48, '::1', 1356317444, 'Medals - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(49, '::1', 1356343787, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(50, '::1', 1356343788, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(51, '::1', 1356343797, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(52, '::1', 1356343797, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(53, '::1', 1356343819, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(54, '::1', 1356343819, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(55, '::1', 1356344054, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(56, '::1', 1356344055, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(57, '::1', 1356344149, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(58, '::1', 1356344149, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(59, '::1', 1356344735, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(60, '::1', 1356344735, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(61, '::1', 1356344736, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(62, '::1', 1356344754, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(63, '::1', 1356344754, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(64, '::1', 1356344783, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(65, '::1', 1356344783, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(66, '::1', 1356344797, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(67, '::1', 1356344797, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(68, '::1', 1356344820, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(69, '::1', 1356344820, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(70, '::1', 1356344841, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(71, '::1', 1356344842, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(72, '::1', 1356344874, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(73, '::1', 1356344874, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(74, '::1', 1356344875, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(75, '::1', 1356344900, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(76, '::1', 1356344900, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(77, '::1', 1356344901, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(78, '::1', 1356344955, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(79, '::1', 1356344956, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(80, '::1', 1356344989, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(81, '::1', 1356344989, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(82, '::1', 1356345009, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(83, '::1', 1356345009, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(84, '::1', 1356345010, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(85, '::1', 1356345032, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(86, '::1', 1356345032, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(87, '::1', 1356345082, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(88, '::1', 1356345082, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(89, '::1', 1356345130, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(90, '::1', 1356345130, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(91, '::1', 1356345154, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(92, '::1', 1356345155, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(93, '::1', 1356345168, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(94, '::1', 1356345168, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(95, '::1', 1356345169, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(96, '::1', 1356345192, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(97, '::1', 1356345192, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(98, '::1', 1356345227, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(99, '::1', 1356345227, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(100, '::1', 1356345228, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(101, '::1', 1356345252, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(102, '::1', 1356345252, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(103, '::1', 1356345270, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(104, '::1', 1356345271, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(105, '::1', 1356345307, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(106, '::1', 1356345307, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(107, '::1', 1356345323, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(108, '::1', 1356345323, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(109, '::1', 1356345471, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(110, '::1', 1356345471, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(111, '::1', 1356345484, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(112, '::1', 1356345485, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(113, '::1', 1356345511, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(114, '::1', 1356345512, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(115, '::1', 1356345515, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(116, '::1', 1356345515, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(117, '::1', 1356345527, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(118, '::1', 1356345528, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(119, '::1', 1356345528, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(120, '::1', 1356345542, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(121, '::1', 1356345543, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(122, '::1', 1356345573, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(123, '::1', 1356345573, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(124, '::1', 1356345574, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(125, '::1', 1356345736, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(126, '::1', 1356345736, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(127, '::1', 1356346505, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(128, '::1', 1356346505, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(129, '::1', 1356346506, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(130, '::1', 1356346564, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(131, '::1', 1356346565, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(132, '::1', 1356346574, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(133, '::1', 1356346575, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(134, '::1', 1356346604, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(135, '::1', 1356346604, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(136, '::1', 1356346681, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(137, '::1', 1356346682, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(138, '::1', 1356346683, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(139, '::1', 1356346693, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(140, '::1', 1356346693, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(141, '::1', 1356346709, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(142, '::1', 1356346709, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(143, '::1', 1356346725, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(144, '::1', 1356346726, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(145, '::1', 1356346744, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(146, '::1', 1356346744, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(147, '::1', 1356346809, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(148, '::1', 1356346809, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(149, '::1', 1356346810, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(150, '::1', 1356346847, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(151, '::1', 1356346848, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(152, '::1', 1356373919, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(153, '::1', 1356373922, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(154, '::1', 1356373978, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(155, '::1', 1356374223, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(156, '::1', 1356374229, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(157, '::1', 1356374234, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(158, '::1', 1356374284, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(159, '::1', 1356374556, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(160, '::1', 1356374711, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(161, '::1', 1356375180, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(162, '::1', 1356375188, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(163, '::1', 1356375188, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(164, '::1', 1356375269, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(165, '::1', 1356375307, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(166, '::1', 1356375317, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(167, '::1', 1356375317, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(168, '::1', 1356375376, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(169, '::1', 1356375415, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(170, '::1', 1356375420, 'Website Settings - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(171, '::1', 1356375430, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(172, '::1', 1356375454, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(173, '::1', 1356375506, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(174, '::1', 1356375739, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(175, '::1', 1356376144, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(176, '::1', 1356376148, 'Website Settings - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(177, '::1', 1356376154, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(178, '::1', 1356376200, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(179, '::1', 1356376218, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(180, '::1', 1356376303, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(181, '::1', 1356376313, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(182, '::1', 1356376318, 'Website Settings - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(183, '::1', 1356376425, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(184, '::1', 1356376425, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(185, '::1', 1356376476, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(186, '::1', 1356376476, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(187, '::1', 1356376536, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(188, '::1', 1356376536, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(189, '::1', 1356376553, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(190, '::1', 1356376553, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(191, '::1', 1356376556, 'Admin''s Profile - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(192, '::1', 1356376556, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(193, '::1', 1356643342, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(194, '::1', 1356643351, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(195, '::1', 1356643352, '');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(196, '::1', 1356643358, 'My Account - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(197, '::1', 1356643361, 'Website Settings - ');
INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`) VALUES(198, '::1', 1356643368, '');

CREATE TABLE IF NOT EXISTS `ipban` (
  `ipban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(11) NOT NULL,
  `exptime` int(11) NOT NULL,
  PRIMARY KEY (`ipban_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `logdate` int(11) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `logs` (`log_id`, `member_id`, `logdate`, `ipaddress`, `message`) VALUES(1, 13, 1356317057, '::1', 'Auto awarded medal for recruiting 5 members.');

CREATE TABLE IF NOT EXISTS `medals` (
  `medal_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `imageurl` text NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `autodays` int(11) NOT NULL,
  `autorecruits` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`medal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(1, 'Tournament Champ', 'Awarded for winning a clan tournament.', 'images/medals/medal_50d53680435d5.gif', 105, 30, 0, 0, 1);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(2, 'Active Member Medal', 'Awarded for being an active clan member.', 'images/medals/medal_50d53660e7533.gif', 105, 30, 0, 0, 3);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(3, 'Forum Hero', 'Awarded for being active on the forums.', 'images/medals/medal_50d536249845b.gif', 105, 30, 0, 0, 5);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(4, 'Epic Medal', 'Awarded for being epic.', 'images/medals/medal_50d5361482940.gif', 105, 30, 0, 0, 6);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(5, 'Rookie Medal', 'Awarded after 5 days in the clan.', 'images/medals/medal_50d535b39cf89.gif', 105, 30, 5, 0, 11);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(6, 'Veteran Medal', 'Awarded after being in the clan for 90 days.', 'images/medals/medal_50d535a2dc0f8.gif', 105, 30, 90, 0, 9);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(7, 'Old Timer Medal', 'Awarded for being in the clan for 120 days.', 'images/medals/medal_50d535ef43360.gif', 105, 30, 120, 0, 8);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(8, 'Shooting Star Medal', 'Awarded for being in the clan 150 days.', 'images/medals/medal_50d536049e104.gif', 105, 30, 150, 0, 7);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(9, 'Silver Shield Medal', 'Awarded to members who help the clan with Web Design/Graphics, etc...', 'images/medals/medal_50d53640a63e9.gif', 105, 30, 0, 0, 4);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(10, 'Established Member Medal', 'Awarded after being in the clan for 30 days.', 'images/medals/medal_50d535cada75a.gif', 105, 30, 30, 0, 10);
INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES(11, 'Humanitarian Medal', 'Awarded for recruiting 5 members to the clan.', 'images/medals/medal_50d7c14e122fe.gif', 0, 0, 0, 5, 2);

CREATE TABLE IF NOT EXISTS `medals_members` (
  `medalmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `medal_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateawarded` int(11) NOT NULL,
  PRIMARY KEY (`medalmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

INSERT INTO `medals_members` (`medalmember_id`, `medal_id`, `member_id`, `dateawarded`) VALUES(1, 5, 13, 1354511654);
INSERT INTO `medals_members` (`medalmember_id`, `medal_id`, `member_id`, `dateawarded`) VALUES(2, 10, 13, 1354511654);
INSERT INTO `medals_members` (`medalmember_id`, `medal_id`, `member_id`, `dateawarded`) VALUES(3, 6, 13, 1354511654);
INSERT INTO `medals_members` (`medalmember_id`, `medal_id`, `member_id`, `dateawarded`) VALUES(4, 7, 13, 1354511654);
INSERT INTO `medals_members` (`medalmember_id`, `medal_id`, `member_id`, `dateawarded`) VALUES(5, 8, 13, 1354511654);
INSERT INTO `medals_members` (`medalmember_id`, `medal_id`, `member_id`, `dateawarded`) VALUES(6, 11, 13, 1356317057);

CREATE TABLE IF NOT EXISTS `memberapps` (
  `memberapp_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `applydate` int(11) NOT NULL,
  `ipaddress` varchar(25) NOT NULL,
  `memberadded` int(11) NOT NULL,
  `seenstatus` int(11) NOT NULL,
  PRIMARY KEY (`memberapp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password2` varchar(255) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `profilepic` text NOT NULL,
  `avatar` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `facebook` text NOT NULL,
  `twitter` varchar(20) NOT NULL,
  `youtube` varchar(40) NOT NULL,
  `googleplus` text NOT NULL,
  `maingame_id` int(11) NOT NULL,
  `birthday` int(11) NOT NULL,
  `datejoined` int(11) NOT NULL,
  `lastlogin` int(11) NOT NULL,
  `lastseen` int(11) NOT NULL,
  `lastseenlink` text NOT NULL,
  `loggedin` int(11) NOT NULL,
  `lastpromotion` int(11) NOT NULL,
  `lastdemotion` int(11) NOT NULL,
  `timesloggedin` int(11) NOT NULL,
  `recruiter` int(11) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `profileviews` int(11) NOT NULL,
  `defaultconsole` int(11) NOT NULL,
  `disabled` int(11) NOT NULL,
  `disableddate` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `newstype` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `postsubject` varchar(255) NOT NULL,
  `newspost` text NOT NULL,
  `lasteditmember_id` int(11) NOT NULL,
  `lasteditdate` int(11) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `news` (`news_id`, `member_id`, `newstype`, `dateposted`, `postsubject`, `newspost`, `lasteditmember_id`, `lasteditdate`) VALUES(1, 13, 3, 1354511637, 'Shoutbox Post', 'test', 0, 0);
INSERT INTO `news` (`news_id`, `member_id`, `newstype`, `dateposted`, `postsubject`, `newspost`, `lasteditmember_id`, `lasteditdate`) VALUES(2, 13, 3, 1354511641, 'Shoutbox Post', 'asdf', 0, 0);
INSERT INTO `news` (`news_id`, `member_id`, `newstype`, `dateposted`, `postsubject`, `newspost`, `lasteditmember_id`, `lasteditdate`) VALUES(3, 13, 3, 1354511642, 'Shoutbox Post', 'asdf', 0, 0);
INSERT INTO `news` (`news_id`, `member_id`, `newstype`, `dateposted`, `postsubject`, `newspost`, `lasteditmember_id`, `lasteditdate`) VALUES(4, 13, 3, 1354511644, 'Shoutbox Post', 'fd', 0, 0);
INSERT INTO `news` (`news_id`, `member_id`, `newstype`, `dateposted`, `postsubject`, `newspost`, `lasteditmember_id`, `lasteditdate`) VALUES(5, 13, 3, 1354511648, 'Shoutbox Post', 'dd', 0, 0);

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `datesent` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `icontype` varchar(15) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `notifications` (`notification_id`, `member_id`, `datesent`, `message`, `status`, `icontype`) VALUES(1, 13, 1352264730, 'You were awarded the medal: <b>Epic Medal</b>', 1, 'promotion');
INSERT INTO `notifications` (`notification_id`, `member_id`, `datesent`, `message`, `status`, `icontype`) VALUES(2, 13, 1352264730, 'You were awarded the medal: <b>Epic Medal</b>', 1, 'medal');
INSERT INTO `notifications` (`notification_id`, `member_id`, `datesent`, `message`, `status`, `icontype`) VALUES(3, 13, 1352264730, 'You were awarded the medal: <b>Epic Medal</b>', 1, 'demotion');
INSERT INTO `notifications` (`notification_id`, `member_id`, `datesent`, `message`, `status`, `icontype`) VALUES(4, 13, 1352264730, 'You were awarded the medal: <b>Epic Medal</b>', 1, '');

CREATE TABLE IF NOT EXISTS `privatemessages` (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `datesent` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `originalpm_id` int(11) NOT NULL,
  `deletesender` int(11) NOT NULL,
  `deletereceiver` int(11) NOT NULL,
  PRIMARY KEY (`pm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `profilecategory` (
  `profilecategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`profilecategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `profilecategory` (`profilecategory_id`, `name`, `ordernum`) VALUES(1, 'Personal Information', 1);

CREATE TABLE IF NOT EXISTS `profileoptions` (
  `profileoption_id` int(11) NOT NULL AUTO_INCREMENT,
  `profilecategory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `optiontype` varchar(255) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`profileoption_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `profileoptions` (`profileoption_id`, `profilecategory_id`, `name`, `optiontype`, `sortnum`) VALUES(2, 1, 'First Name', 'input', 2);
INSERT INTO `profileoptions` (`profileoption_id`, `profilecategory_id`, `name`, `optiontype`, `sortnum`) VALUES(3, 1, 'Gender', 'select', 1);
INSERT INTO `profileoptions` (`profileoption_id`, `profilecategory_id`, `name`, `optiontype`, `sortnum`) VALUES(6, 1, 'Last Name', 'input', 3);

CREATE TABLE IF NOT EXISTS `profileoptions_select` (
  `selectopt_id` int(11) NOT NULL AUTO_INCREMENT,
  `profileoption_id` int(11) NOT NULL,
  `selectvalue` varchar(255) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`selectopt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

INSERT INTO `profileoptions_select` (`selectopt_id`, `profileoption_id`, `selectvalue`, `sortnum`) VALUES(14, 3, 'Male', 2);
INSERT INTO `profileoptions_select` (`selectopt_id`, `profileoption_id`, `selectvalue`, `sortnum`) VALUES(13, 3, 'Alien', 1);
INSERT INTO `profileoptions_select` (`selectopt_id`, `profileoption_id`, `selectvalue`, `sortnum`) VALUES(15, 3, 'Female', 3);

CREATE TABLE IF NOT EXISTS `profileoptions_values` (
  `values_id` int(11) NOT NULL AUTO_INCREMENT,
  `profileoption_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `inputvalue` varchar(255) NOT NULL,
  PRIMARY KEY (`values_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(49, 3, 13, '14');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(2, 0, 0, '');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(50, 2, 13, 'Leo');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(51, 6, 13, 'Rojas');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(40, 3, 18, '13');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(41, 2, 18, 'Not Set');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(42, 6, 18, 'Not Set');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(34, 3, 16, '13');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(35, 2, 16, 'Not Set');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(36, 6, 16, 'Not Set');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(37, 3, 17, '13');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(38, 2, 17, 'Not Set');
INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES(39, 6, 17, 'Not Set');

CREATE TABLE IF NOT EXISTS `rankcategory` (
  `rankcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `imageurl` text NOT NULL,
  `ordernum` int(11) NOT NULL,
  `hidecat` int(11) NOT NULL,
  `useimage` int(1) NOT NULL,
  `description` text NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `color` varchar(30) NOT NULL,
  PRIMARY KEY (`rankcategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

INSERT INTO `rankcategory` (`rankcategory_id`, `name`, `imageurl`, `ordernum`, `hidecat`, `useimage`, `description`, `imagewidth`, `imageheight`, `color`) VALUES(1, 'Commanders', '', 6, 0, 0, 'The leaders of the clan', 0, 0, '#FF0000');
INSERT INTO `rankcategory` (`rankcategory_id`, `name`, `imageurl`, `ordernum`, `hidecat`, `useimage`, `description`, `imagewidth`, `imageheight`, `color`) VALUES(2, 'Generals', '', 4, 0, 0, '', 0, 0, '#0000FF');
INSERT INTO `rankcategory` (`rankcategory_id`, `name`, `imageurl`, `ordernum`, `hidecat`, `useimage`, `description`, `imagewidth`, `imageheight`, `color`) VALUES(7, 'Warrant Officers', '', 2, 0, 0, '', 40, 40, '#F7FF00');
INSERT INTO `rankcategory` (`rankcategory_id`, `name`, `imageurl`, `ordernum`, `hidecat`, `useimage`, `description`, `imagewidth`, `imageheight`, `color`) VALUES(6, 'Officers', '', 3, 0, 0, '', 0, 0, '#09FF00');
INSERT INTO `rankcategory` (`rankcategory_id`, `name`, `imageurl`, `ordernum`, `hidecat`, `useimage`, `description`, `imagewidth`, `imageheight`, `color`) VALUES(8, 'Enlisted', '', 1, 0, 0, '', 0, 0, '#00FFFF');
INSERT INTO `rankcategory` (`rankcategory_id`, `name`, `imageurl`, `ordernum`, `hidecat`, `useimage`, `description`, `imagewidth`, `imageheight`, `color`) VALUES(16, 'Co-Commanders', '', 5, 1, 0, 'asdfsadfff', 0, 0, '#FF6600');

CREATE TABLE IF NOT EXISTS `ranks` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rankcategory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `imageurl` text NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `autodays` int(11) NOT NULL,
  `hiderank` int(11) NOT NULL,
  `promotepower` int(11) NOT NULL,
  `autodisable` int(11) NOT NULL,
  `color` varchar(25) NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(50, 8, 'Master Sergeant', '42 days in the clan.', 'images/ranks/rank_4fa5ecc2638ee.png', 50, 75, 10, 42, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(1, 3, 'Administrator', '', '', 0, 0, 1, 0, 1, 0, 0, '#7FFF00');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(49, 8, 'Gunnery Sergeant', '35 days in the clan.', 'images/ranks/rank_4fa5ec8766300.png', 50, 75, 9, 35, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(41, 1, 'Commander', 'This is a very important rank. They have to be very active and a good leader.', 'images/ranks/rank_4fa57e0c2fcfd.png', 50, 75, 29, 0, 0, 41, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(42, 1, 'Co-Commander', 'The Co-Commander helps the Commanders. Promoted by the Commander.', 'images/ranks/rank_4fa57e3cb293a.png', 50, 75, 28, 0, 0, 31, 0, '#9C2525');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(43, 8, 'Recruit', 'Starting Rank', 'images/ranks/rank_4fa58088a6a9d.png', 50, 75, 3, 0, 0, 0, 0, '#00EAFF');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(44, 8, 'Private', '3 days in clan.', 'images/ranks/rank_4fa580f71decb.png', 50, 75, 4, 3, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(45, 8, 'Private First Class', '7 days in clan.', 'images/ranks/rank_4fa581276383b.png', 50, 75, 5, 7, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(46, 8, 'Corporal', '14 days in clan.', 'images/ranks/rank_4fa5eb8927175.png', 50, 75, 6, 14, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(47, 8, 'Sergeant', '21 days in the clan.', 'images/ranks/rank_4fa5ebcbef13c.png', 50, 75, 7, 21, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(48, 8, 'Staff Sergeant', '28 days in the clan.', 'images/ranks/rank_4fa5ec028e2a9.png', 50, 75, 8, 28, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(31, 2, 'General', 'Promoted by Co-Commanders and up.', 'images/ranks/rank_4fa57ff737f8f.png', 50, 75, 27, 0, 0, 66, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(51, 8, '1st Sergeant', '49 days in the clan.', 'images/ranks/rank_4fa5ed08200bc.png', 50, 75, 11, 49, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(52, 8, 'Sergeant Major', '56 days in the clan.', 'images/ranks/rank_4fa5ed82cb573.png', 50, 75, 12, 56, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(53, 7, 'Warrant Officer W1', 'Promoted by 2nd Lieutanent or Higher.', 'images/ranks/rank_4fa5f1e607f8a.png', 50, 75, 13, 0, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(54, 7, 'Warrant Officer W2', 'Promoted by 2nd Lieutanent or Higher.', 'images/ranks/rank_4fa5f35316e43.png', 50, 75, 14, 0, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(55, 7, 'Warrant Officer W3', 'Promoted by 2nd Lieutanent or Higher.', 'images/ranks/rank_4fa5f37660647.png', 50, 75, 15, 0, 0, 0, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(56, 7, 'Chief Warrant Officer W4', 'Promoted by 1st Lieutanent or Higher.', 'images/ranks/rank_4fa5f3d842b99.png', 50, 75, 16, 0, 0, 52, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(57, 7, 'Chief Warrant Officer W5', 'Promoted by 1st Lieutanent or Higher.', 'images/ranks/rank_4fa5f407bba12.png', 50, 75, 17, 0, 0, 52, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(58, 6, '2nd Lieutenant', 'Promoted by Captain or Higher.', 'images/ranks/rank_4fa5f51b9c48c.png', 50, 75, 18, 0, 0, 55, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(59, 6, '1st Lieutenant', 'Promoted by Captain or Higher.', 'images/ranks/rank_4fa5f54c265ce.png', 50, 75, 19, 0, 0, 57, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(60, 6, 'Captain', 'Promoted by Colonel or Higher.', 'images/ranks/rank_4fa5f5ddbca9a.png', 50, 75, 20, 0, 0, 59, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(61, 6, 'Major', 'Promoted by Colonel or Higher.', 'images/ranks/rank_4fa5f614eabf2.png', 50, 75, 21, 0, 0, 59, 0, '#FF6F00');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(62, 6, 'Lieutenant Colonel', 'Promoted by Colonel or Higher.', 'images/ranks/rank_4fa5f670e6b80.png', 50, 75, 22, 0, 0, 59, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(63, 6, 'Colonel', 'Promoted by Brigadier General or Higher.', 'images/ranks/rank_4fa5f6b6d6c55.png', 50, 75, 23, 0, 0, 62, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(64, 2, 'Brigadier General', 'Promoted by Lieutenant General or Higher.', 'images/ranks/rank_4fa5f9c2eb082.png', 50, 75, 24, 0, 0, 63, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(65, 2, 'Major General', 'Promoted by General or Higher.', 'images/ranks/rank_4fa5f9f050643.png', 50, 75, 25, 0, 0, 63, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(66, 2, 'Lieutenant General', 'Promoted by General or Higher.', 'images/ranks/rank_4fa5fa1568f34.png', 50, 75, 26, 0, 0, 64, 0, '#ffffff');
INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES(67, 8, 'Trial Member', '', 'images/ranks/rank_508358b676d92.png', 40, 40, 2, 0, 0, 0, 5, '#ffffff');

CREATE TABLE IF NOT EXISTS `rank_privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1138 ;

INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1, 1, 1);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(2, 1, 2);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(3, 1, 3);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(4, 1, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(5, 1, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(6, 1, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(8, 1, 9);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(9, 1, 10);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(10, 1, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(11, 1, 12);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(12, 1, 14);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(13, 1, 15);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(14, 1, 17);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(15, 1, 18);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(16, 1, 19);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(620, 31, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(619, 31, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(618, 31, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(836, 58, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(856, 57, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(855, 57, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(854, 57, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(873, 56, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(872, 56, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(871, 56, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(921, 55, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(920, 55, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(901, 54, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(900, 54, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(927, 53, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(926, 53, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(938, 52, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(948, 51, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(958, 50, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(968, 49, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(978, 48, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(988, 47, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(998, 46, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(835, 58, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(834, 58, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(165, 1, 25);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1008, 45, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1018, 44, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1031, 43, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1084, 41, 87);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1083, 41, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(61, 1, 22);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(62, 1, 23);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(63, 1, 24);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1082, 41, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1081, 41, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1137, 42, 91);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1136, 42, 90);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1135, 42, 8);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(816, 59, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(815, 59, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(814, 59, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(796, 60, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(795, 60, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(794, 60, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(783, 61, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(782, 61, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(781, 61, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(780, 61, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(756, 62, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(755, 62, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(754, 62, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(736, 63, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(735, 63, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(734, 63, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(707, 64, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(706, 64, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(705, 64, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(678, 65, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(677, 65, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(676, 65, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(649, 66, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(648, 66, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(647, 66, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(340, 1, 34);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(339, 1, 33);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(338, 1, 32);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(337, 1, 31);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1080, 41, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1134, 42, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(617, 31, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(853, 57, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(833, 58, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(813, 59, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(793, 60, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(779, 61, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(753, 62, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(733, 63, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(704, 64, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(675, 65, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(646, 66, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(367, 1, 21);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1079, 41, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1133, 42, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(616, 31, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(852, 57, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(832, 58, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(812, 59, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(792, 60, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(778, 61, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(752, 62, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(732, 63, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(703, 64, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(674, 65, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(645, 66, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(451, 1, 8);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1078, 41, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1132, 42, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(615, 31, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(851, 57, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(831, 58, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(811, 59, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(791, 60, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(751, 62, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(731, 63, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(702, 64, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(673, 65, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(644, 66, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(465, 1, 20);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(482, 1, 51);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(483, 1, 52);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(494, 1, 63);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(485, 1, 54);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(486, 1, 55);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(487, 1, 56);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(493, 1, 62);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(492, 1, 61);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(491, 1, 60);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(495, 1, 64);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(496, 1, 65);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(497, 1, 66);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(572, 1, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(575, 1, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(574, 1, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(509, 1, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(517, 1, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(518, 1, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(519, 1, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(520, 1, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1029, 43, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(573, 1, 83);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1028, 43, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(776, 61, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(775, 61, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(774, 61, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(773, 61, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(564, 1, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(565, 1, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(567, 1, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(772, 61, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(771, 61, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(578, 1, 86);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(579, 1, 87);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(580, 1, 88);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(581, 1, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(582, 1, 90);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(583, 1, 91);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(584, 1, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(585, 1, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1131, 42, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1130, 42, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1129, 42, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1128, 42, 21);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1127, 42, 86);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1126, 42, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1125, 42, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1124, 42, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1123, 42, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1122, 42, 88);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1121, 42, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1120, 42, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1119, 42, 83);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1118, 42, 20);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1117, 42, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1116, 42, 87);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1115, 42, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1114, 42, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1113, 42, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1112, 42, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1111, 42, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1110, 42, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(622, 31, 87);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(623, 31, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(624, 31, 20);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(625, 31, 83);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(626, 31, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(627, 31, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(628, 31, 88);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(629, 31, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(630, 31, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(631, 31, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(632, 31, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(633, 31, 86);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(634, 31, 21);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(635, 31, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(636, 31, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(637, 31, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(638, 31, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(639, 31, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(640, 31, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(641, 31, 8);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(642, 31, 90);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(643, 31, 91);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(651, 66, 87);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(652, 66, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(653, 66, 20);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(654, 66, 83);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(655, 66, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(656, 66, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(657, 66, 88);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(658, 66, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(659, 66, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(660, 66, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(661, 66, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(662, 66, 86);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(663, 66, 21);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(664, 66, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(665, 66, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(666, 66, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(667, 66, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(668, 66, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(669, 66, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(670, 66, 8);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(671, 66, 90);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(672, 66, 91);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(680, 65, 87);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(681, 65, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(682, 65, 20);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(683, 65, 83);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(684, 65, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(685, 65, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(686, 65, 88);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(687, 65, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(688, 65, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(689, 65, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(690, 65, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(691, 65, 86);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(692, 65, 21);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(693, 65, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(694, 65, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(695, 65, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(696, 65, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(697, 65, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(698, 65, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(699, 65, 8);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(700, 65, 90);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(701, 65, 91);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(709, 64, 87);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(710, 64, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(711, 64, 20);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(712, 64, 83);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(713, 64, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(714, 64, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(715, 64, 88);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(716, 64, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(717, 64, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(718, 64, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(719, 64, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(720, 64, 86);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(721, 64, 21);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(722, 64, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(723, 64, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(724, 64, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(725, 64, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(726, 64, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(727, 64, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(728, 64, 8);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(729, 64, 90);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(730, 64, 91);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(738, 63, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(739, 63, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(740, 63, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(741, 63, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(742, 63, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(743, 63, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(744, 63, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(745, 63, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(746, 63, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(747, 63, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(748, 63, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(749, 63, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(750, 63, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(758, 62, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(759, 62, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(760, 62, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(761, 62, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(762, 62, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(763, 62, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(764, 62, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(765, 62, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(766, 62, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(767, 62, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(768, 62, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(769, 62, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(770, 62, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(784, 61, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(785, 61, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(786, 61, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(787, 61, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(788, 61, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(789, 61, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(790, 61, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(798, 60, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(799, 60, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(800, 60, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(801, 60, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(802, 60, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(803, 60, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(804, 60, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(805, 60, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(806, 60, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(807, 60, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(808, 60, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(809, 60, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(810, 60, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(818, 59, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(819, 59, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(820, 59, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(821, 59, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(822, 59, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(823, 59, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(824, 59, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(825, 59, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(826, 59, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(827, 59, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(828, 59, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(829, 59, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(830, 59, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(838, 58, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(839, 58, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(840, 58, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(841, 58, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(842, 58, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(843, 58, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(844, 58, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(845, 58, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(846, 58, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(847, 58, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(848, 58, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(849, 58, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(850, 58, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(858, 57, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(859, 57, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(860, 57, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(861, 57, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(862, 57, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(863, 57, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(864, 57, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(865, 57, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(866, 57, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(867, 57, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(868, 57, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(869, 57, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(870, 57, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(874, 56, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(875, 56, 71);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(876, 56, 75);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(878, 56, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(879, 56, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(880, 56, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(881, 56, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(882, 56, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(883, 56, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(884, 56, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(885, 56, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(886, 56, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(887, 56, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(888, 56, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(889, 56, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(890, 56, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(919, 55, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(918, 55, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(916, 55, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(915, 55, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(914, 55, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(913, 55, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(902, 54, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(903, 54, 82);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(905, 54, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(906, 54, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(907, 54, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(908, 54, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(909, 54, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(910, 54, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(911, 54, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(912, 54, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(922, 55, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(923, 55, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(924, 55, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(925, 55, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(928, 53, 5);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(930, 53, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(931, 53, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(932, 53, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(933, 53, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(934, 53, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(935, 53, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(936, 53, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(937, 53, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(939, 52, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(941, 52, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(942, 52, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(943, 52, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(944, 52, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(945, 52, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(946, 52, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(947, 52, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(949, 51, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(951, 51, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(952, 51, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(953, 51, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(954, 51, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(955, 51, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(956, 51, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(957, 51, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(959, 50, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(961, 50, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(962, 50, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(963, 50, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(964, 50, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(965, 50, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(966, 50, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(967, 50, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(969, 49, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(971, 49, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(972, 49, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(973, 49, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(974, 49, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(975, 49, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(976, 49, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(977, 49, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(979, 48, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(981, 48, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(982, 48, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(983, 48, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(984, 48, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(985, 48, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(986, 48, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(987, 48, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(989, 47, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(991, 47, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(992, 47, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(993, 47, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(994, 47, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(995, 47, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(996, 47, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(997, 47, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(999, 46, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1001, 46, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1002, 46, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1003, 46, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1004, 46, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1005, 46, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1006, 46, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1007, 46, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1009, 45, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1011, 45, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1012, 45, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1013, 45, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1014, 45, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1015, 45, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1016, 45, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1017, 45, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1019, 44, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1021, 44, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1022, 44, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1023, 44, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1024, 44, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1025, 44, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1026, 44, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1027, 44, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1032, 43, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1033, 43, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1034, 43, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1035, 43, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1036, 43, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1037, 43, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1038, 67, 93);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1040, 67, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1041, 67, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1042, 67, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1043, 67, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1044, 67, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1048, 50, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1049, 49, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1077, 41, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1109, 42, 85);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1052, 43, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1053, 44, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1054, 45, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1055, 46, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1056, 47, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1057, 48, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1058, 31, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1059, 51, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1060, 52, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1061, 53, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1062, 54, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1063, 55, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1064, 56, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1065, 57, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1066, 58, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1067, 59, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1068, 60, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1069, 61, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1070, 62, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1071, 63, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1072, 64, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1073, 65, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1074, 66, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1075, 67, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1076, 1, 80);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1085, 41, 11);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1086, 41, 20);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1087, 41, 83);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1088, 41, 73);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1089, 41, 76);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1090, 41, 88);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1091, 41, 74);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1092, 41, 77);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1093, 41, 78);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1094, 41, 84);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1095, 41, 86);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1096, 41, 21);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1097, 41, 72);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1098, 41, 89);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1099, 41, 70);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1100, 41, 92);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1101, 41, 6);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1102, 41, 7);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1103, 41, 8);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1104, 41, 90);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1105, 41, 91);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1106, 1, 96);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1107, 1, 97);
INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES(1108, 1, 98);

CREATE TABLE IF NOT EXISTS `squadapps` (
  `squadapp_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `squad_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `applydate` int(11) NOT NULL,
  `dateaction` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `squadmember_id` int(11) NOT NULL,
  PRIMARY KEY (`squadapp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `squadinvites` (
  `squadinvite_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `datesent` int(11) NOT NULL,
  `dateaction` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `message` text NOT NULL,
  `startingrank_id` int(11) NOT NULL,
  PRIMARY KEY (`squadinvite_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `squadnews` (
  `squadnews_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `newstype` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `postsubject` varchar(255) NOT NULL,
  `newspost` text NOT NULL,
  `lasteditmember_id` int(11) NOT NULL,
  `lasteditdate` int(11) NOT NULL,
  PRIMARY KEY (`squadnews_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `squadranks` (
  `squadrank_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sortnum` int(11) NOT NULL,
  `postnews` int(11) NOT NULL,
  `managenews` int(11) NOT NULL,
  `postshoutbox` int(11) NOT NULL,
  `manageshoutbox` int(11) NOT NULL,
  `addrank` int(11) NOT NULL,
  `manageranks` int(11) NOT NULL,
  `editprofile` int(11) NOT NULL,
  `sendinvites` int(11) NOT NULL,
  `acceptapps` int(11) NOT NULL,
  `setrank` int(11) NOT NULL,
  `removemember` int(11) NOT NULL,
  PRIMARY KEY (`squadrank_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `squads` (
  `squad_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logourl` text NOT NULL,
  `recruitingstatus` int(11) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `privateshoutbox` int(11) NOT NULL,
  `website` text NOT NULL,
  PRIMARY KEY (`squad_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `squads_members` (
  `squadmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `squadrank_id` int(11) NOT NULL,
  `datejoined` int(11) NOT NULL,
  `lastpromotion` int(11) NOT NULL,
  `lastdemotion` int(11) NOT NULL,
  PRIMARY KEY (`squadmember_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tournamentmatch` (
  `tournamentmatch_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `team1score` int(11) NOT NULL,
  `team2score` int(11) NOT NULL,
  `outcome` int(11) NOT NULL,
  `replayteam1url` text NOT NULL,
  `replayteam2url` text NOT NULL,
  `adminreplayurl` text NOT NULL,
  `team1approve` int(11) NOT NULL,
  `team2approve` int(11) NOT NULL,
  `nextmatch_id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`tournamentmatch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `tournamentmatch` (`tournamentmatch_id`, `tournament_id`, `round`, `team1_id`, `team2_id`, `team1score`, `team2score`, `outcome`, `replayteam1url`, `replayteam2url`, `adminreplayurl`, `team1approve`, `team2approve`, `nextmatch_id`, `sortnum`) VALUES(1, 1, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0);
INSERT INTO `tournamentmatch` (`tournamentmatch_id`, `tournament_id`, `round`, `team1_id`, `team2_id`, `team1score`, `team2score`, `outcome`, `replayteam1url`, `replayteam2url`, `adminreplayurl`, `team1approve`, `team2approve`, `nextmatch_id`, `sortnum`) VALUES(2, 1, 1, 1, 4, 0, 0, 0, '', '', '', 0, 0, 1, 0);
INSERT INTO `tournamentmatch` (`tournamentmatch_id`, `tournament_id`, `round`, `team1_id`, `team2_id`, `team1score`, `team2score`, `outcome`, `replayteam1url`, `replayteam2url`, `adminreplayurl`, `team1approve`, `team2approve`, `nextmatch_id`, `sortnum`) VALUES(3, 1, 1, 2, 3, 0, 0, 0, '', '', '', 0, 0, 1, 0);

CREATE TABLE IF NOT EXISTS `tournamentplayers` (
  `tournamentplayer_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `displayname` varchar(50) NOT NULL,
  PRIMARY KEY (`tournamentplayer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tournamentpools` (
  `tournamentpool_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `finished` int(11) NOT NULL,
  PRIMARY KEY (`tournamentpool_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tournamentpools_teams` (
  `poolteam_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `pool_id` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `team1score` int(11) NOT NULL,
  `team2score` int(11) NOT NULL,
  `winner` int(11) NOT NULL,
  PRIMARY KEY (`poolteam_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tournaments` (
  `tournament_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `gamesplayed_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `seedtype` int(11) NOT NULL,
  `startdate` int(11) NOT NULL,
  `eliminations` int(11) NOT NULL,
  `playersperteam` int(11) NOT NULL,
  `maxteams` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` text NOT NULL,
  `password` varchar(32) NOT NULL,
  `requirereplay` int(10) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY (`tournament_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tournamentteams` (
  `tournamentteam_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `seed` int(11) NOT NULL,
  PRIMARY KEY (`tournamentteam_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `websiteinfo` (
  `websiteinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `clanname` varchar(255) NOT NULL,
  `clantag` varchar(255) NOT NULL,
  `preventhack` varchar(32) NOT NULL,
  `maxdsl` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `lowdsl` varchar(255) NOT NULL,
  `meddsl` varchar(255) NOT NULL,
  `highdsl` varchar(255) NOT NULL,
  `logourl` text NOT NULL,
  `forumurl` text NOT NULL,
  `failedlogins` int(11) NOT NULL,
  `maxdiplomacy` int(11) NOT NULL,
  `mostonline` int(11) NOT NULL,
  `mostonlinedate` int(11) NOT NULL,
  `memberregistration` int(11) NOT NULL,
  `memberapproval` int(11) NOT NULL,
  PRIMARY KEY (`websiteinfo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `websiteinfo` (`websiteinfo_id`, `clanname`, `clantag`, `preventhack`, `maxdsl`, `theme`, `lowdsl`, `meddsl`, `highdsl`, `logourl`, `forumurl`, `failedlogins`, `maxdiplomacy`, `mostonline`, `mostonlinedate`, `memberregistration`, `memberapproval`) VALUES(1, 'Bluethrust Clan Website Manager: Clan Scripts v4', '[bT]', '5555', 0, 'orangegrunge', '#00FF00', '#FFFF52', '#F75B5B', '1', 'fgh', 8, 5, 1, 1355884420, 0, 1);
