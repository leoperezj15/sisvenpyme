<?php

/**
 * @author		Leonardo Perez Justiniano
 * @company 	Blaufuß
 * @copyright 	2018
 * @version     1.0
 */

class Field
{
    private $type;
    private $key;
    private $value;
    
    function __construct($_type, $_key = false)
    {
        $this->type = $_type;
        $this->key  = $_key;
    }
    
    function SetValue($_value){
        $this->value = $_value;
    }
    function GetValue(){
        return $this->value;
    }
}

?>