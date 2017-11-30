<?php
/*EMAIL CONTENT*/
$vcode 			= sha1($cluster_package_id."~".$emp_id."~".$cluster_id);
$arr_emp_mail	=	$database->getClusterEmp($cluster_id,$emp_id);
$first_name = $arr_emp_mail[0]['first_name'];

$verification_link = "<a href='".WEBSITE_URL."verify.php?v=".$vcode."'>Download eVoucher</a>";

$email_header="<html><head></head><body>";

$content_head="Hi ".$first_name.",
<p>
	We at ".$cluster_business_name." care about your health & well being.</p>
	
	<p>It is with this in mind that we have partnered with EasyBuyHealth.com to provide you with a pre-paid (Preventive Healthcare) package.</p>
	
	<p>Its real simple and all you have to do is click on the link mentioned below.</p>

	<p>Once you Click on this link, you will see a page with all your details already filled in, and detailed information of the health package we have chosen for you and the health advantages.<p>

	<p>You will also see information on 'How & Where' you can avail of the package, its real simple!</p>

	<p>Your colleagues here at ".$cluster_business_name." and your family want to see you in good health always.
	Please feel free to contact ".$hr_full_name.". if you have any further questions about this.</p>

	<p>Go ahead and click on this link:<br>
	".$verification_link."</p>

	<p>For ".$cluster_business_name.",<br>
	".$hr_full_name."</p>";
		
$email_footer="</body></html>";		

$email_content	=	$email_header.$content_head.$mail_content_html.$content_footer.$email_footer;

$subject="Your HEALTH is Important to us!";
if($professional_email_id!='')
{
	$to_email	=	$professional_email_id;
}
else
{
	$to_email	=	$personal_email_id;				
}
//$to_email="easybuyhealthtest@gmail.com";
$database->sendSmtpEmail('', $email_content, $subject, $to_email, $first_name);	
/*
$err_log=fopen("error-email-log.txt", 'a');
fputs($err_log, date('Y-m-d H:i:s')."-".$_POST['clusterpkg']."-".$first_name;
fclose($err_log);
*/		
?>