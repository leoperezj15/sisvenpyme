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
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($con) {

        $fetch = mysqli_query($con, "select `idProveedor`,  `Nit`, `nombre`, `contacto` from proveedor where `nombre` like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {

            $idProveedor = $row['idProveedor'];
            $row_array['value'] = $row['nombre'];
            $row_array['idProveedor'] = $idProveedor;
            $row_array['nit'] = $row['Nit'];
            $row_array['nombre'] = $row['nombre'];
            $row_array['contacto'] = $row['contacto'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
?>