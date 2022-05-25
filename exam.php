<?php
session_start();
error_reporting(1);
require 'check-login.php';
require 'header-home.php';
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

    echo "<script>window.location.href = 'myprofile.php'; </script>";
    exit();
}

?>

    <section class="ftco-section testimony-section bg-light">
      <div class="container">

        <div
          id="myprofile_section"
          class="row justify-content-center mb-5 pb-3"
        >
          <div class="col-md-12 text-center heading heading-section">
            <h2 class="mb-2"><?=!empty($model_test_list[$exam_id]['test'])?$model_test_list[$exam_id]['test']:"মডেল টেস্ট"?></h2>
          </div>
          <div class="exam-subject">বিষয়: <?=$model_test_list[$exam_id]['subject']?></div>

          <div class="col-md-12">
            <div class="exam-container">

              <div class="quiz-play-information">

                  <section>
                    <?php
// check already attend
$query_temp = "SELECT `id` FROM `temp_quiz_history` WHERE `user_id` = '$user_id' AND `exam_id` = '$exam_id'";

$result_temp = mysqli_query($conn, $query_temp);
$r_temp_data = mysqli_fetch_assoc($result_temp);

if (!empty($r_temp_data)) {
    // $query_q_h = "INSERT INTO `quiz_histories`(`user_id`, `exam_id`) VALUES ('$user_id','$exam_id')";

    // mysqli_query($conn, $query_q_h);
    // echo "<script> alert('আপনি এই মডেল টেস্টে অংশগ্রহণ করে ফেলেছেন')</script>";
    $_SESSION['alert'] = "আপনি এই মডেল টেস্টে অংশগ্রহণ করে ফেলেছেন";
    header('Location: myprofile.php');
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
        <div class="sticky-class"><div id="countdown"></div></div>
        <div id="examAttendentTime" style="display: none;"></div>
        <form name="exam_submit" method="POST" action="quiz-submit.php" id="submit_form">
    <div class="question-container">
    <?php    

        $i = 1;

        foreach ($result as $row) {

            ?>

    <div class="questions-each">

       <input type="hidden" name="quiz_date" value="<?php echo $row['exam_date'] ?>">
       <input type="hidden" name="exam_id" value="<?php echo $exam_id ?>">
       <input type="hidden" name="examAttendentTime" id="examAttendentTimeUpdate" value="<?=time()?>">
       <input type="hidden" name="question[]" value="<?php echo $row['id'] ?>">
       <input type="hidden" name="token[<?php echo $row['id'] ?>]" value="<?php echo base64_encode($row['answer']) ?>">

       <?php if (!empty($row['picture'])) {?>
        <div class="questions"><img src="./nimdaxipalo/images/<?php echo $row['picture']; ?>" height="200" alt="" /></div>
      <?php }?>

       <?php if (!empty($row['uddipok_statement'])) {?>
        <div class="questions"><?php echo $row['uddipok_statement']; ?></div>
      <?php }?>

      <?php if (!empty($row['uddipok'])) {?>
        <div class="questions"><?php echo $row['uddipok']; ?></div>
      <?php }?>

        <div class="questions"><?php echo BanglaConverter::en2bn($i++) . '. ' . $row['questions']; ?></div>
        <div class="options-container">
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option1" id="option_<?php echo $row['id'] ?>_1">
            <label for="option_<?php echo $row['id'] ?>_1"><?php echo $row['option1'] ?></label>

            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option2" id="option_<?php echo $row['id'] ?>_2">
            <label for="option_<?php echo $row['id'] ?>_2"><?php echo $row['option2'] ?></label>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option3" id="option_<?php echo $row['id'] ?>_3"> <label for="option_<?php echo $row['id'] ?>_3"><?php echo $row['option3'] ?></label>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option4" id="option_<?php echo $row['id'] ?>_4"> <label for="option_<?php echo $row['id'] ?>_4"><?php echo $row['option4'] ?></label>
        </div>

    </div>

<?php }?>

<input type="submit" name="exam_submit" value="সাবমিট" class="exam_submit_btn">
<script>
  $(".exam-running").click(function(){
    alert("মডেল টেস্ট কোলাকালীন সময়ে অন্য পেজে যাওয়া যাবে না");
    return false;
  });
</script>
<?php } else { ?>
  <div style="text-align: center;margin-top: 50px;">দুঃখিত! এই মডেল টেস্টটি পাওয়া যায়নি অথবা এখনো প্রকাশিত হয়নি। <br/>যথাযথ মডেল টেস্ট সিলেক্ট করতে ড্যাসবোর্ড থেকে রুটিন দেখে নাও।</div>
<?php }?>
</form>
</div>
<?php
} else {
    echo "আপনি এই মডেল টেস্টে অংশগ্রহণ করে ফেলেছেন";
}
?>
                  </section>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<script src="./assets/js/script.js?v=5.3"></script>
<?php require 'footer-home.php';?>