<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
                     
class Structure_Cliente
{

 	public $idCliente;
 	public $direccion;
 	public $telefonoFijo;
 	public $telefonoCelular;
 	public $estado; 
 
    function __construct()
    { 
 		$this->idCliente = new Field("int", true);
 		$this->direccion = new Field("varchar");
 		$this->telefonoFijo = new Field("varchar");
 		$this->telefonoCelular = new Field("varchar");
 		$this->estado = new Field("enum");
	}
}
                
?>