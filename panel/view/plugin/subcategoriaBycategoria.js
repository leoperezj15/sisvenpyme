function GetListSubCategoria(obj){

	idCategoria = $(obj).val();

	$.ajax({
		type	: 'post',
		url		: 'control/x-fn.php',
		data    : 'fn=GetListSubCategoria&idCategoria=' + idCategoria,
		success : function (res){
			$("#ctn-SubCategoria").html(res);
		}
	})

}