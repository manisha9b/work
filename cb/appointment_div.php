<?php 
if(isset($_POST['appt_id'])){
session_start();

include_once 'includes/define.php';
include 'classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');
$created_by		=	$_SESSION['ref_id'];
$created_on		=	date("Y-m-d H:i:s");
}
$cluster_package_id = isset($_POST['appt_id'])?$_POST['appt_id']:$first_cluster_package_id;;
//$arr_appt = '';
if(!empty($cluster_package_id)){
	$arr_appt	=	$database->getAppointmentList($cluster_package_id);
}
/*ini_set("display_errors", "1");
  error_reporting(E_ALL);
  echo "<pre>";
print_R($arr_appt[0]);
 print_R($arr_appt[1]);
  echo "</pre>";*/
?>
<style>
.emp_info_data .info{
	text-align:left!important;
}
</style>
  <div class="clearfix"></div>
   <div id="appointments" class="nav-tabs-custom employee_info">
      <ul class="nav nav-tabs">
	   <li class="all active"><a href="#tab_3-2" onclick="return hidesummary()" data-toggle="tab" style="padding:12.5px;">All Appointments</a></li>
         <!-- <li class="active">
            <div class="dropdown">
               <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background:#04092f;padding:12px;border-radius: 0!important;">PRE EMPLOYMENT<span class="caret"></span></a>				  
               <ul class="dropdown-menu purchase_drop_down employee_dropdown" style="width: 140%;">
                  <li><a href="#">Pre Employment</a></li>
                  <li><a href="#">Annual Checkup</a></li>
                  <li><a href="#">Package Type A</a></li>
                  <li><a href="#">Add Tabs</a></li>
               </ul>
            </div>
         </li>
         <li class="upcoming"><a href="#tab_2-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false" style="padding:12.5px;">UPCOMING</a></li>
        
         <li class="pull-right dropdown nohover1 sort_by_btn">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">                    Sort By <span class="caret" style="margin-left: 85px;"></span>                  </a>                  
            <ul class="dropdown-menu">
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sort By</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Date &amp; Time</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Location</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Status</a></li>
            </ul>
         </li> -->
         <li class="pull-right nohover1">
            <!-- search form -->                  
            <form action="#" method="get" class="employee_search sidebar-form1" style="display: inline-block;border-bottom: 1px solid #ccc;">
               <div class=" inner-addon left-addon">                      <i class="fa fa-search"></i>                      <input type="text" id="search_name" name="q" class="form-control" placeholder="Search">                    </div>
            </form>
            <!-- /.search form -->                
         </li>
      </ul>
   </div>
      <div class="box no-border">
	 
      <!-- /.box-header -->            
      <div class="box-body table-responsive emp_detail ">
         <div class="table-responsive">
            <table class="table table-hover employee_details_area" <?php if(!empty($arr_appt)){ echo "id='appt_datatables'";} ?>>
               <thead>
                  <tr class="employee_table employee_heading">
                     <!-- <th> </th> -->
                     <th> </th>
                     <th>FILL NAME</th>
                     <th>WHERE  </th>
                     <th>DATE</th>
                     <th>STATUS</th>
                  </tr>
				   </thead>
				   <tbody>
				  <?php //if(isset($arr_appt)){foreach($arr_appt as $key=>$value){

 if(isset($arr_appt)){foreach($arr_appt as $key=>$value){
 $photo	= (!empty($value['photo_thumb'])) ? $value['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
				  ?>
                  <tr class="emp_info_data" onclick="viewApptSummary(<?php echo $value['sr_no'];?> )">
                     <!-- <td class="info">						<input type="checkbox" id="test1" />						<label for="test1"></label>					</td> -->
                     <td class="table_circle emp_pic"><img src="<?php echo $photo?>"  class="img-circle"></td>
                     <td class="info" align="Left"><?php echo $value['visitor_name'];?></td>
                     <td class="info"><?php if($hsp_logo!=''){?><img src="<?php echo EBH_HTTP_SERVER."app/portal/".$hsp_logo;?>" data-src="holder.js/90x90" style="width: 90px; height: 90px;" class="main-avatar img-rectangle" alt=""><?php } else {echo $value['name'] ;}?></td>
                     <td class="info"><?php echo $value['appointment_datetime'];?></td>
                   
					 <?php if($value['is_confirmed']==1){?>
					   <td class="info confirmed">
					 <i class="fa fa-check" aria-hidden="true"></i> CONFIRMED
					 </td>
					 <?php }else{ ?>
					  <td class="info pending">
					 <i class="fa fa-clock-o" aria-hidden="true"></i> PENDING
					 </td>
					 <?php } ?>
					 
                  </tr>
				  <?php   }}else{  ?>
				   <tr class="emp_info_data"><td colspan="7" align="center">No records found</td></tr>
				  <?php  } ?>
                 
               </tbody>
            </table>
           
         </div>
      </div>
   </div>