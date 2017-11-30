<?php
ob_start();
session_start();
include_once '../../../includes/define.php';
include '../../../classes/Class_Database.php';

global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(isset($_GET['claster_id']) && !empty($_GET['claster_id']) && isset($_GET['list']) && !empty($_GET['list']))
{

	if($_GET['list'] == 'high_bp')
	{	
		unset($database->result);
		$sql="SELECT
		a.emp_id, 
		a.salutation,
		if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
		a.professional_email_id,
		a.personal_email_id,
		a.mobile_no,
		concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
		c.package_nm,
		e.bp_level
		FROM tbl_cluster_employee AS a
		LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
		LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
		LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
		WHERE a.ebh_customer_id<>'' AND a.cluster_id = '".$_GET['claster_id']."' AND e.bp_level<>'' AND e.bp_level='High'";
		$database->select($sql);
		$data_arr = $database->result;
		
		$category = 'High';
	}
	elseif($_GET['list'] == 'diabetes')
	{
		unset($database->result);
		$sql="SELECT
		a.emp_id, 
		a.salutation,
		if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
		a.professional_email_id,
		a.personal_email_id,
		a.mobile_no,
		concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
		c.package_nm,
		e.bs_result
		FROM tbl_cluster_employee AS a
		LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
		LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
		LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
		WHERE a.ebh_customer_id<>'' AND a.cluster_id = '".$_GET['claster_id']."' AND e.bs_result = 'Diabetes'";
		$database->select($sql);
		$data_arr = $database->result;
		
		$category = 'Diabetes';
	}
	elseif($_GET['list'] == 'pre-diabetes')
	{
		unset($database->result);
		$sql="SELECT
		a.emp_id, 
		a.salutation,
		if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
		a.professional_email_id,
		a.personal_email_id,
		a.mobile_no,
		concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
		c.package_nm,
		e.bs_result
		FROM tbl_cluster_employee AS a
		LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
		LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
		LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
		WHERE a.ebh_customer_id<>'' AND a.cluster_id = '".$_GET['claster_id']."' AND e.bs_result = 'Prediabetes'";
		$database->select($sql);
		$data_arr = $database->result;
		
		$category = 'Pre-Diabetes';
	}
	elseif($_GET['list'] == 'overweight')
	{
		unset($database->result);
		$sql="SELECT
		a.emp_id, 
		a.salutation,
		if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',a.first_name,' ',a.middle_name,' ',a.last_name), concat(a.salutation,' ',a.first_name,' ',a.last_name)) as emp_name,
		a.professional_email_id,
		a.personal_email_id,
		a.mobile_no,
		concat(b.appt_request_date,' ',b.appt_request_time) as appointment_date,
		c.package_nm
		FROM tbl_cluster_employee AS a
		LEFT JOIN tbl_appointments AS b ON b.appointment_id<>'' AND a.ebh_customer_id = b.ebh_customer_id
		LEFT JOIN tbl_ebh_pc_packages AS c ON c.ebh_package_id = b.ebh_package_id
		LEFT JOIN tbl_appointments_report AS e ON b.appointment_id = e.appointment_id
		WHERE a.cluster_id = '".$database->clusterId."' AND a.emp_bmi > '24.9'";
		$database->select($sql);
		$data_arr = $database->result;
		
		$category = 'Overweight';
	}
/** Include PHPExcel */
require_once '../../../phpexcel/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Add Properties
$objPHPExcel->getProperties()
			->setCreator("easyhuyhealth")
			->setLastModifiedBy("easyhuyhealth")
			->setTitle("Employees Health Reports")
			->setSubject("Employees Health Reports")
			->setDescription("Employees Health Reports")
			->setKeywords("Employees Health Reports")
			->setCategory("Employees Health Reports");

// Add Headers
$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A1', '#')
            ->setCellValue('B1', 'Name')
            ->setCellValue('C1', 'Gender')
			->setCellValue('D1', 'Email')
			->setCellValue('E1', 'Mobile')
			->setCellValue('F1', 'Appointment Date')
			->setCellValue('G1', 'Package')
			->setCellValue('H1', 'Category');


foreach($data_arr as $key => $row)
 {
	$gender	= $database->getClusterEmpGender($_GET['claster_id'], $row['emp_id']);
	$email	= (!empty($row['professional_email_id'])) ? $row['professional_email_id'] : $row['personal_email_id'];

	$col_no=2;
	$a= "A".($col_no+$key);
	$b= "B".($col_no+$key);
	$c= "C".($col_no+$key);
	$d= "D".($col_no+$key);
	$e= "E".($col_no+$key);
	$f= "F".($col_no+$key);
	$g= "G".($col_no+$key);
	$h= "H".($col_no+$key);	

	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($a, ($key+1))
	->setCellValue($b, $row['emp_name'])
	->setCellValue($c, $gender)
	->setCellValue($d, $email)
	->setCellValue($e, $row['mobile_no'])
	->setCellValue($f, $row['appointment_date'])
	->setCellValue($g, $row['package_nm'])
	->setCellValue($h, $category);	
 }

//Column Dimension
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Employees List');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$_GET['list'].'-'.date('Ymdhis').'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
ob_end_clean();
$objWriter->save('php://output');
exit;
}
?>