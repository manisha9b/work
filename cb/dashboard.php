<?php include_once('partials/header.php'); 

?>
 <style>
	#containercircle {
  margin: 20px;
  width: 200px;
  height:90px;
  text-align:center;
  margin:0 auto;
}

.progressbar-text{font-size:3rem!important;color:rgb(15, 14, 14)!important;}
.swiper-slide .box .date{color:#717171;font-size:14px;}

.health_goal_area .box-solid{border:none!important;padding:15px;height: 250px;}
.add_new_tab{display: block;
    background: #67c100 !important;
    border-radius: 85%;
    width: 70px;
    height: 70px;
    margin: 0 auto;margin-top:35px;}
	
.add_new_tab i{font-size: 25px;
    /* vertical-align: top; */
    margin: 26px 26px auto;
    text-align: center;
    color: #fff}
	
.progress{
  position: relative;
  margin: 4px;
  float:left;
  text-align: center;
  width:100%;
  height:50%;
  background:#fff;
}
.barOverflow{ /* Wraps the rotating .bar */
  position: relative;
  overflow: hidden; /* Comment this line to understand the trick */
  height:110px; /* Half circle (overflow) */
  margin-bottom: -14px; /* bring the numbers up */
  width:100%;
      background: #fff;
}
.bar{
  position: absolute;
  top: 10px; left: 0;
  width:100%; height:265px; /* full circle! */
  border-radius: 50%;
  box-sizing: border-box;
  border:25px solid #eee;     /* half gray, */
 border-bottom-color: #58d76c;
    border-right-color: #58d76c;
}

.progress span{
	position: absolute;
    font-size:25px;
    top: 72px;
    color: #000;
    font-weight:bold;
	visibility:hidden}
	
#container {
  width: 100%;
  height: 100px;
}

svg {
  <!-- height: 120px; -->
  <!-- width: 200px; -->
  fill: none;
  stroke: #21bcc1;
  <!-- stroke-width: 10; -->
  stroke-linecap: round;
  <!-- -webkit-filter: drop-shadow( -3px -2px 5px gray );-->
  <!--filter: drop-shadow( -3px -2px 5px gray ); -->
  }
  
#container .progressbar-text{visibility:hidden!important;}

.health_goal_info .value{font-size:35px;}

/* .disabled:hover { 
    display: block;
    margin-bottom: 20px;
    text-decoration: none;
    border:1px solid #25729a; 
    -webkit-border-radius: 3px; 
    -moz-border-radius: 3px;
    border-radius: 3px;
    font-family:arial, helvetica, sans-serif; 
    padding: 10px 10px 10px 10px; 
    text-shadow: -1px -1px 0 rgba(0,0,0,0.3);
    text-align: center; 
    color: #FFFFFF; 
    background-color: #3093c7;
    background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #3093c7), color-stop(100%, #1c5a85));
    background-image: -webkit-linear-gradient(top, #3093c7, #1c5a85);
    background-image: -moz-linear-gradient(top, #3093c7, #1c5a85);
    background-image: -ms-linear-gradient(top, #3093c7, #1c5a85);
    background-image: -o-linear-gradient(top, #3093c7, #1c5a85);
    background-image: linear-gradient(top, #3093c7, #1c5a85);filter:progid:DXImageTransform.Microsoft.gradient(GradientType=0,startColorstr=#3093c7, endColorstr=#1c5a85);
} */

.disabled {
  opacity: 0.65; 
  cursor: not-allowed;
}

@media screen and (max-width:1366px){
	.bar{
  position: absolute;
  top: 10px; left: 0;
  width:100%; height:212px; /* full circle! */
  border-radius: 50%;
  box-sizing: border-box;
  border:25px solid #eee;     /* half gray, */
 border-bottom-color: #58d76c;
    border-right-color: #58d76c;
}
}

@media only screen and (max-width: 320px){
	
	.bar{position: absolute;
    top: 10px;
    left: 0;
    width: 100%;
    height:310px;
    border-radius: 50%;
    box-sizing: border-box;
    border:30px solid #eee;
    border-bottom-color: #58d76c;
    border-right-color: #58d76c;}
	
}
	
	

  </style>

  <!-- Left side column. contains the logo and sidebar -->
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php
$arr_count = $database->getDashboardCount($clusterId);
$chartdata = $database->getDashboardChart($clusterId);
$emp_arr['healty'] = $database->getClusterEmpDetails($clusterId,'H',' Limit 3');
$emp_arr['unhealty'] = $database->getClusterEmpDetails($clusterId,'UH',' Limit 3');

//$charts = $chartdata['chart'];
$goal_arr = $database->getClusterGoal($clusterId);
//$database->getclusterEbhPackageList($cluster_id);
//echo "<pre>";
//print_R($arr_count);
//print_R($goal_arr);
//echo "</pre>";//die;
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="col-md-12">
		  <h3 class="pull-left">
			<b> <?php echo $arr_cluster['cluster_business_name']?> Dashboard</b>
		  </h3>
		  <div class="pull-right resright">
		  <?php include_once('partials/askme.php'); ?>
			 </div>
	  </div>
      <div class="clearfix"></div>
	  <hr class="hrdivide" />
    </section>
	
    
    <!-- Main content -->	
    <section class="content">
      <!-- Small boxes (Stat box) -->
     <div class="row">
		<div class="col-md-12">
		  <h4><b>Quick Summary</b></h4><br>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-aqua"><i class="fa ion-ios-medkit-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><?php echo $arr_count['total_packages']?> Health Package(s)</span>
				<span class="info-box-number">Purchase</span>
			</div>
			<!-- /.info-box-content -->
			</div>		
		</div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text"><?php echo $arr_count['total_employees']?> Employees</span>
				  <span class="info-box-number">Onboarded</span>
				</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
			<div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-yellow"><i class="fa fa-file-text"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"><?php echo $arr_count['total_report_available']?> Reports</span>
					<span class="info-box-number">Health Index</span>
				</div>
            <!-- /.info-box-content -->
			</div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <!--  <div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-red add_tab_top"><i class="fa fa-plus"></i></span>
				<div class="info-box-content">
					<span class="info-box-text mt-10">Add Tabs</span>
				</div>
			
			</div>
        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	  
		<div class="col-md-12">
		  <h4><b>Company Health Status</b></h4>
		</div>
		<div class="clearfix"></div><br/>
        <div id="graph1" class="package-container">
          <div class="swiper-container graph-container">
			<div class="col-md-12">
			 <!-- BAR CHART -->
			 	
			  <div class="box box-success">
            <div class="box-header with-border">
 <div class="pre-header" style="margin: 8px 0;">
                      <h5 class="margin0 text-uppercase2"><b>Blood Pressure Observations</b></h5>
                      <!--<a href="#" class="btn2">BMI</a>-->
                    </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="row">
                <div class="col-md-4">
              <div class="chart">
                <canvas id="barChart" style="height:250px"></canvas>
              </div>
              <br/>
              <center><div style="font-size:12px;"><div style="background-color:#00c0ef;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> Male &nbsp;&nbsp;&nbsp;
              <div style="background-color:#00a65a;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;</div> Female</div></center><br/>
              </div>
               <div class="col-md-4">
				  <div class="chart">
					<canvas id="chart-area" style="height:230px"></canvas>
				  </div>
              </div>
			  <div class="col-md-4">
                 <table class="table table-bordered">
				 <tr class="bg-blue text-white">
                 
                  <th>Reading</th>
                  <th>Male</th>
                  <th>Female</th>
                </tr>
				 <?php 
				     $high_bp_count = 0;
				     $low_bp_count = 0;
				 foreach($chartdata['bp']['table'] as $key=>$value) { 
				     
				if($value['cat_id']==2 || $value['cat_id']==3 || $value['cat_id']==4 ){
				    $high_bp_count +=$value['total_cnt'];
				}
				if($value['cat_id']==5){
				    $low_bp_count +=$value['total_cnt'];
				}
			
				 
				 ?>
                
                <tr>
                  
                  <td><div style="background-color:<?php echo $value['chart_regular_color']?>;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>  <?php echo $value['reading']?></td>
                  <td>
                      <?php echo $value['male_count']?>
                  </td>
                  <td><?php echo $value['female_count']?></td>
                </tr>
				 <?php }
				 $high_bp_per = ($high_bp_count>0)?round(($high_bp_count/$arr_count['total_employees'])*100):0;
				 $low_bp_per = ($low_bp_count>0)?round(($low_bp_count/$arr_count['total_employees'])*100):0;
				 ?>
                
                
              </table> 
           <h5 class="gsmallresult margin0" style="font-size: 12px;line-height:15px;"><span class="badge1 bg-danger1" style="font-size:13px"><b><?php echo $high_bp_per?>%</b></span> of <?php echo  $arr_cluster['cluster_business_name']?> has <span class="text-danger">High Blood Pressure Levels</span> <br/><br/> <span class="badge1 bg-danger1" style="font-size:13px;font-weight:strong;"><?php echo $low_bp_count?>%</span> of <?php echo $arr_cluster['cluster_business_name']?> has <span class="text-danger">Low Blood Pressure Levels</span></h5>
                </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
         
           
          
               
		  </div>
           
      </div>
      <div class="swiper-container graph-container">
			<div class="col-md-12">
			 <!-- BAR CHART -->
			 	
			  <div class="box box-success">
            <div class="box-header with-border">
 <div class="pre-header" style="margin: 8px 0;">
                      <h5 class="margin0 text-uppercase2"><b>BMI Observations</b></h5>
                      <!--<a href="#" class="btn2">BMI</a>-->
                    </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="row">
                <div class="col-md-4">
              <div class="chart">
                <canvas id="barChart_bmi" style="height:250px"></canvas>
              </div><br/>
              <center><div style="font-size:12px;"><div style="background-color:#00c0ef;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> Male &nbsp;&nbsp;&nbsp;
              <div style="background-color:#00a65a;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;</div> Female</div></center><br/>
              </div>
               <div class="col-md-4">
				  <div class="chart">
					<canvas id="chart-area_bmi" style="height:230px"></canvas>
				  </div>
              </div>
			  <div class="col-md-4">
                 <table class="table table-bordered">
				 <tr class="bg-blue text-white">
                 
                  <th>Reading</th>
                  <th>Male</th>
                  <th>Female</th>
                </tr>
				 <?php 
				     $high_bmi_count = 0;
				     $low_bmi_count = 0;
				 foreach($chartdata['bmi']['table'] as $key=>$value) { 
				     
				if($value['cat_id']==2 ){
				    $high_bmi_count +=$value['total_cnt'];
				}
				if($value['cat_id']==3){
				    $low_bmi_count +=$value['total_cnt'];
				}
			
				 
				 ?>
                
                <tr>
                  
                  <td><div style="background-color:<?php echo $value['chart_regular_color']?>;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> <?php echo $value['reading']?></td>
                  <td>
                      <?php echo $value['male_count']?>
                  </td>
                  <td><?php echo $value['female_count']?></td>
                </tr>
				 <?php }
				 $high_bmi_per = ($high_bmi_count>0)?round(($high_bmi_count/$arr_count['total_employees'])*100):0;
				 $low_bmi_per = ($low_bmi_count>0)?round(($low_bmi_count/$arr_count['total_employees'])*100):0;
				 ?>
                
                
              </table> 
           <h5 class="gsmallresult margin0" style="font-size: 12px;line-height:15px;"><span class="badge1 bg-danger1" style="font-size:13px"><b><?php echo $high_bmi_per?>%</b></span> of <?php echo  $arr_cluster['cluster_business_name']?> are  <span class="text-danger">Overweight</span> <br/><br/> <span class="badge1 bg-danger1" style="font-size:13px;font-weight:strong;"><?php echo $low_bmi_count?>%</span> of <?php echo $arr_cluster['cluster_business_name']?> are <span class="text-danger">Underweight</span></h5>
           
                </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
         
           
          
               
		  </div>
           
      </div>
            <div class="swiper-container graph-container">
			<div class="col-md-12">
			 <!-- BAR CHART -->
			 	<?php if(!empty($chartdata['bs']['table']) ){?>
			  <div class="box box-success">
            <div class="box-header with-border">
 <div class="pre-header" style="margin: 8px 0;">
                      <h5 class="margin0 text-uppercase2"><b>Blood Sugar Observations</b></h5>
                      <!--<a href="#" class="btn2">BMI</a>-->
                    </div>
                    
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="row">
                <div class="col-md-4">
              <div class="chart">
                <canvas id="barChart_bs" style="height:250px"></canvas>
              </div>
              <br/>
              <center><div style="font-size:12px;"><div style="background-color:#00c0ef;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> Male &nbsp;&nbsp;&nbsp;
              <div style="background-color:#00a65a;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;</div> Female</div></center><br/>
              </div>
               <div class="col-md-4">
				  <div class="chart">
					<canvas id="chart-area_bs" style="height:230px"></canvas>
				  </div>
				  
              </div>
			  <div class="col-md-4">
                 <table class="table table-bordered">
				 <tr class="bg-blue text-white">
                 
                  <th>Reading</th>
                  <th>Male</th>
                  <th>Female</th>
                </tr>
				 <?php 
				     $pre_diabetic_count = 0;
				     $diabetic_count = 0;
				 foreach($chartdata['bs']['table'] as $key=>$value) { 
				     
				if($value['cat_id']==2 ){
				    $pre_diabetic_count +=$value['total_cnt'];
				}
				if($value['cat_id']==3){
				    $diabetic_count +=$value['total_cnt'];
				}
			
				 
				 ?>
                
                <tr>
                  
                  <td><div style="background-color:<?php echo $value['chart_regular_color']?>;width: 18px;height: 28px;display: inline;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> <?php echo $value['reading']?></td>
                  <td>
                      <?php echo $value['male_count']?>
                  </td>
                  <td><?php echo $value['female_count']?></td>
                </tr>
				 <?php } 
				 $pre_diabetic_count = ($pre_diabetic_count>0)?round(($pre_diabetic_count/$arr_count['total_employees'])*100):0;
				 $diabetic_count = ($diabetic_count>0)?round(($diabetic_count/$arr_count['total_employees'])*100):0;
				 ?>
                
                
              </table> 
           <h5 class="gsmallresult margin0" style="font-size: 12px;line-height:15px;"><span class="badge1 bg-danger1" style="font-size:13px"><b><?php echo $pre_diabetic_count?>%</b></span> of <?php echo  $arr_cluster['cluster_business_name']?> are  <span class="text-danger">Prediabetic</span> <br/><br/> <span class="badge1 bg-danger1" style="font-size:13px;font-weight:strong;"><?php echo $diabetic_count?>%</span> of <?php echo $arr_cluster['cluster_business_name']?> are <span class="text-danger">Diabetic</span></h5>
                </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
         
           <?php }else{ ?>
            <div class="box box-success">
            <div class="box-header with-border">
 <div class="pre-header" style="margin: 8px 0;">
                      <h5 class="margin0 text-uppercase2"><b>Blood Sugar Observations</b></h5>
                      <!--<a href="#" class="btn2">BMI</a>-->
                    </div>
                   <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
                <div class="row">
                <div class="col-md-offset-2 col-md-8"><br/><br/><br/><center>"Seems you have not subscribed for Blood Sugar test for your calleages! Otherwise you could have access the Sugar Level of your organization as well"</center><br/><br/><br/>
                    </div></div></div>
                    </div>
           <?php }?>
               
		  </div>
           
      </div>
	  <!-- sho my report data -->
	  <?php include_once('my_Reports.php') ?>
	  <!-- end of my report -->
      <!-- /.row -->
     <!-- <div class="row">
        <div class="col-sm-12">
          <div class="configure" style="padding-top: 10px;margin-bottom: 5px;margin-top: 50px;box-shadow:0 4px 5px rgba(0,0,0,0.14), 0 3px 8px rgba(0, 0, 0, 0);">
            <div class="pull-left re_arrange_dashboard">
              <h4 class="margin0" style="line-height: 35px;color=#08A006;"><i class="fa fa-tasks"></i> &nbsp;&nbsp;&nbsp;Rearrange Dashboard</h4>
            </div>
            <div class="pull-right cgreen">
              <h4 class="margin0" style="line-height: 35px;">WELCOME PRIYANKA to your Company Health Management System <i class="fa fa-smile-o"></i></h4>
            </div>
            <div class="clearfix"></div>
          </div>  
        </div>
      </div> -->
      <!-- /.row -->
      <!-- <div class="row wow bounceInleft" data-wow-delay="0.8s">
        <div class="col-sm-12">
          <div class="configure digonalsection pt-0 pb-0">
            <div class="col-md-5 padding0 pt-20 pb-20">
              <div class="col-md-12" style="padding-left: 0;    border-right: 1px inset #fff;">
                <div class="sign_up_news">
                 <span class="cblue"></span> "Why should I take a health checkup?"<br>I am prefectly fine!"
                </div>
                <div class="clearfix"></div>
                <div class="mt-10 bracket_area">
				  <span>(8 out of 10 people think like this)</span>
                </div>                
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="col-md-7 padding0 pt-20 pb-20">
              <div id="plannow">                
                
				<div class="col-md-2 stest_icon"><i class="fa fa-stethoscope" aria-hidden="true"></i></div>
                 <div class="col-md-7 sign_up_area"><h3> Sign up for a <span>FREE Health Checkup</span> Today!</h3></div>                
                <div class="col-md-3 pt-10 pb-10 text-center last">
                  <a href="#" class="btn btn-block btn-green cwhite signup_btn">SIGN UP</a>
                  <div class="mt-10"></div>
                  
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>  
        </div>
      </div> -->
      <!-- /.row -->
    <div class="row pt-20">		
        <div class="employe_health_area">
          <div class="col-md-4">
		  <div class="row">
          <h4 class="pull-left margin0"><strong>Healthy Employees</strong></h4>
		</div>
		   <div class="box">            
            <!-- /.box-header -->
		
            <div class="box-body profileimg">
				<?php foreach($emp_arr['healty'] as $row){ 
				
				if((!empty($row['dob']))){
					$age = $database->ageCalculator($row['dob']). ' Yrs';
				}
				$report ='';
				if($row['bmi_status']=='H'){
						$report[] = "BMI: ".$row['bmi_category'];
					}
					if($row['bp_status']=='H'){
						$report[] = "Blood Pressure: ".$row['bp_category'];
					}
					if($row['bs_status']=='H'){
						$report[] = "Blood Sugar: ".$row['bs_result'];
					}
					$report = implode(', ',$report);
					$photo	= (!empty($row['photo_thumb'])) ? $row['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
				?>
             <img src="<?php echo $photo?>" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong><?php echo $row['emp_name']?></strong></span>
			  <span class="info" style="display:block">
					<?php echo $report; ?>
              </span>
			  </span>
				<a class="pull-right" style="top:0px;"> <?php echo $age?></a>
                <hr>
				<?php } ?>
		
               <a href="employee.php?health=H" class="btn2-lg"><h5 class="margin0">View All</h5></a>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        </div>
		
		
		<div class="col-md-4">
			<div class="row">
			  <h4 class="pull-left margin0"><strong>UnHealthy Employees</strong></h4>
			</div>
		    <div class="box">            
            <!-- /.box-header -->
		
            <div class="box-body profileimg">
				<?php foreach($emp_arr['unhealty'] as $row){ 
				
				if((!empty($row['dob']))){
					$age = $database->ageCalculator($row['dob']). ' Yrs';
				}
				$report_arr ='';
				if($row['bmi_status']=='UH'){
						$report_arr[] = "BMI: ".$row['bmi_category'];
					}
					if($row['bp_status']=='UH'){
						$report_arr[] = "Blood Pressure: ".$row['bp_category'];
					}
					if($row['bs_status']=='UH'){
						$report_arr[] = "Blood Sugar: ".$row['bs_result'];
					}
					$report = implode(', ',$report_arr);
					$photo	= (!empty($row['photo_thumb'])) ? $row['photo_thumb'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
					
				?>
             <img src="<?php echo $photo?>" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong><?php echo $row['emp_name']?></strong></span>
			  <span class="info" style="display:block">
					<?php echo $report; ?>
              </span>
			  </span>
				<a class="pull-right" style="top:0px;"> <?php echo $age?></a>
                <hr>
				<?php } ?>
		
               <a href="employee.php?health=UH" class="btn2-lg"><h5 class="margin0">View All</h5></a>
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        </div>
		
		<div class="col-md-4 " data-wow-delay="0.4s">
            <div class="row">
				<h4 class="pull-left margin0"><strong>Quick Stats</strong></h4>
			</div> 
			<div class="smoking_per">
				<div class="blue-band-home">
                    Coming Soon
                  </div>
				<div class="box box-solid healthy_result">
                  <h5 class="margin0 text-uppercase"><b>SMOKING</b></h5> 
                  <div class="progress xs1 mb-10 mt-10">
                    <!-- Change the css width attribute to simulate progress -->
					<div class="progress-bar progress-bar-danger" role="progressbar" style="width:35%">Danger</div>
                    <div class="progress-bar progress-bar-cgreen" style="width:65%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
					
				  </div>
				  <div class="result"><span class="red"><i class="fa fa-circle" aria-hidden="true"></i> Smokers 35%</span><span class="green"><i class="fa fa-circle" aria-hidden="true"></i> Non Smokers 65%</span></div>
					<h5 class="mt-10 text-uppercase"><b>RISK OF DIASEASE</b></h5>                 
					<div class="progress xs1 mb-10 mt-10">
                    <!-- Change the css width attribute to simulate progress -->					
                    <div class="progress-bar progress-bar-cgreen progress_bar_blue" style="width:85%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
					
				  </div>
				  <div class="progress xs1 mb-10 mt-10">
                    <!-- Change the css width attribute to simulate progress -->					
                    <div class="progress-bar progress-bar-cgreen progress_bar_aqau" style="width:70%;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
					
				  </div>
				  <div class="result"><span class="blue"><i class="fa fa-circle" aria-hidden="true"></i> Cardivascular Disease Risk 35%</span><span class="aqua"><i class="fa fa-circle" aria-hidden="true"></i> Diabetes 30%</span></div>
				</div>
			</div>	
			<div class="">
				<div class="box box-solid sex_ratio">
					<h5 class="margin0 text-uppercase"><b>SEX RATIO</b></h5>
					  <div class="male_Area mt-20 mob-mt10">
						<img src="images/male.png" class="male_icon"></i>
						<div class="person_info">
						<div class="name">
							Males
						</div>
						<div class="age">
							<?php echo $arr_count['male_employee']?>
						</div>
						</div>
						<div class="ratio_percent total_percent">
							<a href="#" class="show_digit">
							<span style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<span style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<span style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<span style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<div id="show_percent" style="display:none">100%</div>
							</a>
							
						</div>
						<div class="ratio_percent">
												
						</div>
					  </div>
					  <div class="male_Area female_area">
						<img src="images/female.png" class="female_icon"></i>
						<div class="person_info">
						<div class="name">
							Females
						</div>
						<div class="age">
							<?php echo $arr_count['female_employee']?>
						</div>
						</div>
						<div class="ratio_percent total_percent female_ratio">
							<a href="#" class="show_digit">
							<span class="female_ratio_per" style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<span class="female_ratio_per" style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<span class="female_ratio_per" style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<span class="female_ratio_per" style="display:block;float:left">
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							<div class="circle_percentage"></div>
							</span>
							<div id="show_percent" style="display:none">100%</div>
							</a>
						
						</div>
					  </div>
                </div>
			</div>
		</div>
    </div>
      <!-- /.row -->
		
      <div class="row pt-20">
		<div class="col-md-12">
		  <h4><strong>My Health Goals</strong></h4>          
		</div>		
		<div class="clearfix"></div>
        <div id="graph3" class="package-container">
          <div class="swiper-container graph-container3">
            <div class="swiper-wrapper">
              <!-- /.col -->
              <div class="col-dm-4 wow bounceInRight swiper-slide health_goal_area" data-wow-delay="0.7s" style="margin:20px;">
                <div class="box box-solid" style="border:1px solid #43ce5a">					
					<div id="container"></div>
					<div class="health_goal_info">
						 <h5 class="margin0 text-uppercase text-center text-black value"><b><span id="steps_goal"><?php echo $goal_arr[0]['steps'];?></span></b></h5>
						<h5 class="text-uppercase text-center text-black margin0" style="font-weight: bold;font-size:20px;"><b>STEPS / DAY</b></h5>
						<h4 class="mb-10 text-center date">By Jan 2018</h4>
						
					</div>
                </div>
              </div>
               <div class="col-dm-4 wow bounceInRight swiper-slide health_goal_area" data-wow-delay="0.6s" style="margin:20px;">
                <div class="box box-solid" style="border:1px solid #43ce5a">					
					<div class="progress">
					  <div class="barOverflow">
						<div class="bar"></div>
					  </div>
					  <span>67</span>%
					</div>
					<div class="health_goal_info">
						 <h5 class="margin0 text-uppercase text-center text-black value"><b><span id="sleep_goal"><?php echo $goal_arr[0]['sleep'];?></span> Hrs</b></h5>
						<h5 class="text-uppercase text-center text-black margin0" style="font-weight: bold;font-size:20px;"><b>SLEEP / Night</b></h5>
						<h4 class="mb-10 text-center date">By Jan 2018</h4> 
						
					</div>
                </div>
              </div>
			     
			   <div class="col-dm-4 wow bounceInRight swiper-slide health_goal_area" data-wow-delay="0.7s" style="margin:20px;" ><!--onClick="openGoalForm();"-->
                <div class="box box-solid" style="border:1px solid #43ce5a">
					<div class="blue-band-home">
                    Coming Soon
                  </div>
				<span class="add_new_tab"><i class="fa fa-plus"></i></span>
					  <h5 class="text-uppercase text-center text-black" style="font-weight: bold;font-size:18px;"><b>ADD A GOAL</b></h5>
                  
                </div>
              </div>
			
              <!-- /.col -->              
            </div>
            <div class="swiper-pagination3"></div>
           <!-- <div class="swiper-button-next packages_next3"></div>
            <div class="swiper-button-prev packages_prev3"></div> -->
          </div>
        </div>  
      </div>
      <!-- /.row -->

      <div id="others" class="row" >
		<div class="col-md-4 wow bounceInLeft  pt-20" data-wow-delay="0.2s">
			<h4 class="pull-left margin0"><strong>Corporate Diet Plans</strong></h4>
			<div class="clearfix"></div><br/>
			<div class="box box-solid">
				<div class="blue-band-home">
                    Coming Soon
                  </div>
				<div class="p-20">
					<div class="mt-20">
						<div class="col-sm-12">
						<h4 class="pull-left margin0"><b>HEALTHY SNACKS</b></h4>
						</div>
						<div class="clearfix"></div>  
						<div class="p-20">
						<div class="col-sm-5">
						<img src="images/diet/1.png" />
						<div class="task done"></div>
						</div>
						<div class="col-sm-7 snack_font">
						<span>Use the treats and energy-boosting snacks during work hours</span>
						</div>
						<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr class="hrdivide">
					<div class="clearfix"></div>
					<div class="mt-20">
						<div class="col-sm-12">
						<h4 class="pull-left margin0"><b>HEALTHY LUNCH</b></h4>
						</div>
						<div class="clearfix"></div>  
						<div class="p-20">
							<div class="col-sm-5">
								<img src="images/lunch_img.png"/>                    
							</div>
							<div class="col-sm-7 snack_font">
								<span>Add extra salad or veg to meals to help fill you up and keep you healthier</span>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					<div class="clearfix"></div>
					<hr class="hrdivide">
					<div class="clearfix"></div>
					<div class="pt-20 mt-10">
						<a href="#" class="btn2-lg"><h5 class="margin0">View full plan</h5></a>
					</div>
				</div>  
			</div>
		</div>
        <!-- /.col -->
        <div class="col-md-4 wow bounceInUp  pt-20" data-wow-delay="0.4s">
			<h4 class="pull-left margin0"><strong>Pick a challenge</strong></h4>
			<div class="clearfix"></div><br/>
			<div class="box box-solid">
				<div class="blue-band-home">
                    Coming Soon
                  </div>
				<div class="p-20 pick_challege_img">
					<ul>
						<h3>WEEK 1</h3>
					  <li class="passed">Eat vegetables with every meal</li>
					  <li class="passed">Drink atleast 8 glasses of water in a day</li>
					  <li class="passed">Exercise for 45 minutes in a day</li>	
							<h3>WEEK 2</h3>	  
					  <li class="current">Drink atleast 8 glasses of water in a day</li>
					  <li class="passed">Write down everything you eat or drink: Track down your caloires too</li>
					  <li class="passed">Exercise for 20 minutes in a day</li>
					</ul>
					<div class="allarticle">
						<a href="#" class="btn2-lg"><h5 class="margin0">View All</h5></a>
					</div>			   
				</div>
			</div>
        </div>
        <!-- /.col -->
		<div class="col-md-4 wow bounceInRight  pt-20" data-wow-delay="0.5s">
			<h4 class="pull-left margin0"><strong>Worth Reading</strong></h4>
			<div class="clearfix"></div>
			<br/>
			<div class="box box-solid">
				<div class="blue-band-home">
                    Coming Soon
                  </div>
				<div class="col-md-12">
					<div class="article">
						<h4 class="mt-0"><span style="font-size:18px;1.5">How I Finally Got Serious <br>About My Health</span></h4>
						<img src="images/articles/1.png" />
					</div>
					<div class="article">
						<h4 class="mt-10"><span style="font-size:18px;">When your health costs <br>you your job</span></h4>
						<img src="images/articles/2.png" />
					</div>
					<div class="allarticle">
						<a href="#" class="btn2-lg"><h5 class="margin0">View All</h5></a>
					</div>  
				</div> 
			</div>
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
              <input type="text" name="bp" value="80 mm" style="background: tranbsparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-5">
            <div class="fieldname">
              Blood Sugar (After Eating):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="120 hg" style="background: tranbsparent;border: none;width: 100%;" />
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
              <input type="text" name="bp" value="00 mm" style="background: tranbsparent;border: none;width: 100%;" />
            </h4>
          </div>
           <div class="col-sm-5">
            <div class="fieldname">
              Blood Sugar (After Eating):
            </div>
            <h4 class="field-details pb-10">
              <input type="text" name="bp" value="00 hg" style="background: tranbsparent;border: none;width: 100%;" />
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
	    <div class="modal fade" id="goal_form_div">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Your Goals</h4>
              </div><form name="goal-form" id="goal-form" method="post" action="">
			  <input type="hidden" name="action"  id="goal_action" value="save_goal" />
			  <input type="hidden" name="cluster_id"  id="cluster_id" value="<?php echo $clusterId ?>" />
              <div class="modal-body">
			<!--  <form id="goal_form" name="goal_form" action="">
			   <input type="hidden" name="action"  id="goal_action" value="save_goal" />
                <div class="row">
               <div class="row"> 
				  
					<div class="form-group">
					
						<div class="col-sm-8">
							
								 <input type="text" name="steps" class="form-control input-sm pull-right" id="steps" placeholder="Steps/Day"  />
							
						</div>
					</div>
						</div>
						<div class="row"> 
						<div class="col-sm-8">
							<div class="form-group">
								<input type="text" name="sleep" class="form-control input-sm pull-right" id="sleep" placeholder="Sleep/Night"  />
							</div>
						</div>
					
					
					
						</div>
					
					
				</div>
				</form> -->
				
    <div id="login_message_div"></div>
			<input type="hidden" name="ajaxlogin" value="on">
      <div class="form-group has-feedback">
	  <input type="text" name="steps" class="form-control " id="steps" placeholder="Steps/Day" required />
        
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="sleep" class="form-control " id="sleep" placeholder="Sleep/Night"  required />
      </div>
    
   
              </div>
              <div class="modal-footer">
               <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
			   <button type="submit" class="btn btn btn-warning"  >Save</button>
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>

              </div> </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
  
<?php include_once('partials/footer.php'); ?>
<!-- FLOT CHARTS 
<script src="plugins/flot/jquery.flot.min.js"></script>
 FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized 
<script src="plugins/flot/jquery.flot.resize.min.js"></script>
 FLOT PIE PLUGIN - also used to draw donut charts 
<script src="plugins/flot/jquery.flot.pie.min.js"></script>
 FLOT CATEGORIES PLUGIN - Used to draw bar charts 
<script src="plugins/flot/jquery.flot.categories.min.js"></script> -->
<!--<script src="plugins/datepicker/bootstrap-datepicker.js"></script>-->
<script src="plugins/swiper/swiper.js"></script>
<!-- Page script -->
<script src="plugins/materialize/materialize.js"></script>
<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>

<script src="dist/js/chart.js"></script>

<script>
		  $(document).ready(function(){
			  //alert("d2");
		  	$('#change_package').change(function(){
				//alert("d");
		$('#change_package option:selected').each(function(){
		$('#last_package_statistics').html('<br /><br /><br /><p class="text-center text-muted"><i class="fa fa-rotate-right fa-spin fa-4x"></i></p><br /><br /><br />');
			var id = $(this).val();
        	$.ajax({
			url: 'lps.php?package_id='+id,
			success: function(response){
					$('#last_package_statistics').html(response);
				}
			});
		});
	});
	});
  $(document).ready(function() {
	  $('.dashboard_menu').addClass('active');
	$("#goal-form").validate({        
		rules:{            
			required:{
				required:true
			},
		},        
		errorClass: "help-inline text-white",        
		errorElement: "span",        
		highlight:function(element, errorClass, validClass) {            
		$(element).parents('.form-group').addClass('has-error');        
		},        unhighlight: function(element, errorClass, validClass) {            
		$(element).parents('.form-group').removeClass('has-error');            
		$(element).parents('.form-group').addClass('has-success');        
		},		
		submitHandler: function() {			
			saveGoal();
			  $('#goal_form_div').modal('hide');
   $('input[type="text"], textarea').val('');
			return false;		
		}    
	});
    //Date picker
    /*$('#datepicker11,#datepicker2,#datepicker3').datepicker({
      autoclose: true
    });*/
    $('#datepicker,#datepicker2,#datepicker3,#datepicker4').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      today: 'Today',
      clear: 'Clear',
      close: 'Ok',
      closeOnSelect: false // Close upon selecting a date,
    });
  });
  $(function () {
    $('#datepicker').on('click', function () {
      setTimeout(addnew,1500);
    });
    function addnew(){
      $('#prevbp').css("display", "block")
    }
    $('#addbloodsugar').on('click', function () {
      $('#bloodsugar').modal('show');
      setTimeout(checksugar,500);
    });
    function checksugar(){
      if($('#bloodsugar').hasClass('in')){
        $('body').addClass('modal-open');
      }
    }

    
  });
  
</script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------


    var areaChartData = {
      labels  : [<?php echo $chartdata['bp']['label']?>],
      datasets: [
        {
          label               : 'Male',
          fillColor           : '#00c0ef',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $chartdata['bp']['Male']?>]
        },
        {
          label               : 'Female',
          fillColor           : 'rgba(60,141,188,0.9)',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $chartdata['bp']['Female']?>]
        }
      ]
    }

   



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
	   multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
	  
    }

    barChartOptions.datasetFill = false
    
     barChart.Bar(barChartData, barChartOptions)
    ///bmi chart
    var areaChartData_bmi = {
      labels  : [<?php echo $chartdata['bmi']['label']?>],
      datasets: [
        {
          label               : 'Male',
          fillColor           : '#00c0ef',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $chartdata['bmi']['Male']?>]
        },
        {
          label               : 'Female',
          fillColor           : '#00a65a',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $chartdata['bmi']['Female']?>]
        }
      ]
    }
    var barChartCanvas_bmi          = $('#barChart_bmi').get(0).getContext('2d')
    var barChart_bmi                = new Chart(barChartCanvas_bmi)
     var barChartData_bmi                     = areaChartData_bmi
    barChart_bmi.Bar(barChartData_bmi, barChartOptions)
	
	//Blood sugar
	 <?php if(!empty($chartdata['bs']['table']) ) {?>
    var areaChartData_bs = {
      labels  : [<?php echo $chartdata['bs']['label']?>],
      datasets: [
        {
          label               : 'Male',
          fillColor           : '#00c0ef',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [<?php echo $chartdata['bs']['Male']?>]
        },
        {
          label               : 'Female',
          fillColor           : '#00a65a',
          strokeColor         : 'rgba(60,141,188,0.8)',
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $chartdata['bs']['Female']?>]
        }
      ]
    }
    var barChartCanvas_bs          = $('#barChart_bs').get(0).getContext('2d')
    var barChart_bs                = new Chart(barChartCanvas_bs)
     var barChartData_bs                     = areaChartData_bs
    barChart_bs.Bar(barChartData_bs, barChartOptions)
    <?php } ?>
	//end Blood sugar
    window.chartColors = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};
    var pieData = [
        <?php 
         $colorarray[4]['color'] = "#4D5360";
        $colorarray[4]['highlight'] = "#616774";
        $colorarray[0]['color'] = "#F7464A";
        $colorarray[0]['highlight'] = "#FF5A5E";
        $colorarray[1]['color'] = "#46BFBD";
        $colorarray[1]['highlight'] = "#5AD3D1";
        $colorarray[2]['color'] = "#FDB45C";
        $colorarray[2]['highlight'] = "#FFC870";
         $colorarray[3]['color'] = "#949FB1";
        $colorarray[3]['highlight'] = "#A8B3C5";
        /*
        
        color:"#F7464A",
					highlight: "#FF5A5E"
        color: "#46BFBD",
					highlight: "#5AD3D1",
					color: "#FDB45C",
					highlight: "#FFC870",*/
        foreach($chartdata['bp']['table'] as $key=>$value) { 
            
            
            ?>
				{
					value: <?php echo $value['total_cnt']?>,
					color:"<?php echo $value['chart_regular_color']?>",
					highlight: "<?php echo $value['chart_highlight_color']?>",
					label: "<?php echo $value['reading']?>"
				},
				<?php } ?>
		

			];
