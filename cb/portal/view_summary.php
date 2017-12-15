<?php
ini_set("display_errors", "1");
  error_reporting(E_ALL);
session_start();
include '../includes/define.php';
include '../classes/Class_Database.php';
global $database;
$database = new Database();
$database->connect();
date_default_timezone_set('Asia/Calcutta');
$clusterId						=	$_SESSION['cluster_id'];
?>
<style>
.no-bottom-margin{ margin-bottom:0!important;}
</style>
<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>          
            <h4 class="modal-title">Summary</h4>
         </div>
 <div class="modal-body">
<?php
//$_GET['id'] = 28;
if(isset($_POST['id']) && !empty($_POST['id']))
{
   $cluster_package_id = $_POST['id'];
	//$package_arr	=	$database->getEbhClusterPackageHSPDetails($_GET['id']);
	
//	$emp_arr_emp_dob = date('Y-m-d', strtotime($emp_arr[0]['emp_dob']));
unset($database->result);
 $sql = "SELECT a.package_id,count(c.hsp_id) as hsp_count,
				a.cluster_id,a.cluster_package_id,tcase(b.package_nm) AS package_nm,
				a.package_unit,a.price_per_unit, a.total_price,a.cluster_contribution, 
				DATE_FORMAT(a.created_on,'%d %b %Y') AS created_on,a.created_on as created_on_date,a.sales_price_type
				FROM tbl_cluster_packages AS a
				LEFT JOIN tbl_ebh_pc_packages AS b ON a.package_id=b.ebh_package_id AND a.package_type='EBH'
				Left Join tbl_cluster_packages_hsp c on c.cluster_package_id=a.cluster_package_id
				where a.cluster_package_id=".$cluster_package_id;
$database->select($sql);
$package_arr = $database->result;
$test_arr	=	$database->getTestByPacckage($package_arr[0]['package_id']);
}
/*echo "<pre>";
print_R($package_arr);
//print_R($test_arr);
echo "</pre>";*/
//print_R($test_arr);
?>
<table>
<tr><td style="width:150px;padding-top:2px;padding-bottom:2px;"><b>Name of Package:</b></td>
	<td>
	<?php
	echo ($package_arr[0]['package_nm'] != '') ? $package_arr[0]['package_nm']." " : "  ";
	?>
	</td></tr>
<tr ><td valign="top" style="padding-top:2px;padding-bottom:2px;""><b>Test Includes:</b></td>
	<td><div class="row">
	    <?php 
	    $service_info_popover ='';
	    $n= 4;
	    $i=0;
foreach($test_arr  as $key=>$val)
			{
            //if($i==$n){
            //    $i=0;
                $service_info_popover .= '	<div class="col-xs-6" style="line-height:25px;">';
           // }
				$service_info_popover.= "<i class='fa fa-check-circle text-success fa-lg'></i> ".$val['test_name'];
				if($k<count($test_arr))
				{
				//	$service_info_popover.="<hr style='margin-top:2px;margin-bottom:2px;'>";
				}
				 $service_info_popover .= '	</div >';
			}
			echo $service_info_popover;
?></div></td></tr>
</table>
<p>&nbsp;</p>
<table class="table table-bordered">
		<thead>
			<tr class="bg-blue text-white">
				
				<th >Purchase Date</th>
				<th >Fixed Purchase Price</th>
				<th >Unit Purchase</th>
				<th >Purchase Price</th>
				<th >Total Payble</th>
			</tr>
		</thead>
		<tbody>
			<?php echo"<tr>
		<td>".$package_arr[0]['created_on']."</td>
		<td>".(($package_arr[0]['sales_price_type']=='Fixed')?'Yes':'NA')."</td>
		<td>".$package_arr[0]['package_unit']."</td>
		<td>".(($package_arr[0]['sales_price_type']=='Fixed')?$package_arr[0]['price_per_unit']:'-')."</td>
		<td>".(($package_arr[0]['sales_price_type']=='Fixed')?$package_arr[0]['total_price']:'-')."</td>
	</tr>\n"; ?>
		</tbody>
</table>
<?php
$arr_hsp	=	$database->getEbhClusterPackageHSP($cluster_package_id); 
?>
<div class="form-group no-bottom-margin">
	
	<div class="col-xs-12"><table  class="table table-condensed" style="width:60%" id="hsp_table">
			  <thead>
				<tr>
		
				  
				  <th width="20%" class="text-center" >Available Provider</th>      
				  <th width="12%" class="text-center">Price/Unit(<i class="fa fa-inr"></i>) <span class="text-danger">*</span></th>
				  
				 </tr>
			</thead>
		    <tbody>
			<?php
			for($i=0;$i<count($arr_hsp);$i++)
			{
				// print_r($arr_hsp[$i]);
				$hsp_name			= $arr_hsp[$i]['name'];
				$price				= $arr_hsp[$i]['price_per_unit'];	
				$hsp_logo				= $arr_hsp[$i]['logo'];
$valign ='';				
if(!empty($hsp_logo)){
	$valign="vertical-align:middle";
}
			?>
	
			
				<td ><span class="help-block text-center"><?php if(!empty($hsp_logo)){?><img src="<?php echo EBH_WEBSITE_URL."".$hsp_logo;?>"  style="width:50px;text-align:center;"  alt="<?php echo $hsp_name;?>"> <?php } else {echo $hsp_name; }?></span></td>
				<td align="center" style="<?php echo $valign ?>"><?php echo $price;?><span class="help-block"> </span></td>
				
				
			</tr>
			<?php } ?>
			</tbody>
			</table>
	</div>
</div>


<p>&nbsp;</p>
<!-- <div class="form-group">
	<label class="col-xs-4 control-label" style="padding-right: 0px;">&nbsp;</label>
	<div class="col-xs-8 inline">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div> --> </div> 
 <div class="modal-footer">          <a href="#" class="btn btn-info pull-right" data-dismiss="modal" aria-label="Close">Close</a>        </div>
 <!-- <script>
 	rtable = $('#hsp_table').dataTable({
		'lengthChange'      : false,
		 'searching'   : false,
		  "iDisplayLength": 2,
		"sPaginationType": "bootstrap",
		"aoColumnDefs": [
			{"bSortable": false,"aTargets": [1]}
		]
	});
	$('#hsp_table_filter').hide();
	$('#hsp_table_length').hide();
	$('#hsp_table_info').css('padding','10px');
	$('.dataTables_paginate ').css('padding','10px');
 </script> -->