<div id="editProductoModal" class="modal fade">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form name="edit_producto" id="edit_producto">

                <div class="modal-header">

                    <h4 class="modal-title">Editar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">

                        <input type="hidden" name="edit_idproducto"  id="edit_idproducto" class="form-control" required>

                    <div class="form-row">

                        <div class="form-group col-md-2">
                            <label for="edit_codigo">Codigo</label>
                            <input type="text" name="edit_codigo" id="edit_codigo" class="form-control strong" placeholder="Codigo para el producto" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="edit_nombre">Nombre</label>
                            <input type="text" class="form-control" name="edit_nombre" id="edit_nombre" placeholder="Introducir Nombre" required>
                        </div><br>
                            
                        <div class="form-group col-md-5">
                            <label for="edit_descripcion">Descripcion</label>
                            <input type="text" class="form-control" name="edit_descripcion" id="edit_descripcion"  placeholder="Descripcion del Producto" required>
                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">

                            <label for="edit_modelo">Modelo</label>
                            <input type="text" class="form-control" name="edit_modelo" id="edit_modelo" placeholder="Modelo del Producto" required>

                        </div>
                            

                        <div class="form-group col-md-4">

                            <label for="edit_peso">Peso</label>
                            <input type="text" class="form-control" name="edit_peso" id="edit_peso" placeholder="Pesos Literal" required>
                            
                        </div>

                        <div class="form-group col-md-4">

                            <label for="edit_madein">Origen de Producto</label>

                            <select class="custom-select" name="edit_madein" id="edit_madein">

                                <option value="USA">USA</option>
                                <option value="Brasil">Brasil</option>
                                <option value="China">China</option>
                                <option value="Vietnan">Vietnan</option>
                                <option value="Korea del Sur">Korea del Sur</option>
                                <option value="Japon">Japon</option>

                            </select>

                        </div>

                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-4">

                            <label for="comboCategoria">Seleccione Categoria</label>
                            <?php echo $cboCategoria;?>

                        </div>

                        <div class="form-group col-md-4" id="ctn-SubCategoria">

                            <label for="comboSubCategoria">Selecione una SubCategoria</label>
                            <?php echo $cboSubCategoria;?>

                        </div>

                        <div class="form-group col-md-4">

                            <label for="comboUnidadMedida">Selecione Unidad de Medida</label>
                            <?php echo $cboUnidadMedida; ?>

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