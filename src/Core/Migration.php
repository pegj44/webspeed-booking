<?php

namespace Webspeed\Booking\Core;

class Migration
{
	private static $createTables = [];
	private static $dropTables = [];
	public static $dbPrefix = 'webspeed_booking_';

	public static function create($tableName, $properties)
	{
		self::$createTables[$tableName] = $properties;
	}

	public static function drop($tableName)
	{
		self::$dropTables[] = $tableName;
	}

	public function insertTables()
	{
		\Webspeed\Booking\Application\Helper::loadSrcFile('Application/Database/insert-migrations.php');

		if (empty(self::$createTables)) { return; }

		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');		

		foreach (self::$createTables as $tableName => $properties) {

			$tablePrefix = self::$dbPrefix;
			$props = implode(', ', $properties);
		    $sql = "CREATE TABLE {$wpdb->prefix}{$tablePrefix}{$tableName} ({$props}) $charset_collate;";

		    dbDelta($sql);
		}

	    $success = empty($wpdb->last_error);

	    return $success;
	}

	public static function dropTables()
	{
		\Webspeed\Booking\Application\Helper::loadSrcFile('Application/Database/drop-migrations.php');

		if (empty(self::$dropTables)) { return; }

		global $wpdb;

		foreach (self::$dropTables as $tableName) {

			$tablePrefix = self::$dbPrefix;
		    $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}{$tablePrefix}{$tableName}" );
		}

	    $success = empty($wpdb->last_error);

	    return $success;
	}	
}