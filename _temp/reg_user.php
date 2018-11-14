<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 */

require "../model/RN_Usuario.php";

$oRN_Usuario = new RN_Usuario;
$osUsuario = new Structure_Usuario;

$osUsuario->idUsuario->SetValue(0);
$osUsuario->hash->SetValue("");
$osUsuario->username->SetValue("referente01");
$osUsuario->password->SetValue("2018");
$osUsuario->alias->SetValue("recursos humanos");
$osUsuario->email->SetValue("rrhh@hotmail.com");
$osUsuario->idRol->SetValue(3); // Administrador (1), Vendedor (2), referente RRHH
$osUsuario->estado->SetValue("Activo");

$oRN_Usuario->Save($osUsuario);


?>