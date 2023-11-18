<?php

class Pruebas
{
    function Imprimir($parametros) 
    {
        try 
        {
            echo "<pre>";
            print_r($parametros);
            echo "</pre>";
            exit();
        } 
        catch (Exception $e) 
        {
            throw new Exception($e);
        }
    }
}


?>