<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleswitcher.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if ( $my->id ) {
initEditor();
}
mosShowHead();

// *************************************************
// Change this variable blow to switch color-schemes
//
// If you have any issues, check out the forum at
// http://www.rockettheme.com
//
// *************************************************

$default_style = "style14"; // style1 | style2 | style3 | ..... | style20
$template_width = "868"; // width in px | fluid
$side_width = "175"; // width in px
$menu_name = "mainmenu"; // mainmenu by default, can be any Joomla menu name
$menu_type = "moomenu"; // moomenu | suckerfish | splitmenu | module
$menu_side = "right"; // left | right
$default_font = "default";      // smaller | default | larger
$show_pathway = "false"; // true | false
$show_pulldown = "false"; // true | false


require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_styleloader.php");

$sidenav = false;
if ($mtype=="splitmenu") :
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_splitmenu.php");
$topnav = rtShowHorizMenu($menu_name);
$sidenav = rtShowSubMenu($menu_name, "-hilite2");
elseif ($mtype=="moomenu" or $mtype=="suckerfish") :
require($mosConfig_absolute_path."/templates/" . $mainframe->getTemplate() . "/rt_moomenu.php");
$sidenav = false;
endif;

if ($template_width=="fluid") {
$template_width = "width: 100%;";
} else {
$template_width = 'margin: 0 auto; width: ' . $template_width . 'px;';
}

// make sure sidenav is empty
if (strlen($sidenav) < 10) $sidenav = false;

//Are we in edit mode
$editmode = false;
if (  !empty( $_REQUEST['task'])  && $_REQUEST['task'] == 'edit'  ) :
$editmode = true;
endif;

?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/<?php echo $tstyle; ?>.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/slimbox/slimbox.css" rel="stylesheet" type="text/css" />
<?php if($mtype=="moomenu" or $mtype=="suckerfish") :?>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/rokmoomenu.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<!--[if lte IE 6]>
<style type="text/css">
#fxTab {background: none; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='templates/<?php echo $mainframe->getTemplate(); ?>/images/<?php echo $tstyle; ?>/fx-tab.png', sizingMethod='scale', enabled='true');}
img { behavior: url(<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/iepngfix.htc); }
</style>
<link href="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/css/template_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="shortcut icon" href="<?php echo $mosConfig_live_site;?>/images/favicon.ico" />
<style type="text/css">
td.left div.moduletable, td.right div.moduletable, td.left div.moduletable-hilite1, td.right div.moduletable-hilite1, td.left div.moduletable-hilite2, td.right div.moduletable-hilite2, td.left div.moduletable-hilite3, td.right div.moduletable-hilite3, td.left div.moduletable-hilite4, td.right div.moduletable-hilite4, td.left div.moduletable-hilite5, td.right div.moduletable-hilite5, td.left div.moduletable-hilite6, td.right div.moduletable-hilite6, td.left div.moduletable-hilite7, td.right div.moduletable-hilite7, td.left div.moduletable-hilite8, td.right div.moduletable-hilite8 { width: <?php echo $side_width; ?>px; }
div.wrapper { <?php echo $template_width; ?>}
</style>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/mootools-release-1.11.js"></script>
<?php if ($show_pulldown == "true") : ?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/roktools.js"></script>
<?php endif; ?>
<?php if($mtype=="moomenu") :?>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/mootools.bgiframe.js"></script>
<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/rokmoomenu.js"></script>
<script type="text/javascript">
window.addEvent('domready', function() {
new rokmoomenu($E('ul.nav'), {
bgiframe: false,
delay: 500,
animate: {
props: ['opacity', 'width', 'height'],
opts: {
duration:400,
fps: 100,
transition: Fx.Transitions.sineOut
}
}
});
});
</script>
<?php endif; ?>
<?php if($mtype=="suckerfish") :
echo "<!--[if IE]>\n";
include_once( "$mosConfig_absolute_path/templates/" . $mainframe->getTemplate() . "/js/ie_suckerfish.js" );
echo "<![endif]-->\n";
endif; ?>
</head>
<body id="page_bg" class="<?php echo $fontstyle; ?>">

