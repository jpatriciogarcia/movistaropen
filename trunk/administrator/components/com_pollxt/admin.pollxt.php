<?php

/**
* PollXT for Joomla!
* @Copyright (C) 2004 - 2006 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 1.22
**/

// ensure this file is being included by a parent file
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');

set_magic_quotes_runtime(1);


// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_pollxt' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

if (!function_exists('josGetArrayInts')) {
  function josGetArrayInts( $name, $type=NULL ) {
    if ( $type == NULL ) {
        $type = $_POST;
    }

    $array = mosGetParam( $type, $name, array(0) );

    mosArrayToInts( $array );

    if (!is_array( $array )) {
        $array = array(0);
    }

    return $array;
 }
}

require_once ($mainframe->getPath('admin_html'));
require_once ($mainframe->getPath('class'));
require_once ($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_pollxt/xtupgrader.class.php');
//$task = mosGetParam( $_REQUEST, 'task', array(0) );
// $cid	= mosGetParam( $_REQUEST, 'cid', array(0) );

$cid = josGetArrayInts( 'cid' );

$mypoll = mosGetParam( $_REQUEST, 'mypoll', 0 );
$config = mosGetParam( $_REQUEST, 'config', 0 );
$pollquestion = mosGetParam( $_REQUEST, 'pollquestion', 0 );
$polloption = mosGetParam( $_REQUEST, 'polloption', 0 );
$selections = mosGetParam( $_REQUEST, 'selections', 0 );
$quid = mosGetParam( $_REQUEST, 'quid', 0 );
$pollid = mosGetParam( $_REQUEST, 'pollid', 0 );
$id = mosGetParam( $_REQUEST, 'id', 0 );


if (!isset($pollquestion)) $pollquestion = array();
if (!isset($polloption)) $polloption = array();
switch ($task) {
	case "info" :
		print_info();
		break;

	case "settings" :
		edit_settings($option);
		break;

	case "saveSettings" :
		save_settings($option, $config);
		break;

	case "new" :
		editPoll(0, $option);
		break;

	case "addPoll" :
		editPoll(0, $option);
		break;

	case "edit" :
		editPoll( intval( $cid[0] ), $option);
		break;
	case 'editA':
		editPoll( $id, $option );
		break;

	case "save" :
		savePoll($mypoll, $pollquestion, $polloption, $selections, $option, 'save');
		break;
	case "apply" :
		savePoll($mypoll, $pollquestion, $polloption, $selections, $option, 'apply');

		break;

	case "remove" :
		removePoll($cid, $option);
		break;

	case "publish" :
		publishPolls($cid, 1, $option);
		break;

	case "unpublish" :
		publishPolls($cid, 0, $option);
		break;

	case "cancel" :
		cancelPoll($option, $pollid);
		break;
	case "addOption" :
		addOption($mypoll, $pollquestion, $polloption, $quid, $pollid, $option);
		break;

	case "addQuestion" :
		addQuestion($mypoll, $pollquestion, $polloption, $pollid, $option);
		break;

	case "copyQuestion" :
		copyQuestion($mypoll, $pollquestion, $polloption, $quid, $pollid, $option);
		break;

	case "orderup" :
		orderMenu($cid[0], -1, $option);
		break;

	case "orderdown" :
		orderMenu($cid[0], 1, $option);
		break;

	case "clear" :
		deletePollData($cid[0], $option);
		break;

	case "copy" :
		copyPoll($cid[0], $option);
		break;
	case "import" :
		showMamboPolls($option);
		break;
	case "doimport" :
		importMamboPolls($cid, $option);
		break;
	case "show" :
		showPolls($option);
		break;
	case "checkUpdate" :
		checkUpdate($option);
		break;
	case "doupdate" :
		update($cid, $option);
		break;
    case "exportList" :
        exportList($option);
        break;
	case "doexport" :
		doexport($option, $cid[0]);
		break;
	default :
		showCPanel($option);
		break;
}

function showPolls($option) {
	global $mosConfig_list_limit, $database, $mainframe;

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( $GLOBALS['mosConfig_absolute_path'].'/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$database->setQuery("SELECT m.*, u.name AS editor,"."\n        COUNT(d.id) AS numoptions"."\nFROM #__pollsxt AS m"."\nLEFT JOIN #__users AS u ON u.id = m.checked_out"."\nLEFT JOIN #__pollsxt_questions AS d ON d.pollid = m.id AND d.title <> ''"."\nGROUP BY m.id"."\nORDER BY m.ordering"."\nLIMIT $pageNav->limitstart, $pageNav->limit");
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		print $database->stderr();
		return false;
	}

	HTML_poll :: showPolls($rows, $pageNav, $option);
}
function copyPoll($uid = 0, $option) {

	editPoll($uid, $option, 1);

}

function editPoll($uid = 0, $option, $copy = 0) {

	global $database, $my;
	$row = new mosPoll($database);
	// load the row from the db table
	$row->load($uid);
    if ($uid == 0) $questions = array();
	$row_arr = get_object_vars($row);
	$row_arr = stripMQ($row_arr);
	// defaults
	if (!$row->imgor)
		$row_arr['imgor'] = "width";
	else
		$row_arr['imgor'] = $row->imgor;
	if (!$row->imgsize)
		$row_arr['imgsize'] = "100";
	else
		$row_arr['imgsize'] = $row->imgsize;
	if ($copy) {

		$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
		$total = $database->loadResult();

		$row_arr['id'] = 0;
		$row_arr['title'] = "Copy of ".$row_arr['title'];
		$row_arr['ordering'] = $total +1;
	}

	// fail if checked out not by 'me'
	if ($row->checked_out && $row->checked_out <> $my->id) {
		mosRedirect("index2.php?option=$option&task=show", 'The poll $row->title is currently being edited by another administrator.');
	}

	$options = array ();

	if ($uid) {
		if (!$copy)
			$row->checkout($my->id);
		$query = "SELECT * FROM #__pollsxt_questions"."\nWHERE pollid='$uid' ORDER BY id";
		$database->setQuery($query);
		$q = $database->loadObjectList();
		$i = 0;
		foreach ($q as $p) {
			$questions[$i] = get_object_vars($p);
			$questions[$i] = stripMQ($questions[$i]);
			//defaults
			if (!$p->imgor)
				$questions[$i]['imgor'] = "width";
			else
				$questions[$i]['imgor'] = $p->imgor;
			if (!$p->imgsize)
				$questions[$i]['imgsize'] = "100";
			else
				$questions[$i]['imgsize'] = $p->imgsize;

			$i ++;
		}
		if (isset($questions)) {
		for ($i = 0, $n = count($questions); $i < $n; $i ++) {
			$quid = $questions[$i]['id'];
			$query = "SELECT * FROM #__pollsxt_options"."\nWHERE quid='$quid' ORDER BY id";
			$database->setQuery($query);
			$o = $database->loadObjectList();
			$j = 0;
			foreach ($o as $p) {
				$options[$i][$j] = get_object_vars($p);
				$options[$i][$j] = stripMQ($options[$i][$j]);
				//defalts
				if (!$p->imgor)
					$options[$i][$j]['imgor'] = "width";
				else
					$options[$i][$j]['imgor'] = $p->imgor;
				if (!$p->imgsize)
					$options[$i][$j]['imgsize'] = "100";
				else
					$options[$i][$j]['imgsize'] = $p->imgsize;
				if (!$p->multirows)
					$options[$i][$j]['multirows'] = "1";
				if (!$p->multicols)
					$options[$i][$j]['multicols'] = "10";

				$j ++;

			}

		}

	}
	} else {
		$row_arr['lag'] = 3600 * 24;

    }

       
	show_editPoll($row_arr, $questions, $options, getMenu($row->id), $option, "1");
}

function savePoll($mypoll, $questions, $options, $selections, $option, $task) {
	global $database, $my;

	// save the poll parent information
	$row = new mosPoll($database);
	$qdb = new mosPollQuestion($database);
	$odb = new mosPollOptions($database);
    $pdb = new mosPollPage($database);
    
	if (!$row->bind($mypoll)) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}
	$isNew = ($row->id == 0);

	if (!$row->check()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}

	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}
	$row->checkin();

	$row->updateOrder('id > 0');

    $i = 1;
    
