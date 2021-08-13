<?php

use Webspeed\Booking\Core\Route;

Route::group(['prefix' => 'events', 'version' => 1], function() 
{
	Route::groupPermissions(['roles' => ['manage_options']], function()
	{
		Route::post('add', 'EventsController@add');
		Route::post('update/{id}', 'EventsController@update');
		Route::post('delete/{id}', 'EventsController@delete');
	});

	Route::get('/', 'EventsController@getEvents');
	Route::get('/{id}', 'EventsController@getEvent');
});