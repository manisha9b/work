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
 $clusterId						=	$_SESSION['cluster_id'];

 //echo "<pre>";
 //echo $_POST['cluser_user_id'];
 $cluster_user_id						=	$_POST['cluser_user_id'];
if(isset($_POST['action'])){ 
	 if(!empty($_FILES['photo']['name'])) {
		// echo realpath(dirname(__FILE__));
		// echo "
		 //";
       // echo $uploaddir = realpath('media\photo\cluster_user\\');die;
		$uploaddir = 'media/photo/cluster_user/';
        $ext = pathinfo($_FILES['photo']['name']);
			$newfilename = $cluster_user_id."-".date('YmdHis').".".$ext['extension'];
        $uploaddir."/".$newfilename;
     var_dump(   move_uploaded_file($_FILES['photo']['tmp_name'], ($uploaddir."/".$newfilename)));
        $photo			= HTTP_SERVER.'portal/media/photo/cluster_user/'.$newfilename;
			$update = array("photo" => $photo);
	  //print_r($update);
	  $database->update(
          "tbl_cluster_users",
          $update,
          "cluster_user_id=".$cluster_user_id
        );
      } 
	  
}else{ 
$update = array(
            "cluster_business_name" => mysql_real_escape_string(trim($_POST["cluster_business_name"])),
            "business_email_id" => mysql_real_escape_string(trim($_POST["business_email_id"])),
            "contact_mobile" => mysql_real_escape_string(trim($_POST["contact_mobile"])),
			"contact_landline" => mysql_real_escape_string(trim($_POST["contact_landline"])),
            "address" => mysql_real_escape_string(trim($_POST["address"])),
            "pincode" => mysql_real_escape_string(trim($_POST["pincode"])),
            "state" => mysql_real_escape_string(trim($_POST["state"])),
            "city" => mysql_real_escape_string(trim($_POST["city"])),
            "hr_full_name" => mysql_real_escape_string(trim($_POST["hr_full_name"])),
            "hr_email_id" => mysql_real_escape_string(trim($_POST["hr_email_id"])),
			"hr_mobile_no" => mysql_real_escape_string(trim($_POST["hr_mobile_no"])),
            "modified_on" => date("Y-m-d H:i:s"),
            "modified_by" => $_SESSION['ref_id']
          );
		 // echo "<pre>";
$database->update(
          "tbl_clusters",
          $update,
          "cluster_id=".$clusterId
        );
$update = array(
		
		"user_name" => mysql_real_escape_string(trim($_POST["hr_full_name"])),
		"user_email" => mysql_real_escape_string(trim($_POST["hr_email_id"])),
		"user_mobile" => mysql_real_escape_string(trim($_POST["hr_mobile_no"])),
		
		
	  );
	  //print_r($update);
	  $database->update(
          "tbl_cluster_users",
          $update,
          "cluster_user_id=".$cluster_user_id
        );

}
		$_SESSION['alert'] ='u';
$redirect_page	=	HTTP_SERVER."profile.php";
		 header("location: ".$redirect_page);
?>