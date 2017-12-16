<?php 

if(isset($_GET['package_id']))
 {
	session_start();
	include_once('includes/define.php');
	include_once('classes/Class_Database.php'); 
	global $database;
	$database=new Database();
	$database->connect();
	date_default_timezone_set('Asia/Calcutta'); 
//print_r($_SESSION);die;
	if(!isset($_SESSION['ref_id']) || !isset($_SESSION['cluster_type']) || !isset($_SESSION['user_id']) || $_SESSION['cluster_type']=='' || $_SESSION['user_id']=='')
	{
		header("Location: ".HTTP_SERVER);
	}
	else
	{
		$user_id						=	$_SESSION['ref_id'];
		$user_group_id					=	$_SESSION['user_group_id'];	
		$clusterId						=	$_SESSION['cluster_id'];
		//$arr_cluster	=	$database->getClusters($clusterId);	
		//$arr_cluster	=	$arr_cluster[0];	
	}

	$arr_ebh_pack	=	$database->getclusterEbhPackage($clusterId, $_GET['package_id']);
 }
else
 {
	$arr_ebh_pack	=	$database->getclusterEbhPackage($clusterId);
 }
$package_nm			= $arr_ebh_pack[0]['package_nm'];
$cluster_package_id	= $arr_ebh_pack[0]['cluster_package_id'];
$hsp_name			= $arr_ebh_pack[0]['hsp_name'];

$package_unit		= $arr_ebh_pack[0]['package_unit'];

$price_per_unit		= $arr_ebh_pack[0]['price_per_unit'];
$total_price		= $arr_ebh_pack[0]['total_price'];
$created_on			= $arr_ebh_pack[0]['created_on'];
$total_invited		= $arr_ebh_pack[0]['total_invited'];

$about_package		= $arr_ebh_pack[0]['about_package'];
$lab_test_id_arr	= $arr_ebh_pack[0]['lab_test_id_arr'];

$lab_test_name_arr	= $arr_ebh_pack[0]['lab_test_name_arr'];
$age_group_arr		= $arr_ebh_pack[0]['age_group_arr'];
$nature_of_work_arr	= $arr_ebh_pack[0]['nature_of_work_arr'];

$hsp_logo			= $arr_ebh_pack[0]['hsp_logo'];

$invited_per		=	($total_invited*100)/$package_unit;
$appt_confirmed=0;
$visited=0;
$appt_confirmed		= $arr_ebh_pack[0]['appt_confirmed'];
$visited			= $arr_ebh_pack[0]['visited'];

