<?php
echo "<pre>";
echo basename($_SERVER['REQUEST_URI'], '?'.$_SERVER['QUERY_STRING']);
print_r($_SERVER);die;
SCRIPT_FILENAME
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,FF=3;OtherUA=4">
  <title>EBH | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/style.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="dist/css/animate.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <style>
	.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
	margin-bottom: -1px;
}
/********************************************************************/
/*** PANEL DEFAULT ***/
.with-nav-tabs.panel-default .nav-tabs > li > a,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
}
.with-nav-tabs.panel-default .nav-tabs > .open > a,
.with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
	background-color: #ddd;
	border-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.active > a,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
	color: #555;
	background-color: #fff;
	border-color: #ddd;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #f5f5f5;
    border-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #777;   
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #555;
}



.my_pro_info .accordion {
  padding: 0;
  margin: 2em 0;
  width: 100%;
  overflow: hidden;
  font-size: 1em;
  position: relative;
}

.my_pro_info .accordion__title {
  padding: 0 1em;  
  border-bottom: 3px solid #fff;
  color: #222;
  float: left;
  line-height: 3;
  height: 3em;
  cursor: pointer;
  margin-right: .25em;
  width: 15%;
  text-align: center;
}

.my_pro_info .no-js .accordion__title {
  float: none;
  height:auto;
  cursor:auto;
  margin:0;
  padding:0 2em;
}

.my_pro_info .accordion__content {
  float: right;
  width: 100%;
  margin: 3em 0 0 -100%;
  padding: 2em;
  border-top:1px solid #ccc;
}

.my_pro_info .no-js .accordion__content {
  float:left;
  margin:0;
}

.my_pro_info .accordion__title:hover,
.my_pro_info .accordion__title.active {
  
  color:#4bd058;
}

.my_pro_info .no-js .accordion__title:hover {
  background-color:#ccc;
  color:#222;
}

.my_pro_info .accordion__title.active {
  border-bottom-color:#61bd62;
      color: #61bd62;
}

@media (max-width:767) {
  
  .my_pro_info .accordion {
    border: 1px solid grey;
  }
  
  .my_pro_info .accordion__title,
  .my_pro_info .accordion__content { 
    float: none;
    margin: 0;
  }
  
  .my_pro_info .accordion__title:first-child {
    border:none;
  }
  
 .my_pro_info .accordion__title.active {
  border-bottom-color:#eee;
  }
  
  .my_pro_info .accordion__title.active, .accordion__title:hover {
    background:#777;
  }
  
  .my_pro_info .accordion__title:before {
  content:"+";
  text-align:center;
  width:2em;
  display:inline-block;
  }
 .my_pro_info .accordion__title.active:before {
  content:"-";
  }
  
 .overflow-scrolling {
  overflow-y: scroll;
  height:11em;
  padding:1em 1em 0 1em;
  /* Warning: momemtum scrolling seems buggy on iOS 7  */
  -webkit-overflow-scrolling: touch;
  }

  .my_pro_info .accordion__content {
    position:relative;
    overflow:hidden;
    padding:0;
  }
  
  .my_pro_info .no-js .accordion__content {
    padding:1em;
    overflow:auto;
    display:block;
  }
  
  .my_pro_info .accordion__content:after {
    position:absolute;
    top:100%;
    left:0;
    width:100%;
    height:50px;
    border-radius:10px 0 0 10px / 50% 0 0 50%;
    box-shadow:-5px 0 10px rgba(0, 0, 0, 0.5);
    content:'';
}
   
}


  
  </style>
