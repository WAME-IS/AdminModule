<?php

namespace App\AdminModule\Presenters;

class DashboardPresenter extends \App\AdminModule\Presenters\BasePresenter
{
    public function startup()
    {
        parent::startup();
		
		if (!$this->user->isAllowed('dashboard', 'view')) {
			$this->flashMessage(_('To enter this section you have sufficient privileges.'), 'danger');
			$this->redirect('parent');
		}
    }
	
	public function renderDefault()
	{
		$this->template->siteTitle = _('Dashboard');
	}

}
