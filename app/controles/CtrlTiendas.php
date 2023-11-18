<?

include_once '../app/modelos/ClsTiendas.php';
include_once '../nucleo/Control.php';
include_once '../nucleo/BaseDatos.php';

class CtrlTiendas extends Control
{
	protected $intOpcion = 2002;
	protected $strClase = 'ClsTiendas';

	public function crearTienda($arrParametros)
	{
		try 
		{
			$strCobertura = '';

			for ($i = 0; $i < count($arrParametros['tien_cobertura']); $i++)
				$strCobertura .= ''.$arrParametros['tien_cobertura'][$i]['lat'].' '.$arrParametros['tien_cobertura'][$i]['lng'].',';

			$strCobertura .= $arrParametros['tien_cobertura'][0]['lat'].' '.$arrParametros['tien_cobertura'][0]['lng'].',';

			$strCobertura = rtrim($strCobertura, ',');

			$sqlInsert = "insert into tb_par_tiendas set ".
				"tien_lat = '".$arrParametros['tien_lat']."', ".
				"tien_lng = '".$arrParametros['tien_lng']."', ".
				"tien_nombre = '".$arrParametros['tien_nombre']."', ".
				"tien_posicion = PointFromText('POINT(".$arrParametros['tien_lat']." ".$arrParametros['tien_lng'].")'), ".
				"tien_cobertura = GeomFromText('POLYGON((".$strCobertura."))'), ".
				"fc = '".date('Y-m-d H:m:s')."', ".
				"uc = ".$_SESSION['usuario_sesion'][0]['usua_codigo'];

			//echo $sqlInsert; exit();

			$arrRta = BaseDatos::ejecutarSentencia($sqlInsert);

			$objRta->tipo = 'exito';
			$objRta->mensaje = 'El proceso se realizó con éxito';
			return $objRta;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	/*public function consule($arrParametros = [])
	{
		try 
		{
			
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}*/
}