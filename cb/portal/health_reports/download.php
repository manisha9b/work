<?php
ob_start();
session_start();
include_once '../../../../includes/define.php';
include '../../../../classes/Class_Database.php';

global $database;
$database=new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(isset($_GET['claster_id']) && !empty($_GET['claster_id']))
{
$fname		=	$_GET['name'];
$fgender	=	$_GET['gender'];
$fbmi		=	$_GET['bmi'];
$fpackage	=	$_GET['package'];

$arr_cluster		=	$database->getClusters($_GET['claster_id']);
$arr_cluster_pack	=	$database->getclusterEbhPackage($_GET['claster_id']);
$arr_cluster_empl	=	$database->getclusterEbhPackageEmployee($_GET['claster_id']);

$cluster_business_name = $arr_cluster[0]['cluster_business_name'];
$cluster_business_name = str_replace(' ', '_', $cluster_business_name);

/** Include PHPExcel */
require_once '../../../../phpexcel/Classes/PHPExcel.php';

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
            ->setCellValue('B1', 'EMP Name')
            ->setCellValue('C1', 'Date of visit')
			->setCellValue('D1', 'Package Name')
			->setCellValue('E1', 'Height')
			->setCellValue('F1', 'Weight')
			->setCellValue('G1', 'BMI Result')
			->setCellValue('H1', 'BP')
			->setCellValue('I1', 'Pulse rate')
			->setCellValue('J1', 'Resp. rate')
			->setCellValue('K1', 'Temperature');

foreach($arr_cluster_empl as $key => $row)
 {
	$package_name = $database->getclusterEbhPackage($_GET['claster_id'], $row['cluster_package_id']);

	$col_no=2;
	$a= "A".($col_no+$key);
	$b= "B".($col_no+$key);
	$c= "C".($col_no+$key);
	$d= "D".($col_no+$key);
	$e= "E".($col_no+$key);
	$f= "F".($col_no+$key);
	$g= "G".($col_no+$key);
	$h= "H".($col_no+$key);
	$i= "I".($col_no+$key);
	$j= "J".($col_no+$key);
	$k= "K".($col_no+$key);

	$emp_name = "".$row['salutation']." ".$row['first_name']." ".$row['last_name']."";

	$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue($a, ($key+1))
	->setCellValue($b, $emp_name)
	->setCellValue($c, $row['visited_on'])
	->setCellValue($d, $package_name[0]['package_nm'])
	->setCellValue($e, $row['height'])
	->setCellValue($f, $row['weight'])
	->setCellValue($g, $row['bmi'])
	->setCellValue($h, $row['bp'])
	->setCellValue($i, $row['pulse_rate'])
	->setCellValue($j, $row['resp_rate'])
	->setCellValue($k, $row['temperature']);
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
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Employees Health Reports');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$cluster_business_name.'-emp-health-reports-'.date('Ymdhis').'.xls"');
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