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
 * @since 1.0.0
 */
class ExtendedMenuLoader extends AbstractExtendedMenuLoader {

	function loadBySourceValues($sourceValues) {
		return $this->loadMenuItems($sourceValues);
	}
	
	function getRawUrlParameter($url, $paramName = 'id') {
		$i	= strpos($url, '&'.$paramName.'=');
		$j	= strpos($url, '?'.$paramName.'=');
		if (($j !== FALSE) && ($j < $i)) {
			$i	= $j;
		}
		if ($i !== FALSE) {
			$i	+= 2 + strlen($paramName);
			$j	= strpos($url, '&', $i);
			if ($j !== FALSE) {
				return substr($url, $i, $j - $i);
			} else {
				return substr($url, $i);
			}
		}
		return FALSE;
	}
	
	function getIdByUrl($url, $paramName = 'id') {
		$value	= $this->getRawUrlParameter($url, $paramName);
		if ($value !== FALSE) {
			$value	= intval($value);
		}
		return $value;
	}

	function loadMenuItems($sourceValues = array()) {
		global $database, $my, $mosConfig_shownoauth, $mosConfig_live_site;
		global $mosConfig_lang, $mosConfig_mbf_content;
		global $Itemid, $option;

		$menutype		= $this->menutype;
		$activeMenuId	= $this->activeMenuId;
		$openActiveOnly	= $this->openActiveOnly;
		$loadActiveOnly	= $this->loadActiveOnly;
		$maxDepth		= $this->maxDepth;
		$minExpand		= $this->minExpand;

		$sql = 'SELECT m.* FROM #__menu AS m'.
			' WHERE menutype='.$this->getSqlQuote($menutype).' AND published = 1';
		if ($this->exactAccessLevel) {
			$sql	.= ' AND access = '.$my->gid;
		} else if (!$mosConfig_shownoauth) {
			$sql	.= ' AND access <= '.$my->gid;
		}
		if ($this->loadFirstLevelOnly) {
			$sql	.= ' AND parent = 0';
		}
		$sql	.= ' ORDER BY ordering';
		$sqlKey	= $sql;
		$cacheVariableName	= '_EXTENDED_MENU_CACHE';
		$cacheVariableName2	= '_EXTENDED_MENU_CACHE_TREE';
		$rows		= NULL;
		$mainRows	= NULL;
		if ($this->cacheEnabled) {
			if ((isset($GLOBALS[$cacheVariableName])) && (isset($GLOBALS[$cacheVariableName2]))) {
				if ((isset($GLOBALS[$cacheVariableName][$sqlKey])) && (isset($GLOBALS[$cacheVariableName2][$sqlKey]))) {
					$rows		=& $GLOBALS[$cacheVariableName][$sqlKey];
					$mainRows	=& $GLOBALS[$cacheVariableName2][$sqlKey];
				}
			} else {
				$GLOBALS[$cacheVariableName]		= array();
				$GLOBALS[$cacheVariableName2]	= array();
			}
		}
		if ((is_null($rows)) || (is_null($mainRows))) {
			$database->setQuery($sql);
			if (($mosConfig_mbf_content) && (class_exists('MambelFish'))) {
				$objectList	= $database->loadObjectList('id');
				$rows		= array();
				if (!$this->checkDatabaseError()) {
					foreach(array_keys($objectList) as $id) {
	      				$rows[$id]			= MambelFish::translate($objectList[$id], 'menu', $mosConfig_lang);
					}
				}
			} else {
				$rows	= $database->loadObjectList('id');
				if (!$this->checkDatabaseError()) {
				} else {
					$rows	= array();
				}
			}
			$mainRows		= array();
			$orphanedIds		= array();
			foreach(array_keys($rows) as $id) {
				$row			=& $rows[$id];
				$parentId	= $row->parent;
				if (($parentId > 0) && (isset($rows[$parentId]))) {
					$parentRow			=& $rows[$parentId];
					$row->_parentRow		=& $parentRow;
					if (!isset($parentRow->_children)) {
						$parentRow->_children		= array();
					}
					$parentRow->_children[]	=& $row;
				} else if ($parentId > 0) {
					// orphaned sub menu item
					$this->showDebug('orphaned sub menu item: '.$row->name.' (id='.$id.')');
					$orphanedIds	[]	= $id;
				} else {
					// main level item
					$mainRows[]		=& $row;
				}
			}
			$i	= 0;
			while($i < count($orphanedIds)) {	// do not use foreach here because we may add items to the array
				$id	= $orphanedIds[$i++];
				$row		=& $rows[$id];
				if (isset($row->_children)) {
					foreach(array_keys($row->_children) as $key) {
						$child	=& $row->_children[$key];
						$this->showDebug('child of orphaned menu item: '.$child->name.' (id='.$id.')');
						$orphanedIds[]	= $child->id;
					}
				}
			}
			foreach($orphanedIds as $id) {
				unset($rows[$id]);	// we need to remove all orphaned menu items
			}
			if ($this->cacheEnabled) {
				if (isset($GLOBALS[$cacheVariableName][$sqlKey])) {
					// the cache may be useful for splitted menus
					$GLOBALS[$cacheVariableName][$sqlKey]	=& $rows;
					$GLOBALS[$cacheVariableName2][$sqlKey]	=& $mainRows;
				}
			}
		}

		$menuNodeByIdMap			= array();
		$menuNodeByNameMap		= array();
		$activeIds				= array();
		$parseAccessKeys			= $this->parseAccessKey;
		
		// find current menu item
		$keys					= array_keys($rows);
		$homeItemid				= FALSE;
		if (($menutype == 'mainmenu') && (count($keys) > 0)) {
			$homeItemid				= $rows[$keys[0]]->id;
		}
		if (($this->ignoreItemidEnabled) ||
				(($this->smartItemidEnabled) && (!isset($rows[$activeMenuId]))) ||
				(($this->smartItemidEnabled) && ($Itemid == $homeItemid))) {
			$currentUrl			= (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '');
			if ($currentUrl == '') {		// REQUEST_URI is usually not set on the IIS
				$currentUrl	= $_SERVER['SCRIPT_NAME'];
				if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != '')) {
					$currentUrl	.= '?'.$_SERVER['QUERY_STRING'];
				}
			}
			$currentUrlArray		= array();
			if ($currentUrl != '') {
				if ((substr($currentUrl, 0, 1) != '/') && (strpos($currentUrl, ':') === FALSE)) {
					$currentUrl		= '/'.$currentUrl;
				}
				$i		= strpos($currentUrl, '&Itemid=');
				if ($i === FALSE) {
					$i		= strpos($currentUrl, '?Itemid=');
				}
				if (substr($currentUrl, 0, 1) == '/') {
					$currentUrlArray[]		= substr($currentUrl, 1);
					$currentUrlArray[]		= $mosConfig_live_site.$currentUrl;
				} else {
					$currentUrlArray[]		= $currentUrl;
				}
				if ($i !== FALSE) {
					if (substr($currentUrl, 0, 1) == '/') {
						$currentUrlArray[]		= substr(substr($currentUrl, 0, $i), 1);
						$currentUrlArray[]		= $mosConfig_live_site.substr($currentUrl, 0, $i);
					} else {
						$currentUrlArray[]		= substr($currentUrl, 0, $i);
					}
				}
			}
			$contentItemRow		= NULL;
			$categoryRow			= NULL;
			$sectionRow			= NULL;
			$sectionRow			= NULL;
			$linkRow				= NULL;
			$componentRow		= NULL;
			foreach(array_keys($rows) as $id) {
				$row			=& $rows[$id];
				switch($row->type) {
					case 'content_item_link':
						if ((is_null($contentItemRow)) && ($this->isActiveContentItem($this->getIdByUrl($row->link)))) {
							$contentItemRow	=& $row;
							break;
						}
						break;
					case 'content_category':
					case 'content_blog_category':
					case 'content_archive_category':
						if ((is_null($categoryRow)) && ($this->isActiveCategory($this->getIdByUrl($row->link)))) {
							$categoryRow		=& $row;
						}
						break;
					case 'content_section':
					case 'content_blog_section':
					case 'content_archive_section':
						if ((is_null($sectionRow)) && ($this->isActiveSection($this->getIdByUrl($row->link)))) {
							$sectionRow		=& $row;
						}
						break;
					default:
						if (($row->link != '') && (in_array($row->link,$currentUrlArray))) {
							$linkRow			=& $row;
						} else if (($row->type == 'components') && ($option == $this->getRawUrlParameter($row->link, 'option'))) {
							$componentRow	=& $row;
						}
				}
				if (!is_null($contentItemRow)) {
					break;	// we found already the most valuable menu item
				}
			}
			
