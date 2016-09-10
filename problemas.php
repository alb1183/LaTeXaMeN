<?php
	require("head.php")
?>
	<script>
		window.document.title = "<?=$web['nombre'];?> - Problemas";
		$(document).ready(function() {
			$('#problemas').dataTable({
				"language": {
					"emptyTable":     "No data available in table",
					"info":           "Mostrando del _START_ al _END_ de _TOTAL_ problemas",
					"infoEmpty":      "Mostrando del 0 al 0 de 0 problemas",
					"infoFiltered":   "(filtered from _MAX_ total entries)",
					"infoPostFix":    "",
					"thousands":      ",",
					"lengthMenu":     "Mostrar _MENU_ problemas",
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
					$(nRow).attr('id', 'problem_' + aData[0]);
					$(nRow).attr('onclick', 'problemas_add(' + aData[0] + ')');
				},
				"order": [[ 0, "desc" ]],
				"columnDefs": [ {
					  "targets": 'no-sort',
					  "orderable": false,
					  "searchable": false
				} ]
			});
			
			/***************** DESCOMENTAR PARA PODER BUSCAR POR COLUMNA ***************/
			/*
			// Setup - add a text input to each footer cell
			$('#problemas tfoot th').each( function () {
				var title = $('#problemas thead th').eq( $(this).index() ).text();
				$(this).html( '<input type="text" placeholder="Buscar por '+title+'" />' );
			} ); 
			
			// DataTable
			var table = $('#problemas').DataTable();
		 
			// Apply the search
			table.columns().every( function () {
				var that = this;
		 
				$( 'input', this.footer() ).on( 'keyup change', function () {
					that
						.search( this.value )
						.draw();
				} );
			} );
			*/
			
			$(".prob_prev").fancybox({
					padding : 0
			});
			
			var problemas = Cookies.get('problemas');
			var problems = problemas.split(',')
			for (var i in problems) {
				$("#problem_" + problems[i]).addClass('row_selected');
				$("#problem_" + problems[i]).attr('onclick', 'problemas_remove(' + problems[i] + ')');
				//$("#problemas_add_" + problems[i]).hide();
				//$("#problemas_remove_" + problems[i]).show();
			}
			
			$( "#problemas a" ).click(function(e) {
				e.stopPropagation();
			});
		});
	</script>
	<div class="box">
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					Problemas <a href="<?=$web['url']?>problema.php?id=0"><img src="<?=$web['url']?>img/add_16.png" style="margin-bottom: 0;" title="Añadir"></a>
					<span class="arrow" style="margin-top: 12px; margin-right: 3px;"> </span>
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<table id="problemas" class="display selectable" cellspacing="0" width="100%">
			<?
				
				$columnas = '<th>ID</th>
							<th>Titulo</th>
							<th>Estandares</th>';

				$columnas_db = $conectar->query("select * from $tabla_problemas order by id Desc");
				$columnas_array = array();
				while($row_columnas=$columnas_db->fetch_array()) {
					$data_json = json_decode($row_columnas['data']);
					foreach($data_json as $key => $val)
					{
						array_push($columnas_array, $key);
					}
				}
				
				//$columnas_array = array_unique($columnas_array);
				natsort($columnas_array);
				$columnas_array_r = array_intersect_key($columnas_array,array_unique(array_map("StrToLower",$columnas_array)));
				$columnas_array_f = array_map("StrToLower",$columnas_array_r);
				
				foreach($columnas_array_r as $column)
				{
					$columnas .= '<th>'.$column.'</th>';
				}
				
				$columnas .= '<th class="no-sort">Opciones</th>';
			?>
				<thead>
					<tr>
						<?=$columnas;?>
					</tr>
				</thead>
			 
				<tfoot>
					<tr>
						<?=$columnas;?>
					</tr>
				</tfoot>
			 
				<tbody>
					<?
					$problemas_db = $conectar->query("SELECT * FROM $tabla_problemas order by id Desc");

					while($row_problemas=$problemas_db->fetch_array()) {
						echo '<tr>';
						echo '	<td>'.$row_problemas['id'].'</td>';
						echo '	<td>'.$row_problemas['titulo'].'</td>';
						echo '	<td>'.(($row_problemas['estandares'] != -1) ? $row_problemas['estandares'] : 'Ninguno' ).'</td>';
						
						$data_json = array_change_key_case(json_decode($row_problemas['data'], TRUE));
						foreach($columnas_array_f as $column)
						{
							echo '<td>'.$data_json[$column].'</td>';
						}
						
						echo '	<td>';
						echo '		<a href="'.$web['url'].'problema.php?id='.$row_problemas['id'].'"><img src="'.$web['url'].'img/page_edit_16.png" title="Editar"></a> ';
						if($row_problemas['preview'] == 1) {
							if(file_exists('./files/problemas/'.$row_problemas['id'].'.jpg')) {
								echo '<a class="prob_prev" href="'.$web['url'].'files/problemas/'.$row_problemas['id'].'.jpg"><img src="'.$web['url'].'img/document_image_16.png" title="Preview"></a> ';
							} else if(file_exists('./files/problemas/'.$row_problemas['id'].'-0.jpg')){
								echo '<a rel="gallery'.$row_problemas['id'].'" class="prob_prev" href="'.$web['url'].'files/problemas/'.$row_problemas['id'].'-0.jpg"><img src="'.$web['url'].'img/document_image_16.png" title="Preview"></a> ';
								echo '<div style="display: none;">';
								$cont = 1;
								while(file_exists('./files/problemas/'.$row_problemas['id'].'-'.$cont.'.jpg')) { // TODO: Esto es para cuando tiene varias paginas, bucle que para cuando ya no hay mas paginas.
									echo '<a rel="gallery'.$row_problemas['id'].'" class="prob_prev" href="'.$web['url'].'files/problemas/'.$row_problemas['id'].'-'.$cont.'.jpg"></a> ';
									$cont++;
								}
								echo '</div>';
							}
						} else {
							echo '	<a href="javascript:void(0);" onclick="alert(\'No se ha generado preview, edita el problema para crearla.\')"><img src="'.$web['url'].'img/document_image_16.png" title="Preview"></a> ';
						}
						//echo '		<a id="problemas_add_'.$row_problemas['id'].'" href="javascript:void(0);" onclick="problemas_add('.$row_problemas['id'].');";><img src="'.$web['url'].'img/book_next_16.png" title="Añadir"></a>';
						//echo '		<a id="problemas_remove_'.$row_problemas['id'].'" style="display: none;" href="javascript:void(0);" onclick="problemas_remove('.$row_problemas['id'].');";><img src="'.$web['url'].'img/book_previous_16.png" title="Quitar"></a>';
						echo '	<a href="javascript:void(0);" onclick="borrar_selectivo(2,'.$row_problemas['id'].')"><img src="'.$web['url'].'img/cross_16.png" title="Borrar"></a>';
						echo '	</td>';
						
						echo '</tr>';
					};
					?>
				</tbody>
			</table>
		</div>
	</div>
<? require("footer.php"); ?>
