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
		$this->loadRoutes();
		$this->loadApplication();
	}

	private function loadCore()
	{

	}

	public function loadRoutes()
	{
		\Webspeed\Booking\Application\Helper::loadSrcFile('Application/routes.php');
		add_action('rest_api_init', ['Webspeed\Booking\Core\Route', 'registerRoutes']);
	}

	public function loadApplication()
	{
		\Webspeed\Booking\Application\Helper::loadSrcFile('Application/functions.php');
		\Webspeed\Booking\Core\Loader::load('Application/Entities');
		\Webspeed\Booking\Core\Loader::load('Application/UI');
		\Webspeed\Booking\Core\Loader::load('Application/Requests');
	}
}