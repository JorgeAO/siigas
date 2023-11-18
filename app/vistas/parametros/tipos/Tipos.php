<script type="text/javascript" src="/siigas/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/siigas/recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="/siigas/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="/siigas/recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/siigas/recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/siigas/recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/propias/css/estilos.css">

<?php include '../../seguridad/seguridad/Menu.php'; ?>

<script type="text/javascript">
	$(document).ready(function(){
		consultar();

		$('#btn_consultar').on('click', function(){
			consultar();
		});
	});

	function consultar()
	{
		enviarPeticion('tipos/consultar',
			{'':''}, 
			function(rta){
				if (rta.tipo == 'error')
					alert(rta.mensaje)
				else if (rta.tipo == 'exito')
				{
					var tabla = '<table id="tbl_resultados" class="table table-hover table-bordered table-striped table-sm texto-12" width="100%" cellspacing="0">'+
						'<thead>'+
						'<tr>'+
						'<th>Código</th>'+
						'<th>Descripción</th>'+
						'<th>Estado</th>'+
						'<th>Opciones</th>'+
						'</tr>'+
						'</thead>'+
						'<tbody>';

					$.each(rta.datos, function(i, val){
						tabla += '<tr>'+
							'<td>'+val['tipo_codigo']+'</td>'+
							'<td>'+val['tipo_descripcion']+'</td>'+
							'<td>'+val['esta_descripcion']+'</td>'+
							'<td class="btn-group">'+
							'<a href="tiposUpd/'+val['tipo_codigo']+'" class="btn btn-primary btn-sm" title="Editar registro"><i class="fa fa-edit"></i></a>'+
							'<button class="btn btn-danger btn-sm" type="button" title="Eliminar registro" onclick="eliminar('+val['tipo_codigo']+')"><i class="fa fa-trash-o"></i></button>'+
							'</td>'+
							'</tr>';
					});

					tabla += '</tbody></table>';

					$('#div_resultados').html(tabla);
					$('#tbl_resultados').DataTable({
						"language": { "url": ruta_tabla_esp }
					});
				}
			}
		);
	}

	function eliminar(cod)
	{
		if (confirm('¿Está seguro que desea eliminar el registro?'))
		{
			enviarPeticion('tipos/eliminar',
				{'tipo_codigo':cod}, 
				function(rta){
					alert(rta.mensaje);
					if (rta.tipo == 'exito')
						consultar();
				}
			);
		}
	}
</script>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header bg-base7 text-white">Tipos</div>
		<div class="card-body">
			<div class="form-group">
				<a class="btn btn-success btn-sm" href="TiposAdd.php">Agregar</a>
				<button class="btn btn-primary btn-sm" id="btn_consultar">Consultar</button>
			</div>
			<div class="table-responsive" id="div_resultados"></div>
		</div>
	</div>
</div>