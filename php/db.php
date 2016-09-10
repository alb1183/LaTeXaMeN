<?php
require_once(__DIR__ . '/config.php');
$conectar = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME, "3306");
if ($conectar->connect_error) {
    die('Error en la conexión principal al servidor :' . $conectar->connect_error);
}

// Datos globales
$OS = 'Windows'; // Sistema operativo ('Windows', 'UNIX')
$directorio_files = $_SERVER['DOCUMENT_ROOT'] . '/latexamen/files/';

//$curso = (int) $_COOKIE["curso"];
$curso = (int) 1; // FIXME
switch ($curso) {
	case 1:
		$prefijotabla_curso = "1_";
		break;
	case 2:
		$prefijotabla_curso = "2_";
		break;
	case 3:
		$prefijotabla_curso = "3_";
		break;
	default:
		$prefijotabla_curso = "1_";
		break;
}

$prefijotabla = "tex_";

$tabla_config = $prefijotabla."config";
$tabla_problemas = $prefijotabla.$prefijotabla_curso."problemas";
$tabla_preambulos = $prefijotabla.$prefijotabla_curso."pre";
$tabla_estandares = $prefijotabla.$prefijotabla_curso."standards";
$tabla_examenes = $prefijotabla.$prefijotabla_curso."exams";

$conectar->set_charset("utf8");

$configresultados = $conectar->query("select * from $tabla_config WHERE id = 1");
$configrow=$configresultados->fetch_array();
$web = array(
		"url" => $configrow['url'],
		"nombre" => $configrow['nombre'],
		"version" => $configrow['version'],
		"jpeg_quality" => $configrow['jpeg_quality'],
		"head" => $configrow['head'],
		"foot" => $configrow['foot'],
		);
date_default_timezone_set("Europe/Madrid");
error_reporting(E_ALL & ~E_NOTICE);//Errores a mostras(E_ALL --> Todos - ~E_NOTICE --> Menos las noticias)
if(isset($urlwebb)) {
	if($urlwebb != $web['url']) {
		echo 'Tienes mal configurado la direccion de la web<br>';
		echo '$urlwebb = "'.$urlwebb.'" y $web[\'url\'] = "'.$web['url'].'"';
		exit();
	}
}else{
	$urlwebb = $web['url'];
}

function encrypt($string, $key) {
   $result = '';
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
   }
   return base64_encode($result);
}
function decrypt($string, $key) {
   $result = '';
   $string = base64_decode($string);
   for($i=0; $i<strlen($string); $i++) {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)-ord($keychar));
      $result.=$char;
   }
   return $result;
}
function formatOffset($offset) {
		$hours = $offset / 3600;
		$remainder = $offset % 3600;
		$sign = $hours > 0 ? '+' : '-';
		$hour = (int) abs($hours);
		$minutes = (int) abs($remainder / 60);

		if ($hour == 0 AND $minutes == 0) {
			$sign = ' ';
		}
		return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');
}
function quitar_tildes($cadena) {
	$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
	$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
	$texto = str_replace($no_permitidas, $permitidas ,$cadena);
	return $texto;
}
function imagecreatefromfile( $filename ) {
    if (!file_exists($filename)) {
        throw new InvalidArgumentException('File "'.$filename.'" not found.');
    }
    switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ))) {
        case 'jpeg':
        case 'jpg':
            return imagecreatefromjpeg($filename);
        break;

        case 'png':
            return imagecreatefrompng($filename);
        break;

        case 'gif':
            return imagecreatefromgif($filename);
        break;

        default:
            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
        break;
    }
}
?> 