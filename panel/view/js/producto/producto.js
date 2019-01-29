$(function() {
    load(1);
});
function load(page){
    var query=$("#q").val();
    var per_page=10;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'control/producto/listar_producto.php',
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
$('#editProductoModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idproducto = button.data('idproducto')
  $('#edit_idproducto').val(idproducto)
  var codigo = button.data('codigo') 
  $('#edit_codigo').val(codigo)
  var nombre = button.data('nombre')
  $('#edit_nombre').val(nombre)
  var descripcion = button.data('descripcion')
  $('#edit_descripcion').val(descripcion)
  var modelo = button.data('modelo')
  $('#edit_modelo').val(modelo)
  var estado = button.data('estado')
  $('#edit_estado').val(estado)
  var peso = button.data('peso')
  $('#edit_peso').val(peso)
  var madein = button.data('madein')
  $('#edit_madein').val(madein)
  var idcategoria = button.data('idcategoria')
  $('#comboCategoria').val(idcategoria)
  var idsubcategoria = button.data('idsubcategoria')
  $('#comboSubCategoria').val(idsubcategoria)
  var idunidadmedida = button.data('idunidadmedida')
  $('#ctn-SubCategoria').val(idsubcategoria)
  var idunidadmedida = button.data('idunidadmedida')
  $('#comboUnidadMedida').val(idunidadmedida)
 

})

$('#deleteProductoModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idproducto = button.data('idproducto') 
  $('#delete_idproducto').val(idproducto)
})


$( "#edit_producto" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/producto/editar_producto.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#editProductoModal').modal('hide');
          }
    });
  event.preventDefault();
});


$( "#add_producto" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/producto/guardar_producto.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#addProductoModal').modal('hide');
          }
    });
  event.preventDefault();
});

$( "#delete_producto" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/producto/eliminar_producto.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#deleteProductoModal').modal('hide');
          }
    });
  event.preventDefault();
});