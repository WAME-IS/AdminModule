<?php 

namespace App\AdminModule\Components;

use Nette\Application\UI;
use Wame\ComponentModule\Entities\ComponentInPositionEntity;

class BaseControl extends UI\Control
{
  	/** @var string */
	public $componentName;
	
	/** @var ComponentInPositionEntity */
	public $componentInPosition;
	
	/** @var string */
	public $templateFile;
	
	
	/**
	 * Set component name
	 * 
	 * @param string $componentName
	 * @return \App\AdminModule\Components\BaseControl
	 */
	public function setComponentName($componentName)
	{
		$this->componentName = $componentName;
		
		return $this;
	}
	
	
	/**
	 * Set component in position
	 * 
	 * @param ComponentInPositionEntity $componentInPosition
	 * @return \App\AdminModule\Components\BaseControl
	 */
	public function setComponentInPosition($componentInPosition)
	{
		$this->componentInPosition = $componentInPosition;
		
		if ($componentInPosition->getParameter('template')) {
			$this->setTemplateFile($componentInPosition->getParameter('template'));
		}
		
		return $this;
	}
	
	
	/**
	 * Set template file
	 * 
	 * @param string $template
	 * @return \App\AdminModule\Components\BaseControl
	 */
	public function setTemplateFile($template)
	{
		$this->templateFile = $template;
		
		return $this;
	}

}