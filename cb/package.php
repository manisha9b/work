<?php 
include_once('partials/header2.php'); 
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
//print_R($arr_ebh_pack);
?>
<style>
    .table_area{
        padding-bottom:0!important;
    }
	.bg-pink{background-color:#d92cac!important}
	
	.carousel-control.left,.carousel-control.right  {background:none;width:25px;}
.carousel-control.left {left:-25px;margin-top:15%;color: #000;}
.carousel-control.right {right:-25px;margin-top:15%;color: #000;}

.broun-block {
    background: url("http://myinstantcms.ru/images/bg-broun1.jpg") repeat scroll center top rgba(0, 0, 0, 0);
    padding-bottom: 34px;
}
.block-text {
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 3px 0 #2c2222;
    color: #626262;
    font-size: 14px;
    margin-top: 27px;
    padding: 15px 18px;
}
.block-text a {
 color: #7d4702;
    font-size: 25px;
    font-weight: bold;
    line-height: 21px;
    text-decoration: none;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.mark {
    padding: 12px 0;background:none;
}
.block-text p {
    color: #585858;
    font-family: Georgia;
    font-style: italic;
    line-height: 20px;
}
.sprite {
	background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAeUCAYAAAAU3UTMAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjY1MzJERUNDRjBEMTExRTM4N0ZFOUUyNENEOTZCNjVCIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjY1MzJERUNERjBEMTExRTM4N0ZFOUUyNENEOTZCNjVCIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NjUzMkRFQ0FGMEQxMTFFMzg3RkU5RTI0Q0Q5NkI2NUIiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NjUzMkRFQ0JGMEQxMTFFMzg3RkU5RTI0Q0Q5NkI2NUIiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz4/ZdnrAAAydElEQVR42uydCbgUxbn3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');
}
.sprite-i-triangle {
    background-position: 0 -1298px;
    height: 44px;
    width: 50px;
}
.block-text ins {
    bottom: -44px;
    left: 50%;
    margin-left: -60px;
}


.block {
    display: block;
}
.zmin {
    z-index: 1;
}
.ab {
    position: absolute;
}

.person-text {
    padding: 10px 0 0;
    text-align: center;
    z-index: 2;
}
.person-text a {
    color: #ffcc00;
    display: block;
    font-size: 14px;
    margin-top: 3px;
    text-decoration: underline;
}
.person-text i {
    color: #fff;
    font-family: Georgia;
    font-size: 13px;
}
.rel {
    position: relative;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="col-sm-12">
      <div class="pb-20 health_package_page">
        <div class="">
          <!-- Content Header (Page header) -->       
          
          <!-- Main content -->
		  <section class="content-header">
		  <div class="col-md-12">
      <h3 class="pull-left">
        <b>Health Packages</b>
      </h3>
      <div class="pull-right resright">
<?php include_once('partials/askme.php')       ;?>
	   </div>
	  </div>
      <div class="clearfix"></div>
	  <hr class="hrdivide">
    </section>
		
		  <section class="content">
			<div class="col-md-12">
			<div class="pull-right" style="margin-top: -10px;">
				<!-- <span>Timeframe<span> : 
				<select style="font-weight: bold;background: transparent;border:none;display: inline-block;width: 125px;height: auto;padding: 0 5px;">
					<option>Last 6 months</option>
					<option>Last 12 months</option>
				</select> -->
			</div>
            <div class="pt-20"></div>
            <div id="appointments" class="nav-tabs-custom mb-65">
              <ul class="nav nav-tabs">
                <li class="active">
				<div class="dropdown pur_option">
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background: #3D4452;
    padding:9.5px;border-radius: 0!important;">PURCHASED <!-- <span class="caret"></span> --></a>
					 <!-- <ul class="dropdown-menu purchase_drop_down" style="width: 140%;">
						<li><a href="#">Pre Employment</a></li>
						<li><a href="#">Annual Checkup</a></li>
						<li><a href="#">Package Type A</a></li>
						<li><a href="#">Add Tabs</a></li>
					  </ul> -->
					</div>
				
				</li>
               <li class="pur_option"><a href="#tab_2-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false">RECOMMENDED</a></li>
                <li class="pur_option"><a href="#tab_3-2" onclick="return hidesummary()" data-toggle="tab">All</a></li> 
                <li class="pull-right nohover1" style="    overflow: hidden; width: 50px; height: 45px;">
					<!-- search form -->
					<form action="#" method="get" class="employee_search sidebar-form1" style="display: inline-block;overflow: hidden; width: 35px;height: 35px;">
						<div class=" inner-addon left-addon"> 
							<a href="#"><i class="fa fa-search" style="color:#3fb8c3;"></i></a>
							<!--<input type="text" name="q" class="form-control" placeholder="Search"> </div>-->
					</form>
					<!-- /.search form -->
				</li>
                <li class="pull-right dropdown nohover1 sort_by_btn"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" style="background-color:#fff;color:#7c7b7b"> Sort By <span class="caret" style="margin-left:124px;"></span>                  </a>
					<ul class="dropdown-menu">
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sort By</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Date &amp; Time</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Location</a></li>
						<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Status</a></li>
					</ul>
				</li>
                
              </ul>
			  <?php
if(isset($_REQUEST['m']))
 {
	echo $database->show_alert($_REQUEST['m']);
 }
?>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
				<div id="div-list">
                  <table id="appttab" class="package_list table table-appointment2 responsive-table" >
                    <tbody>
                      <tr style="background: transparent;">
                        <th>
                          PURCHASED ON
                        </th>
                        <th>
                          PACKAGE NAME
                        </th>
                        <th style="text-align:center;">
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
		$created_on_date		= $database->mysqlToDateCustom($created_on_fulldate	,'d|M,|l|h:i a');
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
		/* END */
		//$hsp_name				= $arr_ebh_pack[$i]['hsp_name'];
		/*$hsp_name				=	$arr_ebh_pack[$i]['hsp_name'];
			$hsp_address			=	$arr_ebh_pack[$i]['hsp_address'];

			$hsp_helpline_number1	= 	$arr_ebh_pack[$i]['hsp_helpline_number1'];
			$hsp_helpline_number1.= 	($arr_ebh_pack[$i]['hsp_helpline_number2']!='')? " / ".$arr_ebh_pack[$i]['hsp_helpline_number2']:"";
			$hsp_helpline_number1.= 	($arr_ebh_pack[$i]['hsp_helpline_number3']!='')? " / ".$arr_ebh_pack[$i]['hsp_helpline_number3']:"";
			$hsp_helpline_number1.= 	($arr_ebh_pack[$i]['hsp_helpline_number4']!='')? " / ".$arr_ebh_pack[$i]['hsp_helpline_number4']:"";

			$hsp_general_email_id	= 	$arr_ebh_pack[$i]['hsp_general_email_id'];
			$branches				=	$arr_ebh_pack[$i]['hsp_branchs'];*/
			//$hsp_address_info		=	"<i class='fa fa-map-marker'></i> ".$hsp_address;
			//$hsp_contact_info		=	"<hr style='margin-top:8px;margin-bottom:8px;'/><i class='fa fa-phone'></i> ".$hsp_helpline_number1;
			//$provider_info_popover	= 	$hsp_address_info.$hsp_contact_info." <hr style='margin-top:5px;margin-bottom:5px;'/><b>Available Branches</b><hr style='margin-top:5px;margin-bottom:5px;'/>";

			/*$branches	=	explode(",",$branches);


			for($k=0;$k<count($branches);$k++)
			{
				$provider_info_popover.= "<i class='fa fa-check text-success'></i> ".$branches[$k];
				if($k<count($branches))
				{
					$provider_info_popover.="<hr style='margin-top:6px;margin-bottom:6px;'>";
				}
			}

			$info_popover_provider	=	'<a class="text-info" style="cursor:pointer;" data-container="body" data-toggle="popover" data-placement="left" data-content="'.$provider_info_popover.'" data-title="<a href=# class=pull-right data-dismiss=popover>&times</a>'.$hsp_name.'"><i class="fa fa-information"></i> Know More </a>';
			onClick="viewPackage(<?php echo $cluster_package_id ?>)
*/
					  ?>
                      <tr style="<?php echo $bg_color?>" >
                        <td width="15%" class="table_area" style="padding-bottom:0;">
                          <h1 class="mt-0" style="display: inline-block;font-weight: bold;font-size: 3em;padding-right:5px;"><?php echo $created_on_date[0];?></h1><h4 style="display: inline-block;vertical-align: top;margin-top: 2px;"><b><?php echo $created_on_date[1];?></b><br><?php echo $created_on_date[2];?></h4>
                          
                          <div class="pt-10">
							<div class="num_package">
								<!-- <a href="#"><span>40</span>PACKAGE PURCHASED</a> -->
							</div>
						  </div>
                        </td>
                        <td  width="45%" class="table_area packagehealth_title" style="padding-bottom:0;">
                         <b><?php echo $package_nm;?></b><br/><span style="font-size:11px;"><?php echo str_replace(',',', ',$lab_test_name_arr) ?></span>
							<div class="package_btns"><a href="javascript:void(0);" class="appointment-act invite" alt="<?php echo $cluster_package_id."~".$package_nm;?>"><i class="fa fa-location-arrow"></i> INVITE</a><a href="javascript:void(0)" onClick="viewPackage(<?php echo $cluster_package_id?>)" class="appointment-act"><i class="fa fa-shopping-cart"></i> VIEW PURCHASE SUMMARY</a>
							<!-- <a href="#" class="appointment-act"><i class="fa fa-clock-o"></i> MANAGE PURCHASE</a>
							<a href="#" class="appointment-act"><i class="fa fa-question-circle-o"></i> FAQs</a> -->
							</div>
                        </td>
						
                        <td class="wherecenter table_area" style="padding-bottom:0;width:30%;text-align:center;">
							<div class="row">
							<div class="col-sm-4">
							<img src="<?php echo EBH_WEBSITE_URL."".$hsp_logo;?>"  style="text-align:center" class="floatleft" alt="">
							</div>
							<?php echo ($hsp_count>1)?"<br/><a href=\"javascript:void(0)\" onClick=\"showHsp($cluster_package_id)\" class=\" text-info\">more..</a>":'';?>
							<!-- <img src="images/center.jpg" class="floatleft" style="width: 150px;"> --> 
							<div class="col-sm-8" style="text-align:left">
                            <b>Suburban</b> Diagnostics<br>
                            Andheri (W),<br>
                            Mumbai
							</div>
						  </div>
                        </td>
                        <td class="analytic_area table_area" style="padding-bottom:0;width:15%">                      
                          <div class="chart-responsive" style="text-align: center;">
                    <canvas id="pieChart<?php echo  $cluster_package_id?>" height="75" width="20%"></canvas>
                  </div>
                        </td>
                      </tr>
                     <tr style="<?php echo $bg_color?>">
                          <td colspan="4" align="left" style="border:0;padding-top:0">
                              
                           
                           <!-- <a href="#" class="appointment-act"><i class="fa fa-question-circle"></i> FAQs</a>
                            <a href="#" class="appointment-act"><i class="fa fa-shopping-cart"></i> VIEW PURCHASE SUMMARY</a>
                            <a href="#" class="print_icon"><i class="fa fa-print"></i></a> -->
                           
                        
                          </td>
                      </tr>
<?php  } }else{ ?>
<tr><td colspan="4" align="center">No Health Package Available</td></tr><?php  } ?>
					  </tbody>
                  </table>
                </div>
                <div class=" hidden" id="invite_employee">
<?php
$form_action =  "portal/invite.php";
?>
<form role="form" class="form-horizontal" novalidate="novalidate" method="post" action="<?php echo $form_action;?>" name="frminvite" id="frminvite" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" id="cluster_package_id" name="cluster_package_id" value="">
	<input type="hidden" id="cluster_id" name="cluster_id" value="<?php echo $database->clusterId;?>">
	<div class="col-sm-7">
		<div class="panel">
			<div class="panel-heading text-primary">
				<span class="panel-title" id="invite-title">Invite Employee </span>
				<span id="temp"></span>
			</div>
			<div class="panel-body">
						<div>
							<label><input type="radio" name="clusterpkg" id="clusterpkgfile" value="fileupload" checked="checked"> Bulk Import Employee</label><br>
							<label><input type="radio" name="clusterpkg" id="clusterpkgemp" value="
							"> Select From Employee List</label><br>
							<label><input type="radio" name="clusterpkg" id="clusterpkgnewemp" value="newemp"> New Employee</label>
						</div>
						<p>&nbsp;</p>

						<div class="form-group">
							<div class="col-sm-12">
								<div id="fileupload">
									<label class="filebutton"><i class="fa fa-upload"></i> Upload Employee Data <span>
										<input type="file" id="fileupload" name="fileupload" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"></span>
										<span class="help-block text-center">Upload Only .xlsx</span>
									</label>
								</div>
							</div>
						</div>


						<div class="form-group">
							<div class="col-sm-10">
								<div id="emp_list">
									<label class="control-label">Select Employees</label>
									<select class="form-control input-sm select2" data-placeholder="Select the Employees" id="cluster_emp_id" name="cluster_emp_id[]" style="width:100%" multiple>
										<?php
											$arr_employees	=	$database->getClusterEmp($database->clusterId);
											for($i=0;$i<count($arr_employees);$i++)
											{
												$employee_id		=	$arr_employees[$i]['emp_id'];
												$emp_name			=	$arr_employees[$i]['emp_name'];

												$selected = '';
												if (is_array($emp_id_arr)) {
													if (in_array($employee_id, $emp_id_arr))
														$selected = 'selected="selected"';
												}
												echo "<option value='".$employee_id."' ".$selected .">".$emp_name."</option>";
											}
										?>
									</select>
								</div>
							</div>
						</div>


						<!-- new emp form !-->
						<div class="form-group">
							<div class="col-sm-12">
								<div id="newemployee" class="panel panel-cascade">
								<div class="panel-body" style="padding: 15px;">
									<div class="row">
									<div class="col-sm-4">
										<label>Salutation *</label>
										<select size="1" name="emp_dr" class="form-control input-sm" required>
											<option value="" hidden>Select</option>											
											<option value="Mr.">Mr.</option>
											<option value="Mrs.">Mrs.</option>
											<option value="Ms.">Ms.</option>
										</select>
									</div>
									<div class="col-sm-4" style="padding-left: 0px;">
										<label>First Name *:</label>
										<input type="text" class="form-control" id="emp_first_name" name="emp_first_name" pattern="[A-Za-z\s]{1,}" required>
									</div>
									<div class="col-sm-4" style="padding: 0px;">
										<label>Last Name *:</label>
										<input type="text" class="form-control" id="emp_last_name" name="emp_last_name" pattern="[A-Za-z\s]{1,}" required>
									</div>
									</div>
									<p>&nbsp;</p>

									<div class="row">
									<div class="col-sm-12" style="padding-right: 0px;">
										<label>Professional Email ID *:</label>
										<input type="email" class="form-control" id="pro_email_id" name="pro_email_id" required onblur="checkEmail(this);">
										<span id="email_msg" class="help-inline text-danger" style="display: none">This email id is already in use</span>
									</div>
									</div>
									<p>&nbsp;</p>

									<div class="row">
									<div class="col-sm-6" style="padding-right: 0px;">
										<label>Mobile No *:</label>
										<input type="text" class="form-control" name="mobile_no" id="mobile_no" pattern="[0-9]{10,12}" required onblur="checkMobile(this);">
										<div id="phone_msg" class="help-inline text-danger" style="display: none">This phone no. is already in use</div>
									</div>
									</div>
									<p>&nbsp;</p>

                                </div>
								</div>
							</div>
						</div>
						<!-- #new emp form !-->

						<div class="form-group">
							<div class="col-sm-12">
							  <button type="submit" class="btn btn-wide btn-success"><i class="fa fa-check-circle"></i> Invite Now</button>
							  <a class="btn btn-wide btn-warning" id='btn-cancel'><i class="fa fa-times"></i> Cancel</a>
							</div>
						</div>

						<div id="message_div"></div>
					</div>

		</div>
	</div>

	<div class="col-sm-5">
		<div class="panel">
			<div class="panel-heading text-primary"> <span class="panel-title">Guidelines</span> </div>
			<div class="panel-body">
			 <ul style="line-height:200%;">
				   <li><a style="color:#0000ff" href="<? echo HTTP_SERVER; ?>portal/employee/bulkimport.xlsx">Download</a> Employee Import Format. </li>
				   <li>Please do not change or edit columns heading</li>
				   <li>System will not accept records without email-id</li>
				   <li>Leave the columns blank incase no data available</li>
				   <li>Share your invitation message (optional)</li>
				   <li>Upload updated excel</li>
			   </ul>
			</div>
		</div>
	</div>
</form>
</div>

				</div>
                <!-- /.tab-pane -->  
                </div>
                <!-- /.tab-pane -->
              </div>
              </div>
			  
			  
			  
            </section>
			
		
         <!-- <section class="content">
			<div class="col-sm-12 wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
				<h4 class="" style="text-align:center;font-weight:bold">
				  Recommended
				</h4>
			</div>
            <div id="disp-table">
				<div class="col-md-12">
				<div class="col-md-1"></div>
              <div class="col-sm-3 wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
                <div class="box-layout2 health_pack_page pack_one">
                  <div class="" style="margin: 0 auto;float: none;"> 
                    <div class="user-info">
                      <div class="title">
                        STARTED
                      </div> 
                    </div>
                    <div class="user-summary">
                      <i class="fa fa-inr" aria-hidden="true"></i>44,000
                    </div>
                     <div class="type_variety">
                      <div class="title">
                        THE COMPLETE EYE CARE PACKAGE
						<p>EAGLES EYE HOSPITAL</p>
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        Squint and Glaucoma
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        Dry eye treatment
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        LASIK Surgery
                      </div> 
                    </div>
					 <div class="pack_details">
                      <div class="title">
							<a href="#">VIEW DETAILS</a>
                      </div> 
                    </div>
					
                  
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
				
              <div class="col-sm-3 wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
               <div class="box-layout2 health_pack_page pack2">
                  <div class="" style="margin: 0 auto;float: none;"> 
                    <div class="user-info">
                      <div class="title">
                        STARTED
                      </div> 
                    </div>
                    <div class="user-summary">
                      <i class="fa fa-inr" aria-hidden="true"></i>44,000
                    </div>
                     <div class="type_variety">
                      <div class="title">
                        THE COMPLETE EYE CARE PACKAGE
						<p>EAGLES EYE HOSPITAL</p>
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        Squint and Glaucoma
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        Dry eye treatment
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        LASIK Surgery
                      </div> 
                    </div>
					 <div class="pack_details">
                      <div class="title">
							<a href="#">VIEW DETAILS</a>
                      </div> 
                    </div>
					
                  
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
			  
			  <div class="col-sm-3 wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
                <div class="box-layout2 health_pack_page pack3">
                  <div class="" style="margin: 0 auto;float: none;"> 
                    <div class="user-info">
                      <div class="title">
                        STARTED
                      </div> 
                    </div>
                    <div class="user-summary">
                      <i class="fa fa-inr" aria-hidden="true"></i>44,000
                    </div>
                     <div class="type_variety">
                      <div class="title">
                        THE COMPLETE EYE CARE PACKAGE
						<p>EAGLES EYE HOSPITAL</p>
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        Squint and Glaucoma
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        Dry eye treatment
                      </div> 
                    </div>
					 <div class="type_variety">
                      <div class="title">
                        LASIK Surgery
                      </div> 
                    </div>
					 <div class="pack_details">
                      <div class="title">
							<a href="#">VIEW DETAILS</a>
                      </div> 
                    </div>
					
                  
                  </div>
                  <div class="clearfix"></div>
                </div>
              </div>
              <div class="clearfix"></div>
			  </div>
            </div>
          </section>
         -->
		 
		<!--
		
		 <div class="col-md-12">
			<div class="row">
				<h3 style="text-align:center;font-weight:bold">Recommended</h3>
			</div>
			 <div class="clearfix"></div>
			 <br>
		</div>
		
<div class="col-md-12 carousel-reviews broun-block hidden-xs">
    <div class="row">
        <div class="col-md-12">
            <div id="carousel-reviews" class="carousel slide" data-ride="carousel">            
                <div class="carousel-inner col-md-offset-1 col-md-10">
                    <div class="item active">						
                	    <div class="col-md-4 p0 recomend_package_plans">
        				    <div class="wow bounceInLeft" style="padding-left: 0;">
								<div class="box-layout2 health_pack_page pack_one">
								  <div class="pack1" style="margin: 0 auto;float: none;"> 
									<div class="user-info">
									  <div class="title">
										BASIC PACKAGE
									  </div> 
									</div>
									<div class="user-summary">
									  <i class="fa fa-inr" aria-hidden="true"></i>700<br>
									  <p class="fs14">6 TESTS + 1 CONSULTATION</p>
									</div>
									 <div class="type_variety">
									  <div class="title">
										TESTS: CBC, ESR (Electrolyte Sedimentation Rate), Blood Grouping, Rh Factor, Urine Routine, Blood Pressure.
										<p>EAGLES EYE HOSPITAL</p>
									  </div> 
									</div>
									 <div class="consult_area">
									  <div class="title">
										Consultation: Physician
									  </div> 
									</div>									 
									 <div class="pack_details">
									  <div class="title">
											<a href="#">KNOW MORE</a>
									  </div> 
									</div>		
								  </div>
								  <div class="clearfix"></div>
								</div>
							  </div>
						</div>
            			<div class="col-md-4 p0 recomend_package_plans">
						    <div class="wow bounceInLeft" style="padding-left: 0;">
								   <div class="box-layout2 health_pack_page pack2">
									  <div class="" style="margin: 0 auto;float: none;"> 
										<div class="user-info">
										  <div class="title">
											CHILDREN
										  </div> 
										</div>
										<div class="user-summary">
										  <i class="fa fa-inr" aria-hidden="true"></i>1100<br>
										  <p class="fs14">10 TESTS + 2 CONSULTATIONS</p>
										</div>
										 <div class="type_variety">
										  <div class="title">
											TESTS: CBC (Complete Blood Count) & Chest X-Ray, Random Blood Sugar, Urine Routine, SGPT, + 7 More
											<p>EAGLES EYE HOSPITAL</p>
										  </div> 
										</div>
										 <div class="consult_area">
										  <div class="title">
											Consultations: Pediatric + Dental
										  </div> 
										</div>
										 <div class="pack_details">
										  <div class="title">
												<a href="#">KNOW MORE</a>
										  </div> 
										</div>
									  </div>
									  <div class="clearfix"></div>
									</div>
								  </div>
						</div>
						<div class="col-md-4 p0 recomend_package_plans">
							<div class="wow bounceInLeft" style="padding-left: 0;">
								<div class="box-layout2 health_pack_page pack3">
								  <div style="margin: 0 auto;float: none;"> 
									<div class="user-info">
									  <div class="title">
										WORKING MEN
									  </div> 
									</div>
									<div class="user-summary">
									  <i class="fa fa-inr" aria-hidden="true"></i>2700<br>
									  <p class="fs14">16 TESTS + 1 CONSULTATION</p>
									</div>
									 <div class="type_variety">
									  <div class="title">
										TESTS: Total Cholesterol, Vitamin D3 & B12, SGOT, SGPT, Fasting Blood Sugar + 10 More
										<p>EAGLES EYE HOSPITAL</p>
									  </div> 
									</div>
									 <div class="consult_area">
									  <div class="title">
										Consultations: Physician
										</div>
									</div>
									 <div class="pack_details">
									  <div class="title">
											<a href="#">KNOW MORE</a>
									  </div> 
									</div>	
								  </div>
								  <div class="clearfix"></div>
								</div>
							  </div>
						</div>
					</div>
                    <div class="item">
                        <div class="col-md-4 p0 recomend_package_plans">
        				    <div class="wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
								<div class="box-layout2 health_pack_page pack_one">
								  <div class="pack1" style="margin: 0 auto;float: none;"> 
									<div class="user-info">
									  <div class="title">
										WORKING WOMEN
									  </div> 
									</div>
									<div class="user-summary">
									  <i class="fa fa-inr" aria-hidden="true"></i>2900<br>
									  <p class="fs14">17 TESTS + 2 CONSULTATIONS</p>
									</div>
									 <div class="type_variety">
									  <div class="title">
										TESTS: Thyroid Function Test, Vitamin D3 & B12, ECG, PCOD, Total Cholesterol + 12 More
										<p>EAGLES EYE HOSPITAL</p>
									  </div> 
									</div>
									 <div class="consult_area">
									  <div class="title">
										Consultations: Physician & Gynecologist
									  </div> 
									</div>
									 <div class="pack_details">
									  <div class="title">
											<a href="#">KNOW MORE</a>
									  </div> 
									</div>
								  </div>
								  <div class="clearfix"></div>
								</div>
							  </div>
						</div>
            			<div class="col-md-4 p0 recomend_package_plans">
						    <div class="wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
								   <div class="box-layout2 health_pack_page pack2">
									  <div class="" style="margin: 0 auto;float: none;"> 
										<div class="user-info">
										  <div class="title">
											SENIOR MALE
										  </div> 
										</div>
										<div class="user-summary">
										  <i class="fa fa-inr" aria-hidden="true"></i>3900<br>
										  <p class="fs14">23 TESTS + 3 CONSULTATIONS</p>
										</div>
										 <div class="type_variety">
										  <div class="title">
											TESTS: Prostate Cancer Test, ECG/Stress Test, Fasting Blood Sugar, + 20 More
											<p>EAGLES EYE HOSPITAL</p>
										  </div> 
										</div>
										 <div class="consult_area">
										  <div class="title">
											Consultations: Physician, Dental & Ophthalmic
										  </div> 
										</div>
										 <div class="pack_details">
										  <div class="title">
												<a href="#">KNOW MORE</a>
										  </div> 
										</div>
									  <div class="clearfix"></div>
									</div>
								  </div>
								</div>
							</div>
						<div class="col-md-4 p0 recomend_package_plans">
							<div class="wow bounceInLeft" style="padding-left: 0;">
								<div class="box-layout2 health_pack_page pack3">
								  <div class="" style="margin: 0 auto;float: none;"> 
									<div class="user-info">
									  <div class="title">
										SENIOR FEMALE
									  </div> 
									</div>
									<div class="user-summary">
									  <i class="fa fa-inr" aria-hidden="true"></i>4300<br>
									  <p class="fs14">24 TESTS + 4 CONSULTATIONS</p>
									</div>
									 <div class="type_variety">
									  <div class="title">
										TESTS: Mammography, Thyroid Function Test, ECG/Stress Test + 21 More
										<p>EAGLES EYE HOSPITAL</p>
									  </div> 
									</div>
									 <div class="type_variety">
									  <div class="title">
										Consultations: Physician, Dental, Ophthalmic & Gynecologist
									  </div> 
									</div>
									 
									 <div class="pack_details">
									  <div class="title">
											<a href="#">KNOW MORE</a>
									  </div> 
									</div>
								  <div class="clearfix"></div>
								</div>
							  </div>
							</div>
						</div>
					</div>
                    <div class="item">
                        <div class="col-md-4 p0 recomend_package_plans">
        				    <div class="wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
								<div class="box-layout2 health_pack_page pack_one">
								  <div class="pack1" style="margin: 0 auto;float: none;"> 
									<div class="user-info">
									  <div class="title">
										WORKING WOMEN
									  </div> 
									</div>
									<div class="user-summary">
									  <i class="fa fa-inr" aria-hidden="true"></i>2900<br>
									  <p class="fs14">17 TESTS + 2 CONSULTATIONS</p>
									</div>
									 <div class="type_variety">
									  <div class="title">
										TESTS: Thyroid Function Test, Vitamin D3 & B12, ECG, PCOD, Total Cholesterol + 12 More
										<p>EAGLES EYE HOSPITAL</p>
									  </div> 
									</div>
									 <div class="consult_area">
									  <div class="title">
										Consultations: Physician & Gynecologist
									  </div> 
									</div>
									 <div class="pack_details">
									  <div class="title">
											<a href="#">KNOW MORE</a>
									  </div> 
									</div>
								  </div>
								  <div class="clearfix"></div>
								</div>
							  </div>
						</div>
            			<div class="col-md-4 p0 recomend_package_plans">
						    <div class="wow bounceInLeft" style="padding-left: 0;" data-wow-delay="0.2s">
								   <div class="box-layout2 health_pack_page pack2">
									  <div class="" style="margin: 0 auto;float: none;"> 
										<div class="user-info">
										  <div class="title">
											SENIOR MALE
										  </div> 
										</div>
										<div class="user-summary">
										  <i class="fa fa-inr" aria-hidden="true"></i>3900<br>
										  <p class="fs14">23 TESTS + 3 CONSULTATIONS</p>
										</div>
										 <div class="type_variety">
										  <div class="title">
											TESTS: Prostate Cancer Test, ECG/Stress Test, Fasting Blood Sugar, + 20 More
											<p>EAGLES EYE HOSPITAL</p>
										  </div> 
										</div>
										 <div class="consult_area">
										  <div class="title">
											Consultations: Physician, Dental & Ophthalmic
										  </div> 
										</div>
										 
										 <div class="pack_details">
										  <div class="title">
												<a href="#">KNOW MORE</a>
										  </div> 
										</div>
									  <div class="clearfix"></div>
									</div>
								  </div>
								</div>
							</div>
						<div class="col-md-4 p0 recomend_package_plans">
							<div class="wow bounceInLeft" style="padding-left: 0;">
								<div class="box-layout2 health_pack_page pack3">
								  <div class="" style="margin: 0 auto;float: none;"> 
									<div class="user-info">
									  <div class="title">
										SENIOR FEMALE
									  </div> 
									</div>
									<div class="user-summary">
									  <i class="fa fa-inr" aria-hidden="true"></i>4300<br>
									  <p class="fs14">24 TESTS + 4 CONSULTATIONS</p>
									</div>
									 <div class="type_variety">
									  <div class="title">
										TESTS: Mammography, Thyroid Function Test, ECG/Stress Test + 21 More
										<p>EAGLES EYE HOSPITAL</p>
									  </div> 
									</div>
									 <div class="consult_area">
									  <div class="title">
										Consultations: Physician, Dental, Ophthalmic & Gynecologist
									  </div> 
									</div>
									 
									 <div class="pack_details">
									  <div class="title">
											<a href="#">KNOW MORE</a>
									  </div> 
									</div>
								  <div class="clearfix"></div>
								</div>
							  </div>
							</div>
						</div>
					</div>                    
                </div>
                <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
</div>
-->	 
		
		 
		  <section class="content" style="margin-top:45px;">
			<div class="final">
			<div class="col-md-12">
        <div class="col-sm-8 pt-20 wow bounceInLeft" style="padding-left: 0px; visibility: visible; animation-delay: 0.2s; animation-name: bounceInLeft;" data-wow-delay="0.2s">
          <div class="box-layout1">
            
            <section id="smartwatch" class="content">
                
              <div class="col-sm-12" style="padding: 0;">
                              
                  <div class="col-sm-3 pt-20" style="margin: 0 auto;text-align: center;">
                    <img src="dist/img/suitcase.png" width="130px">
                  </div>
                  <div class="col-sm-9  pt-20 package_info pb-40">
                    <h3 class="black"><b>Create Your Own Package</b></h3>
					<p>We offer custom tailored <b>Personalised Health Checkup Packages</b> to suit your body, fitness, health and lifestyle. You don't have to go through a battery of tests just because it is included in the set package.</p>
					<div class="rescenter">
						<div class=" col-md-9 p0" style="padding:0px;">
							<div class=" col-md-5 start_btn_area" i>
						<a href="#" class="btn btn-primary btn-green cwhite start_btn" alt="coming soon" title="coming soon" id="get_started" ><Span id="get_started_text">GET STARTED</span></a>
							</div>
							<div class=" col-md-7">
								<a href="#" class="btn btn-block call_back_btn" alt="coming soon" title="coming soon"  id="request_call"><b><Span id="request_call_text">REQUEST A CALL</Span></b></a>
								<div class="clearfix"></div>
						</div>
					  </div>
					</div>
				  </div>
                  <div class="clearfix"></div>
               
              </div>
              <div class="clearfix"></div>
            </section>
          </div>
        </div>
        <div class="col-sm-4 pt-20 wow bounceInRight" style="padding-right:0px;">
          <div class="box-layout1">
            <!-- Main content -->
           <section class="content health_package_title">
				<h1>DID YOU <br>KNOW?</h1>
				<p>7 out of 10 people</p>
				<span>believe that being healthy<br>
keeps one more focussed and <br> productive at work</span>
            </section>
          </div>
        </div>
		</div>
        <div class="clearfix"></div>
      </div>
			
			</section> 
			<!--  <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart26" height="150"></canvas>
                  </div>
                
                </div>
              
              </div>
           
            </div>		  <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <div class="chart-responsive">
                    <canvas id="pieChart27" height="150"></canvas>
                  </div>
                 
                </div>
              
              </div>
             
            </div>
          <!-- /.content -->
        </div>
      </div>  
    </div>
    <div class="clearfix"></div>
  </div>

  
</div>
<div class="modal fade" id="view_hsp" role="dialog">
	<div class="modal-dialog modal-lg" style="width:70%">
		<div class="modal-content" id="hsp_content">
			
		</div>
	</div>
</div>
<div class="modal fade" id="view_package_summary" role="dialog">
	<div class="modal-dialog modal-md" style="width:70%">
		<div class="modal-content" id="package_summary">
			
		</div>
	</div>
</div>
<!-- ./wrapper -->
<?php include_once('partials/footer.php'); ?>
<script src="dist/js/bootstrap-datepicker.min.js"></script>

<script src="dist/js/cluster.js"></script>
<script src="dist/js/chart.js"></script>

<script>
  $(function () {
	   $('.package_menu').addClass('active');
	   
                    $( "#request_call" ).hover(
  function() {
    $( "#request_call_text" ).text( "COMING SOON" );
  }, function() {
    $( "#request_call_text" ).text( "REQUEST A CALL" );
  }
);
                        $( "#get_started" ).hover(
  function() {
    $( "#get_started_text" ).text( "COMING SOON" );
  }, function() {
    $( "#get_started_text" ).text( "GET STARTED" );
  }
);          
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

	  		
    // input 1 styles
    $(".input__1 input, .textarea__1 textarea").focus(function(){
      if($(this).parent().hasClass("input__1"))
        $(this).prev().removeClass("input__1_blurred").addClass("input__1_focused");
      else if($(this).parent().hasClass("textarea__1"))
        $(this).prev().removeClass("textarea__1_blurred").addClass("textarea__1_focused");

      $(this).prev().parent().css({
        borderBottom : "1px solid #43ce5a"
      });
    });
    $(".input__1 input, .textarea__1 textarea").blur(function(){
      if($(this).val() === ""){
        if($(this).parent().hasClass("input__1"))
          $(this).prev().addClass("input__1_blurred").removeClass("input__1_focused");
        else if($(this).parent().hasClass("textarea__1"))
          $(this).prev().addClass("textarea__1_blurred").removeClass("textarea__1_focused");
        $(this).prev().parent().css({
          borderBottom : "1px solid #95989c"
        });
      }
    });
  });
  function viewPackage(cpid){
			$.ajax({
				url: 'portal/view_summary.php',
				type: 'post',
				data: 'id='+cpid,
				success: function(response) {
					$('#package_summary').html(response);
					$('#view_package_summary').modal('show');
				}
			});
}
</script>
</body>
</html>
