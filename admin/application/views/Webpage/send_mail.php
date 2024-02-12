<?php foreach ($receipt_data as $d) {
}
foreach ($setting as $key => $set) {
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Kainkarya - Receipt</title>
</head>

<body>

	<table>
		<tr>
			<td><img src="<?php echo base_url('public/adn-assets/img/pan/') . $set->trust_logo; ?>"></td>
			<td>

				<h1> <?php echo $set->trust_name; ?></h1>
				<h4>
					<address><?php echo $set->address; ?></address>
				</h4>
				<h3>PAN: <?php echo $set->trust_pan; ?></h3>
				<h3>URN: <?php echo $set->trust_urn; ?></h3>
				<!--  <?php $check_date = '2021-11-28';
						if ($d['receipt_date'] > $check_date) { ?>
				<h5 style="color: #ff5722!important;">ALL DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF INCOME TAX ACT 1961. URN AAETK3106DF20217 Dt. 29 November 2021.</h5>
				 <?php } ?>  -->
			</td>
		</tr>
		<tr>
			<td>
				<h3>RECEIPT</h3>
				<table>
					<tr>
						<th>Receipt No:<span class="user_data"> <?= $d['receipt_number']; ?></span></th>
						<th>Date: <span class="user_data">
								<?= date('d-m-Y', strtotime($d['receipt_date'])); ?></span></th>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<b>Received with thanks from Sri/Smt.</b><span> <?= strtoupper($d['firstName']) . ' ' . strtoupper($d['lastName']); ?></span><br /><br />
				<b>Address</b><br /><span>
					<?php if (!empty($d['address'])) {
						echo $d['address'];
					} else {
						echo $d['address1'];
					} ?><br />
				</span>
			</td>
		</tr>
		<tr>
			<td>
				<h2><span>Rs. <?= $d['amount']; ?></span></h2>
			</td>
			<td>
				<b> <span>Rupees
						<?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
						echo $f->format($d['amount']);
						?> only</span>
				</b>
			</td>
		</tr>
		<tr>
			<td><b>Income Tax PAN :</b><span> <?php if (!empty($d['pan'])) {
													echo $d['pan'];
												} else {
													echo $d['pan1'];
												} ?></td>
			</span>
		</tr>
		<tr>
			<td><b>Towards : </b><span class="user_data"> <?php echo $d['remarks'];
															?></span></td>
		</tr>
		<tr>
			<td><b>Method of Payment :</b> <span>
					<?php if ($d['paymentMode'] == 1) {
						echo "Cash";
					} else if ($d['paymentMode'] == 2) {
						echo "Online";
					} elseif ($d['paymentMode'] == 3) {
						echo "Cheque";
					} elseif ($d['paymentMode'] == 4) {
						echo "NEFT";
					} ?></span></td>
		</tr>
		<?php
		if ($d['paymentMode'] == 3) {
		?>
			<tr>
				<th><b>Cheque No</b></th>
				<th><b>Cheque Date</b></th>
				<th><b>Bank Name & Branch</b></th>
				<!-- <td rowspan="2" align="right"><br /><br /><br /><b>Signature of the Receiver</b></td> -->
			</tr>

			<tr>
				<td><?php echo $d['transNumber']; ?></td>
				<td><?php echo date('d-m-Y', strtotime($d['transDate'])); ?></td>
				<td><?php echo $d['transBank']; ?></td>
			</tr>
		<?php
		}
		?>
		<tr>
			<td colspan="4" align="center"><?php $check_date = '2021-11-28';
											if ($d['receipt_date'] > $check_date) { ?>
				<!-- 	<b style="color: #990000!important;">ALL DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF INCOME TAX ACT 1961.<br> URN AAETK3106DF20217 Dt. 29 November 2021.</b> -->
				<b style="color: #990000!important;">DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
					</b>
				<?php } ?></td>
		</tr>
		<tr>
			<td colspan="4" align="center"><b style="color: #990000!important;">*This document is electronically generated. No Signature required.<br>
					In case of any queries write to kainkaryatrust@gmail.com*</b></td>
		</tr>

	</table>

</body>

</html>