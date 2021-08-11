<?php

namespace Webspeed\Booking\Core;

class Route
{
	private static $_instance = null;
	private static $requestRoutes = [];
	private static $prefix = '';
	private static $permissions = [];
	private static $namespace = 'Webspeed\\Booking\\Application\\Controllers\\';

	public static function register_routes()
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
			'segment'   => self::$prefix . $segment,
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
			'segment'   => self::$prefix . $segment,
			'args'      => $args,
			'namespace' => self::$namespace,
			'callback'  => $callback,
			'permissions' => self::$permissions
		];	

		return self::$_instance;
	}

	public static function group(array $args, callable $function)
	{		
		self::$prefix = (isset($args['prefix']))? rtrim($args['prefix'], '/') .'/' : '';
		self::$namespace = (isset($args['namespace']))? $args['namespace'] : self::$namespace;

		call_user_func($function);

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