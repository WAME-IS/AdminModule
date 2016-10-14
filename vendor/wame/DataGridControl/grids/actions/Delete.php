<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

class Delete extends BaseGridAction
{
    /** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addAction('delete', '', $this->getLink($grid))
                ->setIcon('delete')
                ->addAttributes(['data-position' => 'left', 'data-tooltip' => _('Delete')])
                ->setClass('btn btn-xs btn-icon btn-hover-danger tooltipped ajax-modal');
		
		return $grid;
	}

    /** {@inheritDoc} */
    protected function getLinkAction()
    {
        return 'delete';
    }

}