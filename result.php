<?php
session_start();
error_reporting(1);
require 'check-login.php';
require 'header-home.php';
require 'BanglaConverter.php';
include_once 'settings.php';

$exam_id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : 0;

// Get exam data
$exam_query = "SELECT * FROM `quiz_histories` WHERE `id` = '$exam_id' AND `user_id` = '$user_id'";

$exam_result = mysqli_query($conn, $exam_query);
$exam_data = mysqli_fetch_assoc($exam_result);
?>

    <section class="ftco-section testimony-section bg-light">
      <div class="container">

        <div
          class="row justify-content-center mb-5 pb-3"
        >
          <div class="col-md-12 text-center heading heading-section">
            <h2 class="mb-2">ফলাফল</h2>
          </div>
          <?php
            if (!empty($exam_data)) {
          ?>
          <div class="col-md-12">
            <div class="exam-container">
              <div class="result-summary">
                <div class="row"><b>মোট প্রশ্ন: <?=BanglaConverter::en2bn($exam_data['total_marks'] + $exam_data['wrong_answers'] + $exam_data['not_given_answers'])?></b></div>
                <div class="row"><b>সঠিক উত্তর: <?=BanglaConverter::en2bn($exam_data['total_marks'])?></b></div>
                <div class="row"><b>ভুল উত্তর: <?=BanglaConverter::en2bn($exam_data['wrong_answers'])?></b></div>
                <div class="row"><b>উত্তর নাই: <?=BanglaConverter::en2bn($exam_data['not_given_answers'])?></b></div>
                <div class="row"><b>মোট সময়: <?=BanglaConverter::en2bn(floor(($exam_data['completion_time'] - 2) / 60))?> মিনিট <?=BanglaConverter::en2bn(($exam_data['completion_time'] - 2) % 60)?> সেকেন্ড</b></div>
                <div class="details-text"><?=!empty($model_test_list[$exam_data['exam_id']]['test']) ? $model_test_list[$exam_data['exam_id']]['test'] : "বিস্তারিত"?></div>
                <div class="result-subject">বিষয়: <?=$model_test_list[$exam_data['exam_id']]['subject']?></div>
              </div>
              <div class="quiz-play-information">

                  <section>
                    <?php


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

                              <?php
if (!empty($row['uddipok_statement'])) {?>
                                <div class="uddipok"><?php echo $row['uddipok_statement']; ?></div>

                                <div class="uddipok"><?php echo $row['uddipok']; ?></div>

                               <?php }
        ?>



                                  <div class="questions"><?php echo BanglaConverter::en2bn($i++) . '. ' . $row['questions']; ?></div>
                                  <div class="options-container r-option-container">

                                      <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option1'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                          <img style="width: 20px;   margin-right: 4px;" src="images/right.png">
                                      <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option1']) {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;" src="images/wrong.png">
                                      <?php
} else {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;" src="images/normal.png">
                                      <?php
}
        ?>
                                      <?php echo $row['option1'] ?>

                                      <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option2'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                          <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/right.png">
                                      <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option2']) {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/wrong.png">
                                      <?php
} else {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/normal.png">
                                      <?php
}
        ?>
                                      <?php echo $row['option2'] ?>


                                      <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option3'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                          <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/right.png">
                                      <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option3']) {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/wrong.png">
                                      <?php
} else {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/normal.png">
                                      <?php
}
        ?>

                                      <?php echo $row['option3'] ?>

                                      <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option4'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                          <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/right.png">
                                      <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option4']) {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/wrong.png">
                                      <?php
} else {
            ?>
                                        <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/normal.png">
                                      <?php
}
        ?>
                                      <?php echo $row['option4'] ?>

                                  </div>

                                  <?php
                                    if($row[$c_exam_data[$row['id']]] != $row[$row['answer']]) {
                                  ?>
                                  <div class="student-answer">
                                    <b>সঠিক উত্তর: </b> <?=$row[$row['answer']]?>
                                  </div>
                                  <?php
                                    }
                                  ?>

                              </div>

                          <?php }?>

                    




                  </section>

              </div>
            </div>
          </div>
          <?php } else { ?>
           <div class="col-md-12 alert-message"> তুমি এই মডেল টেস্টে অংশগ্রহণ করোনি।</div>
          <?php } ?>
          <div><a href="myprofile.php" class="btn btn-secondary results_profile_btn">ড্যাশবোর্ডে ফিরে যাও </a></div>
        </div>
      </div>
    </section>

    <?php require 'footer-home.php';?>
