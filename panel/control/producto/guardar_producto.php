<?php
    require_once ("../../../model/conexion.php");//Contiene funcion que conecta a la base de datos
    require_once ("../../../model/RN_Producto.php");
    // escaping, additionally removing everything that could be (html/javascript-) code
    
	if (empty($_POST['add_nombre'])){
		$errors[] = "Ingresa el nombre del producto.";
    } 
    elseif (!empty($_POST['add_nombre']))
    {
        $codigo = intval($_POST["add_codigo"]);
        $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["add_nombre"],ENT_QUOTES)));
        $descripcion = mysqli_real_escape_string($con,(strip_tags($_POST["add_descripcion"],ENT_QUOTES)));
        $modelo = mysqli_real_escape_string($con,(strip_tags($_POST["add_modelo"],ENT_QUOTES)));
        $peso =  mysqli_real_escape_string($con,(strip_tags($_POST["add_peso"],ENT_QUOTES)));
        $madein = mysqli_real_escape_string($con,(strip_tags($_POST["add_madein"],ENT_QUOTES)));
        $idsubCategoria = intval($_POST["comboSubCategoria"]);
        $idunidadMedida = intval($_POST["comboUnidadMedida"]);


        $oRN_Producto = new RN_Producto;
        $osProducto = new Structure_Producto;
        
        $osProducto->idProducto->SetValue(0);
        $osProducto->hash->SetValue("");
        $osProducto->codigo->SetValue($codigo);
        $osProducto->nombre->SetValue($nombre);
        $osProducto->descripcion->SetValue($descripcion);
        $osProducto->modelo->SetValue($modelo);
        $osProducto->estado->SetValue("Activo");
        $osProducto->peso->SetValue($peso);
        $osProducto->madein->SetValue($madein);
        $osProducto->idsubCategoria->SetValue($idsubCategoria);
        $osProducto->idunidadMedida->SetValue($idunidadMedida);
        

        
        $res = $oRN_Producto->Guardar($osProducto);

        if($res == true)
        {
            $messages[] = "El producto ha sido guardado con éxito.";
        }
        else
        {
            $errors[] = " Lo sentimos, el registro falló. Por favor, regrese y vuelva a intentarlo.";
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