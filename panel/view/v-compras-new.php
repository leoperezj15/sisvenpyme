<?php
///////////////////////////////////////////////////////////////////////////////////////////////////
//Validacion del detalle de venta
$idProductoV = "";
$almacen = "";
$producto = "";
$cantidad = 0;
$precio = 0;
$subTotal = 0;
if (isset($_SESSION["DetalleVenta"]))
{
$DetalleVenta = $_SESSION["DetalleVenta"];
$MostrarDetalleVenta = "";
$MostrarDetalleVenta = "<tr>";
$total = 0;
foreach ($DetalleVenta as $item2)
{
    
    $idProductoV = $item2["idProducto"];
    $idAlmacen = $item2["idAlmacen"];
    $producto = " ".$item2["descripcion"]." ".$item2["codigo"]."";
    $cantidad = $item2["cantidad"];
    $precio = $item2["precio"];
    $subTotal = $item2["cantidad"]*$item2["precio"];
    $MostrarDetalleVenta .="
        <td>".$idAlmacen."</td>
        <td>".$producto."</td>
        <td>".$cantidad."</td>
        <td>".$precio."</td>
        <td>".$subTotal."</td>
    ";
    $MostrarDetalleVenta .= "</tr>";
    $total += $subTotal;
}

$MostrarDetalleVenta.="<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><h4>Total</h4></td>
                            <td><h4>BOB ".$total."</h4></td>

                       </tr>";

}
else
{
$MostrarDetalleVenta ="No hay productos :(";
}


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


$selectAlmacen = "<select id='almacen'  class='form-control'>";
foreach ($listaAlmacen as $item2) {
    $selectAlmacen .= "<option value='" . $item2->idAlmacen->GetValue() . "'>" . $item2->Nombre->GetValue() . "</option>";
}
$selectAlmacen .= "</select>";
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Su Carrito</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$12</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Second product</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$8</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Third item</h6>
                        <small class="text-muted">Brief description</small>
                    </div>
                    <span class="text-muted">$5</span>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                    <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                        <small>EXAMPLECODE</small>
                    </div>
                    <span class="text-success">-$5</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$20</strong>
                </li>
            </ul>

            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 order-md-1 shadow-lg p-3 mb-5 bg-white rounded">
            <h4 class="mb-3">Compra de Productos</h4>
            <form class="needs-validation" novalidate>
            <h5>Datos del Proveedor</h5>
            
            <div class="row small">

                <div class="col-sm-5 mb-1">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="" value="" autocomplete="off" required>
                    <div class="invalid-feedback">
                    Valid last name is required.
                    </div>
                </div>

                <div class="col-sm-3 mb-1">
                    <input type="hidden" id="idProveedor">
                    <label for="nit">Nit</label>
                    <input type="number" class="form-control" id="nit" placeholder="" value="" required readonly>
                    <div class="invalid-feedback">
                        Valid first name is required.
                    </div>
                </div>
                
                <div class="col-sm-4 mb-1">
                    <label for="contacto">Persona Contacto</label>
                    <input type="text" class="form-control" id="contacto" placeholder="" value="" readonly required>
                    <div class="invalid-feedback">
                    Valid last name is required.
                    </div>
                </div>

            </div>

            <h5>Datos de la Factura de Compra</h5>
            <div class="row small">
                <div class="col-md-6 mb-1">
                    <label for="nro-factura">Nro Factura</label>
                    <input type="number" class="form-control" id="nro-factura" placeholder="" value="" required>
                    <div class="invalid-feedback">
                         Valid first name is required.
                    </div>
                </div>
                <div class="col-md-6 mb-1">
                    <label for="fecha-compra">Fecha de la Compra</label>
                    <input type="date" class="form-control" id="fecha-compra" placeholder="" value="" required>
                    <div class="invalid-feedback">
                    Valid last name is required.
                    </div>
                </div>
            </div>

            <h5>Sucursal y Almacen a Ingresar</h5>
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
                <div class="col-md-4 mb-2" id="cajon-almacen">
                    <label for="fecha-compra">Fecha de Ingreso</label>
                    <input type="text" class="form-control" id="fecha-compra" placeholder="" value="<?php echo date("d/m/Y");?>" readonly>
                    <div class="invalid-feedback">
                         Valid first name is required.
                    </div>
                </div>
                
            </div>
            <hr class="mb-4">
            <h5>Adicionar Productos a la Lista</h5>
            <div class="row small">

                <input type="hidden" name="add_idproducto" id="add_idproducto">

                <div class="col-12">
                    <div class="input-group">
                        <!-- <div class="input-group-prepend">
                            <span class="input-group-text">Producto</span>
                        </div> -->
                        <input type="text"  name="add_nombre" id="add_nombre" class="form-control" placeholder="Nombre">
                        <input type="text"  name="add_codigo" id="add_codigo" class="form-control"placeholder="Codigo de Producto" readonly>
                        <input type="text"  name="add_descripcion" id="add_descripcion" class="form-control" placeholder="descripcion"readonly>
                        <input type="text"  name="add_modelo" id="add_modelo" class="form-control" placeholder="Modelo" readonly>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-sm-5 mb-1">
                
                    <label for="add_cantidad">Cantidad</label>
                    <input type="text" name="add_cantidad" id="add_cantidad" class="form-control">

                    <div class="invalid-feedback">
                    Valid last name is required.
                    </div>

                </div>

                <div class="col-sm-5 mb-1">
                
                    <label for="add_precio">Precio</label>

                    <div class="input-group">

                        <div class="input-group-prepend">
                            <span class="input-group-text">Bs</span>
                        </div>

                        
                        <input type="text" class="form-control" name="add_precio" id="add_precio" >

                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>

                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>

                    </div>

                </div>


                <div class="col-sm-2 mb-1">
                <label for="">Agregar</label>
                    <div class="pull-right">
                        <button type="button" class="btn btn-warning" id="btnAdd" ><i class="fas fa-cart-plus"></i></button>
                    </div>
                </div>
            </div>
            
            <div class="table" id="ctn-items">
            
            </div>
                <button type="button" class="btn btn-danger" id="btnDeleteListItems" ><i class="fas fa-trash"></i> Borrar lista</button>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit">Procesar Compra</button>
        </form>
        </div>
    </div>
