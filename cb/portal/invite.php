<?php
ob_start();
session_start();
include_once '../includes/define.php';
include '../classes/Class_Database.php';
include '../../app/classes/class_google_api.php';
include('../../app/classes/upload_class.php');
include('../../app/classes/imageresizer.class.php');
include '../../app/classes/PHPExcel/IOFactory.php';

global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

$salutation 			= 	$_POST['emp_dr'];
$first_name 			= 	$_POST['emp_first_name'];
$last_name 				= 	$_POST['emp_last_name'];
$professional_email_id	= 	$_POST['pro_email_id'];
$mobile_no 				= 	$_POST['mobile_no'];
$is_active				= 	'1';

$created_by				=	$_SESSION['ref_id'];
$created_on				=	date("Y-m-d H:i:s");

$cluster_package_id		=	$_POST['cluster_package_id'];
$cluster_id				=	$_POST['cluster_id'];



/*GET CLUSTER INFORMATION*/
	$arr_cluster			= $database->getClusters($database->clusterId);
	$cluster_business_name	= $arr_cluster[0]['cluster_business_name'];
	$logo					= $arr_cluster[0]['logo'];
	$hr_full_name			= $arr_cluster[0]['hr_full_name'];
	$hr_email_id			= $arr_cluster[0]['hr_email_id'];
	$hr_mobile_no			= $arr_cluster[0]['hr_mobile_no'];
/*END */
//die;

