<script src="../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script src="../recursos/librerias/propias/js/scripts.js"></script>
<script src="../recursos/librerias/popper/popper.min.js"></script>
<script src="../recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
<script src="../recursos/librerias/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<script src="../recursos/librerias/propias/js/mapas.js"></script>

<script 
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3Xc_M4i3AIJuWOZlooi_hNuCg6E0y0BA&callback=initMap&libraries=&v=weekly" defer
></script>

<link rel="stylesheet" type="text/css" href="../recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../recursos/librerias/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/propias/css/estilos.css">

<style type="text/css">
	/* Always set the map height explicitly to define the size of the div
	* element that contains the map. */
	#map {
		height: 95%;
		border: 1px solid silver;
	}

	/* Optional: Makes the sample page fill the window. */
	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	}

	.alto {
		height: 90%;
	}
</style>



<? require '../../seguridad/seguridad/Menu.php'; ?>

<div class="col-sm-12">
	<div class="card alto">
		<div class="card-header bg-base7 text-white">Tiendas</div>
		<div class="card-body">
			<div class="row">
				<div class="form-group col-sm-2">
					<div class="dropdown">
						<button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Opciones
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
							<button class="dropdown-item btn-sm" id="btn_pnt_add" title="Agregar tienda">
								<i class="fa fa-map-pin"></i> Agregar tienda
							</button>
							<button class="dropdown-item btn-sm" id="btn_mrk_ver" title="Ver tiendas">
								<i class="fa fa-map-o"></i> Ver tiendas
							</button>
							<button class="dropdown-item btn-sm" id="btn_mrk_buscar" title="Buscar tiendas">
								<i class="fa fa-search"></i> Buscar tiendas
							</button>
						</div>
					</div>
				</div>
				<div class="form-group col-sm-8">
					<button class="btn btn-success btn-sm" id="btn_pol_guardar" title="Guardar tienda">
						<i class="fa fa-save"></i>
					</button>
					<button class="btn btn-primary btn-sm" id="btn_pol_dibujar" title="Dibujar polígono">
						<i class="fa fa-pencil"></i>
					</button>
					<button class="btn btn-danger btn-sm" id="btn_map_limpiar" title="Limpiar mapa">
						<i class="fa fa-trash-o"></i>
					</button>
				</div>
			</div>
			<div class="table-responsive" id="map"></div>
		</div>
	</div>
</div>


<div class="modal" id="mdl_add_punto" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Agregar tienda</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Latitud</label>
					<input type="text" class="form-control" id="tien_lat" placeholder="Latitud" readonly="true">
				</div>
				<div class="form-group">
					<label>Longitud</label>
					<input type="text" class="form-control" id="tien_lng" placeholder="Latitud" readonly="true">
				</div>
				<div class="form-group">
					<label>Nombre de la tienda</label>
					<input type="text" class="form-control" id="tien_nombre" placeholder="Nombre de la tienda">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-sm" id="btn_guardar">Guardar</button>
				<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>


<script>
	var map;
	var tiendas = [];
	var cobertura = [];
	var poligono;
	
	$(document).ready(function(){

		$('#btn_poligono').on('click',function(){
			pintarPoligono();
		});

		$('#btn_pnt_add').on('click',function(){
			agregarPunto();
		});

		$('#btn_guardar').on('click', function(){
			
			var cobertura = [];
			var tienda = (tiendas.length - 1);
			$.each(poligono.getPath().i, function(i, val){
				cobertura.push({
					'lat' : val.lat(),
					'lng' : val.lng()
				});
			});
			console.info(cobertura);

			enviarPeticion('tiendas/crearTienda',
				{
					'tien_lat':$('#tien_lat').val(),
					'tien_lng':$('#tien_lng').val(),
					'tien_nombre':$('#tien_nombre').val(),
					'tien_cobertura': cobertura
				}, 
				function(rta){
					// remove listener
					// hide modal
					// add info_window
				}
			);
		});

		$('#btn_mrk_buscar').on('click',function(){
			enviarPeticion('tiendas/consultar',
				{ '':'' }, 
				function(rta){
					if (rta.tipo == 'exito')
					{
						$.each(rta.datos, function(i, val){
							fn_DibujarPunto(
								map, 
								{ lat: parseFloat(val.x), lng: parseFloat(val.y) }, 
								tiendas
							);
						});
					}
				}
			);
		});

		$('#btn_mrk_ver').on('click', function(){
			console.info(tiendas);
		});

		$('#btn_pol_guardar').on('click', function(){
			tiendas[tiendas.length - 1]['cobertura'] = poligono.getPath().i;

			guardarInfoPunto(
				tiendas[tiendas.length - 1].lat(), 
				tiendas[tiendas.length - 1].lng()
			);
		});

		$('#btn_pol_dibujar').on('click', function(){
			definirPoligono();
		});

		$('#btn_map_limpiar').on('click', function(){
			/*$.each(tiendas, function(i, val){
				val.setMap(null);
			})*/
			initMap();
			tiendas = [];
			cobertura = [];
		});
	});

	function initMap() 
	{
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: 3.4349712, lng: -76.5091626},
			zoom: 17
		});
	}

	function agregarPunto()
	{
		map.addListener('click', function(e) {
			placeMarkerAndPanTo(e.latLng, map);
        });
	}

	function placeMarkerAndPanTo(latLng, map) 
	{
        var marker = new google.maps.Marker({
        	position: latLng,
          	map: map
        });
        map.panTo(latLng);
        google.maps.event.clearInstanceListeners(map);

        tiendas.push(latLng);

        definirPoligono();

		//guardarInfoPunto(latLng.lat(), latLng.lng())
		
		/*marker.addListener('click', function() {
			console.info(latLng.lat());
		});*/
	}

	function guardarInfoPunto(lat, lng)
	{
		$('#mdl_add_punto').modal('show');
		$('#tien_lat').val(lat);
		$('#tien_lng').val(lng);
	}

	function definirPoligono()
	{
		poly = new google.maps.Polyline({});

		poly.setMap(map);


		//map.addListener("click", addLatLng(e));
		map.addListener("click", function(e){
			
			const path = poly.getPath();

			path.push(e.latLng);

			poligono = new google.maps.Polygon({
				paths: path,
				editable:true,
				strokeColor: "#FF0000",
				strokeOpacity: 0.8,
				strokeWeight: 3,
				fillColor: "#FF0000",
				fillOpacity: 0.05
			});

			poligono.setMap(map);
		});
	}
</script>