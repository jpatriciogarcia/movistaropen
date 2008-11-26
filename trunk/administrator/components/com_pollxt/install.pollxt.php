<?php
/**
* PollXT for Joomla!
* @Copyright (C) 2004 - 2006 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 1.22
**/
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

function com_install() {

	$XTVersion = "1";
	$XTDevLevel = "23.04";

	//$mamboVersion = "4.5";
	//$mamboDevLevel = "1";

	global $_VERSION, $database, $mosConfig_absolute_path;

	$output = "<table width = \"100%\" bgcolor=\"#FFFFFF\"><tr><td>";
	$output .= "<img valign=\"middle\" src=\"../administrator/components/com_pollxt/pollxt.png\" /><br></td></tr>";

	// check Mambo Version
	/*if (($_VERSION->RELEASE < $mamboVersion) ||
	   (($_VERSION->DEV_LEVEL < $mamboDevLevel) && ($_VERSION->RELEASE == $mamboVersion)))
	   {
	     $output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
	     $output .= "For this Version of PollXT is at least Mambo Version "
	               .$mamboVersion.".".$mamboDevLevel." required<br>";
	     $output .= "Current Version: ".$_VERSION->version.".".$_VERSION->dev_level."<br>";
	     $output .= "Installation aborted</td></tr></table>";
	     return $output;
	     
	   }*/

	//add new admin menu images
	$database->setQuery("SELECT id FROM #__components WHERE admin_menu_link = 'option=com_pollxt'");
	$id = $database->loadResult();
	$database->setQuery("UPDATE #__components SET admin_menu_img = '../administrator/components/com_pollxt/xtmenu.png', admin_menu_link = 'option=com_pollxt' WHERE id='$id'");
	$database->query();
	if ($database->getErrorNum()) {
		$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
		$output .= $database->getErrorMsg()."</td></tr>";
	}

	// get current pollXT Version
	$query = "SELECT version"."\nFROM #__pollxt_config WHERE"."\nid = '1'";
	$database->setQuery($query);
	$version = $database->loadResult();

	// Any version before 1.20
	if (($database->getErrorNum()) || (!$version)) {
		$query = "SELECT *"."\nFROM #__pollsxt";
		$database->setQuery($query);
		$database->query();
		if ($database->getErrorNum()) {
			// no version found
			$version = "0";
		} else
			$version = "1.10";
	}
	// Current Version is newer
	if ($version >= $XTVersion.".".$XTDevLevel) {
		$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
		$output .= "This installer is for version ".$XTVersion.".".$XTDevLevel." of PollXT<br>";
		$output .= "Currently installed version is ".$version."<br>";
		$output .= "No database update necessary.</td</tr></table>";
		$output .= "<tr><td style=\"color:#009900; font-weight:bold; font-size:12px\">";
		$output .= "Succesfully installed Version ".$XTVersion.".".$XTDevLevel."</td></tr></table>";

		return $output;

	}

	// install or upgrade
	if ($version == "0")
		$success = installPollXT( $output,  $version);
	$success = updatePollXT($version,  $output);

	$newVersion = $XTVersion.".".$XTDevLevel;

	// Completed... Update Version no.
	$output .= "<tr><td style=\"color:#009900; font-weight:bold; font-size:12px\">";
	$output .= "Succesfully installed Version ".$XTVersion.".".$XTDevLevel."</td></tr></table>";

	return $output;

}

