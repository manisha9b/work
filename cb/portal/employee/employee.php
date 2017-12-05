<?php
$arr_cluster	=	$database->getClusters($database->clusterId);

$cluster_business_name	= $arr_cluster[0]['cluster_business_name'];
$cluster_group			= $arr_cluster[0]['cluster_group'];
$business_email_id		= $arr_cluster[0]['business_email_id'];
$contact_mobile			= $arr_cluster[0]['contact_mobile'];
$contact_landline		= $arr_cluster[0]['contact_landline'];
$total_packages			= $arr_cluster[0]['total_packages'];
$logo					= $arr_cluster[0]['logo'];
$total_emp				= (!empty($arr_cluster[0]['total_emp'])) ? $arr_cluster[0]['total_emp'] : "0";

$hr_full_name			= $arr_cluster[0]['hr_full_name'];
$hr_email_id			= $arr_cluster[0]['hr_email_id'];
$hr_mobile_no			= $arr_cluster[0]['hr_mobile_no'];

$arr_emp	=	$database->getClusterEmp($database->clusterId);
if(isset($_GET['emp_id']))
{
	$emp_arr	=	$database->getTableForHsp('tbl_cluster_employee', "cluster_id='".$database->clusterId."' AND emp_id='".$_GET['emp_id']."'");
}
else
{
	$emp_arr	=	NULL;
}

?>
<style>
.enrolled {
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 15px;
	margin-left: 0px;
	padding-top: 15px;
	padding-right: 0px;
	padding-bottom: 15px;
	padding-left: 10px;
}
.enrolled li {
	text-align: left;
	display: inline;
	padding-right: 15px;
	padding-bottom: 15px;
}
.as-badge {
    border-radius: 1em;
}
</style>
<div class="row profile">
<div class="col-md-3 user-details well text-center col-sm-12"  style="padding: 10px;background-color:#fff;  -webkit-box-shadow: 3px 3px 6px #C4C2C3;min-height:1080px;">
<?php
	include __DIR__."/../dashboard-menu.php";
?>
</div>

<div class="col-md-9">
<div class="row">
<div class="col-sm-12 text-primary text-left">
<?php
	include __DIR__."/../dashboard-header-text.php";
?>
</div>
</div>
<div class="row">
<div class="col-sm-12 text-primary text-left">
	<ul class="breadcrumb">
		<li><a href="<?php echo HTTP_SERVER;?>portal/cindex.php">Dashboard</a></li>
		<li>My Employees</li>
	</ul>
</div>
</div>
<p>&nbsp;</p>

<div style="overflow:hidden;display:inline-block;clear:both;width:auto;">
<p class="text-center"><strong class="pull-left">SUMMARY:</strong><strong>NUMBER ENROLLED PER PROGRAM</strong></p>
<div class="well well-sm bg-info text-white text-center" style="width:130px;height:127px;padding-top:7px;float:left;margin-right:15px;margin-bottom:15px;">
<h5 style="line-height: 20px;"><strong><?php echo $total_emp;?></strong><br /><br />EMPLOYEES <br /> ON-BOARDED</h5>
</div>
<?php
	unset($database->result);
	$abc = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','r','s','t','u','v','x','y','z');
	$sql="SELECT
	a.cluster_package_id,
	a.package_id,
	tcase(b.package_nm) as package_nm,
	c.total_enrolled
	from tbl_cluster_packages as a
	LEFT join tbl_ebh_pc_packages as b on a.package_id = b.ebh_package_id and a.package_type='EBH'
	left join
	(
		SELECT
		a.cluster_package_id , count(a.sr_no) as total_enrolled
		from tbl_cluster_employee_pack as a
		where a.cluster_id=".$database->clusterId."
		group by a.cluster_package_id
	) as c on a.cluster_package_id = c.cluster_package_id
	WHERE a.cluster_id=".$database->clusterId."";
	$database->select($sql);
	$enrolled_arr=$database->result;
	$bgi = 0;
	$rand_bgcolor = array('#90c657', '#54728c', '#f9a94a', '#e45857', '#428bca', '#999999', '#f0ad4e', '#90c657', '#54728c', '#f9a94a', '#e45857', '#428bca', '#999999', '#f0ad4e', '#90c657', '#54728c', '#f9a94a', '#e45857', '#428bca', '#999999', '#f0ad4e', '#90c657', '#54728c', '#f9a94a', '#e45857', '#428bca', '#999999', '#f0ad4e');
	foreach($enrolled_arr as $key => $row)
	{		
		//$bgi = array_rand($rand_bgcolor, 1);
		$bgi++;
		$total_enrolled = (!empty($row['total_enrolled'])) ? $row['total_enrolled'] : '0';
		echo "<div class=\"well well-sm text-center col-md-3\" style=\"width:130px; height:127px;padding-top:7px;float:left;margin-right:15px;margin-bottom:15px;background-color:".$rand_bgcolor[$bgi]."\">
		<h5 class=\"text-white\" style=\"line-height: 20px;\"><a href=\"#\" class=\"label bg-white text-primary as-badge\" onclick=\"openPkgModal(".$row['cluster_package_id']."); return false;\" title=\"".$row['package_nm']." ".$row['cluster_package_id']."\">".$total_enrolled."</a><br /><br />".$row['package_nm']."</h5>
		</div>\n";
	}
