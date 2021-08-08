<?php

namespace Webspeed\Booking\Application;

class Helper
{
	public function __construct()
	{

	}

	public static function getSrcFiles(string $path, string $returnType = 'file'): array
	{		
		$files = glob( 
			WEBSPEED_BOOKING_DIR . 
			DIRECTORY_SEPARATOR .'src'. DIRECTORY_SEPARATOR . 
			self::DirToSafePath($path) . DIRECTORY_SEPARATOR .'*{.php}', GLOB_BRACE );

		if (empty($files)) { return []; }

		if ('file' == $returnType) {
			$files_arr = [];

			foreach ($files as $file) {
				$files_arr[] = str_replace('.php', '', basename($file));
			}

			return $files_arr;
		}

		return $files;
	}

	public static function DirToSafePath( string $path ): string
    {
		$path = preg_split( '/\\|\//', $path );

		return implode( DIRECTORY_SEPARATOR, $path );
	}	

	public static function loadSrcFile(string $dir, string $loadType = 'require_once'): bool
	{
		$filePath = WEBSPEED_BOOKING_DIR . DIRECTORY_SEPARATOR . 'src'. DIRECTORY_SEPARATOR . self::DirToSafePath($dir);

		if (!file_exists($filePath)) { return false; };

		if ($loadType == 'include') {
			include $filePath;
		} elseif ($loadType == 'include_once') {
			include_once $filePath;
		} elseif ($loadType == 'require_once') {
			require_once $filePath;
		} else {
			require_once $filePath;
		}

		return true;
	}

	public static function loadFiles( string $dir, string $loadType = 'require_once', string $extensions = 'php' ): array
    {
		$dir_files = glob( WEBSPEED_BOOKING_DIR . DIRECTORY_SEPARATOR . self::DirToSafePath($dir) . DIRECTORY_SEPARATOR .'*.{'. $extensions .'}', GLOB_BRACE );
		$included_filenames = [];

		if (empty($dir_files)) { return []; }

		foreach ($dir_files as $file)
		{
			$included_filenames[] = str_replace( '.php', '', basename($file) );

			if ($loadType == 'include') {
				include $file;
			} elseif ($loadType == 'include_once') {
				include_once $file;
			} elseif ($loadType == 'require_once') {
				require_once $file;
			} else {
				require_once $file;
			}
		}

		return $included_filenames;
	}

	/**
	 * Append log report to wp debug.log 
	 */
	public static function debugLog($logs)
	{
		if (is_array($logs) || is_object($logs)) {      
		  error_log( print_r($logs, true) );
		} else {
		  error_log($logs);
		}	
	}
}