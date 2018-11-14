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
 	public $nombre;
 	public $abrev;
 	public $idSucursal;
    public $estado;

    public $Sucursal; 
 
    function __construct()
    { 
 		$this->idAlmacen = new Field("int", true);
 		$this->nombre = new Field("varchar");
 		$this->abrev = new Field("varchar");
 		$this->idSucursal = new Field("int");
        $this->estado = new Field("enum");

        $this->Sucursal = new Structure_Sucursal;

	}
}
                
?>