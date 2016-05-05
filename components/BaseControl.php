<?php 

namespace App\AdminModule\Components;

use Nette\Application\UI;

class BaseControl extends UI\Control
{
 	/** @var string */
	public $templateFile;
	

	/**
	 * Set template file
	 * 
	 * @param string $template
	 * @return \App\AdminModule\Components\AdminMenuControl\AdminMenuControl
	 */
	public function setTemplateFile($template)
	{
		$this->templateFile = $template;
		
		return $this;
	}

}