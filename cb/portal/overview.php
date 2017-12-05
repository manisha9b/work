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
	<img src="<?php echo HTTP_SERVER."portal/".$logo?>"  data-src="holder.js/200x200" style="border:0px;" class="">
	<hr>
	<div class="user-main-info">
	  <h3 class="text-primary user-name"><?php echo $cluster_business_name;?></h3>
	  <!--<h5 class="text-info user-designation"><?php echo $cluster_group;?></h5>	-->
	</div>
	<hr>
	<ul class="list-group details-list">
	 <li class="list-group-item">
	  Your Professional Email<br />
	  <span class="pull-right"><a href="#business_email_id" data-toggle="editmenu" id="business_email_id" title="Edit Business Email"><i class="fa fa-pencil-square-o"></i></a></span>
	  <div id="business_email_id_txt"><?php echo $business_email_id;?></div>
	  <div id="business_email_id_inp" class="left_small_form form-group">
	  <form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/cluster-action.php" name="edit_cluster_email" id="edit_cluster" method="post" class="form-horizontal">
	  <input name="form" type="hidden" value="edit_cluster_email">
	  <input name="cluster_id" type="hidden" value="<?php echo $database->clusterId;?>">
	  <p><input name="business_email_id" type="text" class="form-control input-sm" value="<?php echo $business_email_id;?>" required></p>
	  <p><button type="submit" class="btn btn-primary btn-sm">Save</button> <button type="button" class="btn btn-default btn-sm" data-dismiss="editmenu" data-id="business_email_id">Cancel</button></p>
	  </form>
	  </div>
	</li>
	<li class="list-group-item">
	  Your Primary landline<br />
	  <span class="pull-right"><a href="#contact_landline" data-toggle="editmenu" id="contact_landline" title="Edit Landline No"><i class="fa fa-pencil-square-o"></i></a></span>
	  <div id="contact_landline_txt"><?php echo $contact_landline;?></div>
	  <div id="contact_landline_inp" class="left_small_form form-group">
	  <form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/cluster-action.php" name="edit_cluster_landline" id="edit_cluster" method="post" class="form-horizontal">
	  <input name="form" type="hidden" value="edit_cluster_landline">
	  <input name="cluster_id" type="hidden" value="<?php echo $database->clusterId;?>">
	  <p><input name="contact_landline" type="text" class="form-control input-sm" value="<?php echo $contact_landline;?>" pattern="[0-9]{10,12}" required></p>
	  <p><button type="submit" class="btn btn-primary btn-sm">Save</button> <button type="button" class="btn btn-default btn-sm" data-dismiss="editmenu" data-id="contact_landline">Cancel</button></p>
	  </form>
	  </div>
	</li>
	<li class="list-group-item">
	  Your Cell Phone No.<br />
	  <span class="pull-right"><a href="#contact_mobile" data-toggle="editmenu" id="contact_mobile" title="Edit Contact No"><i class="fa fa-pencil-square-o"></i></a></span>
	  <div id="contact_mobile_txt"><?php echo $contact_mobile;?></div>
	  <div id="contact_mobile_inp" class="left_small_form form-group">
	  <form action="<? echo HTTP_SERVER; ?>portal/modules/cluster-dashboard/cluster-action.php" name="edit_cluster_mobile" id="edit_cluster" method="post" class="form-horizontal">
	  <input name="form" type="hidden" value="edit_cluster_mobile">
	  <input name="cluster_id" type="hidden" value="<?php echo $database->clusterId;?>">
	  <p><input name="contact_mobile" type="text" class="form-control input-sm" value="<?php echo $contact_mobile;?>" pattern="[0-9]{10,12}" required></p>
	  <p><button type="submit" class="btn btn-primary btn-sm">Save</button> <button type="button" class="btn btn-default btn-sm" data-dismiss="editmenu" data-id="contact_mobile">Cancel</button></p>
	  </form>
	  </div>
	</li>
	<li class="list-group-item">
	  <span class="badge bg-success"><?php echo $total_packages;?></span>
	  <a href="<? echo HTTP_SERVER; ?>portal/cindex.php">Purchased Packages</a>
	</li>
	<li class="list-group-item">
	  <span class="badge bg-info"><?php echo $total_emp;?></span>
	  <a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=employee">Manage Employee</a>
	</li>

	<li class="list-group-item">
	  <a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=overview"><strong>Overview</strong></a>
	</li>

	<li class="list-group-item">
	  <a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=schedule">Schedule Reminder</a>
	</li>

	<li class="list-group-item">
	  <a href="<? echo HTTP_SERVER; ?>portal/cindex.php?page=health_reports">Employees Health Reports</a>
	</li>

  </ul>
