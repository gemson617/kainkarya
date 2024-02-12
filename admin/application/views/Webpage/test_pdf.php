<!DOCTYPE html>
<html>
<head>
	<title>Kainkarya - Receipt</title>
</head>
<?php
foreach ($setting as $set) {
	$trust_logo = $set->trust_logo;
	$trust_name = $set->trust_name;
	$trust_pan = $set->trust_pan;
	$trust_urn = $set->trust_urn;
}
foreach ($receipt_data as $d) {
	$receipt_date = $d['receipt_date'];
}
?>
<style type="text/css">
	td {
		font-family: Arial, Helvetica, sans-serif;
		font-size: 14px;
		font-weight: 400;
	}
	.text-color {
		color: #031c99;
	}
	.user_data {
		color: #031c99;
		font-weight: bold;
	}
	table{
	    border:collapse;
	}
</style>
<body>
	<table border="1" cellspacing="0" cellpadding="10" bordercolor="#000">
		<tr>
			<td align="center"><img src="<?php echo base_url('public/adn-assets/img/pan/') . $trust_logo; ?>" style="width: 120px;" height=""></td>
			<td colspan="3" align="center">
				<h2 style="margin-bottom: 10px;" class="text-color"><?php echo $trust_name; ?></h2>
				<h4 style="margin-top: 10px;line-height: 18px;">
					<address class="text-color">Flat F1, SREYAS, Plot 76, Second Street, Balaji Nagar,
						Alwarthiru Nagar, Chennai –600087. Tamil Nadu, India</address>
				</h4><br />
				<h3 style="margin-top: 0px;" class="text-color">PAN: <?php echo $trust_pan; ?><br>URN: <?php echo $trust_urn; ?></h3><br />
				<!--   <?php// $check_date = '2021-11-28';
					//	if ($receipt_date > $check_date) { ?>
				<h5><b style="color: #990000!important;">ALL DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF INCOME TAX ACT 1961. URN AAETK3106DF20217 Dt. 29 November 2021.</b></h5>
				 <?php// } ?> -->
			</td>
		</tr>
		<tr>
			<td colspan="4" align="center">
				<h3 align="center" style="text-decoration: underline;margin: 10px;text-align:center;">RECEIPT</h3>
			</td>
		</tr>
		<tr>
			<th colspan="2" align="left">Receipt No:<span class="user_data"> <?= $d['receipt_number']; ?></span></th>
			<th colspan="2" align="right">Date: <span class="user_data">
					<?= date('d-m-Y', strtotime($d['receipt_date'])); ?></span></th>
		</tr>
		<tr>
			<td colspan="4" style="font-size:15px;border:1px solid #000;">
				<b>Received with thanks from Sri/Smt.</b><span class="user_data"> <?= ($d['firstName']==null || $d['firstName']=='') ? $d['Fullname']:strtoupper($d['firstName']. ' ' .$d['lastName']); ?></span><br /><br />
				<b>Address</b><br /><span class="user_data">
					<?php if (!empty($d['address'])) {
						echo $d['address'];
					} else {
						echo $d['address1'];
					} ?>
				</span>
			</td><br />
		</tr>
		<tr>
			<td>
				<h2 style="margin: 5px;"><span class="user_data">Rs. <?= $d['amount']; ?></span></h2>
			</td>
			<td colspan="3" style="text-transform: uppercase;">
				<b> <span class="user_data">Rupees
						<?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
						echo $f->format($d['amount']);
						?> only</span>
				</b>
			</td>
		</tr>
		<tr>
			<td colspan="4"><b>Income Tax PAN :</b><span class="user_data">
			    <?php if (!empty($d['pan'])) {
                       	echo $d['pan'];
					} else {
					echo $d['pan1'];
					} ?>
					</td>
			</span>
		</tr>
		<tr>
			<td colspan="4">
			<b>Remarks : </b><span class="user_data"> <?php echo $d['remarks'];
																		?></span>
			</td>
		</tr>
		<tr>
			<td colspan="4"><b>Method of Payment :</b> <span class="user_data">
					<?php if ($d['paymentMode'] == 1) {
						echo "Cash";
					} else if ($d['paymentMode'] == 2) {
						echo "Online";
					} elseif ($d['paymentMode'] == 3) {
						echo "Cheque";
					} elseif ($d['paymentMode'] == 4) {
						echo "NEFT";
					} ?></span>
					</td>
					<br /><br />
		</tr>
		<?php
		if ($d['paymentMode'] == 3) {
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
		?> <tr>
			<td colspan="4" align="center"><?php $check_date = '2021-11-28';
											//if ($d['receipt_date'] > $check_date) { ?>
					<!-- <b style="color: #990000!important;">ALL DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF INCOME TAX ACT 1961.<br> URN AAETK3106DF20217 Dt. 29 November 2021.</b> -->
					<!-- <b style="color: #990000!important;">DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
					</b> -->
					<?php if($d['financial_year']=='2021-2022'){ ?>

					<b style="color: #990000!important;">DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
					</b> <?php }elseif($d['financial_year']=='2022-2023'){ ?>
						<b style="color: #990000!important;">DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
					</b><?php }else{  ?>
						<b style="color: #990000!important;">DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
					</b>
				<?php } //} ?></td>
		</tr>
		<tr>
			<td colspan="4" align="center"><b style="color: #990000!important;">*This document is electronically generated. No Signature required.<br>
					In case of any queries write to kainkaryatrust@gmail.com*</b></td>
		</tr>
	</table>
</body>
</html>