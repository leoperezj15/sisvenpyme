<?php

/*Se instancia hacia RN_Modulo y se extrae la lista de Modulos en ListarModulos
**
*/

require_once("../model/RN_Empleado.php");

$oRN_Empleado = new RN_Empleado;

$listarEmpleados = $oRN_Empleado->GetListEmpleado();

include_once "view/v-panel.php";
include_once "view/empleado-list.php";
include_once "view/v-footer.php";




?>