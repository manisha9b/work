<?php
$arr_cluster	=	$database->getClusters($database->clusterId);

$cluster_business_name	= $arr_cluster[0]['cluster_business_name'];
$cluster_group			= $arr_cluster[0]['cluster_group'];
$business_email_id		= $arr_cluster[0]['business_email_id'];
$contact_mobile			= $arr_cluster[0]['contact_mobile'];
$contact_landline		= $arr_cluster[0]['contact_landline'];
$total_packages			= $arr_cluster[0]['total_packages'];
$logo					= $arr_cluster[0]['logo'];
$total_emp				= $arr_cluster[0]['total_emp'];

$hr_full_name			= $arr_cluster[0]['hr_full_name'];
$hr_email_id			= $arr_cluster[0]['hr_email_id'];
$hr_mobile_no			= $arr_cluster[0]['hr_mobile_no'];

$gender_arr = Array(
		0 => Array(
			'title' => 'Male',
			'value' => 'MMale'
		),
		1 => Array(
			'title' => 'Female',
			'value' => 'FFemale'
		),
	);

$arr_cluster_pack = $database->getclusterEbhPackage($database->clusterId);
?>
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
		<li>Access Employee Health Reports</li>
	</ul>
</div>

</div>

<?php
if(isset($_REQUEST['m']))
 {
	echo $database->show_alert($_REQUEST['m']);
 }
?>


<div class="panel">

<div class="panel-heading">
	<h4 class="panel-title text-primary">
	<i class="fa fa-files-o"></i> Employees Health Reports
	<span class="pull-right">
	<a href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/health_reports/download.php?claster_id=<?php echo $database->clusterId; ?>" class="btn btn-success btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;" id="excel_btn" data-filter-name="" data-filter-gender="" data-filter-bmi="" data-filter-package=""><i class="fa fa-download"></i> Download in Excel</a>
	</span>
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


<form name="" action="" method="post" class="form-horizontal">
<div class="row">
<div class="col-sm-4">

<div class="form-group">
	<label class="col-xs-3 control-label">Name:</label>
	<div class="col-xs-9">
		<input type="text" class="form-control input-sm" id="search_name" name="search_name" value="<?php echo $_POST['search_name']; ?>" placeholder="">
	</div>
</div>

</div>
<div class="col-sm-4">

