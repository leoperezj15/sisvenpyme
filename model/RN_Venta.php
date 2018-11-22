<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Precio.inc";
require_once "data/Cliente.inc";
require_once "data/ProductoPrecio.inc";
require_once "data/ProductoAlmacen.inc";
require_once "data/UnidadMedida.inc";
require_once "data/SubCategoria.inc";
require_once "data/Categoria.inc";
                     
class RN_Venta extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) 
     * @return Lista de Structure_ClienteGeneral
     */
    function GetProductoGeneral($_NroDocumento)
    {
        $sql = "SELECT t1.idProducto AS t1_idProducto,t1.descripcion AS t1_descripcion,
        t1.nombre AS t1_nombre,t2.abrev as t2_unidadMedida,t1.stock AS t1_Cantidad,
        t6.precioCompra AS t6_precioCompra,t6.precioVenta AS t6_precioVenta,
        t3.nombre AS t3_subCategoria,t4.nombre as t4_categoria FROM producto t1
        INNER JOIN unidadmedida t2 ON t1.idunidadMedida=t2.idunidadMedida
        INNER JOIN subcategoria t3 ON t1.idsubCategoria=t3.idsubCategoria
        INNER JOIN categoria t4 ON t3.idCategoria=t4.idCategoria
        INNER JOIN producto_precio t5 ON t1.idProducto=t5.idProducto 
        INNER JOIN precio t6 ON t5.idPrecio=t6.idPrecio
        INNER JOIN producto_almacen t7 ON t1.idProducto=t7.idProducto
        INNER JOIN almacen t8 ON t7.idAlmacen=t8.idAlmacen
        WHERE t5.estado='Activo' AND t6.estado='Activo'
        GROUP BY t1.idProducto ASC";
        $res = $this->Execute($sql);
        
        $osProducto = new Structure_Producto;
        $osUnidadMedida = new Structure_UnidadMedida;
        $osSubCategoria = new Structure_SubCategoria;
        $osCategoria = new Structure_Categoria;
        $osProductoPrecio = new Structure_ProductoPrecio;
        $osPrecio = new Structure_Precio;
        $osProductoAlmacen = new Structure_ProductoAlmacen;
        $osAlmacen = new Structure_Almacen;
        
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
 				$osClienteGeneral->idCliente->SetValue($item["idCliente"]);
 				$osClienteGeneral->nombreCompleto->SetValue($item["NombreCompleto"]);
 				$osClienteGeneral->nroDocumento->SetValue($item["NroDocumento"]);
                $osClienteGeneral->direccion->SetValue($item["Direccion"]);
                $osClienteGeneral->celular->SetValue($item["Celular"]);
                $osClienteGeneral->tipoCliente->SetValue($item["tipoCliente"]);

            }            
        }
        
        return $osClienteGeneral;
    }
}
                
?>