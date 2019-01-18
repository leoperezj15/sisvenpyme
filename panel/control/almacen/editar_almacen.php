<?php
    if (empty($_POST['edit_idalmacen']))
    {
		$errors[] = "ID está vacío.";
    } elseif (!empty($_POST['edit_idalmacen']))
    {
	require_once ("../../../model/conexion.php");// escaping, additionally removing everything that could be (html/javascript-) code
    
    $idAlmacen=intval($_POST['edit_idalmacen']);
    $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["edit_nombre"],ENT_QUOTES)));
	$sigla = mysqli_real_escape_string($con,(strip_tags($_POST["edit_sigla"],ENT_QUOTES)));
	$idSucursal = intval($_POST["edit_sucursal"]);
	
	// UPDATE data into database
    $sql = "UPDATE almacen SET Nombre='".$nombre."', Sigla='".$sigla."', idSucursal='".$idSucursal."' WHERE idAlmacen='".$idAlmacen."' ";
    $query = mysqli_query($con,$sql);
    // if product has been added successfully
    if ($query) {
        $messages[] = "El almacen ha sido actualizado con éxito.";
    } else {
        $errors[] = "Lo sentimos, la actualización falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
	{
		$errors[] = "Error desconosido si persiste contacte al administrador del sistema.";
	}
if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}
?>	