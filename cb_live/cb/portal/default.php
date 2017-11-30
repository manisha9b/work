<style>
#panel_menu a:hover {
	text-decoration:none;
}
#panel_menu a:focus {
	text-decoration:none;
}
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

?>
<div class="row profile">
<div class="col-md-3 user-details well text-center col-sm-12"  style="padding: 10px;background-color:#fff;  -webkit-box-shadow: 3px 3px 6px #C4C2C3;min-height:1080px;">
<?php
	include "dashboard-menu.php";
?>
</div>

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
		<li>Overview</li>
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

<div class="panel-body" id="panel_menu">

<div class="row">
<div class="col-sm-3 text-center"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_packages"><div class="well well-sm bg-success text-white" style="padding-top: 20%;padding-bottom: 20%;"><h2><i class="fa fa-list-alt fa-2x"></i><br><br>My Packages</h2></div></a></div>
<div class="col-sm-3 text-center"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_employees"><div class="well well-sm bg-info text-white" style="padding-top: 20%;padding-bottom: 20%;"><h2><i class="fa fa-users fa-2x"></i><br><br>My Employees</h2></div></a></div>
<div class="col-sm-3 text-center"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_reports"><div class="well well-sm bg-warning text-white" style="padding-top: 20%;padding-bottom: 20%;"><h2><i class="fa fa-pie-chart fa-2x"></i><br><br> My Reports</h2></div></a></div>
<div class="col-sm-3 text-center"><a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=my_settings"><div class="well well-sm bg-seagreen text-white" style="padding-top: 20%;padding-bottom: 20%;"><h2><i class="fa fa-calendar fa-2x"></i><br><br> Reminders</h2></div></a></div>
</div>
<!--
<br />
<div class="row">
<div class="col-sm-3 text-center"><a href="/portal/cindex.php?page=health_reports"><div class="well well-sm bg-primary text-white" style="padding-top: 20%; padding-bottom: 20%;"><h2><i class="fa fa-files-o fa-2x"></i><br><br>Health Reports</h2></div></a></div>
<div class="col-sm-3 text-center">&nbsp;</div>
<div class="col-sm-3 text-center">&nbsp;</div>
<div class="col-sm-3 text-center">&nbsp;</div>
</div>
!-->

</div>

</div>
</div>
</div>