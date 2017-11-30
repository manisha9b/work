<?php
ob_start(); 
session_start();
include_once '../includes/define.php';
include '../classes/Class_Database.php';
global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta'); 

$ref_id=$_SESSION['ref_id'];
$sess=$_SESSION['user_session_id'];

if($_SESSION["working_status_id"]!="")
{
	$working_status_id=$_SESSION["working_status_id"];
}
else
{
	$working_status_id='';
}
$j_date=date('Y-m-d H:i:s');
if($sess=="")
{
	$insert_details="insert into crm_login_details (user_id,logout_date,server) VALUES ('".$ref_id."','".$j_date."','')";
	mysql_query($insert_details);
}
$update="update crm_login_details set logout_date='$j_date' where session_id='$sess'";
mysql_query($update);

$database->update("tbl_user_mst",array('work_status'=>'5','logout_on'=>$j_date,'is_online'=>0)," user_id='".$ref_id."'");
 
if($ref_id!="")
{
	$database->insert("crm_working_status_log",array($working_status_id,'5',$ref_id,$ref_id,$j_date),"prev_working_status_id,current_working_status_id,crm_user_id,created_by,created_on");
}

if($_SESSION['web-login']==1)
{
	//$redirect_page="https://www.easybuyhealth.com/accounts/".$_SESSION['client'];
	$redirect_page="".HTTP_SERVER;
}
else
{
	//$redirect_page =HTTP_SERVER;
	$redirect_page=HTTP_SERVER;
}
session_unset();
session_destroy();

header("Location: ".$redirect_page);

?>