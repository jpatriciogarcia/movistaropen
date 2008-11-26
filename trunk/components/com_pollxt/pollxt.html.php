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
global $mosConfig_lang, $my;

// Get the right language if it exists
if (file_exists($GLOBALS['mosConfig_absolute_path'] . '/components/com_pollxt/languages/'.$mosConfig_lang.'.php')) {
	include ($GLOBALS['mosConfig_absolute_path'] . '/components/com_pollxt/languages/'.$mosConfig_lang.'.php');
} else {
	include ($GLOBALS['mosConfig_absolute_path'] . '/components/com_pollxt/languages/english.php');
}

class poll_html {

	function showResults(& $poll, & $questions, & $votes, $rpoll, $pollist, $params, $Itemid, $page = 0) {
		global $mosConfig_live_site, $my;
		if (!empty ($poll->css))
			$stylesheet = $poll->css;
		else
			$stylesheet = "poll_bars";
?>
<link rel="stylesheet" href="components/com_pollxt/<?php echo $stylesheet; ?>.css" type="text/css" />
<form name="poll" id="poll">
  <table cellpadding="0" <?php if ($pollist) echo "cellspacing=\"4\"" ?> border="0" width="100%" class="contentpane<?php echo $params->def( 'pageclass_sfx' ); ?>">

    <?php if ( $params->def( 'page_title' ) ) { ?>
    <tr>
      <td class="componentheading<?php echo $params->def( 'pageclass_sfx' ); ?>">
        <?php echo $page->header ?>
      </td>
    </tr>
    <?php } ?>
    <?php if ($pollist) { ?>
    <tr>
        <td align="left"><?php echo _SEL_POLL; ?>&nbsp;</td>
        <td align="left"><?php echo $pollist; ?></td>
    </tr>
    <?php } ?>

    <tr>
      <td colspan="2" width = "100%" align="center"> 
<?php


		if ($votes)
			graphit($questions, $votes, $rpoll, $poll, $params, $Itemid);
		else
			echo _NO_RESULTS;
?>
      </td>
    </tr>
</table>
</form>
<?php
	$isPopup = mosGetParam($_REQUEST, 'isPopup', 0);
        if ($isPopup == 1) { ?>
        <br>
        <a href="" class="button" onClick="JavaScript:self.close()"> <?php echo _PROMPT_CLOSE;?></a>
        
        <?php }
        else
		// displays back button
        mosHTML :: BackButton($params);

}
	function showDetail($poll, $result, $params, $page) {
		global $tabclass, $mosConfig_live_site;
		$title = "";
		$question = "";

		$tabclass_arr = explode(",", $tabclass);
		$tabcnt = 0;
		if (!empty ($poll->css))
			$stylesheet = $poll->css;
		else
			$stylesheet = "poll_bars";
?>
		<link rel="stylesheet" href="components/com_pollxt/<?php echo $stylesheet; ?>.css" type="text/css" />
      
      	<table cellpadding="1" cellspacing="0" border="0" width="100%" class="contentpane<?php echo $params->def( 'pageclass_sfx' ); ?>">
		<?php 	
			if ( $params->def( 'page_title' ) ) { ?>
    			<tr>
      				<td class="componentheading<?php echo $params->def( 'pageclass_sfx' ); ?>">
      				<?php echo $page->header ?></td>
   				</tr>
		<?php } ?>

         <tr><td>

 <table width = 100% class='pollstableborder<?php echo $params->def( 'pageclass_sfx' ); ?>' cellspacing="0" cellpadding="0" border="0">

  <tr>
    <td colspan="6" class="sectiontableheader<?php echo $params->def( 'pageclass_sfx' ); ?>"> <img src="<?php echo $mosConfig_live_site; ?>/components/com_pollxt/images/poll.png" align="absmiddle" border="0" width="12" height="14" /> <?php echo $poll->title; ?> </td>
  </tr>

 		<?php

		foreach ($result as $r) {
			if ($r->title <> $title) {
				$title = $r->title;
		?>
          <tr>
           <td class="componentheading<?php echo $params->def( 'pageclass_sfx' ); ?>" colspan="6"><?php echo $title; ?></td>
          </tr>
        <?php
			}
			if ($r->qoption <> $question) {
				$question = $r->qoption;
				$tabcnt = 0;
		?>
         <tr>
          <td width="10">&nbsp</td>
          <td colspan="5"><?php echo $question; ?></td>
         </tr>
         <?php }                    ?>
        <tr class="<?php echo $tabclass_arr[$tabcnt]; ?>">
          <td width ="20">&nbsp</td>
          <td width ="20">&nbsp</td>
          <td><?php echo $r->ip; ?></td>
          <td><?php echo $r->user; ?></td>
          <td><?php echo mosFormatDate ($r->datu, _DATE_FORMAT_LC); ?></td>
          <td><?php echo stripslashes($r->value); ?></td>

         </tr>
          <?php
				$tabcnt = 1 - $tabcnt;
			}
?>
 </table>
</td></tr>
 </table>
 <br>
 <center>
 <?php

			// displays back button

			mosHTML :: BackButton($params);

		}

