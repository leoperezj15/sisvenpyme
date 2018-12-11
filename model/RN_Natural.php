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
    
    function VerificarNatural($_idCliente)
    {
        $sql = "select t1.idCliente as t1_idCliente,
        t1.nombre as t1_nombre,
        t1.apPaterno as t1_apPaterno,
        t1.apMaterno as t1_apMaterno,
        t1.fechanacimiento as t1_fechanacimiento,
        t1.ci as t1_ci,
        t1.genero as t1_genero,
        t2.direccion AS t2_direccion, 
        t2.telefonoCelular as t2_telefonoCelular, 
        t2.telefonoFijo t2_telefonoFijo
        FROM `natural` t1
        inner join `cliente` t2 on t2.idCliente = t1.idCliente
        WHERE t1.idCliente =".$_idCliente." and t2.estado = 'Activo'";

        $res = $this->Execute($sql);

        $osNatural = new Structure_Natural;
        

        if($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);

            foreach($data as $item)
            {
               $osNatural->idCliente->SetValue($item["t1_idCliente"]);
               $osNatural->nombre->SetValue($item["t1_nombre"]);
               $osNatural->apPaterno->SetValue($item["t1_apPaterno"]);
               $osNatural->apMaterno->SetValue($item["t1_apMaterno"]);
               $osNatural->fechanacimiento->SetValue($item["t1_fechanacimiento"]);
               $osNatural->ci->SetValue($item["t1_ci"]);
               $osNatural->genero->SetValue($item["t1_genero"]);

               $osCliente = new Structure_Cliente;

               $osCliente->idCliente->SetValue($item["t1_idCliente"]);
               $osCliente->direccion->SetValue($item["t2_direccion"]);
               $osCliente->telefonoCelular->SetValue($item["t2_telefonoCelular"]);
               $osCliente->telefonoFijo->SetValue($item["t2_telefonoFijo"]);

               $osNatural->Cliente = $osCliente;

            }
        }
        return $osNatural;

    }
    
}



?>