if($_POST['clusterpkg'] == 'fileupload')
{
	$err_log=fopen("error_logs/error-log.txt", 'w');
	fclose($err_log);
	
	if(!empty($_FILES['fileupload']['name']))
	{
		$uploaddir 		= 	'../../app/portal/media/cluster-emp-excel/';
		$live_url		=	EBH_HTTP_SERVER.'member/media/cluster-emp-excel/';
		$ext			=	$database->findexts($file['name']);
		$file_name		=	$database->uploadFile('fileupload', $uploaddir.$file_name);
		
		if(file_exists($uploaddir.$file_name))
		{
			$ok  = 0;
			$allerrors = 0;
			$empty_err = array();
			$email_err = array();
			$email_exists_err = array();
			$phone_err = array();


			$xls = PHPExcel_IOFactory::load($uploaddir.$file_name);
			$xls->setActiveSheetIndex(0);
			$sheet = $xls->getActiveSheet();
			
			
			$maxCell = $sheet->getHighestRowAndColumn();
			$inSheet = $sheet->rangeToArray('A2:' . $maxCell['column'] . $maxCell['row'],NULL,TRUE,FALSE);
			$inSheet = array_map('array_filter', $inSheet);
			$inSheet = array_filter($inSheet);
			
			$arrayCount	= count($inSheet);
			
			foreach($inSheet as $ri => $cell)
			{
				$row_id					= ($ri+1);
				$salutation 			= trim($cell[0]);
				$first_name 			= trim($cell[1]);
				$middle_name 			= trim($cell[2]);
				$last_name 				= trim($cell[3]);
				$designation			= trim($cell[4]);
				$professional_email_id	= trim($cell[5]);
				$personal_email_id 		= trim($cell[6]);
				$mobile_number 			= trim($cell[7]);
				$dob					= trim($cell[8]);
				$height					= trim($cell[9]);
				
				$emp_name				= $salutation." ".$first_name." ".$middle_name." ".$last_name;
					
				if(empty($salutation))
				{
					$empty_err[] = $row_id;
					$allerrors = 1;
				}
				
				if(empty($first_name))
				{
					$empty_err[] = $row_id;
					$allerrors = 1;
				}
				
				if(empty($last_name))
				{
					$empty_err[] = $row_id;
					$allerrors = 1;
				}
				
				if(empty($mobile_number))
				{
					$empty_err[] = $row_id;
					$allerrors = 1;
				}
				else
				{
					$phone_check = $database->getTableForHsp("tbl_cluster_employee", "mobile_no = '".$mobile_number."'");
					if(!empty($phone_check))
					{
						//$phone_err[] = $row_id;
						$allerrors	= 1;
						$dublerror	= 1;
						
						$emp_id		= $phone_check[0]['emp_id'];						
						$emp_dup = $database->is_duplicate("cluster_id", "tbl_cluster_employee_pack", " cluster_package_id='".$cluster_package_id."' and emp_id='".$emp_id."'");
						
						if(empty($emp_dup))
						{
							$database->insert("tbl_cluster_employee_pack",
							array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
							"cluster_id,cluster_package_id,emp_id,created_by,created_on");
							
							$err_log=fopen("error_logs/error-log.txt", 'a+');
							fputs($err_log, "<p>".date('Y-m-d H:i:s')." <strong>".$emp_name."</strong> - The Invitation has been sent to the employee</p>\r\n");
							fclose($err_log);
							
							include 'send-sms.php';
							include 'send-email.php';
						}
						else
						{
							$err_log=fopen("error_logs/error-log.txt", 'a+');
							fputs($err_log, "<p>".date('Y-m-d H:i:s')." <strong>".$emp_name."</strong> - The package is already utilized by the employee</p>\r\n");
							fclose($err_log);
						}
					}
				}
				
				/*added By sujeet*/
				if(!empty($professional_email_id))
				{
					$email_check = $database->getTableForHsp("tbl_cluster_employee", "professional_email_id = '".$professional_email_id."'");
					if(!empty($email_check))
					{
						//$email_err[] = $row_id;
						$allerrors = 1;
						$dublerror = 1;
					}
				}
				/*end*/
				
				if($allerrors != 1)
				{
					$dateob = (!empty($dob)) ? date('Y-m-d', strtotime($dob)) : "";
					$database->insert("tbl_cluster_employee",
					array($cluster_id, $salutation, $first_name, $middle_name, $last_name, $designation, $professional_email_id, $personal_email_id, $mobile_number, $dateob, $height, '1', $created_by, $created_on),
					"cluster_id, salutation, first_name, middle_name, last_name, emp_designation, professional_email_id, personal_email_id, mobile_no, emp_dob, emp_height, is_active, created_by, created_on");				
					$ok++;
					$emp_id	= mysql_insert_id();

					$err_log=fopen("error_logs/error-log.txt", 'a+');
					fputs($err_log, "<p>".date('Y-m-d H:i:s')." <strong>".$emp_name."</strong> - Added to Package</p>\r\n");
					fclose($err_log);
					
					$emp_dup = $database->is_duplicate("cluster_id", "tbl_cluster_employee_pack", " cluster_package_id='".$cluster_package_id."' and emp_id='".$emp_id."'");				
					if(empty($emp_dup))
					{
						$database->insert("tbl_cluster_employee_pack",
						array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
						"cluster_id,cluster_package_id,emp_id,created_by,created_on");
						
						$err_log=fopen("error_logs/error-log.txt", 'a+');
						fputs($err_log, "<p>".date('Y-m-d H:i:s')." <strong>".$emp_name."</strong> - The Invitation has been sent to the employee</p>\r\n");
						fclose($err_log);
						
						include 'send-sms.php';
						include 'send-email.php';
					}
					else
					{
						$err_log=fopen("error_logs/error-log.txt", 'a+');
						fputs($err_log, "<p>".date('Y-m-d H:i:s')." <strong>".$emp_name."</strong> - The package is already utilized by the employee</p>\r\n");
						fclose($err_log);
					}
				}
				
				if($dublerror == 1)
				{
					$err_log=fopen("error_logs/error-log.txt", 'a+');
					fputs($err_log, "<p>".date('Y-m-d H:i:s')." <strong>".$emp_name."</strong> - Exist in employee list</p>\r\n");
					fclose($err_log);
				}
			}			
			
			if(!empty($empty_err))
			{
				foreach($empty_err as $rows)
				{
					$empty_rows .= $rows.', ';
				}
				$err_array[] = "In row <strong>#".$empty_rows."</strong> empty mandatory fields. ";
			}
			
			/*
			if(!empty($phone_err))
			{
				foreach($phone_err as $rows)
				{
					$phone_errs .= $rows.', ';
				}
				$err_array[] = "In row(s) #".$phone_errs." duplicate mobile numbers. ";
			}			
			
			if(!empty($email_err))
			{
				foreach($email_err as $rows)
				{
					$email_errs .= $rows.', ';
				}
				$err_array[] = "In row(s) #".$email_errs." duplicate email. ";
			}
			
			
			if(!empty($err_array))
			{
				$err_log=fopen("error_logs/error-log.txt", 'a+');
				foreach($err_array as $errors)
				{
					fputs($err_log, "<p>".date('Y-m-d H:i:s')." ".$errors);
				}				
				fclose($err_log);				
			}
			*/
			
			$redirect_page	=	HTTP_SERVER."package.php?m=isend";			
		}
		else
		{
			$redirect_page	=	HTTP_SERVER."package.php";
		}		
		header("location: ".$redirect_page);

/*		
		$error = false;
		$files = array();


		$uploaddir 		= 	'../../media/cluster-emp-excel/';
		$live_url		=	HTTP_SERVER.'member/media/cluster-emp-excel/';
		$ext			=	$database->findexts($file['name']);
		$file_name		=	$database->uploadFile('fileupload', $uploaddir.$file_name);

		try
		{
			$objPHPExcel = PHPExcel_IOFactory::load($uploaddir.$file_name);
		}
		catch(Exception $e)
		{
			die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
		}

		$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
		$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet
		$suceess=1;
		//echo $arrayCount;
		for($i=2;$i<=$arrayCount;$i++)
		{
			$salutation 			= trim($allDataInSheet[$i]["A"]);
			$first_name 			= trim($allDataInSheet[$i]["B"]);
			$middle_name 			= trim($allDataInSheet[$i]["C"]);
			$last_name 				= trim($allDataInSheet[$i]["D"]);
			$designation			= trim($allDataInSheet[$i]["E"]);
			$professional_email_id	= trim($allDataInSheet[$i]["F"]);
			$personal_email_id 		= trim($allDataInSheet[$i]["G"]);
			$mobile_no 				= trim($allDataInSheet[$i]["H"]);
			$dob					= ($dob!='')?date('Y-m-d',strtotime(trim($allDataInSheet[$i]["I"]))):"";
			$height					= trim($allDataInSheet[$i]["J"]);

			//Check Duplicate email
			if((trim($professional_email_id)!='' && filter_var($professional_email_id, FILTER_VALIDATE_EMAIL)) || (trim($personal_email_id)!='' && filter_var($personal_email_id, FILTER_VALIDATE_EMAIL)) || $mobile_no!='' )
			{
				$pro_email_exists=0;
				$per_email_exists=0;
				$mobile_exists	=0;
				
				$pro_email_error=0;
				echo "<br>";
				if($professional_email_id!='') 
				{
					$pro_email_exists = $database->is_duplicate("professional_email_id", "tbl_cluster_employee", " professional_email_id='".$professional_email_id."'");
					
					$pro_email_error=(intval($pro_email_exists)>0)?1:0;					
				}
				if($pro_email_error==1)
				{
					$msg.="\r\n Duplicate Professional Email: ".$professional_email_id." at ROW ".$i;
				}
				
				$per_email_error=0;	
				if($personal_email_id!='')
				{
					$per_email_exists = $database->is_duplicate("personal_email_id", "tbl_cluster_employee", " personal_email_id='".$personal_email_id."'");
					
					$per_email_error=(intval($per_email_exists)>0)?1:0;										
				}
				if($per_email_error==1)
				{
					$msg.="\r\n Duplicate Personal Email: ".$personal_email_id." at ROW ".$i;
				}			
				
				$mobile_error=0;
				if($mobile_no!='')
				{
					$mobile_exists = $database->is_duplicate("mobile_no", "tbl_cluster_employee", " mobile_no='".$mobile_no."'");
					
					$mobile_error=(intval($mobile_exists)>0)?1:0;
				}
				
				if($mobile_error==1)
				{
					$msg.="\r\n Duplicate Mobile : ".$mobile_no." at ROW ".$i;
				}
				
				//if($database->is_duplicate("professional_email_id", "tbl_cluster_employee", " professional_email_id='".$professional_email_id."'")==0)
				if($pro_email_error==0 && $per_email_error==0 && $mobile_error==0)
				{ 
					echo "HERE-1";
					//INSERT INTO tbl_cluster_employee
 						$database->insert("tbl_cluster_employee",array($cluster_id,$salutation,$first_name,$middle_name,$last_name,$designation,$professional_email_id,$personal_email_id,$mobile_no,$dob,1,$created_by,$created_on),
						"cluster_id,salutation,first_name,middle_name,last_name,emp_designation,professional_email_id,personal_email_id,mobile_no,emp_dob,is_active,created_by,created_on");
						$emp_id	= mysql_insert_id(); 
						//exit;
					//Insert record in tbl_cluster_employee_pack
						 $database->insert("tbl_cluster_employee_pack",
						array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
						"cluster_id,cluster_package_id,emp_id,created_by,created_on"); 

					//Code to send email to Employee
					//include 'send-sms.php';
					//include 'send-email.php';
					
					$err_log=fopen("error_logs/error-log.txt", 'a+');
					fputs($err_log, date('Y-m-d H:i:s')." ".$salutation." ".$first_name." ".$middle_name." ".$last_name." - Added to package\r\n");
					fclose($err_log);
				}
				else
				{
					//set message for already invited employees with employee name
					$err_log=fopen("error_logs/error-log.txt", 'a+');
					fputs($err_log, date('Y-m-d H:i:s')." ".$salutation." ".$first_name." ".$middle_name." ".$last_name." - The package is already utilized by the employee\r\n");
					fclose($err_log);
					
					echo "HERE-2";
					//Fetch Emp ID
					$pro_query='';
					if($professional_email_id!='')
					{
						$pro_query=" and professional_email_id='".$professional_email_id."'";
					}
					$per_query='';
					if($personal_email_id!='')
					{
						$per_query=" and personal_email_id='".$personal_email_id."'";
					}
					$mob_query='';
					if($mobile_no!='')
					{
						$mob_query=" and mobile_no='".$mobile_no."'";
					}					 
					
					unset($database->result);
					$sql="SELECT emp_id,mobile_no from tbl_cluster_employee where 1 ".$pro_query.$per_query.$mob_query;
					$database->select($sql);
					
					$arr	=	$database->result;
					
					
					if(count($arr)>0)
					{
						$emp_id		=	$arr[0]['emp_id'];
						$mobile_no	=	$arr[0]['mobile_no'];
						if($database->is_duplicate("cluster_id", "tbl_cluster_employee_pack", " cluster_package_id='".$cluster_package_id."' and emp_id='".$emp_id."'")==0)
						{
							//Insert record in tbl_cluster_employee_pack
							$database->insert("tbl_cluster_employee_pack",
							array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
							"cluster_id,cluster_package_id,emp_id,created_by,created_on");
							//Code to send email to Employee							
						}
						else
						{
							//set message for already invited employees with employee name
						}
					}
					else{
						//INSERT INTO tbl_cluster_employee
 						$database->insert("tbl_cluster_employee",array($cluster_id,$salutation,$first_name,$middle_name,$last_name,$designation,$professional_email_id,$personal_email_id,$mobile_no,$dob,1,$created_by,$created_on),
						"cluster_id,salutation,first_name,middle_name,last_name,emp_designation,professional_email_id,personal_email_id,mobile_no,emp_dob,is_active,created_by,created_on");
						$emp_id	= mysql_insert_id(); 
						//exit;
					//Insert record in tbl_cluster_employee_pack
						 $database->insert("tbl_cluster_employee_pack",
						array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
						"cluster_id,cluster_package_id,emp_id,created_by,created_on"); 
					}
					//include 'send-sms.php';
					//include 'send-email.php';					
					}
			}
			else
			{
				if(trim($professional_email_id)!='')
				{
					$msg.="\r\n Invalid Email: ".$professional_email_id." at ROW ".$i;
				}
			}
			$suceess++;

		}


		$content = ($msg!='')?date("Y-m-d h:i:s")." \r\n ".$msg:date("Y-m-d h:i:s")." \r\n No error found";

		$fp = fopen("../../error-log/import-error-".$cluster_id.".txt","wb");
		fwrite($fp,$content);
		fclose($fp);
		//exit;
		$redirect_page	=	HTTP_SERVER."portal/cindex.php?m=isend";
		if($suceess>1)
		{
			header("location:".$redirect_page);
		}
*/
	}

}
elseif($_POST['clusterpkg'] == 'newemp')
{
		$err_log=fopen("error_logs/error-log.txt", 'w');
		fclose($err_log);
		
		$database->insert("tbl_cluster_employee",
		array($cluster_id, $cluster_package_id, $salutation, $first_name, $last_name, $professional_email_id, $mobile_no, $is_active, $created_by, $created_on),
		"cluster_id, cluster_package_id, salutation, first_name, last_name, professional_email_id, mobile_no, is_active, created_by, created_on");
		$emp_id = mysql_insert_id();

		$emp_dup = $database->is_duplicate("cluster_id", "tbl_cluster_employee_pack", " cluster_package_id='".$cluster_package_id."' and emp_id='".$emp_id."'");
			
			
		if(empty($emp_dup))
		{
			$arr_emp	=	$database->getClusterEmp($cluster_id,$emp_id);

			$professional_email_id = $arr_emp[0]['professional_email_id'];
			$personal_email_id = $arr_emp[0]['personal_email_id'];
			$mobile_no = $arr_emp[0]['mobile_no'];

			//Insert record in tbl_cluster_employee_pack
			$database->insert("tbl_cluster_employee_pack",
			array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
			"cluster_id,cluster_package_id,emp_id,created_by,created_on");
			//Code to send email to Employee
			include 'send-sms.php';
			include 'send-email.php';
			
			$err_log=fopen("error_logs/error-log.txt", 'a+');
			fputs($err_log, "<p>".date('Y-m-d H:i:s')." ".$arr_emp[0]['emp_name']." - Added to package</p>");
			fclose($err_log);
		}
		else
		{
			$arr_emp	=	$database->getClusterEmp($cluster_id,$emp_id);
			
			//set message for already invited employees with employee name
			$err_log=fopen("error_logs/error-log.txt", 'a+');
			fputs($err_log, "<p>".date('Y-m-d H:i:s')." ".$arr_emp[0]['emp_name']." - The package is already utilized by the employee</p>");
			fclose($err_log);
			
		}

	$redirect_page	=	HTTP_SERVER."package.php?m=isend";
	header("location:".$redirect_page);
}
elseif($_POST['clusterpkg'] == 'empfromlist')
{
	$err_log=fopen("error_logs/error-log.txt", 'w');
	fclose($err_log);
	
	if($_POST['invite_bulk_action'] == 'invite')
	{
		if(!empty($_POST['empinv']))
		{
			$cluster_package_id = $_POST['invite_package'];
			
			foreach($_POST['empinv'] as $emp_id)
			{
				$emp_dup = $database->is_duplicate("cluster_id", "tbl_cluster_employee_pack", " cluster_package_id='".$cluster_package_id."' and emp_id='".$emp_id."'");
				
				if(empty($emp_dup))
				{
					$arr_emp	=	$database->getClusterEmp($cluster_id,$emp_id);
					$first_name = $arr_emp[0]['first_name'];
					$professional_email_id = $arr_emp[0]['professional_email_id'];
					$personal_email_id = $arr_emp[0]['personal_email_id'];
					$mobile_no = $arr_emp[0]['mobile_no'];
					
					
					//Insert record in tbl_cluster_employee_pack
					$database->insert("tbl_cluster_employee_pack",
					array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
					"cluster_id,cluster_package_id,emp_id,created_by,created_on");
					
					//Code to send email to Employee
					include 'send-sms.php';
					include 'send-email.php';
					
					$err_log=fopen("error_logs/error-log.txt", 'a+');
					fputs($err_log, "<p>".date('Y-m-d H:i:s')." ".$arr_emp[0]['emp_name']." - Added to package</p>");
					fclose($err_log);
				}
				else
				{
					$arr_emp	=	$database->getClusterEmp($cluster_id,$emp_id);
			
					//set message for already invited employees with employee name
					$err_log=fopen("error_logs/error-log.txt", 'a+');
					fputs($err_log, "<p>".date('Y-m-d H:i:s')." ".$arr_emp[0]['emp_name']." - The package is already utilized by the employee</p>");
					fclose($err_log);					
				}
			}
			$redirect_page	=	HTTP_SERVER."package.php?m=isend";
		}
		else
		{
			$redirect_page	=	HTTP_SERVER."package.php?m=isend_err";
		}

	}	
	header("location:".$redirect_page);
	//var_dump($_POST);
}
else
{
	$err_log=fopen("error_logs/error-log.txt", 'w');
	fclose($err_log);
	
	foreach($_POST['cluster_emp_id'] as $emp_id)
	{
		$emp_dup = $database->is_duplicate("cluster_id", "tbl_cluster_employee_pack", " cluster_package_id='".$cluster_package_id."' and emp_id='".$emp_id."'");
		
		if(empty($emp_dup))
		{
			$arr_emp	=	$database->getClusterEmp($cluster_id,$emp_id);

			$professional_email_id = $arr_emp[0]['professional_email_id'];
			$personal_email_id = $arr_emp[0]['personal_email_id'];
			$mobile_no = $arr_emp[0]['mobile_no'];

			//Insert record in tbl_cluster_employee_pack
			$database->insert("tbl_cluster_employee_pack",
			array($cluster_id,$cluster_package_id,$emp_id,$created_by,$created_on),
		"cluster_id,cluster_package_id,emp_id,created_by,created_on");
			
			//Code to send email to Employee
		//	include 'send-sms.php';
		//	include 'send-email.php';
			
			$err_log=fopen("error_logs/error-log.txt", 'a+');
			fputs($err_log, "<p>".date('Y-m-d H:i:s')." ".$arr_emp[0]['emp_name']." - Added to package</p>");
			fclose($err_log);
		}
		else
		{
			$arr_emp	=	$database->getClusterEmp($cluster_id,$emp_id);
			
			//set message for already invited employees with employee name
			$err_log=fopen("error_logs/error-log.txt", 'a+');
			fputs($err_log, "<p>".date('Y-m-d H:i:s')." ".$arr_emp[0]['emp_name']." - The package is already utilized by the employee</p>");
			
			fclose($err_log);
		}
		//print_r($arr_emp);die;
	}
	
	$redirect_page	=	HTTP_SERVER."package.php?m=isend";
	header("location:".$redirect_page);	
}
//echo json_encode($data);
?>