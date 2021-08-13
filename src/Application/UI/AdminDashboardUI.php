<?php

namespace Webspeed\Booking\Application\UI;

use \Webspeed\Booking\Core\UserInterface;

class AdminDashboardUI extends UserInterface
{
	public $adminTemplate = 'dashboard';

	public function addMainPageMenu()
	{
		add_menu_page(
			__('WP Bookings', 'wp-bookings'),
			'WP Bookings',
			'manage_options',
			'wp-bookings',
			[$this, 'addMainPage']
		);

		$submenus = apply_filters( 'wp-bookings-submenu', [] );

		foreach ($submenus as $menu => $args) {			
			add_submenu_page(
				'wp-bookings', 
				$args['page_title'], 
				$args['menu_title'], 
				$args['capability'], 
				self::$menuPrefix . $args['menu_slug'], 
				$args['callback']
			);					
		}
	}

	public function addMainPage()
	{
		echo 'dashboard';
	}

	public function getDir()
	{
		return __FILE__;
	}
}