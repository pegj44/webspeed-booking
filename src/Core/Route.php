<?php

namespace Webspeed\Booking\Core;

class Route
{
	private static $_instance = null;
	private static $version = '1';
	private static $requestRoutes = [];
	private static $prefix = '';
	private static $mainPrefix = 'wp-bookings';
	private static $permissions = [];
	private static $namespace = 'Webspeed\\Booking\\Application\\Controllers\\';

	public static function registerRoutes()
	{		
		foreach (self::$requestRoutes as $route) {

			$callback = explode('@', $route['callback']);

			if (2 === count($callback)) {

				$routeArgs = [
					'methods'  => $route['method'],
					'callback' => [$route['namespace'] . $callback[0], $callback[1]],
					'args'     => $route['args']					
				];								

				if (!empty($route['permissions'])) {
					$routeArgs['permissions'] = $route['permissions'];
					$routeArgs['permission_callback'] = [$route['namespace'] . 'RolesController', 'hasPermission'];
				}
				
				register_rest_route(dirname($route['segment']), basename($route['segment']), $routeArgs);
			}
		}
	}

	public static function post(string $segment, string $callback, array $args = [])
	{
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

		self::$requestRoutes[] = [
			'method'    => 'POST',
			'segment'   => self::$mainPrefix .'/v'. self::$version . self::$prefix . $segment,
			'args'      => $args,
			'namespace' => self::$namespace,
			'callback'  => $callback,
			'permissions' => self::$permissions
		];

		return self::$_instance;
	}

	public static function get(string $segment, string $callback, array $args = [])
	{
        if (self::$_instance === null) {
            self::$_instance = new self;
        }

		self::$requestRoutes[] = [
			'method'    => 'GET',
			'segment'   => self::$mainPrefix .'/v'. self::$version . self::$prefix . $segment,
			'args'      => $args,
			'namespace' => self::$namespace,
			'callback'  => $callback,
			'permissions' => self::$permissions
		];	

		return self::$_instance;
	}

	public static function group(array $args, callable $function)
	{		
		self::$version = (isset($args['version']))? rtrim($args['version'], '/') .'/' : '';
		self::$prefix = (isset($args['prefix']))? rtrim($args['prefix'], '/') .'/' : '';
		self::$namespace = (isset($args['namespace']))? $args['namespace'] : self::$namespace;

		call_user_func($function);

		self::$version = '';
		self::$prefix = '';
		self::$namespace = '';
	}

	public static function groupPermissions(array $args, callable $function)
	{
		self::$permissions = $args;

		call_user_func($function);

		self::$permissions = '';
	}

	public static function getPermission( $permission )
	{
		if (strpos($permission, '@') !== false) {
			$callback = explode('@', $permission);
			return [self::$namespace . $callback[0], $callback[1]];
		}

		if (strpos($permission, '.') !== false) {
			$callback = explode('.', $permission);
			$function = $callback[0];

			return $function($callback[1]);
		}

		return false;
	}
}