$confirmed_per		= ($appt_confirmed*100)/$total_invited;
$visited_per		= ($visited*100)/$appt_confirmed;

 if(!empty($cluster_package_id))
{
?>
<style>
    .progress{
        background-color:#f5f5f5!important;
    }
</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<td width="100%">

	<div class="list-group list-projects" style="margin-top:5px;margin-bottom:5px;margin:10px;padding:10px;">
		<div class="row" style="padding-top:5px;">
		<center>
			<div class="col-md-4">
				<span class="help-block"> <?php echo ($total_invited>0)?$total_invited." / ".$package_unit." Employee(s) Invited":"No Invitation sent";?> </span>
				<div class="progress" style="height:10px; margin-left:10%;width:80%;margin-bottom:8px;">
				 <div class="progress-bar three-sec-ease-in-out progress-bar-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="<?php echo $package_unit;?>" style="width: <?php echo $invited_per;?>%;"></div>
			   </div>
			</div>
			<div class="col-md-4">
				<span class="help-block"> <?php echo ($appt_confirmed>0)?$appt_confirmed." / ".$total_invited." Appointment(s) Booked":"No Bookings";?> </span>
				<div class="progress" style="height:10px; margin-left:10%;width:80%;margin-bottom:8px;">
				 <div class="progress-bar three-sec-ease-in-out progress-bar-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="<?php echo $total_invited;?>" style="width: <?php echo $confirmed_per;?>%;"></div>
			   </div>
			</div>
			<div class="col-md-4">
				<span class="help-block"> <?php echo ($visited>0)?$visited." / ".$appt_confirmed." Completed Appointment(s)  ":"No Utilization";?> </span>
				<div class="progress" style="height:10px; margin-left:10%;width:80%;margin-bottom:8px;">
				 <div class="progress-bar three-sec-ease-in-out progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="<?php echo $appt_confirmed;?>" style="width: <?php echo $visited_per;?>%;"></div>
			   </div>
			</div></center>
		</div>
	</div>

</td>
</tr>
</table>
<?php
}
if(!empty($arr_ebh_pack[0]['cluster_package_id']))
{
	unset($database->result);
	$sql="SELECT
	a.cluster_package_id,
	(SELECT count(e.emp_id) from tbl_cluster_employee_pack as e where e.cluster_id=".$clusterId.") as total_emp,
	(SELECT count(z.emp_id) from tbl_cluster_employee_pack as z where z.cluster_id=".$clusterId." and z.is_confirmed=1) as total_emp_confirmed,
	c.package_nm,
	count(a.emp_id) as total_invites,
	((count(a.emp_id)*100)/(SELECT count(x.emp_id) from tbl_cluster_employee_pack as x where x.cluster_id=".$clusterId.") ) as offered_per,
	sum(if(a.is_confirmed=1,1,0)) as total_confirmed,
	((sum(if(a.is_confirmed=1,1,0))*100)/(SELECT count(x.emp_id) from tbl_cluster_employee_pack as x where x.cluster_id=".$clusterId." and x.is_confirmed=1)) as booked_appointment_per,
	sum(if(d.appt_status<>'New',1,0)) as total_visited,
	((sum(if(d.appt_status<>'New',1,0))*100)/(SELECT count(y.appointment_id) from tbl_cluster_employee_pack as x LEFT JOIN tbl_appointments as y on x.appointment_id = y. appointment_id where x.cluster_id=".$clusterId." and y.appt_status<>'New')) as converted_per
	from tbl_cluster_employee_pack as a
	left join tbl_cluster_packages as b on a.cluster_package_id = b.cluster_package_id
	left join tbl_ebh_pc_packages as c on b.package_id = c.ebh_package_id
	left join tbl_appointments as d on a.appointment_id = d.appointment_id
	where a.cluster_id=".$clusterId." and a.cluster_package_id=".$arr_ebh_pack[0]['cluster_package_id']."
	GROUP BY a.cluster_package_id";
	$database->select($sql);
	$po_char_arr=$database->result;
	//echo "<pre>";
//print_R($po_char_arr);
	//echo "</pre>";
}
if(!empty($po_char_arr))
{
?>
  <div class="col-md-4">
              <div class="chart">
			  <?php
if($po_char_arr[0]['total_invites'] != 0)
{	
	$com_per = (($po_char_arr[0]['total_invites']*100)/$package_unit);
	$com_per = round($com_per, 1);
	$pending_per = 100- $com_per ;
?>
                <canvas id="chart-area1" style="height:230px"></canvas>
				<strong style="text-align:center;display:block;padding:5px;">
				
				<?php echo $com_per ?>% of Invitations Sent</strong>
<?php }else
{
	echo"<p align=\"center\">No data to display</p>";
} ?>
              </div>
              </div>
               <div class="col-md-4">
				  <div class="chart">
				  <?php
if($po_char_arr[0]['total_confirmed'] != 0)
{	
	$inv_per = (($po_char_arr[0]['total_confirmed']*100)/$po_char_arr[0]['total_invites']);
?>
					<canvas id="chart-area2" style="height:230px"></canvas>
					<strong style="text-align:center;display:block;padding:7px;"><?php echo round($inv_per, 1) ?>% of Invited Employees<br />Booked the Appointment</strong>
<?php 
}
else
{
	echo"<p align=\"center\">No data to display</p>";
}
?>
				  </div>
              </div>
			   <div class="col-md-4">
				  <div class="chart">
				  <?php
if($po_char_arr[0]['total_visited'] != 0)
{	
	//$total_appt = ($po_char_arr[0]['total_visited'] * 100 / $po_char_arr[0]['converted_per']);
	$total_appt = ($po_char_arr[0]['total_visited'] * 100 / $appt_confirmed);
	$total_appt_notvisited = ($total_appt - $po_char_arr[0]['total_visited']);
	$vis_per = (($po_char_arr[0]['total_visited']*100)/$appt_confirmed);

?>
					<canvas id="chart-area3" style="height:230px"></canvas>
					<strong style="text-align:center;display:block;padding:7px;"><?php echo round($vis_per, 1) ?>% of Booked Appointments<br>were Completed</strong>
<?php 
}
else
{
	echo"<p align=\"center\">No data to display</p>";
}
?>
				  </div>
              </div>
<?php }
if(isset($_GET['package_id']))
 { ?>
 <?php include_once('reports_js.php'); ?>
 
 <?php }  ?>