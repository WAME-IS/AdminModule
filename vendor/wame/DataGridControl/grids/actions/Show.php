<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;
use Wame\DataGridControl\DataGridControl;


class Show extends BaseGridItem
{
    /** @var string */
    private $link;
    
    
    /**
     * Return link
     * 
     * @param DataGridControl $grid
     * @return string
     */
    private function getLink($grid)
    {
        if ($this->link) {
            return $this->link;
        } else {
            return ":{$grid->presenter->getName()}:show";
        }
    }
    
    
    /**
     * Set link
     * 
     * @param type $link
     * @return \Wame\AdminModule\Vendor\Wame\DataGridControl\Actions\Show
     */
    public function setLink($link)
    {
        $this->link = $link;
        
        return $this;
    }


    /** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addAction('show', '', $this->getLink($grid))
			->setIcon('visibility')
			->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Show')])
			->setClass('btn btn-xs btn-icon btn-hover-info tooltipped');
		
		return $grid;
	}
    
}