<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufu�
 * @copyright 	2018
 * @version     1.0
 */

require_once "config.inc";

class Database
{
    private $serverName = "localhost";
    private $user = "root";
    private $pswd = "";
    private $dbName = "acl";
        
    private $link;
    private $op = 1; // 1: xamp, 2: easyphp
    
    function Open()
    {
        if ($this->op == 1){
            $this->link = mysqli_connect($this->serverName, $this->user, $this->pswd);
            mysqli_select_db($this->link, $this->dbName);
        }else{
            $this->link = mysql_connect($this->serverName, $this->user, $this->pswd);
            mysql_select_db($this->dbName, $this->link);
        }
        
        return $this->link;
    }
    
    /**
     * @return : true or false
     * */
    function Execute($_sql){
        if ($this->op == 1){
            $res = mysqli_query($this->link, $_sql);
        }else{
            $res = mysql_query($_sql);
        }
        
        return $res;
    }
    
    function GetLastIdAutoGenerated()
    {
        if ($this->op == 1){
            return mysqli_insert_id($this->link);
        }else{
            return mysql_insert_id();
        }
    }
    
    function ContainsData($res)
    {
        if ($this->op == 1){
            return mysqli_num_rows($res);
        }else{
            return mysql_num_rows($res);
        }
    }
    
    function DataListStructure($_res)
    {
    	$i=0;
	    $ret = array();
        
        if ($this->op == 1){
            while ($row = mysqli_fetch_assoc($_res)) {
    	        foreach ($row as $key => $value) {
    	            $ret[$i][$key] = $value;
    	            }
    	        $i++;
         	}
        }else{
            while ($row = mysql_fetch_assoc($_res)) {
    	        foreach ($row as $key => $value) {
    	            $ret[$i][$key] = $value;
    	            }
    	        $i++;
         	}
        }        
	    
	    return ($ret);	    
    }
    
    function FetchArray($_res){
        if ($this->op == 1){
            $array = mysqli_fetch_array($_res);
        }else{
            $array = mysql_fetch_array($_res);
        }
        
        return $array;
    }
}

?>