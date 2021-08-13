<?php

namespace Webspeed\Booking\Core;

class Request
{
	public $request;

	public function __construct()
	{
		$this->getRequest();
	}

	public function getRequest()
	{
		if (!empty($_POST)) {
			$this->post($_POST);
		}

		if (!empty($_GET)) {
			$this->get($_GET);
		}
	}

	public function validateRequest(string $action, string $nonce): bool
	{
		if (!isset($_POST[$nonce]) || !wp_verify_nonce($_POST[$nonce], $action)) {			
			return false;
		}

		return true;
	}

	public function post($data) {}

	public function get($data) {}
}