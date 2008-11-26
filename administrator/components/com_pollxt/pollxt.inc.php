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

require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/class.compat.15.php");


function pollXT_Show_Sel($pollist) {
	echo $pollist;
}

/*------------------------------------------------------------------------------
Check if user already voted for that poll
------------------------------------------------------------------------------*/
function checkVote($poll) {
	global $database, $my;
	require ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

	$cookiename = "voted$poll->id";
	$vcookie = mosGetParam($_COOKIE, $cookiename, '0');

    if ($xt_seccookie==0)
		$scookie = false;
	elseif ($vcookie and $xt_seccookie==1)
		$scookie = true;
	else
		$scookie = false;


	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else
		$ip=$_SERVER['REMOTE_ADDR']; 

	if (!$my->id)
		$logonQuery = "AND p.logon=0";
	else
		$logonQuery = "";

	$now = date("Y-m-d");

    $where = "";
    $id = intval ($poll->id);
	// if logged on check username else check IP
	if (($my->id) and $xt_secuname and $xt_secip) {
		$where = " AND (d.user = \"".$my->username."\" OR d.ip = \"".$ip."\" )";
	}
	elseif ($xt_secip) $where = " AND d.ip = \"".$ip."\"";
	elseif (($my->id) and $xt_secuname) $where = " AND d.user = \"".$my->username."\"";

	if (!$where=="") {
		$query = "SELECT d.*
																																      FROM #__pollsxt_questions AS q
																																      LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
																																      LEFT JOIN #__pollxt_data AS d ON d.optid = o.id
																																      WHERE q.pollid =\"".$id."\"".$where."ORDER BY d.datu DESC
																																      LIMIT 1";

		$database->setQuery($query);

		$database->loadObject($result);
		echo $database->getErrorMsg();

	}

	$sip = false;
	
	if (isset($result->datu))
		$sip = true;
	return ($scookie or $sip);
}
/*------------------------------------------------------------------------------
read the results and prepare output
------------------------------------------------------------------------------*/
function pollresult($uid, $cfm = false, $Itemid = 0) {
	global $database, $mosConfig_offset, $mosConfig_live_site, $mosConfig_absolute_path, $my, $mosConfig_lang, $mosConfig_mbf_content;
	include ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/pollxt.class.php");
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/components/com_pollxt/pollxt.html.php");
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/components/com_pollxt/class/pollxtresult.class.php");

	$isPopup = mosGetParam($_REQUEST, 'isPopup', 0);
	$menu = & new mosMenu($database);
	$menu->load($Itemid);
	$params = & new mosParameters($menu->params);

	// page header
	if ($params->def('header') <> '') {
		$page->header = $params->def('header')." - "._POLLXT_RESULTS;
	} else {
		$page->header = $menu->name." - "._POLLXT_RESULTS;
	}


	$poll = new mospoll($database);
	$poll->load($uid);

// prevent direct calling of unpublished results
	if (($poll->published == 0) && ($xt_publ == 1))
		mosRedirect(xtSefRelToAbs("/index.php"), _NOT_AUTH);
	
	
	$rpoll = new pollxtresult($uid);

	

	$i = $j = $k = 0;

	// Get questions
	$id = intval ($poll->id);
	$query = "SELECT * FROM #__pollsxt_questions " .
			"WHERE pollid = '$id' " .
			"AND inact = '0' " .
			"AND type <> '5'" .
			"ORDER by 'ID'";
	$database->setQuery($query);
	$questions = $database->loadObjectList();


	foreach ($questions as $question) {

		$orderby = $database->getEscaped($xt_orderby);
		$asc = $database->getEscaped($xt_asc);

		if (empty ($orderby))
			$orderby = "a.id";
    	$id = intval ($question->id);
		$query = "SELECT a.*, COUNT(b.optid) as hits FROM #__pollsxt_options as a ";
		$query .= "left outer join #__pollxt_data as b ";
		$query .= "on a.id=b.optid ";
		$query .= "WHERE a.quid = '$id' ";
        if ($poll->rdispall != 1)
    		$query .= "AND b.block = 0 ";
		$query .= "group by a.qoption ";
		$query .= "order by ".$orderby." ".$asc;
		$query .= ", a.id ASC ";
		$database->setQuery($query);
		$options = $database->loadObjectList();

		$i = 0;
		$sum = 0;
		foreach ($options as $o) {
        	$id = intval ($o->id);
			$database->setQuery("SELECT * FROM #__pollxt_data WHERE optid = '$id' and block = 0 ");
			$data = $database->loadObjectList();
			
			$votes[$j][$i]["text"] = stripslashes($o->qoption);
			$votes[$j][$i]["hits"] = count($data);
			if ($o->img_url) {
			 $img = "<img src=\"";
			 $img .= $mosConfig_live_site.$xt_imgpath.$o->img_url;
			 $img .= "\" ".$o->imgor."=\"".$o->imgsize."\"/>";
			 $votes[$j][$i]["img"] = $img;
			}
			else $votes[$j][$i]["img"] = "";
			
			$sum = $sum + count($data);
			$i ++;
		}
		$i = 0;

		foreach ($options as $o) {
            if ($sum > 0)
                $votes[$j][$i]['perc'] = round($votes[$j][$i]["hits"]*100/$sum,2);
            else
                $votes[$j][$i]['perc'] = 0;
			$votes[$j][$i]['width'] = ceil($votes[$j][$i]['perc'] * 0.98 );
			$i++;  	 
		}

        $j ++;
		
	}
	
	if (!$my->id)
		$logonQuery = "AND logon=0";
	else
		$logonQuery = "";

	if (!$my->usertype == "Super Administrator")
		$logonQuery .= " AND ( rdispb=2 OR rdispb =1 )";

	if ($xt_publ)
		$publquery = "published=1";
	else
		$publquery = "id <> 0";

    $query = "SELECT id, title, rdispb"."\nFROM #__pollsxt"."\nWHERE ".
            $publquery.
            "\n".$logonQuery."\nORDER BY ordering";
    
	$database->setQuery($query);
	$polls = $database->loadObjectList();

	reset($polls);
    if ($cfm || $xt_resselpo != "1") { $pollist = null; }
    else {
	if (!$isPopup) {
		$link = xtSefRelToAbs('index.php?option=com_pollxt&amp;task=results&amp;Itemid='.$Itemid.'&amp;id=\' + this.options[selectedIndex].value + \'');
	} else {
		$link = xtSefRelToAbs('index2.php?option=com_pollxt&amp;task=results&amp;Itemid='.$Itemid.'&amp;isPopup=1&amp;id=\' + this.options[selectedIndex].value + \'');
	}

		$pollist = "\n<select name=\"id\" class=\"inputbox\" size=\"1\" style=\"WIDTH:200px\" onchange=\"if (this.options[selectedIndex].value != '') {document.location.href='".$link."'}\">";
		$pollist .= "\n\t<option value=\"\">"._SELECT_POLL."</option>";
		for ($i = 0, $n = count($polls); $i < $n; $i ++) {
			if (($polls[$i]->rdispb != 2) or (($polls[$i]->rdispb == 2) and (checkVote($polls[$i]))) or ($my->usertype == "Super Administrator")) {
				$k = $polls[$i]->id;
				$t = $polls[$i]->title;
				$sel = ($k == intval($poll->id) ? " selected=\"selected\"" : '');
				$pollist .= "\n\t<option value=\"".$k."\"$sel>".$t."</option>";
			}
		}
		$pollist .= "\n</select>\n";
        }

	poll_html :: showResults($poll, $questions, $votes, $rpoll, $pollist, $params, $Itemid, $page);
}

