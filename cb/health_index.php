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
  $cluster_user_id						=	$_SESSION['cluster_user_id'];
$arr_count = $database->getDashboardCount($clusterId);
$chartdata = $database->getDashboardChart($clusterId);
$PRdata = $database->getPAckageRequestData($cluster_user_id);
$emp_arr['healty'] = $database->getClusterEmpDetails($clusterId,'H',' Limit 3');
$emp_arr['unhealty'] = $database->getClusterEmpDetails($clusterId,'UH',' Limit 3');

//$charts = $chartdata['chart'];
$goal_arr = $database->getClusterGoal($clusterId);
//$database->getclusterEbhPackageList($cluster_id);
//echo "<pre>";
//print_R($PRdata);
//print_R($empty);
//echo "</pre>";//die;*/
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
		<div class="col-md-12">
		  <h3 class="pull-left">
			<b> <?php echo $arr_cluster['cluster_business_name']?> Health Index</b>
		  </h3>
		  <div class="pull-right resright">
		  <?php ///include_once('partials/askme.php'); ?>
			 </div>
	  </div>
      <div class="clearfix"></div>
	  <hr class="hrdivide" />
    </section>
	
    
    <!-- Main content -->	
    <section class="content">
      <!-- Small boxes (Stat box) -->
     
		<div class="clearfix"></div><br/>
        <div id="graph1" class="package-container">
          <div class="swiper-container graph-container">
			<div class="col-md-12">
			 <!-- BAR CHART -->
			 		<?php if(!empty($chartdata['bp']['table']) ){?>
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
                 
                  <th>Readings</th>
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
           <h5 class="gsmallresult margin0" style="font-size: 12px;line-height:15px;"><span class="badge1 bg-danger1" style="font-size:13px"><b><?php echo $high_bp_per?>%</b></span> of company has <span class="text-danger">High Blood Pressure Levels</span> <br/><br/> <span class="badge1 bg-danger1" style="font-size:13px;font-weight:strong;"><?php echo $low_bp_count?>%</span> of company has <span class="text-danger">Low Blood Pressure Levels</span></h5>
                </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
         <?php }else{ ?>
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
                <div class="col-md-offset-2 col-md-8"><br/><br/><br/><center>"Your current Preventive Healthcare Package does not include Blood Pressure Testing. 
                
                <?php if(!isset($PRdata['bp'])){?>To Add a Blood Pressure Test/Package Click "Add"
                <br/><br/>
                 <button type="button" onclick="sendPackageRequest('bp');" class="btn btn-info" >Add</button>
                 
                 <?php } else{
                     echo "<br/>We have recived your request to add Blood Pressure Test/Package.";
                 }?></center><br/><br/><br/>
                    </div></div></div>
                    </div>
           <?php } ?>
           
          
               
		  </div>
           
      </div>
      <div class="swiper-container graph-container">
			<div class="col-md-12">
			 <!-- BAR CHART -->
			 		<?php if(!empty($chartdata['bmi']['table']) ){?>
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
                 
                  <th>Readings</th>
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
           <h5 class="gsmallresult margin0" style="font-size: 12px;line-height:15px;"><span class="badge1 bg-danger1" style="font-size:13px"><b><?php echo $high_bmi_per?>%</b></span> of company is  <span class="text-danger">Overweight</span> <br/><br/> <span class="badge1 bg-danger1" style="font-size:13px;font-weight:strong;"><?php echo $low_bmi_count?>%</span> of company is <span class="text-danger">Underweight</span></h5>
           
                </div>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <?php }else{ ?>
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
                <div class="col-md-offset-2 col-md-8"><br/><br/><br/><center>"Your current Preventive Healthcare Package does not include BMI Calculation. 
                
                <?php if(!isset($PRdata['bmi'])){?>To Add a BMI Calculation/Package Click "Add"
                <br/><br/>
                 <button type="button" onclick="sendPackageRequest('bmi');" class="btn btn-info" >Add</button>
                 
                 <?php } else{
                     echo "<br/>We have recived your request to add BMI Calculation Test/Package.";
                 }?></center><br/><br/><br/>
                    </div></div></div>
                    </div>
           <?php } ?>
           
          
               
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
                 
                  <th>Readings</th>
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
           <h5 class="gsmallresult margin0" style="font-size: 12px;line-height:15px;"><span class="badge1 bg-danger1" style="font-size:13px"><b><?php echo $pre_diabetic_count?>%</b></span> of company is  <span class="text-danger">Prediabetic</span> <br/><br/> <span class="badge1 bg-danger1" style="font-size:13px;font-weight:strong;"><?php echo $diabetic_count?>%</span> of company is <span class="text-danger">Diabetic</span></h5>
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
                <div class="col-md-offset-2 col-md-8"><br/><br/><br/><center>"Your current Preventive Healthcare Package does not include Blood Sugar Testing. 
                <?php if(!isset($PRdata['bs'])){?>To Add a Blood Sugar Test/Package Click "Add" 
                <br/><br/>
                 <button type="button" onclick="sendPackageRequest('bs');" class="btn btn-info" >Add</button>
                 
                 <?php } else{
                     echo "<br/>We have recived your request to add Blood Sugar Test/Package.";
                 }?></center><br/><br/><br/>
                    </div></div></div>
                    </div>
           <?php }?>
               
		  </div>
           
      </div>
	  <!-- sho my report data -->
	  <?php //include_once('my_Reports.php') ?>
	  <!-- end of my report -->
      <!-- /.row -->
    
      <!-- /.row -->
       </section>
    <!-- /.content -->
  </div>
</div>
<!-- ./wrapper -->

<!-- Modal -->
<!-- Modal -->
	  
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

<?php if(!empty($chartdata['bp']['table']) ){?>
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
    <?php } ?>
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
	   multiTooltipTemplate: "<%if (label){%> <%}%><%= value %>",
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
	  
    }

    barChartOptions.datasetFill = false
    <?php if(!empty($chartdata['bp']['table']) ){?>
     barChart.Bar(barChartData, barChartOptions)
     <?php } ?>
    ///bmi chart
    <?php if(!empty($chartdata['bmi']['table']) ){?>
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
		 <?php } ?>
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
			    <?php if(!empty($chartdata['bp']['table']) ){?>
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myPie = new Chart(ctx).Doughnut(pieData);
				<?php } ?>
				<?php if(!empty($chartdata['bmi']['table']) ){?>
					var ctx2 = document.getElementById("chart-area_bmi").getContext("2d");
			//	window.myPie2 = new Chart(ctx2).Pie(pieData2);
				window.myDoughnut = new Chart(ctx2).Doughnut(pieData2, {
					responsive:true
				})	
				<?php } ?>
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
<?php //include_once('reports_js.php'); ?>
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



</script>
<script>

   function sendPackageRequest(obs_type){
	   	 
		  // alert("t--"+$('#goal-form').serialize());
	   	$.ajax({				
		url: 'operation.php',				
		type: 'POST',				
		dataType: 'json',				
		async: false,				
		data: 'action=package_request&type='+obs_type,				
		success: function(response) {	
//alert("t"+response);
			document.location = '';
		//	$('#steps_goal').html(response.steps);
		//	$('#sleep_goal').html(response.sleep);
			
		}
	})
   }
</script>



</body>
</html>
