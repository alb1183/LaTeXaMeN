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
		if($_SERVER['REQUEST_METHOD'] != 'POST' || $tipo > 6 || $refer_parse['host'] != $url_parse['host']) {
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
		}
		// Editar head - End
		// ****************************************** //
		// Editar foot - Start
		if($tipo == 2) {
			$foot = $conectar->real_escape_string($_POST['data']);
			$conectar->query("UPDATE $tabla_config set foot = '$foot' WHERE (id = 1)");
			echo 1;
		exit();
		}
		// Editar foot - End
		// ****************************************** //
		// Editar problema - Start
		if($tipo == 3) {
			$id = (int) $_POST['id'];
			$titulo = $conectar->real_escape_string($_POST['titulo']);
			$latex_p = $_POST['latex'];
			$latex = $conectar->real_escape_string($latex_p);
			$data = $conectar->real_escape_string($_POST['data']);
			$directorio = $_SERVER['DOCUMENT_ROOT'] . '/files/problemas/';
			
			if($id != 0) {
				$conectar->query("UPDATE $tabla_problemas set titulo = '$titulo', latex = '$latex', data = '$data', preview = '1'  WHERE (id = '$id')");
				//echo "UPDATE $tabla_problemas set titulo = '$titulo', latex = '$latex', data = '$data'  WHERE (id = '$id')";
			} else {
				$conectar->query("INSERT INTO $tabla_problemas(id,titulo,data,latex,preview) values (NULL,'$titulo','$data','$latex','1')");					
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
		}
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
		}
		// Editar preambulo - End
		// ****************************************** //
		// Generar Examen - Start
		if($tipo == 5) {
			$id = (int) $_POST['id'];
			$titulo = $conectar->real_escape_string($_POST['titulo']);
			$preambulo = (int) $_POST['preambulo'];
			$problemas = $conectar->real_escape_string($_POST['problemas']);
			$directorio = $_SERVER['DOCUMENT_ROOT'] . '/files/examenes/';
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
			$content = $row_preambulo['head'];
			
			// Añado los problemas
			$problemas_db = $conectar->query("SELECT * FROM $tabla_problemas WHERE id IN ($problemas) ORDER BY FIELD(id, $problemas)");
			while($row_problemas=$problemas_db->fetch_array()) {
				$content .= $row_problemas['latex'];	
			}
			
			$content .= $row_preambulo['foot'];
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
		}
		// Generar Examen - End
		// ****************************************** //
		//  - Start
		if($tipo == 6) {
			
		exit();
		}
		//  - End
		// ****************************************** //

?> 