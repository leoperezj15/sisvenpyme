<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "field.inc";

class Structure_Proveedor
 {
 	public $idProveedor;
 	public $hash;
	public $nit;
 	public $nombre;
 	public $contacto;
 	public $direccion;
 	public $telefonoFijo;
 	public $telefonoCelular;
 	public $correo;
 	public $paginaWeb;
 	public $estado;

 	function __construct()
 	{
 		$this->idProveedor = new Field("int", true);
 		$this->hash = new Field("varchar");
		$this->nit = new Field("int");
 		$this->nombre = new Field("varchar");
 		$this->contacto = new Field("varchar");
 		$this->direccion = new Field("varchar");
 		$this->telefonoFijo = new Field("varchar");
 		$this->telefonoCelular = new Field("varchar");
 		$this->correo = new Field("varchar");
 		$this->paginaWeb = new Field("varchar");
 		$this->estado = new Field("enum");

 	}
 }

?>