<?php

namespace Wame\AdminModule\Vendor\Wame\MenuModule\Components\MenuControl\AdminMenu;

use Nette\Application\LinkGenerator;
use Wame\MenuModule\Models\Item;

interface IAdminMenuItem
{
	/** @return AdminMenuItem */
	public function create();
}


class AdminMenuItem implements \Wame\MenuModule\Models\IMenuItem
{	
    /** @var LinkGenerator */
	private $linkGenerator;
	
	
	public function __construct(
		LinkGenerator $linkGenerator
	) {
		$this->linkGenerator = $linkGenerator;
	}

	
	public function addItem()
	{
		$item = new Item();
        $item->setPriority(0);
		$item->setName('dashboard');
		$item->setTitle(_('Dashboard'));
		$item->setLink($this->linkGenerator->link('Admin:Dashboard:', ['id' => null]));
		$item->setIcon('fa fa-dashboard');
		
		return $item->getItem();
	}

}
