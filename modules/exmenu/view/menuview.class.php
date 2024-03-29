<?php
/**
* @version 1.0.3
* @author Daniel Ecer
* @package exmenu_1.0.3
* @copyright (C) 2005-2006 Daniel Ecer (de.siteof.de)
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
*/

// no direct access
if (!defined('EXTENDED_MENU_HOME')) {
	die('Restricted access');
}


/**
 * Abstract class for all menu nodes.
 */
class AbstractExtendedMenuView {
	var $classSuffix;
	var $idSuffix;
	var $maxDepth					= 10;
	var $openActiveOnly				= TRUE;
	var $menuLevel					= 0;
	var $activeMenuClassLink			= FALSE;
	var $activeMenuClassContainer	= FALSE;
	var $titleAttribute				= FALSE;
	var $hierarchyBasedIds			= FALSE;
	var $sublevelClasses				= FALSE;
	var $mainlevelClasses			= FALSE;
	var $callGetItemid				= TRUE;
	var $menuHierarchy				= array();
	var $imageEnabled				= FALSE;
	var $imageAlignment				= '';
	var $lastLinkBegin				= '';
	var $lastLinkEnd					= '';
	var $addUrlItemidMode			= 'local';
	var $params;


	function getExtractedAttribute($html, $attributeName) {
		$s	= $attributeName.'="';
		$i	= strpos($html, $s);
		if ($i !== FALSE) {
			$i	+= strlen($s);
			$j	= strpos($html, '"', $i);
			if ($j !== FALSE) {
				return substr($html, $i, $j - $i);
			}
		}
		return '';
	}

	function getExtractedHref($html) {
		return $this->getExtractedAttribute($html, 'href');
	}

	function getExtractedOnClick($html) {
		return $this->getExtractedAttribute($html, 'onclick');
	}

	function getExtractedTarget($html) {
		return $this->getExtractedAttribute($html, 'target');
	}
	
	function getHierarchyString($hierarchy) {
		$result	= implode('_', $hierarchy);
		if ($result == '') {
			$result	= 'root';
		}
		return $result;
	}
	
	/**
	 * @since version 0.3.0
	 */
	function getMenuClassName(&$menuNode, $level = 0, $activeMenuClass = FALSE) {
		if ($level > 0) {
			$menuClass = 'sublevel';
		} else {
			$menuClass = 'mainlevel';
		}
		if (($activeMenuClass) && ($menuNode->isActive())) {
			if ($menuNode->isCurrent()) {
				$menuClass	.= '_current';
			} else {
				$menuClass	.= '_active';
			}
		}
		$menuClass	.= $this->classSuffix;
		return $menuClass;
	}
	
	/**
	 * @since version 0.3.0
	 */
	function getLinkMenuClassName(&$menuNode, $level = 0) {
		return $this->getMenuClassName($menuNode, $level, $this->activeMenuClassLink);
	}
	
	/**
	 * @since version 0.3.0
	 */
	function getContainerMenuClassName(&$menuNode, $level = 0) {
		return $this->getMenuClassName($menuNode, $level, $this->activeMenuClassContainer);
	}

	function getMenuLink(&$menuNode, $level = 0, $itemHierarchy = NULL) {
		if (!is_array($itemHierarchy)) {
			$itemHierarchy		= array();
		}
		return trim($this->mosGetMenuLink($menuNode, $level, $this->params, $itemHierarchy));
	}
	
	function hasItemid($url) {
		return (strpos($url, '&Itemid=') !== FALSE) || (strpos($url, '?Itemid=') !== FALSE);
	}
	
	function addItemid($url, $Itemid) {
		if (($Itemid) && (!$this->hasItemid($url))) {
			$url .= (strpos($url, '?') === FALSE ? '?' : '&').'Itemid='. $Itemid;
		}
		return $url;
	}

