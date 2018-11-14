<?php

/*Se instancia hacia RN_Modulo y se extrae la lista de Modulos en ListarModulos
**
*/

require_once("../../model/RN_Modulo.php");

$oRN_Modulo = new RN_Modulo;

$listarModulos = $oRN_Modulo->GetList();

include_once("view/v-user-new.php");

?>