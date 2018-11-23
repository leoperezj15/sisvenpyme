<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Producto.inc";
require_once "data/UnidadMedida.inc";
require_once "data/SubCategoria.inc";
require_once "data/Categoria.inc";
require_once "data/ProductoPrecio.inc";
require_once "data/UnidadMedida.inc";
require_once "data/Precio.inc";
require_once "data/ProductoAlmacen.inc";
require_once "data/Almacen.inc";
                     
class RN_Producto extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) 
     * @return Lista de Structure_ClienteGeneral
     */
    function GetProductoTotal()
    {
        $sql = "SELECT 
        t1.idProducto AS t1_idProducto,
        t1.descripcion AS t1_descripcion,
        t1.nombre AS t1_nombre,
        t2.abrev as t2_unidadMedida,
        t1.stock AS t1_stock,
        t6.precioCompra AS t6_precioCompra,
        t6.precioVenta AS t6_precioVenta,
        t3.nombre AS t3_subCategoria,
        t4.nombre as t4_categoria
        FROM producto t1
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
        

        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
                $osProducto = new Structure_Producto;
                    $osProducto->idProducto->SetValue($item['t1_idProducto']);
                    $osProducto->descripcion->SetValue($item['t1_descripcion']);
                    $osProducto->nombre->SetValue($item['t1_nombre']);
                    $osProducto->stock->SetValue($item['t1_stock']);
                $osUnidadMedida = new Structure_UnidadMedida;
                    $osUnidadMedida->abrev->SetValue($item['t2_unidadMedida']);
                $osSubCategoria = new Structure_SubCategoria;
                    $osSubCategoria->nombre->SetValue($item['t3_subCategoria']);
                $osCategoria = new Structure_categoria;
                    $osCategoria->nombre->SetValue($item['t4_categoria']);
                $osProductoPrecio = new Structure_ProductoPrecio;
                $osPrecio = new Structure_Precio;
                    $osPrecio->precioCompra->SetValue($item['t6_precioCompra']);
                    $osPrecio->precioVenta->SetValue($item['t6_precioVenta']);
        

            }   
        }
        
        return $osClienteGeneral;
    }
    function GetListProducto()
    {
        $sql = "Select * from producto where estado = 'Activo'";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osProducto = new Structure_Producto;

 				$osProducto->idProducto->SetValue($item["idProducto"]);
 				$osProducto->hash->SetValue($item["hash"]);
 				$osProducto->nombre->SetValue($item["nombre"]);
                $osProducto->descripcion->SetValue($item["descripcion"]);
                $osProducto->stock->SetValue($item["stock"]);

                $list[] = $osProducto;                
            }            
        }
        
        return $list;//devolver una lista[]
    }
}
                
?>