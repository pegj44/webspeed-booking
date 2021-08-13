<?php

namespace Webspeed\Booking\Core;

use \Webspeed\Booking\Application\Helper;

class UserInterface
{	
	public $adminTemplate = false;
	public $frontendTemplate = false;
	public $adminAssetUrl = '';
	public $frontendAssetUrl = '';
	public static $menuPrefix = 'wp-bookings-';

	private $UIDir;
	private $pluginDirName;
	private $frontendViewPath;
	private $adminViewPath;

	public function __construct()
	{		
		$this->registerHooks();
		$this->registerMenus();
		$this->setPaths();
	}

	public function actions() {}

	public function adminScripts(string $path) {}

	public function frontendScripts(string $path) {}

	public function addSubmenuPage() {}

	public function addMainPageMenu() {}

	public function getDir() {}

	public static function getMenuPrefix()
	{
		return self::$menuPrefix;
	}

	final public function adminView(string $filePath, array $data = []): string
	{
		if (!$filePath || !$this->adminTemplate) { return ''; }

		$filePath = str_replace( '.php', '', Helper::DirToSafePath( $filePath ) ) . '.php';
		$templateDir = $this->adminViewPath . DIRECTORY_SEPARATOR . $filePath;
		
		if (!file_exists( $templateDir )) { return ''; }

		extract($data); 
		ob_start();

		require_once $templateDir;

		return ob_get_clean();
	}

	final public function view(string $filePath, array $data = []): string
    {
		if (!$filePath || !$this->frontendTemplate) { return ''; }
		
		$filePath = str_replace( '.php', '', Helper::DirToSafePath( $filePath ) ) . '.php';
		$template_dir = locate_template( $this->pluginDirName . DIRECTORY_SEPARATOR . $this->frontendTemplate . DIRECTORY_SEPARATOR . $filePath );

		if (!$template_dir)
		{
			$template_dir = $this->frontendViewPath . DIRECTORY_SEPARATOR . $filePath;			
			if (!file_exists( $template_dir )) { return ''; }
		}

		extract($data); 
		ob_start();

		require_once $template_dir;

		return ob_get_clean();
	}

	private function registerHooks()
	{
		$this->actions();		
		$this->registerScripts();
	}

	private function registerScripts()
	{
		add_action( 'admin_enqueue_scripts', [$this, 'enqueueAdminScripts'] );
		add_action( 'wp_enqueue_scripts', [$this, 'enqueueFrontendScripts'] );		
	}

	final public function enqueueAdminScripts() 
	{
		$this->adminScripts($this->adminAssetUrl);
	}

	final public function enqueueFrontendScripts()
	{
		$this->frontendScripts($this->frontendAssetUrl);
	}

	private function registerMenus()
	{
		add_action('admin_menu', [$this, 'setMenu']);
	}

	final public function setMenu()
	{
		$this->addMainPageMenu();
	}	

	private function setPaths()
	{
		$this->dir 				= $this->getDir();
		$this->pluginDirName	= basename(WEBSPEED_BOOKING_DIR);		
		$this->adminAssetUrl 	= $this->getAdminAssetUrl();
		$this->frontendAssetUrl = $this->getFrontendAssetUrl();
		$this->adminViewPath 	= $this->getAdminTemplateViewPath();
		$this->frontendViewPath = $this->getFrontendTemplateViewPath();
	}	

	private function getAdminAssetUrl(): string
	{
		return plugins_url( false, $this->dir ) . '/assets/';
	}

	private function getFrontendAssetUrl(): string
	{
		return plugins_url( 'public/assets', WEBSPEED_BOOKING_DIR .'/src' ) . '/';
	}

	private function getAdminTemplateViewPath(): string
	{
		if (!$this->adminTemplate) { return ''; }

		return plugin_dir_path($this->dir) . 'templates' . DIRECTORY_SEPARATOR . $this->adminTemplate;
	}

	private function getFrontendTemplateViewPath(): string
	{
		if (!$this->frontendTemplate) { return ''; }

		return plugin_dir_path(WEBSPEED_BOOKING_DIR .'/src') . DIRECTORY_SEPARATOR .'templates'. DIRECTORY_SEPARATOR . $this->frontendTemplate;
	}
}