/* -----------------------------------------------------------------------------
Handle request for result details
------------------------------------------------------------------------------*/
function pollDetail($uid, $params="", $menu="") {
	global $database;
	$Itemid = mosGetParam($_REQUEST, 'Itemid', 0);
    $menu = & new mosMenu($database);
	$menu->load($Itemid);
	$params = & new mosParameters($menu->params);

	$database->setQuery("SELECT q.id, q.title , q.type, o.id, o.qoption , d.*
						FROM #__pollsxt_questions AS q
						LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
						LEFT JOIN #__pollxt_data AS d ON d.optid = o.id
						WHERE q.pollid =  '$uid' AND d.block = 0
						AND q.type <> 5
ORDER BY d.user,q.title,o.qoption");
//						ORDER BY q.title,o.qoption");

	$result = $database->loadObjectList();
	echo $database->getErrorMsg();

	$poll = new mosPoll($database);
	$poll->load($uid);

	// page header
	if (!$params) {
	if ($params->def('header') <> '') {
		$page->header = $params->def('header')." - "._POLLXT_DETAIL;
	} else {
		$page->header = $menu->name." - "._POLLXT_DETAIL;
	}
	}
else {
		$page->header = _POLLXT_DETAIL;
	}

	poll_html :: showDetail($poll, $result, $params, $page);

}
/* -----------------------------------------------------------------------------
Handling of a submitted vote
------------------------------------------------------------------------------*/

function pollAddVote($uid, $option, $cfm, $Itemid) {
	global $database, $mosConfig_offset, $my, $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_lang;
	require ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

	// Get the right language if it exists
	if (file_exists($GLOBALS['mosConfig_absolute_path'].'/components/com_pollxt/languages/'.$mosConfig_lang.'.php')) {
		include_once ($GLOBALS['mosConfig_absolute_path'].'/components/com_pollxt/languages/'.$mosConfig_lang.'.php');
	} else {
		include_once ($GLOBALS['mosConfig_absolute_path'] . '/components/com_pollxt/languages/english.php');
	}

	// get cookies
//	$sessioncookie = mosGetParam($_REQUEST, 'sessioncookie', '');
//	$sessionCookieName 	= mosMainFrame::sessionCookieName();
//	$sessioncookie = mosGetParam($_REQUEST, $sessionCookieName, '');
	// get IP
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	else
		$ip=$_SERVER['REMOTE_ADDR']; 


	// get the selection
	$voteArray = mosGetParam($_POST, 'voteid', 0);
	$xtVal = mosGetParam($_POST, 'xtVal', 0);

	$poll = new mosPoll($database);

	// Poll exists (vivible for user)?
	if (!$poll->load($uid)) {
		mosRedirect(createRedir(false, $Itemid), _NOT_AUTH);
	}

	// Cookies not enabled
/*	if ((!$sessioncookie) and $xt_seccookie) {
		mosRedirect(createRedir(false, $Itemid), _ALERT_ENABLED);
	}*/

	// already voted?
	$voted = checkVote($poll);
	if (!$poll->multivote == 1) {
		if ($voted) {
			mosRedirect(createRedir(false, $Itemid), _ALREADY_VOTE);
		}
	}

	// something selected?
	if (!$voteArray) {
		mosRedirect(createRedir(false, $Itemid), _NO_SELECTION);
	}

	$voteid = array ();
	$i = 0;
	foreach ($voteArray as $v) {
		foreach ($v as $vote) {
			$voteid[$i] = $vote;
			$i ++;
		}
	}

	$now = $now = date("Y-m-d G:i:s");

	if ($my->id)
		$user = $my->username;
	else
		$user = "anonymous";

	// Check for obligatory questions
   	$id = intval ($poll->id);
	$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$id' and obli = '1' and inact = '0' and type <> '5'";
	$database->setQuery($query);
	$questions = $database->loadObjectList();
    $obligatory = "";
	foreach ($questions as $q) {
		$found = false;
		foreach ($voteid as $v) {
            $v = intval($v);
          	$id = intval ($q->id);
			$query = "SELECT * FROM #__pollsxt_options WHERE id = '$v' AND quid = '$id'";
			$database->setQuery($query);
			$result = $database->loadResult();
			if ($result)
				$found = true;
		}
		if (!$found)
			$obligatory .= "<li>".$q->title;
	}

	if (!empty ($obligatory)) {
		echo _POLLXT_OBLIGATORY."<br />";
		echo "<ul>".$obligatory."</ul><br /><br />";
		echo XT_HTML :: closeButton($poll, $voteid);
		return;
	}

	// after all checks set cookie
	$cookiename = "voted$poll->id";
	setcookie("$cookiename", '1', time() + $poll->lag);

	$block = 0;
	// Confirmation email required? Send now
    $mailkey = "";
    if ($poll->email == 1) {
		$mailkey = pollSendEmail($poll);
		if (!$mailkey) {
			echo _POLLXT_EMAIL_FAIL."<br />";
			echo XT_HTML :: closeButton($poll, $voteid);
			return;
		}
		$block = 1;
	}

	// Do that "new option" stuff
   	$id = intval ($poll->id);
	$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$id' AND inact = '0'";
	$database->setQuery($query);
	$qu = $database->loadObjectList();

	foreach ($qu as $q) {
		foreach ($voteid as $v) {
            $v = intval ($v);
           	$id = intval ($q->id);
			$query = "SELECT * FROM #__pollsxt_options WHERE id = '$v' AND quid = '$id' AND inact = '0'";
			$database->setQuery($query);
			$resultList = $database->loadObjectList();
			foreach ($resultList as $result) {
				if ($result->newopt >= 1) {
					if (($my->id) or (($result->newopt == 2) || ($result->newopt == 3))) {
						if ($result->newopt == 2)
							$inact = 1;
						else
							$inact = 0;

						//existence-check
                        $id = intval ($q->id);
                        $val = $xtVal[$v];
						$query = "SELECT * FROM #__pollsxt_options WHERE quid = '$id' and qoption = '$val'";
						$database->setQuery($query);
						$database->loadObject($check);
						if ($check->id)
							$newv[] = $check->id;
						else {
							$database->setQuery("INSERT INTO #__pollsxt_options (quid, qoption, inact) VALUES ('$id', '$val', '$inact')");
							$database->query();
							$newId = mysql_insert_id();
							$database->setQuery("INSERT INTO #__pollxt_data (optid, ip, user, datu, mailkey, block)"."\nVALUES ($newId, '$ip', '$user', '$now', '$mailkey', '$block')");
							$database->query();
							echo $database->getErrorMsg();
						}
					} else
						$newv[] = $v;
				} else
					$newv[] = $v;
			}

		}
	}

	$voteid = $newv;

	// update the database
	foreach ($voteid as $v) {
        if (isset($xtVal[$v]))
            $val = htmlentities($xtVal[$v]);
        else $val = "";
		$database->setQuery("INSERT INTO #__pollxt_data"."\n(optid, ip, user, datu, value, mailkey, block)"."\nVALUES ($v, '$ip', '$user', '$now', '$val', '$mailkey', '$block')");
		$database->query();
	}
	echo $database->getErrorMsg();
   	$id = intval ($poll->id);
	$database->setQuery("UPDATE #__pollsxt SET voters=voters + 1"."\n WHERE id='$id'");

	$database->query();

	// Build thank you message
	if ($poll->thanks)
		$thanks = stripslashes($poll->thanks);
	else
		$thanks = _THANKS;
	// email results 
	if ($poll->mailres)
		emailResult($poll, $voteid, $xtVal);

	// ... and bye
//	echo createRedir($poll, $Itemid)."/".sefRelToAbs($mosConfig_live_site);break;
	$redir = mosGetParam($_REQUEST, 'redir', 0);

	if ( strpos(createRedir($poll, $Itemid), sefRelToAbs($mosConfig_live_site))!== false) {
	 mosRedirect(createRedir($poll, $Itemid), "".stripslashes($thanks).""); }
    else
     mosRedirect(createRedir($poll, $Itemid));
}

/* -----------------------------------------------------------------------------
Creates the redirect depending on where to go and where we are
------------------------------------------------------------------------------*/
function createRedir($poll, $Itemid) {
	global $mosConfig_live_site, $mosConfig_sef;

	$redir = mosGetParam($_REQUEST, 'redir', 0);
	$cfm = mosGetParam($_REQUEST, 'cfm', 0);

// if no query it has to be homepage
   if ($redir=="0") $redir="";

	if (!$poll)
		$poll->goto = 1;

	switch ($poll->goto) {
		// Nowhere - The easiest task...
		case "1" :
            if ($redir != "")
			$redirUrl = xtSefRelToAbs("index.php?$redir");
			else
			$redirUrl = $mosConfig_live_site;
			break;
			// URL - another easy task
		case "2" :
			if (strncasecmp($poll->goto_url, "http", 4) == 0)
				$redirUrl = $poll->goto_url;
			else
				$redirUrl = xtSefRelToAbs("index.php?$poll->goto_url");
			break;
			// now the funny results...
		case "0" :
			// in case of component same screen = mainscreen
			if ((!$cfm) && ($poll->rdisp == 3))
				$poll->rdisp = 1;
			switch ($poll->rdisp) {
				case "1" :
					// set task=result and id
					$redirUrl = xtSefRelToAbs("index.php?option=com_pollxt&task=results&id=$poll->id&Itemid=$Itemid");
					break;
				case "2" :
					// same, but this time index2
					$redirUrl = xtSefRelToAbs("index2.php?option=com_pollxt&task=results&isPopup=1&id=$poll->id&Itemid=$Itemid");
					break;
				case "3" :
					// in module... go to previous page and set task for module
					$redirUrl = xtSefRelToAbs("index.php?".$redir."&xt_resultsId=".$poll->id."&Itemid=".$Itemid);
					break;
			}
	}

	return html_entity_decode($redirUrl);
}

/* -----------------------------------------------------------------------------
Send Confirmation email
------------------------------------------------------------------------------*/
function pollSendEmail($poll) {
	global $my, $database, $mosConfig_live_site, $mosConfig_lang, $mosConfig_mailfrom, $mosConfig_fromname, $mosConfig_mbf_content;

	//translate
    if ($mosConfig_mbf_content)
    if (!class_exists("JoomFish"))
	   $tpoll = MambelFish :: translate($poll, 'pollsxt', $mosConfig_lang);


	//generate key
	$key = md5(mosMakePassword());

	// get Email-Address
	$query = "SELECT email"."\nFROM #__users WHERE"."\nid = '$my->id'";
	$database->setQuery($query);

	$email = $database->loadResult();
	if (!$email)
		return false;

	$subject = $poll->subject;

	$message = stripslashes($poll->emailtext)."\n".$mosConfig_live_site."index.php?option=com_pollxt&task=activate&activation=".$key;

	$message = html_entity_decode($message, ENT_QUOTES);
	// Send email to user

	if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
		$adminName2 = $mosConfig_fromname;
		$adminEmail2 = $mosConfig_mailfrom;
	} else {
		$database->setQuery("SELECT name, email FROM #__users"."\n WHERE usertype='superadministrator'");
		$rows = $database->loadObjectList();
		$row2 = $rows[0];
		$adminName2 = $row2->name;
		$adminEmail2 = $row2->email;
	}

	mosMail($adminEmail2, $adminName2, $email, $subject, $message);

	// return the key
	return $key;
}
/*------------------------------------------------------------------------------
Shows the Poll List
------------------------------------------------------------------------------*/

