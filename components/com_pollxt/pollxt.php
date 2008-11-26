<?php
/**
* PollXT for Mambo Open Source 4.5.2
* @Copyright (C) 2004 - 2005 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.mamboxt.com
* @version 1.20
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once( $mainframe->getPath( 'front_html' ) );
require_once( $mainframe->getPath( 'class' ) );
require_once($mosConfig_absolute_path."/administrator/components/com_pollxt/pollxt.inc.php");

global $mosConfig_lang;

// Get the right language if it exists
if (file_exists($mosConfig_absolute_path.'/components/com_pollxt/languages/'.$mosConfig_lang.'.php')) {
 include_once($mosConfig_absolute_path.'/components/com_pollxt/languages/'.$mosConfig_lang.'.php');
 } else {
   include_once($mosConfig_absolute_path.'/components/com_pollxt/languages/english.php');
 }
if(@$_GET['pollxtvalidate'] != '')	{
	validate(@$_GET['pollxtvalidate']);
}

$tabclass = "sectiontableentry2,sectiontableentry1";

$poll = new mosPoll( $database );

$id = mosGetParam( $_REQUEST, 'id', 0 );
$cfm = mosGetParam( $_REQUEST, 'cfm', 0 );
$Itemid = mosGetParam( $_REQUEST, 'Itemid', 0 );
$task = mosGetParam( $_REQUEST, 'task', '' );
$option = mosGetParam( $_SERVER, 'QUERY_STRING', 0 );
$option = str_replace ("option=", "", $option);

$activation = mosGetParam( $_REQUEST, 'activation', 0 );

$menu =& new mosMenu( $database );
$menu->load( $Itemid );
$params =& new mosParameters( $menu->params );
$xt_pollid = $params->def("xt_pollid");

if (!$task) {
  if ($params->def("xt_task"))
    $task = "list";
  }

switch ($task) {

        case "vote":
                pollAddVote( $id, $option, $cfm, $Itemid );
                break;
        case "detail":
                pollDetail( $id, $params, $menu );
                break;
        case "results":
                pollresult( $id, false, $Itemid );
                break;
        case "voting":
                pollVoting($option, $xt_pollid, $Itemid);
                break;
        case "activate":
                pollActivate($activation);
                break;
        case "list":
                showPollList($params, $menu, $Itemid);
                break;
        default:
                pollVoting($option, $xt_pollid, $Itemid);
                break;
}


function pollVoting($option, $id, $Itemid)
 {

show_pollXT_vote_form($option, true, $Itemid, $id);
 }

function pollActivate ($mailkey) {
global $database;

// Check if key exists (and not already unblocked)
$query = "SELECT id FROM #__pollxt_data "
        ."\nWHERE mailkey = '$mailkey' "
        ."\nAND block = 1";
$database->setQuery($query);
$id = $database->loadResult();

// key ist o.k., unblock
if ($id)
 {
$query = "UPDATE #__pollxt_data SET block = 0 "
        ."\nWHERE id = '$id'";
$database->setQuery($query);
$database->query();
$mosmsg = _POLLXT_ACTIVATE;
mosRedirect( xtSefRelToAbs("index.php"), "".stripslashes($mosmsg)."");
 }
else
{
$mosmsg = _POLLXT_NOT_ACTIVATED;
mosRedirect( xtSefRelToAbs("index.php"), "".stripslashes($mosmsg)."");
}
}
function validate($uid) {
	global $database, $mosConfig_offset, $my, $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_lang;
	require_once ($mosConfig_absolute_path."/administrator/components/com_pollxt/conf.pollxt.php");

	// Get the right language if it exists
	if (file_exists($mosConfig_absolute_path.'/components/com_pollxt/languages/'.$mosConfig_lang.'.php')) {
		include_once ($mosConfig_absolute_path.'/components/com_pollxt/languages/'.$mosConfig_lang.'.php');
	} else {
		include_once ($mosConfig_absolute_path.'/components/com_pollxt/languages/english.php');
	}




	// get cookies
//	$sessioncookie = mosGetParam($_REQUEST, 'sessioncookie', '');
	// get IP
	$ip = getenv("REMOTE_ADDR");

	// get the selection
	$voteArray = mosGetParam($_POST, 'voteid', 0);
	$xtVal = mosGetParam($_POST, 'xtVal', 0);
	$poll = new mosPoll($database);

	// Poll exists (vivible for user)?
	if (!$poll->load($uid)) {
        echo _NOT_AUTH;
        die();
	}

	// Cookies not enabled
//	if ((!$sessioncookie) and $xt_seccookie) {
//		echo _ALERT_ENABLED;
//		die();
//	}

	// already voted?
	$voted = checkVote($poll);
	if (!$poll->multivote == 1) {
		if ($voted) {
			echo _ALREADY_VOTE;
			die();
		}
	}

	// something selected?
	if (!$voteArray) {
		echo _NO_SELECTION;
		die();
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

	$query = "SELECT * FROM #__pollsxt_questions WHERE pollid = '$poll->id' and obli = '1' and inact = '0' and type <> '5'";
	$database->setQuery($query);
	$questions = $database->loadObjectList();
    $obligatory = "";
	foreach ($questions as $q) {
		$found = false;
		foreach ($voteid as $v) {
			$query = "SELECT * FROM #__pollsxt_options WHERE id = '$v' AND quid = '$q->id'";
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
//		echo XT_HTML :: closeButton($poll, $voteid);
		die();
	}
echo "success";
die();
}
?>
