<?php

session_start();
require_once "../../model/RN_Cliente.php";
require_once "../../model/RN_Natural.php";
//require_once "../../model/RN_Juridico.php";


$operacion = $_POST['operacion'];
switch($operacion)
{
    case 'buscarClienteNatural': buscarCliente();
    break;
    case 'GuardarNatural': ;//crearClienteNatural()
    break;
    case 'crearClienteJuridico': CancelarVenta();
    break;
    case '': crearPedido();

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
    $direccion = $_POST['direccion'];
    $telefonoFijo = $_POST['telefonoFijo'];
    $telefonoCelular = $_POST['telefonoCelular'];
    
    $oRN_Natural = new RN_Natural;

    $Verificar = $oRN_Natural->VerificarCI($ci);
    if ($Verificar == null) 
    {
        $oRN_Cliente = new RN_Cliente;
        $osCliente = new Structure_Cliente;
    
        $osCliente->idCliente->SetValue(0);
        $osCliente->direccion->SetValue("".$direccion."");
        $osCliente->telefonoFijo->SetValue("".$telefonoFijo."");
        $osCliente->telefonoCelular->SetValue("".$telefonoCelular."");
    
        $idCliente = $oRN_Cliente->Save($osCliente);//registra campos de la tabla cliente y devuelve idCliente

        $oRN_Natural = new RN_Natural;
        $osNatural = new Structure_Natural;

        $osNatural->idCliente->SetValue($idCliente);
        $osNatural->nombre->SetValue("".$nombre."");
        $osNatural->apPaterno->SetValue("".$apPaterno)."";
        $osNatural->apMaterno->SetValue("".$apPaterno."");
        $osNatural->fechanacimiento->SetValue("".$fechaNacimiento."");
        $osNatural->ci->SetValue("".$ci."");
        $osNatural->genero->SetValue("".$genero."");

        $Verificar2 = $oRN_Natural->SaveNatural($osNatural);
        if($Verificar2 == true)
        {
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
    }
    

}
?>