</div>

<div class="text-left text-primary col-md-3">
	<ul class="breadcrumb">
		<li><a href="<?php echo HTTP_SERVER;?>portal/cindex.php">Dashboard</a></li>
		<li class="active">Overview</li>

	</ul>
</div>
<div class="col-md-9">
<div class="row">
		<div class="col-sm-12">
			<div class="panel">
				<div class="panel-heading">
					<h6 class="panel-title text-primary">
						<i class="fa fa-bar-chart-o"></i> Report Availability
						<span class="pull-right"><a href="<?php echo HTTP_SERVER;?>portal/cindex.php?page=health_reports">View Employee Health Report</a></span>
					</h6>
				</div>
				<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="5%">#</th>
							<th width="25%">Package</th>
							<th>Report Availability</th>
						</tr>
					</thead>
					<tbody>

					<?php
						$arr_rep	=	$database->get_report_availablity($database->clusterId);
						if(count($arr_rep)>0)
						{
						for($i=0;$i<count($arr_rep);$i++)
						{
							$package_name	=	$arr_rep[$i]['package_nm'];
							$percentage		=	$arr_rep[$i]['avail_per'];
							switch($percentage)
							{
								case $percentage<=35:
									$class="progress-bar-danger";
								break;
								case $percentage>35 && $percentage<=50:
									$class="progress-bar-warning";
								break;
								case $percentage>50 && $percentage<=75:
									$class="progress-bar-info";
								break;
								case $percentage>75 && $percentage<=100:
									$class="progress-bar-success";
								break;
								default:
									$class="";
								break;
							}
						?>
						<tr>
							<td><?php echo ($i+1);?></td>
							<td><?php echo $package_name;?> </td>
							<td>
								<div class="text-fill">
									<div class="progress progress-striped" style="margin-bottom:12px;">
										<div class="progress-bar six-sec-ease-in-out <?php echo $class;?>" aria-valuetransitiongoal="<?php echo $percentage;?>"></div>
									</div>
								</div>
							</td>
						</tr>
						<?php
						}
						}else
						{
						?>
						<tr><td colspan="3" align="center"><h5>No Data Found!<h5></td></tr>
						<?php
						}
					?>
					</tbody>
				</table>

				</div>
			</div>
		</div>
	</div>
	<?php $arr_overview	=	$database->cluster_invitation_overview();?>
	<div class="row">
			<div class="col-md-4">
				<div class="panel">
					<div class="panel-heading">
						<h6 class="panel-title text-primary">
							<i class="fa fa-bar-chart-o"></i> Package Invited <span class="small"></span>
						</h6>
					</div>
					<div class="panel-body" style="padding-top:0px;">
					<?php
					echo $message="";
					if(count($arr_overview)==0)
					{
						$message="<h5 class='text-center'>No Data Found!</h5>";
					}
						?>
						<div id="invitation_ratio"></div>
						<?php echo $message;?>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="panel">
					<div class="panel-heading">
						<h6 class="panel-title text-primary">
							<i class="fa fa-bar-chart-o"></i> Booking Confirmed<span class="small"></span>
						</h6>
					</div>
					<div class="panel-body" style="padding-top:0px;">
						<div id="confirm_ratio"></div>
						<?php echo $message;?>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel">
					<div class="panel-heading">
						<h6 class="panel-title text-primary">
							<i class="fa fa-bar-chart-o"></i> Employee Visited <span class="small"></span>
						</h6>
					</div>
					<div class="panel-body" style="padding-top:0px;">
						<div id="visit_ratio"></div>
						<?php echo $message;?>
					</div>
				</div>
			</div>

	</div>
	<div class="row">
		<div class="col-sm-12">
		<div class="panel">
			<div class="panel-heading">
				<h6 class="panel-title text-primary">
					<i class="fa fa-bar-chart-o"></i> Month wise Package Utilization Summary <span class="small">(<?php echo date('Y');?>)</span>
				</h6>
			</div>
			<div class="panel-body">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th></th>
								<th>Jan <br><?php echo date('Y');?></th>
								<th>Feb <br><?php echo date('Y');?></th>
								<th>Mar <br><?php echo date('Y');?></th>
								<th>Apr <br><?php echo date('Y');?></th>
								<th>May <br><?php echo date('Y');?></th>
								<th>Jun <br><?php echo date('Y');?></th>
								<th>Jul <br><?php echo date('Y');?></th>
								<th>Aug <br><?php echo date('Y');?></th>
								<th>Sep <br><?php echo date('Y');?></th>
								<th>Oct <br><?php echo date('Y');?></th>
								<th>Nov <br><?php echo date('Y');?></th>
								<th>Dec <br><?php echo date('Y');?></th>
							</tr>
						</thead>
						<tbody>

					<tbody>
				<?php
					// Get Cluster package
					$arr_cluster_pack	=	$database->getclusterEbhPackage($database->clusterId);
					if(count($arr_cluster_pack)>0)
					{
					for($i=0;$i<count($arr_cluster_pack);$i++)
					{
						$cluster_package_id	=	$arr_cluster_pack[$i]['cluster_package_id'];
						$package_nm	=	$arr_cluster_pack[$i]['package_nm'];
					?>
						<tr>
						<td colspan="13"><h4 class="panel-title text-primary"><?php echo $package_nm;	?><h4></td>
						</tr>
						<?php
							$k=0;
							$arr_summary_list	=	$database->cluster_package_summary_monthwise($database->clusterId, $cluster_package_id,date('Y'));
							for($k=0;$k<count($arr_summary_list);$k++)
							{
								$res_type	= $arr_summary_list[$k]['action'];
								switch($res_type)
								{
									case "Invited":
										$box_class="bg-info";
									break;

									case "Confirmed":
										$box_class="bg-warning";
									break;

									case "Visited":
										$box_class="bg-success";
									break;

								}
							?>	<tr>
									<th><span class="<?php echo $box_class;?>" style="width: 10px;height:10px;border:0px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <?php echo $arr_summary_list[$k]['action']?></th>
									<td ><?php echo ($arr_summary_list[$k]['jan_month']>0)?$arr_summary_list[$k]['jan_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['feb_month']>0)?$arr_summary_list[$k]['feb_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['mar_month']>0)?$arr_summary_list[$k]['mar_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['apr_month']>0)?$arr_summary_list[$k]['apr_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['may_month']>0)?$arr_summary_list[$k]['may_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['jun_month']>0)?$arr_summary_list[$k]['jun_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['jul_month']>0)?$arr_summary_list[$k]['jul_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['aug_month']>0)?$arr_summary_list[$k]['aug_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['sep_month']>0)?$arr_summary_list[$k]['sep_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['oct_month']>0)?$arr_summary_list[$k]['oct_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['nov_month']>0)?$arr_summary_list[$k]['nov_month']:'-';?></td>
									<td><?php echo ($arr_summary_list[$k]['dec_month']>0)?$arr_summary_list[$k]['dec_month']:'-';?></td>
								</tr>
							<?php
							}
							?>

					<?php
					}
					}
					else
					{
					?>
						<tr><td colspan="13" align="center">No Data Found!</td></tr>
					<?php
					}
				?>
					</tbody>
					</table>


			</div>
		</div>
	</div>
	</div>


