<?php
ob_start();
session_start();
include __DIR__.'/../../../../includes/define.php';
include __DIR__.'/../../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(isset($_GET['id']) && !empty($_GET['id']))
{
	$emp_arr	=	$database->getTableForHsp('tbl_cluster_employee', "emp_id='".$_GET['id']."'");
	$emp_arr_emp_dob = date('Y-m-d', strtotime($emp_arr[0]['emp_dob']));
}

if(isset($_GET['method']) && $_GET['method']=='edit')
{
?>
<script>
$(document).ready(function(){
	$("#edt_weight").keyup(function(){
		var edt_h  = $('#edt_height').val();
		var edt_w  = $('#edt_weight').val();
		var edt_hn = (edt_h / 100);
		var edt_bmi = (edt_w / edt_hn / edt_hn);
		var edt_bmi_n = edt_bmi.toFixed(1);
		$('#edt_bmi').val(edt_bmi_n);
	});

	$("#edt_height").keyup(function(){
		var edt_h  = $('#edt_height').val();
		var edt_w  = $('#edt_weight').val();
		var edt_hn = (edt_h / 100);
		var edt_bmi = (edt_w / edt_hn / edt_hn);
		var edt_bmi_n = edt_bmi.toFixed(1);
		$('#edt_bmi').val(edt_bmi_n);
	});

	$('#editdobdate').datepicker({
		dateFormat: "yy-mm-dd",
		maxDate: 'useCurrent',
	});
	
	$('.dobdate').datepicker({
		format: "yyyy-mm-dd",
		startDate: "1900-01-01",
		endDate: 'useCurrent',
		autoclose: true
	});
	$('[data-type="dobdate"]').mask("9999-99-99");
	$('[data-type="phone"]').mask('9999999999');
});
</script>
<input name="emp_id" type="hidden" value="<?php echo $emp_arr[0]['emp_id']; ?>">
<strong>Personal Information</strong>
<hr>
<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Name:</label>
	<div class="col-xs-9">
		<div class="row">
			<div class="col-xs-3">
				<select size="1" name="emp_dr" class="form-control input-sm">
					<option value="" selected="">Select *</option>
					<?php
								$dr_title=Array(
							    	0 => Array(
							        	'title' => 'Mr.',
								        'value' => 'Mr.'
							    	),
								    1 => Array(
							    	    'title' => 'Mrs.',
							        	'value' => 'Mrs.'
								    ),
								    2 => Array(
								        'title' => 'Ms.',
								        'value' => 'Ms.'
								    ),
								);

								foreach($dr_title as $dr_list)
								{
								if($emp_arr[0]['salutation']==$dr_list['value'])
								 {
									echo"<option value=\"".$dr_list['value']."\" selected>".$dr_list['title']."</option>\n";
								 }
								else
								 {
									echo"<option value=\"".$dr_list['value']."\">".$dr_list['title']."</option>\n";
								 }
								}
					?>
				</select>
			</div>
			<div class="col-xs-3" style="padding-left: 0px;"><input type="text" class="form-control input-sm" id="emp_first_name" name="emp_first_name" placeholder="First name *" pattern="[A-Za-z\s]{1,}" required value="<?php echo $emp_arr[0]['first_name']; ?>" /></div>
			<div class="col-xs-3" style="padding-left: 0px;"><input type="text" class="form-control input-sm" name="emp_middle_name" id="emp_middle_name" placeholder="Middle name" pattern="[A-Za-z\s]{1,}" value="<?php echo $emp_arr[0]['middle_name']; ?>" /></div>
			<div class="col-xs-3" style="padding-left: 0px;"><input type="text" class="form-control input-sm" name="emp_last_name" id="emp_last_name" placeholder="Last name *" pattern="[A-Za-z\s]{1,}" required value="<?php echo $emp_arr[0]['last_name']; ?>" /></div>
		</div>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Professional Email *:</label>
	<div class="col-xs-9">
		<input type="email" class="form-control" id ="pro_email_id" name="pro_email_id" required value="<?php echo $emp_arr[0]['professional_email_id']; ?>" />
		<span id="email_msg" class="text-danger hidden"></span>
		
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Personal Email:</label>
	<div class="col-xs-9">
		<input type="email" class="form-control" name="per_email_id" id="per_email_id" value="<?php echo $emp_arr[0]['personal_email_id']; ?>" />
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Designation:</label>
	<div class="col-xs-9">
		<input type="text" class="form-control" name="designation" id="designation" value="<?php echo $emp_arr[0]['emp_designation']; ?>">
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Mobile No *:</label>
	<div class="col-xs-4">
		<input type="text" class="form-control" name="mobile_no" id="mobile_no" data-type="phone" value="<?php echo $emp_arr[0]['mobile_no']; ?>" required>
		<span id="phone_msg" class="text-danger hidden"></span>
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
										if($emp_arr[0]['city']==$row['id'])
										{
											echo "<option value=\"".$row['id']."\" selected>".$row['city_name']."</option>\n";
										}
										else
										{
											echo "<option value=\"".$row['id']."\">".$row['city_name']."</option>\n";
										}
									}
								?>
		</select>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">DOB:</label>
	<div class="col-xs-4">
		<div id="emp_dob_div">
			<input type="text" class="form-control input-sm dobdate" name="dobdate" id="dobdate" data-type="dobdate" placeholder="yyyy-mm-dd" value="<?php echo $emp_arr_emp_dob;?>" required>
		</div>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Height (cm):</label>
	<div class="col-xs-4">
		<input type="number" min="0" class="form-control" name="emp_height" id="emp_height" value="<?php echo $emp_arr[0]['emp_height']; ?>">
	</div>
