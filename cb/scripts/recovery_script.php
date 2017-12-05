<?php
include_once '../includes/define.php';
include '../classes/Class_Database.php';
global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

function generatePassword($length = 6)
{
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ1234567890';
	$numChars = strlen($chars);
	$string = '';
	for($i = 0; $i < $length; $i++)
	{
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
	}
	return $string;
}

$login			= $_POST['txtusername'];
$usertype		= $_POST['usertype'];
 $password	= generatePassword($length = 8);
//echo "---";
//session_start();
//echo $_SESSION['p'] = $password;
 $new_password	= md5($password);
//$new_password	= 'pa!@#098';

//var_dump($_POST);

if(!empty($usertype))
{
	if($usertype=='ebh_customer')
	{
		$database->select("SELECT 
		b.ref_id,
		a.ebh_customer_id, 
		b.user_id, 
		b.login_username, 
		b.login_password,
		b.user_display_name AS customer_name,professional_email_id,personal_email_id
		FROM tbl_ebh_customer AS a 
		INNER JOIN tbl_user_mst AS b ON a.ebh_customer_id = b.ref_id AND b.user_group_id=12
		WHERE b.is_active=1 AND (a.personal_email_id='".$login."' OR a.professional_email_id='".$login."')");
		$user_arr = $database->result;
	//	print_R($user_arr);
	}
	elseif($usertype=='corporate_hr')
	{
		$database->select("SELECT 
		b.ref_id,
		a.cluster_id, 
		b.user_id, 
		b.login_username, 
		b.login_password,
		a.hr_email_id,
		b.user_display_name AS customer_name
		FROM tbl_clusters AS a
		LEFT JOIN tbl_user_mst AS b ON a.cluster_id = b.ref_id and b.user_group_id=7
		WHERE b.is_active=1 AND (a.hr_email_id='".$login."')");
		$user_arr = $database->result;
	}
	else
	{
		$database->select("SELECT a.ref_id,a.login_username,b.ebh_customer_id,b.professional_email_id,b.personal_email_id,
		concat(b.salutation,' ',b.first_name,' ',b.middle_name,' ',b.last_name) AS customer_name
		FROM tbl_user_mst AS a
		LEFT JOIN tbl_ebh_customer AS b ON a.ref_id=b.ebh_customer_id
		WHERE b.professional_email_id='".$login."' OR b.personal_email_id='".$login."'");
		$user_arr = $database->result;
	}	

	/*
	$database->select("SELECT a.ref_id,a.login_username,b.ebh_customer_id,b.professional_email_id,b.personal_email_id,
	concat(b.salutation,' ',b.first_name,' ',b.middle_name,' ',b.last_name) AS customer_name
	FROM tbl_user_mst AS a
	LEFT JOIN tbl_ebh_customer AS b ON a.ref_id=b.ebh_customer_id
	WHERE b.professional_email_id='".$login."' OR b.personal_email_id='".$login."'");
	$user_arr = $database->result;
	*/
	//print_R($user_arr[0]);die;
	if(!empty($user_arr))
	{
		
	
		if($usertype=='corporate_hr'){
		    $to_email = $user_arr[0]['hr_email_id'] ;
		}else{
		    	$to_email = (!empty($user_arr[0]['professional_email_id'])) ? $user_arr[0]['professional_email_id'] : $user_arr[0]['personal_email_id'];
		}
		if(!empty($to_email))
		{
			$msg_tmpl = "<html><head></head><body><p>Dear ".$user_arr[0]['customer_name'].",</br> 
			As per your request, your password has been reset successfully.<br>
			Please go to <a href='https://www.easybuyhealth.com' target='_blank'>https://www.easybuyhealth.com</a> and log in with following information:</p>
			<p>Username: ".$user_arr[0]['login_username']."<br>
			Password: ".$password."</p>
			<p>Once you have logged in you will be able to change your password again from your Dashboard.</p>
			<p>If you have any questions, please do not hesitate to contact us at <a href='mailto:helpdesk@easybuyhealh.com' target='_blank'>helpdesk@easybuyhealh.com</a>.<br>
			Thanks for being part of EasyBuyHealth!</p>
			<p>------------------------------------------------
			<br>EasyBuyHealth Team</p></body></html>";
			//echo $msg_tmpl;
			if($user_arr[0]['ref_id']>0){
			$database->update("tbl_user_mst",array("login_password"=>$new_password)," user_id='".$user_arr[0]['user_id']."'");
			}
			$database->sendSmtpEmail('', $msg_tmpl, 'Password recovery', $to_email, $user_arr[0]['customer_name']);		
			
			if(!isset($_POST['ajaxlogin']))
			{
				$redirect = "https://www.easybuyhealth.com/accounts/".$_POST['referrer']."";
				header("Location: ".$redirect);
			}
			else
			{
				echo "New password sent to you by email";
			}
		}
		else
		{
			if(!isset($_POST['ajaxlogin']))
			{
				//$redirect = "https://www.easybuyhealth.com/accounts/".$_POST['referrer']."/password-recovery/error";
				$redirect = "https://www.easybuyhealth.com";
				header("Location: ".$redirect);
			}
			else
			{
				echo "Invalid Details";
			}
		}
	}
	else
	{
		if(!isset($_POST['ajaxlogin']))
		{
			//$redirect = "https://www.easybuyhealth.com/accounts/".$_POST['referrer']."/password-recovery/error";
			$redirect = "https://www.easybuyhealth.com";
			header("Location: ".$redirect);
		}
		else
		{
			echo '<span for="txtusername" class="help-inline text-danger">Entered Email ID is not registered on our website</span>';
		}
	}
}
else
{
	echo "Invalid Details1";
}
?>