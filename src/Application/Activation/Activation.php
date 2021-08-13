<?php

namespace Webspeed\Booking\Application\Activation;

class Activation
{
	public static function init()
	{
		$query = new \Webspeed\Booking\Core\Database;
		$query->insertTables();
	}
}