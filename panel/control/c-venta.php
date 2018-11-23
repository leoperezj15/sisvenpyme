<?php

session_start();
require_once "../../model/RN_Cliente.php";
require_once "../../model/RN_Pedido.php";
require_once "../../model/RN_ProductoGeneral.php";

$operacion = $_POST['operacion'];
switch($operacion)
{
    case 'buscarCliente': buscarCliente();
    break;
    case 'AddProducto': buscarProducto();
    break;
    case 'Cancelar': Cancelar();
    break;
    case 'Contabilizar': Contabilizar();
    break;
}


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
    $nombreAlmacen = $_POST['NombreAlmacen'];
    $cantidad = $_POST['cantidad'];

    $oRN_ProductoGeneral = new RN_ProductoGeneral;
    $oProducto = $oRN_ProductoGeneral->GetProductoForAlmacenAndCant($idProducto,$nombreAlmacen,$cantidad);
    if($oProducto != null)
    {
        $idProducto = $oProducto->idProducto->GetValue();
        $descripcion = $oProducto->descripcion->GetValue();
        $nombre = $oProducto->nombre->GetValue();
        $almacen = $oProducto->almacen->GetValue();
        $precio = $oProducto->precioVenta->GetValue();
        
        $_SESSION["DetalleVenta"][] = array(
            "idProducto" => $idProducto,
            "descripcion" => $descripcion,
            "nombre" => $nombre,
            "almacen" => $almacen,
            "precio" => $precio,
            "cantidad" => $cantidad
        );
        header("location:http://localhost:8081/acl/panel/index.php?mnu=c-venta-new");
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
    echo "<pre>";
        print_r($_POST);
        echo "</pre>";
}
function crearPedido()
{

    // $oRN_Pedido = new RN_Pedido;
    // $osPedido = new Structure_Modulo;

    // $osPedido->idPedido->SetValue(0);
    // $osPedido->TotalPedido->SetValue("");
    // $osPedido->estado->SetValue("RRHH");
    // $osPedido->idtipoMovimiento->SetValue("Activo");
    // $osPedido->realizado_por->SetValue("Activo");
    // $osPedido->idCliente->SetValue("Activo");

    // $respuesta = $oRN_Pedido->SavePedido($osPedido);
}


function Cancelar()
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