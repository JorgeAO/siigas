<?

include_once '../nucleo/Modelo.php';

class ClsTiendas extends Modelo
{
	protected $strTabla = 'tb_par_tiendas';
	protected $strLlavePrimaria = 'tien_codigo';
	protected $sqlSentencia = "select 
		tien.tien_codigo, 
		tien.tien_nombre, 
		tien.fk_par_estados, 
		tien.tien_lat, 
		tien.tien_lng, 
		x(tien.tien_posicion) as x, 
		y(tien.tien_posicion) as y,
		tien.fc, 
		tien.uc, 
		tien.fm, 
		tien.um, 
		esta.esta_descripcion
		from tb_par_tiendas tien 
		join tb_par_estados esta on (tien.fk_par_estados = esta.esta_codigo) ";
}