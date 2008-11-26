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
$display = $params->get( 'display', 'latest' );
$source = $params->get( 'source', 'all_tag' );
$flickrid = $params->get( 'flickrid', '' );
//$grp = $params->get( 'group', '' );
$tag = $params->get( 'tag', '' );

?>
<div id="flickr_badge_uber_wrapper"><div id="flickr_badge_wrapper">
<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count; ?>&amp;display=<?php echo $display; ?>&amp;size=<?php echo $size; ?>&amp;layout=x&amp;source=<?php echo $source; ?>&amp;tag=<?php echo $tag; ?>&amp;user=<?php echo $flickrid; ?>"></script>
<div style="clear:both;"></div></div>
<a href="http://www.flickr.com" id="flickr_www">www.<strong style="color:#3993ff">flick<span style="color:#ff1c92">r</span></strong>.com</a>
</div>
<!-- End of Flickr Badge -->


