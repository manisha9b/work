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

$interval_arr = Array(
		0 => Array(
			'title' => 'Daily',
			'value' => 'Daily',
			'id'	=> 'daily'
		),
		1 => Array(
			'title' => 'Weekly',
			'value' => 'Weekly',
			'id'	=> 'weekday_select'
		),
		2 => Array(
			'title' => 'Monthly',
			'value' => 'Monthly',
			'id'	=> 'monthday_select'
		),
		3 => Array(
			'title' => 'Alternate date',
			'value' => 'Alternate date',
			'id'	=> 'alternate_date'
		),
);
$weekday_arr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
$monthday_arr = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31");
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
		<li>Schedule Reminder</li>
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
	<h4 class="panel-title text-primary"><i class="fa fa-calendar"></i> Schedule Reminder</h4>
</div>

<div class="panel-body">

<ul id="schTab" class="nav nav-tabs">
	<li class="active"><a href="#confirmation" data-toggle="tab">Confirmation Pending</a></li>
	<li><a href="#visit" data-toggle="tab">Visit Pending</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane fade in active" id="confirmation">
<!-- tab content !-->
<?php
$schedule_arr = $database->getClusterSchedule($_SESSION['cluster_id'], "schedule_type_id = 'confirmation'");
?>
<br />
<form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/schedule/schedule-action.php" name="schedule_confirmation_form" id="schedule_confirmation_form" method="post" class="form-horizontal">
<input name="cluster_id" type="hidden" value="<?php echo $database->clusterId; ?>">
<input name="schedule_type" type="hidden" value="Confirmation Pending">
<input name="schedule_type_id" type="hidden" value="confirmation">
<input name="schedule_id" type="hidden" value="<?php echo $schedule_arr[0]['schedule_id']; ?>">

<div class="form-group">
	<label class="col-xs-3 control-label">Interval *:</label>
	<div class="col-xs-3">
		<select size="1" name="sch_interval" id="sch_interval" class="form-control input-sm" required>
			<option value="" hidden>Select</option>
			<?php
            foreach($interval_arr as $row)
            {
            	if($schedule_arr[0]['sch_interval'] == $row['value'])
            	{
            		echo "<option value=\"".$row['value']."\" data-id=\"".$row['id']."\" selected>".$row['title']."</option>\n";
            	}
            	else
            	{            		
					echo "<option value=\"".$row['value']."\" data-id=\"".$row['id']."\">".$row['title']."</option>\n";
            	}
            }
			?>
		</select>
	</div>
</div>

<div class="form-group selection-block" id="weekday_select" <?php if(empty($schedule_arr[0]['sch_weekday'])){ echo "style=\"display: none;\""; } ?>>
	<label class="col-xs-3 control-label">Weekday *:</label>
	<div class="col-xs-3">
		<select size="1" name="sch_weekday" id="sch_weekday" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
            foreach($weekday_arr as $row)
            {
            	if($schedule_arr[0]['sch_weekday'] == $row)
            	{
            		echo "<option value=\"".$row."\" selected>".$row."</option>";
            	}
            	else
            	{
            		echo "<option value=\"".$row."\">".$row."</option>";
            	}
            }
			?>
		</select>
	</div>
</div>

<div class="form-group selection-block" id="monthday_select" <?php if(empty($schedule_arr[0]['sch_monthday'])){ echo "style=\"display: none;\""; } ?> >
	<label class="col-xs-3 control-label">Day of Month *:</label>
	<div class="col-xs-3">
		<select size="1" name="sch_monthday" id="sch_monthday" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
            foreach($monthday_arr as $row)
            {
            	if($schedule_arr[0]['sch_monthday'] == $row)
            	{
            		echo "<option value=\"".$row."\" selected>".$row."</option>";
            	}
            	else
            	{
            		echo "<option value=\"".$row."\">".$row."</option>";
            	}
            }
			?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">Time to Send Reminder:</label>
	<div class="col-xs-3">
		<input type="text" class="form-control input-sm bootstrap-timepicker timepicker" id="sch_time" name="sch_time" value="<?php echo $schedule_arr[0]['sch_time']; ?>" placeholder="hh:mm">
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">Content (Email):</label>
	<div class="col-xs-6">
		<div data-provide="markdown-editable"></div>
		<textarea name="sch_email_content" id="sch_email_content" class="form-control textarea" rows="10"><?php echo $schedule_arr[0]['sch_email_content']; ?></textarea>
		<p class="text-muted help-inline">Placeholders: {cluster_name}, {employee_name}, {package_name}, {provider_name}, {provider_address}, {provider_contact_info}</p>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">Content (SMS):</label>
	<div class="col-xs-6">
		<textarea name="sch_sms_content" id="sch_sms_content" class="form-control input-sm" rows="5"><?php echo $schedule_arr[0]['sch_sms_content']; ?></textarea>
		<p class="text-muted help-inline">Placeholders: {cluster_name}, {employee_name}, {package_name}, {provider_name}, {provider_address}, {provider_contact_info}</p>
		<p class="text-muted help-inline">Note: <i>Submit your SMS template to EBH Support Team to get the Approval from TRAI</i></p>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">&nbsp;</label>
	<div class="col-xs-6">
		<input type="submit" class="btn btn-success" value="Submit">
	</div>
