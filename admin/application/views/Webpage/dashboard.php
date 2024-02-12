<style type="text/css">
	.title{
		font-weight: bold;
		color:#000080;
	}
	.number{
		font-weight: bold!important;
		color:#800000;
	}
	.number1{
		font-weight: bold!important;
		color:#427506;
		display: block;
		font-size: 30px;
	}
	tr.cur_thd > th {
    text-align: right;
	color:#000080!important;
	font-weight: 700;
}
   .tr-rows{
	color:#000080!important;
	font-weight: 700;
   }
tbody {
    text-align: right;
}
</style>
	<!-- MAIN -->
	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
			<div class="container-fluid">
				<!-- OVERVIEW -->
				<div class="panel panel-headline">
					<div class="panel-heading">
						<!-- <h3 class="panel-title">Weekly Overview</h3>
						<p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p> -->
					</div>
					
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3">
								<div class="metric">								
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($trust_users)+1; ?></span>
										<span class="title">Trustee & Managing Trustee</span>
									</p>
								</div>
							</div>
							<div class="col-md-3">
								<div class="metric" >
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($general); ?></span>
										<span class="title">Governing Council Member</span>
									</p>
								</div>
							</div>
							<div class="col-md-2">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($monthly); ?></span>
										<span class="title"> Monthly Contributor</span>
									</p>
								</div>
							</div>
							<div class="col-md-2">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($member); ?></span>
										<span class="title"> Other Contributor</span>
									</p>
								</div>
							</div>
							<div class="col-md-2">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($no_details); ?></span>
										<span class="title">No Details</span>
									</p>
								</div>
							</div>
							
							<!--  <div class="col-md-4">
								<div class="metric">
									<span class="icon"><i class="fa fa-rupee-sign"></i></span>
									<p>
										<span class="number"><?php foreach ($today_amount as  $t) {
										 $amount+=$t->amount;
										}
										echo $amount;
										 ?></span>
										<span class="title">Today Amount</span>
									</p>
								</div>
							</div>  -->
							<!-- <div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-eye"></i></span>
									<p>
										<span class="number"><?php foreach ($month_amount as  $t) {
										 $amount+=$t->amount;
										}
										echo $amount;
										 ?></span>
										<span class="title">This Month Amount  </span>
									</p>
								</div>
							</div> -->
							<!-- <div class="col-md-3">
								<div class="metric">
									<span class="icon"><i class="fa fa-bar-chart"></i></span>
									<p>
										<span class="number"><?php foreach ($overall_amount as  $t) {
										 $amount+=$t->amount;
										}
										echo $amount;
										 ?></span>
										<span class="title">Overall Amount</span>
									</p>
								</div>
							</div> -->
						</div>
						<div class="row">
						<div class="col-md-4">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($monthly_donation); ?></span>
										<span class="number1"><?php echo number_format($monthly_donation_amount['amount']); ?></span>
										<span class="title">Monthly</span>
									</p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($onetime_donation); ?></span>
										<span class="number1"><?php echo number_format($onetime_donation_amount['amount']); ?></span>
										<span class="title">One Time</span>
									</p>
								</div>
							</div>
							<div class="col-md-4">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($corpos_donation); ?></span>
										<span class="number1"><?php echo number_format($corpos_donation_amount['amount']); ?></span>
										<span class="title">Corpus</span>
									</p>
								</div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($update_pan_users); ?>/<?php echo count($total_users); ?></span>
										<span class="title" style="font-size:14px;">Update Pan Users/Total Users</span>
									</p>
								</div>
							</div>
							<div class="col-md-6">
								<div class="metric">
									<span class="icon"><i class="fa fa-users"></i></span>
									<p>
										<span class="number"><?php echo count($update_address_users); ?>/<?php echo count($total_users); ?></span>
										<span class="title" style="font-size:14px;">Update Address Users/Total Users</span>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			<!-- table  --->

