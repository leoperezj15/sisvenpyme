<?php

/**
 * @author		Miguel Angel Macias Burgos
 * @company 	Blaufuß
 * @copyright 	2018
 */

if ( !isset($_SESSION["ACL"]) ){
    header("location: index.php");
}

$ACL = $_SESSION["ACL"];

$rol = $ACL["nombre"];
$listaModulos = $ACL["listaModulos"];

$content = "
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
        <td height='30'>Módulo</td>
        <td>Objetos</td>
    </tr>
    <tr><td colspan='2' style='height:2px; background:#2F509C'></td></tr>";
    
$i = 0;
foreach($listaModulos as $item){
    $i++;
    $modulo = $item["nombre"];
    $listaObjetos   = $item["listaObjetos"];
    
    $cad2 = "";
    
    if ($i > 1){
        $content .= "<tr><td colspan='2' style='height:2px; background:#ABD9F1'></td></tr>";
    }
    
    foreach($listaObjetos as $item2){
        $objeto = $item2["nombre"];
        if ($cad2 != "") $cad2 .= "<br>";
        $cad2 .= $objeto;
    }
    
    $content .= "
    <tr>
        <td>". $modulo ."</td>
        <td>". $cad2 ."</td>
    </tr>";
}

$content .= "</table>";
?>
<div class="container">
<form action="" method="post"> <!-- Opcional para recivir foto se debe de agregar ectypy="multipart" -->
            <!-- (label{lbl$}+input[name="txt$" placeholder="" id="txt$" require]+br)*6   //ojo para crear label + input y br de forma mas rapida-->
            <!-- Aqui incorporamos el modal para ingresar,actualizar y eliminar usuario -->
            <!-- Button trigger modal -->
            <h1>Listado de Modulos y Objetos</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Agregar Modulo
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registro de Nuevo Modulo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aqui ponemos los campus y botones del formulario -->
                        <div class="form-row"><!-- esta es una clase para form en modal-->

                            <div class="form-group col-md-6">
                            <label for="">Nombre Modulo</label>
                            <input type="text" class="form-control" name="nombre" placeholder="" id="nombre" require="" required>
                            </div><br>
                            
                        </div>
                        

                        <!-- (button[value="btn$" type="submit" name="accion"])*4  //para crear botones de forma rapida X 4-->
                        
                    </div>
                    <div class="modal-footer">
                        <button name="accion"class="btn btn-success" id="btn-empleado-add">Agregar</button>
                        <button value="btnActualizar" type="submit" name="accion" class="btn btn-warning">Actualizar</button>
                        <button value="btnEliminar" type="submit" name="accion" class="btn btn-danger">Eliminar</button>
                        <button value="btnCancelar" type="submit" name="accion" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                    </div>
                    </div>
                </div>
            </div>
            

        </form>
<div class="card text-center"> <!--class="ctn-main"-->
        <div class="card-header">
            <div class="">
                </div class="card-body">
                    <?php
                        echo "<b>Rol - " . $rol . "<br>";
                        echo $content;
                        //echo "<br><b>Estructura Guardada en Sesión</b><br><br>";
                        //print_r($ACL); 
                    ?>
                    <br>
                </div>
    </div>    
</div>
</div>