<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;

class Show extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addAction('show', '', ":{$grid->presenter->getName()}:show")
			->setIcon('visibility')
			->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Show')])
			->setClass('btn btn-xs btn-icon btn-hover-default tooltipped');
		
		return $grid;
	}
    
}