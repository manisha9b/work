<?php
	include_once 'includes/define.php';
	include 'classes/Class_Database.php'; 
	global $database;
	$database = new Database();
	$database->connect();
	date_default_timezone_set('Asia/Calcutta');
/*$_POST['salutation'] = 'Mr.';
$_POST['firstname'] = 'API';
$_POST['lastname'] = 'TEST';
$_POST['email'] = 'test3@test.com';
$_POST['mobile'] = '4445333222';
$_POST['dob'] = '1988-10-02';
$_POST['weight'] = '70';
$_POST['height'] = '161';
$_POST['bp_systolic'] = '90';
$_POST['bp_diastolic'] = '60';*/

$salutation = isset($_POST['salutation'])?$_POST['salutation']:'';
$fname = isset($_POST['firstname'])?$_POST['firstname']:'';
$lname = isset($_POST['lastname'])?$_POST['lastname']:'';
$email = isset($_POST['email'])?$_POST['email']:'';
$mobile = isset($_POST['mobile'])?$_POST['mobile']:'';
$dob = isset($_POST['dob'])?$_POST['dob']:'';
$weight = isset($_POST['weight'])?$_POST['weight']:'';
$height = isset($_POST['height'])?$_POST['height']:'';
$systolic = isset($_POST['bp_systolic'])?$_POST['bp_systolic']:'';
$diastolic = isset($_POST['bp_diastolic'])?$_POST['bp_diastolic']:'';
$dob_arr = explode('-',$dob);
$dob = $dob_arr[2].'-'.$dob_arr[1].'-'.$dob_arr[0];
$cluster_id = 8;
$cluster_package_id = 34;
$hsp_id = 322;
$hsp_branch_id = 186;
$data = json_encode($_POST);
$returnArr= array();
$created_by 			=	"";
$created_on				=	date("Y-m-d H:i:s");
$created_time				=	date("H:i:s");
$bmi = '';
$bmi_category = '';
$returnArr['status']=0;
$sql = "Insert tbl_emp_api (data,created_on) value('$data','$created_on')";

if(!empty($height) && !empty($weight))
				{
					$height_hn	= ($height / 100);			
					$bmi	= ($weight / $height_hn / $height_hn);
					$bmi_category = '';
				
					if($bmi <= '18.5')
					{
						$bmi_category = 'Underweight';
					}
					elseif($bmi > '18.5' && $bmi <= '24.9')
					{
						$bmi_category = 'Normal';
					}
					elseif($bmi >= '25')
					{
						$bmi_category = 'Overweight';
					}
				}
				$bp_level = '';
					$bp_category = '';
				//	echo  "<br/>$systolic  || $diastolic<br/>";
					//var_dump ($systolic >= 90 && $systolic <= 120 && $diastolic > 59 && $diastolic < 79);
if(!empty($systolic) && !empty($diastolic))
				{
					
						
					if($systolic < 90 && $diastolic < 60)
					{
						$bp_level = 'Low';
						$bp_category = 'Lower than Normal';
					}
					elseif($systolic >= 90 && $systolic <= 120 && $diastolic > 59 && $diastolic < 79)
					{
						$bp_level = 'Normal';
						$bp_category = 'Normal Blood pressure range';
					}
					elseif($systolic >= 120 && $systolic <= 139 && $diastolic >= 80 && $diastolic <= 89)
					{
						$bp_level = 'High';
						$bp_category = 'Prehypertension';
					}
					elseif($systolic >= 140 && $systolic <= 159 && $diastolic >= 90 && $diastolic <= 99)
					{
						$bp_level = 'High';
						$bp_category = 'Stage 1 Hypertension';
					}
					elseif($systolic >= 160 && $diastolic >= 100)
					{
						$bp_level = 'High';
						$bp_category = 'Stage 2 Hypertension';
					}					
				}	
			//	echo "<br/>$bp_level,$bp_category<br/>";
