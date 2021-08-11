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
		\Webspeed\Booking\Application\Helper::loadSrcFile('Application/routes.php');
		
		add_action('rest_api_init', ['Webspeed\Booking\Core\Route', 'register_routes']);
	}

	public function loadApplication()
	{
		// \Webspeed\Booking\Core\Loader::load('Application/Controllers');
		\Webspeed\Booking\Core\Loader::load('Application/Providers');
		// \Webspeed\Booking\Core\Loader::load('Application/Entities');		
	}
}