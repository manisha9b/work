<?php include_once('partials/header3.php'); 
unset($arr_ebh_pack);
$data = ($clusterId)?$database->getClusters($clusterId):[];
$dataUser = ($clusterId)?$database->getTableForHsp('tbl_cluster_users', "cluster_user_id='$cluster_user_id'"):[];

			$login = ($clusterId)?$database->getClusterAdmin($clusterId):[];
			$photo	= (!empty($dataUser[0]['photo'])) ? $dataUser[0]['photo'] : "https://www.easybuyhealth.com/beta/public/assets/site/imgs/images.jpg";
?>  <!-- Content Wrapper. Contains page content -->
  <?php $login_result = $database->getLoginLog($user_id) ;
				  //print_r($login_result);
				  ?>
  <div class="content-wrapper">
	
	 <section class="content-header">
		
		  <div class="col-md-12">
      <h3 class="pull-left">
        <b>My Company Profile</b>
      </h3>
      <div class="pull-right resright">
	  </div>
	  </div>
      <div class="clearfix"></div>
	  <hr class="hrdivide">
	   <div class="clearfix"></div>	 
    </section>
	
	<section class="content">			
		<div class="col-md-12">	
<?php 

if(isset($_SESSION['alert']))
 {
	echo $database->show_alert($_SESSION['alert']);
	unset($_SESSION['alert']);
 }
