<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 */

session_start();

if ( isset($_SESSION["ACL"]) )
{
	// 
	$mnu = (isset($_GET["mnu"])? $_GET["mnu"] : "menu");
	//require_once"control/c-panel.php";
	switch ($mnu) 
	{
		case "nuevo_usuario":
			include_once "control/c-user-new.php";
			break;
		case "menu":
			include_once "control/c-panel.php";
			break;
		case "Listar_Usuarios":
			include_once "control/c-user-list.php";
			break;
		case "logout":
			include_once "control/c-logout.php";
			break;
		case "Registrar_Usuario":
			include_once "control/c-registrar_usuario.php";
			break;
		case "nuevo_modulo":
			include_once "control/c-nuevo_modulo.php";
			break;
		case "c-empleado-list":
			include_once "control/c-empleado-list.php";
			break;
		case "login2":
			include_once "control/c-login2.php";
			break;
		
		default:
			echo $mnu;
			break;
	}
     
}
else
{
    require_once "control/c-login.php"; 
}

?>