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


class TOOLBAR_poll {

        /**
        * Draws the menu for a New category
        */
          function INFO_MENU() {
                mosMenuBar::startTable();
                mosMenuBar::cancel();
                mosMenuBar::spacer();
                mosMenuBar::endTable();
            }

        function _NEW() {
        global $_VERSION;
                mosMenuBar::startTable();
                mosMenuBar::save();
            if ($_VERSION->DEV_LEVEL >= 2 || $_VERSION->PRODUCT == "Joomla!") {
             mosMenuBar::apply();
            }
                mosMenuBar::cancel();
                mosMenuBar::spacer();
                mosMenuBar::endTable();
        }
        function _CONF() {
                mosMenuBar::startTable();
                mosMenuBar::save();
                mosMenuBar::cancel();
                mosMenuBar::spacer();
                mosMenuBar::endTable();
        }


        /**
        * Draws the menu for Editting an existing category
        */
        function _EDIT() {
        global $_VERSION;

            mosMenuBar::startTable();
            mosMenuBar::save();
            if ($_VERSION->DEV_LEVEL >= 2 || $_VERSION->PRODUCT == "Joomla!") {
             mosMenuBar::apply();
            }
            mosMenuBar::cancel();
            mosMenuBar::spacer();
            mosMenuBar::endTable();
        }
        function addOption( $pollid, $cur_template ) {
            mosMenuBar::startTable();
            mosMenuBar::save();
            mosMenuBar::cancel();
            mosMenuBar::spacer();
            mosMenuBar::endTable();
        }

	function MENU_Default() {
        global $_VERSION;
        if ($_VERSION->DEV_LEVEL >= 2 || $_VERSION->PRODUCT == "Joomla!") {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::divider();
		mosMenuBar::addNewX();
		mosMenuBar::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy', true );
		mosMenuBar::editListX();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::endTable(); }
        else {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::divider();
		mosMenuBar::addNew();
		mosMenuBar::custom( 'copy', 'copy.png', 'copy_f2.png', 'Copy', true );
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::endTable();
	}


	}


function MENU_showList() {
        global $_VERSION;

        if ($_VERSION->DEV_LEVEL >= 2 || $_VERSION->PRODUCT == "Joomla!") {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::divider();
		mosMenuBar::addNewX();
		mosMenuBar::customX( 'copy', 'copy.png', 'copy_f2.png', 'Copy', true );
		mosMenuBar::editListX();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::divider();
		mosMenuBar::custom( 'cpanel', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::endTable();
	   }
	   else {
		mosMenuBar::startTable();
		mosMenuBar::publishList();
		mosMenuBar::unpublishList();
		mosMenuBar::divider();
		mosMenuBar::addNew();
		mosMenuBar::custom( 'copy', 'copy.png', 'copy_f2.png', 'Copy', true );
		mosMenuBar::editList();
		mosMenuBar::deleteList();
		mosMenuBar::spacer();
		mosMenuBar::divider();
		mosMenuBar::custom( 'cpanel', 'back.png', 'back_f2.png', 'Back', false );
		mosMenuBar::endTable();
	}
}
        function MENU_import() {
        global $_VERSION;
                mosMenuBar::startTable();
                if ($_VERSION->DEV_LEVEL >= 2 || $_VERSION->PRODUCT == "Joomla!")
        		  mosMenuBar::customX( 'doimport', 'upload.png', 'upload_f2.png', 'Import', true );
                else
                  mosMenuBar::custom( 'doimport', 'upload.png', 'upload_f2.png', 'Import', true );
                mosMenuBar::spacer();
                mosMenuBar::cancel();
                mosMenuBar::endTable();
            }
        function MENU_doimport() {
                mosMenuBar::startTable();
                mosMenuBar::back();
                mosMenuBar::endTable();
            }
        function MENU_cpanel() {
                mosMenuBar::startTable();
                mosMenuBar::back();
                mosMenuBar::endTable();
            }
		        function MENU_checkUpdate() {
        global $_VERSION;
                mosMenuBar::startTable();
                if ($_VERSION->DEV_LEVEL >= 2 || $_VERSION->PRODUCT == "Joomla!")
        		  mosMenuBar::customX( 'doupdate', 'upload.png', 'upload_f2.png', 'Update', true );
                else
                  mosMenuBar::custom( 'doupdate', 'upload.png', 'upload_f2.png', 'Update', true );
                mosMenuBar::spacer();
                mosMenuBar::back();
                mosMenuBar::endTable();
            }		
		        function MENU_exportList() {
        global $_VERSION;
                mosMenuBar::startTable();
                if ($_VERSION->DEV_LEVEL >= 2 || $_VERSION->PRODUCT == "Joomla!")
        		  mosMenuBar::customX( 'doexport', 'downloads.png', 'downloads_f2.png', 'Export', true );
                else
                  mosMenuBar::custom( 'doexport', 'downloads.png', 'downloads_f2.png', 'Update', true );
                mosMenuBar::spacer();
                mosMenuBar::back();
                mosMenuBar::endTable();
            }

}

?>
