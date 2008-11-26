<?php
/*
	Desc:			Flickr Badge module, to display images from flickr
	Author:		Original Ben Coleman - Modified by Andy Miller (RocketTheme)
	Date:			03-31-2006
	Version: 	2.0
*/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// Get params
$count = $params->get( 'count', '3' );
$size = $params->get( 'size', 't' );
$display = $params->get( 'display', 'random' );
$source = $params->get( 'source', 'all' );
$flickrid = $params->get( 'flickrid', '' );
//$grp = $params->get( 'group', '' );
$tag = $params->get( 'tag', '' );

?>
<div id="flickr_badge_uber_wrapper"><a href="http://www.flickr.com" id="flickr_www">www.<strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong>.com</a><div id="flickr_badge_wrapper">
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?show_name=0&count=<?=$count?>&display=<?=$display?>&size=<?=$size?>&layout=x&source=<?=$source?>&tag=<?=$tag?>&user=<?=$flickrid?>"></script>
<div style="clear:both;"></div></div></div>
<!-- End of Flickr Badge -->


