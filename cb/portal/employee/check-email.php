<?php
ob_start();
session_start();
include_once '../../../../includes/define.php';
include '../../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(!empty($_GET['email']))
 {
	$empemail = $database->getTableForHsp("tbl_cluster_employee", "professional_email_id = '".$_GET['email']."'");
	if(!empty($empemail))
	{
		$emp_email = $empemail;
	}
	else
	{
		$emp_email = $empemail;
	}
 }

echo $emp_email;
?>