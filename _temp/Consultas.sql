-- Consulta de empleado con respectivo usuario y su rol
SELECT t1.idEmpleado as t1_idEmpleado, CONCAT(t1.nombre,' ', t1.apPaterno,' ', t1.apMaterno) AS t1_nombreCompleto, 
DATE_FORMAT(t1.fechaNacimiento,'%d/%m/%Y') AS t1_fechaNacimiento,t1.ci AS t1_ci , t2.username AS t2_usuario,
t2.email AS t2_email, t3.nombre AS t3_rol FROM `empleado` as t1
INNER JOIN usuario t2 on t1.idEmpleado = t2.idEmpleado and t1.estado = 'activo'
INNER JOIN rol t3 on t2.idRol = t3.idRol
-- -----------------------------------------------------------------------------------------------------------------------------------------------
-- Insert de Categoria
INSERT INTO `categoria`(`idCategoria`, `nombre`, `descripcion`, `estado`) VALUES 
(0,'Herramientas Electricas','Todas las electricas ','Activo'),
(0,'Herramientas Manuales','Todas de manipulacion manual','Activo'),
(0,'Maquinas Soldadoras y componentes','Equipos y componentes de Soldar','Activo'),
(0,'Equipos de Construccion','Todas de construccion','Activo'),
(0,'Equipos Agroforestales','Equipos y herramientas Agroforestales','Activo'),
(0,'Bombas de Fluido','De diferentes caudales','Activo'),
(0,'Grupos Electrogenos','Generadores de energia  de diferentes voltages','Activo'),
(0,'Iluminacion','Todas de iluminacion','Activo'),
(0,'Equipos de Helevacion y Carga','De elevacion y carga','Activo'),
(0,'Equipos Generadores de Aire','Generadores y compresores','Activo');
----------------------------------------------------------------------------------------------------------------------------------------------------
--Insert de Sub Categoria
INSERT INTO `subcategoria`(`idsubCategoria`, `nombre`, `descripcion`, `estado`, `idCategoria`) VALUES 
(0,'Herramientas Electricas Industriales','','Activo',1),
(0,'Herramientas Electricas Profesionales','','Activo',1),
(0,'Herramientas de Medicion','','Activo',1),
(0,'Herramientas Electricas Multiuso','','Activo',1),
(0,'Alicates','','Activo',1),
(0,'Llaves','','Activo',1),
(0,'Medicion y Trazado','','Activo',2),
(0,'Dados y Accesorios','','Activo',2),
(0,'Herramientas de Golpe','','Activo',2),
(0,'Herramientas de Corte y Terminacion','','Activo',2),
(0,'Herramientas de Fijacion','','Activo',2),
(0,'Almacenaje o Gabinetes','','Activo',2),
(0,'Prensas','','Activo',2),
(0,'Juego de Herramientas','','Activo',2),
(0,'Herramientas Mecanicas','','Activo',2);
---------------------------------------------------------------------------------------------------------------------------------------------------
--consulta para mostrar clientes de tipo natural y juridico
SELECT t1.idCliente AS idCliente, CONCAT(t2.nombre, ' ',t2.apPaterno, ' ' , t2.apMaterno) AS NombreCompleto, t1.ci As NroDocumento , t1.direccion Direccion, t1.telefonoCelular AS Celular, 'Natural' AS tipoCliente 
FROM `cliente` t1
INNER JOIN `natural` t2 on t1.idCliente = t2.idCliente
WHERE t1.estado = 'Activo'
UNION
SELECT t4.idCliente AS idCliente, CONCAT(t3.razonSocial) AS NombreCompleto, t3.nit As NroDocumento , t4.direccion AS Direccion, t4.telefonoCelular AS Celular, 'Juridico' AS tipoCliente 
FROM `cliente` t4
INNER JOIN `juridico` t3 on t4.idCliente = t3.idCliente
WHERE t4.estado = 'Activo'
-------------------------------------------------------------------------------------------------------------------------------------------------------
--Consulta a una vista de clientes general donde se compara por nro de documento
SELECT * FROM `view_cliente_general` WHERE NroDocumento = 9710974
--------------------------------------------------------------------------------------------------------------------------------------------------------
--estructurapara recuperar datos de un carrito
-- $lista = array();
-- If ( isset($_SESSION["carrito"] ) {
--     $lista = $_SESSION["carrito"];
-- }

-- $item = array("dato1" => $dato1, "dato2" => $dato2);

-- $lista[] = $item;

-- $_SESSION["carrito"] = $lista;

----------------------------------------------------------------------------------------------------------------------------------------------------------
--estrctura de v-panel
<div class="card text-center"> <!--class="ctn-main"-->
    <div class="card-header">
        <div class="">
        <!-- <a href="?mnu=nuevo_modulo"><input type='button' value='Nuevo Modulo' class='btn btn-primary'></a> -->
    </div class="card-body">
        <!-- <h2 class="card-title">Listado de Modulo y Objetos</h2> -->
        <?php
            echo "<b>Rol - " . $rol . "<br>";
            //echo $content;
            echo "<br><b>Estructura Guardada en Sesión</b><br><br>";
            print_r($ACL); 
        ?>
        <br>
    </div>
    ------------------------------------------------------------------------------------------------------------------------------------------------------
    --Listar Productos con unidad de medida, subcategoria, categoria, producto precio y precio
    SELECT t1.idProducto AS t1_idProducto,t1.descripcion AS t1_descripcion,t1.nombre AS t1_nombre,t2.abrev as t2_unidadMedida,t6.precioCompra AS t6_precioCompra,t6.precioVenta AS t6_precioVenta,t3.nombre AS t3_subCategoria,t4.nombre as t4_categoria FROM producto t1
    INNER JOIN unidadmedida t2 ON t1.idunidadMedida=t2.idunidadMedida
    INNER JOIN subcategoria t3 ON t1.idsubCategoria=t3.idsubCategoria
    INNER JOIN categoria t4 ON t3.idCategoria=t4.idCategoria
    INNER JOIN producto_precio t5 ON t1.idProducto=t5.idProducto 
    INNER JOIN precio t6 ON t5.idPrecio=t6.idPrecio
    WHERE t5.estado='Activo' AND t6.estado='Activo'
    GROUP BY t1.idProducto ASC
    ----------------------------------------------------------------------------------------------------------------------------------------------------
    --
SELECT t1.idProducto AS t1_idProducto,t1.descripcion AS t1_descripcion,t1.nombre AS t1_nombre,t2.abrev as t2_unidadMedida,t1.stock AS t1_Cantidad,t6.precioCompra AS t6_precioCompra,t6.precioVenta AS t6_precioVenta,t3.nombre AS t3_subCategoria,t4.nombre as t4_categoria FROM producto t1
INNER JOIN unidadmedida t2 ON t1.idunidadMedida=t2.idunidadMedida
INNER JOIN subcategoria t3 ON t1.idsubCategoria=t3.idsubCategoria
INNER JOIN categoria t4 ON t3.idCategoria=t4.idCategoria
INNER JOIN producto_precio t5 ON t1.idProducto=t5.idProducto 
INNER JOIN precio t6 ON t5.idPrecio=t6.idPrecio
INNER JOIN producto_almacen t7 ON t1.idProducto=t7.idProducto
INNER JOIN almacen t8 ON t7.idAlmacen=t8.idAlmacen
WHERE t5.estado='Activo' AND t6.estado='Activo'
GROUP BY t1.idProducto ASC
-----------------------------------------------------------------------------------------------------------------------
--para x-fn
 // if($oProducto != null)
                    // {
                    //     $idProducto = $oRN_Producto->idProducto->getValue();
                    //     $nombre = $oRN_Producto->nombre->getValue();
                    //     $descripcion = $oRN_Producto->descripcion->getValue();
                    //     $stock = $oRN_Producto->stock->getValue();

                    //     $_SESSION["ProductoLista"] = array(
                    //         "idProducto" => $idProducto,
                    //         "nombre" => $nombre,
                    //         "descripcion" => $descripcion,
                    //         "stock" => $stock
                    //     );
                        
                    // }
                    // else
                    // {
                    //     $content = "err|No hay Productos Disponibles";
                    // }
--------------------------------------------------------------------------------------------------------
--consulta para ver los alamaces y sus suscursales
SELECT t1.idAlmacen AS t1_idAlmacen,t1.nombre AS t1_nombre,t1.abrev AS t1_abrev,t2.nombre AS t2_nombre 
FROM almacen t1
INNER JOIN sucursal t2 on t1.idSucursal=t2.idSucursal
WHERE t1.estado='Activado'
ORDER BY t1.idAlmacen ASC
-----------------------------------------------------------------------------------------------------------
--creacion de vista producto general
CREATE
 ALGORITHM = UNDEFINED
 VIEW `view_producto_general`
 AS SELECT
    t1.idProducto AS t1_idProducto,
    t1.descripcion AS t1_descripcion,
    t1.nombre AS t1_nombre,
    t2.abrev AS t2_unidadMedida,
    t1.stock AS t1_stock,
    t6.precioCompra AS t6_precioCompra,
    t6.precioVenta AS t6_precioVenta,
    t3.nombre AS t3_subCategoria,
    t4.nombre AS t4_categoria,
    t8.nombre AS t8_almacen,
    t8.abrev AS t8_abrev,
    t9.nombre AS t9_sucursal
FROM
    producto t1
INNER JOIN unidadmedida t2 ON
    t1.idunidadMedida = t2.idunidadMedida
INNER JOIN subcategoria t3 ON
    t1.idsubCategoria = t3.idsubCategoria
INNER JOIN categoria t4 ON
    t3.idCategoria = t4.idCategoria
INNER JOIN producto_precio t5 ON
    t1.idProducto = t5.idProducto
INNER JOIN precio t6 ON
    t5.idPrecio = t6.idPrecio
INNER JOIN producto_almacen t7 ON
    t1.idProducto = t7.idProducto
INNER JOIN almacen t8 ON
    t7.idAlmacen = t8.idAlmacen
INNER JOIN sucursal t9 ON
    t8.idSucursal = t9.idSucursal
WHERE
    t5.estado = 'Activo' AND t6.estado = 'Activo'
GROUP BY
    t1.idProducto ASC
-------------------------------------------------------------------------------------------------------------------------------------------------------
-- busqueda de Productos mientras el pedido sea uno y almacen sea el adecuado
SELECT t1.idProducto,t2.nombre AS NombreProducto, SUM(t1.cantidad) AS Stock 
FROM producto_almacen t1
INNER JOIN producto t2 ON t1.idProducto=t2.idProducto
WHERE t1.idPedido=1 AND t1.idProducto=2 AND t1.idAlmacen=4
----------------------------------------------------------------------------------------------------------------------------------------------------------
select `t1`.`idProducto` AS `t1_idProducto`,
`t1`.`descripcion` AS `t1_descripcion`,
`t1`.`nombre` AS `t1_nombre`,
`t2`.`abrev` AS `t2_unidadMedida`,
`t1`.`stock` AS `t1_stock`,
`t6`.`precioCompra` AS `t6_precioCompra`,
`t6`.`precioVenta` AS `t6_precioVenta`,
`t3`.`nombre` AS `t3_subCategoria`,
`t4`.`nombre` AS `t4_categoria`,
`t8`.`idAlmacen` AS `t8_idAlmacen`,
`t8`.`nombre` AS `t8_almacen`,
`t8`.`abrev` AS `t8_abrev`,
`t9`.`nombre` AS `t9_sucursal` 
from (
    (((((((`acl`.`producto` `t1` 
    join `acl`.`unidadmedida` `t2` on ((`t1`.`idunidadMedida` = `t2`.`idunidadMedida`))) 
    join `acl`.`subcategoria` `t3` on ((`t1`.`idsubCategoria` = `t3`.`idsubCategoria`))) 
    join `acl`.`categoria` `t4` on ((`t3`.`idCategoria` = `t4`.`idCategoria`))) 
    join `acl`.`producto_precio` `t5` on ((`t1`.`idProducto` = `t5`.`idProducto`))) 
    join `acl`.`precio` `t6` on ((`t5`.`idPrecio` = `t6`.`idPrecio`))) 
    join `acl`.`producto_almacen` `t7` on ((`t1`.`idProducto` = `t7`.`idProducto`))) 
    join `acl`.`almacen` `t8` on ((`t7`.`idAlmacen` = `t8`.`idAlmacen`))) 
    join `acl`.`sucursal` `t9` on ((`t8`.`idSucursal` = `t9`.`idSucursal`))) 
    where ((`t5`.`estado` = 'Activo') and (`t6`.`estado` = 'Activo'))
---------------------------------------------------------------------------------------------------------------------------------------------------------------
--Consulta con compras y ventas con clientes y demas stck almacen fechas
SELECT t1.idPedido AS t1_idPedido,t2.nombre AS T2_nombre,t1.realizado_por AS t1_realizado_por,
t3.idProductoAlmacen AS t3_idProductoAlmacen,t3.idProducto AS t3_idProducto,
t4.nombre AS t4_nombre,t4.descripcion AS t4_descripcion,
t3.fechaMovimiento As t3_fechaMovimiento,
t3.idAlmacen as t3_idAlmacen,t5.nombre AS t5_nombre,
t5.abrev as t5_abreviatura,t6.nombre as t6_nombreSucursal,
t3.idPedido AS t3_idPedido,t3.cantidad AS t3_cantidad,
t7.*,
t3.estado AS t3_estado
FROM pedido t1
INNER JOIN tipopedido t2 ON t1.idTipoMovimiento=t2.idTipoPedido
INNER JOIN producto_almacen t3 ON t3.idPedido=t1.idPedido
INNER JOIN producto t4 ON t3.idProducto=t4.idProducto
INNER JOIN almacen t5 ON t3.idAlmacen=t5.idAlmacen
INNER JOIN sucursal t6 ON t5.idSucursal=t6.idSucursal
INNER JOIN view_cliente_general t7 on t1.idCliente=t7.idCliente
WHERE t1.idtipoMovimiento=3 --1 Ventas 3 Compras
ORDER BY t3.idAlmacen,t3.idProducto
---------------------------------------------------------------------------------------------------------------------------------------------------------
--Consulta de stock de Compra dependiendo del producto y del almacen
SELECT t1.idPedido AS t1_idPedido,
t2.nombre AS T2_nombre,
t1.realizado_por AS t1_realizado_por,
t3.idProductoAlmacen AS t3_idProductoAlmacen,
t3.idProducto AS t3_idProducto,
t4.nombre AS t4_nombre,
t4.descripcion AS t4_descripcion,
t3.fechaMovimiento As t3_fechaMovimiento,
t3.idAlmacen as t3_idAlmacen,
t5.nombre AS t5_nombre,
t5.abrev as t5_abreviatura,
t6.nombre as t6_nombreSucursal,
t3.idPedido AS t3_idPedido,
SUM(t3.cantidad) AS t3_cantidad,
t7.*,
t3.estado AS t3_estado
FROM pedido t1
INNER JOIN tipopedido t2 ON t1.idTipoMovimiento=t2.idTipoPedido
INNER JOIN producto_almacen t3 ON t3.idPedido=t1.idPedido
INNER JOIN producto t4 ON t3.idProducto=t4.idProducto
INNER JOIN almacen t5 ON t3.idAlmacen=t5.idAlmacen
INNER JOIN sucursal t6 ON t5.idSucursal=t6.idSucursal
INNER JOIN view_cliente_general t7 on t1.idCliente=t7.idCliente
WHERE t1.idtipoMovimiento=3 AND t3.idProducto=2 AND t3.idAlmacen=2
ORDER BY t3.idAlmacen,t3.idProducto
----------------------------------------------------------------------------------------------------------------------------------------------
--consulta de stck de venta en relacion con el producto y su respectivo almacen
SELECT t1.idPedido AS t1_idPedido,
t2.nombre AS T2_nombre,
t1.realizado_por AS t1_realizado_por,
t3.idProductoAlmacen AS t3_idProductoAlmacen,
t3.idProducto AS t3_idProducto,
t4.nombre AS t4_nombre,
t4.descripcion AS t4_descripcion,
t3.fechaMovimiento As t3_fechaMovimiento,
t3.idAlmacen as t3_idAlmacen,
t5.nombre AS t5_nombre,
t5.abrev as t5_abreviatura,
t6.nombre as t6_nombreSucursal,
t3.idPedido AS t3_idPedido,
SUM(t3.cantidad) AS t3_cantidad,
t7.*,
t3.estado AS t3_estado
FROM pedido t1
INNER JOIN tipopedido t2 ON t1.idTipoMovimiento=t2.idTipoPedido
INNER JOIN producto_almacen t3 ON t3.idPedido=t1.idPedido
INNER JOIN producto t4 ON t3.idProducto=t4.idProducto
INNER JOIN almacen t5 ON t3.idAlmacen=t5.idAlmacen
INNER JOIN sucursal t6 ON t5.idSucursal=t6.idSucursal
INNER JOIN view_cliente_general t7 on t1.idCliente=t7.idCliente
WHERE t1.idtipoMovimiento=1 AND t3.idProducto=2 AND t3.idAlmacen=2
ORDER BY t3.idAlmacen,t3.idProducto
---------------------------------------------------------------------------------------------------------------------------------------------------