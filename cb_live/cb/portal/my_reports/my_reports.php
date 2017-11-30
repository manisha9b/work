<style>
.chi_hr {
	display: block;
	margin: 0px auto;
	padding: 0px;
	width: auto;
	border-bottom: thin solid #000;
	max-width: 100px;
}
.chi_img h4 {	line-height: 25px;}
</style>
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
		<li>My Reports</li>
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
	<h6 class="panel-title">Company Health Index:<span class="pull-right"><a class="btn btn-success text-white btn-sm pull-right" href="<?php echo HTTP_SERVER;?>portal/cindex.php?page=health_reports"> Access Health Report </a></span></h6>
	
</div>
<div class="panel-body">
<?php
$female_emp_arr = $database->getClusterEmpByGenderBmi($database->clusterId, 'female', null);
$female_emp = count($female_emp_arr);
$maleemp_arr = $database->getClusterEmpByGenderBmi($database->clusterId, 'male', null);
$maleemp_arr_count = count($maleemp_arr);
$female_male_emp = ($female_emp + $maleemp_arr_count);

unset($database->result);
$sql="SELECT
a.emp_id, 
a.salutation,
if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
a.professional_email_id,
a.personal_email_id,
a.mobile_no,
concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
c.package_nm,
e.bp_level
FROM tbl_cluster_employee AS a
LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
WHERE a.ebh_customer_id<>'' AND a.cluster_id = '".$database->clusterId."' AND e.bp_level<>'' AND e.bp_level='High'";
$database->select($sql);
$highbp_arr = $database->result;
$highbp_count = count($highbp_arr);
$highbp_prc = floor($highbp_count * 100 / $female_male_emp);
	
unset($database->result);
$sql="SELECT
a.emp_id, 
a.salutation,
if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
a.professional_email_id,
a.personal_email_id,
a.mobile_no,
concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
c.package_nm,
e.bs_result
FROM tbl_cluster_employee AS a
LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
WHERE a.ebh_customer_id<>'' AND a.cluster_id = '".$database->clusterId."' AND e.bs_result = 'Diabetes'";
$database->select($sql);
$diabetes_arr = $database->result;
$diabetes_count = count($diabetes_arr);
$diabetes_prc = floor($diabetes_count * 100 / $female_male_emp);

unset($database->result);
$sql="SELECT
a.emp_id, 
a.salutation,
if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
a.professional_email_id,
a.personal_email_id,
a.mobile_no,
concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
c.package_nm,
e.bs_result
FROM tbl_cluster_employee AS a
LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
WHERE a.ebh_customer_id<>'' AND a.cluster_id = '".$database->clusterId."' AND e.bs_result = 'Prediabetes'";
$database->select($sql);
$prediabetes_arr = $database->result;
$prediabetes_count = count($prediabetes_arr);
$prediabetes_prc = floor($prediabetes_count * 100 / $female_male_emp);

