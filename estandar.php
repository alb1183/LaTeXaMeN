<?php
	require("head.php");

	$id = (int) $_GET['id'];
	if($id != 0) {
		$estandar_db = $conectar->query("select * from $tabla_estandares WHERE id='$id'");
		$row_estandar=$estandar_db->fetch_array();
		
		if($estandar_db) {
			if ($estandar_db->num_rows <= 0) {
				echo "<center><h2>No existe ese preambulo</h2></center>";
				require("footer.php");
				exit();
			}
		}
		$state = 'Editar';
	} else {
		$row_estandar = NULL;
		$state = 'Nuevo';
	}
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - <?=$state;?> Estandares";
		function save_form() {
			var estandar = $('#estandar').val();
			var descripcion = $('#descripcion').val();
			var puntuacion = $('#puntuacion').val();
			
			$.ajax({
				data:  { 'tipo' : 7, 'id' : <?=$id;?> , 'estandar' : estandar, 'descripcion' : descripcion, 'puntuacion' : puntuacion },
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
					<?=$state;?> Estandar
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<center>
				<table cellspacing="2" cellpadding="2" border="0" style="margin-left: 40px;">
					<tr>
						<td style="text-align: right; width: 250px;"><label class="add-on left">Estandar: </label></td>
						<td><input style="width: 350px;" type="text" name="estandar" id="estandar" class="right" value="<?=$row_estandar['estandar'];?>"></td>
					</tr>
					<tr>
						<td style="text-align: right; width: 250px;"><label class="add-on left">Descripcion: </label></td>
						<td><input style="width: 350px;" type="text" name="descripcion" id="descripcion" class="right" value="<?=$row_estandar['descripcion'];?>"></td>
					</tr>
					<tr>
						<td style="text-align: right; width: 250px;"><label class="add-on left">Puntuacion: </label></td>
						<td><input style="width: 350px;" type="text" name="puntuacion" id="puntuacion" class="right" value="<?=$row_estandar['puntuacion'];?>"></td>
					</tr>
					<tr id="form_ult">
						<td style="text-align: right;"><i style="color: #999999; font-size: 11px; font-family: times new roman; margin-right: 5px;" id="infoajax"> </i></td>
						<td><input onclick="save_form();" id="enviarform" type="button" value="Guardar" class="buttonstyle green"></td>
					</tr>
				</table>
			</center>
		</div>
	</div>
<? require("footer.php"); ?>
