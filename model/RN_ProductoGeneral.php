<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/ProductoGeneral.inc";
                     
class RN_ProductoGeneral extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function GetProductoForAlmacenAndCant($_idProducto,$_nombreAlmacen,$_cantidad)
    {
        $sql = "SELECT t1_idProducto as idProducto,
        t1_descripcion as descripcion,
        t1_nombre as nombre,
        t8_almacen as almacen,
        t6_precioVenta as precioVenta
        FROM `view_producto_general` 
        WHERE t1_idProducto=".$_idProducto." 
        AND t8_almacen='".$_nombreAlmacen."' 
        AND t1_stock>=".$_cantidad."";

        $res = $this->Execute($sql);

        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osProductoGeneral = new Structure_ProductoGeneral;

                $osProductoGeneral->idProducto->SetValue($item['idProducto']);
                $osProductoGeneral->descripcion->SetValue($item['descripcion']);
                $osProductoGeneral->nombre->SetValue($item['nombre']);
                $osProductoGeneral->almacen->SetValue($item['almacen']);
                $osProductoGeneral->precioVenta->SetValue($item['precioVenta']);

            }
        }
        return $osProductoGeneral;
    }
}                
?>