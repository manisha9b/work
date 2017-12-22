<?php include_once('partials/header3.php');  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="col-sm-12">		
      <div class="pt-20 wow bounceInUp" data-wow-delay="0.2s">
        <div class="box-layout1">
          <!-- Content Header (Page header) -->
          <section class="content-header pt-0 wrap_area" style="padding-top:10px;">			
            <div id="userprof">
				<div class="col-md-6 pl0 pr0">
					<div class="col-sm-12 pl0 pr0 appointment_form">
						<!-- <div class="close_icon">
							<a href="#"><img src="images/close.png" style="float:right;margin-top:15px;"></i></a>
						</div> -->
						<div class="clearfix"></div>
						<div class="col-md-12 pl0 pr0">
							<h2 style="margin-top: 0px;">Hi <?php echo $HRdisplayName;?>!</h2>
						</div>
													
						<div class="col-md-12 info_subtitle pl5 appointment_form">
							<p class="welcome_text">Your Organisation Health Dashboard is now LIVE on EasyBuyHealth.
</p>	<p class="welcome_text">

Please UPDATE your Password here. </p>
							
						</div>						
						<div class="clearfix"></div>						
					</div>
              
					<div class="col-sm-12 appointment_form res_password" style="padding-left:2px;;"> 						
						<div class="pt-40" style="">							
							<!-- <div class="col-sm-6 pl0 pt-20">
							  <a href="#" class="facebook_btn btn"><i class="fa fa-facebook" aria-hidden="true" style="font-size:20px;text-align: center;"></i> Facebook Login </a>
							  
							  <a href="#" class="gmail_btn btn mt-10"><i class="fa fa-google-plus" style="font-size:20px;"></i> Google+ Login</a>
							</div>	 -->
								<?php
	$form_action = "portal/password.php";
?><form role="form" class="form-horizontal" method="post" action="<?php echo $form_action;?>" name="frmresetpass" id="frmresetpass"
	enctype="multipart/form-data" autocomplete="off">
							<div class="col-sm-12 pl0 pr0 mob_mt10 res_pass_field">
								<div class="form-group" style="width:100%">								  
								  <input type="password" class="form-control" id="password" name="password" placeholder="Enter a New Password"  required>
								</div>
								<div class="form-group" style="width:100%">								  
								  <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Re-Enter New Password" required>
								</div>
								<div class="clearfix"></div>	
								<div class="form-group" style="width:100%"><button type="submit" class="app_form_button">UPDATE</button></div>
							</div>
							</form>
							<div class="clearfix"></div>							
						</div>
					</div>
					<div class="clearfix"></div>	
				<!-- <div class="col-md-12">
					<button type="button" class="app_form_button"><a href="#" data-toggle="modal" data-target="#e_voucher" style="color:#fff;">Download eVoucher</a></button>
				</div> -->
		  </div>
		  <div class="col-md-6 slid_area hidden-xs">
			   <div class="slider mt25 mt_mob10">								
					<div class="col-ms-12 slider" id="slider2">												
						<div style="background-image:url(images/1.jpg)">
							<div class="overlay"></div>
								<div class="carousel-caption">
									<h3 style=";font-size:18px;margin-top: 0px;text-align:center;">With EBH, keeping track of your health <br> and fitness has never been easier</h3>									
								</div>						
						</div>
						<div style="background-image:url(images/1.jpg)">
							<div class="overlay"></div>
								<div class="carousel-caption">
									<h3 style=";font-size:18px;margin-top: 0px;text-align:center;">With EBH, keeping track of your health <br> and fitness has never been easier</h3>									
								</div>						
						</div>
						<div style="background-image:url(images/1.jpg)">
							<div class="overlay"></div>
							<div class="carousel-caption">
								<h3 style=";font-size:18px;margin-top: 0px;text-align:center;">With EBH, keeping track of your health <br> and fitness has never been easier</h3>								
							</div>						
						</div>
						<div style="background-image:url(images/1.jpg)">
							<div class="overlay"></div>
								<div class="carousel-caption">
									<h3 style=";font-size:18px;margin-top: 0px;text-align:center;">With EBH, keeping track of your health <br> and fitness has never been easier</h3>
								</div>						
						</div>			
					</div>
					<div class="overlay">	
						<div class="col-md-12">
							<div class="featu_btn">							
								<div class="btn"> 
									<ul>
										<li style=""><a href="#">Explore Feature</a></li>
										<li style=""><a href="#">Get Started</a></li>
									</ul>
								</div>							
							</div>
						</div>					
					</div>
				</div> <!--slider end-->			
			</div><!--col-md-6 end-->
		<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	  </section>
	</div>
  </div> 
  </div>
  <div class="clearfix"></div>
  </div> <!--content-wrapper close here-->
  
