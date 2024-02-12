<?php 
 $setting = $this->mcommon->records_all('company_setting');
/*$receipt_data=$this->main->get_donation_details($donation_id); */
foreach ($receipt_data as $d) {
	# code...
}
foreach ($setting as $key => $set) {}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title >Kainkarya - Receipt</title>
	<style type="text/css">
		td{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			font-weight: 400;
		}
		.text-color{
			color: #031c99;
		}
		.user_data{
			color: #031c99;
			font-weight: bold;
		}
	</style>
</head>
<body onload="window.print()">

	<table cellpadding="5" cellspacing="0" border="1" rules="all" width="100%" style="font-size: 14px;border:1px solid #000080!important;">
		<tr>
			<td align="center"><img src="<?php echo base_url('public/adn-assets/img/pan/').$set->trust_logo; ?>" style="width: 150px;" height=""></td>
			<td colspan="3" align="center">

				<h1 style="margin-bottom: 10px;" class="text-color"> <?php echo $set->trust_name;?></h1>
				<h4 style="margin-top: 10px;line-height: 18px;">
					<address class="text-color"><?php echo $set->address;?></address>
				</h4>
				<h3 style="margin-top: 0px;" class="text-color">PANNNN: <?php echo $set->trust_pan;?><br>URN: <?php  echo $set->trust_urn;?></h3>
			
				<?php  $check_date='2021-11-28';
				 if($d['receipt_date'] > $check_date){ ?>
				<h5><b style="color: #ff5722!important;">ALL DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF INCOME TAX ACT 1961. URN AAETK3106DF20217 Dt. 29 November 2021.</b></h5>
				 <?php } ?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<h3 align="center" style="text-decoration: underline;margin: 10px;text-align:center">RECEIPT</h3>
				<table width="100%" align="left">
					<tr>
						<th  colspan="2" align="left">Receipt No:<span  class="user_data"> <?= $d['receipt_number'];?></span></th>
						<th  colspan="2" align="right">Date: <span  class="user_data">
						<?=  date('d-m-Y', strtotime($d['receipt_date']));?></span></th>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="4" style="font-size:15px;">
				<b>Received with thanks from Sri/Smt.</b><span class="user_data"> <?= strtoupper($d['firstName']) . ' ' .strtoupper($d['lastName']);?></span><br /><br />
				<b>Address</b><br/><span  class="user_data">
				<?php if (!empty($d['address'])) {
					echo $d['address'];
				}else{
                    echo $d['address1'];
				} ?><br/>
		</span>
			</td>
		</tr>
		<tr>
			<td><h2 style="margin: 5px;"><span  class="user_data">Rs. <?= $d['amount'];?></span></h2></td>
			<td colspan="3" style="text-transform: uppercase;" >
				<b> <span  class="user_data">Rupees 
							<?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
							echo $f->format($d['amount']);
							?> only</span>
				</b>
			</td>
		</tr>
		<tr>
			<td colspan="4"><b>Income Tax PAN :</b><span  class="user_data"> <?php if(!empty($d['pan'])) {
				echo $d['pan'];
			}else{
				echo $d['pan1'];
			}?></td>
			</span>
		</tr>		
		<tr>
			<td colspan="4"><b>Towards : </b><span  class="user_data"> <?php echo $d['remarks'];
			?></span></td>
		</tr>		
		<tr>
			<td colspan="4"><b>Method of Payment :</b> <span  class="user_data">
				<?php if($d['paymentMode'] == 1){ 
					echo "Cash"; 
				}else if($d['paymentMode'] == 2){
					echo "Online";
				}elseif($d['paymentMode']== 3){ 
					echo "Cheque";
			    }elseif($d['paymentMode']== 4){
			    	echo "NEFT";
			    }?></span></td>
		</tr>
		<?php
		if($d['paymentMode'] == 3){
			?>
		<tr>
			<th width="30%"><b>Cheque No</b></th>
			<th width="15%"><b>Cheque Date</b></th>
			<th><b>Bank Name & Branch</b></th>
			<!-- <td rowspan="2" align="right"><br /><br /><br /><b>Signature of the Receiver</b></td> -->
		</tr>
		
		<tr>
			<td height="30px;"><?php echo $d['transNumber']; ?></td>
			<td height="30px;"><?php echo date('d-m-Y', strtotime($d['transDate'])); ?></td>
			<td height="30px;"><?php echo $d['transBank']; ?></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td colspan="4" align="center"><b>This is computer generated receipt, no signature required</b></td>
		</tr>
	</table>

</body>
</html>