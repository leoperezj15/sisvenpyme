<div id="addProductoModal" class="modal fade">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form name="add_producto" id="add_producto">

                <div class="modal-header">

                    <h4 class="modal-title">Agregar Producto</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>

                <div class="modal-body small">

                    <div class="form-row">

                        <div class="form-group col-md-2">
                            <label for="add_codigo">Codigo</label>
                            <input type="text" name="add_codigo" id="add_codigo" class="form-control strong" placeholder="Codigo para el producto" required>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="add_nombre">Nombre</label>
                            <input type="text" class="form-control" name="add_nombre" id="add_nombre" placeholder="Introducir Nombre" required>
                        </div><br>
                            
                        <div class="form-group col-md-5">
                            <label for="add_descripcion">Descripcion</label>
                            <input type="text" class="form-control" name="add_descripcion" id="add_descripcion"  placeholder="Descripcion del Producto" required>
                        </div>

                    </div>

                    <div class="form-row">
                    
                        <div class="form-group col-md-4">

                            <label for="add_modelo">Modelo</label>
                            <input type="text" class="form-control" name="add_modelo" id="add_modelo" placeholder="Modelo del Producto" required>
                       
                        </div>
                            

                        <div class="form-group col-md-4">

                            <label for="add_peso">Peso</label>
                            <input type="text" class="form-control" name="add_peso" id="add_peso" placeholder="Pesos Literal" required>
                            
                        </div>

                        <div class="form-group col-md-4">

                            <label for="add_madein">Origen de Producto</label>

                            <select class="custom-select" name="add_madein" id="add_madein">

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
                    <input type="submit" class="btn btn-success" value="Guardar datos">

                </div>

            </form>

        </div>

    </div>

</div>