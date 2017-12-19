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
$user_id						=	$_SESSION['ref_id'];
	$user_group_id					=	$_SESSION['user_group_id'];	
	$clusterId						=	$_SESSION['cluster_id'];
	$cluster_user_id						=	$_SESSION['cluster_user_id'];
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
						 break;
	case 'package_request':
						ini_set("display_errors", "1");
  error_reporting(E_ALL);
						 $type 		= isset($_POST['type'])?$_POST['type']:''; 
						 switch($type){
						     case'bp':$section = 'Blood Pressure';break;
						     case'bs':$section = 'Blood Sugar';break;
						     case'bmi':$section = 'BMI';break;
						 }
						 $sql = "INSERT INTO `tbl_package_request` ( 	type, cluster_user_id, created_on) VALUES ('$type', '$cluster_user_id' , NOW()) ";
						 @mysql_query($sql) or die(mysql_error());
						
						$dataUser = ($clusterId)?$database->getTableForHsp('tbl_clusters', "cluster_id='$clusterId'"):[];
					
						$email_header="<html><head></head><body>";
                        $content="<table>
                                        <tr><td>Cluster :</td><td>".$dataUser[0]['cluster_business_name']."</td></tr>
                                        <tr><td>HR :</td><td>".$dataUser[0]['hr_email_id']."</td></tr>
                                        <tr><td>Date :</td><td>".date('d M,Y h:i A')."</td></tr>
                                        <tr><td>Section :</td><td>$section</td></tr>
                                        </table>";
						
						$email_footer="</body></html>";		

$email_content	=	$email_header.$content.$email_footer;
$subject="Health Package Request";
$to_email ="manisha.yadav@easybuyhealth.com";
$first_name = 'EBH';
$database->sendSmtpEmail('', $email_content, $subject, $to_email, $first_name);	
						 $result['success'] = true;
						 echo json_encode($result);die;
						 break;
						 
}