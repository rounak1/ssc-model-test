<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-home.php';

$email = $_SESSION['email'];

?>

    <section class="ftco-login ftco-section testimony-section bg-light">
      <div class="container">
        <div id="accomplishTime"></div>
        <div class="container-quiz">
          <div class="quiz-container">
            <form id="quiz_submit">
              <div id="quiz_data"></div>
            </form>
          </div>
        </div>

        <div
          id="myprofile_section"
          class="row justify-content-center mb-5 pb-3"
        >
          <div class="col-md-12 text-center heading heading-section">
            <h2 class="mb-2">ড্যাশবোর্ড</h2>
          </div>

          <div class="col-md-12">
            <div class="profile-container">
              <div class="account-information">
                  <?php
$query = "SELECT `name`, `phone`, `email`, `profession`, `gender`, `district`, `thana` from `quiz_users` WHERE `email` = '$email'";

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {?>

              <h3 class="profile-info"><strong>নাম:</strong><?php echo $row['name']; ?></h3>
  <h4 class="profile-info"><strong>ই-মেইল:</strong> <?php echo $row['email']; ?></h4>
  <h4 class="profile-info"><strong>পেশা:</strong> <?php echo $row['profession']; ?></h4>
  <h4 class="profile-info"><strong>লিঙ্গ:</strong> <?php echo $row['gender'] == 1 ? 'পুরুষ ' : 'মহিলা'; ?></h4>
  <h4 class="profile-info"><strong>ফোন:</strong> <?php echo $row['phone']; ?></h4>
  <h4 class="profile-info"><strong>জেলা:</strong> <?php echo $row['district']; ?></h4>
  <h4 class="profile-info"><strong>উপজেলা:</strong> <?php echo $row['thana']; ?></h4>
  <?php }?>
              </div>
              <div class="quiz-play-information">

                  <section>
                      <div id="countdown">

                      </div>
                      <form name="exam_submit" method="POST" action="quiz-submit.php" id="submit_form">
<div class="question-container">
   <?php
$query = "SELECT * FROM `quiz_questions` WHERE  `exam_date` = '2022-05-11'";

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

       <input type="hidden" name="question[]" value="<?php echo $row['id'] ?>">
       <input type="hidden" name="token[<?php echo $row['id'] ?>]" value="<?php echo base64_encode($row['answer']) ?>">
        <div class="questions"><?php echo $i++ . '. ' . $row['questions']; ?></div>
        <div class="options-container">
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option1"> <?php echo $row['option1'] ?>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option2"> <?php echo $row['option2'] ?>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option3"> <?php echo $row['option3'] ?>
            <input type="radio" name="option[<?php echo $row['id'] ?>]" value="option4"> <?php echo $row['option4'] ?>
        </div>

    </div>

<?php }?>

<input type="submit" name="exam_submit" value="Submit" onclick="myFunction()">

</form>
</div>

                  </section>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
        // myFunction();
function myFunction() {

  document.getElementById("submit_form").submit();

//   alert('x');
  return false;
}
</script>

    <?php include 'footer.php';?>
