<?php
if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}   
    //printr($_POST);
    $LitarEmpleados = "";
    foreach($listarEmpleados as $listado)
    {
        $LitarEmpleados .= "
            <tr>
                <td scope='row'>".$listado->idEmpleado->getValue()."</td>
                <td>".$listado->nombre->getValue()."</td>
                <td>".$listado->apPaterno->getValue()."</td>
                <td>".$listado->apMaterno->getValue()."</td>
                <td>".$listado->fechaNacimiento->getValue()."</td>
                <td>".$listado->ci->getValue()."</td>
            </tr>
        
        ";
    }
    $LitarEmpleados .="";
?>
<!-- <div class="jumbotron"> -->
    <div class="container">
        <form action="" method="post"> <!-- Opcional para recivir foto se debe de agregar ectypy="multipart" -->
            <!-- (label{lbl$}+input[name="txt$" placeholder="" id="txt$" require]+br)*6   //ojo para crear label + input y br de forma mas rapida-->
            <!-- Aqui incorporamos el modal para ingresar,actualizar y eliminar usuario -->
            <!-- Button trigger modal -->
            <h1>Lista de Empleados</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Agregar Empleado
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registro de Nuevo Empleado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Aqui ponemos los campus y botones del formulario -->
                        <div class="form-row"><!-- esta es una clase para form en modal-->

                            <div class="form-group col-md-6">
                            <label for="">Nombre(s)</label>
                            <input type="text" class="form-control" name="nombre" placeholder="" id="nombre" require="" required>
                            </div><br>
                            

                            <div class="form-group col-md-6">
                            <label for="">Apellido Paterno</label>
                            <input type="text" class="form-control" name="apPaterno" placeholder="" id="apPaterno" require="" required>
                            </div>
                            

                            <div class="form-group col-md-6">
                            <label for="">Apellido Materno</label>
                            <input type="text" class="form-control" name="apMaterno" placeholder="" id="apMaterno" require="" required>
                            </div>
                            

                            <div class="form-group col-md-6">
                            <label for="">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimiento" placeholder="" id="fechaNacimiento" require="" required>
                            </div>
                            

                            <div class="form-group col-md-4">
                            <label for="">Cedula de Identidad</label>
                            <input type="number" class="form-control" name="ci" placeholder="" id="ci" require="" required>
                            </div>
                            
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
        <br>
        <div class="shadow-lg p-3 mb-5 bg-white rounded"><!--Cajon con sombrita-->
            <div class="row">
                <!-- table>thead>tr>(th)*4 de forma rapida ayuda a crear una tabla que contenga un thead un tr y 4 th-->
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre(s)</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Cedula de Identidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    echo $LitarEmpleados;     
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
            </div>
        </div>
<!-- </div> -->