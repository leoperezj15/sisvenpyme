<div id="editProveedorModal" class="modal fade">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form name="edit_proveedor" id="edit_proveedor">

                <div class="modal-header">

                    <h4 class="modal-title">Editar Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">

                        <input type="hidden" name="edit_idproveedor"  id="edit_idproveedor" class="form-control" required>

                    <div class="form-row">

                        <div class="form-group col-md-2">
                            <label for="add_nit">Nit</label>
                            <input type="number" name="edit_nit" id="edit_nit" class="form-control" min="1000000000" max="99999999999" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Razon Social</label>
                            <input type="text" name="edit_nombre" id="edit_nombre" class="form-control" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Persona Contacto</label>
                            <input type="text" name="edit_contacto" id="edit_contacto" class="form-control" required>
                        </div>

                    </div>

                    <div class="form-row">
                    
                        <div class="form-group col-md-8">
                            <label>Direccion</label>
                            <input type="text" name="edit_direccion" id="edit_direccion" class="form-control" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Telefono Fijo</label>
                            <input type="number" name="edit_telefonofijo" id="edit_telefonofijo" class="form-control"  min="2000000" max="9999999" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Telefono Celular</label>
                            <input type="number" name="edit_telefonocelular" id="edit_telefonocelular" class="form-control" min="60000000" max="79999999" required>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Correo Electronico</label>
                            <input type="email" name="edit_correo" id="edit_correo" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Pagina Web</label>
                            <input type="text" name="edit_paginaweb" id="edit_paginaweb" class="form-control" required>
                        </div>
                    
                    </div>
		
                </div>
                <div class="modal-footer">

                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-info" value="Guardar datos">

                </div>

            </form>

        </div>

    </div>

</div>