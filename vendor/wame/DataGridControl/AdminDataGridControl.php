<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl;

use Wame\DataGridControl\DataGridControl;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Column\ColumnStatus;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Toolbar\ToolbarButton;
use Wame\AdminModule\Vendor\Ublaboo\Datagrid\Column;


class AdminDataGridControl extends DataGridControl
{
    const TEMPLATE_PATH = BASE_PATH . '/templates/materialDesign/ublaboo/datagrid/src/';
    
    
    /**
	 * @var string
	 */
	public static $icon_prefix = 'material-icons';
    
    
    public function __construct(
        \Kdyby\Doctrine\EntityManager $entityManager, 
        \Nette\ComponentModel\IContainer $parent = NULL, 
        $name = NULL
    ) {
        parent::__construct($entityManager, $parent, $name);
        
        $this->setTemplateFile(self::TEMPLATE_PATH . 'templates/datagrid.latte');
        $this->setPagination(true);
    }
    
    
    public static function getIconPrefix()
    {
        return $this->icon_prefix;
    }
    
    
    public function attach()
	{
        foreach($this->register->getArray() as $item) {
            $this->checkService($item['service'])->render($this);
        }
        
        return $this;
	}
    
    
	/********************************************************************************
	 *                                    COLUMNS                                   *
	 ********************************************************************************/

    
    /**
	 * Add column status
	 * @param  string      $key
	 * @param  string      $name
	 * @param  string|null $column
	 * @return ColumnStatus
	 */
	public function addColumnStatus($key, $name, $column = NULL)
	{
		$this->addColumnCheck($key);
        
		$column = $column ?: $key;

		return $this->addColumn($key, new ColumnStatus($this, $key, $column, $name));
	}
    
    
	/********************************************************************************
	 *                                TOOLBAR BUTTONS                               *
	 ********************************************************************************/
    
    
	/**
	 * Add toolbar button
	 * @param string $href
	 * @param string $text
	 * @param array  $params
	 * @return ToolbarButton
	 */
	public function addToolbarButton($href, $text = '', $params = [])
	{
		$button = new ToolbarButton($this, $href, $text, $params);

		return $this->toolbar_buttons[] = $button;
	}
    
    
	/********************************************************************************
	 *                                    ACTIONS                                   *
	 ********************************************************************************/


	/**
	 * Create action
	 * @param string     $key
	 * @param string     $name
	 * @param string     $href
	 * @param array|null $params
	 * @return Column\Action
	 */
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
	 *                                  PAGINATION                                  *
	 ********************************************************************************/
    
    
	/**
	 * Paginator factory
	 * @return Components\DataGridPaginator\DataGridPaginator
	 */
	public function createComponentPaginator()
	{
        $component = parent::createComponentPaginator();
        
        $component->setTemplateFile(self::TEMPLATE_PATH . 'Components/DataGridPaginator/templates/data_grid_paginator.latte');

		return $component;
	}
    
    
    /********************************************************************************/
    
    
    public function render() 
    {
        parent::render();
        
        $this->getTemplate()->icon_prefix = static::$icon_prefix;
    }

    
    private function checkService($service)
    {
        $adminService = str_replace('Wame\DataGridControl', 'Wame\AdminModule\Vendor\Wame\DataGridControl', get_class($service));
        
        if (class_exists($adminService) && !method_exists(get_class($service), '__construct')) {
            $service = new $adminService();
        }
        
        return $service;
    }

}