<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Proveedor.inc";
require_once "Empleado.inc";
require_once "Almacen.inc";
                     
class Structure_Compra
{

    public $idCompra;
    public $fechayHoraIngreso;
    public $fechaCompra;
    public $idProveedor;
    public $idEmpleado; 
    public $MontoTotal;
    public $idAlmacenIngreso;
    public $nroFactura;

    Public $Proveedor;
    Public $Empleado;
    Public $Almacen;
 
    function __construct()
    { 
 	$this->idCompra = new Field("int", true);
 	$this->fechayHoraIngreso = new Field("date");
 	$this->fechaCompra = new Field("date");
 	$this->idProveedor = new Field("int");
 	$this->idEmpleado = new Field("int");
        $this->MontoTotal = new Field("float");
        $this->idAlmacenIngreso = new Field("int");
        $this->nroFactura = new Field("int");

        $this->Proveedor = new Structure_Proveedor;
        $this->Empleado = new Structure_Empleado;
        $this->Almacen = new Structure_Empleado;
        
	}
}
                
?>