<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Columns;

use Wame\DataGridControl\Columns\Status as BaseStatus;


class Status extends BaseStatus
{
    /** {@inheritDoc} */
	public function render($grid)
    {
        $this->grid = $grid;
        
		$grid->addColumnStatus('status', _('Status'))
				->addOption(1, _('Published'))
					->setIcon('check')
					->setClass('btn-success')
					->endOption()
				->addOption(2, _('Unpublished'))
					->setIcon('close')
					->setClass('btn-danger')
					->endOption()
				->onChange[] = [$this, 'statusChange'];
		
		return $grid;
	}
    
}