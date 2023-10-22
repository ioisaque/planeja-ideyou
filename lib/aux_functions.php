<?php

/**
 * Funções auxiliares
 *
 * @author Isaque Costa
 * @copyright 2018
 */

/**
 * getSelectedStr()
 *
 * @return
 **/
function getSelectedStr($a, $b)
{
	return ($a == $b) ? 'selected' : '';
}

/**
 * getCheckedStr()
 *
 * @return
 **/
function getCheckedStr($a, $b)
{
	return ($a == $b) ? 'checked' : '';
}

/**
 * CAPS()
 *
 * @param mixed $string
 * @return
 **/
function CAPS($string)
{
	return strtoupper($string);
}

/**
 * BRN()
 *
 * @param mixed $amount
 * @return
 **/
function BRN($amount, $decimals = 0)
{
	return number_format($amount, $decimals, ',', '.');
}

/**
 * BRL()
 *
 * @param mixed $amount
 * @return
 **/
function BRL($amount)
{
	return "R$ " . number_format(floatVal($amount), 2, ',', '.');
}

/**
 * rBRL()
 *
 * @param $s
 * @return
 */
function rBRL($s = '')
{
	if (substr_count($s, "R$")) {
		$s = str_replace("R$",  "",  $s);
		$s = str_replace(".",   "",  $s);
		$s = str_replace(",",   ".", $s);
	} elseif (substr_count($s,  "$")) {
		$s = str_replace("$",   "",  $s);
		$s = str_replace(",",   "",  $s);
	} elseif (substr_count($s,  ",")) {
		$s = str_replace(".",   "",  $s);
		$s = str_replace(",",   ".", $s);
	}

	$s = preg_replace('/[^-\\d.]+/', '', $s);

	return $s != '' ? floatVal($s) : 0;
}

/**
 * NF()
 *
 * @param mixed $amount
 * @return
 **/
function NF($n, $p = true)
{
	$n = preg_replace('/\D*/', "", $n);
	$n = strlen($n) < 6 ? sprintf('%06d', $n) : $n;

	return $p ? BRN($n) : $n;
}

/**
 * CPF_CNPJ()
 * @param cpf_cnpj sem formato
 * @return campo formatado
 */
function CPF_CNPJ($cpf_cnpj)
{
	return (strlen($cpf_cnpj) > 12) ? substr($cpf_cnpj, 0, 2) . "." . substr($cpf_cnpj, 2, 3) . "." . substr($cpf_cnpj, 5, 3) . "/" . substr($cpf_cnpj, 8, 4) . "-" . substr($cpf_cnpj, 12, 2) : substr($cpf_cnpj, 0, 3) . "." . substr($cpf_cnpj, 3, 3) . "." . substr($cpf_cnpj, 6, 3) . "-" . substr($cpf_cnpj, 9, 2);
}

/**
 * NOME()
 * @param nome nome completo
 * @return nome primeiro nome
 */
function NOME($name, $last = false)
{
	$name = strtolower($name);
	$name = explode(" ", $name);

	return ucfirst($name[0]) . ($last ? ' ' . end($name) : '');
}

/**
 * SOBRENOME()
 * @param nome nome completo
 * @return nome sobrenome nome
 */
function SOBRENOME($name)
{
	$name = strtolower($name);
	$name = trim($name);
	$last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
	return ucfirst($last_name);
}

/**
 * IDADE()
 * @param nome nome completo
 * @return nome primeiro nome
 */
function IDADE($data_nasc)
{
	$hoje = intval(DATA_F(TODAY, 'Y-m-d', 'Y'));
	$nasc = intval(DATA_F($data_nasc, 'Y-m-d', 'Y'));

	return $hoje - $nasc;
}

/**
 * KG()
 *
 * @param mixed $amount
 * @return
 **/
function KG($amount)
{
	return BRN($amount, 3) . " Kg";
}

/**
 * DECIMAL()
 *
 * @param mixed $amount
 * @return
 **/
function DECIMAL($amount)
{
	return BRN($amount, 2);
}

/**
 * OBJETO()
 *
 * @param array $array
 * @return
 **/
function OBJETO(array $array, $class = 'stdClass')
{
	$object = new $class;
	foreach ($array as $key => $value) {
		if (is_array($value)) {
			// Convert the array to an object
			$value = OBJETO($value, $class);
		}
		// Add the value to the object
		$object->{$key} = $value;
	}
	return $object;
}

