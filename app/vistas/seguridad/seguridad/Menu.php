<?php session_start(); ?>

<script type="text/javascript">
	$(document).ready(function(){
		/*enviarPeticion('permisos/menu',
			{'':''}, 
			function(rta){
				if (rta.tipo == 'error')
					alert(rta.mensaje)
				else if (rta.tipo == 'exito')
					$('#ul_menu').html(rta.mensaje);
			}
		);*/
	});
</script>

<nav class="navbar navbar-expand-sm navbar-dark bg-transparent">
	<p>
		<h5 class="">SIIGAS</h5>
	</p>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_menu" aria-controls="nav_menu" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="nav_menu">
		<ul class="navbar-nav mr-auto" id="ul_menu">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" style="color: #4F4F4F; font-weight:bold" data-toggle="dropdown" href="#mod_1">
					<i class="fa fa-cogs"></i> Parámetros</a>
				<div class="dropdown-menu" id="mod_1">
					<a class="dropdown-item" href="/siigas/app/vistas/parametros/tipos/Tipos.php">Tipos</a>
					<a class="dropdown-item" href="/siigas/app/vistas/parametros/archivos/index.php">Archivos</a>
				</div>
			</li>
		</ul>
		<ul class="navbar-nav">
			<li class="nav-item dropdown dropleft">
				<a class="nav-link dropdown-toggle" href="#" id="mod_user" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					​<picture>
						<img src="/siigas/recursos/imagenes/avatar2.png" class="rounded-circle" title="Jorge Aguilar" width="30">
					</picture>
				</a>
				<div class="dropdown-menu" aria-labelledby="mod_user">
					<div class="col-sm-12">
						<p class="texto-12">Jorge Aguilar</p>
						<p class="texto-12">Root</p>
						<p>
							<button class="btn btn-sm btn-danger" onclick="salir()">Salir</button>
						</p>
					</div>
				</div>
			</li>
		</ul>
	</div>
</nav>
<br>