<div id="addProveedorModal" class="modal fade">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form name="add_proveedor" id="add_proveedor">

                <div class="modal-header">

                    <h4 class="modal-title">Agregar Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>

                <div class="modal-body small">

                    <div class="form-row">

                        <div class="form-group col-md-2">
                            <label for="add_nit">Nit</label>
                            <input type="number" name="add_nit" id="add_nit" class="form-control" min="1000000000" max="99999999999" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Razon Social</label>
                            <input type="text" name="add_nombre" id="add_nombre" class="form-control" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Persona Contacto</label>
                            <input type="text" name="add_contacto" id="add_contacto" class="form-control" required>
                        </div>

                    </div>

                    <div class="form-row">
                    
                        <div class="form-group col-md-8">
                            <label>Direccion</label>
                            <input type="text" name="add_direccion" id="add_direccion" class="form-control" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Telefono Fijo</label>
                            <input type="number" name="add_telefonofijo" id="add_telefonofijo" class="form-control" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Telefono Celular</label>
                            <input type="number" name="add_telefonocelular" id="add_telefonocelular" class="form-control" required>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Correo Electronico</label>
                            <input type="email" name="add_correo" id="add_correo" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pagina Web</label>
                            <input type="text" name="add_paginaweb" id="add_paginaweb" class="form-control" required>
                        </div>
                    
                    </div>
                        
                </div>

                <div class="modal-footer">

                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-success" value="Guardar datos">

                </div>

            </form>

        </div>

    </div>

</div>