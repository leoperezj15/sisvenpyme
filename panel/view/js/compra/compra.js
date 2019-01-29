$(document).ready(function(){
    load(1);
});

function load(page){
    var q= $("#q").val();
    var parametros = {"action":"ajax" , "page":page , "q":q}
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'/control/compra/producto_compra.php',//producto_factura
        data: parametros,
         beforeSend: function(objeto){
         $('#loader').html(' Cargando...');//<img src="./img/ajax-loader.gif">
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            
        }
    })
}

function agregar (id)
		{
			var precio_venta=document.getElementById('precio_venta_'+id).value;
			var cantidad=document.getElementById('cantidad_'+id).value;
			//Inicia validacion
			if (isNaN(cantidad))
			{
			alert('Esto no es un numero');
			document.getElementById('cantidad_'+id).focus();
			return false;
			}
			if (isNaN(precio_venta))
			{
			alert('Esto no es un numero');
			document.getElementById('precio_venta_'+id).focus();
			return false;
			}
			//Fin validacion
			
			$.ajax({
        type: "POST",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id+"&precio_venta="+precio_venta+"&cantidad="+cantidad,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});
		}
		
		function eliminar (id)
		{
			
			$.ajax({
        type: "GET",
        url: "./ajax/agregar_facturacion.php",
        data: "id="+id,
		 beforeSend: function(objeto){
			$("#resultados").html("Mensaje: Cargando...");
		  },
        success: function(datos){
		$("#resultados").html(datos);
		}
			});

		}
		
		$("#datos_factura").submit(function(){
		  var id_cliente = $("#id_cliente").val();
		  var id_vendedor = $("#id_vendedor").val();
		  var condiciones = $("#condiciones").val();
		  
		  if (id_cliente==""){
			  alert("Debes seleccionar un cliente");
			  $("#nombre_cliente").focus();
			  return false;
		  }
		 VentanaCentrada('./pdf/documentos/factura_pdf.php?id_cliente='+id_cliente+'&id_vendedor='+id_vendedor+'&condiciones='+condiciones,'Factura','','1024','768','true');
	 	});
		
		$( "#guardar_cliente" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_cliente.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})
		
		$( "#guardar_producto" ).submit(function( event ) {
		  $('#guardar_datos').attr("disabled", true);
		  
		 var parametros = $(this).serialize();
			 $.ajax({
					type: "POST",
					url: "ajax/nuevo_producto.php",
					data: parametros,
					 beforeSend: function(objeto){
						$("#resultados_ajax_productos").html("Mensaje: Cargando...");
					  },
					success: function(datos){
					$("#resultados_ajax_productos").html(datos);
					$('#guardar_datos').attr("disabled", false);
					load(1);
				  }
			});
		  event.preventDefault();
		})


$(document).ready(function() {
	
    $("#btnAdd").click(function(){
        idproducto = $("#add_idproducto").val();
		nombre = $("#add_nombre").val();
		codigo = $("#add_codigo").val();
		descripcion = $("#add_descripcion").val();
		modelo = $("#add_modelo").val();
		cantidad = $("#add_cantidad").val();
		precio = $("#add_precio").val();
		
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
    
    $("#btnSave").click(function(){
        nom = $("#nom").val();
        ape = $("#ape").val();
        ema = $("#ema").val();
        tel = $("#tel").val();

        $.ajax({
            type	: 'post',
            url		: 'control/compra/detalle_compra.php',
            data    : 'fn=SavePedido&nom=' + nom + '&ape=' + ape + '&ema=' + ema + '&tel=' + tel,
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
