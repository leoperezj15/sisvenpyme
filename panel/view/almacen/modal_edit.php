<?php
require_once "../model/RN_Sucursal.php";

$oRN_Sucursal = new RN_Sucursal;

$listaSucursal = $oRN_Sucursal->ListaSucursal();

$mostrarSucursal = "<option disabled selected required>Elija Almacen:</option>";

if($listaSucursal != null)
{
    foreach($listaSucursal as $item)
    {
        $idSucursal = $item->idSucursal->getValue();
        $Nombre = $item->Nombre->getValue();
        $mostrarSucursal .="<option value=" .$idSucursal. ">" .$Nombre. "</option>";
    }
    
}
$mostrarSucursal .="";
?>

<div id="editAlmacenModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_almacen" id="edit_almacen">
					<div class="modal-header">						
						<h4 class="modal-title">Editar Almacen</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
							<input type="hidden" name="edit_idalmacen"  id="edit_idalmacen" class="form-control" required>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="edit_nombre" id="edit_nombre" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Sigla</label>
							<input type="text" name="edit_sigla" id="edit_sigla" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Sucursal</label>
							<select name="edit_sucursal" id="edit_sucursal" class="form-control" required>
								<?php echo $mostrarSucursal;?>
							</select>
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