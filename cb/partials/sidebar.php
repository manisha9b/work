 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image" style="padding-top:25px;width: 70px;height: 100px;overflow: hidden;">
          <img src="<?php echo EBH_WEBSITE_URL.$arr_cluster['logo']?>" class="img-circle" alt="User Image">
        </div>
        <div class="clearfix clear"></div>
        <div class="info">
          <p> <?php echo $arr_cluster['cluster_business_name']?></p>
        </div>
        <div class="prof cluster_progress_bar">
          <div class="progress xs1 mb-0" style="height:3px;margin:0;">
            <!-- Change the css width attribute to simulate progress -->
            <div class="progress-bar progress-bar-cgreen" style="width: 80%;height:3px;margin:0;" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
		  <div class="clearfix"></div>
          <div class="progresscomplete mb-10" style="margin-top: 9px;white-space: normal;">80% complete profile</div>
          <p style="color: #b7bbc2;">
            <?php echo $arr_cluster['address']?><br/>
           
            <?php echo $arr_cluster['city_name']?>
          </p>
        </div>
      </div>
      <div class="divider"></div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="dashboard_menu cb-menu">
          <a href="dashboard.php">
            <i class="fa fa-th-large"></i> <span>Health Dashboard</span>
          </a>
        </li>
        <li class="cb-menu package_menu">
          <a   href="package.php">
            <i class="fa ion-ios-medkit-outline"></i> <span>Health Packages</span>
          </a>
        </li>
        <li class="cb-menu employee_menu">
          <a  href="employee.php">
            <i class="fa fa-address-card-o"></i> <span>Employees</span>
          </a>
        </li>
        <li>
          <a class="cb-menu" href="my-family.html">
            <i class="fa fa-heartbeat"></i> <span>Health Index</span>
          </a>
        </li>
		<li>
          <a href="appointment.php">
            <i class="cb-menu fa fa-calendar"></i> <span>Appointments</span>
          </a>
        </li>
		<li class="cb-menu report_menu">
          <a href="reports.php">
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
        <li>
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
