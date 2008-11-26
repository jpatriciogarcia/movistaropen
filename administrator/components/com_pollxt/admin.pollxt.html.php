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


require_once ($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_pollxt/class.compat.15.php');

class HTML_poll
{
 
function showPolls( &$rows, &$pageNav, $option ) {
                global $my, $mosConfig_live_site, $_VERSION;



?>

<script type="text/javascript">
function alertClear() {
 return confirm("<?php echo "Do you really want to delete all results?" ?>");
}
</script>

<form action="index2.php" method="POST" name="adminForm">
<input type="hidden" name="hidemainmenu" value="0" />

<?php $header = new xtTitle("PollXT"); echo $header->show("Poll Manager") ?>

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminlist">
  <tr>
   <th  colspan="2" align="left">Poll Title</th>
   <th width ="10%" align="center">ID</th>
   <th width ="10%" align="center">Questions</th>
   <th width ="10%" align="center">Published</th>
   <th width ="10%" align="center">Checked Out</th>
   <th width ="10%" colspan = "2" align="center">Ordering</th>
   <th width ="10%" align="center">Clear data</th>
   <th width ="10%" colspan="2" align="center">Display results</th>
  </tr>

<?php
$k = 0;
$j = 0;
for ($i=0, $n=count( $rows ); $i < $n; $i++) {
 $row = &$rows[$i];

 $link 	= 'index2.php?option=com_pollxt&task=editA&hidemainmenu=1&id='. $row->id;

 $task 	= $row->published ? 'unpublish' : 'publish';
 $img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
 $alt 	= $row->published ? 'Published' : 'Unpublished';

 if ($_VERSION->DEV_LEVEL >= 2) {
  $checked 	= mosCommonHTML::CheckedOutProcessing( $row, $i );
 } else {
  $checked = "<input type=\"checkbox\" id=\"cb".$i."\" name=\"cid[]\" value=\"".$row->id."\" onclick=\"isChecked(this.checked);\" />";
  }
?>

 <tr class="<?php echo "row$k"; ?>">
  <td width="10">
  <?php  echo $checked  ?>
  </td>
  <td align="left">
    <a href="<?php echo $link ?>"><?php echo stripslashes($row->title); ?></a>
  </td>
  <td  align="center"><?php echo $row->id; ?>&nbsp;</td>
  <td  align="center"><?php echo $row->numoptions; ?>&nbsp;</td>
<?php
  $task = $row->published ? 'unpublish' : 'publish';
  $img = $row->published ? 'publish_g.png' : 'publish_x.png';
?>
  <td align="center"><a href="javascript: void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $task;?>')"><img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="" /></a></td>
  <td align="center"><?php echo $row->editor; ?>&nbsp;</td>
  <td align="right">
<?php echo $pageNav->orderUpIcon( $i );  ?>
  </td>
  <td align="left">

<?php echo $pageNav->orderDownIcon( $i, $n );  ?>
 </td>

<td width="10%" align="center"><a href="#clear" onclick="alertClear(); return listItemTask('cb<?php echo $i;?>','clear')"><img src="components/com_pollxt/delete.gif" width="12" height="12" border="0" alt="" /></a></td>
<td width="5%" align="center">
<a href="#" onClick="javascript:window.open('<?php echo $mosConfig_live_site.'/index2.php?option=com_pollxt&isPopup=1&admin=1&task=results&id='.$row->id;?>','Result', 'resizable=yes, scrollbars=yes, location=no, menubar=no, status=no, toolbar=no, width=640, height=480')">
<img src="components/com_pollxt/preview.gif" width="12" height="12" border="0" alt="" />
</a>
</td>
<td width="5%" align="center">(<?php echo $row->voters?>)</td>
<?php                $k = 1 - $k; $j++; ?>
</tr>
<?php        } ?>
</table>
<?php echo $pageNav->getListFooter(); ?>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="task" value="show" />
<input type="hidden" name="boxchecked" value="0" />

</form>
        <?php
}

function editPoll( $mypoll, $questions, $options, $menulist, $conf, $images, $option, $lists, $tab) {

mosMakeHtmlSafe( $mypoll, ENT_QUOTES );
?>
<link rel="stylesheet" type="text/css" media="all" href="../includes/js/calendar/calendar-mos.css" title="green" />
<script type="text/javascript" src="../includes/js/calendar/calendar.js"></script>
<!-- import the language module -->
<script type="text/javascript" src="../includes/js/calendar/lang/calendar-en.js"></script>

        <script language="javascript" type="text/javascript">
        function XTexpandAll() {
          for (var i = 0; i < <?php echo count($questions) ?>; i++) {
            xtname = "opt" + i.toString();
            switchonoff(xtname);
          }
        }

        function switchonoff(name) {
                name_pic = name + "_pic"
                name_opt = "conf[" + name + "]";

                if (document.getElementById(name).style.display=="none")
                 {
                  document.getElementById(name).style.display="block";
                  document.getElementById(name_pic).src="components/com_pollxt/minus.gif";
                  document.getElementById(name_opt).value = 1;

                 }
                else
                 {
                 document.getElementById(name).style.display="none";
                 document.getElementById(name_pic).src="components/com_pollxt/plus.gif";
                  document.getElementById(name_opt).value = "";
                 }
                }
        function addOption(quid, pollid) {
                var form = document.adminForm;
                form.pollid.value = pollid;
                form.quid.value = quid;
                submitform('addOption');
                }
        function addQuestion(pollid) {
//                if (pollid==undefined)
//                 {alert("Save new poll before adding questions");
//                 return;}
                var form = document.adminForm;
                form.pollid.value = pollid;
                submitform('addQuestion');
              }
        function copyQuestion(quid, pollid) {
                var form = document.adminForm;
                form.pollid.value = pollid;
                form.quid.value = quid;
                submitform('copyQuestion');
                }

        function submitbutton(pressbutton) {
                var form = document.adminForm;
                if (pressbutton == 'cancel') {
                form.pollid.value = '<?php echo $mypoll['id']?>';
                submitform( pressbutton );
                        return;
                }
                 // do field validation
                if (document.getElementById("title").value == "") {
                      alert( "Poll must have a title" );
                } else if( isNaN( parseInt( document.getElementById("lag").value ) ) ) {
                        alert( "Poll must have a non-zero lag time" );
                } else if ( (document.getElementById("email").checked == true) && (
                             document.getElementById("subject").value == "" ||
                             document.getElementById("emailtext").value == ""   ))
                             {
                      alert( "Please maintain Email-fields" );
                } else if ( (document.getElementById("email").checked == true) && (
                             document.getElementById("ulog").checked == false))
                             { document.getElementById("ulog").checked = true;
                      alert( "Email-Confirmation requires users to be logged on" );


                } else
                    submitform( pressbutton );
                }

        function typeChange(i, val) {
              multi = "multi"+i;
              if (val=='4' || val=='7') {
              document.getElementById(multi).style.visibility = "visible" }
              else {
              document.getElementById(multi).style.visibility = "hidden" }

              }
        function activate(id, togglePic) {
           field = document.getElementById(id);
           pic = togglePic;
           if (field.value == 0) {
            document.getElementById(id).value = 1;
            pic.src = 'images/publish_x.png';
            pic.alt = 'inactive';
            }
           else {
            document.getElementById(id).value = 0;
            pic.src = 'images/publish_g.png';
            pic.alt = 'active';
            }
        }
        </script>


<?php $header = new xtTitle("PollXT"); echo $header->show($mypoll['id'] ? 'Edit'." \"".$mypoll['title']."\"" : 'Add/Copy'." \"".$mypoll['title']." Poll") ?>

<form action="index2.php" method="POST" name="adminForm">
    <script type="text/javascript" src="js/dhtml.js"></script>
<?php		$tabs = new xtTabs(1);
		$tabs->startPane("poll_pane");
		$tabs->startTab("Configuration","config_tab");
?>

    <table cellpadding="5" cellspacing="0" border="0" width=
    "100%" class="adminform">
      <tr>
        <td width="70%">
          <table valign="top" class="adminform">
            <tr>
              <td>
                Title:
              </td>
              <td colspan="3" valign="top">
                <input class="inputbox" id="title" type="text"
                name="mypoll[title]" size="75" value=
                "<?php echo $mypoll['title']; ?>">
              </td>
            </tr>
            <tr>
              <td valign="top">
                Hide Title:
              </td>
              <td valign="top">
                <input type="hidden" name="mypoll[hidetitle]"
                value="0"> <input type="checkbox" class=
                "checkbox" name="mypoll[hidetitle]" value=
                "1" <?php if ($mypoll['hidetitle'] == 1) echo "checked" ?>>
              </td>
            </tr>
            <tr>
              <td>
                Ordering:
              </td>
              <td colspan="3" valign="top">
                <?php echo $lists['ordering']; ?>
              </td>
            </tr>
            <tr>
              <td>
                Shown in:
              </td>
              <td valign="middle" colspan="3">
                <select class="inputbox" name="mypoll[type]">
                  <option <?php if ($mypoll['type'] == '1') echo 'selected';?>
                   value='1'>
                    Module
                  </option>
                  <option <?php if ($mypoll['type'] == '2') echo 'selected';?>
                   value='2'>
                    Component
                  </option>
                  <option <?php if ($mypoll['type'] == '0') echo 'selected';?>
                   value='0'>
                    Component &amp; Module
                  </option>
                </select>
              </td>
            </tr>
            <tr>
              <td valign="top">
                Image:
              </td>
              <td valign="middle">
                <select class="inputbox" name="mypoll[img_url]">
                  <option value="">
                  </option>
                  <?php foreach($images as $img) { ?>
                  <option <?php if ($mypoll['img_url'] == $img) echo 'selected';?>
                   value='<?php echo $img; ?>'>
                    <?php echo $img; ?>
                  </option>
                  <?php } ?>
                </select>
              </td>
              <td valign="middle">
                <select class="inputbox" name="mypoll[imgor]">
                  <option <?php if ($mypoll['imgor'] == 'width') echo 'selected';?>
                   value='width'>
                    width
                  </option>
                  <option <?php if ($mypoll['imgor'] == 'height') echo 'selected';?>
                   value='height'>
                    height
                  </option>
                </select> <input class="inputbox" type="text"
                name="mypoll[imgsize]" value=
                "<?php echo htmlspecialchars( $mypoll['imgsize'], ENT_QUOTES ); ?>"
                 size="5">
              </td>
              <td valign="middle">
              <input type="hidden" name="mypoll[imglink]" value="0">
                      <input type="checkbox" class="checkbox" name="mypoll[imglink]" value="1" <?php if ($mypoll['imglink'] == 1) echo "checked" ?>/>
                      Link
                 
              </td>
            </tr>
            <tr>
              <td width="20%" valign="top">
                Voting allowed from:
              </td>
              <td nowrap width="20%" valign="top">
                <input readonly class="inputbox" type="text"
                name="mypoll[datefrom]" id="mypoll[datefrom]"
                size="12" maxlength="19" value=
                "<?php echo $mypoll['datefrom']; ?>"> <a href="#"
                onclick=
                "return showCalendar('mypoll[datefrom]', 'y-mm-dd');">
                <img src="components/com_pollxt/datepicker.gif" alt="Calendar"
                border="0"></a> <a href="#" onclick=
                "document.getElementById('mypoll[datefrom]').value='0000-00-00';">
                <img src="components/com_pollxt/cancel.gif" alt="Clear"
                border="0"></a>
              </td>
              <td nowrap width="22%" valign="top">
                to: <input readonly class="inputbox" type="text"
                name="mypoll[dateto]" id="mypoll[dateto]" size=
                "12" maxlength="19" value=
                "<?php echo $mypoll['dateto']; ?>"> <a href="#"
                onclick=
                "return showCalendar('mypoll[dateto]', 'y-mm-dd');">
                <img src="components/com_pollxt/datepicker.gif" alt="Calendar"
                border="0"></a> <a href="#" onclick=
                "document.getElementById('mypoll[dateto]').value='0000-00-00';">
                <img src="components/com_pollxt/cancel.gif" alt="Clear"
                border="0"></a>
              </td>
            </tr>
            <tr>
              <td width="20%" valign="top">
                Time from:
              </td>
              <td width="20%" valign="top">
                <input class="inputbox" type="text"
                name="mypoll[timefrom]" id="mypoll[timefrom]"
                size="12" maxlength="19" value=
                "<?php echo $mypoll['timefrom']; ?>">
              </td>
              <td width="22%" valign="top">
                to: <input class="inputbox" type="text"
                name="mypoll[timeto]" id="mypoll[timeto]" size=
                "12" maxlength="19" value=
                "<?php echo $mypoll['timeto']; ?>">
              </td>
            </tr>
            <tr>
              <td valign="top">
                Multiple Voting:
              </td>
              <td valign="top">
                <input type="hidden" name="mypoll[multivote]"
                value="0"> <input type="checkbox" class=
                "checkbox" name="mypoll[multivote]" value=
                "1" <?php if ($mypoll['multivote'] == 1) echo "checked" ?>>
                <input class="inputbox" id="lag" type="hidden"
                name="mypoll[lag]" size="10" value=
                "<?php echo $mypoll['lag']; ?>">
              </td>
            </tr>
            <tr>
              <td valign="top" align="right">
                Only logged on users:
              </td>
              <td valign="top">
                <input type="hidden" name="mypoll[logon]" value=
                "0"> <input id="ulog" type="checkbox" class=
                "checkbox" name="mypoll[logon]" value=
                "1" <?php if ($mypoll['logon'] == 1) echo "checked" ?>>
              </td>
            </tr>
            <tr>
              <td>
                After Voting go to:
              </td>
              <td valign="middle">
                <select class="inputbox" name="mypoll[goto]">
                  <option <?php if ($mypoll['goto'] == '0') echo 'selected';?>
                   value='0'>
                    Results
                  </option>
                  <option <?php if ($mypoll['goto'] == '1') echo 'selected';?>
                   value='1'>
                    Nowhere
                  </option>
                  <option <?php if ($mypoll['goto'] == '2') echo 'selected';?>
                   value='2'>
                    URL
                  </option>
                </select>
              </td>
              <td colspan="2" valign="top">
                URL: <input class="inputbox" type="text" name=
                "mypoll[goto_url]" value=
                "<?php echo htmlspecialchars( $mypoll['goto_url'], ENT_QUOTES ); ?>"
                 size="40" maxlength="80">
              </td>
            </tr>
            <tr>
              <td valign="top">
                Intro Text:
              </td>
              <td colspan="3" valign="top">
                <textarea class="text_area" name="mypoll[intro]" cols="50" rows="3"
                wrap="soft"><?php echo $mypoll['intro']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td valign="top">
                Thank you Text:
              </td>
              <td colspan="3" valign="top">
                <textarea class="text_area" name="mypoll[thanks]" cols="50" rows=
                "3" wrap="soft"><?php echo $mypoll['thanks']; ?></textarea>
              </td>
            </tr>
            <tr>
              <td valign="top" align="right">
                Email Confirmation required:
              </td>
              <td valign="top">
                <input type="hidden" name="mypoll[email]" value=
                "0"> <input id="email" type="checkbox" class=
                "checkbox" name="mypoll[email]" value=
                "1" <?php if ($mypoll['email'] == 1) echo 'checked' ?>>
              </td>
            </tr>
            <tr>
              <td valign="top">
                Email-Subject:
              </td>
              <td colspan="3">
                <input id="subject" class="inputbox" type="text"
                name="mypoll[subject]" value=
                "<?php echo htmlspecialchars( $mypoll['subject'], ENT_QUOTES ); ?>"
                 size="80" maxlength="80">
              </td>
            </tr>
            <tr>
              <td valign="top">
                Email-Text:
              </td>
              <td colspan="3" valign="top">
                <textarea class="text_area" id="emailtext" name="mypoll[emailtext]"
                cols="50" rows="3" wrap="soft"><?php echo $mypoll['emailtext']; ?></textarea>
              </td>
            </tr>
          </table>
        </td>
        <td valign="top">
          <table valign="top" class="adminform">
            <tr>
              <td>
                Show on menu items:<br>
                 
              </td>
            </tr>
            <tr>
              <td valign="top" colspan="3" rowspan="4">
                <?php echo $menulist; ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
<!-- Tab 2 -->

<?php $tabs->endTab();
$tabs->startTab("Questions","quest_tab");

?>
<table align="left" class="adminform" width="98%" >
   <tr>
<td>
<table><tr>
    <td width="8%"><button class="button" onclick="addQuestion(<?php echo $mypoll['id']?>)" style="font-size:10px">Add question</button></td>
    <td width="8%"><button class="button" type=button onclick="XTexpandAll()" style="font-size:10px">Expand/Collapse</button></td>
    <td></td>
</tr>
</table>
</td>
    </tr>
   <tr>
<td>

<?php
                for ($i=0, $j=0, $n=count( $questions ); $i < $n; $i++ ) { ?>
<table align="left" class="adminform" width="98%" >

<tr>
 <td colspan="2">&nbsp;<td>
 <td style="font-weight:bold">Question</td>
 <td style="font-weight:bold">Type</td>
 <td style="font-weight:bold">Lines</td>
 <td style="font-weight:bold">Image</td>
 <td style="font-weight:bold">Image Size</td>
 <td style="font-weight:bold">Link</td>
 <td style="font-weight:bold">Oblig.</td>
 </tr>

                         <tr>

                         <td><a onClick="javascript:copyQuestion(<?php echo '\''.$questions[$i]['id'].'\','.$questions[$i]['pollid']?>)"><img src="components/com_pollxt/copy.gif" alt="Copy Question" border="0"></a></td>
                                <td><a onClick="activate(<?php echo '\'pollquestion['.$i.'][inact]\', toggle'.$i;?>)" >
                 <?php if ($questions[$i]['inact']) { $img="publish_x.png"; $alt="active"; }
                       else {$img="publish_g.png"; $alt="inactive";} ?>

                                <img id="toggle<?php echo $i; ?>" src="images/<?php echo $img; ?>" alt="<?php echo $alt; ?>" border="0"></a>

                                <input type="hidden" name="pollquestion[<?php echo $i ?>][id]" value="<?php echo $questions[$i]['id'] ?>">
                                <input type="hidden" name="pollquestion[<?php echo $i ?>][pollid]" value="<?php echo $questions[$i]['pollid'] ?>">

                         <input type="hidden" id="pollquestion[<?php echo $i ?>][inact]" name="pollquestion[<?php echo $i ?>][inact]" value="<?php echo $questions[$i]['inact'];?>" />

                         </td>

                                <td>
                                <a onClick="switchonoff('opt<?php echo $i; ?>')" >
                                 <img id="opt<?php echo $i; ?>_pic" src="components/com_pollxt/plus.gif" alt="" border="0">
                                 </a>
                                 </td>

                                <td ><input class="inputbox" type="text" name="pollquestion[<?php echo $i ?>][title]" value="<?php echo htmlspecialchars( $questions[$i]['title'], ENT_QUOTES ); ?>" size="40" /></td>
                                <td>
                                  <select class="inputbox" name="pollquestion[<?php echo $i ?>][type]" onChange="typeChange(<?php echo $i ?>, this.value)">
                                   <option <?php if ($questions[$i]['type'] == '1') echo 'selected';?> value='1'>Radiobutton</option>
                                   <option <?php if ($questions[$i]['type'] == '2') echo 'selected';?> value='2'>Checkbox</option>
                                   <option <?php if ($questions[$i]['type'] == '3') echo 'selected';?> value='3'>Listbox</option>
                                   <option <?php if ($questions[$i]['type'] == '4') echo 'selected';?> value='4'>Multi select</option>
                                   <option <?php if ($questions[$i]['type'] == '6') echo 'selected';?> value='6'>None</option>
                                   <option <?php if ($questions[$i]['type'] == '5') echo 'selected';?> value='5'>Separator</option>
                                  </select>
                                 </td>
                         <td valign="top">
                          <input id="multi<?php echo $i ?>" class="inputbox" type="text" name="pollquestion[<?php echo $i ?>][multisize]" value="<?php echo htmlspecialchars( $questions[$i]['multisize'], ENT_QUOTES ); ?>" size="4" maxlength="3"
                          <?php if ($questions[$i]['type'] == "4" ) 
                            echo "style=\"visibility:visible;\""; 
                            else echo "style=\"visibility:hidden\""; ?>
                            />
                         </td>
                                <td>
                                  <select class="inputbox" style="width:100px" name="pollquestion[<?php echo $i ?>][img_url]" >
                                     <option value=""></option>
                                     <?php foreach($images as $img) { ?>
                                      <option <?php if ($questions[$i]['img_url'] == $img) echo 'selected';?> value='<?php echo $img; ?>'><?php echo $img; ?></option>

                                     <?php } ?>
                                  </select>
                                 </td>
                         <td valign="top">
                          <select class="inputbox" name="pollquestion[<?php echo $i ?>][imgor]" >
                                   <option <?php if ($questions[$i]['imgor'] == 'width') echo 'selected';?> value='width'>width</option>
                                   <option <?php if ($questions[$i]['imgor'] == 'height') echo 'selected';?> value='height'>height</option>
                          </select>
                          <input class="inputbox" type="text" name="pollquestion[<?php echo $i ?>][imgsize]" value="<?php echo htmlspecialchars( $questions[$i]['imgsize'], ENT_QUOTES ); ?>" size="5" />
                          </td>
                          <td><center>
                          <input type="hidden" name="pollquestion[<?php echo $i ?>][imglink]" value="0">
                          <input type="checkbox" class="checkbox" name="pollquestion[<?php echo $i ?>][imglink]" value="1" <?php if ($questions[$i]['imglink'] == 1) echo "checked" ?>/></center>
                         </td>

                         <td><center>
                         <input type="hidden" name="pollquestion[<?php echo $i ?>][obli]" value="0">
                         <input type="checkbox" class="checkbox" name="pollquestion[<?php echo $i ?>][obli]" value="1" <?php if ($questions[$i]['obli'] == 1) echo "checked" ?>/></center>
                          </td>
                         </tr>

 </table>
</td>
</tr>

<tr>
<td>
                 <table align="left" width="100%"  class="adminform" id="opt<?php echo $i;?>">
                  <tr>
                   <td colspan="6">
                    <input type="hidden" id="conf[opt<?php echo $i;?>]" name="conf[opt<?php echo $i;?>]" value="<?php $b = 'opt'.$i; echo $conf[$b];?>">
<?php if ($questions[$i]['type'] <> "5") { ?>
                    <button class="button" style="font-size:10px" type="button" onclick="addOption('<?php echo $questions[$i]['id'] ?>', <?php echo $questions[$i]['pollid'] ?>)">add option</button>
<?php } ?>
                   </td>
                  </tr>
                  
<?php if (isset( $options[$i] ) > 0) { ?>
<tr>
 <td width="60">&nbsp;<td>
 <td>&nbsp;<td>
 <td style="font-weight:bold" >ID</td>
 <td style="font-weight:bold" >Option</td>
 <td style="font-weight:bold">Image</td>
 <td style="font-weight:bold">Image Size</td>
 <td style="font-weight:bold">Link</td>
 <td style="font-weight:bold">Freetext</td>
 <td style="font-weight:bold">Rows</td>
 <td style="font-weight:bold">Cols</td>
 <td style="font-weight:bold">new Option?</td>
 </tr>
 
 <?php }
                 if (isset($options[$i])) { $myoption = $options[$i];

                 for ($j=0, $o=count( $myoption ); $j < $o; $j++ ) { ?>
                         <tr>
 <td width="60">&nbsp;<td>
                         <td><a onClick="activate(<?php $z=($i+1)*1000+$j; echo '\'polloption['.$i.']['.$j.'][inact]\', toggle'.$z;?>)" >
                 <?php
                  if ($myoption[$j]['inact']) { $img="publish_x.png"; $alt="active"; }
                       else {$img="publish_g.png"; $alt="inactive";} ?>

                                <img id="toggle<?php echo ($i+1)*1000+$j; ?>" src="images/<?php echo $img; ?>" alt="<?php echo $alt; ?>" border="0"></a>
                         <input type="hidden" name="polloption[<?php echo $i.']['.$j ?>][inact]" id="polloption[<?php echo $i.']['.$j ?>][inact]" value="<?php echo $myoption[$j]['inact']; ?>"/>
                         </td>
                                <td >
                                 <input type="hidden" name="polloption[<?php echo $i.']['.$j ?>][id]" value="<?php echo $myoption[$j]['id'] ?>">
                                 <input type="hidden" name="polloption[<?php echo $i.']['.$j ?>][quid]" value="<?php echo $myoption[$j]['quid'] ?>">
                               </td>
                                <td><?php echo $myoption[$j]["id"] ?></td>
                                <td ><input class="inputbox" type="text" name="polloption[<?php echo $i.']['.$j ?>][qoption]" value="<?php echo htmlspecialchars( $myoption[$j]['qoption'], ENT_QUOTES ); ?>" size="40" /></td>
                                <td>
                                <select class="inputbox" style="width:100px;" name="polloption[<?php echo $i.']['.$j ?>][img_url]" >
                                     <option value=""></option>
                                     <?php foreach($images as $img) { ?>
                                      <option <?php if ($myoption[$j]['img_url'] == $img) echo 'selected';?> value='<?php echo $img; ?>'><?php echo $img; ?></option>
                                     <?php } ?>
                                  </select>
                               </td>
                         <td>
                          <select class="inputbox" name="polloption[<?php echo $i.']['.$j ?>][imgor]" >
                                   <option <?php if ($myoption[$j]['imgor'] == 'width') echo 'selected';?> value='width'>width</option>
                                   <option <?php if ($myoption[$j]['imgor'] == 'height') echo 'selected';?> value='height'>height</option>
                          </select>
                                <input class="inputbox" type="text" name="polloption[<?php echo $i.']['.$j ?>][imgsize]" value="<?php echo htmlspecialchars( $myoption[$j]['imgsize'], ENT_QUOTES ); ?>" size="5" />
                          </td>
                          <td><center>
                          <input type="hidden" name="polloption[<?php echo $i.']['.$j ?>][imglink]" value="0">
                          <input type="checkbox" class="checkbox" name="polloption[<?php echo $i.']['.$j ?>][imglink]" value="1" <?php if ($myoption[$j]['imglink'] == 1) echo "checked" ?>/></center>
                         </td>

                         <td><center>
                         <input type="hidden" name="polloption[<?php echo $i.']['.$j ?>][freetext]" value="0">
                         <input type="checkbox" class="checkbox" name="polloption[<?php echo $i.']['.$j ?>][freetext]" value="1" <?php if ($myoption[$j]['freetext']  == 1) echo "checked"; ?>/></center>
                         </td>

                         <td valign="top">
                          <input class="inputbox" type="text" name="polloption[<?php echo $i.']['.$j ?>][multirows]" 
                          value="<?php echo htmlspecialchars( $myoption[$j]['multirows'], ENT_QUOTES ); ?>" size="4" maxlength="3"
                            />
                         </td>
                         <td valign="top">
                          <input class="inputbox" type="text" name="polloption[<?php echo $i.']['.$j ?>][multicols]" 
                          value="<?php echo htmlspecialchars( $myoption[$j]['multicols'], ENT_QUOTES ); ?>" size="4" maxlength="3"
                            />
                         </td>
                         <td valign="top">
                          <select class="inputbox" name="polloption[<?php echo $i.']['.$j ?>][newopt]" >
                                   <option <?php if ($myoption[$j]['newopt']  == 0) echo  'selected';?> value='0'>never</option>
                                   <option <?php if ($myoption[$j]['newopt']  == 1) echo  'selected';?> value='1'>only registered</option>
                                   <option <?php if ($myoption[$j]['newopt']  == 2) echo  'selected';?> value='2'>always (unpubl.)</option>
                                   <option <?php if ($myoption[$j]['newopt']  == 3) echo  'selected';?> value='3'>always (publ.)</option>
                          </select>
                         </td>
                         <td colspan = 2>&nbsp;</td>
                         </tr>

<?php       }} ?>
                </table>
                  </td></tr><tr><td>
<?php } ?>

                  </td></tr>
                  </table>
<?php $tabs->endTab();
$tabs->startTab("Results","result_tab");
?>

<table align=left class="adminform" width="98%" >
<tr>
<td width = "50%">
 <table align=left class="adminform" width="98%" >
   <tr>
    <td width="30%" align="right valign" = "top" >Results-Display:</td>
    <td valign = "top" >
     <select name="mypoll[rdisp]" class="listbox">
      <option value = '3' <?php if ($mypoll['rdisp'] == 3) echo 'selected'; ?>>Same Window</option>
      <option value = '1' <?php if ($mypoll['rdisp'] == 1) echo 'selected'; ?>>Main Window</option>
      <option value = '2' <?php if ($mypoll['rdisp'] == 2) echo 'selected'; ?>>Popup</option>
      </select></td></tr>

    <tr>
    <td valign = "top" >Results-Button:</td>
    <td valign = "top" >
     <select name="mypoll[rdispb]" class="listbox">
      <option value = '1' <?php if ($mypoll['rdispb'] == 1) echo 'selected'; ?>>always</option>
      <option value = '2' <?php if ($mypoll['rdispb'] == 2) echo 'selected'; ?>>only after voting</option>
      <option value = '3' <?php if ($mypoll['rdispb'] == 3) echo 'selected'; ?>>only Admin</option>
      <option value = '4' <?php if ($mypoll['rdispb'] == 4) echo 'selected'; ?>>never</option>
     </select></td></tr>

    <tr>
    <td valign = "top" >Show results detail:</td>
    <td valign = "top" >
      <input type="hidden" name="mypoll[rdispd]" value="0">
      <input align=left type="checkbox" class="checkbox" name="mypoll[rdispd]" value="1" <?php if ($mypoll['rdispd'] == 1) echo "checked" ?>/>
    </td></tr>
    <tr>
    <td valign = "top" >Show all options:</td>
    <td valign = "top" >
      <input type="hidden" name="mypoll[rdispall]" value="0">
      <input align=left type="checkbox" class="checkbox" name="mypoll[rdispall]" value="1" <?php if ($mypoll['rdispall'] == 1) echo "checked" ?>/>
    </td></tr>

    <tr>
    <td valign=top>Stylesheet:</td>
    <td valign = "top" >
    <input class="inputbox" id="mypoll[css]" type="text" name="mypoll[css]" size="20" value="<?php echo $mypoll['css']; ?>" />
    </td></tr>
</table>
</td>
<td>
<table align=left class="adminform" width="98%" >
    <tr>
    <td colspan = 3 valign=top>Show fields in results...<br>&nbsp;
    </td></tr>
    <tr>
    <td>&nbsp;</td>
    <td valign = "top" >Total number of Voters</td>
    <td>
      <input type="hidden" name="mypoll[sh_numvote]" value="0">
      <input align=left type="checkbox" class="checkbox" name="mypoll[sh_numvote]" value="1" <?php if ($mypoll['sh_numvote'] == 1) echo "checked" ?>/>
    </td></tr>
    
    <tr>
    <td>&nbsp;</td>
    <td valign = "top" >First/Last Vote (Date)</td>
    <td align=left>
      <input type="hidden" name="mypoll[sh_flvote]" value="0">
      <input align=left type="checkbox" class="checkbox" name="mypoll[sh_flvote]" value="1" <?php if ($mypoll['sh_flvote'] == 1) echo "checked" ?>/>
    </td></tr>

    <tr>
    <td>&nbsp;</td>
    <td valign = "top" >Absolut no. of Votes</td>
    <td>
    <input type="hidden" name="mypoll[sh_abs]" value="0">
      <input align=left type="checkbox" class="checkbox" name="mypoll[sh_abs]" value="1" <?php if ($mypoll['sh_abs'] == 1) echo "checked" ?>/>
    </td></tr>

    <tr>
    <td>&nbsp;</td>
    <td valign = "top" >Percentage</td>
    <td>
      <input type="hidden" name="mypoll[sh_perc]" value="0">
      <input align=left type="checkbox" class="checkbox" name="mypoll[sh_perc]" value="1" <?php if ($mypoll['sh_perc'] == 1) echo "checked" ?>/>
    </td></tr>
</table>
    </td>
  </tr>
<tr>
<td colspan = 2>
<table align="left" class="adminform" width="98%" >
    <tr>
    <td width="20%" valign = "top" >Send results via email</td>
    <td>
     <select name="mypoll[mailres]" class="listbox">
      <option value = '0' <?php if ($mypoll['mailres'] == 0) echo 'selected'; ?>>No</option>
      <option value = '1' <?php if ($mypoll['mailres'] == 1) echo 'selected'; ?>>complete</option>
      <option value = '2' <?php if ($mypoll['mailres'] == 2) echo 'selected'; ?>>short</option>
      <option value = '3' <?php if ($mypoll['mailres'] == 3) echo 'selected'; ?>>tiny</option>
     </select>
     </td>
     <td valign ="top" rowspan="3">
     You can also determine email-receivers dynamically depending on the option(s) a user selected. To define e.g. that  webmaster always receives an email with the results, Oli receives an email if option no. 6 is selected and admin, if option 7 is selected , enter:<br>
     <input size="65" type="text" class="input" readonly="readonly" value="webmaster@joomlaxt.com;6:oli@joomlaxt.com;7:admin@joomlaxt.com"></input>
     </td>
    </tr>
    <tr>
    <td valign=top>Email receivers (separated by ";"):</td>
    <td valign = "top" >
    <input class="inputbox" id="mypoll[mailresrec]" type="text" name="mypoll[mailresrec]" size="70" value="<?php echo $mypoll['mailresrec']; ?>" />
    </td></tr>
    
    <tr>
    <td valign="top">
     Email-Intro-Text: (Variables: &lt;uname&gt;, &lt;date&gt; &lt;polltitle&gt;)
    </td>
    <td valign="top">
      <textarea class="text_area" name="mypoll[mailrestxt]"
                cols="50" rows="3" wrap="soft"><?php echo $mypoll['mailrestxt']; ?></textarea>
   	</td>
    </tr>
</table>
    </td>
  </tr>
</table>

                 <?php
$tabs->endTab();
$tabs->endPane();

?>



                <input type="hidden" name="task" value="">
                <input type="hidden" name="quid" value="">
                <input type="hidden" name="pollid" value="">
                <input type="hidden" name="option" value="<?php echo $option;?>" />
                <input type="hidden" name="id" value="<?php echo $mypoll['id']; ?>" />
                <input type="hidden" name="mypoll[id]" value="<?php echo $mypoll['id']; ?>" />
                <input type="hidden" name="textfieldcheck" value="<?php echo $n; ?>" />

        </form>
<div style="clear:both"></div>
<script type="text/javascript">
<?php for ($i=0, $j=0, $n=count( $questions ); $i < $n; $i++ ) { ?>
 if (document.getElementById("conf[opt<?php echo $i;?>]").value == "") {
 document.getElementById("opt<?php echo $i;?>").style.display="none" ;}
 else {
 document.getElementById("opt<?php echo $i;?>").style.display="block" ;}
<?php
}
?>
</script>


<?php
 }
  function edit_settings ($option, $config, $tod, $images, $com_pollxt_ver) {

$comp = new xtTabs(1);

    ?>
        <script language="javascript" type="text/javascript">
        function submitbutton(pressbutton) {

                if (pressbutton == 'save' )
                 submitform('saveSettings');
                else

                 submitform(pressbutton);
         }
        </script>
    <script type="text/javascript" src="js/dhtml.js"></script>

<?php $header = new xtTitle("PollXT"); echo $header->show("General Settings") ?>

    <form action="index2.php" method="post" name="adminForm">

<?php	/*	$tabs = new mosTabs(1); */
		$comp->startPane("xtsettings_pane"); 
		$comp->startTab("Frontend","poll_tab");
		
?>

    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong>Polls to Display:</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[disp]" >
          <option <?php if ($config['disp'] == '1') echo 'selected';?> value='1'>all published</option>
          <option <?php if ($config['disp'] == '2') echo 'selected';?> value='2'>only one </option>
          <option <?php if ($config['disp'] == '3') echo 'selected';?> value='3'>only where voting is possible </option>
         </select>
        </td>
       <td valign="top">Defines which polls should be displayed in the Polls Module</td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong>Order to display Polls:</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[order]" >
          <option <?php if ($config['order'] == '1') echo 'selected';?> value='1'>in sequence</option>
          <option <?php if ($config['order'] == '2') echo 'selected';?> value='2'>random</option>
         </select>
        </td>
       <td valign="top">Defines the order in which Polls are displayed (or the first if only one)</td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong>Initially hide options:</strong></td>
        <td valign="top">
         <input type="hidden" name="config[hide]" value="0">
         <input type="checkbox" class="checkbox" name="config[hide]" value="1" <?php if ($config['hide'] == 1) echo 'checked'; ?>/>
        </td>
        <td valign="top">Use this option if you have a lot of questions/polls, then initially only Poll titles are displayed, questions/options hidden</td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong>Show Select-Box</strong></td>
        <td valign="top">
         <input type="hidden" name="config[selpo]" value="0">
         <input type="checkbox" class="checkbox" name="config[selpo]" value="1" <?php if ($config['selpo'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top">If you display only one poll, the user has the possibility to choose the others</td>
      </tr>
      <tr><td colspan = 3><hr></td></tr>
      <tr>
        <td width="120" valign="top"><strong>Button Styling:</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[button_style]" >
          <option <?php if ($config['button_style'] == '0') echo 'selected';?> value='0'>Standard</option>
          <option <?php if ($config['button_style'] == '1') echo 'selected';?> value='1'>Background Image (with Text)</option>
          <option <?php if ($config['button_style'] == '2') echo 'selected';?> value='2'>Individual Styling</option>
         </select>
        </td>
       <td valign="top">Choose a layout method for the Buttons</td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong>Image for voting button</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[imgvote]" >
          <option value=""></option>
          <?php foreach($images as $img) { ?>
           <option <?php if ($config['imgvote'] == $img) echo 'selected';?> value='<?php echo $img; ?>'><?php echo $img; ?></option>
          <?php } ?>
         </select>
        </td>
        <td valign="top">Select an image from /images/stories, if you prefer to have a picture instead of the voting-button</td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong>Image for results button</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[imgresult]" >
          <option value=""></option>
          <?php foreach($images as $img) { ?>
           <option <?php if ($config['imgresult'] == $img) echo 'selected';?> value='<?php echo $img; ?>'><?php echo $img; ?></option>
          <?php } ?>
         </select>
        </td>
        <td valign="top">Select an image from /images/stories, if you prefer to have a picture instead of the results-button</td>
      </tr>
   </table>
<!-- Page 2 -->
<?php $comp->endTab();
$comp->startTab("Results","result_tab");
?>

    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong>Order by</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[orderby]" >
          <option <?php if ($config['orderby'] == 'hits') echo 'selected';?> value='hits'>Hits</option>
          <option <?php if ($config['orderby'] == 'a.id') echo 'selected';?> value='a.id'>ID</option>
         </select>
        </td>
       <td valign="top">Defines the order of the poll results</td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong>&nbsp;</strong></td>
        <td valign="top">
         <select class="inputbox" name="config[asc]" >
          <option <?php if ($config['asc'] == 'ASC') echo 'selected';?> value='ASC'>Ascending</option>
          <option <?php if ($config['asc'] == 'DESC') echo 'selected';?> value='DESC'>Descending</option>
         </select>
        </td>
       <td valign="top"></td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong>Show Select-Box for Results</strong></td>
        <td valign="top">
         <input type="hidden" name="config[resselpo]" value="0">
         <input type="checkbox" class="checkbox" name="config[resselpo]" value="1" <?php if ($config['resselpo'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top">User has the choice to view the results of other polls</td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong>only published in results</strong></td>
        <td valign="top">
         <input type="hidden" name="config[publ]" value="0">
         <input type="checkbox" class="checkbox" name="config[publ]" value="1" <?php if ($config['publ'] == 1) echo 'checked' ?>/>
        </td>
        <td valign="top">Check this box if you only want to see results for published Polls, leave unchecked for all results</td>
      </tr>
      <tr>
        <td width="120" valign"top" ><strong>Results-Display:</strong></td>
    <td valign = "top" >
     <select name="config[rdisp]" class="listbox">
      <option value = '1' <?php if ($config['rdisp'] == 1) echo 'selected'; ?>>Main Window</option>
      <option value = '2' <?php if ($config['rdisp'] == 2) echo 'selected'; ?>>Popup</option>
      </select></td>
        <td valign="top">Default value for results display (may be overriden in Poll)</td>
      </tr>

    <tr>

      <tr><td colspan = 3><hr></td></tr>
      <tr>
        <td width="120" valign="top"><strong>Bars in result: Maxcolors</strong></td>
        <td valign="top">
         <input class="inputbox" type="text" name="config[maxcolors]" value="<?php echo htmlspecialchars( $config['maxcolors'], ENT_QUOTES ); ?>" size="3" />
        </td>
        <td valign="top">How many different colors do you have defined in the stylesheet for the results display</td>
       </tr>
       <tr>
        <td width="120" valign="top"><strong>Bars in result: Height</strong></td>
        <td valign="top">
         <input class="inputbox" type="text" name="config[height]" value="<?php echo htmlspecialchars( $config['height'], ENT_QUOTES ); ?>" size="3" />
        </td>
        <td valign="top">Height of the bars in results display</td>
       </tr>
      </table>
<!-- Page 3 -->
<?php $comp->endTab();
$comp->startTab("Security","secu_tab");
?>

    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong>enable Cookies</strong></td>
        <td valign="top">
         <input id=scookie type="hidden" name="config[scookie]" value="0">
         <input id=scookie type="checkbox" class="checkbox" name="config[scookie]" value="1" <?php if ($config['scookie'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top">If this checkbox is selected, cookies will be issued to each voter, to prevent multiple voting</td>
      </tr>
      <tr>
        <td width="120" valign="top"><strong>enable IP-check</strong></td>
        <td valign="top">
         <input id=sip type="hidden" name="config[sip]" value="0">
         <input id=sip type="checkbox" class="checkbox" name="config[sip]" value="1" <?php if ($config['sip'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top">If this checkbox is selected, IP address from which the user accesse will be checked to prevent multiple voting</td>
      </tr>

      <tr>
        <td width="120" valign="top"><strong>enable Username-check</strong></td>
        <td valign="top">
         <input id=sip type="hidden" name="config[suname]" value="0">
         <input id=sip type="checkbox" class="checkbox" name="config[suname]" value="1" <?php if ($config['suname'] == 1) echo "checked" ?>/>
        </td>
        <td valign="top">If this checkbox is selected, the username (only for logged on users) will be checked to prevent multiple voting</td>
      </tr>
		</table>

<?php
$comp->endTab();
$comp->startTab("Miscellaneous","misc_tab");
?>
    <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><strong>Root path for images</strong></td>
        <td valign="top">
         <input class="inputbox" type="text" name="config[imgpath]" value="<?php echo htmlspecialchars( $config['imgpath'], ENT_QUOTES ); ?>" size="40" />
        </td>
        <td align="left" valign="top">Indicate the root path here, were the images for your polls are stored</td>
      </tr>
    </table>
<?php
$comp->endTab();
$comp->endPane();
?>


    <input type="hidden" name="option" value="<?php echo $option;?>" />
    <input type="hidden" name="task" value="saveSettings" />
    <input type="hidden" name="boxchecked" value="0" />

    </form>
<div style="clear:both">
      <table cellpadding="2" cellspacing="4" border="0" width="100%" class="adminform">
      <tr>
        <td width="120" valign="top"><img src="images/help_f2.png" alt="Help"></td>
        <td colspan = 2 valign=top>
        <?php echo $tod; ?>
        </td>
      </tr>
    </table>
</div>
<?php   }


	function showMamboPolls( &$rows, &$pageNav, $option ) {
		global $my;

		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		
		<?php $header = new xtTitle("PollXT"); echo $header->show("Import Polls") ?>

		<table class="adminlist">
		<tr>
			<th width="5">
			#
			</th>
			<th width="20">
			<input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th align="left">
			Poll Title
			</th>
			<th width="10%" align="center">
			Published
			</th>
			<th width="10%" align="center">
			Options
			</th>
		</tr>
		<?php
		$k = 0;
		for ($i=0, $n=count( $rows ); $i < $n; $i++) {
			$row = &$rows[$i];

			$link 	= 'index2.php?option=com_poll&task=editA&hidemainmenu=1&id='. $row->id;

			$task 	= $row->published ? 'unpublish' : 'publish';
			$img 	= $row->published ? 'publish_g.png' : 'publish_x.png';
			$alt 	= $row->published ? 'Published' : 'Unpublished';

            $checked = "<input type=\"checkbox\" id=\"cb".$i."\" name=\"cid[]\" value=\"".$row->id."\" onclick=\"isChecked(this.checked);\" />";			?>
			<tr class="<?php echo 'row$k'; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<?php echo $checked; ?>
				</td>
				<td>
				<?php echo $row->title; ?>
				</td>
				<td align="center">
				<img src="images/<?php echo $img;?>" width="12" height="12" border="0" alt="<?php echo $alt; ?>" />
				</td>
				<td align="center">
				<?php echo $row->numoptions; ?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>

		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}

function cPanel($option, $rows, $limit, $limitstart, $pageNav) {
  global $mosConfig_absolute_path, $mosConfig_live_site, $database;
	require_once($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_pollxt/conf.pollxt.php');
?>
<?php $header = new xtTitle("PollXT"); echo $header->show("Control Panel") ?>

<table class="adminform">
<tr>
	<td width="50%" valign="top">
    <table width="100%" class="adminform">
    <tr>
	   <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=settings&amp;hidemainmenu=1">
	        <img src="images/config.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       Global Settings
	       </a>
	       </div></div></div>
        </td>
	   <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=show" style="text-decoration:none;">
	       <img src="images/addedit.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       Maintain Polls
	       </a>
	       </div></div>
        </td>
	   <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=import" style="text-decoration:none;">
	       <img src="images/backup.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       Import Polls
	       </a>
	       </div></div></div>
        </td>
    </tr>
	   <td valign="top" >
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="http://www.joomlaXT.com" target="_blank" style="text-decoration:none;">
	       <img src="images/support.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       Support Homepage
	       </a>
	       </div></div></div>
        </td>
        <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=checkUpdate" style="text-decoration:none;">
	       <img src="images/install.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       Online Upgrade
	       </a>
	       </div></div></div>
        </td>
        <td valign="top">
	    <div id="cpanel">
	   		<div class="icon">
	   		<div class="iconimage">
	       <a href="index2.php?option=com_pollxt&amp;task=exportList" style="text-decoration:none;">
	       <img src="images/downloads_f2.png" width="48" height="48" align="middle" border="0"/>
	       <br />
	       Export Results (CSV)
	       </a>
	       </div></div></div>
        </td>
        </tr>
    </table>
<form action="index2.php" method="POST" name="adminForm">
    <table class="adminlist">
        <tr>
            <th>Poll</th>
            <th>Votes</th>
        </tr>
        <?php
        $i = 0;
        foreach ( $rows as $row ) {
            $link 	= 'index2.php?option=com_pollxt&task=editA&hidemainmenu=1&id='. $row->id; ?>
        <tr>
		  <td>
		      <a href ="<?php echo $link ?>"><?php echo $row->title;?></a>
		  </td>
		  <td>
		      <a href="#" onClick="javascript:window.open('<?php echo $mosConfig_live_site.'/index2.php?option=com_pollxt&isPopup=1&admin=1&task=results&id='.$row->id;?>','Result', 'resizable=yes, scrollbars=yes, location=no, menubar=no, status=no, toolbar=no, width=640, height=480')">
<?php echo $row->voters;?></a>
		  </td>
	   </tr>
	   <?php
	       $i++;
        }
        ?>
    </table>
    <?php echo $pageNav->getListFooter(); ?>
    <input type="hidden" name="option" value="<?php echo $option;?>" />
    </form>
	</td>
    

    <td width="50%" valign="top">
	<?php include($GLOBALS['mosConfig_absolute_path'] . "/administrator/components/com_pollxt/xthtml.class.php");
 	$myhtml = new xthtml();
 	$myhtml->version = $xt_config->version;
 	$myhtml->name = "PollXT";
 	$myhtml->headerimg = "components/com_pollxt/pollxt.png";
 	echo $myhtml->cpanelInfo();
	?>
    </td>
</tr>
</table>
<?php
}

function updateResult($option, $msg) {
  global $mosConfig_live_site;
    mosCommonHTML::loadOverlib();

?>
   <table class="adminheading" border="0">
   <tr>
      <th class="install">PollXT Upgrade</th>
   </tr>
   </table>
<form action="index2.php" method="post" name="adminForm">

<table width = "75%" class="adminlist">
<?php
 foreach ($msg as $m) {
    if ($m->type == "e") $fc="bb0000";
    if ($m->type == "s") $fc="009900";
    if ($m->type == "i") $fc="000000";

?>
<tr>
 <td style="color:#<?php echo $fc?>; font-weight:bold; font-size:12px"><?php echo $m->text ?></td>
</tr>
<?php } ?>
</table>
</form>
<?php
}
function exportList( &$rows, &$pageNav, $option ) {
                global $my, $mosConfig_live_site, $_VERSION;

?>

<form action="index2.php" method="POST" name="adminForm">
<input type="hidden" name="hidemainmenu" value="0" />

<?php $header = new xtTitle("PollXT"); echo $header->show("Export Manager") ?>

<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminlist">
  <tr>
   <th  colspan="2" align="left">Poll Title</th>
   <th width ="10%" align="center">ID</th>
   <th width ="10%" align="center">Questions</th>
   <th width ="10%" align="center">Votes</th>  </tr>

<?php
$k = 0;
$j = 0;
for ($i=0, $n=count( $rows ); $i < $n; $i++) {
 $row = &$rows[$i];

 $link 	= 'index2.php?option=com_pollxt&task=doexport&hidemainmenu=1&cid[]='. $row->id;


  $checked = "<input type=\"checkbox\" id=\"cb".$i."\" name=\"cid[]\" value=\"".$row->id."\" onclick=\"isChecked(this.checked);\" />";

?>

 <tr class="<?php echo "row$k"; ?>">
  <td width="10">
  <?php  echo $checked  ?>
  </td>
  <td align="left">
    <a href="<?php echo $link ?>"><?php echo stripslashes($row->title); ?></a>
  </td>
  <td  align="center"><?php echo $row->id; ?>&nbsp;</td>
  <td  align="center"><?php echo $row->numoptions; ?>&nbsp;</td>
  <td  align="center"><?php echo $row->voters; ?>&nbsp;</td>
<?php                $k = 1 - $k; $j++; ?>
</tr>
<?php        } ?>
</table>
<?php echo $pageNav->getListFooter(); ?>

<input type="hidden" name="option" value="<?php echo $option;?>" />
<input type="hidden" name="task" value="show" />
<input type="hidden" name="boxchecked" value="0" />

</form>
        <?php
}

}
?>
