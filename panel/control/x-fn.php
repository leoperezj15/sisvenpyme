<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufu�
 * @copyright 	2018
 */
 
session_start();

require_once "../../model/RN_Usuario.php";
require_once "../../model/RN_RolModulo.php";
require_once "../../model/RN_Objeto.php";

$content = "";

if ( isset($_POST["fn"]) )
{
    $fn = $_POST["fn"];
    
    switch ($fn){
        case "Login":
            $user = base64_encode($_POST["user"]);
            $pass = base64_encode($_POST["pass"]);
            
            $oRN_Usuario    = new RN_Usuario;
            
            $oUsuario   = $oRN_Usuario->Verify($user, $pass);
            
            $content = "error|Datos de acceso incorrectos";
            if ($oUsuario != null)
            {
                
                $idRol  = $oUsuario->idRol->getValue();
                $rol    = $oUsuario->Rol->nombre->GetValue();
                
                $oRN_RolModulo  = new RN_RolModulo;
                $oRN_Objeto     = new RN_Objeto;
                
                $lista = $oRN_RolModulo->GetListByRol($idRol);
                
                $acl = array();
                $cad = "";
                foreach($lista as $item){
                    $idModulo = $item->idModulo->GetValue();
                    
                    $listaObjetos = $oRN_Objeto->GetListByModulo($idModulo);
                    $cad2 = "";
                    
                    $iObjetos = array();
                    foreach($listaObjetos as $item2){
                        $cad2 .= $item2->nombre->GetValue() . ",";
                        
                        $iObjetos[] = array("idObjeto" => $item2->idObjeto->GetValue(),
                                            "nombre" => $item2->nombre->GetValue(),
                                            "nombreControl" =>$item2->nombreControl->GetValue(),
                                            );
                    }
                    
                    $iModulos[] = array("idModulo" => $idModulo,
                                        "nombre" => $item->Modulo->nombre->GetValue(),
                                        "listaObjetos" => $iObjetos);
                                        
                    $cad .= $item->Modulo->nombre->GetValue() . "(". $cad2 .")";
                }
                
                $acl = array("idRol" => $idRol,
                             "nombre" => $rol,
                             "listaModulos" => $iModulos);
                $_SESSION["ACL"] = $acl;
                
                $content = "ok|Datos Correctos";
            }
                        
            break;
    }
}

echo $content;

?>