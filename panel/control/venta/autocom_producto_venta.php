<?php

// if (isset($_GET['term'])) {
//     require "../../../model/RN_Proveedor.php";
//     $oRN_Proveedor = new RN_Provedor;
//     $term = $_GET['term'];
//     $return_arr = $oRN_Proveedor->UnProveedor($term);
//     echo json_encode($return_arr);
// }

?>
<?php
if (isset($_GET['term'])) {
    require_once("../../../model/conexion.php");
    $return_producto = array();
/* If connection to database, run sql statement. */
    if ($con) {

        $fetch = mysqli_query($con, "select `idProducto`, `codigo`,  `nombre`, `descripcion`, `modelo`,`pventa` from producto where `nombre` like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {

            $idProducto = $row['idProducto'];
            $row_array['value'] = $row['nombre'];
            $row_array['idproducto'] = $idProducto;
            $row_array['nombre2'] = $row['nombre'];
            $row_array['codigo'] = $row['codigo'];
            $row_array['descripcion'] = $row['descripcion'];
            $row_array['modelo'] = $row['modelo'];
            $row_array['precio'] = $row['pventa'];
            array_push($return_producto, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_producto);

}
?>