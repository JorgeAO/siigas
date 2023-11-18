<?php

include_once '../nucleo/Modelo.php';

class ClsTipos extends Modelo
{
	protected $strTabla = 'tb_par_tipos';
	protected $strLlavePrimaria = 'tipo_codigo';
	protected $sqlSentencia = 'select tipo.*, esta.esta_descripcion
		from tb_par_tipos tipo 
		join tb_par_estados esta on (tipo.fk_par_estados = esta.esta_codigo) ';
}