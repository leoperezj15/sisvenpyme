<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Empleado.inc";
                     
class RN_Empleado extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funci�n para obtener la lista de empleado(s) 
     * @return Lista de Structure_Modulo
     */
    function GetListEmpleado()
    {
        $sql = "Select idEmpleado, hash, nombre, apPaterno, apMaterno, DATE_FORMAT(fechaNacimiento,'%d/%m/%Y') as fechaNacimiento, ci from empleado where estado = 'Activo'";
        $res = $this->Execute($sql);
        
        $listEmpleado = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osEmpleado = new Structure_Empleado;

 				$osEmpleado->idEmpleado->SetValue($item["idEmpleado"]);
 				$osEmpleado->hash->SetValue($item["hash"]);
 				$osEmpleado->nombre->SetValue($item["nombre"]);
                $osEmpleado->apPaterno->SetValue($item["apPaterno"]);
                $osEmpleado->apMaterno->SetValue($item["apMaterno"]);
                $osEmpleado->fechaNacimiento->SetValue($item["fechaNacimiento"]);
                $osEmpleado->ci->SetValue($item["ci"]);

 				$listEmpleado[] = $osEmpleado;                
            }            
        }
        
        return $listEmpleado;
    }
    /**
     * Funcion para verificar si existe empleado en realcion a su CI
     */
    function VerificarEmpleado($_ci)
    {
        $sql = "Select * from empleado where ci=" .base64_decode($_ci). "";
        $res = $this->Execute($sql);
        if ($this->ContainsData($res))
        {
            $data = $this->DataListStructure($res);
            return true;          
        }
        else
        {
            return false;
        }
    }
    /** 
     * @abstract Funci�n para obtener los Datos de modulo(s)
     * @param string hash
     * @return Structure_Modulo
     */
    function GetData($_hash)
    {
        $sql = "Select * from modulo where hash = '". $_hash . "'";
        $res = $this->Execute($sql);
        
        $osModulo = new Structure_Modulo;
        
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);            
            
            foreach($data as $item)
            {
 				$osModulo->idModulo->SetValue($item["idModulo"]);
 				$osModulo->hash->SetValue($item["hash"]);
 				$osModulo->nombre->SetValue($item["nombre"]);
 				$osModulo->estado->SetValue($item["estado"]);
            }            
        }
        
        return $osModulo;
    }
    
    /** 
     * @abstract Funcion para guardar Empleado
     * @param Structure_Modulo osEmpleado
     * @return bool
     */
    function SaveEmpleado($_osEmpleado)
    {
        $sql = "Insert into empleado values (
                " . $_osEmpleado->idEmpleado->GetValue() . ",
                '" . $_osEmpleado->hash->GetValue() . "',
				'" . base64_decode($_osEmpleado->nombre->GetValue()) . "',
                '" . base64_decode($_osEmpleado->apPaterno->GetValue()) . "',
                '" . base64_decode($_osEmpleado->apMaterno->GetValue()) . "',
                '" . $_osEmpleado->fechaNacimiento->GetValue() . "',
                '" . base64_decode($_osEmpleado->ci->GetValue()) . "',
				'" . $_osEmpleado->estado->GetValue() . "')";

        $res = $this->Execute($sql);

		$id   = $this->GetLastIdAutoGenerated();
		$hash = sha1($id);
		$sql2 = "Update empleado set hash = '". $hash ."' where idEmpleado = " . $id;
		$res2 = $this->Execute($sql2);
        
        $r = ($res and $res2) ? true : false;
		return $r;
    }
    
    /** 
     * @abstract Funci�n para actualizar modulo
     * @param Structure_Modulo osModulo
     * @return bool
     */
    function Update($_osModulo)
    {
        $sql = "Update modulo set 
					nombre = '" . $_osModulo->nombre->GetValue() . "',
					estado = '" . $_osModulo->estado->GetValue() . "'
				where hash = '" . $_osModulo->hash->GetValue() . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
    
    /** 
     * @abstract Funci�n para eliminar modulo
     * @param string hash
     * @return bool
     */
    function Delete($_hash)
    {
        $sql = "Update modulo set estado = 'Inactivo' where hash = '" . $_hash . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
}
                
?>