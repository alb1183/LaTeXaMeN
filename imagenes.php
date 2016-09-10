<?php
	require("head.php")
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Imagenes";
		
		
		function subirImagen()	{
			var archivo = $("#image_upload_file").prop("files")[0]
			if(archivo) {
				var form_data = new FormData();
				form_data.append("upload_file", archivo)
				form_data.append("tipo", 9);
				$.ajax({
					xhr: function() {
						var xhr = new window.XMLHttpRequest();
						xhr.upload.addEventListener("progress", function(evt){
							if (evt.lengthComputable) {
								var percentComplete = (evt.loaded / evt.total * 100).toFixed(2);
								if(percentComplete < 91) {
									$("#progress_bar_container").show();
									$("#progress_bar").show();
									$("#progress_bar").css({'width' : percentComplete + '%'});
									$("#progress_status").html(percentComplete + "% subido. " + filesize(evt.loaded) + " de " + filesize(evt.total));
								}else{
									$("#progress_bar_container").hide();
									$("#progress_bar").show();
									$("#progress_bar").css({'width' : '0%'});
									$("#progress_status").html("Trabajando...(Subido " + percentComplete + "%).");

								}
							}
						}, false);
						return xhr;
					},
					data:  form_data,
					url:   urlweb + 'php/funciones-ajax.php',
					type:  'post',
					contentType: false,
					processData: false,
					success:  function (response) {
							if(response == 1){
								location.reload();
							}else{
								alert('Error: ' + response);
							}
					}
				});
			}
		};	
		
		
		function borrar_imagen(file, num) {
			if (confirm("¿Seguro que quieres borrarlo?") == true) {
				
				$.ajax({
					data:  { 'tipo' : 10, 'file' : file},
					url:   '<?=$web['url'];?>php/funciones-ajax.php',
					type:  'post',
					beforeSend: function () {
						$("#file_"+num).css({'opacity' : '0.8'});
						$("#file_"+num).css({'transition-duration' : 'none'});
					},
					success:  function (response) {
							if(response == 1){
								$("#file_"+num).animate({
									width: 0,
									opacity: 0
								}, 300, function() {
									$("#file_"+num).remove()
								});
							}else{
								//$("#infoajax").html("Error: " + response);
								alert("Error: " + response);
							}
					}
				});
			}
		}
		
		$(document).ready(function() {
			$('#image_upload_file_text').click(function(e) {
				$("#image_upload_file").click();
			});
		});
		
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					Imagenes
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<b>Subir imagen:</b> 
		   <td class="text">
			<input type="file" accept="image/*" class="upload_btn" id="image_upload_file">
			<input name="image_upload_file_text" class="caja_text" type="text" value="" id="image_upload_file_text">
			<input type="button" class="buttonstyle navy caja text" id="image_upload_btn" onclick="subirImagen()" value="Subir"></td>
			<div id="progress_bar_container" class="" style="width: 330px; display: none;">
				<div id="progress_bar"></div>
			</div>
			<div class="progress_status_div" style="width: 330px;">
				<span id="progress_status" style="text-align: center;"></span>
			</div>
			<hr>
			<h2 style="margin: 0px;">Imagenes subidas:</h2>
				
				<?
					$num = 1;
					$imagenes_array = glob($directorio_files . 'examenes/*.{jpg,png,gif}', GLOB_BRACE);
					usort($imagenes_array, create_function('$b,$a', 'return filemtime($a) - filemtime($b);')); // Ordeno por fecha de modificacion descendente
					foreach($imagenes_array as $filename){
						echo '<img id="file_'.$num.'" onclick="borrar_imagen(\''.basename($filename).'\', '.$num++.')" title="Borrar" class="imgredon" src="'.$web['url'].'files/examenes/'.basename($filename).'">';
					}
					
				?>
		</div>
	</div>
<? require("footer.php"); ?>
