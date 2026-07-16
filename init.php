<?php

define('COMPANY_NAME', 'Aurelio');
define("BASEPATH",     str_replace("init.php", "", realpath(__FILE__)));

$logDir = BASEPATH . 'logs';
if (!is_dir($logDir))
	mkdir($logDir, 0755, true);

ini_set('log_errors', '1');
ini_set('error_log', $logDir . '/php-error.log');
error_reporting(E_ALL);

require_once(BASEPATH . "lib/aux_functions.php");
define('HOJE', DATA_F(false, 'Y-m-d', 'd/m/Y'));

require_once(BASEPATH . "lib/class_registry.php");

require_once(BASEPATH . "lib/class_core.php");
Registry::set('Core', new Core());
$core = Registry::get("Core");
?>