//    delete deleted items
		$database->setQuery("SELECT id FROM #__pollsxt_questions WHERE pollid = '$row->id' AND kz='D'");
        $q = $database->loadObjectList();
        foreach($q as $qid) {
            $database->setQuery("DELETE FROM #__pollsxt_options WHERE quid = '$qid->id' ");
            $database->query();
        }
		$database->setQuery("DELETE FROM #__pollsxt_questions WHERE pollid = '$row->id' AND kz='D'");
		$database->query();
        $database->setQuery("DELETE FROM #__pollxt_page WHERE pollid = '$row->id' AND kz='D'");
		$database->query();


	// save the poll options

	$i = 0;
	foreach ($questions as $question) {
		if (!$qdb->bind($question)) {
			echo "<script> alert('".$qdb->getError()."'); window.history.go(-1); </script>\n";
			exit ();
		}

		$qdb->pollid = $row->id;

		if (empty ($qdb->title) and $qdb->img_url == "" and is_numeric($qdb->id)) {
			$database->setQuery("DELETE FROM #__pollsxt_questions where id='$qdb->id'");
			$database->query();
			$database->setQuery("DELETE FROM #__pollsxt_options where quid='$qdb->id'");
			$database->query();

		} else {

			// 'slash' the options
			if (!get_magic_quotes_gpc()) {
//				$qdb->title = addslashes($qdb->title);
			}

			if (!is_numeric($qdb->id) or $isNew) {
				$qdb->id = null;
			}

			if (!$qdb->store()) {
				echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
				exit ();
			}

		}
		for ($j = 0, $o = count($options[$i]); $j < $o; $j ++) {

			$odb->bind($options[$i][$j]);

			$odb->quid = $qdb->id;
            if (empty($odb->qoption) && ($odb->img_url == "") and !($odb->id == 0)) {
                $database->setQuery("DELETE FROM #__pollsxt_options where id='$odb->id'");
				$database->query();
			} else {
				// 'slash' the options
				if (!get_magic_quotes_gpc()) {
//					$odb->qoption = addslashes($odb->qoption);
				}
				$oldid = $odb->id;
				if ($odb->id == 0 or $isNew) {
                  $odb->id = 0;
				}
				if (!$odb->store()) {
					echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
					exit ();
				}
			}
		}
		$i ++;
	}

	// update the menu visibility
	$selections = mosGetParam($_POST, 'selections', array ());

	$database->setQuery("DELETE from #__pollxt_menu where pollid='$row->id'");
	$database->query();

	for ($i = 0, $n = count($selections); $i < $n; $i ++) {
		$database->setQuery("INSERT INTO #__pollxt_menu"."\nSET pollid='$row->id', menuid='$selections[$i]'");
		$database->query();
	}

	if ($task == "save")
		mosRedirect("index2.php?option=$option&task=show", "Settings saved");
	if ($task == "apply")
		mosRedirect("index2.php?option=$option&task=editA&hidemainmenu=1&id=$row->id", "Settings applied");
	if ($task == "doimport")
		return array ($row->id, $qdb);

}