<div class="form-group">
	<label class="col-xs-3 control-label">Gender:</label>
	<div class="col-xs-9">
		<select size="1" name="search_gender" id="search_gender" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
            foreach($gender_arr as $row)
            {
            	if($_POST['search_gender'] == $row)
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
<div class="col-sm-4">

<div class="form-group">
	<label class="col-xs-3 control-label">Package:</label>
	<div class="col-xs-9">
		<select size="1" name="search_package" id="search_package" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
            foreach($arr_cluster_pack as $row)
            {
            	if($_POST['search_package'] == $row['cluster_package_id'])
            	{
            		echo "<option value=\"".$row['package_nm']."\" selected>".$row['package_nm']."</option>\n";
            	}
            	else
            	{
            		echo "<option value=\"".$row['package_nm']."\">".$row['package_nm']."</option>\n";
            	}
            }
			?>
			<option value="">All</option>
		</select>
	</div>
</div>

</div>
</div>

<div class="row">
<div class="col-sm-4">

<div class="form-group">
	<label class="col-xs-3 control-label">BMI:</label>
	<div class="col-xs-9">
		<select size="1" name="search_bmi" id="search_bmi" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<option value="Normal">Normal</option>
			<option value="Overweight">Overweight</option>
			<option value="Underweight">Underweight</option>
			<option value="">All</option>
		</select>
	</div>
</div>

</div>
<div class="col-sm-4"></div>
<div class="col-sm-4 text-right">

<div class="form-group">
	<label class="col-xs-3 control-label">&nbsp;</label>
	<div class="col-xs-9">
		<!-- <button type="button" name="search_btn" id="search_btn" class="btn btn-success btn-sm">Search</button> !-->
		<a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=health_reports" class="btn btn-warning btn-sm" id="reset_btn" style="display: none">Reset</a>
	</div>
</div>

</div>
</div>
</form>

<br />
<div class="row">
<div class="col-xs-12">

<table class="table table-striped" id="reportsdatatables">
<thead>
<tr>
<th width="5%">#</th>
<th>Employee</th>
<th style="display: none;">Gender</th>
<th style="display: none;">BMI Category</th>
<th>Date of visit</th>
<th>Package</th>
<th>Health Report</th>
<th>Vital Information</th>
</tr>
</thead>
<tbody>
<?php
$arr_cluster_empl = $database->getclusterEbhPackageEmployee($database->clusterId);

foreach($arr_cluster_empl as $i => $row)
 {
	$package_name = $database->getclusterEbhPackage($database->clusterId,$row['cluster_package_id']);

	if(!empty($row['report_name']))
	{
		$employee_name = "".$row['salutation']." ".$row['first_name']." ".$row['last_name']."";
		$reports_list_arr = "<div class='media'>";
		$reports_name_list_arr = explode(',', $row['report_name']);
		$reports_pach_list_arr = explode(',', $row['report_path']);
		$emp_name_to_file_name = str_replace(' ', '_', $employee_name);
		$pach_list_to_file_name = str_replace('http://ebhconsole.easybuyhealth.com/portal/media/patient-report/', '', $row['report_path']);
		$pach_list_to_file_name = str_replace('http://app.easybuyhealth.com/portal/media/patient-report/', '', $pach_list_to_file_name);

		foreach($reports_name_list_arr as $key => $name)
		 {
		 	$reports_list_arr .= "<a href='".$reports_pach_list_arr[$key]."' target='_blank'><i class='fa fa-file-o'></i> ".$name."</a><hr style='margin-top:6px;margin-bottom:6px;'>";
		 }

		$reports_list_arr .= "<a href='".HTTP_SERVER."portal/media/patient-report/reports-zip.php?files=".$pach_list_to_file_name."&emp=".$emp_name_to_file_name."'>Download All</a><hr style='margin-top:6px;margin-bottom:6px;'></div>";
		$reports_list = '<div style="cursor: pointer;" data-toggle="popover" data-placement="left" data-content="'.$reports_list_arr.'" role="button" data-original-title="<a href=# class=pull-right data-dismiss=popover>&times</a> Health Reports&nbsp;&nbsp;&nbsp;">Reports <i class="fa fa-chevron-down"></i></div>';
	}
	else
	{
		$reports_list = "Not Available";
	}

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
	$vital_list = '<div style="cursor:pointer;width:100%" data-toggle="popover" data-placement="left" data-content="'.$vital_list_arr.'" role="button" data-original-title="<a href=# class=pull-right data-dismiss=popover>&times</a> Vital Information&nbsp;&nbsp;&nbsp;">Click Here</div>';

	$employee_list_data_arr = array("".$row['salutation']."".$row['first_name']." ".$row['last_name']."", $row['visited_on'], $package_name[0]['package_nm'], $reports_list, $vital_list);

	if($row['salutation'] == 'Mr.' or $row['salutation'] == 'Kumar.' or $row['salutation'] == 'Shri.')
	{
	echo "<tr>
	<td width=\"5%\">".($i+1)."</td>
	<td>".$row['employee_name']." ".$row['ebh_customer_id']."</td>
	<td style=\"display: none;\">MMale</td>
	<td style=\"display: none;\">".$row['bmi_category']."</td>
	<td>".$row['visited_on']."</td>
	<td>".$package_name[0]['package_nm']."</td>
	<td>".$reports_list."</td>
	<td>".$vital_list."</td>
	</tr>\n";
	}
	elseif($row['salutation'] == 'Ms.' or $row['salutation'] == 'Mrs.' or $row['salutation'] == 'Kumari.')
	{
	echo "<tr>
	<td width=\"5%\">".($i+1)."</td>
	<td>".$row['employee_name']." ".$row['ebh_customer_id']."</td>
	<td style=\"display: none;\">FFemale</td>
	<td style=\"display: none;\">".$row['bmi_category']."</td>
	<td>".$row['visited_on']."</td>
	<td>".$package_name[0]['package_nm']."</td>
	<td>".$reports_list."</td>
	<td>".$vital_list."</td>
	</tr>\n";
	}
    else
    {
    echo "<tr>
	<td width=\"5%\">".($i+1)."</td>
	<td>".$row['employee_name']." ".$row['ebh_customer_id']."</td>
	<td style=\"display: none;\"></td>
	<td style=\"display: none;\">".$row['bmi_category']."</td>
	<td>".$row['visited_on']."</td>
	<td>".$package_name[0]['package_nm']."</td>
	<td>".$reports_list."</td>
	<td>".$vital_list."</td>
	</tr>\n";
    }
 }

?>
</tbody>
</table>

</div>
</div>

</div>
</div>
</div>
</div>


