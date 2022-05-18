
<?php

require 'connection.php';

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT `email` FROM `quiz_users` WHERE `token` = '$token'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $query = "UPDATE `quiz_users` SET  `status`='1', `token` = '' WHERE `token`='$token'";
        $result = mysqli_query($conn, $query);

        if ($result) {

            $_SESSION['email'] = $email;
            $_SESSION['message'] = "আপনার ই-মেইলটি সফলভাবে ভেরিফাই করা হয়েছে";
            header('Location: login.php');
        }

    } else {
        echo "No records found";
    }

} else {
    echo " Token not found";
}
