<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Sucursal.inc";

                     
class Structure_Almacen
{

 	public $idAlmacen;
 	public $Nombre;
 	public $Sigla;
 	public $idSucursal;

    public $Sucursal; 
 
    function __construct()
    { 
 		$this->idAlmacen = new Field("int", true);
 		$this->Nombre = new Field("varchar");
 		$this->Sigla = new Field("varchar");
 		$this->idSucursal = new Field("int");
        $this->estado = new Field("enum");

        $this->Sucursal = new Structure_Sucursal;

	}
}
                
?>