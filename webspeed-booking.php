<?php

/**
 * Plugin Name: WP Bookings
 * Author: Paul
 * Description: Wordpress Booking System
 * version: 1.0.0
 * Package: wp-bookings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

define('WEBSPEED_BOOKING_VERSION', '1.0.0');
define('WEBSPEED_BOOKING_DIR', plugin_dir_path(__FILE__));
define('WEBSPEED_BOOKING_URI', plugin_dir_url(__FILE__));

require_once plugin_dir_path( __FILE__ ) .'vendor/autoload.php';

register_activation_hook(__FILE__, ['Webspeed\Booking\Application\Activation\Activation', 'init']);
register_deactivation_hook(__FILE__, ['Webspeed\Booking\Application\Activation\Deactivation', 'init']);
register_uninstall_hook(__FILE__, ['Webspeed\Booking\Application\Activation\Uninstall', 'init']);

add_action('plugins_loaded', function() 
{
	new Webspeed\Booking\Core\Plugin;
});