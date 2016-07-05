<?php
session_start();
require("db.php");
require("funciones.php");


	// ******************************************************************** //
	// Tipo : Funcion                                            : Linea    //
	// -------------------------------------------------------------------- //
	//    1 : (Vacio)                                            :          //
	//    2 : (Vacio)                                            :          //
	//    3 : (Vacio)                                            :          //
	//    4 : (Vacio)                                            :          //
	//    5 : (Vacio)                                            :          //
	//                                                                      //
	// ******************************************************************** //

		$tipo = (int) $_POST['tipo'];
		$datoid = (int) $_POST['datoid'];
		$time = time();
		
		//Por si las moscas :D
		$refer_parse = parse_url($_SERVER['HTTP_REFERER']);
		$url_parse = parse_url($web['url']);
		if($_SERVER['REQUEST_METHOD'] != 'POST' || $tipo > 10 || $refer_parse['host'] != $url_parse['host']) {
			header("Location: ".$web['url']);
			exit();
		}
		
		
		// ****************************************** //
		// Editar head - Start
		if($tipo == 1) {
			$head = $conectar->real_escape_string($_POST['data']);
			$conectar->query("UPDATE $tabla_config set head = '$head' WHERE (id = 1)");
			echo 1;
		exit();
		}else
		// Editar head - End
		// ****************************************** //
		// Editar foot - Start
		if($tipo == 2) {
			$foot = $conectar->real_escape_string($_POST['data']);
			$conectar->query("UPDATE $tabla_config set foot = '$foot' WHERE (id = 1)");
			echo 1;
		exit();
		}else
		// Editar foot - End
		// ****************************************** //
		// Editar problema - Start
		if($tipo == 3) {
			$id = (int) $_POST['id'];
			$titulo = $conectar->real_escape_string($_POST['titulo']);
			$estandares = $conectar->real_escape_string($_POST['estandares']);
			$latex_p = $_POST['latex'];
			$latex = $conectar->real_escape_string($latex_p);
			$data = $conectar->real_escape_string($_POST['data']);
			$directorio = $_SERVER['DOCUMENT_ROOT'] . '/latexamen/files/problemas/';
			
			if($id != 0) {
				$conectar->query("UPDATE $tabla_problemas set titulo = '$titulo', estandares = '$estandares', latex = '$latex', data = '$data', preview = '1'  WHERE (id = '$id')");
				//echo "UPDATE $tabla_problemas set titulo = '$titulo', latex = '$latex', data = '$data'  WHERE (id = '$id')";
			} else {
				$conectar->query("INSERT INTO $tabla_problemas(id,titulo,estandares,data,latex,preview) values (NULL,'$titulo','$estandares','$data','$latex','1')");					
				$problema_db = $conectar->query("select * from $tabla_problemas WHERE (titulo='$titulo' AND data='$data')");
				$row_problema=$problema_db->fetch_array();
				$id = $row_problema['id'];
			}
			
			// Creando el .tex
			$content = $web['head'];
			$content .= $latex_p;
			$content .= $web['foot'];
			crear_tex($directorio.$id .'.tex', $content);
			
			// Genero el .pdf
			// Genero la img - TODO: el comando convert es del ImageMagick(http://www.imagemagick.org/script/index.php)
			// TODO: EL ImageMagick requiere el GhostScript(http://ghostscript.com/download/)
			$salida = generar_pdf_img($id, $directorio, true);
			
			/*if(strlen(trim($salida))>415) { // TODO: FIXME: Metodo muy cutre, buscar otro -_-
				$conectar->query("UPDATE $tabla_problemas set preview = '0'  WHERE (id = '$id')");
				echo 2;
				exit();
			}*/
			
			$fichero_ruta = '../files/problemas/' . $id . '.log';
			$leer_log_f = leer_log($fichero_ruta);
			if($leer_log_f['error'] === true) {
				file_put_contents($fichero_ruta, $leer_log_f['contenido']);
				
				$conectar->query("UPDATE $tabla_problemas set preview = '0'  WHERE (id = '$id')");
				echo 2;
				exit();
			}
			
			echo 1;
		exit();
		}else
		// Editar problema - End
		// ****************************************** //
		// Editar preambulo - Start
		if($tipo == 4) {
			$id = (int) $_POST['id'];
			$titulo = $conectar->real_escape_string($_POST['titulo']);
			$head = $conectar->real_escape_string($_POST['head']);
			$foot = $conectar->real_escape_string($_POST['foot']);
			
			if($id != 0) {
				$conectar->query("UPDATE $tabla_preambulos set titulo = '$titulo', head = '$head', foot = '$foot' WHERE (id = '$id')");
			} else {
				$conectar->query("INSERT INTO $tabla_preambulos(id,titulo,head,foot) values (NULL,'$titulo','$head','$foot')");
			}
			echo 1;
		exit();
		}else
		// Editar preambulo - End
		// ****************************************** //
		// Generar Examen - Start
		if($tipo == 5) {
			$id = (int) $_POST['id'];
			$titulo = $conectar->real_escape_string($_POST['titulo']);
			$preambulo = (int) $_POST['preambulo'];
			$problemas = $conectar->real_escape_string($_POST['problemas']);
			$directorio = $_SERVER['DOCUMENT_ROOT'] . '/latexamen/files/examenes/';
			$criteria = (int) $_POST['criteria'];
			$fecha = time();
			
			if($id != 0) {
				$conectar->query("UPDATE $tabla_examenes set titulo = '$titulo', preambulo = '$preambulo', problemas = '$problemas', generado = '1' WHERE (id = '$id')");
			} else {
				$conectar->query("INSERT INTO $tabla_examenes(id,titulo,problemas,preambulo,fecha,generado) values (NULL,'$titulo','$problemas','$preambulo','$fecha','1')");					
				$examenes_db = $conectar->query("select * from $tabla_examenes WHERE (titulo='$titulo' AND fecha='$fecha')");
				$row_examenes=$examenes_db->fetch_array();
				$id = $row_examenes['id'];;
			}
			
			
			
			$preambulo_db = $conectar->query("select * from $tabla_preambulos WHERE id='$preambulo'");
			$row_preambulo=$preambulo_db->fetch_array();
			
			// Creando el .tex
			// Cabecera
			$content = $row_preambulo['head'].PHP_EOL;
			
			// Añado los problemas
			$problemas_db = $conectar->query("SELECT * FROM $tabla_problemas WHERE id IN ($problemas) ORDER BY FIELD(id, $problemas)");
			$problemas_estandares = array();
			$problemas_num = 0;
			while($row_problemas=$problemas_db->fetch_array()) {
				$content .= $row_problemas['latex'].PHP_EOL;
				
				$problemas_estandares[] = $row_problemas['estandares'];
				$problemas_num++;
			}
			
			// Generar tabla de estandares
			if($criteria == 1) {
				$tabla = '\hrule'.PHP_EOL;
				$tabla .= '\begin{table}[h]'.PHP_EOL;
				$tabla .= '\begin{center}'.PHP_EOL;
				$tabla .= '\begin{tabular}{|p{3.2cm}|p{1.3cm}|p{1.3cm}|p{1.3cm}|p{1.3cm}|p{1.3cm}|p{1.3cm}|}'.PHP_EOL;
				$tabla .= '\hline'.PHP_EOL;
				$tabla .= '{\scriptsize Estándar de aprendizaje}'.PHP_EOL;
				
				for($i = 0; $i < $problemas_num; $i++) {
					$estandars = str_replace(' ', ' \\\\ ', $problemas_estandares[$i]);
					str_replace(' ', ' \\\\ ', $estandars);
					$tabla .= '& \centering {\scriptsize '.$estandars.'\\\\ }'.PHP_EOL;
				}
				
				$tabla .= '\tabularnewline \hline {\scriptsize Preguntas o apartados \par con que se relaciona}'.PHP_EOL;
				
				for($i = 0; $i < $problemas_num; $i++) {
					$tabla .= ' &  \centering {\scriptsize '.($i+1).' }'.PHP_EOL;
				}
				
				$tabla .= ' \tabularnewline \hline'.PHP_EOL;
				$tabla .= ' {\scriptsize Puntuación máx. estándar}'.PHP_EOL;
				
				for($i = 0; $i < $problemas_num; $i++) {
					$estandars = explode(' ', $problemas_estandares[$i]);
					$longitud = count($estandars);
					
					$tabla .= '  &  \centering {\scriptsize ';
					
					for($j=0; $j<$longitud; $j++) {
						$estd = trim($estandars[$j]);
						$estands_db = $conectar->query("select * from $tabla_estandares WHERE estandar='$estd'");
						$row_estands=$estands_db->fetch_array();
						$tabla .= $row_estands['puntuacion'].'\\\\';
					}
					$tabla .= ' } '.PHP_EOL;
				}
				
 				$tabla .= '\tabularnewline \hline'.PHP_EOL;
				$tabla .= ' {\scriptsize Puntuación obtenida } '.PHP_EOL;
				$tabla .= ' &  \vspace*{1cm} \centering    \vspace*{1.5cm} '.PHP_EOL;
				$tabla .= ' &  \centering  '.PHP_EOL;
				$tabla .= ' & \centering  '.PHP_EOL;
				$tabla .= ' &  \tabularnewline '.PHP_EOL;
				$tabla .= '\hline '.PHP_EOL;
				$tabla .= '\end{tabular}'.PHP_EOL;
				$tabla .= '\end{center}'.PHP_EOL;
				$tabla .= '\end{table}'.PHP_EOL;
				$tabla .= '\hrule'.PHP_EOL;
				
				$content .= $tabla.PHP_EOL;
			}			
			
			
			// Footer
			$content .= $row_preambulo['foot'];
			// Creo el .tex
			crear_tex($directorio.$id .'.tex', $content);
			
			// Genero el .pdf
			$salida = generar_pdf_img($id, $directorio, false);
			
			$fichero_ruta = '../files/examenes/' . $id . '.log';
			$leer_log_f = leer_log($fichero_ruta);
			if($leer_log_f['error'] === true) {
				file_put_contents($fichero_ruta, $leer_log_f['contenido']);
				
				$conectar->query("UPDATE $tabla_examenes set generado = '0' WHERE (id = '$id')");
				
				echo 2;
				exit();
			}
			
			echo 1;
		exit();
		}else
		// Generar Examen - End
		// ****************************************** //
		// Actualizar configuracion web - Start
		if($tipo == 6) {
			$url = $conectar->real_escape_string($_POST['url']);
			$curso = (int) $conectar->real_escape_string($_POST['curso']);
			$conectar->query("UPDATE $tabla_config set url = '$url' WHERE (id = 1)");
			setcookie('curso', $curso, -1, '/');
			echo 1;
		exit();
		}else
		// Actualizar configuracion web - End
		// ****************************************** //
		// Editar estandar - Start
		if($tipo == 7) {
			$id = (int) $_POST['id'];
			$estandar = $conectar->real_escape_string($_POST['estandar']);
			$descripcion = $conectar->real_escape_string($_POST['descripcion']);
			$puntuacion = (int) $conectar->real_escape_string($_POST['puntuacion']);
			
			if($id != 0) {
				$conectar->query("UPDATE $tabla_estandares set estandar = '$estandar', descripcion = '$descripcion', puntuacion = '$puntuacion' WHERE (id = '$id')");
			} else {
				$conectar->query("INSERT INTO $tabla_estandares(id,estandar,descripcion,puntuacion) values (NULL,'$estandar','$descripcion','$puntuacion')");
			}
			echo 1;			
		exit();
		}
		// Editar estandar - End
		// ****************************************** //
		// Borrar examen/problema/preambulo/estandar - Start
		if($tipo == 8) {
			$id = (int) $_POST['id'];
			$modo = (int) $_POST['modo'];
			if($modo == 1) {
				$conectar->query("DELETE FROM $tabla_examenes WHERE (id = '$id')");
			}else if($modo == 2) {
				$conectar->query("DELETE FROM $tabla_problemas WHERE (id = '$id')");
			}else if($modo == 3) {
				$conectar->query("DELETE FROM $tabla_preambulos WHERE (id = '$id')");
			}else if($modo == 4) {
				$conectar->query("DELETE FROM $tabla_estandares WHERE (id = '$id')");
			}else {
				echo 'Modo incorrecto';
				exit();
			}
			echo 1;
		exit();
		}
		// Borrar examen/problema/preambulo/estandar - End
		// ****************************************** //
		//  - Start
		if($tipo == 9) {
			
		exit();
		}
		//  - End
		// ****************************************** //
		//  - Start
		if($tipo == 10) {
			
		exit();
		}
		//  - End
		// ****************************************** //

?> 