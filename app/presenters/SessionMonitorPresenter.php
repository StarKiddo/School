<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Tracy\Debugger;
use Nette\Http\Session;


class SessionMonitorPresenter extends BasePresenter
{

	private $database;

	public function __construct(Context $database, Session $session)
	{
		parent::__construct($database, $session);
		$this->database = $database;
	}


	public function renderDefault() {

	}

}
