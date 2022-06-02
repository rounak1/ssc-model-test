<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}

error_reporting(1);
require 'connection.php';
require 'admin-header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "UPDATE `model_questions` SET `status`= '0' WHERE `id` = '$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        header('Location: quiz.php');
    }
} else {
    header('Location: quiz.php');
}

?>



    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script> -->


    <!-- <script src="./assets/js/main.js"></script> -->
  </body>
</html>
