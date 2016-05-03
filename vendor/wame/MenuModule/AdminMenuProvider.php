<?php

namespace Wame\AdminModule\Vendor\Wame\MenuModule;

use Wame\MenuModule\Models\ItemSorter;

class AdminMenuProvider
{
    /** @var array */
    private $services = [];
	
	/** @var ItemSorter */
	private $itemSorter;
	
	
	public function __construct(ItemSorter $itemSorter) 
	{
		$this->itemSorter = $itemSorter;
	}

	
    /**
     * Set one service
     * 
     * @param string $service
     * @return \Wame\MenuModule\Models\MenuBuilder
     */
    public function setService($service) 
    {
        $this->services[] = $service;

        return $this;
    }
	
	
    /**
     * Get items from services
     * 
     * @return array
     */
    public function getItems()
    {
        return $this->itemSorter->sort($this->services);
    }
    
}
