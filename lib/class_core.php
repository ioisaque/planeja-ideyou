<?php

/**
 * Classe Core
 *
 * @package isaque.it
 * @author Isaque Costa
 * @copyright 2021
 **/

final class Core
{
	public static $get = array();
	public static $post = array();

	/**
	 * Core::__construct()
	 *
	 * @return
	 */
	public function __construct()
	{
		$_GET = self::clean($_GET);
		$_POST = self::clean($_POST);

		self::$get = $_GET;
		self::$post = $_POST;

		$this->init();
	}

	/**
	 * Core::init()
	 *
	 * @return
	 */
	private function init()
	{
		$sessionName = CAPS(preg_replace('/\s/', '_', trim(rACENTOS(COMPANY_NAME))));

		session_start([
			"name" => $sessionName,
			"cookie_lifetime" => 604800,
		]);
	}

	/**
	 * Core::post()
	 *
	 * @return
	 */
	public static function post($var)
	{
		return isset(self::$post[$var]) ? self::$post[$var] : null;
	}

	/**
	 * Core::data()
	 * Retorna o valor do POST; se não existir, tenta o GET.
	 *
	 * @return
	 */
	public static function data($var)
	{
		if (isset(self::$post[$var]))
			return self::$post[$var];

		return isset(self::$get[$var]) ? self::$get[$var] : null;
	}

	/**
	 * Core::clean()
	 *
	 * @param mixed $data
	 * @return
	 */
	public static function clean($data, $trim = false)
	{
		if (is_array($data)) {
			foreach ($data as $key => $value) {
				unset($data[$key]);

				$data[self::clean($key)] = self::clean($value);
			}
		} else {
			$data = filter_var($data, FILTER_UNSAFE_RAW);
			$data = trim($data);
			$data = stripslashes($data);
			$data = strip_tags($data);
			$data = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $data);

			if ($trim)
				$data = substr($data, 0, $trim);

			$data = urldecode($data);
		}

		return $data;
	}
}
