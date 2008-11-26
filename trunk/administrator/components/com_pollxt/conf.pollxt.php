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

global $mainframe, $database, $mosConfig_absolute_path;
require_once($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/pollxt.class.php");

  $xt_config = new mosPollConfig ($database);
  // load the row from the db table
  $xt_config->load('1');

$com_pollxt_ver =   $xt_config->version;
$xt_disp =          $xt_config->xt_disp;
$xt_hide =          $xt_config->xt_hide;
$xt_selpo =         $xt_config->xt_selpo;
$xt_resselpo =      $xt_config->resselpo;
$xt_publ =          $xt_config->xt_publ;
$xt_order =         $xt_config->xt_order;
$xt_imgvote =       $xt_config->xt_imgvote;
$xt_imgresult =     $xt_config->xt_imgresult;
$xt_maxcolors =     $xt_config->xt_maxcolors;
$xt_height =        $xt_config->xt_height;
$xt_orderby =       $xt_config->xt_orderby;
$xt_asc =           $xt_config->xt_asc;
$xt_seccookie =     $xt_config->xt_seccookie;
$xt_secip =         $xt_config->xt_secip;
$xt_secuname =      $xt_config->xt_secuname;
$xt_imgpath =       $xt_config->imgpath;
$xt_rdisp   =       $xt_config->rdisp;
$xt_btnstyle = 		$xt_config->button_style;
?>
