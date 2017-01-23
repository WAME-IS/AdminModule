<?php

namespace App\AdminModule\Presenters;

class DashboardPresenter extends BasePresenter
{
	public function renderDefault()
	{
		$this->template->siteTitle = _('Dashboard');
	}

}
