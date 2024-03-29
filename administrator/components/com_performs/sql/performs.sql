###
# install sql for perForms
###

CREATE TABLE IF NOT EXISTS #__performs (
  `id` int(11) NOT NULL auto_increment,
  `intro` text,
  `note` text,
  `title` varchar(150) NOT NULL default '',
  `published` tinyint(1) NOT NULL default '0',
  `start_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `finish_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `image` varchar(150) default NULL,
  `imagefloat` varchar(36) default 'left',
  `tablename` varchar(100) default NULL,
  `theme` varchar(50) default 'performs.jpg',
  `from` varchar(100) ,
  `emails` text ,
  `mailIt` tinyint(1) NOT NULL default '0',
  `mailToAdmin` tinyint(1) NOT NULL default '1',
  `mailToUser` tinyint(1) NOT NULL default '1',
  `enableMailFrom` tinyint(1) NOT NULL default '0',
  `mailAlways` tinyint(1) NOT NULL default '0',
  `mailAsText` tinyint(1) NOT NULL default '0',
  `useintro` tinyint(1) NOT NULL default '0',
  `appendtimestamp` tinyint(1) NOT NULL default '0',
  `includeSubmit` tinyint(1) NOT NULL default '1',
  `submitLabel` varchar(100) NOT NULL default 'Submit',
  `submitImageUrl` text,
  `submitImageWidth` int(11) default '32',
  `submitImageHeight` int(11) default '32',
  `replaceSubmitButton` tinyint(1) NOT NULL default '0',
  `includeReset` tinyint(1) NOT NULL default '0',
  `resetLabel` varchar(100) default 'Reset',
  `replaceResetButton` tinyint(1) NOT NULL default '0',
  `resetImageUrl` text,
  `resetImageWidth` int(11) default '32',
  `resetImageHeight` int(11) default '32',
  `includePDF` tinyint(1) NOT NULL default '1',
  `includePF` tinyint(1) NOT NULL default '1',
  `mailSubject` varchar(255) default NULL,
  `access` tinyint(3) unsigned NOT NULL default '0',
	`noAuthMessage` text,
  `checked_out` int(10) unsigned NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  `r_url` varchar(255) default NULL,
  `asub` tinyint(1) NOT NULL default '2',
  `strMissingFieldMsg` varchar(255) default NULL,
  `use_securityimages` tinyint(1) NOT NULL default '0',
  `securityHelpText` varchar(255) default NULL,
  `securityErrorText` varchar(255) default NULL,
  `showFormTitle` tinyint(1) NOT NULL default '1',
  `formWidth` varchar(12) default '100%',
  `useContainer` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS #__performs_items (
  `itemId` int(11) NOT NULL auto_increment,
  `formId` int(11) NOT NULL default '0',
  `type` varchar(50) NOT NULL default '',
  `name` varchar(50) NOT NULL default '',
  `value` text ,
  `caption` text NOT NULL,
  `accesskey` CHAR(1) NOT NULL DEFAULT ' ',
  `required` tinyint(1) default '0',
  `var1` int(11) default NULL,
  `var2` int(11) default NULL,
  `check` varchar(50) default NULL,
  `help` varchar(255) default NULL,
  `errMsg` varchar(255) default NULL,
  `usecaption` tinyint(1) default '1',
  `showuploadedimage` tinyint(1) default '0',
  `disabled` tinyint(1) default '0',
  `readonly` tinyint(1) default '0',
  `multiple` tinyint(1) default '0',
  `captionCssClass` varchar(25) default 'pfCaption',
  `valueCssClass` varchar(25) default 'pfValue',
  `infoCssClass` varchar(25) default 'pfInfo',
  `errorCssClass` varchar(25) default 'pfError',
	`separator` varchar(100) default NULL,
  `checkOrSelect` varchar(50) default NULL,
  `ordering` int(2) default '0',
  PRIMARY KEY  (`itemId`)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS `#__performs_config` (
  `id` int(9) unsigned NOT NULL auto_increment,
  `name` text NOT NULL,
  `value` text NOT NULL,
 PRIMARY KEY `id` (`id`)
) TYPE=MyISAM;