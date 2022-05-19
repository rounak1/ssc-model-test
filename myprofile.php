<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-home.php';

include_once 'settings1.php';

$email = $_SESSION['email'];

?>
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <section class="ftco-login ftco-section testimony-section bg-light">
      <div class="container">
        <div id="accomplishTime"></div>
        <div class="container-quiz">
          <div class="quiz-container">
            <!-- <form id="quiz_submit">
              <div id="quiz_data"></div>
            </form> -->
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
$query = "SELECT `name`, `district`, `school_name` from `model_students` WHERE `email` = '$email'";

$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {?>



              <h3 class="profile-info"><strong>নাম:</strong><?php echo $row['name']; ?></h3>
              <h4 class="profile-info"><strong>স্কুলের নাম:</strong> <?php echo $row['school_name']; ?></h4>

  <h4 class="profile-info"><strong>জেলা:</strong> <?php echo $row['district']; ?></h4>

  <?php }?>

  <div class="logout-btn-container">
            <a href="logout.php" class="profile-logout-btn">লগ আউট</a>
            </div>


              </div>
              <div class="quiz-play-information">

              <form action="exam.php" method="POST" name="subject_selection">

                <div class="exam-selection-container">
                  <h3>এসএসসি মডেল টেস্ট ২০২২</h3>

                 <?php // echo "<pre>";
// print_r($exam_list);
?>



                  <?php

$science_subjects = $exam_list['ssc'][0]['science']['subjects'];
$arts_subjects = $exam_list['ssc'][1]['arts']['subjects'];
$commerce_subjects = $exam_list['ssc'][2]['commerce']['subjects'];

?>

                  <?php

// echo "RPounak";

// echo "<pre>";

// // print_r($exam_list);

// print_r($exam_list['ssc']['science']['subject'][1]['test'][1]['id']);
?>

                  <?php

?>



                  <select name="group" id="group">
                      <option value="">বিভাগ</option>
                      <option value="science">বিজ্ঞান</option>
                      <option value="arts">মানবিক</option>
                      <option value="commerce">ব্যবসায়</option>
                    </select>

                    <select name="science_subject" class="subject_box" id="science_subject">
                      <option value="">বিষয়</option>

                       <?php

foreach ($science_subjects as $science_subject) {?>
                 <option value="<?php echo ($science_subject['name']) ?>"> <?php echo ($science_subject['name']) ?> </option>

                      <?php }?>

                    </select>


                  <!-- Start Arts Subject Loading  -->
                    <select name="arts_subject" class="subject_box" id="arts_subject">
                      <option value="">বিষয়</option>
                      <?php

foreach ($arts_subjects as $arts_subject) {?>
                 <option value="<?php echo ($arts_subject['name']) ?>"> <?php echo ($arts_subject['name']) ?> </option>

                      <?php }?>
                    </select>

                    <!-- End Arts Subject Loading  -->

                    <!-- Start Commerce Subject Loading  -->

                    <select name="commerce_subject" class="subject_box" id="commerce_subject">
                      <option value="">বিষয়</option>
                      <?php

foreach ($commerce_subjects as $commerce_subject) {?>
                 <option value="<?php echo ($commerce_subject['name']) ?>"> <?php echo ($commerce_subject['name']) ?> </option>

                      <?php }?>
                    </select>

                    <!-- End Commerce Subject Loading  -->



                    <select name="test_number[]" class="model_test_no" id="ban_p1">
                      <option value="" disabled>মডেল টেস্ট নাম্বার</option>

                      <?php
$bangla_p1 = $exam_list['ssc'][0]['science']['subjects'][0]['test'];

for ($i = 0; $i < count($bangla_p1); $i++) {?>
  <option value="<?php echo $bangla_p1[$i]['id']; ?>"><?php echo $bangla_p1[$i]['test_name']; ?></option>
<?php }

?>

                    </select>

                    <select name="test_number[]" class="model_test_no" id="agri">
                      <option value="">মডেল টেস্ট নাম্বার</option>
                      <?php
$bangla_p2 = $exam_list['ssc'][0]['science']['subjects'][1]['test'];

for ($i = 0; $i < count($bangla_p2); $i++) {?>
  <option value="<?php echo $bangla_p2[$i]['id']; ?>"><?php echo $bangla_p2[$i]['test_name']; ?></option>
<?php }

?>

                    </select>

                    <select name="test_number[]" class="model_test_no" id="physics">
                      <option value="">মডেল টেস্ট নাম্বার</option>
                      <?php
$agri = $exam_list['ssc'][0]['science']['subjects'][2]['test'];

