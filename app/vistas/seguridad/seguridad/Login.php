<script type="text/javascript" src="/siigas/recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="/siigas/recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="/siigas/recursos/librerias/propias/js/validador.js"></script>
<script type="text/javascript" src="/siigas/recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/siigas/recursos/librerias/propias/css/estilos.css">

<script type="text/javascript">
	$(document).ready(function(){
		$('#btn_entrar1').on('click', function(){
			if (validarFormulario('frm_src'))
			{
				enviarPeticion('usuarios/validar',
					prepararFormulario('frm_src'), 
					function(rta){
						if (rta.tipo == 'error')
							alert(rta.mensaje)
						else if (rta.tipo == 'exito')
							window.location.href = rta.ruta;
					}
				);
			}
		});

		$('#frm_src').on('submit', function(event){
			event.preventDefault();
			if (validarFormulario('frm_src'))
			{
				enviarPeticion('usuarios/validar',
					prepararFormulario('frm_src'), 
					function(rta){
						if (rta.tipo == 'error')
							alert(rta.mensaje)
						else if (rta.tipo == 'exito')
							window.location.href = rta.ruta;
					}
				);
			}
		});
	});
</script>

<br>

<div class="col-sm-6 offset-sm-3">
		<form id="frm_src">	
	<div class="">
			<div class="bg-transparent text-center">
				<h3>
					Iniciar Sesión
				</h3>
			</div>
			<div class="card-body">
				<div class="col-sm-12">
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" class="form-control form-control-sm" name="usua_login" id="usua_login" data-tipo="login" data-req="true">
							<label id="hlp_usua_login" class="texto-error"></label>
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<input type="password" class="form-control form-control-sm" name="usua_clave" id="usua_clave" data-tipo="clave" data-req="true">
							<label id="hlp_usua_clave" class="texto-error"></label>
						</div>
				</div>
			</div>
			<div class="text-center">
  				<button type="submit" class="btn btn-primary btn-sm" id="btn_entrar" name="btn_entrar">Entrar</button>
				<a href="recuperarCuenta" class="btn btn-outline-primary btn-sm">Olvidé mi contraseña</a>
			</div>
	</div>
		</form>
</div>
<div class="col-sm-12 text-center">
	<span class="texto-12">Desarrollado por:<br></span>
	<img width="100px" src="/siigas/recursos/imagenes/aming_logo.png">
</div>