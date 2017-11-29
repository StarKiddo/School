<?php

namespace App\Presenters;

use Nette;
use Nette\Database\Context;
use Nette\Http\Session;
use Tracy\Debugger;
use Nette\Utils\Arrays;


class BasePresenter extends Nette\Application\UI\Presenter
{

	private $database;
	private $session;
	private $visitedSection;

	public function __construct(Context $database, Session $session)
	{
		$this->database = $database;
		$this->session = $session;
		$this->visitedSection = $this->session->getSection("visited");
	}

	public function beforeRender()
	{
		if (!is_array($this->visitedSection->pages)) {
			$this->visitedSection->pages = [];
		}
		$currentLink = $this->getName() . ":" .$this->view;
		$this->visitedSection->pages[] = $currentLink;
		Debugger::dump($this->visitedSection->pages);

		$count = 0;
		$frequency = array();
		$frequency[' '] = 0;

		foreach ($this->visitedSection->pages as $page) {
			if (Arrays::searchKey($frequency, $page) != false){
				$frequency[$page]++;
			}

			else {

					$frequency[$page] = 1;
			}

		}
		foreach ($frequency as $key) {
			$count += $key;

		}
		foreach ($frequency as $key => $value) {
			$frequency[$key] = $value/$count * 100;
		}
		$this->template->frequency = $frequency;
		$this->template->count = $count;
	}
}
