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
		$(document).scrollTo('.content-header');
		
	});

	$('#btn-cancel').click(function(e){

		$('#sort_by_date').show();
		$('#cluster_package_id').val('');
		$('#invite-title').html("Invite employees");

		$('#div-list').removeClass('hidden');
		$('#invite_employee').addClass('hidden');
	});

	$("#frminvite").validate({
        rules:{
            required:{
                required:true
            }
        },
		messages: {
			fileupload:"Employee excel data can not be blank"
		},
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });
	$('.know_more').click(function(e){
		var id			=	$(this).attr("alt");
		$('#detail_'+id).toggleClass('hidden');

	});

	$('#emp_list').hide();
	$('#newemployee').hide();
	$('#clusterpkgfile').click(function () {
        $('#emp_list').hide('fast');
        $('#newemployee').hide('fast');
        $('#fileupload').show('fast');
    });
    $('#clusterpkgemp').click(function () {
        $('#fileupload').hide('fast');
        $('#newemployee').hide('fast');
        $('#emp_list').show('fast');
    });
    $('#clusterpkgnewemp').click(function () {
        $('#fileupload').hide('fast');
        $('#emp_list').hide('fast');
        $('#newemployee').show('fast');
    });

	$("#frmchangepass").validate({
		rules:{
			required:{
				required:true
			},
			old_password:{
				required:true
			},
			new_password:{
				required:true
			},
			new_re_password:{
				required:true,
				equalTo: "#new_password"
			}
		},
		errorClass: "help-inline text-danger",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.form-group').addClass('has-error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.form-group').removeClass('has-error');
			$(element).parents('.form-group').addClass('has-success');
		},
		submitHandler: function(form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				success: function(response) {

					$('#message_div_pwd').html(response);


				}
			});
		}
	});

	var datepickerSelector_startdate = '#txtstartdate';
	$(datepickerSelector_startdate).datepicker({
		showOtherMonths: true,
		selectOtherMonths: true,
		dateFormat: "yy-mm-dd",
		yearRange: '-100:+0',
		maxDate: 'useCurrent',
		onSelect: function(selected)
		{
			$("#txtenddate").datepicker("option","minDate", selected)
		}

	}).prev('.btn').on('click', function (e) {
		e && e.preventDefault();
		$(datepickerSelector_startdate_1).focus();
	});

	$('#newdobdate').datepicker({
		dateFormat: "yy-mm-dd",
		maxDate: 'useCurrent',
	});

	$("#add_employee_form_temp").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        },
		submitHandler: function(form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				success: function(response) {
					$('#myModal').modal('hide');
					if(response == "success"){
						$("#add_employee_form").trigger('reset');
						$('#result').html('<div class="alert alert-success alert-dismissable" style="width:450px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>New employee added successfully!</p></div>');
						setTimeout(function(){ document.location.href = "cindex.php?page=employee"; }, 1000);
					}else{
						$('#result').html(response);
					}
				}
			});
		}

    });

    $("#edit_employee_form_temp").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        },
		submitHandler: function(form) {
			$.ajax({
				url: form.action,
				type: form.method,
				data: $(form).serialize(),
				success: function(response) {
					$('#myModal').modal('hide');
					if(response == "update_success"){
						$("#edit_employee_form").trigger('reset');
						$('#result').html('<div class="alert alert-success alert-dismissable" style="width:450px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>Employee details updated successfully!</p></div>');
						$('#myEditModal').modal('hide');
						$('#edit_employee_form').html('<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>');
					}else{
						$('#result').html(response);
					}
				}
			});
		}

    });

    $("#add_employee_form").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });
	
	$("#invite_employee_form").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });

    $("#add_employee_file").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        },
        submitHandler: function(form) {
			$.ajax({
				url: 'portal/employee/add-employee-file.php',
				type: 'POST',
				//data: $("#add_employee_file").serialize(),
				data: new FormData($('#add_employee_file')[0]),
        		cache: false,
        		contentType: false,
        		processData: false,
				success: function(response){
						$('#add_employee_file_block').html(response);
				}
			});
		}
    });
	
    $("#edit_employee_form").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });

    $("#schedule_confirmation_form").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });

    $("#edit_cluster_email").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });

    $("#edit_cluster_landline").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });

    $("#edit_cluster_mobile").validate({
        rules:{
            required:{
                required:true
            },
        },
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });


});

