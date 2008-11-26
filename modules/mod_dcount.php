<?php
//
/**
* @package mod_dcount
* @All rights reserved
* @netWill
* @Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @version $Revision: 1.0.1b $
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_lang, $iso_client_lang;

$cDay 		= @$params->get('Day') 		? @$params->get('Day') 		: '01' ;
$cMonth 	= @$params->get('Month') 	? @$params->get('Month') 	: '01' ;
$cYear		= @$params->get('Year') 	? @$params->get('Year') 	: '2005' ;
$cHour 		= @$params->get('Hour') 	? @$params->get('Hour') 	: '12' ;
$cMinute	= @$params->get('Minute') 	? @$params->get('Minute') 	: '0' ;
$cOffset	= @$params->get('Offset');// 	? @$params->get('Offset') 	: '-7' ;
$cFormat	= @$params->get('Format');// 	? @$params->get('Format') 	: '0';


//Includes file which defines language Strings and display_count function, that proper helds plurals.

if ( file_exists($mosConfig_absolute_path."/modules/mod_dcount/".$mosConfig_lang.".php") ) {
    include($mosConfig_absolute_path."/modules/mod_dcount/".$mosConfig_lang.".php");
} else {
    include($mosConfig_absolute_path."/modules/mod_dcount/english.php"); }

    if ( file_exists($mosConfig_absolute_path."/templates/".$mainframe->getTemplate()."/css/dcount_css.css") ) {
?>
<link href="templates/<?php echo $mainframe->getTemplate(); ?>/css/dcount_css.css" rel="stylesheet" type="text/css"/>
<?php
    } else {
?>
<link href="modules/mod_dcount/dcount_css_default.css" rel="stylesheet" type="text/css"/>
<?php }?>

<div align="center">
	<script>
	function getRefToDiv(divID,oDoc) {
	    if( document.getElementById ) {
	        return document.getElementById(divID); }
	        if( document.all ) {
	            return document.all[divID]; }
	            if( !oDoc ) { oDoc = document; }
	            if( document.layers ) {
	                if( oDoc.layers[divID] ) { return oDoc.layers[divID]; } else {
	                    //repeatedly run through all child layers
	                    for( var x = 0, y; !y && x < oDoc.layers.length; x++ ) {
	                        //on success, return that layer, else return nothing
	                        y = getRefToDiv(divID,oDoc.layers[x].document); }
	                        return y; } }
	                        return false;
	}

	function getZeroPrint(number)
	{
	    strNum='';
	    if (number<10) strNum='0';
	    strNum+=(number);
	    return strNum;
	}

	function display_count(Time_Left,down,days,hours,minutes,seconds)
	{

	    if (down) getRefToDiv('countdown_title').innerHTML = '<?php echo DC_TITLE_COUNTDOWN; ?>';
	    else getRefToDiv('countdown_title').innerHTML = '<?php echo DC_TITLE_COUNTUP; ?>';

	    <?php echo $outString; ?>

	}

	function count_clock(year, month, day, hour, minute)
	{
	    //I chose a div as the container for the timer, but
	    //it can be an input tag inside a form, or anything
	    //who's displayed content can be changed through
	    //client-side scripting.

	    document.write('<?php echo DC_HTML_CODE ?>');

	    Today = new Date();
	    Todays_Year = Today.getFullYear() - 2000;
	    Todays_Month = Today.getMonth() + 1;

	    <?php
	    $date = getDate(time()- $cOffset*60*60);

	    $second = $date["seconds"];
	    $minute = $date["minutes"];
	    $hour = $date["hours"];
	    $day = $date["mday"];
	    $month = $date["mon"];
	    $month_name = $date["month"];
	    $year = $date["year"];
	    ?>

	    //Computes the time difference between the client computer and the server.
	    Server_Date = (new Date(<?php echo $year - 2000 ?>, <?php echo $month ?>, <?php echo $day ?>,
	    <?php echo $hour ?>, <?php echo $minute ?>, <?php echo $second ?>)).getTime();
	    Todays_Date = (new Date(Todays_Year, Todays_Month, Today.getDate(),
	    Today.getHours(), Today.getMinutes(), Today.getSeconds())).getTime();

	    count( year, month, day, hour, minute, (Todays_Date - (Server_Date)) );
	}

	function count(year, month, day, hour, minute, time_difference)
	{
	    Today = new Date();
	    Todays_Year = Today.getFullYear() - 2000;
	    Todays_Month = Today.getMonth() + 1;

	    //Convert today's date and the target date into miliseconds.

	    Todays_Date = (new Date(Todays_Year, Todays_Month, Today.getDate(),
	    Today.getHours(), Today.getMinutes(), Today.getSeconds())).getTime();
	    Target_Date = (new Date(year, month, day, hour, minute, 00)).getTime();

	    //Find their difference, and convert that into seconds.
	    //Taking into account the time differential between the client computer and the server.
	    Time_Left = Math.round((Target_Date - Todays_Date + time_difference ) / 1000);

	    down=0;
	    if (Time_Left>=0) down=1;

	    Time_Left = Math.abs(Time_Left);
	    days = Math.floor(Time_Left / (60 * 60 * 24));
	    Time_Left %= (60 * 60 * 24);
	    hours = Math.floor(Time_Left / (60 * 60));
	    Time_Left %= (60 * 60);
	    minutes = Math.floor(Time_Left / 60);
	    Time_Left %= 60;
	    seconds = Time_Left;

	    display_count(Time_Left,down,days,hours,minutes,seconds);

	    //Recursive call, keeps the clock ticking.
	    setTimeout('count(' + year + ',' + month + ',' + day + ',' + hour + ',' + minute + ',' +
	    time_difference + ');', 1000);
	}

	count_clock(<?php echo $cYear - 2000 ?>, <?php echo $cMonth ?>, <?php echo $cDay ?>, <?php echo $cHour ?>, <?php echo $cMinute ?>)

	</script>
</div>