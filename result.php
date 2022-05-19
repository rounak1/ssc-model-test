<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'check-login.php';
require 'header-home.php';
require 'BanglaConverter.php';

$email = $_SESSION['email'];

$exam_id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : 0;
                      
// Get exam data
$exam_query = "SELECT * FROM `quiz_histories` WHERE `id` = '$exam_id'";

$exam_result = mysqli_query($conn, $exam_query);
$exam_data = mysqli_fetch_assoc($exam_result);
?>

    <section class="ftco-section testimony-section bg-light">
      <div class="container">
        <div class="container-quiz">
          <div class="quiz-container">
            <form id="quiz_submit">
              <div id="quiz_data"></div>
            </form>
          </div>
        </div>

        <div
          class="row justify-content-center mb-5 pb-3"
        >
          <div class="col-md-12 text-center heading heading-section">
            <h2 class="mb-2">ফলাফল</h2>
          </div>

          <div class="col-md-12">
            <div class="exam-container">
              <div class="result-summary">
                <div class="row"><b>মোট প্রশ্ন: <?=BanglaConverter::en2bn($exam_data['total_marks'] + $exam_data['wrong_answers'] + $exam_data['not_given_answers'])?></b></div>
                <div class="row"><b>সঠিক উত্তর: <?=BanglaConverter::en2bn($exam_data['total_marks'])?></b></div>
                <div class="row"><b>ভুল উত্তর: <?=BanglaConverter::en2bn($exam_data['wrong_answers'])?></b></div>
                <div class="row"><b>উত্তর নাই: <?=BanglaConverter::en2bn($exam_data['not_given_answers'])?></b></div>
                <div class="row"><b>মোট সময়: <?=BanglaConverter::en2bn(floor(($exam_data['completion_time'] - 2) / 60))?> মিনিট <?=BanglaConverter::en2bn(($exam_data['completion_time'] - 2) % 60)?> সেকেন্ড</b></div>
                <div class="details-text">বিস্তারিত</div>
              </div>
              <div class="quiz-play-information">

                  <section>
                    <?php

                      if(!empty($exam_data)) 
                      {
                        $decode_exam_data = json_decode($exam_data['exam_list']);
                        $c_exam_data = (array) $decode_exam_data->option;
                     
                    ?>
                        <?php
                          $exam_id = $exam_data['exam_id'];

                          $query = "SELECT * FROM `model_questions` WHERE  `exam_id` = '$exam_id'";

                          $result = mysqli_query($conn, $query);

                          $rows = [];
                          while ($row = mysqli_fetch_array($result)) {
                              $rows[] = $row;
                          }
                          $i = 1;

                          foreach ($rows as $row) {
                              ?>

                              <div class="questions-each">
                                 
                                  <div class="questions"><?php echo BanglaConverter::en2bn($i++) . '. ' . $row['questions']; ?></div>
                                  <div class="options-container r-option-container">
                                      <input disabled type="radio" name="option[<?php echo $row['id'] ?>]" value="option1"> <?php echo $row['option1'] ?>
                                      <input disabled type="radio" name="option[<?php echo $row['id'] ?>]" value="option2"> <?php echo $row['option2'] ?>
                                      <input disabled type="radio" name="option[<?php echo $row['id'] ?>]" value="option3"> <?php echo $row['option3'] ?>
                                      <input disabled type="radio" name="option[<?php echo $row['id'] ?>]" value="option4"> <?php echo $row['option4'] ?>
                                  </div>

                                  <div class="student-answer">
                                    <b>আপনার উত্তর:</b> <?= $row[$c_exam_data[$row['id']]]?>
                                  </div>

                                  <div class="student-answer">
                                    <b>সঠিক উত্তর:</b> <?= $row[$row['answer']]?>
                                  </div>

                              </div>

                          <?php }?>

                    <?php
                      }
                    ?>
                  </section>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php include 'footer.php';?>
