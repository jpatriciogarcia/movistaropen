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
class xthtml {
	var $headerimg = null;
	var $version = null;
	var $name = null;
	
	function xthtml() {
	}

	function cpanelInfo() {
		global $mosConfig_absolute_path;
		
?>
        <table style="border: solid 1px #d5d5d5;" cellpadding="4" cellspacing="2" border="0" width="100%">
            <tr >
             <td colspan="2" class = "cpanel" bgcolor = "#FFFFFF"width="100%">
                <span class="sectionname">
                  <img src="<?php echo $this->headerimg; ?>" align="middle" /><?php echo $this->name; ?>
                   Component
                </span>
             </td>
            </tr>
            <tr>
             <td bgcolor = "#FFFFFF" style="font-variant:small-caps;">
                  Installed Version:
             </td>
             <td bgcolor = "#FFFFFF">
             <?php echo $this->version; ?>
             </td>
            </tr>
            <tr>
             <td bgcolor = "#FFFFFF" style="font-variant:small-caps;">
                  Copyright:
             </td>
             <td bgcolor = "#FFFFFF">
             &copy; 2004-2007 <a href="mailto:webmaster@joomlaxt.com">Oli Merten</a>
             </td>
            </tr>
            <tr>
             <td bgcolor = "#FFFFFF" style="font-variant:small-caps;">
                  License:
             </td>
             <td bgcolor = "#FFFFFF">
             <a href="http://www.gnu.org/copyleft/gpl.html" target="_blank">GNU GPL</a>
             </td>
            </tr>
            <tr>
             <td bgcolor = "#FFFFFF" style="font-variant:small-caps;">
                  Project Homepage:
             </td>
             <td bgcolor = "#FFFFFF">
             <a href="http://www.joomlaxt.com" target="_blank">www.joomlaXT.com</a>
             </td>
            </tr>
            <tr>
             <td valign="top" bgcolor = "#FFFFFF" style="font-variant:small-caps;">
                  Credits:
             </td>
             <td bgcolor = "#FFFFFF">
             <a href="http://www.joomla.org" target="_blank">Joomla!</a> for the worlds best CMS<br/>
             All unnamed beta-testers<br/>
             All unnamed translators <br/>
             and of course all users which frequently provide feedback, report bugs and feed me with new ideas
             </td>
            </tr>
            <tr>
             <td valign="top" bgcolor = "#FFFFFF" style="font-variant:small-caps;">
                  Donate:
             </td>
             <td bgcolor = "#FFFFFF">

<form action="https://www.paypal.com/cgi-bin/webscr" target="_blank" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Donation with PayPal">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
</form>
             </td>
            </tr>

        </table>


<?php

	}
}
?>
