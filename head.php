<?php
	require("php/db.php");
	require("php/funciones.php");
	$refer_parse = parse_url($_SERVER['REQUEST_URI']);
	$url_parse = parse_url($web['url']);
	if($refer_parse['path'] == $url_parse['path']."head.php") {
		header("Location: ".$web['url']);
		exit();
	}
?>
<!DOCTYPE html>
<head>
	<meta name="generador" content="Notepad++">
	<meta name="author" content="alb1183">
	<meta name="version" content="<?=$web["version"]?>">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="es">
	<meta name="distribution" content="global">
	<meta charset="UTF-8">
	<script type="text/javascript" src="<?=$web['url']?>js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="<?=$web['url']?>js/jquery.browser.js"></script>
	<script type="text/javascript" src="<?=$web['url']?>js/ace.js"></script>
	<script type="text/javascript" src="<?=$web['url']?>js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="<?=$web['url']?>js/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?=$web['url']?>js/js.cookie.js"></script>
	<script type="text/javascript" src="<?=$web['url']?>js/jquery.sortable.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=$web['url']?>css/estilo.css">
	<link rel="stylesheet" type="text/css" href="<?=$web['url']?>css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="<?=$web['url']?>css/jquery.fancybox.css">
	<script type="text/javascript" src="<?=$web['url']?>js/javascript.js"></script>
	<link rel="icon" type="image/png" href="<?=$web['url']?>img/pi_math.png"/>
	<title><?=$web['nombre']?> · Cargando...</title>

</head>
<body id="body" style="">
	<script type="text/javascript">
			urlweb = "<?=$web['url']?>"
			webnombre = "<?=$web['nombre']?>"
	</script>
	
	<div id="firefox" class="noticia" style="display: none; left: 25px; right: auto;">
		<img src="<?=$web['url'];?>img/chromfox.png" style="width: 128px; height: 128px;">
		<br><span style="font-family: Lucida Grande; font-size: 16px; color: #999;">Se recomienda desiteresadamente el uso de <a href="http://www.mozilla.org/es-ES/firefox/new/">Firefox</a> o <a href="http://www.google.com/chrome?hl=es">Chrome</a></span>.
	</div>
		
	<script type="text/javascript">			
			if ($.browser.msie) {
				$('#firefox').show();
            }
	</script>
	
	
	
	
	<div class="master-header">
		<div class="site-header">
		
			<div class="header-wrap-container">
                <div class="logo-container">
                    <a href="<?=$web['url'];?>" class="index-logo no-com ir">
					
                    </a>
                </div>
			</div>
		
			<nav id="nav-main" class="nav-main">
				<ul>
					<li style="width: 105px;">
						<a class="nav-main-home" href="<?=$web['url'];?>" title="Inicio" style="padding-left: 25px;">
							<span class="ir"> </span>
							<?php
								switch ($_COOKIE["curso"]) {
									case 1:
										echo 'Segundo';
										break;
									case 2:
										echo 'Tercero';
										break;
									case 3:
										echo 'Cuarto';
										break;
									default:
										echo 'Segundo';
										break;
								}
							?>
						</a>
					</li>
					<li style="width: 105px;">
						<a href="<?=$web['url'];?>generar.php" title="Generar">
							<img src="<?=$web['url'];?>img/bookmark_16.png"> Generar
						</a>
					</li>
					<li style="width: 110px;">
						<a href="<?=$web['url'];?>examenes.php" title="Examenes">
							<img src="<?=$web['url'];?>img/books_16.png"> Examenes
						</a>
					</li>
					<li style="width: 120px;">
						<a href="<?=$web['url'];?>problemas.php" title="Preguntas">
							<img src="<?=$web['url'];?>img/bookshelf_16.png"> Problemas
						</a>
					</li>
					<li style="width: 130px;">
						<a href="<?=$web['url'];?>preambulos.php" title="Preambulos">
							<img src="<?=$web['url'];?>img/document_comments_16.png"> Preambulos
						</a>
					</li>
					<li style="width: 130px;">
						<a href="<?=$web['url'];?>estandares.php" title="Estandares">
							<img src="<?=$web['url'];?>img/document_todo_16.png"> Estandares
						</a>
					</li>
					<li style="width: 165px;">
						<a href="<?=$web['url'];?>configuraciones.php" title="Configuraciones">
							<img src="<?=$web['url'];?>img/database_16.png"> Configuraciones
						</a>
					</li>
				</ul>
			</nav>
		
		
		</div>
	</div>
	
	<div id="cuerpo" class="cuerpo">
