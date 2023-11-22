<?php

set_include_path(__DIR__.'/../../recursos/librerias/PHPExcel-1.8/Classes/');

require_once('C:/xampp/htdocs/siigas/recursos/librerias/PHPExcel-1.8/Classes/PHPExcel.php');
//require_once(__DIR__.'/../../recursos/librerias/PHPExcel-1.8/PHPExcel.php');
require_once('PHPExcel/Reader/Excel2007.php');

include 'C:/xampp/htdocs/siigas/nucleo/SQLServer.php';

class CtrlArchivos
{
	protected $intOpcion = 2001;
	protected $strClase = 'ClsTipos';

    public function Cargar($parametros)
    {
        try 
        {
            // Crear objeto de PHPExcel que va a leer el archivo
            $objReader = new PHPExcel_Reader_Excel2007();

            // Pasar el nombre del archivo para que sea leido
            $objPHPExcel = $objReader->load($parametros['archivo']['tmp_name']);

            // Obtener la hoja de cálculo del archivo excel que será leída
            $sheet =  $objPHPExcel->getActiveSheet();

            // Obtener el número de fila con información
            $cantFilas = $sheet->getHighestRow();

            // Obtener la última columna con información
            $ultimaColumna = $sheet->getHighestColumn();

            // Obtener el número de columnas con información
            $cantColumnas = PHPExcel_Cell::columnIndexFromString($ultimaColumna);

            // Definir nombre de la tabla
            $nombreTabla = "tmp_tbl_".$parametros['evento'];

            // Iniciar sentencia SQL que creará la tabla temporal con un campo para identificador único
            $sqlCrearTabla = "CREATE TABLE ".$nombreTabla."(";
            //$sqlCrearTabla.= "__id INT PRIMARY KEY, ";

            $listadoCampos = '';

            // Recorrer la primera fila para identificar los nombre de las columnas con las que se va a crear la tabla temporal
            for ($i = 0; $i < $cantColumnas; $i++)
            {
                // Agregar la columna del excel que está en el ciclo a la sentencia SQL que crea la tabla temporal
                $sqlCrearTabla .= $sheet->getCellByColumnAndRow($i, 1)->getValue()." NVARCHAR(100), ";

                // Agregar la columna al listado de campos
                $listadoCampos .= $sheet->getCellByColumnAndRow($i, 1)->getValue().", ";
            }

            // Limpiar el final de la sentencia SQL (quitar la última coma)
            $sqlCrearTabla = rtrim($sqlCrearTabla, ", ");
            $listadoCampos = rtrim($listadoCampos, ", ");

            // Cerrar la sentencia SQL que crea la tabla temporal
            $sqlCrearTabla .= ");";

            $sqlInsert = "";
            for ($i = 2; $i < $cantFilas; $i++)
            {
                $sqlInsertFila = "insert into ".$nombreTabla."(".$listadoCampos.") values (";

                for ($j = 0; $j < $cantColumnas; $j++)
                {
                    $sqlInsertFila .= "'".$sheet->getCellByColumnAndRow($j, $i)->getValue()."', ";
                }

                $sqlInsertFila = rtrim($sqlInsertFila, ", ");
                $sqlInsertFila .= ");";

                $sqlInsert .=  $sqlInsertFila;
            }

            echo $sqlInsert;

            // Eliminar la tabla antes de crear la nueva
            SQLServer::insert("drop table if exists ".$nombreTabla.";");

            // Crear la tabla nuevamente
            SQLServer::insert($sqlCrearTabla);

            SQLServer::insert($sqlInsert);
        } 
        catch (Exception $e) 
        {
			throw new Exception('ERROR: '.$e->getMessage());   
        }
    }

    private function crearTabla($nombreTabla, $hojaCalculo) 
    {
        try 
        {
        } 
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }    
    }
}

?>