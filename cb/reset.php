<?php
ob_start(); 
session_start();
include_once 'includes/define.php';
include 'classes/Class_Database.php';
global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta'); 
$success=0;
$code = $_POST['txtvcode'];
$code = '8f69d812ceb00cbedb6b0e1272bf5dc41112e841';
$sql="SELECT
	a.user_id,a.ref_id,a.user_display_name,b.user_group,a.user_group_id,
	case
		when a.user_group_id=2 then c.emp_email 
		when a.user_group_id=17 then h.user_email  
		when a.user_group_id=15 then h.user_email 
		when a.user_group_id=16 then h.user_email
	end as user_email,
	case
		when a.user_group_id=15 then h.user_mobile 
		when a.user_group_id=16 then h.user_mobile
		when a.user_group_id=17 then h.user_mobile
	end as user_mobile,
	case 
		when a.user_group_id=17 then h.cluster_id
		when a.user_group_id=15 then h.cluster_id	
		when a.user_group_id=16 then h.cluster_id
	end as cluster_id,
	case 
		
		when a.user_group_id=15 then i.cluster_type	
		when a.user_group_id=16 then i.cluster_type
		when a.user_group_id=17 then i.cluster_type
	end as cluster_type, 
	e.branch_id as hsp_branch_id,
	f.branch_name,
	f.hspid as hsp_id
	from tbl_user_mst as a
	left join tbl_user_group as b on a.user_group_id = b.user_group_id
	left join tbl_ebh_employee_mst as c on a.ref_id = c.employee_id and a.user_group_id=2 

	left Join tbl_hsp_branch_employees as e on a.ref_id= e.id and a.user_group_id=13
	left join tbl_hsp_branchs as f on e.branch_id = f.branch_id
	left join tbl_cluster_users as h	 on a.ref_id = h.cluster_user_id and (a.user_group_id=15 or a.user_group_id=16  or a.user_group_id=17)
	left join tbl_clusters as i on h.cluster_id = i.cluster_id 
	where SHA1(concat(a.user_id,'~',a.ref_id,'~',a.login_username)) = '".$code."' and a.user_group_id=17
	and a.is_active=1";
		$database->select($sql);
$arr=$database->result;

		?>
<center>

  <div id="light-login" class="white_content_login" style="width:500px;height:500px;top:50px;line-height:30px;">
    <center>
      <div class="font_28 bold"><img src="<?php echo EBH_HTTP_SERVER;?>img/ebh-logo.png"></div>
    </center>
    <div id="login-div" style="margin-top:50px;">
      <form action="<?php echo HTTP_SERVER;?>scripts/activation-script.php" method="post" name="activate" >
		<input name="verify" type="hidden" id="verify"  value="<?php echo $_GET['v'];?>"/>
      </form>
    </div>
	<div class="loader"></div>
   <h3>Please wait while your account is being verified. <br></h3>
     </div>
  <div id="fade-login" class="black_overlay_login"></div>

</center>
<?php
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
	$_SESSION['cluster_user_id']	=	$arr[0]['cluster_user_id'];

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
	
	echo "<pre>".print_r($_SESSION)."</pre>";//die;
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
	$_SESSION['show_reset_password']=1;

	$redirect_page=HTTP_SERVER."reset_password.php";
	

		if(!isset($_POST['ajaxlogin']))
		{
			header("Location: ".$redirect_page);
		}
		else
		{
			echo $redirect_page;
			echo "<script>document.location = '".$redirect_page."'</script>";
		}
}
?>
<script language="javascript">
 //document.forms["activate"].submit();
</script>