<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-home.php';
require 'BanglaConverter.php';

$email = $_SESSION['email'];

?>

    <section class="ftco-section testimony-section bg-light">
      <div class="container">
        
        <div
          id="myprofile_section"
          class="row justify-content-center mb-5 pb-3"
        >
          <div class="col-md-12 text-center heading heading-section">
            <h2 class="mb-2">মডেল টেস্ট</h2>
          </div>

          <div class="col-md-12">
            <div class="exam-container">
              
              <div class="quiz-play-information">

                  <section>
                    <?php
                      $exam_id = 'ssc_phy_t001';

                      $query1 = "SELECT `id` FROM `model_students` WHERE `email` = '$email'";

                      $result1 = mysqli_query($conn, $query1);
                      $user_data = mysqli_fetch_assoc($result1);

                      $user_id = $user_data['id'];

                      // check already attend
                      $query_temp = "SELECT `id` FROM `temp_quiz_history` WHERE `user_id` = '$user_id' && `exam_id` = '$exam_id'";

                      $result_temp = mysqli_query($conn, $query_temp);
                      $r_temp_data = mysqli_fetch_assoc($result_temp);
                      
                      if(!empty($r_temp_data)) {
                        $query_q_h = "INSERT INTO `quiz_histories`(`user_id`, `exam_id`) VALUES ('$user_id','$exam_id')";

                        mysqli_query($conn, $query_q_h);
                        echo "<script> alert('আপনি ইতিমধ্যে এই মডেল টেস্টে যোগদান করেছিলেন')</script>";                        
                      }

                      $query2 = "SELECT `id` FROM `quiz_histories` WHERE `user_id` = '$user_id'";

                      $result2 = mysqli_query($conn, $query2);
                      $exam_data2 = mysqli_fetch_assoc($result2);

                      if(empty($exam_data2)) {

                        // insert temp data
                        $query_temp_insert = "INSERT INTO `temp_quiz_history`(`user_id`, `exam_id`) VALUES ('$user_id', '$exam_id')";

                        $result_temp_insert = mysqli_query($conn, $query_temp_insert);

                        echo mysqli_error($conn);

                    ?>
                      <div id="countdown"></div>
                      <div id="examAttendentTime" style="display: none;"></div>
                      <form name="exam_submit" method="POST" action="quiz-submit.php" id="submit_form">
<div class="question-container">
   <?php
   
$query = "SELECT * FROM `model_questions` WHERE  `exam_id` = '$exam_id'";

$result = mysqli_query($conn, $query);

$rows = [];
while ($row = mysqli_fetch_array($result)) {
    $rows[] = $row;
}
shuffle($rows);

$i = 1;

foreach ($rows as $row) {

    ?>

    <div class="questions-each">

       <input type="hidden" name="quiz_date" value="<?php echo $row['exam_date'] ?>">
       <input type="hidden" name="exam_id" value="<?php echo $exam_id ?>">
       <input type="hidden" name="examAttendentTime" id="examAttendentTimeUpdate" value="<?=time()?>">
       <input type="hidden" name="question[]" value="<?php echo $row['id'] ?>">
       <input type="hidden" name="token[<?php echo $row['id'] ?>]" value="<?php echo base64_encode($row['answer']) ?>">
        <div class="questions"><?php echo BanglaConverter::en2bn($i++) . '. ' . $row['questions']; ?></div>
        <div class="options-container">
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option1"> <?php echo $row['option1'] ?>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option2"> <?php echo $row['option2'] ?>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option3"> <?php echo $row['option3'] ?>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option4"> <?php echo $row['option4'] ?>
        </div>

    </div>

<?php }?>

<input type="submit" name="exam_submit" value="সাবমিট" class="exam_submit_btn">

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

    <?php include 'footer.php';?>
