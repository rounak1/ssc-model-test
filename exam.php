<?php
session_start();
error_reporting(1);
$site_title = "মডেল টেস্ট :: এসএসসি মডেল টেস্ট ২০২২";
require 'check-login.php';
require 'header-v2.php';
require 'BanglaConverter.php';
include_once 'settings.php';

if (isset($_POST['test_number'])) {
    $exam_id = $_POST['test_number'];
}

if (isset($_GET['id'])) {
    $exam_id = $_GET['id'];
}

if (!isset($exam_id)) {
    $_SESSION['alert'] = "পরীক্ষার বিষয় ও মডেল টেস্ট নম্বর নির্বাচন করুন";

    echo "<script>window.location.href = 'myprofile'; </script>";
    exit();
}

?>

<section class="course__area pt-115 pb-90 exam-center">
  <div class="container">
    <div class="row">

      <div class="col-12">
        <div class="course__wrapper">

          <div class="course__tab-content mb-0">
            <div class="course__curriculum">
              <div class="accordion-item">

                <?php
// check already attend
$query_temp = "SELECT `id` FROM `temp_quiz_history` WHERE `user_id` = '$user_id' AND `exam_id` = '$exam_id'";

$result_temp = mysqli_query($conn, $query_temp);
$r_temp_data = mysqli_fetch_assoc($result_temp);

if (!empty($r_temp_data)) {
    // $query_q_h = "INSERT INTO `quiz_histories`(`user_id`, `exam_id`) VALUES ('$user_id','$exam_id')";

    // mysqli_query($conn, $query_q_h);
    // echo "<script> alert('তুমি এই মডেল টেস্টে ইতিমধ্যে অংশগ্রহণ করে ফেলেছ')</script>";
    $_SESSION['alert'] = "তুমি এই মডেল টেস্টে ইতিমধ্যে অংশগ্রহণ করে ফেলেছ";
    header('Location: myprofile');
}

$query2 = "SELECT `id` FROM `quiz_histories` WHERE `user_id` = '$user_id' AND `exam_id` = '$exam_id'";

$result2 = mysqli_query($conn, $query2);
$exam_data2 = mysqli_fetch_assoc($result2);

if (empty($exam_data2)) {

    // insert temp data
    $query_temp_insert = "INSERT INTO `temp_quiz_history`(`user_id`, `exam_id`) VALUES ('$user_id', '$exam_id')";

    $result_temp_insert = mysqli_query($conn, $query_temp_insert);

    echo mysqli_error($conn);

    $current_date = date('Y-m-d');

    $query = "SELECT * FROM `model_questions` WHERE  `exam_id` = '$exam_id' AND `exam_date` <= '$current_date'";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {

        ?>
                  <h2>
                   <button class="accordion-button">
                     <?=!empty($model_test_list[$exam_id]['test']) ? $model_test_list[$exam_id]['test'] : ""?> (<?=$model_test_list[$exam_id]['subject']?>)
                   </button>
                  </h2>

                   <div class="sticky-class">
                      <div class="time-left">সময় বাকি</div>
                      <div id="countdown"></div>
                    </div>
                    <form name="exam_submit" method="POST" action="quiz-submit.php" id="submit_form">
                      <?php
$i = 1;
        foreach ($result as $row) {
            ?>
                            <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                              <div class="course__curriculum-info">
                                <h3>
                                  <input type="hidden" name="quiz_date" value="<?php echo $row['exam_date'] ?>">
                                  <input type="hidden" name="exam_id" value="<?php echo $exam_id ?>">
                                  <input type="hidden" name="examAttendentTime" id="examAttendentTimeUpdate" value="<?=time()?>">
                                  <input type="hidden" name="question[]" value="<?php echo $row['id'] ?>">
                                  <input type="hidden" name="token[<?php echo $row['id'] ?>]" value="<?php echo base64_encode($row['answer']) ?>">

                                  <?php if (!empty($row['uddipok_statement'])) {?>
                                    <div class="questions"><?php echo $row['uddipok_statement']; ?></div>
                                  <?php }?>

                                  <?php if (!empty($row['picture'])) {?>
                                    <div class="questions">
                                      <img src="./nimdaxipalo/images/<?php echo $row['picture']; ?>" height="200" alt="" />
                                    </div>
                                  <?php }?>


                                  <?php if (!empty($row['uddipok'])) {?>
                                    <div class="questions"><?php echo $row['uddipok']; ?></div>
                                  <?php }?>

                                  <div class="questions">
                                    <?php echo BanglaConverter::en2bn($i++) . '. ' . $row['questions']; ?>
                                  </div>
                                </h3>

                                <div class="options-container">

                                  <div class="option-wrapper">
                                    <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option1" id="option_<?php echo $row['id'] ?>_1">
                                    <label for="option_<?php echo $row['id'] ?>_1"><?php echo $row['option1'] ?></label>
                                  </div>

                                  <div class="option-wrapper">
                                    <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option2" id="option_<?php echo $row['id'] ?>_2">
                                    <label for="option_<?php echo $row['id'] ?>_2"><?php echo $row['option2'] ?></label>
                                  </div>

                                  <div class="option-wrapper">
                                    <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option3" id="option_<?php echo $row['id'] ?>_3"> <label for="option_<?php echo $row['id'] ?>_3"><?php echo $row['option3'] ?></label>
                                  </div>

                                  <div class="option-wrapper">
                                    <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option4" id="option_<?php echo $row['id'] ?>_4"> <label for="option_<?php echo $row['id'] ?>_4"><?php echo $row['option4'] ?></label>
                                  </div>
                                </div>

                              </div>
                            </div>
                      <?php
}
        ?>
                      <div style="text-align: right;">
                        <input type="submit" name="exam_submit" value="সাবমিট" class="exam_submit_btn tp-btn mt-20 mb-20 ml-20 mr-20">
                      </div>
                    </form>
                    <script>
                      $(".exam-running").click(function(){
                        alert("মডেল টেস্ট চলাকালীন সময়ে অন্য পেজে যাওয়া যাবে না");
                        return false;
                      });
                    </script>
                <?php } else {?>

                    <div class='alert alert-primary text-center'>দুঃখিত! এই মডেল টেস্টটি পাওয়া যায়নি অথবা এখনো প্রকাশিত হয়নি। <br/>যথাযথ মডেল টেস্ট সিলেক্ট করতে ড্যাশবোর্ড থেকে রুটিন দেখে নাও।</div>

                <?php }?>
              <?php } else {?>

                  <div class='alert alert-primary text-center'>তুমি এই মডেল টেস্টে ইতিমধ্যে অংশগ্রহণ করে ফেলেছ</div>

              <?php }?>
              </div>
            </div>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

<script src="./assets/js/script.js?v=6"></script>
<?php require 'footer-v2.php';?>