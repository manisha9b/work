<div class="modal fade" id="health_checkup_status">
   <div class="modal-dialog">
      <!-- Modal content-->      
      <div class="modal-content">
	           <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>          
            <h4 class="modal-title">Appointment Detail</h4>
         </div>
		   <div class="modal-body">
<?php

session_start();

include_once '../includes/define.php';
include '../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');
$created_by		=	$_SESSION['ref_id'];
$created_on		=	date("Y-m-d H:i:s");
$id = isset($_POST['id'])?$_POST['id']:'';;
$arr_appt	=	$database->getAppointmentDetailsBySrNo($id);
//echo "<pre>";
//print_R($arr_appt);
//echo "</pre>";//die;*/
$grey_img = "grey1.jpg";
$onboard_img = ($arr_appt[0]['onboard']!='')?'aqua2.jpg':$grey_img;
$commmuncation_on_img = ($arr_appt[0]['commmuncation_on']!='')?'ora2.jpg':$grey_img;;
$confirmed_on_img = ($arr_appt[0]['confirmed_on']!='')?'purple2.jpg':$grey_img;
$appointment_sent_img = ($arr_appt[0]['appointment_sent']!='')?'green1.jpg':$grey_img;
$testdone_on_img = ($arr_appt[0]['testdone_on']!='')?'ar-yellow.jpg':$grey_img;
$report_uploaded_on_img = ($arr_appt[0]['report_uploaded_on']!='')?'arr-last.jpg':$grey_img;
 ?>



       
            <div class="col-md-12 test_complete box-body p0">	
            <div class="col-md-12 mt-20">
					<div class="col-md-2 text-style on_board p0 process_bar">
						<h4 class="fs11" style="margin-bottom: 0px;color:#999">ONBOARDED</h4>
						<span><img src="images/<?php echo $onboard_img ?>"</span>
						<span class="description"><?php echo $database->getApptDate($arr_appt[0]['onboard'])?></span>
					</div>
					<div class="col-md-3 com_sent p0 process_bar">
						<h4 class="fs11" style="margin-bottom: 0px;color:#999">INVITED ON</h4>
						<span><img src="images/<?php echo $commmuncation_on_img ?>"></span>
						<span class="description"><?php echo $database->getApptDate($arr_appt[0]['commmuncation_on'])?></span>
					</div>
					<div class="col-md-3 lin_clik p0 process_bar">
						<h4 class="fs11" style="margin-bottom: 0px;color:#999">LINK CLICKED</h4>
						<span><img src="images/<?php echo $confirmed_on_img ?>"></span>
						<span class="description"><?php echo $database->getApptDate($arr_appt[0]['confirmed_on'])?></span>
					</div>
					<div class="col-md-3 app_send p0 process_bar">
						<h4 class="fs11" style="margin-bottom: 0px;color:#999">APPOINTMENT SENT</h4>
						<span><img src="images/<?php echo $appointment_sent_img ?>"></span>
						<span class="description"><?php echo $database->getApptDate($arr_appt[0]['appointment_sent'])?></span>
					</div>
					<div class="col-md-3 app_send p0 process_bar">
						<h4 class="fs11" style="margin-bottom: 0px;color:#999">TEST DONE</h4>
						<span><img src="images/<?php echo $testdone_on_img ?>"></span>
						<span class="description"><?php echo $database->getApptDate($arr_appt[0]['testdone_on'])?></span>
					</div>
					<div class="col-md-2 report_complete p0 process_bar">
						<h4 class="fs11" style="margin-bottom:0px;color:#999">REPORT COMPLETE</h4>
						<span><img src="images/<?php echo $report_uploaded_on_img ?>"></span>
						<span class="description"><?php echo $database->getApptDate($arr_appt[0]['report_uploaded_on'])?></span>
					</div>
					</div>
					<br>
					<div class="clearfix"></div>
					<!--	<div class="col-md-12 mt-20">					<div class="col-md-2 text-style on_board p0 process_bar">						<h4 class="fs11" style="margin-bottom: 0px;color:#999">ONBOARDED</h4>						<span><img src="images/aqua2.jpg"></span>					</div>					<div class="col-md-3 com_sent p0 process_bar">						<h4 class="fs11" style="margin-bottom: 0px;color:#999">COMMUNICATION SENT</h4>						<span><img src="images/ora2.jpg"></span>					</div>					<div class="col-md-3 lin_clik p0 process_bar">						<h4 class="fs11" style="margin-bottom: 0px;color:#999">LINK CLICKED</h4>						<span><img src="images/purple2.jpg"></span>					</div>					<div class="col-md-3 app_send p0 process_bar">						<h4 class="fs11" style="margin-bottom: 0px;color:#999">APPOINTMENT SENT</h4>						<span><img src="images/green1.jpg"></span>					</div>					<div class="col-md-3 app_send p0 process_bar">						<h4 class="fs11" style="margin-bottom: 0px;color:#999">TEST DONE</h4>						<span><img src="images/ar-yellow.jpg"></span>					</div>					<div class="col-md-2 report_complete p0 process_bar">						<h4 class="fs11" style="margin-bottom:0px;color:#999">REPORT COMPLETE</h4>						<span><img src="images/arr-last.jpg"></span>					</div>					</div>					<br>					<div class="clearfix"></div>								
               <div class="text-center"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
               <div class="nav-tabs-custom wizard-content">
                  <ul class="nav nav-tabs">
                     <li class="on_board"><a href="#emp_on_board" data-toggle="tab" aria-expanded="false" class="border_one">ONBOARDED</a></li>
                     <li class="com_sent"><a href="#comm_sent" data-toggle="tab" aria-expanded="false" class="border_two">COMMUNICATION SENT</a></li>
                     <li class="lin_clik"><a href="#link_click" data-toggle="tab" aria-expanded="false" class="border_three">CONFIRMED ON</a></li>
                     <li class="app_send"><a href="#app_sent" data-toggle="tab" aria-expanded="false" class="border_four">APPOINTMENT SENT</a></li>
                     <li class="test_complet"><a href="#test_done" data-toggle="tab" aria-expanded="false" class="border_five">TEST DONE</a></li>
                     <li class="report_complete"><a href="#report_receiv" data-toggle="tab" aria-expanded="false" class="border_six">REPORTS RECEIVED</a></li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane on_board active " id="emp_on_board">
                        <div class="user-block"> <span class="description"><?php echo $database->getApptDate($arr_appt[0]['onboard'])?></span> </div>
                        <div class="clearfix"></div>
                     </div>
                     <div class="tab-pane com_sent clr_orange" id="comm_sent">
                        <div class="user-block"> <span class="description"><?php echo $database->getApptDate($arr_appt[0]['commmuncation_on'])?></span></div>
                     </div>
                     <div class="tab-pane lin_clik" id="link_click">
                        <div class="user-block"> <span class="description"><?php echo $database->getApptDate($arr_appt[0]['confirmed_on'])?></span></div>
                     </div>
                     <div class="tab-pane app_send" id="app_sent">
                        <div class="user-block"> <span class="description"><?php echo $database->getApptDate($arr_appt[0]['appointment_sent'])?></span></div>
                     </div>
                     <div class="tab-pane test_complet" id="test_done">
                        <div class="user-block"> <span class="description"><?php echo $database->getApptDate($arr_appt[0]['testdone_on'])?></span> </div>
                     </div>
                     <div class="tab-pane report_complete" id="report_receiv">
                        <div class="user-block"> <span class="description"><?php echo $database->getApptDate($arr_appt[0]['report_uploaded_on'])?></span> </div>
                     </div>
                                         
                  </div>
               </div>
               <div class="clearfix"></div>-->
                <!--<div class="col-md-12 p0 employee_profile">
                  <div class="col-md-8">
                   <!--  <div class="health_status"><span class="current_status">Current Health Status:</span></span><span class="profile_person"> Unknown</span><span class="profile_pic"><img src="images/unknown_icon.gif" style=""></span></div>
                     <br>			
                     <div class="employee_file ">
                        <ul>
                           <li class="blue_clr"><i class="fa fa-user" aria-hidden="true"></i> VIEW PROFILE</li>
                           <li class="blue_clr"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> APPOINTMENT HISTORY</li>
                           <li class="green_clr"><i class="fa fa-download" aria-hidden="true"></i> ARCHIEVE</li>
                           <li class="green_clr"><i class="fa fa-envelope-o" aria-hidden="true"></i> SEND MESSAGE</li>
                           <li class="grey_clr"><i class="fa fa-file-text-o" aria-hidden="true"></i> VIEW REPORT</li>
                        </ul>
                     </div> 
                  </div>
                  <div class="col-md-4 p0">
                     <div class="time_limit">
                        <div class="start_to_end"> 	<span class="number">6</span> 	<span class="number_of_days"> 		<span class="day">DAYS</span> 		<span class="">Start to finish</span> 	</span>  	</div>
                        <div class="company_avg"> 	<span class="number">4</span> 	<span class="number_of_days"> 		<span class="day">DAYS</span> 		<span>Company Avg</span> 	</span> </div>
                        <div class="caret_down"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                     </div>
                  </div>
               </div> -->
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="modal-footer">          <a href="#" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">Close</a>        </div>
      </div>
   </div>
</div>