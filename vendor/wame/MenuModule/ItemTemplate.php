<?php

namespace Wame\AdminModule\Vendor\Wame\MenuModule;

use Nette\Object;
use Nette\Utils\Html;


class ItemTemplate extends Object
{
    public function createItem($element, $item) 
	{
        return $element->setHtml($this->getItem($item));
	}
    
    
    private function getItem($item)
    {
        if (count($item->nodes) == 0) {
            $html = Html::el('a')
                            ->setHref($item->link)
                            ->setText($item->title);
            
        } else {
            $html = Html::el()
                        ->addHtml(Html::el('div')
                                    ->addClass('collapsible-header')
                                    ->setText($item->title)
                        )->addHtml($this->getNodes($item->nodes));
        }
        
        return Html::el('li')->setHtml($html);
    }
    
    
    private function getNodes($items)
    {
        $html = Html::el('ul')->setClass('collapsible-body');

        foreach ($items as $item) {
            $html->addHtml($this->getItem($item));
        }
        
        return $html;
    }
	
}
