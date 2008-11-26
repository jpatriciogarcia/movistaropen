<?php
//
/**
* @package mod_dcount
* @All rights reserved
* @sDenn
* @Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.0b $
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

DEFINE("DC_HTML_CODE",'<div dir="ltr" class="countdown_title" id="countdown_title"></div><br/><div dir="ltr" class="countdown" id="countdown"></div><br/>');
DEFINE("DC_TITLE_COUNTDOWN","Fasnacht 2008 isch in");
DEFINE("DC_TITLE_COUNTUP","Fasnacht 2008");

switch ($cFormat) {
	default:
	case 1:
				//Define plural suffixes
				$outString = "dps = 'e'; hps = 'n'; mps = 'n'; sps = 'n';"
				. "if(days == 1) dps ='';"
				. "if(hours == 1) hps ='';"
				. "if(minutes == 1) mps ='';"
				. "if(seconds == 1) sps ='';";

				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + ' Tag' + dps + ' ';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' Stunde' + hps + ' ';"
				. "getRefToDiv('countdown').innerHTML += minutes + ' Minute' + mps + ' und ';"
				. "getRefToDiv('countdown').innerHTML += seconds + ' Sekunde' + sps;";
				break;
	case 2:
					//Define plural suffixes
				$outString = "dps = 'e'; hps = 'n';"
				. "if(days == 1) dps ='';"
				. "if(hours == 1) hps ='';";

				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + ' Tag' + dps + ' ';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' Stunde' + hps + ' ';"
				. "if ((!days)&&(!hours)) getRefToDiv('countdown').innerHTML= 'jetzt' ;";
				break;
	case 3:
				$outString = "dps = 'e';"
				. "if(days == 1) dps ='';"
				. "getRefToDiv('countdown').innerHTML = days + ' Tag' + dps + ' ';"
				. "getRefToDiv('countdown').innerHTML += hours + ':' + getZeroPrint(minutes) + ':' + getZeroPrint(seconds);";
				break;
	case 4:
				//Define plural suffixes
				$outString = "dps = 'e'; hps = 'n'; mps = 'n';"
				. "if(days == 1) dps ='';"
				. "if(hours == 1) hps ='';"
				. "if(minutes == 1) mps ='';";

				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + ' Tag' + dps + ' ';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' Stunde' + hps + ' ';"
				. "getRefToDiv('countdown').innerHTML += minutes + ' Minute' + mps;";
				break;
	}
?>

