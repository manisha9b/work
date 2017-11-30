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
		<li>Change Password</li>
	</ul>
</div>

</div>

<div class="panel">
<?php
	$form_action = MODULE_PATH . "cluster-dashboard/password.php";
?>
	<form role="form" class="form-horizontal" method="post" action="<?php echo $form_action;?>" name="frmchangepass" id="frmchangepass"
	enctype="multipart/form-data" autocomplete="off">
	<div class="panel-body">
	  <div class="form-group">
		<label class="col-sm-2 control-label">  </label>
		<div class="col-sm-7">
		  <div id="message_div_pwd"></div>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label"> Old Password </label>
		<div class="col-sm-4">
		  <input type="password" class="form-control input-sm" id="old_password" name="old_password"  required>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label"> New Password </label>
		<div class="col-sm-4 ">
		  <input type="password" class="form-control input-sm" id="new_password" name="new_password" required>
		  <span id="msg_new_password" class="help-inline text-danger"></span> </div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label">Re-Type Password </label>
		<div class="col-sm-4 tooltips">
		  <input type="password" class="form-control input-sm" id="new_re_password" name="new_re_password" required>
		  <span id="msg_new_re_password" class="help-inline text-danger"></span> </div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-4 control-label"> </label>
		<div class="col-sm-4 tooltips">
		  <button type="submit" class="btn btn-success btn-submit btn-sm"> Save</button>
		  <button type="Reset" class="btn btn-danger btn-sm"> Reset</button>
		</div>
	  </div>
	</div>
	</form>

</div>
</div>
</div>