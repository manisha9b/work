<?php
ob_start();
session_start();
//print_R($_SESSOIN);die;
//session_start();
session_unset();
session_set_cookie_params(0, '/', 'easybuyhealth.com');
//session_start();
include_once '../includes/define.php';
include '../classes/Class_Database.php';
global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

$success=0;
$login = $_POST['txtusername'];
$password = $_POST['txtpassword'];
 $password_md5 = md5($password);
/*Cluster Specific Login*/
$clusterid = $_POST['clusterid'];
$cluster_query='';
if(!empty($clusterid))
{
	$cluster_query=" and d.cluster_id=".$clusterid;
}
/*END */

$sql="SELECT
	a.user_id,a.ref_id,a.user_display_name,b.user_group,a.user_group_id,
	case
		when a.user_group_id=2 then c.emp_email 
		when a.user_group_id=7 then d.business_email_id 
		when a.user_group_id=15 then h.user_email 
		when a.user_group_id=16 then h.user_email
	end as user_email,
	case
		when a.user_group_id=15 then h.user_mobile 
		when a.user_group_id=16 then h.user_mobile
	end as user_mobile,
	case 
		when a.user_group_id=7 then d.cluster_id
		when a.user_group_id=15 then h.cluster_id	
		when a.user_group_id=16 then h.cluster_id
	end as cluster_id,
	case 
		when a.user_group_id=7 then d.cluster_type
		when a.user_group_id=15 then i.cluster_type	
		when a.user_group_id=16 then i.cluster_type
	end as cluster_type, 
	e.branch_id as hsp_branch_id,
	f.branch_name,
	f.hspid as hsp_id
	from tbl_user_mst as a
	left join tbl_user_group as b on a.user_group_id = b.user_group_id
	left join tbl_ebh_employee_mst as c on a.ref_id = c.employee_id and a.user_group_id=2 
	left join tbl_clusters as d on a.ref_id = d.cluster_id and a.user_group_id=7 ".$cluster_query." 

	left Join tbl_hsp_branch_employees as e on a.ref_id= e.id and a.user_group_id=13
	left join tbl_hsp_branchs as f on e.branch_id = f.branch_id
	left join tbl_cluster_users as h on a.ref_id = h.cluster_user_id and a.user_group_id=15 OR a.ref_id = h.cluster_user_id and a.user_group_id=16 
	left join tbl_clusters as i on h.cluster_id = i.cluster_id 
	where a.login_username='".$login."' and (a.login_password='".$password."')  and a.is_active=1 OR a.login_username='".$login."' and  a.login_password='".md5($password)."' and a.is_active=1 and (a.user_group_id=2 and a.user_group_id=7 and a.user_group_id=15 and a.user_group_id=16)";

$database->select($sql);
$arr=$database->result;
//echo "<pre>".print_r($arr)."</pre>";
//exit;
//echo "<br>_____<br>";
//echo count($arr);
if(!empty($arr))
{
	
	$_SESSION['ref_id']				=	$arr[0]['ref_id'];
	$_SESSION['user_id']			=	$arr[0]['user_id'];
	$_SESSION['user_group']			=	$arr[0]['user_group'];
	$_SESSION['user_group_id']		=	$arr[0]['user_group_id'];
	$_SESSION['user_display_name']	=	$arr[0]['user_display_name'];
	$_SESSION['user_email']			=	$arr[0]['user_email'];
	$_SESSION['user_mobile']		=	$arr[0]['user_mobile'];
	$_SESSION['cluster_id']			=	$arr[0]['cluster_id'];

	$_SESSION['hsp_branch_id']		=	$arr[0]['hsp_branch_id'];
	$_SESSION['hsp_id']				=	$arr[0]['hsp_id'];
	$_SESSION['branch_name']		=	$arr[0]['branch_name'];

	$_SESSION['cluster_type']		=	$arr[0]['cluster_type'];
	
	if(isset($_POST['referrer'])!='')
	{
		$_SESSION['web-login']=1;
		$_SESSION['client']=$_POST['referrer'];
	}
	else
	{
		$_SESSION['web-login']=0;
	}
	
	if(isset($_POST['ajaxlogin']))
	{
		$_SESSION['web-login']=1;
	}
	
	//echo "<pre>".print_r($_SESSION)."</pre>";
	//exit;
	$j_date=date('Y-m-d H:i:s');
	$crm_ref_id=$_SESSION['ref_id'];
	$insert_details="insert into crm_login_details (user_id,login_date,server) VALUES ('".$crm_ref_id."','".$j_date."','Web')";
	mysql_query($insert_details);
	$sess=mysql_insert_id();

	$database->update("tbl_user_mst",array('is_online'=>'1','login_on'=>$j_date)," user_id='".$crm_ref_id."'");

 	$database->insert("crm_working_status_log",array('0','1',$crm_ref_id,$crm_ref_id,$j_date),"prev_working_status_id,current_working_status_id,crm_user_id,created_by,created_on");

	$_SESSION["working_status_id"]="1";
	$_SESSION['user_session_id']=$sess;
	$_SESSION['user_session_login_date']=$j_date;

	$redirect_page=HTTP_SERVER."dashboard.php";
	
		/*if($arr[0]['user_group_id']==7)
		{
			$redirect_page=HTTP_SERVER."portal/cindex.php";
		}
		elseif($arr[0]['user_group_id']==12)
		{
			//$redirect_page=HTTP_SERVER."portal/eindex.php";		
			//$redirect_page=HTTP_SERVER."caccount.php";
			$redirect_page="".WEBSITE_URL."/myaccount/";
		}
		elseif($arr[0]['user_group_id']==11)
		{
			$redirect_page=HTTP_SERVER."portal/hindex.php";
		}
		elseif($arr[0]['user_group_id']==13)
		{			
			$redirect_page=HTTP_SERVER."account.php";
		}
		elseif($arr[0]['user_group_id']==15)
		{			
			$redirect_page=HTTP_SERVER."portal/cindex.php";
		}
		elseif($arr[0]['user_group_id']==16)
		{			
			$redirect_page=HTTP_SERVER."portal/cindex.php";
		}
		*/
		if(!isset($_POST['ajaxlogin']))
		{
			header("Location: ".$redirect_page);
		}
		else
		{
			echo "<script>document.location = '".$redirect_page."'</script>";
		}
}
else
{
	if(isset($_POST['referrer']))
	{
		header("Location: ".WEBSITE_URL."/accounts/".$_POST['referrer']."/error");
	}
	else
	{
		if(!isset($_POST['ajaxlogin']))
		{
			header("Location: ".HTTP_SERVER."index.php?message=wrong_passowrd");
		}
		else
		{
			echo "Invalid Login Credentials";
		}
	}
}

ob_flush();
?>