<?php
	require("head.php")
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Estandares";
		$(document).ready(function() {
			$('#estandares').dataTable({
				"language": {
					"emptyTable":     "No data available in table",
					"info":           "Mostrando del _START_ al _END_ de _TOTAL_ estandares",
					"infoEmpty":      "Mostrando del 0 al 0 de 0 estandares",
					"infoFiltered":   "(filtered from _MAX_ total entries)",
					"infoPostFix":    "",
					"thousands":      ",",
					"lengthMenu":     "Mostrar _MENU_ estandares",
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
				"fnCreatedRow": function( nRow, aData, iDataIndex ) {
					$(nRow).attr('id', 'pream_' + aData[0]);
				},
				"columnDefs": [ {
					  "targets": 'no-sort',
					  "orderable": false,
					  "searchable": false
				} ]
			});
			
		});
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					Estandares <a href="<?=$web['url']?>estandar.php?id=0"><img src="<?=$web['url']?>img/add_16.png" style="margin-bottom: 0;" title="Añadir"></a>
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<table id="estandares" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>ID</th>
						<th>Estandar</th>
						<th>Descripcion</th>
						<th>Puntuacion</th>
						<th class="no-sort">Opciones</th>
					</tr>
				</thead>
			 
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Estandar</th>
						<th>Descripcion</th>
						<th>Puntuacion</th>
						<th class="no-sort">Opciones</th>
					</tr>
				</tfoot>
			 
				<tbody>
					<?
					$estandares_db = $conectar->query("SELECT * FROM $tabla_estandares");
					while($row_estandares=$estandares_db->fetch_array()) {
						echo '<tr>';
						echo '	<td>'.$row_estandares['id'].'</td>';
						echo '	<td>'.$row_estandares['estandar'].'</td>';
						echo '	<td>'.$row_estandares['descripcion'].'</td>';
						echo '	<td>'.$row_estandares['puntuacion'].'</td>';
						echo '	<td>';
						echo '		<a href="'.$web['url'].'estandar.php?id='.$row_estandares['id'].'"><img src="'.$web['url'].'img/page_edit_16.png" title="Editar"></a>';
						echo '	<a href="javascript:void(0);" onclick="borrar_selectivo(4,'.$row_estandares['id'].')"><img src="'.$web['url'].'img/cross_16.png" title="Borrar"></a>';
						echo '	</td>';
						echo '</tr>';
					};
					?>
				</tbody>
			</table>
		</div>
	</div>
<? require("footer.php"); ?>
