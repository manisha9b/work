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
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="col-sm-12">
      <div class="pb-20">
        <div class="">
          <!-- Content Header (Page header) -->       
          
          <!-- Main content -->
		  <section class="content-header">
		  <div class="col-md-12">
      <h3 class="pull-left">
        <b>Health Packages</b>
      </h3>
      <div class="pull-right resright">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li>
              <a class="btn3 ask_Any" href="#">
                <img src="dist/img/ask.png"> Ask me anything
              </a>
            </li>
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 0px 10px;">
                <i class="fa fa-bell-o"></i>
                <span class="label label-danger">6</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 6 messages</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <!-- end message -->
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 2 hours</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> Today</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> Yesterday</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
          </ul>
        </div>  
      </div>
	  </div>
      <div class="clearfix"></div>
	  <hr class="hrdivide">
    </section>
		
		  <section class="content">
			<div class="col-md-12">
			<div class="pull-right" style="margin-top: -10px;">
				<span>Timeframe<span> : 
				<select style="font-weight: bold;background: transparent;border:none;display: inline-block;width: 125px;height: auto;padding: 0 5px;">
					<option>Last 6 months</option>
					<option>Last 12 months</option>
				</select>
			</div>
            <div class="pt-20"></div>
            <div id="appointments" class="nav-tabs-custom mb-65">
              <ul class="nav nav-tabs">
                <li class="active">
				<div class="dropdown">
					  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background: #3D4452;
    padding:9.5px;border-radius: 0!important;">PURCHASED <span class="caret"></span></a>
					  <ul class="dropdown-menu purchase_drop_down" style="width: 140%;">
						<li><a href="#">Pre Employment</a></li>
						<li><a href="#">Annual Checkup</a></li>
						<li><a href="#">Package Type A</a></li>
						<li><a href="#">Add Tabs</a></li>
					  </ul>
					</div>
				
				</li>
                <li><a href="#tab_2-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false">RECOMMENDED</a></li>
                <li><a href="#tab_3-2" onclick="return hidesummary()" data-toggle="tab">All</a></li>
                <li class="pull-right nohover1">
                  <!-- search form -->
                  <form action="#" method="get" class="sidebar-form1" style="display: inline-block;background: #FFFFFF;">
                    <div class=" inner-addon left-addon">
                      <i class="fa fa-search"></i>
                      <input type="text" name="q" class="form-control" placeholder="Type To Search">
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
                </li> -->
                
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
				<div id="div-list">
                  <table id="appttab" class="table table-appointment responsive-table">
                    <tbody>
                      <tr style="background: transparent;">
                        <th>
                          Date &amp; Time
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
		//print_r($arr_ebh_pack[$i]);
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
*/
					  ?>
                      <tr onclick="viewsummay()">
                        <td width="200" class="table_area">
                          <h1 class="mt-0" style="display: inline-block;font-weight: bold;font-size: 3em;"><?php echo $created_on_date[0];?></h1><h4 style="display: inline-block;vertical-align: top;margin-top: 2px;"><b><?php echo $created_on_date[1];?></b><br><?php echo $created_on_date[2];?></h4>
                          
                          <div class="pt-10">
							<div class="num_package">
								<!-- <a href="#"><span>40</span>PACKAGE PURCHASED</a> -->
							</div>
						  </div>
                        </td>
                        <td class="table_area">
                         <b><?php echo $package_nm;?></b>
						  <div class="package_opt">
                            <a href="javascript:void(0);" class="appointment-act invite" alt="<?php echo $cluster_package_id."~".$package_nm;?>"><i class="fa fa-location-arrow"></i> INVITE</a>
                           <!-- <a href="#" class="appointment-act"><i class="fa fa-question-circle"></i> FAQs</a>
                            <a href="#" class="appointment-act"><i class="fa fa-shopping-cart"></i> VIEW PURCHASE SUMMARY</a>
                            <a href="#" class="print_icon"><i class="fa fa-print"></i></a> -->
                           
                          </div>
                        </td>
						
                        <td class="wherecenter table_area">
                          <div class="col-sm-4">
                            <div class="row">
							<img src="<?php echo EBH_WEBSITE_URL."".$hsp_logo;?>"  style="width: 150px;" class="floatleft" alt="">
							<!-- <img src="images/center.jpg" class="floatleft" style="width: 150px;"> --> </div>
                          </div>
                          <div class="col-sm-7">
                            <b><?php echo $hsp_name;?></b> <br>
                            <?php echo $hsp_address;?>
                          </div>
                        </td>
                        <td class="analytic_area table_area">                      
                          <img src="dist/img/analytics.png">
						  <span class="text-uppercase analytic_img">+25%</span>
                        </td>
                      </tr>