function showPollList($parameters, $menu, $Itemid) {
	global $mosConfig_absolute_path, $mosConfig_live_site, $mos_config_lang;
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/components/com_pollxt/pollxt.html.php");
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

	// get the polls
	$polls = getPolls(true, false, $Itemid);

	// used to show table rows in alternating colours
	$tabclass = array ('sectiontableentry1', 'sectiontableentry2');

	// page header
	if ($parameters->def('header') <> '') {
		$polllist->header = $parameters->def('header');
	} else {
		$polllist->header = $menu->name;
	}

	// page description
	if ($parameters->def('description')) {
		$polllist->descrip = $parameters->def('description_text');
	}

	// page image
	$path = $mosConfig_live_site.$xt_imgpath;
	if ($parameters->def('image') <> -1) {
		$polllist->img = $path.$parameters->def('image');
		$polllist->align = $parameters->def('image_align');
	}
	else {$polllist->img ="";
          $polllist->align = "";
    }

	// item image
	$path = $mosConfig_live_site.$xt_imgpath;
	if ($parameters->def('itemimage') <> -1) {
		$polllist->itemimg = $path.$parameters->def('itemimage');
	} else
		$polllist->itemimg = $mosConfig_live_site."/components/com_pollxt/images/"."status_r.png";

	$path = $mosConfig_live_site.$xt_imgpath;
	if ($parameters->def('itemimagenot') <> -1) {
		$polllist->itemimgnot = $path.$parameters->def('itemimagenot');
	} else
		$polllist->itemimgnot = $mosConfig_live_site."/components/com_pollxt/images/"."status_g.png";

	poll_html :: showList($polls, $parameters, $tabclass, $polllist, $Itemid);
}
/*------------------------------------------------------------------------------
Gets the Poll List
------------------------------------------------------------------------------*/

