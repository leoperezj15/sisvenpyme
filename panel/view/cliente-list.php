<?php
//$listarCliente;
if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}
// Listar El cliente
// $tipoClienteN = "";
// $mostrarPila = false;
// if(isset($_SESSION["UpdateCliente"]))
// {
//     $UpdateCliente = $_SESSION["UpdateCliente"];

//     $tipoCliente = $UpdateCliente['tipoCliente']?$UpdateCliente['tipoCliente']:"";
//     if($tipoCliente == 'Natural')
//     {
//         $idCliente = $UpdateCliente['idCliente'];
//         $nombre = $UpdateCliente['nombre'];
//         $apPaterno = $UpdateCliente['apPaterno'];
//         $apMaterno = $UpdateCliente['apMaterno'];
//         $fechanacimiento = $UpdateCliente['fechanacimiento'];
//         $ci = $UpdateCliente['ci'];
//         $direccion = $UpdateCliente['direccion'];
//         $telefonoFijo = $UpdateCliente['telefonoFijo'];
//         $telefonoCelular = $UpdateCliente['telefonoCelular'];
//         //$mostrarPila = true;
//     }
//     else
//     {
//         $idCliente = $UpdateCliente['idCliente'];
//         $razonSocial = $UpdateCliente['razonSocial'];
//         $rptelegal = $UpdateCliente['rpteLegal'];
//         $nit = $UpdateCliente['nit'];
//         $direccion = $UpdateCliente['direccion'];
//         $telefonoFijo = $UpdateCliente['telefonoFijo'];
//         $telefonoCelular = $UpdateCliente['telefonoCelular'];

//     }
// }
// else
// {
//     $_SESSION["UpdateCliente"] = array();
// }



$ListarClientesGeneral = "";
foreach ($listarClientes as $item) 
{
    $ListarClientesGeneral .= "
        <tr class='small'>
            <!--<form action='control/c-cliente.php' method='post'>-->
            <th scope='row'><input type='hidden' name='idCliente' value='" .$item->idCliente->GetValue(). "'>" .$item->idCliente->GetValue(). "</td>
            <td>" .$item->nombreCompleto->GetValue(). "</td>
            <td>" .$item->nroDocumento->GetValue(). "</td>
            <td>" .$item->direccion->GetValue(). "</td>
            <td>" .$item->celular->GetValue(). "</td>
            <td><input type='hidden' name='tipoCliente' value='" .$item->tipoCliente->GetValue(). "'>" .$item->tipoCliente->GetValue(). "</td>
            <td>
                <div class='btn-group' role='group'>
                    <button class='btn btn-outline-danger btn-sm btnEditar' data-tipocliente='". $item->tipoCliente->GetValue() ."' data-cliente='". $item->idCliente->GetValue() ."' type='submit' name='operacion' value='editarCliente' data-toggle='modal' data-target='.Modal_editar_cliente_" .$item->tipoCliente->GetValue(). "'>Editar</button>
                    <button class='btn btn-sm btn-outline-warning btnEliminar' data-cliente='". $item->idCliente->GetValue() ."' type='submit' name='operacion' value='eliminarCliente'>Eliminar</button>
                </div>
            </td>
            <!--</form>-->
        </tr>
    "; 
}
$ListarClientesGeneral.="";

?>

<!-- Large modal Editar Cliente Natural -->

<div class="modal fade Modal_editar_cliente_Natural" tabindex="-1" role="dialog" aria-labelledby="Modal_editar_cliente_Natural" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Formulario para editar -->
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente Natural</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="control/c-cliente.php" method="post">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                        <!-- Formalrio d ela parte de natural -->
                            <input type="hidden" class="form-control" id="validationCustom00"  name="idCliente" placeholder="" value="" required>
                        
                            <label for="validationCustom01">Nombre(s)</label>
                            <input type="text" class="form-control" id="validationCustom01"  name="nombre" placeholder="Nombre(s)" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Nombre!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Apellido Paterno</label>
                            <input type="text" class="form-control" id="validationCustom02"  name="apPaterno" placeholder="Apellido Paterno" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Apellido!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03">Apellido Materno</label>
                            <input type="text" class="form-control" id="validationCustom03"  name="apMaterno" placeholder="Apellido Materno" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Apellido!
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom04">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="validationCustom04"  name="fechanacimiento" placeholder="Proporcione una fecha" value="" required>
                            <div class="valid-feedback">
                                Fecha correcta!!
                            </div>
                            <div class="invalid-feedback">
                                Especifique una Fecha Valida!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom05">Cedula de Identidad</label>
                            <input type="number" class="form-control" id="validationCustom05" min="1000000" max="99999999" name="ci" placeholder="Cedula de Identidad" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Cedula de identidad debe contar de un Min de 7 digitos y Max 8 digitos.
                            </div>
                        </div>
                        <!-- formulario de la parte de cliente -->
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom06">Direccion</label>
                            <input type="text" class="form-control" id="validationCustom06" name="direccion" placeholder="Direccion" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione una dirrecion Valida.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom07">Telefono Fijo</label>
                            <input type="number" class="form-control" id="validationCustom07" min="10000000" max="79999999" name="telefonoFijo" placeholder="Telefono Fijo" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Telefono Fijo debe contar de un Min de 8 digitos.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom08">Telefono Celular</label>
                            <input type="number" class="form-control" id="validationCustom08" min="60000000" max="79999999" name="telefonoCelular" placeholder="Telefono Celular" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Nro de Celular debe contar de un Min de 8 digitos.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline1" name="genero" class="custom-control-input" id="invalidCheck" value="Masculino" required>
                                    <label class="custom-control-label" for="customRadioInline1">Masculino</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="genero" class="custom-control-input" id="invalidCheck" value="Femenino" required>
                                    <label class="custom-control-label" for="customRadioInline2">Femenino</label>
                            </div>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                                <div class="invalid-feedback">
                                    Selecione una opcion.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="operacion" value="actualizarNatural">Guardar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--Fin de Modal Editar Cliente Natural-->

