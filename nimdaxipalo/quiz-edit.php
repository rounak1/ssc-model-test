<?php

error_reporting(E_ALL);
require 'connection.php';
require '../settings.php';
// require 'admin-header.php';
require 'header-v2.php';
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}

$msg = [];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM `model_questions` WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

} else {
    header('Location: quiz.php');
}

if (isset($_POST['btn_update'])) {

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: quiz.php');
    }

    if (empty($_POST["exam_date"])) {
        array_push($msg, "পরীক্ষার তারিখ দিন");
    } else {
        $exam_date = test_input($_POST["exam_date"]);
    }

    if (empty($_POST["exam_id"])) {
        array_push($msg, "পরীক্ষার বিষয় নির্বাচন করুন");
    } else {
        $exam_id = test_input($_POST["exam_id"]);
    }

    $uddipok_statement = test_input($_POST["uddipok_statement"]);

    $uddipok = test_input($_POST["uddipok"]);

    if (empty($_POST["question"])) {
        array_push($msg, "প্রশ্নটি দিন");
    } else {
        $question = test_input($_POST["question"]);
    }

    if (empty($_POST["answer"])) {
        array_push($msg, "উত্তর সিলেক্ট করুন");
    } else {
        $answer = test_input($_POST["answer"]);
    }
    if (empty($_POST["option1"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option1 = test_input($_POST["option1"]);
    }
    if (empty($_POST["option2"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option2 = test_input($_POST["option2"]);
    }
    if (empty($_POST["option3"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option3 = test_input($_POST["option3"]);
    }

    if (empty($_POST["option4"])) {
        array_push($msg, "উত্তরের অপশন দিন");
    } else {
        $option4 = test_input($_POST["option4"]);
    }

    if ((count($msg) < 1)) {

        $query = "UPDATE  `model_questions` SET `exam_id` = '$exam_id', `uddipok_statement` = '$uddipok_statement', `uddipok` = '$uddipok', `questions` = '$question', `option1` = '$option1', `option2` = '$option2', `option3` = '$option3', `option4` = '$option4', `answer` = '$answer', `exam_date` = '$exam_date' WHERE `id` = '$id' ";

        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "<script>toastr.success('প্রশ্নটি সফলভাবে আপডেট হয়েছে ');</script>";
        }

        header('Location: quiz.php');
        echo "<script type='text/javascript'>window.top.location='quiz.php';</script>";exit;
    }

}
?>
    <div class="container">
      <div class="quiz-container">
        <div class="login-container">
          <div class="title">Quiz edit form</div>
        <?php foreach ($result as $row) {?>

          <form id="form_submit_update" method="POST" action="">
            <div class="input-container">
              <label>Date</label>
              <input
                type="text"
                name="exam_date"
                value="<?php echo $row['exam_date']; ?>"
                id="date"
                placeholder="YYYY-MM-DD"
                required="required"
              />
            </div>

            <?php

    // echo "<pre>";

    ?>
            <div class="input-container">
            <select name="exam_id" id="subjects" class="input-container">
                <option value="">সাবজেক্ট  সিলেক্ট করুন</option>

                <?php

    foreach ($model_test_list as $exam) {?>

    <option value="<?php echo $exam['id']; ?>" <?=$exam['id'] == $row['exam_id'] ? 'selected' : ''?>>
      <?php echo ($exam['subject'] . ' -- ' . $exam['test']); ?>
    </option>
<?php }

    ?>

              </select>


              <!-- <input
                type="text"
                name="exam_id"
                value="<?php echo $subject_display = $model_test_list[$row['exam_id']]['subject'] . '-' . $model_test_list[$row['exam_id']]['test'] ?>"
                id="date"
                placeholder="YYYY-MM-DD"
                required="required"
              /> -->
            </div>

            <?php if (!empty($row['uddipok_statement'])) {?>
              <div class="input-container">
              <label>উদ্দীপক স্টেটমেন্ট </label>
              <input
                type="text"
                name="uddipok_statement"
                value="<?php echo $row['uddipok_statement']; ?>"
                id="question"
                placeholder="uddipok_statement"
              />
            </div>
           <?php }?>

           <?php if (!empty($row['uddipok'])) {?>
              <div class="input-container">
              <label>উদ্দীপক</label>
              <input
                type="text"
                name="uddipok"
                value="<?php echo $row['uddipok']; ?>"
                id="question"
                placeholder="uddipok"
              />
            </div>
           <?php }?>





            <div class="input-container">
              <label>Question</label>
              <input
                type="text"
                name="question"
                value="<?php echo $row['questions']; ?>"
                id="question"
                placeholder="Question"
                required="required"
              />
            </div>
            <div class="input-container">
              <label class="label-answer">Answer</label>
              <label class="label-option">Option</label>
            </div>
            <div class="input-container">
              <input
                type="radio"
                name="answer"
                class="answer-radio"
                value="option1" <?php echo $row['answer'] === 'option1' ? "checked" : "" ?> />
              <input
                type="text"
                name="option1"
                class="question-option"
                value="<?php echo $row['option1']; ?>"
                id="option1"
                placeholder="Option 1"
                required="required"
              />
            </div>
            <div class="input-container">
              <input
                type="radio"
                name="answer"
                class="answer-radio"
                value="option2"
                <?php echo $row['answer'] === 'option2' ? "checked" : "" ?>
              />
              <input
                type="text"
                name="option2"
                class="question-option"
                value="<?php echo $row['option2']; ?>"
                id="option2"
                placeholder="Option 2"
                required="required"
              />
            </div>
            <div class="input-container">
              <input
                type="radio"
                name="answer"
                class="answer-radio"
                value="option3"
                <?php echo $row['answer'] === 'option3' ? "checked" : "" ?>
              />
              <input
                type="text"
                name="option3"
                class="question-option"
                value="<?php echo $row['option3']; ?>"
                id="option3"
                placeholder="Option 3"
                required="required"
              />
            </div>
            <div class="input-container">
              <input
                type="radio"
                name="answer"
                class="answer-radio"
                value="option4"
                <?php echo $row['answer'] === 'option4' ? "checked" : "" ?>
              />
              <input
                type="text"
                name="option4"
                class="question-option"
                value="<?php echo $row['option4']; ?>"
                id="option4"
                placeholder="Option 4"
              />
            </div>
            <div class="input-container">
              <input
                type="hidden"
                name="quiz_id"
                id="quiz_id"
                value=""
                required="required"
              />
              <input
                type="hidden"
                name="created_at"
                id="created_at"
                value=""
                required=""
              />
              <button id="submit-button" name="btn_update">Update</button>
            </div>
          </form>
          <?php

}
?>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- <script src="./assets/js/main.js"></script> -->
    <?php require 'footer-v2.php';?>