function removePoll($cid, $option) {
	global $database;
	$msg = '';
	for ($i = 0, $n = count($cid); $i < $n; $i ++) {
		$poll = new mosPoll($database);

		if (!$poll->delete($cid[$i])) {
			$msg .= $poll->getError();
		}
	}
	mosRedirect("index2.php?option=$option&task=show&mosmsg=$msg");
}
function orderMenu($uid, $inc, $option) {
	global $database;

	$row = new mosPoll($database);
	$row->load($uid);
	$row->move($inc);
	$msg .= $row->getError();
	mosRedirect("index2.php?option=$option&task=show&mosmsg=$msg");

}

function deletePollData($uid, $option) {
	global $database;
	$database->setQuery("SELECT o.id
	      FROM #__pollsxt_questions AS q
	      LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
	      WHERE q.pollid =  '$uid'");

	$deldata = $database->loadObjectList();
	foreach ($deldata as $d) {
		$database->setQuery("DELETE FROM #__pollxt_data WHERE optid = '$d->id'");
		$database->query();

	}
	$row = new mosPoll($database);
	$row->load($uid);
	$row->voters = "0";
	if (!$row->store()) {
		echo "<script> alert('".$row->getError()."'); window.history.go(-1); </script>\n";
		exit ();
	}

	mosRedirect("index2.php?option=$option&task=show");

}
function publishPolls($cid = null, $publish = 1, $option) {
	global $database, $my;

	$catid = mosGetParam($_POST, 'catid', array (0));

	if (!is_array($cid) || count($cid) < 1) {
		$action = $publish ? 'publish' : 'unpublish';
		echo "<script> alert('Select an item to $action'); window.history.go(-1);</script>\n";
		exit;
	}

	$cids = implode(',', $cid);

	$database->setQuery("UPDATE #__pollsxt SET published='$publish'"."\nWHERE id IN ($cids) AND (checked_out=0 OR (checked_out='$my->id'))");
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		exit ();
	}

	if (count($cid) == 1) {
		$row = new mosPoll($database);
		$row->checkin($cid[0]);
	}
	mosRedirect("index2.php?option=$option&task=show");
}

