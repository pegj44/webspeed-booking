<?php

namespace Webspeed\Booking\Application\Controllers;

class BookingController
{
	public function __construct()
	{		

	}

	public static function testseg()
	{

	}

	public static function testroute2(\WP_REST_Request $request)
	{
		// !d($request->get_params());
		return new \WP_REST_Response([
			'status' => 'test route 2'
		], 200);
	}

	public static function testroute(\WP_REST_Request $request)
	{
		// !d($request->get_params());
		return new \WP_REST_Response([
			'status' => 'test route 1'
		], 200);
	}

	public static function roleManageOptions(\WP_REST_Request $request)
	{
		return new \WP_REST_Response([
			'status' => 'roleManageOptions'
		], 200);		
	}

	public static function roleEditPosts(\WP_REST_Request $request)
	{
		return new \WP_REST_Response([
			'status' => 'roleEditPosts'
		], 200);		
	}
}