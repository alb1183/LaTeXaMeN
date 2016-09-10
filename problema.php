<?php
	require("head.php");

	$id = (int) $_GET['id'];
	if($id != 0) {
		$problema_db = $conectar->query("select * from $tabla_problemas WHERE id=$id");
		$row_problema=$problema_db->fetch_array();
		
		if($problema_db) {
			if ($problema_db->num_rows <= 0) {
				echo "<center><h2>No existe ese problema</h2></center>";
				require("footer.php");
				exit();
			}
		}
		$state = 'Editar';
	} else {
		$row_problema = NULL;
		$state = 'Nuevo';
	}
?>
	<style>
		.ace_active-line-2 {
			background: rgba(255, 100, 100, 0.4) none repeat scroll 0 0;
		   position: absolute; /* without this positions will be erong */
		   z-index: 1000; /* in front of all other markers */ 
		}
	</style>
	<script>
		window.document.title = "<?=$web['nombre'];?> - <?=$state;?> Problema";
		function add_form() {
			var form_n = prompt("Nombre de la nueva columna", "");
			
			if (form_n != null) {
					var html  = '<tr>';
						html += '<td style="text-align: right; width: 250px;"><label class="add-on left">'+form_n+': </label></td>';
						html += '<td><input style="width: 350px;" type="text" name="'+form_n+'" id="'+form_n+'" class="right formulario" value=""> <img onclick="del_form(this);" style="margin-bottom: -4px; cursor: pointer;" title="Borrar formulario" src="<?=$web['url'];?>img/textfield_delete_16.png"></td>';
						html += '</tr>';
				$(html).insertBefore("#form_ult");
			}
		}
		function del_form(that) {
			var r = confirm("Seguro que lo quieres quitar?");
			if (r == true) {
				$(that).closest('tr').remove();
			}
		}
		
		function save_form(id) {
			var parametros = {};
			$( ".formulario" ).each(function( index ) {
				var name = $(this).attr('name');
				//alert(name);
				var val = $(this).val();
				
				parametros[name] = val;
			});
			
			//Lo paso a JSON para enviarlo :D
			var json_send = JSON.stringify(parametros);
			
			var titulo = $('#titulo').val();
			var estandares = $('#estandares').val();
			var latex = editor_latex.getValue();
			
			$.ajax({
				data:  { 'tipo' : 3, 'id' : id , 'titulo' : titulo, 'estandares' : estandares, 'latex' : latex , 'data' : json_send},
				url:   '<?=$web['url'];?>php/funciones-ajax.php',
				type:  'post',
				beforeSend: function () {
						$("#infoajax").html("Guardando...");
				},
				success:  function (response) {
						if(response == 1){
							$("#infoajax").html("Guardado correctamente");
							if(id == 0) 
								window.location = '<?=$web['url'];?>problemas.php'
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
					<?=$state;?> Problema
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<center>
				<table cellspacing="2" cellpadding="2" border="0" style="margin-left: 40px;">
					<tr>
						<td style="text-align: right; width: 250px;"><label class="add-on left">Titulo: </label></td>
						<td><input style="width: 350px;" type="text" name="titulo" id="titulo" class="right" value="<?=$row_problema['titulo'];?>"></td>
					</tr>
					<tr>
						<td style="text-align: right; width: 250px;"><label class="add-on left">Estandares: </label></td>
						<td><input style="width: 350px;" type="text" name="estandares" id="estandares" class="right" value="<?=$row_problema['estandares'];?>"> <img onclick="add_form();" style="margin-bottom: -4px; cursor: pointer;" title="Añadir formulario" src="<?=$web['url'];?>img/textfield_add_16.png"></td>
					</tr>
					<?
						if($id != 0) {
							$data_json = json_decode($row_problema['data'], TRUE);
						} else {
							$data_json = json_decode('{"Tags":"","Area":"","Dificultad":""}', TRUE);
						}
						foreach($data_json as $key => $column)
						{
							echo '<tr>';
							echo '	<td style="text-align: right;"><label class="add-on left">'.$key.':</label></td>';
							echo '	<td><input class="right formulario" style="width: 350px;" type="text" name="'.$key.'" id="'.$key.'" value="'.$column.'"> <img onclick="del_form(this);" style="margin-bottom: -4px; cursor: pointer;" title="Borrar formulario" src="'.$web['url'].'img/textfield_delete_16.png"></td>';
							echo '</tr>';
						}
					?>
					<tr id="form_ult">
						<td style="text-align: right;"><i style="color: #999999; font-size: 11px; font-family: times new roman; margin-right: 5px;" id="infoajax"> </i></td>
						<td><input onclick="save_form(<?=$id;?>);" id="enviarform" type="button" value="Guardar" class="buttonstyle green"> <input type="button" onclick="save_form(0);" value="Nuevo" class="buttonstyle orange"> <? if($id != 0) echo '<input type="button" class="buttonstyle red" value="Borrar" onclick="borrar_selectivo(2,'.$id.')">'; ?></td>
					</tr>
				</table>
			</center>
			<pre style="width: 1190px; height: 500px;" id="editor_latex"><?=$row_problema['latex'];?></pre>
			<? if($row_problema['preview'] != 1 && $id != 0) { 
				$leer_log_f = leer_log('./files/problemas/' . $id . '.log');
				$errores = $leer_log_f['errores'];
				$errores_linea = $leer_log_f['errores_linea'];
				$contenido = $leer_log_f['contenido'];
			?>
			<h2>Log(<?=$errores;?> errores marcados en rojo):</h2>
			<pre style="width: 1190px; height: 500px;" id="editor_log"><?=$contenido;?></pre>
			<script>
				var Range = ace.require("ace/range").Range
				var editor_log = ace.edit("editor_log");
				editor_log.setTheme("ace/theme/twilight");
				editor_log.getSession().setMode("ace/mode/plain_text");
				editor_log.setShowPrintMargin(false);
				<?
					foreach ($errores_linea as &$linea) {
						echo 'editor_log.getSession().addMarker(new Range('.($linea-1).', 0, '.($linea+5).', 1), "ace_active-line-2", "fullLine"); ';
					}
				?>
			</script>
			<?
			}			
			?>
			<script>
				var editor_latex = ace.edit("editor_latex");
				editor_latex.setTheme("ace/theme/twilight");
				editor_latex.getSession().setMode("ace/mode/latex");
				editor_latex.setShowPrintMargin(false);
			</script>
		</div>
	</div>
<? require("footer.php"); ?>
