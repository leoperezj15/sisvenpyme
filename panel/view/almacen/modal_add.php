<div id="addAlmacenModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_almacen" id="add_almacen">
					<div class="modal-header">						
						<h4 class="modal-title">Agregar Almacen</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="add_nombre" id="add_nombre" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Sigla</label>
							<input type="text" name="add_sigla" id="add_sigla" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Sucursal</label>
							<input type="text" name="add_sucursal" id="add_sucursal" class="form-control" required>
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