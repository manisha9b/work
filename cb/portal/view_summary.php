<?php
ini_set("display_errors", "1");
  error_reporting(E_ALL);
session_start();
include '../includes/define.php';
include '../classes/Class_Database.php';
global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');
$clusterId						=	$_SESSION['cluster_id'];
?>
<style>
.no-bottom-margin{ margin-bottom:0!important;}
</style>
<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>          
            <h4 class="modal-title">Summary</h4>
         </div>
 <div class="modal-body">
<?php
$_GET['id'] = 28;
if(isset($_GET['id']) && !empty($_GET['id']))
{
   
	$hsp_arr	=	$database->getEbhClusterPackageHSPDetails($_GET['id']);
	$test_arr	=	$database->getTestByPacckage($hsp_arr[0]['ebh_package_id']);
//	$emp_arr_emp_dob = date('Y-m-d', strtotime($emp_arr[0]['emp_dob']));
}
//echo "<pre>";
//print_R($hsp_arr);
//print_R($test_arr);
//echo "</pre>";
//print_R($test_arr);
?>
<table>
<tr><td style="width:150px;">Name of Package:</td>
	<td>
	<?php
	echo ($hsp_arr[0]['package_nm'] != '') ? $hsp_arr[0]['package_nm']." " : "  ";
	?>
	</td></tr>
<tr><td>Test Includes:</td>
	<td>
	    <?php 
	    $service_info_popover ='';
	    $n= 4;
	    $i=0;
foreach($test_arr  as $key=>$val)
			{
            //if($i==$n){
            //    $i=0;
                $service_info_popover .= '	<div class="col-xs-6">';
           // }
				$service_info_popover.= "<i class='fa fa-check text-success'></i> ".$val['test_name'];
				if($k<count($test_arr))
				{
				//	$service_info_popover.="<hr style='margin-top:2px;margin-bottom:2px;'>";
				}
				 $service_info_popover .= '	</div >';
			}
			echo $service_info_popover;
?></td></tr>
</table>
<p>&nbsp;</p>
<div class="form-group no-bottom-margin">
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
<!-- <div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px;">&nbsp;</label>
	<div class="col-xs-8 inline">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div> --> </div> 
 <div class="modal-footer">          <a href="#" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">Close</a>        </div>