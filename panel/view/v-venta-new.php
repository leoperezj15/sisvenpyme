<?php
//--Verificaion de que el usuarioeste logUp
if ( !isset($_SESSION["ACL"]) )
{
    header("location: index.php");
}
///////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////
require "../model/RN_Almacen.php";
require "../model/RN_Sucursal.php";

$oRN_Sucursal = new RN_Sucursal;
$oRN_Almacen = new RN_Almacen;

$listaSucursal = $oRN_Sucursal->ListaSucursal();


$idSucursal = "";

$selectSucursal = "<select id='sucursal'  class='form-control' onchange='ListarAlmacenPorSucursal1(this)'>";
foreach ($listaSucursal as $item) {
    if ($idSucursal == "") {
        $idSucursal = $item->idSucursal->GetValue();
    }

    $selectSucursal .= "<option value='" . $item->idSucursal->GetValue() . "'>" . $item->Nombre->GetValue() . "</option>";
}
$selectSucursal .= "</select>";

$listaAlmacen = $oRN_Almacen->listarAlmacenPorSucursal($idSucursal);


$selectAlmacen = "<select name='venta_add_almacen' id='almacen'  class='form-control'>";
foreach ($listaAlmacen as $item2) {
    $selectAlmacen .= "<option value='" . $item2->idAlmacen->GetValue() . "'>" . $item2->Nombre->GetValue() . "</option>";
}
$selectAlmacen .= "</select>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<!-- <div class="jumbotron"> -->
<div class="container">
    <div class="row">
        <div class="col-md-3 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Adicionar Productos</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Nombre de Producto</h6>
                        <small class="text-muted">
                            <input type="hidden" name="add_idproducto" id="add_idproducto" required>
                            <input type="text"  name="add_nombre" id="add_nombre" class="form-control" placeholder="Nombre" required>
                        </small>
                    </div>
                    
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Codigo</h6>
                        <small class="text-muted">
                            <input type="text"  name="add_codigo" id="add_codigo" class="form-control"placeholder="Codigo de Producto" required readonly>
                        </small>
                    </div>
                    
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Descripcion</h6>
                        <small class="text-muted">
                            <input type="text"  name="add_descripcion" id="add_descripcion" class="form-control" placeholder="descripcion"required readonly>
                            
                        </small>
                    </div>
                    
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Modelo</h6>
                        <small>
                            <input type="text"  name="add_modelo" id="add_modelo" class="form-control" placeholder="Modelo" required readonly>
                        </small>
                    </div>
                    
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Cantidad</h6>
                        <small> 
                            <input type="number" name="add_cantidad" id="add_cantidad" class="form-control" value="1" required>
                        </small>
                    </div>         
                </li>
                <li class="list-group-item justify-content-between bg-light">
                    <div class="text-muted">
                        <h6 class="my-0">% Descuento</h6>
                            <small>
                                <select class="custom-select" name="add_descuento" id="add_descuento">
                                    
                                    <option value="SD">Sin Descuento</option>
                                    <option value="0.05">5</option>
                                    <option value="0.10">10</option>
                                    <option value="0.15">15</option>
                                    <option value="0.20">20</option>
                                    <option value="0.25">25</option>
                                    <option value="0.30">30</option>

                                </select>
                            </small>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <div class="text-success">
                        <h6 class="my-0">Precio</h6>
                        <small> 
                            <div class="input-group">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><strong>Bs</strong></span>
                                </div>


                                <input type="number" class="form-control" name="add_precio" id="add_precio" value="0.00" required readonly>

                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>

                                <div class="input-group-append">
                                    <span class="input-group-text"><strong>.00</strong></span>
                                </div>

                            </div>

                        </small>
                    </div>
                    
                </li>
            </ul>

            <form class="card p-2">
                <div class="input-group">
                    <div class="pull-right">
                        <button type="button" class="btn btn-warning btn-lg btn-block" id="btnAdd" ><i class="fas fa-cart-plus"></i>   Agregar a la Lista</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-9 order-md-1 shadow-lg p-3 mb-5 bg-white rounded">
        
            <form namespace="add_venta" id="add_venta">
            <h2 class="mb-3">Venta</h2>

            

                <h5>Datos del Cliente</h5>
                
                <div class="row small">

                    <div class="col-sm-5 mb-1">
                        <input type="hidden" name="venta_add_idcliente" id="idCliente">

                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" placeholder="" required>

                        <div class="invalid-feedback">
                        Valid last name is required.
                        </div>
                    </div>

                    <div class="col-sm-3 mb-1">
                        
                        <label for="nit">Nro Documento</label>
                        <input type="number" class="form-control" id="nrodocumento" placeholder="" value="" required readonly>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    
                    <div class="col-sm-4 mb-1">
                        <label for="contacto">Direccion</label>
                        <input type="text" class="form-control" id="direccion" placeholder="" value="" readonly required>
                        <div class="invalid-feedback">
                        Valid last name is required.
                        </div>
                    </div>

                </div>
            

                <h5>Sucursal y Almacen para la Venta</h5>

                <div class="row small">

                    <div class="col-md-4 mb-2">
                        <label for="sucursal">Sucursal</label>
                        <?php echo $selectSucursal; ?>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-4 mb-2" id="cajon-almacen">
                        <label for="almacen">Almacen</label>
                        <?php echo $selectAlmacen; ?>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="fecha-compra">Fecha de Venta</label>
                        <input type="text" class="form-control" name="" id="fecha-compra" placeholder="" value="<?php echo date("d/m/Y");?>" readonly>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    
                </div>

            <hr class="mb-4">
            
            <div id="resultados"></div> <!-- Reciviendo datos de Ajax -->
            <div class="table" id="ctn-items"></div> <!-- Reciviendo datos de Ajax -->
                <button type="button" class="btn btn-danger" id="btnDeleteListItems" ><i class="fas fa-trash"></i> Borrar lista</button>
            <hr class="mb-4">
            
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="btnSaveVenta" id="btnSaveVenta">Procesar Compra</button>
            </form>
        </div>

        
    </div>
