-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 13, 2014 at 06:24 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cs4`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_captcha`
--

CREATE TABLE IF NOT EXISTS `app_captcha` (
  `appcaptcha_id` int(11) NOT NULL AUTO_INCREMENT,
  `appcomponent_id` int(11) NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `captchatext` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`appcaptcha_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=118 ;

--
-- Dumping data for table `app_captcha`
--

INSERT INTO `app_captcha` (`appcaptcha_id`, `appcomponent_id`, `ipaddress`, `captchatext`) VALUES
(117, 225, '127.0.0.1', 'eece0dbf'),
(111, 226, '127.0.0.1', 'cy9buyet'),
(115, -1, '127.0.0.1', '364q3ya6');

-- --------------------------------------------------------

--
-- Table structure for table `app_components`
--

CREATE TABLE IF NOT EXISTS `app_components` (
  `appcomponent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `componenttype` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `required` int(11) NOT NULL,
  `tooltip` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`appcomponent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=227 ;

--
-- Dumping data for table `app_components`
--

INSERT INTO `app_components` (`appcomponent_id`, `name`, `componenttype`, `required`, `tooltip`, `ordernum`) VALUES
(225, 'Captcha', 'captcha', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `app_selectvalues`
--

CREATE TABLE IF NOT EXISTS `app_selectvalues` (
  `appselectvalue_id` int(11) NOT NULL AUTO_INCREMENT,
  `appcomponent_id` int(11) NOT NULL,
  `componentvalue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`appselectvalue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `app_selectvalues`
--

INSERT INTO `app_selectvalues` (`appselectvalue_id`, `appcomponent_id`, `componentvalue`) VALUES
(1, 4, 'Haha'),
(2, 4, 'No'),
(3, 4, 'Yes'),
(4, 0, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `app_values`
--

CREATE TABLE IF NOT EXISTS `app_values` (
  `appvalue_id` int(11) NOT NULL AUTO_INCREMENT,
  `appcomponent_id` int(11) NOT NULL,
  `memberapp_id` int(11) NOT NULL,
  `appvalue` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`appvalue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `app_values`
--

INSERT INTO `app_values` (`appvalue_id`, `appcomponent_id`, `memberapp_id`, `appvalue`) VALUES
(40, 11, 10, 'China'),
(39, 9, 10, 'Starcraft'),
(37, 10, 10, 'sdf'),
(38, 8, 10, 'sdf'),
(36, 1, 10, 'Call of Duty');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `news_id`, `member_id`, `dateposted`, `message`) VALUES
(3, 41, 13, 1401831979, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `console`
--

CREATE TABLE IF NOT EXISTS `console` (
  `console_id` int(11) NOT NULL AUTO_INCREMENT,
  `consolecategory_id` int(11) NOT NULL,
  `pagetitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  `adminoption` int(11) NOT NULL,
  `sep` int(11) NOT NULL,
  `defaultconsole` int(11) NOT NULL,
  `hide` int(1) NOT NULL,
  PRIMARY KEY (`console_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=208 ;

--
-- Dumping data for table `console`
--

INSERT INTO `console` (`console_id`, `consolecategory_id`, `pagetitle`, `filename`, `sortnum`, `adminoption`, `sep`, `defaultconsole`, `hide`) VALUES
(1, 1, 'Add New Rank', 'admin/addrank.php', 1, 1, 0, 1, 0),
(2, 1, 'Manage Ranks', 'admin/manageranks.php', 2, 1, 0, 1, 0),
(5, 2, 'Add Member', 'membermanagement/addmember.php', 3, 0, 0, 1, 0),
(6, 2, 'Promote Member', 'membermanagement/promotemember.php', 2, 0, 0, 1, 0),
(7, 2, 'Demote Member', 'membermanagement/demotemember.php', 8, 0, 0, 1, 0),
(8, 2, 'Set Member''s Rank', 'membermanagement/setrank.php', 9, 0, 0, 1, 0),
(9, 10, 'Add New Medal', 'admin/addmedal.php', 2, 1, 0, 1, 0),
(10, 10, 'Manage Medals', 'admin/managemedals.php', 3, 1, 0, 1, 0),
(11, 3, 'Edit Profile', 'editprofile.php', 3, 0, 0, 1, 0),
(12, 1, '-separator-', '', 28, 1, 1, 0, 0),
(20, 2, 'Disable a Member', 'membermanagement/disablemember.php', 1, 0, 0, 1, 0),
(14, 1, 'Add Games Played', 'admin/addgamesplayed.php', 6, 1, 0, 1, 0),
(15, 1, 'Manage Games Played', 'admin/managegamesplayed.php', 7, 1, 0, 1, 0),
(19, 1, '-separator-', '', 5, 1, 1, 0, 0),
(17, 1, 'Add Custom Page', 'admin/addcustompages.php', 9, 1, 0, 1, 0),
(18, 1, 'Manage Custom Pages', 'admin/managecustompages.php', 10, 1, 0, 1, 0),
(21, 2, 'Delete Member', 'membermanagement/deletemember.php', 5, 0, 0, 1, 0),
(22, 1, 'Add New Rank Category', 'admin/addrankcategory.php', 3, 1, 0, 1, 0),
(23, 1, 'Manage Rank Categories', 'admin/managerankcategories.php', 4, 1, 0, 1, 0),
(135, 10, '-separator-', '', 4, 0, 1, 0, 0),
(25, 1, 'Add Console Option', 'admin/addconsoleoption.php', 15, 1, 0, 1, 0),
(33, 1, 'Manage Console Categories', 'admin/manageconsolecategories.php', 18, 1, 0, 1, 0),
(32, 1, 'Add New Console Category', 'admin/addconsolecategory.php', 17, 1, 0, 1, 0),
(31, 1, 'Manage Console Options', 'admin/manageconsole.php', 16, 1, 0, 1, 0),
(65, 1, 'Add Profile Option', 'admin/addprofileoption.php', 24, 1, 0, 1, 0),
(51, 1, '-separator-', '', 8, 1, 1, 1, 0),
(52, 1, '-separator-', '', 14, 1, 1, 1, 0),
(54, 14, '-separator-', '', 3, 1, 1, 1, 0),
(55, 14, 'Add Download Category', 'admin/adddownloadcategory.php', 1, 1, 0, 1, 0),
(56, 14, 'Manage Download Categories', 'admin/managedownloadcategories.php', 2, 1, 0, 1, 0),
(62, 1, 'Website Settings', 'admin/sitesettings.php', 30, 1, 0, 1, 0),
(61, 1, 'Modify Current Theme', 'admin/edittheme.php', 29, 1, 0, 1, 0),
(60, 1, '-separator-', '', 23, 1, 1, 1, 0),
(63, 1, 'Add Profile Category', 'admin/addprofilecategory.php', 26, 1, 0, 1, 0),
(64, 1, 'Manage Profile Categories', 'admin/manageprofilecategories.php', 27, 1, 0, 1, 0),
(66, 1, 'Manage Profile Options', 'admin/manageprofileoptions.php', 25, 1, 0, 1, 0),
(83, 9, 'Manage News', 'news/managenews.php', 5, 0, 0, 1, 0),
(82, 9, 'Post News', 'news/postnews.php', 2, 0, 0, 1, 0),
(70, 2, '-separator-', '', 7, 0, 1, 0, 0),
(71, 7, 'Create a Squad', 'squads/create.php', 1, 0, 0, 1, 0),
(72, 7, 'View Your Squads', 'squads/index.php', 4, 0, 0, 1, 0),
(73, 7, 'Apply to a Squad', 'squads/apply.php', 2, 0, 0, 1, 0),
(74, 7, 'View Squad Invitations', 'squads/viewinvites.php', 3, 0, 0, 1, 0),
(75, 8, 'Create a Tournament', 'tournaments/create.php', 1, 0, 0, 1, 0),
(76, 8, 'Manage Tournaments', 'tournaments/manage.php', 3, 0, 0, 1, 0),
(77, 8, 'Manage My Matches', 'tournaments/managematches.php', 4, 0, 0, 1, 0),
(78, 17, 'Private Messages', 'privatemessages/index.php', 1, 0, 0, 1, 0),
(84, 9, 'View Private News', 'news/privatenews.php', 6, 0, 0, 1, 0),
(80, 3, 'Edit My Game Stats', 'editmygamestats.php', 2, 0, 0, 1, 0),
(85, 9, 'Post Comment', 'news/postcomment.php', 3, 0, 0, 1, 1),
(86, 2, 'Undisable Member', 'membermanagement/undisablemember.php', 4, 0, 0, 1, 0),
(87, 10, 'Award Medal', 'medals/awardmedal.php', 1, 0, 0, 1, 0),
(88, 10, 'Revoke Medal', 'medals/revokemedal.php', 5, 0, 0, 1, 0),
(89, 3, 'Change Password', 'changepassword.php', 6, 0, 0, 1, 0),
(90, 2, '-separator-', '', 11, 0, 1, 0, 0),
(91, 2, 'Reset Member Password', 'membermanagement/resetpassword.php', 16, 0, 0, 1, 0),
(92, 3, 'View Logs', 'logs.php', 8, 0, 0, 1, 0),
(93, 9, 'Post in Shoutbox', 'news/postshoutbox.php', 4, 0, 0, 1, 1),
(96, 2, 'Registration Options', 'membermanagement/registrationoptions.php', 12, 0, 0, 1, 0),
(97, 2, 'Member Application', 'membermanagement/memberapplication.php', 13, 0, 0, 1, 0),
(98, 2, 'View Member Applications', 'membermanagement/viewapplications.php', 14, 0, 0, 1, 0),
(99, 11, 'Diplomacy: Add a Clan', 'diplomacy/addclan.php', 1, 0, 0, 1, 0),
(100, 11, 'Diplomacy: Manage Clans', 'diplomacy/manageclans.php', 2, 0, 0, 1, 0),
(101, 11, 'View Diplomacy Requests', 'diplomacy/viewrequests.php', 3, 0, 0, 1, 0),
(102, 11, 'Manage Diplomacy Statuses', 'diplomacy/diplomacystatuses.php', 6, 0, 0, 1, 0),
(103, 11, '-seperator-', '', 4, 0, 1, 1, 0),
(104, 11, 'Add Diplomacy Status', 'diplomacy/adddiplomacystatus.php', 5, 0, 0, 1, 0),
(105, 12, 'Add Event', 'events/addevent.php', 1, 0, 0, 1, 0),
(106, 12, 'Manage My Events', 'events/manage.php', 2, 0, 0, 1, 0),
(107, 12, 'View Event Invitations', 'events/viewinvites.php', 3, 0, 0, 1, 0),
(108, 1, 'Add Custom Form Page', 'admin/addcustomformpage.php', 11, 1, 0, 1, 0),
(109, 1, 'Manage Custom Form Pages', 'admin/managecustomforms.php', 12, 1, 0, 1, 0),
(110, 1, 'View Custom Form Submissions', 'admin/customformsubmissions.php', 13, 1, 0, 1, 0),
(111, 9, 'Modify News Ticker', 'news/newsticker.php', 8, 0, 0, 1, 0),
(113, 8, 'Join a Tournament', 'tournaments/join.php', 2, 0, 0, 1, 0),
(114, 1, 'Member''s Only Pages', 'admin/membersonlypages.php', 31, 1, 0, 1, 0),
(118, 13, 'Add Forum Category', 'forum/addcategory.php', 4, 0, 0, 1, 0),
(122, 13, 'Manage Boards', 'forum/manageboards.php', 8, 0, 0, 1, 0),
(119, 13, 'Manage Forum Categories', 'forum/managecategories.php', 5, 0, 0, 1, 0),
(120, 13, '-seperator-', '', 6, 0, 1, 1, 0),
(121, 13, 'Add Board', 'forum/addboard.php', 7, 0, 0, 1, 0),
(123, 13, 'Post Topic', 'forum/post.php', 2, 0, 0, 1, 1),
(124, 13, 'Manage Moderators', 'forum/managemoderators.php', 9, 0, 0, 1, 0),
(125, 13, 'Manage Forum Posts', 'forum/manageposts.php', 3, 0, 0, 1, 1),
(126, 3, 'Change Username', 'changeusername.php', 7, 0, 0, 1, 0),
(127, 2, 'Set Member''s Recruiter', 'membermanagement/setrecruiter.php', 17, 0, 0, 1, 0),
(128, 2, 'Set Member''s Recruit Date', 'membermanagement/setrecruitdate.php', 18, 0, 0, 1, 0),
(129, 2, '-seperator-', '', 15, 0, 1, 1, 0),
(134, 1, 'Clear Logs', 'admin/clearlogs.php', 32, 1, 0, 1, 0),
(136, 1, '-seperator-', '', 33, 0, 1, 1, 0),
(137, 1, 'Add Menu Category', 'admin/addmenucategory.php', 34, 0, 0, 1, 0),
(138, 1, 'Add Menu Item', 'admin/addmenuitem.php', 36, 0, 0, 1, 0),
(139, 1, 'Manage Menu Categories', 'admin/managemenucategory.php', 35, 0, 0, 1, 0),
(140, 1, 'Manage Menu Items', 'admin/managemenuitem.php', 37, 0, 0, 1, 0),
(141, 9, 'Manage Home Page Images', 'news/manageimages.php', 11, 0, 0, 1, 0),
(142, 9, 'Add Home Page Image', 'news/addimage.php', 10, 0, 0, 1, 0),
(143, 9, '-seperator-', '', 9, 0, 1, 1, 0),
(144, 13, 'Post Forum Attachments', 'forum/postattachments.php', 1, 0, 0, 1, 1),
(145, 14, 'Add Download', 'downloads/adddownload.php', 4, 0, 0, 1, 0),
(146, 14, 'Manage Downloads', 'downloads/managedownloads.php', 4, 0, 0, 1, 0),
(147, 13, '-seperator-', '', 10, 0, 1, 1, 0),
(148, 13, 'Forum Settings', 'forum/forumsettings.php', 11, 0, 0, 1, 0),
(188, 17, 'Add PM Folder', 'privatemessages/addfolder.php', 3, 0, 0, 1, 0),
(150, 1, '-seperator-', '', 38, 0, 1, 1, 0),
(187, 17, '-separator-', '', 2, 0, 1, 0, 0),
(165, 1, 'Plugin Manager', 'admin/pluginmanager.php', 39, 0, 0, 1, 0),
(171, 2, 'Set Promotion Power', 'membermanagement/setpromotionpower.php', 10, 0, 0, 1, 0),
(172, 2, '-seperator-', '', 19, 0, 1, 1, 0),
(173, 2, 'Set Member Inactive Status', 'membermanagement/iaoptions.php', 20, 0, 0, 1, 0),
(174, 2, 'View Inactive Requests', 'membermanagement/inactiverequests.php', 21, 0, 0, 1, 0),
(175, 3, 'Inactive Request', 'requestinactive.php', 9, 0, 0, 1, 0),
(176, 3, 'Cancel IA', 'cancelinactive.php', 1, 0, 0, 1, 1),
(189, 17, 'Manage PM Folders', 'privatemessages/managefolders.php', 4, 0, 0, 1, 0),
(190, 9, 'HTML in News Posts', '', 1, 0, 0, 1, 1),
(191, 9, 'Manage Shoutbox Posts', 'news/manageshoutbox.php', 7, 0, 0, 1, 0),
(192, 2, 'Change Member Username', 'membermanagement/changememberusername.php', 6, 0, 0, 1, 0),
(193, 1, 'IP Banning', 'admin/ipbanning.php', 40, 0, 0, 1, 0),
(194, 18, 'Create a Poll', 'polls/createpoll.php', 3, 0, 0, 1, 0),
(195, 18, 'Manage Polls', 'polls/managepolls.php', 4, 0, 0, 1, 0),
(196, 18, 'View Poll Results', '', 2, 0, 0, 1, 1),
(200, 13, 'Move Topic', 'forum/movetopic.php', 0, 0, 0, 1, 1),
(201, 7, 'Manage All Squads', '', 0, 1, 0, 1, 1),
(202, 12, 'Manage All Events', '', 0, 1, 0, 1, 1),
(203, 16, 'Add Social Media Icon', 'social/add.php', 1, 0, 0, 1, 0),
(204, 16, 'Manage Social Media Icons', 'social/manage.php', 2, 0, 0, 1, 0),
(205, 19, 'Create a Donation Campaign', '../plugins/donations/console/createcampaign.php', 1, 0, 0, 0, 0),
(206, 19, 'Manage Donation Campaigns', '../plugins/donations/console/managecampaign.php', 2, 0, 0, 0, 0),
(207, 19, 'View Donation Log', '../plugins/donations/console/donationlog.php', 3, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `consolecategory`
--

CREATE TABLE IF NOT EXISTS `consolecategory` (
  `consolecategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  `adminoption` int(1) NOT NULL,
  PRIMARY KEY (`consolecategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `consolecategory`
--

INSERT INTO `consolecategory` (`consolecategory_id`, `name`, `ordernum`, `adminoption`) VALUES
(1, 'Administrator Options', 1, 1),
(2, 'Member Management', 5, 0),
(3, 'Account Options', 7, 0),
(9, 'News', 6, 0),
(7, 'Squads', 3, 0),
(8, 'Tournaments', 2, 0),
(10, 'Medals', 4, 0),
(11, 'Diplomacy Options', 8, 0),
(12, 'Events', 9, 0),
(13, 'Forum Management', 10, 0),
(14, 'Downloads', 11, 0),
(16, 'Social Media Connect', 12, 0),
(17, 'Private Messages', 13, 0),
(18, 'Polls', 14, 0),
(19, 'Donations', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `console_members`
--

CREATE TABLE IF NOT EXISTS `console_members` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `console_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `allowdeny` int(1) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `console_members`
--

INSERT INTO `console_members` (`privilege_id`, `console_id`, `member_id`, `allowdeny`) VALUES
(3, 82, 51, 0),
(5, 121, 45, 1),
(6, 5, 51, 1),
(11, 171, 43, 1),
(12, 6, 63, 1),
(13, 87, 50, 1),
(14, 190, 48, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customform`
--

CREATE TABLE IF NOT EXISTS `customform` (
  `customform_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageinfo` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `submitmessage` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `submitlink` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `specialform` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`customform_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customform`
--

INSERT INTO `customform` (`customform_id`, `name`, `pageinfo`, `submitmessage`, `submitlink`, `specialform`) VALUES
(1, 'Test Page', '<p>blah blah blah</p>\r\n<p>&nbsp;</p>\r\n<p>lol</p>', '', '', ''),
(4, 'Test Form Page', '<p style="text-align: center;"><strong>Blah Blah</strong> this is a test1</p>', '<p style="text-align: center;">Success!! You submitted a form!</p>', 'http://localhost/cs4git/members', ''),
(5, 'Join', '<p>Agree or die!!!</p>', '<p>Thank you for joining!</p>', 'http://localhost/cs4/signupcheck.php', '');

-- --------------------------------------------------------

--
-- Table structure for table `customform_components`
--

CREATE TABLE IF NOT EXISTS `customform_components` (
  `component_id` int(11) NOT NULL AUTO_INCREMENT,
  `customform_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `componenttype` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `required` int(11) NOT NULL,
  `tooltip` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`component_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `customform_components`
--

INSERT INTO `customform_components` (`component_id`, `customform_id`, `name`, `componenttype`, `required`, `tooltip`, `sortnum`) VALUES
(1, 1, '', '0', 0, '', 1),
(2, 1, '', '0', 0, '', 1),
(10, 4, 'Name', 'input', 0, '', 1),
(11, 4, 'Gender', 'select', 1, '', 2),
(12, 4, 'large', 'largeinput', 0, 'tool tip''s!', 5),
(13, 4, 'Separators!!', 'separator', 0, 'This is some info', 4),
(14, 4, 'Color', 'multiselect', 1, '', 3),
(15, 5, 'Agree 1', 'select', 0, 'NOW!', 1),
(16, 5, 'Agree 2', 'select', 0, 'DO IT!', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customform_selectvalues`
--

CREATE TABLE IF NOT EXISTS `customform_selectvalues` (
  `selectvalue_id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `componentvalue` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`selectvalue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `customform_selectvalues`
--

INSERT INTO `customform_selectvalues` (`selectvalue_id`, `component_id`, `componentvalue`, `sortnum`) VALUES
(50, 14, 'red', 0),
(47, 11, 'Male', 0),
(46, 11, 'Female', 0),
(10, 9, 'test3', 0),
(9, 9, 'test1', 0),
(49, 14, 'green', 0),
(48, 14, 'blue', 0),
(56, 15, 'Yes', 0),
(55, 15, 'No', 0),
(58, 16, 'Yes', 0),
(57, 16, 'No', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customform_submission`
--

CREATE TABLE IF NOT EXISTS `customform_submission` (
  `submission_id` int(11) NOT NULL AUTO_INCREMENT,
  `customform_id` int(11) NOT NULL,
  `submitdate` int(11) NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seenstatus` int(11) NOT NULL,
  PRIMARY KEY (`submission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `customform_submission`
--

INSERT INTO `customform_submission` (`submission_id`, `customform_id`, `submitdate`, `ipaddress`, `seenstatus`) VALUES
(1, 0, 1364178455, '::1', 0),
(2, 0, 1364179225, '::1', 0),
(3, 0, 1364179677, '::1', 0),
(4, 0, 1364179802, '::1', 0),
(15, 4, 1365132767, '::1', 1),
(14, 4, 1365132267, '::1', 1),
(16, 4, 1365132973, '::1', 1),
(17, 4, 1365133148, '::1', 1),
(20, 4, 1365133385, '::1', 1),
(34, 5, 1386126157, '127.0.0.1', 0),
(35, 5, 1386126301, '127.0.0.1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customform_values`
--

CREATE TABLE IF NOT EXISTS `customform_values` (
  `value_id` int(11) NOT NULL AUTO_INCREMENT,
  `submission_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `formvalue` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`value_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=83 ;

--
-- Dumping data for table `customform_values`
--

INSERT INTO `customform_values` (`value_id`, `submission_id`, `component_id`, `formvalue`) VALUES
(1, 1, 10, 'test'),
(2, 1, 11, 'Male'),
(3, 1, 12, 'zXcZXC'),
(14, 11, 14, 'green'),
(13, 11, 11, 'Female'),
(12, 11, 10, ''),
(15, 11, 12, 'test'),
(16, 12, 10, 'My Name'),
(17, 12, 11, 'Female'),
(18, 12, 14, 'blue'),
(19, 12, 14, 'green'),
(20, 12, 14, 'red'),
(21, 12, 12, 'LOLOL'),
(30, 14, 12, 'lolz\r\n\r\nha'),
(29, 14, 14, 'blue'),
(28, 14, 11, 'Male'),
(27, 14, 10, 'yo'),
(31, 15, 10, 'asdf'),
(32, 15, 11, 'Female'),
(33, 15, 14, 'green'),
(34, 15, 12, 'sdf'),
(35, 16, 10, 'asdf'),
(36, 16, 11, 'Female'),
(37, 16, 14, 'green'),
(38, 16, 12, 'asdf'),
(39, 17, 10, 'asdf'),
(40, 17, 11, 'Female'),
(41, 17, 14, 'green'),
(42, 17, 12, 'asdf'),
(43, 18, 10, 'asdf'),
(44, 18, 11, 'Female'),
(45, 18, 14, 'green'),
(46, 18, 12, 'asdf'),
(50, 20, 11, 'Female'),
(49, 20, 10, 'asdf'),
(51, 20, 14, 'green'),
(52, 20, 12, 'asdf'),
(53, 21, 15, 'No'),
(54, 21, 16, 'No'),
(55, 22, 15, 'No'),
(56, 22, 16, 'No'),
(57, 23, 15, 'No'),
(58, 23, 16, 'No'),
(59, 24, 15, 'No'),
(60, 24, 16, 'No'),
(61, 25, 15, 'No'),
(62, 25, 16, 'No'),
(63, 26, 15, 'No'),
(64, 26, 16, 'No'),
(65, 27, 15, 'Yes'),
(66, 27, 16, 'Yes'),
(67, 28, 15, 'Yes'),
(68, 28, 16, 'Yes'),
(69, 29, 15, 'Yes'),
(70, 29, 16, 'Yes'),
(71, 30, 15, 'Yes'),
(72, 30, 16, 'Yes'),
(73, 31, 15, 'Yes'),
(74, 31, 16, 'Yes'),
(75, 32, 15, 'Yes'),
(76, 32, 16, 'Yes'),
(77, 33, 15, 'Yes'),
(78, 33, 16, 'Yes'),
(79, 34, 15, 'Yes'),
(80, 34, 16, 'Yes'),
(81, 35, 15, 'Yes'),
(82, 35, 16, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `custompages`
--

CREATE TABLE IF NOT EXISTS `custompages` (
  `custompage_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageinfo` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`custompage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `custompages`
--

INSERT INTO `custompages` (`custompage_id`, `pagename`, `pageinfo`) VALUES
(11, 'History', '<p style="text-align: center;">This is the clan history.</p>\n<p style="text-align: center;">&nbsp;</p>\n<p style="text-align: center;">This is actually just a custom page...</p>'),
(12, 'Rules', '<p style="text-align: center;">This is the clan rules page.</p>\n<p style="text-align: center;">&nbsp;</p>\n<p style="text-align: center;">This is actually<strong> just a</strong> custom page...</p>\n<p style="text-align: center;">&nbsp;</p>\n<p style="text-align: center;">&nbsp;</p>'),
(15, 'Test Videos', '<p><iframe src="http://www.youtube.com/embed/q3jR0gaqH6o?list=UUshoKvlZGZ20rVgazZp5vnQ" frameborder="0" width="560" height="315"></iframe></p>');

-- --------------------------------------------------------

--
-- Table structure for table `diplomacy`
--

CREATE TABLE IF NOT EXISTS `diplomacy` (
  `diplomacy_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `diplomacystatus_id` int(11) NOT NULL,
  `dateadded` int(11) NOT NULL,
  `clanname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `leaders` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clansize` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `clantag` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `skill` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gamesplayed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extrainfo` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`diplomacy_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diplomacy`
--

INSERT INTO `diplomacy` (`diplomacy_id`, `member_id`, `diplomacystatus_id`, `dateadded`, `clanname`, `leaders`, `website`, `clansize`, `clantag`, `skill`, `gamesplayed`, `extrainfo`) VALUES
(1, 13, 1, 1367095057, 'Test Clan', 'blah', '', 'small', '', '', 'lol', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `diplomacy_request`
--

CREATE TABLE IF NOT EXISTS `diplomacy_request` (
  `diplomacyrequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateadded` int(11) NOT NULL,
  `diplomacystatus_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clanname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clantag` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `clansize` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `gamesplayed` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `leaders` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `confirmemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`diplomacyrequest_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diplomacy_request`
--

INSERT INTO `diplomacy_request` (`diplomacyrequest_id`, `ipaddress`, `dateadded`, `diplomacystatus_id`, `email`, `name`, `clanname`, `clantag`, `clansize`, `gamesplayed`, `website`, `leaders`, `message`, `confirmemail`) VALUES
(1, '127.0.0.1', 1388099880, 1, 'sample@email.tst', 'tscbreqm', 'nhfditms', '17', 'small', '1', 'http://www.acunetix.com', '1', '20', '1');

-- --------------------------------------------------------

--
-- Table structure for table `diplomacy_status`
--

CREATE TABLE IF NOT EXISTS `diplomacy_status` (
  `diplomacystatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`diplomacystatus_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `diplomacy_status`
--

INSERT INTO `diplomacy_status` (`diplomacystatus_id`, `name`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`) VALUES
(1, 'Ally', 'images/diplomacy/status_50e3b3406ddf8.png', 0, 0, 3),
(2, 'Enemy', 'images/diplomacy/status_50e3b36d60f5a.png', 20, 20, 1),
(3, 'Neutral', 'images/diplomacy/status_50e3b37ebd1fc.png', 0, 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE IF NOT EXISTS `donations` (
  `donation_id` int(11) NOT NULL AUTO_INCREMENT,
  `donationcampaign_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `datesent` int(11) NOT NULL,
  `amount` decimal(62,2) NOT NULL,
  `hideamount` int(11) NOT NULL,
  `paypalemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `response` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`donation_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `donations_campaign`
--

CREATE TABLE IF NOT EXISTS `donations_campaign` (
  `donationcampaign_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `datestarted` int(11) NOT NULL,
  `dateend` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `recurringunit` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `recurringamount` int(11) NOT NULL,
  `currentperiod` int(11) NOT NULL,
  `goalamount` decimal(62,2) NOT NULL,
  `allowname` int(11) NOT NULL DEFAULT '1',
  `allowmessage` int(11) NOT NULL DEFAULT '1',
  `allowhiddenamount` int(11) NOT NULL,
  `minimumamount` decimal(65,2) NOT NULL,
  `awardmedal` int(11) NOT NULL,
  `currency` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`donationcampaign_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `donations_campaign`
--

INSERT INTO `donations_campaign` (`donationcampaign_id`, `member_id`, `datestarted`, `dateend`, `title`, `description`, `recurringunit`, `recurringamount`, `currentperiod`, `goalamount`, `allowname`, `allowmessage`, `allowhiddenamount`, `minimumamount`, `awardmedal`, `currency`) VALUES
(1, 13, 1402558532, 1420002000, 'Monthly Hosting', '', 'months', 1, 6, '10.00', 1, 1, 0, '0.00', 0, ''),
(2, 13, 1402557401, 1404100800, 'test campaign', 'lol', 'months', 1, 6, '500.00', 1, 1, 0, '1.00', 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `donations_errorlog`
--

CREATE TABLE IF NOT EXISTS `donations_errorlog` (
  `donationerror_id` int(11) NOT NULL AUTO_INCREMENT,
  `datesent` int(11) NOT NULL,
  `response` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`donationerror_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `downloadcategory`
--

CREATE TABLE IF NOT EXISTS `downloadcategory` (
  `downloadcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  `accesstype` int(11) NOT NULL,
  `specialkey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`downloadcategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `downloadcategory`
--

INSERT INTO `downloadcategory` (`downloadcategory_id`, `name`, `ordernum`, `accesstype`, `specialkey`) VALUES
(6, 'Replays', 2, 0, ''),
(5, 'Forum Attachments', 1, 0, 'forumattachments'),
(7, 'Videos', 3, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE IF NOT EXISTS `downloads` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `downloadcategory_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateuploaded` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mimetype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filesize` int(11) NOT NULL,
  `splitfile1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `splitfile2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `downloadcount` int(11) NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`download_id`, `downloadcategory_id`, `member_id`, `dateuploaded`, `name`, `filename`, `mimetype`, `filesize`, `splitfile1`, `splitfile2`, `description`, `downloadcount`) VALUES
(15, 5, 13, 1378008075, '', '218d8d91a9620cebcc6e3f695433c0dd.jpg', 'image/jpeg', 16527, 'downloads/files/forumattachment/split_13780080755222bc0bdd010', 'downloads/files/forumattachment/split_13780080755222bc0bdd2ef', '', 0),
(16, 5, 13, 1378008075, '', '1323032613_trophy.png', 'image/png', 15325, 'downloads/files/forumattachment/split_13780080755222bc0bdf090', 'downloads/files/forumattachment/split_13780080755222bc0bdf36d', '', 0),
(17, 5, 13, 1378008153, '', 'phpinfo.php', 'text/x-php', 62, 'downloads/files/forumattachment/split_13780081535222bc59dd1ac', 'downloads/files/forumattachment/split_13780081535222bc59dd4e3', '', 0),
(19, 5, 13, 1378064028, '', 'iframe.html', 'text/html', 533, 'downloads/files/forumattachment/split_13780640275223969bf3c19', 'downloads/files/forumattachment/split_13780640275223969bf3e57', '', 3),
(20, 6, 13, 1378273105, 'Test Download 2', 'SplatterSocialIcons.zip', 'application/zip', 75393, 'downloads/split_13782731055226c7515288f', 'downloads/split_13782731055226c75152b34', 'sdfasdf', 0),
(21, 6, 13, 1378273133, 'Test 2', 'php_filesplit2.zip', 'application/zip', 1588, 'downloads/split_13782731335226c76de5c3d', 'downloads/split_13782731335226c76de971a', 'asdfs', 0),
(22, 6, 13, 1378273157, 'lol', 'CamStudioCodec-1.4-w32.zip', 'application/zip', 34510, 'downloads/split_13782731575226c7854346f', 'downloads/split_13782731575226c785436fc', 'wut', 0),
(23, 7, 13, 1378273371, 'Flow', 'flowplayer-3.2.7.swf', 'application/x-shockwave-flash', 120221, 'downloads/split_13782733715226c85bceb21', 'downloads/split_13782733715226c85bd333e', 'yo', 0),
(24, 7, 13, 1378276276, 'test final', 'flowplayer-3.2.7.swf', 'application/x-shockwave-flash', 120221, 'downloads/files/split_13782762765226d3b47718a', 'downloads/files/split_13782762765226d3b47750d', 'asdfs', 2),
(25, 6, 13, 1394083893, 'test', 'filters-2.0.zip', 'application/zip', 11870, 'downloads/files/split_139408389353180835dd0c7', 'downloads/files/split_139408389353180835dd528', 'asdf', 1),
(26, 5, 0, 1401776295, '', '1287666826226.png', 'image/png', 130930, 'downloads/files/forumattachment/split_1401776295538d68a7df419', 'downloads/files/forumattachment/split_1401776295538d68a7dfbe9', '', 1),
(27, 5, 0, 1401776368, '', '1287666826226.png', 'image/png', 130930, 'downloads/files/forumattachment/split_1401776368538d68f050f4f', 'downloads/files/forumattachment/split_1401776368538d68f051337', '', 0),
(28, 5, 0, 1401776368, '', 'avatar_52de4d9a0c0c2.jpg', 'image/jpeg', 42069, 'downloads/files/forumattachment/split_1401776368538d68f059039', 'downloads/files/forumattachment/split_1401776368538d68f059809', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `download_extensions`
--

CREATE TABLE IF NOT EXISTS `download_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `downloadcategory_id` int(11) NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `download_extensions`
--

INSERT INTO `download_extensions` (`extension_id`, `downloadcategory_id`, `extension`) VALUES
(10, 6, '.zip'),
(9, 5, ''),
(11, 6, '.rep'),
(17, 7, '.avi'),
(16, 7, '.wmv'),
(15, 7, '.mov'),
(18, 7, '.swf');

-- --------------------------------------------------------

--
-- Table structure for table `eventchat`
--

CREATE TABLE IF NOT EXISTS `eventchat` (
  `eventchat_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `datestarted` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`eventchat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `eventchat`
--

INSERT INTO `eventchat` (`eventchat_id`, `event_id`, `datestarted`, `status`) VALUES
(1, 1, 1362366001, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eventchat_messages`
--

CREATE TABLE IF NOT EXISTS `eventchat_messages` (
  `eventchatmessage_id` int(11) NOT NULL AUTO_INCREMENT,
  `eventchat_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`eventchatmessage_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventchat_roomlist`
--

CREATE TABLE IF NOT EXISTS `eventchat_roomlist` (
  `eventchatlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `eventchat_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `inactive` int(11) NOT NULL,
  `lastseen` int(11) NOT NULL,
  PRIMARY KEY (`eventchatlist_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `eventmessages`
--

CREATE TABLE IF NOT EXISTS `eventmessages` (
  `eventmessage_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`eventmessage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `eventmessages`
--

INSERT INTO `eventmessages` (`eventmessage_id`, `event_id`, `member_id`, `dateposted`, `message`) VALUES
(12, 6, 13, 1399022225, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `eventmessage_comment`
--

CREATE TABLE IF NOT EXISTS `eventmessage_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `eventmessage_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `comment` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `eventmessage_comment`
--

INSERT INTO `eventmessage_comment` (`comment_id`, `eventmessage_id`, `member_id`, `dateposted`, `comment`) VALUES
(23, 12, 13, 1399022418, 'lol');

-- --------------------------------------------------------

--
-- Table structure for table `eventpositions`
--

CREATE TABLE IF NOT EXISTS `eventpositions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  `modchat` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invitemembers` int(11) NOT NULL,
  `manageinvites` int(11) NOT NULL,
  `postmessages` int(11) NOT NULL,
  `managemessages` int(11) NOT NULL,
  `attendenceconfirm` int(11) NOT NULL,
  `editinfo` int(11) NOT NULL,
  `eventpositions` int(11) NOT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startdate` int(11) NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enddate` int(11) NOT NULL,
  `publicprivate` int(11) NOT NULL,
  `visibility` int(11) NOT NULL,
  `messages` int(11) NOT NULL,
  `invitepermission` int(11) NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `member_id`, `title`, `description`, `location`, `startdate`, `timezone`, `enddate`, `publicprivate`, `visibility`, `messages`, `invitepermission`) VALUES
(4, 47, 'test', 'asdf', 'asdf', 1404100800, '', 0, 0, 0, 1, 0),
(6, 13, 'Test Event', '', '', 1395360000, 'Africa/Abidjan', 0, 0, 0, 0, 0),
(7, 13, 'Test Timezone Events', '', '', 1395619200, 'America/New_York', 0, 0, 0, 0, 0),
(8, 13, 'Test Event 453', 'this\r\n\r\nis a \r\n\r\ntest', '', 1408471620, '', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `events_members`
--

CREATE TABLE IF NOT EXISTS `events_members` (
  `eventmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `invitedbymember_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `attendconfirm_admin` int(11) NOT NULL,
  `attendconfirm_member` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  PRIMARY KEY (`eventmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `failban`
--

CREATE TABLE IF NOT EXISTS `failban` (
  `failban_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`failban_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `failban`
--

INSERT INTO `failban` (`failban_id`, `pagename`, `ipaddress`) VALUES
(8, 'editconsoleoption', '127.0.0.1'),
(9, 'editconsoleoption', '127.0.0.1');

-- --------------------------------------------------------

--
-- Table structure for table `forgotpass`
--

CREATE TABLE IF NOT EXISTS `forgotpass` (
  `rqid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `changekey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timeofrq` int(11) NOT NULL,
  PRIMARY KEY (`rqid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_attachments`
--

CREATE TABLE IF NOT EXISTS `forum_attachments` (
  `forumattachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `forumpost_id` int(11) NOT NULL,
  `download_id` int(11) NOT NULL,
  PRIMARY KEY (`forumattachment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `forum_attachments`
--

INSERT INTO `forum_attachments` (`forumattachment_id`, `forumpost_id`, `download_id`) VALUES
(17, 30, 17),
(16, 29, 16),
(15, 29, 15),
(18, 31, 19),
(19, 87, 26),
(20, 88, 27),
(21, 88, 28);

-- --------------------------------------------------------

--
-- Table structure for table `forum_board`
--

CREATE TABLE IF NOT EXISTS `forum_board` (
  `forumboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `forumcategory_id` int(11) NOT NULL,
  `subforum_id` int(11) NOT NULL,
  `lastpost_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `accesstype` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`forumboard_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `forum_board`
--

INSERT INTO `forum_board` (`forumboard_id`, `forumcategory_id`, `subforum_id`, `lastpost_id`, `name`, `description`, `accesstype`, `sortnum`) VALUES
(4, 1, 16, 0, 'Minecraft', '', 0, 1),
(5, 1, 6, 0, 'Guild Wars', '', 1, 1),
(6, 1, 0, 0, 'Games Chat', 'Talk about games here!', 0, 5),
(7, 6, 0, 0, 'War Discussion', 'Discuss who we want to war next!', 0, 1),
(11, 1, 0, 0, 'Leadership', 'A place for leaders to discuss the future of the clan', 0, 4),
(12, 1, 0, 0, 'Events', 'Talk about events going on with the clan here!', 0, 3),
(16, 1, 5, 0, 'World of Warcraft', '', 0, 1),
(17, 1, 0, 0, 'Clan Information', 'Discuss clan information here!', 0, 2),
(18, 1, 0, 0, 'General Discussion', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_category`
--

CREATE TABLE IF NOT EXISTS `forum_category` (
  `forumcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`forumcategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `forum_category`
--

INSERT INTO `forum_category` (`forumcategory_id`, `name`, `ordernum`) VALUES
(1, 'General', 2),
(6, 'Clan Wars', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forum_memberaccess`
--

CREATE TABLE IF NOT EXISTS `forum_memberaccess` (
  `forummemberaccess_id` int(11) NOT NULL AUTO_INCREMENT,
  `board_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `accessrule` int(11) NOT NULL,
  PRIMARY KEY (`forummemberaccess_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_moderator`
--

CREATE TABLE IF NOT EXISTS `forum_moderator` (
  `forummoderator_id` int(11) NOT NULL AUTO_INCREMENT,
  `forumboard_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateadded` int(11) NOT NULL,
  PRIMARY KEY (`forummoderator_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `forum_moderator`
--

INSERT INTO `forum_moderator` (`forummoderator_id`, `forumboard_id`, `member_id`, `dateadded`) VALUES
(1, 7, 48, 1369358889),
(5, 5, 46, 1369360045),
(7, 6, 46, 1369360050),
(8, 12, 46, 1393534312);

-- --------------------------------------------------------

--
-- Table structure for table `forum_post`
--

CREATE TABLE IF NOT EXISTS `forum_post` (
  `forumpost_id` int(11) NOT NULL AUTO_INCREMENT,
  `forumtopic_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lastedit_date` int(11) NOT NULL,
  `lastedit_member_id` int(11) NOT NULL,
  PRIMARY KEY (`forumpost_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=90 ;

--
-- Dumping data for table `forum_post`
--

INSERT INTO `forum_post` (`forumpost_id`, `forumtopic_id`, `member_id`, `dateposted`, `title`, `message`, `lastedit_date`, `lastedit_member_id`) VALUES
(1, 1, 13, 1368818879, 'First POst!', 'lol', 0, 0),
(2, 2, 13, 1368819256, 'SEcond POST!', 'lol', 0, 0),
(5, 4, 13, 1368999458, 'A forum!', '<p>finally!</p>', 0, 0),
(7, 1, 48, 1369106020, '', '<p>[quote]<a href="../forum/viewtopic.php?tID=1#1">Originally posted by admin:</a>lol[/quote]</p>\r\n<p>&nbsp;</p>\r\n<p>ha what a joke</p>', 0, 0),
(9, 4, 48, 1369197213, '', '<p>oooooo a reply<img title="Surprised" src="../js/tiny_mce/plugins/emotions/img/smiley-surprised.gif" alt="Surprised" border="0" /></p>', 0, 0),
(10, 2, 48, 1369197313, '', '<p>asdf</p>', 0, 0),
(12, 2, 48, 1369197769, '', '<p>haha111</p>', 1369628678, 13),
(14, 2, 13, 1369620467, '', '<p>[quote]<a href="../forum/viewtopic.php?tID=2#12">Originally posted by NewMember:</a></p>\r\n<p>haha</p>\r\n<p><br />[/quote]</p>\r\n<p>&nbsp;</p>\r\n<p>LOL!!!</p>', 0, 0),
(17, 8, 48, 1369707734, 'test', '<p>asdf</p>', 0, 0),
(18, 8, 13, 1369707749, '', '<p>haha lol</p>', 0, 0),
(20, 10, 48, 1371708420, 'testing auto updates', '<p>asdfasdfs</p>', 0, 0),
(21, 11, 13, 1377056196, 'test', '<p>[youtube]https://www.youtube.com/watch?v=YQ-2JXUZO_4[/youtube]</p>', 0, 0),
(22, 12, 13, 1377996789, 'test attachments', '<p>asdf</p>', 0, 0),
(24, 12, 13, 1378001511, '', '<p>test</p>', 0, 0),
(25, 12, 13, 1378001535, '', '<p>test</p>', 0, 0),
(26, 12, 13, 1378001584, '', '<p>test</p>', 0, 0),
(27, 12, 13, 1378001830, '', '<p>test 2</p>', 0, 0),
(28, 12, 13, 1378001896, '', '<p>asdfsadf</p>', 0, 0),
(29, 12, 13, 1378008075, '', '<p>test 3</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>sdf</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>test</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>asdfasd</p>', 1400130645, 13),
(30, 12, 13, 1378008153, '', '<p>test php attachment</p>', 0, 0),
(31, 10, 13, 1378064028, '', '<p>sdf</p>', 0, 0),
(32, 13, 13, 1378690354, 'Test', '<p>asdfsad</p>', 0, 0),
(33, 14, 13, 1378690379, 'test22', '<p>asdfsd</p>', 0, 0),
(34, 13, 13, 1378690542, '', '<p>asdfsadf</p>', 0, 0),
(35, 15, 13, 1378690551, 'asdfasd', '<p>sdfsadf</p>', 0, 0),
(36, 10, 13, 1382408784, '', '<p>[youtube]http://www.youtube.com/watch?v=WWwaJzM2CFM[/youtube]</p>', 0, 0),
(37, 10, 13, 1382408799, '', '<p>[twitch]http://www.twitch.tv/ksiolajidebt[/twitch]</p>', 0, 0),
(38, 16, 63, 1387995913, 'Test Topic', '<p>hi buddy</p>', 0, 0),
(39, 17, 63, 1388025943, 'hey', '<p>yo</p>', 0, 0),
(40, 18, 57, 1388344884, 'sdfg', '<p>sdfg</p>', 0, 0),
(41, 4, 63, 1389204199, '', '<p>test</p>', 0, 0),
(42, 19, 13, 1389476752, 'hello?', '<p>asdf</p>', 0, 0),
(43, 19, 13, 1389476858, '', '<p>asdf</p>\r\n<p>&nbsp;</p>\r\n<p><img src="http://i41.tinypic.com/2z9mwr7.jpg" alt="" /></p>', 0, 0),
(44, 20, 13, 1390168198, 'hello', '<p>asdf</p>', 0, 0),
(46, 20, 13, 1390168233, '', '<p>yo</p>', 0, 0),
(49, 19, 13, 1391649907, '', '<p><script></p>\r\n<p>alert(''hi'');</p>\r\n<p></script></p>', 0, 0),
(50, 21, 46, 1393534112, 'test', '<p>asdf</p>', 0, 0),
(51, 18, 13, 1395011980, '', '<p>[poll]7[/poll]</p>', 0, 0),
(52, 20, 13, 1395344038, '', '<p>[poll]1[/poll]</p>', 0, 0),
(53, 22, 13, 1395345869, 'Very long forum post title lol', '<p>asdfasdfasdf</p>', 0, 0),
(54, 23, 13, 1395345891, 'Server Promotion Video', '<p>asdf</p>', 0, 0),
(55, 22, 13, 1396298865, '', '<p>[code]tessssssssssssssssssssssssssssssssssssslibs/jquery.slimscroll.min.jsssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssst[/code]</p>', 1396298884, 13),
(56, 24, 13, 1398621463, 'New /Gone Members/ & NEWS *April Edition*', '<p>test</p>', 0, 0),
(57, 2, 13, 1400121526, '', '<p>[quote]<a href="../forum/viewtopic.php?tID=2#2">Originally posted by admin:</a><br />lol<br />[/quote]</p>', 0, 0),
(58, 12, 13, 1400175125, '', '<p>another</p>', 0, 0),
(59, 12, 13, 1400175130, '', '<p>another 1</p>', 0, 0),
(60, 12, 13, 1400175135, '', '<p>another 2</p>', 0, 0),
(64, 28, 13, 1400318941, 'MOVED - hello?', 'This topic has been moved to <a href=''/cs4/forum/viewboard.php?bID=18''>General Discussion</a>.\r\n\r\n<a href=''/cs4/forum/viewtopic.php?tID=19''>hello?</a>', 0, 0),
(65, 29, 13, 1400319193, 'MOVED - MOVED - hello?', 'This topic has been moved to <a href=''/cs4/forum/viewboard.php?bID=18''>General Discussion</a>.\r\n\r\n<a href=''/cs4/forum/viewtopic.php?tID=28''>MOVED - hello?</a>\n\n\n<p class=''tinyFont''><i>Moved by <span style=''color: #7FFF00''><a href=''/cs4/profile.php?mID=13'' style=''color: '' title=''admin''>admin</a></span></i></p>', 0, 0),
(66, 30, 13, 1400319491, 'MOVED - MOVED - MOVED - hello?', 'This topic has been moved to <a href=''/cs4/forum/viewboard.php?bID=18''>General Discussion</a>.\r\n\r\n<a href=''/cs4/forum/viewtopic.php?tID=29''>MOVED - MOVED - hello?</a>\n\n\n<p class=''tinyFont''><i>Moved by <span style=''color: #7FFF00''><a href=''/cs4/profile.php?mID=13'' style=''color: '' title=''admin''>admin</a></span> on Sat May 17, 2014 9:38 am</i></p>', 0, 0),
(67, 31, 13, 1401386428, 'test tables', '<table>\r\n<tbody>\r\n<tr>\r\n<td>Name</td>\r\n<td>Attack1</td>\r\n<td>Attack2</td>\r\n<td>Total Stars</td>\r\n</tr>\r\n<tr>\r\n<td>Ylenor</td>\r\n<td>0 Stars</td>\r\n<td>3 Stars</td>\r\n<td>3 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>Micheal</td>\r\n<td>3 Stars</td>\r\n<td>&nbsp;</td>\r\n<td>3 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>Ryanrich</td>\r\n<td>1 Star</td>\r\n<td>3 Stars</td>\r\n<td>4 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>fritz</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Neil</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>jd_deeps</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>duff</td>\r\n<td>2 Stars</td>\r\n<td>1 Star</td>\r\n<td>3 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>dejemreynz</td>\r\n<td>3 Stars</td>\r\n<td>1 Star</td>\r\n<td>4 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>Nasrul</td>\r\n<td>2 Stars</td>\r\n<td>1 Star</td>\r\n<td>3 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>AlexZ</td>\r\n<td>2 Stars</td>\r\n<td>&nbsp;</td>\r\n<td>2 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>Noel</td>\r\n<td>0 Stars</td>\r\n<td>2 Stars</td>\r\n<td>2 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>Eno</td>\r\n<td>3 Stars</td>\r\n<td>1 Star</td>\r\n<td>4 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>gamyl</td>\r\n<td>1 Star</td>\r\n<td>3 Stars</td>\r\n<td>4 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>Eyecu</td>\r\n<td>6 Stars</td>\r\n<td>6 Stars</td>\r\n<td>6 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>ADAMsGOIN</td>\r\n<td>3 Stars</td>\r\n<td>3 Stars</td>\r\n<td>6 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>tdogg 63</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Sir Matthew</td>\r\n<td>3 Stars</td>\r\n<td>3 Stars</td>\r\n<td>6 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>littledojo</td>\r\n<td>3 Stars</td>\r\n<td>&nbsp;</td>\r\n<td>3 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>tanks n spanks</td>\r\n<td>2 Stars</td>\r\n<td>3 Stars</td>\r\n<td>5 Stars</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 23px;">jfhfj</td>\r\n<td style="height: 23px;">&nbsp;</td>\r\n<td style="height: 23px;">&nbsp;</td>\r\n<td style="height: 23px;">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Janz Cuevas</td>\r\n<td>1 Star</td>\r\n<td>&nbsp;</td>\r\n<td>1 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>daniel</td>\r\n<td>0 Stars</td>\r\n<td>1 Star</td>\r\n<td>1 Star</td>\r\n</tr>\r\n<tr>\r\n<td>Spartans</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>Nevar</td>\r\n<td>3 Stars</td>\r\n<td>0 Stars</td>\r\n<td>3 Stars</td>\r\n</tr>\r\n<tr>\r\n<td>nav</td>\r\n<td>0 Stars</td>\r\n<td>1 Star</td>\r\n<td>1 Star</td>\r\n</tr>\r\n<tr>\r\n<td>Nitro Dallas</td>\r\n<td>1 Star</td>\r\n<td>&nbsp;</td>\r\n<td>1 Star</td>\r\n</tr>\r\n<tr>\r\n<td>joshua</td>\r\n<td>0 Stars</td>\r\n<td>1 Star</td>\r\n<td>1 Star</td>\r\n</tr>\r\n<tr>\r\n<td>MonsterPiggy</td>\r\n<td>0 Stars</td>\r\n<td>1 Star</td>\r\n<td>1 Star</td>\r\n</tr>\r\n<tr>\r\n<td>CoopDog 58</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td>lady</td>\r\n<td>2 Stars</td>\r\n<td>0 Stars</td>\r\n<td>2 Stars</td>\r\n</tr>\r\n</tbody>\r\n</table>', 0, 0),
(70, 34, 13, 1401773947, 'test22222', '<p>asdfasdfsdf</p>', 0, 0),
(71, 0, 13, 1401774039, '', '<p>asdsdfsadf lol</p>', 0, 0),
(72, 34, 13, 1401774690, '', '<p>dfg</p>', 0, 0),
(73, 34, 13, 1401774953, '', '<p>test attachment</p>', 0, 0),
(74, 34, 13, 1401775141, '', '<p>test reply2</p>', 0, 0),
(75, 34, 13, 1401775220, '', '<p>test reply2</p>', 0, 0),
(76, 34, 13, 1401775967, '', '<p>asdf</p>', 0, 0),
(77, 34, 13, 1401776013, '', '<p>asdf</p>', 0, 0),
(78, 34, 13, 1401776039, '', '<p>asdf</p>', 0, 0),
(79, 34, 13, 1401776075, '', '<p>asdf</p>', 0, 0),
(80, 34, 13, 1401776124, '', '<p>asdf</p>', 0, 0),
(81, 34, 13, 1401776185, '', '<p>asdf</p>', 0, 0),
(82, 34, 13, 1401776199, '', '<p>asdf</p>', 0, 0),
(83, 34, 13, 1401776222, '', '<p>asdf</p>', 0, 0),
(84, 34, 13, 1401776239, '', '<p>asdf</p>', 0, 0),
(85, 34, 13, 1401776256, '', '<p>asdf</p>', 0, 0),
(86, 34, 13, 1401776269, '', '<p>asdf</p>', 0, 0),
(87, 34, 13, 1401776295, '', '<p>asdf</p>', 0, 0),
(88, 34, 13, 1401776368, '', '<p>test attachment3</p>', 0, 0),
(89, 35, 13, 1401825656, 'test3', '<p>test</p>\r\n', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_rankaccess`
--

CREATE TABLE IF NOT EXISTS `forum_rankaccess` (
  `forumrankaccess_id` int(11) NOT NULL AUTO_INCREMENT,
  `board_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `accesstype` int(11) NOT NULL,
  PRIMARY KEY (`forumrankaccess_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=73 ;

--
-- Dumping data for table `forum_rankaccess`
--

INSERT INTO `forum_rankaccess` (`forumrankaccess_id`, `board_id`, `rank_id`, `accesstype`) VALUES
(72, 5, 66, 0),
(71, 5, 65, 0),
(70, 5, 64, 0),
(69, 5, 31, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `forumtopic_id` int(11) NOT NULL AUTO_INCREMENT,
  `forumboard_id` int(11) NOT NULL,
  `forumpost_id` int(11) NOT NULL,
  `lastpost_id` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `replies` int(11) NOT NULL,
  `lockstatus` int(11) NOT NULL,
  `stickystatus` int(11) NOT NULL,
  PRIMARY KEY (`forumtopic_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `forum_topic`
--

INSERT INTO `forum_topic` (`forumtopic_id`, `forumboard_id`, `forumpost_id`, `lastpost_id`, `views`, `replies`, `lockstatus`, `stickystatus`) VALUES
(1, 4, 1, 7, 42, 1, 0, 1),
(2, 4, 2, 57, 221, 6, 0, 0),
(4, 6, 5, 41, 64, 2, 0, 0),
(8, 4, 17, 18, 167, 1, 0, 0),
(10, 4, 20, 37, 36, 3, 0, 0),
(11, 5, 21, 21, 44, 0, 0, 0),
(12, 6, 22, 60, 106, 11, 0, 0),
(13, 5, 32, 34, 3, 1, 0, 0),
(14, 5, 33, 33, 2, 0, 0, 0),
(15, 5, 35, 35, 6, 0, 0, 0),
(16, 6, 38, 38, 6, 0, 0, 0),
(17, 4, 39, 39, 5, 0, 0, 0),
(18, 18, 40, 51, 18, 1, 0, 0),
(19, 18, 42, 49, 74, 2, 0, 0),
(20, 18, 44, 52, 32, 5, 0, 0),
(21, 12, 50, 50, 7, 0, 1, 1),
(22, 11, 53, 55, 15, 1, 0, 0),
(23, 11, 54, 54, 2, 0, 0, 0),
(24, 18, 56, 56, 70, 0, 0, 0),
(25, 7, 61, 61, 0, 0, 1, 0),
(28, 18, 64, 64, 5, 0, 1, 0),
(29, 18, 65, 65, 4, 0, 1, 0),
(30, 17, 66, 66, 5, 0, 1, 0),
(31, 6, 67, 67, 2, 0, 0, 0),
(34, 11, 70, 88, 9, 17, 0, 0),
(35, 6, 89, 89, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topicseen`
--

CREATE TABLE IF NOT EXISTS `forum_topicseen` (
  `forumtopicseen_id` int(11) NOT NULL AUTO_INCREMENT,
  `forumtopic_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`forumtopicseen_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `forum_topicseen`
--

INSERT INTO `forum_topicseen` (`forumtopicseen_id`, `forumtopic_id`, `member_id`) VALUES
(4, 1, 13),
(10, 1, 48),
(16, 6, 48),
(17, 7, 48),
(20, 8, 13),
(21, 8, 48),
(22, 9, 47),
(24, 11, 13),
(34, 14, 13),
(35, 13, 13),
(36, 15, 13),
(38, 10, 13),
(39, 16, 63),
(40, 17, 63),
(42, 4, 63),
(43, 4, 13),
(51, 19, 13),
(52, 21, 46),
(53, 18, 13),
(54, 20, 13),
(56, 23, 13),
(57, 22, 13),
(58, 24, 13),
(59, 2, 13),
(62, 12, 13),
(65, 28, 13),
(66, 29, 13),
(67, 30, 13),
(68, 31, 13),
(69, 33, 13),
(70, 34, 13),
(71, 35, 13);

-- --------------------------------------------------------

--
-- Table structure for table `freezemedals_members`
--

CREATE TABLE IF NOT EXISTS `freezemedals_members` (
  `freezemedal_id` int(11) NOT NULL AUTO_INCREMENT,
  `medal_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `freezetime` int(11) NOT NULL,
  PRIMARY KEY (`freezemedal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `freezemedals_members`
--

INSERT INTO `freezemedals_members` (`freezemedal_id`, `medal_id`, `member_id`, `freezetime`) VALUES
(6, 8, 48, 1397074545);

-- --------------------------------------------------------

--
-- Table structure for table `gamesplayed`
--

CREATE TABLE IF NOT EXISTS `gamesplayed` (
  `gamesplayed_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`gamesplayed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `gamesplayed`
--

INSERT INTO `gamesplayed` (`gamesplayed_id`, `name`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`) VALUES
(7, 'Minecraft', 'images/gamesplayed/game_501f58d5683e4.png', 32, 32, 1),
(9, 'World of Warcraft', 'images/gamesplayed/game_508dc7963ba36.png', 0, 0, 4),
(12, 'Black Ops 2', 'images/gamesplayed/game_522d32661c6b3.png', 40, 40, 6),
(5, 'Starcraft', 'images/gamesplayed/game_4fc70ad0a7ab8.gif', 28, 14, 3),
(8, 'Call of Duty', 'images/gamesplayed/game_508dc503812e7.png', 60, 15, 2),
(2, 'Starcraft 2', 'images/gamesplayed/game_4f9dc59c97b06.png', 48, 48, 5);

-- --------------------------------------------------------

--
-- Table structure for table `gamesplayed_members`
--

CREATE TABLE IF NOT EXISTS `gamesplayed_members` (
  `gamemember_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamesplayed_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`gamemember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=219 ;

--
-- Dumping data for table `gamesplayed_members`
--

INSERT INTO `gamesplayed_members` (`gamemember_id`, `gamesplayed_id`, `member_id`) VALUES
(217, 7, 13),
(216, 8, 13),
(18, 2, 48),
(215, 5, 13),
(19, 7, 48),
(214, 9, 13),
(213, 2, 13),
(212, 12, 13),
(218, 12, 65);

-- --------------------------------------------------------

--
-- Table structure for table `gamestats`
--

CREATE TABLE IF NOT EXISTS `gamestats` (
  `gamestats_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamesplayed_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stattype` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `calcop` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `firststat_id` int(11) NOT NULL,
  `secondstat_id` int(11) NOT NULL,
  `decimalspots` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `hidestat` int(11) NOT NULL,
  `textinput` int(11) NOT NULL,
  PRIMARY KEY (`gamestats_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `gamestats`
--

INSERT INTO `gamestats` (`gamestats_id`, `gamesplayed_id`, `name`, `stattype`, `calcop`, `firststat_id`, `secondstat_id`, `decimalspots`, `ordernum`, `hidestat`, `textinput`) VALUES
(12, 12, 'K/D Ratio', 'input', '', 0, 0, 2, 0, 0, 0),
(8, 9, 'Level', 'input', '', 0, 0, 0, 0, 0, 0),
(7, 2, 'Losses', 'input', '', 0, 0, 0, 1, 0, 0),
(13, 12, 'Kills', 'input', '', 0, 0, 0, 1, 0, 0),
(14, 12, 'Deaths', 'input', '', 0, 0, 0, 2, 0, 0),
(6, 2, 'Wins', 'input', '', 0, 0, 0, 0, 0, 0),
(5, 5, 'Losses', 'input', '', 0, 0, 0, 1, 0, 0),
(4, 5, 'Wins', 'input', '', 0, 0, 0, 0, 0, 0),
(1, 8, 'K/D Ratio', 'calculate', 'div', 2, 3, 2, 0, 0, 0),
(2, 8, 'Kills', 'input', '', 0, 0, 0, 1, 0, 0),
(3, 8, 'Deaths', 'input', '', 0, 0, 0, 2, 0, 0),
(18, 12, 'New Stat', 'input', '', 0, 0, 1, 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gamestats_members`
--

CREATE TABLE IF NOT EXISTS `gamestats_members` (
  `gamestatmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamestats_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `statvalue` decimal(65,30) NOT NULL,
  `stattext` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateupdated` int(11) NOT NULL,
  PRIMARY KEY (`gamestatmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `gamestats_members`
--

INSERT INTO `gamestats_members` (`gamestatmember_id`, `gamestats_id`, `member_id`, `statvalue`, `stattext`, `dateupdated`) VALUES
(29, 4, 13, '9.000000000000000000000000000000', '', 1396746366),
(28, 8, 13, '7.000000000000000000000000000000', '', 1396746366),
(27, 7, 13, '5.000000000000000000000000000000', '', 1396746366),
(26, 6, 13, '1.000000000000000000000000000000', '', 1396746366),
(25, 18, 13, '1.310000000000000000000000000000', '', 1396746366),
(24, 14, 13, '101.000000000000000000000000000000', '', 1396746366),
(23, 13, 13, '51.000000000000000000000000000000', '', 1396746366),
(22, 12, 13, '2.450000000000000000000000000000', '', 1396746366),
(30, 5, 13, '8.000000000000000000000000000000', '', 1396746366),
(31, 2, 13, '1.000000000000000000000000000000', '', 1396746366),
(32, 3, 13, '77.000000000000000000000000000000', '', 1396746366);

-- --------------------------------------------------------

--
-- Table structure for table `hitcounter`
--

CREATE TABLE IF NOT EXISTS `hitcounter` (
  `hit_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dateposted` int(11) NOT NULL,
  `pagename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `totalhits` int(11) NOT NULL,
  PRIMARY KEY (`hit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Dumping data for table `hitcounter`
--

INSERT INTO `hitcounter` (`hit_id`, `ipaddress`, `dateposted`, `pagename`, `totalhits`) VALUES
(1, '::1', 1379122845, 'Forum - ', 380608),
(2, '::1', 1365366291, 'Website Settings - ', 0),
(3, '::1', 1365366295, '', 0),
(4, '::1', 1365366308, '', 0),
(5, '::1', 1365367097, '', 0),
(6, '::1', 1365367117, '', 0),
(7, '::1', 1365367142, '', 0),
(8, '::1', 1365367215, '', 0),
(9, '::1', 1365367342, '', 0),
(10, '::1', 1365367360, '', 0),
(11, '::1', 1365367386, '', 0),
(12, '::1', 1365367396, '', 0),
(13, '::1', 1365367411, '', 0),
(14, '::1', 1365367487, '', 0),
(15, '::1', 1365367550, '', 0),
(16, '::1', 1365367593, '', 0),
(17, '::1', 1365370145, '', 0),
(18, '::1', 1365370174, '', 0),
(19, '::1', 1365370241, '', 0),
(20, '::1', 1365370368, '', 0),
(21, '::1', 1365370378, '', 0),
(22, '::1', 1365370618, '', 0),
(23, '::1', 1365370660, '', 0),
(24, '::1', 1365370917, '', 0),
(25, '::1', 1365370966, '', 0),
(26, '::1', 1365370980, '', 0),
(27, '::1', 1365371002, '', 0),
(28, '::1', 1365371009, '', 0),
(29, '::1', 1365371018, '', 0),
(30, '::1', 1365371066, '', 0),
(31, '::1', 1365371079, '', 0),
(32, '::1', 1365371092, '', 0),
(33, '::1', 1365371099, '', 0),
(34, '::1', 1365371108, '', 0),
(35, '::1', 1365371126, '', 0),
(36, '::1', 1365964355, 'Website Settings - ', 0),
(37, '::1', 1365966739, 'Website Settings - ', 0),
(38, '::1', 1365968370, 'Test Squad - ', 0),
(39, '::1', 1365969988, 'Website Settings - ', 0),
(40, '::1', 1365970037, 'Members - ', 0),
(41, '::1', 1366246534, 'My Account - ', 0),
(42, '::1', 1366246540, 'Add Custom Form Page - ', 0),
(43, '::1', 1366246561, 'My Account - ', 0),
(44, '::1', 1366246566, 'Website Settings - ', 0),
(45, '::1', 1367036255, '', 0),
(46, '::1', 1367036300, '', 0),
(47, '::1', 1367036601, '', 0),
(48, '::1', 1367047015, 'My Account - ', 0),
(49, '::1', 1367047016, '', 0),
(50, '::1', 1367047020, '', 0),
(51, '::1', 1367047020, '', 0),
(52, '::1', 1367047023, 'My Account - ', 0),
(53, '::1', 1367047131, 'My Account - ', 0),
(54, '::1', 1367047133, 'Member''s Only Pages - ', 0),
(55, '::1', 1367047163, 'Member''s Only Pages - ', 0),
(56, '::1', 1367047388, 'Member''s Only Pages - ', 0),
(57, '::1', 1367047443, 'Member''s Only Pages - ', 0),
(58, '::1', 1367047468, 'Member''s Only Pages - ', 0),
(59, '::1', 1367047496, 'Member''s Only Pages - ', 0),
(60, '::1', 1367047516, 'Member''s Only Pages - ', 0),
(61, '::1', 1367047586, 'Member''s Only Pages - ', 0),
(62, '::1', 1367047598, 'My Account - ', 0),
(63, '::1', 1367047602, 'Website Settings - ', 0),
(64, '::1', 1367093884, 'Website Settings - ', 0),
(65, '::1', 1367105446, 'News - ', 0),
(66, '::1', 1367105559, 'News - ', 0),
(67, '::1', 1367105562, 'test - News - ', 0),
(68, '::1', 1367105582, 'test - News - ', 0),
(69, '::1', 1367105584, '', 0),
(70, '::1', 1367107870, 'Diplomacy Request - ', 0),
(71, '::1', 1367107874, 'Events - ', 0),
(72, '::1', 1367107876, 'Test Event2 - ', 0),
(73, '::1', 1367107878, 'News - ', 0),
(74, '::1', 1367107891, 'My Account - ', 0),
(75, '::1', 1367107894, 'Manage Tournaments - ', 0),
(76, '::1', 1367107896, 'Tournaments - Manage Tournaments - ', 0),
(77, '::1', 1367107904, 'My Account - ', 0),
(78, '10.158.26.104', 1371182493, 'Private Messages - ', 33),
(79, '10.158.26.136', 1371182497, 'My Account - ', 55),
(80, '127.0.0.1', 1402681660, 'Manage Download Categories - ', 103259);

-- --------------------------------------------------------

--
-- Table structure for table `iarequest`
--

CREATE TABLE IF NOT EXISTS `iarequest` (
  `iarequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `requestdate` int(11) NOT NULL,
  `reason` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `requeststatus` int(11) NOT NULL,
  `reviewer_id` int(11) NOT NULL,
  `reviewdate` int(11) NOT NULL,
  PRIMARY KEY (`iarequest_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `iarequest`
--

INSERT INTO `iarequest` (`iarequest_id`, `member_id`, `requestdate`, `reason`, `requeststatus`, `reviewer_id`, `reviewdate`) VALUES
(3, 43, 1388623129, 'IA ME PLZ', 1, 13, 1388623414),
(4, 63, 1388730456, 'plz', 1, 13, 1388730466),
(5, 13, 1396742352, 'test request', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `iarequest_messages`
--

CREATE TABLE IF NOT EXISTS `iarequest_messages` (
  `iamessage_id` int(11) NOT NULL AUTO_INCREMENT,
  `iarequest_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `messagedate` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`iamessage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `iarequest_messages`
--

INSERT INTO `iarequest_messages` (`iamessage_id`, `iarequest_id`, `member_id`, `messagedate`, `message`) VALUES
(1, 1, 48, 1388609799, 'test message'),
(3, 1, 48, 1388610597, 'test asdf'),
(4, 1, 48, 1388610615, 'kk'),
(6, 1, 13, 1388614519, 'asdf'),
(7, 1, 13, 1388614526, 'hello'),
(8, 2, 13, 1388617870, 'test'),
(9, 2, 13, 1388617894, 'asdf'),
(10, 1, 13, 1388617960, 'asdf'),
(11, 1, 13, 1388617978, 'asdf'),
(12, 2, 13, 1388617984, 'sdfs'),
(13, 1, 13, 1388617990, 'ssss'),
(14, 2, 13, 1388619919, 'asdf'),
(15, 2, 13, 1388619921, 'sss'),
(16, 2, 13, 1388619924, '1'),
(17, 2, 13, 1388620318, 'test'),
(18, 2, 13, 1388620385, 'test2'),
(19, 3, 13, 1388623373, 'hey what kind of reason is that'),
(20, 3, 43, 1388623385, 'cmon \n\nplz'),
(21, 3, 13, 1388623411, 'ok'),
(22, 5, 13, 1396743453, 'test'),
(23, 5, 13, 1396743456, 'dfghdfg');

-- --------------------------------------------------------

--
-- Table structure for table `imageslider`
--

CREATE TABLE IF NOT EXISTS `imageslider` (
  `imageslider_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `messagetitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `fillstretch` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  `link` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `linktarget` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `membersonly` int(11) NOT NULL,
  PRIMARY KEY (`imageslider_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `imageslider`
--

INSERT INTO `imageslider` (`imageslider_id`, `name`, `messagetitle`, `message`, `imageurl`, `fillstretch`, `ordernum`, `link`, `linktarget`, `membersonly`) VALUES
(15, 'test1', '', 'Click here to find out about our hosting options.', 'images/homepage/hpimage_537bec0461c07.png', 'stretch', 3, 'http://bluethrust.com/plans', '', 0),
(16, 'testr21', 'Tournament 22', 'asdf3', 'images/homepage/hpimage_539371f4bda8f.jpg', 'fill', 4, '/cs4/tournaments/view.php?tID=28', '_blank', 1),
(17, 'Help', 'Need Help?', 'Check out the support forums if you have a question!', 'images/homepage/hpimage_537bec3877f6a.png', 'fill', 2, 'http://bluethrust.com/forum', '', 0),
(19, 'test11111', 'Tournament 211', 'asdf11', 'images/homepage/hpimage_53937344f0025.gif', 'fill', 1, '/cs4/tournaments/view.php?tID=81', '_blank', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ipban`
--

CREATE TABLE IF NOT EXISTS `ipban` (
  `ipban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exptime` int(11) NOT NULL,
  `dateadded` int(11) NOT NULL,
  PRIMARY KEY (`ipban_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=31 ;

--
-- Dumping data for table `ipban`
--

INSERT INTO `ipban` (`ipban_id`, `ipaddress`, `exptime`, `dateadded`) VALUES
(21, '55555', 2147483647, 1393304815),
(26, '5', 0, 1393306113);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `logdate` int(11) NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=364 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`log_id`, `member_id`, `logdate`, `ipaddress`, `message`) VALUES
(1, 13, 1370562726, '::1', 'Cleared all logs.'),
(2, 45, 1370644272, '::1', 'Auto promoted for being in the clan for 56 days.'),
(3, 13, 1370700233, '::1', '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> changed TestCommander''s recruiter from admin to Testing.<br><br><b>Reason:</b><br>'),
(4, 13, 1370915758, '::1', 'Modified the member application component order.'),
(5, 13, 1370915759, '::1', 'Modified the member application component order.'),
(6, 13, 1370915760, '::1', 'Modified the member application component order.'),
(7, 13, 1370915768, '::1', 'Modified the member application.'),
(8, 13, 1370915772, '::1', 'Modified the member application component order.'),
(9, 13, 1370915777, '::1', 'Added a new member application component.'),
(10, 13, 1370915781, '::1', 'Modified the member application component order.'),
(11, 13, 1370915783, '::1', 'Modified the member application component order.'),
(12, 13, 1370915784, '::1', 'Modified the member application component order.'),
(13, 13, 1370915786, '::1', 'Modified the member application component order.'),
(14, 13, 1370915790, '::1', 'Deleted a member application component.'),
(15, 13, 1370915796, '::1', 'Modified the member application component order.'),
(16, 13, 1370915798, '::1', 'Modified the member application component order.'),
(17, 13, 1370915801, '::1', 'Modified the member application component order.'),
(18, 13, 1370915803, '::1', 'Modified the member application component order.'),
(19, 13, 1370915805, '::1', 'Modified the member application component order.'),
(20, 13, 1370915862, '::1', 'Deleted a member application component.'),
(21, 13, 1370915865, '::1', 'Deleted a member application component.'),
(22, 13, 1370915868, '::1', 'Deleted a member application component.'),
(23, 13, 1370915871, '::1', 'Deleted a member application component.'),
(24, 13, 1370915874, '::1', 'Deleted a member application component.'),
(25, 13, 1370915881, '::1', 'Added a new member application component.'),
(26, 13, 1370915920, '::1', 'Added a new member application component.'),
(27, 13, 1370916133, '::1', 'Deleted a member application component.'),
(28, 13, 1370916136, '::1', 'Deleted a member application component.'),
(29, 13, 1370916140, '::1', 'Added a new member application component.'),
(30, 13, 1370916151, '::1', 'Deleted a member application component.'),
(31, 13, 1370916156, '::1', 'Added a new member application component.'),
(32, 13, 1370916228, '::1', 'Deleted a member application component.'),
(33, 13, 1370916233, '::1', 'Added a new member application component.'),
(34, 13, 1370916309, '::1', 'Deleted a member application component.'),
(35, 13, 1370916320, '::1', 'Added a new member application component.'),
(36, 13, 1370916350, '::1', 'Deleted a member application component.'),
(37, 13, 1370916356, '::1', 'Added a new member application component.'),
(38, 13, 1370916370, '::1', 'Added a new member application component.'),
(39, 13, 1370916661, '::1', 'Added a new member application component.'),
(40, 13, 1370916671, '::1', 'Deleted a member application component.'),
(41, 13, 1371084548, '::1', 'Added a new member application component.'),
(42, 13, 1371084553, '::1', 'Added a new member application component.'),
(43, 13, 1371084608, '::1', 'Modified the member application component order.'),
(44, 13, 1371084609, '::1', 'Modified the member application component order.'),
(45, 13, 1371084612, '::1', 'Modified the member application component order.'),
(46, 13, 1371084613, '::1', 'Modified the member application component order.'),
(47, 13, 1371084614, '::1', 'Modified the member application component order.'),
(48, 13, 1371084616, '::1', 'Modified the member application component order.'),
(49, 13, 1371084617, '::1', 'Modified the member application component order.'),
(50, 13, 1371084618, '::1', 'Modified the member application component order.'),
(51, 13, 1371084624, '::1', 'Deleted a member application component.'),
(52, 13, 1371084627, '::1', 'Deleted a member application component.'),
(53, 13, 1371084632, '::1', 'Added a new member application component.'),
(54, 13, 1371084640, '::1', 'Added a new member application component.'),
(55, 13, 1371084644, '::1', 'Modified the member application component order.'),
(56, 13, 1371084646, '::1', 'Modified the member application component order.'),
(57, 13, 1371084647, '::1', 'Modified the member application component order.'),
(58, 13, 1371085077, '::1', 'Added a new member application component.'),
(59, 13, 1371085122, '::1', 'Modified the member application component order.'),
(60, 13, 1371085301, '::1', 'Added a new member application component.'),
(61, 13, 1371085306, '::1', 'Added a new member application component.'),
(62, 13, 1371085311, '::1', 'Added a new member application component.'),
(63, 13, 1371085317, '::1', 'Added a new member application component.'),
(64, 13, 1371085323, '::1', 'Added a new member application component.'),
(65, 13, 1371085328, '::1', 'Modified the member application component order.'),
(66, 13, 1371085330, '::1', 'Modified the member application component order.'),
(67, 13, 1371085332, '::1', 'Modified the member application component order.'),
(68, 13, 1371085333, '::1', 'Modified the member application component order.'),
(69, 13, 1371085335, '::1', 'Modified the member application component order.'),
(70, 13, 1371085337, '::1', 'Modified the member application component order.'),
(71, 13, 1371085339, '::1', 'Modified the member application component order.'),
(72, 13, 1371085340, '::1', 'Modified the member application component order.'),
(73, 13, 1371085342, '::1', 'Modified the member application component order.'),
(74, 13, 1371085344, '::1', 'Modified the member application component order.'),
(75, 13, 1371085345, '::1', 'Modified the member application component order.'),
(76, 13, 1371085347, '::1', 'Modified the member application component order.'),
(77, 13, 1371085349, '::1', 'Modified the member application component order.'),
(78, 13, 1371085350, '::1', 'Modified the member application component order.'),
(79, 13, 1371085352, '::1', 'Modified the member application component order.'),
(80, 13, 1371085354, '::1', 'Modified the member application component order.'),
(81, 13, 1371085564, '::1', 'Added a new member application component.'),
(82, 13, 1371085568, '::1', 'Modified the member application component order.'),
(83, 13, 1371085572, '::1', 'Modified the member application component order.'),
(84, 13, 1371085574, '::1', 'Modified the member application component order.'),
(85, 13, 1371085712, '::1', 'Modified the member application component order.'),
(86, 13, 1371085714, '::1', 'Modified the member application component order.'),
(87, 13, 1371085727, '::1', 'Modified the member application component order.'),
(88, 57, 1372126571, '::1', 'Auto promoted for being in the clan for 3 days.'),
(89, 53, 1372127107, '::1', 'Auto promoted for being in the clan for 3 days.'),
(90, 54, 1372127184, '::1', 'Auto promoted for being in the clan for 3 days.'),
(91, 55, 1372127188, '::1', 'Auto promoted for being in the clan for 3 days.'),
(92, 56, 1372127193, '::1', 'Auto promoted for being in the clan for 3 days.'),
(93, 53, 1373425825, '::1', 'Auto awarded medal for being in the clan for 5 days.'),
(94, 53, 1373425825, '::1', 'Auto promoted for being in the clan for 14 days.'),
(95, 13, 1373428269, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=53'' style=''color: #00FFFF'' title=''tes222[bT]''>tes222[bT]</a></span> demoted to rank Private First Class from Corporal.  Rank frozen for 3 days.<br><br><b>Reason:</b><br>'),
(96, 13, 1373428582, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=53'' style=''color: #00FFFF'' title=''tes222[bT]''>tes222[bT]</a></span> demoted to rank Private from Private First Class.  Rank frozen for 0 days.<br><br><b>Reason:</b><br>'),
(97, 53, 1373428593, '::1', 'Auto promoted for being in the clan for 14 days.'),
(98, 13, 1373430396, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=48'' style=''color: #FF0000'' title=''NewMember''>NewMember</a></span> was stripped of the Rookie Medal medal.<br><br><b>Reason:</b><br>'),
(99, 48, 1373430406, '::1', 'Auto awarded medal for being in the clan for 5 days.'),
(100, 48, 1373430406, '::1', 'Auto awarded medal for being in the clan for 120 days.'),
(101, 13, 1373430486, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=48'' style=''color: #FF0000'' title=''NewMember''>NewMember</a></span> was stripped of the Rookie Medal medal.<br><br><b>Reason:</b><br>'),
(102, 48, 1373603328, '::1', 'Auto awarded medal for being in the clan for 5 days.'),
(103, 48, 1373603328, '::1', 'Auto awarded medal for being in the clan for 150 days.'),
(104, 13, 1373430749, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=48'' style=''color: #FF0000'' title=''NewMember''>NewMember</a></span> was stripped of the Rookie Medal medal.  The medal will not be awarded again for 3 days.<br><br><b>Reason:</b><br>'),
(105, 52, 1373744442, '::1', 'Auto awarded medal for being in the clan for 5 days.'),
(106, 13, 1373744455, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=52'' style=''color: #09FF00'' title=''checkitout[bT]''>checkitout[bT]</a></span> was stripped of the Rookie Medal medal.  The medal will not be awarded again for 1 day.<br><br><b>Reason:</b><br>'),
(107, 13, 1374118943, '::1', '<span style=''color: #9C2525''><a href=''/cs4git/profile.php?mID=43'' style=''color: #FF0000'' title=''TestMember''>TestMember</a></span> demoted to rank Co-Commander from Commander.  Rank frozen for 0 days.<br><br><b>Reason:</b><br>'),
(108, 13, 1374120016, '::1', '<span style=''color: #9C2525''><a href=''/cs4git/profile.php?mID=43'' style=''color: #FF0000'' title=''TestMember''>TestMember</a></span> was awarded the Epic Medal medal.<br><br><b>Reason:</b><br>Testing Reasons'),
(109, 43, 1374120022, '::1', 'Auto awarded medal for being in the clan for 120 days.'),
(110, 43, 1374120022, '::1', 'Auto awarded medal for being in the clan for 150 days.'),
(111, 50, 1374357682, '::1', 'Auto awarded medal for being in the clan for 5 days.'),
(112, 50, 1374357683, '::1', 'Auto awarded medal for being in the clan for 30 days.'),
(113, 50, 1374357683, '::1', 'Auto awarded medal for being in the clan for 90 days.'),
(114, 50, 1374357683, '::1', 'Auto promoted for being in the clan for 56 days.'),
(115, 48, 1374358845, '::1', 'Auto awarded medal for being in the clan for 5 days.'),
(116, 13, 1374853075, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=42'' style=''color: #FF0000'' title=''TestCommander''>TestCommander</a></span> was awarded the Silver Shield Medal medal.<br><br><b>Reason:</b><br>ha'),
(117, 13, 1374853169, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=42'' style=''color: #FF0000'' title=''TestCommander''>TestCommander</a></span> was awarded the Humanitarian Medal medal.<br><br><b>Reason:</b><br>'),
(118, 13, 1374853245, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=42'' style=''color: #FF0000'' title=''TestCommander''>TestCommander</a></span> was stripped of the Humanitarian Medal medal.  The medal will not be awarded again for 0 days.<br><br><b>Reason:</b><br>'),
(119, 13, 1374853293, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=42'' style=''color: #FF0000'' title=''TestCommander''>TestCommander</a></span> was stripped of the Silver Shield Medal medal.<br><br><b>Reason:</b><br>'),
(120, 13, 1374853407, '::1', '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=42'' style=''color: #FF0000'' title=''TestCommander''>TestCommander</a></span> was awarded the Silver Shield Medal medal.<br><br><b>Reason:</b><br>'),
(121, 13, 1374855784, '::1', 'Changed TestCommander''s recruit date to Tue Jul 9, 2013 12:00 am.'),
(122, 51, 1375034104, '::1', 'Auto promoted for being in the clan for 56 days.'),
(123, 59, 1375143089, '::1', 'Disabled for failure to be promoted before 5 days.'),
(124, 59, 1375542780, '::1', 'Disabled for failure to be promoted before 5 days.'),
(125, 59, 1375675826, '::1', 'Disabled for failure to be promoted before 5 days.'),
(126, 59, 1375675862, '::1', 'Disabled for failure to be promoted before 5 days.'),
(127, 59, 1375675886, '::1', 'Disabled for failure to be promoted before 5 days.'),
(128, 59, 1375675905, '::1', 'Disabled for failure to be promoted before 5 days.'),
(129, 59, 1375675908, '::1', 'Disabled for failure to be promoted before 5 days.'),
(130, 59, 1375675937, '::1', 'Disabled for failure to be promoted before 5 days.'),
(131, 59, 1375675955, '::1', 'Disabled for failure to be promoted before 5 days.'),
(132, 59, 1375675988, '::1', 'Disabled for failure to be promoted before 5 days.'),
(133, 59, 1375676008, '::1', 'Disabled for failure to be promoted before 5 days.'),
(134, 59, 1375676029, '::1', 'Disabled for failure to be promoted before 5 days.'),
(135, 59, 1375676043, '::1', 'Disabled for failure to be promoted before 5 days.'),
(136, 59, 1375676067, '::1', 'Disabled for failure to be promoted before 5 days.'),
(137, 59, 1375676084, '::1', 'Disabled for failure to be promoted before 5 days.'),
(138, 59, 1375676091, '::1', 'Disabled for failure to be promoted before 5 days.'),
(139, 59, 1375676098, '::1', 'Disabled for failure to be promoted before 5 days.'),
(140, 59, 1375676106, '::1', 'Disabled for failure to be promoted before 5 days.'),
(141, 59, 1375676123, '::1', 'Disabled for failure to be promoted before 5 days.'),
(142, 59, 1375676183, '::1', 'Disabled for failure to be promoted before 5 days.'),
(143, 59, 1375676193, '::1', 'Disabled for failure to be promoted before 5 days.'),
(144, 59, 1375676211, '::1', 'Disabled for failure to be promoted before 5 days.'),
(145, 59, 1375676233, '::1', 'Disabled for failure to be promoted before 5 days.'),
(146, 59, 1375676253, '::1', 'Disabled for failure to be promoted before 5 days.'),
(147, 59, 1375676269, '::1', 'Disabled for failure to be promoted before 5 days.'),
(148, 59, 1375676281, '::1', 'Disabled for failure to be promoted before 5 days.'),
(149, 59, 1375676292, '::1', 'Disabled for failure to be promoted before 5 days.'),
(150, 59, 1375676305, '::1', 'Disabled for failure to be promoted before 5 days.'),
(151, 59, 1375676326, '::1', 'Disabled for failure to be promoted before 5 days.'),
(152, 59, 1375676351, '::1', 'Disabled for failure to be promoted before 5 days.'),
(153, 59, 1375676378, '::1', 'Disabled for failure to be promoted before 5 days.'),
(154, 59, 1375676395, '::1', 'Disabled for failure to be promoted before 5 days.'),
(155, 59, 1375677435, '::1', 'Disabled for failure to be promoted before 5 days.'),
(156, 59, 1375928809, '::1', 'Disabled for failure to be promoted before 5 days.'),
(157, 59, 1377986347, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(158, 59, 1378012255, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(159, 59, 1378159575, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(160, 59, 1378159639, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(161, 59, 1378159655, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(162, 59, 1378160851, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(163, 59, 1378160876, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(164, 59, 1378160904, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(165, 59, 1378160931, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(166, 59, 1378160959, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(167, 59, 1378160995, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(168, 59, 1378161023, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(169, 59, 1378161069, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(170, 59, 1378161128, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(171, 59, 1378161136, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(172, 59, 1378161215, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(173, 59, 1378161636, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(174, 59, 1378161645, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(175, 59, 1378161662, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(176, 59, 1378161690, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(177, 59, 1378161803, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(178, 59, 1378161824, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(179, 59, 1378161878, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(180, 59, 1378161902, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(181, 59, 1378161969, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(182, 59, 1378164913, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(183, 59, 1378165074, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(184, 59, 1378175081, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(185, 59, 1378175121, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(186, 59, 1378175124, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(187, 59, 1378175143, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(188, 59, 1378175384, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(189, 59, 1378175896, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(190, 59, 1378175947, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(191, 59, 1378175977, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(192, 59, 1378176269, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(193, 59, 1378176303, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(194, 59, 1378178088, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(195, 59, 1378179692, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(196, 59, 1378181184, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(197, 59, 1378182529, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(198, 59, 1378254117, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(199, 13, 1378271248, '127.0.0.1', 'Edited <a href=''/downloads/index.php?catID=6#18''>Test Download!</a> download information.'),
(200, 59, 1378530523, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(201, 13, 1378606917, '127.0.0.1', 'Deleted a member application component.'),
(202, 13, 1378606921, '127.0.0.1', 'Deleted a member application component.'),
(203, 13, 1378606924, '127.0.0.1', 'Deleted a member application component.'),
(204, 13, 1378606928, '127.0.0.1', 'Deleted a member application component.'),
(205, 13, 1378606931, '127.0.0.1', 'Deleted a member application component.'),
(206, 13, 1378606934, '127.0.0.1', 'Deleted a member application component.'),
(207, 13, 1378606937, '127.0.0.1', 'Deleted a member application component.'),
(208, 13, 1378606940, '127.0.0.1', 'Deleted a member application component.'),
(209, 13, 1378606943, '127.0.0.1', 'Deleted a member application component.'),
(210, 13, 1378606946, '127.0.0.1', 'Deleted a member application component.'),
(211, 13, 1378606949, '127.0.0.1', 'Deleted a member application component.'),
(212, 59, 1378683215, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(213, 59, 1378683228, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(214, 52, 1378683234, '127.0.0.1', 'Auto awarded medal for being in the clan for 5 days.'),
(215, 52, 1378683234, '127.0.0.1', 'Auto awarded medal for being in the clan for 30 days.'),
(216, 59, 1378683256, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(217, 59, 1378683402, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(218, 59, 1379057360, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(219, 59, 1379057897, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(220, 59, 1379558394, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(221, 59, 1379564036, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(222, 59, 1379564412, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(223, 59, 1381925558, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(224, 59, 1382136982, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(225, 59, 1382137024, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(226, 59, 1382232625, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(227, 59, 1382829533, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(228, 59, 1382829572, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(229, 59, 1382829712, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(230, 59, 1382829717, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(231, 59, 1382829863, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(232, 59, 1382829876, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(233, 59, 1382833202, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(234, 59, 1382835299, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(235, 59, 1382835311, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(236, 59, 1382837410, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(237, 59, 1382837472, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(238, 59, 1382837517, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(239, 59, 1382837825, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(240, 59, 1382837832, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(241, 59, 1382837963, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(242, 59, 1382838004, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(243, 59, 1382838223, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(244, 59, 1382838234, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(245, 59, 1382838244, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(246, 59, 1382838293, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(247, 59, 1382838298, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(248, 59, 1382838345, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(249, 59, 1382838374, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(250, 59, 1382838409, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(251, 59, 1382838473, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(252, 59, 1382838514, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(253, 59, 1382838530, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(254, 59, 1382838589, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(255, 59, 1382838757, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(256, 59, 1382838797, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(257, 59, 1382839276, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(258, 59, 1382841113, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(259, 59, 1382841192, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(260, 59, 1382841747, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(261, 59, 1383805392, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(262, 44, 1383805399, '127.0.0.1', 'Auto awarded medal for being in the clan for 5 days.'),
(263, 44, 1383805399, '127.0.0.1', 'Auto awarded medal for being in the clan for 30 days.'),
(264, 44, 1383805399, '127.0.0.1', 'Auto awarded medal for being in the clan for 90 days.'),
(265, 44, 1383805399, '127.0.0.1', 'Auto awarded medal for being in the clan for 120 days.'),
(266, 44, 1383805399, '127.0.0.1', 'Auto awarded medal for being in the clan for 150 days.'),
(267, 59, 1386042936, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(268, 59, 1386121577, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(269, 13, 1387240056, '127.0.0.1', 'Accepted <span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=61'' style=''color: #006FFF'' title=''testuser22''>testuser22</a></span>''s member application.'),
(270, 13, 1387240064, '127.0.0.1', 'Removed the member application for testuser22.'),
(271, 59, 1387240069, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(272, 13, 1387240349, '127.0.0.1', '<span style=''color: #00EAFF''><a href=''/cs4/profile.php?mID=61'' style=''color: #006FFF'' title=''testuser22''>testuser22</a></span> promoted to rank Recruit from Trial Member.<br><br><b>Reason:</b><br>'),
(273, 59, 1387240371, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(274, 59, 1387240377, '127.0.0.1', 'Disabled for failure to be promoted before 5 days.'),
(275, 13, 1387240500, '127.0.0.1', 'Deleted testpass from the website.'),
(276, 13, 1387240928, '127.0.0.1', 'Accepted <span style=''color: #00EAFF''><a href=''/cs4/profile.php?mID=62'' style=''color: #006FFF'' title=''tsetdff''>tsetdff</a></span>''s member application.'),
(277, 13, 1387678034, '127.0.0.1', 'Uninstalled Facebook Login Plugin.'),
(278, 13, 1387678669, '127.0.0.1', 'Uninstalled Twitter Connect Plugin.'),
(279, 13, 1387678913, '127.0.0.1', 'Uninstalled Facebook Login Plugin.'),
(280, 13, 1387678917, '127.0.0.1', 'Installed Twitter Connect Plugin.'),
(281, 13, 1387848294, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(282, 13, 1387848776, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(283, 13, 1387848802, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(284, 13, 1388033194, '127.0.0.1', 'Deleted Forum Board: testboard3'),
(285, 13, 1388033439, '127.0.0.1', 'Deleted Forum Board: test board3ddd'),
(286, 13, 1388098544, '127.0.0.1', '<span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=63'' style=''color: #0000FF'' title=''TestMember8''>TestMember8</a></span> demoted to rank General from Commander.<br><br><b>Reason:</b><br>'),
(287, 57, 1388344788, '127.0.0.1', 'Auto promoted for being in the clan for 56 days.'),
(288, 13, 1388353717, '127.0.0.1', 'Added a new member application component.'),
(289, 13, 1388360916, '127.0.0.1', 'Modified the member application.'),
(290, 13, 1388361301, '127.0.0.1', 'Added a new member application component.'),
(291, 13, 1388475032, '127.0.0.1', 'Set maximum promote power for <span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=52'' style=''color: #046900'' title=''checkitout[bT]''>checkitout[bT]</a></span> to Sergeant'),
(292, 13, 1388475292, '127.0.0.1', 'Set maximum promote power for <span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=52'' style=''color: #046900'' title=''checkitout[bT]''>checkitout[bT]</a></span> to Default'),
(293, 13, 1388476231, '127.0.0.1', 'Set maximum promote power for <span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=52'' style=''color: #046900'' title=''checkitout[bT]''>checkitout[bT]</a></span> to Recruit'),
(294, 13, 1388597781, '127.0.0.1', '<span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=42'' style=''color: #DE0000'' title=''TestCommander''>TestCommander</a></span> was awarded the Forum Hero medal.<br><br><b>Reason:</b><br>'),
(295, 13, 1388622274, '127.0.0.1', 'Deleted <span style=''color: #9C2525''><a href=''/cs4/profile.php?mID=43'' style=''color: #FF6600'' title=''TestMember''>TestMember</a></span>''s IA Request.'),
(296, 13, 1388622278, '127.0.0.1', 'Deleted <span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=48'' style=''color: #DE0000'' title=''NewMember''>NewMember</a></span>''s IA Request.'),
(297, 63, 1388730844, '127.0.0.1', 'Auto awarded medal for being in the clan for 5 days.'),
(298, 51, 1388733232, '127.0.0.1', 'Auto awarded medal for being in the clan for 90 days.'),
(299, 51, 1388733232, '127.0.0.1', 'Auto awarded medal for being in the clan for 120 days.'),
(300, 51, 1388733232, '127.0.0.1', 'Auto awarded medal for being in the clan for 150 days.'),
(301, 13, 1388733450, '127.0.0.1', 'Uninstalled Facebook Login Plugin.'),
(302, 13, 1388733456, '127.0.0.1', 'Uninstalled Twitter Connect Plugin.'),
(303, 13, 1388733459, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(304, 13, 1388970747, '127.0.0.1', 'Installed Twitter Connect Plugin.'),
(305, 13, 1388976376, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(306, 13, 1388976382, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(307, 13, 1388976426, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(308, 13, 1388976432, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(309, 13, 1388976518, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(310, 13, 1388976614, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(311, 13, 1388976617, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(312, 13, 1388976652, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(313, 13, 1388976657, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(314, 13, 1388976697, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(315, 13, 1388976700, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(316, 13, 1388976730, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(317, 13, 1388976736, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(318, 13, 1388976765, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(319, 13, 1388976772, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(320, 13, 1388976893, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(321, 13, 1388980456, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(322, 13, 1388980461, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(323, 13, 1389476357, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=2''>SEcond POST!</a>'),
(324, 13, 1389648558, '127.0.0.1', 'Auto awarded medal for being in the clan for 100 days.'),
(325, 13, 1389989851, '127.0.0.1', 'Set maximum promote power for <span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=50'' style=''color: #F5FFA8'' title=''Testing''>Testing</a></span> to Commander'),
(326, 50, 1389989877, '127.0.0.1', '<span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=42'' style=''color: #F29999'' title=''TestCommander''>TestCommander</a></span> was awarded the Epic Medal medal.<br><br><b>Reason:</b><br>test'),
(327, 42, 1389989882, '127.0.0.1', 'Auto awarded medal for being in the clan for 100 days.'),
(328, 13, 1390168217, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=20''>hello</a>'),
(329, 13, 1390168238, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=20''>hello</a>'),
(330, 13, 1390168371, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=20''>hello</a>'),
(331, 13, 1390170170, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=20''>hello</a>'),
(332, 13, 1390327624, '127.0.0.1', 'Deleted Forum Board: Test Board 8'),
(333, 13, 1390330554, '127.0.0.1', 'Deleted Forum Board: test'),
(334, 13, 1391660370, '127.0.0.1', 'Deleted 1 shoutbox post.'),
(335, 13, 1391660407, '127.0.0.1', 'Deleted 3 shoutbox posts.'),
(336, 13, 1391831615, '127.0.0.1', 'Changed asd[bT]''s username to <a href=''/cs4/profile.php?mID=56''>asdLOL</a>.'),
(337, 56, 1391831627, '127.0.0.1', 'Auto awarded medal for being in the clan for 100 days.'),
(338, 56, 1391831627, '127.0.0.1', 'Auto awarded medal for being in the clan for 5 days.'),
(339, 56, 1391831627, '127.0.0.1', 'Auto awarded medal for being in the clan for 90 days.'),
(340, 56, 1391831627, '127.0.0.1', 'Auto awarded medal for being in the clan for 150 days.'),
(341, 56, 1391831627, '127.0.0.1', 'Auto promoted for being in the clan for 56 days.'),
(342, 13, 1391995736, '127.0.0.1', 'Changed NewMember''s username to <a href=''/cs4/profile.php?mID=48''>NewMember1</a>.'),
(343, 13, 1392501807, '127.0.0.1', 'Declined gsdgdd''s member application.'),
(344, 13, 1392502398, '127.0.0.1', 'Declined hui''s member application.'),
(345, 46, 1393534406, '127.0.0.1', 'Stickied forum topic: <a href=''/cs4/forum/viewtopic.php?tID=21''>test</a>'),
(346, 46, 1393534409, '127.0.0.1', 'Locked forum topic: <a href=''/cs4/forum/viewtopic.php?tID=21''>test</a>'),
(347, 13, 1393724990, '127.0.0.1', 'Set <span style=''color: #00EAFF''><a href=''/cs4/profile.php?mID=61'' style=''color: #F5FFA8'' title=''testuser22''>testuser22</a></span> IA status to On Leave'),
(348, 13, 1395014742, '127.0.0.1', 'Deleted a member application component.'),
(349, 13, 1395438169, '127.0.0.1', 'Installed Youtube Connect Plugin.'),
(350, 13, 1396811218, '127.0.0.1', '<span style=''color: #15FF00''><a href=''/cs4/profile.php?mID=42'' style=''color: #F29999'' title=''TestCommander''>TestCommander</a></span> was awarded the Shooting Star Medal medal.<br><br><b>Reason:</b><br>'),
(351, 13, 1396815345, '127.0.0.1', '<span style=''color: #15FF00''><a href=''/cs4/profile.php?mID=48'' style=''color: #F29999'' title=''NewMember1''>NewMember1</a></span> was stripped of the Shooting Star Medal medal.  The medal will not be awarded again for 3 days.<br><br><b>Reason:</b><br>test'),
(352, 13, 1399188720, '127.0.0.1', 'Installed Twitter Connect Plugin.'),
(353, 13, 1399189387, '127.0.0.1', 'Uninstalled Youtube Connect Plugin.'),
(354, 13, 1400318687, '127.0.0.1', 'Deleted forum topic: MOVED - hello?'),
(355, 13, 1400318922, '127.0.0.1', 'Deleted forum topic: MOVED - hello?'),
(356, 13, 1400319193, '127.0.0.1', 'Moved forum topic, <a href=''/cs4/forum/viewtopic.php?tID=28''>MOVED - hello?</a>, to <a href=''/cs4/forum/viewboard.php?bID=18''>General Discussion</a>'),
(357, 13, 1400319491, '127.0.0.1', 'Moved forum topic, <a href=''/cs4/forum/viewtopic.php?tID=29''>MOVED - MOVED - hello?</a>, to <a href=''/cs4/forum/viewboard.php?bID=18''>General Discussion</a>'),
(358, 48, 1400709315, '127.0.0.1', 'Auto awarded medal for being in the clan for 150 days.'),
(359, 13, 1401665780, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=12''>test attachments</a>'),
(360, 13, 1401773674, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=32''></a>'),
(361, 13, 1401773935, '127.0.0.1', 'Deleted post in topic: <a href=''/cs4/forum/viewtopic.php?tID=33''></a>'),
(362, 13, 1401933492, '127.0.0.1', 'Disabled <span style=''color: #00EAFF''><a href=''/cs4/profile.php?mID=65'' style=''color: #4A2000'' title=''testdeletemember''>testdeletemember</a></span>.<br><br><b>Reason:</b><br>'),
(363, 13, 1401933501, '127.0.0.1', 'Deleted testdeletemember from the website.');

-- --------------------------------------------------------

--
-- Table structure for table `medals`
--

CREATE TABLE IF NOT EXISTS `medals` (
  `medal_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `imageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `autodays` int(11) NOT NULL,
  `autorecruits` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`medal_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `medals`
--

INSERT INTO `medals` (`medal_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `autodays`, `autorecruits`, `ordernum`) VALUES
(2, 'Active Member Medal', 'Awarded for being an active clan member.', 'images/medals/medal_50d53660e7533.gif', 105, 30, 0, 0, 1),
(3, 'Forum Hero', 'Awarded for being active on the forums.', 'images/medals/medal_50d536249845b.gif', 105, 30, 0, 0, 3),
(4, 'Epic Medal', 'Awarded for being epic.', 'images/medals/medal_50d5361482940.gif', 105, 30, 0, 0, 4),
(5, 'test medal55', 'test', '', 75, 100, 0, 0, 9),
(6, 'Veteran Medal', 'Awarded after being in the clan for 90 days.', 'images/medals/medal_50d535a2dc0f8.gif', 105, 30, 90, 0, 7),
(7, 'Old Timer Medal', 'Awarded for being in the clan for 120 days.', 'images/medals/medal_50d535ef43360.gif', 105, 30, 0, 0, 6),
(8, 'Shooting Star Medal', 'Awarded for being in the clan 150 days.', 'images/medals/medal_50d536049e104.gif', 105, 30, 150, 0, 5),
(9, 'Silver Shield Medal', 'Awarded to members who help the clan with Web Design/Graphics, etc...', 'images/medals/medal_50d53640a63e9.gif', 105, 30, 0, 0, 2),
(10, 'Established Member Medal', 'Awarded after being in the clan for 30 days.', 'images/medals/medal_50d535cada75a.gif', 105, 30, 0, 0, 8),
(22, 'test medal', 'test', 'images/medals/medal_534d83276e1ff.gif', 75, 100, 0, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `medals_members`
--

CREATE TABLE IF NOT EXISTS `medals_members` (
  `medalmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `medal_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateawarded` int(11) NOT NULL,
  `reason` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`medalmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `medals_members`
--

INSERT INTO `medals_members` (`medalmember_id`, `medal_id`, `member_id`, `dateawarded`, `reason`) VALUES
(1, 5, 13, 1362363928, ''),
(2, 10, 13, 1362363928, ''),
(3, 6, 13, 1362363928, ''),
(4, 7, 13, 1362363928, ''),
(5, 8, 13, 1362363928, ''),
(7, 5, 43, 1364181795, ''),
(8, 10, 43, 1364181795, ''),
(10, 10, 48, 1364181954, ''),
(11, 5, 42, 1366245676, ''),
(12, 10, 42, 1366245676, ''),
(13, 5, 46, 1368390309, ''),
(14, 10, 46, 1368390309, ''),
(15, 6, 46, 1368390309, ''),
(16, 6, 43, 1368504425, ''),
(17, 5, 51, 1369632318, ''),
(18, 10, 51, 1369632318, ''),
(19, 6, 48, 1369634319, ''),
(20, 6, 42, 1369717988, ''),
(21, 7, 42, 1369717988, ''),
(22, 8, 42, 1369717988, ''),
(23, 5, 53, 1373425825, ''),
(25, 7, 48, 1373430406, ''),
(29, 4, 43, 1374120016, 'Testing Reasons'),
(30, 7, 43, 1374120022, ''),
(31, 8, 43, 1374120022, ''),
(32, 5, 50, 1374357682, ''),
(33, 10, 50, 1374357683, ''),
(34, 6, 50, 1374357683, ''),
(35, 5, 48, 1374358845, ''),
(38, 9, 42, 1374853406, ''),
(39, 5, 52, 1378683234, ''),
(40, 10, 52, 1378683234, ''),
(41, 5, 44, 1383805399, ''),
(42, 10, 44, 1383805399, ''),
(43, 6, 44, 1383805399, ''),
(44, 7, 44, 1383805399, ''),
(45, 8, 44, 1383805399, ''),
(46, 3, 42, 1388597781, ''),
(47, 5, 63, 1388730844, ''),
(48, 6, 51, 1388733232, ''),
(49, 7, 51, 1388733232, ''),
(50, 8, 51, 1388733232, ''),
(59, 9, 56, 1396810957, 'asdf'),
(52, 4, 42, 1389989877, 'test'),
(55, 5, 56, 1391831627, ''),
(56, 6, 56, 1391831627, ''),
(57, 8, 56, 1391831627, ''),
(60, 7, 52, 1396811184, ''),
(61, 8, 42, 1396811218, ''),
(62, 8, 48, 1400709315, '');

-- --------------------------------------------------------

--
-- Table structure for table `memberapps`
--

CREATE TABLE IF NOT EXISTS `memberapps` (
  `memberapp_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `applydate` int(11) NOT NULL,
  `ipaddress` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `memberadded` int(11) NOT NULL,
  `seenstatus` int(11) NOT NULL,
  PRIMARY KEY (`memberapp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `memberapps`
--

INSERT INTO `memberapps` (`memberapp_id`, `username`, `password`, `password2`, `email`, `applydate`, `ipaddress`, `memberadded`, `seenstatus`) VALUES
(11, 'test11111', '$2a$09$47d988146123a1b3031f6uy0kV4pqNFcKQbP.I6JNiIYS0Cqlhe.2', '$2a$09$47d988146123a1b3031f60', 'hasdfas@asdfas. com', 1401826330, '127.0.0.1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank_id` int(11) NOT NULL,
  `profilepic` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `avatar` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maingame_id` int(11) NOT NULL,
  `birthday` int(11) NOT NULL,
  `datejoined` int(11) NOT NULL,
  `lastlogin` int(11) NOT NULL,
  `lastseen` int(11) NOT NULL,
  `lastseenlink` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `loggedin` int(11) NOT NULL,
  `lastpromotion` int(11) NOT NULL,
  `lastdemotion` int(11) NOT NULL,
  `timesloggedin` int(11) NOT NULL,
  `recruiter` int(11) NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profileviews` int(11) NOT NULL,
  `defaultconsole` int(11) NOT NULL,
  `disabled` int(11) NOT NULL,
  `disableddate` int(11) NOT NULL,
  `notifications` int(11) NOT NULL,
  `topicsperpage` int(11) NOT NULL,
  `postsperpage` int(11) NOT NULL,
  `freezerank` int(11) NOT NULL,
  `forumsignature` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `promotepower` int(11) NOT NULL,
  `onia` int(11) NOT NULL,
  `inactivedate` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=66 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `username`, `password`, `password2`, `rank_id`, `profilepic`, `avatar`, `email`, `maingame_id`, `birthday`, `datejoined`, `lastlogin`, `lastseen`, `lastseenlink`, `loggedin`, `lastpromotion`, `lastdemotion`, `timesloggedin`, `recruiter`, `ipaddress`, `profileviews`, `defaultconsole`, `disabled`, `disableddate`, `notifications`, `topicsperpage`, `postsperpage`, `freezerank`, `forumsignature`, `promotepower`, `onia`, `inactivedate`) VALUES
(13, 'admin', '$2a$07$db3236ba045e2a3f085a9O4lYudAXAYHfLubECHlBT4DuEcQSsWEK', '$2a$07$db3236ba045e2a3f085a9c', 1, 'images/profile/profile_538fc87bf2b58.png', '', 'leorojas122@gmail.com', 12, 596091600, 1318062024, 1402681660, 1402682240, '<a href=''http://localhost/cs4/members/console.php?cID=56''>Manage Download Categories</a>', 1, 1350783875, 0, 351, 0, '127.0.0.1', 2013, 14, 0, 1351401446, 0, 10, 10, 0, '<p>Test Signature</p>\r\n', 0, 0, 0),
(50, 'Testing', '$2a$07$e12210975504e3bd08305u1Uaez4r282.XH9bxDA7lG5grIh0k3su', '$2a$07$e12210975504e3bd083054', 52, '', '', '', 0, 0, 1365730509, 1389989860, 1389990063, '<a href=''http://localhost/cs4/members/''>My Account</a>', 0, 1374357683, 0, 5, 13, '127.0.0.1', 6, 0, 0, 0, 0, 0, 0, 0, '', 41, 0, 0),
(42, 'TestCommander', '$2a$06$2d5e8a01e31ead683ceeduaOT/igvxd2KjdLdt47KoR/zrFyKtOsO', '$2a$06$2d5e8a01e31ead683ceed9', 41, '', '', 'homerun31@msn.com', 16, 0, 1373342400, 1401826282, 1401826283, '<a href=''http://localhost/cs4/''>Home Page</a>', 0, 0, 0, 16, 50, '127.0.0.1', 45, 3, 0, 0, 0, 10, 10, 0, '', 0, 0, 0),
(43, 'TestMember', '$2a$04$5e55e5ed6c17b5db04a02ORA6eski.vLHuq7PrLyp/puDD8J7oBPq', '$2a$04$5e55e5ed6c17b5db04a02b', 42, '', '', '', 0, 0, 1360122795, 1388626062, 1388626071, '<a href=''http://localhost/cs4/members/index.php?select=12''>My Account</a>', 0, 1362363099, 1374118943, 15, 42, '127.0.0.1', 12, 0, 0, 0, 0, 0, 0, 1374118943, '', 0, 0, 0),
(44, 'HahaMember', '$2a$06$0b84014aa834b4accc963uf986.oy5ae4XJxmd2TFycikEX112jsy', '$2a$06$0b84014aa834b4accc9636', 52, '', '', '', 0, 0, 1360475817, 1365733043, 1365733043, '<a href=''http://localhost/cs4git/index.php''>Home Page</a>', 0, 1365733043, 0, 1, 13, '::1', 4, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(45, 'WhatMember', '$2a$10$e5557f427698a51030d61urhj8vHahYLQK1tTvTzd6vcqw4OpJf2e', '$2a$10$e5557f427698a51030d617', 52, '', '', '', 0, 0, 1360475827, 1370644272, 1370645705, '<a href=''http://localhost/cs4git/members/''>My Account</a>', 0, 1370644272, 0, 2, 13, '::1', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(46, 'ANotherONE?', '$2a$10$3a39c6655e348501bcc93O01yq0wGTISFSjPAl2rSeUI6FvGk69Ty', '$2a$10$3a39c6655e348501bcc93d', 59, '', '', '', 0, 0, 1360475840, 1393551009, 1393551111, '<a href=''http://localhost/cs4/members/''>My Account</a>', 0, 0, 0, 2, 51, '127.0.0.1', 5, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(47, 'SomeMember', '$2a$08$a83f266a6dcf9c9f57b3deD9/v2cFAmhZnKIOz0Or9Mf.e0CuT7RW', '$2a$08$a83f266a6dcf9c9f57b3de', 55, '', '', '', 0, 0, 1360475852, 1379185356, 1379185363, '<a href=''http://cs4svn/members/privatemessages/view.php?pmID=37''>Compose Message - Private Messages</a>', 0, 0, 0, 4, 13, '127.0.0.1', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(48, 'NewMember1', '$2a$08$321271ce806f805f09d4cuRgCRoExebNLEOc0quqzt6RwRiYseSUW', '$2a$08$321271ce806f805f09d4c7', 41, '', '', '', 7, 0, 1360475862, 1395023330, 1395023521, '<a href=''http://localhost/cs4/members/console.php?cID=76&select=9''>Manage Tournaments</a>', 0, 1362363754, 0, 46, 13, '127.0.0.1', 43, 13, 0, 0, 0, 10, 10, 0, '', 0, 0, 0),
(49, 'ThisIsATestMember', '$2a$10$1c96597bf709b71eb2d01uqEZgKQNZw.shyRndOvMu60G5DKemjm.', '$2a$10$1c96597bf709b71eb2d013', 48, '', '', '', 0, 0, 1360475876, 1360475876, 0, '', 0, 0, 0, 0, 13, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(51, 'RetiredDude', '$2a$10$22baf9995d1f8ab156087uNAT0bnQsCx5d5IlQGSODkNBcpoMVU6y', '$2a$10$22baf9995d1f8ab1560873', 52, '', '', '', 0, 0, 1365752863, 1375286854, 1375290127, '<a href=''http://localhost/cs4git/themes/_refreshmenus.php''>Home Page</a>', 0, 1375034104, 0, 2, 51, '::1', 2, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(52, 'checkitout[bT]', '$2a$06$3841a1413c9c21840973euFaLsN7WnFI0OZAgReuqSHl8pFzNDl..', '$2a$06$3841a1413c9c21840973e7', 60, '', '', '', 0, 0, 1371708653, 1393195584, 1393195624, '<a href=''http://localhost/cs4/members/''>My Account</a>', 0, 0, 0, 1, 13, '127.0.0.1', 3, 0, 0, 0, 0, 0, 0, 0, '', 43, 0, 0),
(53, 'tes222[bT]', '$2a$10$fed0bceedd33b513569c4u1aoNm5o6Sd95inDOKo7FRj0h29FUXdG', '$2a$10$fed0bceedd33b513569c40', 46, '', '', '', 0, 0, 1371773197, 1372127107, 1372130137, '<a href=''http://localhost/cs4git/themes/_refreshmenus.php''>Home Page</a>', 0, 1373428593, 1373428582, 1, 13, '::1', 4, 0, 0, 0, 0, 0, 0, 1373428582, '', 0, 0, 0),
(54, 'test35[bT]', '$2a$04$cd6a1ae9fa0152ba1f319OKCbd3THA7oOATs/i/7.9.r2UU6RYI7i', '$2a$04$cd6a1ae9fa0152ba1f319b', 44, '', '', '', 0, 0, 1371773393, 1371773393, 0, '', 0, 1372127184, 0, 0, 13, '', 1, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(55, 'asdf333[bT]', '$2a$06$1729e7f1f65498ee8b4c1O.124i9pwwvesht2v21AdusFgie9xbFe', '$2a$06$1729e7f1f65498ee8b4c1c', 44, '', '', '', 0, 0, 1371773490, 1371773490, 0, '', 0, 1372127188, 0, 0, 13, '', 1, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(56, 'asdLOL', '$2a$10$b8ff4dfd2d0eb463076b2eqMmEzPs/ge29hOsn4HLnbra9pHHPNkO', '$2a$10$b8ff4dfd2d0eb463076b2e', 52, '', '', '', 0, 0, 1371773552, 1371773552, 0, '', 0, 1391831627, 0, 0, 13, '', 3, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(57, 'hahahahahahhaha[bT]', '$2a$06$09c05efeb9bcc43ce57e3urx6MTSqSf06pqCO0/ldqlopAMI80GIG', '$2a$06$09c05efeb9bcc43ce57e31', 52, '', '', '', 0, 0, 1371773599, 1388353996, 1388353996, '<a href=''http://localhost/cs4/''>Home Page</a>', 0, 1388344788, 0, 1, 13, '127.0.0.1', 1, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(58, 'TestW4', '$2a$08$69dfc7a1c0b974864f5c3umQzPH./Ils4ieQ2mNb597NbWJ4QgHJ6', '$2a$08$69dfc7a1c0b974864f5c33', 56, '', '', '', 0, 0, 1372503283, 1372503283, 0, '', 0, 0, 0, 0, 13, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(61, 'testuser22', '$2a$10$1d3a7d0054099a7da1396OIMODyP.B96XIaCfH.m.f6UQ.R6neFTO', '$2a$10$1d3a7d0054099a7da1396c', 43, '', '', 'test@asdfasdf.com', 0, 0, 1387240056, 1387240056, 1387240056, '', 0, 1387240349, 0, 0, 13, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1, 0),
(62, 'tsetdff', '$2a$07$8ae51429def7b31d088bdOotBVZTdKeqDjP7fAYMgmzFr6Y72LG/.', '$2a$07$8ae51429def7b31d088bdd', 43, '', '', 'asdfsdf@asdfsdd.com', 0, 0, 1387240928, 1387240928, 1387240928, '', 0, 0, 0, 0, 13, '', 1, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0),
(63, 'TestMember8', '$2a$04$fae0e2e3370666c73df3cuvTt5yh73lLmRjDvBG4nqAbZEtkSbGsq', '$2a$04$fae0e2e3370666c73df3c4', 31, '', '', '', 0, 0, 1387995873, 1389219085, 1389219212, '<a href=''http://localhost/cs4/members/''>My Account</a>', 0, 0, 1388098544, 7, 13, '127.0.0.1', 10, 0, 0, 0, 0, 0, 25, 1388098544, '', 0, 0, 1388730466),
(64, 'CoCommander', '$2a$10$0beb8b99d068815e3bc13uWUk9lfeWPbvlm0Z8Lf6KmnU6fUP4TmC', '$2a$10$0beb8b99d068815e3bc136', 42, '', '', '', 0, 0, 1395346034, 1395346034, 0, '', 0, 0, 0, 0, 13, '', 0, 0, 0, 0, 0, 0, 25, 0, '', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `membersonlypage`
--

CREATE TABLE IF NOT EXISTS `membersonlypage` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `dateadded` int(11) NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `menuitem_customblock`
--

CREATE TABLE IF NOT EXISTS `menuitem_customblock` (
  `menucustomblock_id` int(11) NOT NULL AUTO_INCREMENT,
  `menuitem_id` int(11) NOT NULL,
  `blocktype` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `code` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`menucustomblock_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `menuitem_customblock`
--

INSERT INTO `menuitem_customblock` (`menucustomblock_id`, `menuitem_id`, `blocktype`, `code`) VALUES
(13, 61, 'code', '<b>SITE LINKS:</b>'),
(14, 62, 'code', '<br><b>TOP PLAYERS:</b><br>'),
(15, 64, 'code', '<br><b>DOWNLOADS:</b><br>');

-- --------------------------------------------------------

--
-- Table structure for table `menuitem_custompage`
--

CREATE TABLE IF NOT EXISTS `menuitem_custompage` (
  `menucustompage_id` int(11) NOT NULL AUTO_INCREMENT,
  `menuitem_id` int(11) NOT NULL,
  `custompage_id` int(11) NOT NULL,
  `prefix` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `linktarget` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textalign` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`menucustompage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `menuitem_custompage`
--

INSERT INTO `menuitem_custompage` (`menucustompage_id`, `menuitem_id`, `custompage_id`, `prefix`, `linktarget`, `textalign`) VALUES
(4, 46, 7, '<b>&middot;</b> ', '', 'left'),
(5, 47, 6, '<b>&middot;</b> ', '', 'left'),
(6, 58, 12, '<b>&middot;</b> ', '', 'left'),
(7, 59, 11, '<b>&middot;</b> ', '', 'left'),
(8, 65, 6, '<b>&middot;</b> ', '', 'left'),
(9, 66, 7, '<b>&middot;</b> ', '', 'left');

-- --------------------------------------------------------

--
-- Table structure for table `menuitem_image`
--

CREATE TABLE IF NOT EXISTS `menuitem_image` (
  `menuimage_id` int(11) NOT NULL AUTO_INCREMENT,
  `menuitem_id` int(11) NOT NULL,
  `imageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `link` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `linktarget` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `imagealign` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`menuimage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `menuitem_link`
--

CREATE TABLE IF NOT EXISTS `menuitem_link` (
  `menulink_id` int(11) NOT NULL AUTO_INCREMENT,
  `menuitem_id` int(11) NOT NULL,
  `link` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `linktarget` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `textalign` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`menulink_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `menuitem_link`
--

INSERT INTO `menuitem_link` (`menulink_id`, `menuitem_id`, `link`, `linktarget`, `prefix`, `textalign`) VALUES
(30, 54, 'ranks.php', '', '<b>&middot;</b> ', 'left'),
(31, 55, 'medals.php', '', '<b>&middot;</b> ', 'left'),
(32, 56, 'diplomacy', '', '<b>&middot;</b> ', 'left'),
(33, 57, 'diplomacy/request.php', '', '<b>&middot;</b> ', 'left'),
(34, 67, 'index.php', '', '<b>&middot;</b> ', 'left');

-- --------------------------------------------------------

--
-- Table structure for table `menuitem_shoutbox`
--

CREATE TABLE IF NOT EXISTS `menuitem_shoutbox` (
  `menushoutbox_id` int(11) NOT NULL AUTO_INCREMENT,
  `menuitem_id` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `percentwidth` int(1) NOT NULL,
  `percentheight` int(1) NOT NULL,
  `textboxwidth` int(11) NOT NULL,
  PRIMARY KEY (`menushoutbox_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menuitem_shoutbox`
--

INSERT INTO `menuitem_shoutbox` (`menushoutbox_id`, `menuitem_id`, `width`, `height`, `percentwidth`, `percentheight`, `textboxwidth`) VALUES
(1, 2, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_category`
--

CREATE TABLE IF NOT EXISTS `menu_category` (
  `menucategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  `headertype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `headercode` longtext COLLATE utf8_unicode_ci NOT NULL,
  `accesstype` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  PRIMARY KEY (`menucategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `menu_category`
--

INSERT INTO `menu_category` (`menucategory_id`, `section`, `name`, `sortnum`, `headertype`, `headercode`, `accesstype`, `hide`) VALUES
(5, 0, 'Forum Activity', 4, 'customcode', 'FORUM ACTIVITY', 0, 0),
(1, 0, 'Shoutbox', 3, 'customcode', 'SHOUTBOX', 0, 0),
(4, 0, 'Newest Members', 6, 'customcode', 'NEWEST MEMBERS', 0, 0),
(24, 0, 'Log In', 2, 'customcode', 'LOG IN', 2, 0),
(25, 0, 'Logged In', 1, 'customcode', 'LOGGED IN', 1, 0),
(16, 0, 'Poll', 5, 'customcode', 'POLL', 0, 0),
(17, 1, 'Main Menu', 1, 'customcode', 'MAIN MENU', 0, 0),
(18, 1, 'News', 2, 'customcode', '<a href=''[MAIN_ROOT]news''>NEWS</a>', 0, 0),
(19, 1, 'Members', 3, 'customcode', '<a href=''[MAIN_ROOT]members.php''>MEMBERS</a>', 0, 0),
(20, 1, 'Tournaments', 4, 'customcode', '<a href=''[MAIN_ROOT]tournaments''>TOURNAMENTS</a>', 0, 0),
(21, 1, 'Squads', 5, 'customcode', '<a href=''[MAIN_ROOT]squads''>SQUADS</a>', 0, 0),
(22, 1, 'Events', 6, 'customcode', '<a href=''[MAIN_ROOT]events''>EVENTS</a>', 0, 0),
(23, 1, 'Forum', 7, 'customcode', '<a href=''[MAIN_ROOT]forum''>FORUM</a>', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu_item`
--

CREATE TABLE IF NOT EXISTS `menu_item` (
  `menuitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `menucategory_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `itemtype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `itemtype_id` int(11) NOT NULL,
  `accesstype` int(1) NOT NULL,
  `hide` int(1) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`menuitem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=75 ;

--
-- Dumping data for table `menu_item`
--

INSERT INTO `menu_item` (`menuitem_id`, `menucategory_id`, `name`, `itemtype`, `itemtype_id`, `accesstype`, `hide`, `sortnum`) VALUES
(2, 1, 'Shoutbox', 'shoutbox', 1, 0, 0, 1),
(4, 4, 'Newest Members', 'newestmembers', 0, 0, 0, 1),
(5, 5, 'Forum Activity', 'forumactivity', 0, 0, 0, 1),
(54, 17, 'Ranks', 'link', 30, 0, 0, 3),
(55, 17, 'Medals', 'link', 31, 0, 0, 4),
(56, 17, 'Diplomacy', 'link', 32, 0, 0, 5),
(57, 17, 'Diplomacy Request', 'link', 33, 0, 0, 6),
(58, 17, 'Rules', 'custompage', 6, 0, 0, 8),
(59, 17, 'History', 'custompage', 7, 0, 0, 7),
(61, 17, 'Site Links', 'customcode', 13, 0, 0, 1),
(62, 17, 'Top Players', 'customcode', 14, 0, 0, 9),
(63, 17, 'Top Player Links', 'top-players', 0, 0, 0, 10),
(64, 17, 'Downloads', 'customcode', 15, 0, 0, 11),
(65, 17, 'Replays', 'downloads', 8, 0, 0, 12),
(66, 17, 'Videos', 'downloads', 9, 0, 0, 13),
(67, 17, 'Home', 'link', 34, 0, 0, 2),
(68, 16, 'Poll', 'poll', 1, 0, 0, 1),
(69, 24, 'Log In', 'login', 0, 0, 0, 1),
(70, 25, 'Logged In', 'login', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `news_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `newstype` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `postsubject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newspost` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lasteditmember_id` int(11) NOT NULL,
  `lasteditdate` int(11) NOT NULL,
  `hpsticky` int(11) NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=69 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `member_id`, `newstype`, `dateposted`, `postsubject`, `newspost`, `lasteditmember_id`, `lasteditdate`, `hpsticky`) VALUES
(62, 13, 3, 1395020728, 'Shoutbox Post', 'k', 13, 1395855813, 0),
(63, 13, 1, 1395367059, 'test', '<p>[poll]1[/poll]</p>', 13, 1395367096, 0),
(64, 13, 2, 1395614066, 'test private news', '<p>test</p>\r\n<p>&nbsp;</p>\r\n<p>asdf</p>', 0, 0, 0),
(43, 13, 1, 1388726617, 'test anohter', 'asdfasdfsddd', 0, 0, 0),
(35, 13, 1, 1373327157, 'Testing News', 'asdfasdfsadf\r\n\r\nsadfasdfsdf', 13, 1390367074, 0),
(42, 13, 1, 1388726078, 'another news post', 'ddddd', 0, 0, 0),
(40, 13, 1, 1378617595, 'Test Twitch', '[twitch]http://www.twitch.tv/meatwagon22[/twitch]', 0, 0, 0),
(41, 13, 1, 1379122878, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam q<b>uis dolo</b>r quam. Mauris ipsum magna, suscipit at lectus sit amet, tempor faucibus tortor. Aliquam congue nisi non arcu suscipit malesuada. Nulla sed dolor eget erat consequat ornare sit amet a arcu. Vestibulum facilisis tempor sem et vehicula. Mauris ut quam ut arcu iaculis sodales. Vestibulum auctor non purus sit amet tempus. Curabitur sit amet auctor felis. Nam nec imperdiet purus. Sed in justo at ipsum faucibus hendrerit sit amet id elit. Quisque feugiat sit amet est sed varius. Praesent facilisis sem lectus. Nunc facilisis ornare lectus, porta interdum sapien ultrices non. Phasellus tortor leo, tincidunt in luctus at, varius ac velit. Phasellus nibh dui, lobortis non orci ac, dignissim tincidunt tortor. Sed eleifend augue sollicitudin scelerisque dapibus. ', 13, 1391458414, 1),
(44, 13, 1, 1388728062, 'test links', 'https://www.google.com', 0, 0, 0),
(45, 13, 1, 1388728136, 'test youtube', '[youtube]http://www.youtube.com/watch?v=bnTHWV004AA[/youtube]', 0, 0, 0),
(46, 13, 1, 1388728359, 'test links 2', 'http://www.google.com', 0, 0, 0),
(47, 13, 1, 1388729199, 'test url links', '[url=http://google.com]http://google.com[/url]', 0, 0, 0),
(49, 13, 1, 1391456776, 'sdf', '[url=http://www.wa-sta.net/?nick=lmarcussl][img]http://sig.wa-sta.net/10/0/lmarcussl.png[/img][/url]', 13, 1391456921, 0),
(65, 42, 3, 1400709452, 'Shoutbox Post', 'asdf', 0, 0, 0),
(66, 13, 2, 1401845056, 'test', '<p>asdfasd</p>', 0, 0, 0),
(68, 13, 1, 1401850540, 'Test', '<p>asdfasdfa</p>\r\n', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `datesent` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `icontype` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=161 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `member_id`, `datesent`, `message`, `status`, `icontype`) VALUES
(1, 43, 1362363099, 'Your rank has been set to Commander!', 1, 'general'),
(2, 48, 1362363754, 'Your rank has been set to Commander!', 1, 'general'),
(3, 13, 1362363928, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(4, 13, 1362363928, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(5, 13, 1362363928, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 1, 'general'),
(6, 13, 1362363928, 'You have been awarded the Old Timer Medal for being the clan for 120 days.', 1, 'general'),
(7, 13, 1362363928, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 1, 'general'),
(8, 13, 1362363928, 'You have been awarded the Humanitarian Medal for recruiting 5 members.', 1, 'general'),
(9, 43, 1362365595, 'You have been invited to the event, <b>test</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=1''>event</a> page to view more info.', 1, 'general'),
(10, 13, 1362365703, '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=43'' style=''color: #FF0000''>TestMember</a></span> is going to your <a href=''/cs4git/events/info.php?eID=1''>event</a>.', 1, 'general'),
(11, 43, 1362366001, 'A chatroom has been started for the event, <a href=''/cs4git/members/events/manage.php?eID=1&pID=Chat''>test</a>!', 1, 'general'),
(12, 48, 1362366926, 'You have been invited to the event, <b>test</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=1''>event</a> page to view more info.', 1, 'general'),
(13, 49, 1362366926, 'You have been invited to the event, <b>test</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=1''>event</a> page to view more info.', 0, 'general'),
(14, 44, 1362366926, 'You have been invited to the event, <b>test</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=1''>event</a> page to view more info.', 1, 'general'),
(15, 42, 1362366926, 'You have been invited to the event, <b>test</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=1''>event</a> page to view more info.', 1, 'general'),
(16, 43, 1362368871, 'You have been invited to the event, <b>The Top Secret Event</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=3''>event</a> page to view more info.', 1, 'general'),
(17, 46, 1362368871, 'You have been invited to the event, <b>The Top Secret Event</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=3''>event</a> page to view more info.', 1, 'general'),
(18, 45, 1362368871, 'You have been invited to the event, <b>The Top Secret Event</b>!.  Go to the <a href=''/cs4git/events/info.php?eID=3''>event</a> page to view more info.', 1, 'general'),
(19, 13, 1362368900, '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=43'' style=''color: #FF0000''>TestMember</a></span> is going to your <a href=''/cs4git/events/info.php?eID=3''>event</a>.', 1, 'general'),
(20, 43, 1364181795, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(21, 43, 1364181795, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(22, 48, 1364181954, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(23, 48, 1364181954, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(24, 13, 1365132767, 'There is a new submission for custom form: <b>Test Form Page</b><br><a href=''/cs4git/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(25, 13, 1365132973, 'There is a new submission for custom form: <b>Test Form Page</b><br><a href=''/cs4git/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(26, 13, 1365133148, 'There is a new submission for custom form: <b>Test Form Page</b><br><a href=''/cs4git/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(27, 13, 1365133329, 'There is a new submission for custom form: <b>Test Form Page</b><br><a href=''/cs4git/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(28, 13, 1365133385, 'There is a new submission for custom form: <b>Test Form Page</b><br><a href=''/cs4git/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(29, 42, 1366245676, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(30, 42, 1366245676, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(31, 42, 1366525393, '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> has updated the match results for <a href=''/cs4git/members/console.php?cID=77&pID=9''>TestCommander vs. admin</a>', 1, 'general'),
(32, 48, 1366525547, '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> has updated the match results for <a href=''/cs4git/members/console.php?cID=77&pID=11''>NewMember vs. admin</a>', 1, 'general'),
(33, 43, 1366569495, '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> has updated the match results for <a href=''/cs4git/members/console.php?cID=77&mID=3''>admin vs. TestMember</a>', 1, 'general'),
(34, 43, 1366569517, '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> has updated the match results for <a href=''/cs4git/members/console.php?cID=77&mID=3''>admin vs. TestMember</a>', 1, 'general'),
(35, 43, 1366569841, '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> has updated the match results for <a href=''/cs4git/members/console.php?cID=77&mID=3''>admin vs. TestMember</a>', 1, 'general'),
(36, 13, 1366570087, '<span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=43'' style=''color: #FF0000''>TestMember</a></span> has updated the match results for <a href=''/cs4git/members/console.php?cID=77&mID=3''>admin vs. TestMember</a>', 1, 'general'),
(37, 43, 1366581613, '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> has approved the match results for <a href=''/cs4git/tournaments/view.php?tID=1''>admin vs. TestMember</a>', 1, 'general'),
(38, 13, 1366598290, '<span style=''color: #7FFF00''><a href=''/cs4git/profile.php?mID=13'' style=''color: ''>admin</a></span> has joined your tournament: <a href=''/cs4git/tournaments/view.php?tID=2''>TEst Pools</a>', 1, 'general'),
(39, 42, 1367115505, 'You have received a squad invitation from <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>!<br><br><a href=''/cs4git/members/console.php?cID=74''>Click Here</a> to view your Squad Invitations.', 1, 'general'),
(40, 50, 1367115518, 'You have received a squad invitation from <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>!<br><br><a href=''/cs4git/members/console.php?cID=74''>Click Here</a> to view your Squad Invitations.', 1, 'general'),
(41, 48, 1367115530, 'You have received a squad invitation from <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>!<br><br><a href=''/cs4git/members/console.php?cID=74''>Click Here</a> to view your Squad Invitations.', 1, 'general'),
(42, 13, 1367115681, 'There are currently members in your squad, <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b> without ranks!', 1, 'general'),
(43, 48, 1367115681, 'Congratulations!  You just joined the squad <b>Test Squad</b>.  View the Squads section of <a href=''/cs4git/members''>My Account</a> to <a href=''/cs4git/members/console.php?cID=72''>View Your Squads</a>.', 1, 'general'),
(44, 13, 1367115681, '<b><span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=48'' style=''color: #FF0000''>NewMember</a></span></b> has accepted the invitation to join <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>', 1, 'general'),
(45, 13, 1367115754, 'There are currently members in your squad, <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b> without ranks!', 1, 'general'),
(46, 42, 1367115754, 'Congratulations!  You just joined the squad <b>Test Squad</b>.  View the Squads section of <a href=''/cs4git/members''>My Account</a> to <a href=''/cs4git/members/console.php?cID=72''>View Your Squads</a>.', 1, 'general'),
(47, 13, 1367115754, '<b><span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=42'' style=''color: #FF0000''>TestCommander</a></span></b> has accepted the invitation to join <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>', 1, 'general'),
(48, 13, 1367115770, 'There are currently members in your squad, <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b> without ranks!', 1, 'general'),
(49, 50, 1367115770, 'Congratulations!  You just joined the squad <b>Test Squad</b>.  View the Squads section of <a href=''/cs4git/members''>My Account</a> to <a href=''/cs4git/members/console.php?cID=72''>View Your Squads</a>.', 1, 'general'),
(50, 13, 1367115770, '<b><span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=50'' style=''color: #00FFFF''>Testing</a></span></b> has accepted the invitation to join <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>', 1, 'general'),
(51, 43, 1367116003, 'You have received a squad invitation from <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>!<br><br><a href=''/cs4git/members/console.php?cID=74''>Click Here</a> to view your Squad Invitations.', 1, 'general'),
(52, 13, 1367116035, 'There are currently members in your squad, <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b> without ranks!', 1, 'general'),
(53, 43, 1367116035, 'Congratulations!  You just joined the squad <b>Test Squad</b>.  View the Squads section of <a href=''/cs4git/members''>My Account</a> to <a href=''/cs4git/members/console.php?cID=72''>View Your Squads</a>.', 1, 'general'),
(54, 13, 1367116035, '<b><span style=''color: #ffffff''><a href=''/cs4git/profile.php?mID=43'' style=''color: #FF0000''>TestMember</a></span></b> has accepted the invitation to join <b><a href=''/cs4git/squads/profile.php?sID=1''>Test Squad</a></b>', 1, 'general'),
(55, 51, 1367367576, 'Your rank has been set to Recruit!', 1, 'general'),
(56, 46, 1368390309, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(57, 46, 1368390309, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(58, 46, 1368390309, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 1, 'general'),
(59, 43, 1368504425, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 1, 'general'),
(60, 13, 1369632295, 'Your recruiter has been set to ANotherONE?!', 1, 'general'),
(61, 51, 1369632318, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(62, 51, 1369632318, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(63, 13, 1369632371, 'Your recruiter has been set to ANotherONE?!', 1, 'general'),
(64, 48, 1369634319, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 1, 'general'),
(65, 42, 1369717988, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 1, 'general'),
(66, 42, 1369717988, 'You have been awarded the Old Timer Medal for being the clan for 120 days.', 1, 'general'),
(67, 42, 1369717988, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 1, 'general'),
(68, 13, 1370700233, 'Your recruiter has been set to TestCommander!', 1, 'general'),
(69, 53, 1373425825, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 0, 'general'),
(70, 53, 1373428269, 'You have been demoted to Private First Class!', 0, 'demotion'),
(71, 53, 1373428582, 'You have been demoted to Private!', 0, 'demotion'),
(72, 48, 1373430396, 'You were stripped of the medal: <b>Rookie Medal</b>', 1, 'general'),
(73, 48, 1373430406, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(74, 48, 1373430406, 'You have been awarded the Old Timer Medal for being the clan for 120 days.', 1, 'general'),
(75, 48, 1373430486, 'You were stripped of the medal: <b>Rookie Medal</b>', 1, 'general'),
(76, 48, 1373603328, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(77, 48, 1373603328, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 1, 'general'),
(78, 48, 1373430749, 'You were stripped of the medal: <b>Rookie Medal</b>', 1, 'general'),
(79, 52, 1373744442, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(80, 52, 1373744455, 'You were stripped of the medal: <b>Rookie Medal</b>', 1, 'general'),
(81, 43, 1374118943, 'You have been demoted to Co-Commander!', 1, 'demotion'),
(82, 43, 1374120016, 'You were awarded the medal: <b>Epic Medal</b>', 1, 'general'),
(83, 43, 1374120022, 'You have been awarded the Old Timer Medal for being the clan for 120 days.', 1, 'general'),
(84, 43, 1374120022, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 1, 'general'),
(85, 50, 1374357682, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(86, 50, 1374357683, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(87, 50, 1374357683, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 1, 'general'),
(88, 48, 1374358845, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(89, 42, 1374853075, 'You were awarded the medal: <b>Silver Shield Medal</b>', 1, 'general'),
(90, 42, 1374853169, 'You were awarded the medal: <b>Humanitarian Medal</b>', 1, 'general'),
(91, 42, 1374853245, 'You were stripped of the medal: <b>Humanitarian Medal</b>', 1, 'general'),
(92, 42, 1374853293, 'You were stripped of the medal: <b>Silver Shield Medal</b>', 1, 'general'),
(93, 42, 1374853406, 'You were awarded the medal: <b>Silver Shield Medal</b>', 1, 'general'),
(94, 52, 1378683234, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(95, 52, 1378683234, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 1, 'general'),
(96, 44, 1383805399, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 0, 'general'),
(97, 44, 1383805399, 'You have been awarded the Established Member Medal for being the clan for 30 days.', 0, 'general'),
(98, 44, 1383805399, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 0, 'general'),
(99, 44, 1383805399, 'You have been awarded the Old Timer Medal for being the clan for 120 days.', 0, 'general'),
(100, 44, 1383805399, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 0, 'general'),
(101, 13, 1386125017, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(102, 13, 1386125064, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(103, 13, 1386125097, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(104, 13, 1386125123, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(105, 13, 1386125412, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(106, 13, 1386125456, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(107, 13, 1386125547, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(108, 13, 1386125606, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(109, 13, 1386125664, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(110, 13, 1386125712, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(111, 13, 1386125846, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(112, 13, 1386126036, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(113, 13, 1386126072, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(114, 13, 1386126157, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(115, 13, 1386126301, 'There is a new submission for custom form: <b>Join</b><br><a href=''/cs4/members/console.php?cID=110''>View Form Submissions</a>', 1, 'general'),
(116, 61, 1387240349, 'You have been promoted to Recruit!', 0, 'promotion'),
(117, 63, 1388098544, 'Your rank has been set to General!', 1, 'general'),
(118, 13, 1388362693, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(119, 13, 1388362818, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(120, 13, 1388362868, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(121, 42, 1388597781, 'You were awarded the medal: <b>Forum Hero</b>', 1, 'general'),
(122, 43, 1388620318, 'A new message was posted on your inactive request!<br><br><a href=''/cs4/members/console.php?cID=''>View Messages</a>', 1, 'general'),
(123, 43, 1388620385, 'A new message was posted on your inactive request!<br><br><a href=''/cs4/members/console.php?cID=175''>View Messages</a>', 1, 'general'),
(124, 43, 1388622274, 'Your inactive request was deleted!', 1, 'general'),
(125, 48, 1388622278, 'Your inactive request was deleted!', 1, 'general'),
(126, 43, 1388623373, 'A new message was posted on your inactive request!<br><br><a href=''/cs4/members/console.php?cID=175''>View Messages</a>', 1, 'general'),
(127, 43, 1388623411, 'A new message was posted on your inactive request!<br><br><a href=''/cs4/members/console.php?cID=175''>View Messages</a>', 1, 'general'),
(128, 43, 1388623414, 'Your inactive request was approved!', 1, 'general'),
(129, 63, 1388730466, 'Your inactive request was approved!', 1, 'general'),
(130, 63, 1388730844, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 1, 'general'),
(131, 51, 1388733232, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 0, 'general'),
(132, 51, 1388733232, 'You have been awarded the Old Timer Medal for being the clan for 120 days.', 0, 'general'),
(133, 51, 1388733232, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 0, 'general'),
(134, 13, 1389219148, '<span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=63'' style=''color: #9191FF'' title=''TestMember8''>TestMember8</a></span> has joined your tournament: <a href=''/cs4/tournaments/view.php?tID=1''>Test Tournament</a>', 1, 'general'),
(135, 13, 1389219209, '<span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=63'' style=''color: #9191FF'' title=''TestMember8''>TestMember8</a></span> has joined your tournament: <a href=''/cs4/tournaments/view.php?tID=3''>Test Tournament Teams</a>', 1, 'general'),
(136, 13, 1389648558, 'You have been awarded the ljk for being the clan for 100 days.', 1, 'general'),
(137, 42, 1389989877, 'You were awarded the medal: <b>Epic Medal</b>', 1, 'general'),
(138, 42, 1389989882, 'You have been awarded the ljk for being the clan for 100 days.', 1, 'general'),
(139, 48, 1390416072, 'Your were promoted to the rank of <b>New Founder</b> in squad: <b><a href=''/cs4/squads/profile.php?sID=1''>Test Squad</a></b>.', 1, 'general'),
(140, 56, 1391831627, 'You have been awarded the ljk for being the clan for 100 days.', 0, 'general'),
(141, 56, 1391831627, 'You have been awarded the Rookie Medal for being the clan for 5 days.', 0, 'general'),
(142, 56, 1391831627, 'You have been awarded the Veteran Medal for being the clan for 90 days.', 0, 'general'),
(143, 56, 1391831627, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 0, 'general'),
(144, 13, 1393195622, '<span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=52'' style=''color: #6DD46A'' title=''checkitout[bT]''>checkitout[bT]</a></span> has joined your tournament: <a href=''/cs4/tournaments/view.php?tID=3''>Test Tournament Teams</a>', 1, 'general'),
(145, 13, 1393195648, '<span style=''color: #ffffff''><a href=''/cs4/profile.php?mID=46'' style=''color: #6DD46A'' title=''ANotherONE?''>ANotherONE?</a></span> has joined your tournament: <a href=''/cs4/tournaments/view.php?tID=3''>Test Tournament Teams</a>', 1, 'general'),
(146, 42, 1393451109, 'You have been added as a manager on the tournament: <a href=''tournaments/view.php?tID=6''>test tournament</a>.', 1, 'general'),
(147, 46, 1393536099, 'You have been added as a manager on the tournament: <a href=''tournaments/view.php?tID=6''>test tournament</a>.', 1, 'general'),
(148, 46, 1393536139, 'You have been removed as a manager on the tournament: <a href=''tournaments/view.php?tID=6''>test tournament</a>.', 1, 'general'),
(149, 46, 1393536172, 'You have been added as a manager on the tournament: <a href=''/cs4/tournaments/view.php?tID=6''>test tournament</a>.', 1, 'general'),
(150, 61, 1393724990, 'You are On Leave Until ', 0, 'general'),
(151, 13, 1395014578, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(152, 42, 1395014579, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(153, 13, 1395014676, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(154, 42, 1395014677, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(155, 48, 1395023320, 'You have been added as a manager on the tournament: <a href=''/cs4/tournaments/view.php?tID=9''>Test Timezones</a>.', 1, 'general'),
(156, 42, 1396811218, 'You were awarded the medal: <b>Shooting Star Medal</b>', 1, 'general'),
(157, 48, 1396815345, 'You were stripped of the medal: <b>Shooting Star Medal</b>', 0, 'general'),
(158, 48, 1400709315, 'You have been awarded the Shooting Star Medal for being the clan for 150 days.', 0, 'general'),
(159, 13, 1401826331, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 1, 'general'),
(160, 42, 1401826332, 'A new member has signed up!  Go to the <a href=''/cs4/members/console.php?cID=98''>View Member Applications</a> page to review the application.', 0, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `plugins`
--

CREATE TABLE IF NOT EXISTS `plugins` (
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filepath` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `apikey` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `dateinstalled` int(11) NOT NULL,
  PRIMARY KEY (`plugin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `plugins`
--

INSERT INTO `plugins` (`plugin_id`, `name`, `filepath`, `apikey`, `dateinstalled`) VALUES
(3, 'Donations', 'donations', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plugin_config`
--

CREATE TABLE IF NOT EXISTS `plugin_config` (
  `pluginconfig_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`pluginconfig_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `plugin_config`
--

INSERT INTO `plugin_config` (`pluginconfig_id`, `plugin_id`, `name`, `value`) VALUES
(1, 3, 'email', 'homerun31@msn.com');

-- --------------------------------------------------------

--
-- Table structure for table `plugin_pages`
--

CREATE TABLE IF NOT EXISTS `plugin_pages` (
  `pluginpage_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) NOT NULL,
  `page` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pagepath` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`pluginpage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `poll_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `question` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `accesstype` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `multivote` int(11) NOT NULL,
  `displayvoters` int(11) NOT NULL,
  `resultvisibility` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `maxvotes` int(11) NOT NULL,
  `pollend` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `lastedit_date` int(11) NOT NULL,
  `lastedit_memberid` int(11) NOT NULL,
  PRIMARY KEY (`poll_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`poll_id`, `member_id`, `question`, `accesstype`, `multivote`, `displayvoters`, `resultvisibility`, `maxvotes`, `pollend`, `dateposted`, `lastedit_date`, `lastedit_memberid`) VALUES
(1, 13, 'Whats your favorite color?', 'public', 0, 0, 'open', 0, 0, 1395344025, 1395859418, 13);

-- --------------------------------------------------------

--
-- Table structure for table `poll_memberaccess`
--

CREATE TABLE IF NOT EXISTS `poll_memberaccess` (
  `pollmemberaccess_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `accesstype` int(11) NOT NULL,
  PRIMARY KEY (`pollmemberaccess_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

CREATE TABLE IF NOT EXISTS `poll_options` (
  `polloption_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `optionvalue` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`polloption_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`polloption_id`, `poll_id`, `optionvalue`, `color`, `sortnum`) VALUES
(1, 1, 'Green', '#1AFF00', 0),
(2, 1, 'White', '#FFFFFF', 1),
(3, 1, 'Black', '#000000', 2),
(4, 1, 'Red', '#FF0000', 3),
(5, 1, 'Blue', '#0900FF', 4);

-- --------------------------------------------------------

--
-- Table structure for table `poll_rankaccess`
--

CREATE TABLE IF NOT EXISTS `poll_rankaccess` (
  `pollrankaccess_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `accesstype` int(11) NOT NULL,
  PRIMARY KEY (`pollrankaccess_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE IF NOT EXISTS `poll_votes` (
  `pollvote_id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_id` int(11) NOT NULL,
  `polloption_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datevoted` int(11) NOT NULL,
  `votecount` int(11) NOT NULL,
  PRIMARY KEY (`pollvote_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `poll_votes`
--

INSERT INTO `poll_votes` (`pollvote_id`, `poll_id`, `polloption_id`, `member_id`, `ipaddress`, `datevoted`, `votecount`) VALUES
(1, 1, 2, 13, '127.0.0.1', 1395859432, 2),
(2, 1, 4, 13, '127.0.0.1', 1395380448, 3),
(3, 1, 3, 13, '127.0.0.1', 1395380435, 1);

-- --------------------------------------------------------

--
-- Table structure for table `privatemessages`
--

CREATE TABLE IF NOT EXISTS `privatemessages` (
  `pm_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `datesent` int(11) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `originalpm_id` int(11) NOT NULL,
  `deletesender` int(11) NOT NULL,
  `deletereceiver` int(11) NOT NULL,
  `senderfolder_id` int(11) NOT NULL DEFAULT '-1',
  `receiverfolder_id` int(11) NOT NULL,
  PRIMARY KEY (`pm_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=44 ;

--
-- Dumping data for table `privatemessages`
--

INSERT INTO `privatemessages` (`pm_id`, `sender_id`, `receiver_id`, `datesent`, `subject`, `message`, `status`, `originalpm_id`, `deletesender`, `deletereceiver`, `senderfolder_id`, `receiverfolder_id`) VALUES
(1, 13, 48, 1363149044, 'test', 'test', 1, 0, 0, 0, -1, 0),
(2, 13, 48, 1363150172, 'tes2', 'asdf', 1, 0, 0, 1, -1, 0),
(3, 48, 13, 1364096095, 'test', 'asdf', 1, 0, 0, 1, -1, 0),
(4, 48, 13, 1367292060, 'test', 'test', 1, 0, 0, 1, -1, 0),
(5, 48, 13, 1368072601, 'test', 'asdf', 1, 0, 0, 1, -1, 0),
(6, 13, 48, 1369634335, 'lol', 'test', 1, 4, 0, 0, -1, 0),
(7, 48, 13, 1369634403, 'asdf', 'yeahah ahah', 1, 4, 0, 0, -1, 0),
(8, 48, 13, 1369958988, 'adsf', 'sdfsd', 0, 0, 0, 1, -1, 0),
(9, 48, 13, 1369960241, 'adsfds', 'sdfsd', 0, 0, 0, 1, -1, 0),
(10, 48, 13, 1369960249, 'sadfs', 'sdfasd', 0, 0, 0, 1, -1, 0),
(11, 48, 13, 1369960363, 'asdf', 'dsfs', 1, 0, 0, 1, -1, 0),
(12, 48, 13, 1369960370, 'asds', 'sdfs', 1, 0, 0, 0, -1, 0),
(13, 48, 13, 1370406698, 'test', 'asdf', 1, 0, 0, 0, -1, -2),
(14, 13, 48, 1371123473, 'test', 'asdf', 1, 0, 0, 0, -1, 0),
(18, 13, 0, 1372049052, 'test', 'asdjkfl', 0, 0, 0, 0, -1, 0),
(19, 48, 0, 1372059346, 'test', 'teasdf', 0, 0, 0, 0, -1, 0),
(20, 13, 0, 1372059384, 'test squads', 'asdf', 0, 0, 0, 0, 0, 0),
(21, 13, 0, 1372059462, 'tournaments!', 'asdf', 0, 0, 0, 0, -2, 0),
(22, 13, 48, 1372060079, 'test', 'asdf', 1, 0, 0, 0, -1, 0),
(23, 13, 0, 1372119307, 'asdfsa', 'sdsfs', 0, 0, 0, 0, -1, 0),
(24, 13, 57, 1372127027, 'test', 'asdfsd', 1, 0, 0, 0, -1, 0),
(25, 13, 0, 1372127325, 'dsfsdf', 'asdfs', 0, 0, 0, 0, -1, 0),
(26, 13, 0, 1372130138, 'test', 'asdfs', 0, 23, 0, 0, -1, 0),
(27, 13, 0, 1372130692, 'test2 rank only', 'test3', 0, 0, 0, 0, -1, 0),
(28, 48, 0, 1372131335, 'testasdf', 'asdfsdfsd', 0, 27, 0, 0, -1, 0),
(29, 13, 48, 1372131434, 'test newmember only', 'asdfs', 1, 12, 0, 0, -1, 0),
(30, 48, 13, 1372132187, 'test admin only', 'asdf', 1, 12, 0, 0, -1, -2),
(31, 13, 48, 1372135273, 'test', 'asdfas', 0, 12, 0, 0, -1, 0),
(32, 13, 48, 1372135304, 'tasdfasdf', 'asdfasdfsf3', 1, 12, 0, 0, -1, 0),
(33, 13, 48, 1372137649, 'test reply', 'asdfasdf', 1, 12, 0, 0, -1, 0),
(34, 13, 0, 1372140665, 'test tournaments 2', 'asdfsd', 0, 0, 0, 0, -1, 0),
(35, 13, 0, 1372141268, 'lolz replys', 'asdfsd', 0, 34, 0, 0, -1, 0),
(36, 47, 13, 1374724689, 'RE: lolz replys', 'test', 1, 34, 0, 0, -1, 1),
(37, 13, 0, 1379185319, 'Test PM', 'asdfasd', 0, 0, 0, 0, -1, 0),
(38, 63, 13, 1388219482, 'test', 'asdf', 1, 0, 0, 1, -1, -2),
(39, 42, 13, 1394074512, 'asdf', 'asdf', 1, 0, 0, 0, -1, 0),
(40, 13, 13, 1394850695, 'test sending multiple', 'test', 1, 0, 0, 0, -1, 0),
(41, 13, 0, 1394851519, 'test multiple 2', 'test', 0, 0, 0, 0, -1, 0),
(42, 13, 42, 1395857830, 'thisisarealllllllylooooooooooooooongggggggggggggggsubbbbbbbbbbbbbjectline', 'test', 1, 0, 0, 0, -1, 0),
(43, 13, 42, 1396299356, 'test', 'A supperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospacesupperlongpmwithnospaces', 1, 0, 0, 0, -1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `privatemessage_folders`
--

CREATE TABLE IF NOT EXISTS `privatemessage_folders` (
  `pmfolder_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`pmfolder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `privatemessage_folders`
--

INSERT INTO `privatemessage_folders` (`pmfolder_id`, `member_id`, `name`, `ordernum`, `sortnum`) VALUES
(1, 13, 'Test Folder1', 2, 1),
(2, 13, 'New Folder', 1, 1),
(4, 42, 'test', 1, 1),
(5, 42, 'test2', 4, 2),
(6, 42, 'test3', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `privatemessage_members`
--

CREATE TABLE IF NOT EXISTS `privatemessage_members` (
  `pmmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `pm_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `grouptype` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `seenstatus` int(11) NOT NULL,
  `deletestatus` int(11) NOT NULL,
  `pmfolder_id` int(11) NOT NULL,
  PRIMARY KEY (`pmmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=57 ;

--
-- Dumping data for table `privatemessage_members`
--

INSERT INTO `privatemessage_members` (`pmmember_id`, `pm_id`, `member_id`, `grouptype`, `group_id`, `seenstatus`, `deletestatus`, `pmfolder_id`) VALUES
(1, 18, 42, 'rank', 1, 0, 0, 0),
(2, 18, 43, 'rank', 1, 1, 0, 0),
(3, 18, 48, 'rank', 1, 1, 0, 0),
(4, 19, 13, '', 0, 1, 0, -2),
(5, 19, 48, '', 0, 1, 0, 0),
(6, 20, 13, 'squad', 2, 1, 0, -2),
(7, 21, 48, 'tournament', 2, 1, 0, 0),
(8, 21, 43, 'tournament', 2, 1, 0, 0),
(9, 21, 42, 'tournament', 2, 0, 0, 0),
(10, 21, 47, 'tournament', 2, 0, 0, 0),
(11, 21, 44, 'tournament', 2, 0, 0, 0),
(12, 21, 45, 'tournament', 2, 0, 0, 0),
(13, 21, 50, 'tournament', 2, 0, 0, 0),
(14, 21, 13, 'tournament', 2, 1, 0, -2),
(15, 23, 13, '', 0, 1, 1, 0),
(16, 23, 42, 'rank', 1, 0, 0, 0),
(17, 23, 43, 'rank', 1, 1, 0, 0),
(18, 23, 48, 'rank', 1, 1, 0, 0),
(19, 25, 53, 'rank', 44, 1, 0, 0),
(20, 25, 54, 'rank', 44, 0, 0, 0),
(21, 25, 55, 'rank', 44, 0, 0, 0),
(22, 25, 56, 'rank', 44, 0, 0, 0),
(23, 25, 57, 'rank', 44, 1, 0, 0),
(24, 26, 42, 'rankcategory', 1, 0, 0, 0),
(25, 26, 43, 'rankcategory', 1, 1, 0, 0),
(26, 26, 48, 'rankcategory', 1, 1, 0, 0),
(27, 27, 42, 'rank', 41, 0, 0, 0),
(28, 27, 43, 'rank', 41, 1, 0, 0),
(29, 27, 48, 'rank', 41, 1, 0, 0),
(30, 28, 42, 'rank', 41, 0, 0, 0),
(31, 28, 43, 'rank', 41, 1, 0, 0),
(32, 28, 48, 'rank', 41, 1, 0, 0),
(33, 34, 48, 'tournament', 2, 0, 0, 0),
(34, 34, 43, 'tournament', 2, 0, 0, 0),
(35, 34, 42, 'tournament', 2, 0, 0, 0),
(36, 34, 47, 'tournament', 2, 0, 0, 0),
(37, 34, 44, 'tournament', 2, 0, 0, 0),
(38, 34, 45, 'tournament', 2, 0, 0, 0),
(39, 34, 50, 'tournament', 2, 0, 0, 0),
(40, 34, 13, 'tournament', 2, 1, 1, 0),
(41, 35, 48, 'tournament', 2, 0, 0, 0),
(42, 35, 43, 'tournament', 2, 0, 0, 0),
(43, 35, 42, 'tournament', 2, 0, 0, 0),
(44, 35, 47, 'tournament', 2, 1, 0, 0),
(45, 35, 44, 'tournament', 2, 0, 0, 0),
(46, 35, 45, 'tournament', 2, 0, 0, 0),
(47, 35, 50, 'tournament', 2, 0, 0, 0),
(48, 35, 13, 'tournament', 2, 1, 1, 0),
(49, 37, 42, '', 0, 0, 0, 0),
(50, 37, 47, '', 0, 1, 0, 0),
(51, 37, 44, '', 0, 0, 0, 0),
(52, 41, 13, 'squad', 1, 1, 0, -2),
(53, 41, 48, 'squad', 1, 0, 0, 0),
(54, 41, 42, 'squad', 1, 0, 0, 0),
(55, 41, 50, 'squad', 1, 0, 0, 0),
(56, 41, 43, 'squad', 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profilecategory`
--

CREATE TABLE IF NOT EXISTS `profilecategory` (
  `profilecategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`profilecategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `profilecategory`
--

INSERT INTO `profilecategory` (`profilecategory_id`, `name`, `ordernum`) VALUES
(1, 'Personal Information', 1);

-- --------------------------------------------------------

--
-- Table structure for table `profileoptions`
--

CREATE TABLE IF NOT EXISTS `profileoptions` (
  `profileoption_id` int(11) NOT NULL AUTO_INCREMENT,
  `profilecategory_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `optiontype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`profileoption_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `profileoptions`
--

INSERT INTO `profileoptions` (`profileoption_id`, `profilecategory_id`, `name`, `optiontype`, `sortnum`) VALUES
(2, 1, 'First Name', 'input', 2),
(3, 1, 'Gender', 'select', 1),
(6, 1, 'Last Name', 'input', 3);

-- --------------------------------------------------------

--
-- Table structure for table `profileoptions_select`
--

CREATE TABLE IF NOT EXISTS `profileoptions_select` (
  `selectopt_id` int(11) NOT NULL AUTO_INCREMENT,
  `profileoption_id` int(11) NOT NULL,
  `selectvalue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`selectopt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `profileoptions_select`
--

INSERT INTO `profileoptions_select` (`selectopt_id`, `profileoption_id`, `selectvalue`, `sortnum`) VALUES
(14, 3, 'Male', 2),
(13, 3, 'Alien', 1),
(15, 3, 'Female', 3);

-- --------------------------------------------------------

--
-- Table structure for table `profileoptions_values`
--

CREATE TABLE IF NOT EXISTS `profileoptions_values` (
  `values_id` int(11) NOT NULL AUTO_INCREMENT,
  `profileoption_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `inputvalue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`values_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=259 ;

--
-- Dumping data for table `profileoptions_values`
--

INSERT INTO `profileoptions_values` (`values_id`, `profileoption_id`, `member_id`, `inputvalue`) VALUES
(2, 0, 0, ''),
(40, 3, 18, '13'),
(41, 2, 18, 'Not Set'),
(42, 6, 18, 'Not Set'),
(34, 3, 16, '13'),
(35, 2, 16, 'Not Set'),
(36, 6, 16, 'Not Set'),
(37, 3, 17, '13'),
(38, 2, 17, 'Not Set'),
(39, 6, 17, 'Not Set'),
(124, 3, 48, '13'),
(125, 2, 48, 'Not Set'),
(126, 6, 48, 'Not Set'),
(142, 3, 42, '13'),
(143, 2, 42, 'Not Set'),
(144, 6, 42, 'Not Set'),
(253, 3, 13, '14'),
(254, 2, 13, 'Leo2'),
(255, 6, 13, 'Rojas1'),
(256, 3, 65, '13'),
(257, 2, 65, 'Not Set'),
(258, 6, 65, 'Not Set');

-- --------------------------------------------------------

--
-- Table structure for table `rankcategory`
--

CREATE TABLE IF NOT EXISTS `rankcategory` (
  `rankcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `imageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  `hidecat` int(11) NOT NULL,
  `useimage` int(1) NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `color` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rankcategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `rankcategory`
--

INSERT INTO `rankcategory` (`rankcategory_id`, `name`, `imageurl`, `ordernum`, `hidecat`, `useimage`, `description`, `imagewidth`, `imageheight`, `color`) VALUES
(1, 'Commanders', '', 6, 0, 0, 'The leaders of the clan', 0, 0, '#8A1212'),
(2, 'Generals', '', 4, 0, 0, '', 0, 0, '#6C7273'),
(7, 'Warrant Officers', '', 2, 0, 0, '', 0, 0, '#67A300'),
(6, 'Officers', '', 3, 0, 0, '', 0, 0, '#048500'),
(8, 'Enlisted', '', 1, 0, 0, '', 0, 0, '#4A2000'),
(16, 'Co-Commanders', '', 5, 0, 0, 'asdfsadfff', 0, 0, '#B35A1E');

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

CREATE TABLE IF NOT EXISTS `ranks` (
  `rank_id` int(11) NOT NULL AUTO_INCREMENT,
  `rankcategory_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `imageurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `autodays` int(11) NOT NULL,
  `hiderank` int(11) NOT NULL,
  `promotepower` int(11) NOT NULL,
  `autodisable` int(11) NOT NULL,
  `color` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=71 ;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`rank_id`, `rankcategory_id`, `name`, `description`, `imageurl`, `imagewidth`, `imageheight`, `ordernum`, `autodays`, `hiderank`, `promotepower`, `autodisable`, `color`) VALUES
(50, 8, 'Master Sergeant', '42 days in the clan.', 'images/ranks/rank_4fa5ecc2638ee.png', 50, 75, 9, 42, 0, 0, 0, '#ffffff'),
(1, 3, 'Administrator', '', '', 0, 0, 1, 0, 1, 0, 0, '#7FFF00'),
(49, 8, 'Gunnery Sergeant', '35 days in the clan.', 'images/ranks/rank_4fa5ec8766300.png', 50, 75, 8, 35, 0, 0, 0, '#ffffff'),
(41, 1, 'Commander', 'This is a very important rank. They have to be very active and a good leader.', 'images/ranks/rank_517e082d87871.png', 50, 75, 28, 0, 0, 41, 0, '#15FF00'),
(42, 16, 'Co-Commander', 'The Co-Commander helps the Commanders. Promoted by the Commander.', 'images/ranks/rank_517e0836044ec.png', 50, 75, 27, 0, 0, 31, 0, '#9C2525'),
(43, 8, 'Recruit', 'Starting Rank', 'images/ranks/rank_4fa58088a6a9d.png', 50, 75, 2, 0, 0, 0, 0, '#00EAFF'),
(44, 8, 'Private', '3 days in clan.', 'images/ranks/rank_4fa580f71decb.png', 50, 75, 3, 3, 0, 0, 0, '#ffffff'),
(45, 8, 'Private First Class', '7 days in clan.', 'images/ranks/rank_4fa581276383b.png', 50, 75, 4, 7, 0, 0, 0, '#ffffff'),
(46, 8, 'Corporal', '14 days in clan.', 'images/ranks/rank_4fa5eb8927175.png', 50, 75, 5, 14, 0, 0, 0, '#ffffff'),
(47, 8, 'Sergeant', '21 days in the clan.', 'images/ranks/rank_4fa5ebcbef13c.png', 50, 75, 6, 21, 0, 0, 0, '#ffffff'),
(48, 8, 'Staff Sergeant', '28 days in the clan.', 'images/ranks/rank_4fa5ec028e2a9.png', 50, 75, 7, 28, 0, 0, 0, '#ffffff'),
(31, 2, 'General', 'Promoted by Co-Commanders and up.', 'images/ranks/rank_4fa57ff737f8f.png', 50, 75, 26, 0, 0, 66, 0, '#ffffff'),
(51, 8, '1st Sergeant', '49 days in the clan.', 'images/ranks/rank_4fa5ed08200bc.png', 50, 75, 10, 49, 0, 0, 0, '#ffffff'),
(52, 8, 'Sergeant Major', '56 days in the clan.', 'images/ranks/rank_4fa5ed82cb573.png', 50, 75, 11, 56, 0, 0, 0, '#ffffff'),
(53, 7, 'Warrant Officer W1', 'Promoted by 2nd Lieutanent or Higher.', 'images/ranks/rank_4fa5f1e607f8a.png', 50, 75, 12, 0, 0, 0, 0, '#ffffff'),
(54, 7, 'Warrant Officer W2', 'Promoted by 2nd Lieutanent or Higher.', 'images/ranks/rank_4fa5f35316e43.png', 50, 75, 13, 0, 0, 0, 0, '#ffffff'),
(55, 7, 'Warrant Officer W3', 'Promoted by 2nd Lieutanent or Higher.', 'images/ranks/rank_4fa5f37660647.png', 50, 75, 14, 0, 0, 0, 0, '#ffffff'),
(56, 7, 'Chief Warrant Officer W4', 'Promoted by 1st Lieutanent or Higher.', 'images/ranks/rank_4fa5f3d842b99.png', 50, 75, 15, 0, 0, 52, 0, '#ffffff'),
(57, 7, 'Chief Warrant Officer W5', 'Promoted by 1st Lieutanent or Higher.', 'images/ranks/rank_4fa5f407bba12.png', 50, 75, 16, 0, 0, 52, 0, '#ffffff'),
(58, 6, '2nd Lieutenant', 'Promoted by Captain or Higher.', 'images/ranks/rank_4fa5f51b9c48c.png', 50, 75, 17, 0, 0, 55, 0, '#ffffff'),
(59, 6, '1st Lieutenant', 'Promoted by Captain or Higher.', 'images/ranks/rank_4fa5f54c265ce.png', 50, 75, 18, 0, 0, 57, 0, '#ffffff'),
(60, 6, 'Captain', 'Promoted by Colonel or Higher.', 'images/ranks/rank_4fa5f5ddbca9a.png', 50, 75, 19, 0, 0, 59, 0, '#ffffff'),
(61, 6, 'Major', 'Promoted by Colonel or Higher.', 'images/ranks/rank_4fa5f614eabf2.png', 50, 75, 20, 0, 0, 59, 0, '#FF6F00'),
(62, 6, 'Lieutenant Colonel', 'Promoted by Colonel or Higher.', 'images/ranks/rank_517e084db9628.png', 50, 75, 21, 0, 0, 59, 0, '#ffffff'),
(63, 6, 'Colonel', 'Promoted by Brigadier General or Higher.', 'images/ranks/rank_517e0842d66f0.png', 50, 75, 22, 0, 0, 62, 0, '#ffffff'),
(64, 2, 'Brigadier General', 'Promoted by Lieutenant General or Higher.', 'images/ranks/rank_4fa5f9c2eb082.png', 50, 75, 23, 0, 0, 63, 0, '#ffffff'),
(65, 2, 'Major General', 'Promoted by General or Higher.', 'images/ranks/rank_4fa5f9f050643.png', 50, 75, 24, 0, 0, 63, 0, '#ffffff'),
(66, 2, 'Lieutenant General', 'Promoted by General or Higher.', 'images/ranks/rank_4fa5fa1568f34.png', 50, 75, 25, 0, 0, 64, 0, '#ffffff');

-- --------------------------------------------------------

--
-- Table structure for table `rank_privileges`
--

CREATE TABLE IF NOT EXISTS `rank_privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2683 ;

--
-- Dumping data for table `rank_privileges`
--

INSERT INTO `rank_privileges` (`privilege_id`, `rank_id`, `console_id`) VALUES
(2, 1, 2),
(3, 1, 3),
(6, 1, 7),
(10, 1, 11),
(11, 1, 12),
(12, 1, 14),
(13, 1, 15),
(14, 1, 17),
(15, 1, 18),
(16, 1, 19),
(2180, 31, 91),
(2179, 31, 90),
(836, 58, 75),
(856, 57, 75),
(855, 57, 71),
(872, 56, 93),
(871, 56, 85),
(920, 55, 74),
(901, 54, 93),
(900, 54, 85),
(927, 53, 93),
(926, 53, 85),
(938, 52, 85),
(948, 51, 85),
(958, 50, 85),
(968, 49, 85),
(978, 48, 85),
(988, 47, 85),
(998, 46, 85),
(835, 58, 71),
(165, 1, 25),
(1527, 43, 92),
(2682, 41, 140),
(61, 1, 22),
(62, 1, 23),
(2681, 41, 138),
(2680, 41, 139),
(2679, 41, 137),
(2110, 42, 91),
(2109, 42, 18),
(2108, 42, 90),
(816, 59, 75),
(815, 59, 71),
(2240, 60, 7),
(2239, 60, 92),
(782, 61, 77),
(781, 61, 74),
(780, 61, 76),
(1514, 62, 7),
(1512, 62, 92),
(1491, 63, 7),
(1489, 63, 92),
(707, 64, 75),
(706, 64, 71),
(678, 65, 75),
(677, 65, 71),
(649, 66, 75),
(648, 66, 71),
(340, 1, 34),
(339, 1, 33),
(338, 1, 32),
(337, 1, 31),
(2107, 42, 17),
(779, 61, 73),
(1511, 62, 70),
(1488, 63, 70),
(367, 1, 21),
(2678, 41, 136),
(2178, 31, 8),
(852, 57, 93),
(832, 58, 93),
(812, 59, 93),
(778, 61, 11),
(1510, 62, 89),
(1487, 63, 89),
(703, 64, 93),
(674, 65, 93),
(645, 66, 93),
(451, 1, 8),
(2677, 41, 134),
(2106, 42, 8),
(2177, 31, 7),
(851, 57, 85),
(831, 58, 85),
(811, 59, 85),
(2237, 60, 84),
(1509, 62, 72),
(1486, 63, 72),
(702, 64, 85),
(673, 65, 85),
(644, 66, 85),
(482, 1, 51),
(483, 1, 52),
(494, 1, 63),
(493, 1, 62),
(492, 1, 61),
(491, 1, 60),
(495, 1, 64),
(496, 1, 65),
(497, 1, 66),
(575, 1, 85),
(574, 1, 84),
(509, 1, 70),
(517, 1, 71),
(518, 1, 72),
(519, 1, 73),
(520, 1, 74),
(573, 1, 83),
(1526, 43, 89),
(776, 61, 75),
(775, 61, 71),
(564, 1, 75),
(565, 1, 76),
(772, 61, 93),
(771, 61, 85),
(578, 1, 86),
(580, 1, 88),
(581, 1, 89),
(582, 1, 90),
(583, 1, 91),
(584, 1, 92),
(585, 1, 93),
(2105, 42, 7),
(2104, 42, 102),
(2103, 42, 92),
(2101, 42, 104),
(2100, 42, 88),
(2099, 42, 84),
(2098, 42, 70),
(2097, 42, 103),
(2096, 42, 89),
(2094, 42, 72),
(2093, 42, 83),
(2092, 42, 21),
(2091, 42, 125),
(2090, 42, 107),
(2089, 42, 101),
(2176, 31, 92),
(2174, 31, 88),
(2173, 31, 84),
(2172, 31, 70),
(2171, 31, 89),
(2169, 31, 72),
(2168, 31, 83),
(2167, 31, 21),
(2166, 31, 125),
(2165, 31, 107),
(2164, 31, 93),
(2163, 31, 86),
(2161, 31, 77),
(2160, 31, 74),
(2159, 31, 123),
(2158, 31, 106),
(2157, 31, 85),
(2156, 31, 76),
(652, 66, 11),
(654, 66, 83),
(655, 66, 73),
(656, 66, 76),
(657, 66, 88),
(658, 66, 74),
(659, 66, 77),
(661, 66, 84),
(662, 66, 86),
(663, 66, 21),
(664, 66, 72),
(665, 66, 89),
(666, 66, 70),
(667, 66, 92),
(669, 66, 7),
(670, 66, 8),
(671, 66, 90),
(672, 66, 91),
(681, 65, 11),
(683, 65, 83),
(684, 65, 73),
(685, 65, 76),
(686, 65, 88),
(687, 65, 74),
(688, 65, 77),
(690, 65, 84),
(691, 65, 86),
(692, 65, 21),
(693, 65, 72),
(694, 65, 89),
(695, 65, 70),
(696, 65, 92),
(698, 65, 7),
(699, 65, 8),
(700, 65, 90),
(701, 65, 91),
(710, 64, 11),
(712, 64, 83),
(713, 64, 73),
(714, 64, 76),
(715, 64, 88),
(716, 64, 74),
(717, 64, 77),
(719, 64, 84),
(720, 64, 86),
(721, 64, 21),
(722, 64, 72),
(723, 64, 89),
(724, 64, 70),
(725, 64, 92),
(727, 64, 7),
(728, 64, 8),
(729, 64, 90),
(730, 64, 91),
(1485, 63, 107),
(1484, 63, 84),
(1482, 63, 77),
(1481, 63, 74),
(1479, 63, 76),
(1478, 63, 73),
(1477, 63, 11),
(1476, 63, 106),
(1475, 63, 80),
(1474, 63, 75),
(1473, 63, 71),
(1508, 62, 107),
(1507, 62, 84),
(1505, 62, 77),
(1504, 62, 74),
(1502, 62, 76),
(1501, 62, 73),
(1500, 62, 11),
(1499, 62, 106),
(1498, 62, 80),
(1497, 62, 75),
(1496, 62, 71),
(784, 61, 84),
(785, 61, 72),
(786, 61, 89),
(787, 61, 70),
(788, 61, 92),
(790, 61, 7),
(2236, 60, 70),
(2235, 60, 89),
(2234, 60, 72),
(2233, 60, 107),
(2232, 60, 93),
(2230, 60, 77),
(2229, 60, 74),
(2228, 60, 123),
(2227, 60, 106),
(2226, 60, 85),
(2225, 60, 76),
(818, 59, 11),
(819, 59, 73),
(820, 59, 76),
(821, 59, 74),
(822, 59, 77),
(824, 59, 84),
(825, 59, 72),
(826, 59, 89),
(827, 59, 70),
(828, 59, 92),
(830, 59, 7),
(838, 58, 11),
(839, 58, 73),
(840, 58, 76),
(841, 58, 74),
(842, 58, 77),
(844, 58, 84),
(845, 58, 72),
(846, 58, 89),
(847, 58, 70),
(848, 58, 92),
(850, 58, 7),
(858, 57, 11),
(859, 57, 73),
(860, 57, 76),
(861, 57, 74),
(862, 57, 77),
(864, 57, 84),
(865, 57, 72),
(866, 57, 89),
(867, 57, 70),
(868, 57, 92),
(870, 57, 7),
(875, 56, 71),
(876, 56, 75),
(878, 56, 11),
(879, 56, 73),
(880, 56, 76),
(881, 56, 74),
(882, 56, 77),
(884, 56, 84),
(885, 56, 72),
(886, 56, 89),
(887, 56, 70),
(888, 56, 92),
(890, 56, 7),
(919, 55, 73),
(918, 55, 11),
(914, 55, 93),
(913, 55, 85),
(905, 54, 11),
(906, 54, 73),
(907, 54, 74),
(909, 54, 84),
(910, 54, 72),
(911, 54, 89),
(912, 54, 92),
(922, 55, 84),
(923, 55, 72),
(924, 55, 89),
(925, 55, 92),
(930, 53, 11),
(931, 53, 73),
(932, 53, 74),
(934, 53, 84),
(935, 53, 72),
(936, 53, 89),
(937, 53, 92),
(939, 52, 93),
(941, 52, 11),
(942, 52, 73),
(943, 52, 74),
(945, 52, 72),
(946, 52, 89),
(947, 52, 92),
(949, 51, 93),
(951, 51, 11),
(952, 51, 73),
(953, 51, 74),
(955, 51, 72),
(956, 51, 89),
(957, 51, 92),
(959, 50, 93),
(961, 50, 11),
(962, 50, 73),
(963, 50, 74),
(965, 50, 72),
(966, 50, 89),
(967, 50, 92),
(969, 49, 93),
(971, 49, 11),
(972, 49, 73),
(973, 49, 74),
(975, 49, 72),
(976, 49, 89),
(977, 49, 92),
(979, 48, 93),
(981, 48, 11),
(982, 48, 73),
(983, 48, 74),
(985, 48, 72),
(986, 48, 89),
(987, 48, 92),
(989, 47, 93),
(991, 47, 11),
(992, 47, 73),
(993, 47, 74),
(995, 47, 72),
(996, 47, 89),
(997, 47, 92),
(999, 46, 93),
(1001, 46, 11),
(1002, 46, 73),
(1003, 46, 74),
(1005, 46, 72),
(1006, 46, 89),
(1007, 46, 92),
(1284, 45, 74),
(1282, 45, 73),
(1281, 45, 11),
(1279, 45, 80),
(1278, 45, 93),
(1271, 44, 74),
(1269, 44, 73),
(1268, 44, 11),
(1266, 44, 80),
(1265, 44, 93),
(1525, 43, 72),
(1524, 43, 107),
(1522, 43, 74),
(1048, 50, 80),
(1049, 49, 80),
(1839, 1, 135),
(2088, 42, 93),
(1520, 43, 73),
(1264, 44, 85),
(1277, 45, 85),
(1055, 46, 80),
(1056, 47, 80),
(1057, 48, 80),
(2155, 31, 73),
(1059, 51, 80),
(1060, 52, 80),
(1061, 53, 80),
(1062, 54, 80),
(1063, 55, 80),
(1064, 56, 80),
(1065, 57, 80),
(1066, 58, 80),
(1067, 59, 80),
(2224, 60, 73),
(1069, 61, 80),
(1072, 64, 80),
(1073, 65, 80),
(1074, 66, 80),
(1076, 1, 80),
(2676, 41, 114),
(2675, 41, 62),
(2674, 41, 61),
(2673, 41, 12),
(2672, 41, 64),
(2671, 41, 63),
(2670, 41, 66),
(2669, 41, 65),
(2668, 41, 60),
(2667, 41, 33),
(2666, 41, 32),
(2665, 41, 91),
(2664, 41, 31),
(2663, 41, 25),
(1106, 1, 96),
(1107, 1, 97),
(1138, 1, 99),
(1139, 1, 100),
(1140, 1, 101),
(1141, 1, 102),
(1143, 1, 104),
(1519, 43, 11),
(1518, 43, 106),
(2662, 41, 98),
(2661, 41, 52),
(2660, 41, 110),
(2659, 41, 109),
(2658, 41, 141),
(2657, 41, 108),
(2656, 41, 90),
(2655, 41, 171),
(2087, 42, 86),
(2085, 42, 77),
(2084, 42, 74),
(2083, 42, 123),
(2082, 42, 106),
(2081, 42, 100),
(2080, 42, 85),
(1274, 44, 72),
(1275, 44, 89),
(1276, 44, 92),
(1287, 45, 72),
(1288, 45, 89),
(1289, 45, 92),
(1290, 50, 106),
(1291, 49, 106),
(2654, 41, 142),
(2079, 42, 76),
(1517, 43, 80),
(1295, 44, 106),
(1296, 45, 106),
(1297, 46, 106),
(1298, 47, 106),
(1299, 48, 106),
(1301, 51, 106),
(1302, 52, 106),
(1303, 53, 106),
(1304, 54, 106),
(1305, 55, 106),
(1306, 56, 106),
(1307, 57, 106),
(1308, 58, 106),
(1309, 59, 106),
(2223, 60, 11),
(1311, 61, 106),
(1314, 64, 106),
(1315, 65, 106),
(1316, 66, 106),
(1319, 1, 106),
(1320, 50, 107),
(1321, 49, 107),
(2078, 42, 73),
(1516, 43, 93),
(1325, 44, 107),
(1326, 45, 107),
(1327, 46, 107),
(1328, 47, 107),
(1329, 48, 107),
(2153, 31, 11),
(1331, 51, 107),
(1332, 52, 107),
(1333, 53, 107),
(1334, 54, 107),
(1335, 55, 107),
(1336, 56, 107),
(1337, 57, 107),
(1338, 58, 107),
(1339, 59, 107),
(2222, 60, 105),
(1341, 61, 107),
(1493, 62, 93),
(1470, 63, 93),
(1344, 64, 107),
(1345, 65, 107),
(1346, 66, 107),
(1349, 1, 107),
(2653, 41, 18),
(1515, 43, 85),
(1492, 62, 85),
(1469, 63, 85),
(2652, 41, 175),
(2076, 42, 11),
(1603, 1, 103),
(1622, 50, 82),
(1623, 49, 82),
(2651, 41, 143),
(2075, 42, 10),
(1626, 43, 82),
(1627, 44, 82),
(1628, 45, 82),
(1629, 46, 82),
(1630, 47, 82),
(1631, 48, 82),
(2152, 31, 10),
(1633, 51, 82),
(1634, 52, 82),
(1635, 53, 82),
(1636, 54, 82),
(1637, 55, 82),
(1638, 56, 82),
(1639, 57, 82),
(1640, 58, 82),
(1641, 59, 82),
(2221, 60, 80),
(1643, 61, 82),
(1644, 62, 82),
(1645, 63, 82),
(1646, 64, 82),
(1647, 65, 82),
(1648, 66, 82),
(1649, 1, 82),
(1651, 50, 105),
(1652, 49, 105),
(2650, 41, 17),
(2074, 42, 105),
(1655, 43, 105),
(1656, 44, 105),
(1657, 45, 105),
(1658, 46, 105),
(1659, 47, 105),
(1660, 48, 105),
(2151, 31, 105),
(1662, 51, 105),
(1663, 52, 105),
(1664, 53, 105),
(1665, 54, 105),
(1666, 55, 105),
(1667, 56, 105),
(1668, 57, 105),
(1669, 58, 105),
(1670, 59, 105),
(2220, 60, 75),
(1672, 61, 105),
(1673, 62, 105),
(1674, 63, 105),
(1675, 64, 105),
(1676, 65, 105),
(1677, 66, 105),
(1679, 1, 105),
(1682, 50, 123),
(1683, 49, 123),
(2073, 42, 99),
(1686, 43, 123),
(1687, 44, 123),
(1688, 45, 123),
(1689, 46, 123),
(1690, 47, 123),
(1691, 48, 123),
(2150, 31, 80),
(1693, 51, 123),
(1694, 52, 123),
(1695, 53, 123),
(1696, 54, 123),
(1697, 55, 123),
(1698, 56, 123),
(1699, 57, 123),
(1700, 58, 123),
(1701, 59, 123),
(2219, 60, 71),
(1703, 61, 123),
(1704, 62, 123),
(1705, 63, 123),
(1706, 64, 123),
(1707, 65, 123),
(1708, 66, 123),
(1711, 1, 123),
(2649, 41, 8),
(1715, 1, 1),
(2648, 41, 111),
(2647, 41, 92),
(2646, 41, 51),
(2645, 41, 7),
(2644, 41, 70),
(2643, 41, 15),
(2642, 41, 192),
(2641, 41, 102),
(2640, 41, 89),
(2639, 41, 84),
(2638, 41, 14),
(2637, 41, 104),
(2636, 41, 88),
(2635, 41, 83),
(2634, 41, 21),
(2633, 41, 19),
(2632, 41, 189),
(2631, 41, 103),
(2630, 41, 93),
(2629, 41, 86),
(2628, 41, 77),
(2627, 41, 72),
(2626, 41, 23),
(2625, 41, 188),
(2624, 41, 125),
(2623, 41, 107),
(2622, 41, 101),
(2621, 41, 85),
(2620, 41, 76),
(2072, 42, 80),
(2149, 31, 75),
(1821, 64, 125),
(1822, 65, 125),
(1823, 66, 125),
(1824, 1, 125),
(1829, 1, 121),
(1831, 1, 9),
(2619, 41, 74),
(2148, 31, 71),
(1835, 64, 10),
(1836, 65, 10),
(1837, 66, 10),
(1838, 1, 10),
(2618, 41, 54),
(2617, 41, 22),
(2616, 41, 11),
(2615, 41, 10),
(2614, 41, 5),
(2071, 42, 75),
(2070, 42, 71),
(2613, 41, 187),
(2069, 42, 82),
(2147, 31, 82),
(1964, 64, 5),
(1965, 65, 5),
(1966, 66, 5),
(1967, 1, 5),
(2612, 41, 123),
(2068, 42, 5),
(2146, 31, 5),
(2218, 60, 82),
(2611, 41, 113),
(2610, 41, 106),
(2063, 1, 55),
(2609, 41, 100),
(2065, 1, 56),
(2608, 41, 80),
(2067, 1, 54),
(2244, 50, 175),
(2245, 49, 175),
(2607, 41, 73),
(2247, 42, 175),
(2248, 43, 175),
(2249, 44, 175),
(2250, 45, 175),
(2251, 46, 175),
(2252, 47, 175),
(2253, 48, 175),
(2254, 31, 175),
(2255, 51, 175),
(2256, 52, 175),
(2257, 53, 175),
(2258, 54, 175),
(2259, 55, 175),
(2260, 56, 175),
(2261, 57, 175),
(2262, 58, 175),
(2263, 59, 175),
(2264, 60, 175),
(2265, 61, 175),
(2266, 62, 175),
(2267, 63, 175),
(2268, 64, 175),
(2269, 65, 175),
(2270, 66, 175),
(2272, 1, 175),
(2273, 50, 176),
(2274, 49, 176),
(2606, 41, 82),
(2276, 42, 176),
(2277, 43, 176),
(2278, 44, 176),
(2279, 45, 176),
(2280, 46, 176),
(2281, 47, 176),
(2282, 48, 176),
(2283, 31, 176),
(2284, 51, 176),
(2285, 52, 176),
(2286, 53, 176),
(2287, 54, 176),
(2288, 55, 176),
(2289, 56, 176),
(2290, 57, 176),
(2291, 58, 176),
(2292, 59, 176),
(2293, 60, 176),
(2294, 61, 176),
(2295, 62, 176),
(2296, 63, 176),
(2297, 64, 176),
(2298, 65, 176),
(2299, 66, 176),
(2301, 1, 176),
(2302, 50, 113),
(2303, 49, 113),
(2605, 41, 56),
(2305, 42, 113),
(2306, 43, 113),
(2307, 44, 113),
(2308, 45, 113),
(2309, 46, 113),
(2310, 47, 113),
(2311, 48, 113),
(2312, 31, 113),
(2313, 51, 113),
(2314, 52, 113),
(2315, 53, 113),
(2316, 54, 113),
(2317, 55, 113),
(2318, 56, 113),
(2319, 57, 113),
(2320, 58, 113),
(2321, 59, 113),
(2322, 60, 113),
(2323, 61, 113),
(2324, 62, 113),
(2325, 63, 113),
(2326, 64, 113),
(2327, 65, 113),
(2328, 66, 113),
(2329, 1, 113),
(2604, 41, 9),
(2346, 42, 20),
(2347, 31, 20),
(2348, 64, 20),
(2349, 65, 20),
(2350, 66, 20),
(2351, 1, 20),
(2603, 41, 6),
(2353, 42, 171),
(2354, 1, 171),
(2602, 41, 2),
(2356, 42, 6),
(2357, 31, 6),
(2358, 56, 6),
(2359, 57, 6),
(2360, 58, 6),
(2361, 59, 6),
(2362, 60, 6),
(2363, 61, 6),
(2364, 62, 6),
(2365, 63, 6),
(2366, 64, 6),
(2367, 65, 6),
(2368, 66, 6),
(2369, 1, 6),
(2601, 41, 190),
(2371, 42, 87),
(2372, 31, 87),
(2373, 64, 87),
(2374, 65, 87),
(2375, 66, 87),
(2376, 1, 87),
(2377, 50, 78),
(2378, 49, 78),
(2600, 41, 176),
(2380, 42, 78),
(2381, 43, 78),
(2382, 44, 78),
(2383, 45, 78),
(2384, 46, 78),
(2385, 47, 78),
(2386, 48, 78),
(2387, 31, 78),
(2388, 51, 78),
(2389, 52, 78),
(2390, 53, 78),
(2391, 54, 78),
(2392, 55, 78),
(2393, 56, 78),
(2394, 57, 78),
(2395, 58, 78),
(2396, 59, 78),
(2397, 60, 78),
(2398, 61, 78),
(2399, 62, 78),
(2400, 63, 78),
(2401, 64, 78),
(2402, 65, 78),
(2403, 66, 78),
(2404, 1, 78),
(2406, 50, 187),
(2407, 49, 187),
(2409, 42, 187),
(2410, 43, 187),
(2411, 44, 187),
(2412, 45, 187),
(2413, 46, 187),
(2414, 47, 187),
(2415, 48, 187),
(2416, 31, 187),
(2417, 51, 187),
(2418, 52, 187),
(2419, 53, 187),
(2420, 54, 187),
(2421, 55, 187),
(2422, 56, 187),
(2423, 57, 187),
(2424, 58, 187),
(2425, 59, 187),
(2426, 60, 187),
(2427, 61, 187),
(2428, 62, 187),
(2429, 63, 187),
(2430, 64, 187),
(2431, 65, 187),
(2432, 66, 187),
(2433, 1, 187),
(2599, 41, 144),
(2598, 41, 105),
(2597, 41, 99),
(2596, 41, 87),
(2595, 41, 78),
(2594, 41, 75),
(2524, 1, 190),
(2593, 41, 71),
(2526, 1, 192),
(2527, 50, 188),
(2528, 49, 188),
(2592, 41, 55),
(2530, 42, 188),
(2531, 43, 188),
(2532, 44, 188),
(2533, 45, 188),
(2534, 46, 188),
(2535, 47, 188),
(2536, 48, 188),
(2537, 31, 188),
(2538, 51, 188),
(2539, 52, 188),
(2540, 53, 188),
(2541, 54, 188),
(2542, 55, 188),
(2543, 56, 188),
(2544, 57, 188),
(2545, 58, 188),
(2546, 59, 188),
(2547, 60, 188),
(2548, 61, 188),
(2549, 62, 188),
(2550, 63, 188),
(2551, 64, 188),
(2552, 65, 188),
(2553, 66, 188),
(2554, 1, 188),
(2555, 50, 189),
(2556, 49, 189),
(2591, 41, 20),
(2558, 42, 189),
(2559, 43, 189),
(2560, 44, 189),
(2561, 45, 189),
(2562, 46, 189),
(2563, 47, 189),
(2564, 48, 189),
(2565, 31, 189),
(2566, 51, 189),
(2567, 52, 189),
(2568, 53, 189),
(2569, 54, 189),
(2570, 55, 189),
(2571, 56, 189),
(2572, 57, 189),
(2573, 58, 189),
(2574, 59, 189),
(2575, 60, 189),
(2576, 61, 189),
(2577, 62, 189),
(2578, 63, 189),
(2579, 64, 189),
(2580, 65, 189),
(2581, 66, 189),
(2582, 1, 189),
(2590, 41, 1),
(2584, 42, 98),
(2585, 31, 98),
(2586, 64, 98),
(2587, 65, 98),
(2588, 66, 98),
(2589, 1, 98);

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `social_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `icon` text COLLATE utf8_unicode_ci NOT NULL,
  `iconwidth` int(11) NOT NULL,
  `iconheight` int(11) NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `tooltip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`social_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`social_id`, `name`, `icon`, `iconwidth`, `iconheight`, `url`, `tooltip`, `ordernum`) VALUES
(1, 'Facebook', 'images/socialmedia/facebook.png', 24, 24, '', 'Entire entire Facebook URL.', 5),
(2, 'Twitter', 'images/socialmedia/twitter.png', 24, 24, 'http://www.twitter.com/', 'Enter your Twitter username.', 4),
(3, 'Youtube', 'images/socialmedia/youtube.png', 24, 24, 'http://youtube.com/', 'Enter your Youtube username.', 3),
(4, 'Google Plus', 'images/socialmedia/googleplus.png', 24, 24, '', 'Enter entire Google Plus URL.', 2),
(5, 'Twitch', 'images/socialmedia/twitch.png', 24, 24, 'http://twitch.tv/', 'Enter your Twitch username.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `social_members`
--

CREATE TABLE IF NOT EXISTS `social_members` (
  `socialmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `social_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`socialmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `social_members`
--

INSERT INTO `social_members` (`socialmember_id`, `social_id`, `member_id`, `value`) VALUES
(1, 1, 13, 'http://www.fa1cebook.com/bluethrust'),
(2, 2, 13, 'bluethrust'),
(11, 5, 13, 'bluethrustTV'),
(10, 4, 13, '5'),
(9, 3, 13, 'bluethrustweb'),
(12, 1, 65, ''),
(13, 2, 65, ''),
(14, 3, 65, ''),
(15, 4, 65, ''),
(16, 5, 65, '');

-- --------------------------------------------------------

--
-- Table structure for table `squadapps`
--

CREATE TABLE IF NOT EXISTS `squadapps` (
  `squadapp_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `squad_id` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `applydate` int(11) NOT NULL,
  `dateaction` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `squadmember_id` int(11) NOT NULL,
  PRIMARY KEY (`squadapp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `squadinvites`
--

CREATE TABLE IF NOT EXISTS `squadinvites` (
  `squadinvite_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `datesent` int(11) NOT NULL,
  `dateaction` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `message` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `startingrank_id` int(11) NOT NULL,
  PRIMARY KEY (`squadinvite_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `squadinvites`
--

INSERT INTO `squadinvites` (`squadinvite_id`, `squad_id`, `sender_id`, `receiver_id`, `datesent`, `dateaction`, `status`, `message`, `startingrank_id`) VALUES
(1, 1, 13, 42, 1367115505, 1367115754, 1, '', 2),
(2, 1, 13, 50, 1367115518, 1367115770, 1, '', 2),
(3, 1, 13, 48, 1367115530, 1367115681, 1, '', 2),
(4, 1, 13, 43, 1367116003, 1367116035, 1, '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `squadnews`
--

CREATE TABLE IF NOT EXISTS `squadnews` (
  `squadnews_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `newstype` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `postsubject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newspost` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `lasteditmember_id` int(11) NOT NULL,
  `lasteditdate` int(11) NOT NULL,
  PRIMARY KEY (`squadnews_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `squadnews`
--

INSERT INTO `squadnews` (`squadnews_id`, `squad_id`, `member_id`, `newstype`, `dateposted`, `postsubject`, `newspost`, `lasteditmember_id`, `lasteditdate`) VALUES
(1, 1, 13, 1, 1364007215, 'test post', 'asdfasdf', 0, 0),
(2, 1, 13, 1, 1364007731, 'ahha', 'test\r\n\r\n\r\nasdf\r\n\r\nasdfasdf', 0, 0),
(3, 1, 13, 1, 1364007747, 'asdf', 'asdfasdf', 0, 0),
(5, 1, 13, 3, 1382840229, '', 'test', 0, 0),
(6, 1, 13, 3, 1382840234, '', 'hello', 0, 0),
(7, 1, 13, 3, 1382840273, '', 'whats up', 0, 0),
(8, 1, 13, 3, 1382840926, '', 'hi', 0, 0),
(9, 1, 13, 3, 1382840939, '', 'whats up', 0, 0),
(10, 1, 13, 3, 1390149451, '', 'hello', 0, 0),
(11, 1, 13, 3, 1390149535, '', 'whats up', 0, 0),
(12, 2, 13, 3, 1395295389, '', 'test', 0, 0),
(13, 2, 13, 3, 1399021880, '', 'test', 0, 0),
(14, 2, 13, 3, 1399021884, '', 'lol', 0, 0),
(15, 2, 13, 3, 1399021888, '', 'whats up\n', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `squadranks`
--

CREATE TABLE IF NOT EXISTS `squadranks` (
  `squadrank_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `squadranks`
--

INSERT INTO `squadranks` (`squadrank_id`, `squad_id`, `name`, `sortnum`, `postnews`, `managenews`, `postshoutbox`, `manageshoutbox`, `addrank`, `manageranks`, `editprofile`, `sendinvites`, `acceptapps`, `setrank`, `removemember`) VALUES
(1, 1, 'Founder', 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 'Member', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 2, 'Founder', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(4, 1, 'New Founder', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(5, 3, 'Founder', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `squads`
--

CREATE TABLE IF NOT EXISTS `squads` (
  `squad_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `logourl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `recruitingstatus` int(11) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `privateshoutbox` int(11) NOT NULL,
  `website` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`squad_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `squads`
--

INSERT INTO `squads` (`squad_id`, `member_id`, `name`, `description`, `logourl`, `recruitingstatus`, `datecreated`, `privateshoutbox`, `website`) VALUES
(1, 48, 'Test Squad', 'blah\r\n\r\n\r\nasdf\r\n\r\nasdf', '/cs4git/images/squads/squad_514d1764b3bec.gif', 1, 1363924075, 1, ''),
(2, 13, 'Test Squad2', '', 'asdf', 1, 1367177255, 1, ''),
(3, 42, 'test squad no admin', '', '', 1, 1401667405, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `squads_members`
--

CREATE TABLE IF NOT EXISTS `squads_members` (
  `squadmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `squadrank_id` int(11) NOT NULL,
  `datejoined` int(11) NOT NULL,
  `lastpromotion` int(11) NOT NULL,
  `lastdemotion` int(11) NOT NULL,
  PRIMARY KEY (`squadmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `squads_members`
--

INSERT INTO `squads_members` (`squadmember_id`, `squad_id`, `member_id`, `squadrank_id`, `datejoined`, `lastpromotion`, `lastdemotion`) VALUES
(1, 1, 13, 1, 1363924075, 0, 0),
(2, 1, 48, 4, 1367115681, 1390416072, 0),
(3, 1, 42, 2, 1367115754, 0, 0),
(4, 1, 50, 2, 1367115770, 0, 0),
(5, 1, 43, 2, 1367116035, 0, 0),
(6, 2, 13, 3, 1367177255, 0, 0),
(7, 3, 42, 5, 1401667405, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tableupdates`
--

CREATE TABLE IF NOT EXISTS `tableupdates` (
  `tableupdate_id` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updatetime` int(11) NOT NULL,
  PRIMARY KEY (`tableupdate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Dumping data for table `tableupdates`
--

INSERT INTO `tableupdates` (`tableupdate_id`, `tablename`, `updatetime`) VALUES
(1, 'menu_item', 1401938698),
(2, 'websiteinfo', 1401055474),
(3, 'members', 1401933418),
(4, 'hitcounter', 1402682240),
(5, 'news', 1401850540),
(6, 'forum_topic', 1401825658),
(7, 'forum_post', 1401825656),
(8, 'menu_category', 1401941381),
(9, 'menuitem_link', 1401055376),
(10, 'menuitem_custompage', 1399316861),
(11, 'menuitem_customblock', 1401386858),
(12, 'menuitem_shoutbox', 1399185901),
(13, 'privatemessages', 1400709285),
(14, 'privatemessage_members', 1400524062),
(15, 'logs', 1401933501),
(16, 'menuitem_image', 1401938698),
(17, 'medals_members', 1400709315),
(18, 'notifications', 1401826332),
(19, 'freezemedals_members', 1396815345),
(20, 'ranks', 1396297389),
(21, 'rank_privileges', 1396297390),
(22, 'custompages', 1375155191),
(23, 'rankcategory', 1399021190),
(24, 'forum_board', 1400214045),
(25, 'membersonlypage', 1374853043),
(26, 'events', 1401678926),
(27, 'eventmessages', 1399022225),
(28, 'eventmessage_comment', 1399022418),
(29, 'console', 1399189413),
(30, 'failban', 1389989824),
(31, 'console_members', 1391460160),
(32, 'profileoptions_values', 1401933454),
(33, 'gamesplayed_members', 1401933454),
(34, 'downloadcategory', 1402681695),
(35, 'download_extensions', 1399316816),
(36, 'imageslider', 1402172248),
(37, 'downloads', 1401932185),
(38, 'forum_attachments', 1401776368),
(39, 'app_components', 1395014742),
(40, 'gamesplayed', 1401932314),
(41, 'gamestats', 1394244918),
(42, 'memberapps', 1401826330),
(43, 'squadnews', 1399021888),
(44, 'customform', 1386126282),
(45, 'customform_components', 1386126282),
(46, 'customform_selectvalues', 1386126282),
(47, 'customform_submission', 1386126301),
(48, 'customform_values', 1386126301),
(49, 'consolecategory', 1395548114),
(50, 'tournaments', 1400554452),
(51, 'tournamentteams', 1400552791),
(52, 'tournamentmatch', 1400552791),
(53, 'plugins', 1399189390),
(54, 'plugin_pages', 1399188720),
(55, 'forum_rankaccess', 1390280052),
(56, 'diplomacy_request', 1388099880),
(57, 'forum_memberaccess', 1390279959),
(58, 'app_captcha', 1401826304),
(59, 'iarequest', 1396742352),
(60, 'iarequest_messages', 1396743456),
(61, 'medals', 1402189024),
(62, 'tournamentplayers', 1393538930),
(63, 'gamestats_members', 1396746366),
(64, 'ipban', 1393306263),
(65, 'forum_category', 1390327613),
(66, 'squadranks', 1401667405),
(67, 'squads_members', 1401667405),
(68, 'privatemessage_folders', 1392016747),
(69, 'tournament_managers', 1395023320),
(70, 'forum_moderator', 1393534312),
(71, 'polls', 1395859418),
(72, 'poll_options', 1395859418),
(73, 'poll_memberaccess', 1394919227),
(74, 'poll_rankaccess', 1394919227),
(75, 'poll_votes', 1395859432),
(76, 'social_members', 1401933454),
(77, 'squads', 1401667405),
(78, 'comments', 1401831979),
(79, 'social', 1402211245),
(80, 'donations_campaign', 1402558532);

-- --------------------------------------------------------

--
-- Table structure for table `tournamentmatch`
--

CREATE TABLE IF NOT EXISTS `tournamentmatch` (
  `tournamentmatch_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `round` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `team1score` int(11) NOT NULL,
  `team2score` int(11) NOT NULL,
  `outcome` int(11) NOT NULL,
  `replayteam1url` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `replayteam2url` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `adminreplayurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `team1approve` int(11) NOT NULL,
  `team2approve` int(11) NOT NULL,
  `nextmatch_id` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`tournamentmatch_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tournamentmatch`
--

INSERT INTO `tournamentmatch` (`tournamentmatch_id`, `tournament_id`, `round`, `team1_id`, `team2_id`, `team1score`, `team2score`, `outcome`, `replayteam1url`, `replayteam2url`, `adminreplayurl`, `team1approve`, `team2approve`, `nextmatch_id`, `sortnum`) VALUES
(1, 1, 2, 1, 3, 1, 0, 1, '', '', '', 0, 0, 0, 0),
(2, 1, 1, 1, 4, 0, 0, 1, '', '', '/cs4git/downloads/replays/replay_517431c5d429b.zip', 0, 0, 1, 0),
(3, 1, 1, 2, 3, 3, 1, 2, '/cs4git/downloads/replays/replay_51743217d80b8.zip', '/cs4git/downloads/replays/replay_51743217d80b8.zip', '', 1, 1, 1, 0),
(4, 3, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(5, 3, 1, 13, 16, 0, 0, 0, '', '', '', 0, 0, 4, 0),
(6, 3, 1, 14, 15, 0, 0, 0, '', '', '', 0, 0, 4, 0),
(7, 5, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(8, 5, 1, 21, 24, 0, 0, 0, '', '', '', 0, 0, 7, 0),
(9, 5, 1, 22, 23, 0, 0, 0, '', '', '', 0, 0, 7, 0),
(10, 6, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(11, 6, 1, 27, 28, 0, 0, 0, '', '', '', 0, 0, 10, 0),
(12, 6, 1, 25, 26, 0, 0, 0, '', '', '', 0, 0, 10, 0),
(13, 7, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(14, 7, 1, 29, 32, 0, 0, 0, '', '', '', 0, 0, 13, 0),
(15, 7, 1, 30, 31, 0, 0, 0, '', '', '', 0, 0, 13, 0),
(16, 8, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(17, 8, 1, 33, 36, 0, 0, 0, '', '', '', 0, 0, 16, 0),
(18, 8, 1, 34, 35, 0, 0, 0, '', '', '', 0, 0, 16, 0),
(19, 9, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(20, 9, 1, 37, 0, 0, 0, 0, '', '', '', 0, 0, 19, 0),
(21, 9, 1, 38, 39, 0, 0, 0, '', '', '', 0, 0, 19, 0),
(22, 10, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(23, 10, 1, 41, 44, 0, 0, 0, '', '', '', 0, 0, 22, 0),
(24, 10, 1, 42, 43, 0, 0, 0, '', '', '', 0, 0, 22, 0),
(25, 11, 2, 0, 0, 0, 0, 0, '', '', '', 0, 0, 0, 0),
(26, 11, 1, 45, 48, 0, 0, 0, '', '', '', 0, 0, 25, 0),
(27, 11, 1, 46, 47, 0, 0, 0, '', '', '', 0, 0, 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tournamentplayers`
--

CREATE TABLE IF NOT EXISTS `tournamentplayers` (
  `tournamentplayer_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `displayname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tournamentplayer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Dumping data for table `tournamentplayers`
--

INSERT INTO `tournamentplayers` (`tournamentplayer_id`, `tournament_id`, `team_id`, `member_id`, `displayname`) VALUES
(1, 1, 1, 48, ''),
(2, 2, 5, 48, ''),
(3, 2, 6, 43, ''),
(42, 3, 13, 48, ''),
(5, 2, 8, 42, ''),
(6, 2, 9, 47, ''),
(7, 2, 10, 44, ''),
(8, 2, 11, 45, ''),
(9, 2, 12, 50, ''),
(14, 2, 7, 13, ''),
(11, 1, 3, 43, ''),
(12, 1, 4, 50, ''),
(41, 3, 13, 42, ''),
(40, 3, 13, 50, ''),
(48, 5, 21, 48, ''),
(47, 5, 21, 13, ''),
(49, 6, 25, 0, 'sadf'),
(50, 1, 2, 63, ''),
(56, 3, 0, 63, ''),
(57, 6, 26, 0, 'test'),
(58, 8, 33, 48, ''),
(59, 8, 33, 43, ''),
(60, 8, 33, 42, ''),
(61, 8, 33, 50, '');

-- --------------------------------------------------------

--
-- Table structure for table `tournamentpools`
--

CREATE TABLE IF NOT EXISTS `tournamentpools` (
  `tournamentpool_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `finished` int(11) NOT NULL,
  PRIMARY KEY (`tournamentpool_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tournamentpools`
--

INSERT INTO `tournamentpools` (`tournamentpool_id`, `tournament_id`, `finished`) VALUES
(1, 2, 0),
(2, 2, 0),
(3, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tournamentpools_teams`
--

CREATE TABLE IF NOT EXISTS `tournamentpools_teams` (
  `poolteam_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `pool_id` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `team1score` int(11) NOT NULL,
  `team2score` int(11) NOT NULL,
  `team1approve` int(1) NOT NULL,
  `team2approve` int(1) NOT NULL,
  `replayteam1url` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `replayteam2url` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `winner` int(11) NOT NULL,
  PRIMARY KEY (`poolteam_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tournamentpools_teams`
--

INSERT INTO `tournamentpools_teams` (`poolteam_id`, `tournament_id`, `pool_id`, `team1_id`, `team2_id`, `team1score`, `team2score`, `team1approve`, `team2approve`, `replayteam1url`, `replayteam2url`, `winner`) VALUES
(1, 2, 1, 11, 10, 0, 0, 0, 0, '', '', 2),
(2, 2, 1, 11, 12, 0, 0, 0, 0, '', '', 0),
(3, 2, 1, 11, 9, 0, 0, 0, 0, '', '', 0),
(4, 2, 1, 10, 12, 0, 0, 0, 0, '', '', 0),
(5, 2, 1, 10, 9, 0, 0, 0, 0, '', '', 0),
(6, 2, 1, 12, 9, 0, 0, 0, 0, '', '', 0),
(7, 2, 2, 8, 5, 0, 0, 0, 0, '', '', 0),
(8, 2, 2, 8, 6, 0, 0, 0, 0, '', '', 0),
(9, 2, 2, 8, 7, 0, 0, 0, 1, '', '', 2),
(10, 2, 2, 5, 6, 0, 0, 0, 0, '', '', 0),
(11, 2, 2, 5, 7, 0, 0, 0, 1, '', '', 2),
(12, 2, 2, 6, 7, 0, 0, 0, 0, '', '', 0),
(13, 4, 3, 18, 19, 0, 0, 0, 0, '', '', 0),
(14, 4, 3, 18, 20, 0, 0, 0, 0, '', '', 0),
(15, 4, 3, 18, 17, 0, 0, 0, 0, '', '', 0),
(16, 4, 3, 19, 20, 0, 0, 0, 0, '', '', 0),
(17, 4, 3, 19, 17, 0, 0, 0, 0, '', '', 0),
(18, 4, 3, 20, 17, 0, 0, 0, 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE IF NOT EXISTS `tournaments` (
  `tournament_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `gamesplayed_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seedtype` int(11) NOT NULL,
  `startdate` int(11) NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eliminations` int(11) NOT NULL,
  `playersperteam` int(11) NOT NULL,
  `maxteams` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `description` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `requirereplay` int(10) NOT NULL,
  `access` int(11) NOT NULL,
  PRIMARY KEY (`tournament_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`tournament_id`, `member_id`, `gamesplayed_id`, `name`, `seedtype`, `startdate`, `timezone`, `eliminations`, `playersperteam`, `maxteams`, `status`, `description`, `password`, `requirereplay`, `access`) VALUES
(1, 13, 2, 'Test Tournament', 1, 1366171200, '', 1, 1, 4, 0, '', '', 0, 1),
(2, 13, 2, 'TEst Pools', 3, 1366862400, '', 1, 1, 8, 0, '', '098f6bcd4621d373cade4e832627b4f6', 0, 1),
(3, 13, 2, 'Test Tournament Teams', 1, 1367294400, '', 1, 5, 4, 0, '', '', 0, 1),
(4, 13, 2, 'Test Poolsdsf', 3, 1367294400, '', 1, 1, 4, 0, '', 'd41d8cd98f00b204e9800998ecf8427e', 0, 1),
(5, 13, 2, 'test teams2', 1, 1369195200, '', 1, 2, 4, 0, '', 'd41d8cd98f00b204e9800998ecf8427e', 0, 1),
(6, 13, 12, 'test tournament', 2, 1387929600, '', 1, 1, 4, 0, '', 'd41d8cd98f00b204e9800998ecf8427e', 0, 3),
(7, 42, 12, 'My Tournament', 1, 1519171200, '', 1, 1, 4, 0, 'asdf', 'd41d8cd98f00b204e9800998ecf8427e', 0, 1),
(8, 48, 12, 'Tournament 2', 1, 1412035200, '', 1, 4, 4, 0, 'asdf', 'd41d8cd98f00b204e9800998ecf8427e', 0, 1),
(9, 13, 12, 'Test Timezones', 1, 1400630400, 'America/Mexico_City', 1, 1, 4, 0, 'test timezones', 'd41d8cd98f00b204e9800998ecf8427e', 0, 1),
(10, 13, 12, 'Test', 1, 1395878400, '', 1, 1, 4, 0, 'asdf', 'd41d8cd98f00b204e9800998ecf8427e', 0, 1),
(11, 13, 12, 'test times', 1, 1401527880, 'America/La_Paz', 1, 1, 4, 0, 'test', 'd41d8cd98f00b204e9800998ecf8427e', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tournamentteams`
--

CREATE TABLE IF NOT EXISTS `tournamentteams` (
  `tournamentteam_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `seed` int(11) NOT NULL,
  PRIMARY KEY (`tournamentteam_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=49 ;

--
-- Dumping data for table `tournamentteams`
--

INSERT INTO `tournamentteams` (`tournamentteam_id`, `tournament_id`, `name`, `seed`) VALUES
(1, 1, 'Team 1', 4),
(2, 1, 'Team 2', 2),
(3, 1, 'Team 3', 3),
(4, 1, 'Team 4', 1),
(5, 2, 'Team 1', 0),
(6, 2, 'Team 2', 0),
(7, 2, 'Team 3', 0),
(8, 2, 'Team 4', 0),
(9, 2, 'Team 5', 0),
(10, 2, 'Team 6', 0),
(11, 2, 'Team 7', 0),
(12, 2, 'Team 8', 0),
(13, 3, 'Test Squad', 1),
(14, 3, 'Team 2', 2),
(15, 3, 'Team 3', 3),
(16, 3, 'Team 4', 4),
(17, 4, 'Team 1', 0),
(18, 4, 'Team 2', 0),
(19, 4, 'Team 3', 0),
(20, 4, 'Team 4', 0),
(21, 5, 'Test Squad', 1),
(22, 5, 'Team 2', 2),
(23, 5, 'Team 3', 3),
(24, 5, 'Team 4', 4),
(25, 6, 'Team 1', 2),
(26, 6, 'Team 2', 3),
(27, 6, 'Team 3', 1),
(28, 6, 'Team 4', 4),
(29, 7, 'Team 1', 1),
(30, 7, 'Team 2', 2),
(31, 7, 'Team 3', 3),
(32, 7, 'Team 4', 4),
(33, 8, '', 1),
(34, 8, 'Team 2', 2),
(35, 8, 'Team 3', 3),
(36, 8, 'Team 4', 4),
(37, 9, 'Team 1', 1),
(38, 9, 'Team 2', 2),
(39, 9, 'Team 3', 3),
(40, 9, 'Team 4', 4),
(41, 10, 'Team 1', 1),
(42, 10, 'Team 2', 2),
(43, 10, 'Team 3', 3),
(44, 10, 'Team 4', 4),
(45, 11, 'Team 1', 1),
(46, 11, 'Team 2', 2),
(47, 11, 'Team 3', 3),
(48, 11, 'Team 4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_connect`
--

CREATE TABLE IF NOT EXISTS `tournament_connect` (
  `tournamentconnect_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `clanname` varchar(255) NOT NULL,
  `clanurl` text NOT NULL,
  `connected` int(11) NOT NULL,
  PRIMARY KEY (`tournamentconnect_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tournament_managers`
--

CREATE TABLE IF NOT EXISTS `tournament_managers` (
  `tournamentmanager_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`tournamentmanager_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tournament_managers`
--

INSERT INTO `tournament_managers` (`tournamentmanager_id`, `tournament_id`, `member_id`) VALUES
(7, 6, 63),
(8, 6, 42),
(10, 6, 46),
(11, 9, 48);

-- --------------------------------------------------------

--
-- Table structure for table `websiteinfo`
--

CREATE TABLE IF NOT EXISTS `websiteinfo` (
  `websiteinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`websiteinfo_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=63 ;

--
-- Dumping data for table `websiteinfo`
--

INSERT INTO `websiteinfo` (`websiteinfo_id`, `name`, `value`) VALUES
(1, 'clanname', 'Bluethrust Clan Website Manager: Clan Scripts v4'),
(2, 'clantag', '[bT]'),
(3, 'preventhack', '5555'),
(4, 'maxdsl', '0'),
(5, 'theme', 'lol'),
(6, 'lowdsl', '#00FF00'),
(7, 'meddsl', '#FFFF52'),
(8, 'highdsl', '#F75B5B'),
(9, 'logourl', 'images/logo.png'),
(10, 'forumurl', 'http://localhost/cs4git/forum'),
(11, 'failedlogins', '8'),
(12, 'maxdiplomacy', '10'),
(13, 'mostonline', '2'),
(14, 'mostonlinedate', '1362280462'),
(15, 'memberregistration', '0'),
(16, 'memberapproval', '1'),
(17, 'medalorder', '1'),
(18, 'newsticker', 'Welcome to the Site!'),
(19, 'newstickercolor', '#000000'),
(20, 'newstickersize', '14'),
(21, 'newstickerbold', '0'),
(22, 'newstickeritalic', '0'),
(23, 'debugmode', '0'),
(24, 'privateforum', '0'),
(25, 'privateprofile', '0'),
(26, 'updatemenu', '1399187245'),
(27, 'hpimagetype', 'slider'),
(28, 'hpimagewidth', '600'),
(29, 'hpimageheight', '400'),
(30, 'hpimagewidthunit', 'px'),
(31, 'hpimageheightunit', 'px'),
(32, 'forum_showmedal', '1'),
(33, 'forum_medalcount', '5'),
(34, 'forum_medalwidth', '50'),
(35, 'forum_medalheight', '13'),
(36, 'forum_medalwidthunit', 'px'),
(37, 'forum_medalheightunit', 'px'),
(38, 'forum_showrank', '1'),
(39, 'forum_rankwidth', '50'),
(40, 'forum_rankheight', '75'),
(41, 'forum_rankwidthunit', 'px'),
(42, 'forum_rankheightunit', 'px'),
(43, 'forum_postsperpage', '10'),
(44, 'forum_topicsperpage', ''),
(45, 'forum_imagewidth', '500'),
(46, 'forum_imageheight', '500'),
(47, 'forum_sigwidth', '500'),
(48, 'forum_sigheight', '150'),
(49, 'forum_imagewidthunit', 'px'),
(50, 'forum_imageheightunit', 'px'),
(51, 'forum_sigwidthunit', 'px'),
(52, 'forum_sigheightunit', 'px'),
(53, 'forum_linkimages', '1'),
(54, 'forum_hidesignatures', '0'),
(55, 'forum_avatarwidth', '50'),
(56, 'forum_avatarheight', '50'),
(57, 'forum_avatarwidthunit', 'px'),
(58, 'forum_avatarheightunit', 'px'),
(59, 'hideinactive', '0'),
(60, 'hpnews', '0'),
(61, 'sortnum', '0'),
(62, 'news_postsperpage', '10');

-- --------------------------------------------------------

--
-- Table structure for table `websiteinfo1`
--

CREATE TABLE IF NOT EXISTS `websiteinfo1` (
  `websiteinfo_id` int(11) NOT NULL AUTO_INCREMENT,
  `clanname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clantag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preventhack` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `maxdsl` int(11) NOT NULL,
  `theme` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lowdsl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meddsl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `highdsl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logourl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `forumurl` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `failedlogins` int(11) NOT NULL,
  `maxdiplomacy` int(11) NOT NULL,
  `mostonline` int(11) NOT NULL,
  `mostonlinedate` int(11) NOT NULL,
  `memberregistration` int(11) NOT NULL,
  `memberapproval` int(11) NOT NULL,
  `medalorder` int(11) NOT NULL,
  `newsticker` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `newstickercolor` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `newstickersize` int(11) NOT NULL,
  `newstickerbold` int(11) NOT NULL,
  `newstickeritalic` int(11) NOT NULL,
  `debugmode` int(11) NOT NULL,
  `privateforum` int(11) NOT NULL,
  `privateprofile` int(11) NOT NULL,
  `updatemenu` int(11) NOT NULL,
  `hpimagetype` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `hpimagewidth` int(11) NOT NULL,
  `hpimageheight` int(11) NOT NULL,
  `hpimagewidthunit` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `hpimageheightunit` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `forum_showmedal` int(11) NOT NULL,
  `forum_medalcount` int(11) NOT NULL,
  `forum_medalwidth` int(11) NOT NULL,
  `forum_medalheight` int(11) NOT NULL,
  `forum_medalwidthunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_medalheightunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_showrank` int(11) NOT NULL,
  `forum_rankwidth` int(11) NOT NULL,
  `forum_rankheight` int(11) NOT NULL,
  `forum_rankwidthunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_rankheightunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_postsperpage` int(11) NOT NULL,
  `forum_topicsperpage` int(11) NOT NULL,
  `forum_imagewidth` int(11) NOT NULL,
  `forum_imageheight` int(11) NOT NULL,
  `forum_sigwidth` int(11) NOT NULL,
  `forum_sigheight` int(11) NOT NULL,
  `forum_imagewidthunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_imageheightunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_sigwidthunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_sigheightunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_linkimages` int(11) NOT NULL,
  `forum_hidesignatures` int(11) NOT NULL,
  `forum_avatarwidth` int(11) NOT NULL,
  `forum_avatarheight` int(11) NOT NULL,
  `forum_avatarwidthunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `forum_avatarheightunit` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `hideinactive` int(11) NOT NULL,
  `hpnews` int(11) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`websiteinfo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `websiteinfo1`
--

INSERT INTO `websiteinfo1` (`websiteinfo_id`, `clanname`, `clantag`, `preventhack`, `maxdsl`, `theme`, `lowdsl`, `meddsl`, `highdsl`, `logourl`, `forumurl`, `failedlogins`, `maxdiplomacy`, `mostonline`, `mostonlinedate`, `memberregistration`, `memberapproval`, `medalorder`, `newsticker`, `newstickercolor`, `newstickersize`, `newstickerbold`, `newstickeritalic`, `debugmode`, `privateforum`, `privateprofile`, `updatemenu`, `hpimagetype`, `hpimagewidth`, `hpimageheight`, `hpimagewidthunit`, `hpimageheightunit`, `forum_showmedal`, `forum_medalcount`, `forum_medalwidth`, `forum_medalheight`, `forum_medalwidthunit`, `forum_medalheightunit`, `forum_showrank`, `forum_rankwidth`, `forum_rankheight`, `forum_rankwidthunit`, `forum_rankheightunit`, `forum_postsperpage`, `forum_topicsperpage`, `forum_imagewidth`, `forum_imageheight`, `forum_sigwidth`, `forum_sigheight`, `forum_imagewidthunit`, `forum_imageheightunit`, `forum_sigwidthunit`, `forum_sigheightunit`, `forum_linkimages`, `forum_hidesignatures`, `forum_avatarwidth`, `forum_avatarheight`, `forum_avatarwidthunit`, `forum_avatarheightunit`, `hideinactive`, `hpnews`, `sortnum`) VALUES
(1, 'Bluethrust Clan Website Manager: Clan Scripts v4', '[bT]', '5555', 0, 'lol', '#00FF00', '#FFFF52', '#F75B5B', 'images/logo.png', 'http://localhost/cs4git/forum', 8, 10, 2, 1362280462, 0, 1, 1, 'Welcome to the Site!', '#000000', 14, 0, 0, 0, 0, 0, 1399187245, 'slider', 600, 400, 'px', 'px', 1, 5, 50, 13, 'px', 'px', 1, 50, 75, 'px', 'px', 25, 0, 500, 500, 500, 150, 'px', 'px', 'px', 'px', 1, 0, 50, 50, 'px', 'px', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
