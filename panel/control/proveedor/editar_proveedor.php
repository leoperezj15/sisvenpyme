<?php
    if (empty($_POST['edit_idproveedor']))
    {
		$errors[] = "ID está vacío.";
    } elseif (!empty($_POST['edit_idproveedor']))
    {
	require_once ("../../../model/conexion.php");// escaping, additionally removing everything that could be (html/javascript-) code
    
        $idproveedor = intval($_POST["edit_idproveedor"]);
        $nit = intval($_POST["edit_nit"]);
        $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["edit_nombre"],ENT_QUOTES)));
        $contacto = mysqli_real_escape_string($con,(strip_tags($_POST["edit_contacto"],ENT_QUOTES)));
        $direccion = mysqli_real_escape_string($con,(strip_tags($_POST["edit_direccion"],ENT_QUOTES)));
        $telfijo = intval($_POST["edit_telefonofijo"]);
        $telcelu = intval($_POST["edit_telefonocelular"]);
        $correo = filter_var($_POST["edit_correo"], FILTER_VALIDATE_EMAIL);
        $paginaweb = filter_var($_POST["edit_paginaweb"], FILTER_SANITIZE_URL);
    
    $sql_nit = "SELECT Nit FROM `proveedor` WHERE Nit=$nit AND idProveedor != $idproveedor";

    $res_nit = mysqli_num_rows(mysqli_query($con,$sql_nit));
    
    if($res_nit != true)
    {
        $sql_nombre = "SELECT nombre FROM `proveedor` WHERE nombre='$nombre' AND idProveedor != $idproveedor";
        $res_nombre = mysqli_num_rows(mysqli_query($con,$sql_nombre));

        if($res_nombre != true)
        {
            // UPDATE data into database
            $sql = "UPDATE proveedor SET Nit=".$nit.", 
            nombre='".$nombre."', 
            contacto='".$contacto."', 
            direccion='".$direccion."', 
            telefonoFijo='".$telfijo."', 
            telefonoCelular='".$telcelu."', 
            correo='".$correo."',
            paginaWeb='".$paginaweb."'
            WHERE idProveedor='".$idproveedor."' ";
            $query = mysqli_query($con,$sql);
            // if product has been added successfully
        }
        else
        {
            $errors[] = "El Nombre ya se encuentra Registrado.";
        }
    }
    else
    {
        $errors[] = "Este Nit ya se encuentra Registrado.";
        $query = false;
    }
	
    if ($query) {
        $messages[] = "El proveedor ha sido actualizado con éxito.";
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