<?php

require_once "../../model/RN_Modulo.php";



if($_POST['nombre'])
{
    $nombre = $_POST['nombre'];

    $oRN_Modulo = new RN_Modulo;
    $osModulo = new Structure_Modulo;

    $osModulo->idModulo->SetValue(0);
    $osModulo->hash->SetValue("");
    $osModulo->nombre->SetValue($nombre);
    $osModulo->estado->SetValue("Activo");

    $oRN_Modulo->Save($osModulo);
    include_once "panel/view/v-panel.php";
    
}
else
{
    include_once "panel/view/v-add-modulo.php";
}






?>