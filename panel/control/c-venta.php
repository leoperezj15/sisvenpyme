<?php

session_start();
require_once "../../model/RN_Cliente.php";
require_once "../../model/RN_Pedido.php";

$operacion = $_REQUEST['operacion'];
switch($operacion)
{
    case 'buscarCliente': buscarCliente();
    break;
    case 'AddProducto': buscarProducto();
    break;
}
echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";

function buscarCliente()
{
    $NroDocumento = $_REQUEST['nroDocumento'];
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
    $idProducto = $_REQUEST['idProducto'];
    $oRN_Producto = new RN_Producto;
    $oProducto = $oRN_Producto->GetProducto($idProducto);
    if($oProducto != null)
    {
        
    }
}
function crearPedido()
{
    $oRN_Pedido = new RN_Pedido;
    $osPedido = new Structure_Modulo;

    $osPedido->idPedido->SetValue(0);
    $osPedido->TotalPedido->SetValue("");
    $osPedido->estado->SetValue("RRHH");
    $osPedido->idtipoMovimiento->SetValue("Activo");
    $osPedido->realizado_por->SetValue("Activo");
    $osPedido->idCliente->SetValue("Activo");

    $respuesta = $oRN_Pedido->SavePedido($osPedido);
}




// require_once "../../model/RN_Cliente.php";

// $operacion = $_REQUEST['operacion'];

// switch ($operacion)
// {
//     case 'buscarCliente': buscarCliente();
//         break;
// }

// function buscarCliente()
// {
//     $ci = $_REQUEST['ci'];

// }






?>