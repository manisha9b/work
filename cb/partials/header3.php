<?php 
session_start();
include_once('includes/define.php');
 include_once('classes/Class_Database.php'); 
 global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta'); 
//print_r($_SESSION);die;
$url_filename = basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']);
	$url_page = explode('.',$url_filename);
	$url_page = $url_page[0];
if(!isset($_SESSION['ref_id']) || !isset($_SESSION['cluster_type']) || !isset($_SESSION['user_id']) || $_SESSION['cluster_type']=='' || $_SESSION['user_id']=='')
{
	header("Location: ".HTTP_SERVER);
}else if(isset($_SESSION['show_reset_password']) && $_SESSION['show_reset_password']==1 && $url_page!='reset_password')
{
	header("Location: ".HTTP_SERVER."reset_password.php");
}
else
{
    	$user_id						=	$_SESSION['ref_id'];
if($url_page=='reset_password' ){
    
    $userArr = ($user_id)?$database->getTableForHsp('tbl_user_mst', "user_id='$user_id'"):[];
    //print_R($userArr);
    if($userArr[0]['is_password_changed']==1){
        unset($_SESSION['show_reset_password']);
        header("Location: ".HTTP_SERVER."dashboard.php");
    }
    
}	

	$user_group_id					=	$_SESSION['user_group_id'];	
	$clusterId						=	$_SESSION['cluster_id'];
	$cluster_user_id				=	$_SESSION['cluster_user_id'];
	$arr_cluster	=	$database->getClusters($clusterId);	
	$arr_cluster	=	$arr_cluster[0];	
	$page_id= 'home';
	$dataUser = ($clusterId)?$database->getTableForHsp('tbl_cluster_users', "cluster_user_id='$cluster_user_id'"):[];
	//$clusterUserId					=	$dataUser[0]['cluster_user_id'];
	$HRdisplayName					=	$dataUser[0]['user_name'];
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>EBH | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <?php if($url_page == 'reset_password'){ ?>
	  <link rel="stylesheet" href="dist/css/style1.css">
	<?php }
	?>
  
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="dist/css/animate.css">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="dist/css/select2.css">	
	<?php
	if($url_page == 'profile'){ ?>
		 
	<?php 
	include_once('profile_css.php');
	$page_id='myprofile'; 
	}
	if($url_page == 'reset_password'){ 
	include_once('reset_password_css.php');
	$page_id='reset_password'; ?>
	  <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link href="dist/css/sliderResponsive.css" rel="stylesheet" type="text/css">
			 
	<?php  }
	?>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body id="<?php echo $page_id?>" class="hold-transition skin-blue sidebar-mini">
<?php 
include_once('body_header.php');
include_once('sidebar.php');
?>