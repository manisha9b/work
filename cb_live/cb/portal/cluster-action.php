<?php
ob_start();
session_start();
include_once '../../../includes/define.php';
include '../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

$modified_by	=	$_SESSION['ref_id'];
$modified_on	=	date("Y-m-d H:i:s");

if(isset($_POST['form']))
 { 	if($_POST['form']=='edit_cluster_email')
 	{    	$business_email_id	=	$_POST['business_email_id'];
    	$cluster_id			=	$_POST['cluster_id'];

    	$database->update("tbl_clusters", array(
		"business_email_id" => $business_email_id,
		"modified_by" => $modified_by,
		"modified_on" => $modified_on)," cluster_id='".$cluster_id."'");
 	}
 	elseif($_POST['form']=='edit_cluster_mobile')
 	{        $contact_mobile	=	$_POST['contact_mobile'];
    	$cluster_id			=	$_POST['cluster_id'];

        $database->update("tbl_clusters", array(
		"contact_mobile" => $contact_mobile,
		"modified_by" => $modified_by,
		"modified_on" => $modified_on)," cluster_id='".$cluster_id."'");
 	}
	else
	{        $contact_landline	=	$_POST['contact_landline'];
    	$cluster_id			=	$_POST['cluster_id'];

        $database->update("tbl_clusters", array(
		"contact_landline" => $contact_landline,
		"modified_by" => $modified_by,
		"modified_on" => $modified_on)," cluster_id='".$cluster_id."'");
	}
 }

header("location: ".$_SERVER['HTTP_REFERER']);

?>