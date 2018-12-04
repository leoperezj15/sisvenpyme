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
        $sql = "Insert into natural values (
				" . $_osNatural->idCliente->GetValue() . ",
				'" . $_osNatural->nombre->GetValue() . "',
                '" . $_osNatural->apPaterno->GetValue() . "',
                '" . $_osNatural->apMaterno->GetValue() . "',
                '" . $_osNatural->fechanacimiento->GetValue() . "',
                '" . $_osNatural->ci->GetValue() . "',
                '" . $_osNatural->genero->GetValue() . "')";

        $res = $this->Execute($sql);

		$r = $res ? true : false;
		return $r;
    }
    function VerificarCI($_ci)
    {
        $sql = "select * from natural where ci=".$_ci."";
        $res = $this->Execute($sql);
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
                $osNatural = new Structure_Natural;

                $osNatural->idCliente->SetValue($item['idCliente']);
                $osNatural->nombre->SetValue($item['nombre']);
                $osNatural->apPaterno->SetValue($item['apPaterno']);
                $osNatural->apMaterno->SetValue($item['apMaterno']);
                $osNatural->fechanacimiento->SetValue($item['fechanacimiento']);
                $osNatural->ci->SetValue($item['ci']);
                $osNatural->genero->SetValue($item['genero']);
 				
            }            
        }
        
        return $osNatural;
    }
}



?>