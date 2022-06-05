<?php
session_start();
error_reporting(1);
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
require 'connection.php';
require '../settings.php';
// require 'admin-header.php';
require 'header-v2.php';
$todays_date = date('Y-m-d');

?>

<div class="container">
    <div class="quiz-container">

    <?php
$sql = 'select count(distinct `user_id`) from quiz_histories';
$res = mysqli_query($conn, $sql);

foreach ($res as $total_prtcpnts) {
    $total_participants = $total_prtcpnts['count(distinct `user_id`)'];
}

?>

<div class="quiz-header">

<div class="search-panel">
            <form action="" method="POST">

            <select name="specific_questions" id="" class="all_quiz">
            <?php

foreach ($model_test_list as $key => $value) {?>


    ?>
  <option value="<?php echo $value['id']; ?>" <?=$value['id'] == $_POST['specific_questions'] ? 'selected' : ''?> >
  <?php echo $value['subject'] . ' ' . $value['test']; ?>
</option>
<?php }

?>

            </select>
            <input
              id="submit_search"
              type="submit"
              name="search"
              value="Search"
            />
            </form>
          </div>

          <h4>Total Participants: <?=$total_participants;?> </h4>

</div>


      <section>



      <?php
if (isset($_POST['search'])) {

    $exam_id = $_POST['specific_questions'];

    $sql = "select (count(exam_id)) from quiz_histories WHERE `exam_id` = '$exam_id'";

    $res = mysqli_query($conn, $sql);

    foreach ($res as $prtcpnt_each) {
        $participants_each_exam = $prtcpnt_each['(count(exam_id))'];
    }?>

  <h2 class="participants_text">Test Given by <?=$participants_each_exam;?> Participants</h2>


<div class="table-content table-responsive">
<table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Total Marks</th>
                <th>Time Taken(S)</th>
              </tr>
            </thead>
            <tbody class="participants-information-body-1">
                <?php
$query = "SELECT model_students.name, model_students.phone, quiz_histories.total_marks, quiz_histories.completion_time, quiz_histories.created_at FROM `model_students` INNER JOIN `quiz_histories` on model_students.id = quiz_histories.user_id where quiz_histories.exam_id = '$exam_id'  ORDER BY `total_marks` DESC, completion_time ASC LIMIT 200";

    $result = mysqli_query($conn, $query);
    $i = 1;

    foreach ($result as $row) {?>

    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['total_marks']; ?></td>
        <td><?php echo gmdate("H:i:s", $row['completion_time']); ?></td>

    </tr>

<?php }
    ?>
            </tbody>
          </table>
    </div>

<?php } else {

    $sql = 'select (count(exam_id)) from quiz_histories WHERE `exam_id` = "ssc_ban1_t001"';
    $res = mysqli_query($conn, $sql);

    foreach ($res as $prtcpnt_each) {
        $participants_each_exam = $prtcpnt_each['(count(exam_id))'];
    }?>

  <h2 class="participants_text">Test Given by <?=$participants_each_exam;?> Participants</h2>
    <div class="table-content table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Total Marks</th>
                <th>Time Taken(S)</th>
              </tr>
            </thead>
            <tbody class="participants-information-body-1">
                <?php
$query = "SELECT model_students.name, model_students.phone, quiz_histories.total_marks, quiz_histories.completion_time, quiz_histories.created_at FROM `model_students` INNER JOIN `quiz_histories` on model_students.id = quiz_histories.user_id where quiz_histories.exam_id = 'ssc_ban1_t001' ORDER BY `total_marks` DESC, completion_time ASC LIMIT 200";

    $result = mysqli_query($conn, $query);
    $i = 1;

    foreach ($result as $row) {?>

    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['total_marks']; ?></td>
        <td><?php echo gmdate("H:i:s", $row['completion_time']); ?></td>

    </tr>

<?php }
    ?>
            </tbody>
          </table>
    </div>
      <?php }
?>



<div id="all_participants" class="tabcontent">

</div>



      </section>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <?php require 'footer-v2.php';?>
