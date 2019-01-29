<?php
    if (empty($_POST['edit_idproducto']))
    {
		$errors[] = "ID está vacío.";
    } elseif (!empty($_POST['edit_idproducto']))
    {
	require_once ("../../../model/conexion.php");// escaping, additionally removing everything that could be (html/javascript-) code
    
        $idproducto = intval($_POST["edit_idproducto"]);
        $codigo = intval($_POST["edit_codigo"]);
        $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["edit_nombre"],ENT_QUOTES)));
        $descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["edit_descripcion"],ENT_QUOTES)));
        $modelo = mysqli_real_escape_string($con,(strip_tags($_POST["edit_modelo"],ENT_QUOTES)));
        $peso = intval($_POST["edit_peso"]);
        $madein = mysqli_real_escape_string($con,(strip_tags($_POST["edit_madein"],ENT_QUOTES)));
        $idsubCategoria = intval($_POST["edit_idsubCategoria"]);
        $idunidadMedida = intval($_POST["edit_idunidadMedida"]);
    
    $sql_codigo = "SELECT codigo FROM `proveedor` WHERE codigo=$codigo AND idproducto != $idproducto";

    $res_codigo = mysqli_num_rows(mysqli_query($con,$sql_codigo));
    
    if($res_codigo != true)
    {
        $sql_nombre = "SELECT nombre FROM `proveedor` WHERE nombre='$nombre' AND idproducto != $idproducto";
        $res_nombre = mysqli_num_rows(mysqli_query($con,$sql_nombre));

        if($res_nombre != true)
        {
            // UPDATE data into database
            $sql = "UPDATE proveedor SET codigo=".$codigo.", 
            nombre='".$nombre."', 
            descripcion='".$descripcion."', 
            modelo='".$modelo."', 
            peso='".$peso."', 
            madein='".$madein."', 
            idsubCategoria='".$idsubCategoria."',
            idunidadMedida='".$idunidadMedida."'
            WHERE idproducto='".$idproducto."' ";
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
        $errors[] = "Este codigo ya se encuentra Registrado.";
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