<div class="clearfix"></div>  
</div> <!-- ./wrapper -->

  <!-- Modal -->
<!-- <div class="modal fade include_are_popup" id="includearea" role="dialog">
	<div class="modal-dialog">    
	
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				<p>Some text in the modal.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Agree</button>
			</div>
		</div>
	</div>
</div>  



<div class="modal fade include_are_popup" id="e_voucher" role="dialog">
	<div class="modal-dialog">    
	
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Modal Header</h4>
			</div>
			<div class="modal-body">
				<p>Some text in the modal.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Agree</button>
			</div>
		</div>
	</div>
</div>  --> 


<div class="clearfix"></div>
<?php include_once('partials/footer.php'); ?>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="plugins/materialize/materialize.css">
<script src="plugins/materialize/materialize.js"></script>
<script>
$(document).ready(function() {
	$("#frmresetpass").validate({
        rules:{
            password:{
                required:true
            },
			 
    confirm_password: {
      equalTo: "#password",
    required:true
        }},
		messages: {
			fileupload:"Employee excel data can not be blank",
		},
        errorClass: "help-inline text-danger",
        errorElement: "span",
        highlight:function(element, errorClass, validClass) {
            $(element).parents('.form-group').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.form-group').removeClass('has-error');
            $(element).parents('.form-group').addClass('has-success');
        }
    });
    });
  new WOW().init();
  $(document).ready(function() {
    $('select.materializeselect').material_select();
    $('[data-toggle="popover"]').popover();
    $('.popover-dismiss').popover({
      trigger: 'focus'
    })
  });
  function addfam(){
    document.getElementById('fam1').innerHTML="Father";
    document.getElementById('famval').innerHTML="Abc";
    document.getElementById('famact').innerHTML="!";
  }
</script>
<script>
  $("input[type='image']").click(function() {
    $("input[id='my_file']").click();
  });
  $(function () {
    //Initialize Select2 Elements
    /*$(".select2").select2({
      minimumResultsForSearch: -1
    });*/
    $(".dynamicaddition").select2({
      tags: true
    })
  });
  $(document).ready(function(){
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
  

        
</script>
<script>
$('.datepicker').pickadate({
selectMonths: true,//Creates a dropdown to control month
selectYears: 15,//Creates a dropdown of 15 years to control year
//The title label to use for the month nav buttons
labelMonthNext: 'Next Month',
labelMonthPrev: 'Last Month',
//The title label to use for the dropdown selectors
labelMonthSelect: 'Select Month',
labelYearSelect: 'Select Year',
//Months and weekdays
monthsFull: [ 'January', 'February', 'March', 'April', 'March', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ],
monthsShort: [ 'Jan', 'Feb', 'Mar', 'Apr', 'Mar', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ],
weekdaysFull: [ 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' ],
weekdaysShort: [ 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat' ],
//Materialize modified
weekdaysLetter: [ 'S', 'M', 'T', 'W', 'T', 'F', 'S' ],
//Today and clear
today: 'Today',
clear: 'Clear',
close: 'Close',
//The format to show on the `input` element
format: 'dd/mm/yyyy'
});
//Copy settings and initialization tooltipped

 $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });
</script>

<script src="dist/js/sliderResponsive.js"></script>
<script>
$(document).ready(function() {
  
  $("#slider1").sliderResponsive({
  // Using default everything
    // slidePause: 5000,
    // fadeSpeed: 800,
    // autoPlay: "on",
    // showArrows: "off", 
    // hideDots: "off", 
    // hoverZoom: "on", 
    // titleBarTop: "off"
  });
  
  $("#slider2").sliderResponsive({
    fadeSpeed: 300,
    autoPlay: "on",
    showArrows: "off",   
  });
 
  
      
}); 
 $(document).ready(function() {
    $('select').material_select();
  });

  
  $('.timepicker').pickatime({
    default: 'now', 
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
  
  
  $(document).ready(function(){
    $('.tooltipped').tooltip({delay: 50});
  });
   
// This will remove the tooltip functionality for the buttons on this page
  $('.tooltipped').tooltip('remove');   
</script>

</body>
</html>
