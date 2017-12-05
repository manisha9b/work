<?php
if(!isset($_SESSION['ref_id'])){header('Location: /');}
?>
<style>
.welcome-txt h4 {	line-height: 30px;}
.breadcrumb {	font-size: 14px;
	padding-left: 7px;}
</style>
<?php
if(!isset($_SESSION['ref_id'])){header('Location: /');}
?>
<div class="row">
  <div class="col-mod-12" style="height:10px;">

  </div>
</div>
<?php
switch($page_request)
{
	case "":
		include_once 'default.php';
	break;
	case "my_packages":
		include_once 'my_packages.php';
	break;
	case "my_employees":
		include_once 'employee/employee.php';
	break;
	case "my_reports":
		include_once 'my_reports/my_reports.php';
	break;
	case "my_settings":
		include_once 'schedule/schedule.php';
	break;
	case "change-password":
		include_once 'change-password.php';
	break;
	case "analytics":
		include_once 'analytics.php';
	break;
	case "overview":
		include_once 'overview.php';
	break;
	case "schedule":
		include_once 'schedule/schedule.php';
	break;
	case "health_reports":
		include_once 'health_reports/reports.php';
	break;


}
?>