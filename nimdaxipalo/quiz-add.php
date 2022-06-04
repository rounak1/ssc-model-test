<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
error_reporting(1);
require 'connection.php';
require '../settings.php';
// require 'admin-header.php';
require 'header-v2.php';
$date = $question = $answer = $option1 = $option2 = $option3 = $option4 = "";

$msg = [];
$image_resize = [];

if (isset($_POST['form_submit'])) {

    // echo "<pre>";
    // print_r($_POST) . "End POST";
    // print_r($_FILES);

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

    if (!empty($_POST["uddipok_statement"])) {
        $uddipok_statement = $_POST["uddipok_statement"];
    } else {
        $uddipok_statement = "";
    }

    if (!empty($_POST["uddipok"])) {
        $uddipok = $_POST["uddipok"];
    } else {
        $uddipok = "";
    }

    if (empty($_POST["question"])) {
        array_push($msg, "প্রশ্নটি দিন");
    } else {
        $question = $_POST["question"];
    }

    for ($h = 0; $h < count($_FILES['picture']['name']); $h++) {

        if (!empty($_FILES['picture']['name'][$h])) {
            $image_name = test_input($_FILES['picture']['name'][$h]);
        }

        if (!empty($_FILES['picture']['name'][$h])) {
            $image_name = time() . $image_name;

            $image_type = $_FILES['picture']['type'][$h];
            $img_tmp_location = $_FILES['picture']['tmp_name'][$h];
            $img_size = $_FILES['picture']['size'][$h];
            $tmp = explode('.', $_FILES['picture']['name'][$h]);

            $uploadPath = getcwd() . "/images/" . basename($image_name);

            $img_extension = strtolower(end($tmp));
            $required_img_format = array('jpg', 'jpeg', 'png');

            // echo "<pre>";
            // // print_r($_POST) . "End POST";
            // print_r($image_name);

            if (in_array($img_extension, $required_img_format) === false) {
                array_push($msg, "ছবির ফরম্যাট গ্রহণযোগ্য নয়।");

            }

            if ($img_size > 2097152) {
                array_push($msg, "ছবি ২ এমবি এর কম হতে হবে");
            }

            $moved = 0;

            if (count($msg) < 1) {
                $moved = move_uploaded_file($img_tmp_location, $uploadPath);
                $image_resize[$h] = $image_name;
            }
        }
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
        $z = 0;
        foreach (array_filter($question) as $item) {

            $uddipok_stmnt = test_input($uddipok_statement[$z]);
            $uddipk = test_input($uddipok[$z]);
            $qustion = test_input($question[$z]);
            $optn1 = test_input($option1[$z]);
            $optn2 = test_input($option2[$z]);
            $optn3 = test_input($option3[$z]);
            $optn4 = test_input($option4[$z]);

            $query = "INSERT INTO `model_questions`(`exam_id`, `questions`, `uddipok_statement`, `uddipok`, `picture`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_date`) VALUES ('$exam_id', '$qustion', '$uddipok_stmnt', '$uddipk', '$image_resize[$z]', '$optn1', '$optn2', '$optn3', '$optn4', '$answer[$z]', '$exam_date')";

            $result = mysqli_query($conn, $query);

            $z++;
        }

        if ($result) {
            echo "<script>toastr.success('প্রশ্নটি সফলভাবে ডাটাবেজে সেভ হয়েছে ');</script>";
        } else {
            echo "<script>toastr.alert('প্রশ্নটি ডাটাবেজে সেভ হয়নি ');</script>";
        }
    }
}

?>



    <div class="container">
      <div class="quiz-container">
        <div class="login-container">
          <div class="title">Question entry form</div>

          <form id="form_submit" method="post" action="" name="form_submit" enctype="multipart/form-data">
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
                <label>উদ্দীপক স্টেটমেন্ট</label>
                <input
                  type="text"
                  name="uddipok_statement[]"
                  value=""
                  id="uddipok_statement"
                  placeholder=""

                />
              </div>

            <div class="input-container">
                <label>উদ্দীপক</label>
                <input
                  type="text"
                  name="uddipok[]"
                  value=""
                  id="uddipok"
                  placeholder=""

                />
              </div>

              <div class="input-container">
                <label class="question">Question <?php echo $i + 1; ?></label>
                <input
                  type="text"
                  name="question[]"
                  value=""
                  id="question"
                  placeholder="Question"

                />
              </div>



              <div class="input-container">
        <label for="story" class="col-sm-3 col-form-label">
          ছবি
        </label>

        <label for="imageUpload_1" class="image-upload">
          <span>Upload</span> Photo (max 2mb)
        </label>
        <img src="images/cook.png" alt="" class="img-responsive" id="imagePreview_1">
        <input type="file" class="form-control-file hide" id="imageUpload_1" name="picture[]">
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
    <?php require 'footer-v2.php';?>
