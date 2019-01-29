<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

 require_once "field.inc";
 require_once "SubCategoria.inc";
 require_once "UnidadMedida.inc";



 class Structure_Producto
 {
 	public $idProducto;
 	public $hash;
 	public $nombre;
 	public $descripcion;
 	public $modelo;
 	public $estado;
 	public $peso;
 	public $madein;
	public $codigo;
 	public $idsubCategoria;
 	public $idunidadMedida;

 	public $SubCategoria;
 	public $UnidadMedida;

 	function __construct()
 	{

 		$this->idProducto = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->descripcion = new Field("varchar");
 		$this->modelo = new Field("varchar");
 		$this->estado = new Field("enum");
 		$this->peso = new Field("varchar");
 		$this->madein = new Field("varchar");
		$this->codigo = new Field("varchar");
 		$this->idsubCategoria = new Field("int");
 		$this->idunidadMedida = new Field("int");

 		$this->SubCategoria = new Structure_SubCategoria;
 		$this->UnidadMedida = new Structure_UnidadMedida;


 	}

 }

?>