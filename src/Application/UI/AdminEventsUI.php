<?php

namespace Webspeed\Booking\Application\UI;

use Webspeed\Booking\Core\UserInterface;

class AdminEventsUI extends UserInterface
{
	public $adminTemplate = 'events';
	public $frontendTemplate = 'events';

	public function actions()
	{		
		add_filter('wp-bookings-submenu', [$this, 'addMenuPage'], 1);
	}

	public function addMenuPage($submenus)
	{
		$submenus[] = [
			'page_title' => 'Events', 
			'menu_title' => 'Events', 
			'capability' => 'manage_options', 
			'menu_slug'  => 'events', 
			'callback'   => [$this, 'adminPage']
		];

		return $submenus;
	}

	public function adminPage()
	{
		if (isset($_GET['wp-bookings-action'])) {
			if($_GET['wp-bookings-action'] == 'add') {
				echo $this->adminView('add');
			}
		} else {
			echo $this->adminView('events');	
		}
	}
	
	public function setTemplatePath()
	{
		
	}

	public function getDir()
	{
		return __FILE__;
	}
}