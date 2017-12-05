<?php
/*EMAIL CONTENT*/
$vcode 			= sha1($cluster_package_id."~".$emp_id."~".$cluster_id);
$verification_link = WEBSITE_URL."verify.php?v=".$vcode;

$key = 'AIzaSyBQUUWYNpLdqZKjeVXVucTSAGywOKZ48kc';
$googer = new GoogleURLAPI($key);

// Test: Shorten a URL
$shortDWName = $googer->shorten($verification_link);
//echo $shortDWName; // returns http://goo.gl/i002

$arr_emp_sms	=	$database->getClusterEmp($cluster_id,$emp_id);
$first_name		= 	$arr_emp_sms[0]['first_name'];

$sms_message	=	"Hi ".$first_name.", ".$cluster_business_name." has gifted you a Preventive Healthcare Package. Click on ".$shortDWName." to know more and download  eVoucher. Regards, ".$hr_full_name.",HR,".$cluster_business_name;
		
$url="https://myvaluefirst.com/smpp/sendsms?username=affordhttp&password=afford123&to=".$mobile_no."&from=EBHLTH&udh=0&text=".urlencode($sms_message)."&dlr-mask=19";
$f_content = file_get_contents($url);

?>