		function showList($polls, $params, $tabclass, $polllist, $Itemid) {
			global $mosConfig_absolute_path, $my;
			require_once ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/pollxt.inc.php");

			if ($params->def('page_title')) {
?>
			<div class="componentheading<?php echo $params->def( 'pageclass_sfx' ); ?>">
			<?php echo $polllist->header; ?>
			</div>
			<?php


			}
?>


		<form action="index.php" method="post" name="adminForm">

		<table width="100%" cellspacing="1" cellpadding="3" border="0" align="center" class="contentpane<?php echo $params->def( 'pageclass_sfx' ); ?>">
		<tr>
			<td width="60%" valign="top" class="contentdescription<?php echo $params->def( 'pageclass_sfx' ); ?>" colspan="2">
			<?php


			// show image
			if ($polllist->img) {
?>
				<img src="<?php echo $polllist->img; ?>" align="<?php echo $polllist->align; ?>" hspace="6" alt="" />
				<?php


			}
			echo $polllist->descrip;
?>
			</td>
		</tr>

		<tr>
            <td>
		<table cellspacing="1" cellpadding="3" width="100%" border="0" cellspacing="0" cellpadding="0">
        <?php


			if ($params->def('headings')) {
?>
			<tr>
        <?php


				if ($params->def('voted')) {
?>
				<td height="20" class="sectiontableheader<?php echo $params->def( 'pageclass_sfx' ); ?>">
				<?php echo _POLLXT_VOTABLE ?>
                </td>
    <?php


				}
?>

				<td width="80%" height="20" class="sectiontableheader<?php echo $params->def( 'pageclass_sfx' );?>">
				<?php echo _POLLXT_POLL_TITLE ?>
				</td>
<?php


				if ($params->def('votes')) {
?>
				<td height="20" class="sectiontableheader<?php echo $params->def( 'pageclass_sfx' ); ?>">
				<?php echo _POLLXT_VOTES ?>
                </td>
    <?php


				}
?>

			</tr>

<?php   } ?>
<?php


				$k = 0;
				foreach ($polls as $poll) {
					$link = sefRelToAbs('index.php?option=com_pollxt&task=voting&pollid='.$poll->id.'&Itemid='.$Itemid);
					$menuclass = 'category'.$params->def('pageclass_sfx');
					$txt = '<a href="'.$link.'"class='.$menuclass.'>'.$poll->title.'</a>';
?>
			<tr class="<?php echo $tabclass[$k]; ?>">
<?php       if ( $params->def( 'voted' )) { ?>
            	<td><center>
            <?php


					if (checkVote($poll) && (!$poll->multivote)) {
?>
                 <img src="<?php echo $polllist->itemimg ?>" />
<?php


					} else {
?>
                 <img src="<?php echo $polllist->itemimgnot ?>" />

    <?php


					}
				}
?>
                </center>
				</td>

				<td>
				<?php


				echo $txt;
				if ($params->def('item_description')) {
					echo "<br>".$poll->intro;
				}
?>
              </td>
<?php       if ( $params->def( 'votes' )) { ?>
            	<td><center>

    <?php
				echo $poll->voters;
?>
        </td>
<?php } ?>

			</tr>
			<?php


				$k = 1 - $k;
			}
?>
		</table>
			</td>
		</tr>
		</table>
		</form>
		<?php
			// displays back button
			mosHTML :: BackButton($params);

		}
	}

	function graphit(& $questions, & $data_arr, $rpoll, $poll, $params, $Itemid) {

		global $mosConfig_live_site, $polls_maxcolors, $tabclass, $my, $polls_barheight, $polls_barcolor, $mosConfig_absolute_path;
		require ($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/conf.pollxt.php");
    	$tabclass_arr = array ('sectiontableentry1', 'sectiontableentry2');
		$height = $xt_height;
		$polls_maxcolors = $xt_maxcolors;
		$polls_graphwidth = 100;

		$tabcnt = 0;
		$colorx = 0;
		$i = $j = 0;
?>
<br />
<table class='pollstableborder<?php echo $params->def( 'pageclass_sfx' ); ?>' cellspacing="0" cellpadding="0" border="0" width = "100%">
  <tr>
    <td colspan="2" class="sectiontableheader<?php echo $params->def( 'pageclass_sfx' ); ?>"> 
      <img src="<?php echo $mosConfig_live_site; ?>/components/com_pollxt/images/poll.png" align="absmiddle" border="0" width="12" height="14" />
      <?php echo $poll->title; ?> 
     </td>
  </tr>
  <?php


		$j = 0;
		foreach ($questions as $question) {
?>
  <tr>
    <td colspan="2">
	<?php 
	if ($question->img_url) {
	 echo "<img src=\"";
	 echo $mosConfig_live_site.$xt_imgpath.$question->img_url;
	 echo "\" ".$question->imgor."=\"".$question->imgsize."\"/>";
	 }
	echo $question->title ?>
    </td>
  </tr>
    <?php


			$total = 0;
			if (isset ($data_arr[$j])) {
				for ($i = 0, $n = count($data_arr[$j]); $i < $n; $i ++) {
					$text = $data_arr[$j][$i]["text"];
					$hits = $data_arr[$j][$i]["hits"];
?>
  <tr class="<?php echo $tabclass_arr[$tabcnt]; ?>">
    <td width="100%" colspan="2">&nbsp;&nbsp; <?php echo $data_arr[$j][$i]["img"].$text; ?></td>
  </tr>
  <tr class="<?php echo $tabclass_arr[$tabcnt]; ?>">
    <td>
      <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr class='<?php echo $tabclass_arr[$tabcnt]; ?>'>
        <?php if ($poll->sh_abs) { ?>
          <td align="right" width="25"> <b><?php echo $hits; ?></b> </td>
          <td align="left" width="2">&nbsp; </td>
        <?php


				}
				if ($poll->sh_perc) {
					;
?>
          <td width="30" align="left"> <?php echo $data_arr[$j][$i]['perc']; ?>%
          </td>
          <?php


				}
				$tdclass = '';
				if ($polls_barcolor == 0) {
					if ($colorx < $polls_maxcolors) {
						$colorx = ++ $colorx;
					} else {
						$colorx = 1;
					}
					$tdclass = "polls_color_".$colorx;
				} else {
					$tdclass = "polls_color_".$polls_barcolor;
				}
?>
          <td width="<?php echo $polls_graphwidth; ?>%" align="left" >
            <table width = "100%">

              <tr>
                <td  width="<?php echo $polls_graphwidth; ?>%" align="left" >
                    <img src='<?php echo $mosConfig_live_site; ?>/components/com_pollxt/images/blank.png' class='<?php echo $tdclass; ?>' height="<?php echo $height; ?>" width='<?php echo $data_arr[$j][$i]['width']; ?>%' />
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <?php


				$tabcnt = 1 - $tabcnt;
			}
		}
		$j ++;
	}
?>
</table>

<br />
<table cellspacing="0" cellpadding="0" border="0">
<?php if ($poll->sh_numvote) { ?>
  <tr>
    <td class='smalldark<?php echo $params->def( 'pageclass_sfx' ); ?>'> <?php echo _NUM_VOTERS; ?> </td>
    <td class='smalldark<?php echo $params->def( 'pageclass_sfx' ); ?>'> &nbsp;:&nbsp;<?php echo $poll->voters; ?> </td>
  </tr>
<?php


}
if ($poll->sh_flvote) {
?>
  <tr>
    <td class='smalldark<?php echo $params->def( 'pageclass_sfx' ); ?>'> <?php echo _FIRST_VOTE; ?> </td>
    <td class='smalldark<?php echo $params->def( 'pageclass_sfx' ); ?>'> &nbsp;:&nbsp;<?php echo $rpoll->firstVote; ?> </td>
  </tr>
  <tr>
    <td class='smalldark<?php echo $params->def( 'pageclass_sfx' ); ?>'> <?php echo _LAST_VOTE; ?> </td>
    <td class='smalldark<?php echo $params->def( 'pageclass_sfx' ); ?>'> &nbsp;:&nbsp;<?php echo $rpoll->lastVote; ?> </td>
  </tr>
<?php } ?>
</table>
<br />
<?php


	$isPopup = mosGetParam($_REQUEST, 'isPopup', 0);
	$admin = mosGetParam($_REQUEST, 'admin', 0);

	if (($poll->rdispd) or ($my->usertype == "Super Administrator") || $admin) {
		if ($poll->rdisp == 2 or $isPopup) {
?>
 <input type="button" class="button" value="<?php echo _POLLXT_DETAIL?>" onclick="location.href='<?php echo $mosConfig_live_site; ?>/index2.php?option=com_pollxt&isPopup=1&id=<?php echo $poll->id.'&Itemid='.$Itemid?>&task=detail'" />
<?php } else { ?>
 <input type="button" class="button" value="<?php echo _POLLXT_DETAIL?>" onclick="location.href='<?php echo $mosConfig_live_site; ?>/index.php?option=com_pollxt&amp;id=<?php echo $poll->id.'&amp;Itemid='.$Itemid?>&amp;task=detail'" />
 <?php


		}
	}

}
?>