<?php  } } ?>
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
							<label><input type="radio" name="clusterpkg" id="clusterpkgemp" value="emp_list"> Select From Employee List</label><br>
							<label><input type="radio" name="clusterpkg" id="clusterpkgnewemp" value="newemp"> New Employee</label>
						</div>
						<p>&nbsp;</p>

						<div class="form-group">
							<div class="col-sm-12">
								<div id="fileupload">
									<label class="filebutton"><i class="fa fa-upload"></i> Upload Employee Data <span>
										<input type="file" id="fileupload" name="fileupload" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"></span>
										<span class="help-block">Upload Only .xlsx</span>
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
				   <li><a style="color:#0000ff" href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/employee/bulkimport.xlsx">Download</a> Employee Import Format. </li>
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
          <section class="content">
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
          <div class="clearfix"></div>
		  <section class="content" style="margin-top:45px;">
			<div class="final">
			<div class="col-md-12">
        <div class="col-sm-8 pt-20 wow bounceInLeft" style="padding-left: 0px; visibility: visible; animation-delay: 0.2s; animation-name: bounceInLeft;" data-wow-delay="0.2s">
          <div class="box-layout1">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->
            <section id="smartwatch" class="content">
              <div class="col-sm-12" style="padding: 0;">
                                
                  <div class="col-sm-3 pt-20" style="margin: 0 auto;text-align: center;">
                    <img src="dist/img/suitcase.png" width="130px">
                  </div>
                  <div class="col-sm-9  pt-20 package_info pb-40">
                    <h3><b>Create Your Own Package</b></h3>
					<p>We offer custom tailored <b>Personalised Health Checkup Packages</b> to suit your body, fitness, health and lifestyle. You don't have to go through a battery of tests just because it is included in the set package.</p>
					<div class="rescenter">
						<div class=" col-md-9 p0" style="padding:0px;">
							<div class=" col-md-5 start_btn_area">
						<a href="#" class="btn btn-primary btn-green cwhite start_btn">GET STARTED</a>
							</div>
							<div class=" col-md-7">
						<a href="#" class="btn btn-block call_back_btn"><b>REQUEST A CALL BACK</b></a>
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
        <div class="col-sm-4 pt-20 wow bounceInRight">
          <div class="box-layout1">
            <!-- Main content -->
            <section class="content health_package_title">
				<h1>DID YOU <br>KNOW?</h1>
				<p>7 out of 10 people</p>
				<span>believe that being healthy<br>
keeps one more focussed and <br> productiev at work</span>
            </section>
          </div>
        </div>
		</div>
        <div class="clearfix"></div>
      </div>
			
			</section>
          <!-- /.content -->
        </div>
      </div>  
    </div>
    <div class="clearfix"></div>
  </div>

  
</div>
<!-- ./wrapper -->
<?php include_once('partials/footer.php'); ?>
<script src="dist/js/bootstrap-datepicker.min.js"></script>

<script src="dist/js/cluster.js"></script>
<script>
  $(document).ready(function(){
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
</script>
</body>
</html>
