<?php

namespace Webspeed\Booking\Application\Providers;

class AdminProvider
{
	public function __construct()
	{
		add_action('admin_menu', [$this, 'add_main_page_menu']);
	}

	public function add_main_page_menu()
	{
		add_menu_page(
			__('WP Bookings', 'wp-bookings'),
			'WP Bookings',
			'manage_options',
			'wp-bookings',
			[$this, 'add_main_page']
		);
	}

	public function add_main_page()
	{
		echo 'test menu';
	}
}