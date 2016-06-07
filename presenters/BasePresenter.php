<?php

namespace App\AdminModule\Presenters;

use Nette;
use Nette\Utils\Html;
use Wame\MenuModule\Components\IMenuControlFactory;
use Wame\UserModule\Entities\UserEntity;
use Wame\UserModule\Repositories\UserRepository;

abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** h4kuna Gettext latte translator trait */
    use \h4kuna\Gettext\InjectTranslator;

	/** @var IMenuControlFactory @inject */
	public $IMenuControlFactory;
	
	/** @var \Wame\AdminModule\Vendor\Wame\MenuModule\AdminMenuProvider @inject */
	public $adminMenuProvider;
    
	/** @var \WebLoader\Nette\LoaderFactory @inject */
	public $webLoader;
	
	/** @var \Kdyby\Doctrine\EntityManager @inject */
	public $entityManager;
	
	/** @var \Wame\RouterModule\Repositories\RouterRepository @inject */
	public $routerRepository;
	
	/** @var UserRepository @inject */
	public $userRepository;
	
	/** @var UserEntity */
	public $yourUserEntity;
	
	/** @persistent */
	public $id;
    
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
		
		$this->yourUserEntity = $this->userRepository->get(['id' => $this->user->id]);
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
      
    /** @return \Wame\MenuModule\Components\MenuControl */
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
	* Return module name
	* 
	* @param string $name
	* @return string
	*/
	public function getModule($name = null)
	{
		if (is_null($name)) {
			$name = $this->name;
		}

		$module = preg_replace("#:?[a-zA-Z_0-9]+$#", "", $name);

		return $module . 'Module';
	}

	/**
	* Return custom template
	* 
	* @return string
	*/
	public function getCustomTemplate()
	{
		if (isset($this->context->parameters['customTemplate'])) {
			$template = $this->context->parameters['customTemplate'];
		} else {
			$template = null;
		}

		return $template;
	}

	/**
	* Return template file
	* use current Module, Presenter
	* resolve customTemplates
	* 
	* @return array
	*/
	public function formatTemplateFiles()
	{
		$name = $this->getName();
		$presenter = substr($name, strrpos(':' . $name, ':'));
		$module = $this->getModule();

		$dir = dirname($this->getReflection()->getFileName());
		$dir = is_dir("$dir/templates") ? $dir : dirname($dir);

		$dirs = [];

		$dirs[] = APP_PATH . '/' . $module . '/admin/presenters/templates';

		if ($this->customTemplate) {
			$dirs[] = TEMPLATES_PATH . '/' . $this->customTemplate . '/' . $module . '/admin/presenters/templates';
		}

		$dirs[] = $dir . '/templates';

		$paths = [];

		foreach ($dirs as $dir) {
			array_push($paths, "$dir/$presenter/$this->view.latte", "$dir/$presenter.$this->view.latte");
		}

		return $paths;
	}

	/**
	* Return layout file
	* use current Module, Presenter
	* resolve customTemplates
	* 
	* @return array
	*/
	public function formatLayoutTemplateFiles()
	{
		$name = $this->getName();
		$presenter = substr($name, strrpos(':' . $name, ':'));
		$module = $this->getModule();
		$layout = $this->layout ? $this->layout : 'layout';

		$dir = dirname($this->getReflection()->getFileName());
		$dir = is_dir("$dir/templates") ? $dir : dirname($dir);

		$dirs = [];

		$dirs[] = APP_PATH . '/' . $module . '/admin/presenters/templates';

		if ($this->customTemplate) {
			$dirs[] = TEMPLATES_PATH . '/' . $this->customTemplate . '/' . $module . '/admin/presenters/templates';
		}

		$dirs[] = $dir . '/templates';

		$list = [];

		foreach ($dirs as $dir) {
			array_push($list, "$dir/$presenter/@$layout.latte", "$dir/$presenter.@$layout.latte");

			do {
				$list[] = "$dir/@$layout.latte";
				$dir = dirname($dir);
			} while ($dir && ($name = substr($name, 0, strrpos($name, ':'))));
		}

		array_push($list, APP_PATH . '/AdminModule/presenters/templates/@layout.latte');

		if ($this->customTemplate) {
			array_push($list, TEMPLATES_PATH . '/' . $this->customTemplate . '/AdminModule/presenters/templates/@layout.latte');
		}

		array_push($list, VENDOR_PATH . '/' . PACKAGIST_NAME . '/AdminModule/presenters/templates/@layout.latte');

		return $list;
	}
    
    /**
     * Create template
     * 
     * @return Nette\Application\UI\ITemplate
     */
    public function createTemplate()
    {
        $template = parent::createTemplate();
        
        $template->lang = $this->lang;
        $template->id = $this->id;
        
        return $template;
    }
	
	protected function shutdown($response) 
	{
		parent::shutdown($response);

		$this->entityManager->flush();
		
//		exit;
	}
	
	/**
	 * Format DateTime to string
	 * 
	 * @param \DateTime $date
	 * @param string $format
	 * @return string
	 */
	public function formatDate($date, $format = 'Y-m-d H:i:s')
	{
		return $date->format($format);
	}

}
