<?php


require("../model/RN_Usuario.php");

$oRN_Usuario = new RN_Usuario;

$ListaDeUsuarios = $oRN_Usuario->GetList();

include_once("view/v-user-list.php");


?>