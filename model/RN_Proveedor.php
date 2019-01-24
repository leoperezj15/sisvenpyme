<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Proveedor.inc";

                     
class RN_Proveedor extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    
    /** 
     * @abstract Funcion para obtener un proveedor(s) 
     * @return Lista de Structure_Proveedor
     */
    function UnProveedor($_dato)
    {
        $return_arr = array();
        $dato = $this->RealScapeString($_dato);
        $sql ="select `idProveedor`,  `Nit`, `nombre`, `contacto` from proveedor where `nombre` like '%" . $dato . "%' and  LIMIT 0 ,50";
        $res = $this->Execute($sql);
        $list = array();
        if ($this->ContainsData($res)){
            while($row = $this->FetchArray($res))
            {
                $idProveedor = $row['idProveedor'];
                $row_array['value'] = $row['nombre'];
                $row_array['idProveedor'] = $idProveedor;
                $row_array['nit'] = $row['nit'];
                $row_array['nombre'] = $row['nombre'];
                $row_array['contacto'] = $row['contacto'];
                array_push($return_arr,$row_array);
                
            }        
        }
        
        return $return_arr;
    }
    function Verificar_Nit($_nit)
    {
        $sql = "SELECT Nit FROM `proveedor` WHERE Nit=$_nit";
        $res = $this->Execute($sql);
        if ($this->ContainsData($res)){
            return true;
        }
        else
        {
            return false;
        }
    }
    function Verificar_Nombre($_nombre)
    {
        $sql = "SELECT nombre FROM `proveedor` WHERE Nit=$_nombre";
        $res = $this->Execute($sql);
        if ($this->ContainsData($res)){
            return true;
        }
        else
        {
            return false;
        }
    }
    function Edit($_osProveedor)
    {
        $sql = "Update proveedor SET 
                    Nit = '" . $_osProveedor->nit->GetValue() . "',
					nombre = '" . $_osProveedor->nombre->GetValue() . "',
					contacto = '" . $_osProveedor->contacto->GetValue() . "',
					direccion = '" . $_osProveedor->direccion->GetValue() . "',
					telefonoFijo = " . $_osProveedor->telefonoFijo->GetValue() . ",
					telefonoCelular = " . $_osProveedor->telefonoCelular->GetValue() . ",
                    correo = '" . $_osProveedor->correo->GetValue() . "',
                    paginaWeb = '" . $_osProveedor->paginaWeb->GetValue() . "'
				where idProveedor = '" . $_osProveedor->idProveedor->GetValue() . "'";
        $res = $this->Execute($sql);
        
        return $res;
    }
    function Listar()
    {
        
    }
    function Delete($_idproveedor)
    {
        $sql = "Update proveedor set
                    estado = 'Inactivo'
                where idProveedor = $_idproveedor";
        $res = $this->Execute($sql);

        return $res;
    }
    
}                
?>