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
<div class="col-md-12  employee_summary">			
		<div class="col-md-6 p0">				
			<div class="pagination check_box_drop download_icon">
				<a href="#" class="dropdown_setting dropdown-toggle" data-toggle="dropdown" style="margin-right:5px;">
				<input type="checkbox" id="checkAll" name="subscribe" value="newsletter">
				<span class="caret"></span></a>	
				<ul class="dropdown-menu">
					<li><a href="#">All</a></li>
					<li><a href="#">None</a></li>
					<li><a href="#">Add Tab</a></li>
				</ul>				
			</div>								
			<div class="pagination download_icon" style="margin-right:5px;">
				<a href="#"><i class="fa fa-repeat" aria-hidden="true"></i></a>
			</div>				
			<div class="pagination download_icon">
				<a href="#"><i class="fa fa-download" aria-hidden="true"></i></a>
			</div>				
			<div class="pagination left_align_pagination">
				<a href="#"><i class="fa fa-folder" aria-hidden="true"></i><span class="caret"></span></a>
			</div>				
			<div class="pagination left_align_pagination">					
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-tag" aria-hidden="true"></i><span class="caret"></span></a>
				<ul class="dropdown-menu tag_area_dropdown" style="right: 0!important;right: 0!important;float: right;margin-left: 52%;top: 62px;width: 35%;">
					<span>Label as:</span>
					<div class="tag_options">    
					<div id="custom-search-input">
						<div class="input-group col-md-12" style="padding-left: 5px;padding-right: 5px;">
							<input type="text" class="search-query form-control" placeholder="Search" style="border-radius: 0px !important;margin-bottom: 5px !important;">
							<span class="input-group-btn" style="position: absolute; right: 0;margin-top: -4px;">
								<button class="btn btn-danger" type="button">
									<span class=" glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					</div>
					<a href="#" class="box_area" style="border: 0; display: block; width: 100%;  float: left;  padding:5px 3px; ">
					<input type="checkbox" id="test2">
					<label for="test2" style="vertical-align: text-top;"></label>
					Scheduled
					</a>
					<a href="#" style="border: 0; display: block; width: 100%; float: left;padding:5px 3px;"><input type="checkbox" id="test4">
					<label for="test4" style="vertical-align: text-top;"></label>Rescheduled</a>
					<a href="#" style="border: 0; display: block; width: 100%; float: left;padding:5px 3px;"><input type="checkbox" id="test4">
					<label for="test4" style="vertical-align: text-top;"></label>Unwanted</a>
					<a href="#" class="box_area" style="border: 0;display: block;width: 100%;float: left;padding:5px 3px;">
					<input type="checkbox" id="test4">
					<label for="test4" style="vertical-align: text-top;"></label>
					Updated
					</a>
  <div class="clearfix"></div>
					<div class="hr-divider" style=" width: 95%;border-top: 1px solid #ccc; margin: 10px auto"></div>				
					<a href="#" class="box_area" style="border: 0; display: block; width: 100%; float: left; ">	Create New</a>					
					<a href="#" class="box_area" style="border: 0; display: block; width: 100%; float: left; ">Manage Labels</a>						
					<a href="#" class="box_area" style="border: 0; display: block; width: 100%; float: left; ">Apply</a>					
				</ul>
			</div>			
		</div>			<div class="col-md-6 p0">				<div class="pagination pagination_right">				<span>1-9 of 32</span>				<a href="#">&lt;</a>				<a href="#">&gt;</a>				<a href="#" class="dropdown_setting" data-toggle="dropdown" style="margin-left:10px;"><i class="fa fa-cog" aria-hidden="true"></i><span class="caret"></span></a>				</div>			</div>		</div>
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
         </li>-->
         <li class="upcoming"><a href="#tab_2-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false" style="padding:12.5px;">UPCOMING</a></li>
		 <li class="upcoming"><a href="#tab_3-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false" style="padding:12.5px;">All</a></li>
        
         <li class="pull-right dropdown nohover1 sort_by_btn">
            <a class="dropdown-toggle " data-toggle="dropdown" href="#" style="height:36px;">
				Sort By <span class="caret" style="margin-left: 85px;"></span>                  </a>                  
            <ul class="dropdown-menu">
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sort By</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Date &amp; Time</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Location</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Status</a></li>
            </ul>
         </li>
         <li class="pull-right nohover1">
            <!-- search form -->                  
            <form action="#" method="get" class="employee_search sidebar-form1" style="display: inline-block;border-bottom: 1px solid #ccc;">
               <div class=" inner-addon left-addon">                      <i class="fa fa-search"></i>                      <input type="text" id="search_name" name="q" class="form-control" placeholder="Search">                    </div>
            </form>
            <!-- /.search form -->                
         </li>
      </ul>
   </div>
      <div class="box no-border mb-65">
	 
      <!-- /.box-header -->            
      <div class="box-body table-responsive  ">
         <div class="table-responsive">
            <table class="table table-hover employee_details_area" <?php if(!empty($arr_appt)){ echo "id='appt_datatables'";} ?>>
               <thead>
                  <tr class="employee_table employee_heading">
                     <!-- <th> </th> -->
                     <th> </th>
                     <th style="text-align:center">NAME</th>
                     <th style="text-align:center">DESIGNATION</th>					 
                     <th style="text-align:center">WHERE  </th>
                     <th style="text-align:center">DATE</th>
                     <th style="text-align:center">STATUS</th>
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
                     <td class="info" align="Left">Designation</td>
					 
                     <td class="info"><?php if($hsp_logo!=''){?><img src="<?php echo EBH_HTTP_SERVER."app/portal/".$hsp_logo;?>" data-src="holder.js/90x90" style="width: 90px; height: 90px;" class="main-avatar img-rectangle" alt=""><?php } else {echo $value['name'] ;}?></td>
                     <td class="info"><?php echo $value['appointment_datetime'];?></td>
                   
					 <?php if($value['is_confirmed']==1){?>
					   <td class="info confirmed">
					 <i class="fa fa-check" aria-hidden="true"></i> CONFIRMED
					 </td>
					 <?php }else{ ?>
					  <td class="info pending">
					 <i class="fa fa-clock-o text-danger" aria-hidden="true"></i> PENDING
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