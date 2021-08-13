<?php

use Webspeed\Booking\Core\Migration;

Migration::create('events', [
	'id bigint(20) NOT NULL AUTO_INCREMENT',
	'title varchar(255) NOT NULL',
	'content bigint(20) UNSIGNED NOT NULL',
	'created_at datetime NOT NULL',
	'expires_at datetime NOT NULL',
	'PRIMARY KEY (id)'
]);