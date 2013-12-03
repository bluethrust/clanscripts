CREATE TABLE IF NOT EXISTS `app_components` (
  `appcomponent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `componenttype` varchar(25) NOT NULL,
  `required` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`appcomponent_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `app_selectvalues` (
  `appselectvalue_id` int(11) NOT NULL AUTO_INCREMENT,
  `appcomponent_id` int(11) NOT NULL,
  `componentvalue` varchar(255) NOT NULL,
  PRIMARY KEY (`appselectvalue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `app_values` (
  `appvalue_id` int(11) NOT NULL AUTO_INCREMENT,
  `appcomponent_id` int(11) NOT NULL,
  `memberapp_id` int(11) NOT NULL,
  `appvalue` text NOT NULL,
  PRIMARY KEY (`appvalue_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `consolecategory` (
  `consolecategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `adminoption` int(1) NOT NULL,
  PRIMARY KEY (`consolecategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `console_members` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `console_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `allowdeny` int(1) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `custompages` (
  `custompage_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) NOT NULL,
  `pageinfo` text NOT NULL,
  PRIMARY KEY (`custompage_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `diplomacy` (
  `diplomacy_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `diplomacystatus_id` int(11) NOT NULL,
  `dateadded` int(11) NOT NULL,
  `clanname` varchar(255) NOT NULL,
  `leaders` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `clansize` varchar(10) NOT NULL,
  `clantag` varchar(15) NOT NULL,
  `skill` varchar(100) NOT NULL,
  `gamesplayed` varchar(255) NOT NULL,
  `extrainfo` text NOT NULL,
  PRIMARY KEY (`diplomacy_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `diplomacy_request` (
  `diplomacyrequest_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(255) NOT NULL,
  `dateadded` int(11) NOT NULL,
  `diplomacystatus_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `clanname` varchar(255) NOT NULL,
  `clantag` varchar(15) NOT NULL,
  `clansize` varchar(10) NOT NULL,
  `gamesplayed` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `leaders` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `confirmemail` varchar(255) NOT NULL,
  PRIMARY KEY (`diplomacyrequest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `diplomacy_status` (
  `diplomacystatus_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `imageurl` text NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`diplomacystatus_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `downloadcategory` (
  `downloadcategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`downloadcategory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `downloads` (
  `download_id` int(11) NOT NULL AUTO_INCREMENT,
  `downloadcategory_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateuploaded` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `downloadcount` int(11) NOT NULL,
  PRIMARY KEY (`download_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `download_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `downloadcategory_id` int(11) NOT NULL,
  `extension` varchar(255) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `failban` (
  `failban_id` int(11) NOT NULL AUTO_INCREMENT,
  `pagename` varchar(255) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  PRIMARY KEY (`failban_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `gamesplayed` (
  `gamesplayed_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `imageurl` text NOT NULL,
  `imagewidth` int(11) NOT NULL,
  `imageheight` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`gamesplayed_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `gamesplayed_members` (
  `gamemember_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamesplayed_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`gamemember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `gamestats_members` (
  `gamestatmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `gamestats_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `statvalue` decimal(65,30) NOT NULL,
  `stattext` varchar(255) NOT NULL,
  `dateupdated` int(11) NOT NULL,
  PRIMARY KEY (`gamestatmember_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `hitcounter` (
  `hit_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(25) NOT NULL,
  `dateposted` int(11) NOT NULL,
  `pagename` varchar(255) NOT NULL,
  PRIMARY KEY (`hit_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `ipban` (
  `ipban_id` int(11) NOT NULL AUTO_INCREMENT,
  `ipaddress` varchar(11) NOT NULL,
  `exptime` int(11) NOT NULL,
  PRIMARY KEY (`ipban_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `logdate` int(11) NOT NULL,
  `ipaddress` varchar(255) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `medals_members` (
  `medalmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `medal_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `dateawarded` int(11) NOT NULL,
  PRIMARY KEY (`medalmember_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `notifications` int(11) NOT NULL,
  PRIMARY KEY (`member_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `notifications` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) NOT NULL,
  `datesent` int(11) NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL,
  `icontype` varchar(15) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `profilecategory` (
  `profilecategory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ordernum` int(11) NOT NULL,
  PRIMARY KEY (`profilecategory_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `profileoptions` (
  `profileoption_id` int(11) NOT NULL AUTO_INCREMENT,
  `profilecategory_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `optiontype` varchar(255) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`profileoption_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `profileoptions_select` (
  `selectopt_id` int(11) NOT NULL AUTO_INCREMENT,
  `profileoption_id` int(11) NOT NULL,
  `selectvalue` varchar(255) NOT NULL,
  `sortnum` int(11) NOT NULL,
  PRIMARY KEY (`selectopt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `profileoptions_values` (
  `values_id` int(11) NOT NULL AUTO_INCREMENT,
  `profileoption_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `inputvalue` varchar(255) NOT NULL,
  PRIMARY KEY (`values_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `squads_members` (
  `squadmember_id` int(11) NOT NULL AUTO_INCREMENT,
  `squad_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `squadrank_id` int(11) NOT NULL,
  `datejoined` int(11) NOT NULL,
  `lastpromotion` int(11) NOT NULL,
  `lastdemotion` int(11) NOT NULL,
  PRIMARY KEY (`squadmember_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tournamentplayers` (
  `tournamentplayer_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `displayname` varchar(50) NOT NULL,
  PRIMARY KEY (`tournamentplayer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tournamentpools` (
  `tournamentpool_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `finished` int(11) NOT NULL,
  PRIMARY KEY (`tournamentpool_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `tournamentteams` (
  `tournamentteam_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `seed` int(11) NOT NULL,
  PRIMARY KEY (`tournamentteam_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `rank_privileges` (
  `privilege_id` int(11) NOT NULL AUTO_INCREMENT,
  `rank_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  PRIMARY KEY (`privilege_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
