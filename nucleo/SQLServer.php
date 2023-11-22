<?php

class SQLServer
{
    private static function datosConexion($servidor)
    {
        try 
        {
			$arrDatosCnx['localhost'] = [
				"servidor" => "JORGEAO\\SQLEXPRESS",
				"usuario" => "siigas",
				"clave" => "siigas2023",
				"basedatos" => "db_prueba",
			];

			return $arrDatosCnx[$servidor];
        } 
        catch (Exception $e)
        {
			throw new Exception($e->getMessage());
        }   
    }

    private static function conectar($servidor = 'localhost')
    {
        try 
        {
            $datosCnx = self::datosConexion($servidor);
            
            $cnx = new PDO( "sqlsrv:Server=".$datosCnx['servidor'].";Database=".$datosCnx['basedatos'], $datosCnx['usuario'], $datosCnx['clave'] );
            $cnx->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
            $cnx->setAttribute( PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 1 );

            return $cnx;
        } 
        catch (Exception $e) 
        {
			throw new Exception($e->getMessage());
        }
    }

	public static function insert($sqlSentencia, $servidor = 'localhost')
	{
		try 
		{
			$cnx = self::conectar($servidor);
            $stmt = $cnx->query($sqlSentencia);

            $datos = array();
            $datos['error'] = false;
            $datos['lastInsertId'] = $cnx->lastInsertId();

			return $datos;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}

	public static function select($sqlSentencia, $servidor = 'localhost')
	{
		try 
		{
			$cnx = self::conectar($servidor);
            $stmt = $cnx->query($sqlSentencia);

            $datos = array();
            
            while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $datos[] = $fila;
            }

			return $datos;
		} 
		catch (Exception $e) 
		{
			throw new Exception($e->getMessage());
		}
	}
}
?>