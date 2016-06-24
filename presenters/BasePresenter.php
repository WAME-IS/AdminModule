<?php

namespace App\AdminModule\Presenters;

use Nette\Utils\Html;
use Wame\MenuModule\Components\MenuControl;
use Wame\MenuModule\Components\IMenuControlFactory;


abstract class BasePresenter extends \App\Core\Presenters\BasePresenter
{
	/** @var IMenuControlFactory @inject */
	public $IMenuControlFactory;
	
	/** @var \Wame\AdminModule\Vendor\Wame\MenuModule\AdminMenuProvider @inject */
	public $adminMenuProvider;
	
    
    public function startup()
    {
        parent::startup();
        
        if (!$this->user->isLoggedIn()) {
			$this->flashMessage(_('To enter this section must be signed.'), 'danger');
			$this->redirect(':User:Sign:in');
		}
		
		if (!$this->user->isAllowed('admin', 'view')) {
			$this->flashMessage(_('To enter this section you do not have enough privileges.'), 'danger');
			$this->redirect(':Homepage:Homepage:');
		}
    }
	
	
	/** @return CssLoader */
	protected function createComponentCss()
	{
		return $this->webLoader->createCssLoader('admin');
	}
	
	/** @return JavaScriptLoader */
	protected function createComponentJs()
	{
		return $this->webLoader->createJavaScriptLoader('admin');
	}
	
      
    /**
	 * Admin menu
	 * 
	 * @return MenuControl
	 */
	protected function createComponentMenu()
	{
        $control = $this->IMenuControlFactory->create();
		$control->addProvider($this->adminMenuProvider);
		$control->setContainerPrototype(Html::el('div')->setClass('com-adminMenu'));
		$control->setListPrototype(Html::el('ul')->setClass('list-group'));
		$control->setItemPrototype(Html::el('li')->setClass('list-group-item'));
        
		return $control;
	}


	/**
	* Return template file
	* use current Module, Presenter
	* resolve customTemplates
	* 
	* @return array
	*/
	public function formatTemplateFiles($way = '/admin')
	{
		return parent::formatTemplateFiles($way);
	}
	

	/**
	* Return layout file
	* use current Module, Presenter
	* resolve customTemplates
	* 
	* @return array
	*/
	public function formatLayoutTemplateFiles($modulePath = 'AdminModule', $way = '/admin')
	{
		return parent::formatLayoutTemplateFiles($modulePath, $way);
	}

}
