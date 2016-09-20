<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;
use Wame\DataGridControl\DataGridControl;


class Delete extends BaseGridItem
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
            return ":{$grid->presenter->getName()}:delete";
        }
    }
    
    
    /**
     * Set link
     * 
     * @param type $link
     * @return \Wame\AdminModule\Vendor\Wame\DataGridControl\Actions\Delete
     */
    public function setLink($link)
    {
        $this->link = $link;
        
        return $this;
    }
    
    
    /** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addAction('delete', '', $this->getLink($grid))
                ->setIcon('delete')
                ->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Delete')])
                ->setClass('btn btn-xs btn-icon btn-hover-danger tooltipped ajax-modal');
		
		return $grid;
	}
    
}