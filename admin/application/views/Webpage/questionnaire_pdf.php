<style>
    #pageloader {
        background: rgba(255, 255, 255, 0.8);
        display: none;
        height: 100%;
        position: fixed;
        width: 100%;
        z-index: 9999;
    }

    #pageloader img {
        left: 50%;
        margin-left: -32px;
        margin-top: -32px;
        position: absolute;
        top: 50%;
    }
</style>
<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <?php $id = $this->uri->segment(3);
            $question = $this->mcommon->specific_row_value('polling_questions', array('id' => $id), 'question');
            $answer = $this->mcommon->specific_fields_records_all('polling_answer', array('question_id' => $id), 'answer');
            // sort($answer);
            ?>
<?php  $cur_year=$this->mcommon->specific_row_value('financial_year',array('status'=>1),'year'); ?>
            <div class="row">
                <div class="col-md-12">
                    <button type="button" class="btn btn-info" id="print">Print</button>&nbsp;&nbsp;
                    <a href="<?php echo base_url('questionnaire/show/'.$cur_year) ?>" class="btn btn-primary">Back</a>
                    <!-- INPUT GROUPS -->
                    <div class="panel" id="DivIdToPrint">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center" style="font-size: 16px;">Kainkarya Charitable Trust<br>
                                Questionaire
                            </h3>
                            &nbsp;
                            <p class="panel-title" style="font-size: 16px;">Link: <?php echo "https://kainkarya.com/home/questionnaire/" .$cur_year."/".$this->uri->segment(3)."/".$this->uri->segment(4); ?>
                            <p>
                            <p class="panel-title" style="font-size: 16px;">Question: <b class="panel-title" style="font-size: 16px;"><?php echo $question; ?></b></p>
                            <p class="panel-title" style="font-size: 16px;">
                                <?php
                                $t = 1;
                                foreach ($answer as $row) { ?>
                                    <?php echo "Answer " . $t++ . ': ' . $row['answer'] . "<br>"; ?>
                                <?php } ?></p>

                        </div>

                        <div class="panel-body">
                            <table border="1" id="dmstable1" class="table table-bordered" style="font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>User Type</th>
                                        <th>Answer</th>
                                        <th>Comment</th>
                                    </tr>

                                </thead>
                                <tbody>
                                    <?php

                                   
                                    $i = 1;
                                    foreach ($data as $key => $row) {

                                        foreach ($row as $ky => $r) {
                                            // echo $return[$key][$ky]->user_type."<br>";
                                            $name = $data[$key][$ky]->name;
                                            $mobile = $data[$key][$ky]->mobile;
                                            $answer = $data[$key][$ky]->answer;
                                            $type_name = $data[$key][$ky]->user_type;
                                            $reason = $data[$key][$ky]->reason;
                                            // echo "count ".count($return[$key]);
                                            $type = $this->mcommon->specific_row_value('user_type', array('type_id' => $data[$key][$ky]->user_type), 'type_name');
                                    ?>

                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $mobile; ?></td>
                                               <!-- <td><?php echo $type; ?></td>  -->
                                             <td><?php echo $type_name; ?></td> 
                                                <td><?php echo $answer; ?></td>
                                                <td><?php echo $reason; ?></td>
                                            </tr>

                                    <?php }
                                    } ?>
                                    <tr>
                                        <td colspan="5" style="height: 36px;"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <?php
                                    $answer_new = $this->mcommon->records_all('polling_answer', array('question_id' => $id));
                                    // $answer_new = $this->mcommon->specific_fields_records_all('polling_answer', array('question_id' => $id),'a_id');
                                    $i = 1;
                                    $k = 0;
                                    foreach ($answer_new as $an) {

                                        print_r($key1);
                                        $getanswer_id = $this->mcommon->specific_fields_records_all('poll_result', array('question_id' => $id, 'answer_id' => $an->a_id), 'id');
                                        $count_of_answer = count($getanswer_id);
                                        //  foreach ($data as $key1 => $r) {

                                    ?>
                                        <tr style="font-size: 16px;">
                                            <td border="0"></td>
                                            <td colspan="" align="left"><b> <?php echo $an->answer; ?></b></td>

                                            <td></td>
                                            <td></td>
                                            <td align="center"><b><?php echo $count_of_answer;
                                                    $k = $k + $count_of_answer;
                                                    ?></b></td>
                                        </tr>


                                    <?php //}
                                    }

                                    ?>
                                    <tr style="font-size: 16px;">

                                        <td></td>
                                        <td colspan="" align="left"><b>Total</b></td>
                                        <td></td>
                                        <td></td>
                                        <td align="center"><b><?php echo $k; ?></b></td>
                                    </tr>
                                </tfoot>
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
<div id="pageloader">
    <img src="http://cdnjs.cloudflare.com/ajax/libs/semantic-ui/0.16.1/images/loader-large.gif" alt="processing..." />
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('#excel').on('click', function() {

        $("#dmstable").table2excel({
            filename: "Questionnaire Lists.xlsx"
        });
        //let table = document.getElementsByTagName("table");
        // let table=$('#dmstable').find('table');
        //      TableToExcel.convert(table[1], { // html code may contain multiple tables so here we are refering to 1st table tag
        //         name: `Questionnaire Lists.xlsx`, // fileName you could use any name
        //         sheet: {
        //            name: 'Sheet 1' // sheetName
        //          }
        //        });
    });

    function copyToClipboard(id) {
        var copyText = document.getElementById("cp" + id).innerHTML;
        navigator.clipboard
            .writeText(copyText)
            .then(() => alert("Copied"))
            .catch((err) => console.error(`Error copying to clipboard: ${err}`));
    }