function getPolls($cfm, $pollid, $Itemid) {
	global $my, $database, $mosConfig_lang, $mosConfig_mbf_content, $mosConfig_absolute_path;
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

// Zwei unterschiedliche Queries, weil sonst Liste nicht funktioniert!!!!
	if (!$cfm) {
		$menuquery = "\nFROM #__pollxt_menu AS pm, #__pollsxt AS p"."\nWHERE (pm.menuid='$Itemid' OR pm.menuid='0') AND "."p.id=pm.pollid \nAND ";
		if ($pollid)
			$menuquery .= "p.id='$pollid' AND ";
	} else {
		if ($pollid)
			$menuquery = "\nFROM #__pollsxt AS p WHERE p.id='$pollid'AND ";
		else
		$menuquery = "\nFROM #__pollxt_menu AS pm, #__pollsxt AS p"."\nWHERE (pm.menuid='$Itemid' OR pm.menuid='0') AND "."p.id=pm.pollid \nAND ";

//			$menuquery = "\nFROM #__pollsxt AS p WHERE ";
		//  if ($pollid) $menuquery .= "\nWHERE p.id=$pollid AND " ;
	}

	if ($cfm)
		$cfmquery = "\nAND (p.type = '2'";
	else
		$cfmquery = "\nAND (p.type = '1'";

	$cfmquery .= "\nOR p.type = '0')";

	if (!$my->id)
		$logonQuery = "AND p.logon=0";
	else
		$logonQuery = "";

	$now = date("Y-m-d");
	$nowtime = date("H:i:s");
	$query1 = "SELECT p.*".$menuquery."p.published=1"."\nAND (p.datefrom < '$now' OR p.datefrom='0000-00-00' OR (p.datefrom = '$now' AND p.timefrom <= '$nowtime') )"."\nAND (p.dateto > '$now' OR p.dateto='0000-00-00' OR (p.dateto = '$now' AND p.timeto >= '$nowtime') ) "."\n".$logonQuery.$cfmquery."\nORDER BY p.ordering";

	$database->setQuery($query1);
	$polls = $database->loadObjectList();
	if ($mosConfig_mbf_content) {
		for ($i = 0; $i < count($polls); $i ++) {
			$tpoll = & $polls[$i];
            if (!class_exists("JoomFish"))
                $tpoll = MambelFish :: translate($tpoll, 'pollsxt', $mosConfig_lang);

		}
	}

	if ($database->getErrorNum()) {
		echo "MB ".$database->stderr(true);
		return;
	}

	return $polls;
}

function sortPolls($polls, $xt_order = 0) {
	global $mosConfig_absolute_path;
	include ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

	// Random Polls
	srand((double) microtime() * 1000000);
	if ($xt_order == 2)
		shuffle($polls);
	// Only where voting allowed
	if ($xt_disp == 3) {
		$tmp = $polls;
		unset ($polls);
		$polls = array ();
		foreach ($tmp as $t) {
			if (!checkVote($t) or $t->multivote)
				array_push($polls, $t);
		}
	}
	return $polls;
}

function emailResult($poll, $voteid, $xtVal) {
	global $database, $mosConfig_fromname, $mosConfig_mailfrom, $my;

	// build the text for the results
   	$id = intval ($poll->id);
	$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$id' and inact = '0' ORDER BY id";
	$database->setQuery($query);
	$questions = $database->loadObjectList();

	$subject = "Results for Poll \"".$poll->title."\"";

	$msg = stripslashes($poll->mailrestxt)."\n";

// long version
    if ($poll->mailres == 1) {
	foreach ($questions as $q) {
       	$id = intval ($q->id);
		$msg .= "\n\n".$q->title."\n";
		$msg .= "==============================\n";
		$query = "SELECT * FROM #__pollsxt_options WHERE quid = '$id'";
		$database->setQuery($query);
		$results = $database->loadObjectList();
		foreach ($results as $result) {
			if (in_array($result->id, $voteid))
				$msg .= "[X] ";
			else
				$msg .= "[ ] ";
			$msg .= $result->qoption;
			if (isset($xtVal[$result->id]))
				$msg .= ": ".$xtVal[$result->id]."\n";
			else
				$msg .= "\n";
		}
	}
    }
	else {
// short version
    $i = 0;
    $quid="";
    foreach ($questions as $q) {
        $i++;
       	$id = intval ($q->id);
		$query = "SELECT * FROM #__pollsxt_options WHERE quid = '$id'";
		$database->setQuery($query);
		$results = $database->loadObjectList();
		foreach ($results as $result) {
			if (in_array($result->id, $voteid)) {
            if ($q->id != $quid ) {$quid = $q->id;
            if ($poll->mailres == 2) $msg .= "\n".$q->title."\n";
             else $msg .= $i.".)";
             }
            else
            $msg .= "; ";
			$msg .= $result->qoption;
			if (isset($xtVal[$result->id]))
				$msg .= ": ".$xtVal[$result->id]."\n";
			else
				$msg .= "\n";
            }
		}
	}

    }
	
    $message = html_entity_decode($msg, ENT_QUOTES);

	if ($my->id) $uname = $my->username;
	else $uname = "anonymous";

	// parse message
	$message = str_replace ("<uname>", $uname, $message);
	$message = str_replace ("<date>", date("d-m-y"), $message);
	$message = str_replace ("<polltitle>", $poll->title, $message);

	// Send email to user
	if ($mosConfig_mailfrom != "" && $mosConfig_fromname != "") {
		$adminName2 = $mosConfig_fromname;
		$adminEmail2 = $mosConfig_mailfrom;
	} else {
		$database->setQuery("SELECT name, email FROM #__users"."\n WHERE usertype='superadministrator'");
		$rows = $database->loadObjectList();
		$row2 = $rows[0];
		$adminName2 = $row2->name;
		$adminEmail2 = $row2->email;
	}

	if (!$poll->mailresrec) {
		$email = $adminEmail2;
		mosMail($adminEmail2, $adminName2, $email, $subject, $message);
		}
	else {
		$emaillist = explode(";", $poll->mailresrec);
		foreach ($emaillist as $email) {
         if (strpos($email,":")) {
            $a = strpos($email,":");
            if (in_array(substr($email, 0, $a), $voteid)) {
                $optid = substr($email, 0, $a);
                $email = strstr($email, ":");
                mosMail($adminEmail2, $adminName2, $email, $subject, $message);
            }
         }
         else mosMail($adminEmail2, $adminName2, $email, $subject, $message);
        }

    }
}

