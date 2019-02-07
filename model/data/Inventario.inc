<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Producto.inc";
require_once "Almacen.inc";
                     
class Structure_Inventario
{

    public $idAlmacen;
    public $idProducto;
    public $Stock;
    public $estado;

    Public $Producto;
    Public $Almacen;
 
    function __construct()
    { 
        $this->idAlmacen = new Field("int");
        $this->idProducto = new Field("int");
        $this->Stock = new Field("float");
        $this->estado = new Field("enum");

        $this->Producto = new Structure_Producto;
        $this->Almacen = new Structure_Almacen;
        
	}
}
                
?>