<?php
ob_start();
session_start();
include_once '../../../../includes/define.php';
include '../../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');
?>
<div class="panel-body">
<?php
if(!isset($_GET['package_id']))
 {
	$arr_ebh_pack	=	$database->getclusterEbhPackage($database->clusterId);
 }
else
 {
	$arr_ebh_pack	=	$database->getclusterEbhPackage($database->clusterId, $_GET['package_id']);
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
<table class="table">
<tr>
<td width="10%" class="text-center" style="padding-top: 70px;"><?php echo $created_on; ?></td>
<td width="10%" class="text-center" style="padding-top: 20px;"><a href="#"><img src="<?php echo HTTP_SERVER."portal/".$hsp_logo;?>" data-src="holder.js/90x90" style="width: 90px; height: 90px;" class="main-avatar img-rectangle pull-left" alt=""></a></td>
<td width="80%">

	<div class="list-group list-projects" style="margin-top:5px;margin-bottom:5px;margin:10px;padding:10px;">
		<div class="row" style="padding-top:5px;">
			<div class="col-md-12">
				<?php echo $package_nm;?>
			</div>
			<div class="col-md-4">
				<span class="help-block"> <?php echo ($total_invited>0)?$total_invited." / ".$package_unit." Employees Invited":"No Invitation sent";?> </span>
				<div class="progress" style="height:10px; width:50%;margin-bottom:8px;">
				 <div class="progress-bar three-sec-ease-in-out progress-bar-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="<?php echo $package_unit;?>" style="width: <?php echo $invited_per;?>%;"></div>
			   </div>
			</div>
			<div class="col-md-4">
				<span class="help-block"> <?php echo ($appt_confirmed>0)?$appt_confirmed." / ".$total_invited." Booked Appointments":"No Bookings";?> </span>
				<div class="progress" style="height:10px; width:50%;margin-bottom:8px;">
				 <div class="progress-bar three-sec-ease-in-out progress-bar-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="<?php echo $total_invited;?>" style="width: <?php echo $confirmed_per;?>%;"></div>
			   </div>
			</div>
			<div class="col-md-4">
				<span class="help-block"> <?php echo ($visited>0)?$visited." / ".$appt_confirmed." Utilized Package":"No Utilization";?> </span>
				<div class="progress" style="height:10px; width:50%;margin-bottom:8px;">
				 <div class="progress-bar three-sec-ease-in-out progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="<?php echo $appt_confirmed;?>" style="width: <?php echo $visited_per;?>%;"></div>
			   </div>
			</div>
		</div>
	</div>

</td>
</tr>
</table>
<?php
}
?>
</div>
<!-- Pie Charts!-->
<div class="panel-body">
<?php
if(!empty($_GET['package_id']))
{
	unset($database->result);
	$sql="SELECT
	a.cluster_package_id,
	(SELECT count(e.emp_id) from tbl_cluster_employee_pack as e where e.cluster_id=".$database->clusterId.") as total_emp,
	(SELECT count(z.emp_id) from tbl_cluster_employee_pack as z where z.cluster_id=".$database->clusterId." and z.is_confirmed=1) as total_emp_confirmed,
	c.package_nm,
	count(a.emp_id) as total_invites,
	((count(a.emp_id)*100)/(SELECT count(x.emp_id) from tbl_cluster_employee_pack as x where x.cluster_id=".$database->clusterId.") ) as offered_per,
	sum(if(a.is_confirmed=1,1,0)) as total_confirmed,
	((sum(if(a.is_confirmed=1,1,0))*100)/(SELECT count(x.emp_id) from tbl_cluster_employee_pack as x where x.cluster_id=".$database->clusterId." and x.is_confirmed=1)) as booked_appointment_per,
	sum(if(d.appt_status<>'New',1,0)) as total_visited,
	((sum(if(d.appt_status<>'New',1,0))*100)/(SELECT count(y.appointment_id) from tbl_cluster_employee_pack as x LEFT JOIN tbl_appointments as y on x.appointment_id = y. appointment_id where x.cluster_id=".$database->clusterId." and y.appt_status<>'New')) as converted_per
	from tbl_cluster_employee_pack as a
	left join tbl_cluster_packages as b on a.cluster_package_id = b.cluster_package_id
	left join tbl_ebh_pc_packages as c on b.package_id = c.ebh_package_id
	left join tbl_appointments as d on a.appointment_id = d.appointment_id
	where a.cluster_id=".$database->clusterId." and a.cluster_package_id=".$_GET['package_id']."
	GROUP BY a.cluster_package_id";
	$database->select($sql);
	$po_char_arr=$database->result;
}

