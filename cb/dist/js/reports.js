
		  $(document).ready(function(){
			  //alert("d2");
		  	$('#change_package').change(function(){
				alert("d");
		$('#change_package option:selected').each(function(){
		$('#last_package_statistics').html('<br /><br /><br /><p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p><br /><br /><br />');
			var id = $(this).val();
        	$.ajax({
			url: 'lps.php?package_id='+id,
			success: function(response){
					$('#last_package_statistics').html(response);
				}
			});
		});
	});
	});
