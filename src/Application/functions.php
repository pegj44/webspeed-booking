<?php

use Webspeed\Booking\Core\UserInterface;

function wp_bookings_admin_url(string $page, string $subpage = ''): string
{
	$prefix = UserInterface::getMenuPrefix();
	$subpage = ($subpage)? '&'. $prefix . 'action='. $subpage : '';
	$url = 'admin.php?page='. UserInterface::getMenuPrefix() . $page . $subpage;
	
	return admin_url($url);
}