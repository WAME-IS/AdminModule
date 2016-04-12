<?php

namespace Wame;

use Wame\Core\Models\Plugin;
use Wame\PermissionModule\Models\PermissionObject;

class AdminModule extends Plugin 
{
	/** @var PermissionObject */
	private $permission;

	public function __construct(PermissionObject $permission) 
	{
		$this->permission = $permission;
	}

	public function onEnable() 
	{
		$this->permission->addResource('admin');
		$this->permission->addResourceAction('admin', 'view');
		$this->permission->allow('moderator', 'admin', 'view');
		$this->permission->addResourceAction('admin', 'add');
		$this->permission->allow('moderator', 'admin', 'add');
		$this->permission->addResourceAction('admin', 'edit');
		$this->permission->allow('moderator', 'admin', 'edit');
		$this->permission->addResourceAction('admin', 'delete');
		$this->permission->allow('admin', 'admin', 'delete');
		
		$this->permission->addResource('dashboard');
		$this->permission->addResourceAction('dashboard', 'view');
		$this->permission->allow('moderator', 'dashboard', 'view');
	}

}
