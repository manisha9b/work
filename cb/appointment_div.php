
   <div class="clearfix"></div>
   <div id="appointments" class="nav-tabs-custom employee_info">
      <ul class="nav nav-tabs">
	   <li class="all active"><a href="#tab_3-2" onclick="return hidesummary()" data-toggle="tab" style="padding:12.5px;">All</a></li>
         <!-- <li class="active">
            <div class="dropdown">
               <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background:#04092f;padding:12px;border-radius: 0!important;">PRE EMPLOYMENT<span class="caret"></span></a>				  
               <ul class="dropdown-menu purchase_drop_down employee_dropdown" style="width: 140%;">
                  <li><a href="#">Pre Employment</a></li>
                  <li><a href="#">Annual Checkup</a></li>
                  <li><a href="#">Package Type A</a></li>
                  <li><a href="#">Add Tabs</a></li>
               </ul>
            </div>
         </li>
         <li class="upcoming"><a href="#tab_2-2" onclick="return hidesummary()" data-toggle="tab" aria-expanded="false" style="padding:12.5px;">UPCOMING</a></li>
        
         <li class="pull-right dropdown nohover1 sort_by_btn">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">                    Sort By <span class="caret" style="margin-left: 85px;"></span>                  </a>                  
            <ul class="dropdown-menu">
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sort By</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Date &amp; Time</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Location</a></li>
               <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Status</a></li>
            </ul>
         </li> -->
         <li class="pull-right nohover1">
            <!-- search form -->                  
            <form action="#" method="get" class="employee_search sidebar-form1" style="display: inline-block;border-bottom: 1px solid #ccc;">
               <div class=" inner-addon left-addon">                      <i class="fa fa-search"></i>                      <input type="text" name="q" class="form-control" placeholder="Search">                    </div>
            </form>
            <!-- /.search form -->                
         </li>
      </ul>
   </div>
   <div class="box no-border">
      <!-- /.box-header -->            
      <div class="box-body table-responsive emp_detail ">
         <div class="table-responsive">
            <table class="table table-hover employee_details_area">
               <tbody>
                  <tr class="employee_table employee_heading">
                     <th> </th>
                     <th> </th>
                     <th>FILL NAME</th>
                     <th>DEPARTMENT <span class="caret"></span></th>
                     <th>WHERE <span class="caret"></span> </th>
                     <th>TEST</th>
                     <th>STATUS</th>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">						<input type="checkbox" id="test1" />						<label for="test1"></label>					</td>
                     <td class="table_circle emp_pic"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Danish Rao</td>
                     <td class="info">Business Developement</td>
                     <td class="info">Suburban Diagnostics Andheri</td>
                     <td class="info">CBC Test</td>
                     <td class="info confirmed"><i class="fa fa-check" aria-hidden="true"></i> CONFIRMED</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">						<input type="checkbox" id="test2"/>						<label for="test2"></label>					</td>
                     <td  class="table_circle emp_pic info"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Anisha Peters</td>
                     <td class="info" >Design & Visualisation</td>
                     <td class="info">Metropolis Clinic Lower Parel</td>
                     <td class="info">RBC Test</td>
                     <td class="info pending"><i class="fa fa-clock-o" aria-hidden="true"></i> PENDING</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">						<input type="checkbox" id="test3"/>						<label for="test3"></label>					</td>
                     <td class="table_circle emp_pic"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Danish Rao</td>
                     <td class="info">Business Developement</td>
                     <td class="info">Suburban Diagnostics Andheri</td>
                     <td class="info">CBC Test</td>
                     <td class="info confirmed"><i class="fa fa-check" aria-hidden="true"></i> CONFIRMED</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">					<input type="checkbox" id="test4"/>					<label for="test4"></label>				</td>
                     <td  class="table_circle emp_pic info"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Anisha Peters</td>
                     <td class="info" >Design & Visualisation</td>
                     <td class="info">Metropolis Clinic Lower Parel</td>
                     <td class="info">RBC Test</td>
                     <td class="info pending"><i class="fa fa-clock-o" aria-hidden="true"></i> PENDING</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">					<input type="checkbox" id="test5"/>					<label for="test5"></label>				</td>
                     <td class="table_circle emp_pic"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Danish Rao</td>
                     <td class="info">Business Developement</td>
                     <td class="info">Suburban Diagnostics Andheri</td>
                     <td class="info">CBC Test</td>
                     <td class="info confirmed"><i class="fa fa-check" aria-hidden="true"></i> CONFIRMED</td>
                  </tr>
                  <div class="clearfix"></div>
                  <tr class="emp_info_data" data-toggle="modal" data-target="#health_checkup_status">
                     <td class="info">						<input type="checkbox" id="test6"/>						<label for="test6"></label>					</td>
                     <td  class="table_circle emp_pic info"><img src="dist/img/sneha.png" class="img-circle"></td>
                     <td class="info">Anisha Peters						<span class="app_scheduled">Scheduled</span>					  </td>
                     <td class="info" >Design & Visualisation</td>
                     <td class="info">Metropolis Clinic Lower Parel</td>
                     <td class="info">RBC Test</td>
                     <td class="info pending"><i class="fa fa-clock-o" aria-hidden="true"></i> PENDING</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">					<input type="checkbox" id="test7" />					<label for="test7"></label>				</td>
                     <td class="table_circle emp_pic"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Danish Rao</td>
                     <td class="info">Business Developement</td>
                     <td class="info">Suburban Diagnostics Andheri</td>
                     <td class="info">CBC Test</td>
                     <td class="info confirmed"><i class="fa fa-check" aria-hidden="true"></i> CONFIRMED</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">					<input type="checkbox" id="test8" />					<label for="test8"></label>				</td>
                     <td  class="table_circle emp_pic info"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Anisha Peters</td>
                     <td class="info" >Design & Visualisation</td>
                     <td class="info">Metropolis Clinic Lower Parel</td>
                     <td class="info">RBC Test</td>
                     <td class="info pending"><i class="fa fa-clock-o" aria-hidden="true"></i> PENDING</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">					<input type="checkbox" id="test7" />					<label for="test7"></label>				</td>
                     <td class="table_circle emp_pic"><img src="dist/img/user2-160x160.jpg" class="img-circle"></td>
                     <td class="info">Danish Rao</td>
                     <td class="info">Business Developement</td>
                     <td class="info">Suburban Diagnostics Andheri</td>
                     <td class="info">CBC Test</td>
                     <td class="info confirmed"><i class="fa fa-check" aria-hidden="true"></i> CONFIRMED</td>
                  </tr>
                  <tr class="emp_info_data">
                     <td class="info">					<input type="checkbox" id="test6">					<label for="test6"></label>				</td>
                     <td class="table_circle emp_pic info"><img src="dist/img/sneha.png" class="img-circle"></td>
                     <td class="info">Anisha Peters</td>
                     <td class="info">Design &amp; Visualisation</td>
                     <td class="info">Metropolis Clinic Lower Parel</td>
                     <td class="info">RBC Test</td>
                     <td class="info pending"><i class="fa fa-clock-o" aria-hidden="true"></i> PENDING</td>
                  </tr>
               </tbody>
            </table>
            <div class="box-header employee_pagination mt-20 pt-20 pb-20">
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
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-6 employee_chart_area">
         <div class="nav-tabs-custom ">
            <ul class="nav nav-tabs">
               <li class=""><a href="#region" data-toggle="tab" aria-expanded="false">TOP REGIONS</a></li>
               <li  class="active"><a href="#hsp" data-toggle="tab" aria-expanded="false">TOP HSP'S</a></li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane" id="region">
                  <div class="user-block">                    <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">                        <span class="username">                          <a href="#">Adam Jones</a>                          <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>                        </span>                    <span class="description">Posted 5 photos - 5 days ago</span>                  </div>
               </div>
               <!-- /.tab-pane -->              
               <div class="tab-pane active" id="hsp">
                  <!-- The timeline -->                
                  <div class="box-body">					<img src="images/map.png">				</div>
               </div>
               <!-- /.tab-pane -->                         
            </div>
            <!-- /.tab-content -->          
         </div>
      </div>
      <div class="col-md-6 test_undertaken_employees">
         <div class="box undertaken_employees">
            <div class="box-header with-border">
               <h4 class="pull-left margin0"><strong>TEST UNDERTAKEN BY EMPLOYEES</strong></h4>
            </div>
            <!-- /.box-header -->            
            <div class="box-body profileimg">
               <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">			  <span class="profile_info" style="">			  <span class="name" style=""><strong>John Fernandes</strong></span>			  <span class="info" style="display:block">					Lorem Ipsum is simply dummy text              </span>			  </span>				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>                
               <hr>
               <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">			  <span class="profile_info" style="">			  <span class="name" style=""><strong>John Fernandes</strong></span>			  <span class="info" style="display:block">					Lorem Ipsum is simply dummy text              </span>			  </span>				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>                
               <hr>
               <img src="dist/img/user2-160x160.jpg" class="img-circle" style="">			  <span class="profile_info" style="">			  <span class="name" style=""><strong>John Fernandes</strong></span>			  <span class="info" style="display:block">					Lorem Ipsum is simply dummy text              </span>			  </span>				<a class="pull-right" style="margin-top: 15px;">Male,28 yrs</a>                
               <hr>
               <a href="#" class="btn2-lg">
                  <h5 class="margin0">View All</h5>
               </a>
               <!-- /.box-body -->          
            </div>
            <!-- /.box -->        
         </div>
      </div>
   </div>