function cancelPoll($option, $pollid) {
	global $database;
	if (!isset($pollid) or $pollid == 0)
        mosRedirect("index2.php?option=$option");
	$row = new mosPoll($database);
	$row->checkin($pollid);
	mosRedirect("index2.php?option=$option&amp;task=show");
}
function addOption($row, $questions, $options, $quid, $pollid, $option) {
	if (!$options)
		$options = array ();

	$questions = stripMQ($questions);
	$options = stripMQ($options);
	$row = stripMQ($row);

	$i = 0;
	foreach ($questions as $question) {
		if ($question['id'] == $quid) {
			if (!isset($options[$i])) {
				$options[$i][0] = array ("id" => 0, "quid" => $quid, "qoption" => "",
                 "img_url" => "", "imgor" => "", "imgsize" => "",
                 "imglink" => "", "freetext" => "", "newopt" => "", "inact" => "",
                 "multirows" => "", "multicols" => "");
			} else {
				$newOption = array ("id" => 0, "quid" => $quid, "qoption" => "",
                 "img_url" => "", "imgor" => "", "imgsize" => "",
                 "imglink" => "", "freetext" => "", "newopt" => "", "inact" => "",
                 "multirows" => "", "multicols" => "");
				array_push($options[$i], $newOption);

			}
		}
		$i ++;
	}
	show_editPoll($row, $questions, $options, getMenu($pollid), $option, "2");

}
function addQuestion($mypoll, $questions, $options, $pollid, $option) {
	$i = 0;
	if (!$options)
		$options = array ();

	if (!$questions)
		$questions = array ();
	$questions = stripMQ($questions);
	$options = stripMQ($options);
	$mypoll = stripMQ($mypoll);
	$vid = count($questions)."a";
	if (count($questions) == 0)
		$questions[0] = array ("id" => $vid, "pollid" => $pollid, "title" => "", "type" => 1,
        "img_url" => "", "imgor" => "", "imgsize" => "", "imglink" => "", "obli" => "",
        "multisize" => "", "inact" => "");
	else {
		$newQuestion = array ("id" => $vid, "pollid" => $pollid, "title" => "", "type" => 1,
        "img_url" => "", "imgor" => "", "imgsize" => "", "imglink" => "", "obli" => "",
        "multisize" => "", "inact" => "");

		array_push($questions, $newQuestion);
	}
	$i ++;

	show_editPoll($mypoll, $questions, $options, getMenu($pollid), $option, "2");
}
function copyQuestion($row, $questions, $options, $quid, $pollid, $option) {

	$questions = stripMQ($questions);
	$options = stripMQ($options);
	$row = stripMQ($row);

	$vid = count($questions)."a";
	$i = 0;
	foreach ($questions as $q) {

		if ($q['id'] == $quid) {
			$newQuestion = array ("id" => $vid, "pollid" => $pollid, "title" => $q['title'], "type" => $q['type'], "img_url" => $q['img_url'], "imgor" => $q['imgor'], "imgsize" => $q['imgsize'], "multisize" => $q['multisize'], "imglink" => $q['imglink'], "obli" => $q['obli'], "inact" => "");
			array_push($questions, $newQuestion);
			$j = count($questions) - 1;
			foreach ($options[$i] as $o) {

				if (!isset($options[$j])) {
					$options[$j][0] = array ("inact" => 0, "id" => 0, "quid" => $vid, "qoption" => $o['qoption'], "img_url" => $o['img_url'], "imgor" => $o['imgor'], "imgsize" => $o['imgsize'], "freetext" => $o['freetext'], "imglink" => $o['imglink'], "newopt" => $o['newopt']);
				} else {
					$newOption = array ("inact" => 0, "id" => 0, "quid" => $vid, "qoption" => $o['qoption'], "img_url" => $o['img_url'], "imgor" => $o['imgor'], "imgsize" => $o['imgsize'], "freetext" => $o['freetext'], "imglink" => $o['imglink'], "newopt" => $o['newopt']);
					array_push($options[$j], $newOption);
				}

			}

		}
		$i ++;
	}

	show_editPoll($row, $questions, $options, getMenu($pollid), $option, "2");
}

