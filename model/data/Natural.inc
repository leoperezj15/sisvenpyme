<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Cliente.inc";

                     
class Structure_Natural
{

    public $idCliente;
    public $nombre;
    public $apPaterno;
    public $apMaterno;
    public $fechanacimiento;
    public $ci;
    public $genero;

    Public $Cliente;
 
    function __construct()
    { 
        $this->idCliente = new Field("int", true);
 	$this->nombre = new Field("varchar");
 	$this->apPaterno = new Field("varchar");
 	$this->apMaterno = new Field("varchar");
        $this->fechanacimiento = new Field("date");
        $this->ci = new Field("varchar");
        $this->genero = new Field("enum");

        $this->Cliente = new Structure_Cliente;
	}
}
                
?>