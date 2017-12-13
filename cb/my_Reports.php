 <?php 
 $arr_cluster_pack = $database->getclusterEbhPackage($database->clusterId);

 ?>
 <div class="swiper-container graph-container">
			<div class="col-md-12">
			 <!-- BAR CHART -->
			 	
			  <div class="box box-success">
            <div class="box-header with-border">
 <div class="pre-header" style="margin: 8px 0;">
                      <h5 class="margin0 text-uppercase2"><b>Last Purchased Health Package Statistics:</b></h5>
					  
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
			<div class="row">
			<div class="form-group">
                <label class="col-md-2 control-label" style="font-size:13px!important">Health Package
				</label>
				<div class="col-sm-4 ">
	<?php
	if(!empty($arr_cluster_pack))
	{
		echo'<select size="1" name="change_package" id="change_package" class="form-control input-sm">';
			foreach($arr_cluster_pack as $row)
			{
				if($_GET['package_id'] == $row['cluster_package_id'])
				{
					echo "<option value=\"".$row['cluster_package_id']."\" selected>".$row['package_nm']."</option>\n";
				}
				else
				{
					echo "<option value=\"".$row['cluster_package_id']."\">".$row['package_nm']."</option>\n";
				}
			}
		echo'</select>';
	}
	?>
	</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-12" id="last_package_statistics">
			<?php include_once('lps.php'); ?>
			</div>
			</div>
			</div>
            <!-- /.box-body -->
          </div>
         
           
          
               
		  </div>
		  </div>
		  </div>
		  