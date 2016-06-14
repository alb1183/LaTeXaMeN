<?php
	require("head.php");

	$id = (int) $_GET['id'];
	if($id != 0) {
		$preambulo_db = $conectar->query("select * from $tabla_preambulos WHERE id='$id'");
		$row_preambulo=$preambulo_db->fetch_array();
		
		if($preambulo_db) {
			if ($preambulo_db->num_rows <= 0) {
				echo "<center><h2>No existe ese preambulo</h2></center>";
				require("footer.php");
				exit();
			}
		}
		$state = 'Editar';
	} else {
		$row_preambulo = NULL;
		$state = 'Nuevo';
	}
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - <?=$state;?> Preambulo";
		function save_form() {
			var titulo = $('#titulo').val();
			var head = editor_latex_head.getValue();
			var foot = editor_latex_foot.getValue();
			
			$.ajax({
				data:  { 'tipo' : 4, 'id' : <?=$id;?> , 'titulo' : titulo, 'head' : head, 'foot' : foot },
				url:   '<?=$web['url'];?>php/funciones-ajax.php',
				type:  'post',
				beforeSend: function () {
						$("#infoajax").html("Guardando...");
				},
				success:  function (response) {
						if(response == 1){
							$("#infoajax").html("Guardado correctamente");
						}else{
							//$("#infoajax").html("Error: " + response);
							alert("Error: " + response);
						}
				}
			});
			
		}
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					<?=$state;?> Preambulo
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<center>
				<table cellspacing="2" cellpadding="2" border="0" style="margin-left: 40px;">
					<tr>
						<td style="text-align: right; width: 250px;"><label class="add-on left">Titulo: </label></td>
						<td><input style="width: 350px;" type="text" name="titulo" id="titulo" class="right" value="<?=$row_preambulo['titulo'];?>"></td>
					</tr>
					<tr id="form_ult">
						<td style="text-align: right;"><i style="color: #999999; font-size: 11px; font-family: times new roman; margin-right: 5px;" id="infoajax"> </i></td>
						<td><input onclick="save_form();" id="enviarform" type="button" value="Guardar" class="buttonstyle green"></td>
					</tr>
				</table>
			</center>
			<h3 style="margin: 0px;">Inicio de pagina: </h3>
			<pre style="width: 1190px; height: 500px;" id="editor_latex_head"><?=$row_preambulo['head'];?></pre>
			<h3 style="margin: 0px;">Fin de pagina: </h3>
			<pre style="width: 1190px; height: 500px;" id="editor_latex_foot"><?=$row_preambulo['foot'];?></pre>
			<script>
				var editor_latex_head = ace.edit("editor_latex_head");
				var editor_latex_foot = ace.edit("editor_latex_foot");
				editor_latex_head.setTheme("ace/theme/twilight");
				editor_latex_foot.setTheme("ace/theme/twilight");
				editor_latex_head.getSession().setMode("ace/mode/latex");
				editor_latex_foot.getSession().setMode("ace/mode/latex");
				editor_latex_head.setShowPrintMargin(false);
				editor_latex_foot.setShowPrintMargin(false);
			</script>
		</div>
	</div>
<? require("footer.php"); ?>
