<?php
	session_start();
	require("head.php");
?>
<script>
	window.document.title = "<?=$web['nombre'];?> - Error 404";
</script>
<div class="box">
	<div class="title select">
		<center>
			<h1 style="margin: 0;">
				404 - Page Not Found
				<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
			</h1>
		</center>
	</div>
	<div class="bloque interior">
		<center>
			<h3>La página a la que intentas acceder no existe o no está disponible actualmente.</h3>
			<h4>Asegurate de haber escrito bien la url.</h4>
		</center>
	</div>
</div>
<? require("footer.php"); ?>
