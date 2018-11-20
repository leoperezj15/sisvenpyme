<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/ClienteGeneral.inc";
require_once "data/Cliente.inc";
                     
class RN_Cliente extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) 
     * @return Lista de Structure_ClienteGeneral
     */
    function GetCliente($_NroDocumento)
    {
        $sql = "select * from `view_cliente_general` where NroDocumento = '".$_NroDocumento."'";
        $res = $this->Execute($sql);
        
        $osClienteGeneral = new Structure_ClienteGeneral;
        
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
 				$osClienteGeneral->idCliente->SetValue($item["idCliente"]);
 				$osClienteGeneral->nombreCompleto->SetValue($item["NombreCompleto"]);
 				$osClienteGeneral->nroDocumento->SetValue($item["NroDocumento"]);
                $osClienteGeneral->direccion->SetValue($item["Direccion"]);
                $osClienteGeneral->celular->SetValue($item["Celular"]);
                $osClienteGeneral->tipoCliente->SetValue($item["tipoCliente"]);

            }            
        }
        
        return $osClienteGeneral;
    }
}
                
?>