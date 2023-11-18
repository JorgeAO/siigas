<?php

include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Worksheet/Protection.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Worksheet/SheetView.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Worksheet/HeaderFooter.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Worksheet/PageMargins.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Worksheet/PageSetup.php';
include __DIR__.'/../../recursos/librerias/simple-cache/src/SimpleCache/CacheInterface.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Collection/Memory/SimpleCache3.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Settings.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Collection/Cells.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Collection/CellsFactory.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Shared/StringHelper.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/IComparable.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Worksheet/Worksheet.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Theme.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Calculation/Engine/BranchPruner.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Calculation/Engine/Logger.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Calculation/Engine/CyclicReferenceStack.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Calculation/Category.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Calculation/Calculation.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Spreadsheet.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Shared/File.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Reader/Security/XmlScanner.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/ReferenceHelper.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Reader/IReadFilter.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Reader/DefaultReadFilter.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Reader/Xlsx/Namespaces.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Reader/IReader.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Reader/BaseReader.php';
include __DIR__.'/../../recursos/librerias/PhpSpreadsheet/src/PhpSpreadsheet/Reader/Xlsx.php';

class CtrlArchivos
{
	protected $intOpcion = 2001;
	protected $strClase = 'ClsTipos';

    public function Cargar($parametros)
    {
        try 
        {
            $lector = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $hojaCalculo = $lector->load($parametros['archivo']['tmp_name']);
            $hojaTrabajo = $hojaCalculo->getActiveSheet();
            $arrHojaTrabajo = $hojaTrabajo->toArray();

            echo "<pre>";
            print_r($arrHojaTrabajo);
            echo "</pre>";
            exit();
        } 
        catch (Exception $e) 
        {
			throw new Exception('ERROR: '.$e->getMessage());   
        }
    }
}

?>