	/**
	* Utility function for writing a menu link
	* (modification of the original menu module mosGetMenuLink function)
	*/
	function mosGetMenuLink( $mitem, $level=0, &$params, $itemHierarchy ) {
		global $Itemid, $mosConfig_live_site, $mainframe;

		// alias to use a prefered name without having to change all reference
		$menuNode	=& $mitem;
		
		$txt = '';

		switch ($mitem->type) {
			case 'separator':
				$mitem->browserNav	= 3;
				break;
			case 'component_item_link':
				break;
			case 'content_item_link':
				if (!$this->hasItemid($menuNode->link)) {
					$temp = split('&task=view&id=', $menuNode->link);
					if (($this->callGetItemid) || ($menuNode->id === FALSE)) {
						if ($menuNode->id !== FALSE) {
							$_Itemid	= $Itemid;
							$Itemid		= $mitem->id;	// getItemid uses the global variable as a default value... use the id of the menu item instead
							$id			= $mainframe->getItemid($temp[1]);
							$Itemid		= $_Itemid;
						} else {
							$id			= $mainframe->getItemid($temp[1]);
						}
					} else {
						$id	= $mitem->id;
					}
					if ($id > 0) {
						$menuNode->link .= '&Itemid='.$id;
					}
				}
				break;
			case 'url':
				switch($this->addUrlItemidMode) {
					case 'local':
						if ((strpos(strtolower($menuNode->link), 'index.php?') !== FALSE) &&
								(($mosConfig_live_site == '') || (strpos($menuNode->link, ':') === FALSE) || (strpos($menuNode->link, $mosConfig_live_site) === 0))) {
							$menuNode->link		= $this->addItemid($menuNode->link, $menuNode->id);
						}
						break;
					case 'default':
					default:
						if (strpos(strtolower($menuNode->link), 'index.php?') !== FALSE) {
							$menuNode->link		= $this->addItemid($menuNode->link, $menuNode->id);
						}
				}
				break;
			case 'content_typed':
			default:
				$menuNode->link		= $this->addItemid($menuNode->link, $menuNode->id);
				break;
		}

		// Active Menu highlighting
		// why reading the request parameter when there is a global variable?
//			$current_itemid = trim( mosGetParam( $_REQUEST, 'Itemid', 0 ) );
		
		$title	= strip_tags($menuNode->name);
		
		// use a more meaningful name than "id": elementParameters
		$elementParameters	= '';
		if (($this->hierarchyBasedIds) && (count($itemHierarchy) > 0)) {
			$elementParameters	.= ' id="menulink_'.$this->getHierarchyString($itemHierarchy).$this->idSuffix.'"';
		} else if ($menuNode->isCurrent()) {
			$elementParameters	.= ' id="active_menu'.$this->idSuffix.'"';
		}
		if ((isset($menuNode->accessKey)) && ($menuNode->accessKey != '')) {
			$elementParameters	.= ' accesskey="'.$menuNode->accessKey.'"';
			$title	.= ' ['.strtoupper($menuNode->accessKey).']';
		}
		
		if ($this->titleAttribute) {
			$elementParameters	.= ' title="'.$title.'"';
		}

		$mitem->link = ampReplace( $mitem->link );

		if ( strcasecmp( substr( $mitem->link,0,4 ), 'http' ) ) {
			$mitem->link = sefRelToAbs( $mitem->link );
		}

		$menuclass	= $this->getLinkMenuClassName($menuNode, $level);
		
		$linkBegin	= '';
		$linkText	= $mitem->name;
		$linkEnd	= '';

		switch ($mitem->browserNav) {
			// cases are slightly different
			case 1:
				// open in a new window
				$linkBegin	= '<a href="'. $mitem->link .'" target="_blank" class="'. $menuclass .'"'. $elementParameters .'>';
				$linkEnd	= '</a>';
//					$txt = '<a href="'. $mitem->link .'" target="_blank" class="'. $menuclass .'"'. $elementParameters .'>'. $mitem->name .'</a>';
				break;

			case 2:
				// open in a popup window
				$linkBegin	= "<a href=\"#\" onclick=\"javascript: window.open('". $mitem->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\"". $elementParameters .">";
				$linkEnd	= "</a>\n";
//					$txt = "<a href=\"#\" onclick=\"javascript: window.open('". $mitem->link ."', '', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=550'); return false\" class=\"$menuclass\"". $elementParameters .">". $mitem->name ."</a>\n";
				break;

			case 3:
				// don't link it
				$linkBegin	= '<span class="'. $menuclass .'"'. $elementParameters .'>';
				$linkText	= ($mitem->name != '' ? $mitem->name : '&nbsp;');
				$linkEnd	= '</span>';
//					$txt = '<span class="'. $menuclass .'"'. $elementParameters .'>'. ($mitem->name != '' ? $mitem->name : '&nbsp;') .'</span>';
				break;

			default:	// formerly case 2
				// open in parent window
				$linkBegin	= '<a href="'. $mitem->link .'" class="'. $menuclass .'"'. $elementParameters .'>';
				$linkEnd	= '</a>';
//					$txt = '<a href="'. $mitem->link .'" class="'. $menuclass .'"'. $elementParameters .'>'. $mitem->name .'</a>';
				break;
		}
		
		$txt	= $linkBegin.$linkText.$linkEnd;

		if ($this->imageEnabled) {
			$menu_params = new stdClass();
			$menu_params =& new mosParameters( $mitem->params );
			$menu_image = $menu_params->def('menu_image', -1);
			if ( ( $menu_image <> '-1' ) && $menu_image ) {
				$image = '<img src="'. $mosConfig_live_site .'/images/stories/'. $menu_image .'" border="0" alt="'. $mitem->name .'"/>';
				switch($this->imageAlignment) {
					case 'image_only':	// does not really make sense
						$txt	= $image;
						break;
					case 'image_only_linked':
						$txt	= $linkBegin.$image.$linkEnd;
						break;
					case 'right':
						$txt	= $txt.' '.$image;
						break;
					case 'right_linked':
						$txt	= $linkBegin.$linkText.' '.$image.$linkEnd;
						break;
					case 'left_linked':
						$txt	= $linkBegin.$image.' '.$linkText.$linkEnd;
						break;
					case 'left':
					default:
						$txt	= $image.' '.$txt;
				}
			}
		}
		
		$this->lastLinkBegin	= $linkBegin;
		$this->lastLinkEnd		= $linkEnd;

		return $txt;
	}
}

?>