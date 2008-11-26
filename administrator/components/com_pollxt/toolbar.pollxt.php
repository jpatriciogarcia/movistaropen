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

require_once( $mainframe->getPath( 'toolbar_html' ) );
require_once( $mainframe->getPath( 'toolbar_default' ) );

switch ($task) {

        case "new":
                TOOLBAR_poll::_NEW();
                break;
        case "copy":
                TOOLBAR_poll::_NEW();
                break;

        case "edit":

		$cid = josGetArrayInts( 'cid' );

             $database->setQuery( "SELECT published FROM #__pollsxt WHERE id='$cid[0]'" );
                $published = $database->loadResult();

        		$cur_template = $mainframe->getTemplate();
        		
                TOOLBAR_poll::_EDIT($cid[0], $cur_template);
                break;
        case "editA":

		$id = intval( mosGetParam( $_REQUEST, 'id', 0 ) );
		
             $database->setQuery( "SELECT published FROM #__pollsxt WHERE id='$id'" );
                $published = $database->loadResult();

        		$cur_template = $mainframe->getTemplate();

                TOOLBAR_poll::_EDIT($id, $cur_template);
                break;
        case "addOption":
               TOOLBAR_poll::_EDIT();
               break;
        case "settings":
               TOOLBAR_poll::_CONF();
               break;
        case "addQuestion":
               TOOLBAR_poll::_EDIT();
               break;
        case "copyQuestion":
               TOOLBAR_poll::_EDIT();
               break;
        case "info":
               TOOLBAR_poll::INFO_MENU();
               break;
        case "showList":
               TOOLBAR_poll::MENU_showList();
               break;
        case "import":
               TOOLBAR_poll::MENU_import();
               break;
        case "doimport":
               TOOLBAR_poll::MENU_doimport();
               break;
        case "exportList":
               TOOLBAR_poll::MENU_exportList();
               break;
        case "show":
               TOOLBAR_poll::MENU_showList();
               break;
        case "checkUpdate":
               TOOLBAR_poll::MENU_checkUpdate();
               break;

        default:
               TOOLBAR_poll::MENU_cpanel();
               break;
}
?>
