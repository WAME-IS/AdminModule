<?php

namespace Wame\AdminModule\Vendor\Ublaboo\Datagrid\Filter;

use Nette;
use Ublaboo\DataGrid\Filter\FilterDate as UblabooFilterDate;


class FilterDate extends UblabooFilterDate
{
    /** {@inheritDoc} */
    protected $attributes = [
		['class', 'datepicker']
	];
    
    
	/** {@inheritDoc} */
	public function addToFormContainer(Nette\Forms\Container $container)
	{
		$container->addText($this->key, $this->name)
                    ->setType('date');

		$this->addAttributes($container[$this->key]);

		if ($this->grid->hasAutoSubmit()) {
			$container[$this->key]->setAttribute('data-autosubmit-change', TRUE);
		}

		if ($this->getPlaceholder()) {
			$container[$this->key]->setAttribute('placeholder', $this->getPlaceholder());
		}
	}

}