</script>


<script>
    $(document).ready(function() {
        $(".select2").select2();
        $("#myform").on("submit", function() {
            $("#pageloader").fadeIn();
        }); //submit
    });
</script>
<script type="text/javascript">
    $('.multi-field-wrapper').each(function() {
        var $wrapper = $('.multi-fields', this);
        $(".add-field", $(this)).click(function(e) {
            var lengths = $('.multi-field').length + 1;
            if (lengths >= 10) {
                Swal.fire({
                    icon: 'error',
                    // title: 'Oops...',
                    text: 'Only Nine Answers Allowed!',

                })
            } else {
                $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper).find('input').val('').focus();
            }
        });
        $('.multi-field .remove-field', $wrapper).click(function() {
            if ($('.multi-field', $wrapper).length > 1)
                $(this).parent('.multi-field').remove();
        });
    });

    $(function() {
        $("#select1").select2();
    });

    $('#export-excel').on("click", function() {

        $.ajax({
            url: "<?php echo site_url() ?>home/export_excel",
            method: "POST",
            type: "ajax",
            data: {
                "excel": 1
            },
            success: function(result) {
                console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });

    })


    // In your Javascript (external .js resource or <script> tag)
    /* $(document).ready(function() {
      $('#select1').select2();
    });*/
</script>
<script>
    function get_users(user_id) {

        $.ajax({
            url: "<?php echo site_url() ?>home/get_userdata",
            method: "POST",
            type: "ajax",
            data: {
                user_id: user_id
            },
            success: function(result) {
                var data = JSON.parse(result);

                $('#firstName').val(data[0].firstName);
                $('#lastName').val(data[0].lastName);
                $('#email').val(data[0].email);
                $('#mobileNo').val(data[0].mobile);
                $('#address').val(data[0].address);
                $('#panNumber').val(data[0].pan);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function get_type(value) {

        if (value == 2) {
            $('#users_name').show();
        } else {
            $('#users_name').hide();
        }
    }

    $('#print').on("click", function() {
        var divToPrint = document.getElementById('DivIdToPrint');

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><style>h3{text-align:center}</style><title>Questionnaire<?php echo $this->uri->segment(3); ?></title><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');

        newWin.document.close();
    })

    // $(document).ready(function() {
    // $('#dmstable').DataTable( {
    //  dom: 'Bfrtip',
    // buttons: [

    //     {
    //             extend: 'print',
    //             orientation: 'landscape',
    //             pageSize: 'LEGAL',
    //             footer: true,
    //             title:'Questionnaire Report',
    //             customize: function (win) {
    //            var htmldata="<h3>Charitable Trust<br>Questionnaire Report</h3>";
    //        // $(win.document.body).find( 'h1' ).append(win.document.innerHTML=htmldata);
    //           $(win.document.body).find('h3').css('font-size', '15px');
    //           $(win.document.body).find('h3').css('text-align','center');

    //     }
    // }
    //         //]
    //     } );
    // } );
</script>