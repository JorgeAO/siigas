<script type="text/javascript" src="/siigas/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/siigas/recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="/siigas/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="/siigas/recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="/siigas/recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="/siigas/recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/propias/css/estilos.css">

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_enviar').on('click', function(){
            
            var form_data = new FormData();
            form_data.append('formato', $('#formato').val());
            form_data.append('archivo', $('#archivo').prop('files')[0]);

            $.ajax({
		        url:'/siigas/nucleo/Enrutador.php?peticion=archivos/cargar',
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(rta){
					alert(rta.mensaje);
					if (rta.tipo == 'exito')
						window.location.href = 'tipos';
				}
            });
		});
	});
</script>

<?php include '../../seguridad/seguridad/Menu.php'; ?>

<script type="text/javascript"></script>

<div class="col-sm-12">
	<div class="card">
		<div class="card-header">Agregar Archivo</div>
		<div class="card-body">
			<form id="frm_add">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="formato">Dimensión</label>
                        <select class="form-control" id="dimension" name="dimension">
                            <option value="">-- Seleccione --</option>
                            <option value="1">1 - Dimensión Uno</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label for="evento">Evento</label>
                        <select class="form-control" id="evento" name="evento">
                            <option value="">-- Seleccione --</option>
                            <option value="356">356 - Intentos de suicidio</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label for="formato">Archivo</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="archivo">
                            <label class="custom-file-label" for="archivo"></label>
                        </div>
                    </div>
                    <div class="col-sm-8 mt-2">
                        <button type="button" class="btn btn-primary btn-sm" id="btn_enviar">Cargar Archivo</button>
                    </div>
                </div>
            </form>
		</div>
	</div>
</div>