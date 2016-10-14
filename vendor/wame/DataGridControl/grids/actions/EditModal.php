<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

class EditModal extends BaseGridAction
{
    /** {@inheritDoc} */
	public function render($grid)
	{
		$grid->addAction('edit', '', $this->getLink($grid))
			->setIcon('edit')
			->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Edit')])
			->setClass('btn btn-xs btn-icon btn-hover-warning tooltipped ajax-modal');
		
		return $grid;
	}
    
}