function getMenu($pollid) {
	global $database, $my;
	// get selected pages
	if ($pollid) {
		$database->setQuery("SELECT menuid AS value FROM #__pollxt_menu WHERE pollid='$pollid'");
		$lookup = $database->loadObjectList();
	} else {
		$lookup = array (mosHTML :: makeOption(0, 'All'));
	}

	// build the html select list
	$lists['select'] = mosAdminMenus :: MenuLinks($lookup, 1, 1);
	return $lists['select'];
}

function getImages() {
    global $mosConfig_absolute_path;
	include($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

	if ($xt_imgpath == "")
		$path = $mosConfig_absolute_path."/images/stories/";
	else
		$path = $mosConfig_absolute_path.$xt_imgpath;

	$arr = recursedir($path, "");
	asort($arr);
	return ($arr);
}

function print_info() {
	HTML_poll :: print_info();
}

function edit_settings($option) {
	global $database;
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

	$config['publ'] = $xt_publ;
	$config['disp'] = $xt_disp;
	$config['hide'] = $xt_hide;
	$config['selpo'] = $xt_selpo;
	$config['order'] = $xt_order;
	$config['imgvote'] = $xt_imgvote;
	$config['imgresult'] = $xt_imgresult;
	$config['maxcolors'] = $xt_maxcolors;
	$config['height'] = $xt_height;
	$config['orderby'] = $xt_orderby;
	$config['asc'] = $xt_asc;
	$config['scookie'] = $xt_seccookie;
	$config['sip'] = $xt_secip;
	$config['suname'] = $xt_secuname;
	$config['resselpo'] = $xt_config->resselpo;
	$config['imgpath'] = $xt_config->imgpath;
	$config['rdisp'] = $xt_config->rdisp;
	$config['button_style'] = $xt_config->button_style;

	if (!$config['imgpath'])
		$config['imgpath'] = "/images/stories/";

	// include random tip of day
	$arrTod[1] = "Check for new versions of PollXT at <a href=\"http://www.Joomlaxt.com\" target=\"_blank\">http://www.JoomlaXT.com</a>";
	$arrTod[2] = "Send feedback to <a href=\"mailto:pollXT@JoomlaXT.com\">pollXT@JoomlaXT.com</a>";
	$arrTod[3] = "If you select <i>random order</i> and <i>only one</i> you'll have one random Poll displayed,
	                otherwise you'll have a random order of all displayed polls.";
	$arrTod[4] = "If <i>Initially hide options</i> is selected only the title of the poll is displayed, clicking
	                on that opens the questions and options";
	$arrTod[5] = "Look for the documentation of PollXT at <a href=\"http://www.JoomlaXT.com\" target=\"_blank\">http://www.Joomlaxt.com</a>";
	$arrTod[6] = "Create your own stylesheet for results display: <joomlaroot>components/com_pollxt/poll_bars.css";
	$arrTod[7] = "You'll find support, Tips & Tricks and additional information on <a href=\"http://www.joomlaXT.com\" target=\"_blank\">http://www.JoomlaXT.com</a>";

	srand((double) microtime() * 1000000);
	$randnum = rand(1, count($arrTod));

	$tod = $arrTod[$randnum];

	HTML_poll :: edit_settings($option, $config, $tod, getImages(), $com_pollxt_ver);
}

function save_settings($option, $conf) {

	// Config holen (wegen version)
	require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");

	$xt_config->version = $xt_config_version;
	$xt_config->xt_disp = $conf['disp'];
	$xt_config->xt_hide = $conf['hide'];
	$xt_config->xt_selpo = $conf['selpo'];
	$xt_config->xt_publ = $conf['publ'];
	$xt_config->xt_order = $conf['order'];
	$xt_config->xt_imgvote = $conf['imgvote'];
	$xt_config->xt_imgresult = $conf['imgresult'];
	$xt_config->xt_maxcolors = $conf['maxcolors'];
	$xt_config->xt_height = $conf['height'];
	$xt_config->xt_orderby = $conf['orderby'];
	$xt_config->xt_asc = $conf['asc'];
	$xt_config->xt_seccookie = $conf['scookie'];
	$xt_config->xt_secip = $conf['sip'];
	$xt_config->xt_secuname = $conf['suname'];
	$xt_config->resselpo = $conf['resselpo'];
	$xt_config->imgpath = $conf['imgpath'];
	$xt_config->rdisp = $conf['rdisp'];
	$xt_config->button_style = $conf['button_style'];
	if (!$xt_config->store()) {
		echo "<script> document.write('".$xt_config->getError()."');  </script>\n";
		exit ();
	}

	$mosmsg = "Settings saved";

	// back to settings
	mosRedirect("index2.php?option=$option&task=settings", $mosmsg);

}
function stripMQ(& $value) {
	if (is_array($value)) {
		$result = array ();
		foreach ($value as $k => $v) {
			if (is_array($v)) {
				$result[$k] = stripMQ($v);
			} else {
				if (!is_object($v))
					$result[$k] = stripslashes($v);
			}
		}

		return $result;
	} else {
		return stripslashes($value);
	}
}

function show_editPoll($row_arr, $questions, $options, $menu, $option, $tab) {

	$conf = mosGetParam($_REQUEST, 'conf', 0);

	// build the html select list for ordering
	$order = mosGetOrderingList("SELECT ordering AS value, title AS text"."\n FROM #__pollsxt WHERE id > '0'"."\n ORDER BY ordering");

	$lists['ordering'] = mosHTML :: selectList($order, 'mypoll[ordering]', 'class="inputbox" size="1"', 'value', 'text', intval($row_arr['ordering']));

	HTML_poll :: editPoll($row_arr, $questions, $options, $menu, $conf, getImages(), $option, $lists, $tab);

}
function recursedir($BASEDIR, $subdir) {
	$hndl = opendir($BASEDIR.$subdir);
	if (!isset($myarr)) $myarr = array();
	while ($file = readdir($hndl)) {

		if ($file == '.' || $file == '..')
			continue;
		$completepath = $BASEDIR."/".$subdir."/".$file."/";

		if (@ is_dir($completepath)) {
			# its a dir, recurse.
			recursedir($BASEDIR, $subdir."/".$file);

		} else {
			global $myarr;
			# its a file.
			$myarr[] = trim(stripslashes($subdir."/".$file));
		}
	}
	return $myarr;

}

function showMamboPolls($option) {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	$database->setQuery("SELECT COUNT(*) FROM #__polls");
	$total = $database->loadResult();

	require_once ($GLOBALS['mosConfig_absolute_path'].'/administrator/includes/pageNavigation.php');
	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$query = "SELECT m.*, u.name AS editor,"."\n COUNT(d.id) AS numoptions"."\n FROM #__polls AS m"."\n LEFT JOIN #__users AS u ON u.id = m.checked_out"."\n LEFT JOIN #__poll_data AS d ON d.pollid = m.id AND d.text <> ''"."\n GROUP BY m.id"."\n LIMIT $pageNav->limitstart,$pageNav->limit";
	$database->setQuery($query);
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		echo $database->stderr();
		return false;
	}

	HTML_poll :: showMamboPolls($rows, $pageNav, $option);
}
function importMamboPolls($cid, $option) {
	global $database;

	// get the selected polls
	$query = 'SELECT * FROM #__polls WHERE id IN ('.implode(',', $cid).')';
	$database->setQuery($query);
	$polls = $database->loadObjectList();

	// for each poll
	foreach ($polls as $p) {

		// get the options
		$options = array ();

		$query = "SELECT id, text FROM #__poll_data"."\n WHERE pollid='$p->id'"."\n AND text <>''"."\n ORDER BY id";
		$database->setQuery($query);
		$options = $database->loadObjectList();

		// build poll
		$poll['id'] = 0;
		$poll['title'] = $p->title;
		$poll['voters'] = $p->voters;
		$poll['published'] = 0;
		$poll['lag'] = $p->lag;
		$poll['rdispb'] = "1";
		$poll['rdisp'] = "3";

		// build question (there is only one)
		$question[0]['id'] = '1a';
		$question[0]['title'] = $p->title;
		$question[0]['type'] = 1;
		$question[0]['published'] = 1;
		$question[0]['imgor'] = 'width';

		$count = 0;

		// save without options (needed later)
		list ($newid, $newquestions) = savePoll($poll, $question, $opt, $lookup, $option, 'doimport');

		// update the results
		foreach ($options as $o) {
			$opt = new mosPollOptions($database);
			$opt->quid = $newquestions->id;
			$opt->qoption = $o->text;
			if (!$opt->store()) {
				echo "<script> alert('".$opt->getError()."'); window.history.go(-1); </script>\n";
				exit ();
			}
			$query = "SELECT * FROM #__poll_date WHERE vote_id = '$o->id'";
			$database->setQuery($query);
			$votes = $database->loadObjectList();
			foreach ($votes as $v) {
				$database->setQuery("INSERT INTO #__pollxt_data (optid, ip, user, datu) "."\nVALUES ('$opt->id', 'unknown', 'anonymous', '$v->date')");
				$database->query();
				echo $database->getErrorMsg();

			}
		}
		//update menu
		$query = 'INSERT INTO #__pollxt_menu (pollid,menuid) SELECT '.$newid.',menuid FROM #__poll_menu WHERE pollid = '.$p->id;
		$database->setQuery($query);
		$database->query();

	}

	mosRedirect("index2.php?option=$option&task=show", "Polls imported");
}
function showCPanel($option) {
	global $mosConfig_list_limit, $mainframe, $database;

	require_once ($GLOBALS['mosConfig_absolute_path'].'/administrator/includes/pageNavigation.php');

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}", 'limitstart', 0);

	$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	$pageNav = new mosPageNav($total, $limitstart, $limit);

	$database->setQuery("SELECT m.*, u.name AS editor,"."\n        COUNT(d.id) AS numoptions"."\nFROM #__pollsxt AS m"."\nLEFT JOIN #__users AS u ON u.id = m.checked_out"."\nLEFT JOIN #__pollsxt_questions AS d ON d.pollid = m.id AND d.title <> ''"."\nGROUP BY m.id"."\nORDER BY m.ordering"."\nLIMIT $pageNav->limitstart,$pageNav->limit");
	$rows = $database->loadObjectList();

	HTML_poll :: cPanel($option, $rows, $limit, $limitstart, $pageNav);
}

