<?php


require_once "field.inc";

class Structure_Sucursal
{
	public $idSucursal;
	public $nombre;
	public $descripcion;
	public $telefonofijo;
	public $estado;
    public $abrev;

	function __construct()
	{
		$this->idSucursal = new Field("int", true);
 		$this->nombre = new Field("varchar");
 		$this->descripcion = new Field("varchar");
		$this->telefonofijo = new Field("varchar");
 		$this->estado = new Field("enum");
 		$this->abrev = new Field("varchar");
	}

}

?>