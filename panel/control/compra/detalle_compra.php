<?php
session_start();
$contenido = "";

if(isset($_POST["fn"]))
{
    $fn = $_POST["fn"];
    switch ($fn) {
        case 'AddItem':
            addItem();
        break;
        case 'DeleteListItems':
            DeleteListItems();
        break;
        case 'SaveCompra':
            ProcesarCompra();
    break;
    }
}

function addItem()
{
    $idproducto = $_POST['idproducto'];
    $nombre = $_POST['nombre'];
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $lista = array();

    $existe = false;

    if( isset($_SESSION['lista']))
    {
        $lista = $_SESSION['lista'];

        for($i = 0; $i < count($lista); $i++)
        {
            if($lista[$i]['idproducto'] == $idproducto)
            {
                $existe = true;
                $lista[$i]['cantidad'] = $lista[$i]['cantidad'] + $cantidad;
            }
        }
    }
    
    if($existe == false)
    {
        $item = array("idproducto" => $idproducto, 
        "nombre" => $nombre, 
        "codigo" => $codigo, 
        "descripcion" => $descripcion,
        "modelo" => $modelo,
        "cantidad" => $cantidad,
        "precio" => $precio
    );

        $lista[] = $item;
    }

    $_SESSION['lista'] = $lista;

    $contenido = "
    <table class='table table-resposible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub total</th>
                <th>Quitar</th>

            </tr>

        </thead>

        <tbody>

    ";
    $c = 0;
    $total = 0;
    foreach($lista as $item)
    {
        $c++;
        $itemPrecio=$item['precio'];
        $itemCantidad=$item['cantidad'];

        $subTotal = $itemPrecio * $itemCantidad;
        $total += $subTotal;
        

        $contenido.= "
        
            <tr>
                <td>      ".$c."      </td>
                <td><strong>     ".$item['codigo']."      </strong></td>
                <td><strong>       ".$item['nombre']." ".$item['descripcion']." ".$item['modelo']."    </strong></td>
                <td>      ".$itemCantidad."      </td>
                <td>      ".number_format($itemPrecio,2)."      </td>
                <td>      ".number_format($subTotal,2)."      </td>
                <td> <a href='#deleteProductoCompraModal' class='delete btn btn-primary' data-toggle='modal'
                data-idproducto=' ".$item['idproducto']."'><i class='far fa-trash-alt'></i></a></td>
            </tr>
            
        
        ";
        

    }
    $contenido.="
        
        <td class='text-right' colspan=5><strong>TOTAL Bs<strong></td>
        <td class=''><input type='hidden' name='compra_add_montototal' id='compra_add_montototal' value='".$total."'>".number_format($total,2)."</td>
        <td></td>
        
        ";
    $contenido.= "
        </tbody>
    </table>";
    
    echo $contenido;
}
function DeleteListItems()
{
    $_SESSION["lista"] = null;
    $_SESSION["TotalCompra"] = null;
    $contenido = "
    <table class='table table-resposible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Sub total</th>
                <th>Quitar</th>

            </tr>

        </thead>

        <tbody>
            <tr><td colspan='6'>No hay nada en lista</td></tr>
        </tbody>
    </table>

    ";
    echo $contenido;
}
function ProcesarCompra()
{
    require_once ("../../../model/RN_Empleado.php");
    require_once ("../../../model/RN_Compra.php");
    require_once ("../../../model/RN_DetalleCompra.php");
    require_once ("../../../model/RN_Inventario.php");
    
    // echo "<pre>";
    // print_r($_POST);
    // echo "<pre>";
    date_default_timezone_set('America/La_Paz');

    $fechahoraingreso = date("Y-m-d h:i:s");
    $fechacompra = $_POST["compra_add_fechacompra"];
    $idproveedor = $_POST["compra_add_idproveedor"];
    $usuarioActivo = $_SESSION['USUARIO_ACTIVO'];
    $idEmpleado = $usuarioActivo['idEmpleado'];
    $MontoTotal = $_POST['compra_add_montototal'];
    $idAlmacen = $_POST['compra_add_almacen'];
    $nrofactura = $_POST['compra_add_nrofactura'];

    $MontoTotal = $_POST['compra_add_montototal'];
    if($MontoTotal!="")
    {
        $oRN_Compra = new RN_Compra;
        $osCompra = new Structure_Compra;

        $osCompra->idCompra->SetValue(0);
        $osCompra->fechayHoraIngreso->SetValue($fechahoraingreso);
        $osCompra->fechaCompra->SetValue($fechacompra);
        $osCompra->idProveedor->SetValue($idproveedor);
        $osCompra->idEmpleado->SetValue($idEmpleado);
        $osCompra->MontoTotal->SetValue($MontoTotal);
        $osCompra->idAlmacenIngreso->SetValue($idAlmacen);
        $osCompra->nroFactura->SetValue($nrofactura);

        $idCompra = $oRN_Compra->Save($osCompra);

        if (isset($_SESSION["lista"]))
        {
            $lista = $_SESSION["lista"];
            $contador = 0;

            foreach($lista as $item)
            {
                $idProducto = $item["idproducto"];
                $cantidad = $item["cantidad"];
                $precio_compra = $item["precio"];

                $oRN_DetalleCompra = new RN_DetalleCompra;
                $osDetalleCompra = new Structure_DetalleCompra;

                $osDetalleCompra->idCompra->SetValue($idCompra);
                $osDetalleCompra->idProducto->SetValue($idProducto);
                $osDetalleCompra->cantidad->SetValue($cantidad);
                $osDetalleCompra->precioCompra->SetValue($precio_compra);

                $detalle = $oRN_DetalleCompra->Save($osDetalleCompra);

                if($detalle == true)
                {
                    $oRN_Inventario = new RN_Inventario;
                    $osInventario = new Structure_Inventario;

                    $osInventario->idAlmacen->SetValue($idAlmacen);
                    $osInventario->idProducto->SetValue($idProducto);
                    $osInventario->Stock->SetValue($cantidad);
                    $osInventario->estado->SetValue('Activo');

                    $resultado = $oRN_Inventario->Verifcar($osInventario);

                    if($resultado != false)
                    {
                        //si es diferente de falso se hace update a stock en inventario
                        $osInventario->idAlmacen->SetValue($idAlmacen);
                        $osInventario->idProducto->SetValue($idProducto);
                        $osInventario->Stock->SetValue($cantidad + $resultado);// sumando
                        $osInventario->estado->SetValue('Activo');
                        $actualizar = $oRN_Inventario->Update($osInventario);
                    }
                    else
                    {
                        //si es igual a falso se inserta
                        $insertar = $oRN_Inventario->Save($osInventario);
                        $messages[] = "Se guardo con exito";
                    }
                
                }
                else
                {
                    $errors[]= "No se puedo guardar el detalle";
                }
            }

        }
        else
        {
            $errors[]= "Al menos debe de ingresar un producto al detalle";
        }


    }
    else
    {
        $errors[]= "Al menos debe de ingresar un producto al detalle";
    }
    if (isset($errors))
    {	
        ?>
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Error!</strong> 
                <?php
                
                foreach ($errors as $error) 
                {
                    echo $error;
                }
                DeleteListItems();
                ?>
        </div>
        <?php
    }
    if (isset($messages))
    {
            
    ?>
    <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Bien hecho!</strong>
            <?php
                foreach ($messages as $message) {
                        echo $message;
                    }
                ?>
    </div>
    <?php
    }
       
}

?>