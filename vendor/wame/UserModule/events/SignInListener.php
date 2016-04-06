<?php

namespace Wame\AdminModule\Vendor\Wame\UserModule\Events;

use Nette\Object;
use Nette\Application\Application;
use Nette\Security\User;

class SignInListener extends Object 
{
	/** @var \Nette\Application\Application */
	public $application;

	public function __construct(Application $application, User $user)
	{
		$this->application = $application;
		
		$user->onLoggedIn[] = [$this, 'redirectAfterLogin'];
	}

	public function redirectAfterLogin(User $user) 
	{
		$presenter = $this->application->getPresenter();

		if ($user->isInRole('administrator')) {
			$presenter->redirect(':Admin:Dashboard:');
		}
	}

}
