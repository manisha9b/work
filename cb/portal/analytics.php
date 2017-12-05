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

?>

<div class="row profile">
<div class="col-md-3 user-details well text-center col-sm-12" style="padding: 10px;background-color:#fff;  -webkit-box-shadow: 3px 3px 6px #C4C2C3;min-height:1080px;">
<?php
	include "dashboard-menu.php";
?>
</div>
	<?php
		$arr_ebh_pack	=	$database->getclusterEbhPackage($database->clusterId,$_GET['id']);
		$package_nm		= 	$arr_ebh_pack[0]['package_nm'];

		$appt_confirmed=0;
		$visited=0;
		$package_unit			=	$arr_ebh_pack[0]['package_unit'];
		$total_invited			= 	$arr_ebh_pack[0]['total_invited'];


		$appt_confirmed			= $arr_ebh_pack[0]['appt_confirmed'];
		$visited				= $arr_ebh_pack[0]['visited'];
		$remaining				= ($package_unit -($total_invited));
		
		/*
		$invited_per	=	($total_invited*100)/$package_unit;
		$confirmed_per	=	($appt_confirmed*100)/$package_unit;
		$visited_per	=	($visited*100)/$package_unit;
		*/
		$invited_per	=	(($total_invited-$appt_confirmed)*100)/$package_unit;
		$confirmed_per	=	(($appt_confirmed-$visited)*100)/$package_unit;			
		$visited_per	=	($visited*100)/$package_unit;
		
		$remaining_per	=	($remaining*100)/$package_unit;

	?>
<div class="col-md-9">
<div class="row">
<div class="col-sm-12 text-primary text-left">
<?php
	include "dashboard-header-text.php";
?>
</div>
</div>
<div class="row">
<div class="col-sm-12 text-primary text-left">
	<ul class="breadcrumb">
		<li><a href="<?php echo HTTP_SERVER;?>portal/cindex.php">Dashboard</a></li>
		<li><a href="<?php echo HTTP_SERVER;?>portal/cindex.php?page=my_packages">My Packages</a></li>
		<li><?php echo $package_nm; ?> Analytics</li>
	</ul>
</div>

</div>

	
</div>

	<div class="col-md-5">
		<div class="panel">
			<div class="panel-body">
				<div class="panel">
					<div class="panel-heading">
						<h4 class="panel-title text-primary">
							<i class="fa fa-bar-chart-o"></i> Usage Summary <span class="small"></span>
						</h4>
					</div>
					<div class="panel-body">
					  <div id="graphDonut2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-4">
		<div class="panel">
			<div class="panel-body">
				<div class="panel">
					<div class="panel-heading">
						<h4 class="panel-title text-primary">
							<i class="fa fa-list"></i> Usage Report <span class="small"></span>
						</h4>
					</div>
					<div class="panel-body">
						<ul class="list-group details-list">
							 <li class="list-group-item">
							  <span class="pull-right"><?php echo $package_unit;?></span>
							  Purchased UNIT
							</li>
							<li class="list-group-item">
							  <span class="pull-right"><?php echo $total_invited;?></span>
							  Invitation Sent To Employee
							</li>
							<li class="list-group-item">
							  <span class="pull-right"><?php echo $appt_confirmed;?></span>
							  Availability Confirmed By Employee
							</li>
							<li class="list-group-item">
							  <span class="pull-right"><?php echo $visited;?></span>
							  Employee Visited at HSP Location
							</li>
							<li class="list-group-item">
							  <span class="pull-right"><?php echo $remaining;?></span>
							  Remaining Package UNIT
							</li>
						  </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
<!-- Pie Charts!-->
<div class="col-sm-9">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
if(!empty($_GET['id']))
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
	where a.cluster_id=".$database->clusterId." and a.cluster_package_id=".$_GET['id']."
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
</div>	
	
	
	<div class="col-sm-12">
		<div class="panel">
			<div class="panel-body">
				<div class="panel">
					<div class="panel-heading">
						<h4 class="panel-title text-primary">
							<i class="fa fa-bar-chart-o"></i> <?php echo $package_nm;?> Utilization Analysis <span class="small">(Last Six Months)</span>
						</h4>
					</div>
					<div class="panel-body">
					  <div id="barchart" style="height: 250px;"></div>
					</div>
				</div>
			</div>
		</div>
		
	</div>


