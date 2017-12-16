<script>
		  $(document).ready(function(){
			
	
	<?php
	   $colorarray[4]['color'] = "#4D5360";
        $colorarray[4]['highlight'] = "#616774";
        $colorarray[0]['color'] = "#F7464A";
        $colorarray[0]['highlight'] = "#FF5A5E";
        $colorarray[1]['color'] = "#46BFBD";
        $colorarray[1]['highlight'] = "#5AD3D1";
        $colorarray[2]['color'] = "#F39C12";
        $colorarray[2]['highlight'] = "#F4A324";
         $colorarray[3]['color'] = "#00a65a";
        $colorarray[3]['highlight'] = "#00c068";
	if($po_char_arr[0]['total_invites'] != 0)
{	
	$com_per = (($po_char_arr[0]['total_invites']*100)/$package_unit);
?>
 var pieData_pkg1 = [
 {
					value: <?php echo ($package_unit - $po_char_arr[0]['total_invites']) ?>,
					color:"<?php echo $colorarray[2]['color']?>",
					highlight: "<?php echo $colorarray[2]['highlight']?>",
					label: ""
				},
				{
					value: <?php echo $po_char_arr[0]['total_invites']?>,
					color:"<?php echo $colorarray[1]['color']?>",
					highlight: "<?php echo $colorarray[1]['highlight']?>",
					label: ""
				},
				]
				
<?php } 
if($po_char_arr[0]['total_confirmed'] != 0)
{	
	$inv_per = (($po_char_arr[0]['total_confirmed']*100)/$po_char_arr[0]['total_invites']);
?>
var pieData_pkg2 = [
 {
					value: <?php echo ($po_char_arr[0]['total_invites'] - $po_char_arr[0]['total_confirmed']) ?>,
					color:"<?php echo $colorarray[2]['color']?>",
					highlight: "<?php echo $colorarray[2]['highlight']?>",
					label: ""
				},
				{
					value: <?php echo ceil($po_char_arr[0]['total_confirmed']) ?>,
					color:"<?php echo $colorarray[1]['color']?>",
					highlight: "<?php echo $colorarray[1]['highlight']?>",
					label: ""
				},
				]
				//window.onload = function(){
				//var ctx_pkg2 = document.getElementById("chart-area2").getContext("2d");
				//window.myPie = new Chart(ctx_pkg2).Doughnut(pieData_pkg2);
				//}
<?php } if($po_char_arr[0]['total_visited'] != 0)
{	
	//$total_appt = ($po_char_arr[0]['total_visited'] * 100 / $po_char_arr[0]['converted_per']);
	$total_appt = ($po_char_arr[0]['total_visited'] * 100 / $appt_confirmed);
	$total_appt_notvisited = ($total_appt - $po_char_arr[0]['total_visited']);
	$vis_per = (($po_char_arr[0]['total_visited']*100)/$appt_confirmed);
?>
var pieData_pkg3 = [
 {
					value:  <?php echo ($appt_confirmed - $po_char_arr[0]['total_visited']); ?>,
					color:"<?php echo $colorarray[2]['color']?>",
					highlight: "<?php echo $colorarray[2]['highlight']?>",
					label: ""
				},
				{
					value: <?php echo ceil($po_char_arr[0]['total_visited']) ?>,
					color:"<?php echo $colorarray[1]['color']?>",
					highlight: "<?php echo $colorarray[1]['highlight']?>",
					label: ""
				},
				]
				//window.onload = function(){
				//var ctx_pkg2 = document.getElementById("chart-area2").getContext("2d");
				//window.myPie = new Chart(ctx_pkg2).Doughnut(pieData_pkg2);
				//}
<?php } ?>
//window.onload = function(){
<?php	if($po_char_arr[0]['total_invites'] != 0)
{ ?>
				var ctx_pkg1 = document.getElementById("chart-area1").getContext("2d");
				window.myPie = new Chart(ctx_pkg1).Doughnut(pieData_pkg1);
				
				<?php } if($po_char_arr[0]['total_confirmed'] != 0)
{	?>
					var ctx_pkg2 = document.getElementById("chart-area2").getContext("2d");
				window.myPie = new Chart(ctx_pkg2).Doughnut(pieData_pkg2);
				<?php }  if($po_char_arr[0]['total_visited'] != 0)
{	?>
					var ctx_pkg3 = document.getElementById("chart-area3").getContext("2d");
				window.myPie = new Chart(ctx_pkg3).Doughnut(pieData_pkg3);
				<?php } ?>
				//}
	});
</script>