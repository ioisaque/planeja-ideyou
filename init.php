<?php
define('COMPANY_NAME', 'IdeYou');
define("BASEPATH",     str_replace("init.php", "", realpath(__FILE__)));

require_once(BASEPATH . "lib/aux_functions.php");
require_once(BASEPATH . "lib/class_registry.php");

require_once(BASEPATH . "lib/class_core.php");
Registry::set('Core', new Core());
$core = Registry::get("Core");
?>