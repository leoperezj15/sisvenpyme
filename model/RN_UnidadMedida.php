<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/UnidadMedida.inc";
                     
class RN_UnidadMedida extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un cliente(s) 
     * @return Lista de Structure_ClienteGeneral
     */
    function GetListUnidadMedida()
    {
        $sql = "Select * from unidadmedida";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osUnidadMedida = new Structure_UnidadMedida;

 				$osUnidadMedida->idunidadMedida->SetValue($item["idunidadMedida"]);
 				$osUnidadMedida->nombre->SetValue($item["nombre"]);
 				$osUnidadMedida->abrev->SetValue($item["abrev"]);
 				$osUnidadMedida->descripcion->SetValue($item["descripcion"]);

 				$list[] = $osUnidadMedida;                
            }            
        }
        
        return $list;
    }
    
}
                
?>