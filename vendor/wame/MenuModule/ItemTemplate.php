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
            $html = Html::el('ul')
                        ->addClass('collapsible collapsible-accordion')
                        ->setData('collapsible', 'accordion')
                        ->setHtml(Html::el('li')->add(
                            Html::el('a')
                                    ->addClass('collapsible-header')
                                    ->setHref('#')
                                    ->setText($item->title)
                            )->add($this->getNodes($item->nodes))
                        );
        }
        
        return Html::el('li')->setHtml($html);
    }
    
    
    private function getNodes($items)
    {
        $html = Html::el('ul');

        foreach ($items as $item) {
            $html->add($this->getItem($item));
        }
        
        return Html::el('div')->setClass('collapsible-body')->setHtml($html);
    }
	
}
