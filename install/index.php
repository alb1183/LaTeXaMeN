
<!DOCTYPE html>
<head>
<title>Instalador LaTeXaMeN</title>
	<link rel="icon" type="image/png" href="../img/pi_math.png"/>
	<meta name="generador" content="Notepad++">
	<meta name="author" content="alb1183">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="es">
	<meta name="distribution" content="global">
	<meta charset="UTF-8">
<style>
	h3 {
		margin: 0;
		text-decoration: underline;		
	}
</style>
</head>
<body style="background: rgba(0, 0, 0, 0) url('img/200.jpg') repeat scroll 0 0;">
	<center>
		<div style="width: 900px; background-color: #8DCAE0; border-radius: 5px; padding-bottom: 15px;">
			<h2>Instalador</h2>
			<div style="width: 850px; background-color: #EEE; border-radius: 5px">
				<?
				$paso = ($_GET['paso']) ? $_GET['paso'] : 1;
				if($paso == 1) {
					$php_version=phpversion();
					if($php_version<5)
					{
					  $error=true;
					  $php_error="La version de PHP $php_version es muy antigua!";
					}
					$_SESSION['myscriptname_sessions_work']=1;
					if(empty($_SESSION['myscriptname_sessions_work']))
					{
					  $error=true;
					  $session_error="Las sesiones tienen que estar activadas!";
					}
					
					
					function find_SQL_Version() { 
					  $output = shell_exec('mysql -V');    
					  preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
					  return @$version[0]?$version[0]:-1; 
					}
					function find_ImageMagick_Version() { 
					  $output = shell_exec('convert -version');    
					  preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
					  return @$version[0]?$version[0]:-1; 
					}
					function find_pdflatex_Version() { 
					  $output = shell_exec('pdflatex');    
					  preg_match('@[0-9]+\.[0-9]+\.[0-9]+@', $output, $version); 
					  return @$version[0]?$version[0]:-1; 
					}
					 
					$mysql_version=find_SQL_Version();        
					if($mysql_version<5)
					{
					  if($mysql_version==-1) $mysql_error="Se comprobara en el siguiente paso.";
					  else $mysql_error="MySQL version $mysql_version. Se requiere una superior a la 5.";
					}
					 
					$pdflatex_version=find_pdflatex_Version();        
					if(!$pdflatex_version)
					{
					  $pdflatex_error="PDFLatex no encontrado";
					}
					
					$ImageMagick_version=find_ImageMagick_Version();        
					if(!$ImageMagick_version)
					{
					  $ImageMagick_error="ImageMagick no encontrado";
					}
				?>
				<h3>Comprobando configuraciones</h3>
				<form method="POST" action="?paso=2">
					<table style="width: 600px;">
						<tr>
						  <td><strong>Opcion</strong></td>
						  <td><strong>Estado</strong></td>
						</tr>
						<tr>
						  <td>Version de PHP(recomendada 5.3+):</td>
						  <td><?php if(empty($php_error)) echo "<span style='color:green;'>$php_version - OK!</span>";
									else echo "<span style='color:red;'>$php_error</span>";?></td>
						</tr>
						<tr>
						  <td>Sesiones de PHP:</td>
						  <td><?php if(empty($session_error)) echo "<span style='color:green;'>OK!</span>";
									else echo "<span style='color:red;'>$session_error</span>";?></td>
						</tr>
						<tr>
						  <td>Version MySQL:</td>
						  <td><?php if(empty($mysql_error)) echo "<span style='color:green;'>OK!</span>";
									else echo "<span style='color:red;'>$mysql_error</span>";?></td>
						</tr>
						<tr>
						  <td>PDFlatex:</td>
						  <td><?php if(empty($pdflatex_error)) echo "<span style='color:green;'>$pdflatex_version - OK!</span>";
									else echo "<span style='color:red;'>$pdflatex_error</span>";?></td>
						</tr>
						<tr>
						  <td>ImageMagick:</td>
						  <td><?php if(empty($ImageMagick_error)) echo "<span style='color:green;'>$ImageMagick_version - OK!</span>";
									else echo "<span style='color:red;'>$ImageMagick_error</span>";?></td>
						</tr>
						<tr>
						  <td>Servidor de la base de datos:</td>
						  <td><input type="text" name="server" value="127.0.0.1" style="width: 200px;"></td>
						</tr>
						<tr>
						  <td>Usuario de la base de datos:</td>
						  <td><input type="text" name="user" value="root" style="width: 200px;"></td>
						</tr>
						<tr>
						  <td>Contraseña:</td>
						  <td><input type="text" name="pass" style="width: 200px;"></td>
						</tr>
						<tr>
						  <td>Base de datos:</td>
						  <td><input type="text" name="db" value="latexamen" style="width: 200px;"></td>
						</tr>
						<tr>
						  <td></td>
						  <td><? if($error == true) { echo 'Error en alguna de las comprobaciones'; }else { echo '<input type="submit" value="Siguiente">'; } ?></td>
						</tr>
					</table>
				</form>
				<?
				} else if($paso==2) {
					    $db_error=false;
						// try to connect to the DB, if not display error
						if(!@mysql_connect($_POST['server'],$_POST['user'],$_POST['pass']))
						{
						  $db_error=true;
						  $error_msg="Error: ".mysql_error();
						}
						 
						if(!$db_error and !@mysql_select_db($_POST['db']))
						{
						  $db_error=true;
						  $error_msg="Error, la base de datos no existe: ".mysql_error();
						}
						
						if($db_error != true) {
							$connect_code="<?php
											define('DBSERVER','".$_POST['server']."');
											define('DBNAME','".$_POST['db']."');
											define('DBUSER','".$_POST['user']."');
											define('DBPASS','".$_POST['pass']."');
											?>";
							if(!is_writable("../php/config.php")) {
							  $error_msg="<p>No se puede escribir en <b>../php/config.php</b>.
							  Prueba a añadir manualmente la siguiente configuracion:<br /><br />
							  <textarea rows='5' cols='50' onclick='this.select();'>$connect_code</textarea></p>";
							} else {
							  $fp = fopen('../php/config.php', 'wb');
							  fwrite($fp,$connect_code);
							  fclose($fp);
							  //chmod('../php/config.php', 0666);
							}
							
						}
				?>
				<h3>Comprobando base de datos</h3>
				<form method="POST" action="?paso=3">
					<table style="width: 600px;">
						<tr>
						  <td><strong>Opcion</strong></td>
						  <td><strong>Estado</strong></td>
						</tr>
						<tr>
						  <td>Base de datos:</td>
						  <td><?php if(empty($error_msg)) echo "<span style='color:green;'>OK!</span>";
									else echo "<span style='color:red;'>$error_msg</span>";?></td>
						</tr>
						<tr>
						  <td>Direccion de la pagina:</td>
						  <td><input type="text" name="url" value="http://servermurcia.com/latexamen/" style="width: 400px;"></td>
						</tr>
						<tr>
						  <td></td>
						  <td><? if($db_error == true) { echo 'Error en alguna de las comprobaciones'; }else { echo '<input type="submit" value="Instalar">'; } ?></td>
						</tr>
					</table>
				</form>
				<?
				} else if($paso==3) {
					require("../php/config.php");
					$conectar = new mysqli(DBSERVER, DBUSER, DBPASS, DBNAME, "3306");
					if ($conectar->connect_error) {
						die('Error en la conexión principal al servidor :' . $conectar->connect_error);
					}
					$sql = file_get_contents('sql.sql');
					
					/* execute multi query */
					if (mysqli_multi_query($conectar, $sql)) {
						 echo "Correcto";
						 $url = $_POST['url'];
						 $conectar->query("UPDATE tex_config set url = '$url' WHERE (id = '1')");
						 header("Location: ../index.php");
					} else 
						 echo "Error";
				
				}
				
				?>
			</div>
		</div>
	</center>
</body>