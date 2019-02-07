
<?php
if (isset($_GET['term'])) {
    require_once("../../../model/conexion.php");
    $return_arr = array();
/* If connection to database, run sql statement. */
    if ($con) {

        $fetch = mysqli_query($con, "select `idCliente`,  `NombreCompleto`, `NroDocumento`, `Direccion` from view_cliente_general_activo where `NombreCompleto` like '%" . mysqli_real_escape_string($con, ($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
        while ($row = mysqli_fetch_array($fetch)) {

            $idCliente = $row['idCliente'];
            $row_array['value'] = $row['NombreCompleto'];
            $row_array['idCliente'] = $idCliente;
            $row_array['nombre'] = $row['NombreCompleto'];
            $row_array['nrodocumento'] = $row['NroDocumento'];
            $row_array['direccion'] = $row['Direccion'];
            array_push($return_arr, $row_array);
        }

    }

/* Free connection resources. */
    mysqli_close($con);

/* Toss back results as json encoded array. */
    echo json_encode($return_arr);

}
?>