$(document).ready(function(){
	$("#contact_landline_input").mask("+91 99 9999 9999");
	$("#contact_mobile_input").mask("+91 9999999999");
});

$(document).ready(function(){
	$("#emp_weight").keyup(function(){
		var emp_h  = $('#emp_height').val();
		var emp_w  = $('#emp_weight').val();
		var emp_hn = (emp_h / 100);
		var emp_bmi = (emp_w / emp_hn / emp_hn);
		var emp_bmi_n = emp_bmi.toFixed(1);
		if(emp_bmi_n != 'NaN' && emp_bmi_n != 'Infinity'){
			$('#emp_bmi').val(emp_bmi_n);
		}
	});

	$("#emp_height").keyup(function(){
		var emp_h  = $('#emp_height').val();
		var emp_w  = $('#emp_weight').val();
		var emp_hn = (emp_h / 100);
		var emp_bmi = (emp_w / emp_hn / emp_hn);
		var emp_bmi_n = emp_bmi.toFixed(1);
		if(emp_bmi_n != 'NaN' && emp_bmi_n != 'Infinity'){
			$('#emp_bmi').val(emp_bmi_n);
		}
	});
});

function openEditModal(emp_id){
	$('#edit_employee_form').html('<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>');
		$.ajax({
			url: 'portal/employee/emp_modal.php?id='+emp_id+'&method=edit',
			success: function(response) {
                     $('#edit_employee_form').html(response);
				}
		});
		$('#myEditModal').modal('show');
}

function openViewModal(emp_id){
	$('#view_employee_form').html('<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>');
		$.ajax({
			url: 'portal/employee/emp_modal.php?id='+emp_id+'&method=view',
			success: function(response) {
                     $('#view_employee_form').html(response);
				}
		});
		$('#myViewModal').modal('show');
}

function openPkgModal(id){
	$('#pkg_table').html('<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>');
		$.ajax({
			url: 'portal/employee/pkg.info.php?id='+id+'',
			success: function(response) {
                     $('#pkg_table').html(response);
				}
		});
		$('#pkgModal').modal('show');
}

function checkEmail(field){
	var email = $(field).val();
	$.ajax({
		url: '/app/portal/modules/cluster-dashboard/employee/check-email.php?email='+email,
		success: function(data) {
			
        	if(data){
				$(field).parents('.form-group').removeClass('has-success');
            	$(field).parents('.form-group').addClass('has-error');				
            	$(field).val('');
				$(field).next('#email_msg').show('slow');
				
			}else{				
				$('[id=email_msg]').hide('slow');
				$(field).parents('.form-group').addClass('has-success');
			}
		}
	});
};

function checkMobile(field){
	var mobile = $(field).val();
	$.ajax({
		url: '/app/portal/modules/cluster-dashboard/employee/check-mobile.php?mobile='+mobile,
		success: function(data) {
        	if(data){
				$(field).parents('.form-group').removeClass('has-success');
            	$(field).parents('.form-group').addClass('has-error');
            	
				$(field).val('');$(field).next('#phone_msg').show('slow');
			}else{				
				$('[id=phone_msg]').hide('slow');
				$(field).parents('.form-group').addClass('has-success');
			}
		}
	});
};

function checkMobile(field){
	var mobile = $(field).val();
	$.ajax({
		url: '/app/portal/modules/cluster-dashboard/employee/check-mobile.php?mobile='+mobile,
		success: function(data) {
        	if(data){
				$(field).parents('.form-group').removeClass('has-success');
            	$(field).parents('.form-group').addClass('has-error');
            	
				$(field).val('');$(field).next('#phone_msg').show('slow');
			}else{				
				$('[id=phone_msg]').hide('slow');
				$(field).parents('.form-group').addClass('has-success');
			}
		}
	});
};

$(document).ready(function(){
	var error_log = document.getElementById('error_log');
	if(error_log){
		$.ajax({
			url: '/app/portal/modules/cluster-dashboard/error_logs/error-log.txt',
			success: function(data){
				if(data){
					$(error_log).html("<p></p><p>However, Please find the logs below:</p>"+data);
				}
			}
		});
	}
});