</div>
<script>
		$(function() {
						$("#nombre").autocomplete({
							source: "control/compra/autocom_proveedor_compra.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#idProveedor').val(ui.item.idProveedor);
								$('#nombre').val(ui.item.nombre);
								$('#nit').val(ui.item.nit);
                                $('#contacto').val(ui.item.contacto);
																
								
							 }
						});
					});
					
	$("#nombre" ).on( "keydown", function( event ) {
						if (event.keyCode== $.ui.keyCode.LEFT || event.keyCode== $.ui.keyCode.RIGHT || event.keyCode== $.ui.keyCode.UP || event.keyCode== $.ui.keyCode.DOWN || event.keyCode== $.ui.keyCode.DELETE || event.keyCode== $.ui.keyCode.BACKSPACE )
						{
							$("#idProveedor" ).val("");
							$("#nombre" ).val("");
							$("#nit" ).val("");
                            $('#contacto').val("");
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#nombre" ).val("");
							$("#idProveedor" ).val("");
							$("#nit" ).val("");
                            $('#contacto').val("");
						}
            });



            $(function() {
						$("#add_nombre").autocomplete({
							source: "control/compra/autocom_producto_compra.php",
							minLength: 2,
							select: function(event, ui) {
								event.preventDefault();
								$('#add_idproducto').val(ui.item.idproducto);
                                $('#add_codigo').val(ui.item.codigo);
                                $('#add_nombre').val(ui.item.value);
								$('#add_descripcion').val(ui.item.descripcion);
                                $('#add_modelo').val(ui.item.modelo);
																
								
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
											
						}
						if (event.keyCode==$.ui.keyCode.DELETE){
							$("#add_idproducto" ).val("");
							$("#add_nombre" ).val("");
							$("#add_codigo" ).val("");
                            $('#add_descripcion').val("");
                            $('#add_modelo').val("");
						}
			});		
</script>

<!--incluimos modal add producto-->
<?php include("view/compra/modal_addProducto.php");?>
<!--script de compras-->
<script src="view/js/compra/compra.js"></script>
<link rel="stylesheet" href="view/js/ui/1.11.4/jquery-ui.css">
<script src="view/js/ui/1.11.4/jquery-ui.js"></script>

