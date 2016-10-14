<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

class Remove extends BaseGridAction
{
    /** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addAction('remove', '', $this->getLink($grid), $this->getLinkParams())
                ->setIcon('clear')
                ->addAttributes($this->getAttributes() + [
                    'data-position' => 'left', 
                    'data-tooltip' => _('Remove')
                ])
                ->setClass('btn btn-xs btn-icon btn-hover-danger tooltipped ajax-modal');
		
		return $grid;
	}
    
    /** {@inheritDoc} */
    protected function getLinkAction()
    {
        return 'remove';
    }

}