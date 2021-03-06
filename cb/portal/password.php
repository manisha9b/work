<?php
ob_start(); 
session_start();
include_once '../includes/define.php';
include '../classes/Class_Database.php';

global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta'); 

$current_user_id		=	$database->user_id_pk;
$current_user_group		=	$database->userGroupId;
$created_on				=	date("Y-m-d H:i:s");

$old_password			=	isset($_POST['old_password'])?$_POST['old_password']:'';
$new_password			=	isset($_POST['new_password'])?$_POST['new_password']:'';
$password				=	isset($_POST['password'])?$_POST['password']:'';

if($old_password!='')										
{
	$arr_user =	$database->getUserPassword($current_user_id,$old_password);
	
	if(count($arr_user)>0)
	{											
		$database->update("tbl_user_mst",array("login_password"=>$new_password)," user_id='".$current_user_id."'");
		
		$response_html='<div class="alert alert-success alert-dismissable">
					 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    
					 <p>Password changed successfully. Kindly <a href="'.HTTP_SERVER.'">click here</a> to login again..</p>
				   </div>';
				   
		session_destroy();
	}
	else
	{
		$response_html='<div class="alert alert-danger alert-dismissable">
					 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>    
					 <p>Old password doesn\'t match. Please try again</p>
				   </div>';
	}	 
}elseif(isset($_POST['confirm_password'])){
	$database->update("tbl_user_mst",array("login_password"=>$password,'is_password_changed'=>'1')," user_id='".$current_user_id."'");
	unset($_SESSION['show_reset_password']);
//	session_unset();
		$redirect_page	=	HTTP_SERVER."dashboard.php?rs=1";
		 header("location: ".$redirect_page);
//	print_R($_SESSION);
}
echo $response_html;
?>