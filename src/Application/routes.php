<?php

use Webspeed\Booking\Core\Route;

Route::group(['prefix' => 'testseg/v1'], function() 
{
	Route::post('seg2', 'BookingController@testroute2', [
		'param1' => [
			'validate_callback' => function($param) {
				return is_numeric($param);
			}
		],
		'param2' => [
			'validate_callback' => function($param) {
				return ($param == 'test');
			},
			'sanitize_callback' => function($param) {
				return 'testdd';
			}
		]
	]);

	Route::groupPermissions(['roles' => []], function() 
	{
		Route::post('seg3', 'BookingController@roleManageOptions');
		Route::get('seg4', 'BookingController@roleEditPosts');
	});
});