<?php

/**
 * Classe Core
 *
 * @package IdeYou
 * @author Isaque Costa
 * @copyright 2021
 **/

final class Core
{
	public static $get = array();
	public static $post = array();
	public static $files = array();
	public static $cookie = array();
	public static $server = array();
	public static $request = array();
	public static $session = array();

	public static $id = null;
	public static $do = null;
	public static $action = null;
	public static $daysOfWeek = array(
		"sunday" => "Domingo",
		"monday" => "Segunda",
		"tuesday" => "Terça",
		"wednesday" => "Quarta",
		"thursday" => "Quinta",
		"friday" => "Sexta",
		"saturday" => "Sábado",
	);

	public static $messages = array();
	public static $print = false;
	public static $redirect = false;

	/**
	 * Core::__construct()
	 *
	 * @return
	 */
	public function __construct()
	{
		$_FILES = $_FILES;
		$_GET = self::clean($_GET);
		$_POST = self::clean($_POST);
		$_COOKIE = self::clean($_COOKIE);
		$_SERVER = self::clean($_SERVER);
		$_REQUEST = self::clean($_REQUEST);

		self::$get = $_GET;
		self::$post = $_POST;
		self::$files = $_FILES;
		self::$cookie = $_COOKIE;
		self::$server = $_SERVER;
		self::$request = $_REQUEST;

		self::getID();
		self::getDo();
		self::getAction();

		$this->init();
	}

	/**
	 * Core::init()
	 *
	 * @return
	 */
	private function init()
	{

		if (strpos($_SERVER['REQUEST_URI'], '/sistema/') !== false) {
			$SESSION_NAME = lang('SISTEMA_') . COMPANY_NAME; // Internal Access
		} elseif (strpos($_SERVER['REQUEST_URI'], '/webservice/') !== false) {
			$SESSION_NAME = 'WebService'; // Webservice Access
		} else {
			$SESSION_NAME = COMPANY_NAME; // Client Access
		}

		$SESSION_NAME = rACENTOS($SESSION_NAME);

		session_start([
			"name" => CAPS(preg_replace('/\s/', '_', trim($SESSION_NAME))),
			"cookie_lifetime" => 604800,
		]);
	}

	/**
	 * Core::getID()
	 *
	 * @return
	 */
	private static function getID()
	{
		if (isset(self::$request['id'])) {
			$id = (is_numeric(self::$request['id']) && self::$request['id'] > -1) ? intval(self::$request['id']) : self::clean(self::$request['id']);

			if ($id == null)
				return self::error(400);
			else
				return self::$id = $id;
		}
	}

	/**
	 * Core::getDo()
	 *
	 * @return
	 */
	private static function getDo()
	{
		if (isset(self::$get['do'])) {
			$do = ((string) self::$get['do']) ? (string) self::$get['do'] : false;
			$do = self::clean($do);

			if ($do == false) {
				return DEBUG == true ? self::error(404) : 'ERROR: DO inválido!';
			} else {
				return self::$do = strtolower($do);
			}
		}
	}

	/**
	 * Core::getAction()
	 *
	 * @return
	 */
	private static function getAction()
	{
		if (isset(self::$get['action'])) {
			$action = ((string) self::$get['action']) ? (string) self::$get['action'] : false;
			$action = self::clean($action);

			if ($action == false) {
				return DEBUG == true ? self::error(404) : 'ERROR: ACTION inválido!';
			} else {
				return self::$action = $action;
			}
		}
	}

	/**
	 * Core::GET()
	 *
	 * @return
	 */
	public static function get($var)
	{
		return isset(self::$get[$var]) ? self::$get[$var] : null;
	}

	/**
	 * Core::POST()
	 *
	 * @return
	 */
	public static function post($var)
	{
		return isset(self::$post[$var]) ? self::$post[$var] : null;
	}

	/**
	 * Core::COOKIE()
	 *
	 * @return
	 */
	public static function cookie($var, $json = false)
	{
		return isset(self::$cookie[$var]) ? ($json ? json_decode(self::$cookie[$var]) : self::$cookie[$var]) : ($json ? [] : null);
	}

	/**
	 * Core::FILE()
	 *
	 * @return
	 */
	public static function file($var)
	{
		return isset(self::$files[$var]) ? self::$files[$var] : null;
	}

	/**
	 * Core::curl()
	 *
	 * @return
	 */
	public static function curl($URL, $TYPE = 'GET', $options = [])
	{
		$defaultOptions = [
			CURLOPT_URL => $URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $TYPE,
			CURLOPT_POSTFIELDS => "",
		];

		$curl = curl_init();

		$options = ($options && is_array($options)) ? $options : [];

		curl_setopt_array($curl, $options + $defaultOptions);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return "cURL Error #:" . $err;
		} else {
			return json_decode($response);
		}
	}


	/**
	 * Core::CORS()
	 *
	 * @return
	 */
	public static function cors()
	{
		// Allow from any origin
		// if (!isset($_SERVER['HTTP_ORIGIN'])) {
		// should do a check here to match $_SERVER['HTTP_ORIGIN'] to a
		// whitelist of safe domains
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Credentials: true');
		header('Access-Control-Max-Age: 86400'); // cache for 1 day
		// }
		// Access-Control headers are received during OPTIONS requests
		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
				header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

			if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
				header('Access-Control-Allow-Headers: ' . $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']);

			die();
		}
	}

	/**
	 * Core::error()
	 *
	 * @return
	 */
	public static function error($code)
	{
		if (!headers_sent()) {
			Core::redirectTo("http://cdn.ideyou.com.br/_error/" . $code . ".html");
			exit;
		} else {
			echo '<script type="text/javascript" charset="UTF-8">';
			echo 'window.location.href = "http://cdn.ideyou.com.br/_error/' . $code . '.html";';
			echo '</script>';

			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="http://cdn.ideyou.com.br/_error/' . $code . '.html" />';
			echo '</noscript>';
		}
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

	/**
	 * Core::redirectTo()
	 *
	 * @return
	 */
	public static function redirectTo($location)
	{
		if (!headers_sent()) {
			header('Location: ' . $location);
			exit;
		} else {
			echo '<script type="text/javascript" charset="UTF-8">';
			echo 'window.location.href="' . $location . '";';
			echo '</script>';

			echo '<noscript>';
			echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
			echo '</noscript>';
		}
	}

	/**
	 * Core::framePage()
	 *
	 * @return
	 */
	public static function framePage($location, $title = false)
	{
		echo '<!DOCTYPE HTML>';
		echo '<html lang="pt-BR">';

		echo '<head>';
		$url = 'https://cdn.ideyou.com.br/_presets/header.php';
		$data = array(
			'bar_color' => '#FFF',
			'scroll_bg' => '#000',
			'title' => $title ? $title : 'Sistema ' . COMPANY_NAME,
		);

		// use key 'http' even if you send the request to https://...
		$options = array(
			'http' => array(
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
			),
		);
		$context = stream_context_create($options);
		echo file_get_contents($url, false, $context);
		echo '</head>';
		echo '<frameset frameborder="0" framespacing="0">';
		echo '<frame src="' . $location . '">';
		echo '<noframes>';

		echo '<body>';
		echo '</body>';
		echo '</noframes>';
		echo '</frameset>';

		echo '</html>';
	}

	/**
	 * Core::Notify()
	 *
	 * @return
	 */
	public static function Notify($message, $type = 'info', $redirect = false, $play = false)
	{
		self::$messages[] = array(
			'message'   => $message,
			'type'      => $type,
			'redirect'  => $redirect,
			'play'  => $play
		);
	}
}
