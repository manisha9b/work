<?php 
include_once('partials/header2.php'); 
unset($arr_ebh_pack);
$arr_emp	=	$database->getClusterEmp($clusterId);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header">
		<div class="col-md-12">
      <h3 class="pull-left">
        <b>Digital Republik's Employees</b>
      </h3>
      <div class="pull-right resright">
	  <?php 
include_once('partials/askme.php'); 
?>
       </div>      
	  </div>
	  <div class="clearfix"></div>
	  <hr class="hrdivide" />
    </section>
    
	
    <!-- Main content -->
    <section class="content">
		<div class="col-md-12">
		<div class="pull-right" style="margin-top: -10px;">
			<span>Timeframe<span> :
				<select style="font-weight: bold;background: transparent;border:none;display: inline-block;width: 125px;height: auto;padding: 0 5px;">
					<option>Last 6 months</option>
					<option>Last 12 months</option>
				</select>
		</div>
        <div class="pt-20"></div>
		</div>
		<div class="row">
		<div class="col-md-12">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box box2 bg_dark_blue">
            <span class="info-box-icon bg-aqua dark_blue_clr"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text text2 clr_effect1">78</span>
              <span class="info-box-number text-white">TOTAL EMPLOYEES</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box box3 healthy_employee">
            <span class="info-box-icon icon2 bg_dark_blue1 text-white"><i class="fa fa-heartbeat"></i></span>

            <div class="info-box-content bg_dark_blue1">
              <span class="info-box-text text2 clr_effect1 text-white">45</span>
              <span class="info-box-number text-white">HEALTHY EMPLOYEES</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box box4 unhealthy_employee">
            <span class="info-box-icon icon3"><img src="images/logo/unhealthy_icon.png" width="35"></span>

            <div class="info-box-content">
              <span class="info-box-text text2 text-white clr_effect1">33</span>
              <span class="info-box-number text-white">UNHEALTHY EMPLOYEE</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box box5 add_tab_new">
            <span class="info-box-icon icon4"><i class="fa fa-plus-circle" aria-hidden="true"></i></span>

            <div class="info-box-content text">
              <span class="info-box-text text2">ADD TAB</span>
              
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		</div>
      </div>  
	  
	
		<div class="col-md-12">
		<div id="appointments" class="nav-tabs-custom">
		<ul class="nav nav-tabs">
            <li class="active">
				<div class="dropdown">
				  <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background: #3D4452;
padding:9.5px;border-radius: 0!important;">PRE EMPLOYMENT <span class="caret"></span></a>
				  <ul class="dropdown-menu purchase_drop_down" style="width: 140%;">
					<li><a href="#">Pre Employment</a></li>
					<li><a href="#">Annual Checkup</a></li>
					<li><a href="#">Package Type A</a></li>
					<li><a href="#">Add Tabs</a></li>
				  </ul>
				</div>				
			</li>
                <li><a href="#tab_2-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false">CURRENT EMPLOYEES</a></li>
                <li><a href="#tab_3-2" onclick="return hidesummary()" data-toggle="tab">All</a></li>
                <li class="pull-right nohover1">
                  <!-- search form -->
                  <form action="#" method="get" class="sidebar-form1" style="display: inline-block;background: #FFFFFF;">
                    <div class=" inner-addon left-addon">
                      <i class="fa fa-search"></i>
                      <input type="text" name="q" class="form-control" id="search_name" placeholder="Type To Search">
                    </div>
                  </form>
                  <!-- /.search form -->
                </li>
                <li class="pull-right dropdown nohover1">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Sort By <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sort By</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Date &amp; Time</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Location</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Status</a></li>
                  </ul>
                </li>                
            </ul>
	</div>
	   <div class="box no-border">
            
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding emp_detail">
              <table class="table table-hover" <?php if(!empty($arr_emp)){ echo "id='reportsdatatables'";} ?>>
                <thead>
				<tr class="employee_table">
				 <th> </th>
                  <th>NAME</th>
                  <th>GENDER/AGE</th>
                  <th>MOBILE</th>
                  <th>EMAIL</th>
                  <th>CITY</th>
				  <th>BLOOD GROUP</th>
				  <th>ACTION </th>
				 
                </tr>
				</thead>
				<tbody>
				<?php
