<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;
use Wame\DataGridControl\DataGridControl;


class Remove extends BaseGridItem
{
    /** @var string */
    private $link;
    
    /** @var mixed */
    private $linkParams = null;
    
    /** @var array */
    private $dataLinkParams = [];
    
    
    /** set *******************************************************************/
    
    /**
     * Set link
     * 
     * @param type $link
     * @return \Wame\AdminModule\Vendor\Wame\DataGridControl\Actions\Remove
     */
    public function setLink($link, $params = null)
    {
        $this->link = $link;
        $this->linkParams = $params;
        
        return $this;
    }
    
    /**
     * Set data link params
     * 
     * @param array $dataLinkParams
     * @return \Wame\AdminModule\Vendor\Wame\DataGridControl\Actions\Remove
     */
    public function setDataLinkParams(array $dataLinkParams)
    {
        $this->dataLinkParams = $dataLinkParams;
        
        return $this;
    }
    
    /** get *******************************************************************/
    
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
            return ":{$grid->presenter->getName()}:remove";
        }
    }
    
    private function getLinkParams()
    {
        return $this->linkParams;
    }
    
    private function getDataLinkParams()
    {
        return $this->dataLinkParams;
    }
    
    
    /** render ****************************************************************/
    
    /** {@inheritDoc} */
	public function render($grid)
    {
		$grid->addAction('remove', '', $this->getLink($grid), $this->getLinkParams())
                ->setIcon('clear')
                ->addAttributes([
                    'data-position' => 'left', 
                    'data-tooltip' => _('Remove'),
                    'data-link-params' => $this->getDataLinkParams()
                ])
                ->setClass('btn btn-xs btn-icon btn-hover-danger tooltipped ajax-modal');
		
		return $grid;
	}
    
}