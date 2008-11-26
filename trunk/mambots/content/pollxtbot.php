<?php
/**
* @version $Id: moscode.php,v 1.4 2005/01/06 01:13:30 eddieajau Exp $
* @package Mambo
* @copyright (C) 2000 - 2005 Miro International Pty Ltd
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* Mambo is Free Software
*/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

$_MAMBOTS->registerFunction( 'onPrepareContent', 'pollxtbot' );

function pollxtbot( $published, &$row, &$params, $page=0 ) {

    $pattern = "/{pollxtbot(.*?)}/s";
    $resultpattern = "/{pollxtresultbot(.*?)}/s";
	if (!$published) {
	$row->text = preg_replace($pattern, "", $row->text);
	$row->text = preg_replace($resultpattern, "", $row->text);
		return;
	}

	// perform the replacement
	$row->text = preg_replace_callback( $pattern, 'pollxtbot_replacer', $row->text );
	$row->text = preg_replace_callback( $resultpattern, 'pollxtresultbot_replacer', $row->text );

	return true;
}
function pollxtbot_replacer(&$matches) {
    global $mosConfig_absolute_path;
    require_once($mosConfig_absolute_path."/administrator/components/com_pollxt/pollxt.inc.php");
    $option=$_GET["option"];
    $Itemid=$_GET["Itemid"];
    $params = "";
    $pollid = trim(preg_replace("/.*?id.*?=/i", "", trim($matches[1])));
    ob_start();
    show_pollXT_vote_form( $option, false, $Itemid, $pollid, $params );
    $ret = ob_get_contents();
    ob_end_clean();
    
    return $ret;
  }
function pollxtresultbot_replacer(&$matches) {
    global $mosConfig_absolute_path;
    require_once($mosConfig_absolute_path."/administrator/components/com_pollxt/pollxt.inc.php");

    $pollid = trim(preg_replace("/.*?id.*?=/i", "", trim($matches[1])));
    ob_start();
    pollresult( $pollid);
    $ret = ob_get_contents();
    ob_end_clean();


    return $ret;
  }


