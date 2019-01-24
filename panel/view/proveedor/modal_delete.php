<div id="deleteProveedorModal" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <form name="delete_proveedor" id="delete_proveedor">

                <div class="modal-header">						
                    <h4 class="modal-title">Dar de Baja a Proveedor</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">

                    <p>¿Seguro que quieres dar de <strong>Baja</strong> este proveedor?</p>
                    <p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
                    <input type="hidden" name="delete_idproveedor" id="delete_idproveedor">

                </div>
                <div class="modal-footer">

                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
                    <input type="submit" class="btn btn-danger" value="Eliminar">
                </div>

            </form>

        </div>

    </div>

</div>