if(!empty($arr_emp))
{
	foreach($arr_emp as $row)
	{
		//+91 9930-7110-84
		$mobile_no_code	= (!empty($row['mobile_no_code'])) ? $row['mobile_no_code'] : "+91";
		$photo	= (!empty($row['photo_thumb'])) ? $row['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
		$photo	= "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
		if(!empty($row['mobile_no']))
		{
			$mobile = substr($row['mobile_no'],-10,-6)."-".substr($row['mobile_no'],-6,-2)."-".substr($row['mobile_no'],-2);
		}
		$mobile_no	= (!empty($mobile)) ? $mobile_no_code." ".$mobile : "";
		?>
                <tr class="emp_info_data">
                  <td class="table_circle emp_pic" style="padding-left:2px;padding-right:2px;"><img src="<?php echo $photo?>" style="width:50px;margin:0;" class="img-circle"></td>
                  <td class="info"><?php echo $row['emp_name']?></td>
                  <td class="info"><?php echo $database->getGender($row['salutation'])?>,28 Yrs</td>
                  <td class="info"><?php echo $mobile_no?></td>
				  <td class="info"><?php echo $row['professional_email_id']?></td>
				  <td class="info"><?php echo $row['city_name']?></td>
				  <td class="info"><?php echo $row['blood_group']?></?></td>
				  <td>
						<div class="btn-group emp_action_btn">
					  <button type="button" class="btn btn-success btn-flat">Action</button>
					  <button type="button" class="btn  btn-success btn-flat dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu" role="menu">
						<li><a href="#"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a></li>
						<li><a href="#"><i class="fa fa-trash-o" aria-hidden="true"></i>Delete</a></li>
						<li><a href="#"><i class="fa fa-plus-circle" aria-hidden="true"></i>Add action</a></li>
					  </ul>
					</div>
				  </td>
                </tr>
				<?php
				$i++;
	}
}
else
{

	echo'<tr>
		<td colspan="7"  class="text-center">No Employee found!!</td>
	</tr>';
	
} ?>
                  </tbody>
			  </table>	
				<!-- <div class="box-header employee_pagination mt-20 pt-20 pb-20">
					<div class="col-md-12 total_entry">
					<tr>
					<td>Showing 8 out of 34 entries</td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td></td>
					  <td>
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a href="#">«</a></li>
						<li><a href="#">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li><a href="#">»</a></li>
					</ul>
					</td>				
					</tr>
					</div>
				</div> -->
			</div>
	   </div>
			  </div>
      
      <!-- /.row -->
    
      <!-- /.row -->
      <div class="row pt-20">		
        <div class="col-md-12 employe_health_area">
          <div class="col-md-6">
		  
		   <div class="box">  
			<div class="box-header with-border">
          <h4 class="pull-left margin0"><strong>Healthy Employees</strong></h4>
		</div>
            <!-- /.box-header -->
            <div class="box-body profileimg">
             <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>
                <hr>
			 <a href="#" class="btn2-lg"><h5 class="margin0">View All</h5></a>
              
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
		
		
		<div class="col-md-6">
			
		   <div class="box"> 
				<div class="box-header with-border">
			  <h4 class="pull-left margin0"><strong>UnHealthy Employees</strong></h4>
			</div>
            <!-- /.box-header -->
            <div class="box-body profileimg">
             <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>
                <hr>
			 <a href="#" class="btn2-lg"><h5 class="margin0">View All</h5></a>
              
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
      </div>
      <!-- /.row -->
    </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->

  </div>

  
</div>
<!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade" id="bloodpressure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document" style="box-shadow: 0 6px 20px 8px rgba(0,0,0,0.5);">
    <div class="col-sm-12 modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-left cblue" id="myModalLabel">My Health Status</h4>
        <h4 class="modal-title pull-right" id="myModalLabel">Dashboard Update: <span class="cgreen">Blood Pressure</span></h4>
      </div>
      <div class="modal-body" style="padding-left: 10px;padding-right: 10px;">
        <p class="pt-10">
          Don't Know Your Blood Pressure count as on date? No Problem.<br/>
          Just walk to your nearest General Physician / Doctor and she can let you know.
        </p>
        <div class="pt-10 pb-30" style="border-bottom: 1px dotted #000000">
          <div class="col-sm-4">
            <div class="input__1">
              <div class="input__1_placeholder input__1_blurred">BP (systolic)</div>
              <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
            </div>
          </div>
           <div class="col-sm-4">
            <div class="input__1">
              <div class="input__1_placeholder input__1_blurred">BP (Diastolic)</div>
              <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
            </div>
          </div>
           <div class="col-sm-4">
            <div class="text-center">
              <div class="cgreen">As On:</div>
              <div class=" inner-addon right-addon">
                <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:35%;"></i>
                <input id="datepicker" type="text" name="date1" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;">
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div id="prevbp" style="display: none;">
          <div class="pt-10">
            <span class="text-uppercase">Remember your Count from a previous date?</span> Helps with the Graph
          </div>
          <div class="pt-10 pb-20" style="border-bottom: 1px dotted #000000">
            <div class="col-sm-4">
              <div class="input__1">
                <div class="input__1_placeholder input__1_blurred">BP (systolic)</div>
                <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
              </div>
            </div>
             <div class="col-sm-4">
              <div class="input__1">
                <div class="input__1_placeholder input__1_blurred">BP (Diastolic)</div>
                <input type="text" name="state" id="state" maxlength="50" onKeyPress="return validData(event,'name')" />
              </div>
            </div>
             <div class="col-sm-4">
              <div class="text-center">
                <div class="cgreen">As On:</div>
                <div class=" inner-addon right-addon">
                  <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:35%;"></i>
                  <input id="datepicker2" type="text" name="date2" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;" />
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="pt-10 pb-10">
          <a href="#" class="btn cgreen" style="padding-left: 8px;padding-right: 8px;">ADD One More?</a><a href="#" class="btn cblue" data-dismiss="modal" aria-label="Close"  style="padding-left: 8px;padding-right: 8px;">No, I'm DONE</a><a href="#" id="addbloodsugar" class="btn btn-green cwhite" data-dismiss="modal" aria-label="Close"  style="padding-left: 8px;padding-right: 8px;">OR Add Blood Sugar level</a><a href="#" class="btn cgreen"  style="padding-left: 8px;padding-right: 8px;">Don't Know?</a>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="bloodsugar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="col-sm-12 modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-left cblue" id="myModalLabel">My Health Status</h4>
        <h4 class="modal-title pull-right" id="myModalLabel">Dashboard Update: <span class="cgreen">Blood Sugar</span></h4>
      </div>
      <div class="modal-body">
        <p class="pt-10 cgreen">
          Don't Know Your Blood Sugar Level as on date? No Problem.<br/>
          Just walk to your nearest General Physician / Doctor and she can let you know.
        </p>
        <div class="pt-10 pb-20" style="border-bottom: 1px dotted #000000">
          <div class="col-sm-4">
            <div class="fieldname">
              Blood Sugar (Fasting):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="80 mm" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-5">
            <div class="fieldname">
              Blood Sugar (After Eating):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="120 hg" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-3">
            <div class="text-center">
              <div class="cgreen">As On:</div>
              <div class=" inner-addon right-addon">
                  <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:30%;"></i>
                  <input id="datepicker3" type="text" name="date3" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;" />
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="pt-10">
          <span class="text-uppercase">Remember your Count from a previous date?</span> Helps with the Graph
        </div>
        <div class="pt-10 pb-10" style="border-bottom: 1px dotted #000000">
          <div class="col-sm-4">
            <div class="fieldname">
              Blood Sugar (Fasting):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="00 mm" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-5">
            <div class="fieldname">
              Blood Sugar (After Eating):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="00 hg" style="background: transparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-3">
            <div class="text-center">
              <div class="cgreen">As On:</div>
              <div class=" inner-addon right-addon">
                  <i class="fa fa-calendar" style="font-size: 2.2em;cursor: pointer;padding-top: 5px; color: #000000;right:30%;"></i>
                  <input id="datepicker4" type="text" name="date4" style="opacity: 0;width: 30%;height:35px;padding-right: 0;cursor: pointer;" />
                </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="pt-10 pb-10">
          <a href="#" class="btn cgreen">ADD One More?</a>
          <a href="#" class="btn cblue" data-dismiss="modal" aria-label="Close">No, I'm DONE</a>
        </div>
      </div> 
    </div>
    <div class="clearfix"></div>
  </div>
</div>

<?php include_once('partials/footer.php'); ?>

<script src="dist/js/bootstrap-datepicker.min.js"></script>
<script src="dist/js/cluster.js"></script>
</body>
</html>
