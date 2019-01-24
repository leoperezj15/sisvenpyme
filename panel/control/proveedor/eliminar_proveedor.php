<?php

    
    if (empty($_POST['delete_idproveedor']))
    {
		$errors[] = "Id vacío.";
    } elseif (!empty($_POST['delete_idproveedor']))
    {
	//require_once ("../conexion.php");//Contiene funcion que conecta a la base de datos
	// escaping, additionally removing everything that could be (html/javascript-) code
    $idProveedor=intval($_POST['delete_idproveedor']);
	
    require_once ("../../../model/RN_Proveedor.php");

    $oRN_Proveedor = new RN_Proveedor;

    $res = $oRN_Proveedor->Delete($idProveedor);
	
    // if product has been added successfully
    if ($res) {
        $messages[] = "El proveedor se ha dado de baja con éxito. ";
    } else {
        $errors[] = " Lo sentimos, dar de baja falló. Por favor, regrese y vuelva a intentarlo.";
    }
		
	} else 
	{
		$errors[] = "desconocido.";
	}
if (isset($errors))
{
?>

<div class="alert alert-danger" role="alert">

    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Error!</strong>

    <?php
        foreach ($errors as $error) 
        {
            echo $error;
        }
    ?>

</div>

<?php

}

if (isset($messages))
{

?>
<div class="alert alert-success" role="alert">

    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>¡Bien hecho!</strong>

    <?php
        foreach ($messages as $message) 
        {
            echo $message;
        }
    ?>

</div>

<?php
}
?>