var pieData2 = [
        <?php 
        
        foreach($chartdata['bmi']['table'] as $key=>$value) { 
            
            
            ?>
				{
					value: <?php echo $value['total_cnt']?>,
					color:"<?php echo $value['chart_regular_color']?>",
					highlight: "<?php echo $value['chart_highlight_color']?>",
					label: "<?php echo $value['reading']?>"
				},
				<?php } ?>
		

			];
			var pieData3 = [
        <?php 
        
        foreach($chartdata['bs']['table'] as $key=>$value) { 
            //$value['chart_regular_color'] = (empty($value['chart_regular_color']))?$colorarray[$key+1]['color']:$value['chart_regular_color'];
           // $value['chart_highlight_color'] = (empty($value['chart_highlight_color']))?$colorarray[$key+1]['color']:$value['chart_highlight_color'];
            
            ?>
				{
					value: <?php echo $value['total_cnt']?>,
					color:"<?php echo $value['chart_regular_color']?>",
					highlight: "<?php echo $value['chart_highlight_color']?>",
					label: "<?php echo $value['reading']?>"
				},
				<?php } ?>
		

			];
			window.onload = function(){
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myPie = new Chart(ctx).Doughnut(pieData);
					var ctx2 = document.getElementById("chart-area_bmi").getContext("2d");
			//	window.myPie2 = new Chart(ctx2).Pie(pieData2);
				window.myDoughnut = new Chart(ctx2).Doughnut(pieData2, {
					responsive:true
				})	
				<?php if(!empty($chartdata['bs']['table']) ) {?>
				var ctx3 = document.getElementById("chart-area_bs").getContext("2d");
			//	window.myPie2 = new Chart(ctx2).Pie(pieData2);
				window.myDoughnut = new Chart(ctx3).Doughnut(pieData3, {
					responsive:true
				});
					<?php } ?>
			};
  })
