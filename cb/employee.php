<?php 
include_once('partials/header2.php'); 
unset($arr_ebh_pack);
  $health = '';
  if(isset($_GET['health']) && ($_GET['health']=='H' || $_GET['health']=='UH')){
	  $health = $_GET['health'];
  }
$arr_emp	=	$database->getClusterEmpDetails($clusterId,$health);
  //ini_set("display_errors", "1");
  //error_reporting(E_ALL);

$arr_emp_count	=	$database->getClusterEmpCount($clusterId);
$emp_arr['healty'] = $database->getClusterEmpDetails($clusterId,'H',' Limit 3');
$emp_arr['unhealty'] = $database->getClusterEmpDetails($clusterId,'UH',' Limit 3');
//echo "<pre>";
//print_R($arr_emp);//die;
//echo "</pre>";
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
		<div class="col-md-12">
      <h3 class="pull-left">
        <b><?php echo $arr_cluster['cluster_business_name']?>'s Employees</b>
      </h3>
      <div class="pull-right resright">
	  <?php 
include_once('partials/askme.php'); 
?>
       </div>      
	  </div>
	  <div class="clearfix"></div>
	  <hr class="hrdivide" />
    </section>
    
	
    <!-- Main content -->
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
		</div>
		<div class="row">
		<div class="col-md-12">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box box2 bg_dark_blue">
            <span class="info-box-icon bg-aqua dark_blue_clr"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1"><?php echo $arr_emp_count['total']?></span>
              <span class="info-box-number text-white">TOTAL EMPLOYEES</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box box3 healthy_employee">
            <span class="info-box-icon icon2 bg_dark_blue1 text-white"><i class="fa fa-heartbeat"></i></span>

            <div class="info-box-content bg_dark_blue1">
              <span class="info-box-text text2 clr_effect1 text-white"><?php echo $arr_emp_count['healthy']?></span>
              <span class="info-box-number text-white">HEALTHY EMPLOYEES</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box box4 unhealthy_employee">
            <span class="info-box-icon icon3"><img src="images/logo/unhealthy_icon.png" width="35"></span>

            <div class="info-box-content">
              <span class="info-box-text text2 text-white clr_effect1"><?php echo $arr_emp_count['unhealthy']?></span>
              <span class="info-box-number text-white">UNHEALTHY EMPLOYEE</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		  <div class="col-md-3 col-sm-6 col-xs-12"  data-toggle="modal" data-target="#myModal">
          <div class="info-box box4 bg-yellow">
            <span class="info-box-icon icon4"><i class="ion ion-person-add"></i></span>

            <div class="info-box-content">
              <span class="info-box-text text2 text-white clr_effect1"></span>
              <span class="info-box-number text-white" style="margin-top:15px;">ADD NEW EMPLOYEE</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- <div class="col-md-3 col-sm-6 col-xs-12" data-toggle="modal" data-target="#myModal">
          <div class="info-box box5 add_tab_new">
            <span class="info-box-icon icon4"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>

            <div class="info-box-content text">
              <span class="info-box-text text2">ADD EMPLOYEE</span>
              
            </div>
           
          </div>
        </div> -->
        <!-- /.col -->
		</div>
      </div>  
	  
	
		<div class="col-md-12">
		<div id="appointments" class="nav-tabs-custom">
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
	</div>
	   <div class="box no-border">
            <?php
if(isset($_REQUEST['m']))
 {
	echo $database->show_alert($_REQUEST['m']);
 }
?>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding emp_detail">
              <table class="table table-hover" <?php if(!empty($arr_emp)){ echo "id='reportsdatatables'";} ?>>
                <thead>
				<tr class="employee_table">
				 <th> </th>
                  <th style="width:20%;text-align:center;">NAME</th>
                  <th style="width:10%;text-align:center;">GENDER/AGE</th>
                  <th style="width:20%;text-align:center;">MOBILE</th>
                  <th style="width:25%;text-align:center;">EMAIL</th>
                  <!--<th style="width:45%;">CITY</th>-->
				  <!--<th style="width:10%;text-align:center;">BLOOD GROUP</th>-->
				  <th style="width:15%;text-align:center;"> </th>
				 
                </tr>
				</thead>
				<tbody>
				<?php
				$healthy_emp = array();
				$unhealthy_emp = array();
