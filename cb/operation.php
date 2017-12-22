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
$clusterId						=	$_SESSION['cluster_id'];
$data = ($clusterId)?$database->getClusters($clusterId):[];
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
	case 'request_call':
	    /*ini_set("display_errors", "1");
  error_reporting(E_ALL);
	    print_r($data);*/
	   $data = $data[0];
	    //die;
    	    	                     
						 $organization 	= $data['cluster_business_name'];
					//	 $website 	= $data['cluster_business_name']; 	
							
						 $email 		= $data['hr_email_id'];
						 $mobile 		= $data['hr_mobile_no'];		
						 $designation 		= 'HR';
							
$first_name = $data['hr_full_name'];
$name = $first_name;
$lname = '';
                    	    $emp_size 		= isset($_POST['emp_size'])?$_POST['emp_size']:'';
                    	    $industry		= isset($_POST['industry'])?$_POST['industry']:'';
                            $sql = "INSERT INTO `tbl_request_call` (name,lname,`organization`,industry, `emp_size`, `mobile`, `email`,designation, `cdate`,cluster_user_id,cluster_id)
                            VALUES ('$name','$lname','$organization','$industry','$emp_size','$mobile','$email','$designation', NOW(),'$cluster_user_id',$clusterId)";
						 mysql_query($sql);
						//	echo  "Thank You! for your request.";
							echo '<div class="alert alert-success alert-dismissable" style="width:450px;margin-top:20px;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><p>Thank You! for your request.</p></div>;';
							$email_header="<html><head></head><body>";

							$content="Hi ".$first_name.",
							<p>
							
Thank you for your interest in our Employee Healthcare Management packages.
Our Sales Team will contact you within One Business Day to discuss your specific needs
</p>
Thanks,<br/>
Pankaj	<br/>
<a href=\"www.EasyBuyHealth.com\">www.EasyBuyHealth.com</a>";
								
							$email_footer="</body></html>";		

							 $email_content	=	$email_header.$content;
							$database->sendSmtpEmail('', $email_content, 'EasyBuyHealth: We\'ve Got Your Request!',  'manisha.yadav@easybuyhealth.com', $first_name);
							$email_content ="We have received a new enquiry:<br/> <table border=\"0\">
							<tr><td>Name</td><td>: $first_name</td></tr>
<tr><td>Organization</td><td>:$organization</td></tr>
<tr><td>Designation</td><td>:$designation</td></tr>
<tr><td>Employee Size</td><td>:$emp_size</td></tr>
<tr><td>Email</td><td>:$email</td></tr>

<tr><td>Mobile</td><td>:$mobile</td></tr>

<tr><td>Intrested in</td><td>:$industry</td></tr>
</table>";
							// $email_content	=	$email_header.$content;
							$database->sendSmtpEmail('', $email_content, 'New Enquiry', 'manisha.yadav@easybuyhealth.com', $first_name);
	    break;
						 
}