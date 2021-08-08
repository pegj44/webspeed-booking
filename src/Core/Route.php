<?php

namespace Webspeed\Booking\Core;

class Route
{
	private $post_requests = [];
	private $get_requests = [];
	private $prefix;

	public function __construct()
	{

	}

	public function registerPostRoutes()
	{
		foreach ($this->post_requests as $route) {
			// register_rest_route($route['segment'], '', [

			// ]);
		}
	}

	public function registerGetRoutes()
	{

	}

	public static function post(string $segment, string $callback)
	{
		$this->post_requests[] = [
			'segment' => $segment,
			'callback' => $callback
		];
	}

	public static function get(string $segment, string $callback)
	{
		$this->get_requests[] = [
			'segment' => $segment,
			'callback' => $callback
		];
	}

	public static function group(array $args, callable $function)
	{
		$this->prefix = $args['prefix'];
	}

	public function disectSegment(string $segment)
	{

	}
}