<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}

error_reporting(1);
require 'connection.php';
require '../settings.php';
require '../BanglaConverter.php';
require 'header-v2.php';

require '../settings.php';
?>
    <div class="container">
      <div class="quiz-container">
        <div class="quiz-header">
        <div class="search-panel">
            <form action="" method="GET">

            <select name="specific_questions" id="" class="all_quiz">
            <?php

foreach ($model_test_list as $key => $value) {?>


    ?>
  <option value="<?php echo $value['id']; ?>" <?=$value['id'] == $_GET['specific_questions'] ? 'selected' : ''?> >
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
if (isset($_GET['search'])) {

    $exam_id = $_GET['specific_questions'];
    ?>

<table class="table">
            <thead>
              <tr>
                <th></th>
                <th>ডেট</th>
                <th>প্রশ্ন</th>
                <!-- <th>Answer</th> -->
                <th>অপশন ১</th>
                <th>অপশন ২</th>
                <th>অপশন ৩</th>
                <th>অপশন ৪</th>
                <!-- <td style="width: 96px ;">Actions</td> -->
              </tr>
              </thead>

              <tbody id="contentData">

              <?php

    $query = "SELECT `id`, `exam_id`, `uddipok_statement`,`uddipok`, `questions`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_date` FROM `model_questions`   WHERE `status` = '1' and `exam_id` = '$exam_id'";

    $result = mysqli_query($conn, $query);

    foreach ($result as $row) {
      $date = explode("-", $row['exam_date']);
?>

<tr>
    <td><?php echo BanglaConverter::en2bn($row['id']); ?></td>
    <td>
      <?=BanglaConverter::en2bn($date[2])?> <?=$monthsObj[$date[1]]?>
    </td>

    <td>
      <?php
        if(!empty($row['uddipok_statement'])) {
          echo $row['uddipok_statement'] . '<br/><br/>';
        }
        if(!empty($row['uddipok'])) {
          echo $row['uddipok'] . '<br/><br/>';
        }
        echo "<b>" . $row['questions'] . "</b>";
      ?>
    </td>
    <!-- <td><?php echo $row['answer']; ?></td> -->
    <td class="<?=$row['answer']=='option1'? 'option_answer':''?>"><?php echo $row['option1']; ?></td>
    <td class="<?=$row['answer']=='option2'? 'option_answer':''?>"><?php echo $row['option2']; ?></td>
    <td class="<?=$row['answer']=='option3'? 'option_answer':''?>"><?php echo $row['option3']; ?></td>
    <td class="<?=$row['answer']=='option4'? 'option_answer':''?>"><?php echo $row['option4']; ?></td>
    <td><a href="quiz-edit.php?id=<?php echo $row['id']; ?>">Edit</a> | <a href="quiz-delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm(`Are you sure?`)">Delete</a></td>
</tr>

<?php }?>

</tbody>



          </table>

<?php } else {?>


          <table class="table">
            <thead>
              <tr>
                <th></th>
                <th>ডেট</th>
                <th>প্রশ্ন</th>
                <!-- <th>Answer</th> -->
                <th>অপশন ১</th>
                <th>অপশন ২</th>
                <th>অপশন ৩</th>
                <th>অপশন ৪</th>
                <!-- <th style="width: 96px ;">Actions</th> -->
              </tr>
              </thead>

              <tbody id="contentData">

              <?php

    $query = "SELECT `id`, `exam_id`, `uddipok_statement`,`uddipok`, `questions`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_date` FROM `model_questions`   WHERE `status` = '1' and `exam_id` = 'ssc_ban1_t001'";

    $result = mysqli_query($conn, $query);

    foreach ($result as $row) {
      $date = explode("-", $row['exam_date']);
  ?>

<tr>
    <td><?php echo BanglaConverter::en2bn($row['id']); ?></td>
    <td>
      <?=BanglaConverter::en2bn($date[2])?> <?=$monthsObj[$date[1]]?>
    </td>

    <td>
      <?php
        if(!empty($row['uddipok_statement'])) {
          echo $row['uddipok_statement'] . '<br/><br/>';
        }
        if(!empty($row['uddipok'])) {
          echo $row['uddipok'] . '<br/><br/>';
        }
        echo "<b>" . $row['questions'] . "</b>";
      ?>
    </td>
    <!-- <td><?php echo $row['answer']; ?></td> -->
    <td class="<?=$row['answer']=='option1'? 'option_answer':''?>"><?=$row['option1'];?></td>
    <td class="<?=$row['answer']=='option2'? 'option_answer':''?>"><?php echo $row['option2']; ?></td>
    <td class="<?=$row['answer']=='option3'? 'option_answer':''?>"><?php echo $row['option3']; ?></td>
    <td class="<?=$row['answer']=='option4'? 'option_answer':''?>"><?php echo $row['option4']; ?></td>
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

    <style type="text/css">
      .quiz-data table tbody tr td {
        text-align: left;
      }
      .quiz-data table tbody tr td.option_answer {
        color: red;
        font-weight: bold;
      }
    </style>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <!-- <script src="./assets/js/main.js?v=1.000"></script> -->
    <?php require 'footer-v2.php';?>