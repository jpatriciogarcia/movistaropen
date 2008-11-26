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
DEFINE("DC_TITLE_COUNTDOWN","До свадьбы осталось");
DEFINE("DC_TITLE_COUNTUP","Мы муж и жена");

switch ($cFormat) {
	default:
	case 1:
				//Define plural suffixes
				$outString = "dps = 'дней'; hps = 'часов'; mps = 'минут'; sps = 'секунд';"
				. "if((Math.floor(days/10)!=1)&&(days%10 == 1)) dps ='день';"
				. "if((Math.floor(hours/10)!=1)&&(hours%10 == 1)) hps ='час';"
				. "if((Math.floor(minutes/10)!=1)&&(minutes%10 == 1)) mps ='минута';"
				. "if((Math.floor(seconds/10)!=1)&&(seconds%10 == 1)) sps ='секунда';"
				. "if((Math.floor(days/10)!=1)&&(days%10 > 1)&&(days%10 < 5)) dps ='дня';"
				. "if((Math.floor(hours/10)!=1)&&(hours%10 > 1)&&(hours%10 < 5)) hps ='часа';"
				. "if((Math.floor(minutes/10)!=1)&&(minutes%10 > 1)&&(minutes%10 < 5)) mps ='минуты';"
				. "if((Math.floor(seconds/10)!=1)&&(seconds%10 > 1)&&(seconds%10 < 5)) sps ='секунды';";
				
				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + ' ' + dps + ' ';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' ' + hps + ' ';"
				. "getRefToDiv('countdown').innerHTML += minutes + ' ' + mps + ' и ';"
				. "getRefToDiv('countdown').innerHTML += seconds + ' ' + sps;";
				break;
	case 2:
					//Define plural suffixes
				$outString = "dps = 's'; hps = 's';"
				. "if(days == 1) dps ='';"
				. "if(hours == 1) hps ='';";
				
				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + ' day' + dps + ' ';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' hour' + hps + ' ';"
				. "if ((!days)&&(!hours)) getRefToDiv('countdown').innerHTML= 'Сейчас' ;";
				break;
	case 3:
				$outString = "dps = 's';"
				. "if(days == 1) dps ='';"
				. "getRefToDiv('countdown').innerHTML = days + ' day' + dps + ' ';"
				. "getRefToDiv('countdown').innerHTML += hours + ':' + getZeroPrint(minutes) + ':' + getZeroPrint(seconds);";
				break;	
	case 4:
				//Define plural suffixes
				$outString = "dps = 'дней'; hps = 'часов'; mps = 'минут';"
				. "if((Math.floor(days/10)!=1)&&(days%10 == 1)) dps ='день';"
				. "if((Math.floor(hours/10)!=1)&&(hours%10 == 1)) hps ='час';"
				. "if((Math.floor(minutes/10)!=1)&&(minutes%10 == 1)) mps ='минута';"
				. "if((Math.floor(days/10)!=1)&&(days%10 > 1)&&(days%10 < 5)) dps ='дня';"
				. "if((Math.floor(hours/10)!=1)&&(hours%10 > 1)&&(hours%10 < 5)) hps ='часа';"
				. "if((Math.floor(minutes/10)!=1)&&(minutes%10 > 1)&&(minutes%10 < 5)) mps ='минуты';";

				
				$outString .= "if (days!=0) getRefToDiv('countdown').innerHTML = days + ' ' + dps + ' ';"
				. "else getRefToDiv('countdown').innerHTML ='';"
				. "getRefToDiv('countdown').innerHTML += hours + ' ' + hps + ' ';"
				. "getRefToDiv('countdown').innerHTML += minutes + ' ' + mps;";
				break;
	}
?>

