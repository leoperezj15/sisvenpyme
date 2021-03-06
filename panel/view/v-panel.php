<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 */

if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}

$ACL = $_SESSION["ACL"];

$rol = $ACL["nombre"];
$listaModulos = $ACL["listaModulos"];

$content = "

        
      ";
$i = 0;
foreach($listaModulos as $item){
    $i++; 
    $modulo = $item["nombre"];
    $listaObjetos   = $item["listaObjetos"];
    $cad2 = "";
    $content .= "
    <li class='nav-item dropdown'>
    <button id='btnGroupDrop1' type='button' class='btn btn-primary dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>". $modulo ."</button>
    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>";
    if ($i > 1){
        $content .= "";
    }
    foreach($listaObjetos as $item2)
    {   
        $objeto = $item2["nombre"];
        $nombreControl = $item2["nombreControl"];
        //if ($cad2 != "") $cad2 .= "";//quitando <br>
        $cad2 .= "<a class='dropdown-item' href='?mnu=". $nombreControl ."'>". $objeto ."</a>";
        
    }
    $content .= "".$cad2."";
}
$content .= "

</div>
</li>
";
?>
<html lang="es">
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<meta name="author" content="Leonardo Perez" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>ACL - Panel</title>
    <link rel="icon" href="view/icon/favicon.ico">
    <!-- <link rel='stylesheet' type='text/css' href='view/css/main.css'/>-->
    <script src="view/plugin/jquery-2.0.3.min.js"></script>
    <script src="view/plugin/subcategoriaBycategoria.js"></script>
    <script src="view/plugin/fechayhora.js"></script>
    <script src="view/js/ajax/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap on line -->
    <link rel="stylesheet" href="view/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="view/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="view/css/switch.css">
    <!-- <script src="view/js/jquery-3.3.1.slim.min.js"></script>-->
    <!--<script src="view/plugin/jquery-2.0.3.min.js"></script>-->
    
    <script>
        $(document).ready(function()
        {
             
            //ejecutar tabla de clientes            
            $('#TablaPrueba').DataTable();
            //adicionar empleado
            $("#btn-empleado-add").click(function()
            {
                
                nombre = $("#nombre").val();
                apPaterno = $("#apPaterno").val();
                apMaterno = $("#apMaterno").val();
                fechaNacimiento = $("#fechaNacimiento").val();
                ci = $("#ci").val();
                
                $.ajax({
            		type: "POST",
            		url: "control/x-fn.php",
            		data: "fn=Empleado-add&nombre=" + nombre  + "&apPaterno=" + apPaterno + "&apMaterno=" + apMaterno + "&fechaNacimiento=" + fechaNacimiento + "&ci=" + ci,
            		cache: false,
            		success: function (res){
                        
                        data = res.split("|");
                        
            			if (data[0] == "ok")
            			{          
                            alert(data[1]);
                            setTimeout("reloadPage()", 10);
            			}else{
                            alert(data[1]);
                            $("#nombre").focus();
            			}
            			
            		}
            	});
            })
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
            $(".btnEditar").click(function(){
                idCliente = $(this).attr("data-cliente");
                tipo      = $(this).attr("data-tipocliente");

                $.ajax({
                    type: "POST",
                    url : "control/c-cliente.php",
                    data: "operacion=editarCliente&idCliente="+ idCliente + "&tipoCliente=" + tipo,
                    success: function(res){
                        //alert(res);
                        data = res.split("|");
                        
                            $('#validationCustom00').val(data[1]);
                            $('#validationCustom01').val(data[2]);
                            $('#validationCustom02').val(data[3]);
                            $('#validationCustom03').val(data[4]);
                            $('#validationCustom04').val(data[5]);
                            $('#validationCustom05').val(data[6]);
                            $('#validationCustom06').val(data[7]);
                            $('#validationCustom07').val(data[8]);
                            $('#validationCustom08').val(data[9]);
                        if (data[0] == "Natural") {
                            $('#validationCustom00').val(data[1]);
                            $('#validationCustom01').val(data[2]);
                            $('#validationCustom02').val(data[3]);
                            $('#validationCustom03').val(data[4]);
                            $('#validationCustom04').val(data[5]);
                            $('#validationCustom05').val(data[6]);
                            $('#validationCustom06').val(data[7]);
                            $('#validationCustom07').val(data[8]);
                            $('#validationCustom08').val(data[9]);
                        }else{
                            $('#JvalidationCustom00').val(data[1]);
                            $('#JvalidationCustom01').val(data[2]);
                            $('#JvalidationCustom02').val(data[3]);
                            $('#JvalidationCustom03').val(data[4]);
                            $('#JvalidationCustom04').val(data[5]);
                            $('#JvalidationCustom05').val(data[6]);
                            $('#JvalidationCustom06').val(data[7]);
                        }
                    }   
                });
            })
            $(".btnEliminar").click(function(){
                idCliente = $(this).attr("data-cliente");
                
                $.ajax({
                    type: "POST",
                    url : "control/c-cliente.php",
                    data: "operacion=eliminarCliente&idCliente="+ idCliente,
                    success: function(res){
                        data = res.split("|");
                        alert(res);
                        if (data[0] == "ok")
            			{          
                            alert(data[1]);
                            setTimeout("reloadPage()", 1000);
            			}else{
                            alert(data[1]);
                            $("#nroDocumento").focus();
            			}
                    }
                })
            })
        })
        function reloadPage()
        {
            location.reload();
        }
        
        $(document).ready( function () 
        {
            $('#TabladeClientes').DataTable({
                "language": {
                    "Search" : "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado - lo siento",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)"
                }
            } );
        } );
        //aqui se añadio  reacion a la tabla de Empleados
        $(document).ready( function () 
        {
            $('#TablaDeEmpleados').DataTable({
                "language": {
                    "Search" : "Buscar",
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nada encontrado - lo siento",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)"
                }
            } );
        } );
                        
    </script>  
</head>

<body class="">
<!--Aqui va a empezar el menu de navegacion-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">SISVENPyME</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="?mnu=menu">Home <span class="sr-only">(current)</span></a>
      </li>
      <?php echo $content;?>
      <li class="nav-item">
        <a href='?mnu=logout'><input type='button' value='Cerrar Session' class='btn btn-success'></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Buscar en la pagina" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
    </form>
  </div>
</nav>
<div class="jumbotron">
<!--Aqui termina el menu de navegacion-->
<!-- <div class="widget">
    <div class="fecha">
      <p id="diaSemana" class="diaSemana"></p>
      <p id="dia" class="dia"></p>
      <p>de</p>
      <p id="mes" class="mes"></p>
      <p>del</p>
      <p id="anio" class="anio"></p>
    </div>
    <div class="reloj">
      <p id="horas" class="horas"></p>
      <p>:</p>
      <p id="minutos" class="minutos"></p>
      <p>:</p>
      <div class="cajaSegundos">
        <p id="ampm" class="ampm"></p>
        <p id="segundos" class="segundos"></p>
      </div>
    </div>
  </div> -->