function installPollXT(& $output, & $version) {
	global $database;

	// Queries 
	$query = array ("CREATE TABLE IF NOT EXISTS #__pollsxt (
	  id int(11) unsigned NOT NULL auto_increment,
	  title varchar(100)  NOT NULL default '',
	  voters int(9) NOT NULL default '0',
	  checked_out int(11) NOT NULL default '0',
	  checked_out_time datetime NOT NULL default '0000-00-00 00:00:00',
	  published tinyint(1) NOT NULL default '0',
	  access int(11) NOT NULL default '0',
	  lag int(11) NOT NULL default '0',
	  multivote tinyint(1) default '0',
	  rdisp tinyint(1) NOT NULL default '0',
	  rdispb tinyint(1) NOT NULL default '0',
	  ordering int(11) NOT NULL default '0',
	  rdispd tinyint(1) NOT NULL default '0',
	  intro text  NOT NULL,
	  thanks text  NOT NULL,
	  logon tinyint(1) NOT NULL default '0',
	  img_url text ,
	  imgsize int(11) NOT NULL default '0',
	  imgor text  NOT NULL,
	  imglink tinyint(1) NOT NULL default '0',
	  css varchar(20)  NOT NULL default 'poll_bars',
	  datefrom date NOT NULL default '0000-00-00',
	  dateto date NOT NULL default '0000-00-00',
	  type tinyint(1) NOT NULL default '0',
	  maxwidth int(3) NOT NULL default '294',
	  sh_numvote tinyint(1) NOT NULL default '0',
	  sh_flvote tinyint(1) NOT NULL default '0',
	  sh_abs tinyint(1) NOT NULL default '0',
	  sh_perc tinyint(1) NOT NULL default '0',
	  email tinyint(1) NOT NULL default '0',
	  subject varchar(80)  NOT NULL default '',
	  emailtext text  NOT NULL,
	  goto tinyint(1) NOT NULL default '0',
	  goto_url varchar(100)  NOT NULL default '',
	  PRIMARY KEY  (id)
	) ", "CREATE TABLE IF NOT EXISTS #__pollsxt_options (
	  id int(11) NOT NULL auto_increment,
	  quid int(11) NOT NULL default '0',
	  qoption text  NOT NULL,
	  img_url text ,
	  imgsize int(11) NOT NULL default '0',
	  imgor text  NOT NULL,
	  imglink tinyint(1) NOT NULL default '0',
	  freetext tinyint(1) NOT NULL default '0',
	  newopt tinyint(1) NOT NULL default '0',
	  inact tinyint(1) NOT NULL default '0',
	  PRIMARY KEY  (id)
	) ", "CREATE TABLE IF NOT EXISTS #__pollsxt_questions (
	  id int(11) NOT NULL auto_increment,
	  pollid int(11) NOT NULL default '0',
	  title text  NOT NULL,
	  type tinyint(1) NOT NULL default '0',
	  img_url text ,
	  imgsize int(11) NOT NULL default '0',
	  imgor text  NOT NULL,
	  imglink tinyint(1) NOT NULL default '0',
	  obli tinyint(1) NOT NULL default '0',
	  multisize char(3)  NOT NULL default '',
	  inact tinyint(1) NOT NULL default '0',
	  PRIMARY KEY  (id)
	) ", "CREATE TABLE IF NOT EXISTS #__pollxt_config (
	  id tinyint(1) NOT NULL auto_increment,
	  version varchar(10)  NOT NULL default '',
	  xt_disp tinyint(1) NOT NULL default '0',
	  xt_hide tinyint(1) NOT NULL default '0',
	  xt_selpo tinyint(1) NOT NULL default '0',
	  xt_publ tinyint(1) NOT NULL default '0',
	  xt_order tinyint(1) NOT NULL default '0',
	  xt_imgvote varchar(80)  NOT NULL default '',
	  xt_imgresult varchar(80)  NOT NULL default '',
	  xt_maxcolors tinyint(1) NOT NULL default '0',
	  xt_height tinyint(2) NOT NULL default '0',
	  xt_orderby varchar(10)  NOT NULL default '',
	  xt_asc varchar(4)  NOT NULL default '',
	  xt_seccookie tinyint(1) NOT NULL default '0',
	  xt_secip tinyint(1) NOT NULL default '0',
	  xt_secuname tinyint(1) NOT NULL default '0',
	  PRIMARY KEY  (id)
	) ", "CREATE TABLE #__pollxt_data (
	  id int(11) NOT NULL auto_increment,
	  optid int(11) NOT NULL default '0',
	  ip text  NOT NULL,
	  user text  NOT NULL,
	  datu datetime NOT NULL default '0000-00-00 00:00:00',
	  value varchar(100)  NOT NULL default '',
	  mailkey varchar(100)  NOT NULL default '',
	  block tinyint(1) NOT NULL default '0',
	  PRIMARY KEY  (id)
	) ", "CREATE TABLE #__pollxt_menu (
	  pollid int(11) NOT NULL default '0',
	  menuid int(11) NOT NULL default '0',
	  PRIMARY KEY  (pollid,menuid)
	) ", "INSERT INTO `#__pollsxt` VALUES
	(1, 'Sample Poll', 2, 0, '0000-00-00 00:00:00', 1, 0, 86400, 0, 3, 1, 1, 1, 'This is a sample poll, that shows you quickly some of the capabilities of PollXT', '', 0, '/asterisk.png', 100, 'width', 0, '', '0000-00-00', '0000-00-00', 0, 300, 1, 0, 0, 1, 0, '', '', 0, '')
	", "INSERT INTO `#__pollsxt_options` VALUES (1, 1, 'yes', '', 100, 'width', 0, 0, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (2, 2, 'Cherries', '/fruit/cherry.jpg', 30, 'width', 1, 0, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (3, 1, 'no', '', 0, 'width', 0, 0, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (4, 2, 'Strawberrys', '/fruit/strawberry.jpg', 30, 'width', 0, 0, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (5, 2, 'Something else', '', 0, 'width', 0, 1, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (6, 3, 'PollXT is cool', '', 0, 'width', 0, 0, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (7, 3, 'I like JoomlaXT', '', 0, 'width', 0, 0, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (8, 3, 'The standard poll is crap', '', 0, 'width', 0, 0, 0, 0)", "INSERT INTO `#__pollsxt_options` VALUES (9, 3, 'I''ll try StaticXT, too', '', 0, 'width', 0, 0, 0, 0)", "INSERT INTO `#__pollsxt_questions` VALUES (1, 1, 'A question with radio buttons... like it?', 1, '', 100, 'width', 0, 0, '', 0)", "INSERT INTO `#__pollsxt_questions` VALUES (2, 1, 'Now some checkboxes with pictures, do you like...', 2, '', 100, 'width', 0, 0, '', 0)", "INSERT INTO `#__pollsxt_questions` VALUES (3, 1, 'Select as much as you''d like to...', 4, '/clock.jpg', 30, 'width', 0, 1, '3', 0)", "INSERT INTO `#__pollxt_menu` VALUES (1, 0)", "INSERT INTO `#__pollxt_config` VALUES (1, '1.20b3', 1, 0, 0, 0, 1, '', '', 5, 5, 'hits', 'ASC', 0, 1, 1 )");

	// Create Tables
	$success = true;
	foreach ($query as $q) {
		$database->setQuery($q);
		$database->query();
		if ($database->getErrorNum()) {
			$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
			$output .= $database->getErrorMsg()."</td></tr>";
			$success = false;
		}

	}
	$version = "1.20";
	return $success;
}

function updatePollXT($version, & $output) {
	global $mosConfig_absolute_path, $database;

	// Upgrade to 1.20
	if ($version == "1.10") {
		$query = array ("ALTER TABLE #__pollsxt ADD `type` TINYINT(1) NOT NULL,
		ADD `maxwidth` INT(3) DEFAULT '294' NOT NULL,
		ADD `sh_numvote` TINYINT(1) NOT NULL,
		ADD `sh_flvote` TINYINT(1) NOT NULL,
		ADD `sh_abs` TINYINT(1) NOT NULL ,
		ADD `sh_perc` TINYINT(1) NOT NULL ,
		ADD `email` TINYINT(1) NOT NULL ,
		ADD `subject` VARCHAR(80) NOT NULL,
		ADD `emailtext` TEXT NOT NULL,
		ADD `goto` TINYINT(1) NOT NULL,
		ADD `goto_url` VARCHAR(80) NOT NULL", "ALTER TABLE #__pollxt_data ADD `mailkey` VARCHAR(100) NOT NULL,
		ADD `block` TINYINT(1) NOT NULL", "CREATE TABLE #__pollxt_config (
		`id` tinyint(1) NOT NULL AUTO_INCREMENT ,
		`version` varchar(10) NOT NULL default '',
		`xt_disp` tinyint(1) NOT NULL default '0',
		`xt_hide` tinyint(1) NOT NULL default '0',
		`xt_selpo` tinyint(1) NOT NULL default '0',
		`xt_publ` tinyint(1) NOT NULL default '0',
		`xt_order` tinyint(1) NOT NULL default '0',
		`xt_imgvote` varchar(80) NOT NULL default '',
		`xt_imgresult` varchar(80) NOT NULL default '',
		`xt_maxcolors` tinyint(1) NOT NULL default '0',
		`xt_height` tinyint(2) NOT NULL default '0',
		`xt_orderby` varchar(10) NOT NULL default '',
		`xt_asc` varchar(4) NOT NULL default '',
		`xt_seccookie` tinyint(1) NOT NULL default '0',
		`xt_secip` tinyint(1) NOT NULL default '0',
		`xt_secuname` tinyint(1) NOT NULL default '0',
		PRIMARY KEY ( `id` )
		)
		");

		$success = true;
		foreach ($query as $q) {
			$database->setQuery($q);
			$database->query();
			if ($database->getErrorNum()) {
				$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
				$output .= $database->getErrorMsg()."</td></tr>";
			}
		}

		// if database upgraded succesfully get configuration
		if (file_exists($mosConfig_absolute_path."/administrator/components/com_pollxt/config.pollxt.php")) {
			include_once ($mosConfig_absolute_path."/administrator/components/com_pollxt/config.pollxt.php");
		}

		// move configuration to database
		$query = "INSERT into #__pollxt_config (version, xt_disp, xt_hide, xt_selpo, xt_publ, xt_order,
		                                        xt_imgvote, xt_imgresult, xt_maxcolors, xt_height, xt_orderby,
		                                        xt_asc, xt_seccookie, xt_secip, xt_secuname)
		                                        VALUES
		                                        ( '1.20', '$xt_disp', '$xt_hide', '$xt_selpo', '$xt_publ', '$xt_order',
		                                        '$xt_imgvote', '$xt_imgresult', '$xt_maxcolors', '$xt_height', '$xt_orderby',
		                                        '$xt_asc', '$xt_seccookie', '$xt_secip', '$xt_scuname')";

		$database->setQuery($query);
		$database->query();
		if ($database->getErrorNum()) {
			$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
			$output .= $database->getErrorMsg()."</td></tr>";
		}
		$version = "1.20";
	}
	// 1.20 completed
	// upgrade to 1.20b2
	if ($version == "1.20") {
		$query = 'ALTER TABLE `#__pollxt_config` ADD `resselpo` TINYINT(1) NOT NULL';
		$database->setQuery($query);
		$database->query();
		if ($database->getErrorNum()) {
			$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
			$output .= $database->getErrorMsg()."</td></tr>";
		}
		$version = "1.20b2";
	}
	if ($version == "1.20b2") {
		$query = 'ALTER TABLE `#__pollsxt` ADD `hidetitle` TINYINT( 1 ) NOT NULL';
		$database->setQuery($query);
		$database->query();
		if ($database->getErrorNum()) {
			$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
			$output .= $database->getErrorMsg()."</td></tr>";
		}
		$version = "1.20b3";
	}
	if ($version == "1.20b3") {
		$query = 'ALTER TABLE `#__pollsxt` DROP `maxwidth`';
		$database->setQuery($query);
		$database->query();
		if ($database->getErrorNum()) {
			$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
			$output .= $database->getErrorMsg()."</td></tr>";
		}
		$version = "1.20b4";
	}
	if ($version == "1.20b4") {

		$version = "1.20rc1";
	}

	if ($version == "1.20rc1") {
		$query = 'ALTER TABLE `#__pollsxt` ADD `timefrom` TIME NOT NULL AFTER `dateto`, ADD `timeto` TIME NOT NULL AFTER `timefrom`';
		$database->setQuery($query);
		$database->query();
		if ($database->getErrorNum()) {
			$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
			$output .= $database->getErrorMsg()."</td></tr>";
		}
		$version = "1.20rc2";
	}

	if ($version == "1.20rc2") {
		$query = 'ALTER TABLE `#__pollxt_config` ADD `imgpath` VARCHAR(80) NOT NULL';
		$database->setQuery($query);
		$database->query();
		if ($database->getErrorNum()) {
			$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
			$output .= $database->getErrorMsg()."</td></tr>";
		}
		$version = "1.20rc3";
	}
	// from version 1.21.02 new update functionality
	// include updateinfo
	require_once ($mosConfig_absolute_path."/administrator/components/com_pollxt/com_pollxtupd.inc");

	// update database

	if ($updatequery) {
		foreach ($updatequery as $q) {
			if ($q->upversion > $version) {
				$database->setQuery($q->query);
				$database->query();
				if ($database->getErrorNum()) {
					$output .= "<tr><td style=\"color:#bb0000; font-weight:bold; font-size:12px\">";
					$output .= $database->getErrorMsg()."</td></tr>";
				}
			}
		}
	}

	return true;
}
?>

