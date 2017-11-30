<?php
ob_start();
session_start();
include_once '../../../../includes/define.php';
include '../../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');

if(!empty($_GET['files']))
 {
	if(extension_loaded('zip'))
	{
		$_GET['files'] = str_replace('http://ebhconsole.easybuyhealth.com/', $_SERVER['DOCUMENT_ROOT'].'/', $_GET['files']);
		$files_to_zip = explode(',', $_GET['files']);
		$zip_file_folder = "/portal/media/patient-report/";
		$zip_file_name = $_GET['emp']."_".date('Y-m-d-H-i-s')."_all_reports.zip";

		$result = $database->createZip($files_to_zip, $zip_file_folder.$zip_file_name);

		if(file_exists($zip_file_folder.$zip_file_name))
		{
			header('Content-type: application/zip');
			header('Content-Disposition: attachment; filename="'.$zip_file_folder.$zip_file_name.'"');
			readfile($zip_file_folder.$zip_file_name);
			unlink($zip_file_folder.$zip_file_name);
		}
    }
 }

?>