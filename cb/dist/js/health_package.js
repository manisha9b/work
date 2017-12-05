$(document).ready(function() {

	$('.invite').click(function(e){

		var attr_values			=	$(this).attr("alt");
		var arr_values			=	attr_values.split('~');
		var cluster_package_id	=	arr_values[0];
		var package_nm			=	arr_values[1];
		
		$('#sort_by_date').hide();
		
		$('#cluster_package_id').val(cluster_package_id);
		$('#invite-title').html("Invite employees for "+package_nm);

		$('#div-list').addClass('hidden');
		$('#invite_employee').removeClass('hidden');
	});
)};