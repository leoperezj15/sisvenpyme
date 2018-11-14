<?php

/**
 * @author Leonardo Perez Justiniano
 * @copyright 2018
 */
require ("../model/RN_Usuario");



if ( isset($_POST["user"] && $_POST["pass"])) 
{
	$user = $_POST["user"];
	$pass = $_POST["pass"];

	$oRN_Usuario = new RN_Usuario;
	$osUsuario = new Structure_Usuario;

	$osUsuario->idUsuario->SetValue(0);
	$osUsuario->hash->SetValue("");
	$osUsuario->username->SetValue("vendedor2");
	$osUsuario->password->SetValue("2018");
	$osUsuario->alias->SetValue("Vendedor 2");
	$osUsuario->email->SetValue("vendedor2@hotmail.com");
	$osUsuario->idRol->SetValue(2); // Administrador (1), Vendedor (2)
	$osUsuario->estado->SetValue("Activo");

	$oRN_Usuario->Save($osUsuario);

}
else
{

}


?>