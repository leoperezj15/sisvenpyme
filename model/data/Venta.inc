<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Cliente.inc";
require_once "Empleado.inc";
require_once "Almacen.inc";
                     
class Structure_Venta
{

    public $idVenta;
    public $idCliente;
    public $fechayHora;
    public $MontoTotal;
    public $MontoDescuento;
    public $idEmpleado;
    public $estado;
    public $idAlmacenVenta;
    

    Public $Cliente;
    Public $Empleado;
    Public $Almacen;
 
    function __construct()
    { 
        $this->idVenta = new Field("int", true);
        $this->idCliente = new Field("int");
        $this->fechayHora = new Field("datetime");
        $this->MontoTotal = new Field("float");
        $this->MontoDescuento = new Field("float");
        $this->idEmpleado = new Field("int");
        $this->estado = new Field("enum");
        $this->idAlmacenVenta = new Field("int");

        $this->Cliente = new Structure_Cliente;
        $this->Empleado = new Structure_Empleado;
        $this->Almacen = new Structure_Almacen;
        
	}
}
                
?>