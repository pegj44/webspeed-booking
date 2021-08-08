<?php

namespace Webspeed\Booking\Core;

class Plugin
{
	public $route;
	public $module;
	public $migration;

	public function __construct()
	{
		$this->loadCore();
		$this->loadApplication();		
	}

	private function loadCore()
	{
		$this->route 	 = new \Webspeed\Booking\Core\Route;
		$this->module 	 = new \Webspeed\Booking\Core\Module;
		$this->migration = new \Webspeed\Booking\Core\Migration;
	}

	public function loadApplication()
	{
		\Webspeed\Booking\Core\Loader::load('Application/Controllers');
		\Webspeed\Booking\Core\Loader::load('Application/Providers');
		\Webspeed\Booking\Core\Loader::load('Application/Entities');		
	}
}