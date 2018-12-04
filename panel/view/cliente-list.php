<?php
//$listarCliente;
if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}

$ListarClientesGeneral = "";
foreach ($listarClientes as $item) 
{
    $ListarClientesGeneral .= "
        <tr>
            <td scope='row'>" .$item->idCliente->GetValue(). "</td>
            <td>" .$item->nombreCompleto->GetValue(). "</td>
            <td>" .$item->nroDocumento->GetValue(). "</td>
            <td>" .$item->direccion->GetValue(). "</td>
            <td>" .$item->celular->GetValue(). "</td>
            <td>" .$item->tipoCliente->GetValue(). "</td>
            <td><div class='btn-group' role='group'><a class='btn btn-sm btn-outline-danger' href='#'>Editar</a><a class='btn btn-sm btn-outline-warning' href='#'>Eliminar</a></div></td>
        </tr>
    "; 
}
$ListarClientesGeneral.="";

?>

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
                    <div class="table-responsive-md">
                        <table class="table table-striped ">
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
                <button class="btn btn-primary" type="submit" name="operacion" value="GuardarNatural">Guardar</button>
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
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">3</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">4</div>
            </div>
        </div>
    </div>
</div>
</div>