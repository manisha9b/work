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
?>
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="images/logo/EBH-small.png" alt="EasyByHealth" style="max-width: 100%;" /></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="images/logo/EBH.png" alt="EasyByHealth" style="max-width: 90%;" /></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form1" style="display: inline-block;">
        <div class=" inner-addon left-addon">
          <i class="fa fa-search"></i>
          <input type="text" name="q" class="form-control" placeholder="Type To Search">
        </div>
      </form>
      <!-- /.search form -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			<li class="login_user">
				<a href="#"> <i class="fa fa-user-o" aria-hidden="true"></i> <span>Hi Priyanka</span></a>
			</li>
          <li>
            <a href="#">About EBH</a>
          </li>
          <li>
            <a href="#">How it Works</a>
          </li>
          <li class="nohover">
            <a href="#">
              <div class="social">
                <i class="fa fa-facebook"></i>
              </div>
            </a>
          </li>
          <li class="nohover">
            <a href="#">
              <div class="social">
                <i class="fa fa-instagram"></i>
              </div>
            </a>
          </li>
          <li class="nohover nav-space">
            <a href="#">
              <div class="social">
                <i class="fa fa-twitter"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image" style="padding-top:25px;">
          <img src="images/dr.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="clearfix clear"></div>
        <div class="info">
          <p>Digital Republik</p>
        </div>
        <div class="prof">
          <div class="progress xs1 mb-0">
            <!-- Change the css width attribute to simulate progress -->
            <div class="progress-bar progress-bar-cgreen" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progresscomplete mb-10" style="margin-top: 9px;">80% complete profile</div>
          <p style="color: #b7bbc2;">
            Digital Republik Pvt.Ltd<br/>
            Mumbai
          </p>
        </div>
      </div>
      <div class="divider"></div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
          <a href="cluster_dashboard.html">
            <i class="fa fa-th-large"></i> <span>Health Dashboard</span>
          </a>
        </li>
        <li>
          <a href="health_package.html">
            <i class="fa ion-ios-medkit-outline"></i> <span>Health Packages</span>
          </a>
        </li>
        <li>
          <a href="employee_information.html">
            <i class="fa fa-address-card-o"></i> <span>Employees</span>
          </a>
        </li>
        <li>
          <a href="my-family.html">
            <i class="fa fa-heartbeat"></i> <span>Health Index</span>
          </a>
        </li>
		<li class="active">
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Appointments</span>
          </a>
        </li>
		<li>
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>Reports</span>
          </a>
        </li>
        <div class="nav-divider"></div>        
        <li>
          <a class="disable">
            <i class="fa ion-ios-list"></i> <span>Worth Reading</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-shield"></i> <span>Diet Plan</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-heartbeat"></i> <span>Fitness Services</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-user"></i> <span>Nutritionists</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-heart"></i> <span>Health Equipments</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-file-text"></i> <span>Pharmacy & Chemists</span>
          </a>
        </li>
        <!--<li>
          <a class="disable">
            <i class="fa fa-gift"></i> <span>Rewards</span>
          </a>
        </li>-->
        <div class="nav-divider"></div>
        <li>
          <a href="my-profile.html">
            <i class="fa fa-user"></i> <span>Company Profile</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-info-circle"></i> <span>About EBH</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

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
		<div class="pull-right">
			<span>Timeframe<span> :
				<select style="font-weight: bold;background: transparent;border:none;display: inline-block;width: 125px;height: auto;padding: 0 5px;">
					<option>Last 6 months</option>
					<option>Last 12 months</option>
				</select>
		</div>        
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
              <span class="info-box-text text2 clr_effect1">78</span>
              <span class="info-box-number text-white">ONBOARDED <span style="font-size: 12px;">EMPLOYEES</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <div class="summary_add text-center"><a href="#">Add more employees</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box3 healthy_employee">
            <span class="info-box-icon icon2 bg_dark_blue1 text-white"><i class="fa fa-calendar-check-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1">39</span>
              <span class="info-box-number text-white">APPOINTMENTS <span style="font-size: 12px;">BOOKED</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <div class="summary_add text-center"><a href="#">Send reminders to others</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box4 evoucher_download">
            <span class="info-box-icon icon3 text-white"><i class="fa fa-download"></i></span></span>

             <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1">26</span>
              <span class="info-box-number text-white">eVOUCHERS <span style="font-size: 12px;">DOWNLOADED</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		   <div class="summary_add text-center"><a href="#">Send reminders to others</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box4 unhealthy_employee">
            <span class="info-box-icon icon3"><img src="images/ecg_icon.png" width="35"></span>

             <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1">25</span>
              <span class="info-box-number text-white">TESTS <span style="font-size: 12px;">TAKEN</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <div class="summary_add text-center"><a href="#">Say Congratulations</a></div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12 summary_opt">
          <div class="info-box box4 report_present">
            <span class="info-box-icon icon3 text-white"><i class="fa fa-file-text-o"></i></span></span>

             <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1">19</span>
              <span class="info-box-number text-white">REPORTS <span style="font-size: 12px;">AVAILABLE</span></span>
            </div>
            <!-- /.info-box-content -->
          </div>
		  <div class="summary_add text-center"><a href="#">Add more employees</a></div>
          <!-- /.info-box -->
        </div>
		<!-- /.col -->
		</div>
      </div>  
	  
		
		<div class="col-md-12 mt-20 purchase_pack">
			<div class="pagination">
				<span>1-2 of 18</span>
			  <a href="#"><</a>
			  <a href="#">></a>
			</div>
			
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
                                <a href="javascript:void(0)" class="appointment-act" value="Show/Hide" onclick="showHideDiv('divMsg')"><i class="fa fa-clock-o"></i> MANAGE PURCHASE</a>
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

  
</div>
<!-- ./wrapper --> <!-- Modal -->  <div class="modal fade" id="health_checkup_status">    <div class="modal-dialog">          <!-- Modal content-->      <div class="modal-content">        <div class="modal-header">          <button type="button" class="close" data-dismiss="modal">&times;</button>          <h4 class="modal-title">Modal Header</h4>        </div>        <div class="modal-body">          <div class="col-md-12 test_complete box-body p0">			<div class="text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></div>			<div class="nav-tabs-custom wizard-content">            <ul class="nav nav-tabs">				<li class="on_board"><a href="#emp_on_board" data-toggle="tab" aria-expanded="false" class="border_one">ONBOARDED</a></li>				<li class="com_sent"><a href="#comm_sent" data-toggle="tab" aria-expanded="false" class="border_two">COMMUNICATION SENT</a></li>				<li class="lin_clik"><a href="#link_click" data-toggle="tab" aria-expanded="false" class="border_three">LINK CLICKED</a></li>				<li class="app_send"><a href="#app_sent" data-toggle="tab" aria-expanded="false" class="border_four">APPOINTMENT SENT</a></li>				<li class="test_complet"><a href="#test_done" data-toggle="tab" aria-expanded="false" class="border_five">TEST DONE</a></li>				<li class="report_complete"><a href="#report_receiv" data-toggle="tab" aria-expanded="false" class="border_six">REPORTS RECEIVED</a></li>            </ul>            <div class="tab-content">				<div class="tab-pane on_board active " id="emp_on_board">					<div class="user-block">                                       						<span class="description"><b style="color: #000;">2nd Oct,</b> Monday <br>11.30AM</span>					</div> 					<div class="clearfix"></div>									</div>             				<div class="tab-pane com_sent clr_orange" id="comm_sent">					<div class="user-block">                                       						<span class="description"><b style="color: #000;">14 Oct</b>,Thursday <br>2.15PM</span>					</div>				</div>				<div class="tab-pane lin_clik" id="link_click">					<div class="user-block">                                       						<span class="description"><b style="color: #000;">18 Oct,</b> Wednesday <br>11.20AM</span>					</div>				</div>				<div class="tab-pane app_send" id="app_sent">					<div class="user-block">                                       						<span class="description"><b style="color: #000;">21 Oct,</b> Monday <br>12.00PM</span>					</div>				</div>				<div class="tab-pane test_complet" id="test_done">					<div class="user-block">                                       						<span class="description"><b style="color: #000;">21 Oct,</b> Monday <br>12.00PM</span>					</div>				</div>				<div class="tab-pane report_complete" id="report_receiv">					<div class="user-block">                                       						<span class="description"><b style="color: #000;">21 Oct,</b> Monday <br>12.00PM</span>					</div>				</div>              <!-- /.tab-pane -->                         </div>          </div>		  <div class="clearfix"></div>		  <div class="col-md-12 p0 employee_profile">			<div class="col-md-8">			<div class="health_status"><span class="current_status">Current Health Status:</span></span><span class="profile_person"> Unknown</span><span class="profile_pic"><img src="images/unknown_icon.gif" style=""></span></div>			<br>			<div class="employee_file ">				<ul>					<li class="blue_clr"><i class="fa fa-user" aria-hidden="true"></i> VIEW PROFILE</li>					<li class="blue_clr"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> APPOINTMENT HISTORY</li>					<li class="green_clr"><i class="fa fa-download" aria-hidden="true"></i> ARCHIEVE</li>					<li class="green_clr"><i class="fa fa-envelope-o" aria-hidden="true"></i> SEND MESSAGE</li>					<li class="grey_clr"><i class="fa fa-file-text-o" aria-hidden="true"></i> VIEW REPORT</li>				</ul>			</div>			</div>			<div class="col-md-4 p0">				<div class="time_limit">					<div class="start_to_end">						<span class="number">6</span>						<span class="number_of_days">							<span class="day">DAYS</span>							<span class="">Start to finish</span>						</span>											</div>										<div class="company_avg">						<span class="number">4</span>						<span class="number_of_days">							<span class="day">DAYS</span>							<span>Company Avg</span>						</span>					</div>					<div class="caret_down"><i class="fa fa-caret-down" aria-hidden="true"></i></div>				</div>			</div>					  </div>		</div>		<div class="clearfix"></div>        </div>        <div class="modal-footer">          <a href="#" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">Close</a>        </div>      </div>          </div>  </div>


<?php include_once('partials/footer.php'); ?>

<script src="dist/js/bootstrap-datepicker.min.js"></script>

<script src="dist/js/cluster.js"></script>
<script src="dist/js/chart.js"></script>
<script>
  $(function () {
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
