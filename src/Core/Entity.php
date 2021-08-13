<?php

namespace Webspeed\Booking\Core;

abstract class Entity
{
	private $postTypes = [];

	public function __construct() 
	{
		$this->hooks();
		$this->registerPostTypes();		
	}

	abstract public function hooks();

	abstract public function addPostType();	

	public function registerPostTypes()
	{
		$this->postTypes = $this->addPostType();

		// !d($this->postTypes);
		// register_post_type( 'wp-bookings-events', $args );
	}
}