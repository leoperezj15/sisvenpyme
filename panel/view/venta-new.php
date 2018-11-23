<?php
//--Verificaion de que el usuarioeste logUp
if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}
//--------------------------------------------------------------------------------------------------------------------------------------------
//Definimos que esto es una venta con la variable local con el idTipoPedido
$idTipoPedido = 1;
//idTipoPedido=1,Nombre="Venta",descripcion="Realizar Venta Nueva", estado="Activo";
//----------------------------------------------------------------------------------------------------------------------------------------------
//Verificacion de la fecha del sistema
//------------------------------------------------------------------------------------------------------------------------------------------------
$fechaHoy = getdate();
$dia = $fechaHoy['mday'];
$mes = $fechaHoy['mon'];
$anio = $fechaHoy['year'];

$hora = $fechaHoy['hours'];
$minuto = $fechaHoy['minutes'];

$diaDeSemana = $fechaHoy['weekday'];
$mesliteral = $fechaHoy['month'];

$fechaTotalgeneral = "".$dia."/".$mes."/".$anio."";
$fechaTotalliteral = "".$diaDeSemana." ".$dia." ".$mesliteral." de ".$anio."";
$fechaTotalNumeria = $fechaHoy['0'];
//----------------------------------------------------------------------------------------------------------------------
//Verificacion de que el cliente exista

if (isset($_SESSION["ClienteVenta"]))
{
    $ClienteVenta = $_SESSION["ClienteVenta"];
   
    $idCliente = $ClienteVenta["idCliente"];
    $nombreCompleto = $ClienteVenta["nombreCompleto"];
    $nroDocumento = $ClienteVenta["nroDocumento"];
    $direccion = $ClienteVenta["direccion"];
    $celular = $ClienteVenta["celular"];
    $tipoCliente = $ClienteVenta["tipocliente"];

}
else
{
    $idCliente = "";
    $nombreCompleto = "";
    $nroDocumento = "";
    $direccion = "";
    $celular = "";
    $tipoCliente = "";
}
//-------------------------------------------------------------------------------------------------------------------------------
// incuimos el producto para abrir los productos
require_once "../model/RN_Producto.php";

$oRN_Producto = new RN_Producto;

$lista = $oRN_Producto->GetListProducto();

$mostrarProducto = "<option selected>Elija un producto:</option>";
if($lista != null)
{
    foreach($lista as $item)
    {
        
        $idProducto = $item->idProducto->getValue();
        $hash = $item->hash->getValue();
        $nombre = $item->nombre->getValue();
        $descripcion = $item->descripcion->getValue();
        $stock = $item->stock->getValue();
        $ListarProducto[] = array(
            "idProducto" => $idProducto,
            "hash" => $hash,
            "nombre" => $nombre,
            "descripcion" => $descripcion,
            "stock" => $stock
        );
        $mostrarProducto .="<option value=".$idProducto.">".$idProducto." ".$nombre." ".$descripcion."</option>";

        
    }
    
}
$mostrarProducto .="";
//----------------------------------------------------------------------------------------------------------------------
//Validacion del detalle de venta
$almacen = "";
$producto = "";
$cantidad = 0;
$precio = 0;

if (isset($_SESSION["DetalleVenta"]))
{
    // $ClienteVenta = $_SESSION["ClienteVenta"];
   
    // $idCliente = $ClienteVenta["idCliente"];
    // $nombreCompleto = $ClienteVenta["nombreCompleto"];
    // $nroDocumento = $ClienteVenta["nroDocumento"];
    // $direccion = $ClienteVenta["direccion"];
    // $celular = $ClienteVenta["celular"];
    // $tipoCliente = $ClienteVenta["tipocliente"];

}
//----------------------------------------------------------------------------------------------------------------------
require_once "../model/RN_Almacen.php";

$oRN_Almacen = new RN_Almacen;

$listaAlmacen = $oRN_Almacen->GetAlmacenList();

$mostrarAlmacen = "<option disabled selected required>Elija Almacen:</option>";

