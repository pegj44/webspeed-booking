<?php

namespace Webspeed\Booking\Application\Controllers;

use Webspeed\Booking\Application\Entities\Events;

class EventsController
{
	public static function add(\WP_REST_Request $request)
	{
		do_action('wp-bookings-before-add-event');
		
		$addEvent = Events::add([
			'post_title'   => 'test event1',
			'post_content' => 'test event1 content',
			'post_status'  => 'publish'
		]);

		do_action('wp-bookings-after-add-event');

		return new \WP_REST_Response([
			'status' => 'event added'
		], 200);
	}



	public static function update(\WP_REST_Request $request)
	{

	}

	public static function delete(\WP_REST_Request $request)
	{
		
	}

	public static function getEvents(\WP_REST_Request $request)
	{
		
	}

	public static function getEvent(\WP_REST_Request $request)
	{
		
	}
}