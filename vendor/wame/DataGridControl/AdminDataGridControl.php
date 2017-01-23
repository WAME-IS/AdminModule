<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl;

use Kdyby\Doctrine\EntityManager;
use Nette\ComponentModel\IContainer;
use Ublaboo\DataGrid\Exception\DataGridException;
use Wame\DataGridControl\DataGridControl;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Column\ColumnStatus;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Toolbar\ToolbarButton;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Column;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Export;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Filter;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\InlineEdit;


class AdminDataGridControl extends DataGridControl
{
    const TEMPLATE_PATH = BASE_PATH . '/templates/materialDesign/ublaboo/datagrid/src/';
    
    
    /** @var string */
	public static $icon_prefix = 'material-icons';
    

	/** {@inheritdoc} */
    public function __construct(
        EntityManager $entityManager,
        IContainer $parent = NULL,
        $name = NULL
    ) {
        parent::__construct($entityManager, $parent, $name);
        
        $this->setPagination(true);
        
        $this->setColumnsHideable();
        
        $this->setOuterFilterRendering();
        
//        $this->setAutoSubmit(FALSE);
//        
//        $this->addExportCsv(_('Csv export (filtered)'), 'export.csv')->setTitle(_('Csv export (filtered)'));
//        
//        $this->addInlineAdd();
//        
//        $this->setItemsDetail();
    }


    /**
     * Get icon prefix
     *
     * @return string
     */
    public static function getIconPrefix()
    {
        return self::$icon_prefix;
    }

    /** {@inheritdoc} */
    public function attach()
	{
        foreach($this->register->getArray() as $item) {
            $this->checkService($item['service'])
                    ->setParent($this)
                    ->setParameters($item['parameters'])
                    ->render($this);
            
            $item['service']->setVisibility($this);
        }
        
        return $this;
	}
    
    
	/********************************************************************************
	 *                                  TEMPLATING                                  *
	 ********************************************************************************/


    /** {@inheritDoc} */
	public function getOriginalTemplateFile()
	{
		return self::TEMPLATE_PATH . 'templates/datagrid.latte';
	}
    
    
	/********************************************************************************
	 *                                  TREE VIEW                                   *
	 ********************************************************************************/
    
    /** {@inheritDoc} */
    public function setTreeView($get_children_callback, $tree_view_has_children_column = 'has_children') 
    {
        parent::setTreeView($get_children_callback, $tree_view_has_children_column);
        
        $this->setTemplateFile(self::TEMPLATE_PATH . '/templates/datagrid_tree.latte');
        
        return $this;
    }

    
	/********************************************************************************
	 *                                    COLUMNS                                   *
	 ********************************************************************************/

    
    /** {@inheritDoc} */
	public function addColumnStatus($key, $name, $column = NULL)
	{
		$this->addColumnCheck($key);
        
		$column = $column ?: $key;

		return $this->addColumn($key, new ColumnStatus($this, $key, $column, $name));
	}
    
    
	/********************************************************************************
	 *                                TOOLBAR BUTTONS                               *
	 ********************************************************************************/
    
    
	/** {@inheritDoc} */
	public function addToolbarButton($href, $text = '', $params = [])
	{
		$button = new ToolbarButton($this, $href, $text, $params);

		return $this->toolbar_buttons[] = $button;
	}
    
    
	/********************************************************************************
	 *                                    ACTIONS                                   *
	 ********************************************************************************/


	/** {@inheritDoc} */
	public function addAction($key, $name, $href = NULL, array $params = NULL)
	{
		$this->addActionCheck($key);
		$href = $href ?: $key;

		if (NULL === $params) {
			$params = [$this->primary_key];
		}

		return $this->actions[$key] = new Column\Action($this, $href, $name, $params);
	}
    
    
	/********************************************************************************
	 *                                    FILTERS                                   *
	 ********************************************************************************/

    
	/** {@inheritDoc} */
	public function addFilterDate($key, $name, $column = NULL)
	{
		$column = $column ?: $key;

		if (!is_string($column)) {
			throw new DataGridException("FilterDate can only filter in one column.");
		}

		$this->addFilterCheck($key);

		return $this->filters[$key] = new Filter\FilterDate($this, $key, $name, $column);
	}    
    
	/********************************************************************************
	 *                                  PAGINATION                                  *
	 ********************************************************************************/
    
    
	/** {@inheritDoc} */
	public function createComponentPaginator()
	{
        $component = parent::createComponentPaginator();
        
        $component->setTemplateFile(self::TEMPLATE_PATH . 'Components/DataGridPaginator/templates/data_grid_paginator.latte');

		return $component;
	}


	/********************************************************************************
	 *                                    EXPORTS                                   *
	 ********************************************************************************/


	/** {@inheritDoc} */
	public function addExportCallback($text, $callback, $filtered = FALSE)
	{
		if (!is_callable($callback)) {
			throw new DataGridException("Second parameter of ExportCallback must be callable.");
		}

		return $this->addToExports(new Export\Export($this, $text, $callback, $filtered));
	}  
    
    
	/********************************************************************************
	 *                                  INLINE ADD                                  *
	 ********************************************************************************/

    
	/** {@inheritDoc} */
	public function addInlineAdd()
	{
		$this->inlineAdd = new InlineEdit($this);

		$this->inlineAdd
			->setTitle('ublaboo_datagrid.add')
			->setIcon('add_circle_outline')
			->setClass('btn btn-icon btn-hover-success tooltipped');

		return $this->inlineAdd;
	}

    
	/********************************************************************************
	 *                                  ITEM DETAIL                                 *
	 ********************************************************************************/


    /** {@inheritDoc} */
	public function setItemsDetail($detail = TRUE, $primary_where_column = NULL)
	{
		if ($this->isSortable()) {
			throw new DataGridException('You can not use both sortable datagrid and items detail.');
		}

		$this->items_detail = new Column\ItemDetail(
			$this,
			$primary_where_column ?: $this->primary_key
		);

		if (is_string($detail)) {
			/**
			 * Item detail will be in separate template
			 */
			$this->items_detail->setType('template');
			$this->items_detail->setTemplate($detail);

		} else if (is_callable($detail)) {
			/**
			 * Item detail will be rendered via custom callback renderer
			 */
			$this->items_detail->setType('renderer');
			$this->items_detail->setRenderer($detail);

		} else if (TRUE === $detail) {
			/**
			 * Item detail will be rendered probably via block #detail
			 */
			$this->items_detail->setType('block');

		} else {
			throw new DataGridException(
				'::setItemsDetail() can be called either with no parameters or with parameter = template path or callable renderer.'
			);
		}

		return $this->items_detail;
	}
    
    
    /********************************************************************************/
    
    /** {@inheritDoc} */
    public function render() 
    {
        parent::render();
        
        $this->getTemplate()->icon_prefix = static::$icon_prefix;
    }


    /**
     * Check service
     *
     * @param $service
     * @return mixed
     */
    private function checkService($service)
    {
        $adminService = str_replace('Wame\DataGridControl', 'Wame\AdminModule\Vendor\Wame\DataGridControl', get_class($service));
        
        if (class_exists($adminService) && !method_exists(get_class($service), '__construct')) {
            $service = new $adminService();
        }
        
        return $service;
    }

}