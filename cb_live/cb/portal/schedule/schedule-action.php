<?php
ob_start();
session_start();
include_once '../../../../includes/define.php';
include '../../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(isset($_POST['schedule_type_id']))
 {

	$cluster_id			=	$_POST['cluster_id'];
	$schedule_type		=	$_POST['schedule_type'];
	$schedule_type_id	=	$_POST['schedule_type_id'];
	$sch_interval		=	$_POST['sch_interval'];
	$sch_weekday		=	$_POST['sch_weekday'];
	$sch_monthday		=	$_POST['sch_monthday'];
	$sch_time			=	$_POST['sch_time'];
	$sch_email_content	=	$_POST['sch_email_content'];
	$sch_sms_content	=	$_POST['sch_sms_content'];

	$created_by			=	$_SESSION['ref_id'];
	$created_on			=	date("Y-m-d H:i:s");
	$modified_by		=	$_SESSION['ref_id'];
	$modified_on		=	date("Y-m-d H:i:s");


    if(empty($_POST['schedule_id']))
    {
		$database->insert("tbl_cluster_reminder_schedule",
		array($cluster_id, $schedule_type, $schedule_type_id, $sch_interval, $sch_weekday, $sch_monthday, $sch_time, $sch_email_content, $sch_sms_content, $created_by, $created_on, $modified_by),
		"cluster_id, schedule_type, schedule_type_id, sch_interval, sch_weekday, sch_monthday, sch_time, sch_email_content, sch_sms_content, created_by, created_on, modified_by");
	}
	else
	{		$database->update("tbl_cluster_reminder_schedule", array(
		"cluster_id" => $cluster_id,
		"schedule_type" => $schedule_type,
		"sch_interval" => $sch_interval,
		"sch_weekday" => $sch_weekday,
		"sch_monthday" => $sch_monthday,
		"sch_time" => $sch_time,
		"sch_email_content" => $sch_email_content,
		"sch_sms_content" => $sch_sms_content,
		"modified_by" => $modified_by,
		"modified_on" => $modified_on)," schedule_type_id='".$_POST['schedule_type_id']."' AND schedule_id='".$_POST['schedule_id']."'");
	}

	$redirect_url = HTTP_SERVER."/portal/cindex.php?page=schedule&m=sch#".$_POST['schedule_type_id'];
 }
else
 {	
	$redirect_url = HTTP_SERVER."/portal/cindex.php";
 }
	header('location: '.$redirect_url);
?>