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

/**
* Poll database table class
*/
class mosPoll extends mosDBTable {
/** @var int Primary key */
        var $id=null;
/** @var string */
        var $title=null;
        var $voters=null;
/** @var string */
        var $checked_out=null;
/** @var time */
        var $checked_out_time=null;
/** @var boolean */
        var $published=null;
/** @var int */
        var $access=null;
/** @var int */
        var $lag=null;
        var $multivote=null;
        var $rdisp=null;
        var $rdispb=null;
        var $rdispd=null;
        var $rdispall=null;
        var $ordering=null;
        var $intro=null;
        var $thanks=null;
        var $logon=null;
        var $img_url = null;
        var $imgor = null;
        var $imgsize = null;
        var $imglink = null;
        var $css = null;
        var $datefrom = null;
        var $dateto = null;
        var $timefrom = null;
        var $timeto = null;
        var $type = null;
        var $sh_numvote = null;
        var $sh_flvote = null;
        var $sh_abs = null;
        var $sh_perc = null;
        var $email = null;
        var $subject = null;
        var $emailtext = null;
        var $goto = null;
        var $goto_url = null;
        var $hidetitle = null;
        var $mailres = null;
        var $mailrestxt = null;
        var $mailresrec = null;



        /**
* @param database A database connector object
*/
        function mosPoll( &$db ) {
                $this->mosDBTable( '#__pollsxt', 'id', $db );
        }
// overloaded check function
        function check() {
        // check for valid name
                if (trim( $this->title ) == '') {
                        $this->_error = "Your Poll must contain a title.";
                        return false;
                }
        // check for valid lag
                $this->lag = intval( $this->lag );
                if ($this->lag == 0) {
                        $this->_error = "Your Poll must have a non-zero lag time.";
                        return false;
                }
        // check for existing title
                $this->_db->setQuery( "SELECT id FROM #__pollsxt WHERE title='$this->title'"
                );

                $xid = intval( $this->_db->loadResult() );
                if ($xid && $xid != intval( $this->id )) {
                        $this->_error = "There is a module already with that name (".$this->title."), please try again.";
                        return false;
                }

        // sanitise some data
                if (!get_magic_quotes_gpc()) {
                        $row->title = addslashes( $row->title );
                }

                return true;
        }
// overloaded delete function
        function delete( $oid=null ) {
                $k = $this->_tbl_key;
                if ($oid) {
                        $this->$k = intval( $oid );
                }


                if (mosDBTable::delete( $oid )) {
                        $this->_db->setQuery( "SELECT q.pollid as pollid, o.quid as quid, d.optid as optid
                        FROM #__pollsxt_questions AS q
                        LEFT  JOIN #__pollsxt_options AS o ON o.quid = q.id
                        LEFT JOIN #__pollxt_data AS d ON d.optid = o.id
                        WHERE q.pollid =  '".$this->$k."'");

                        $rows = $this->_db->loadObjectList();
                         foreach ($rows as $row) {
                          $this->_db->setQuery( "DELETE from #__pollsxt_questions where pollid='".$row->pollid."'" );
                          $this->_db->query();
                          $this->_db->setQuery( "DELETE from #__pollsxt_options where quid='".$row->quid."'" );
                          $this->_db->query();
                          $this->_db->setQuery( "DELETE from #__pollxt_data where optid='".$row->optid."'" );
                          $this->_db->query();
                        }

                        if (!$this->_db->query()) {
                                $this->_error .= $this->_db->getErrorMsg() . "\n";
                        }



                        $this->_db->setQuery( "DELETE from #__pollxt_menu where pollid='".$this->$k."'" );
                        if (!$this->_db->query()) {
                                $this->_error .= $this->_db->getErrorMsg() . "\n";
                        }

                        return true;
                } else {
                        return false;
                }
        }
}
class mosPollQuestion extends mosDBTable {
/** @var int Primary key */
        var $id=null;
        var $pollid = null;
/** @var string */
        var $title=null;
        var $type = null;
        var $img_url = null;
        var $imgor = null;
        var $imgsize = null;
        var $imglink = null;
        var $obli = null;
        var $multisize = null;
        var $inact = null;


        function mosPollQuestion( &$db ) {
                $this->mosDBTable( '#__pollsxt_questions', 'id', $db );
        }
}
class mosPollOptions extends mosDBTable {
/** @var int Primary key */
        var $id=null;
        var $quid = null;
/** @var string */
        var $qoption=null;
        var $img_url = null;
        var $imgor = null;
        var $imgsize = null;
        var $imglink = null;
        var $freetext = null;
        var $newopt = null;
        var $inact = null;
        var $multirows = null;
        var $multicols = null;

        function mosPollOptions( &$db ) {
                $this->mosDBTable( '#__pollsxt_options', 'id', $db );
        }
}
class mosPollData extends mosDBTable {
/** @var int Primary key */
        var $id=null;
        var $optid = null;
        var $ip=null;
        var $user = null;
        var $datu = null;
        var $mailkey = null;
        var $block = null;
        
        
function mosPollData( &$db ) {
         $this->mosDBTable( '#__pollsxt_data', 'id', $db );
        }
}

class mosPollConfig extends mosDBTable {
/** @var int Primary key */
var $id = null;
var $version = null;
var $xt_disp = null;
var $xt_hide = null;
var $xt_selpo = null;
var $xt_publ = null;
var $xt_order = null;
var $xt_imgvote = null;
var $xt_imgresult = null;
var $xt_maxcolors = null;
var $xt_height = null;
var $xt_orderby = null;
var $xt_asc = null;
var $xt_seccookie = null;
var $xt_secip = null;
var $xt_secuname = null;
var $resselpo = null;
var $imgpath = null;
var $rdisp = null;
var $button_style;
function mosPollConfig( &$db ) {
         $this->mosDBTable( '#__pollxt_config', 'id', $db );
        }
}

class mosPollPage extends mosDBTable {
/** @var int Primary key */
var $id = null;
var $pollid = null;
var $elid = null;
var $eltype = null;
var $ordering = null;

function mosPollPage( &$db ) {
         $this->mosDBTable( '#__pollxt_page', 'id', $db );
        }
}

?>
