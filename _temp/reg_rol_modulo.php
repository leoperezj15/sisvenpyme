<?php
require "../model/RN_RolModulo.php";

$oRN_RolModulo = new RN_RolModulo;
$osRolModulo = new Structure_RolModulo;

$osRolModulo->idRol->Setvalue(1);
$osRolModulo->idModulo->Setvalue(3);
$osRolModulo->hash->Setvalue("");
$osRolModulo->estado->Setvalue("Activo");

$oRN_RolModulo->Save($osRolModulo);

?>