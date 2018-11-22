<?php
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
//Prueba para ver el array de productos
    // echo "<pre>";
    // print_r($ListarProducto);
    // echo "</pre>";
//fin de mostrar el producto en un select
//------------------------------------------------------------------------------------------------------------------------
//Validar que se aya selecionado un cliente
//Validar que al menos se seleciones un producto
//Validar verificar el stock de prodectos
if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}

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


$idCliente = "";
$nombreCompleto = "";
$nroDocumento = "";
$direccion = "";
$celular = "";
$tipoCliente = "";
if (isset($_SESSION["ClienteVenta"]))
{
    $ClienteVenta = $_SESSION["ClienteVenta"];
   
    $idCliente = $ClienteVenta["idCliente"];
    $nombreCompleto = $ClienteVenta["nombreCompleto"];
    $nroDocumento = $ClienteVenta["nroDocumento"];
    $direccion = $ClienteVenta["direccion"];
    $celular = $ClienteVenta["celular"];
    $tipoCliente = $ClienteVenta["tipoCliente"];

}
?>
<div class="jumbotron">
    <div class="container">
        <h4>Venta de Productos</h4>
        <hr class="my-2">
        <div class="row">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon3">Fecha y hora:</span>
                </div>
                <input type="text" class="form-control list-group-item list-group-item-secondary" id="basic-url" aria-describedby="basic-addon3" value="<?php echo $fechaTotalliteral;?>" disabled>
            </div>
            <div class="col">
                <h6>Buscar Cliente:</h6>
                <input type="text" id="nroDocumento" name="nroDocumento" class="form-control" placeholder="Busque Ci o Nit" required>
            </div>
            <div class="col">
                <h6>...</h6>
                <input type="button" class="btn btn-primary" value="Buscar Cliente" id="btnbuscarCliente">
            </div>           
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
        <div class="row">
            <div class="col">
                <select name="" id="" class="form-control form-control-sm">
                    <?php echo $mostrarProducto;?>
                </select>
            </div>
            <div class="col">
                <input type="button" class="btn btn-warning" value="Add Producto" id="btnbuscarProducto">
            </div>
        </div>
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
                                    <th scope="col">Nro</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Almacen</th>
                                    <th scope="col">Operacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php echo "Aqui van los datos del detalle";?>
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
