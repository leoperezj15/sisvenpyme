<?php

/**
 * @author		Leonardo Perez Justiniano
 * @copyright 	2018
 * @version     1.0
 */

 require_once "field.inc";
 require_once "SubCategoria";
 require_once "UnidadMedida";
 require_once "Proveedor";


 class Structure_Producto
 {
 	public $idProducto;
 	public $hash;
 	public $nombre;
 	public $descripcion;
 	public $cantidadXunidad;
 	public $estado;
 	public $peso;
 	public $madein;
 	public $idsubCategoria;
 	public $idunidadMedida;
 	public $idProveedor;

 	public $SubCategoria;
 	public $UnidadMedida;
 	public $Proveedor;

 	function __construct()
 	{

 		$this->idProducto = new Field("int", true);
 		$this->hash = new Field("varchar");
 		$this->nombre = new Field("varchar");
 		$this->descripcion = new Field("varchar");
 		$this->cantidadXunidad = new Field("varchar");
 		$this->estado = new Field("enum");
 		$this->peso = new Field("varchar");
 		$this->madein = new Field("varchar");
 		$this->idsubCategoria = new Field("int");
 		$this->idunidadMedida = new Field("int");
 		$this->idProveedor = new Field("int");

 		$this->Subcategoria = new Structure_SubCategoria;
 		$this->UnidadMedida = new Structure_UnidadMedida;
 		$this->Proveedor = new Structure_Proveedor;


 	}

 }

?>