</head>
<body id="myprofile" class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

   <header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="images/logo/EBH-small.png" alt="EasyByHealth" style="max-width: 100%;" /></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="images/logo/EBH.png" alt="EasyByHealth" style="max-width: 90%;" /></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form1" style="display: inline-block;">
        <div class=" inner-addon left-addon">
          <i class="fa fa-search"></i>
          <input type="text" name="q" class="form-control" placeholder="Type To Search">
        </div>
      </form>
      <!-- /.search form -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
			<li class="login_user">
				<a href="#"> <i class="fa fa-user-o" aria-hidden="true"></i> <span>Hi Priyanka</span></a>
			</li>
          <li>
            <a href="#">About EBH</a>
          </li>
          <li>
            <a href="#">How it Works</a>
          </li>
          <li class="nohover">
            <a href="#">
              <div class="social">
                <i class="fa fa-facebook"></i>
              </div>
            </a>
          </li>
          <li class="nohover">
            <a href="#">
              <div class="social">
                <i class="fa fa-instagram"></i>
              </div>
            </a>
          </li>
          <li class="nohover nav-space">
            <a href="#">
              <div class="social">
                <i class="fa fa-twitter"></i>
              </div>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image" style="padding-top:25px;width:60px;height:80px;">
          <img src="images/dr3.jpg" class="" alt="User Image">
        </div>
        <div class="clearfix clear"></div>
        <div class="info">
          <p>Digital Republik</p>
        </div>
        <div class="prof">
          <div class="progress xs1 mb-0">
            <!-- Change the css width attribute to simulate progress -->
            <div class="progress-bar progress-bar-cgreen" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
          <div class="progresscomplete mb-10" style="margin-top: 9px;">80% complete profile</div>
          <p style="color: #b7bbc2;">
            Digital Republik Pvt.Ltd<br/>
            Mumbai
          </p>
        </div>
      </div>
      <div class="divider"></div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li>
          <a href="cluster_dashboard.html">
            <i class="fa fa-th-large"></i> <span>Health Dashboard</span>
          </a>
        </li>
        <li>
          <a href="health_package.html">
            <i class="fa ion-ios-medkit-outline"></i> <span>Health Packages</span>
          </a>
        </li>
        <li>
          <a href="employee_information.html">
            <i class="fa fa-address-card-o"></i> <span>Employees</span>
          </a>
        </li>
        <li>
          <a href="my-family.html">
            <i class="fa fa-heartbeat"></i> <span>Health Index</span>
          </a>
        </li>
		<li>
          <a href="#">
            <i class="fa fa-calendar"></i> <span>Appointments</span>
          </a>
        </li>
		<li>
          <a href="#">
            <i class="fa fa-file-text-o"></i> <span>Reports</span>
          </a>
        </li>
        <div class="nav-divider"></div>        
        <li>
          <a class="disable">
            <i class="fa ion-ios-list"></i> <span>Worth Reading</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-shield"></i> <span>Diet Plan</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-heartbeat"></i> <span>Fitness Services</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-user"></i> <span>Nutritionists</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-heart"></i> <span>Health Equipments</span>
          </a>
        </li>
        <li>
          <a class="disable">
            <i class="fa fa-file-text"></i> <span>Pharmacy & Chemists</span>
          </a>
        </li>
        <!--<li>
          <a class="disable">
            <i class="fa fa-gift"></i> <span>Rewards</span>
          </a>
        </li>-->
        <div class="nav-divider"></div>
        <li class="active">
          <a href="my-profile.html">
            <i class="fa fa-user"></i> <span>Company Profile</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-info-circle"></i> <span>About EBH</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
	
	 <section class="content-header">
		
		  <div class="col-md-12">
      <h3 class="pull-left">
        <b>My Company Profile</b>
      </h3>
      <div class="pull-right resright">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Messages: style can be found in dropdown.less-->
            <li>
              <a class="btn3 ask_Any" href="#">
                <img src="dist/img/ask.png"> Ask me anything
              </a>
            </li>
            <li class="dropdown messages-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 0px 10px;">
                <i class="fa fa-bell-o"></i>
                <span class="label label-danger">6</span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have 6 messages</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <ul class="menu">
                    <li><!-- start message -->
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <!-- end message -->
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 2 hours</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> Today</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> Yesterday</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <div class="pull-left">
                          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Lorem Ipsum is simply dummy text</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="footer"><a href="#">See All Messages</a></li>
              </ul>
            </li>
          </ul>
        </div>  
      </div>
	  </div>
      <div class="clearfix"></div>
	  <hr class="hrdivide">
	   <div class="clearfix"></div>	 
    </section>
	
	<section class="content">			
		<div class="col-md-12">		
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
				<ul class="nav nav-tabs">
					<li class="pull-right dropdown nohover1 setting_icon dropdown invite_member">
						<i class="fa fa fa-user add_member dropdown-toggle" id="menu1" data-toggle="dropdown" aria-hidden="true"></i>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="fs14">Signed In</a></li>
						  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="fs14">Log out</a></li>						  						  
						  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="fs14">+ Add Tab</a></li>    
						</ul>
					</li>
					<li class="pull-right dropdown nohover1 user_icon">
					  
					   <i class="fa fa-cog" aria-hidden="true"></i>
					</li>
					<li class="pull-right">
					<div class="input-group input-group-noborder hidden-sm com_pro_search_bar">
						<i class="fa fa-search fa-lg"></i>
						<input type="text" class="form-control" placeholder="Search">
					</div>
					</li>
				</ul>
				</div>
			</div>			
			</div>
			<div class="clearfix"></div>	 
                <!-- /.tab-pane -->				
			<div class="box-layout1 emp_com_info_form"> 
            <!-- Main content -->
            <section id="smartwatch" class="content pb-60 tab-content" >
              <div class="mt-20 create_com_info tab-pane fade in active" id="tab1default">
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
                        <input type="text" name="orgname" id="orgname" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">PAN Card No.</div>
                        <input type="text" name="email" id="email" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">TAN Card No.</div>
                        <input type="text" name="mob" id="mob" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>                  
                  <div class="pt-10">                    
                    <div class="col-sm-6">
                      <h4 class="select__1 field-details nosearch mt-0  mb-10" style="padding-bottom: 8px;">
                        <div class="select-wrapper materializeselect"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-fa0b7598-bb75-efe7-41cd-42d837a14a81" value="GST Status"><ul id="select-options-fa0b7598-bb75-efe7-41cd-42d837a14a81" class="dropdown-content select-dropdown "><li class=""><span>GST Status</span></li><li class=""><span>Mumbai</span></li><li class=""><span>Pune</span></li></ul><select class="materializeselect initialized" style="background: transparent;border: none;width: 100%;" data-select-id="fa0b7598-bb75-efe7-41cd-42d837a14a81">
                          <option>GST Status</option>
                          <option>Mumbai</option>
                          <option>Pune</option>
                        </select></div>
                      </h4>
                    </div>
                    <div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">GST Number</div>
                        <input type="text" name="locality" id="locality" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
                    <div class="clearfix"></div>
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
                        <input type="text" name="orgname" id="orgname" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
				  
				  </div>
                  <div class="pt-10">
					<div class="col-sm-4">
                      <h4 class="select__1 field-details nosearch margin0" style="padding-bottom: 8px;">
                        <div class="select-wrapper materializeselect"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-de43ec78-ec6d-1996-8555-d97809e46578" value="City"><ul id="select-options-de43ec78-ec6d-1996-8555-d97809e46578" class="dropdown-content select-dropdown "><li class=""><span>City</span></li><li class=""><span>Mumbai</span></li><li class=""><span>Delhi</span></li></ul><select class="materializeselect initialized" style="background: transparent;border: none;width: 100%;" data-select-id="de43ec78-ec6d-1996-8555-d97809e46578">
                          <option>City</option>
                          <option>Mumbai</option>
                          <option>Delhi</option>
                        </select></div>
                      </h4>
                    </div>
                    <div class="col-sm-4">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Country</div>
                        <input type="text" name="country" id="country" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Postal Code</div>
                        <input type="text" name="country" id="country" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
				  
				  <div class="pt-10">                    
                    <div class="col-sm-6">
                      <h4 class="select__1 field-details nosearch mt-0  mb-10" style="padding-bottom: 8px;">
                        <div class="select-wrapper materializeselect"><span class="caret">▼</span><input type="text" class="select-dropdown" readonly="true" data-activates="select-options-fa0b7598-bb75-efe7-41cd-42d837a14a81" value="GST Status"><ul id="select-options-fa0b7598-bb75-efe7-41cd-42d837a14a81" class="dropdown-content select-dropdown "><li class=""><span>GST Status</span></li><li class=""><span>Mumbai</span></li><li class=""><span>Pune</span></li></ul><select class="materializeselect initialized" style="background: transparent;border: none;width: 100%;" data-select-id="fa0b7598-bb75-efe7-41cd-42d837a14a81">
                          <option>Entity Type</option>
                          <option>Mumbai</option>
                          <option>Pune</option>
                        </select></div>
                      </h4>
                    </div>
                    <div class="col-sm-6">
                      <div class="input__1 mb-10">
                        <div class="input__1_placeholder input__1_blurred">Service Distribution Email</div>
                        <input type="text" name="locality" id="locality" maxlength="50" onkeypress="return validData(event,'name')">
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
				  <div class="pt-10 col-md-12">
					<div class="col-md-6 pull-right rescenter mt-20">
						<a href="#" class="btn cblack cancel_btn pull-right">CANCEL</a>
						<a href="#" class="btn save_btn pull-right">SAVE</a>
					  </div>
				  </div>
                </div>
				<div class="tab-pane fade" id="tab2default">						
					<div class="row">
						<div class="col-md-12 my_pro_detail pt-30">
							<div class="col-md-3 pro_pics">							
								<img src="images/profile_pic.jpg" class="img-circle">
							</div>
							<div class="col-md-3 status">							
								<div class="emp_name"><h3 class="text-bold">Priyanka Shroff</h3></div>
								<div class="emaiid_link"><a href="mailto:priyanka@digirepublik.com" class="email_id_clr">priyanka@digirepublik.com</a></div>
								<div class="active_status">Last active on Nov 21</div>
							</div>
							<div class="col-md-3 password">							
								<div class="cur_pass mt30"><h3>Password</h3></div>
								<div class="change_pass"><h3><a href="#">Change Password</a></h3></div>
							</div>
							<div class="col-md-3 social_icon">							
								<div class="pull-right login pt-40">
									<a href="#"><i class="fa fa-facebook" aria-hidden="true" style="color:#3a5999"></i></a>
									<a href="#"><i class="fa fa-google-plus" aria-hidden="true" style="color:#e62d28"></i></a>
								</div>
							</div>	
						</div>
						<div class="col-md-12 my_pro_info">
							<dl class="accordion">
  <dt class="accordion__title">Activity</dt>
  <dd class="accordion__content">
    <p><b>Your latest activity across all projects.</b></p>
    <p><b>Nov 19</b><span class="fs16" style="color:#646464;"> You posted a message on a Digital Republik's Appointment page</span> </p>
	<p><b>Nov 11</b><span class="fs16" style="color:#646464;"> You posted a message on a Digital Republik's Appointment page</span> </p>
	<p><b>Nov 05</b><span class="fs16" style="color:#646464;"> You posted a message on a Digital Republik's Appointment page</span> </p>
	<p><b>Oct 29</b><span class="fs16" style="color:#646464;"> You posted a message on a Digital Republik's Appointment page</span> </p>
	<p><b>Oct 21</b><span class="fs16" style="color:#646464;"> You posted a message on a Digital Republik's Appointment page</span> </p>
	
	<br>
	<p><a href="#" style="color: #3fb9c3;text-decoration: underline;">See all of your activity</a></p>
  </dd>
  <dt class="accordion__title">Profile</dt>
  <dd class="accordion__content">
    <p><b>Item 2 content.</b> Ut laoreet augue et neque pretium non sagittis nibh pulvinar. Etiam ornare tincidunt orci quis ultrices. Pellentesque ac sapien ac purus gravida ullamcorper. Duis rhoncus sodales lacus, vitae adipiscing tellus pharetra sed. Praesent bibendum lacus quis metus condimentum ac accumsan orci vulputate. Aenean fringilla massa vitae metus facilisis congue. Morbi placerat eros ac sapien semper pulvinar. Vestibulum facilisis, ligula a molestie venenatis, metus justo ullamcorper ipsum, congue aliquet dolor tortor eu neque. Sed imperdiet, nibh ut vestibulum tempor, nibh dui volutpat lacus, vel gravida magna justo sit amet quam. Quisque tincidunt ligula at nisl imperdiet sagittis. Morbi rutrum tempor arcu, non ultrices sem semper a. Aliquam quis sem mi.</p>
  </dd>
  <dt class="accordion__title">Messages</dt>
  <dd class="accordion__content">
    <p><b>Item 3 content.</b> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus dui urna, mollis vel suscipit in, pharetra at ligula. Pellentesque a est vel est fermentum pellentesque sed sit amet dolor. Nunc in dapibus nibh. Aliquam erat volutpat. Phasellus vel dui sed nibh iaculis convallis id sit amet urna. Proin nec tellus quis justo consequat accumsan. Vivamus turpis enim, auctor eget placerat eget, aliquam ut sapien.</p>
  </dd>
  <dt class="accordion__title">Settings</dt>
  <dd class="accordion__content">
    <p><b>Item 3 content.</b> Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus dui urna, mollis vel suscipit in, pharetra at ligula. Pellentesque a est vel est fermentum pellentesque sed sit amet dolor. Nunc in dapibus nibh. Aliquam erat volutpat. Phasellus vel dui sed nibh iaculis convallis id sit amet urna. Proin nec tellus quis justo consequat accumsan. Vivamus turpis enim, auctor eget placerat eget, aliquam ut sapien.</p>
  </dd>