/*------------------------------------------------------------------------------
Prepare the vote form
------------------------------------------------------------------------------*/
function show_pollXT_vote_form($option, $cfm, $Itemid = 0, $pollid = 0, $params = 0) {
	global $database, $mosConfig_absolute_path, $my, $mosConfig_lang, $mosConfig_sef, $mosConfig_mbf_content, $mosConfig_live_site, $option;
	require ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/components/com_pollxt/class/pollxt.utilities.php");
	echo "<!-- PollXT version ".$com_pollxt_ver." -->";
	$Itemid = mosGetParam($_REQUEST, 'Itemid', 0);
	if (!$pollid)
		$pollid = mosGetParam($_REQUEST, 'pollid', 0);

	if (!$params) {
		$menu = & new mosMenu($database);
		$menu->load($Itemid);
		$params = & new mosParameters($menu->params);
	}

	// get parameters for module
	if (!$pollid)
		$pollid = $params->get('mod_pollid');
	if ($params->get('mod_disp'))
		$xt_disp = $params->get('mod_disp');
	if ($params->get('mod_order'))
		$xt_order = $params->get('mod_order');
	if ($params->get('mod_hide'))
		$xt_hide = $params->get('mod_hide');
	if ($xt_hide == 2)
		$xt_hide = null;
	if ($params->get('mod_selpo'))
		$xt_selpo = $params->get('mod_selpo');
	if ($xt_selpo == 2)
		$xt_selpo = "";
	if ($params->get('mod_imgvote'))
		$xt_imgvote = $params->get('mod_imgvote');
	if ($params->get('mod_imgresult'))
		$xt_imgresult = $params->get('mod_imgresult');

	// page header
	if ($params->def('header') <> '') {
		$page->header = $params->def('header');
	} else {
		if (isset ($menu))
			$page->header = $menu->name;
	}

	$sfx = $params->def( 'pageclass_sfx' );


	$polls = getPolls($cfm, $pollid, $Itemid);
	$polls = sortPolls($polls, $xt_order);
	//Parameter for new windows
	$xthtml->imgpar = "resizable=yes,"."scrollbars=yes,"."location=no,"."menubar=no,"."status=no,"."toolbar=no,"."width=640,"."height=480";

	// no polls to display
	if (!$polls) {
		pollXT_no_polls($cfm, $xt_rdisp, $Itemid, $xthtml, $xt_imgresult, $option);
		return;
	}

	global $XTSelCount;
	$XTSelCount ++;

	// Create select-box
    $querystring = "";
	unset($_GET["pollid"]);
	foreach ($_GET as $k=>$v) $querystring .= $k."=".$v."&";
    $action = xtSefRelToAbs("index.php?".$querystring);

	$spolls = getPolls($cfm, false, $Itemid);
	$xthtml->pollist = "";
	if (($xt_selpo) and (count($spolls) > 1)) {
		$pollist = "<form name=\"pollxt$XTSelCount\" method=\"post\" action=\"$action\">";
		$pollist .= "\n<select name=\"id\" class=\"inputbox\" size=\"1\"
        onChange=\"document.forms.pollxt$XTSelCount.pollid.value=this.options[selectedIndex].value;
        if (this.options[selectedIndex].value != '') {document.forms.pollxt$XTSelCount.submit()}\">";
		$pollist .= "\n\t<option value=\"\">"._SELECT_POLL."</option>";
		for ($i = 0, $n = count($spolls); $i < $n; $i ++) {
			$k = $spolls[$i]->id;
			$t = $spolls[$i]->title;
			$sel = ($k == intval($pollid) ? " selected=\"selected\"" : '');
			$pollist .= "\n\t<option value=\"".$k."\"$sel>".$t."</option>";
		}
		$pollist .= "\n</select>\n";
		$pollist .= "<input type=hidden name='pollid' value = ''></form>";

		$xthtml->pollist = $pollist;
	}
	if ($xt_disp == 2) {
		if ($pollid) {
			$i = 0;
			foreach ($polls as $poll) {
				if ($pollid == $poll->id)
					$hit = $i;
				$i ++;
			}
			$polls = array_splice($polls, $hit, count($polls));
			if ($hit < count($polls) and $hit > 0)
				$polls = array_splice($polls, 0, -1);
			else
				$polls = array_splice($polls, 0);
		}
	}
	reset($polls);

	// Now start... For each Poll
	$rc = 0;
	foreach ($polls as $poll) {
		if ($poll->id) {
			$i = 0;
           	$id = intval ($poll->id);
			$query = "SELECT * FROM #__pollsxt_questions"
            ."\nWHERE pollid='$id' AND inact = '0' ";
			$database->setQuery($query);
			$q = $database->loadObjectList();

			// For each question
			foreach ($q as $p) {
				if ($mosConfig_mbf_content) {
//					$p = JoomFish :: translate($p, 'pollsxt_questions', $mosConfig_lang);
				}

				$questions[$i][0] = $p->id;
				$questions[$i][1] = $p->pollid;
				$questions[$i][2] = stripslashes($p->title);
				$questions[$i][3] = $p->type;
				$questions[$i]['img_url'] = $p->img_url;
				$questions[$i]['imgor'] = $p->imgor;
				$questions[$i]['imgsize'] = $p->imgsize;
				$questions[$i]['imglink'] = $p->imglink;
				$questions[$i]['multisize'] = $p->multisize;
				$questions[$i]['obli'] = $p->obli;
				$i ++;
			}
			for ($i = 0, $n = count($questions); $i < $n; $i ++) {
				$quid = $questions[$i][0];
              	$id = intval ($quid);
				$query = "SELECT * FROM #__pollsxt_options"."\nWHERE quid='$id' AND inact = '0' ORDER BY id";
				$database->setQuery($query);
				$o = $database->loadObjectList();
				$j = 0;
				foreach ($o as $p) {
					if ($mosConfig_mbf_content) {
                      if (!class_exists("JoomFish"))
						$p = MambelFish :: translate($p, 'pollsxt_options', $mosConfig_lang);
					}

					$options[$i][$j][0] = $p->id;
					$options[$i][$j][1] = $p->quid;
					$options[$i][$j][2] = stripslashes($p->qoption);
					$options[$i][$j]['img_url'] = $p->img_url;
					$options[$i][$j]['imgor'] = $p->imgor;
					$options[$i][$j]['imgsize'] = $p->imgsize;
					$options[$i][$j]['imglink'] = $p->imglink;
					$options[$i][$j]['freetext'] = $p->freetext;
					$options[$i][$j]['multirows'] = $p->multirows;
					$options[$i][$j]['multicols'] = $p->multicols;
					if ($p->multirows =="") $p->multirows = "1";
					if ($p->multicols =="") $p->multicols = "10";
					$j ++;
				}
			}

			//create the form
			$rd = "";
			$onsubmit = "";
			$name = "formXT".$poll->id;
			if ($cfm) $name .= "com";

			if ($poll->rdisp == 2 && $poll->goto == 0) {				
			 	$rd = '2';
				$win = "'about:blank','_results', '".$xthtml->imgpar."'";
				$onsubmit = "javascript:window.open(".$win.");return true;";
			}

			$action = xtSefRelToAbs("index".$rd.".php?option=com_pollxt&Itemid=".$Itemid);

			$xthtml->form = "<form name=\"".$name."\" method=\"post\" action=\"".$action."\"";
			if ($onsubmit)
				$xthtml->form .= " onSubmit = \"".$onsubmit."\"";
			$xthtml->form .= ">";

			// Main table
			$xtwidth = $params->get('modulewidth');
			if (!$xtwidth)
				$xtwidth = "100%";
			$xthtml->maintable = "<table width=\"".$xtwidth."\" border=\"0\" cellspacing=\"0\" >";


			// Image for Poll
			$xthtml->pollimg = "";
			if (!empty ($poll->img_url)) {
				$src = xtSefRelToAbs($xt_imgpath.$poll->img_url);
				if ($poll->imglink == 1) {
					$onkeypress = "window.open('".$src."','Pic', '".$xthtml->imgpar."')";
					$xthtml->pollimg = "<a style=\"cursor:pointer\" onkeypress=\"".$onkeypress."\""." onclick   =\"".$onkeypress."\" >";
				}
				$xthtml->pollimg .= "<img border = \"0\" ".$poll->imgor."=\"".$poll->imgsize."\" "."src=\"".$src."\" />";
				if ($poll->imglink == 1)
					$xthtml->pollimg .= "</a>";
			}

			// Link for results
			$link = $href = "index.php?option=com_pollxt";
			if (!$cfm && $poll->rdisp == 3)
				$href = "index.php?".$_SERVER['QUERY_STRING'];

			if ($cfm && $poll->rdisp == 3)
				$poll->rdisp = 1;

			switch ($poll->rdisp) {
				case '1' :
					$xthtml->rlink = "document.location.href='".xtSefRelToAbs($href."&task=results&amp;id=".$poll->id."&Itemid=".$Itemid)."'";
					break;
				case '2' :
					$xthtml->rlink = "window.open('".xtSefRelToAbs("index2.php?option=com_pollxt&task=results&isPopup=1&Itemid=".$Itemid."&id=".$poll->id)."', '_results', '$xthtml->imgpar')";
					break;
				case '3' :
					$xthtml->rlink = "document.location.href='".xtSefRelToAbs($href."&xt_resultsId=".$poll->id."&Itemid=".$Itemid)."'";
					break;
			}

			// Voting & Results Button
			$imgvote = $xt_imgpath.$xt_imgvote;
			$imgresult = $xt_imgpath.$xt_imgresult;
            if ($cfm) $com = "com"; else $com = "";
            
			switch($xt_btnstyle) {
			case "1": // background image
			$xthtml->votebutton = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">"._BUTTON_VOTE."</label>"."<button style=\"background-image:url('".$mosConfig_live_site.$imgvote."')\" type=\"button\" name=\"task_button\" "."id=\"task_button\" class=\"button\" value=\""._BUTTON_VOTE."\" onclick=\"refresh".$poll->id.$com."()\" >"._BUTTON_VOTE."</button>";
			$xthtml->resultbutton = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">"._BUTTON_RESULTS."</label>"."<button style=\"background:url('".$mosConfig_live_site.$imgresult."')\" type=\"button\" name=\"task_button\" "."id=\"task_button\" class=\"button\" value=\""._BUTTON_RESULTS."\""." onclick=\"".$xthtml->rlink."\" >"._BUTTON_RESULTS."</button>";
			break;

			case "2": //individual
			$xthtml->votebutton = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">"._BUTTON_VOTE."</label>"."<div name=\"task_button\" "."id=\"pollxtButton\" class=\"pollxtVote\" value=\""._BUTTON_VOTE."\" onclick=\"refresh".$poll->id.$com."()\" >"._BUTTON_VOTE."</div>";
				$xthtml->resultbutton = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">"._BUTTON_RESULTS."</label>"."<div name=\"task_button\" "."id=\"pollxtButton\" class=\"pollxtResult\" value=\""._BUTTON_RESULTS."\""." onclick=\"".$xthtml->rlink."\" >"._BUTTON_RESULTS."</div>";
			break;
			default:  // STANDARD Buttons (with/ without image)
			if ($xt_imgvote != -1 && $xt_imgvote)
				$xthtml->votebutton = "<a name=\"vote\" /><a href=\"#vote\">"."<img border=\"0\" alt=\""._BUTTON_VOTE."\""."src=\"".$mosConfig_live_site.$imgvote."\" "."onclick=\"refresh".$poll->id.$com."();\" />"."</a>";
			else
				$xthtml->votebutton = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">"._BUTTON_VOTE."</label>"."<button type=\"button\" name=\"task_button\" "."id=\"task_button\" class=\"button\" value=\""._BUTTON_VOTE."\" onclick=\"refresh".$poll->id.$com."()\" >"._BUTTON_VOTE."</button>";
			if ($xt_imgresult != -1 && $xt_imgresult)
				$xthtml->resultbutton = "<a style=\"cursor:pointer\" >"."<img border=\"0\" alt=\""._BUTTON_RESULTS."\" "."src=\"".$mosConfig_live_site.$imgresult."\" "."onclick=\"".$xthtml->rlink."\" >"."</a>";
			else
				$xthtml->resultbutton = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">"._BUTTON_RESULTS."</label>"."<button type=\"button\" name=\"task_button\" "."id=\"task_button\" class=\"button\" value=\""._BUTTON_RESULTS."\""." onclick=\"".$xthtml->rlink."\" >"._BUTTON_RESULTS."</button>";
			break;
			}
			
			$qc = 0;
			// build the questions
			foreach ($questions as $q) {
			// if it's a separator 			 
				if ($q[3] == "5" ) {
					$xthml->question[$qc] = "<div class=\"pollseparator".$sfx."\">".$q[2]."</div>";
				}
				else {
					$xthtml->question[$qc]  = "<div class=\"sectiontableheader".$sfx."\">";
       				if ($q['obli']) $xthtml->question[$qc] .=  "<font color=\"red\">!</font>";
       				$xthtml->question[$qc] .= $q[2]."</div>";

					if (!empty($q['img_url'])) { 
					$xthtml->question[$qc]  .= createImg($q['imglink'], $q['img_url'], $q['imgor'], $q['imgsize'], $sfx, $xt_imgpath, "sectiontableheader", $xthtml->imgpar);
					}
				
					$qhelper = new xtUtil($q, $qc);
					$qhelper->imgpath = $xt_imgpath;
					$qhelper->sfx = $sfx;
					$qhelper->imgpar = $xthtml->imgpar;
					$xthtml->options[$qc] = $qhelper->getOptions($options[$qc]);
				}
			$qc++;
			
			}
			
			// Navigation buttons
			$xthtml->navBack = "";
			$xthtml->navNext = "";

			if ($params->def('pollNav') <> '') {
				$navPolls = getPolls($cfm, false, $Itemid);
				$navPolls = sortPolls($navPolls);
				$pollcount = 0;

				foreach ($navPolls as $p) {
					if (($p->id == $pollid)) {
						if ($pollcount > 0) {
							$prevPoll = $navPolls[$pollcount -1];
							$xthtml->navBack = "<a href=\"index.php?option=com_pollxt&amp;pollid=".$prevPoll->id."&task=voting&Itemid=".$Itemid."\">[ "._CMN_PREV_ARROW._CMN_PREV." ]</a>";

						}
						if ($pollcount < (count($navPolls) - 1)) {
							$nextPoll = $navPolls[$pollcount +1];
							$xthtml->navNext = "<a href=\"index.php?option=com_pollxt&amp;pollid=".$nextPoll->id."&task=voting&Itemid=".$Itemid."\">[ "._CMN_NEXT._CMN_NEXT_ARROW." ]</a>";

						}

					}
					$pollcount ++;
				}
			}
			if (!isset ($page))
				$page = null;
			pollXT_vote_form_html($name, $poll, $questions, $options, $Itemid, $xt_hide, $option, $cfm, $xthtml, $page, $params);
			unset ($questions, $options);
			if ($xt_disp == 2)
				break;
		}
	}

}
/*------------------------------------------------------------------------------
No polls available
------------------------------------------------------------------------------*/
function pollXT_no_polls($cfm, $rdisp, $Itemid, $xthtml, $xt_imgresult, $option) {
	global $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_lang, $mosConfig_sef;
	// Get the right language if it exists
	if (file_exists($mosConfig_absolute_path.'/components/com_pollxt/languages/'.$mosConfig_lang.'.php')) {
		include_once ('components/com_pollxt/languages/'.$mosConfig_lang.'.php');
	} else {
		include_once ('components/com_pollxt/languages/english.php');
	}
include ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");
			// Link for results
			$link = $href = "index.php?option=com_pollxt";
			if (!$cfm && $rdisp == 3)
				$href = "index.php?option=".$option;
   			if ($cfm && $rdisp == 3)
				$rdisp = 1;

			switch ($rdisp) {
				case '1' :
					$rlink = "document.location.href='".xtSefRelToAbs($href."&task=results&id=0&Itemid=".$Itemid)."'";
					break;
				case '2' :
					$rlink = "window.open('".xtSefRelToAbs("index2.php?option=com_pollxt&task=results&isPopup=1")."', '_results', '$xthtml->imgpar')";
					break;
				case '3' :
					$rlink = "document.location.href='".xtSefRelToAbs($href."&Itemid=".$Itemid."&xt_resultsId=1")."'";
					break;
			}

			// Voting & Results Button
			$imgresult = xtSefRelToAbs($xt_imgpath.$xt_imgresult);
            if ($cfm) $com = "com"; else $com = "";

			if ($xt_imgresult != -1 && $xt_imgresult)
				$xthtml->resultbutton = "<a href=\"\">"."<img border=\"0\" alt=\""._BUTTON_RESULTS."\""."src=\"".$imgresult."\""."onclick=\"".$rlink."\" />"."</a>";
			else
				$xthtml->resultbutton = "<label for=\"task_button\" "."style=\"visibility:hidden; display:none;\">"._BUTTON_RESULTS."</label>"."<button type=\"button\" name=\"task_button\" "."id=\"task_button\" class=\"button\" value=\""._BUTTON_RESULTS."\""."onclick=\"".$rlink."\" />"._BUTTON_RESULTS."</button>";

	$rlink = "window.open('".$mosConfig_live_site."index2.php?option=com_pollxt&task=results&id=1', '_results', 'location=no, menubar=no, status=no, toolbar=no, width=640, height=480' )";
?>
<table><tr><td><?php echo _POLLXT_NO_POLLS ?></td></tr>
<tr><td>
<?php echo $xthtml->resultbutton; ?>
</td></tr></table>

<?php


}
/*------------------------------------------------------------------------------
Builds the vote form - shouldn't be here
------------------------------------------------------------------------------*/
function pollXT_vote_form_html($name, & $poll, & $questions, & $options, & $Itemid, $xt_hide, $option, $cfm, $xthtml, $page = 0, $params = 0) {
	global $mosConfig_live_site, $mosConfig_absolute_path, $my, $mosConfig_lang, $mainframe;

    $i = 0;
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");
	if (file_exists($GLOBALS['mosConfig_absolute_path'] . '/components/com_pollxt/languages/'.$mosConfig_lang.'.php')) {
		include_once($GLOBALS['mosConfig_absolute_path'] . '/components/com_pollxt/languages/'.$mosConfig_lang.'.php');
	} else {
		include_once ($GLOBALS['mosConfig_absolute_path'] . '/components/com_pollxt/languages/english.php');
	}
	include ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");
	$sfx = $params->def( 'pageclass_sfx' );
	$tabclass_arr = array ("sectiontableentry2".$sfx, "sectiontableentry1".$sfx);
	$tabcnt = 0;
	$voted = checkVote($poll);
// problem with non-Latin-1 Codepages in IE, solved by adding UTF-8

?>



<script type="text/javascript" src="components/com_pollxt/script/pollxt.js" charset="UTF-8">
</script>

	<script type="text/javascript" >




	function refresh_cb<?php echo $poll->id; if ($cfm) echo "com"; ?> (new_data) {
    document.getElementById("checkmsg<?php echo $poll->id; if ($cfm) echo 'com'; ?>").innerHTML
= new_data;
    document.getElementById("checkmsg<?php echo $poll->id; if ($cfm) echo 'com'; ?>").style.display="block";

    if (new_data.match("success") != null) {
 	<?php if ($poll->rdisp == 2 && $poll->goto == 0) { ?>
         window.open('about:blank','_results', '<?php echo $xthtml->imgpar; ?>');
      <?php } ?>
        document.forms["<?php echo $name ?>"].submit();
    }
	}

	function refresh<?php echo $poll->id; if ($cfm) echo "com"; ?>() {

        var polldata ="";
        pollform = document.formXT<?php echo $poll->id; if ($cfm) echo "com"; ?>;
        len = pollform.length;
        for (var i = 0; i < len; i++) {
        el = pollform.elements[i];
         if ((el.type == "radio" || el.type == "checkbox" )&& el.checked == true ) {
         polldata = polldata  + el.name + "=" + el.value + String.fromCharCode(38);      }

          if (el.type == "select-one" || el.type == "select-multiple") {
            for (var j = 0; j < el.options.length; j++ ) {

             if (el.options[j].selected == true) {
                polldata = polldata  + el.name + "=" + el.value + String.fromCharCode(38);
                  }
            }
         }
        if ((el.type == "input" || el.type == "hidden") && el.value != '' ) {
         polldata = polldata  + el.name + "=" + el.value + String.fromCharCode(38);      }
        }

<?php $serverurl= "index.php?option=com_pollxt&amp;Itemid=".@$_GET['Itemid']."&amp;pollxtvalidate=".$poll->id; ?>
        var serverurl = '<?php echo $serverurl ?>';
        while (serverurl.search(/&amp;/)!= -1) serverurl = serverurl.replace(/&amp;/, String.fromCharCode(38));
        call_server(serverurl, refresh_cb<?php echo $poll->id; if ($cfm) echo "com"; ?>, polldata);


}
	</script>



<?php
	// for xhtml compliance
	$mainframe->addCustomHeadTag('<link rel="stylesheet" href="components/com_pollxt/poll_bars.css" type="text/css" />');
	
	echo $xthtml->pollist;
?>
<?php echo $xthtml->form; ?>

<input type="hidden" name="id" value="<?php echo $poll->id;?>" />
<input type="hidden" name="task" value="vote" />
<input type="hidden" name="redir" value="<?php if($_SERVER['QUERY_STRING']) echo $_SERVER['QUERY_STRING'];?>" />
<?php if (!$cfm) {?>
<input type="hidden" name="cfm" value="1" />
<?php } ?>
<?php
if (($params->get('page_title')) && $cfm) {
?>
  <div class="componentheading<?php echo $sfx; ?>">
  <?php echo $page->header; ?>
  </div>
 <?php		}		?>

<?php if (!$poll->hidetitle) { ?> 
    <div id="pollxtTitle" class="componentheading<?php echo $sfx; ?>"><b>
    <a href="javascript:switchonoff(<?php echo "'".$name."'"; ?>)">
    <?php echo $poll->title; ?>
                 </a></b></div>
    <div id="pollxtImg">
    <?php echo $xthtml->pollimg; ?>
    </div>
 <?php } ?>

<?php if ($poll->intro) { ?> 
<div id="pollxtIntro">
  <?php echo stripslashes($poll->intro) ?>
</div>
<?php } ?>

 
  <div id="poll<?php echo $name ?>" <?php if ($xt_hide==1) echo "style=\"display:none;\"";?> style="height: 188px; ">
	<?php $qc= 0;
		foreach ($xthtml->question as $q) { echo $q; echo $xthtml->options[$qc]; $qc++;} ?>

	  <div id="pollxtButtons">
                  <?php


									if ((!$voted) or ($poll->multivote)) {
										echo "<div align='center'>".$xthtml->votebutton."</div>";
									}
									if (($poll->rdispb == 1) or ($voted and $poll->rdispb == 2) or ($my->usertype == "Super Administrator")) {
										//echo $xthtml->resultbutton;
										echo "<br /><div align='center' style=\"cursor: pointer;\" onclick=\"window.open('http://desarrollo.datapartner.cl/movistar/index2.php?option=com_pollxt&task=results&isPopup=1&Itemid=107&id=1', '_results', 'resizable=no,scrollbars=no,location=no,menubar=no,status=no,toolbar=no,width=617,height=340')\">Ver resultados</div>";
									}
?>
		</div>
	</div>
	<div class ="xtmessage<?php echo $sfx; ?>" id="checkmsg<?php echo $poll->id; if ($cfm) echo 'com'; ?>"></div>

<?php if ($params->def( 'pollExp' )=="1" && $poll->dateto != '0000-00-00') {		?>
        <tr><td colspan="3" align="center" class='smalldark<?php echo $params->def( 'pageclass_sfx' ); ?>'>
     <?php echo _POLLXT_VOTING_UNTIL.mosFormatDate($poll->dateto." ".$poll->timeto, _DATE_FORMAT_LC2); ?> </td>
<?php } ?>    
               
<?php


									// displays back button
if ($cfm && (($xthtml->navBack != "") || ($xthtml->navNext != "") )) {
    echo "<br />";
    echo "<center>";
    echo $xthtml->navBack;
    echo $xthtml->navNext;
    echo "</center>";
}
?>


<?php if ($poll->rdisp == 2 && $poll->goto == 0) 
echo "<script language=\"javascript\" type=\"text/javascript\"> 
document.forms[\"".$name."\"].target='_results';
</script>"; ?>
</form>

<?php

									if ($cfm) {
										mosHTML :: BackButton($params);
									}


}



								/*------------------------------------------------------------------------------
								Class for often used HTML expressions
								------------------------------------------------------------------------------*/
								class XT_HTML {

									// creates a close/continue button, depending on where we are
									function closeButton($poll, $voteid) {
										$sfx = $params->def( 'pageclass_sfx' );
										if ($poll->rdisp != 2) 
							                return "<input class=\"button".$sfx."\" type=\"button\" value=\""._POLLXT_CONTINUE."\" onClick=\"window.history.go(-1);\">"; 
										 else 
                							return "<input class=\"button".$sfx."\" type=\"button\" value=\""._POLLXT_CLOSE."\" onClick=\"window.close();\">"; }
										

								
									

								}
								
?>