if(!empty($po_char_arr))
{
?>
<div class="row">
	<div class="col-md-4">
		<div class="panel">
			<div class="panel-body text-center">
<?php
if($po_char_arr[0]['total_invites'] != 0)
{	
	$com_per = (($po_char_arr[0]['total_invites']*100)/$package_unit);
?>
<script type="text/javascript">
/*['',<?php echo ($po_char_arr[0]['total_emp'] - $po_char_arr[0]['total_invites']) ?>],*/
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([        			
        			['',<?php echo ($package_unit - $po_char_arr[0]['total_invites']) ?>],
        			['',<?php echo $po_char_arr[0]['total_invites']?>],
        ]);
        var options = {
        legend: 'none',
        pieSliceText: 'label',
        pieStartAngle: 100,
        colors: ['#31b3bf', '#43ce5a'],
        chartArea:{left:0,top:0,width:'98%',height:'98%'}
      	};
        var chart = new google.visualization.PieChart(document.getElementById('package_offered'));
        chart.draw(data,options);
      }
</script>
<div id="package_offered"></div>
<strong style="text-align:center;display:block;padding:7px;">Package Offered to<br /><?php echo round($com_per, 1) ?>% of employee on-boarded</strong>
<?php 
}
else
{
	echo"<p align=\"center\">No data to display</p>";
}
?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel">
			<div class="panel-body text-center">
<?php
if($po_char_arr[0]['total_confirmed'] != 0)
{	
	$inv_per = (($po_char_arr[0]['total_confirmed']*100)/$po_char_arr[0]['total_invites']);
?>
<script type="text/javascript">
/*['', <?php echo ($po_char_arr[0]['total_emp_confirmed'] - $po_char_arr[0]['total_confirmed']) ?>],*/
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([        			
        			['', <?php echo ($po_char_arr[0]['total_invites'] - $po_char_arr[0]['total_confirmed']) ?>],
        			['', <?php echo ceil($po_char_arr[0]['total_confirmed']) ?>],
        ]);
        var options = {
        legend: 'none',
        pieSliceText: 'label',
        pieStartAngle: 100,
        colors: ['#31b3bf', '#43ce5a'],
        chartArea:{left:0,top:0,width:'98%',height:'98%'}
      	};
        var chart = new google.visualization.PieChart(document.getElementById('booked_appointment'));
        chart.draw(data,options);
      }
</script>
<div id="booked_appointment"></div>
<strong style="text-align:center;display:block;padding:7px;"><?php echo round($inv_per, 1) ?>% of offered employee<br />booked the appointment</strong>
<?php 
}
else
{
	echo"<p align=\"center\">No data to display</p>";
}
?>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="panel">
			<div class="panel-body text-center">
<?php
if($po_char_arr[0]['total_visited'] != 0)
{	
//$total_appt = ($po_char_arr[0]['total_visited'] * 100 / $po_char_arr[0]['converted_per']);
	$total_appt = ($po_char_arr[0]['total_visited'] * 100 / $appt_confirmed);
	$total_appt_notvisited = ($total_appt - $po_char_arr[0]['total_visited']);
	$vis_per = (($po_char_arr[0]['total_visited']*100)/$appt_confirmed);

?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
        			['', <?php echo ($appt_confirmed - $po_char_arr[0]['total_visited']); ?>],
        			['', <?php echo ceil($po_char_arr[0]['total_visited']) ?>],
        ]);
        var options = {
        legend: 'none',
        pieSliceText: 'label',
        pieStartAngle: 100,
        colors: ['#31b3bf', '#43ce5a'],
        chartArea:{left:0,top:0,width:'98%',height:'98%'}
      	};
        var chart = new google.visualization.PieChart(document.getElementById('booked_appointment_confirmed'));
        chart.draw(data,options);
      }
