<?php include_once('partials/header3.php'); 
unset($arr_ebh_pack);
if(!empty($_GET['sort']))
{
	if($_GET['sort']=='latest'){$sortby='DESC';}else{$sortby='ASC';}
	$arr_ebh_pack	=	$database->getclusterEbhPackageDetail($clusterId, null, $sortby);
}
else
{
	$arr_ebh_pack	=	$database->getclusterEbhPackageDetail($clusterId);
}
$appt_count_arr	=	$database->getAppointmentCount($clusterId);
$appt_count_arr[0]['onboard'] = 10;
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
		<div class="col-md-12">
      <h3 class="pull-left">
        <b>My Company's Appointments</b>
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
              <span class="info-box-text text2 clr_effect1"><?php echo $appt_count_arr[0]['onboard']?></span>
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
              <span class="info-box-text text2 clr_effect1"><?php echo $appt_count_arr[0]['onboard']?></span>
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
              <span class="info-box-text text2 clr_effect1"><?php echo $appt_count_arr[0]['onboard']?></span>
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
              <span class="info-box-text text2 clr_effect1"><?php echo $appt_count_arr[0]['onboard']?></span>
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
              <span class="info-box-text text2 clr_effect1"><?php echo $appt_count_arr[0]['total_report_available']?></span>
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
			
			<div class="mb-10">
				<h4><b>Purchased Packages</b></h4>
			</div>
			<div id="appointments" class="nav-tabs-custom mb-65">
			<div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <table id="appttab" class="table table-appointment2 responsive-table">
                    <tbody>
                      <tr style="background: transparent;">
                        <th>
                          PURCHASED ON
                        </th>
                        <th>
                          PACKAGE NAME
                        </th>
                        <th>
                          HSP
                        </th>
                        <th class="text-center">
                          ANALYTICS
                        </th>
                      </tr>
					    <?php
					//  echo ' <tr><td>';
					  if(count($arr_ebh_pack)>0)
{
	for($i=0;$i<count($arr_ebh_pack);$i++)
	{
		//echo "<pre>";
		if ($i % 2) {
$bg_color="background:#f4f4f4;cursor:pointer;";
} else {
$bg_color="cursor:pointer;";
}
		$package_nm				= $arr_ebh_pack[$i]['package_nm'];
		$hsp_count				= $arr_ebh_pack[$i]['hsp_count'];
		$cluster_package_id		= $arr_ebh_pack[$i]['cluster_package_id'];
		if($i==0){
			$first_cluster_package_id = $cluster_package_id;
		}

		$package_unit			= $arr_ebh_pack[$i]['package_unit'];

		$price_per_unit			= $arr_ebh_pack[$i]['price_per_unit'];
		$total_price			= $arr_ebh_pack[$i]['total_price'];
		$created_on				= $arr_ebh_pack[$i]['created_on'];
		$created_on_fulldate	= $arr_ebh_pack[$i]['created_on_date'];
	//echo	$created_on_date		= $database->mysqlToDateCustom($created_on_date,'d');
	//echo "<br/>";
		$created_on_date		= $database->mysqlToDateCustom($created_on_fulldate	,'d|M, D|h:i a');
		$created_on_date		= explode('|',$created_on_date);
		//print_r($created_on_date);die;
		$total_invited			= $arr_ebh_pack[$i]['total_invited'];

		$about_package		= $arr_ebh_pack[$i]['about_package'];
		$lab_test_id_arr	= $arr_ebh_pack[$i]['lab_test_id_arr'];

		$lab_test_name_arr	= $arr_ebh_pack[$i]['lab_test_name_arr'];
		//$age_group_arr		= $arr_ebh_pack[$i]['age_group_arr'];
		//$nature_of_work_arr	= $arr_ebh_pack[$i]['nature_of_work_arr'];

		$hsp_logo	= $arr_ebh_pack[$i]['hsp_logo'];

		/*Added Today*/
			$lab_test_name_arr		=	$arr_ebh_pack[$i]['lab_test_name_arr'];
			$test_name	=	explode(",",$lab_test_name_arr);
			$service_info_popover="<div class='media'>";

			for($k=0;$k<count($test_name);$k++)
			{

				$service_info_popover.= "<i class='fa fa-check text-success'></i> ".$test_name[$k];
				if($k<count($test_name))
				{
					$service_info_popover.="<hr style='margin-top:6px;margin-bottom:6px;'>";
				}
			}
			$service_info_popover.="</div>";

			$voucher_url	=	HTTP_SERVER."voucher_pdf.php?r=f&id=".SHA1($appointment_id);

			$info_popover			=	'<a class="text-info" style="cursor:pointer;" data-container="body" data-toggle="popover" data-placement="right" data-content="'.$service_info_popover.'" data-title="<a href=# class=pull-right data-dismiss=popover>&times</a> Package Includes"><i class="fa fa-search"></i> Package includes </a>';

			
			$package_unit			=	$arr_ebh_pack[$i]['package_unit'];

			$invited_per	=	($total_invited*100)/$package_unit;
			$appt_confirmed=0;
			$visited=0;
			$appt_confirmed			= $arr_ebh_pack[$i]['appt_confirmed'];
			$visited				= $arr_ebh_pack[$i]['visited'];

			$confirmed_per	=	($appt_confirmed*100)/$total_invited;

			$visited_per	=	($visited*100)/$appt_confirmed;
			$arr_hsp	=	$database->getEbhClusterPackageHSPDetails($cluster_package_id,'Limit 1');
			$hsp_logo	= $arr_hsp[0]['hsp_logo'];
			$hsp_name				=	$arr_hsp[0]['hsp_name'];
			$hsp_address			=	$arr_hsp[0]['hsp_address'];
			 ?>
                       <tr style="<?php echo $bg_color?>">
                        <td width="150" class="table_area" style="padding-bottom:0;">
                          <h1 class="mt-0" style="display: inline-block;font-weight: bold;font-size: 3em;"><?php echo $created_on_date[0];?></h1><h4 style="display: inline-block;vertical-align: top;margin-top: 2px;"><b><?php echo $created_on_date[1];?></b><br><?php echo $created_on_date[2];?></h4>
                          
                          <div class="pt-10">
							<div class="num_package">
								<!-- <a href="#"><span>40</span>PACKAGE PURCHASED</a> -->
							</div>
						  </div>
                        </td>
                        <td  width="300" class="table_area" style="padding-bottom:0;">
                         <b><?php echo $package_nm;?></b><br/><span style="font-size:11px;"><?php echo $lab_test_name_arr ?></span>
						
                        </td>
						
                        <td class="wherecenter table_area" style="padding-bottom:0;">
                         
							<img src="<?php echo EBH_WEBSITE_URL."".$hsp_logo;?>"  style="width: 100px;" class="floatleft" alt="">
							<?php echo ($hsp_count>1)?"<br/><a href=\"javascript:void(0)\" onClick=\"showHsp($cluster_package_id)\" class=\" text-info\">more..</a>":'';?>
							<!-- <img src="images/center.jpg" class="floatleft" style="width: 150px;"> --> 
                        </td>
                        <td class="analytic_area table_area" style="padding-bottom:0;">                      
                          <div class="chart-responsive" style="text-align: center;">
                    <canvas id="pieChart<?php echo  $cluster_package_id?>" height="75" width="130"></canvas>
                  </div>
                        </td>
                      </tr>
					  <tr style="<?php echo $bg_color?>">
                          <td colspan="4" align="center" style="border:0;padding-top:0">
                                <a href="javascript:void(0)" class="appointment-act" value="Show/Hide" onclick="showApptDiv(<?php echo $cluster_package_id?>)"><i class="fa fa-clock-o"></i> VIEW APPOINTMETS</a>
                           <!-- <a href="javascript:void(0);" class="appointment-act invite" alt="<?php echo $cluster_package_id."~".$package_nm;?>"><i class="fa fa-location-arrow"></i> INVITE</a><a href="javascript:void(0)" onClick="showPackageSummary(<?php echo $cluster_package_id?>)" class="appointment-act"><i class="fa fa-shopping-cart"></i> VIEW PURCHASE SUMMARY</a> -->
                           <!-- <a href="#" class="appointment-act"><i class="fa fa-question-circle"></i> FAQs</a>
                            <a href="#" class="appointment-act"><i class="fa fa-shopping-cart"></i> VIEW PURCHASE SUMMARY</a>
                            <a href="#" class="print_icon"><i class="fa fa-print"></i></a> -->
                           
                        
                          </td>
                      </tr>
<?php  } } ?>
				
                     </tbody>
                  </table>
                </div>
                <!-- /.tab-pane -->  
                </div>
			</div>
		</div>
      
      <!-- /.row -->
		<div class="col-md-12 employee_summary" id="divMsg">	
			<?php include_once('appointment_div.php')?>
		</div>
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

