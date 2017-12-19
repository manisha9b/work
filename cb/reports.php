<?php include_once('partials/header3.php'); 
unset($arr_ebh_pack);
$appt_count_arr	=	$database->getAppointmentCount($clusterId);
$arr_cluster_empl = $database->getclusterEbhPackageEmployee($clusterId);
?>
<style>

</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
		<div class="col-md-12">
      <h3 class="pull-left">
        <b>Employees Health Reports</b>
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
		  <div class="col-md-12 mb-10">
		  <h4><b>Summary</b></h4>
		</div>
		<div class="row mb-10">
		<div class="col-md-12 company_summary">
        <div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box2 bg_dark_blue">
            <span class="info-box-icon bg-aqua dark_blue_clr"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1"><?php echo ($appt_count_arr[0]['onboarded_employee']>0)?$appt_count_arr[0]['onboarded_employee']:00;?></span>
              <span class="info-box-number text-white">ONBOARDED <span style="font-size: 12px;">EMPLOYEES</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		 <!--  <div class="summary_add text-center"><a href="#">Add more employees</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box3 healthy_employee">
            <span class="info-box-icon icon2 bg_dark_blue1 text-white"><i class="fa fa-calendar-check-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1"><?php echo ($appt_count_arr[0]['total_appointment']>0)?$appt_count_arr[0]['total_appointment']:0;?></span>
              <span class="info-box-number text-white">APPOINTMENTS <span style="font-size: 12px;">BOOKED</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <!-- <div class="summary_add text-center"><a href="#">Send reminders to others</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box4 evoucher_download">
            <span class="info-box-icon icon3 text-white"><i class="fa fa-download"></i></span></span>

             <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1"><?php echo ($appt_count_arr[0]['voucher_downloaded']>0)?$appt_count_arr[0]['voucher_downloaded']:'0&nbsp;&nbsp;&nbsp;';?></span>
              <span class="info-box-number text-white">eVOUCHERS <span style="font-size: 12px;">DOWNLOADED</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		   <!-- <div class="summary_add text-center"><a href="#">Send reminders to others</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box4 unhealthy_employee">
            <span class="info-box-icon icon3"><img src="images/ecg_icon.png" width="35"></span>

             <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1"><?php echo ($appt_count_arr[0]['tests_taken_count']>0)?$appt_count_arr[0]['tests_taken_count']:'0&nbsp;&nbsp;&nbsp;';?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <span class="info-box-number text-white">TESTS <span style="font-size: 12px;">TAKEN</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <!-- <div class="summary_add text-center"><a href="#">Say Congratulations</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box4 report_present">
            <span class="info-box-icon icon3 text-white"><i class="fa fa-file-text-o"></i></span></span>

             <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1"><?php echo ($appt_count_arr[0]['total_report_available']>0)?$appt_count_arr[0]['total_report_available']:'0&nbsp;&nbsp;&nbsp;';?>&nbsp;&nbsp;</span>
              <span class="info-box-number text-white">REPORTS <span style="font-size: 12px;">AVAILABLE</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <!-- <div class="summary_add text-center"><a href="#">Add more employees</a></div>
          <!-- /.info-box -->
        </div>
		<!-- /.col -->
		</div>
      </div> 
	  
	  
		
		<div class="col-md-12 mt-20 purchase_pack">
			<!-- <div class="pagination">
				<span>1-2 of 18</span>
			  <a href="#"><</a>
			  <a href="#">></a>
			</div> -->
			
			
			<div id="appointments" class="nav-tabs-custom mb-65">
			<ul class="nav nav-tabs">
           <!-- <li class="active">
				<div class="dropdown">
				  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background: #3D4452;
