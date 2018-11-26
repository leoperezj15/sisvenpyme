<?php

session_start();
require_once "../../model/RN_Cliente.php";
require_once "../../model/RN_Pedido.php";
require_once "../../model/RN_ProductoGeneral.php";
require_once "../../model/RN_ProductoAlmacen.php";

$operacion = $_POST['operacion'];
switch($operacion)
{
    case 'buscarCliente': buscarCliente();
    break;
    case 'AddProducto': buscarProducto();
    break;
    case 'Cancelar': CancelarVenta();
    break;
    case 'Contabilizar': crearPedido();

    break;
}
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

function buscarCliente()
{
    $NroDocumento = $_POST['nroDocumento'];
    $oRN_Cliente = new RN_Cliente;
    $oCliente = $oRN_Cliente->GetCliente($NroDocumento);
    if($oCliente != null)
    {
        $idCliente = $oCliente->idCliente->getValue();
        $nombreCompleto = $oCliente->nombreCompleto->GetValue();
        $nroDocumento = $oCliente->nroDocumento->GetValue();
        $direccion = $oCliente->direccion->GetValue();
        $celular = $oCliente->celular->GetValue();
        $tipoCliente = $oCliente->tipoCliente->GetValue();

        $_SESSION["ClienteVenta"] = array(
            "idCliente" => $idCliente,
            "nombreCompleto" => $nombreCompleto,
            "nroDocumento" => $nroDocumento,
            "direccion" => $direccion,
            "celular" => $celular,
            "tipocliente" => $tipoCliente
        );
        header("location:http://localhost:8081/acl/panel/index.php?mnu=c-venta-new");
    }
    else
    {
        echo "No se encontro coincidencia";
    }
}

function buscarProducto()
{
    $idProducto = $_POST['idProducto'];
    $idAlmacen = $_POST['idAlmacen'];
    $cantidad = $_POST['cantidad'];

    $oRN_ProductoGeneral = new RN_ProductoGeneral;
    $oProducto = $oRN_ProductoGeneral->GetProductoForAlmacenAndCant($idProducto,$idAlmacen,$cantidad);
    if($oProducto != null)
    {
        $idProducto = $oProducto->idProducto->GetValue();
        $descripcion = $oProducto->descripcion->GetValue();
        $nombre = $oProducto->nombre->GetValue();
        $idAlmacen = $oProducto->idAlmacen->GetValue();
        $precio = $oProducto->precioVenta->GetValue();
        
        $_SESSION["DetalleVenta"][] = array(
            "idProducto" => $idProducto,
            "descripcion" => $descripcion,
            "nombre" => $nombre,
            "idAlmacen" => $idAlmacen,
            "precio" => $precio,
            "cantidad" => $cantidad
        );
        header("location:http://localhost:8081/acl/panel/index.php?mnu=c-venta-new");
        // echo "<pre>";
        // print_r($_POST);
        // print_r($_SESSION["DetalleVenta"]);
        // echo "</pre>";
    }
    else
    {
        header("location:http://localhost:8081/acl/panel/index.php?mnu=c-venta-new");
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Holy guacamole!</strong> You should check in on some of those fields below.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>";
    }
}
function Contabilizar()
{
    
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}
function crearPedido()
{
    //cargar datos para  nuevo pedido
    //idPedio, TotalPedido, estado, idtipoMovimiento, realizado_por, idCliente
    $totalVenta = $_POST['totalVenta'];
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    if (isset($_SESSION["ClienteVenta"])) 
    {
        $Cliente = $_SESSION["ClienteVenta"];
        $idCliente = $Cliente["idCliente"];
        if (isset($_SESSION["USUARIO_ACTIVO"])) 
        {
            $Usuario = $_SESSION["USUARIO_ACTIVO"];
            $idUsuario = $Usuario["idUsuario"];

            $oRN_Pedido = new RN_Pedido;
            $osPedido = new Structure_Pedido;

            $osPedido->idPedido->SetValue(0);
            $osPedido->TotalPedido->SetValue("");
            $osPedido->estado->SetValue("Activo");
            $osPedido->idtipoMovimiento->SetValue(1);//tipo movimiento 1 Venta
            $osPedido->realizado_por->SetValue($idUsuario);
            $osPedido->idCliente->SetValue("$idCliente");

            $idPedido = $oRN_Pedido->SavePedido($osPedido);
            
            if (isset($_SESSION["DetalleVenta"])) 
            {
                $detalleVenta = $_SESSION["DetalleVenta"];
                $contador = 0;
                foreach($detalleVenta as $dv)
                {
                    //aqui agregar los datos de producto almacen conosido como detalle venta
                    //los datos son idProducto,idAlmacen,cantidad,idPedido,fechaMovimiento,estado
                    $idProducto = $dv["idProducto"];
                    $idAlmacen = $dv["idAlmacen"];
                    $cantidad = $dv["cantidad"];
                    $fecha = date("Y/M/d H:i:s");

                    $oRN_ProductoAlmacen = new RN_ProductoAlmacen;
                    $osProductoAlmacen = new Structure_ProductoAlmacen;
                    
                    $contador++;
                    $osProductoAlmacen->idProductoAlmacen->SetValue(0);
                    $osProductoAlmacen->idProducto->SetValue($idProducto);
                    $osProductoAlmacen->idAlmacen->SetValue($idAlmacen); //corregir botal el codigo de almacen
                    $osProductoAlmacen->idPedido->SetValue($idPedido);
                    $osProductoAlmacen->fechaMovimiento->SetValue($fecha);
                    $osProductoAlmacen->cantidad->SetValue($cantidad);
                    $osProductoAlmacen->estado->SetValue('Activo');//diferentes estados
                    // echo "<pre>";
                    // print_r($osProductoAlmacen);
                    // echo "</pre>";
                    $resp = $oRN_ProductoAlmacen->SaveProductoAlmacen($osProductoAlmacen);
                    //Actualizando el valor total del pedido
                }
                
                $oRN_Pedido2 = new RN_Pedido;
                $osPedido2 = new Structure_Pedido;
                $osPedido2->idPedido->SetValue($idPedido);
                $osPedido2->TotalPedido->SetValue($totalVenta);
                $actualizarTotalPedido = $oRN_Pedido2->UpdatePedido($osPedido2);
                // echo "<pre>";
                //     print_r($osPedido2);
                //     echo "</pre>";
            }
            
            
        }
        CancelarVenta();

    }
    else
    {
        echo "Selecione un cliente";
    }
    
}


function CancelarVenta()
{
    $_SESSION["ClienteVenta"] = null;
    $_SESSION["DetalleVenta"] = null;
    header("location:http://localhost:8081/acl/panel/index.php?mnu=c-venta-new");
}
function crearDetalleVenta()
{

}
function actualizarPedido()
{

}


?>