?>
</div>

<p>&nbsp;</p>

<div class="panel">

<div class="panel-heading">
	<h4 class="panel-title text-primary">
	<i class="fa fa-users"></i> My Employees
	<span class="pull-right"><button type="button"  style="font-size:12px;" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> ADD New Employee</button></span>
	</h4>
	<br />
</div>

<div class="panel-body">
<?php
if(isset($_REQUEST['m']))
 {
	echo $database->show_alert($_REQUEST['m']);
 }
?>
<!-- Modals !-->
<div class="modal fade" id="pkgModal" role="dialog">
	<div class="modal-dialog modal-lg" style="width: 850px;">
		<div class="modal-content" id="pkg_table">			
			<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>
		</div>
	</div>
</div>

<div class="modal fade" id="myErrModal" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div id="err_result" class="text-center">
					<p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p>
				</div>
			</div>
		</div>
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
				<form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/employee/add-employee.php" name="edit_employee_form" id="edit_employee_form" method="post" class="form-horizontal">
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
				<form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/employee/add-employee.php" name="add_employee_form" id="add_employee_form" method="post" class="form-horizontal">
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
				<div class="tab-pane fade" id="add_new_file_tab">
				<p>&nbsp;</p>
				<div id="add_employee_file_block">
				<form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/employee/add-employee-file.php" name="add_employee_file" id="add_employee_file" method="post" class="form-horizontal" enctype="multipart/form-data">
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
					<a href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/employee/bulkimport.xlsx" style="color: #0000CC;"><i class="fa fa-download"></i> Download Import Format</a>
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
<!-- #modals !-->

<?php
$gender_arr = Array(
		0 => Array(
			'title' => 'Male',
			'value' => 'EMPMale'
		),
		1 => Array(
			'title' => 'Female',
			'value' => 'EMPFemale'
		),
	);
?>
<!-- Filters !-->
<div id="advanced_search" style="padding:15px;border: solid 1px #CCC;display:none;">
<form name="search_emp_form" action="" method="post" class="form-horizontal" id="search_emp_form">
<div class="row">
<div class="col-sm-3" style="padding-right: 0px;">

<div class="form-group">
	<label class="col-xs-4 control-label">Gender:</label>
	<div class="col-xs-8">
		<select size="1" name="search_emp_gender" id="search_emp_gender" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
            foreach($gender_arr as $row)
            {
            	if($_POST['search_emp_gender'] == $row)
            	{
            		echo "<option value=\"".$row['value']."\" selected>".$row['title']."</option>\n";
            	}
            	else
            	{
            		echo "<option value=\"".$row['value']."\">".$row['title']."</option>\n";
            	}
            }
			?>
			<option value="">All</option>
		</select>
	</div>
</div>

</div>
<div class="col-sm-3" style="padding-right: 0px;">

<div class="form-group">
	<label class="col-xs-3 control-label">Name:</label>
	<div class="col-xs-9">
		<input type="text" class="form-control input-sm" id="search_name" name="search_name" value="<?php echo $_POST['search_name']; ?>" placeholder="">
	</div>
</div>

</div>
<div class="col-sm-3" style="padding-right: 0px;">

<div class="form-group">
	<label class="col-xs-3 control-label">Email:</label>
	<div class="col-xs-9">
		<input type="email" class="form-control input-sm" id="search_email" name="search_email" value="<?php echo $_POST['search_email']; ?>" placeholder="">
	</div>
</div>

</div>
<div class="col-sm-3" style="padding-right: 0px;">

<div class="form-group">
	<label class="col-xs-3 control-label">Mobile:</label>
	<div class="col-xs-9">
		<input type="text" class="form-control input-sm" id="search_mobile" name="search_mobile" pattern="[0-9]{10,12}" value="<?php echo $_POST['search_mobile']; ?>" placeholder="">
	</div>
</div>

</div>
</div>

<div class="row">
<div class="col-sm-3" style="padding-right: 0px;">

<div class="form-group">
	<label class="col-xs-4 control-label">Designation:</label>
	<div class="col-xs-8">
		<input type="text" class="form-control input-sm" id="search_designation" name="search_designation" value="<?php echo $_POST['search_designation']; ?>" placeholder="">
	</div>
</div>

</div>
<div class="col-sm-3" style="padding-right: 0px;">

<div class="form-group">
	<label class="col-xs-3 control-label">City:</label>
	<div class="col-xs-9">
		<select size="1" name="search_city" id="search_city" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
			$cities_list = $database->getTableForHsp('cities', "country_id='IN'");
			foreach($cities_list as $row)
			{
				echo "<option value=\"".$row['city_name']."\">".$row['city_name']."</option>\n";
			}
			?>
		</select>
	</div>