function checkUpdate($option) {
	global $database, $mainframe, $mosConfig_list_limit;

	$upgrader = new xt_upgrader();
	$upgrader->set_upgrade_path("http://www.joomlaxt.com/updates/");
	$upgrader->set_version_xml("currentversion.xml");

	// get module versions
	$mod = getModuleVersions($upgrader, "mod_pollxt");
	$modcount = count($mod);
//	$modcount ++;
	// get bot versions
	$mod = getBotVersions($upgrader, "pollxt", $mod);
	$modcount = count($mod);
	$modcount ++;
	// get component version
	$mod[$modcount] = getComponentVersion($upgrader);

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	require_once ($GLOBALS['mosConfig_absolute_path'].'/administrator/includes/pageNavigation.php');
	$pageNav = new mosPageNav(count($mod), $limitstart, $limit);

	HTML_upgrader :: showCheckResult($option, $mod, $pageNav);
}

function update($cid, $option) {
	global $database, $mosConfig_absolute_path;

	$mod = mosGetParam($_REQUEST, 'mod', 0);
	$cid = mosGetParam($_REQUEST, 'cid', 0);

// make dirs if required
	if (!file_exists($mosConfig_absolute_path."/components/com_pollxt/class"))
	 mkdir($mosConfig_absolute_path."/components/com_pollxt/class");
	if (!file_exists($mosConfig_absolute_path."/components/com_pollxt/script"))
	 mkdir($mosConfig_absolute_path."/components/com_pollxt/script");

	$upgrader = new xt_upgrader();
	$upgrader->set_upgrade_path("http://www.joomlaxt.com/updates/");

	foreach ($cid as $c) {
		$curVer = $mod[$c]['oldversion'];

		$item = new xtupgradeItem();
		$item->bind($mod[$c]);

		$upgrader->upgrade($item);
		$msg = $upgrader->msg;

	}

	HTML_upgrader :: updateResult($option, $msg);
}

