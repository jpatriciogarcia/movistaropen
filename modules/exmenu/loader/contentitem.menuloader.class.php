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

require_once(EXTENDED_MENU_HOME.'/loader/menu.menuloader.class.php');

/**
 * @since 1.0.0
 */
class ContentItemExtendedMenuLoader extends ExtendedMenuLoader {
	
	var $contentItemCache	= NULL;
	
	function &getContentItemCache() {
		if (!is_object($this->contentItemCache)) {
			$this->contentItemCache	=& ExtendedMenuCacheFactory::getNewInstance('content');
			$cache					=& $this->contentItemCache;
			$cache->order			= $this->contentItemOrder;
			$cache->categoryOrder	= $this->categoryOrder;	// TODO may get removed
		}
		return $this->contentItemCache;
	}
	
	function loadBySourceValues($sourceValues) {
		return $this->loadByContentItemIds($sourceValues, $this->contentItemVisible);
	}
	
	function loadByContentItemIds($ids, $contentItemVisible = TRUE) {
		$this->resolveTableIds($ids, '#__content', array('title_alias', 'title'), 'id', FALSE, array('state = 1'));
		$contentItemCache		=& $this->getContentItemCache();
		$contentItemCache->loadByContentItemIds($ids);
		$contentItemList			=& $contentItemCache->getContentItemList();
		$rootMenuNode			=& $this->getRootMenuNode();
		$this->addContentItemMenuNodes($rootMenuNode, $contentItemList, $contentItemVisible);
		return TRUE;
	}
	
	function getTaskByLinkType($linkType) {
		if ($linkType == 'content_item_link') {
			return 'view';
		}
		return parent::getTaskByLinkType($linkType);
	}
	
	function addItemid($url, $Itemid) {
		if (is_array($Itemid)) {
			foreach($Itemid as $id) {
				if ($id != '') {
					if ($id > 0) {
						$url	.= '&Itemid='.$Itemid;
					}
					break;
				}
			}
		} else {
			if ($Itemid) {
				$url	.= '&Itemid='.$Itemid;
			}
		}
		return $url;
	}

	function applyContentItemLink(&$menuNode, $categoryId, $alternativeItemid = '') {
		$menuNode->type			= $this->contentItemLinkType;
		$menuNode->link			= 'index.php?option=com_content&task='.$this->getTaskByLinkType($this->contentItemLinkType).'&id='.$categoryId;
		$menuNode->link			= $this->addItemid($menuNode->link, array($this->defaultContentItemid, $alternativeItemid));
	}
	
	function &getNewContentItemMenuNode(&$contentItem) {
		$menuNode				=& $this->getEmptyMenuNode();
		$menuNode->id			= ($this->defaultContentItemid != '' ? $this->defaultContentItemid : FALSE);
		$menuNode->name			= $contentItem->title;
		if ($this->isCurrentContentItem($contentItem->id)) {
			$menuNode->setCurrent(TRUE);
			$menuNode->setExpanded(TRUE);
		} else if ($this->isActiveContentItem($contentItem->id)) {
			$menuNode->setActive(TRUE);
			$menuNode->setExpanded(TRUE);
		}
		if (!$this->openActiveOnly) {
			$menuNode->setExpanded(TRUE);
		}
		if ($this->contentItemLinkEnabled) {
			$this->applyContentItemLink($menuNode, $contentItem->id);
		}
		return $menuNode;
	}

	function addContentItemMenuNode(&$parentMenuNode, &$contentItem, $contentItemVisible = TRUE) {
		if ($contentItemVisible) {
			$menuNode				=& $this->getNewContentItemMenuNode($contentItem);
			$this->addMenuNode($parentMenuNode, $menuNode);
		}
	}

	function addContentItemMenuNodes(&$parentMenuNode, &$contentItemList, $contentItemVisible = TRUE) {
		if ($contentItemVisible) {
			foreach(array_keys($contentItemList) as $key) {
				$contentItem			=& $contentItemList[$key];
				$this->addContentItemMenuNode($parentMenuNode, $contentItem, $contentItemVisible);
			}
		}
	}

}

?>