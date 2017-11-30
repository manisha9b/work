<?php
ob_start();
session_start();
include_once '../../../../includes/define.php';
include '../../../../classes/Class_Database.php';
include '../../../../classes/PHPExcel/IOFactory.php';

global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

$cluster_id	=	$_SESSION['cluster_id'];
$created_by	=	$_SESSION['ref_id'];
$created_on	=	date("Y-m-d H:i:s");

if(!empty($_FILES['fileupload']['name']))
{
	$uploaddir		=	'../../../media/cluster-emp-excel/';
	$live_url		=	HTTP_SERVER.'/media/cluster-emp-excel/';
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
		
				
		//$inSheet = $sheet->toArray(null,true,true,true);
		//$firstinsheet = array_shift($inSheet);		
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
			
			$allerrors=0;	
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
					$phone_err[] = $row_id;
					$allerrors = 1;
				}
			}
			
			/*added By sujeet*/
			if(!empty($professional_email_id))
			{
				$email_check = $database->getTableForHsp("tbl_cluster_employee", "professional_email_id = '".$professional_email_id."'");
				if(!empty($email_check))
				{
					$email_err[] = $row_id;
					$allerrors = 1;
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
			}
		}

		if(!empty($empty_err))
		{
			foreach($empty_err as $rows)
			{
				$empty_rows .= $rows.', ';
			}
			$err_array[] = "In row(s) #".$empty_rows." empty mandatory fields. ";
		}
		
		if(!empty($phone_err))
		{
			foreach($phone_err as $rows)
			{
				$phone_errs .= $rows.', ';
			}
			$err_array[] = "In row(s) #".$phone_errs." duplicate mobile numbers. ";
		}
		
		/*Added By Sujeet*/
		if(!empty($email_err))
		{
			foreach($email_err as $rows)
			{
				$email_errs .= $rows.', ';
			}
			$err_array[] = "In row(s) #".$email_errs." duplicate email. ";
		}
		/*end*/
		
		if(!empty($err_array))
		{
			echo "<div class=\"alert alert-danger alert-dismissable\">			
			<strong>Errors:</strong> ";
			foreach($err_array as $errors)
			{
				echo $errors;
			}
			echo"<hr>
			<p>Added ".$ok."/".$arrayCount." rows...</p>
			<p>&nbsp;</p>
			<p><a href=\"".HTTP_SERVER."portal/cindex.php?page=my_employees\" class=\"btn btn-danger\" id=\"alert-dismiss\">Close</a></p>
			</div>\n";
		}
        else
        {
			echo "<div class=\"alert alert-success alert-dismissable\">
			<p>New employee added successfully!</p>
			<hr>
			<p>Added ".$ok."/".$arrayCount." rows...</p>
			<p>&nbsp;</p>
			<p><a href=\"".HTTP_SERVER."portal/cindex.php?page=my_employees\" class=\"btn btn-success\" id=\"alert-dismiss\">OK</a></p>
			</div>\n";
		}
	}
	else
	{
		die('Error loading file ...');
	}
}
else
{
	die('Error loading file ...');
}
?>