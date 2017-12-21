-- --------------------------------------------------------

-- 
-- 資料表格式： `voteonline_account`
-- 

CREATE TABLE `voteonline_account` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `elid` int(10) unsigned NOT NULL default '0',
  `gcid` int(10) unsigned NOT NULL default '0',
  `nb` tinyint(3) unsigned NOT NULL default '0',
  `passwd` varchar(5) default NULL,
  `status` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 資料表格式： `voteonline_candidate`
-- 

CREATE TABLE `voteonline_candidate` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `elid` int(10) unsigned NOT NULL default '0',
  `tpid` tinyint(3) unsigned NOT NULL default '0',
  `nb` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(40) NOT NULL default '',
  `votes` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 資料表格式： `voteonline_class`
-- 

CREATE TABLE `voteonline_class` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `elid` int(10) unsigned NOT NULL default '0',
  `gdcl` varchar(10) NOT NULL default '',
  `uid` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 資料表格式： `voteonline_election`
-- 

CREATE TABLE `voteonline_election` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `check_bg` varchar(20) default NULL,
  `check_ed` varchar(20) default NULL,
  `vote_bg` varchar(20) default NULL,
  `vote_ed` varchar(20) default NULL,
  `bulletin_bg` varchar(20) default NULL,
  `bulletin` text,
  `packaged` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- 資料表格式： `voteonline_vote`
-- 

CREATE TABLE `voteonline_vote` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `elid` int(10) unsigned NOT NULL default '0',
  `tpid` int(10) unsigned NOT NULL default '0',
  `cddid` int(10) unsigned NOT NULL default '0',
  `actid` int(10) unsigned NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `dttm` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;


CREATE TABLE `voteonline_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `elid` int(10) unsigned NOT NULL,
  `types` varchar(255) NOT NULL,
  `votes_none` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;