<?php
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 */

require_once "../model/RN_Modulo.php";

$oRN_Modulo = new RN_Modulo;
$osModulo = new Structure_Modulo;

$osModulo->idModulo->SetValue(0);
$osModulo->hash->SetValue("");
$osModulo->nombre->SetValue("RRHH");
$osModulo->estado->SetValue("Activo");

$oRN_Modulo->Save($osModulo);


?>