$(document).ready(function(){
	var hash = window.location.hash;
	if(hash){
		$('#schTab a[href="' + hash + '"]').tab('show');
		window.scrollTo(0, 0);
	}

	$('#sch_interval').change(function(){
		$('#sch_interval option:selected').each(function(){
			var intrv = $(this).attr('data-id');
			$('.selection-block').hide();
			$('.selection-block').find('select').prop('required', false);
			$('.selection-block').find('select').prop('selectedIndex', 0);
			$('#'+intrv).show();
			$('#'+intrv).find('select').prop('required', true);
		});
	});

	/*$('#sch_time').timepicker({
		minuteStep: 1
	});*/

	$('#vsch_interval').change(function(){
		$('#vsch_interval option:selected').each(function(){
			var intrv = $(this).attr('data-id');
			$('.selection-block').hide();
			$('.selection-block').find('select').prop('required', false);
			$('.selection-block').find('select').prop('selectedIndex', 0);
			$('#v'+intrv).show();
			$('#v'+intrv).find('select').prop('required', true);
		});
	});

	/*$('#vsch_time').timepicker({
		minuteStep: 1
	});*/
});

$(document).ready(function(){
    $('[data-toggle="popover"]').each(function() {
    	var button = $(this);
    	button.popover().on('shown.bs.popover', function(){
        	button.data('bs.popover').tip().find('[data-dismiss=popover]').on('click', function(){
            	button.popover('toggle');
				return false;
        	});
    	});
	});
});

$(document).ready(function(){
	
	 /* $('#reportsdatatables').DataTable({
		  "sPaginationType": "bootstrap",
		  'lengthChange'      : false,
		 'searching'   : false,
		  
	  });*/
	rtable = $('#reportsdatatables').dataTable({
		'lengthChange'      : false,
		 'searching'   : false,
		"sPaginationType": "bootstrap",
		"aoColumnDefs": [
			{"bSortable": false,"aTargets": [1]}
		]
	});
	$('#reportsdatatables_filter').hide();
	$('#reportsdatatables_length').hide();
	$('#reportsdatatables_info').css('padding','10px');
	$('.dataTables_paginate ').css('padding','10px');
	$('#search_name').keyup(function(){
		rtable.fnFilter($(this).val());	

	/*$('#reportsdatatables_filter').hide();
	$('#reportsdatatables_length').hide();
	$('#reportsdatatables_info').css('padding','10px');
	$('.dataTables_paginate ').css('padding','10px');
	$('#search_name').keyup(function(){
		ptable.fnFilter($(this).val());
		/*$('#excel_btn').attr('data-filter-name', $(this).val());
 		$('#reset_btn').show();*/
	});
/*
	
	
	$('#search_designation').keyup(function(){
		rtable.fnFilter($(this).val(), 3, true, false);
		$('#excel_btn').attr('data-filter-name', $(this).val());
 		$('#reset_btn').show();
	});
	
	$('#search_city').change(function(){
		$('#search_city option:selected').each(function(){
			rtable.fnFilter($(this).val(), 4, true, false);
			$('#excel_btn').attr('data-filter-city', $(this).val());
 			$('#reset_btn').show();
		});
	});
	
	$('#search_email').keyup(function(){
		rtable.fnFilter($(this).val(), 5, true, false);
		$('#excel_btn').attr('data-filter-name', $(this).val());
 		$('#reset_btn').show();
	});
	
	$('#search_mobile').keyup(function(){
		rtable.fnFilter($(this).val(), 6, true, false);
		$('#excel_btn').attr('data-filter-name', $(this).val());
 		$('#reset_btn').show();
	});	

	$('#search_gender').change(function(){
		$('#search_gender option:selected').each(function(){
			rtable.fnFilter($(this).val(), 2, true, false);
			$('#excel_btn').attr('data-filter-gender', $(this).val());
 			$('#reset_btn').show();
		});
	});
	
	$('#search_emp_gender').change(function(){
		$('#search_emp_gender option:selected').each(function(){
			rtable.fnFilter($(this).val(), 7, true, false);
			$('#excel_btn').attr('data-filter-gender', $(this).val());
 			$('#reset_btn').show();
		});
	});

	$('#search_bmi').change(function(){
		$('#search_bmi option:selected').each(function(){
			rtable.fnFilter($(this).val(), 3, true, false);
			$('#excel_btn').attr('data-filter-bmi', $(this).val());
 			$('#reset_btn').show();
		});
	});

	$('#search_package').change(function(){
		$('#search_package option:selected').each(function(){
			rtable.fnFilter($(this).val(), 5, true, false);
			$('#excel_btn').attr('data-filter-package', $(this).val());
 			$('#reset_btn').show();
		});
	});	
*/
	$('#excel_btn').click(function(){		
		var fname = $(this).attr('data-filter-name');
		var fgender = $(this).attr('data-filter-gender');
		var fbmi = $(this).attr('data-filter-bmi');
		var fpackage = $(this).attr('data-filter-package');
		var href = $(this).attr('href');
        var url = href+'&name='+fname+'&gender='+fgender+'&bmi='+fbmi+'&package='+fpackage;
        document.location.href = url;
	});
	
	$('#reset_btn').click(function(){
		rtable.fnFilter('', 0, true, false);
		rtable.fnFilter('', 1, true, false);
		rtable.fnFilter('', 2, true, false);
		rtable.fnFilter('', 3, true, false);
		rtable.fnFilter('', 4, true, false);
		rtable.fnFilter('', 5, true, false);
		rtable.fnFilter('', 6, true, false);
		rtable.fnFilter('', 7, true, false);
		$('#search_emp_form')[0].reset();
	});
});

