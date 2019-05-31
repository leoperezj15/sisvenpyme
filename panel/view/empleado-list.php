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
                <form action='' method='POST'>
                    <td scope='row'><input type='hidden' name='txtidEmpleado' value='".$listado->idEmpleado->getValue()."'>".$listado->idEmpleado->getValue()."</td>
                    <td>
                        <input type='hidden' name='txtnombre' value='".$listado->nombre->getValue()."'>". $listado->nombre->getValue()."
                        <input type='hidden' name='txtapPaterno' value='".$listado->apPaterno->getValue()."'>". $listado->apPaterno->getValue() ."
                        <input type='hidden' name='txtapMaterno' value='".$listado->apMaterno->getValue()."'>". $listado->apMaterno->getValue() ."
                    </td>
                    <td><input type='hidden' name='txtfechaNacimiento' value='".$listado->fechaNacimiento->getValue()."'>".$listado->fechaNacimiento->getValue()."</td>
                    <td><input type='hidden' name='txtci' value='".$listado->ci->getValue()."'>".$listado->ci->getValue()."</td>
                    <td>
                    <button type='Submit' name='accion' value='Selecionar' class='btn btn-sm btn-info' data-toggle='modal' data-target='#exampleModal'>
                        <i class='fas fa-user-tag'></i>
                    </button>
                    <button type='Submit' onclick='return Confirmar(Deseas Eliminar el dato?);' name='accion' value='Eliminar' class='btn btn-sm btn-danger'>
                        <i class='fas fa-user-minus'></i>
                    </button>
                    </td>
                </form>
            </tr>
        
        ";
        
    }
    $LitarEmpleados .="";
    //header('Location: ../view/empleado-list.php');

    // print_r($_POST);
    // echo "<br>";
    // echo $_POST['txtidEmpleado'];
    // echo "<br>";
    // echo $_POST['txtnombre'];
    // echo "<br>";
    // echo $_POST['txtapPaterno'];
    // echo "<br>";
    // echo $_POST['txtapMaterno'];
    // echo "<br>";
    // echo $_POST['txtfechaNacimiento'];
    // echo "<br>";
    // echo $_POST['txtci'];
    // echo "<br>";
    // echo $_POST['accion'];
    // echo "<br>";

    $txtidEmpleado = (isset($_POST['txtidEmpleado'])) ? $_POST['txtidEmpleado']:"";
    $txtnombre = (isset($_POST['txtnombre'])) ? $_POST['txtnombre']:"";
    $txtapPaterno = (isset($_POST['txtapPaterno'])) ? $_POST['txtapPaterno']:"";
    $txtapMaterno = (isset($_POST['txtapMaterno'])) ? $_POST['txtapMaterno']:"";
    $txtifechaNacimiento = (isset($_POST['txtfechaNacimiento'])) ? $_POST['txtfechaNacimiento']:"";
    $txtci = (isset($_POST['txtci'])) ? $_POST['txtci']:"";
    $accion = (isset($_POST['accion'])) ? $_POST['accion']:"";

    $accionAgregar = "";
    $accionModificar=$accionEliminar=$accioncancelar="disabled";
    $mostrarModal=false;

    switch ($accion) {
        case 'btnAgregar':
            echo "Presionaste btnAgregar ";
            break;
        case 'btnActualizar':
            # code...
            break;
        case 'btnEliminar':
            # code...
            break;
        case 'btnCancelar':
            # code...
            break;
        case 'Selecionar':
            $accionAgregar = "disabled";
            $accionModificar=$accionEliminar=$accioncancelar="";
            //header("location:../index.php?mnu=c-empleado-list");
            break;
        
        default:
            # code...
            break;
    }



?>
<!-- <div class="jumbotron"> -->
    <div class="container">
        <form action="" method="post"> <!-- Opcional para recivir foto se debe de agregar ectypy="multipart" -->
            <!-- (label{lbl$}+input[name="txt$" placeholder="" id="txt$" require]+br)*6   //ojo para crear label + input y br de forma mas rapida-->
            <!-- Aqui incorporamos el modal para ingresar,actualizar y eliminar usuario -->
            <!-- Button trigger modal -->
            
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
                                <input type="text" class="form-control" name="nombre" placeholder="" id="nombre" require="" value="<?php echo $txtnombre;?>" required>
                                </div><br>
                                

                                <div class="form-group col-md-6">
                                <label for="">Apellido Paterno</label>
                                <input type="text" class="form-control" name="apPaterno" placeholder="" id="apPaterno" value="<?php echo $txtapPaterno;?>" require="" required>
                                </div>
                                

                                <div class="form-group col-md-6">
                                <label for="">Apellido Materno</label>
                                <input type="text" class="form-control" name="apMaterno" placeholder="" id="apMaterno" value="<?php echo $txtapMaterno;?>" require="" required>
                                </div>
                                

                                <div class="form-group col-md-6">
                                <label for="">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" name="fechaNacimiento" placeholder="" id="fechaNacimiento" value="<?php echo $txtifechaNacimiento;?>" required>
                                </div>
                                

                                <div class="form-group col-md-4">
                                <label for="">Cedula de Identidad</label>
                                <input type="number" class="form-control" name="ci" min="1000000" max="9999999" placeholder="" id="ci" value="<?php echo $txtci;?>" require="" required>
                                </div>
                                
                            </div>
                            

                            <!-- (button[value="btn$" type="submit" name="accion"])*4  //para crear botones de forma rapida X 4-->
                            
                        </div>
                        <div class="modal-footer">
                            <button name="accion"class="btn btn-success" id="btn-empleado-add">Agregar</button>
                            <button value="btnActualizar"  type="submit" name="accion" class="btn btn-warning">Actualizar</button>
                            <button value="btnEliminar" type="submit" name="accion" class="btn btn-danger">Eliminar</button>
                            <button value="btnCancelar" type="submit" name="accion" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Aqui empiza en panel de navegacion total de RRHH -->
        <div class="shadow-lg p-3 mb-5 bg-white rounded">
            <div class="row">
                <div class="col-3">
                    <!-- Inicio botones comando para la navegacion -->
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Inicio</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Listado de Empleados</a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Listado de Usuarios</a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Asigancion de Usuarios</a>
                    </div>
                    <!-- fin bbotones comando para navegacion -->
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <h1>Contenido de Inicio</h1>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h1>Contenido de Listado de Empleados</h1>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Agregar Empleado
                            </button>
                            <div class="shadow-lg p-3 mb-5 bg-white rounded"><!--Cajon con sombrita-->
                                <div class="row">
                                    <!-- table>thead>tr>(th)*4 de forma rapida ayuda a crear una tabla que contenga un thead un tr y 4 th-->
                                    <div class="table-responsive table-sm">
                                        <table id="TablaDeEmpleados" class="table table-sm">
                                            <thead>
                                                
                                                <tr>
                                                    <th scope="col">Codigo</th>
                                                    <th scope="col">Nombre Completo</th>
                                                    <th scope="col">Fecha de Nacimiento</th>
                                                    <th scope="col">Cedula de Identidad</th>
                                                    <th scope="col">Operacion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                    <?php
                                                        echo $LitarEmpleados;     
                                                    ?>
                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <h1>Contenido de Listado de Usuarios</h1>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <h1>contenido de Asignacion de usuarios</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Aqui finaliza el panel de Navegacion total de RRHH -->
        
        <br>
        
<!-- </div> -->
<?php if($mostrarModal){?>
<script>
    $('#exampleModal').modal('show';)    
</script>
<script>
    function Confirmar(Mensaje)
    {
        return (confirm(Mensaje))?true:false;
    }
</script>
<?php }?>