<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Inventario.inc";
                     
class RN_Inventario extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function Save($_osInventario)
    {
        $sql = "INSERT into inventario values (
				" . $_osInventario->idAlmacen->GetValue() . ",
                " . $_osInventario->idProducto->GetValue() . ",
                " . $_osInventario->Stock->GetValue() . ",
				'" . $_osInventario->estado->GetValue() ."')";

        $res = $this->Execute($sql);
        
        return $res;
    }
    function Update($_osInventario)
    {
        $sql = "UPDATE inventario set 
        Stock = '" . $_osInventario->Stock->GetValue() . "' 
        WHERE idAlmacen = " . $_osInventario->idAlmacen->GetValue() . " 
        AND idProducto = ".$_osInventario->idProducto->GetValue();

        $res = $this->Execute($sql);

        return $res;


    }
    function Verifcar($_osInventario)
    {
        $sql = "SELECT * From inventario 
        WHERE idAlmacen=".$_osInventario->idAlmacen->GetValue()."
        AND idProducto=".$_osInventario->idProducto->GetValue();

        $res = $this->Execute($sql);

        if($this->ContainsData($res))
        {

            $row = $this->FetchArray($res);
            $Stock = $row["Stock"];
            return $Stock;
    
        }
        else
        {
            return false;
        }

    }
    function VerificarStock($_osInventario)
    {
        $sql = "SELECT Stock FROM `inventario` 
        WHERE idAlmacen=".$_osInventario->idAlmacen->GetValue()." 
        AND idProducto=".$_osInventario->idProducto->GetValue();

        $res = $this->Execute($sql);

        if($this->ContainsData($res))
        {

            $row = $this->FetchArray($res);
            $Stock = $row["Stock"];
            return $Stock;
    
        }
        else
        {
            return false;
        }

    }
    
    
}
                
?>