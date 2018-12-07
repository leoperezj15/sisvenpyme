<?php
require_once "data/db.inc";
require_once "data/Cliente.inc";
require_once "data/Natural.inc";



class RN_Natural extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) Naturales 
     * @return Lista de Structure_ClienteGeneral
     */
    
    function SaveNatural($_osNatural)
    {
        $sql = "Insert into `natural` values (
				" . $_osNatural->idCliente->GetValue() . ",
				'" . $_osNatural->nombre->GetValue() . "',
                '" . $_osNatural->apPaterno->GetValue() . "',
                '" . $_osNatural->apMaterno->GetValue() . "',
                '" . $_osNatural->fechanacimiento->GetValue() . "',
                '" . $_osNatural->ci->GetValue() . "',
                '" . $_osNatural->genero->GetValue() . "')";
        $res = $this->Execute($sql);
        if($res == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    function VerificarCI($_ci)
    {
        $sql = "select * from `natural` where ci=".$_ci."";
        $res = $this->Execute($sql);
        $osNatural = null;

        if ($this->ContainsData($res)){

            $row = $this->FetchArray($res);      
            $osNatural = $row;
            //return $osNatural;
            return true;
        }
        else
        {
            //return $osNatural;
            return false;
        }
        
    }
    
}



?>