<div>
<script language="javascript" type="text/javascript" src="http://www.atptennis.com/5/ptn/PTNmenus.js">;</script>
<div align="center" style="margin:0px;"><script type="text/javascript" src="http://www.atptennis.com/5/ptn/banner.js">;</script></div>
</div>

<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/templates/<?php echo $mainframe->getTemplate(); ?>/js/slimbox.js"></script>
<?php if ($show_pulldown == "true") : ?>
<div id="fxContainer">
<div id="fxTarget">
<div id="fxPadding" class="wrapper">
<?php mosLoadModules('header', -2); ?>
</div>
</div>
<div id="fxTab">
<span id="fxTrigger">&nbsp;</span>
</div>
</div>
<?php endif; ?>
<div style="left: 0px; top: 0px; position: absolute; z-index: 0; border: none;" align="left">





<img src="http://desarrollo.datapartner.cl/movistar/images/home/108x600.jpg" width="600" height="156" />
</div>
<div id="template" class="wrapper">
<div style="top: 0px; position: absolute; z-index: 0; border: none;">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="868" height="104">
<param name="movie" value="swf/cabecera_movistar.swf" />
<param name="quality" value="high" />
<param name="WMode" value="Transparent">
<embed src="swf/cabecera_movistar.swf" quality="high" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="868" height="104"></embed>
</object>
</div>
<div id="header">
<div id="banner">
<div class="padding">
<?php mosLoadModules('banner', -1); ?>
</div>
</div>
</div>
<div id="horiz-menu" class="<?php echo $mtype; ?>">
<div id="fondomenuhorizontal">
</div>

<?php if($mtype == "splitmenu") : ?>
<?php echo $topnav; ?>
<?php elseif($mtype == "moomenu" or $mtype=="suckerfish") : ?>
<?php mosShowListMenu($menu_name); ?>
<?php else: ?>
     <?php mosLoadModules('toolbar',-1); ?>
  <?php endif; ?>
