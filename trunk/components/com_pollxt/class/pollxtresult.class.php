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

class pollxtresult {
	var $firstVote = null;
	var $lastVote = null;
	var $votes = null;
	
    function pollxtresult($pollid) {
	global $database;
	$database->setQuery("SELECT MAX(t1.datu) AS maxdate, " .
						"MIN(t1.datu) AS mindate, " .
						"t4.voters AS votes " .
						"FROM #__pollxt_data as t1, " .
						"#__pollsxt_options as t2, #__pollsxt_questions as t3, " .
						"#__pollsxt as t4 where t4.id='$pollid' " .
						"AND t1.optid = t2.id AND t2.quid = t3.id " .
						"AND t3.pollid = t4.id and t1.block = 0 " .
						"GROUP BY t3.id;");
	$dates = $database->loadObjectList();
	if (!isset($dates[0])) return;
	$this->firstVote = mosFormatDate($dates[0]->mindate, _DATE_FORMAT_LC2);
	$this->lastVote = mosFormatDate($dates[0]->maxdate, _DATE_FORMAT_LC2);
	$this->votes = $dates[0]->votes;
	
    }
}
?>
