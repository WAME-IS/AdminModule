<?php 

namespace App\AdminModule\Components\AdminMenu;

class AdminMenuControl extends \App\AdminModule\Components\BaseControl
{	
	/** @var array */
	private $items = [];

	/** @var string */
	private $templateFile;
	
	public function setItem($factory)
	{
		$item = $factory->create();

		$this->items[] = $item->addItem();	
	}
    
    /**
     * Set template file
     * 
     * @param string $template
     * @return \App\AdminModule\Components\AdminMenu\AdminMenuControl
     */
	public function setTemplateFile($template)
	{
		$this->templateFile = $template;
		
		return $this;
	}
	
	public function render()
	{
		if ($this->templateFile) {
			$this->template->setFile($this->templateFile);
		} else {
			$this->template->setFile(__DIR__ . '/AdminMenuControl.latte');
		}

		$this->template->items = $this->items;
		$this->template->render();
	}

}