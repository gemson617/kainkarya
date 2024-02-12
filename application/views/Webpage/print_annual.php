<?php foreach ($reports as $d) {

  /* $firstName = $d->firstName;
  $lastName = $d->lastName;
  $address = $d->address;
  $mobileNo = $d->mobileNo;
  $panNumber = $d->panNumber; */
}
foreach ($user_details as $u) {
  $firstName = $u->firstName;
  $lastName = $u->lastName;
  $address = $u->address;
  $mobileNo = $u->mobile;
  $panNumber = $u->pan;
}
foreach ($setting as $key => $set) {
}


?>
<!DOCTYPE html>
<html>

<head>
  <title>Kainkarya - Annual Reports</title>
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
  </style>
</head>

<body onload="window.print()">

  <table cellpadding="5" cellspacing="0" border="1" rules="all" width="100%" style="font-size: 14px;border:1px solid #000080!important;">
    <tr>
      <td align="center"><img src="<?php echo base_url('admin/public/adn-assets/img/pan/') . $set->trust_logo; ?>" style="width: 150px;" height=""></td>
      <td colspan="3" align="center">

        <h1 style="margin-bottom: 10px;" class="text-color"> <?php echo $set->trust_name; ?></h1>
        <h4 style="margin-top: 10px;line-height: 18px;" class="text-color">
          <address><?php echo $set->address; ?></address>

        </h4>
        <h3 style="margin-top: 0px;" class="text-color">PAN: <?php echo $set->trust_pan; ?><br>URN: <?php echo $set->trust_urn; ?></h3>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <h3 align="center" style="margin: 10px;">DONATION RECEIVED STATEMENT FOR THE YEAR &nbsp;<?php echo $fin_year; ?> </h3>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="font-size:15px;">
        <b>Sri/Smt.</b><span class="user_data"> <?php echo $firstName . ' ' . $lastName; ?><br /><br /></span>
        <b>Address</b><br /><span class="user_data">
          <?php
          echo $address;
          ?><br /></span><br />
        <b>PAN:</b><span class="user_data"><?php echo $panNumber; ?><br /></ </td> </tr> </table> <table cellpadding="5" cellspacing="0" border="" rules="all" width="100%" style="font-size: 14px;border:1px solid #000080!important;">

    <tr>
      <th colspan="1">S.No</th>
      <th>Receipt No</th>
      <th>Date</th>
      <th>Mode Of Receipt</th>
      <th>Donation Type</th>
      <th>Amount</th>
    </tr>

    <?php $total = 0;
    $i = 1;
    foreach ($reports as  $row) {
      $total += $row->amount;
    ?>
      <tr>
        <td colspan="1" align="center"><?php echo $i++; ?></td>
        <td align="center" class="user_data"><?php echo $row->receipt_number; ?></td>
        <td align="center" class="user_data"><?php echo date('d-m-Y', strtotime($row->receipt_date)); ?></td>
        <td align="center" class="user_data"><?php if ($row->paymentMode == 1) {
                                                echo "Cash";
                                              } elseif ($row->paymentMode == 2) {
                                                echo "Online";
                                              } elseif ($row->paymentMode == 3) {
                                                echo "Cheque";
                                              } elseif ($row->paymentMode == 4) {
                                                echo "NEFT";
                                              } ?></td>
        <td align="center" class="user_data"><?php if ($row->corpusFund == 1) {
                                                echo "Monthly";
                                              } elseif ($row->corpusFund == 2) {
                                                echo "Corpus";
                                              } elseif ($row->corpusFund == 3) {
                                                echo "One Time";
                                              } ?></td>
        <td align="center" class="user_data"><?php echo $row->amount; ?></td>
      </tr>
    <?php } ?>
    <tr>
      <td colspan="5" align="right">Total Amount Received for the financial year&nbsp;<strong><span class="user_data"><?php echo $fin_year; ?></span></strong>&nbsp;is Rs.&nbsp;</td>
      <td align="center" class="user_data"><strong><?php echo number_format((float) $total, 2, '.', ''); ?></strong></td>
    </tr>
    <tr>
      <td colspan="6" align="left">Amount in Words: Rs.<span style="text-transform: uppercase;">
          <span class="user_data"> <?php $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
                                    echo $f->format($total);
                                    ?></span> only</span></td>

    </tr>
    <tr>

      <td colspan="6" align="center">
        <?php if($fin_year=='2021-2022'){ ?>

          <b style="color: #990000!important;">DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
          </b> <?php }elseif($fin_year=='2022-2023'){ ?>
            <b style="color: #990000!important;">DONATIONS TO THIS TRUST ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
          </b> <?php }else{ ?>
<b style="color: #990000!important;">DONATIONS FROM 29TH NOVEMBER 2021 ARE EXEMPTED u/s 80G OF THE INCOME TAX ACT
          </b>
          <?php } ?>
      </td>
    </tr>
    <tr>
      <td colspan="6" align="center"><b style="color:#990000!important;">*This document is electronically generated. No Signature required.<br>
          In case of any queries write to kainkaryatrust@gmail.com*</b></td>
    </tr>
  </table>


</body>

</html>