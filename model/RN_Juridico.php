<?php
require_once "data/db.inc";
require_once "data/Cliente.inc";
require_once "data/Juridico.inc";



class RN_Juridico extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) Naturales 
     * @return Lista de Structure_ClienteGeneral
     */
    
    function SaveJuridico($_osJuridico)
    {
        $sql = "Insert into `juridico` values (
				" . $_osJuridico->idCliente->GetValue() . ",
				'" . $_osJuridico->razonSocial->GetValue() . "',
                '" . $_osJuridico->rpteLegal->GetValue() . "',
                '" . $_osJuridico->nit->GetValue() . "')";
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
    function VerificarNit($_nit)
    {
        $sql = "select * from `juridico` where nit=".$_nit."";
        $res = $this->Execute($sql);
        $osJuridico = null;

        if ($this->ContainsData($res)){

            $row = $this->FetchArray($res);      
            $osJuridico = $row;
            return true;
        }
        else
        {
            return false;
        }
        
    }
    
}



?>