if(!empty($email)){
 $sqlEmail = "SELECT * FROM tbl_cluster_employee WHERE (professional_email_id  = '".$email."' or personal_email_id = '".$email."') and cluster_id = '".$cluster_id ."'";
$exeEmail = mysql_query($sqlEmail);
$resEmail = mysql_num_rows($exeEmail);
}
if($resEmail > 0){
	$returnArr['error']=1;
	$returnArr['msg'] = 'Email Id is Already in use. Please try something new.';
}elseif(!empty($mobile)){
	$sqlmobile = "SELECT * FROM tbl_cluster_employee WHERE (mobile_no  = '".$mobile."') and cluster_id = '".$cluster_id ."'";
	$exemobile = mysql_query($sqlmobile);
	$resmobile = mysql_num_rows($exemobile);
	if($resmobile > 0){
		$returnArr['error']=1;
		$returnArr['msg'] = 'Mobile No. is Already in use. Please try something new.';
	}
}

if(!isset($returnArr['error'])){
	/*$database->insert("tbl_cluster_employee",
		array($cluster_id, $salutation, $fname, $lname,  $email,  $mobile, $dob,  '1',  $created_on),
		"cluster_id, salutation, first_name,  last_name,  professional_email_id,  mobile_no, emp_dob,   is_active, created_on");*/
		$password = 'ebh123';
	$sql="INSERT INTO tbl_cluster_employee(cluster_id, salutation, first_name,  last_name,  professional_email_id,  mobile_no, emp_dob,   is_active, created_on,emp_height,emp_weight) value ($cluster_id,'$salutation','$fname','$lname','$email','$mobile','$dob',  '1',  '$created_on','$height','$weight') ";
	mysql_query($sql);
	$emp_id = mysql_insert_id();
	$username = trim($fname).'.'.trim($lname).$emp_id;
	 
	 
	$sql="INSERT INTO tbl_cluster_employee_pack(cluster_id,cluster_package_id,emp_id,is_confirmed,confirmed_on,created_by,created_on) value ($cluster_id,$cluster_package_id,$emp_id,1,'$created_on','$created_by','$created_on') ";
	mysql_query($sql);
//	echo "<br/>";
	$emp_pack_id = mysql_insert_id();
	
	$sql="INSERT INTO tbl_ebh_customer(salutation,first_name,middle_name,last_name,current_designation,professional_email_id,personal_email_id,mobile_no,date_of_birth,c_height,c_weight,c_bmi,c_rbs,c_bp,city_name)  
	SELECT salutation,first_name,middle_name,last_name,emp_designation,professional_email_id,personal_email_id,mobile_no,emp_dob,emp_height,emp_weight,emp_bmi,emp_rbs,emp_bp,city 
	FROM tbl_cluster_employee WHERE emp_id='".$emp_id."'";
	mysql_query($sql);
	$ebh_customer_id = mysql_insert_id();
	 
	$sql="INSERT INTO tbl_user_mst(user_group_id,ref_id,login_username,login_password,is_active,created_on) value (12,$ebh_customer_id,'$username','$password',1,'$created_on') ";
	mysql_query($sql);
	$user_id = mysql_insert_id();
	
//echo "<br/>";
	$database->update("tbl_cluster_employee",array("ebh_customer_id"=>$ebh_customer_id)," emp_id='".$emp_id."'");
	
//	echo "<br/>";
		 $sql_appt="	INSERT into tbl_appointments(appt_voucher_code,ebh_customer_id,hsp_id,appt_source,ebh_package_id,appt_request_date,appt_request_time,appt_status,verified_on,appt_schedule_date,appt_schedule_time,hsp_id,hsp_branch_id)			
							SELECT concat(DATE_FORMAT(NOW(),'%Y%m%d'),(SELECT (max(appointment_id)+1) as total_apt from tbl_appointments)) as voucher_code,b.ebh_customer_id,d.hsp_id,'cluster' as appt_source,d.package_id ,'$created_on','$created_time','Visited','$created_on','$created_on','$created_time','$hsp_id','$hsp_branch_id'
							from tbl_cluster_employee_pack as a
							LEFT JOIN tbl_cluster_employee as b on a.emp_id = b.emp_id
							LEFT JOin tbl_cluster_packages as d on a.cluster_package_id = d.cluster_package_id
							LEFT JOIN tbl_appointments as e on a.appointment_id = e.appointment_id
							where a.emp_id='".$emp_id."'";;
				mysql_query($sql_appt);	
				$appt_id=mysql_insert_id();	
				$database->update("tbl_cluster_employee_pack",array("appointment_id"=>$appt_id,"is_confirmed"=>1,"confirmed_on"=>date("Y-m-d h:i:s"))," sr_no='".$emp_pack_id."'");
				
				$sql="INSERT INTO tbl_ebh_customer_health_readings(ebh_customer_id, recorded_on, height,  weight,  bmi,  bmi_category, bs_result, systolic,   diastolic, bp_level, bp_category) value ($ebh_customer_id,'$created_on','$height','$weight','$bmi','$bmi_category','$bs_result','$systolic', '$diastolic',  '$bp_level','$bp_category') ";
	mysql_query($sql);
	
	$sql="INSERT INTO tbl_appointments_report(appt_id, recorded_on, height,  weight,  bmi,  bmi_category, bs_result, systolic,   diastolic, bp_level, bp_category) value ($appt_id,'$created_on','$height','$weight','$bmi','$bmi_category','$bs_result','$systolic', '$diastolic',  '$bp_level','$bp_category') ";
	mysql_query($sql);

	/* CODE ADDED FOR SMS / EMAIL*/
	$email_header="<html><head></head><body>";
	$mail_content_html='
	<table cellpadding="0" cellspacing="0" style="margin:0 auto;" width="600">
		<tbody>
			<tr>
				<td style="border:1px solid #d1d1d1; padding:10px 20px 30px 20px;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tbody>
						<tr>
							<td align="center"><img alt="" border="0"  src="http://easybuyhealth.com/ebhconsole/images/ebh-logo.png"/>
							<hr style="display:block; height:7px; background:#2cb3c0; border:none;" /></td>
						</tr>
						<tr>
							<td style="text-align:LEFT; font-size:16px; font-weight:bold; color:#231f20; font-family:Arial, Helvetica, sans-serif; padding-top:10px; padding-bottom:10px;">Dear '.$fname.',</td>
						</tr>
						<tr>
							<td style="padding-top:20px; font-size:16px; color:#808285; font-family:Arial, Helvetica, sans-serif;">
							<p style="line-height:25px;">Congratulations! Now you are a registered member on&nbsp;EasyBuyHealth.com.</p>

							<p style="line-height:25px;">Please log into your account with mentioned below details and change your password after first login.</p>

							<p style="line-height:25px;">
							Link : https://www.easybuyhealth.com <br>
							User Name : <strong>'.$username.'</strong><br>
							Password : <strong>'.$password.'</strong></p>

							<p style="line-height:25px;">Best Wishes,<br />
							Team EasyBuyHealth</p>
							</td>
						</tr>
						<tr>
							<td align="center" style="padding-top:20px">
							<hr style="display:block; height:7px; background:#2cb3c0; border:none;" />
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody>
									<tr>
										<td style="font-size:14px; color:#808285; font-family:Arial, Helvetica, sans-serif;">Affordable Health Services P. Ltd.</td>
									</tr>
								</tbody>
							</table>
							</td>
						</tr>
					</tbody>
				</table>
				</td>
			</tr>
		</tbody>
	</table>
	';
	$email_footer="</body></html>";		
	$email_content	=	$email_header.$content_head.$mail_content_html.$content_footer.$email_footer;

	$subject=" Congratulations! Your EasyBuyHealth account details!";

	//$email = "sujeet.karn@easybuyhealth.com";
	$database->sendSmtpEmail('', $email_content, $subject, $email, $fname);		

	/*SMS*/
	//$mobile='9930711084';
	$sms_message=	"Hi ".$fname.", Your Account at EasyBuyHealth is now ACTIVE. Access your Health Account, Purchase History and Browse Health Info at any time. Stay Healthy!"; 

	$url="https://myvaluefirst.com/smpp/sendsms?username=affordhttp&password=afford123&to=".$mobile."&from=EBHLTH&udh=0&text=".urlencode($sms_message)."&dlr-mask=19";

	$f_content = file_get_contents($url);
	
	/* END */
	
/*	echo "<br/>";
	echo $ebh_customer_health_readings = mysql_insert_id();
	echo "<br/>";*/
	$returnArr['status']=1;
}

//echo "<pre>";
echo json_encode($returnArr);
//echo "</pre>";



?>