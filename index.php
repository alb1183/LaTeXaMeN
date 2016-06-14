<?php
	require("head.php")
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Inicio";
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					Inicio
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<center>
				<h2>Bienvenido a LaTeXaMeN</h2>
				<h3>Esta aplicacion tiene como finalidad crear, archivar y administrar examenes y problemas LaTeX.</h3>
				<h4>La aplicacion depende de un servidor PHP y una base de datos SQL, al igual que requiere tener en
				el host instalado latex con pdflatex e ImageMagick(que a su vez requiere Ghostscript).</h4>
				<h5 style="color: red;">Para cualquier duda, consulta, idea o problema enviese un correo electronico a alber1183@hotmail.com</h5>
			</center>
		</div>
	</div>
<? require("footer.php"); ?>
