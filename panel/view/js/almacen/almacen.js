$(function() {
    load(1);
});
function load(page){
    var query=$("#q").val();
    var per_page=10;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'control/almacen/listar_almacen.php',
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
$('#editAlmacenModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idalmacen = button.data('idalmacen')
  $('#edit_idalmacen').val(idalmacen)
  var nombre = button.data('nombre') 
  $('#edit_nombre').val(nombre)
  var sigla = button.data('sigla') 
  $('#edit_sigla').val(sigla)
  var sucursal = button.data('sucursal')
  $('#edit_sucursal').val(sucursal)

})

$('#deleteAlmacenModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idAlmacen = button.data('idAlmacen') 
  $('#delete_idAlmacen').val(idAlmacen)
})


$( "#edit_almacen" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/almacen/editar_almacen.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#editAlmacenModal').modal('hide');
          }
    });
  event.preventDefault();
});


$( "#add_almacen" ).submit(function( event ) {
  var parametros = $(this).serialize();
  alert(parametros);
    $.ajax({
            type: "POST",
            url: "control/almacen/guardar_almacen.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#addAlmacenModal').modal('hide');
          }
    });
  event.preventDefault();
});

$( "#delete_almacen" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/almacen/eliminar_producto.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#deleteAlmacenModal').modal('hide');
          }
    });
  event.preventDefault();
});