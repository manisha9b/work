<style>
.left_small_form {
	display: none;
}
.left_small_txt h5 {
	font-size: 16px;
}
.my-form-control {
	font-size: 16px;
	background-color: #FFF;
	display: inline;
	height: auto;
	width: auto;
	padding-right: 5px;
	padding-bottom: 5px;
	padding-left: 0px;
	border-bottom-width: thin;
	border-top-style: none;
	border-right-style: none;
	border-bottom-style: solid;
	border-left-style: none;
	border-bottom-color: #CCC;
}
.my-btn {
	padding: 5px;
}
</style>
<img src="<?php echo HTTP_SERVER."portal/".$logo?>"  data-src="holder.js/200x200" style="border:0px;">
<hr>
<div class="user-main-info">
<h3 class="text-primary user-name"><?php echo $cluster_business_name;?></h3>
</div>
<hr>
<ul class="list-group details-list">
	 <li class="list-group-item">
	  Your Professional Email<br />
	  <div id="business_email_id_txt" class="left_small_txt"><h5><?php echo $business_email_id;?><span class="pull-right"><a href="#business_email_id" data-toggle="editmenu" id="business_email_id" title="Edit Business Email"><i class="fa fa-pencil-square-o"></i></a></span></h5></div>
	  <div id="business_email_id_inp" class="left_small_form form-group">
	  <form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/cluster-action.php" name="edit_cluster_email" id="edit_cluster_email" method="post" class="form-horizontal">
	  <input name="form" type="hidden" value="edit_cluster_email">
	  <input name="cluster_id" type="hidden" value="<?php echo $database->clusterId;?>">
	  <p>
	  <input name="business_email_id" id="business_email_id_input" type="email" class="my-form-control input-sm" value="<?php echo $business_email_id;?>" required>
	  <button type="submit" class="btn btn-default btn-sm my-btn"><i class="fa fa-floppy-o fa-lg"></i></button> <button type="button" class="btn btn-default btn-sm my-btn" data-dismiss="editmenu" data-id="business_email_id"><i class="fa fa-times fa-lg"></i></button>
	  </p>
	  </form>
	  </div>
	</li>
	<li class="list-group-item">
	  Your Primary landline<br />
	  <div id="contact_landline_txt" class="left_small_txt"><h5><?php echo $contact_landline;?><span class="pull-right"><a href="#contact_landline" data-toggle="editmenu" id="contact_landline" title="Edit Landline No"><i class="fa fa-pencil-square-o"></i></a></span></h5></div>
	  <div id="contact_landline_inp" class="left_small_form form-group">
	  <form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/cluster-action.php" name="edit_cluster_landline" id="edit_cluster_landline" method="post" class="form-horizontal">
	  <input name="form" type="hidden" value="edit_cluster_landline">
	  <input name="cluster_id" type="hidden" value="<?php echo $database->clusterId;?>">
	  <p>
	  <input name="contact_landline" id="contact_landline_input" type="text" class="my-form-control input-sm" value="<?php echo $contact_landline;?>" pattern="[0-9]{10,12}" required>
	  <button type="submit" class="btn btn-default btn-sm my-btn"><i class="fa fa-floppy-o fa-lg"></i></button> <button type="button" class="btn btn-default btn-sm my-btn" data-dismiss="editmenu" data-id="contact_landline"><i class="fa fa-times fa-lg"></i></button>
	  </p>
	  </form>
	  </div>
	</li>
	<li class="list-group-item">
	  Your Cell Phone No.<br />
	  <div id="contact_mobile_txt" class="left_small_txt"><h5><?php echo $contact_mobile;?><span class="pull-right"><a href="#contact_mobile" data-toggle="editmenu" id="contact_mobile" title="Edit Contact No"><i class="fa fa-pencil-square-o"></i></a></span></h5></div>
	  <div id="contact_mobile_inp" class="left_small_form form-group">
	  <form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/cluster-action.php" name="edit_cluster_mobile" id="edit_cluster_mobile" method="post" class="form-horizontal">
	  <input name="form" type="hidden" value="edit_cluster_mobile">
	  <input name="cluster_id" type="hidden" value="<?php echo $database->clusterId;?>">
	  <p>
	  <input name="contact_mobile" id="contact_mobile_input" type="text" class="my-form-control input-sm" value="<?php echo $contact_mobile;?>" pattern="[0-9]{10,12}" required>
	  <button type="submit" class="btn btn-default btn-sm my-btn"><i class="fa fa-floppy-o fa-lg"></i></button> <button type="button" class="btn btn-default btn-sm my-btn" data-dismiss="editmenu" data-id="contact_mobile"><i class="fa fa-times fa-lg"></i></button>
	  </p>
	  </form>
	  </div>
	</li>
</ul>