$(document).ready(function(){
    $('[data-toggle="editmenu"]').click(function(){
    	$('.left_small_form').hide();
    	$('.left_small_txt').show();
    	var fieldId = $(this).attr('href');
    	$(fieldId+'_txt').hide();
    	$(fieldId+'_inp').show();
    	$(fieldId+'_inp input').focus();
    	return false;
    });

    $('[data-dismiss="editmenu"]').click(function(){    	
		var fieldId = $(this).attr('data-id');
    	$('#'+fieldId).show();
    	$('#'+fieldId+'_txt').show();
    	$(this).parents('.left_small_form').hide();
    });

    $('#sort_by_date').change(function(){
		$('#sort_by_date option:selected').each(function(){
			var url = '/app/portal/cindex.php?page=my_packages&sort='+$(this).val();
			document.location.href = url;
		});
	});

	$('#change_package').change(function(){
		$('#change_package option:selected').each(function(){
		$('#last_package_statistics').html('<br /><br /><br /><p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p><br /><br /><br />');
			var id = $(this).val();
        	$.ajax({
			url: '/app/portal/modules/cluster-dashboard/my_reports/lps.php?package_id='+id,
			success: function(response){
					$('#last_package_statistics').html(response);
				}
			});
		});
	});
});

$(document).ready(function(){
	$('#search_form').click(function(){
		var id = $(this).attr('href');
		$(id).slideToggle();
		$('#invitation_form').slideUp();
		$('.empinv').hide();
		return false;
	});
});

$(document).ready(function(){
	$('#send_invitation').click(function(){
		var id = $(this).attr('href');
		$(id).slideToggle();
		$('.empinv').toggle();
		$('#advanced_search').slideUp();
		return false;
	});
});

$(document).ready(function(){
	$('#select_all_emp').click(function(){
		var checkboxes = $(this).closest('#reportsdatatables').find(':checkbox');
		if($(this).is(':checked')){
			checkboxes.prop('checked', true);
		}else{
			checkboxes.prop('checked', false);
		}
	});
});

$(document).ready(function(){
	$('.dobdate').datepicker({
		format: "yyyy-mm-dd",
		startDate: "1900-01-01",
		endDate: 'useCurrent',
		autoclose: true
	});
	$("#dobdate").mask("9999-99-99");
	$("#mobile_no").mask("9999999999");
});

$(document).ready(function(){
	 $('.select2').select2();
});
function showHsp(cpid){
			$.ajax({
				url: 'portal/show_hsp.php',
				type: 'post',
				data: 'cpid='+cpid,
				success: function(response) {
					$('#hsp_content').html(response);
					$('#view_hsp').modal('show');
				}
			});
}