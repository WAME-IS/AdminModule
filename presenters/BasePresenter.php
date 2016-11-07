<?php

namespace App\AdminModule\Presenters;

use Wame\MenuModule\Components\MenuControl;
use Wame\MenuModule\Components\IMenuControlFactory;
use Wame\AdminModule\Vendor\Wame\MenuModule\ItemTemplate;


abstract class BasePresenter extends \App\Core\Presenters\BasePresenter
{
	/** @var IMenuControlFactory @inject */
	public $IMenuControlFactory;

	/** @var \Wame\AdminModule\Vendor\Wame\MenuModule\AdminMenuProvider @inject */
	public $adminMenuProvider;

    /** @var ItemTemplate @inject */
	public $itemTemplate;


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

        $this->dictionary->setDomain('AdminModule');
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
        $control->setItemTemplate($this->itemTemplate);
        $control->setTemplateFile('admin.latte');

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