?>		
        <div class="col-sm-9 pt-20 wow bounceInLeft with-nav-tabs" style="padding-left: 0px; visibility: visible; animation-delay: 0.2s; animation-name: bounceInLeft;" data-wow-delay="0.2s">			
			<div class="col-md-12 p0">
			<div class="col-md-4 p0">
				<div id="appointments" class="company_profile_nav mb-25">				
				<ul class="nav nav-tabs">
					<li class="active">					
						<a href="#tab1default" data-toggle="tab" class="btn btn-primary" style="color: #fff;background: #3D4452;padding:9.5px;border-radius: 0!important;">COMPANY PROFILE</a>
					</li>
					<li><a href="#tab2default" data-toggle="tab" class="btn btn-primary" style="color: #fff;background: #3D4452;padding:9.5px;border-radius: 0!important;">MY PROFILE</a></li>
				
				</ul>
				</div>
			</div>
			<div class="col-md-8 p0">
				<div id="appointments" class="company_profile_nav mb-25">				
				
				</div>
			</div>			
			</div>
			<div class="clearfix"></div>	 
                <!-- /.tab-pane -->				
			<div class="box-layout1 emp_com_info_form"> 
            <!-- Main content -->
            <section id="smartwatch" class="content pb-60 tab-content" style="background-color:white;">
              <div class="mt-20 create_com_info tab-pane fade in active" id="tab1default">
			  <form class="form" method="post" enctype="multipart/form-data" autocomplete="off" action="portal/profile_update.php">

			<input type="hidden" name="cluser_user_id" value="<?=$dataUser[0]['cluster_user_id']?>">
                  <h4 class="pull-left m0">
                    Your Company Information
                  </h4>                  
                  <div class="clearfix"></div>
                  
                  <div class="pt-20">
                    <div class="col-sm-12">
                      <!--<div class="fieldname">
                        Organization Name
                      </div>
                      <h4 class="field-details pb-10">
                        <input type="text" name="orgname" value="Acme Industries" style="background: transparent;border: none;width: 100%;" />
                      </h4>-->
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Organization Name</div>
                        <input type="text" name="cluster_business_name" id="cluster_business_name" maxlength="50"   value="<?=$data[0]["cluster_business_name"]?>" required pattern="^[a-zA-Z\s]+$" title="Please  enter only Alphabets">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Email ID</div>
                        <input type="email" name="business_email_id" id="business_email_id" maxlength="50"   value="<?=$data[0]["business_email_id"]?>" required>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Mobile Number</div>
                        <input type="text" name="contact_mobile" id="contact_mobile" value="<?=$data[0]["contact_mobile"]?>" required maxlength="50"  pattern="^[\-\+0-9\s]+$" title="Please  enter Correct Mobile Numbers">
                      </div>
                    </div
					><div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Phone Number</div>
                        <input type="text" name="contact_landline" id="contact_landline" value="<?=$data[0]["contact_landline"]?>" required maxlength="50" pattern="^[\-\+0-9\s]+$" title="Please  enter Correct Phone Numbers">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>                  
                  <div class="pt-10">                    
                    <div class="col-sm-6"> 
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">HR Full Name.</div>
                        <input type="text" name="hr_full_name" id="hr_full_name" maxlength="50" value="<?php echo $dataUser[0]['user_name'];?>" required pattern="^[a-zA-Z\.\s]+$" title="Please  enter only Alphabets">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">HR Email ID</div>
                        <input type="email" name="hr_email_id" id="hr_email_id" maxlength="50"   value="<?php echo $dataUser[0]['user_email'];?>" required >
                      </div>
                    </div>
					<div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">HR Mobile No.</div>
                        <input type="text" name="hr_mobile_no" id="hr_mobile_no" maxlength="50"   value="<?php echo $data[0]['hr_mobile_no'];?>" required pattern="^[\-\+0-9\s]+$" title="Please  enter Correct Mobile Numbers">
                      </div>
                    </div>
                  </div>
				  <div class="pt-10">
					<div class="col-sm-12">
                      <!--<div class="fieldname">
                        Organization Name
                      </div>
                      <h4 class="field-details pb-10">
                        <input type="text" name="orgname" value="Acme Industries" style="background: transparent;border: none;width: 100%;" />
                      </h4>-->
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Billing Address</div>
                        <input type="text" name="address" id="address" maxlength="50"   value="<?=$data[0]["address"]?>" required >
                      </div>
                    </div>
				  
				  </div>
                  <div class="pt-10">
				  <div class="col-sm-4">
                      <h4 class="select__1 field-details nosearch mt-0  mb-10" style="padding-bottom: 8px;">
                        <select class="materializeselect" style="background: transparent;border: none;width: 100%;"    id="state"  name="state" required />
						<option value="">State</option>
                          <?php 
						  $cityArr = $database->getTableForHsp('states', "country_id='IN'") ;
						  foreach($cityArr as $state){?>
						  <option value="<?php echo $state["id"]?>" <?php if($data[0]["state_name"] == $state["state_name"]):?>selected<?php endif; ?>><?=$state["state_name"]?></option>
									
						  <? }?>
                        </select>
                      </h4>
                    </div>
					<div class="col-sm-4">
                      <h4 class="select__1 field-details nosearch mt-0  mb-10" style="padding-bottom: 8px;" >
                        <select class="materializeselect" style="background: transparent;border: none;width: 100%;" id="city"  name="city" required />
						<option value="">City</option>
                          <?php 
						  $cityArr = $database->getTableForHsp('cities', "country_id='IN'") ;
						  foreach($cityArr as $city){?>
						  <option <?php if($data[0]["city_name"] == $city["city_name"]):?>selected<?php endif; ?> value="<?php echo $city["id"]?>"><?=$city["city_name"]?></option>
									
						  <? }?>
                        </select>
                      </h4>
                    </div>
                   
                    <div class="col-sm-4">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Postal Code</div>
                        <input type="text" name="pincode" id="pincode" maxlength="50"   value="<?=$data[0]["pincode"]?>" required pattern="^[0-9]{6}$" title="Please  enter only 6 digit Numbers">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
				  
				 
				  <div class="pt-10 col-md-12">
					<div class="col-md-6 pull-right rescenter mt-20">
						
						<button type="submit" class="btn save_btn pull-right">SAVE</button>
					  </div>
				  </div>
				  <br/>
				  </form>
				  <div class="clearfix"></div>	 
                </div>
				<div class="clearfix"></div>	 
				<div class="tab-pane fade" id="tab2default">						
					<div class="row">
						<div class="col-md-12 my_pro_detail pt-30">
							<div class="col-md-3 pro_pics">							
								<img src="<?php echo $photo?>" class="img-circle">
								 <form class="form" id="photo_form" method="post" enctype="multipart/form-data" autocomplete="off" action="portal/profile_update.php">
								 <input name="action" type="hidden" value="upload_photo" />
								 <input type="hidden" name="cluser_user_id" value="<?=$dataUser[0]['cluster_user_id']?>">
								  <div class="form-group">
                <div class="btn btn-default btn-file" style="margin-top:10px;">
                   Upload Photo
                  <input type="file" name="photo" id="photo" accept="image/jpeg,image/png,image/gif">
                </div>
                
              </div></form>
							</div>
							<div class="col-md-5 status">							
								<div class="emp_name"><h3 class="text-bold"><?php  echo $dataUser[0]['user_name']?></h3></div>
								<div class="emaiid_link"><a href="mailto:<?php echo $dataUser[0]['user_email'] ?>" class="email_id_clr"><?php echo $dataUser[0]['user_email'] ?></a></div>
								<div class="active_status">Last active on Nov 21</div>
							</div>
							<div class="col-md-4 password">							
								<div class="cur_pass mt30"><h3>Password</h3></div>
								<div class="change_pass"><h3><a href="password.php">Change Password</a></h3></div>
							</div>
								
						</div>
						
					</div>					
				</div>
              <div class="clearfix"></div>
            </section>
          </div>
        </div>
        <div class="col-sm-3 pt-20 wow bounceInRight" style="visibility: visible; animation-name: bounceInRight;">
		
			
          <div class="box-layout1">
            <div class="pb-20 emp_profile_area">
                <div class="user-pic" style="background-color:#62bd63">
                  <div class="profile_pic"><img src="<?php echo $photo?>" class="img-circle"></div>
				
                </div>
                <div class="user-details mt-20">
                 
                  <h3 class="text-center m0 pt-10 fs13">
                    <?php echo $dataUser[0]['user_name'] ?>
                  </h3>
                  <h4 class="text-center pt-20 black">
                   <!-- <a href="mailto:nikita@digirepublik.com"><?php echo $dataUser[0]['user_email'] ?></a> -->
                   <!-- <a href="mailto:nikita@digirepublik.com"><?php echo $dataUser[0]['user_email'] ?></a> -->
                  </h4>
                  <p class="text-center m0 pb-10 green">
				  
                   Last active on <?php echo $login_result[0]['last_login_date'] ?>
                  </p>
					               
                </div>
              </div>
          </div>		  
		 
		  <div class="clearfix"></div>
		 
        </div>
		</div>
        <div class="clearfix"></div>      			
	</section> 
	 </div>
