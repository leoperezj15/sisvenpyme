<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/DetalleVenta.inc";
                     
class RN_DetalleVenta extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function Save($_osDetalleVenta)
    {
        $sql = "INSERT into detalle_venta values (
				" . $_osDetalleVenta->idProducto->GetValue() . ",
                " . $_osDetalleVenta->idVenta->GetValue() . ",
                " . $_osDetalleVenta->cantidad->GetValue() . ",
                " . $_osDetalleVenta->precio->GetValue() . ",
                " . $_osDetalleVenta->descuento->GetValue() . ",
				" . $_osDetalleVenta->descuento_porcentaje->GetValue() .")";

        $res = $this->Execute($sql);
        
        return $res;
    }
    
    
}
                
?>