<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-home.php';

include_once 'settings1.php';

$email = $_SESSION['email'];

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

                <div class="exam-selection-container">
                  <h3>এসএসসি মডেল টেস্ট ২০২২</h3>

                  <?php

// echo "RPounak";

// echo "<pre>";

// // print_r($exam_list);

// print_r($exam_list['ssc']['science']['subject'][1]['test'][1]['id']);
?>

                  <?php

function superUnique($array, $key)
{

    foreach ($array as $arr) {
        if ($arr['group'] === $key) {

            for ($k = 1; $k < count($arr); $k++) {

                $temp_array = [];
                foreach ($arr as &$v) {
                    if (!isset($temp_array[$v['subject']])) {
                        $temp_array[$v['subject']] = &$v;
                    }

                }
                $array1 = array_values($temp_array);
                return $array1;

            }
            // echo "<pre>";
            // print_r($arr);

            // $temp_array = [];
            // foreach ($array as &$v) {
            //     if (!isset($temp_array[$v[$key]])) {
            //         $temp_array[$v[$key]] = &$v;
            //     }

            // }
            // $array = array_values($temp_array);
            // return $array;

        }
    }

}

$uniqueField = superUnique($exam_list, 'science');

?>

                  <form action="" method="POST">
                    <select name="group" id="group">
                      <option value="">বিভাগ</option>
                      <option value="science">বিজ্ঞান</option>
                      <option value="arts">মানবিক</option>
                      <option value="commerce">ব্যবসায়</option>
                    </select>

                    <select name="science_subject" id="science_subject">
                      <option value="">বিষয়</option>

                      <!-- <?php
// $uniqueField = superUnique($exam_list, 'subject');

// foreach ($uniqueField as $unnn) {?>
//    <option value=""> <?php // echo $unnn['subject']; ?> </option>
// <?php //}
?> -->

                    </select>



                    <select name="arts_subject" id="arts_subject">
                      <option value="">বিষয়</option>


                    </select>

                    <select name="commerce_subject" id="commerce_subject">
                      <option value="">বিষয়</option>
                    </select>

                    <select name="test_number" id="test_number">
                      <option value="">মডেল টেস্ট নাম্বার</option>


                    </select>
                  </form>





              </div>
              <div class="start-exam-from-dashboard">
                  <div
                    class="btn btn-primary px-4 py-3"
                    id="start_exam_container"
                  > <a href="exam.php">
                    কুইজ শুরু করুন</a>
                  </div>

                </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>



$('#group').change(function () {
var select=$(this).find(':selected').val();

console.log(select);

	    })

</script>

    <?php include 'footer.php';?>


