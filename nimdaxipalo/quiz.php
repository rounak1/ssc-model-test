<?php
error_reporting(1);
require 'connection.php';
require 'admin-header.php';
require '../settings.php';
?>
    <div class="container">
      <div class="quiz-container">
        <div class="quiz-header">
          <a href="quiz-add.php" class="addQuiz">Add Quiz</a>
        </div>
        <div class="quiz-data">
          <div class="search-panel">
            <input
              type="text"
              name="search_by_date"
              id="search_by_date"
              value=""
            />
            <input
              id="submit_search"
              type="submit"
              name="search"
              value="Search"
            />
          </div>
          <table>
            <thead>
              <tr>
                <td>Quiz Date</td>
                <td>subjects</td>
                <td>Question</td>
                <td>Answer</td>
                <td>Option 1</td>
                <td>Option 2</td>
                <td>Option 3</td>
                <td>Option 4</td>
                <td style="width: 96px ;">Actions</td>
              </tr>
              </thead>

              <tbody id="contentData">

              <?php

$query = "SELECT `id`, `exam_id`, `questions`, `option1`, `option2`, `option3`, `option4`, `answer`, `exam_date` FROM `model_questions`   WHERE `status` = '1'";

$result = mysqli_query($conn, $query);

foreach ($result as $row) {?>

<tr>
    <td><?php echo $row['exam_date']; ?></td>
    <td><?php

    echo $subject_display = $model_test_list[$row['exam_id']]['subject'] . '-' . $model_test_list[$row['exam_id']]['test'];

    ?></td>
    <td><?php echo $row['questions']; ?></td>
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
        </div>
      </div>
    </div>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
    <!-- <script src="./assets/js/main.js?v=1.000"></script> -->
  </body>
</html>
