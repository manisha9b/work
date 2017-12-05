<?php
	ob_start();
	session_start();
	include_once '../../../../includes/define.php';
	include '../../../../classes/Class_Database.php';

	global $database;
	$database = new Database();
	$database->connect();
	date_default_timezone_set('Asia/Calcutta');

	$emp_id 				= 	$_POST['emp_id'];
	$emp_salutation 		= 	$_POST['emp_dr'];
	$emp_first_name 		= 	$_POST['emp_first_name'];
	$emp_middle_name 		= 	$_POST['emp_middle_name'];
	$emp_last_name 			= 	$_POST['emp_last_name'];
	$emp_city 				= 	$_POST['emp_city'];
	$professional_email_id 	= 	$_POST['pro_email_id'];
	$personal_email_id 		= 	$_POST['per_email_id'];
	$designation	 		= 	$_POST['designation'];
	$emp_mobile_number 		= 	$_POST['mobile_no'];
	$emp_dob 				= 	$_POST['dobdate'];

	$emp_height 			= 	$_POST['emp_height'];
	$emp_weight 			= 	$_POST['emp_weight'];
	$emp_bmi 				= 	$_POST['emp_bmi'];
	$emp_rbs 				= 	$_POST['emp_rbs'];
	$emp_bp	 				= 	$_POST['emp_bp'];

	$cluster_id 			=	$_SESSION['cluster_id'];
	$created_by 			=	$_SESSION['ref_id'];
	$created_on				=	date("Y-m-d H:i:s");

	$modified_by			=	$_SESSION['ref_id'];
	$modified_on			=	date("Y-m-d H:i:s");

	$response_html = "";

if(empty($emp_id))
 {
	if(!empty($professional_email_id)){
	$sqlProEmail = "SELECT * FROM tbl_cluster_employee WHERE professional_email_id  = '".$professional_email_id."' and cluster_id = '".$cluster_id ."'";
	$exeProEmail = mysql_query($sqlProEmail);
	$resProEmail = mysql_num_rows($exeProEmail);
	}

	if(!empty($personal_email_id)){
	$sqlPerEmail = "SELECT * FROM tbl_cluster_employee WHERE personal_email_id  = '".$personal_email_id."' and cluster_id = '".$cluster_id ."'";
	$exePerEmail = mysql_query($sqlPerEmail);
	$resPerEmail = mysql_num_rows($exePerEmail);
	}

	if($resProEmail > 0){

		$response_html ='<div class="alert alert-danger alert-dismissable" style="width:450px;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p>Professional Email Id is Already in use. Please try something new.</p>
		</div>';

	}elseif($resPerEmail > 0){

		$response_html ='<div class="alert alert-danger alert-dismissable" style="width:450px;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p>Personal Email Id is Already in use. Please try something new.</p>
		</div>';

	}elseif(empty($_POST['emp_first_name'])){

		$response_html ='<div class="alert alert-danger alert-dismissable" style="width:450px;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p>All fields marked with * are required</p>
		</div>';
	}elseif(empty($_POST['emp_last_name'])){

		$response_html ='<div class="alert alert-danger alert-dismissable" style="width:450px;">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p>All fields marked with * are required</p>
		</div>';

	}else{

		$database->insert("tbl_cluster_employee",
		array($cluster_id, $emp_salutation, $emp_first_name, $emp_middle_name, $emp_last_name, $designation, $professional_email_id, $personal_email_id, $emp_mobile_number, $emp_dob, $emp_height, $emp_city, '1', $created_by, $created_on),
		"cluster_id, salutation, first_name, middle_name, last_name, emp_designation, professional_email_id, personal_email_id, mobile_no, emp_dob, emp_height, city, is_active, created_by, created_on");

		//$response_html = "success";
		$redirect_url = "/portal/cindex.php?page=my_employees&m=aemp";
	}
 }
else
 { 		$database->update("tbl_cluster_employee", array(
		"salutation" => $emp_salutation,
		"first_name" => $emp_first_name,
		"middle_name" => $emp_middle_name,
		"last_name" => $emp_last_name,
		"emp_designation" => $designation,
		"professional_email_id" => $professional_email_id,
		"personal_email_id" => $personal_email_id,
		"mobile_no" => $emp_mobile_number,
		"emp_dob" => $emp_dob,
		"emp_height" => $emp_height,
		"city" => $emp_city,
		"modified_by" => $modified_by,
		"modified_on" => $modified_on)," emp_id='".$emp_id."'");

		//$response_html = "update_success";
		$redirect_url = "/portal/cindex.php?page=my_employees&m=uemp";
 }
		//echo $response_html;
		header('location: '.HTTP_SERVER.$redirect_url);
?>