</div>

</form>
<!-- #tab content !-->
</div>
<div class="tab-pane fade" id="visit">
<!-- tab content !-->
<?php
$schedule_arr = $database->getClusterSchedule($_SESSION['cluster_id'], "schedule_type_id = 'visit'");
?>
<br />
<form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/schedule/schedule-action.php" name="schedule_visit_form" id="schedule_visit_form" method="post" class="form-horizontal">
<input name="cluster_id" type="hidden" value="<?php echo $database->clusterId; ?>">
<input name="schedule_type" type="hidden" value="Visit Pending">
<input name="schedule_type_id" type="hidden" value="visit">
<input name="schedule_id" type="hidden" value="<?php echo $schedule_arr[0]['schedule_id']; ?>">

<div class="form-group">
	<label class="col-xs-3 control-label">Interval *:</label>
	<div class="col-xs-3">
		<select size="1" name="sch_interval" id="vsch_interval" class="form-control input-sm" required>
			<option value="" hidden>Select</option>
			<?php
            foreach($interval_arr as $row)
            {
            	if($schedule_arr[0]['sch_interval'] == $row['value'])
            	{
            		echo "<option value=\"".$row['value']."\" data-id=\"".$row['id']."\" selected>".$row['title']."</option>\n";
            	}
            	else
            	{
            		echo "<option value=\"".$row['value']."\" data-id=\"".$row['id']."\">".$row['title']."</option>\n";
            	}
            }
			?>
		</select>
	</div>
</div>

<div class="form-group selection-block" id="vweekday_select" <?php if(empty($schedule_arr[0]['sch_weekday'])){ echo "style=\"display: none;\""; } ?>>
	<label class="col-xs-3 control-label">Weekday *:</label>
	<div class="col-xs-3">
		<select size="1" name="sch_weekday" id="sch_weekday" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
            foreach($weekday_arr as $row)
            {
            	if($schedule_arr[0]['sch_weekday'] == $row)
            	{
            		echo "<option value=\"".$row."\" selected>".$row."</option>";
            	}
            	else
            	{
            		echo "<option value=\"".$row."\">".$row."</option>";
            	}
            }
			?>
		</select>
	</div>
</div>

<div class="form-group selection-block" id="vmonthday_select" <?php if(empty($schedule_arr[0]['sch_monthday'])){ echo "style=\"display: none;\""; } ?> >
	<label class="col-xs-3 control-label">Day of Month *:</label>
	<div class="col-xs-3">
		<select size="1" name="sch_monthday" id="sch_monthday" class="form-control input-sm">
			<option value="" hidden>Select</option>
			<?php
            foreach($monthday_arr as $row)
            {
            	if($schedule_arr[0]['sch_monthday'] == $row)
            	{
            		echo "<option value=\"".$row."\" selected>".$row."</option>";
            	}
            	else
            	{
            		echo "<option value=\"".$row."\">".$row."</option>";
            	}
            }
			?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">Time to Send Reminder:</label>
	<div class="col-xs-3">
		<input type="text" class="form-control input-sm bootstrap-timepicker timepicker" id="vsch_time" name="sch_time" value="<?php echo $schedule_arr[0]['sch_time']; ?>" placeholder="hh:mm">
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">Content (Email):</label>
	<div class="col-xs-6">
		<div data-provide="markdown-editable"></div>
		<textarea name="sch_email_content" id="sch_email_content" class="form-control textarea" rows="10"><?php echo $schedule_arr[0]['sch_email_content']; ?></textarea>
		<p class="text-muted help-inline">Placeholders: {cluster_name}, {employee_name}, {package_name}, {provider_name}, {provider_address}, {provider_contact_info}</p>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">Content (SMS):</label>
	<div class="col-xs-6">
		<textarea name="sch_sms_content" id="sch_sms_content" class="form-control input-sm" rows="5"><?php echo $schedule_arr[0]['sch_sms_content']; ?></textarea>
		<p class="text-muted help-inline">Placeholders: {cluster_name}, {employee_name}, {package_name}, {provider_name}, {provider_address}, {provider_contact_info}</p>
		<p class="text-muted help-inline">Note: <i>Submit your SMS template to EBH Support Team to get the Approval from TRAI</i></p>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label">&nbsp;</label>
	<div class="col-xs-6">
		<input type="submit" class="btn btn-success" value="Submit">
	</div>
</div>

</form>
<!-- #tab content !-->
</div>
</div>

</div>
</div>
</div>
</div>


