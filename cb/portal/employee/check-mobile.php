<?php
ob_start();
session_start();
include_once '../../../../includes/define.php';
include '../../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(!empty($_GET['mobile']))
 {
	$empmobile = $database->getTableForHsp("tbl_cluster_employee", "mobile_no = '".$_GET['mobile']."'");
	if(!empty($empmobile))
	{
		$emp_mobile = $empmobile;
	}
	else
	{
		$emp_mobile = $empmobile;
	}
 }

echo $emp_mobile;
?>