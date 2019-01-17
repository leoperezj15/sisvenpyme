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
        $sql = "select * from `view_cliente_general_activo` where NroDocumento = '".$_NroDocumento."'";
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
    function GetListCliente()
    {
        $sql = "SELECT * FROM `view_cliente_general_activo` order by idCliente";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
                $osClienteGeneral = new Structure_ClienteGeneral;

 				$osClienteGeneral->idCliente->SetValue($item["idCliente"]);
 				$osClienteGeneral->nombreCompleto->SetValue($item["NombreCompleto"]);
 				$osClienteGeneral->nroDocumento->SetValue($item["NroDocumento"]);
                $osClienteGeneral->direccion->SetValue($item["Direccion"]);
                $osClienteGeneral->celular->SetValue($item["Celular"]);
                $osClienteGeneral->tipoCliente->SetValue($item["tipoCliente"]);
                $list[] = $osClienteGeneral;

            }            
        }
        return $list;
    }
    function SaveCliente($_osCliente)
    {
        $sql = "Insert into cliente values(
				" . $_osCliente->idCliente->GetValue() . ",
				'" . $_osCliente->direccion->GetValue() . "',
				'" . $_osCliente->telefonoFijo->GetValue() . "',
                '" . $_osCliente->telefonoCelular->GetValue() . "',
                '" . $_osCliente->estado->GetValue() . "')";
        $res = $this->Execute($sql);

		$id   = $this->GetLastIdAutoGenerated();
		
		return $id;
    }
    function DeleteCliente($_idCliente)
    {
        $sql = "Update cliente set estado = 'Inactivo' where idCliente = '" . $_idCliente . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
    function UpdateCliente($_osCliente)
    {
        $sql = "Update cliente set 
					direccion = '" . $_osCliente->direccion->GetValue() . "',
                    telefonoFijo = '" . $_osCliente->telefonoFijo->GetValue() . "',
                    telefonoCelular = '" . $_osCliente->telefonoCelular->GetValue(). "'
				where idCliente = '" . $_osCliente->idCliente->GetValue() . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
}
                
?>