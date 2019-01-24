$(document).ready(function(){
    load(1);
});

function load(page){
    var q= $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./ajax/productos_factura.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');
            
        }
    })
}

$(document).ready(function() {
	
    $("#btnAdd").click(function(){
        can = $("#can").val();
        prod = $("#prod").val();

        $.ajax({
            type	: 'post',
            url		: 'control/x-fn.php',
            data    : 'fn=AddItem&data=' + prod + '&can=' + can,
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
            url		: 'control/x-fn.php',
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