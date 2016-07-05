<?php
	require("head.php")
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Examenes";
		
		$(document).ready(function() {
			$('#preambulos').dataTable({
				"language": {
					"emptyTable":     "No data available in table",
					"info":           "Mostrando del _START_ al _END_ de _TOTAL_ preambulos",
					"infoEmpty":      "Mostrando del 0 al 0 de 0 preambulos",
					"infoFiltered":   "(filtered from _MAX_ total entries)",
					"infoPostFix":    "",
					"thousands":      ",",
					"lengthMenu":     "Mostrar _MENU_ preambulos",
					"loadingRecords": "Cargando...",
					"processing":     "Procesando...",
					"search":         "Buscar:",
					"zeroRecords":    "No se han encontrado resultados",
					"paginate": {
						"first":      "Primero",
						"last":       "Ultimo",
						"next":       "Siguiente",
						"previous":   "Anterior"
					},
					"aria": {
						"sortAscending":  ": activate to sort column ascending",
						"sortDescending": ": activate to sort column descending"
					}
				},
				"order": [[ 0, "desc" ]],
				"columnDefs": [ {
					  "targets": 'no-sort',
					  "orderable": false,
					  "searchable": false
				} ]
			});
			
			$(".pre_prev").fancybox({
					padding : 0
			});
		});
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					Examenes
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<table id="preambulos" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Titulo</th>
						<th>Fecha</th>
						<th class="no-sort">Opciones</th>
					</tr>
				</thead>
			 
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Titulo</th>
						<th>Fecha</th>
						<th class="no-sort">Opciones</th>
					</tr>
				</tfoot>
			 
				<tbody>
					<?
					$examenes_db = $conectar->query("SELECT * FROM $tabla_examenes order by id Desc");

					while($row_examenes=$examenes_db->fetch_array()) {
						echo '<tr>';
						echo '	<td>'.$row_examenes['id'].'</td>';
						echo '	<td>'.$row_examenes['titulo'].'</td>';
						echo '	<td>'.UNIX2DATE($row_examenes['fecha']).'</td>';
						echo '	<td>';
						echo '		<a href="'.$web['url'].'generar.php?id='.$row_examenes['id'].'"><img src="'.$web['url'].'img/page_edit_16.png" title="Editar"></a>';
						if($row_examenes['generado'] == 1) {
							echo ' <a href="'.$web['url'].'files/examenes/'.$row_examenes['id'].'.pdf"><img src="'.$web['url'].'img/document_image_16.png" title="Preview"></a>';
						} else {
							echo '	<a href="javascript:void(0);" onclick="alert(\'No se ha generado preview, edita el problema para crearla.\')"><img src="'.$web['url'].'img/document_image_16.png" title="Preview"></a> ';
						}
						echo '	<a href="javascript:void(0);" onclick="borrar_selectivo(1,'.$row_examenes['id'].')"><img src="'.$web['url'].'img/cross_16.png" title="Borrar"></a>';
						echo '	</td>';
						echo '</tr>';
					};
					?>
				</tbody>
			</table>
		</div>
	</div>
<? require("footer.php"); ?>
