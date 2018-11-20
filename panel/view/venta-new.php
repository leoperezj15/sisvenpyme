<?php
if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}
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

    // echo "<pre>";
    // print_r($_SESSION["ClienteVenta"]);
    // echo "</pre>";

    
}



?>

    <div class="container">
        <h1>Venta de Productos</h1>
        <div class="row">
            <div class="form-group">
                <a href="?mnu=menu"><input type="button" value="Regresar a Menu" class="btn btn-success"></a>
                <br>
                <label for="">Buscar al ccliente</label>
                <input type="text" id="nroDocumento" name="nroDocumento" class="form-control" placeholder="Busque Ci o Nit" required>
                <input type="button" class="btn btn-primary" value="Buscar Cliente" id="btnbuscarCliente">
                <section id="tabla_resultados">
                
                </section>
            </div>
            <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <h2>Buscar Cliente</h2>
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Nro Documento</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Celular </th>
                                <th scope="col">Tipo de Cliente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><?php echo $idCliente; ?></th>
                                <th><?php echo $nombreCompleto; ?></th>
                                <th><?php echo $nroDocumento; ?></th>
                                <th><?php echo $direccion; ?></th>
                                <th><?php echo $celular; ?></th>
                                <th><?php echo $tipoCliente; ?></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
        <div class="row">
            <div class="col-sm-12"></div>
                <div id="VentasNew"></div>
                <div id="VentasHechas"></div>
        </div>
    </div>
