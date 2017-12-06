<?php
ob_start();
session_start();

include_once '../includes/define.php';
include '../classes/Class_Database.php';

global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');
$created_by		=	$_SESSION['ref_id'];
$created_on		=	date("Y-m-d H:i:s");
$cluster_package_id = isset($_POST['cpid'])?$_POST['cpid']:'';;
$arr_hsp	=	$database->getEbhClusterPackageHSP($cluster_package_id);

					?>
<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo $arr_hsp[0]['package_nm']?></h4>
			</div>
			<div class="modal-body" id="close_form">
			<div class="col-md-12">
			<div class="row">
				<div class="col-md-3"><b>Package</b></div>
				<div class="col-md-9"><?php echo $arr_hsp[0]['package_nm']?></div>
			</div>
			<div class="row">
				<div class="col-md-3"><b>Unit</b></div>
				<div class="col-md-9"><?php echo $arr_hsp[0]['package_unit']?></div>
			</div>
			<div class="row">
				<div class="col-md-3"><b>Total(<i class="fa fa-inr"></i>)</b></div>
				<div class="col-md-9"><?php echo $arr_hsp[0]['total_price']?></div>
			</div>
			<div class="row">
				<div class="col-md-3"><b>Contribution(%)</b></div>
				<div class="col-md-9"><?php echo $arr_hsp[0]['cluster_contribution']?></div>
			</div>
			</div>
			<table class="table table-condensed" id="hsp_list" style="margin:20px;width:98%">
			  <thead>
				<tr>
		
				  <th width="5%">#</th>
				
				  <th style="width:150px;" class="text-center" >HSP</th>      
				  <th  class="text-center">Price/Unit</th>
				  
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
				$hsp_name			= $arr_hsp[$i]['name'];
				$price				= $arr_hsp[$i]['price_per_unit'];	
			?>
	
				<td><?php echo ($i+1)?></td>
				<td><?php echo $hsp_name;?><span class="help-block"> </span></td>
				<td align="center"><?php echo $price;?><span class="help-block"> </span></td>
				
			</tr>
			<?php } ?>
			</tbody>
			</table>
			 <div class="pt-10 pb-10" style="padding-right:20px;">
         
          <a href="#" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">Close</a><br/><br/>
        </div>
			</div>
			<script>
			
			</script>
			