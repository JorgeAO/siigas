function fn_DibujarPunto(mapa, posicion, arreglo)
{
	var marker = new google.maps.Marker({
    	position: posicion,
      	map: mapa
    });
    mapa.panTo(posicion);

    arreglo.push(marker);
}

function fn_PonerPunto(mapa, arreglo)
{
	map.addListener('click', function(e) {
		//placeMarkerAndPanTo(e.latLng, map);
		console.info(e.latLng);
    });

    //arreglo.push(marker);
}