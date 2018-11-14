<?php
                
/**
 * @author		Leonardo Perez Justiniano
 * @version     1.0
 */
                
require_once "field.inc";
require_once "Cliente.inc";

                     
class Structure_Juridico
{

 	public $idCliente;
 	public $razonSocial;
 	public $rpteLegal;
 	public $nit;

    Public $Cliente;
 
    function __construct()
    { 
 		$this->idCliente = new Field("int", true);
 		$this->razonSocial = new Field("varchar");
 		$this->rpteLegal = new Field("varchar");
 		$this->nit = new Field("varchar");

        $this->Cliente = new Structure_Cliente;
	}
}
                
?>