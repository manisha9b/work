<?php
ob_start();
session_start();
include __DIR__.'/../../../../includes/define.php';
include __DIR__.'/../../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(!empty($_GET['id']))
{
	unset($database->result);
	$sql="SELECT
	a.emp_id,
	b.salutation, b.first_name, b.middle_name, b.last_name,
	b.emp_designation, b.professional_email_id, b.mobile_no_code, b.mobile_no,
	c.city_name,
	e.package_nm
	FROM tbl_cluster_employee_pack AS a
	LEFT JOIN tbl_cluster_employee AS b ON b.emp_id=a.emp_id
	LEFT JOIN cities AS c ON c.id = b.city
	LEFT JOIN tbl_cluster_packages AS d ON d.cluster_package_id=a.cluster_package_id
	LEFT JOIN tbl_ebh_pc_packages AS e ON e.ebh_package_id=d.package_id
	WHERE a.cluster_id='".$database->clusterId."' AND a.cluster_package_id='".$_GET['id']."'";
	$database->select($sql);
	$pkg_arr=$database->result;

?>
<div class="modal-header">			
	<button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title"><?php echo $pkg_arr[0]['package_nm']; ?></h4>
</div>
<div class="modal-body">
	<div id="err_result">
		<table class="table table-striped">
			<thead>
				<tr>      
					<th width="5%">#</th>
					<th>Name</th>
					<th>Designation</th>
					<th>City</th>
					<th>Email</th>
					<th>Mobile</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$i=1;
			foreach($pkg_arr as $row)
			{
				
				$mobile_no_code	= (!empty($row['mobile_no_code'])) ? $row['mobile_no_code'] : "+91";
				if(!empty($row['mobile_no']))
				{
					$mobile = substr($row['mobile_no'],-10,-6)."-".substr($row['mobile_no'],-6,-2)."-".substr($row['mobile_no'],-2);
				}
				$mobile_no	= (!empty($mobile)) ? $mobile_no_code." ".$mobile : "";
				
				echo "<tr> 
					<td>".$i++."</td>
					<td>".$row['salutation']."".$row['first_name']." ".$row['last_name']."</td>
					<td>".$row['emp_designation']."</td>
					<td>".$row['city_name']."</td>
					<td>".$row['professional_email_id']."</td>
					<td>".$mobile_no."</td>
				</tr>";
			}
			?>
			</tbody>
		</table>                       
	</div>
</div>
<?php
}
?>