<script src="dist/js/cluster.js"></script>
<script src="dist/js/chart.js"></script>
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
function viewApptSummary(id){
	$.ajax({
				url: 'portal/appointment_summary.php',
				type: 'post',
				data: 'id='+id,
				success: function(response) {
					$('#appt_summary').html(response);
					$('#health_checkup_status').modal('show');
					
				}
			})
}
function appointmentLoad(){
		rtable = $('#appt_datatables').dataTable({
		'lengthChange'      : false,
		 'searching'   : false,
		"sPaginationType": "bootstrap",
		"aoColumnDefs": [
			{"bSortable": false,"aTargets": [1]}
		]
	});
		$('#appt_datatables_filter').hide();
	$('#appt_datatables_length').hide();
	$('#appt_datatables_info').css('padding','10px');
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
}
</script>
<script>
  $(function () {
	  appointmentLoad();
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
   
	   $('.package_menu').addClass('active');
      // -------------
  // - PIE CHART -
  // -------------
  // Get context with jQuery - using jQuery's .get() method.

  var pieOptions     = {
    // Boolean - Whether we should show a stroke on each segment
    segmentShowStroke    : true,
    // String - The colour of each segment stroke
    segmentStrokeColor   : '#fff',
    // Number - The width of each segment stroke
    segmentStrokeWidth   : 1,
    // Number - The percentage of the chart that we cut out of the middle
    percentageInnerCutout: 50, // This is 0 for Pie charts
    // Number - Amount of animation steps
    animationSteps       : 100,
    // String - Animation easing effect
    animationEasing      : 'easeOutBounce',
    // Boolean - Whether we animate the rotation of the Doughnut
    animateRotate        : true,
    // Boolean - Whether we animate scaling the Doughnut from the centre
    animateScale         : false,
    // Boolean - whether to make the chart responsive to window resizing
    responsive           : true,
    // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio  : false,
    // String - A legend template
    legendTemplate       : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<segments.length; i++){%><li><span style=\'background-color:<%=segments[i].fillColor%>\'></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
    // String - A tooltip template
    tooltipTemplate      : '<%=value %> <%=label%> '
  };
  // Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  <?php foreach($arr_ebh_pack as $key=>$val){?>
    
   pieChartCanvas = $('#pieChart<?php echo $val['cluster_package_id']?>').get(0).getContext('2d');
  var pieChart<?php echo $val['cluster_package_id']?>       = new Chart(pieChartCanvas);
 
  var PieData<?php echo $val['cluster_package_id']?>        = [
    {
      value    : <?php  echo $val['visited']?>,
      color    : '#f56954',
      highlight: '#f56954',
      label    : 'Utilized '
    },
    {
      value    : <?php  echo ($val['package_unit']-$val['visited'])?>,
      color    : '#00a65a',
      highlight: '#00a65a',
      label    : 'Remaining '
    },
    
  ];
 
  pieChart<?php echo $val['cluster_package_id']?>.Doughnut(PieData<?php echo $val['cluster_package_id']?>, pieOptions);
  <?php } ?>
  // -----------------
  // - END PIE CHART -
  // -----------------


  
    
   $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
 });
</script><script>$(document).ready(function() {	$('#showmenu').click(function() {			$('.slidingDiv').slideToggle("");	});	});	</script>
</body>
</html>
