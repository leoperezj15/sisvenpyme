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
        $sql = "SELECT t1.idAlmacen AS t1_idAlmacen,t1.nombre AS t1_nombre,t1.abrev AS t1_abrev,t2.nombre AS t2_nombre 
        FROM almacen t1
        INNER JOIN sucursal t2 on t1.idSucursal=t2.idSucursal
        WHERE t1.estado='Activado'
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
                $osAlmacen->nombre->SetValue($item["t1_nombre"]);
                $osAlmacen->abrev->SetValue($item["t1_abrev"]);
                $osSucursal->nombre->SetValue($item["t2_nombre"]);
                
                $osAlmacen->Sucursal = $osSucursal;

                $list[] = $osAlmacen;                
            }            
        }
        
        return $list;//devolver una lista[]
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
}