$(function() {
    load(1);
});
function load(page){
    var query=$("#q").val();
    var per_page=10;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'control/venta/listar_venta.php',
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
        descuento = $("#add_descuento").val();
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
            url		: 'control/venta/detalle_venta.php',
            data    : 'fn=AddItem&idproducto=' + idproducto + '&nombre=' + nombre + '&codigo='+ codigo +'&descripcion=' + descripcion +'&modelo=' +modelo+ '&cantidad=' +cantidad+ '&precio='+precio +'&descuento='+descuento,
            success : function (res){
                $("#ctn-items").html(res);
            }
        })

	})
	$("#btnDeleteListItems").click(function(){
		
        $.ajax({
            type	: 'post',
            url		: 'control/venta/detalle_venta.php',
            data    : 'fn=DeleteListItems',
            success : function (res){
                $("#ctn-items").html(res);
            }
        })

    })
});
function ListarAlmacenPorSucursal1(obj){

    idSucursal = $(obj).val();
    $.ajax({
        type	: 'post',
        url		: 'control/venta/recurso_venta.php',
        data    : 'idSucursal=' + idSucursal,
        success : function (res){
            $("#cajon-almacen").html(res);
        }
    })
    
}
$( "#add_venta" ).submit(function( event ) {
	var parametros = $(this).serialize();
	  $.ajax({
			  type: "POST",
			  url: "control/venta/detalle_venta.php",
			  data: "fn=SaveVenta&"+parametros,
			  success: function(datos){
				  //alert(datos);
			  $("#resultados").html(datos);
			}
	  });
	event.preventDefault();
  });
