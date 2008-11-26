<?php
/**
* @version $Id: mod_jvtempo.php 2007-04-28 22:22:22Z Lisboa $
* @package Joomla
* @copyright Copyright (C) 2006 Joao vieira. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
global $mosConfig_offset, $mosConfig_cachepath;
$cidades = $params->def( 'cidades' );
$graus = $params->def( 'graus' );
$font_header = $params->def( 'font_header' );

function converte_data($strdata)
{
	$strdata_partir = explode(" ", $strdata);
	$strdata = str_replace(":", "", $strdata_partir[1]);
	$strdata_partir = explode("/", $strdata_partir[0]);
	$strdata = $strdata_partir[0] . $strdata_partir[1] . $strdata_partir[2] . $strdata;
	return $strdata;
}

function apanha_tempo($accid, $graus, $mosConfig_cachepath)
{
	//puxa dados em cache, caso existam
	if ( !file_exists( $mosConfig_cachepath . '/jvtempo.txt') )
	{
		$ficha = fopen($mosConfig_cachepath . '/jvtempo.txt', "w");
		$dcache[$accid]['LastUp'] = "";
		$dcache[$accid]['Temp'] = "";
		$dcache[$accid]['CIcon'] = "";
		fputs($ficha, serialize($dcache));
		fclose($ficha);
	}else
	{
		$ficha = fopen($mosConfig_cachepath . '/jvtempo.txt', "r");
		$dcache = unserialize(fgets($ficha, 1000));
		fclose($ficha);
	}

	$cidade = explode("=", $accid);
	$accid = $cidade[0];
	$url ="http://weather.msn.com/local.aspx?wealocations=wc:$accid";
	$ConteudoRemoto = file_get_contents($url);


	/**
	MODIFICADO A MANO
	**/
	$jgg_posx = strpos($ConteudoRemoto, '<td class="smtemp"><table class="hilo"><tr><th>Hi:</th> <td>');
	$jgg_ConteudoRemoto = strip_tags(substr($ConteudoRemoto, $jgg_posx, 62));
	$jgg_ConteudoRemoto = explode(' ', $jgg_ConteudoRemoto);
	$MsnWeather['TempMax'] = $jgg_ConteudoRemoto[1];

	$jgg_posx = strpos($ConteudoRemoto, '>UV Index</a>:</td> <td>');
	$jgg_ConteudoRemoto = strip_tags(substr($ConteudoRemoto, $jgg_posx, 28));
	$jgg_ConteudoRemoto = explode(' ', $jgg_ConteudoRemoto);
	$MsnWeather['UV'] = $jgg_ConteudoRemoto[2];
	//faz calculos de temperatura
	if ( !($MsnWeather['TempMax']) ) {
		$jgg_temperatura = "-";
	}
	elseif ($graus == 'c') {
		$temperatura = $MsnWeather['TempMax'];
		$temperatura = $temperatura-32;
		$temperatura = $temperatura/9;
		$temperatura = $temperatura*5;
		$temperatura = round($temperatura, 0);
	}
	elseif ($graus == 'f') {
		$temperatura = $MsnWeather['TempMax'];
	}

	$MsnWeather['TempMax'] = $temperatura;

	/**
	FIN MODIFICACION A MANO
	**/


	$posx = explode('<title>', $ConteudoRemoto);
	$posx = explode(',', $posx[1]);
	$xcity = trim(strip_tags($posx[0]));

	$posx = strpos($ConteudoRemoto, '</div></td></tr><tr><td rowspan="8"><div class="icon"><img src="');
	$ConteudoRemoto = substr($ConteudoRemoto, $posx, 300);
	$ConteudoRemoto = explode('<img src="', $ConteudoRemoto);
	$posx = explode('.gif', $ConteudoRemoto[1]);
	$posx = explode('/', $posx[0]);
	$xicon = trim(strip_tags($posx[count($posx)-1]));

	$ConteudoRemoto = explode('div class="temp">', $ConteudoRemoto[1]);
	$ConteudoRemoto = explode('&#176;', $ConteudoRemoto[1]);
	$xtemperature = trim(strip_tags($ConteudoRemoto[0]));
	$xdate = date("Y/m/d H:00:00");

	$MsnWeather['City'] = htmlspecialchars($xcity);
	$MsnWeather['LastUp'] = $xdate;
	$MsnWeather['Temp'] = $xtemperature;
	$MsnWeather['CIcon'] = $xicon;

	if (count($cidade)>1) $MsnWeather['City'] = $cidade[1];

	//verifica se os dados que est�o em cache s�o mais actuais ou n�o
	$alterou = false;
	if ( converte_data($MsnWeather['LastUp']) > converte_data($dcache[$accid]['LastUp']) )
	{
		$dcache[$accid]['LastUp'] = $MsnWeather['LastUp'];
		if ($MsnWeather['Temp']) $dcache[$accid]['Temp'] = $MsnWeather['Temp'];
		if ($MsnWeather['CIcon']) $dcache[$accid]['CIcon'] = $MsnWeather['CIcon'];
		$alterou = true;
	}else
	{
		$MsnWeather['LastUp'] = $dcache[$accid]['LastUp'];
		$MsnWeather['Temp'] = $dcache[$accid]['Temp'];
		$MsnWeather['CIcon'] = $dcache[$accid]['CIcon'];
	}

	if ( $alterou && file_exists( $mosConfig_cachepath . '/jvtempo.txt') )
	{
		$ficha = fopen($mosConfig_cachepath . '/jvtempo.txt', "w");
		fputs($ficha, serialize($dcache));
		fclose($ficha);
	}
	//faz calculos de temperatura
	if ( !($MsnWeather['Temp']) )
	{
		$temperatura = "-";
		$MsnWeather['CIcon'] = "44";
	}
	elseif ($graus == 'c')
	{
		$temperatura = $MsnWeather['Temp'];
		$temperatura = $temperatura-32;
		$temperatura = $temperatura/9;
		$temperatura = $temperatura*5;
		$temperatura = round($temperatura, 0);
	}
	elseif ($graus == 'f')
	{
		$temperatura = $MsnWeather['Temp'];
	}
	if (!$MsnWeather['CIcon']) $MsnWeather['CIcon'] = "44";

	$MsnWeather['Temp'] = $temperatura;

	$varlocal = "";
	$varlocal .= "<a href='http://weather.msn.com/local.aspx?wealocations=wc:$accid&setunit=".strtoupper($graus)."' target='_blank'>".$MsnWeather['City']."<img align=\"absmiddle\" border=\"0\" src=\"http://st.msn.com/as/wea3/i/en-US/". $MsnWeather['CIcon'] . ".gif\">&nbsp;&nbsp;<strong>".$temperatura."�".strtoupper($graus)."  </strong></a>";
	//return $varlocal;
	return $MsnWeather;
}

$cidades = explode(",", $cidades);
$content .="<div class='jvTempo'>";
for($i=0; $i<count($cidades); $i++)
{
	$MsnWeather = apanha_tempo($cidades[$i],$graus, $mosConfig_cachepath);
	$content .="<div>";
	//$content .= apanha_tempo($cidades[$i],$graus, $mosConfig_cachepath);
	$content .= "<div id=\"jvTempo-CIcon-title\">HOY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M&Aacute;X</div>";
	$content .= "<div id=\"jvTempo-CIcon\"><img align=\"absmiddle\" border=\"0\" src=\"http://st.msn.com/as/wea3/i/en-US/". $MsnWeather['CIcon'] . ".gif\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$MsnWeather['TempMax']."&deg;</div>";
	$content .= "<div id=\"jvTempo-Temp-title\">T&deg; ACTUAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&Iacute;NDICE UV</div>";
	$content .= "<div id=\"jvTempo-Temp\">".$MsnWeather['Temp']."&deg;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$MsnWeather['UV']."</div>";
	$content .="</div>";
}
$content .= "</div>";

?>