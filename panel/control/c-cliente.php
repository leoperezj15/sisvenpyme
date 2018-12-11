<?php

session_start();
require_once "../../model/RN_Cliente.php";
require_once "../../model/RN_Natural.php";
require_once "../../model/RN_Juridico.php";


$operacion = $_POST['operacion'];
switch($operacion)
{
    case 'buscarClienteNatural': buscarCliente();
    break;
    case 'GuardarNatural': crearClienteNatural();
    break;
    case 'GuardarJuridico': crearClienteJuridico();
    break;
    case 'editarCliente': traerCliente();
    break;
    case 'eliminarCliente': echo "Eliminar Cliente";
    break;
}
echo "<pre>";
print_r($_POST);
echo "</pre>";
function crearClienteNatural()
{

    
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apPaterno'];
    $apMaterno = $_POST['apMaterno'];
    $fechanacimiento = $_POST['fechanacimiento'];
    $ci = $_POST['ci'];
    $genero = $_POST['genero'];
    $direccion = $_POST['direccion'];
    $telefonoFijo = $_POST['telefonoFijo'];
    $telefonoCelular = $_POST['telefonoCelular'];
    
    $oRN_Natural = new RN_Natural;

    $Verificar = $oRN_Natural->VerificarCI($ci);
    
    if ($Verificar == false)
    {
        $oRN_Cliente = new RN_Cliente;
        $osCliente = new Structure_Cliente;
    
        $osCliente->idCliente->SetValue(0);
        $osCliente->direccion->SetValue($direccion);
        $osCliente->telefonoFijo->SetValue($telefonoFijo);
        $osCliente->telefonoCelular->SetValue($telefonoCelular);
        $osCliente->estado->SetValue("Activo");
        
        
        $id = $oRN_Cliente->SaveCliente($osCliente); //registra campos de la tabla cliente y devuelve idCliente

        $osNatural = new Structure_Natural;

        $osNatural->idCliente->SetValue($id);
        $osNatural->nombre->SetValue($nombre);
        $osNatural->apPaterno->SetValue($apPaterno);
        $osNatural->apMaterno->SetValue($apMaterno);
        $osNatural->fechanacimiento->SetValue($fechanacimiento);
        $osNatural->ci->SetValue($ci);
        $osNatural->genero->SetValue($genero);

        $Verificar2 = $oRN_Natural->SaveNatural($osNatural);
        if($Verificar2 == true)
        {
            header("location:../index.php?mnu=c-cliente-list");
            echo "Se creo correctamente";
        }
        else
        {
            echo "No se pudo crear";
        }
        

       

    }
    else
    {
        echo "Esta Persona se encuentra Registrada";
        header("location:../index.php?mnu=c-cliente-list#v-pills-profile");
    }
    

}
function crearClienteJuridico()
{
    $razonSocial = $_POST['razonSocial'];
    $rpteLegal = $_POST['rpteLegal'];
    $nit = $_POST['nit'];
    $direccion = $_POST['direccion'];
    $telefonoFijo = $_POST['telefonoFijo'];
    $telefonoCelular = $_POST['telefonoCelular'];

    $oRN_Juridico = new RN_Juridico;
    $verificarNit = $oRN_Juridico->VerificarNit($nit);

    if ($verificarNit == false) 
    {
        $oRN_Cliente = new RN_Cliente;
        $osCliente = new Structure_Cliente;
    
        $osCliente->idCliente->SetValue(0);
        $osCliente->direccion->SetValue($direccion);
        $osCliente->telefonoFijo->SetValue($telefonoFijo);
        $osCliente->telefonoCelular->SetValue($telefonoCelular);
        $osCliente->estado->SetValue("Activo");
        
        
        $id = $oRN_Cliente->SaveCliente($osCliente);

        $osJuridico = new Structure_Juridico;

        $osJuridico->idCliente->SetValue($id);
        $osJuridico->razonSocial->SetValue($razonSocial);
        $osJuridico->rpteLegal->SetValue($rpteLegal);
        $osJuridico->nit->SetValue($nit);

        $Verificar2 = $oRN_Juridico->SaveJuridico($osJuridico);
        if($Verificar2 == true)
        {
            header("location:../index.php?mnu=c-cliente-list");
            echo "Se creo correctamente";
        }
        else
        {
            header("location:../index.php?mnu=c-cliente-list");
            echo "No se creo el juridico";
        }


    }
    else
    {
        echo "Este cliente se encuentra Registrado";
        header("location:../index.php?mnu=c-cliente-list#v-pills-profile");
    }

}
function traerCliente()
{
    $tipoCliente = $_POST["tipoCliente"];
    $idCliente = $_POST["idCliente"];

    if($tipoCliente == "Natural")
    {
        $oRN_Natural = new RN_Natural;
    
        $Natural = $oRN_Natural->VerificarNatural($idCliente);
        
        if($Natural != null)
        {
            $idCliente = $Natural->idCliente->GetValue();
            $nombre = $Natural->nombre->GetValue();
            $apPaterno = $Natural->apPaterno->GetValue();
            $apMaterno = $Natural->apMaterno->GetValue();
            $fechanacimiento = $Natural->fechanacimiento->GetValue();
            $ci = $Natural->ci->GetValue();
            $direccion = $Natural->Cliente->direccion->GetValue();
            $telefonoFijo = $Natural->Cliente->telefonoFijo->GetValue();
            $telefonoCelular = $Natural->Cliente->telefonoCelular->GetValue();

            $_SESSION["UpdateCliente"] = array(
                "idCliente" => $idCliente,
                "nombre" => $nombre,
                "apPaterno" => $apPaterno,
                "apMaterno" => $apMaterno,
                "fechanacimiento" => $fechanacimiento,
                "ci" => $ci,
                "direccion" => $direccion,
                "telefonoFijo" => $telefonoFijo,
                "telefonoCelular" => $telefonoCelular,
                "tipoCliente" => "Natural"    
            );
            echo "<pre>";
            print_r($_SESSION["UpdateCliente"]);
            echo "</pre>";
            header("location:../index.php?mnu=c-cliente-list");
        }
        
    }
    else
    {

    }
}
?>