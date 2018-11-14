        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.4.0
            </div>
            <strong>Copyright &copy; 2017-2018 <a href="">Almsaeed Studio</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/template/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url();?>assets/template/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url();?>assets/template/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/template/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url();?>assets/template/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url();?>assets/template/dist/js/demo.js"></script>
<script>
$(document).ready(function () {
	// para el modal de la vista de categorias
	var base_url="<?php echo base_url();?>";
	$(".btn-view").on("click",function())
	{
		var id = $($this).val();
		$.ajax({
			url: base_url + "Inventario/categoria/view/" + id,
			type: "POST",
			success:function(resp){
				alert(resp);
			}
		});
	}
	$('#example1').DataTable(
								{
									"languaje":{"lengthMenu": "Mostrar _MENU_ registros por pagina",
												"zeroRecords": "No se encuentran resultados en la busqueda",
												"searchPlaceholder": "Buscar registros",
												"info": "Mostrando registros de _START_ al _END_ de un total de _TOTAL_ registros",
												"infoEmpty": "No existen registros",
												"infofiltered": "(Filtrado de un total de _MAX_ registros)",
												"search": "Buscar",
												"paginate" : {
																"first" : "Primero",
																"last" : "Ultimo",
																"next" : "Siguiente",
																"previous" : "Anterior"
															}
												}		
								}
	);
	$('.sidebar-menu').tree();
})
</script>
</body>
</html>
