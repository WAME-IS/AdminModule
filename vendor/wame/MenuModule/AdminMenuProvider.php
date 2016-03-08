<?php

namespace Wame\AdminModule\Vendor\Wame\MenuModule;

class AdminMenuProvider
{
    /** @var array */
    private $items = [];
    
    /** @var array */
    private $services = [];
     
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
        foreach ($this->services as $service) {
            $item = $service->create();
            
            $this->items[] = $item->addItem();
        }
        
        return $this->items;
    }
    
}
