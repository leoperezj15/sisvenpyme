<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 */

require "../model/RN_Rol.php";

$oRN_Rol = new RN_Rol;
$osRol = new Structure_Rol;

$osRol->idRol->SetValue(0);
$osRol->hash->SetValue("");
$osRol->nombre->SetValue("Referente de RRHH");
$osRol->estado->SetValue("Activo");


$oRN_Rol->Save($osRol);


?>