if($listaAlmacen != null)
{
    foreach($listaAlmacen as $item)
    {
        $idAlmacen = $item->idAlmacen->getValue();
        $nombre = $item->nombre->getValue();
        $abrev = $item->abrev->getValue();
        $Sucursal = $item->Sucursal->nombre->getValue();

        $ListarAlamcen[] = array(
            "idAlmacen" => $idAlmacen,
            "nombre" => $nombre,
            "abrev" => $abrev,
            "Sucursal" => $Sucursal
        );
        $mostrarAlmacen .="<option value=".$idAlmacen.">".$nombre." ".$abrev." Sucursal: ".$Sucursal."</option>";

        
    }
    
}
$mostrarAlmacen .="";
//----------------------------------------------------------------------------------------------------------------------
//Prueba para ver el array de productos
    // echo "<pre>";
    // print_r($ListarProducto);
    // echo "</pre>";
//fin de mostrar el producto en un select
//------------------------------------------------------------------------------------------------------------------------
//Validar que se aya selecionado un cliente
//Validar que al menos se seleciones un producto
//Validar verificar el stock de prodectos




//--------------mostar el cliente

?>
<div class="jumbotron">
    <div class="container">
        <h4>Venta de Productos</h4>
        <hr class="my-2">
        <!-- Primer Row -->
        <div class="row">
            <form action="control/c-venta.php" method="post" >
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Fecha y hora:</span>
                </div>
                <input type="text" class="form-control list-group-item list-group-item-secondary" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $fechaTotalliteral;?>" disabled>
            </div>
            <div class="col">
                <input type="text"  name="nroDocumento" class="form-control form-control-sm" placeholder="Busque Ci o Nit" required><!--id="nroDocumento"-->
            </div>
            <div class="col">
                <input type="submit" name="operacion" value="buscarCliente" class="btn btn-primary"><!--id="btnbuscarCliente" -->
            </div>
            </form>
        </div>
        <!-- Finalizacion del primer Row -->
        <!-- Empieza row 2 -->
            <div class="row">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Nro Documento</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Celular </th>
                                <th scope="col">Tipo de Cliente</th>
                                <th scope="col">Operacion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $idCliente; ?></th>
                                <td><?php echo $nombreCompleto; ?></th>
                                <td><?php echo $nroDocumento; ?></th>
                                <td><?php echo $direccion; ?></th>
                                <td><?php echo $celular; ?></th>
                                <td><?php echo $tipoCliente; ?></th>
                                <td><a href="#" class="btn btn-danger">Quitar</a></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Aqui empieza otro formulario anadir producto con cantidad-->
        <form action="control/c-venta.php" method="post">
        <div class="row">
            <div class="col">
                <select name="idAlmacen" id="" class="form-control form-control-sm">
                    <?php echo $mostrarAlmacen;?>
                </select>
            </div>
            <div class="col">
                <select name="idProducto" id="" class="form-control form-control-sm">
                    <?php echo $mostrarProducto;?>
                </select>
            </div>
            <div class="col">
                <input type="text" name="cantidad" class="form-control form-control-sm" placeholder="Cantidad del Producto" required>
            </div>
            <div class="col">
                <input type="submit" name="operacion" value="AddProducto" class="btn btn-warning" >
            </div>
        </div>
        </form>
        <!-- Acaba formulario -->
        <hr class="my-2">
        <div class="row">
            <div class="col-sm-9">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Detalle de Venta</h5>
                    <p class="card-text">Adicione o quite productos.</p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Almacen</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php echo "Aqui van los datos del detalle";?>
                                    <td><?php echo $almacen; ?></td>
                                    <td><?php echo $producto; ?></td>
                                    <td><?php echo $cantidad; ?></td>
                                    <td><?php echo $precio; ?></td>
                                    <td><?php echo $precio * $cantidad; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Botones de Acciones</h5>
                        <p class="card-text"></p>
                        <a href="#" class="btn btn-info">Verificar</a>
                        <hr class="my-2">
                        <a href="#" class="btn btn-success">Contabilizar</a>
                        <hr class="my-2">
                        <a href="#" class="btn btn-danger">Cancelar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
?>