<?php 
$yr=$this->mcommon->specific_row_value('company_setting',array('id'=>1),'current_financial_year');
$mnth=array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"); ?>
			
				<!-- END OVERVIEW -->
				<div class="row" style="display: none;">
					<div class="col-md-12">
						<!-- RECENT PURCHASES -->
						<div class="panel">
							<div class="panel-heading">
							<h3 class="panel-title">Contributions</h 3>
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
								</div>
							</div>
							<div class="panel-body no-padding">
								<table class="table table-bordered">
									<thead>
									<tr>
											<td align="center" colspan="7" style="color:#296ec6">CURRENT YEAR <?php echo $yr; ?></td>
										</tr>
										<tr class="tr-rows">
											<td align="center">Month</td>
											<td align="center" colspan="2">Monthly</td>
											<td align="center" colspan="2">One Time</td>
											<td align="center" colspan="2">Corpus</td>
										</tr>
										<tr class="cur_thd">
											<th></th>
											<th>Number</th>
											<th>Amount</th>										
											<th>Number</th>
											<th>Amount</th>
											<th>Number</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										
										
										foreach ($month_data as $key => $month) {										
                                             $corpos=$cor=[];
                                             $one_time=$one=[];
                                             $general=$gen_amnt=[];
                                               foreach ($month as  $v) {
                                                	 if ($v->corpusFund==2) {
                                                	 	$corpos[]=$v->donation_id;														
														 $am=$this->mcommon->get_sum_amount('donation',$key,2,array('financial_year'=>$yr));
														 //$cor[]=$v->amount;
														 $cor[]=$am['amount'];
                                                	 }elseif ($v->corpusFund==3) {
                                                	 	$one_time[]=$v->donation_id;
														 $am1=$this->mcommon->get_sum_amount('donation',$key,3,array('financial_year'=>$yr));
														 //$one[]=$v->amount;
														 $one[]=$am1['amount'];
                                                	 }elseif ($v->corpusFund==1) {
                                                	 	$general[]=$v->donation_id;
														 $am2=$this->mcommon->get_sum_amount('donation',$key,1,array('financial_year'=>$yr));
														 //$gen_amnt[]=$v->amount;
														 $gen_amnt[]=$am2['amount'];
                                                	 }
                                                }
										 ?>
										<tr>
											<td style="text-align: left;"><?php if ($key==1) {
												echo "January";
											}elseif ($key==2) {
												echo "February";
											}elseif ($key==3) {
												echo "March ";
											}elseif ($key==4) {
												echo "April ";
											}elseif ($key==5) {
												echo "May";
											}elseif ($key==6) {
												echo "June";
											}elseif ($key==7) {
												echo "July";
											}elseif ($key==8) {
												echo "August";
											}elseif ($key==9) {
												echo "September ";
											}elseif ($key==10) {
												echo "October";
											}elseif ($key==11) {
												echo "November ";
											}elseif ($key==12) {
												echo "December";
											} ?></td>
											<td><?php echo $gen1=count($general); ?></td>
											<td><?php echo $gen_amnt[$key]; ?></td>
											<td><?php echo $onet=count($one_time); ?></td>
											<td><?php echo $one[$key]; ?></td>
											<td><?php echo $corpu=count($corpos); ?></td>
											<td><?php echo $cor[$key]; ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<!-- <div class="panel-footer">
								<div class="row">
									<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Donates</a></div>
								</div>
							</div> -->
						</div>
						<!-- END RECENT PURCHASES -->
					</div>
				</div>


				<div class="row">
					<div class="col-md-12">
						<!-- RECENT PURCHASES -->
						<div class="panel">
							<div class="panel-heading">
							<h3 class="panel-title" style="font-size:18px;">Contributions</h3>
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
								</div>
							</div>
							<div class="panel-body no-padding">
								<table class="table table-bordered">
									<thead>
									<tr>
											<td align="center" colspan="9" style="color:#000080!important;font-size:16px;font-weight:bold!important">Current Year <?php echo $fin_year; ?></td>
										</tr>
										<tr class="tr-rows">
											<td align="left">Month</td>
											<td align="center" colspan="2">Monthly</td>
											<td align="center" colspan="2">One Time</td>	
											<td align="center" colspan="2">General Fund</td>										
											<td align="center" colspan="2">Corpus Fund</td>
											
											
										</tr>
										<tr class="cur_thd">
											<th></th>
											<th>Number</th>
											<th>Amount</th>										
											<th>Number</th>
											<th>Amount</th>
											<th>Number</th>
											<th>Amount</th>
											<th>Number</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$con_tot=$con_tot1=$con_tot=$gen_con=0;
										$amt_tot=$amt_tot1=$amt_tot2=$gen_tot=0;
										foreach ($month_data as $key => $month) {
											//echo $key;
											// if ($key == 1 || $key == 2 || $key == 3) {
											// 	continue;
											// }
											//foreach ($month as  $v) {
										?>
										<tr>
											<td style="text-align: left;font-weight: bold;"><?php echo $mnth[$key]; ?></td>
											<td class="title"><?php $cn=$this->mcommon->get_count_month_general('donation',$key,1,array('financial_year'=>$yr)); echo $cn['cont']; ?></td>
											<td class="title"><?php $am=$this->mcommon->get_sum_amount_general('donation',$key,1,array('financial_year'=>$yr)); echo isset($am['amount']) ? $am['amount']:'0.00'; ?></td>
											<td class="title"><?php $cn1=$this->mcommon->get_count_month('donation',$key,3,array('financial_year'=>$yr)); echo $cn1['cont']; ?></td>
											<td class="title"><?php  $am1=$this->mcommon->get_sum_amount('donation',$key,3,array('financial_year'=>$yr)); echo isset($am1['amount']) ? $am1['amount']:'0.00'; ?></td>																						
											<td class="title"><?php echo $gcon=$cn['cont']+$cn1['cont']; ?></td>
											<td class="title"><?php $gam=$am1['amount']+$am['amount']; echo number_format($gam,2); ?></td>
											<td class="title"><?php $cn2=$this->mcommon->get_count_month('donation',$key,2,array('financial_year'=>$yr)); echo $cn2['cont']; ?></td>
											<td class="title"><?php $am2=$this->mcommon->get_sum_amount('donation',$key,2,array('financial_year'=>$yr)); echo isset($am2['amount']) ?$am2['amount']:'0.00';?></td>
											
										</tr>
										<?php  
										//echo "<pre>";print_r($this->db);
									$con_tot +=$cn['cont'];
									$con_tot1 +=$cn1['cont'];
									$con_tot2 +=$cn2['cont'];
									$amt_tot +=$am['amount'];
									$amt_tot1 +=$am1['amount'];
									$amt_tot2 +=$am2['amount'];
									$gen_con +=$gcon;
									$gen_tot +=$gam;
									} //} ?>
									<tr>
										<td style="text-align: left; font-size: 16px; font-weight: bold; color:#800000!important">Total</td>
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo $con_tot ?></td>
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo  str_replace( ',', '',number_format($amt_tot,2)) ?></td>										
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo $con_tot1 ?></td>
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo str_replace( ',', '',number_format($amt_tot1,2)); ?></td>
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo $gen_con; ?></td>
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo str_replace( ',', '',number_format($gen_tot,2)); ?></td>
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo $con_tot2 ?></td>
										<td style="font-size: 16px; font-weight: bold; color:#800000!important"><?php echo str_replace( ',', '',number_format($amt_tot2,2)); ?></td>
									</tr>
										<tr>
										<td colspan="7" style="text-align: left; font-size: 16px; font-weight: bold; color:#427506!important">Grand Total</td>
										<td style="font-size: 16px; font-weight: bold; color:#427506!important"><?php echo $gen_con+$con_tot2 ?></td>
										<td style="font-size: 16px; font-weight: bold; color:#427506!important"><?php echo str_replace( ',', '',number_format($gen_tot+$amt_tot2,2)); ?></td>
										
									</tr>
									</tbody>
									
								</table>
							</div>
							<!-- <div class="panel-footer">
								<div class="row">
									<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Donates</a></div>
								</div>
							</div> -->
						</div>
						<!-- END RECENT PURCHASES -->
					</div>
				</div>
				
				
				<div class="row" style="display: none;">
					<div class="col-md-12">
						<!-- RECENT PURCHASES -->
						<div class="panel">
							<div class="panel-heading">
								
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
								</div>
							</div><br>
							<div class="panel-body no-padding">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Financial Year</th>
											<th>Total No</th>																		
											<th>Total Amount</th>
											<th>Type</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										$typ=array('',"General","Corpus","oneTime");
										foreach($overall_data as $key => $val) { 
											$ty=explode(',',$val->corpusFund);
											?>
										<tr>
										<td><?php echo $val->financial_year ?></td>
										<td><?php echo $val->total ?></td>
										<td><?php echo $val->Amount ?></td>
										<td><?php echo $typ[$ty[0]].",".$typ[$ty[1]].",".$typ[$ty[2]]; ?></td>											
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<!-- <div class="panel-footer">
								<div class="row">
									<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Donates</a></div>
								</div>
							</div> -->
						</div>
						<!-- END RECENT PURCHASES -->
					</div>
				</div>	

			<div class="row">
					<div class="col-md-12">
						<div class="panel">
								<div class="panel-heading">									
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
								<table class="table table-bordered">
									<thead>
										<tr>
											<td align="center" colspan="9" style="color:#000080!important;font-size:16px;font-weight:bold!important">Other Years</td>
										</tr>
										<tr class="tr-rows">
											<td align="left">Financial Year</td>
											<td align="center" colspan="2">Monthly</td>
											<td align="center" colspan="2">One Time</td>	
											<td align="center" colspan="2">General Fund</td>										
											<td align="center" colspan="2">Corpus Fund</td>
											
										</tr>
										<tr class="cur_thd">
											<th></th>
											<th>Number</th>
											<th>Amount</th>										
											<th>Number</th>
											<th>Amount</th>
											<th>Number</th>
											<th>Amount</th>
											<th>Number</th>
											<th>Amount</th>
										</tr>
									</thead>
									<tbody>
									<?php 
							
										$typ=array('',"General","Corpus","oneTime");
										
											// /$ty=explode(',',$val->corpusFund);
											foreach($overall_data as $row){
											?>

										<tr>
										<td style="text-align:left;font-weight: bold;"><?php echo $row->financial_year; ?></td>
										<td style="font-weight: bold;"><?php echo $row->general_cont; ?></td>
										<td style="font-weight: bold;"><?php echo isset($row->General) ? number_format($row->General,2):'0.00'; ?></td>
										<td style="font-weight: bold;"><?php echo $row->onetime_cont; ?></td>
										<td style="font-weight: bold;"><?php echo isset($row->Onetime) ? number_format($row->Onetime,2):'0.00'; ?></td>
										<td style="font-weight: bold;"><?php echo $row->general_cont+$row->onetime_cont; ?></td>
										<td style="font-weight: bold;"><?php echo number_format($row->General+$row->Onetime,2); ?></td>
										<td style="font-weight: bold;"><?php echo $row->corpus_cont; ?></td>
										<td style="font-weight: bold;"><?php echo isset($row->Corpus) ? number_format($row->Corpus,2):'0.00'; ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>

								</div>
						</div>
					</div>
			</div>
			


				<div class="row" style="display: none;">
					<div class="col-md-12">
						<!-- RECENT PURCHASES -->
						<div class="panel">
							<div class="panel-heading">
								<h3 class="panel-title">Overall Previous year</h3>
								<div class="right">
									<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
									<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
								</div>
							</div><br>
							<div class="panel-body no-padding">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Month</th>
											<th>Total No</th>																		
											<th>Total Amount</th>
											<th>Type</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										
										$typ=array('',"General","Corpus","oneTime");
										foreach($current_year as $key => $val) { 
										foreach($val as $ky=>$mn){
										?>
										<tr>
										<td><?php echo $mnth[$mn->receipt_month]; ?></td>
										<td><?php echo $mn->Number; ?></td>
										<td><?php echo $mn->Amount; ?></td>
										<td><?php echo $typ[$mn->corpusFund]; ?></td>											
										</tr>
										<?php } }?>
									</tbody>
								</table>
							</div>
							<!-- <div class="panel-footer">
								<div class="row">
									<div class="col-md-6 text-right"><a href="#" class="btn btn-primary">View All Donates</a></div>
								</div>
							</div> -->
						</div>
						<!-- END RECENT PURCHASES -->
					</div>
				</div>



			</div>
		</div>
		<!-- END MAIN CONTENT -->
	</div>
	<!-- END MAIN -->
	

