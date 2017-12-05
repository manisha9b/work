<?php 

ini_set("display_errors", "1");
  error_reporting(E_ALL);
session_start();
include_once('includes/define.php');
 include_once('classes/Class_Database.php'); 

 global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta'); 

if(!isset($_SESSION['ref_id']))
{
	header("Location: ".HTTP_SERVER);
}
//PRINT_r($_POST);
$action = $database->getControllerAction('view');
//print_r($_POST);
//echo $action;die;
switch($action) {
	case 'save_goal':
						
						 $steps 		= isset($_POST['steps'])?$_POST['steps']:''; 		
						 $sleep 		= isset($_POST['sleep'])?$_POST['sleep']:''; 	
						 $cluster_id 	= isset($_POST['cluster_id'])?$_POST['cluster_id']:''; 	
						
										
						 
						  $sql = "INSERT INTO `tbl_cluster_goal` (`cluster_id`,  `steps`, `sleep`, `cdate`) VALUES ($cluster_id, '$steps' , '$sleep',NOW()) ON DUPLICATE KEY UPDATE steps=$steps,`sleep`='$sleep',udate= NOW()";
						 @mysql_query($sql) or die(mysql_error());
						
						 $result['steps'] = $steps;
						 $result['sleep'] = $sleep;
						
						
						 echo json_encode($result);die;
}