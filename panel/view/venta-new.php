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
    $idCliente = $_SESSION["ClienteVenta"]->idCliente;
    $nombreCompleto = $_SESSION["ClienteVenta"]->nombreCompleto;
    $nroDocumento = $_SESSION["ClienteVenta"]->nroDocumento;
    $direccion = $_SESSION["ClienteVenta"]->direccion;
    $celular = $_SESSION["ClienteVenta"]->celular;
    $tipoCliente = $_SESSION["ClienteVenta"]->tipoCliente;

    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="view/plugin/jquery-2.0.3.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <title>Realizar NUeva Venta</title>
    <script>
        $(document).ready(function()
        {
            $("#btnbuscarCliente").click(function()
            {
                
                nroDocumento = $("#nroDocumento").val();
                
                $.ajax({
            		type: "POST",
            		url: "control/x-fn.php",
            		data: "fn=buscarCliente&nroDocumento=" + nroDocumento ,
            		cache: false,
            		success: function (res){
                        
                        data = res.split("|");
                        
            			if (data[0] == "ok")
            			{          
                            alert(data[1]);
                            setTimeout("reloadPage()", 1000);
            			}else{
                            alert(data[1]);
                            $("#nroDocumento").focus();
            			}
            			
            		}
            	});
            })
        })
        function reloadPage()
        {
            location.reload();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="row">

            <div class="form-group">
                <a href="?mnu=menu"><input type="button" value="Regresar a Menu" class="btn btn-success"></a>
                <br>
                <label for="">Buscar Cliente</label>
                <input type="text" id="nroDocumento" class="form-control">
                <input type="button" class="btn btn-primary" value="Buscar Cliente" id="btnbuscarCliente">
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
    </div>
</body>
</html>