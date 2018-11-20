<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 */
 
session_start();

require_once "../../model/RN_Usuario.php";
require_once "../../model/RN_RolModulo.php";
require_once "../../model/RN_Objeto.php";
require_once "../../model/RN_Empleado.php";
require_once "../../model/RN_Cliente.php";

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
            
            $content = "err|Datos de acceso incorrectos";
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
        case "Empleado-add":
                $nombre = base64_encode($_POST["nombre"]);
                $apPaterno = base64_encode($_POST["apPaterno"]);
                $apMaterno = base64_encode($_POST["apMaterno"]);
                $fechaNacimiento = $_POST["fechaNacimiento"];
                $ci = base64_encode($_POST["ci"]);

                $oRN_Empleado    = new RN_Empleado;
            
                $oEmpleado = $oRN_Empleado->VerificarEmpleado($ci);
                
                if ($oEmpleado == true)
                {
                    $content = "err|El empleado ya esta registrado";
                }
                else
                {
                    $osEmpleado = new Structure_Empleado;

                    $osEmpleado->idEmpleado->SetValue(0);
                    $osEmpleado->hash->SetValue("");
                    $osEmpleado->nombre->SetValue($nombre);
                    $osEmpleado->apPaterno->SetValue($apPaterno);
                    $osEmpleado->apMaterno->SetValue($apMaterno);
                    $osEmpleado->fechaNacimiento->SetValue($fechaNacimiento);
                    $osEmpleado->ci->SetValue($ci);
                    $osEmpleado->estado->SetValue("Activo");

                    $oEmpleado = $oRN_Empleado->SaveEmpleado($osEmpleado);
                    if ($oEmpleado == true)
                    {
                        $content = "ok|Datos guardados corectamente";
                    }
                    else
                    {
                        $content = "err|No se pudo guardar la informacion";
                    }
                    
                }
            break;
        case "buscarCliente":
                $nroDocumento = $_POST["nroDocumento"];
                $oRN_Cliente = new RN_Cliente;
                $oCliente = $oRN_Cliente->GetCliente($nroDocumento);
                if($oCliente != null)
                {
                    //$idRol  = $oUsuario->idRol->getValue();
                    $idCliente = $oCliente->idCliente->getValue();
                    $nombreCompleto = $oCliente->nombreCompleto->getValue();
                    $nroDocumento = $oCliente->nroDocumento->getValue();
                    $direccion = $oCliente->direccion->getValue();
                    $celular = $oCliente->celular->getValue();
                    $tipoCliente = $oCliente->tipoCliente->getValue();

                    $_SESSION["ClienteVenta"] = array(
                        "idCliente" => $idCliente, 
                        "nombreCompleto" => $nombreCompleto,
                        "nroDocumento" => $nroDocumento,
                        "direccion" => $direccion,
                        "celular" => $celular,
                        "tipoCliente" => $tipoCliente,);
                    
                    $content = "ok|Se encontraron datos";
                }
                else
                {
                    $content = "err|No se encontro ningun cliente";
                }
                
                break;
    }
}

echo $content;

?>