</script>
<?php include_once('reports_js.php'); ?>
<script>
  $(document).ready(function(){
	  
	 

jQuery.validator.addMethod("bponly", function(value, element) {
  return this.optional(element) || /(1)(\d\d)(\/)(\d\d)/.test(value);
}, "Please enter correct Blood Pressure");
    // input 1 styles
    $(".input__1 input, .textarea__1 textarea").focus(function(){
      if($(this).parent().hasClass("input__1"))
        $(this).prev().removeClass("input__1_blurred").addClass("input__1_focused");
      else if($(this).parent().hasClass("textarea__1"))
        $(this).prev().removeClass("textarea__1_blurred").addClass("textarea__1_focused");

      $(this).prev().parent().css({
        borderBottom : "1px solid #43ce5a"
      });
    });
    $(".input__1 input, .textarea__1 textarea").blur(function(){
      if($(this).val() === ""){
        if($(this).parent().hasClass("input__1"))
          $(this).prev().addClass("input__1_blurred").removeClass("input__1_focused");
        else if($(this).parent().hasClass("textarea__1"))
          $(this).prev().addClass("textarea__1_blurred").removeClass("textarea__1_focused");
        $(this).prev().parent().css({
          borderBottom : "1px solid #95989c"
        });
      }
    });
  });
  $(window).load(function() {
    var swiper = new Swiper('.graph-container', {
      slidesPerView: 3,
      nextButton: '.packages_next',
      prevButton: '.packages_prev',
      // init: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 2,
          spaceBetween: 0,
        },
        800: {
          slidesPerView: 1,
          spaceBetween: 0,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 0,
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 0,
        }
      }
    });
    var swiper2 = new Swiper('.graph-container2', {
      slidesPerView: 3,
      nextButton: '.packages_next2',
      prevButton: '.packages_prev2',
      // init: false,
      pagination: {
        el: '.swiper-pagination2',
        clickable: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 2,
          spaceBetween: 0,
        },
        800: {
          slidesPerView: 1,
          spaceBetween: 0,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 0,
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 0,
        }
      }
    });
    var swiper3 = new Swiper('.graph-container3', {
      slidesPerView: 5,
      nextButton: '.packages_next3',
      prevButton: '.packages_prev3',
      // init: false,
      pagination: {
        el: '.swiper-pagination3',
        clickable: true,
      },
      breakpoints: {
        1024: {
          slidesPerView: 3,
          spaceBetween: 0,
        },
        800: {
          slidesPerView: 3,
          spaceBetween: 0,
        },
        640: {
          slidesPerView: 2,
          spaceBetween: 0,
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 0,
        }
      }
    });
  });
