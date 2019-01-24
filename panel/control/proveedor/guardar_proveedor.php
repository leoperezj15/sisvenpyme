<?php
    require_once ("../../../model/conexion.php");//Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code 

	if (empty($_POST['add_nombre'])){
		$errors[] = "Ingresa el nombre del proveedor.";
    } 
    elseif (!empty($_POST['add_nombre']))
    {
        $nit = intval($_POST["add_nit"]);
        $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["add_nombre"],ENT_QUOTES)));
        $contacto = mysqli_real_escape_string($con,(strip_tags($_POST["add_contacto"],ENT_QUOTES)));
        $direccion = mysqli_real_escape_string($con,(strip_tags($_POST["add_direccion"],ENT_QUOTES)));
        $telfijo = intval($_POST["add_telefonofijo"]);
        $telcelu = intval($_POST["add_telefonocelular"]);
        $correo = filter_var($_POST["add_correo"], FILTER_VALIDATE_EMAIL);
        $paginaweb = filter_var($_POST["add_paginaweb"], FILTER_SANITIZE_URL);

        // REGISTER data into database
        $sql = "INSERT INTO proveedor VALUES (0,'',$nit,'$nombre','$contacto','$direccion','$telfijo','$telcelu','$correo','$paginaweb','Activo')";
        $query = mysqli_query($con,$sql);
        // if product has been added successfully
        if ($query) {
            $messages[] = "El almacen ha sido guardado con éxito.";
        } else {
            $errors[] = "Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
        }
		
    }
    else 
	{
		$errors[] = "desconocido.";
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