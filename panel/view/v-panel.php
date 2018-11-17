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
<html>
<head>
	<meta http-equiv="content-type" content="text/html" charset="utf-8" />
	<meta name="author" content="Leonardo Perez" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<title>ACL - Panel</title>
    <link rel="icon" href="view/icon/favicon.ico">
    <!-- <link rel='stylesheet' type='text/css' href='view/css/main.css' /> -->
    <script src="view/plugin/jquery-2.0.3.min.js"></script>
    <!-- Bootstrap on line -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>     
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
<!--Aqui termina el menu de navegacion-->

<div class="card text-center"> <!--class="ctn-main"-->
    <div class="card-header">
        <div class="">
        <!-- <a href="?mnu=nuevo_modulo"><input type='button' value='Nuevo Modulo' class='btn btn-primary'></a> -->
    </div class="card-body">
        <!-- <h2 class="card-title">Listado de Modulo y Objetos</h2> -->
        <?php
            echo "<b>Rol - " . $rol . "<br>";
            //echo $content;
            echo "<br><b>Estructura Guardada en Sesión</b><br><br>";
            print_r($ACL); 
        ?>
        <br>
    </div>
</div>    
</body>
</html>