</script>



<script>
	$(".progress").each(function(){
  
  var $bar = $(this).find(".bar");
  var $val = $(this).find("span");
  var perc = parseInt( $val.text(), 10);

  $({p:0}).animate({p:perc}, {
    duration: 3000,
    easing: "swing",
    step: function(p) {
      $bar.css({
        transform: "rotate("+ (14+(p*1.8)) +"deg)", // 100%=180¡Æ so: ¡Æ = % * 1.8
        // 45 is to add the needed rotation to have the green borders at the bottom
      });
      $val.text(p|0);
    }
  });
});


var bar = new ProgressBar.SemiCircle(container, {
  strokeWidth: 10,
  color: 'red',
  trailColor: '#eee',
  trailWidth: 10,
  easing: 'easeInOut',
  duration: 1400,
  svgStyle: null,
  text: {
    value: '',
    alignToBottom: false
  },
  
  // Set default step function for all animate calls
  step: (state, bar) => {
    bar.path.setAttribute('stroke', state.color);
    var value = Math.round(bar.value() * 100);
    if (value === 0) {
      bar.setText('');
    } else {
      bar.setText(value+"%");
    }

    bar.text.style.color = state.color;
  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '2rem';

bar.animate(0.68);  // Number from 0.0 to 1.0

</script>
<script>
  function openGoalForm(){
	   $('#goal_form_div').modal('show');
   }  
   function saveGoal(){
	   	   $('#goal_form_div').modal('show');
		  // alert("t--"+$('#goal-form').serialize());
	   	$.ajax({				
		url: 'operation.php',				
		type: 'POST',				
		dataType: 'json',				
		async: false,				
		data: $('#goal-form').serialize(),				
		success: function(response) {	
//alert("t"+response);
			
			$('#steps_goal').html(response.steps);
			$('#sleep_goal').html(response.sleep);
			
		}
	})
   }
</script>

<script src="http://dimplejs.org/dist/dimple.v2.3.0.min.js"></script>
  <script type="text/javascript">
    var svg = dimple.newSvg("#chartContainer", 590, 400);
    d3.tsv("/data/example_data.tsv", function (data) {
      var myChart = new dimple.chart(svg, data);
      myChart.setBounds(90, 35, 480, 325)
      myChart.addCategoryAxis("x", ["Channel", "Price Tier"]);
      myChart.addCategoryAxis("y", "Owner");
      myChart.addSeries("Price Tier", dimple.plot.bubble);
      myChart.addLegend(240, 10, 330, 20, "right");
      myChart.draw();
    });
  </script>

  

</body>
</html>
