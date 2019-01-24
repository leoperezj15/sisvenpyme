<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "data/db.inc";
require_once "data/Almacen.inc";
require_once "data/Sucursal.inc";
                     
class RN_Almacen extends DataBase
{
    function __construct()
    {
        $this->Open();
    }
    function GetAlmacenList()
    {
        $sql = "SELECT t1.idAlmacen AS t1_idAlmacen,t1.Nombre AS t1_Nombre,t1.Sigla AS t1_Sigla,t2.Nombre AS t2_Nombre 
        FROM almacen t1
        INNER JOIN sucursal t2 on t1.idSucursal=t2.idSucursal
        ORDER BY t1.idAlmacen ASC";
        $res = $this->Execute($sql);
        
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osAlmacen = new Structure_Almacen;
                $osSucursal = new Structure_Sucursal;

                $osAlmacen->idAlmacen->SetValue($item["t1_idAlmacen"]);
                $osAlmacen->Nombre->SetValue($item["t1_Nombre"]);
                $osAlmacen->Sigla->SetValue($item["t1_Sigla"]);
                $osSucursal->Nombre->SetValue($item["t2_Nombre"]);
                
                $osAlmacen->Sucursal = $osSucursal;

                $listAlmacen[] = $osAlmacen;                
            }            
        }
        
        return $listAlmacen;//devolver una lista[]
    }
    function ListarAlmacen($_page,$_query,$_per_page)
    {
        $tables="almacen";
        $campos="*";
        $sWhere=" Nombre LIKE '%".$query."%'";
        $sWhere.=" order by Nombre";

        include 'control/almacen/pagination.php';

        $adjacents  = 4;

        $offset = ($page - 1) * $per_page;

        $sql1 = "SELECT count(*) AS numrows FROM $tables where $sWhere ";
        $res = $this->Execute($sql1);

        if($this->ConstainsData($res))
        {
            if($row = $this->FetchArray($res))
            {
                $numrows = $row['numrows'];
            }
        }
        $total_pages = ceil($numrows/$per_page);

        $sql2 = "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page";
        $res2 = $this->Execute($sql2);

        if($this->ConstainsData($res2))
        {
            if($row2 = $this->FetchArray($res2))
            {
                $camposAlmacen = array(
                    'idAlmacen' => $row2['idAlmacen'],
                    'Nombre' => $row2['Nombre'],
                    'Sigla' => $row2['Sigla'],
                    'idSucrusal' => $row2['idSucursal'],
            );
            }
        }
        return $camposAlmacen;

    }
    function listarAlmacenPorSucursal($_idSucursal)
    {
        $sql = "select * from almacen where idSucursal=$_idSucursal";
        $res = $this->Execute($sql);
        $list = array();
        if ($this->ContainsData($res)){
            $data = $this->DataListStructure($res);
            foreach($data as $item)
            {
                $osAlmacen = new Structure_Almacen;

                $osAlmacen->idAlmacen->SetValue($item["idAlmacen"]);
                $osAlmacen->Nombre->SetValue($item["Nombre"]);
                $osAlmacen->Sigla->SetValue($item["Sigla"]);
                $osAlmacen->idSucursal->SetValue($item["idSucursal"]);

                $listAlmacen[] = $osAlmacen;                
            }            
        }
        
        return $listAlmacen;//devolver una lista[]

    }
}