<?php

/**
 * @package     Base.Administrator
 * @subpackage  com_base
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Items View
 *
 * @since  0.0.1
 */
class BaseViewItems extends JViewLegacy
{
	/**
	 * Display the Items view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
		// Get application
		$app = JFactory::getApplication();
		$context = "base.list.admin.item";

		// Get data from the model
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');
		$this->state			= $this->get('State');
		//$this->filter_order 	= $app->getUserStateFromRequest($context . 'filter_order', 'filter_order', 'greeting', 'cmd');
		//$this->filter_order_Dir = $app->getUserStateFromRequest($context . 'filter_order_Dir', 'filter_order_Dir', 'asc', 'cmd');
		$this->filterForm    	= $this->get('FilterForm');
		$this->activeFilters 	= $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}
		
		// Set the submenu
		BaseHelper::addSubmenu('items');

		// Set the toolbar and number of found items
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.6
	 */
	protected function addToolBar()
	{
		$title = JText::_('COM_BASE_ITEMS_MANAGER');

		if ($this->pagination->total) {
			$title .= "<span style='font-size: 0.5em; vertical-align: middle;'>(" . $this->pagination->total . ")</span>";
		}

		JToolBarHelper::title($title, 'item');
		JToolbarHelper::addNew('item.add');
		JToolbarHelper::editList('item.edit');
		JToolbarHelper::deleteList('', 'items.delete');
		JToolBarHelper::preferences('com_base');
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();
		$document->setTitle(JText::_('COM_BASE_ADMINISTRATION'));
	}
}
