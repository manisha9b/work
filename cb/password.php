<?php include_once('partials/header3.php'); 
unset($arr_ebh_pack);
$appt_count_arr	=	$database->getAppointmentCount($clusterId);
$arr_cluster_empl = $database->getclusterEbhPackageEmployee($clusterId);
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
		<div class="col-md-12">
      <h3 class="pull-left">
        <b>Change Password</b>
      </h3>
      <div class="pull-right resright">
	  <?php include_once('partials/askme.php')       ;?>
         </div>      
	  </div>
	  <div class="clearfix"></div>
	  <hr class="hrdivide" />
    </section>
    
	
    <!-- Main content -->
    <section class="content">
		
		<div class="col-md-12">
		<!-- <div class="pull-right">
			<span>Timeframe<span> :
				<select style="font-weight: bold;background: transparent;border:none;display: inline-block;width: 125px;height: auto;padding: 0 5px;">
					<option>Last 6 months</option>
					<option>Last 12 months</option>
				</select>
		</div>    -->    
		</div>

	  
		
		<div class="col-md-12 mt-20 purchase_pack">
			<!-- <div class="pagination">
				<span>1-2 of 18</span>
			  <a href="#"><</a>
			  <a href="#">></a>
			</div> -->
			
			
			<div id="appointments" class="nav-tabs-custom mb-65">
			<?php
	$form_action = "portal/password.php";
?>
			<div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  	<form role="form" class="form-horizontal" method="post" action="<?php echo $form_action;?>" name="frmchangepass" id="frmchangepass"
	enctype="multipart/form-data" autocomplete="off">
	<div class="panel-body">
	  <div class="form-group">
		<label class="col-sm-2 control-label">  </label>
		<div class="col-sm-7">
		  <div id="message_div_pwd"></div>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label"> Old Password </label>
		<div class="col-sm-4">
		  <input type="password" class="form-control input-sm" id="old_password" name="old_password"  required>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label"> New Password </label>
		<div class="col-sm-4 ">
		  <input type="password" class="form-control input-sm" id="new_password" name="new_password" required>
		  <span id="msg_new_password" class="help-inline text-danger"></span> </div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label">Re-Type Password </label>
		<div class="col-sm-4 tooltips">
		  <input type="password" class="form-control input-sm" id="new_re_password" name="new_re_password" required>
		  <span id="msg_new_re_password" class="help-inline text-danger"></span> </div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label"> </label>
		<div class="col-sm-4 tooltips">
		  <button type="submit" class="btn btn-success btn-submit btn-sm"> Save</button>
		  <button type="Reset" class="btn btn-danger btn-sm"> Reset</button>
		</div>
	  </div>
	</div>
	</form>
                </div>
                <!-- /.tab-pane -->  
                </div>
			</div>
		</div>
      
      <!-- /.row -->
		<div class="col-md-12 employee_summary" id="divMsg">	

<!--employee-show-hide-area-ended-here-->     
<div class="row pt-20">
   <!-- /.row -->    
</div>
<!-- /.col -->
    </section>
    <!-- /.content -->

  </div>

  <!-- Modal -->  
<div id="appt_summary">
</div>

</div>
<!-- ./wrapper --> 

<?php include_once('partials/footer.php'); ?>

<script src="dist/js/bootstrap-datepicker.min.js"></script>



<script>

$(document).ready(function(){
	
	 /* $('#reportsdatatables').DataTable({
		  "sPaginationType": "bootstrap",
		  'lengthChange'      : false,
		 'searching'   : false,
		  
	  });*/

	/*$('#reportsdatatables_filter').hide();
	$('#reportsdatatables_length').hide();
	$('#reportsdatatables_info').css('padding','10px');
	$('.dataTables_paginate ').css('padding','10px');
	$('#search_name').keyup(function(){
		ptable.fnFilter($(this).val());
		/*$('#excel_btn').attr('data-filter-name', $(this).val());
 		$('#reset_btn').show();*/
	});
	});
</script>
<script>
  $(function () {
	  
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
	 // appointmentLoad();
    /*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [], totalPoints = 100

    function getRandomData() {

      if (data.length > 0)
        data = data.slice(1)

      // Do a random walk
      while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y    = prev + Math.random() * 10 - 5

        if (y < 0) {
          y = 0
        } else if (y > 100) {
          y = 100
        }

        data.push(y)
      }


      // Zip the generated y values with the x values
      var res = []
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }

      return res
    } 
   
	   $('.report_menu').addClass('active');


  
    
   $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 });
</script><script>$(document).ready(function() {	$('#showmenu').click(function() {			$('.slidingDiv').slideToggle("");	});	});	</script>
</body>
</html>