</div>
<div id="top">
<?php if ($show_pathway == "true") : ?>
<?php mosPathway(); ?>
<?php endif; ?>
<?php mosLoadModules('top', -1); ?>
</div>
<?php $section1count = mosCountModules('advert1') + mosCountModules('user1') + mosCountModules('user2'); ?>
<?php if($section1count) : ?>
<?php $section1width = 'w' . floor(99 / $section1count); ?>
<div class="clr" id="section1">
<table class="sections" cellspacing="0" cellpadding="0">
<tr valign="top">
<?php if(mosCountModules('advert1')) : ?>
<td class="section <?php echo $section1width ?>">
<?php mosLoadModules('advert1', -2); ?>
</td>
<?php endif; ?>
<?php if(mosCountModules('user1')) : ?>
<td class="section <?php echo $section1width; ?>">
<?php mosLoadModules('user1', -2); ?>
</td>
<?php endif; ?>
<?php if(mosCountModules('user2')) : ?>
<td class="section <?php echo $section1width; ?>">
<?php mosLoadModules('user2', -2); ?>
</td>
<?php endif; ?>
</tr>
</table>
</div>
<?php endif; ?>
<div class="clr" id="mainbody">
<table class="mainbody" cellspacing="0" cellpadding="0">
<tr valign="top">
<?php if(!$editmode and (mosCountModules('left') or ($sidenav and $menu_side == 'left'))) : ?>
<td class="left" align="left">
<?php if($sidenav and $menu_side == 'left') : ?>
<div id="vert-menu">
<?php echo $sidenav; ?>
</div>
<?php endif; ?>
<?php mosLoadModules('left', -2); ?>
</td>
<?php endif; ?>
<td class="mainbody">
<?php $mainbodycount = mosCountModules('user3') + mosCountModules('user4'); ?>
<?php if($mainbodycount) : ?>
<?php $mainbodywidth = 'w' . floor(99 / $mainbodycount); ?>
<table class="sections" cellspacing="0" cellpadding="0">
<tr valign="top">
<?php if(mosCountModules('user3')) : ?>
<td class="section <?php echo $mainbodywidth; ?>">
<?php mosLoadModules('user3', -2); ?>
</td>
<?php endif; ?>
<?php if(mosCountModules('user4')) : ?>
<td class="section <?php echo $mainbodywidth; ?>">
<?php mosLoadModules('user4', -2); ?>
</td>
<?php endif; ?>
</tr>
</table>
<?php endif; ?>
<div class="padding">
<?php mosMainbody(); ?>
</div>
<?php $mainbody2count = mosCountModules('user5') + mosCountModules('user6'); ?>
<?php if($mainbody2count) : ?>
<?php $mainbody2width = 'w' . floor(99 / $mainbody2count); ?>
<table class="sections" cellspacing="0" cellpadding="0">
<tr valign="top">
<?php if(mosCountModules('user5')) : ?>
<td class="section <?php echo $mainbody2width; ?>">
<?php mosLoadModules('user5', -2); ?>
</td>
<?php endif; ?>
<?php if(mosCountModules('user6')) : ?>
<td class="section <?php echo $mainbody2width; ?>">
<?php mosLoadModules('user6', -2); ?>
</td>
<?php endif; ?>
</tr>
</table>
<?php endif; ?>
</td>
<?php if(!$editmode and (mosCountModules('right') or ($sidenav and $menu_side == 'right'))) : ?>
<td class="right" align="center">
<?php if($sidenav and $menu_side == 'right') : ?>
<div id="vert-menu">
<?php echo $sidenav; ?>
</div>
<?php endif; ?>
<?php mosLoadModules('right', -2); ?>
</td>
<?php endif; ?>
</tr>
</table>
</div>
<?php $section2count = mosCountModules('advert2') + mosCountModules('user7') + mosCountModules('user8'); ?>
<?php if($section2count) : ?>
<?php $section2width = 'w' . floor(99 / $section2count); ?>
<?php $block2div = (mosCountModules('advert2') and (mosCountModules('user7') or mosCountModules('user8'))) ? " divider" : ""; ?>
<?php $block3div = (mosCountModules('user8') and (mosCountModules('advert2') or mosCountModules('user8'))) ? " divider" : ""; ?>
<div class="clr" id="section2">
<table class="sections" cellspacing="0" cellpadding="0">
<tr valign="top">
<?php if(mosCountModules('advert2')) : ?>
<td class="section <?php echo $section2width; ?>">
<?php mosLoadModules('advert2', -2); ?>
</td>
<?php endif; ?>
<?php if(mosCountModules('user7')) : ?>
<td class="section <?php echo $section2width . $block2div; ?>">
<?php mosLoadModules('user7', -2); ?>
</td>
<?php endif; ?>
<?php if(mosCountModules('user8')) : ?>
<td class="section <?php echo $section2width . $block3div; ?>">
<?php mosLoadModules('user8', -2); ?>
</td>
<?php endif; ?>
</tr>
</table>
</div>
<?php endif; ?>

<div style="top: 0px; position: relative; border: none; visibility: visible;">
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="868" height="65">
<param name="movie" value="http://www.movistaropen.cl/images/banner_abajo.swf" />
<param name="quality" value="high" />
<embed src="http://www.movistaropen.cl/images/banner_abajo.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="868" height="65"></embed>
</object>
</div>

<div class="rk-1">
</div>
<?php mosLoadModules( 'debug', -1 );?>
</body>
</html>
<script type="text/javascript" src="embeddedcontent.js" defer="defer"></script>