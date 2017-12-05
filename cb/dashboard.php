<?php include_once('partials/header.php'); ?>
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
.health_goal_area{color:#ccc;width:24%!important;}
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
  width:100%; height:270px; /* full circle! */
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




  </style>

  <!-- Left side column. contains the logo and sidebar -->
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <?php
$arr_count = $database->getDashboardCount($clusterId);
echo "<pre>";
print_R($arr_cluster);
echo "</pre>";//die;
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
		<div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-aqua"><i class="fa ion-ios-medkit-outline"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"><?php echo $arr_count['package_count']?> Health Package(s)</span>
				<span class="info-box-number">Purchase</span>
			</div>
			<!-- /.info-box-content -->
			</div>		
		</div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
				<div class="info-box-content">
				  <span class="info-box-text"><?php echo $arr_count['employee_count']?> Employees</span>
				  <span class="info-box-number">Onboarded</span>
				</div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-yellow"><i class="fa fa-file-text"></i></span>
				<div class="info-box-content">
					<span class="info-box-text">5 Reports</span>
					<span class="info-box-number">Health Index</span>
				</div>
            <!-- /.info-box-content -->
			</div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
			<div class="info-box dashboard_summary_view">
				<span class="info-box-icon bg-red add_tab_top"><i class="fa fa-plus"></i></span>
				<div class="info-box-content">
					<span class="info-box-text mt-10">Add Tabs</span>
				</div>
			<!-- /.info-box-content -->
			</div>
          <!-- /.info-box -->
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
			    <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="line-chart-6" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
		  </div>
            <div class="swiper-wrapper pt-20">
              <div class="col-md-4 wow bounceInLeft swiper-slide" data-wow-delay="0.2s">
                <!-- Line chart -->
                <div class="box box-primary mb-10" style="box-shadow: none;">
                  <div class="blue-band-home">
                    Sample
                  </div>
                  <div class="box-header with-border">
                    <div class="pre-header" style="margin: 8px 0;">
                      <h5 class="margin0 text-uppercase"><b>AVG. CHOLESTEROL</b></h5>
                      <!--<a href="#" class="btn2">BMI</a>-->
                    </div>
                    <div>
                      <h2 class="box-title pull-left">160-189<span style="font-weight: normal;">mg /dL </span></h2>
                      <div class=" pull-right" style="margin-left: 15px;">
                        <i class="fa fa-sort-asc" style="color: red !important;"></i> 12%
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <h4 class="box-title-sm" style="padding-left: 0px;">100<span style="font-weight: normal;">avg </span></h4>
                  </div>
                  <div class="box-body">
                    <div id="line-chart" style="height: 150px; max-width: 90%; margin: 0 auto;"></div>
                    <div class="clearfix"></div>
                    <div class="pre-header mb-0">
                      <div style="min-height: 58px;padding-top: 10px;">
                        <img src="images/up.png" style="max-width: 8%;margin: 0px 15px 10px;float: left;" />
                       <!-- <h4 class="gresult margin0">56% of Digital Republik has high cholestrol</h4>-->
                        <h5 class="gresult margin0" style="font-size: 0.9em;">56% of Digital Republik has high cholestrol</h5>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body-->
                  
                </div>
                <!-- /.box -->

              </div>
              <!-- /.col -->
              <div class="col-md-4 wow bounceInRight swiper-slide" data-wow-delay="0.5s" style="width: 421px; visibility: visible; animation-delay: 0.5s; animation-name: bounceInRight;">
                <!-- Line chart -->
                <div class="box box-primary mb-10" style="box-shadow: none;">
                  <div class="blue-band-home">
                    Sample
                  </div>
                  <div class="box-header with-border">
                    <div class="pre-header">
                      <h5 class="margin0 text-uppercase"><b>AVG.BLOOD SUGAR LEVELS</b></h5>
                    </div>
                    <div>
                      <h2 class="box-title pull-left">161 <span style="font-weight: normal;">mg</span></h2>
                      <div class=" pull-right" style="margin-left: 15px;">
                        <i class="fa fa-sort-asc" style="color: red !important;"></i> 16%
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <h4 class="box-title-sm" style="padding-left: 5px;">157 <span style="font-weight: normal;">avg</span></h4>
                  </div>
                  <div class="box-body">
                    <div id="line-chart2" style="height: 150px; max-width: 90%; margin: 0px auto; padding: 0px; position: relative;"><canvas class="flot-base" width="333" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 333px; height: 150px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 181px; top: 133px; left: 16px; text-align: center;">Mar</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 181px; top: 133px; left: 75px; text-align: center;">Apr</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 181px; top: 133px; left: 133px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 181px; top: 133px; left: 193px; text-align: center;">Jun</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 181px; top: 133px; left: 254px; text-align: center;">Jul</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 181px; top: 133px; left: 307px; text-align: center;">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 120px; left: 14px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 90px; left: 7px; text-align: right;">50</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 60px; left: 1px; text-align: right;">100</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 30px; left: 1px; text-align: right;">150</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">200</div></div></div><canvas class="flot-overlay" width="333" height="150" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 333px; height: 150px;"></canvas></div>
                    <div class="clearfix"></div>
                    <div class="pre-header mb-0">
                      <div style="min-height: 58px;padding-top: 10px;">
                        <img src="images/up.png" style="max-width: 8%;margin: 0px 15px 10px;float: left">
                      <!--  <h4 class="gresult margin0">You have high Blood Sugar Level</h4>-->
                        <h5 class="gsmallresult margin0" style="font-size: 0.9em;">19% of Digital Republik has high Blood Sugar Levels</h5>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body-->
                </div>
                <!-- /.box -->

              </div>
              <!-- /.col -->
              <div class="col-md-4 wow bounceInRight swiper-slide" data-wow-delay="0.5s">
                <!-- Line chart -->
                <div class="box box-primary mb-10" style="box-shadow: none;">
                  <div class="blue-band-home">
                    Sample
                  </div>
                  <div class="box-header with-border">
                    <div class="pre-header">
                      <h5 class="margin0 text-uppercase"><b>AVG.BLOOD SUGAR LEVELS</b></h5>
                    </div>
                    <div>
                      <h2 class="box-title pull-left">161 <span style="font-weight: normal;">mg</span></h2>
                      <div class=" pull-right" style="margin-left: 15px;">
                        <i class="fa fa-sort-asc" style="color: red !important;"></i> 16%
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <h4 class="box-title-sm" style="padding-left: 5px;">157 <span style="font-weight: normal;">avg</span></h4>
                  </div>
                  <div class="box-body">
                    <div id="line-chart3" style="height: 150px; max-width: 90%; margin: 0 auto;"></div>
                    <div class="clearfix"></div>
                    <div class="pre-header mb-0">
                      <div style="min-height: 58px;padding-top: 10px;">
                        <img src="images/up.png" style="max-width: 8%;margin: 0px 15px 10px;float: left" />
                      <!--  <h4 class="gresult margin0">You have high Blood Sugar Level</h4>-->
                        <h5 class="gsmallresult margin0" style="font-size: 0.9em;">19% of Digital Republik has high Blood Sugar Levels</h5>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body-->
                </div>
                <!-- /.box -->

              </div>
              <!-- /.col -->
              </div>
      </div>
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
             <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="top:0px;">28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="top:0px;">28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="top:0px;">28 yrs</a>
                <hr>
			 <a href="#" class="btn2-lg"><h5 class="margin0">View All</h5></a>
              
           
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
             <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="top:0px;">28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="top:0px;">28 yrs</a>
                <hr>
			 <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">
			  <span class="profile_info" style="">
			  <span class="name" style=""><strong>John Fernandes</strong></span>
			  <span class="info" style="display:block">
					Lorem Ipsum is simply dummy text
              </span>
			  </span>
				<a class="pull-right" style="top:0px;">28 yrs</a>
                <hr>
			 <a href="#" class="btn2-lg"><h5 class="margin0">View All</h5></a>
              
           
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        </div>
		
		<div class="col-md-4 " data-wow-delay="0.4s">
            <div class="row">
				<h4 class="pull-left margin0"><strong>Quick Stats</strong></h4>
			</div> 
			<div class="">
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
					  <div class="male_Area mt-20">
						<img src="images/male.png"></i>
						<div class="person_info">
						<div class="name">
							Males
						</div>
						<div class="age">
							50
						</div>
						</div>
						<div class="ratio_percent"><img src="images/average.png"></div>
					  </div>
					  <div class="male_Area mt-10">
						<img src="images/female.png"></i>
						<div class="person_info">
						<div class="name">
							Females
						</div>
						<div class="age">
							28
						</div>
						</div>
						<div class="ratio_percent"><img src="images/average2.png" style="    margin-left:-22px;"></div>
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
						<h5 class="margin0 text-uppercase text-center text-black value"><b><span id="steps_goal"><?php echo $dataArr['goal']['steos'];?></span></b></h5>
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
						<h5 class="margin0 text-uppercase text-center text-black value"><b><span id="sleep_goal"><?php echo $dataArr['goal']['sleep'];?></span> Hrs</b></h5>
						<h5 class="text-uppercase text-center text-black margin0" style="font-weight: bold;font-size:20px;"><b>SLEEP / Night</b></h5>
						<h4 class="mb-10 text-center date">By Jan 2018</h4>
					</div>
                </div>
              </div>
			     
			   <div class="col-dm-4 wow bounceInRight swiper-slide health_goal_area" data-wow-delay="0.7s" style="margin:20px;cursor:pointer;" onClick="openGoalForm();">
                <div class="box box-solid" style="border:1px solid #43ce5a">
					<span class="add_new_tab"><i class="fa fa-plus"></i></span>
					  <h5 class="text-uppercase text-center text-black" style="font-weight: bold;font-size:18px;"  ><b>ADD A GOAL</b></h5>
                  
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
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="plugins/flot/jquery.flot.categories.min.js"></script>
<!--<script src="plugins/datepicker/bootstrap-datepicker.js"></script>-->
<script src="plugins/swiper/swiper.js"></script>
<!-- Page script -->
<script src="plugins/materialize/materialize.js"></script>
<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
<script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>

<script>
  $(document).ready(function() {
	  
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
    /*
     * LINE CHART 1
     * ----------
     */
	   var line_data2 = {
      data:  [["Jan", 110], ["Feb", 66.5], ["Mar", 150.5], ["Apr", 69.8], ["May", 71], ["June", 71.8]],
      color: "#bad0d2"
    };
    var line_data21 = {
      data:  [["Jan", 165], ["Feb", 180.5], ["Mar", 100.5], ["Apr", 169.8], ["May", 171], ["June", 171.8]],
      color: "#ccafaa"
    };
    $.plot("#line-chart-6", [line_data2,line_data21], {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3",
       
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: true,
        color: ["#bad0d2", "#ccafaa"]
      },
      yaxis: {
        show: true,
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
    });
    //LINE randomly generated data
    var line_data1 = {
      data:  [["Jan", 65], ["Feb", 66.5], ["Mar", 69.5], ["Apr", 69.8], ["May", 71], ["June", 71.8]],
      color: "#31b3bf"
    };
    $.plot("#line-chart", [line_data1], {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 70, to: 70} }]
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: true,
        color: ["#31b3bf", "#f56954"]
      },
      yaxis: {
        show: true,
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
    });
    //Initialize tooltip on hover
    /*$('<div class="tooltip-inner" id="line-chart-tooltip"></div>').css({
      position: "absolute",
      display: "none",
      opacity: 0.9
    }).appendTo("body");
    $("#line-chart").bind("plothover", function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1].toFixed(2);

        $("#line-chart-tooltip").html(x + " = " + y)
            .css({top: item.pageY + 5, left: item.pageX + 5})
            .fadeIn(200);
      } else {
        $("#line-chart-tooltip").hide();
      }

    });*/
    /* END LINE CHART */
    /*
     * LINE CHART 2
     * ----------
     */
    //LINE randomly generated data
    var line_data2 = {
      data:  [["Jan", 65], ["Feb", 66.5], ["Mar", 69.5], ["Apr", 69.8], ["May", 71], ["June", 71.8]],
      color: "#31b3bf"
    };
    var line_data21 = {
      data:  [["Jan", 165], ["Feb", 166.5], ["Mar", 169.5], ["Apr", 169.8], ["May", 171], ["June", 171.8]],
      color: "#dd4b39"
    };
    $.plot("#line-chart2", [line_data2,line_data21], {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 80, to: 80} },{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 160, to: 160} }]
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: true,
        color: ["#31b3bf", "#f56954"]
      },
      yaxis: {
        show: true,
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
    });
    //Initialize tooltip on hover
    /*$('<div class="tooltip-inner" id="line-chart-tooltip2"></div>').css({
      position: "absolute",
      display: "none",
      opacity: 0.8
    }).appendTo("body");
    $("#line-chart2").bind("plothover", function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1].toFixed(2);

        $("#line-chart-tooltip").html(x + " = " + y)
            .css({top: item.pageY + 5, left: item.pageX + 5})
            .fadeIn(200);
      } else {
        $("#line-chart-tooltip2").hide();
      }

    });*/
    /* END LINE CHART */
    /* END LINE CHART */
    /*
     * LINE CHART 3
     * ----------
     */
    //LINE randomly generated data
    var line_data3 = {
      data:  [["Mar", 150], ["Apr", 165], ["May", 140], ["Jun", 135], ["Jul", 120], ["June", 149]],
      color: "#31b3bf"
    };
    $.plot("#line-chart3", [line_data3], {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 135, to: 135} }]
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: true,
        color: ["#31b3bf", "#f56954"]
      },
      yaxis: {
        show: true,
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
    });
    //Initialize tooltip on hover
    /*$('<div class="tooltip-inner" id="line-chart-tooltip3"></div>').css({
      position: "absolute",
      display: "none",
      opacity: 0.8
    }).appendTo("body");
    $("#line-chart3").bind("plothover", function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1].toFixed(2);

        $("#line-chart-tooltip").html(x + " = " + y)
            .css({top: item.pageY + 5, left: item.pageX + 5})
            .fadeIn(200);
      } else {
        $("#line-chart-tooltip3").hide();
      }

    });*/
    /* END LINE CHART */
    /*
     * LINE CHART 4
     * ----------
     */
    //LINE randomly generated data
    var line_data4 = {
      data:  [["Mar", 150], ["Apr", 165], ["May", 140], ["Jun", 135], ["Jul", 120], ["June", 149]],
      color: "#31b3bf"
    };
    $.plot("#line-chart4", [line_data4], {
      grid: {
        hoverable: true,
        borderColor: "#f3f3f3",
        borderWidth: 1,
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 135, to: 135} }]
      },
      series: {
        shadowSize: 0,
        lines: {
          show: true
        },
        points: {
          show: true
        }
      },
      lines: {
        fill: true,
        color: ["#31b3bf", "#f56954"]
      },
      yaxis: {
        show: true,
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
    });
    //Initialize tooltip on hover
    /*$('<div class="tooltip-inner" id="line-chart-tooltip3"></div>').css({
      position: "absolute",
      display: "none",
      opacity: 0.8
    }).appendTo("body");
    $("#line-chart3").bind("plothover", function (event, pos, item) {

      if (item) {
        var x = item.datapoint[0],
            y = item.datapoint[1].toFixed(2);

        $("#line-chart-tooltip").html(x + " = " + y)
            .css({top: item.pageY + 5, left: item.pageX + 5})
            .fadeIn(200);
      } else {
        $("#line-chart-tooltip3").hide();
      }

    });*/
    /* END LINE CHART */
    /*
     * BAR CHART
     * ---------
     */

    var bar_data = {
      data: [["Mon", 4005], ["Tue", 3500], ["Wed", 4000], ["Thu", 5500], ["Fri", 3800], ["Sat", 1800], ["Sun", 2200]],
      color: "#43ce5a"
    };
    $.plot("#bar-chart", [bar_data], {
      grid: {
        borderWidth: 1,
        borderColor: "#f3f3f3",
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 2500, to: 2500} }]
      },
            
      series: {
        bars: {
          show: true,
          barWidth: 0.09,
          borderRadius: 15,
          align: "center"
        }
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
      
    });
    /* END BAR CHART */
    /*
     * bar-chart2
     * ---------
     */

    var bar_data2 = {
      data: [["Mon", 4005], ["Tue", 3500], ["Wed", 4000], ["Thu", 5500], ["Fri", 3800], ["Sat", 1800], ["Sun", 2200]],
      color: "#ff6184"
    };
    $.plot("#bar-chart2", [bar_data2], {
      grid: {
        borderWidth: 1,
        borderColor: "#f3f3f3",
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 2500, to: 2500} }]
      },
      series: {
        bars: {
          show: true,
          barWidth: 0.09,
          borderRadius: 15,
          align: "center"
        }
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
      
    });
    /* END BAR CHART */
    /*
     * BAR CHART 3
     * ---------
     */

    var bar_data3 = {
      data: [["Mon", 4005], ["Tue", 3500], ["Wed", 4000], ["Thu", 5500], ["Fri", 3800], ["Sat", 1800], ["Sun", 2200]],
      color: "#3b39b5"
    };
    $.plot("#bar-chart3", [bar_data3], {
      grid: {
        borderWidth: 1,
        borderColor: "#f3f3f3",
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 2500, to: 2500} }]
      },
      series: {
        bars: {
          show: true,
          barWidth: 0.09,
          borderRadius: 15,
          align: "center"
        }
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
      
    });
    /* END BAR CHART */
    /*
     * BAR CHART 3
     * ---------
     */

    var bar_data4 = {
      data: [["Mon", 4005], ["Tue", 3500], ["Wed", 4000], ["Thu", 5500], ["Fri", 3800], ["Sat", 1800], ["Sun", 2200]],
      color: "#3b39b5"
    };
    $.plot("#bar-chart4", [bar_data4], {
      grid: {
        borderWidth: 1,
        borderColor: "#f3f3f3",
        tickColor: "#f3f3f3",
        markings: [{ color: "#ffb4cd", lineWidth: 2, yaxis: { from: 2500, to: 2500} }]
      },
      series: {
        bars: {
          show: true,
          barWidth: 0.09,
          borderRadius: 15,
          align: "center"
        }
      },
      xaxis: {
        mode: "categories",
        tickLength: 0
      }
      
    });
    /* END BAR CHART */
  });
  
