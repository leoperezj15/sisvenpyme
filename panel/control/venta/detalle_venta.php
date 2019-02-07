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
        case 'SaveVenta':
            ProcesarVenta();
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
    $descuento_porcentaje = $_POST['descuento'];
    $cantidad = $_POST['cantidad'];

    $lista = array();

    $existe = false;

    if( isset($_SESSION['listaVenta']))
    {
        $lista = $_SESSION['listaVenta'];

        for($i = 0; $i < count($lista); $i++)
        {
            if($lista[$i]['idproducto'] == $idproducto)
            {
                $existe = true;
                $lista[$i]['cantidad'] = $lista[$i]['cantidad'] + $cantidad;
            }
        }
    }
    $descuento_sub = 0;
    if($existe == false)
    {
        
        $item = array("idproducto" => $idproducto, 
        "nombre" => $nombre, 
        "codigo" => $codigo, 
        "descripcion" => $descripcion,
        "modelo" => $modelo,
        "cantidad" => $cantidad,
        "precio" => $precio,
        "descuento_porcentaje" => $descuento_porcentaje
    );

        $lista[] = $item;
    }

    $_SESSION['listaVenta'] = $lista;

    $contenido = "
    <table class='table table-resposible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descuento</th>
                <th>Sub total</th>
                <th>Quitar</th>

            </tr>

        </thead>

        <tbody>

    ";
    $c = 0;
    $total = 0;
    $total_descuento = 0;
    foreach($lista as $item)
    {
        $c++;
        $itemPrecio=$item['precio'];
        $itemCantidad=$item['cantidad'];
        $itemPorcentaje=$item['descuento_porcentaje'];

        if($itemPorcentaje=="SD")
        {
            $itemPorcentaje = 0.00;
        }

        $subTotal = $itemPrecio * $itemCantidad;

        $descontado = $subTotal * $itemPorcentaje;

        $subTotal = $subTotal - $descontado;

        $total += $subTotal;

        $total_descuento += $descontado;
        

        $contenido.= "
        
            <tr>
                <td>      ".$c."      </td>
                <td><strong>     ".$item['codigo']."      </strong></td>
                <td><strong>       ".$item['nombre']." ".$item['descripcion']." ".$item['modelo']."    </strong></td>
                <td>      ".$itemCantidad."      </td>
                <td>      ".number_format($itemPrecio,2)."      </td>
                <td>      ".number_format($descontado,2)."      </td>
                <td>      ".number_format($subTotal,2)."      </td>
                <td> <a href='#deleteProductoCompraModal' class='delete btn btn-primary' data-toggle='modal'
                data-idproducto=' ".$item['idproducto']."'><i class='far fa-trash-alt'></i></a></td>
            </tr>
            
        
        ";
        

    }
    $contenido.="
        <tr>
        <td class='text-right' colspan=6><strong>TOTAL Bs<strong></td>
        <td class=''><input type='hidden' name='venta_add_montototal' id='venta_add_montototal' value='".$total."'>".number_format($total,2)."</td>
        <td></td>
        </tr>

        <tr>
        <td class='text-right' colspan=6><strong>TOTAL Descuento Bs<strong></td>
        <td class=''><input type='hidden' name='venta_add_montototal_descuento' id='venta_add_montototal_descuento' value='".$total_descuento."'>".number_format($total_descuento,2)."</td>
        <td></td>
        </tr>
        
        ";
    $contenido.= "
        </tbody>
    </table>";
    
    echo $contenido;
}
function DeleteListItems()
{
    $_SESSION["listaVenta"] = null;
    $contenido = "
    <table class='table table-resposible small'>
        
        <thead class='table-dark'>

            <tr>

                <th>#</th>
                <th>Codigo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Descuento</th>
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
function ProcesarVenta()
{
    require_once ("../../../model/RN_Empleado.php");
    require_once ("../../../model/RN_Venta.php");
    require_once ("../../../model/RN_DetalleVenta.php");
    require_once ("../../../model/RN_Inventario.php");
    
    // echo "<pre>";
    // print_r($_POST);
    // echo "<pre>";
    date_default_timezone_set('America/La_Paz');

    $fechaVenta= date("Y-m-d h:i:s");
    $idcliente = $_POST["venta_add_idcliente"];
    $usuarioActivo = $_SESSION['USUARIO_ACTIVO'];
    $idEmpleado = $usuarioActivo['idEmpleado'];
    $MontoTotal = $_POST['venta_add_montototal'];
    $idAlmacen = $_POST['venta_add_almacen'];
    $MontoTotal_descuento = $_POST['venta_add_montototal_descuento'];
    
    if($MontoTotal!="")
    {
        $oRN_Venta = new RN_Venta;
        $osVenta = new Structure_Venta;
        

        $osVenta->idVenta->SetValue(0);
        $osVenta->idCliente->SetValue($idcliente);
        $osVenta->fechayHora->SetValue($fechaVenta);
        $osVenta->MontoTotal->SetValue($MontoTotal);
        $osVenta->MontoDescuento->SetValue($MontoTotal_descuento);
        $osVenta->idEmpleado->SetValue($idEmpleado);
        $osVenta->estado->SetValue('Facturado');
        $osVenta->idAlmacenVenta->SetValue($idAlmacen);
        // echo "<pre>";
        // print_r($osVenta);
        // echo "</pre>";

        $idVenta = $oRN_Venta->Save($osVenta);

        // echo "<pre>";
        // print_r("Rec IDVENTA: ".$idVenta);
        // echo "</pre>";

        if (isset($_SESSION["listaVenta"]))
        {
            $listaVenta = $_SESSION["listaVenta"];
            $contador = 0;
            
            foreach($listaVenta as $item)
            {
                $idProducto = $item["idproducto"];
                $cantidad = $item["cantidad"];
                $precio = $item["precio"];
                $descuento_porcentaje = $item["descuento_porcentaje"];

                if($descuento_porcentaje == "SD")
                {
                    $descuento_porcentaje = 0.00;
                }
                $oRN_DetalleVenta = new RN_DetalleVenta;
                $osDetalleVenta = new Structure_DetalleVenta;

                $osDetalleVenta->idProducto->SetValue($idProducto);
                $osDetalleVenta->idVenta->SetValue($idVenta);
                $osDetalleVenta->cantidad->SetValue($cantidad);
                $osDetalleVenta->precio->SetValue($precio);
                $osDetalleVenta->descuento->SetValue(0.00);
                $osDetalleVenta->descuento_porcentaje->SetValue($descuento_porcentaje);

                // echo "<pre>";
                // print_r($osDetalleVenta);
                // echo "</pre>";
                $detalle = $oRN_DetalleVenta->Save($osDetalleVenta);

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
                        $osInventario->Stock->SetValue($resultado - $cantidad);// restando
                        $osInventario->estado->SetValue('Activo');

                        $actualizar = $oRN_Inventario->Update($osInventario);
                        if($actualizar)
                        {
                            $messages[] = "Venta exitosa! Su # de Venta es: ".$idVenta;
                            DeleteListItems();
                        }
                    }
                    else
                    {
                        //si es igual a falso se inserta
                        $errors[] = "El producto ".$idProducto." no se puede vender por falta de Stock";
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