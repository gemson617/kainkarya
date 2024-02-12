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
    .angry-grid > div {
    padding: 15px;
}
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

.angry-grid {
    display: grid;

    /* grid-template-rows: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr; */
    grid-template-columns: 1fr 1fr 1fr 1fr 1fr;

    gap: 0px;
    height: 100%;

}

#item-0 {

    border:1px solid #000;
    grid-row-start: 1;
    grid-column-start: 1;

    grid-row-end: 2;
    grid-column-end: 2;

}

#item-1 {

    border:1px solid #000;
    grid-row-start: 1;
    grid-column-start: 2;
    text-align: center;
    grid-row-end: 2;
    grid-column-end: 6;

}

#item-2 {

    border:1px solid #000;
    grid-row-start: 2;
    grid-column-start: 1;
    height: 30px;
    grid-row-end: 3;
    grid-column-end: 6;

}

#item-3 {

    border:1px solid #000;
    grid-row-start: 3;
    grid-column-start: 1;
    height: 30px;
    grid-row-end: 4;
    grid-column-end: 2;

}

#item-4 {
    text-align: right;
    border:1px solid #000;
    grid-row-start: 3;
    grid-column-start: 2;
    height: 30px;
    grid-row-end: 4;
    grid-column-end: 6;

}

#item-5 {

    border:1px solid #000;
    grid-row-start: 4;
    grid-column-start: 1;
    height: 80px;
    grid-row-end: 5;
    grid-column-end: 6;

}

#item-6 {

    border:1px solid #000;
    grid-row-start: 5;
    grid-column-start: 1;
    height: 30px;
    grid-row-end: 6;
    grid-column-end: 2;

}

#item-7 {

    border:1px solid #000;
    grid-row-start: 5;
    grid-column-start: 2;
    height: 30px;
    grid-row-end: 6;
    grid-column-end: 6;

}

#item-8 {

    border:1px solid #000;
    grid-row-start: 6;
    grid-column-start: 1;
    grid-row-end: 7;
    grid-column-end: 6;
    padding: 25px;
    height: 20px;

}

#item-9 {

    border:1px solid #000;
    grid-row-start: 7;
    grid-column-start: 1;
    grid-row-end: 8;
    grid-column-end: 6;
    padding: 25px;
    height: 20px;

}

#item-10 {

    border:1px solid #000;
    grid-row-start: 8;
    grid-column-start: 1;
    grid-row-end: 9;
    grid-column-end: 6;
    padding: 25px;
    height: 20px;

}

#item-11 {

    border:1px solid #000;
    grid-row-start: 9;
    grid-column-start: 1;
    grid-row-end: 10;
    grid-column-end: 6;
    text-align: center;
    height: 45px;

}

#item-12 {
    border:1px solid #000;
    grid-row-start: 10;
    grid-column-start: 1;
    grid-row-end: 11;
    grid-column-end: 6;
    text-align: center;
    height: 50px;

}
</style>

<body>
   


    <div class="angry-grid">
        <div id="item-0"><img src="<?php echo base_url('public/adn-assets/img/pan/').$trust_logo; ?>"
                style="width: 120px;" height=""></div>
        <div id="item-1">
            <h2 style="margin-bottom: 10px;" class="text-color"><?php echo $trust_name; ?></h2>
            <h4 style="margin-top: 10px;line-height: 18px;">
                <address class="text-color">Flat F1, SREYAS, Plot 76, Second Street, Balaji Nagar,
                    Alwarthiru Nagar, Chennai –600087. Tamil Nadu, India</address>
            </h4>
            <h3 style="margin-top: 0px;" class="text-color">PAN: <?php echo $trust_pan; ?><br>URN:
                <?php echo $trust_urn; ?></h3><br />

        </div>
        <div id="item-2">
            <h3 align="center" style="text-decoration: underline;margin: 10px;text-align:center;">RECEIPT</h3>
        </div>
        <div id="item-3"><b>Receipt No:</b><span class="user_data"> <?php echo $d['receipt_number']; ?></span></div>
        <div id="item-4">Date: <span
                class="user_data"><?php echo date('d-m-Y', strtotime($d['receipt_date'])); ?></span></div>
        <div id="item-5"><b>Received with thanks from Sri/Smt.</b><span class="user_data">
                <?= strtoupper($d['firstName']) . ' ' . strtoupper($d['lastName']); ?></span><br /><br />
            <b>Address</b><br /><span class="user_data">
                <?php if (!empty($d['address'])) {
						echo $d['address'];
					} else {
						echo $d['address1'];
					} ?>
            </span>
        </div>
        <div id="item-6">
            <h2 style="margin: 5px;"><span class="user_data">Rs. <?php echo $d['amount']; ?></span></h2>
        </div>
        <div id="item-7">
            <b> <span class="user_data">Rupees
                    <?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
						echo $f->format($d['amount']);
						?> only</span>
            </b>
        </div>
        <div id="item-8"><b>Income Tax PAN :</b><span class="user_data">
                <?php if (!empty($d['pan'])) {
		echo $d['pan'];
		} else {
	echo $d['pan1'];
	} ?></div>
        <div id="item-9"><b>Remarks : </b><span class="user_data"> <?php echo $d['remarks']; ?></span></div>
        <div id="item-10"><b>Method of Payment :</b> <span class="user_data">
                <?php if ($d['paymentMode'] == 1) {
						echo "Cash";
					} else if ($d['paymentMode'] == 2) {
						echo "Online";
					} elseif ($d['paymentMode'] == 3) {
						echo "Cheque";
					} elseif ($d['paymentMode'] == 4) {
						echo "NEFT";
					} ?></span><br>
            <?php if ($d['paymentMode'] == 3) { 
                        echo "<b>Cheque No</b>&nbsp;&nbsp;&nbsp;&nbsp;".$d['transNumber'];
                        echo "<b>Cheque Date&nbsp;&nbsp;&nbsp;&nbsp;</b>".date('d-m-Y', strtotime($d['transDate']));
                        echo "<b>Bank Name & Branch&nbsp;&nbsp;&nbsp;&nbsp;</b>".$d['transBank'];

                    } ?>
        </div>
        <div id="item-11"><?php if($d['financial_year']=='2021-2022'){ ?>

            <b style="color: #990000!important;">DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME
                TAX ACT
            </b> <?php }elseif($d['financial_year']=='2022-2023'){ ?>
            <b style="color: #990000!important;">DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
            </b><?php }else{  ?>
            <b style="color: #990000!important;">DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
                TAX ACT
            </b>
            <?php }  ?>
        </div>
        <div id="item-12"><b style="color: #990000!important;">*This document is electronically generated. No Signature
                required.<br>
                In case of any queries write to kainkaryatrust@gmail.com*</b></div>
    </div>

</body>

</html>