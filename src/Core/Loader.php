<?php

namespace Webspeed\Booking\Core;

use Webspeed\Booking\Application\Helper;

class Loader
{
	public static function load($path)
	{
		$controllers = Helper::getSrcFiles($path);

		if (empty($controllers)) { return; }

		$path = str_replace('/', '\\', $path);

		foreach ($controllers as $controller) {
			$class = 'Webspeed\\Booking\\'. $path .'\\' . $controller;

			if (class_exists($class)) {
				new $class;
			}
		}		
	}
}