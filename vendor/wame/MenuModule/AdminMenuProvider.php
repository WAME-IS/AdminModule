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
	
	
	private function createItems()
	{
		foreach ($this->services as $service) {
            $item = $service->create()->addItem();
			
			if (array_key_exists($item->name, $this->items)) {
				$this->items[$item->name] = (object) \Nette\Utils\Arrays::mergeTree((array) $item, (array) $this->items[$item->name]);
			} else {
				$this->items[$item->name] = $item;
			}
        }
		
		return $this->items;
	}
	
	
	private function sortItems($items)
	{
		$return = [];
		
		foreach ($items as $item) {
			if (count($item->nodes) == 0) {
				$return[$item->priority][] = $item;
			} else {
//				$item->nodes = $this->sortItems($item->nodes);
				
				$return[$item->priority][] = $item;
			}
		}

		krsort($return);
		
		return $return;
	}
	

    /**
     * Get items from services
     * 
     * @return array
     */
    public function getItems()
    {
		$this->createItems();

		$this->items = $this->sortItems($this->items);

        return $this->items;
    }
    
}
