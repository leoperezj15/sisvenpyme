$(document).ready(function(e) {
	$('#submit').click(function(){
		var nombre = $('#nombre').val();
		$ajax({
			type:'POST',
			data:{nombre:nombre},
			url:"control/modulo/add.php", //php page URL where we post this data to save in databse
			success: function(result){
			
				$('#alert').show();
				
				$('#show').html(result);
						
				
			}
		})
	});
});