function getModuleVersions($upgrader, $modname) {
	global $mosConfig_absolute_path, $database, $mainframe;
	$mod = null;
	$rows = $upgrader->get_installed_modules($modname);

	$i = 0;
	foreach ($rows as $row) {
		$version = $upgrader->get_mod_version($row);
		$newVersion = $upgrader->get_server_version($row->module);

		$mod[$i]->newVersion = $newVersion;
		$mod[$i]->oldVersion = $version;
		$mod[$i]->module = $row->module;

		if ($newVersion > $version) {
			$mod[$i]->update = true;

		} else {
			$mod[$i]->update = false;

		}
		$i ++;
	}

	return $mod;
}
function getBotVersions($upgrader, $modname, $mod) {
	global $mosConfig_absolute_path, $database, $mainframe;

	$rows = $upgrader->get_installed_bots($modname);
	if (isset($rows)) {
    $i = count($mod);
	foreach ($rows as $row) {
		$version = $upgrader->get_bot_version($row);
		$newVersion = $upgrader->get_server_version($row->element);

		$mod[$i]->newVersion = $newVersion;
		$mod[$i]->oldVersion = $version;
		$mod[$i]->module = $row->element;

		if ($newVersion > $version) {
			$mod[$i]->update = true;

		} else {
			$mod[$i]->update = false;

		}
		$i ++;
	}
	}
	return $mod;
}

