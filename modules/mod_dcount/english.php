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

DEFINE("DC_HTML_CODE",'<div dir="ltr" class="countdown_title" id="countdown_title"></div><div dir="ltr" class="countdown" id="countdown"></div>');
DEFINE("DC_TITLE_COUNTDOWN","");
DEFINE("DC_TITLE_COUNTUP","");

switch ($cFormat) {
	default:
	case 1:
				//Define plural suffixes
				$outString = "dps = '&nbsp;&nbsp;&nbsp;'; hps = ''; mps = ''; sps = '';"
				. "if(days == 1) dps ='&nbsp;&nbsp;&nbsp;';"
				. "if(hours == 1) hps ='';"
				. "if(minutes == 1) mps ='';"
				. "if(seconds == 1) sps ='';";

				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + '' + dps + '';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' ' + hps + ' ';"
				. "/*getRefToDiv('countdown').innerHTML += minutes + ' ' + mps + ' ';*/"
				. "/*getRefToDiv('countdown').innerHTML += seconds + ' ' + sps;*/";
				break;
	case 2:
					//Define plural suffixes
				$outString = "dps = '&nbsp;&nbsp;&nbsp;'; hps = '';"
				. "if(days == 1) dps ='&nbsp;&nbsp;&nbsp;';"
				. "if(hours == 1) hps ='';";

				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = 'D&Iacute;AS: ' + days + '';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "//getRefToDiv('countdown').innerHTML += hours + '' + hps + '';"
				. "//if ((!days)&&(!hours)) getRefToDiv('countdown').innerHTML= '' ;";
				break;
	case 3:
				$outString = "dps = '&nbsp;&nbsp;&nbsp;';"
				. "if(days == 1) dps =' ';"
				. "getRefToDiv('countdown').innerHTML = days + '' + dps + '';"
				. "getRefToDiv('countdown').innerHTML += hours + ' ' + getZeroPrint(minutes) + ' ' + getZeroPrint(seconds);";
				break;
	case 4:
				//Define plural suffixes
				$outString = "dps = '&nbsp;&nbsp;&nbsp;'; hps = ''; mps = '';"
				. "if(days == 1) dps ='&nbsp;&nbsp;&nbsp;';"
				. "if(hours == 1) hps ='';"
				. "if(minutes == 1) mps ='';";

				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + '' + dps + '';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' ' + hps + ' ';"
				. "/*getRefToDiv('countdown').innerHTML += minutes + ' ' + mps;*/";
				break;
	}

	$outString .= "getRefToDiv('countdown').onclick = function(event) {location.href='?option=com_content&task=view&id=75&Itemid=115';}";

?>