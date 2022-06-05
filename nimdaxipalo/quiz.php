<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}

error_reporting(1);
require 'connection.php';
require '../settings.php';
// require 'admin-header.php';
require 'header-v2.php';

require '../settings.php';
?>
    <div class="container">
      <div class="quiz-container">
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

          <a href="quiz-add.php" class="addQuiz">Add Question</a>
        </div>
        <div class="quiz-data table-content table-responsive">


          <?php
if (isset($_POST['search'])) {

    $exam_id = $_POST['specific_questions'];
    ?>

<table class="table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <!-- <td style="width: 96px ;">Actions</td> -->
              </tr>
              </thead>

              <tbody id="contentData">

              <?php

    $query = "SELECT `id`, `exam_id`, `uddipok_statement`,`uddipok`, `questions`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_date` FROM `model_questions`   WHERE `status` = '1' and `exam_id` = '$exam_id'";

    $result = mysqli_query($conn, $query);

    foreach ($result as $row) {?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['exam_date']; ?></td>

    <td><?php echo $row['uddipok_statement'] . "<br/>" . $row['uddipok'] . "<br/>" . $row['questions']; ?></td>
    <td><?php echo $row['answer']; ?></td>
    <td><?php echo $row['option1']; ?></td>
    <td><?php echo $row['option2']; ?></td>
    <td><?php echo $row['option3']; ?></td>
    <td><?php echo $row['option4']; ?></td>
    <td><a href="quiz-edit.php?id=<?php echo $row['id']; ?>">Edit</a> | <a href="quiz-delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm(`Are you sure?`)">Delete</a></td>
</tr>

<?php }?>

</tbody>



          </table>

<?php } else {?>


          <table class="table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Question</th>
                <th>Answer</th>
                <th>Option 1</th>
                <th>Option 2</th>
                <th>Option 3</th>
                <th>Option 4</th>
                <th style="width: 96px ;">Actions</th>
              </tr>
              </thead>

              <tbody id="contentData">

              <?php

    $query = "SELECT `id`, `exam_id`, `uddipok_statement`,`uddipok`, `questions`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_date` FROM `model_questions`   WHERE `status` = '1' and `exam_id` = 'ssc_ban1_t001'";

    $result = mysqli_query($conn, $query);

    foreach ($result as $row) {?>

<tr>

    <td><?php echo $row['exam_date']; ?></td>

    <td>
      <?=(!empty($row['uddipok_statement'])) ? $row['uddipok_statement'] . "<br/><br/>" : ""?>
      <?=(!empty($row['uddipok'])) ? $row['uddipok'] . "<br/><br/>" : ''?>
      <?=$row['questions'];?>
    </td>
    <td><?php echo $row['answer']; ?></td>
    <td><?=$row['option1'];?></td>
    <td><?php echo $row['option2']; ?></td>
    <td><?php echo $row['option3']; ?></td>
    <td><?php echo $row['option4']; ?></td>
    <td><a href="quiz-edit.php?id=<?php echo $row['id']; ?>">Edit</a> | <a href="quiz-delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm(`Are you sure?`)">Delete</a></td>
</tr>

<?php }?>

</tbody>



          </table>
      <?php }
?>
        </div>
      </div>
    </div>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <!-- <script src="./assets/js/main.js?v=1.000"></script> -->
    <?php require 'footer-v2.php';?>