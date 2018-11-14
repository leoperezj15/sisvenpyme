<?php
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 */
require "../model/RN_Objeto.php";

$oRN_Objeto = new RN_Objeto;
$osObjeto = new Structure_Objeto;

$osObjeto->idObjeto->SetValue(0);
$osObjeto->hash->SetValue("");
$osObjeto->nombre->SetValue("Listar Objeto");
$osObjeto->imagen->SetValue("");
$osObjeto->nombreControl->SetValue("c-empleado-list");
$osObjeto->orden->SetValue(10);
$osObjeto->idModulo->SetValue(3);
$osObjeto->estado->SetValue("Activo");

$oRN_Objeto->Save($osObjeto);

if ($oRN_Objeto == TRUE) {
	echo "Se guardo informacion";
}
else
{
	echo "No se pudo guardar";
}

?>