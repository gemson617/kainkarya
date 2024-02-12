<?php
include "header1.php";
?>
<style>
    h1 {
        text-align: center;
        font-size: 60px;
        text-shadow: #c9d6de 1px 3px;
    }

    .question {
        font-size: 16px;
        font-weight: bold;
    }
    .answers {
        padding-top: 15px;
    }

    label {
       /* border: 1px solid #e3e36a;
        padding: 10px;
        margin: 0 0 10px;*/
        display: block;
        font-size: 14px;
        font-weight: 100;
    }

    label:hover {
        background: #e3dede;
        cursor: pointer;
    }

    ul {
        list-style: none;
    }

    nav li {
        display: inline;
        margin: 10px;
        /* border-style:solid;
  border-width:thin; */
        position: relative;

    }

    nav {
        text-align: center;
        /* border-style: solid;
  border-width: thin; */
    }

    nav ul {
        padding: inherit;
        list-style: none;
    }
    .question-btn {
    padding: 5px 18px !important;
    margin-top: 35px;
    width: 100px;
   color:#fff;
    background: #000080!important;
}
</style>
<br><br><br><br><br><br><br><br>
<section class="banner-area organic-breadcrumb" style="">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center">
            <div class="col-first col-lg-12">
                <h2 align="center">Questionnaire</h2>
                
            </div>
        </div>
    </div>
</section>
<!-- Start My Account -->


<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12"><br><br><br>
                <!--Start-->
                <form action="<?php echo site_url('Home/submit_poll'); ?>" method="post">
                    <div class="col-md-12">
                        <?php
                        foreach ($polling as $key => $p) {
                        ?>
                            <div class="question"><?php echo $p['question']; ?>
                                
                                <ul class="answers">
                                    <?php foreach ($p['answer'] as $ans) { ?>
                                        <li><label>
                                            <input name="answer" type="radio" value="<?php echo $ans->a_id;?>"> <?php echo $ans->answer; ?>
                                            <input type="hidden" name="question" value="<?php echo $p['id']; ?>">

                                        </label></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        <?php } ?>
                        <div class="form-group col-md-6">
                              <label>Reason About Answer</label>          
                              <textarea name="reason" class="form-control" placeholder="Please Enter Reason for Choose the Option"></textarea>
                        </div>
                        
                    </div>


                    <!-- <div class="results">Results</div> -->

                    <!-- <input class="previous" type="button" value="Previous"> -->
                    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
                    <!-- <input class="next" type="button" value="Next Question"> -->
                    <input class="question-btn" type="submit" value="Submit">
                    <!-- <input class="clear" type="button" value="Clear Selection">
                     <input class="results" type="button" value="Results"> -->
                </form>
                    <!-- <input type="button" name="btnResults" id="btnResults" value="Results" onclick="Results()"/> -->
        </div>
    </div>
</div>
        <br><br><br>
         
<!-- End My Account -->

<?php
include "footer.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="trivia.js"></script>

<script>



    $(document).ready(function() {

    });

    //Total number of questions
    var totalNumQuestions = $('.question').size();


    //Display current question, sets it at first question
    var currentQuestion = 0;

    //jQuery variable
    $question = $('.question');

    //Hide all of the questions
    $question.hide();
    // $(".submit").hide();
    //jQuery variable
    $button = $('.next');

    //Show the first question
    $($question.get(currentQuestion)).fadeIn();

    //Click listener to get next question...
    $('.next').click(function() {

        //Current question disappears...
        $($question.get(currentQuestion)).fadeOut(function() {

            //Questions go up one by one
            currentQuestion = currentQuestion + 1;
            if (currentQuestion == totalNumQuestions) {
                $(".next").hide();
                $(".submit").show();
            }
            //Next question...
            $($question.get(currentQuestion)).fadeIn();
        });

    });

    //...Scoring...want this in jQuery, eventually...

    var score = 0;

    function Results() {
        if (document.getElementById("correct").checked === true) score++;
        else(alert("Incorrect!"));

    }
</script>