			if (!is_null($contentItemRow)) {
				$activeMenuId	= $contentItemRow->id;
			} else if (!is_null($categoryRow)) {
				$activeMenuId	= $categoryRow->id;
			} else if (!is_null($sectionRow)) {
				$activeMenuId	= $sectionRow->id;
			} else if (!is_null($linkRow)) {
				$activeMenuId	= $linkRow->id;
			} else if ((!is_null($componentRow)) && ($option != 'com_wrapper')) {	// the com_wrapper requires the correct Itemid
				$activeMenuId	= $componentRow->id;
			}
		}
		
		if (isset($rows[$activeMenuId])) {
			$id	= $activeMenuId;
			while(($id > 0) && (isset($rows[$id]))) {
				$activeRow	=& $rows[$id];
				if ($id == $activeMenuId) {
					$activeRow->current	= TRUE;	// we assume that we do not have a field called 'current'
				}
				$activeRow->active	= TRUE;	// we assume that we do not have a field called 'active'
				$activeIds[]			= $id;
				$id	= $activeRow->parent;
			}
		}
		if (count($sourceValues) > 0) {
			$filteredMenuRows		= array();
			foreach(array_keys($mainRows) as $key) {
				$menuRow		=& $mainRows[$key];
				if ((($menuRow->id > 0) && (in_array($menuRow->id, $sourceValues))) ||
						(($menuRow->name != '') && (in_array($menuRow->name, $sourceValues)))) {
					$filteredMenuRows[]		=& $menuRow;
				}
			}
			$mainRows			=& $filteredMenuRows;
		}
		$this->menuNodeByIdMap		=& $menuNodeByIdMap;
		$this->menuNodeByNameMap		=& $menuNodeByNameMap;
		$this->activeIds				=& $activeIds;
		$rootMenuNode				=& $this->getRootMenuNode();
		$this->addMenuItemMenuNodes($rootMenuNode, $mainRows, $minExpand, $openActiveOnly);
		return TRUE;
	}

	function addMenuItemMenuNodes(&$parentMenuNode, &$menuItemList, $minExpand, $openActiveOnly, $level = 0) {
		$parseAccessKeys			= $this->parseAccessKey;
		foreach(array_keys($menuItemList) as $key) {
			$menuItem		=& $menuItemList[$key];
			
			$menuNode		=& new MenuNode();
			foreach(get_object_vars($menuItem) as $k => $field) {
				if ((!is_object($field)) && (!is_array($field)) && (substr($k, 0, 1) != '_')) {
					$menuNode->$k = $field;
				}
			}
			if (($menuNode->active) ||  (!$openActiveOnly) || ($level < $minExpand - 1)) {
				$menuNode->expanded	= TRUE;	// active menu items are expanded
			}
			$name		= $menuNode->name;
			if ($parseAccessKeys > 0) {
				$menuNode->accessKey	= $this->parseAccessKey($menuNode->name, $parseAccessKeys);
			}
			$this->menuNodeByIdMap[$menuNode->id]		=& $menuNode;
			$this->menuNodeByNameMap[$menuNode->name]	=& $menuNode;
			if ($name != $menuNode->name) {
				$this->menuNodeByNameMap[$name]				=& $menuNode;
			}
			if (isset($menuItem->_children)) {
				$children	=& $menuItem->_children;
				$this->addMenuItemMenuNodes($menuNode, $children, $minExpand, $openActiveOnly, $level + 1);
			}
			$parentMenuNode->addChildNode($menuNode);
		}
	}
}

?>