padding:9.5px;border-radius: 0!important;">PRE EMPLOYMENT <span class="caret"></span></a>
				  <ul class="dropdown-menu purchase_drop_down" style="width: 140%;">
					<li><a href="#">Pre Employment</a></li>
					<li><a href="#">Annual Checkup</a></li>
					<li><a href="#">Package Type A</a></li>
					<li><a href="#">Add Tabs</a></li>
				  </ul>
				</div>				
			</li>
                <li><a href="#tab_2-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false">CURRENT EMPLOYEES</a></li>
                <li><a href="#tab_3-2" onclick="return hidesummary()" data-toggle="tab">All</a></li> -->	
                <li class="pull-right nohover1">
                  <!-- search form -->
                  <form action="#" method="get" class="sidebar-form1" style="display: inline-block;background: #FFFFFF;">
                    <div class=" inner-addon left-addon">
                      <i class="fa fa-search"></i>
                      <input type="text" name="q" class="form-control" id="search_name" placeholder="Type To Search">
                    </div>
                  </form>
                  <!-- /.search form -->
                </li>
               <!-- <li class="pull-right dropdown nohover1">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Sort By <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu"> 
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sort By</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Date &amp; Time</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Location</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Status</a></li>
                  </ul> 
                </li>   -->             
            </ul>
			<div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <?php //echo "<pre>".print_R($arr_cluster_empl)."</pre>" ?>
                   <table class="table table-hover" <?php if(!empty($arr_cluster_empl)){ echo "id='reportsdatatables'";} ?>>
                   <thead>
                      <tr style="background: transparent;" >
					  <th width="5%"></th>
                        <th style="text-align:left!important;padding-bottom:20px!important">
                         Employee
                        </th>
						
                       <th style="padding-bottom:20px!important">Date of visit</th>
