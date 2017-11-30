<?php
$arr_cluster	=	$database->getClusters($database->clusterId);

$cluster_business_name	= $arr_cluster[0]['cluster_business_name'];
$cluster_group			= $arr_cluster[0]['cluster_group'];
$business_email_id		= $arr_cluster[0]['business_email_id'];
$contact_mobile			= $arr_cluster[0]['contact_mobile'];
$contact_landline		= $arr_cluster[0]['contact_landline'];
$total_packages			= $arr_cluster[0]['total_packages'];
$logo					= $arr_cluster[0]['logo'];
$total_emp				= $arr_cluster[0]['total_emp'];

$hr_full_name			= $arr_cluster[0]['hr_full_name'];
$hr_email_id			= $arr_cluster[0]['hr_email_id'];
$hr_mobile_no			= $arr_cluster[0]['hr_mobile_no'];

?>
<div class="row profile">
<div class="col-md-3 user-details well text-center col-sm-12"  style="padding: 10px;background-color:#fff;  -webkit-box-shadow: 3px 3px 6px #C4C2C3;min-height:1080px;">
<?php
	include "dashboard-menu.php";
	
?>
</div>

<div class="col-md-9">
<div class="row">
<div class="col-sm-12 text-primary text-left">
<?php
	include "dashboard-header-text.php";
?>
</div>
</div>
<div class="row">
<div class="col-sm-12 text-primary text-left">
	<ul class="breadcrumb">
		<li><a href="<?php echo HTTP_SERVER;?>portal/cindex.php">Dashboard</a></li>
		<li>My Packages</li>
	</ul>
</div>

</div>

<?php
if(isset($_REQUEST['m']))
 {
	echo $database->show_alert($_REQUEST['m']);
 }
?>
<div class="panel">

<div class="panel-heading">
	<div class="col-sm-2 pull-right">
	<select size="1" name="sort_by_date" id="sort_by_date" class="form-control input-sm">
		<option value="" hidden>Sort By</option>
		<?php
        if($_GET['sort']=='latest')
        {        	
			echo"<option value=\"latest\" selected>Latest date</option>\n<option value=\"oldest\">Oldest date</option>\n";
        }
        elseif($_GET['sort']=='oldest')
        {        	
			echo"<option value=\"latest\">Latest date</option>\n<option value=\"oldest\" selected>Oldest date</option>\n";
        }
        else
        {
        	echo"<option value=\"latest\">Latest date</option>\n<option value=\"oldest\">Oldest date</option>\n";
        }
		?>
	</select>
	</div>
	<h4 class="panel-title text-primary"><i class="fa fa-files-o"></i> My Packages</h4><br />

</div>

<div class="panel-body">
<?php

	include_once 'cluster-package-list.php';
?>

</div>
</div>
</div>
</div>