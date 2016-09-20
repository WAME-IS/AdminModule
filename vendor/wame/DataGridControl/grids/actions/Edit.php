<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;
use Wame\DataGridControl\DataGridControl;


class Edit extends BaseGridItem
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
            return ":{$grid->presenter->getName()}:edit";
        }
    }
    
    
    /**
     * Set link
     * 
     * @param type $link
     * @return \Wame\AdminModule\Vendor\Wame\DataGridControl\Actions\Edit
     */
    public function setLink($link)
    {
        $this->link = $link;
        
        return $this;
    }
    
    
    /** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addAction('edit', '', $this->getLink($grid))
			->setIcon('edit')
			->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Edit')])
			->setClass('btn btn-xs btn-icon btn-hover-warning tooltipped');
		
		return $grid;
	}
    
}