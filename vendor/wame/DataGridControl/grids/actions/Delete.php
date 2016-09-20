<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;


class Delete extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addAction('delete', '', ":{$grid->presenter->getName()}:delete")
			->setIcon('delete')
			->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Delete')])
			->setClass('btn btn-xs btn-icon btn-hover-danger tooltipped ajax-modal');
		
		return $grid;
	}
    
}