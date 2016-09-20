<?php

/**
 * @copyright   Copyright (c) 2015 ublaboo <ublaboo@paveljanda.com>
 * @author      Pavel Janda <me@paveljanda.com>
 * @package     Ublaboo
 */

namespace Wame\AdminModule\Vendor\Ublaboo\Datagrid\Traits;

use Nette\Utils\Html;
use Wame\AdminModule\Vendor\Wame\DataGridControl\AdminDataGridControl;


trait TButton
{
	/**
	 * Should the element has an icon?
	 * @param  Html            $el
	 * @param  string|null     $icon
	 * @param  string          $name
	 * @return void
	 */
	public function tryAddIcon(Html $el, $icon, $name)
	{
		if ($icon) {
			$el->addHtml(Html::el('span')->class(AdminDataGridControl::$icon_prefix)->setText($icon));

			if (strlen($name)) {
				$el->addHtml('&nbsp;');
			}
		}
	}

}
