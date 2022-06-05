<?php

error_reporting(1);
require 'connection.php';
require '../settings.php';
// require 'admin-header.php';
require 'header-v2.php';

if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM  `model_questions` WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: quiz.php');
        echo "<script type='text/javascript'>window.top.location='quiz.php';</script>";exit;
    }
} else {
    header('Location: quiz.php');
    echo "<script type='text/javascript'>window.top.location='quiz.php';</script>";exit;
}

?>



    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script> -->


    <!-- <script src="./assets/js/main.js"></script> -->
    <?php require 'footer-v2.php';?>