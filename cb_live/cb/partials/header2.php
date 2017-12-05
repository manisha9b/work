<!DOCTYPE html>
<?php 
session_start();
include_once('includes/define.php');
 include_once('classes/Class_Database.php'); 
 global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta'); 
//print_r($_SESSION);die;
if(!isset($_SESSION['ref_id']) || !isset($_SESSION['cluster_type']) || !isset($_SESSION['user_id']) || $_SESSION['cluster_type']=='' || $_SESSION['user_id']=='')
{
	header("Location: ".HTTP_SERVER);
}
else
{
	$user_id						=	$_SESSION['ref_id'];
	$user_group_id					=	$_SESSION['user_group_id'];	
	$clusterId						=	$_SESSION['cluster_id'];
	$arr_cluster	=	$database->getClusters($clusterId);	
	$arr_cluster	=	$arr_cluster[0];	
}
 ?>
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
  <link rel="stylesheet" href="dist/css/style_cluster.css">
  <link rel="stylesheet" href="dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="dist/css/select2.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="dist/css/animate.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">		<link href="https://fonts.googleapis.com/css?family=Raleway:400,300,600,800,900" rel="stylesheet" type="text/css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
 </head>
<body id="home" class="hold-transition skin-blue sidebar-mini">
<?php 
include_once('body_header.php');
include_once('sidebar.php');
?>
