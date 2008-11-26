<?php
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');set_magic_quotes_runtime(0);
global $mosConfig_absolute_path;
// make dirs if required
	if (!file_exists($mosConfig_absolute_path."/components/com_pollxt/class"))
	 mkdir($mosConfig_absolute_path."/components/com_pollxt/class");
	if (!file_exists($mosConfig_absolute_path."/components/com_pollxt/script"))
	 mkdir($mosConfig_absolute_path."/components/com_pollxt/script");

$updatequery[0]->query = "ALTER TABLE `#__pollsxt` ADD `mailres` TINYINT(1) NOT NULL, ADD `mailresrec` VARCHAR(80) NOT NULL, ADD `mailrestxt` VARCHAR(255) NOT NULL;";
$updatequery[0]->upversion = "1.21.02";
$updatequery[0]->text = "DB: New EMail fields";
$updatequery[1]->query = "ALTER TABLE `#__pollsxt` ADD `rdispall` TINYINT( 1 ) NOT NULL ;";
$updatequery[1]->upversion = "1.22.13";
$updatequery[1]->text = "DB: ALTER Poll Table";
$updatequery[2]->query = "UPDATE `#__pollxt_config`  SET version = '1.23.04' WHERE id = '1'";
$updatequery[2]->upversion = "9";
$updatequery[2]->text = "DB: Version-Info";
$updatequery[3]->query = "ALTER TABLE `#__pollsxt_options` ADD `multicols` CHAR( 3 ) NOT NULL ,
ADD `multirows` CHAR( 3 ) NOT NULL ;";
$updatequery[3]->upversion = "1.21.06";
$updatequery[3]->text = "DB: Alter Options Table";
$updatequery[4]->query = "ALTER TABLE `#__pollxt_config` ADD `rdisp` TINYINT(1) NOT NULL";
$updatequery[4]->upversion = "1.22.01";
$updatequery[4]->text = "DB: ALTER Config-Table";
$updatequery[5]->query = "ALTER TABLE `#__pollxt_config` ADD `button_style` TINYINT( 1 ) NOT NULL ;";
$updatequery[5]->upversion = "1.23.02";
$updatequery[5]->text = "DB: ALTER Config Table";
