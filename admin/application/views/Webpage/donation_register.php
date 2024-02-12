
<div class="main">
  <!-- MAIN CONTENT -->
  <div class="main-content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <!-- INPUT GROUPS -->
          <div class="panel">
            <div class="panel-heading">
              <h3 class="panel-title"> Donation Register</h3>
            </div>
            <div class="panel-body">
              <form action="<?php echo base_url('home/search_donation') ?>" method="post">
                <div class="form-group row">
                  <div class="col-md-3">
                    <label for="firstName">Financial Year</label>
                    <select name="year" id="year" class="form-control">
                    <?php $trust_year= $yr=$this->mcommon->specific_row_value('company_setting','','current_financial_year'); ?>
                     <!-- <option value="">---select---</option> -->
                     <?php foreach ($year as $key => $y) {
                      if(isset($sel_year)){
                        ?>
                      <option value="<?php echo $y['year']; ?>"  <?php echo ($y['year']==$sel_year) ? 'selected':''; ?>><?php echo $y['year']; ?></option>
                    <?php }else{ ?> 
                        <option value="<?php echo $y['year']; ?>"  <?php echo ($y['year']==$trust_year) ? 'selected':''; ?>><?php echo $y['year']; ?></option>
                        <?php } } ?>
                    
                  </select>
                </div>

              </div>
              <br>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
        <!-- END INPUT GROUPS -->
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <!-- INPUT GROUPS -->
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title"></h3>
          </div>
          <?php //echo "<pre>";print_r($records); ?>
          <button  type="submit" name="submit" class="btn btn-primary" id="excel">Export to Excel</button>
          <div class="panel-body">
            <table id="dmstable"  class="table table-bordered">
             <thead>
              <tr>
               <th>S.No</th>
               <th>Name</th>
               <th>User Id</th>
               <th>Type</th>
               <th style="text-align:right;" >Apr</th>
               <th style="text-align:right;">May</th>
               <th style="text-align:right;">Jun</th>
               <th style="text-align:right;">Jul</th>
               <th style="text-align:right;">Aug</th>
               <th style="text-align:right;">Sep</th>
               <th style="text-align:right;">Oct</th>
               <th style="text-align:right;">Nov</th>
               <th style="text-align:right;">Dec</th>
               <th style="text-align:right;">Jan</th>
               <th style="text-align:right;">Feb</th>
               <th style="text-align:right;">Mar</th>
               <th style="text-align:right;">Total</th> 
             </tr>
           </thead>
           <tbody>

            <?php $i=1; foreach($records as $key=> $datas){ 
             $m1tot='';$m2tot='';$m3tot='';$m4tot='';
             $m5tot='';$m6tot='';$m7tot='';$m8tot='';
             $m9tot='';$m10tot='';$m11tot='';$m12tot='';
             $typ=array('',"General","Corpus","oneTime");
             ?>
             <tr>
              <td style="text-align:right;"><?php echo $i++; ?></td>
              <td><?php echo strtoupper($key); ?></td>
              <td><?php echo $datas[0]['user_id']; ?></td>
              <td><?php echo  $typ[$datas[0]['corpusFund']]; ?></td>

              <td style="text-align:right;"><?php 
              foreach ($datas as $r) {
                if ($r['month'] == 4) {
                 $m4tot+=$r['amount'];
               } } echo $m4tot; ?></td>
               <td style="text-align:right;"><?php
               foreach ($datas as $r) {
                 if ($r['month'] == 5) {
                   $m5tot+=$r['amount'];
                 } } echo $m5tot;?></td>
                 <td style="text-align:right;"><?php
                 foreach ($datas as $r) {
                   if ($r['month']==6) {
                     $m6tot+= $r['amount'];
                   } } echo $m6tot; ?></td>
                   <td style="text-align:right;"><?php
                   foreach ($datas as $r) {
                     if ($r['month']==7) {
                       $m7tot+=$r['amount'];
                     } } echo $m7tot; ?></td>
                     <td style="text-align:right;"><?php foreach ($datas as $r) {
                      if ($r['month']==8) {
                       $m8tot+= $r['amount'];
                     } } echo $m8tot; ?></td>
                     <td style="text-align:right;"><?php foreach ($datas as $r) {
                      if ($r['month']==9) {
                       $m9tot+=$r['amount'];
                     } } echo $m9tot; ?></td>
                     <td style="text-align:right;"><?php foreach ($datas as $r) {
                      if ($r['month']==10) {
                       $m10tot+=$r['amount'];
                     } } echo $m10tot; ?></td>
                     <td style="text-align:right;"><?php foreach ($datas as $r) {
                       if ($r['month']==11) {
                         $m11tot+= $r['amount'];
                       } } echo $m11tot; ?></td>
                       <td style="text-align:right;"><?php foreach ($datas as $r) {
                         if ($r['month']==12) {
                           $m12tot+=$r['amount'];
                         } } echo $m12tot; ?></td>
                         <td style="text-align:right;"><?php foreach ($datas as $r) {
                          if ($r['month']==1) {
                            $m1tot+=$r['amount'];
                          } }
                          echo $m1tot;
                          ?></td>
                          <td style="text-align:right;"><?php foreach ($datas as $r) {
                            if ($r['month']==2) {
                             $m2tot+=$r['amount'];
                           } } echo $m2tot; ?></td>
                           <td style="text-align:right;"><?php foreach ($datas as $r) {
                            if ($r['month']==3) {
                             $m3tot+=$r['amount'];
                           } } echo $m3tot; ?></td> 
                           <td style="text-align:right;"><?php $total='';
                           foreach ($datas as $r) {
                            $total+=$r['amount'];
                          } echo $total; ?></td>  

                        </tr>
                      <?php   } ?>
                    </tbody>
                  </table>

                </div>
              </div>
              <!-- END INPUT GROUPS -->
            </div>
          </div>

        </div>
      </div>
      <!-- END MAIN CONTENT -->
    </div>

    <table class="table table-bordered" style="display: none;">
     <thead>
      <tr>
       <th align="right">S.No</th>
       <th >Name</th>
       <th>User Id</th>
       <th>Apr</th>
       <th>May</th>
       <th>Jun</th>
       <th>Jul</th>
       <th>Aug</th>
       <th>Sep</th>
       <th>Oct</th>
       <th>Nov</th>
       <th>Dec</th>
       <th>Jan</th>
       <th>Feb</th>
       <th>Mar</th>
       <th align="right">Total</th> 
     </tr>
   </thead>
   <tbody>

    <?php $i=1; foreach($records as $key=> $datas){ 
     $m1tot='';$m2tot='';$m3tot='';$m4tot='';
     $m5tot='';$m6tot='';$m7tot='';$m8tot='';
     $m9tot='';$m10tot='';$m11tot='';$m12tot='';

     ?>
     <tr>
      <td><?php echo $i++; ?></td>
      <td><?php echo strtoupper($key); ?></td>
      <td><?php echo $datas[0]['user_id']; ?></td>
      <td align="right"><?php 
      foreach ($datas as $r) {
        if ($r['month'] == 4) {
         $m4tot+=$r['amount'];
       } } echo $m4tot; ?></td>
       <td align="right"><?php
       foreach ($datas as $r) {
         if ($r['month'] == 5) {
           $m5tot+=$r['amount'];
         } } echo $m5tot;?></td>
         <td align="right"><?php
         foreach ($datas as $r) {
           if ($r['month']==6) {
             $m6tot+= $r['amount'];
           } } echo $m6tot; ?></td>
           <td align="right"><?php
           foreach ($datas as $r) {
             if ($r['month']==7) {
               $m7tot+=$r['amount'];
             } } echo $m7tot; ?></td>
             <td align="right"><?php foreach ($datas as $r) {
              if ($r['month']==8) {
               $m8tot+= $r['amount'];
             } } echo $m8tot; ?></td>
             <td align="right"><?php foreach ($datas as $r) {
              if ($r['month']==9) {
               $m9tot+=$r['amount'];
             } } echo $m9tot; ?></td>
             <td align="right"><?php foreach ($datas as $r) {
              if ($r['month']==10) {
               $m10tot+=$r['amount'];
             } } echo $m10tot; ?></td>
             <td align="right"><?php foreach ($datas as $r) {
               if ($r['month']==11) {
                 $m11tot+= $r['amount'];
               } } echo $m11tot; ?></td>
               <td align="right"><?php foreach ($datas as $r) {
                 if ($r['month']==12) {
                   $m12tot+=$r['amount'];
                 } } echo $m12tot; ?></td>
                 <td align="right"><?php foreach ($datas as $r) {
                  if ($r['month']==1) {
                    $m1tot+=$r['amount'];
                  } }
                  echo $m1tot;
                  ?></td>
                  <td align="right"><?php foreach ($datas as $r) {
                    if ($r['month']==2) {
                     $m2tot+=$r['amount'];
                   } } echo $m2tot; ?></td>
                   <td align="right"><?php foreach ($datas as $r) {
                    if ($r['month']==3) {
                     $m3tot+=$r['amount'];
                   } } echo $m3tot; ?></td> 
                   <td align="right"><?php $total='';
                   foreach ($datas as $r) {
                    $total+=$r['amount'];
                  } echo $total; ?></td>  

                </tr>
              <?php   } ?>
            </tbody>
          </table>
          <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
          <script>
            $('#excel').on('click', function(){
              var year=$('#year').val();
             let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
          name: "KCT_Donation Register_"+year+"_<?php echo date('d-m-Y'); ?>.xlsx", // fileName you could use any name
           sheet: {
              name: 'Sheet 1' // sheetName
            }
          });
      });
    </script>



