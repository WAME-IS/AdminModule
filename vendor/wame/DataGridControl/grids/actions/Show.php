<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

class Show extends BaseGridAction
{
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