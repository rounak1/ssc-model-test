<?php
error_reporting(1);
require 'connection.php';
require 'admin-header.php';
$date = $question = $answer = $option1 = $option2 = $option3 = $option4 = "";

$msg = [];

if (isset($_POST['form_submit'])) {

    if (empty($_POST["exam_date"])) {
        array_push($msg, "পরীক্ষার তারিখ দিন");
    } else {
        $exam_date = $_POST["exam_date"];
    }

    if (empty($_POST["exam_id"])) {
        array_push($msg, "পরীক্ষার সাবজেক্ট নির্বাচন করুন");
    } else {
        $exam_id = $_POST["exam_id"];
    }

    if (empty($_POST["question"])) {
        array_push($msg, "প্রশ্নটি দিন");
    } else {
        $question = $_POST["question"];
    }

    if (empty($_POST["answer"])) {
        array_push($msg, "উত্তর সিলেক্ট করুন");
    } else {
        $answer = $_POST["answer"];
    }
    if (empty($_POST["option1"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option1 = $_POST["option1"];
    }
    if (empty($_POST["option2"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option2 = $_POST["option2"];
    }
    if (empty($_POST["option3"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option3 = $_POST["option3"];
    }

    if (empty($_POST["option4"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option4 = $_POST["option4"];
    }

    if ((count($msg) < 1)) {

        for ($j = 0; $j < count($_POST['question']); $j++) {

            if (!empty($question[$j])) {

                $query = "INSERT INTO `model_questions`(`exam_id`, `questions`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_date`) VALUES ('$exam_id', '$question[$j]', '$option1[$j]', '$option2[$j]', '$option3[$j]', '$option4[$j]', '$answer[$j]', '$exam_date')";

                $result = mysqli_query($conn, $query);
            }
        }

        if ($result) {
            echo "<script>toastr.success('প্রশ্নটি সফলভাবে ডাটাবেজে সেভ হয়েছে ');</script>";
        }
    }
}

?>



    <div class="container">
      <div class="quiz-container">
        <div class="login-container">
          <div class="title">Quiz entry form</div>



          <form id="form_submit" method="post" action="" name="form_submit">
            <div class="input-container">
              <label>Date</label>
              <input
                type="text"
                name="exam_date"
                value=""
                id="date"
                placeholder="YYYY-MM-DD"
                required="required"
              />
            </div>


            <div class="input-container">
              <select name="exam_id" id="subjects" class="input-container">
                <option value="">সাবজেক্ট  সিলেক্ট করুন</option>

                <?php

foreach ($model_test_list as $exam) {?>
    <option value="<?php echo $exam['id']; ?>"><?php echo ($exam['subject'] . ' -- ' . $exam['test']); ?></option>
<?php }

?>

              </select>
            </div>

            <?php
for ($i = 0; $i < 10; $i++) {

    ?>


            <div class="each-question-container">
              <div class="input-container">
                <label>Question <?php echo $i + 1; ?></label>
                <input
                  type="text"
                  name="question[]"
                  value=""
                  id="question"
                  placeholder="Question"

                />
              </div>

              <div class="input-container">
                <label class="label-answer">Answer</label>
                <label class="label-option">Option</label>
              </div>

              <div class="input-container">
                <input
                  type="radio"
                  name="answer[<?php echo $i; ?>]"
                  class="answer-radio"
                  value="option1"
                />
                <input
                  type="text"
                  name="option1[<?php echo $i; ?>]"
                  class="question-option"
                  value=""
                  id="option1"
                  placeholder="Option 1"
                />
              </div>
              <div class="input-container">
                <input
                  type="radio"
                  name="answer[<?php echo $i; ?>]"
                  class="answer-radio"
                  value="option2"
                />
                <input
                  type="text"
                  name="option2[<?php echo $i; ?>]"
                  class="question-option"
                  value=""
                  id="option2"
                  placeholder="Option 2"
                />
              </div>
              <div class="input-container">
                <input
                  type="radio"
                  name="answer[<?php echo $i; ?>]"
                  class="answer-radio"
                  value="option3"
                />
                <input
                  type="text"
                  name="option3[<?php echo $i; ?>]"
                  class="question-option"
                  value=""
                  id="option3"
                  placeholder="Option 3"
                />
              </div>
              <div class="input-container">
                <input
                  type="radio"
                  name="answer[<?php echo $i; ?>]"
                  class="answer-radio"
                  value="option4"
                />
                <input
                  type="text"
                  name="option4[<?php echo $i; ?>]"
                  class="question-option"
                  value=""
                  id="option4"
                  placeholder="Option 4"
                />
              </div>

            </div> <!-- End of each question container -->

            <?php }?>


            <div class="input-container">
              <button id="submit-button" name="form_submit">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- <script src="./assets/js/main.js"></script> -->
  </body>
</html>
