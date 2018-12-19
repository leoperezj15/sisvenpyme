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
    function VerificarJuridico($_idCliente)
    {
        $sql = "select t1.idCliente as t1_idCliente,
        t1.razonSocial as t1_razonSocial,
        t1.rpteLegal as t1_rpteLegal,
        t1.nit as t1_nit,
        t2.direccion AS t2_direccion, 
        t2.telefonoCelular as t2_telefonoCelular, 
        t2.telefonoFijo t2_telefonoFijo
        FROM `juridico` t1
        inner join `cliente` t2 on t2.idCliente = t1.idCliente
        WHERE t1.idCliente =".$_idCliente." and t2.estado = 'Activo'";

        $res = $this->Execute($sql);

        $osJuridico = new Structure_Juridico;
        

        if($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
               $osJuridico->idCliente->SetValue($item["t1_idCliente"]);
               $osJuridico->razonSocial->SetValue($item["t1_razonSocial"]);
               $osJuridico->rpteLegal->SetValue($item["t1_rpteLegal"]);
               $osJuridico->nit->SetValue($item["t1_nit"]);

               $osCliente = new Structure_Cliente;

               $osCliente->idCliente->SetValue($item["t1_idCliente"]);
               $osCliente->direccion->SetValue($item["t2_direccion"]);
               $osCliente->telefonoCelular->SetValue($item["t2_telefonoCelular"]);
               $osCliente->telefonoFijo->SetValue($item["t2_telefonoFijo"]);

               $osJuridico->Cliente = $osCliente;

            }
        }
        return $osJuridico;

    }
    
}



?>