<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Wame\AdminModule\Vendor\Ublaboo\Datagrid\Column;

use Ublaboo\DataGrid\Column\ItemDetail as UblabooItemDetail;


class ItemDetail extends UblabooItemDetail
{
    use \Wame\AdminModule\Vendor\Ublaboo\Datagrid\Traits\TButton;
    
    public function __construct(\Ublaboo\DataGrid\DataGrid $grid, $primary_where_column) 
    {
        parent::__construct($grid, $primary_where_column);

		$this->class = 'btn btn-icon ajax';
		$this->icon = 'visibility';
    }

}
