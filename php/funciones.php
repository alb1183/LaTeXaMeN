<?php
	$refer_parse = parse_url($_SERVER['REQUEST_URI']);
	$url_parse = parse_url($urlwebb);
	if($refer_parse['path'] == $url_parse['path']."php/funciones.php") {
		header("Location: ".$urlwebb);
		exit();
	}
	
	$dias_array = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
	$mes_array = array("Origen del universo XP","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

	
	function UNIX2DATE($fecha){
			global $dias_array, $mes_array;
			$time = time();
			if($time < $fecha ){
				$textofecha = "Viene del futuro";
			}elseif($time - 30 < $fecha ){
				$textofecha = "Hace un instante";
			}elseif($time - 60 < $fecha ){
				$segundos = $time- $fecha;
				$textofecha = "Hace ".$segundos." segundo(s)";
			}elseif($time - 3600 < $fecha){
				$minutos = floor(($time - $fecha) / 60);
				$textofecha = "Hace ".$minutos." minuto(s)";
			}elseif($time - 86400 < $fecha){
				$horas = floor(($time - $fecha) / 3600);
				$textofecha = "Hace ".$horas." hora(s)";
				$minutos = floor((($time - $fecha) - ($horas * 3600)) / 60);
				if($minutos > 20) {
					$textofecha = "Hace ".$horas." hora(s) y ".$minutos." minutos.";
				}
			}elseif($time - 172800 < $fecha){
				$textofecha = "Ayer a las ".date("H:i", $fecha);
			}elseif(date("Y", $fecha) == date('Y')){
				$textofecha = date('d', $fecha)." de ".$mes_array[date('n', $fecha)].",  a las ".date("H:i", $fecha);
			}else{
				$textofecha = date('d', $fecha)." de ".$mes_array[date('n', $fecha)]." de ".date("Y", $fecha).",  a las ".date("H:i", $fecha);
			}
	   return $textofecha;
	}
	function UNIX2DATETEXT($unix){
			global $dias_array, $mes_array;
			$textofecha = $dias_array[date("w", $unix)].", ".date("d", $unix)." de ".$mes_array[date("n", $unix)]." de ".date("Y", $unix)." a las ".date("H:i", $unix);
	   return $textofecha;
	}
	
	function leer_log($directorio){
		$fichero = fopen($directorio, "r");
		$contenido = '';
		$errores = 0;
		$errores_linea = array();
		$linea_count = 1;
		$error = false;
		if($fichero != false) {
			while(!feof($fichero)) {
				$line = fgets($fichero);				
				if (strpos($line,'LaTeX Error')) {
					$error = true;
					//array_push($errores_linea, ftell($fichero));
					array_push($errores_linea, $linea_count);
					$errores++;
					//break;
				}
				if($error) {
					$contenido .= utf8_encode($line);
				}
				$linea_count++;
			}
			fclose($fichero);
		}
		return array('error' => $error, 'errores' => $errores, 'contenido' => $contenido, 'errores_linea' => $errores_linea);
	}
	function crear_tex($dir, $contenido){
		$fp = fopen($dir,'wb');
		fwrite($fp,$contenido);
		fclose($fp);
	}
	
	function generar_pdf_img($id, $directorio, $img) {
		// Genero la img - TODO: el comando convert es del ImageMagick(http://www.imagemagick.org/script/index.php)
		// TODO: EL ImageMagick requiere el GhostScript(http://ghostscript.com/download/)
		$orden = 'cd "'.$directorio.'" && pdflatex --interaction batchmode --enable-installer -quiet '.$id .'.tex';
		if($img === true) {
			$orden .= ' && convert -verbose -density 150 -trim '.$id .'.pdf -quality 100 -gravity center -background white -extent 1275x1650 '.$id .'.jpg';
		}
		$salida = shell_exec($orden);
		
		return $salida;
	}
	
	//$user_id = $_COOKIE['user_id'];
	//setcookie('user_id', null, -1, '/');
?> 