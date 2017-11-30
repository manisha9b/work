<?php
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

<!-- Trigger the modal with a button -->
<br />
<p align="right"><button type="button"  style="font-size:12px;" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> ADD New Employee</button></p>

<?php if(isset($_REQUEST['m'])) {echo $database->show_alert($_REQUEST['m']); }?>

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
				<form action="/portal/modules/cluster-dashboard/add-employee.php" name="edit_employee_form" id="edit_employee_form" method="post" class="form-horizontal">
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
				<form action="/portal/modules/cluster-dashboard/add-employee.php" name="add_employee_form" id="add_employee_form" method="post" class="form-horizontal">

<strong>Personal Information</strong>
<hr>
<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Name:</label>
	<div class="col-xs-9">
		<div class="row">
			<div class="col-xs-3">
				<select size="1" name="emp_dr" class="form-control input-sm">
					<option value="" hidden>Select</option>
					<option value="Ms.">Ms.</option>
					<option value="Mr.">Mr.</option>
					<option value="Mrs.">Mrs.</option>
					<option value="Shri.">Shri.</option>
					<option value="Prof.">Prof.</option>
					<option value="Rev.">Rev.</option>
					<option value="Kumar.">Kumar.</option>
					<option value="Kumari.">Kumari.</option>
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
		<input type="email" class="form-control" id ="pro_email_id" name="pro_email_id" required onblur="checkEmail(this);">
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
		<input type="text" class="form-control" name="designation" id="designation" pattern="[A-Za-z\s]{1,}">
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Phone:</label>
	<div class="col-xs-4">
		<input type="text" class="form-control" name="mobile_no" id="mobile_no" pattern="[0-9]{10,12}">
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
	<label class="col-xs-3 control-label" style="padding-right: 0px;">DOB:</label>
	<div class="col-xs-4">
		<input type="text" class="form-control input-sm" name="txtstartdate" id="newdobdate" placeholder="yy-mm-dd" readonly>
	</div>
</div>
<p>&nbsp;</p>

<strong>Vital Information</strong>
<hr>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">Height (cm):</label>
	<div class="col-xs-9">
			<div class="row">
			<div class="col-xs-5" style="padding-right: 0px;">
				<input type="number" min="0" class="form-control input-sm" id="emp_height" name="emp_height" placeholder="in centimeters">
			</div>
			<div class="col-xs-3" style="padding-right: 0px;">
				<label class="control-label">Weight (kgs):</label>
			</div>
			<div class="col-xs-4" style="padding-left: 0px;">
				<input type="number" min="0" class="form-control input-sm" id="emp_weight" name="emp_weight" placeholder="in kilograms">
			</div>
			</div>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">BMI :</label>
	<div class="col-xs-4 tooltips inline">
		<input type="number" min="0" class="form-control input-sm" id="emp_bmi" name="emp_bmi" placeholder="" readonly>
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">R.B.S :</label>
	<div class="col-xs-4 tooltips inline">
		<input type="text" class="form-control input-sm" id="emp_rbs" name="emp_rbs" placeholder="in mg/dl">
	</div>
</div>

<div class="form-group">
	<label class="col-xs-3 control-label" style="padding-right: 0px;">BP :</label>
	<div class="col-xs-4 tooltips inline">
		<input type="text" class="form-control input-sm" id="emp_bp" name="emp_bp" placeholder="in mmHg">
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

				</form>
			</div>
		</div>
	</div>
</div>

<table class="table table-striped" style="margin:10px;" <?php if(count($arr_emp)>0){?> id="tabledata" <?php }?>>
  <thead>
    <tr>
      <th width="5%">#</th>
	  <th>Name</th>
      <th>Designation</th>
	  <th>City</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>&nbsp;</th>
      <th>&nbsp;</th>
    </tr>
  </thead>
  <tbody>
<?php
for($i=0;$i<count($arr_emp);$i++)
{
?>
 <tr>
		<td class="text-center"><?php echo ($i+1)?></td>
		<td><?php echo $arr_emp[$i]['emp_name'];?></td>
		<td><?php echo $arr_emp[$i]['emp_designation'];?></td>
		<td><?php echo $arr_emp[$i]['city_name'];?></td>
		<td><?php echo $arr_emp[$i]['professional_email_id']; ?></td>
		<td><?php echo $arr_emp[$i]['mobile_no'];?></td>
		<td><a href="#" onclick="openEditModal(<?php echo $arr_emp[$i]['emp_id'];?>)">Edit</a></td>
		<td><a href="#" onclick="openViewModal(<?php echo $arr_emp[$i]['emp_id'];?>)">View</a></td>
</tr>
<?php
}
if(count($arr_emp)==0)
	{
	?>
		<tr>
			<td colspan="7" class="text-center">No Employee found!!</td>
		</tr>
	<?php
	}
	?>

</tbody>
</table>