<!--inicio de modal de Cliente Juridico-->
<div class="modal fade Modal_editar_cliente_Juridico" tabindex="-1" role="dialog" aria-labelledby="Modal_editar_cliente_Juridico" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Formulario para editar -->
            <div class="modal-header">
                <h5 class="modal-title">Editar Cliente Juridico</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" novalidate action="control/c-cliente.php" method="post">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                        <!-- Formalrio d ela parte de natural -->
                            <input type="hidden" class="form-control" id="JvalidationCustom00"  name="idCliente" placeholder="" value="" required>
                            
                            <label for="JvalidationCustom01">Razon Social</label>
                            <input type="text" class="form-control" id="JvalidationCustom01"  name="razonSocial" placeholder="Razon Social" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Nombre valido!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="JvalidationCustom02">Representante Legal</label>
                            <input type="text" class="form-control" id="JvalidationCustom02"  name="rpteLegal" placeholder="Nombre Representante" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Nombre valido!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="JvalidationCustom03">Nro de Identificacion Tributaria</label>
                            <input type="number" class="form-control" id="JvalidationCustom03"  name="nit" min="1000000000" max="999999999999" placeholder="NIT" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Nit Valido!
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <!-- formulario de la parte de cliente -->
                        <div class="col-md-4 mb-3">
                            <label for="JvalidationCustom04">Direccion</label>
                            <input type="text" class="form-control" id="JvalidationCustom04" name="direccion" placeholder="Direccion" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione una dirrecion Valida.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="JvalidationCustom05">Telefono Fijo</label>
                            <input type="number" class="form-control" id="JvalidationCustom05" min="10000000" max="79999999" name="telefonoFijo" placeholder="Telefono Fijo" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Telefono Fijo debe contar de un Min de 8 digitos.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="JvalidationCustom06">Telefono Celular</label>
                            <input type="number" class="form-control" id="JvalidationCustom06" min="60000000" max="79999999" name="telefonoCelular" placeholder="Telefono Celular" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Nro de Celular debe contar de un Min de 8 digitos.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                        </div>
                    <button class="btn btn-primary" type="submit" name="operacion" value="actualizarJuridico">Guardar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>

