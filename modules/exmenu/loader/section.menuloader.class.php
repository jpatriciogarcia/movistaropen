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

require_once(EXTENDED_MENU_HOME.'/loader/category.menuloader.class.php');

/**
 * @since 1.0.0
 */
class SectionExtendedMenuLoader extends CategoryExtendedMenuLoader {
	
	var $sectionCache	= NULL;
	
	function &getSectionCache() {
		if (!is_object($this->sectionCache)) {
			$this->sectionCache		=& ExtendedMenuCacheFactory::getNewInstance('section');
			$cache			=& $this->sectionCache;
			$cache->order	= $this->sectionOrder;
		}
		return $this->sectionCache;
	}
	
	function loadBySourceValues($sourceValues) {
		return $this->loadBySectionIds($sourceValues, $this->sectionVisible, $this->categoryVisible, $this->contentItemVisible);
	}
	
	function applySectionLink(&$menuNode, $sectionId) {
		$menuNode->type			= $this->sectionLinkType;
		$menuNode->link			= 'index.php?option=com_content&task='.$this->getTaskByLinkType($this->sectionLinkType).'&id='.$sectionId;
		if ($this->defaultSectionItemid != '') {
			$menuNode->link		.= '&Itemid='.$this->defaultSectionItemid;
		} else {
			$menuNode->link		.= '&Itemid='.$GLOBALS['Itemid'];
		}
	}
	
	function &getNewSectionMenuNode(&$section) {
		$menuNode				=& $this->getEmptyMenuNode();
		$menuNode->name			= $section->title;
		if ($this->isCurrentSection($section->id)) {
			$menuNode->setCurrent(TRUE);
			$menuNode->setExpanded(TRUE);
		} else if ($this->isActiveSection($section->id)) {
			$menuNode->setActive(TRUE);
			$menuNode->setExpanded(TRUE);
		}
		if (!$this->openActiveOnly) {
			$menuNode->setExpanded(TRUE);
		}
		if ($this->sectionLinkEnabled) {
			$this->applySectionLink($menuNode, $section->id);
		}
		return $menuNode;
	}
	
	function addSectionMenuNode(&$parentMenuNode, &$section, $sectionVisible = FALSE, $categoryVisible = FALSE, $contentItemVisible = TRUE) {
		if ($sectionVisible) {
			$menuNode				=& $this->getNewSectionMenuNode($section);
			if ($categoryVisible) {
				$categoryCache			=& $this->getCategoryCache();
				$categoryList			=& $categoryCache->getCategoryListBySectionId($section->id);
				$this->addCategoryMenuNodes($menuNode, $categoryList, $categoryVisible, $contentItemVisible);
			} else {
				if ($contentItemVisible) {
					$contentItemCache		=& $this->getContentItemCache();
					$contentItemList			=& $contentItemCache->getContentListBySectionId($section->id);
					$this->addContentItemMenuNodes($menuNode, $contentItemList, $contentItemVisible);
				}
			}
			$this->addMenuNode($parentMenuNode, $menuNode);
		} else {
			if ($categoryVisible) {
				$categoryCache			=& $this->getCategoryCache();
				$categoryList			=& $categoryCache->getCategoryListBySectionId($section->id);
				$this->addCategoryMenuNodes($parentMenuNode, $categoryList, $categoryVisible, $contentItemVisible);
			} else {
				if ($contentItemVisible) {
					$contentItemCache		=& $this->getContentItemCache();
					$contentItemList			=& $contentItemCache->getContentListBySectionId($section->id);
					$this->addContentItemMenuNodes($parentMenuNode, $contentItemList, $contentItemVisible);
				}
			}
		}
	}
	
	function addSectionMenuNodes(&$parentMenuNode, &$sectionList, $sectionVisible = FALSE, $categoryVisible = FALSE, $contentItemVisible = TRUE) {
		$titleArray		= array();
		foreach(array_keys($sectionList) as $key) {
			$section					=& $sectionList[$key];
			$this->addSectionMenuNode($parentMenuNode, $section, $sectionVisible, $categoryVisible, $contentItemVisible);
			$titleArray[]	= $section->title;
		}
		if (!$parentMenuNode->hasCaption()) {
			$parentMenuNode->setCaption(implode(', ', $titleArray));
		}
	}
	
	function loadBySectionIds($ids, $sectionVisible = FALSE, $categoryVisible = FALSE, $contentItemVisible = TRUE) {
		global $database, $mosConfig_shownoauth, $my, $mosConfig_offset;
		$this->resolveTableIds($ids, '#__sections', array('name', 'title'), 'id', FALSE, array('published = 1'));
		if ($sectionVisible) {
			$sectionCache		=& $this->getSectionCache();
			$sectionCache->loadBySectionIds($ids);
			$sectionList			=& $sectionCache->getSectionList();
		}
		if ($categoryVisible) {
			$categoryCache		=& $this->getCategoryCache();
			$categoryCache->loadBySectionIds($ids, $sectionVisible);
		}
		if ($contentItemVisible) {
			$contentItemCache	=& $this->getContentItemCache();
			$contentItemCache->loadBySectionIds($ids, $categoryVisible);
		}
		$rootMenuNode	=& $this->getRootMenuNode();
		if ($sectionVisible) {
			$this->addSectionMenuNodes($rootMenuNode, $sectionList, $sectionVisible, $categoryVisible, $contentItemVisible);
		} else if ($categoryVisible) {
			$categoryCache		=& $this->getCategoryCache();
			$categoryList		=& $categoryCache->getCategoryList();
			$this->addCategoryMenuNodes($rootMenuNode, $categoryList, $categoryVisible, $contentItemVisible);
		} else if ($contentItemVisible) {
			$contentItemCache	=& $this->getContentItemCache();
			$contentItemList		=& $contentItemCache->getContentItemList();
			$this->addContentItemMenuNodes($rootMenuNode, $contentItemList, $contentItemVisible);
		}
		return TRUE;
	}
}

?>