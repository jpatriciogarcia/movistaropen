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

global $mosConfig_dbprefix;
$output = "! To completely clean up the database, perform:<br><br>"
."DROP TABLE `".$mosConfig_dbprefix."pollsxt`;<br>"
."DROP TABLE `".$mosConfig_dbprefix."pollsxt_options`;<br>"
."DROP TABLE `".$mosConfig_dbprefix."pollsxt_questions`;<br>"
."DROP TABLE `".$mosConfig_dbprefix."pollxt_config`;<br>"
."DROP TABLE `".$mosConfig_dbprefix."pollxt_data`;<br>"
."DROP TABLE `".$mosConfig_dbprefix."pollxt_menu`;<br>";

$this->setError(0, $output);

function com_uninstall()
{
global $installer;
	


return true;

}

?>