/**
 * DEVICE($info)
 *
 * @return
 */
function DEVICE($info)
{
	if (!$info || strlen($info) < 100)
		return (object) array(
			'DV' => '',
			'OS' => '',
			'HW' => '',
			'tag' => '',
			'icon' => '',
		);

	$info = explode('(', $info)[1];
	$info = explode(')', $info)[0];
	$info = explode('; ', $info, 3);

	$device = (object) array(
		'icon' => '',
		'tag'  => '',
		'color'  => '#5292b1',
		'DV'   => $info[0],
		'OS'   => sizeOf($info) > 1 ? $info[1] : '',
		'HW'   => sizeOf($info) > 2 ? CAPS($info[2]) : '',
	);

	if (str_contains(CAPS($device->DV), 'IPHONE')) {
		$device->icon = 'apple';
		$device->color = '#000000';
		$device->HW = $device->DV;
		$device->OS = str_replace('CPU iPhone OS', 'iOS', $device->OS);
		$device->OS = str_replace('_', '.', $device->OS);
		$device->OS = str_replace('like Mac OS X', '', $device->OS);
	} elseif (str_contains(CAPS($device->DV), 'MACINTOSH')) {
		$device->HW = $device->DV;
		$device->color = '#353535';
		$device->icon = 'apple-keyboard-command';
		$device->OS = str_replace('CPU iPhone OS', 'iOS', $device->OS);
	} elseif (str_contains(CAPS($device->DV), 'WINDOWS')) {
		$device->icon = 'windows';
		$device->color = '#1976d2';
		$device->OS = $device->DV;
		$device->HW = 'PC';
	} elseif (str_contains(CAPS($device->DV), 'LINUX')) {
		$device->icon = 'linux';
		$device->color = '#ffb22b';
		if (str_contains(CAPS($device->OS), 'ANDROID') || str_contains(CAPS($device->HW), 'ANDROID')) {
			$device->icon = 'anroid';
			$device->color = '#28a745';
		}
	} else
		$device->icon = 'desktop-tower';

	$device->tag = "<i class='mdi mdi-$device->icon'></i> $device->HW - $device->OS";

	return $device;
}

/**
 * DATA_F()
 * @param String data desejada
 * @param String formato inicial
 * @param String formato final
 * @return Date data formatada
 **/
function DATA_F($data, $de, $para)
{
	$date = new DateTime("NOW");

	if ($data && $data != '//')
		if ($de)
			$date = DateTime::createFromFormat($de, $data);
		else
			$date->setTimestamp(strtotime($data));

	return $date->format($para);
}

/**
 * DATA()
 * @param String data desejada
 * @param String formato inicial
 * @param String formato final
 * @return Date data formatada
 **/
function DATA($date = false)
{
	return DATA_F($date, false, "d/m/Y");
}

/**
 * HORA()
 * @param data no formato americano $date
 * @return data no formato brasileiro
 **/
function HORA($time = false, $secs = false)
{
	return DATA_F($time, false, $secs ? "H:i:s" : "H:i");
}

/**
 * DATA_HORA()
 * @param data no formato americano $date
 * @return data no formato brasileiro
 **/
function DATA_HORA($date = false, $secs = true)
{
	return DATA_F($date, false, $secs ? "d/m/y \à\s H:i:s" : "d/m/y \à\s H:i");
}

/**
 * US_DATE()
 * @param data em qualquer formato
 * @return data no formato brasileiro
 **/
function US_DATE($data = false)
{
	return DATA_F($data, 'd/m/Y', "Y-m-d");
}

/**
 * US_DATETIME()
 * @param data em qualquer formato
 * @return data no formato brasileiro
 **/
function US_DATETIME($data = false)
{
	return DATA_F($data, 'd/m/Y H:i', "Y-m-d H:i");
}


/**
 * MIN_ORDER_DATETIME()
 * @param data no formato americano $us_data
 * @return data no formato brasileiro
 **/