</div>

<p>&nbsp;</p>
<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">&nbsp;</label>
	<div class="col-xs-9 inline">
		<input type="submit" class="btn btn-primary" value ="Submit">
		<input type="reset" class="btn btn-warning" value="Reset">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	</div>
</div>
<?php
}
elseif($_GET['method']=='view')
{
?>
<strong>Personal Information</strong>
<hr>
<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">Name:</label>
	<div class="col-xs-8">
	<?php
	echo ($emp_arr[0]['salutation'] != '') ? $emp_arr[0]['salutation']." " : "  ";
	echo ($emp_arr[0]['first_name'] != '') ? ucfirst(strtolower($emp_arr[0]['first_name']))." " : "  ";
	echo ($emp_arr[0]['middle_name'] != '') ? ucfirst(strtolower($emp_arr[0]['middle_name']))." " : "  ";
	echo ($emp_arr[0]['last_name'] != '') ? ucfirst(strtolower($emp_arr[0]['last_name']))." " : "  ";
	?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">Professional Email:</label>
	<div class="col-xs-8">
		<?php echo ($emp_arr[0]['professional_email_id'] != '') ? $emp_arr[0]['professional_email_id'] : "-"; ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">Personal Email:</label>
	<div class="col-xs-8">
		<?php echo ($emp_arr[0]['personal_email_id'] != '') ? $emp_arr[0]['personal_email_id'] : "-"; ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">Designation:</label>
	<div class="col-xs-8">
		<?php echo ($emp_arr[0]['emp_designation'] != '') ? $emp_arr[0]['emp_designation'] : "-"; ?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">Mobile No:</label>
	<div class="col-xs-8">
	<?php
	//+91 9930-7110-84
	$mobile_no_code	= (!empty($emp_arr[0]['mobile_no_code'])) ? $emp_arr[0]['mobile_no_code'] : "+91";
	if(!empty($emp_arr[0]['mobile_no']))
	{
		$mobile = substr($emp_arr[0]['mobile_no'],-10,-6)."-".substr($emp_arr[0]['mobile_no'],-6,-2)."-".substr($emp_arr[0]['mobile_no'],-2);
	}
	echo (!empty($mobile)) ? $mobile_no_code." ".$mobile : "-";
	?>		
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">City:</label>
	<div class="col-xs-8">
		<?php
		$city = $database->getTableForHsp('cities', "id='".$emp_arr[0]['city']."'");
		echo ($city[0]['city_name'] != '') ? $city[0]['city_name'] : "-";
		?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">Age (yrs):</label>
	<div class="col-xs-8 tooltips inline">
		<?php			
			$age = (date('Y-m-d') - $emp_arr[0]['emp_dob']);
			echo (!empty($emp_arr[0]['emp_dob'])) ? $age : "-"; 
		?>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px; padding-top: 0px;">Height (cm):</label>
	<div class="col-xs-8 tooltips inline">
		<?php echo ($emp_arr[0]['emp_height'] != '') ? $emp_arr[0]['emp_height'] : "-"; ?>
	</div>
</div>
<p>&nbsp;</p>
<div class="form-group">
	<div class="col-xs-12">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th width="32%">Package Name</th>
				<th width="32%">Appointment Date</th>
				<th width="31%">Provider Name</th>
			</tr>
		</thead>
		<tbody>
<?php
unset($database->result);
$sql="SELECT
concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
tcase(c.package_nm) as package_nm,
tcase(d.name) as `name`
FROM tbl_cluster_employee AS a
LEFT JOIN tbl_cluster_employee_pack as f on a.emp_id = f.emp_id 
LEFT JOIN tbl_appointments AS b ON b.ebh_customer_id = a.ebh_customer_id
LEFT JOIN tbl_cluster_packages AS e ON f.cluster_package_id = e.cluster_package_id
LEFT JOIN tbl_ebh_pc_packages AS c ON e.package_id = c.ebh_package_id
LEFT JOIN tbl_hsps AS d ON d.id = e.hsp_id
WHERE a.emp_id = '".$emp_arr[0]['emp_id']."'
group by b.appointment_id
";
$database->select($sql);
$emp_data_arr = $database->result;
foreach($emp_data_arr as $i => $row)
{
	$appointment_date = (!empty($row['appointment_date'])) ? date('d-M-Y h:i A', strtotime($row['appointment_date'])) : '';
	
	echo"<tr>
		<td>".($i+1)."</td>
		<td>".$row['package_nm']."</td>
		<td>".$appointment_date."</td>
		<td>".$row['name']."</td>
	</tr>\n";
}
?>	
		</tbody>
	</table>
	</div>
</div>


<p>&nbsp;</p>
<div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px;">&nbsp;</label>
	<div class="col-xs-8 inline">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div>
<?php
}
?>
