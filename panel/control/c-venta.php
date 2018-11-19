<?php

// echo "<pre>";
// print_r($_REQUEST);
// echo "</pre>";

require_once "../../model/RN_Cliente.php";

$operacion = $_REQUEST['operacion'];

switch ($operacion)
{
    case 'buscarCliente': buscarCliente();
        break;
}

function buscarCliente()
{
    $ci = $_REQUEST['ci'];

}






?>