function MIN_ORDER_DATETIME()
{
	$MIN_TIME = Registry::get("Settings")->get('ORDER_SCHEDULE_MIN_TIME');
	$WAIT_TIME = Registry::get("Pedidos")->getWaitTime();
	$WAIT_TIME = $WAIT_TIME ? DateTime::createFromFormat('i:s', $WAIT_TIME)->format('i') : 0;
	$MINUTES = $MIN_TIME ? ($WAIT_TIME > $MIN_TIME ? $WAIT_TIME : $MIN_TIME) : $WAIT_TIME;
	$SCHEDULE = date('Y-m-d H:i', strtotime("+$MINUTES min"));

	return $SCHEDULE;
}

/**
 * ONLY_NUMBERS()
 *
 * @param $str
 * @return
 */
function ONLY_NUMBERS($str)
{
	return preg_replace('/\D*/', "", $str ?? "");
}

/**
 * rACENTOS()
 *
 * @param string $texto
 * @return
 **/
function rACENTOS($texto)
{
	$array1 = array(
		"á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù", "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö", "Ú", "Ù", "Û", "Ü", "Ç", "'"
	);
	$array2 = array(
		"a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u", "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O", "U", "U", "U", "U", "C", " "
	);
	return str_replace($array1, $array2, $texto);
}

/**
 * IMG()->src
 *
 * @param mixed $url
 * @return
 **/
function IMG($img = false, $placeholder = false)
{
	$image = (object) array(
		'path' => $img,
		'bytes' => 0,
		'size' => 0 . ' kbps',
		'src' => URL_SERVER . "sistema/assets/images/img-placeholder.jpg",
	);

	if ($img && str_contains($img, URL_SERVER)) {
		$image->src = $img;
		$image->path = $img;

		return $image;
	}

	if (!$img && !$placeholder)
		return $image;

	if (!$img && str_contains($placeholder, URL_SERVER)) {
		$image->path = $placeholder;
		$image->src = $placeholder;
		return $image;
	}

	$img = BASEPATH . UP_DIR . $img;
	$placeholder = BASEPATH . ($placeholder ? (UP_DIR . $placeholder) : "sistema/assets/images/img-placeholder.jpg");

	if (file_exists($img)) {
		$image->bytes = BRN(filesize($img) / 1024);
		$image->src = str_replace(BASEPATH, URL_SERVER, $img);
	} else if (file_exists($placeholder)) {
		$image->path = str_replace(BASEPATH . UP_DIR, "", $placeholder);
		$image->bytes = BRN(filesize($placeholder) / 1024);
		$image->src = str_replace(BASEPATH, URL_SERVER, $placeholder);
	}

	$image->size = $image->bytes . ' Kbps';

	return $image;
}

/**
 * IMG_TYPE()
 *
 * @param mixed $url
 * @return
 **/
function IMG_TYPE($url)
{
	if (!file_exists($url))
		return 'none';
	elseif (filetype($url) == 'dir')
		return 'dir';
	else {
		$img = getimagesize($url);

		return  str_replace('image/', '', $img['mime']);
	}
}

/**
 * sanitizePHONE()
 *
 * @param $str
 * @return
 */
function sanitizePHONE($str = '')
{
	return preg_replace("/[^0-9]/", "", $str);
}

/**
 * validatePHONE()
 *
 * @param $str
 * @return
 */
function validatePHONE($str)
{
	return preg_match('/^\(\d{2}\)\s9\s\d{4}\-\d{4}$/', $str);
}

/**
 * rrmdir()
 *
 * @param $dir
 * @return
 */
function rrmdir($dir)
{
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if ($object != "." && $object != "..") {
				if (filetype($dir . "/" . $object) == "dir")
					rrmdir($dir . "/" . $object);
				else unlink($dir . "/" . $object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}


/**
 * LOG_STRING($type = 2, )
 *
 * @param $dir
 * @return
 */
function LOG_STRING($_ACAO = 2)
{
	$_DATA = date('d/m/Y');
	$_HORA = date('H:i:s');
	$_USER = Usuarios::getName(Usuario::$id, lang('SISTEMA'));
	$_ACAO = !$_ACAO ? lang('DELETADO_POR') : ($_ACAO == 2 ? lang('ALTERADO_POR') : lang('CRIADO_POR'));

	return '<h6 class="d-block">' . $_ACAO . '<b>' . $_USER . '</b>' . lang('EM') . '<b>' . $_DATA . '</b>' . lang('AS') . '<b>' . $_HORA . '</b></h6>';
}
