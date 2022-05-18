<?php

session_start();
error_reporting(1);
require 'connection.php';
require 'header-home.php';

$email = $_SESSION['email'];

// print_r($_POST);
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

    $query1 = "SELECT `id` FROM `quiz_users` WHERE `email` = '$email'";

    $result1 = mysqli_query($conn, $query1);

    foreach ($result1 as $row1) {
        $user_id = $row1['id'];
    }

    $query2 = "INSERT INTO `quiz_histories`(`user_id`, `total_marks`, `wrong_answers`, `not_given_answers`, `quiz_date`) VALUES ('$user_id','$correct_answer', '$wrong_answer', '$not_given_answers', '22-05-11')";

    $result2 = mysqli_query($conn, $query2);

    if ($result2) {
        echo "<script> alert('Data Inserted')</script>";
    }

}
