<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

require_once "field.inc";


 class Structure_UnidadMedida
 {
 	public $idUnidadMedida;
 	public $nombre;
 	public $abrev;
 	public $descripcion;

 	function __construct()
 	{
 		$this->idUnidadMedida = new Field("int", true);
 		$this->nombre = new Field("varchar");
 		$this->abrev = new Field("varchar");
 		$this->descripcion = new Field("varchar");

 	}
 }



?>