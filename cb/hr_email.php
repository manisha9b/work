<?php
//ob_start(); 
session_start();
include_once 'includes/define.php';
include 'classes/Class_Database.php';
global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta'); 
$success=0;
$sql="select SHA1(concat(m.user_id,'~',m.ref_id,'~',m.login_username))as id,m.user_id,`user_group_id`, `login_password`, `login_username`, `ref_id`, `user_display_name`, `user_contact`,u.user_email,tcase(u.user_name) as user_name  from tbl_user_mst m
 join tbl_cluster_users u on m.ref_id=u.cluster_user_id
 where m.user_group_id=17 and m.is_active=1 and m.user_id=3950;";
		$database->select($sql);
$arr=$database->result;
//echo "<pre>";
//echo file_get_contents("/home/easybuyhealth/public_html/EBH-emailer(HR)/index.html");

/*echo "<pre>";
print_R($arr);
echo "</pre>";*/
foreach($arr as $key=>$value){
    $name = str_replace('Ms.','',$value['user_name']);
     $name = str_replace('Mrs.','',$name);
      $name = str_replace('Mr.','',$name);
       $id = $value['id'];
       $url = HTTP_SERVER.'reset.php?vcode='.$id;
       ob_start();
include('../EBH-emailer(HR)/index.php');
$email_content = ob_get_contents();
ob_end_clean();
$subject="Your HEALTH is Important to us!";
$to_email = $value['user_email'];
$first_name = $name;
echo $email_content;
 //$database->sendSmtpEmail('', $email_content, $subject, $to_email, $first_name );	
 print_R($value);
}