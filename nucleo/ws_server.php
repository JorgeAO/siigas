<?php

require '../recursos/librerias/nusoap/nusoap-0.9.5/lib/nusoap.php';
require '../app/controles/CtrlUsuarios.php';

// Crear servidor
$server = new soap_server();
$server->configureWSDL("Prueba de Web Service NuSOAP PHP", "http://localhost/siigas");

// Registrar el método
$server->register('ejecutar',
    array("type" => "xsd:string"),
    array("return" => "xsd:string"),
    "",
    "http://localhost/siigas#ejecutar",
    "rpc",
    "encoded",
    "");

function ejecutar($arrParametros = [])
{
	$obRta = new StdClass();

	try 
	{
		$arrParametros = json_decode($arrParametros);

		// Validar el usuario
		$ctrlUsuarios = new CtrlUsuarios();
		$usuario = $ctrlUsuarios->validar([
			'usua_login' => $arrParametros->usuario,
			'usua_clave' => $arrParametros->clave,
		]);

		// Identificar la petición
		$arrPeticion = explode('/', $arrParametros->peticion);

		$ctrlNombre = 'Ctrl'.ucfirst($arrPeticion[0]);
		$strMetodo = $arrPeticion[1];

		// Saber si el controlador existe
		if (!file_exists('../app/controles/'.$ctrlNombre.'.php'))
			throw new Exception('No existe el control "'.$ctrlNombre.'"');
		
		include '../app/controles/'.$ctrlNombre.'.php';
		$control = new $ctrlNombre();

		if (!method_exists($control, $arrPeticion[1]))
			throw new Exception('No se encuentra definido el método "'.$arrPeticion[1].'" en el control "'.$ctrlNombre.'"');

		$objResultado = $control->$strMetodo($arrParametros->parametros);
		
		$obRta->error = false;
		$obRta->mensaje = 'Peticion procesada con exito';
		$obRta->parametros = $arrPeticion;
		$obRta->resultado = $objResultado;
	} 
	catch (Exception $e) 
	{
		$obRta->error = true;
		$obRta->mensaje = $e->getMessage();
	}

	return json_encode($obRta);
}

if (!isset($HTTP_RAW_POST_DATA))
	$HTTP_RAW_POST_DATA = file_get_contents('php://input');

$server->service($HTTP_RAW_POST_DATA);

?>