</script>
<div id="booked_appointment_confirmed"></div>
<strong style="text-align:center;display:block;padding:7px;"><?php echo round($vis_per, 1) ?>% of booked appointment<br>have been utilized</strong>
<?php 
}
else
{
	echo"<p align=\"center\">No data to display</p>";
}
?>
			</div>
		</div>
	</div>
</div>
</div>
<?php
}
else
{
	if(!empty($package_nm))
	{
		echo "<p align=\"center\">No data to display for ".$package_nm."</p>";
	}
	else
	{
		echo "<p align=\"center\">No data to display</p>";	
	}
}
?>
<!-- #Pie Charts!-->

<?php
$arr_summary_list	=	$database->cluster_package_summary_monthwise($database->clusterId, $cluster_package_id,date('Y'));
if(!empty($arr_summary_list))
{
?>
<div class="panel-body">
<table class="table table-bordered">
<thead>
<tr>
	<th></th>
	<th>Jan <br><?php echo date('Y');?></th>
	<th>Feb <br><?php echo date('Y');?></th>
	<th>Mar <br><?php echo date('Y');?></th>
	<th>Apr <br><?php echo date('Y');?></th>
	<th>May <br><?php echo date('Y');?></th>
	<th>Jun <br><?php echo date('Y');?></th>
	<th>Jul <br><?php echo date('Y');?></th>
	<th>Aug <br><?php echo date('Y');?></th>
	<th>Sep <br><?php echo date('Y');?></th>
	<th>Oct <br><?php echo date('Y');?></th>
	<th>Nov <br><?php echo date('Y');?></th>
	<th>Dec <br><?php echo date('Y');?></th>
</tr>
</thead>
<tbody>
<tbody>
<?php
// Get Cluster package
if(!isset($_GET['package_id']))
 {
	$arr_cluster_pack	=	$database->getclusterEbhPackage($database->clusterId);
 }
else
 {
	$arr_cluster_pack	=	$database->getclusterEbhPackage($database->clusterId, $_GET['package_id']);
 }

$cluster_package_id	=	$arr_cluster_pack[0]['cluster_package_id'];
$package_nm	=	$arr_cluster_pack[0]['package_nm'];
?>
<tr>
	<td colspan="13"><h4 class="panel-title text-primary"><?php echo $package_nm;	?><h4></td>
</tr>
<?php
$k=0;
for($k=0;$k<count($arr_summary_list);$k++)
{
	$res_type	= $arr_summary_list[$k]['action'];
	switch($res_type)
	{
		case "Invited":
				$box_class="bg-info";
		break;
		case "Confirmed":
				$box_class="bg-warning";
		break;
		case "Visited":
				$box_class="bg-success";
		break;
	}
?>
<tr>
	<th><span class="<?php echo $box_class;?>" style="width: 10px;height:10px;border:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $arr_summary_list[$k]['action']?></th>
	<td ><?php echo ($arr_summary_list[$k]['jan_month']>0)?$arr_summary_list[$k]['jan_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['feb_month']>0)?$arr_summary_list[$k]['feb_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['mar_month']>0)?$arr_summary_list[$k]['mar_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['apr_month']>0)?$arr_summary_list[$k]['apr_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['may_month']>0)?$arr_summary_list[$k]['may_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['jun_month']>0)?$arr_summary_list[$k]['jun_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['jul_month']>0)?$arr_summary_list[$k]['jul_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['aug_month']>0)?$arr_summary_list[$k]['aug_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['sep_month']>0)?$arr_summary_list[$k]['sep_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['oct_month']>0)?$arr_summary_list[$k]['oct_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['nov_month']>0)?$arr_summary_list[$k]['nov_month']:'-';?></td>
	<td><?php echo ($arr_summary_list[$k]['dec_month']>0)?$arr_summary_list[$k]['dec_month']:'-';?></td>
</tr>
<?php
}
?>

</tbody>
</table>
</div>
<?php
}
?>