</div>

<script>
		$(function() {
						$("#nombre").autocomplete({
							source: "control/venta/autocom_cliente_venta.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#idCliente').val(ui.item.idCliente);
								$('#nombre').val(ui.item.nombre);
								$('#nrodocumento').val(ui.item.nrodocumento);
                                $('#direccion').val(ui.item.direccion);
																
								
							 }
						});
					});
					
	$("#nombre" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#idCliente" ).val("");
							$("#nombre" ).val("");
							$("#nrodocumento" ).val("");
                            $('#direccion').val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre" ).val("");
							$("#idCliente" ).val("");
							$("#nrodocumento" ).val("");
                            $('#direccion').val("");
						}
            });



            $(function() {
						$("#add_nombre").autocomplete({
							source: "control/venta/autocom_producto_venta.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#add_idproducto').val(ui.item.idproducto);
                                $('#add_codigo').val(ui.item.codigo);
                                $('#add_nombre').val(ui.item.value);
								$('#add_descripcion').val(ui.item.descripcion);
                                $('#add_modelo').val(ui.item.modelo);
                                $('#add_precio').val(ui.item.precio);
																
								
							 }
						});
					});
					
	$("#add_nombre" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || 
                        event.keyCode== $.ui.keyCode.RIGHT || 
                        event.keyCode== $.ui.keyCode.UP || 
                        event.keyCode== $.ui.keyCode.DOWN || 
                        event.keyCode== $.ui.keyCode.DELETE || 
                        event.keyCode== $.ui.keyCode.BACKSPACE )
						{
                            $("#add_nombre" ).val("");
							$("#add_idproducto" ).val("");
                            $("#add_codigo" ).val("");
                            $('#add_descripcion').val("");
                            $('#add_modelo').val("");
                            $('#add_precio').val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#add_idproducto" ).val("");
							$("#add_nombre" ).val("");
							$("#add_codigo" ).val("");
                            $('#add_descripcion').val("");
                            $('#add_modelo').val("");
                            $('#add_precio').val("");
						}
			});		
</script>

<!--incluimos modal add producto-->
<!--script de compras-->
<script src="view/js/venta/venta.js"></script>
<link rel="stylesheet" href="view/js/ui/1.11.4/jquery-ui.css">
<script src="view/js/ui/1.11.4/jquery-ui.js"></script>
<!-- </div> -->
<?php
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
?>