<!--Fin de Modal de Cliente Juridico-->
<div class="container">
<div class="shadow-lg p-3 mb-5 bg-white rounded">
    <div class="row">
        <div class="col-3">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Listado de Clientes Activos</a>
            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Crear Cliente Natural</a>
            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Crear Cliente Juridico</a>
            <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Listado de Clientes de Baja</a>
            </div>
        </div>
        <div class="col-9">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active table-responsive-sm" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <h3>Listado de Clientes</h3>
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="table-responsive-sm table-responsive-md">
                        
                            <table id="TabladeClientes" class="table-sm table-striped-md table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Cod. Cliente</th>
                                        <th scope="col">Nombre Completo</th>
                                        <th scope="col">Nro de Documento</th>
                                        <th scope="col">Direccion</th>
                                        <th scope="col">Celular o Telefono</th>
                                        <th scope="col">Tipo de Cliente</th>
                                        <th scope="col">Operacion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        echo $ListarClientesGeneral;
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h3>Adicionar un cliente Natural</h3>
                    <!-- Aqui empieza el formulario de Crear un nuevo Cliente Natural -->
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                    <form class="needs-validation" novalidate action="control/c-cliente.php" method="post">
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                        <!-- Formalrio d ela parte de natural -->                            
                            <label for="validationCustom01">Nombre(s)</label>
                            <input type="text" class="form-control" id="validationCustom01"  name="nombre" placeholder="Nombre(s)" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Nombre!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom02">Apellido Paterno</label>
                            <input type="text" class="form-control" id="validationCustom02"  name="apPaterno" placeholder="Apellido Paterno" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Apellido!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03">Apellido Materno</label>
                            <input type="text" class="form-control" id="validationCustom03"  name="apMaterno" placeholder="Apellido Materno" value="" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione un Apellido!
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom04">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="validationCustom04"  name="fechanacimiento" placeholder="Proporcione una fecha" value="" required>
                            <div class="valid-feedback">
                                Fecha correcta!!
                            </div>
                            <div class="invalid-feedback">
                                Especifique una Fecha Valida!
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom05">Cedula de Identidad</label>
                            <input type="number" class="form-control" id="validationCustom05" min="1000000" max="99999999" name="ci" placeholder="Cedula de Identidad" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Cedula de identidad debe contar de un Min de 7 digitos y Max 8 digitos.
                            </div>
                        </div>
                        <!-- formulario de la parte de cliente -->
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom06">Direccion</label>
                            <input type="text" class="form-control" id="validationCustom06" name="direccion" placeholder="Direccion" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Proporcione una dirrecion Valida.
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom07">Telefono Fijo</label>
                            <input type="number" class="form-control" id="validationCustom07" min="10000000" max="79999999" name="telefonoFijo" placeholder="Telefono Fijo" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Telefono Fijo debe contar de un Min de 8 digitos.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom08">Telefono Celular</label>
                            <input type="number" class="form-control" id="validationCustom08" min="60000000" max="79999999" name="telefonoCelular" placeholder="Telefono Celular" required>
                            <div class="valid-feedback">
                                Muy Bien!!
                            </div>
                            <div class="invalid-feedback">
                                Nro de Celular debe contar de un Min de 8 digitos.
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="valid-feedback">
                            Muy Bien!!
                        </div>
                        <div class="invalid-feedback">
                            Selecione una opcion.
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="customControlValidation2" name="genero" required>
                            <label class="custom-control-label" for="customControlValidation2">Masculino</label>
                        </div>
                        <div class="custom-control custom-radio mb-3">
                            <input type="radio" class="custom-control-input" id="customControlValidation3" name="genero" required>
                            <label class="custom-control-label" for="customControlValidation3">Femenino</label>
                        </div>
                        <button class="btn btn-primary" type="submit" name="operacion" value="GuardarNatural">Guardar</button>
                    </div>
                    
                    </form>
                    </div>
                    <script>
                    // Example starter JavaScript for disabling form submissions if there are invalid fields
                    (function() {
                        'use strict';
                        window.addEventListener('load', function() {
                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
                            var forms = document.getElementsByClassName('needs-validation');
                            // Loop over them and prevent submission
                            var validation = Array.prototype.filter.call(forms, function(form) {
                            form.addEventListener('submit', function(event) {
                                if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                                }
                                form.classList.add('was-validated');
                            }, false);
                            });
                        }, false);
                        })();
                    </script>
                <!-- Fin -->
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <h3>Adicionar un cliente Natural</h3>
                    <!-- Aqui empieza el formulario de Crear un nuevo Cliente Natural -->
                    <div class="shadow-lg p-3 mb-5 bg-white rounded">
                        <form class="needs-validation" novalidate action="control/c-cliente.php" method="post">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                <!-- Formalrio d ela parte de natural -->
                                    <label for="validationCustom01">Razon Social</label>
                                    <input type="text" class="form-control" id="validationCustom01"  name="razonSocial" placeholder="Razon Social" value="" required>
                                    <div class="valid-feedback">
                                        Muy Bien!
                                    </div>
                                    <div class="invalid-feedback">
                                        Proporcione un Nombre valido!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom02">Representante Legal</label>
                                    <input type="text" class="form-control" id="validationCustom02"  name="rpteLegal" placeholder="Nombre Representante" value="" required>
                                    <div class="valid-feedback">
                                        Muy Bien!
                                    </div>
                                    <div class="invalid-feedback">
                                        Proporcione un Nombre valido!
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom03">Nro de Identificacion Tributaria</label>
                                    <input type="number" class="form-control" id="validationCustom03"  name="nit" min="1000000000" max="999999999999" placeholder="NIT" value="" required>
                                    <div class="valid-feedback">
                                        Muy Bien!!
                                    </div>
                                    <div class="invalid-feedback">
                                        Proporcione un Nit Valido!
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-row">
                                <!-- formulario de la parte de cliente -->
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom06">Direccion</label>
                                    <input type="text" class="form-control" id="validationCustom06" name="direccion" placeholder="Direccion" required>
                                    <div class="valid-feedback">
                                        Muy Bien!!
                                    </div>
                                    <div class="invalid-feedback">
                                        Proporcione una dirrecion Valida.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom07">Telefono Fijo</label>
                                    <input type="number" class="form-control" id="validationCustom07" min="10000000" max="79999999" name="telefonoFijo" placeholder="Telefono Fijo" required>
                                    <div class="valid-feedback">
                                        Muy Bien!!
                                    </div>
                                    <div class="invalid-feedback">
                                        Telefono Fijo debe contar de un Min de 8 digitos.
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="validationCustom08">Telefono Celular</label>
                                    <input type="number" class="form-control" id="validationCustom08" min="60000000" max="79999999" name="telefonoCelular" placeholder="Telefono Celular" required>
                                    <div class="valid-feedback">
                                        Muy Bien!!
                                    </div>
                                    <div class="invalid-feedback">
                                        Nro de Celular debe contar de un Min de 8 digitos.
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                            </div>
                            <button class="btn btn-primary" type="submit" name="operacion" value="GuardarJuridico">Guardar</button>
                        </form>
                    </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    4
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>