for ($i = 0; $i < count($agri); $i++) {?>
  <option value="<?php echo $agri[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
<?php }

?>


                    </select>

                    <select name="test_number[]" class="model_test_no" id="biology">
                      <option value="">মডেল টেস্ট নাম্বার</option>
                      <?php
$biology = $exam_list['ssc'][0]['science']['subjects'][3]['test'];

for ($i = 0; $i < count($biology); $i++) {?>
  <option value="<?php echo $biology[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
<?php }

?>

                    </select>

                    <select name="test_number[]" class="model_test_no" id="bangladesh_history">
                      <option value="">মডেল টেস্ট নাম্বার</option>
                      <?php
$bangladesh_history = $exam_list['ssc'][1]['arts']['subjects'][2]['test'];

for ($i = 0; $i < count($bangladesh_history); $i++) {?>
  <option value="<?php echo $bangladesh_history[$i]['id']; ?>"><?php echo $bangladesh_history[$i]['test_name']; ?></option>
<?php }

?>

                    </select>



                    <select name="test_number[]" class="model_test_no" id="accounting">
                      <option value="">মডেল টেস্ট নাম্বার</option>

                      <?php
$accounting = $exam_list['ssc'][2]['commerce']['subjects'][2]['test'];

for ($i = 0; $i < count($accounting); $i++) {?>
  <option value="<?php echo $accounting[$i]['id']; ?>"><?php echo $accounting[$i]['test_name']; ?></option>
<?php }

?>

                    </select>

                    <select name="test_number[]" class="model_test_no" id="finance">
                      <option value="">মডেল টেস্ট নাম্বার</option>

                      <?php
$finance = $exam_list['ssc'][2]['commerce']['subjects'][3]['test'];

for ($i = 0; $i < count($finance); $i++) {?>
  <option value="<?php echo $finance[$i]['id']; ?>"><?php echo $finance[$i]['test_name']; ?></option>
<?php }

?>

                    </select>
                    </div>

                    <div class="start-exam-from-dashboard">
                  <div
                    class="btn btn-primary px-4 py-3"> <input type="submit" value="কুইজ শুরু করুন"  id="start_exam_container" name="subject_selection" />

                  </div>

                </div>


                  </form>


            </div>
          </div>
        </div>
      </div>
    </section>

    <script>

$(document).ready(function() {
  $(".subject_box, .model_test_no").hide();
  // $("#science_subject").show();


	$("#group").change(function() {

		// var selectedVal = $("#myselect option:selected").text();
		var selectedGroup = $("#group option:selected").val();
		if (selectedGroup == 'science'){
      $(".subject_box").hide();
      $("#science_subject").show();
    }
    if (selectedGroup == 'arts'){
      $(".subject_box").hide();
      $("#arts_subject").show();
    }

    if (selectedGroup == 'commerce'){
      $(".subject_box").hide();
      $("#commerce_subject").show();
    }

	});

// Start Science Subjects
$("#science_subject").change(function() {
  var selectedSubject = $("#science_subject option:selected").val();

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#agri, #physics, #biology").hide();
    $("#ban_p1").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #physics, #biology").hide();
    $("#agri").show();
  }
  if (selectedSubject == 'পদার্থবিজ্ঞান'){
    $("#ban_p1, #agri, #biology").hide();
    $("#physics").show();
  }

  if (selectedSubject == 'জীববিজ্ঞান'){
    $("#ban_p1, #agri, #physics").hide();
    $("#biology").show();
  }


});

// End Science Subjects

$("#arts_subject").change(function() {
  var selectedSubject = $("#arts_subject option:selected").val();

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#agri, #bangladesh_history").hide();
    $("#ban_p1").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #bangladesh_history").hide();
    $("#agri").show();
  }

  if (selectedSubject == 'বাংলাদেশের ইতিহাস ও বিশ্বসভ্যতা'){
    $("#ban_p1, #agri").hide();
    $("#bangladesh_history").show();
  }



});

$("#commerce_subject").change(function() {
  var selectedSubject = $("#commerce_subject option:selected").val();

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#agri, #accounting, #finance").hide();
    $("#ban_p1").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #accounting, #finance").hide();
    $("#agri").show();
  }


  if (selectedSubject == 'হিসাববিজ্ঞান'){
    $("#ban_p1, #agri, #finance").hide();
    $("#accounting").show();
  }

  if (selectedSubject == 'ফিন্যান্স ও ব্যাংকিং'){
    $("#ban_p1, #agri, #accounting").hide();
    $("#finance").show();
  }



});


});






</script>

    <?php include 'footer.php';?>


