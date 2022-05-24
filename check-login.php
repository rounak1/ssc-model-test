<?php
session_start();
require 'connection.php';

$email = $_SESSION['email'];

$query_user_data = "SELECT * FROM `model_students` WHERE `email` = '$email'";

$result_user_data = mysqli_query($conn, $query_user_data);
$user_data = mysqli_fetch_assoc($result_user_data);

$user_id = $user_data['id'];

if (empty($email)) {
    header("Location: login.php");
    exit();
}
