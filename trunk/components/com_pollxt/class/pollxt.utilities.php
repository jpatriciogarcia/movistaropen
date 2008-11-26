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

function createImg($link = "1", $url, $or = "width", $size = "100%", $sfx ="", $path, $class, $imgpar) {

	$imgurl = xtSefRelToAbs($path.$url);
	$html = "";
	$html = "<div class=\"".$class.$sfx."\">";

	if ($link == 1) {
		$clicklink = "window.open('".$imgurl."','Pic', '".$imgpar."')"; 
		$html .= "<a style=\"cursor:pointer\" onkeypress=\"".$clicklink."\" onclick = \"".$clicklink."\">";
	}
	$html .= "<img border=\"0\" ".$or."="."\"".$size."\" src=".$imgurl." />";
	if ($link == 1) $html .= "</a>";
	$html .= "</div>";
	return $html;
}

class xtUtil {
	function xtUtil($question, $i) {
	 	$multiple = "";
		switch ($question[3]) {
					case 2 :
						$type = "checkbox";
						break;
					case 3 :
						$type = "select";
						$multiple = "size='1'";
						break;
					case 4;
						$type = "select";
						$multiple = "multiple size=".$question['multisize'];
						break;
					case 6;
						$type = "hidden";
						break;
					case 7;
						$type = "textarea";
						break;
					default :
						$type = "radio";
						break;
		}
		$this->type = $type;
		$this->multiple = $multiple;
		$this->qcount = $i;
	}
	function getOptions($options) {
	$tabclass_arr = array ("sectiontableentry2".$this->sfx, "sectiontableentry1".$this->sfx);
	$tabcnt = 0;
	$html = "";
		if ($this->type == "select") {
			$vid = intval($this->qcount);
			if (!empty ($options[0]['img_url'])) {
			 	$html = createImg($options[0]['imglink'], $options[0]['img_url'], $options[0]['imgor'], $options[0]['imgsize'], $this->sfx, $this->imgpath, $tabclass_arr[$tabcnt], $this->imgpar);
			}
            $html .= "<div class='".$tabclass_arr[$tabcnt]."'>".
                	 "<select ".$this->multiple." class=\"inputbox".$this->sfx."\"".
                     "name=\"voteid[".$vid."][]\" >";
            foreach ($options as $o) { 
            	$html .= "<option value=\"".$o[0]."\" >".$o[2]."</option>";
			}
            $html .= "</select>";
            $html .= "</div>";
		}
		else {
		 	$i = 0;
            foreach ($options as $o) { 
				if ($this->type == "radio")
					$vid = intval($this->qcount) * 100;
				else
					$vid = intval($this->qcount) * 100 + intval($i);
				
				$img[$i] = "";
				$free[$i] = "";
				if (!empty ($o['img_url'])) {
			 	$img[$i] = createImg($o['imglink'], $o['img_url'], $o['imgor'], $o['imgsize'], $this->sfx, $this->imgpath, $tabclass_arr[$tabcnt], $this->imgpar);
				}
				if ($this->type=="radio") $lab = "label_radio";
				if ($this->type=="checkbox") $lab = "label_check";
				
				$inp[$i]  = "<div class='".$tabclass_arr[$tabcnt]."'>";
				$inp[$i] .= "<label class=\"".$lab."\" for=\"voteid[".$vid."][]\">";
		 		$inp[$i] .= "<input type=\"".$this->type."\" name=\"voteid[".$vid."][]\"".
                  	     "id=\"p".$o[0]."\" value=\"".$o[0]."\" />";
                $inp[$i] .= $o[2]."</label></div>";
				
				if ($o['freetext']==1) {
                  if ($o['multirows']==1 || $o['multirows']=="") {
                    $free[$i] = "<input type=\"text\" size=\"".$o['multicols']."\" id=\"v".$o[0]."\"".
						     " class=\"inputbox".$this->sfx."\"".
                             " onchange=\"javascript:checkSelected(".$o[0].")\"". 
                             " name=\"xtVal[".$o[0]."]\" />";
                  } else { 
		            $free[$i] = "<textarea rows=\"".$o['multirows']."\" cols=\"".$o['multicols']."\" id=\"v".$o[0]."\"". 
						     " class=\"".inputbox.$this->sfx."\"".
                             " onchange=\"javascript:checkSelected(".$o[0].")\"". 
                             " name=\"xtVal[".$o[0]."]\" wrap=\"virtual\" />".
                       		 "</textarea>";
				 }
				}				
				$html .= "<div id=\"pollxtImgCol\">".$img[$i]."</div>".
						 "<div id=\"pollxtOptCol\">".$inp[$i]."</div>".
						 "<div id=\"pollxtFreeCol\">".$free[$i]."</div><div style=\"clear:both\"></div>"; 

				$i++;
				if ($tabcnt == 1) $tabcnt = 0;
				else $tabcnt ++;
			}
/*			$html = "<div style=\"float:left\">";
			if (isset($img)) foreach ($img as $h) $html .= $h."<br/>"; 
			$html .= "</div><div style=\"float:left\">";
			if (isset($inp)) foreach ($inp as $h) $html .= $h."<br/>"; 
			$html .= "</div><div style=\"float:left\">";
			if (isset($free)) foreach ($free as $h) $html .= $h."<br/>"	; 
			$html .= "</div><div style=\"clear:both\"></div>"; */

		}
	
	return $html;
	}
}
?>