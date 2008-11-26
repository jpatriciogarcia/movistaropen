<?php

/**
* PollXT for Joomla!
* @Copyright (C) 2004 - 2006 Oli Merten
* @ All rights reserved
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ http://www.joomlaxt.com
* @version 1.22
**/

// ensure this file is being included by a parent file
defined('_VALID_MOS') or die('Direct Access to this location is not allowed.');


function xtSefRelToAbs($url) {
 global $mosConfig_live_site;
		$version = ($GLOBALS["_VERSION"]->RELEASE);
			if ($version == "1.5") 
			  return sefRelToAbs($url);
			else
			  if ( strpos($url, $mosConfig_live_site)=== false) 
				  return sefRelToAbs($mosConfig_live_site."/".$url);
			  else 
				  return sefRelToAbs($url);

}

class xtTitle {
	function xtTitle($product) {
		$this->version = ($GLOBALS["_VERSION"]->RELEASE);
		$this->product = $product;
	}
	function show($title) {	 
		if ($this->version == "1.5") {
		 	$html = "<div class=\"header icon-48-categories\">";
		 	$html .= $this->product." ".$title;
			$html .= "</div>";
		}
		else {
		 	$html = "<table class=\"adminheading\" cellpadding=\"2\" cellspacing=\"4\" border=\"0\" width=\"100%\" ><tr>";
		 	$html .= "<th  class=\"config\" align=\"left\">";
		 	$html .= $this->product." ".$title;
		 	$html .= "</tr></table>";
		}
		return $html;
	}
}
class xtTabs {
	function xtTabs($index) {
		$this->version = ($GLOBALS["_VERSION"]->RELEASE);
		$this->initTabs($index);
		
	}
	
	function initTabs($index) {
		if ($this->version == "1.5") {
			$tabs = JPane::getInstance('Tabs');
		}
		else {
			$tabs = new mosTabs($index);			
		}
		$this->tabs = $tabs;
	}
	
	function startPane ($name) {
		if ($this->version == "1.5") {
			echo $this->tabs->startPane($name);
		}
		else {
			$this->tabs->startPane($name);
		}
		
	}
	function startTab($name, $text) {
		if ($this->version == "1.5") {
			echo $this->tabs->startPanel($name,$text);
		}
		else {
			$this->tabs->startTab($name,$text);
		}
	}
	function endTab() {
		if ($this->version == "1.5") {
			echo $this->tabs->endPanel();
		}
		else {
			$this->tabs->endTab();
		}
	}
	function endPane() {
		if ($this->version == "1.5") {
			echo $this->tabs->endPane();
		}
		else {
			$this->tabs->endPane();
		}
	}

}
	
