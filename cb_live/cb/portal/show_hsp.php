<?php
ob_start();
session_start();

include_once '../../../includes/define.php';
include '../../../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');
$created_by		=	$_SESSION['ref_id'];
$created_on		=	date("Y-m-d H:i:s");
$cluster_package_id = isset($_POST['cpid'])?$_POST['cpid']:'';;
$arr_hsp	=	$database->getEbhClusterPackageHSPDetails($cluster_package_id);

					?>
<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo $arr_hsp[0]['package_nm']?></h4>
			</div>
			<div class="modal-body" id="close_form">
			<table class="table table-condensed" style="margin:20px;width:98%">
			  <thead>
				<tr>
		
				  <th width="5%">#</th>
				
				  <th style="width:150px;" class="text-center" >HSP</th>      
				  <th  class="text-center">Address</th>
				  <th  class="text-center">Available Branches</th>
				  
				 </tr>
			</thead>
		    <tbody>
			<?php
			/*echo "<pre>";
print_r($arr_hsp);
echo "</pre>";*/
			for($i=0;$i<count($arr_hsp);$i++)
			{
				// print_r($arr_hsp[$i]);
				$hsp_logo	= $arr_hsp[$i]['hsp_logo'];
				$hsp_name				=	$arr_hsp[$i]['hsp_name'];
			$hsp_address			=	$arr_hsp[$i]['hsp_address'];

			$hsp_helpline_number1	= 	$arr_hsp[$i]['hsp_helpline_number1'];
			$hsp_helpline_number1.= 	($arr_hsp[$i]['hsp_helpline_number2']!='')? " / ".$arr_hsp[$i]['hsp_helpline_number2']:"";
			$hsp_helpline_number1.= 	($arr_hsp[$i]['hsp_helpline_number3']!='')? " / ".$arr_hsp[$i]['hsp_helpline_number3']:"";
			$hsp_helpline_number1.= 	($arr_hsp[$i]['hsp_helpline_number4']!='')? " / ".$arr_hsp[$i]['hsp_helpline_number4']:"";

			$hsp_general_email_id	= 	$arr_hsp[$i]['hsp_general_email_id'];
			$branches				=	$arr_hsp[$i]['hsp_branchs'];
			$hsp_address_info		=	"<i class='fa fa-map-marker'></i> ".$hsp_address;
			$hsp_contact_info		=	"<hr style='margin-top:8px;margin-bottom:8px;'/><i class='fa fa-phone'></i> ".$hsp_helpline_number1;
			$branches	=	explode(",",$branches);
			$provider_info_popover ='';
			for($k=0;$k<count($branches);$k++)
			{
				$provider_info_popover.= "<i class='fa fa-check text-success'></i> ".$branches[$k];
				if($k<count($branches))
				{
					$provider_info_popover.="<hr style='margin-top:6px;margin-bottom:6px;'>";
				}
			}
			?>
	
				<td ><?php echo ($i+1)?></td>
				<td ><img src="<?php echo HTTP_SERVER."portal/".$hsp_logo;?>" data-src="holder.js/90x90" style="width: 90px; height: 90px;" class="main-avatar img-rectangle" alt=""></td>
				<td><?php echo $hsp_address_info;?></td>
				<td><?php echo $provider_info_popover;?></td>
				
				
			</tr>
			<?php } ?>
			</tbody>
			</table>
			</div>