unset($database->result);
$sql="SELECT
a.emp_id, 
a.salutation,
if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
a.professional_email_id,
a.personal_email_id,
a.mobile_no,
concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
c.package_nm,
e.bs_result
FROM tbl_cluster_employee AS a
LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
WHERE a.cluster_id = '".$database->clusterId."' AND e.bmi > '24.9'";
$database->select($sql);
$overweight_arr = $database->result;
$overweight_count = count($overweight_arr);
$overweight_prc = floor($overweight_count * 100 / $female_male_emp);
?>
<div class="row">
<div class="col-sm-2 text-center chi_img"><img src="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/my_reports/icons/female.png" width="100"><h4><?php echo $female_emp; ?></h4><span class="chi_hr"></span><h4>Female<br />Employee</h4></div>
<div class="col-sm-2 text-center chi_img"><img src="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/my_reports/icons/male.png" width="100"><h4><?php echo $maleemp_arr_count; ?></h4><span class="chi_hr"></span><h4>Male<br />Employee</h4></div>
<div class="col-sm-2 text-center chi_img"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=high_bp"><img src="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/my_reports/icons/high-bp.png" width="100"></a><h4><?php echo $highbp_prc; ?>%</h4><span class="chi_hr"></span><h4><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=high_bp">High<br />BP</a></h4></div>
<div class="col-sm-2 text-center chi_img"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=diabetes"><img src="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/my_reports/icons/diabetes.png" width="100"></a><h4><?php echo $diabetes_prc; ?>%</h4><span class="chi_hr"></span><h4><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=diabetes">Diabetes</a></h4></div>
<div class="col-sm-2 text-center chi_img"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=pre-diabetes"><img src="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/my_reports/icons/pre-diabetes.png" width="100"></a><h4><?php echo $prediabetes_prc; ?>%</h4><span class="chi_hr"></span><h4><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=pre-diabetes">Pre-Diabetes</a></h4></div>
<div class="col-sm-2 text-center chi_img"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=overweight"><img src="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/my_reports/icons/overweight.png" width="100"></a><h4><?php echo $overweight_prc; ?>%</h4><span class="chi_hr"></span><h4><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports&list=overweight">Overweight</a></h4></div>
</div>
</div>
<br />
<?php
if(!isset($_GET['list']))
{
?>
<div class="panel-heading">
	<div class="col-sm-3 pull-right">
	<?php
	if(!empty($arr_cluster_pack))
	{
		echo'<select size="1" name="change_package" id="change_package" class="form-control input-sm">';
			foreach($arr_cluster_pack as $row)
			{
				if($_GET['package_id'] == $row['cluster_package_id'])
				{
					echo "<option value=\"".$row['cluster_package_id']."\" selected>".$row['package_nm']."</option>\n";
				}
				else
				{
					echo "<option value=\"".$row['cluster_package_id']."\">".$row['package_nm']."</option>\n";
				}
			}
		echo'</select>';
	}
	?>
	</div>
	<h6 class="panel-title">Last Purchased Health Package Statistics:</h6><br />
</div>

<div id="last_package_statistics">
<!-- lps !-->
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="15%" height="60px" class="text-center" valign="middle"><?php echo $created_on; ?></td>
<td width="15%" height="60px" class="text-center" valign="middle"><a href="#"><img src="<?php echo HTTP_SERVER."portal/".$hsp_logo;?>" data-src="holder.js/90x90" style="width: 90px; height: 90px;" class="main-avatar img-rectangle pull-left" alt=""></a></td>
<td width="70%">

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
<br />
<!-- Pie Charts!-->
<div class="panel-body">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
if(!empty($arr_cluster_pack[0]['cluster_package_id']))
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
	where a.cluster_id=".$database->clusterId." and a.cluster_package_id=".$arr_cluster_pack[0]['cluster_package_id']."
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
<!-- #lps !-->
</div>
<?php
}
elseif($_GET['list'] == 'male')
{
?>
<div class="panel-body">
<a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=<?php echo $_GET['page']; ?>" class="btn btn-info btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;"><i class="fa fa-chevron-left"></i> Back to My Reports</a>
<?php
if(!empty($maleemp_arr))
{
?>
<div class="pull-right">
	<a href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/downloadinexcel.php?claster_id=<?php echo $database->clusterId; ?>&list=<?php echo $_GET['list']; ?>" class="btn btn-success btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;" id="excel_btn" data-filter-name="" data-filter-gender="" data-filter-bmi="" data-filter-package=""><i class="fa fa-download"></i> Download in Excel</a>
</div>
<?php
}
?>
<p>&nbsp;</p>
<table class="table table-striped" <?php if(!empty($maleemp_arr)){ echo "id='tabledata'";} ?>>
	<thead>
		<tr>
			<th width="5%">#</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Appointment Date</th>
			<th>Package</th>
			<th>Category</th>
		</tr>
	</thead>
<tbody>
<?php
	if(!empty($maleemp_arr))
	{
		$i = 1;
		foreach($maleemp_arr as $row)
		{
			$gender	= $database->getClusterEmpGender($database->clusterId, $row['emp_id']);
			$email	= (!empty($row['professional_email_id'])) ? $row['professional_email_id'] : $row['personal_email_id'];
			echo"<tr>
				<td>".$i++."</td>
				<td>".$row['emp_name']."</td>
				<td>".$gender."</td>
				<td>".$email."</td>
				<td>".$row['mobile_no']."</td>
				<td>".$row['appointment_date']."</td>
				<td>".$row['package_nm']."</td>
				<td>".$row['bp_level']."</td>
			</tr>\n";
		}
	}
	else
	{
			echo"<tr>
				<td colspan=\"8\" align=\"center\">No data found...</td>
			</tr>\n";
	}
?>
</tbody>
</table>
</div>
<?php
}
elseif($_GET['list'] == 'high_bp')
{
?>
<div class="panel-body">
<a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=<?php echo $_GET['page']; ?>" class="btn btn-info btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;"><i class="fa fa-chevron-left"></i> Back to My Reports</a>
<?php
if(!empty($highbp_arr))
{
?>
<div class="pull-right">
	<a href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/downloadinexcel.php?claster_id=<?php echo $database->clusterId; ?>&list=<?php echo $_GET['list']; ?>" class="btn btn-success btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;" id="excel_btn" data-filter-name="" data-filter-gender="" data-filter-bmi="" data-filter-package=""><i class="fa fa-download"></i> Download in Excel</a>
</div>
<?php
}
?>
<p>&nbsp;</p>
<table class="table table-striped" <?php if(!empty($highbp_arr)){ echo "id='tabledata'";} ?>>
	<thead>
		<tr>
			<th width="5%">#</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Appointment Date</th>
			<th>Package</th>
			<th>Category</th>
		</tr>
	</thead>
<tbody>
<?php
	if(!empty($highbp_arr))
	{
		$i = 1;
		foreach($highbp_arr as $row)
		{
			$gender	= $database->getClusterEmpGender($database->clusterId, $row['emp_id']);
			$email	= (!empty($row['professional_email_id'])) ? $row['professional_email_id'] : $row['personal_email_id'];
			echo"<tr>
				<td>".$i++."</td>
				<td>".$row['emp_name']."</td>
				<td>".$gender."</td>
				<td>".$email."</td>
				<td>".$row['mobile_no']."</td>
				<td>".$row['appointment_date']."</td>
				<td>".$row['package_nm']."</td>
				<td>".$row['bp_level']."</td>
			</tr>\n";
		}
	}
	else
	{
			echo"<tr>
				<td colspan=\"8\" align=\"center\">No data found...</td>
			</tr>\n";
	}
?>
</tbody>
</table>
</div>
<?php
}
elseif($_GET['list'] == 'diabetes')
{
?>
<div class="panel-body">
<a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=<?php echo $_GET['page']; ?>" class="btn btn-info btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;"><i class="fa fa-chevron-left"></i> Back to My Reports</a>
<?php
if(!empty($diabetes_arr))
{
?>
<div class="pull-right">
	<a href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/downloadinexcel.php?claster_id=<?php echo $database->clusterId; ?>&list=<?php echo $_GET['list']; ?>" class="btn btn-success btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;" id="excel_btn" data-filter-name="" data-filter-gender="" data-filter-bmi="" data-filter-package=""><i class="fa fa-download"></i> Download in Excel</a>
</div>
<?php
}
?>
<p>&nbsp;</p>
<table class="table table-striped" <?php if(!empty($diabetes_arr)){ echo "id='tabledata'";} ?>>
	<thead>
		<tr>
			<th width="5%">#</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Appointment Date</th>
			<th>Package</th>
			<th>Category</th>
		</tr>
	</thead>
<tbody>
<?php
	if(!empty($diabetes_arr))
	{	
		$i = 1;
		foreach($diabetes_arr as $row)
		{
			$gender	= $database->getClusterEmpGender($database->clusterId, $row['emp_id']);
			$email	= (!empty($row['professional_email_id'])) ? $row['professional_email_id'] : $row['personal_email_id'];
			echo"<tr>
				<td>".$i++."</td>
				<td>".$row['emp_name']."</td>
				<td>".$gender."</td>
				<td>".$email."</td>
				<td>".$row['mobile_no']."</td>
				<td>".$row['appointment_date']."</td>
				<td>".$row['package_nm']."</td>
				<td>Diabetes</td>
			</tr>\n";
		}
	}
	else
	{
			echo"<tr>
				<td colspan=\"8\" align=\"center\">No data found...</td>
			</tr>\n";
	}
?>
</tbody>
</table>
</div>
<?php
}
elseif($_GET['list'] == 'pre-diabetes')
{
?>
<div class="panel-body">
<a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=<?php echo $_GET['page']; ?>" class="btn btn-info btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;"><i class="fa fa-chevron-left"></i> Back to My Reports</a>
<?php
if(!empty($prediabetes_arr))
{
?>
<div class="pull-right">
	<a href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/downloadinexcel.php?claster_id=<?php echo $database->clusterId; ?>&list=<?php echo $_GET['list']; ?>" class="btn btn-success btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;" id="excel_btn" data-filter-name="" data-filter-gender="" data-filter-bmi="" data-filter-package=""><i class="fa fa-download"></i> Download in Excel</a>
</div>
<?php
}
?>
<p>&nbsp;</p>
<table class="table table-striped" <?php if(!empty($prediabetes_arr)){ echo "id='tabledata'";} ?>>
	<thead>
		<tr>
			<th width="5%">#</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Appointment Date</th>
			<th>Package</th>
			<th>Category</th>
		</tr>
	</thead>
<tbody>
<?php
	if(!empty($prediabetes_arr))
	{	
		$i = 1;
		foreach($prediabetes_arr as $row)
		{
			$gender	= $database->getClusterEmpGender($database->clusterId, $row['emp_id']);
			$email	= (!empty($row['professional_email_id'])) ? $row['professional_email_id'] : $row['personal_email_id'];
			echo"<tr>
				<td>".$i++."</td>
				<td>".$row['emp_name']."</td>
				<td>".$gender."</td>
				<td>".$email."</td>
				<td>".$row['mobile_no']."</td>
				<td>".$row['appointment_date']."</td>
				<td>".$row['package_nm']."</td>
				<td>Pre-Diabetes</td>
			</tr>\n";
		}
	}
	else
	{
			echo"<tr>
				<td colspan=\"8\" align=\"center\">No data found...</td>
			</tr>\n";
	}
?>
</tbody>
</table>
</div>
<?php
}
elseif($_GET['list'] == 'overweight')
{
?>
<div class="panel-body">
<a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=<?php echo $_GET['page']; ?>" class="btn btn-info btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;"><i class="fa fa-chevron-left"></i> Back to My Reports</a>
<?php
if(!empty($overweight_arr))
{
?>
<div class="pull-right">
	<a href="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/downloadinexcel.php?claster_id=<?php echo $database->clusterId; ?>&list=<?php echo $_GET['list']; ?>" class="btn btn-success btn-sm" style="color: #FFF; font-size: 12px; padding-left: 15px; padding-right: 15px;" id="excel_btn" data-filter-name="" data-filter-gender="" data-filter-bmi="" data-filter-package=""><i class="fa fa-download"></i> Download in Excel</a>
</div>
<?php
}
?>
<p>&nbsp;</p>
<table class="table table-striped" <?php if(!empty($overweight_arr)){ echo "id='tabledata'";} ?>>
	<thead>
		<tr>
			<th width="5%">#</th>
			<th>Name</th>
			<th>Gender</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Appointment Date</th>
			<th>Package</th>
			<th>Category</th>
		</tr>
	</thead>
<tbody>
<?php
	if(!empty($overweight_arr))
	{
		$i = 1;
		foreach($overweight_arr as $row)
		{
			$gender	= $database->getClusterEmpGender($database->clusterId, $row['emp_id']);
			$email	= (!empty($row['professional_email_id'])) ? $row['professional_email_id'] : $row['personal_email_id'];
			echo"<tr>
				<td>".$i++."</td>
				<td>".$row['emp_name']."</td>
				<td>".$gender."</td>
				<td>".$email."</td>
				<td>".$row['mobile_no']."</td>
				<td>".$row['appointment_date']."</td>
				<td>".$row['package_nm']."</td>
				<td>Overweight</td>
			</tr>\n";
		}
	}
	else
	{
			echo"<tr>
				<td colspan=\"8\" align=\"center\">No data found...</td>
			</tr>\n";
	}
?>
</tbody>
</table>
</div>
<?php
}
?>
</div>
</div>
</div>


