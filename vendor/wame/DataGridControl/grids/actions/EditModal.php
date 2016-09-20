<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;

class EditModal extends BaseGridItem
{
    /** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addAction('edit', '', ":{$grid->presenter->getName()}:edit")
			->setIcon('edit')
			->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Edit')])
			->setClass('btn btn-xs btn-icon btn-hover-warning tooltipped ajax-modal');
		
		return $grid;
	}
    
}