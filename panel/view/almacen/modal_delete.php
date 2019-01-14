<div id="deleteAlmacenModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="delete_almacen" id="delete_almacen">
					<div class="modal-header">						
						<h4 class="modal-title">Eliminar Almacen</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>¿Seguro que quieres eliminar este almacen?</p>
						<p class="text-warning"><small>Esta acción no se puede deshacer.</small></p>
						<input type="hidden" name="delete_idAlmacen" id="delete_idAlmacen">
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-danger" value="Eliminar">
					</div>
				</form>
			</div>
		</div>
	</div>