</div>

</div>
<div class="col-sm-3" style="padding-right: 0px;">

<!--
<div class="form-group">
	<label class="col-xs-3 control-label">Age:</label>
	<div class="col-xs-9">
		<select size="1" name="search_age" id="search_age" class="form-control input-sm">
			<option value="" hidden>Select</option>
		</select>
	</div>
</div>
-->

</div>
<div class="col-sm-3 text-right">

<div class="form-group">
	<label class="col-xs-3 control-label">&nbsp;</label>
	<div class="col-xs-9 text-right">
		<!-- <button type="button" name="search_btn" id="search_btn" class="btn btn-success btn-sm">Search</button> !-->
		<button type="button" name="reset_btn" id="reset_btn" style="display: none" class="btn btn-warning btn-sm">Reset</button>
		<!-- <a href="/portal/cindex.php?page=my_employees" class="btn btn-warning btn-sm" id="reset_btn" style="display: none">Reset</a> !-->
	</div>
</div>

</div>
</div>
</form>
</div>
<!-- #Filters !-->

<!-- Invitation !-->
<form name="invite_employee_form" id="invite_employee_form" action="<?php echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/invite.php" method="post" class="form-horizontal">
<div id="invitation_form" style="padding:15px;border: solid 1px #CCC;display:none;">
<input type="hidden" name="clusterpkg" value="empfromlist">
<input type="hidden" name="cluster_id" value="<?php echo $database->clusterId; ?>">

<div class="row">
<div class="col-sm-4" style="padding-right: 0px;">
<div class="form-group">
	<label class="col-sm-4 control-label">Bulk Action:</label>
	<div class="col-sm-8">
		<select size="1" name="invite_bulk_action" id="invite_bulk_action" class="form-control input-sm" required>
			<option value="invite">Invite</option>
		</select>
	</div>
</div>
</div>
<div class="col-sm-4" style="padding-right: 0px;">
<div class="form-group">
	<label class="col-xs-3 control-label">Package:</label>
	<div class="col-xs-9">
		<select size="1" name="invite_package" id="invite_package" class="form-control input-sm" required>
			<option value="" hidden>Select Package</option>
			<?
			foreach($enrolled_arr as $key => $row)
			{
				echo "<option value=\"".$row['cluster_package_id']."\">".$row['package_nm']."</option>\n";
			}
			?>
		</select>
	</div>
</div>
</div>
<div class="col-sm-4" style="padding-right: 0px;">
	<button type="submit" name="invite_btn" id="invite_btn" class="btn btn-info btn-sm">Invite Employee</button>
</div>
</div>
</div>
<!-- #Invitation !-->

<br />
<p class="text-right"><a href="#invitation_form" id="send_invitation">Send Invitation</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#advanced_search" id="search_form">Advanced Search</a></p>


<table class="table table-striped" <?php if(!empty($arr_emp)){ echo "id='reportsdatatables'";} ?>>
<thead>
    <tr>      
	  <th width="5%">#</th>
	  <th width="5%" class="empinv" style="display:none;"><input type="checkbox" name="select_all_emp" id="select_all_emp"></th>
	  <th>Name</th>
      <th>Designation</th>
	  <th>City</th>
      <th>Email</th>
      <th>Mobile</th>
	  <th style="display: none;">Gender</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
</thead>
<tbody>
<?php
if(!empty($arr_emp))
{
	foreach($arr_emp as $row)
	{
		//+91 9930-7110-84
		$mobile_no_code	= (!empty($row['mobile_no_code'])) ? $row['mobile_no_code'] : "+91";
		if(!empty($row['mobile_no']))
		{
			$mobile = substr($row['mobile_no'],-10,-6)."-".substr($row['mobile_no'],-6,-2)."-".substr($row['mobile_no'],-2);
		}
		$mobile_no	= (!empty($mobile)) ? $mobile_no_code." ".$mobile : "";
		
		echo'<tr>		
			<td>'.($i+1).'</td>
			<td class="empinv" style="display:none;"><input type="checkbox" name="empinv[]" value="'.$row['emp_id'].'"></td>
			<td>'.$row['emp_name'].'</td>
			<td>'.$row['emp_designation'].'</td>
			<td>'.$row['city_name'].'</td>
			<td>'.$row['professional_email_id'].'</td>
			<td>'.$mobile_no.'</td>
			<th style="display: none;">EMP'.$database->getGender($row['salutation']).'</th>
			<td><a href="#" onclick="openEditModal('.$row['emp_id'].'); return false;">Edit</a></td>
			<td><a href="#" onclick="openViewModal('.$row['emp_id'].'); return false;">View</a></td>
		</tr>';
		$i++;
	}
}
else
{

	echo'<tr>
		<td colspan="7"  class="text-center">No Employee found!!</td>
	</tr>';
	
}
?>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
