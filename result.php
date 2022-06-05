<?php
session_start();
error_reporting(1);
require 'check-login.php';
require 'header-v2.php';
require 'BanglaConverter.php';
include_once 'settings.php';

$exam_id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : 0;

// Get exam data
$exam_query = "SELECT * FROM `quiz_histories` WHERE `id` = '$exam_id' AND `user_id` = '$user_id'";

$exam_result = mysqli_query($conn, $exam_query);
$exam_data = mysqli_fetch_assoc($exam_result);
?>

<section class="course__area pt-115 pb-90">
  <div class="container">
    <div class="row">

      <div class="col-12">
        <div class="course__wrapper">
          <?php
if (!empty($exam_data)) {
    ?>
            <div class="row">
              <div class="col-12 col-md-4">
                <?php require 'menu.php';?>
              </div>

              <div class="col-12 col-md-8">

                <div class="course__tab-content mb-30">
                  <div class="course__curriculum">
                    <div class="accordion-item mb-50">

                      <h2>
                       <button class="accordion-button">
                         ফলাফল: <?=!empty($model_test_list[$exam_data['exam_id']]['test']) ? $model_test_list[$exam_data['exam_id']]['test'] : ""?> (<?=$model_test_list[$exam_data['exam_id']]['subject']?>)
                       </button>
                      </h2>

                      <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                        <div class="course__curriculum-info">
                           <svg viewBox="0 0 32 32">
                            <circle fill="#FFF8E1" cx="16" cy="16" r="15"/>
                            <path fill="#FFA000" d="M16,32C7.178,32,0,24.822,0,16S7.178,0,16,0s16,7.178,16,16S24.822,32,16,32z M16,2C8.28,2,2,8.28,2,16
                              s6.28,14,14,14s14-6.28,14-14S23.72,2,16,2z"/>
                            <path fill="#FFA000" d="M16,24c0.828,0,1.5,0.672,1.5,1.5S16.828,27,16,27c-0.828,0-1.5-0.672-1.5-1.5S15.172,24,16,24z M16,7
                              c3.314,0,6,2.686,6,6c0,2.165-0.753,3.29-2.674,4.923C17.399,19.56,17,20.297,17,22h-2c0-2.474,0.787-3.695,3.031-5.601
                              C19.548,15.11,20,14.434,20,13c0-2.21-1.79-4-4-4s-4,1.79-4,4v1h-2v-1C10,9.686,12.686,7,16,7z"/>
                            </svg>
                           <h3> <span>মোট প্রশ্ন</span></h3>
                        </div>
                        <div class="course__curriculum-meta">
                           <span class="question" style="background: #FFA000;"><?=BanglaConverter::en2bn($exam_data['total_marks'] + $exam_data['wrong_answers'] + $exam_data['not_given_answers'])?></span>
                        </div>
                      </div>

                      <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                        <div class="course__curriculum-info">
                          <svg viewBox="0 0 32 32">
                            <g>
                              <circle fill="#E0F3F0" cx="16" cy="16" r="15"/>
                              <path fill="#016E53" d="M16,32C7.178,32,0,24.822,0,16S7.178,0,16,0s16,7.178,16,16S24.822,32,16,32z M16,2C8.28,2,2,8.28,2,16
                                s6.28,14,14,14s14-6.28,14-14S23.72,2,16,2z"/>
                            </g>
                            <path fill="#016E53" d="M13.5,19.834L24.332,9L26,10.666l-12.5,12.5l-7.5-7.5L7.666,14L13.5,19.834z"/>
                          </svg>
                          <h3> <span>সঠিক উত্তর</span></h3>
                        </div>
                        <div class="course__curriculum-meta">
                           <span class="question" style="background: #016E53;">
                            <?=BanglaConverter::en2bn($exam_data['total_marks'])?></span>
                        </div>
                      </div>

                      <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                        <div class="course__curriculum-info">
                          <svg viewBox="0 0 32 32">
                            <g>
                            <circle fill="#FFEBEE" cx="16" cy="16" r="15"/>
                            <path fill="#D60000" d="M16,32C7.178,32,0,24.822,0,16S7.178,0,16,0s16,7.178,16,16S24.822,32,16,32z M16,2C8.28,2,2,8.28,2,16
                            s6.28,14,14,14s14-6.28,14-14S23.72,2,16,2z"/>
                            </g>
                            <path fill="#D60000" d="M15.955,14.188L22.142,8l1.767,1.767l-6.188,6.188l6.188,6.188l-1.767,1.767l-6.188-6.188L9.767,23.91
                            L8,22.142l6.188-6.188L8,9.767L9.767,8L15.955,14.188z"/>
                          </svg>
                           <h3> <span>ভুল উত্তর</span></h3>
                        </div>
                        <div class="course__curriculum-meta">
                           <span class="question" style="background: #D60000;"><?=BanglaConverter::en2bn($exam_data['wrong_answers'])?></span>
                        </div>
                      </div>

                      <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                        <div class="course__curriculum-info">
                           <svg viewBox="0 0 32 32">
                            <circle fill="#FFF8E1" cx="16" cy="16" r="15"/>
                            <path fill="#FFA000" d="M16,32C7.178,32,0,24.822,0,16S7.178,0,16,0s16,7.178,16,16S24.822,32,16,32z M16,2C8.28,2,2,8.28,2,16
                              s6.28,14,14,14s14-6.28,14-14S23.72,2,16,2z"/>
                            <path fill="#FFA000" d="M11.107,14.5c0.828,0,1.5,0.672,1.5,1.5s-0.672,1.5-1.5,1.5c-0.828,0-1.5-0.672-1.5-1.5
                              S10.279,14.5,11.107,14.5z"/>
                            <path fill="#FFA000" d="M16,14.5c0.828,0,1.5,0.672,1.5,1.5s-0.672,1.5-1.5,1.5c-0.828,0-1.5-0.672-1.5-1.5S15.172,14.5,16,14.5z"/>
                            <path fill="#FFA000" d="M20.893,14.5c0.828,0,1.5,0.672,1.5,1.5s-0.672,1.5-1.5,1.5c-0.828,0-1.5-0.672-1.5-1.5
                              S20.065,14.5,20.893,14.5z"/>
                            </svg>
                           <h3> <span>উত্তর নাই</span></h3>
                        </div>
                        <div class="course__curriculum-meta">
                           <span class="question" style="background: #FFA000;"><?=BanglaConverter::en2bn($exam_data['not_given_answers'])?></span>
                        </div>
                      </div>

                      <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                        <div class="course__curriculum-info">
                           <svg viewBox="0 0 32 32">
                            <circle fill="#E1F5FE" cx="16" cy="16" r="15"/>
                            <path fill="#01579B" d="M16,32C7.178,32,0,24.822,0,16S7.178,0,16,0s16,7.178,16,16S24.822,32,16,32z M16,2C8.28,2,2,8.28,2,16
                              s6.28,14,14,14s14-6.28,14-14S23.72,2,16,2z"/>
                            <polygon fill="#01579B" points="16.631,14.976 20.631,14.976 20.631,16.976 14.631,16.976 14.631,9.976 16.631,9.976 "/>
                            </svg>
                           <h3> <span>মোট সময়</span></h3>
                        </div>
                        <div class="course__curriculum-meta">
                           <?=BanglaConverter::en2bn(floor(($exam_data['completion_time'] - 2) / 60))?> মিনিট <?=BanglaConverter::en2bn(($exam_data['completion_time'] - 2) % 60)?> সেকেন্ড
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="course__tab-content mb-0">
              <div class="course__curriculum">
                <div class="accordion-item">

                  <h2>
                   <button class="accordion-button">
                     বিস্তারিত
                   </button>
                  </h2>

                  <?php

    $decode_exam_data = json_decode($exam_data['exam_list']);
    $c_exam_data = (array) $decode_exam_data->option;

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

                      <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                        <div class="course__curriculum-info">
                          <h3>
                            <?php
if (!empty($row['uddipok_statement'])) {?>
                                  <div class="uddipok"><?php echo $row['uddipok_statement']; ?></div>

                                  <?php }

        if (!empty($row['picture'])) {?>
  <div class="questions">
    <img src="./nimdaxipalo/images/<?php echo $row['picture']; ?>" height="200" alt="" />
  </div>
<?php }

        if (!empty($row['uddipok'])) {?>





                                  <div class="uddipok"><?php echo $row['uddipok']; ?></div>

                                  <?php }?>


                            <div class="questions">
                              <?php echo BanglaConverter::en2bn($i++) . '. ' . $row['questions']; ?>
                            </div>
                          </h3>
                          <div class="options-container">

                            <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option1'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;" src="assets/images/right.svg">
                            <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option1']) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;" src="assets/images/wrong.svg">
                            <?php } else {?>
                                <img style="width: 20px;   margin-right: 4px;" src="images/normal.png">
                            <?php }?>
                                <?php echo $row['option1'] ?>

                            <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option2'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="assets/images/right.svg">
                            <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option2']) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="assets/images/wrong.svg">
                            <?php } else {?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/normal.png">
                            <?php }?>
                                <?php echo $row['option2'] ?>


                            <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option3'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="assets/images/right.svg">
                            <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option3']) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="assets/images/wrong.svg">
                            <?php } else {?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/normal.png">
                            <?php }?>
                               <?php echo $row['option3'] ?>

                            <?php
if (!empty($row[$c_exam_data[$row['id']]]) && $row[$row['answer']] == $row['option4'] && $row[$c_exam_data[$row['id']]] == $row[$row['answer']]) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="assets/images/right.svg">
                            <?php
} elseif ($row[$c_exam_data[$row['id']]] == $row['option4']) {
            ?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="assets/images/wrong.svg">
                            <?php } else {?>
                                <img style="width: 20px;   margin-right: 4px;margin-left: 12px;" src="images/normal.png">
                            <?php }?>
                                <?php echo $row['option4'] ?>
                          </div>

                          <?php
if ($row[$c_exam_data[$row['id']]] != $row[$row['answer']]) {
            ?>
                          <div class="student-answer">
                            <b>সঠিক উত্তর: </b> <?=$row[$row['answer']]?>
                          </div>
                          <?php
}
        ?>

                        </div>
                      </div>

                  <?php }?>

                </div>
              </div>
            </div>

              </div>
            </div>



          <?php } else {?>
            <div class="alert alert-primary text-center" role="alert">
              তুমি এই মডেল টেস্টে অংশগ্রহণ করোনি।
            </div>
          <?php }?>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require 'footer-v2.php';?>