<th style="text-align:left!important;padding-left:50px;padding-bottom:20px!important">Package</th>
<th style="padding-bottom:20px!important">Health Report</th>
<th style="padding-bottom:20px!important">Vital Information</th>
                      </tr> </thead> <tbody>
					    <?php
					//  echo ' <tr><td>';
					  if(count($arr_cluster_empl)>0)
{
	foreach($arr_cluster_empl as $i => $row)
 {
		$package_name = $database->getclusterEbhPackage($database->clusterId,$row['cluster_package_id']);

	if(!empty($row['report_name']))
	{
	    $reports_list_arr = '';
		$employee_name = "".$row['salutation']." ".$row['first_name']." ".$row['last_name']."";
		//$reports_list_arr = "<div class='media'>";
		$reports_name_list_arr = explode(',', $row['report_name']);
		$reports_pach_list_arr = explode(',', $row['report_path']);
		$emp_name_to_file_name = str_replace(' ', '_', $employee_name);
		$pach_list_to_file_name = str_replace('http://ebhconsole.easybuyhealth.com/portal/media/patient-report/', '', $row['report_path']);
		$pach_list_to_file_name = str_replace('http://app.easybuyhealth.com/portal/media/patient-report/', '', $pach_list_to_file_name);

		foreach($reports_name_list_arr as $key => $name)
		 {
		 //	$reports_list_arr .= "<a href='".$reports_pach_list_arr[$key]."' target='_blank'><i class='fa fa-file-o'></i> ".$name."</a><hr style='margin-top:6px;margin-bottom:6px;'>";
		 $reports_list_arr .= "<li><a href='".$reports_pach_list_arr[$key]."' target='_blank'><i class='fa fa-download'></i> ".$name."</a></li>";
		 }

		//$reports_list_arr .= "<li><a href='".EBH_HTTP_SERVER."portal/media/patient-report/reports-zip.php?files=".$pach_list_to_file_name."&emp=".$emp_name_to_file_name."'>Download All</a></li>";
		$reports_list = '	<div class="btn-group emp_action_btn">
					  <button type="button" class="btn btn-success btn-flat">Reports</button>
					  <button type="button" class="btn  btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
						'.$reports_list_arr.'
						
					  </ul>
					</div>';
		/*$reports_list = '<div class="btn-group emp_action_btn">
					  <button type="button" class="btn btn-success btn-flat">Action</button>
					  <button type="button" class="btn  btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="javascript:void(0);" ><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a></li>
						<li><a href="javascript:void(0);" ><i class="fa fa-list-alt" aria-hidden="true"></i>View</a></li>
						'.$reports_list_arr.'
					  </ul>
					</div>';*/
	//	$reports_list = '<div style="cursor: pointer;" data-toggle="popover" data-placement="left" data-content="'.$reports_list_arr.'" role="button" data-original-title="<a href=# class=pull-right data-dismiss=popover>&times</a> Health Reports&nbsp;&nbsp;&nbsp;">Reports <i class="fa fa-chevron-down"></i></div>';
	}
	else
	{
		$reports_list = "Not Available";
	}
$photo	= (!empty($row['photo_thumb'])) ? $row['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
	$vital_arr = Array(
		0 => Array(
			'title' => 'Bp',
			'value' => $row['bp']
		),
		1 => Array(
			'title' => 'Temp',
			'value' => $row['temp']
		),
		2 => Array(
			'title' => 'Pulse',
			'value' => $row['pulse_rate']
		),
		3 => Array(
			'title' => 'Resp.',
			'value' => $row['resp_rate']
		),
		4 => Array(
			'title' => 'Height',
			'value' => $row['height']
		),
		5 => Array(
			'title' => 'Weight',
			'value' => $row['weight']
		),
		6 => Array(
			'title' => 'BMI',
			'value' => $row['bmi']
		),
	);

	$vital_list_arr = "<ul class='list-group details-list'>";

	foreach($vital_arr as $vital)
	 {
		 $vital_value = ($vital['value'] != '') ? $vital['value'] : "-";
		 $vital_list_arr .= "<li class='list-group-item'><span class='pull-right'>".$vital_value."</span>".$vital['title']."&nbsp;&nbsp;&nbsp;</li>";
	 }

	$vital_list_arr .= "</ul>";
	$vital_list = '<div style="cursor:pointer;width:100%" data-toggle="popover" data-placement="left" data-content="'.$vital_list_arr.'" role="button" data-original-title="<a href=\'javascript:void(0)\' class=\'pull-right close\' >&times</a> Vital Information&nbsp;&nbsp;&nbsp;">Click Here</div>';

	$employee_list_data_arr = array("".$row['salutation']."".$row['first_name']." ".$row['last_name']."", $row['visited_on'], $package_name[0]['package_nm'], $reports_list, $vital_list);

	if($row['salutation'] == 'Mr.' or $row['salutation'] == 'Kumar.' or $row['salutation'] == 'Shri.')
	{
	echo "<tr>
	<td class=\"table_circle emp_pic\" style=\"padding-left:2px;padding-right:2px;\"><img src=\"".$photo."\"  class=\"img-circle\"></td>
	<td>".$row['employee_name']." ".$row['ebh_customer_id']."</td>

	<td align='center'>".$row['visited_on']."</td>
	<td>".$package_name[0]['package_nm']."</td>
	<td align='center'>".$reports_list."</td>
	<td align='center'>".$vital_list."</td>
	</tr>\n";
	}
	elseif($row['salutation'] == 'Ms.' or $row['salutation'] == 'Mrs.' or $row['salutation'] == 'Kumari.')
	{
	echo "<tr>
	<td class=\"table_circle emp_pic\" style=\"padding-left:2px;padding-right:2px;\"><img src=\"".$photo."\"  class=\"img-circle\"></td>
	<td>".$row['employee_name']." ".$row['ebh_customer_id']."</td>
	
	<td align='center'>".$row['visited_on']."</td>
	<td>".$package_name[0]['package_nm']."</td>
	<td align='center'>".$reports_list."</td>
	<td align='center'>".$vital_list."</td>
	</tr>\n";
	}
    else
    {
    echo "<tr>
	<td class=\"table_circle emp_pic\" style=\"padding-left:2px;padding-right:2px;\"><img src=\"".$photo."\"  class=\"img-circle\"></td>
	<td>".$row['employee_name']." ".$row['ebh_customer_id']."</td>

	<td align='center'>".$row['visited_on']."</td>
	<td>".$package_name[0]['package_nm']."</td>
	<td align='center'>".$reports_list."</td>
	<td align='center'>".$vital_list."</td>
	</tr>\n";
    }
 }
 }
	else
{

	echo'<tr>
		<td colspan="7"  class="text-center">No Records found!!</td>
	</tr>';
	
} ?>	
				
                     </tbody>
                  </table>
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

<script src="<?php echo EBH_WEBSITE_URL?>js/tooltips-popovers.js"></script>


<script>
function showApptDiv(id){
	$.ajax({
				url: 'appointment_div.php',
				type: 'post',
				data: 'appt_id='+id,
				success: function(response) {
					$('#divMsg').html(response);
					$('#divMsg').show();
					 $(document).scrollTo('#divMsg','slow');
					 appointmentLoad();
				}
			})
}
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
	});
</script>
<script>
  $(function () {
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
