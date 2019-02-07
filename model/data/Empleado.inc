<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
                     
class Structure_Empleado
{

 	public $idEmpleado;
 	public $hash;
 	public $nombre;
 	public $apPaterno;
 	public $apMaterno;
 	public $fechaNacimiento;
 	public $ci;
 	public $estado; 
 
    function __construct()
    { 
 		$this->idEmpleado = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->apPaterno = new Field("varchar");
 		$this->apMaterno = new Field("varchar");
 		$this->fechaNacimiento = new Field("datetime");
 		$this->ci = new Field("varchar");
 		$this->estado = new Field("enum");
	}
}
                
?>