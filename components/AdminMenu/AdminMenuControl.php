<?php 

namespace App\AdminModule\Components\AdminMenu;

class AdminMenuControl extends \App\AdminModule\Components\BaseControl
{	
	/** @var array */
	public $items = [];

	private $templateFile;
	
	public function setItem($name)
	{
		$item = new $name();
		$this->items[] = $item->item;	
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