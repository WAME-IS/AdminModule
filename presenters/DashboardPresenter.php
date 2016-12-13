<?php

namespace App\AdminModule\Presenters;

class DashboardPresenter extends \App\AdminModule\Presenters\BasePresenter
{
	public function renderDefault()
	{
		$this->template->siteTitle = _('Dashboard');
	}

}
