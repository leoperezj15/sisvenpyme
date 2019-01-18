<?php
require_once "data/db.inc";
require_once "data/Sucursal.inc";



class RN_Sucursal extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function ListaSucursal()
    {
        $sql = "SELECT idSucursal,Nombre FROM `sucursal`";
        $res = $this->Execute($sql);

        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osSucursal = new Structure_Sucursal;

                $osSucursal->idSucursal->SetValue($item["idSucursal"]);
                $osSucursal->Nombre->SetValue($item["Nombre"]);

                $listaSucursal[] = $osSucursal;                
            }            
        }
        
        return $listaSucursal;//devolver una lista[]
    }

}