function getComponentVersion($upgrader) {
	global $mosConfig_absolute_path, $database, $mainframe;
	$database->setQuery("SELECT version"."\n FROM #__pollxt_config");
	$com->oldVersion = $database->loadResult();
	$com->module = "com_pollxt";

	$com->newVersion = $upgrader->get_server_version("com_pollxt");

	if ($com->newVersion > $com->oldVersion)
		$com->update = true;
	else
		$com->update = false;
	return $com;
}
function exportList($option) {
	global $mosConfig_list_limit, $database, $mainframe;

	$limit = $mainframe->getUserStateFromRequest("viewlistlimit", 'limit', $mosConfig_list_limit);
	$limitstart = $mainframe->getUserStateFromRequest("view{$option}limitstart", 'limitstart', 0);

	$database->setQuery("SELECT COUNT(*) FROM #__pollsxt");
	$total = $database->loadResult();
	echo $database->getErrorMsg();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	$database->setQuery("SELECT m.*, u.name AS editor,"."\n        COUNT(d.id) AS numoptions"."\nFROM #__pollsxt AS m"."\nLEFT JOIN #__users AS u ON u.id = m.checked_out"."\nLEFT JOIN #__pollsxt_questions AS d ON d.pollid = m.id AND d.title <> ''"."\nGROUP BY m.id"."\nORDER BY m.ordering"."\nLIMIT $pageNav->limitstart, $pageNav->limit");
	$rows = $database->loadObjectList();

	if ($database->getErrorNum()) {
		print $database->stderr();
		return false;
	}

	HTML_poll :: exportList($rows, $pageNav, $option);
}

function doexport($option, $cid) {
global $database;
$database->setQuery("SELECT p.id as pollid, p.title as ptitle, q.id as qid,
                                q.title as qtitle, o.id as oid, o.qoption ,
                                d.id as did, d.ip, d.user, d.datu, d.value
						FROM #__pollsxt_questions AS q
						LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
						LEFT JOIN #__pollxt_data AS d ON d.optid = o.id
						LEFT JOIN #__pollsxt AS p ON p.id = q.pollid
						WHERE q.pollid =  '$cid' AND d.block = 0
						AND q.type <> 5
						ORDER BY q.id,o.id");

$result = $database->loadObjectList();
$results_arr = array();
echo $database->getErrorMsg();

$csv_output = "";
$csv_output .= "PollID,PollTitle,QuestionID,QuestionText,OptionID,OptionText,ResultID,IP,User,DateTime,Comment";

// no results
if (count($result) == 0) {
    $mosmsg = "No results exist for the selected Poll";
	mosRedirect("index2.php?option=$option&task=exportList", $mosmsg);
}
foreach($result as $r) {
    $results_arr = get_object_vars($r);
    $csv_output .= "\n\"".implode ("\",\"", $results_arr)."\"";

    $polltitle= $results_arr['ptitle'];
   }

$csv_output .= "\n";

//header("Content-type: application/vnd.ms-excel");
header("Content-type: text/csv");
$size_in_bytes = strlen($csv_output);
$fname=str_replace(" ", "", $polltitle).".csv";
header("Content-disposition:  attachment; filename=$fname; size=$size_in_bytes");

print $csv_output;
exit;

}
?>