</div>

<?php include_once('partials/footer.php'); ?>
<!-- Page script -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="plugins/materialize/materialize.css">
<script src="plugins/materialize/materialize.js"></script>
<script>
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
	 $(".input__1 input, .textarea__1 textarea").each(function(){
      if($(this).parent().hasClass("input__1"))
        $(this).prev().removeClass("input__1_blurred").addClass("input__1_focused");
      else if($(this).parent().hasClass("textarea__1"))
        $(this).prev().removeClass("textarea__1_blurred").addClass("textarea__1_focused");

      $(this).prev().parent().css({
        borderBottom : "1px solid #43ce5a"
      });
    });
	document.getElementById("photo").onchange = function() {
    document.getElementById("photo_form").submit();
}
  });
</script>
<script>
	if($(window).width() > 768){

// Hide all but first tab content on larger viewports
$('.accordion__content:not(:first)').hide();

// Activate first tab
$('.accordion__title:first-child').addClass('active');

} else {
  
// Hide all content items on narrow viewports
$('.accordion__content').hide();
};

// Wrap a div around content to create a scrolling container which we're going to use on narrow viewports
$( ".accordion__content" ).wrapInner( "<div class='overflow-scrolling'></div>" );

// The clicking action
$('.accordion__title').on('click', function() {
$('.accordion__content').hide();
$(this).next().show().prev().addClass('active').siblings().removeClass('active');
});


</script>
<script>
$(function () {
	   $('.profile_menu').addClass('active');
});
</script>
</body>
</html>
