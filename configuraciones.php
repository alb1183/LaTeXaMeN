<?php
	require("head.php")
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Configuraciones";
		function save_config(tipo, data) {
			//alert(tipo + "////" + data)
			$.ajax({
				data:  {
						"tipo" : tipo,
						"data" : data
						},
				url:   '<?=$web['url'];?>php/funciones-ajax.php',
				type:  'post',
				beforeSend: function () {
						//$("#infoajax").html("Actualizando...");
				},
				success:  function (response) {
						if(response == 1){
							//$("#infoajax").html("Actualizado correctamente");
							//alert("Actualizado correctamente");
						}else{
							//$("#infoajax").html("Error: " + response);
							//alert("Error: " + response);
						}
				}
			});
		}
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					Configuraciones
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<h3 style="margin: 0px;">Inicio de pagina: <input onclick="save_config(1, editor_head.getValue())" type="button" style="float: right;" class="buttonstyle green" value="Guardar" id="head_editor_save"></h3>
			<pre style="width: 1190px; height: 500px;" id="editor_head"><?=$web['head']?></pre>
			<h3 style="margin: 0px;">Fin de pagina: <input onclick="save_config(2, editor_foot.getValue())" type="button" style="float: right;" class="buttonstyle red" value="Guardar" id="foot_editor_save"></h3>
			<pre style="width: 1190px; height: 500px;" id="editor_foot"><?=$web['foot']?></pre>
		</div>
	</div>
	<script>
		var editor_head = ace.edit("editor_head");
		var editor_foot = ace.edit("editor_foot");
		editor_head.setTheme("ace/theme/twilight");
		editor_foot.setTheme("ace/theme/twilight");
		editor_head.getSession().setMode("ace/mode/latex");
		editor_foot.getSession().setMode("ace/mode/latex");
		editor_head.setShowPrintMargin(false);
		editor_foot.setShowPrintMargin(false);
	</script>
<? require("footer.php"); ?>