</dl>
						</div>	
					</div>					
				</div>
              <div class="clearfix"></div>
            </section>
          </div>
        </div>
        <div class="col-sm-3 pt-20 wow bounceInRight" style="visibility: visible; animation-name: bounceInRight;">
			<div id="appointments" class="nav-tabs-custom company_profile_nav emp_profile_nav">
              <ul class="nav nav-tabs">
				<li class="pull-right dropdown nohover1">
				    <div class="dropdown invite_member">
						<a class="dropdown-toggle" id="menu1" data-toggle="dropdown">
						<i class="fa fa-user-plus add_member" aria-hidden="true"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
						  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="fs14">Invite Member</a></li>
						  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="fs14">Make a Group</a></li>
						  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="fs14">Remove</a></li>						  
						  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" class="fs14">+ Add Tab</a></li>    
						</ul>
					  </div>
                </li> 
				<li class="pull-right dropdown nohover1">
					<i class="fa fa-envelope-o" aria-hidden="true"></i>
                </li>
                <li class="pull-right dropdown nohover1">
					<i class="fa fa-trash-o" aria-hidden="true"></i>
                </li>
				               
              </ul>              
                <!-- /.tab-pane -->
            </div>
			<div class="box-layout1 next_user_profile">                            
                <div class="next_user-detail text-center m0 emp_profile mb-15">
                  <div class="post">
                    Admin
                  </div>
                  <h5 class="name">
                    ABHISHEK RAVAL
                  </h5>                
                </div>              
          </div>
          <div class="box-layout1">
            <div class="pb-20 emp_profile_area">
                <div class="user-pic" style="background-color:#62bd63">
                  <div class="profile_pic"><img src="images/emp.jpg" class="img-circle"></div>
                </div>
                <div class="user-details mt-20">
                  <div class="fieldname pt-20 text-center grey">
                    ACCOUNT MANAGER
                  </div>
                  <h3 class="text-center m0 pt-10 fs13">
                    NIKITA RAO
                  </h3>
                  <h4 class="text-center pt-20 black">
                    <a href="mailto:nikita@digirepublik.com">nikita@digirepublik.com</a>
                  </h4>
                  <p class="text-center m0 pb-10 green">
                   Last active on Nov 10
                  </p>
					<div class="rescenter mt-10 text-center">
						<a href="#" class="btn cblack mob-mb-10 fs12 grey_btn">VIEW PROFILE</a>
						<a href="#" class="btn btn-green cwhite fs12 green_btn">SEND MESSAGE</a>
					</div>                
                </div>
              </div>
          </div>		  
		  <div class="box-layout1 next_user_profile">                            
                <div class="next_user-detail text-center emp_profile">
                  <div class="post">
                    Admin
                  </div>
                  <h5 class="name">
                    GISELLE D'SA
                  </h5>                
                </div>              
          </div>
		  <div class="box-layout1 next_user_profile">                            
                <div class="next_user-detail text-center emp_profile">
                  <div class="post">
                    Admin
                  </div>
                  <h5 class="name">
                    ANSHUL KAPOOR
                  </h5>                
                </div>              
          </div>
		  <div class="clearfix"></div>
		  <div class="mt-20 text-center">                            
                <a href="#" class="btn cblack grey_btn fs12" style="border:1px solid #ccc;color: #a7a2a2;">View All</a>
				<div class="clearfix"></div>
          </div>
        </div>
		</div>
        <div class="clearfix"></div>      			
	</section> 
	<section class="content">
		 
		<div class="col-md-9 mt-40">
			
			<div class="billing_opt">
				<div class="col-md-3"><i class="fa fa-list" aria-hidden="true"></i> BILL PLANS</div>
				<div class="col-md-3"><a href="#" class="btn btn-primary"><i class="fa fa-clock-o" aria-hidden="true"></i> BILLING HISTORY</a></div>
				<div class="col-md-3"><i class="fa fa-credit-card" aria-hidden="true"></i> CHANGE PAYMENT</div>
				<div class="col-md-3"><i class="fa fa-file-text" aria-hidden="true"></i> INVOICES</div>
			</div>
			<div class="clearfix"></div> 
		
		<div class="clearfix"></div> 
		<div class="box no-border">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding emp_detail emp_bill_detail">
              <table class="table table-hover">
                <tbody>				
				<tr class="employee_table">
                  <th style="text-align: center;">ID No</th>
                  <th style="text-align: center;">Date</th>
                  <th style="text-align: center;">Invoice</th>
                  <th style="text-align: center;">Payment Profile</th>
                  <th style="text-align: center;">Status</th>
				  <th></th>
                </tr>
                <tr class="emp_info_data">                  
                  <td class="info">010</td>
                  <td class="info">04/09/2017</td>
                  <td class="info">#3271</td>
				  <td class="info">Initial Trial Balance</td>
				  <td class="info"><img src="images/checkout_option.png" width="25"></td>
				  <td class="info"><i class="fa fa-tasks" aria-hidden="true"></i></td>				  
                </tr>
                <tr class="emp_info_data">                  
                  <td class="info">002</td>
                  <td class="info">21/09/2017</td>
                  <td class="info">#4728</td>
				  <td class="info">Initial Trial Balance</td>
				  <td class="info"><img src="images/checkout_option.png" width="25"></td>
				  <td class="info"><i class="fa fa-tasks" aria-hidden="true"></i></td>				  
                </tr>
                <tr class="emp_info_data">                  
                  <td class="info">010</td>
                  <td class="info">04/09/2017</td>
                  <td class="info">#3271</td>
				  <td class="info">Initial Trial Balance</td>
				  <td class="info"><img src="images/checkout_option.png" width="25"></td>
				  <td class="info"><i class="fa fa-tasks" aria-hidden="true"></i></td>				  
                </tr>
                 <tr class="emp_info_data">                  
                  <td class="info">010</td>
                  <td class="info">04/09/2017</td>
                  <td class="info">#3271</td>
				  <td class="info">Initial Trial Balance</td>
				  <td class="info"><img src="images/checkout_option.png" width="25"></td>
				  <td class="info"><i class="fa fa-tasks" aria-hidden="true"></i></td>				  
                </tr>
				
              </tbody>
			  </table>	
				<div class="box-header employee_pagination mt-20 pt-20 pb-20">
					<div class="col-md-12 total_entry">
					<span>Showing 8 out of 34 entries</span>
					<ul class="pagination pagination-sm no-margin pull-right">
						<li><a href="#">«</a></li>						
						<li><a href="#">»</a></li>
					</ul>
					</div>
				</div>
			</div>
	   </div>
	   </div><!--col-md-12 closed-->
	   <div class="col-md-3 mob-p0">
			<div class="col-md-12 p0">			
				<div class="package_count_area">
					<span class="fs27">42</span><span> PACKAGES PURCHASED</span>
				</div>
				<div class="clearfix"></div> 
			<br>
		<div class="clearfix"></div> 
		<div class="box no-border">
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding emp_detail package_box" style="position: relative;
    z-index: 0;margin-top: 21px!important;padding-top: 62px!important;">
              <table class="table table-hover">
                <tbody>			
				
				<tr class="employee_table">
                  <th style="text-align: center;">Date</th>
                  <th style="text-align: center;">Packages</th>                 
				  <th></th>
                </tr>
                <tr class="emp_info_data package_detail_btn">                  
                  <td class="info ">02 Oct,<br>Monday</td>
                  <td class="info fs12">Comprehensive Health Checkup</td>
                  <td class="info"><a href="" class="btn cblack detail_pack_btn">VIEW DETAILS</a></td>				  			  
                </tr>
                <tr class="emp_info_data  package_detail_btn">                  
                  <td class="info">02 Oct,<br>Monday</td>
                  <td class="info fs12">Comprehensive Health Checkup</td>
                  <td class="info"><a href="" class="btn cblack detail_pack_btn view_detail">VIEW DETAILS</a></td>				  			  
                </tr>
                <tr class="emp_info_data  package_detail_btn">                  
                  <td class="info">02 Oct,<br>Monday</td>
                  <td class="info fs12">Comprehensive Health Checkup</td>
                  <td class="info"><a href="" class="btn cblack detail_pack_btn view_detail">VIEW DETAILS</a></td>				  			  
                </tr>
                 <tr class="emp_info_data  package_detail_btn">                  
                  <td class="info">02 Oct,<br>Monday</td>
                  <td class="info fs12">Comprehensive Health Checkup</td>
                  <td class="info"><a href="" class="btn cblack detail_pack_btn view_detail">VIEW DETAILS</a>	</td>				  			  
                </tr>
				
              </tbody>
			  </table>	
				<div class="mt-20 mb-10 text-center">                            
                <a href="#" class="btn cblack grey_btn fs12" style="border:1px solid #ccc;color: #a7a2a2;">View All</a>
				<div class="clearfix"></div>
				</div>
			</div>
	   </div>
	   </div>
	   </div>
	    <div class="clearfix"></div> 
	</section>
  </div>
</div>

<!-- ./wrapper -->
<div class="clearfix"></div>
<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE for Wow purposes -->
<script src="dist/js/wow.min.js"></script>
<!-- FLOT CHARTS -->
<script src="plugins/flot/jquery.flot.min.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/jquery.flot.pie.min.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="plugins/flot/jquery.flot.categories.min.js"></script>
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
</body>
</html>
