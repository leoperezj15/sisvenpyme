$(function() {
    load(1);
});
function load(page){
    var query=$("#q").val();
    var per_page=10;
    var parametros = {"action":"ajax","page":page,'query':query,'per_page':per_page};
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'control/proveedor/listar_proveedor.php',
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
$('#editProveedorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal

  var idproveedor = button.data('idproveedor')
  $('#edit_idproveedor').val(idproveedor)
  var nit = button.data('nit') 
  $('#edit_nit').val(nit)
  var nombre = button.data('nombre')
  $('#edit_nombre').val(nombre)
  var contacto = button.data('contacto')
  $('#edit_contacto').val(contacto)
  var direccion = button.data('direccion')
  $('#edit_direccion').val(direccion)
  var telefonofijo = button.data('telefonofijo')
  $('#edit_telefonofijo').val(telefonofijo)
  var telefonocelular = button.data('telefonocelular')
  $('#edit_telefonocelular').val(telefonocelular)
  var correo = button.data('correo')
  $('#edit_correo').val(correo)
  var paginaweb = button.data('paginaweb')
  $('#edit_paginaweb').val(paginaweb)
 

})

$('#deleteProveedorModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var idproveedor = button.data('idproveedor') 
  $('#delete_idproveedor').val(idproveedor)
})


$( "#edit_proveedor" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/proveedor/editar_proveedor.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#editProveedorModal').modal('hide');
          }
    });
  event.preventDefault();
});


$( "#add_proveedor" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/proveedor/guardar_proveedor.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#addProveedorModal').modal('hide');
          }
    });
  event.preventDefault();
});

$( "#delete_proveedor" ).submit(function( event ) {
  var parametros = $(this).serialize();
    $.ajax({
            type: "POST",
            url: "control/proveedor/eliminar_proveedor.php",
            data: parametros,
             beforeSend: function(objeto){
                $("#resultados").html("Enviando...");
              },
            success: function(datos){
            $("#resultados").html(datos);
            load(1);
            $('#deleteProveedorModal').modal('hide');
          }
    });
  event.preventDefault();
});