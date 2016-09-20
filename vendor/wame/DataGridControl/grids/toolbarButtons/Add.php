<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\ToolbarButtons;

use Wame\DataGridControl\BaseGridItem;

class Add extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid)
    {
        $grid->addToolbarButton(":{$grid->presenter->getName()}:create", _('Add'))
                ->setIcon('add_circle_outline')
                ->setClass('btn btn-link');
                
		return $grid;
	}
    
}