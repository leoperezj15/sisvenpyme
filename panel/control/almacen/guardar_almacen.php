<?php
    require_once ("../../../model/conexion.php");//Contiene funcion que conecta a la base de datos
    // escaping, additionally removing everything that could be (html/javascript-) code 

	if (empty($_POST['add_nombre'])){
		$errors[] = "Ingresa el nombre del almacen.";
    } 
    elseif (!empty($_POST['add_nombre']))
    {
        
        $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["add_nombre"],ENT_QUOTES)));
        $sigla = mysqli_real_escape_string($con,(strip_tags($_POST["add_sigla"],ENT_QUOTES)));
        $sucursal = mysqli_real_escape_string($con,(strip_tags($_POST["add_sucursal"],ENT_QUOTES)));

        // REGISTER data into database
        $sql = "INSERT INTO almacen VALUES (0,'$nombre','$sigla','$sucursal')";
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