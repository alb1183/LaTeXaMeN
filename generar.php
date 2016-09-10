<?php
	require("head.php");
	
	$id = (int) $_GET['id'];
	
	if($id != 0) {
		$examenes_db = $conectar->query("select * from $tabla_examenes WHERE id=$id");
		$row_examenes=$examenes_db->fetch_array();
		
		if($examenes_db) {
			if ($examenes_db->num_rows <= 0) {
				echo "<center><h2>No existe ese examen</h2></center>";
				require("footer.php");
				exit();
			}
		}
		$preambulo = $row_examenes['preambulo'];
		$problemas = $row_examenes['problemas'];
		$titulo = $row_examenes['titulo'];
	} else {
		$id = 0;
		$preambulo = $_COOKIE["preambulo"];
		$problemas = $_COOKIE["problemas"];
	}
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Generar";
	</script>
	<style>
		.ace_active-line-2 {
			background: rgba(255, 100, 100, 0.4) none repeat scroll 0 0;
		   position: absolute; /* without this positions will be erong */
		   z-index: 1000; /* in front of all other markers */ 
		}
	</style>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					Generar
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
		<? if($preambulo && $problemas) { ?>
			<center>
				<table cellspacing="2" cellpadding="2" border="0" style="margin-left: 40px;">
					<tr>
						<td style="text-align: right; width: 250px;"><label class="add-on left">Titulo: </label></td>
						<td><input style="width: 310px;" type="text" name="titulo" id="titulo" class="right" value="<?=$titulo;?>"></td>
					</tr>
					<?
						$preambulo_db = $conectar->query("select * from $tabla_preambulos WHERE id='$preambulo'");
						$row_preambulo=$preambulo_db->fetch_array();
						
						$problemas_db = $conectar->query("SELECT * FROM $tabla_problemas WHERE id IN ($problemas) ORDER BY FIELD(id, $problemas)");
						
						//echo '<h3>Preambulo: <b>'.$preambulo.'</b> - <b>"'.$row_preambulo['titulo'].'"</b></h3>';
						echo '<tr>';
						echo '	<td style="text-align: right; width: 250px;"><label class="add-on left">Preambulo: </label></td>';
						echo '	<td><label class="add-on right" style="width: 310px;"><b>'.$preambulo.'</b> - <b>"'.$row_preambulo['titulo'].'</b></label></td>';
						echo '</tr>';
						
						//echo '<h3>Preguntas(ordenar): </h3>';
						echo '<tr>';
						echo '	<td style="text-align: right; width: 250px;"><label class="add-on left">Preguntas(ordenar): </label></td>';						
						echo '	<td> <ul class="sortable" style="width: 100%;">';	
						while($row_problemas=$problemas_db->fetch_array()) {
							echo '<li id="'.$row_problemas['id'].'">'.$row_problemas['titulo'].'</li>';	
						}
						echo '	</ul> </td>';
						echo '</tr>';
					?>
					<tr>
						<td style="text-align: right;"></td>
						<td><input type="checkbox" class="css-checkbox" id="generate" name="generate" value="1" <?=(($id == 0) ? 'checked' : NULL)?>><label for="generate" name="generate_lbl" class="css-label depressed"> Generar fichero .tex</label></td>
					</tr>
					<tr>
						<td style="text-align: right;"></td>
						<td><input type="checkbox" class="css-checkbox" id="criteria" name="criteria" value="1"><label for="criteria" name="criteria_lbl" class="css-label depressed"> Generar tabla de criterios</label></td>
					</tr>
					<tr id="form_ult">
						<td style="text-align: right;"><i style="color: #999999; font-size: 11px; font-family: times new roman; margin-right: 5px;" id="infoajax"> </i></td>
						<td><input onclick="save_form();" id="enviarform" type="button" value="Guardar" class="buttonstyle green"> <input onclick="Cookies.remove('problemas'); Cookies.remove('preambulo'); location.reload();" type="button" value="Vaciar" class="buttonstyle red"></td>
					</tr>
				</table>
				<script>
					function save_form() {
						var titulo = $('#titulo').val();
						var preambulo = "<?=$preambulo;?>";
						var id = "<?=$id;?>"
						var criteria;
						if($("#criteria").is(":checked")) {
							criteria = 1;
						}else{
							criteria = 0;
						}
						var generate;
						if($("#generate").is(":checked")) {
							generate = 1;
						}else{
							generate = 0;
						}
						
						var preguntas = [];
						
						$( ".sortable li" ).each(function( index ) {
						  //alert( index + ": " + $( this ).text() );
							//prengutas = preguntas + $( this ).attr('id')
							preguntas.push($( this ).attr('id'));
						});
						
						var preguntas_f = preguntas.toString();
						
						var latex = '';
						if(typeof editor_latex !== 'undefined') {
							latex = editor_latex.getValue();
						}
						
						$.ajax({
							data:  { 'tipo' : 5, 'id' : id, 'titulo' : titulo, 'preambulo' : preambulo, 'problemas' : preguntas_f, 'criteria' : criteria, 'generate' : generate, 'latex' : latex},
							url:   '<?=$web['url'];?>php/funciones-ajax.php',
							type:  'post',
							beforeSend: function () {
									$("#infoajax").html("Guardando...");
							},
							success:  function (response) {
									if(response == 1 || response == 2){
										$("#infoajax").html("Guardado correctamente");
										Cookies.remove('problemas');
										Cookies.remove('preambulo');
										if(response == 2) {
											alert("Guardado pero el latex se ha generado con algunos errores.")
										}
									}else{
										//$("#infoajax").html("Error: " + response);
										alert("Error: " + response);
									}
							}
						});
					}
				
					$('.sortable').sortable();
				</script>
			</center>
			<? if($id != 0) {
				$latex_contenido = file_get_contents('./files/examenes/' . $id . '.tex');
			?>
			<hr>
			<pre style="width: 1190px; height: 500px;" id="editor_latex"><?=$latex_contenido;?></pre>
			<script>
				var editor_latex = ace.edit("editor_latex");
				editor_latex.setTheme("ace/theme/twilight");
				editor_latex.getSession().setMode("ace/mode/latex");
				editor_latex.setShowPrintMargin(false);
			</script>
			<?			
				if($row_examenes['generado'] != 1) {
					$leer_log_f = leer_log('./files/examenes/' . $id . '.log');
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
			}
		} else {
				echo "<center><h2> No se ha seleccionado preambulo y/o problema.</h2><input onclick=\"Cookies.remove('problemas'); Cookies.remove('preambulo'); location.reload();\" type=\"button\" value=\"Vaciar\" class=\"buttonstyle red\"></center>";
		}
		?>
		</div>
	</div>
<? require("footer.php"); ?>
