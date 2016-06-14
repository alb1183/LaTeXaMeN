<?php
	require("head.php")
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Preambulos";
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
				"fnCreatedRow": function( nRow, aData, iDataIndex ) {
					$(nRow).attr('id', 'pream_' + aData[0]);
				},
				"columnDefs": [ {
					  "targets": 'no-sort',
					  "orderable": false,
					  "searchable": false
				} ]
			});
			
			$(".pre_prev").fancybox({
					padding : 0
			});
			
			var select_pream = Cookies.get('preambulo');
			$("#pream_" + select_pream).addClass('row_selected');
		});
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					<!--<img src="<?=$web['url'];?>img/accordion_32.png">-->
					Preambulos
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
						<th class="no-sort">Opciones</th>
					</tr>
				</thead>
			 
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Titulo</th>
						<th class="no-sort">Opciones</th>
					</tr>
				</tfoot>
			 
				<tbody>
					<?
					$preambulos_db = $conectar->query("SELECT * FROM $tabla_preambulos order by id Desc");

					while($row_preambulos=$preambulos_db->fetch_array()) {
						echo '<tr>';
						echo '	<td>'.$row_preambulos['id'].'</td>';
						echo '	<td>'.$row_preambulos['titulo'].'</td>';
						echo '	<td>';
						echo '		<a href="'.$web['url'].'preambulo.php?id='.$row_preambulos['id'].'"><img src="'.$web['url'].'img/page_edit_16.png" title="Editar"></a>';
						echo '		<a href="javascript:void(0);" onclick="preambulo_cambiar('.$row_preambulos['id'].')";><img src="'.$web['url'].'img/book_next_16.png" title="Seleccionar"></a>';
						echo '	<a href="javascript:void(0);" onclick="borrar_selectivo(3,'.$row_preambulos['id'].')"><img src="'.$web['url'].'img/cross_16.png" title="Borrar"></a>';
						echo '	</td>';
						echo '</tr>';
					};
					?>
				</tbody>
			</table>
		</div>
	</div>
<? require("footer.php"); ?>
