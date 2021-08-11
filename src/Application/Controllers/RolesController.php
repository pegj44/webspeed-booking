<?php

namespace Webspeed\Booking\Application\Controllers;

class RolesController
{
	public static function hasPermission($obj): bool
	{
		$attributes = $obj->get_attributes();

		foreach ($attributes['permissions']['roles'] as $role) {
			if (!current_user_can($role)) {
				return false;
			}
		}

		return true;
	}
}