</script>
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
	// progressbar.js@1.0.0 version is used
// Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

var bar = new ProgressBar.SemiCircle(containercircle, {
  strokeWidth:10,
  color: '#FFEA82',
  trailColor: '#eee',
  trailWidth: 1,
  easing: 'easeInOut',
  duration: 1400,
  svgStyle: null,
  text: {
    value: '',
    alignToBottom: false
  },
  from: {color: '#FFEA82'},
  to: {color: '#21bcc1'},
  // Set default step function for all animate calls
  step: (state, bar) => {
    bar.path.setAttribute('stroke', state.color);
    var value = Math.round(bar.value() * 10000);
    if (value === 0) {
      bar.setText('');
    } else {
      bar.setText(value);
    }

    bar.text.style.color = state.color;
  }
});
bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
bar.text.style.fontSize = '2rem';

bar.animate(1.0);  // Number from 0.0 to 1.0


    $( document ).ready(function() { // 6,32 5,38 2,34
        $("#test-circle").circliful({
            animation: 1,
            animationStep: 5,
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
            percent: 38,
            textSize: 28,
            textStyle: 'font-size: 12px;',
            textColor: '#666',
            multiPercentage: 1,
            percentages: [10, 20, 30]
        });
        $("#test-circle2").circliful({
            animation: 0,
            animationStep: 6,
            foregroundBorderWidth: 5,
            backgroundColor: "none",
            fillColor: '#eee',
            percent: 50,
            iconColor: '#3498DB',
            icon: 'f206',
            iconSize: '40',
            iconPosition: 'middle'
        });
        $("#test-circle3").circliful({
            animation: 1,
            animationStep: 6,
            foregroundBorderWidth: 5,
            backgroundBorderWidth: 1,
            percent: 88,
            iconColor: '#3498DB',
            icon: 'f004',
            iconSize: '40',
            iconPosition: 'middle'
        });
        $("#test-circle4").circliful({
            animation: 1,
            animationStep: 1,
            start: 2,
            showPercent: 1,
            backgroundColor: '#000',
            foregroundColor: '#A8C64A',
            fontColor: '#000',
            multiPercentage: 1,
            text: 'No Kids',
            foregroundBorderWidth: 15,
            backgroundBorderWidth: 15,
        });
        $("#test-circle5").circliful({
          animationStep: 5,
          foregroundBorderWidth: 5,
          backgroundBorderWidth: 15,
          percent: 80,
          halfCircle: 1,
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
        transform: "rotate("+ (14+(p*1.8)) +"deg)", // 100%=180° so: ° = % * 1.8
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
		   alert("t--"+$('#goal-form').serialize());
	   	$.ajax({				
		url: 'operation.php',				
		type: 'POST',				
		dataType: 'json',				
		async: false,				
		data: $('#goal-form').serialize(),				
		success: function(response) {	
alert("t"+response);
			
			$('#steps_goal').html(response.steps);
			$('#sleep_goal').html(response.sleep);
			
		}
	})
   }
</script>
</body>
</html>
