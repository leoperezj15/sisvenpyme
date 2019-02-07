$(function() {
    load(1);
});
function load(page){
    var query=$("#q").val();
    var per_page=10;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'control/compra/listar_compra.php',
        data: parametros,
        beforeSend: function(objeto){
        $("#loader").html("Cargando...");
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $("#loader").html("");
        }
    })
}
$(document).ready(function() {
	
    $("#btnAdd").click(function(){
        idproducto = $("#add_idproducto").val();
		nombre = $("#add_nombre").val();
		if(nombre=="")
		{
			alert("Selecione un producto");
			document.getElementById('add_nombre').focus();
			return false;
		}
		codigo = $("#add_codigo").val();
		descripcion = $("#add_descripcion").val();
		modelo = $("#add_modelo").val();
		cantidad = $("#add_cantidad").val();
		precio = $("#add_precio").val();
		if(precio=="0.00" || precio=="0")
		{
			alert("El precio no puede ser 0");
			document.getElementById('add_precio').focus();
			return false;
		}
		
        $.ajax({
            type	: 'post',
            url		: 'control/compra/detalle_compra.php',
            data    : 'fn=AddItem&idproducto=' + idproducto + '&nombre=' + nombre + '&codigo='+ codigo +'&descripcion=' + descripcion +'&modelo=' +modelo+ '&cantidad=' +cantidad+ '&precio='+precio,
            success : function (res){
                $("#ctn-items").html(res);
            }
        })

	})
	$("#btnDeleteListItems").click(function(){
		
        $.ajax({
            type	: 'post',
            url		: 'control/compra/detalle_compra.php',
            data    : 'fn=DeleteListItems',
            success : function (res){
                $("#ctn-items").html(res);
            }
        })

    })
    
    $("#").click(function(){

        idproveedor = $("#compra_add_idproveedor").val();
        idalmacen = $("#compra_add_almacen").val();
		fechacompra = $("#compra_add_fechacompra").val();
		montototal = $("#compra_add_montototal").val();
		nrofactura = $("#compra_add_nrofactura").val();
		alert("algo " + idproveedor + idalmacen + fechacompra + montototal + nrofactura);//)
        $.ajax({
            type	: 'post',
            url		: 'control/compra/detalle_compra.php',
            data    : 'fn=SaveCompra&idproveedor=' + idproveedor + '&idalmacen=' + idalmacen + '&fechacompra=' + fechacompra + '&montototal=' + montototal + '&nrofactura=' + nrofactura,//
            success : function (res){
                $("#resultados").html(res);
            }
        })			
    })

});

function ListarAlmacenPorSucursal1(obj){

idSucursal = $(obj).val();
$.ajax({
    type	: 'post',
    url		: 'control/compra/recurso_compra.php',
    data    : 'idSucursal=' + idSucursal,
    success : function (res){
        $("#cajon-almacen").html(res);
    }
})

}

function buscarProveedor(e,obj) {
    tecla = (document.all) ? e.keyCode : e.which;
    nit = $(obj).val();
    if (tecla==13) 
    {
        alert ('Has pulsado enter y ' + nit);
        $.ajax({
            type	: 'post',
            url		: 'control/compra/buscarproveedor_compra.php',
            data    : 'nit=' + nit,
            success : function (res){
                $("#cajon-almacen").html(res);
            }
        })
    }
    
}
$( "#add_compra" ).submit(function( event ) {
	var parametros = $(this).serialize();
	  $.ajax({
			  type: "POST",
			  url: "control/compra/detalle_compra.php",
			  data: "fn=SaveCompra&"+parametros,
			  success: function(datos){
				  //alert(datos);
			  $("#resultados").html(datos);
			}
	  });
	event.preventDefault();
  });
