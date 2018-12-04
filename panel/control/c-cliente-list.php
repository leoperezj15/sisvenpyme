<?php


    
require_once("../model/RN_Cliente.php");

$oRN_Cliente = new RN_Cliente;

$listarClientes = $oRN_Cliente->GetListCliente();

include_once "view/v-panel.php";
include_once "view/cliente-list.php";
include_once "view/v-footer.php";

?>