if(!empty($arr_emp))
{
	foreach($arr_emp as $row)
	{
		//+91 9930-7110-84
		//print_r($row);die;
		$mobile = '';
		$mobile_no_code	= (!empty($row['mobile_no_code'])) ? $row['mobile_no_code'] : "+91";
		$photo	= (!empty($row['photo_thumb'])) ? $row['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
		//s$photo	= "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
		if(!empty($row['mobile_no']))
		{
			$mobile = substr($row['mobile_no'],-10,-6)."-".substr($row['mobile_no'],-6,-2)."-".substr($row['mobile_no'],-2);
		}
		$mobile_no	= (!empty($mobile)) ? $mobile_no_code." ".$mobile : "";
		$age = '';
		if((!empty($row['dob']))){
			$age = ' ,'.$database->ageCalculator($row['dob']). 'Yrs';
		}
		$row['age'] = $age;
		$row['contact_no'] = $mobile_no;
		$row['gender'] = $database->getGender($row['salutation']);
		if($row['health'] == 'H'){
			$healthy_emp[] = $row;
			
		}
		if($row['health'] == 'UH'){
			$unhealthy_emp[] = $row;
			
		}
		?>
                <tr class="emp_info_data">
                  <td class="table_circle emp_pic" style="padding-left:2px;padding-right:2px;"><img src="<?php echo $photo?>"  class="img-circle"></td>
                  <td class="info"><?php echo $row['emp_name']?></td>
                  <td class="info"><?php echo $row['gender'].$age?></td>
                  <td class="info"><?php echo $mobile_no?></td>
				  <td class="info"><?php echo $row['professional_email_id']?></td>
				  <!--<td class="info"><?php echo $row['city_name']?></td>
				  <td class="info"><?php echo $row['blood_group']?></?></td>-->
				  <td style="text-align:center;vertical-align: middle;">
						
						<div class="btn-group emp_action_btn">
					  <button type="button" class="btn btn-success btn-flat">Action</button>
					  <button type="button" class="btn  btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="javascript:void(0);" onclick="openEditModal(<?php echo $row['emp_id']?>)"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a></li>
						<li><a href="javascript:void(0);" onclick="openViewModal(<?php echo $row['emp_id']?>)"><i class="fa fa-list-alt" aria-hidden="true"></i>View</a></li>
						
					  </ul>
					</div>
				  </td>
                </tr>
				<?php
				//$i++;
	}
}
else
{

	echo'<tr>
		<td colspan="7"  class="text-center">No Employee found!!</td>
	</tr>';
	
} ?>
                  </tbody>
			  </table>	
				<!-- <div class="box-header employee_pagination mt-20 pt-20 pb-20">
					<div class="col-md-12 total_entry">
					<tr>
					<td>Showing 8 out of 34 entries</td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td>
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a href="#">«</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">»</a></li>
					</ul>
					</td>				
					</tr>
					</div>
				</div> -->
			</div>
	   </div>
			  </div>
      
      <!-- /.row -->
    
      <!-- /.row -->
      <div class="row pt-20">		
        <div class="col-md-12 employe_health_area">
          <div class="col-md-6">
		  
		   <div class="box">  
			<div class="box-header with-border">
          <h4 class="pull-left margin0"><strong>Healthy Employees</strong></h4>
		</div>
		<?php 
		//	print_R($unhealthy_emp); 
		?>
            <!-- /.box-header -->
            <div class="box-body profileimg">
			<?php foreach($emp_arr['healty'] as $row){ 
				
				if((!empty($row['dob']))){
					$age = $database->ageCalculator($row['dob']). ' Yrs';
				}
				$report ='';
				if($row['bmi_status']=='H'){
						$report[] = "BMI: ".$row['bmi_category'];
					}
					if($row['bp_status']=='H'){
						$report[] = "Blood Pressure: ".$row['bp_category'];
					}
					if($row['bs_status']=='H'){
						$report[] = "Blood Sugar: ".$row['bs_result'];
					}
					$report = implode(', ',$report);
					$photo	= (!empty($row['photo_thumb'])) ? $row['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
				?>
              <img src="<?php echo $photo?>" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong><?php echo $row['emp_name']?></strong></span>
			  <span class="info" style="display:block">
					<?php echo $report; ?>
              </span>
			  </span>
				<a class="pull-right" style="top:0px;"> <?php echo $age?></a>
                <hr>
				<?php } ?>
			
			 <a href="employee.php?health=H" class="btn2-lg"><h5 class="margin0">View All</h5></a>
              
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
		
		
		<div class="col-md-6">
			
		   <div class="box"> 
				<div class="box-header with-border">
			  <h4 class="pull-left margin0"><strong>UnHealthy Employees</strong></h4>
			</div>
            <!-- /.box-header -->
		
            <div class="box-body profileimg">
             <?php foreach($emp_arr['unhealty'] as $row){ 
				
				if((!empty($row['dob']))){
					$age = $database->ageCalculator($row['dob']). ' Yrs';
				}
				$report_arr ='';
				if($row['bmi_status']=='UH'){
						$report_arr[] = "BMI: ".$row['bmi_category'];
					}
					if($row['bp_status']=='UH'){
						$report_arr[] = "Blood Pressure: ".$row['bp_category'];
					}
					if($row['bs_status']=='UH'){
						$report_arr[] = "Blood Sugar: ".$row['bs_result'];
					}
					$report = implode(', ',$report_arr);
					$photo	= (!empty($row['photo_thumb'])) ? $row['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
					
				?>
             <img src="<?php echo $photo?>" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong><?php echo $row['emp_name']?></strong></span>
			  <span class="info" style="display:block">
					<?php echo $report; ?>
              </span>
			  </span>
				<a class="pull-right" style="top:0px;"> <?php echo $age?></a>
                <hr>
				<?php } ?>
			 
			 <a href="employee.php?health=UH" class="btn2-lg"><h5 class="margin0">View All</h5></a>
              
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->

  </div>

  
</div>
<!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade" id="bloodpressure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="box-shadow: 0 6px 20px 8px rgba(0,0,0,0.5);">
    <div class="col-sm-12 modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-left cblue" id="myModalLabel">My Health Status</h4>
        <h4 class="modal-title pull-right" id="myModalLabel">Dashboard Update: <span class="cgreen">Blood Pressure</span></h4>
      </div>
      <div class="modal-body" style="padding-left: 10px;padding-right: 10px;">
        <p class="pt-10">
          Don't Know Your Blood Pressure count as on date? No Problem.<br/>
          Just walk to your nearest General Physician / Doctor and she can let you know.
        </p>
        <div class="pt-10 pb-30" style="border-bottom: 1px dotted #000000">
          <div class="col-sm-4">
            <div class="input__1">
              <div class="input__1_placeholder input__1_blurred">BP (systolic)</div>
              <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
            </div>
          </div>
           <div class="col-sm-4">
            <div class="input__1">
              <div class="input__1_placeholder input__1_blurred">BP (Diastolic)</div>
              <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
            </div>
          </div>
           <div class="col-sm-4">
            <div class="text-center">
              <div class="cgreen">As On:</div>
              <div class=" inner-addon right-addon">
                <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:35%;"></i>
                <input id="datepicker" type="text" name="date1" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;">
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div id="prevbp" style="display: none;">
          <div class="pt-10">
            <span class="text-uppercase">Remember your Count from a previous date?</span> Helps with the Graph
          </div>
          <div class="pt-10 pb-20" style="border-bottom: 1px dotted #000000">
            <div class="col-sm-4">
              <div class="input__1">
                <div class="input__1_placeholder input__1_blurred">BP (systolic)</div>
                <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
              </div>
            </div>
             <div class="col-sm-4">
              <div class="input__1">
                <div class="input__1_placeholder input__1_blurred">BP (Diastolic)</div>
                <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
              </div>
            </div>
             <div class="col-sm-4">
              <div class="text-center">
                <div class="cgreen">As On:</div>
                <div class=" inner-addon right-addon">
                  <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:35%;"></i>
                  <input id="datepicker2" type="text" name="date2" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;" />
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="pt-10 pb-10">
          <a href="#" class="btn cgreen" style="padding-left: 8px;padding-right: 8px;">ADD One More?</a><a href="#" class="btn cblue" data-dismiss="modal" aria-label="Close"  style="padding-left: 8px;padding-right: 8px;">No, I'm DONE</a><a href="#" id="addbloodsugar" class="btn btn-green cwhite" data-dismiss="modal" aria-label="Close"  style="padding-left: 8px;padding-right: 8px;">OR Add Blood Sugar level</a><a href="#" class="btn cgreen"  style="padding-left: 8px;padding-right: 8px;">Don't Know?</a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="bloodsugar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="col-sm-12 modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-left cblue" id="myModalLabel">My Health Status</h4>
        <h4 class="modal-title pull-right" id="myModalLabel">Dashboard Update: <span class="cgreen">Blood Sugar</span></h4>
      </div>
      <div class="modal-body">
        <p class="pt-10 cgreen">
          Don't Know Your Blood Sugar Level as on date? No Problem.<br/>
          Just walk to your nearest General Physician / Doctor and she can let you know.
        </p>
        <div class="pt-10 pb-20" style="border-bottom: 1px dotted #000000">
          <div class="col-sm-4">
            <div class="fieldname">
              Blood Sugar (Fasting):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="80 mm" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-5">
            <div class="fieldname">
              Blood Sugar (After Eating):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="120 hg" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-3">
            <div class="text-center">
              <div class="cgreen">As On:</div>
              <div class=" inner-addon right-addon">
                  <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:30%;"></i>
                  <input id="datepicker3" type="text" name="date3" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;" />
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="pt-10">
          <span class="text-uppercase">Remember your Count from a previous date?</span> Helps with the Graph
        </div>
        <div class="pt-10 pb-10" style="border-bottom: 1px dotted #000000">
          <div class="col-sm-4">
            <div class="fieldname">
              Blood Sugar (Fasting):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="00 mm" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-5">
            <div class="fieldname">
              Blood Sugar (After Eating):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="00 hg" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-3">
            <div class="text-center">
              <div class="cgreen">As On:</div>
              <div class=" inner-addon right-addon">
                  <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:30%;"></i>
                  <input id="datepicker4" type="text" name="date4" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;" />
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="pt-10 pb-10">
          <a href="#" class="btn cgreen">ADD One More?</a>
          <a href="#" class="btn cblue" data-dismiss="modal" aria-label="Close">No, I'm DONE</a>
        </div>
      </div> 
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<div class="modal fade" id="myViewModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div id="view_employee_form" class="form-horizontal">
					<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myEditModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<form action="<? echo HTTP_SERVER; ?>portal/employee/add-employee.php" name="edit_employee_form" id="edit_employee_form" method="post" class="form-horizontal">
					<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>
				</form>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<!-- Tabs !-->
				<ul id="schTab" class="nav nav-tabs">
					<li class="active"><a href="#add_new_form_tab" data-toggle="tab">New Employee</a></li>
					<li><a href="#add_new_file_tab" data-toggle="tab">Bulk Import</a></li>
				</ul>

				<div class="tab-content">
				<div class="tab-pane fade in active" id="add_new_form_tab">
				<p>&nbsp;</p>
				<!-- Add New Employee Form !-->
				<form action="<? echo HTTP_SERVER; ?>portal/employee/add-employee.php" name="add_employee_form" id="add_employee_form" method="post" class="form-horizontal">
				<input type="hidden" name="cluster_id" value="<?php echo $database->clusterId; ?>">
				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">Name:</label>
					<div class="col-xs-9">
						<div class="row">
							<div class="col-xs-3">
								<select size="1" name="emp_dr" class="form-control input-sm" required>
									<option value="" hidden>Select *</option>
									<option value="Mr.">Mr.</option>
									<option value="Mrs.">Mrs.</option>
									<option value="Ms.">Ms.</option>
								</select>
							</div>
							<div class="col-xs-3" style="padding-left: 0px;"><input type="text" class="form-control input-sm" id="emp_first_name" name="emp_first_name" placeholder="First name *" pattern="[A-Za-z\s]{1,}" required></div>
							<div class="col-xs-3" style="padding-left: 0px;"><input type="text" class="form-control input-sm" name="emp_middle_name" id="emp_middle_name" placeholder="Middle name" pattern="[A-Za-z\s]{1,}"></div>
							<div class="col-xs-3" style="padding-left: 0px;"><input type="text" class="form-control input-sm" name="emp_last_name" id="emp_last_name" placeholder="Last name *" pattern="[A-Za-z\s]{1,}" required></div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">Professional Email *:</label>
					<div class="col-xs-9">
						<input type="email" class="form-control" id="pro_email_id" name="pro_email_id" required onblur="checkEmail(this);">
						<div id="email_msg" class="help-inline text-danger" style="display: none">This email id is already in use</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">Personal Email:</label>
					<div class="col-xs-9">
						<input type="email" class="form-control" name="per_email_id" id="per_email_id">
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">Designation:</label>
					<div class="col-xs-9">
						<input type="text" class="form-control" name="designation" id="designation">
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">Mobile No *:</label>
					<div class="col-xs-4">
						<input type="text" class="form-control" name="mobile_no" id="mobile_no" pattern="[0-9]{10,12}" required onblur="checkMobile(this);">
						<div id="phone_msg" class="help-inline text-danger" style="display: none">This phone no. is already in use</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">City *:</label>
					<div class="col-xs-4">
						<select size="1" name="emp_city" id="emp_city" class="form-control input-sm" required>
							<option value="" hidden>Select City</option>
							<?php
							$cities_list = $database->getTableForHsp('cities', "country_id='IN'");
							foreach($cities_list as $row)
							{
								echo "<option value=\"".$row['id']."\">".$row['city_name']."</option>\n";
							}
							?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">DOB *:</label>
					<div class="col-xs-4">
						<div id="emp_dob_div">
							<input type="text" class="form-control input-sm dobdate" name="dobdate" id="dobdate" placeholder="yyyy-mm-dd" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">Height (cm):</label>
					<div class="col-xs-4">
						<input type="number" min="0" class="form-control" name="emp_height" id="emp_height">
					</div>
				</div>

				<p>&nbsp;</p>
				<div class="form-group">
					<label class="col-xs-3 control-label" style="padding-right: 0px;">&nbsp;</label>
					<div class="col-xs-9 inline">
						<input type="submit" class="btn btn-primary" value="Submit">
						<input type="reset" class="btn btn-warning" value="Reset">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					</div>
				</div>

				</form>
				<!-- #Add New Employee Form !-->
				</div>
				<div class="tab-pane fade" id="add_new_file_tab" style="overflow:hidden;">
				<p>&nbsp;</p>
				<div id="add_employee_file_block">
				<form action="<? echo HTTP_SERVER; ?>portal/employee/add-employee-file.php" name="add_employee_file" id="add_employee_file" method="post" class="form-horizontal" enctype="multipart/form-data">
				<input type="hidden" name="cluster_id" value="<?php echo $database->clusterId; ?>">
				<div class="col-sm-6">
					<div class="form-group">
						<div id="fileupload">
							<label class="filebutton"><i class="fa fa-upload"></i> Upload Employee Data *
								<input type="file" id="fileupload" name="fileupload" required accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
								<span class="help-block">Upload Only .xlsx</span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<a href="<? echo HTTP_SERVER; ?>portal/employee/bulkimport.xlsx" style="color: #0000CC;"><i class="fa fa-download"></i> Download Import Format</a>
				</div>
				<div class="col-sm-12">				
					<p>&nbsp;</p>				
					<div class="form-group">
						<div class="col-sm-3"></div>
						<div class="col-sm-9">
							<input type="submit" class="btn btn-primary" value="Submit">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
					</div>
				</div>				
				
				</form>
				</div>				
				</div>
				</div>
				<!-- #Tabs !-->
			</div>
		</div>
	</div>
</div>

<?php include_once('partials/footer.php'); ?>
<script>
$(function () {
	   $('.employee_menu').addClass('active');
});
</script>
<script src="dist/js/bootstrap-datepicker.min.js"></script>
<script src="dist/js/cluster.js"></script>
</body>
</html>
