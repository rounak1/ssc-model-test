<?php

session_start();
error_reporting(1);
require 'connection.php';
require 'check-login.php';
require 'header-home.php';

$email = $_SESSION['email'];

if (isset($_POST['question'])) {

    $correct_answer = 0;
    $wrong_answer = 0;
    $not_given_answers = 0;

    $length = count($_POST['question']);

    for ($i = 0; $i < $length; $i++) {
        $j = $_POST['question'][$i];

        if ($_POST['token'][$j] === base64_encode($_POST['option'][$j])) {

            $correct_answer += 1;

        } else {
            if (!empty($_POST['option'][$j])) {
                $wrong_answer += 1;
            }

        }

    }

    $not_given_answers = $length - ($correct_answer + $wrong_answer);

    // echo $wrong_answer . "<br>";

    // find user id from user email
    $query1 = "SELECT `id` FROM `model_students` WHERE `email` = '$email'";

    $result1 = mysqli_query($conn, $query1);
    $user_data = mysqli_fetch_assoc($result1);
    $user_id = $user_data['id'];

    // json object encode
    $all_question_answer_list = json_encode($_POST);

    // get exam date
    $quiz_date = $_POST['quiz_date'];

    // get exam id
    $exam_id = $_POST['exam_id'];

    // get exam attend time
    $examAttendentTime = time() - $_POST['examAttendentTime'];
    
    $query2 = "INSERT INTO `quiz_histories`(`user_id`, `total_marks`, `wrong_answers`, `not_given_answers`, `quiz_date`, `exam_list`, `completion_time`, `exam_id`) VALUES ('$user_id','$correct_answer', '$wrong_answer', '$not_given_answers', '$quiz_date', '$all_question_answer_list','$examAttendentTime', '$exam_id')";

    $result2 = mysqli_query($conn, $query2);

    if ($result2) {
        $last_id = mysqli_insert_id($conn);
        header("Location: result.php?id=".$last_id);
        exit();
        echo "<script> alert('Data Inserted')</script>";
    } else {
        echo "Error: " . $query2 . "<br>" . mysqli_error($conn);
    }

} else {
    echo 'no data';
}
