<?php

/**
 * Ruta para descar el driver de PHP-SQLServer
 * https://learn.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver16#download
 */

class SQLServer
{
    private function datosConexion($servidor)
    {
        try 
        {
			$arrDatosCnx['localhost'] = [
				'servidor' => 'JORGEAO/SQLEXPRESS',
				'usuario' => 'php_app',
				'clave' => 'Phpapp',
				'basedatos' => 'bd_prueba',
			];

			return $arrDatosCnx[$servidor];
        } 
        catch (Exception $e)
        {
            //throw $th;
			throw new Exception($e->getMessage());
        }   
    }

    private function conectar($servidor = 'localhost')
    {
        try 
        {
            $datosCnx = self::datosConexion($servidor);

            $infoConeccion = array(
                "Database"=>$datosCnx['basedatos'], 
                "UID"=>$datosCnx['usuario'], 
                "PWD"=>$datosCnx['clave']
            );

            $cnx = sqlsrv_connect( $datosCnx['servidor'], $infoConeccion);
        } 
        catch (Exception $e) 
        {
			throw new Exception($e->getMessage());
        }
    }
}
?>