<?php


require_once "field.inc";

class Structure_Sucursal
{
	public $idSucursal;
	public $Nombre;
	public $Ubicacion;
	public $Descripcion;
	public $Direccion;

	function __construct()
	{
		$this->idSucursal = new Field("int", true);
 		$this->Nombre = new Field("varchar");
 		$this->Ubicacion = new Field("varchar");
		$this->Descripcion = new Field("varchar");
 		$this->Direccion = new Field("varchar");
	}

}

?>