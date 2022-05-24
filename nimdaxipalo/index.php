<?php
session_start();
error_reporting(1);

$msg = [];

if (isset($_POST['login'])) {

    if (empty($_POST["username"])) {
        array_push($msg, "আপনার ইমেইল লিখুন");
    } else {
        $username = $_POST["username"];
    }

    if (empty($_POST["password"]) || strlen($_POST["password"]) < 3) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $password = $_POST["password"];
    }

    if ($username == 'test' && $password == 'password@1') {

        $_SESSION['logged_session'] = true;

        header('Location:home.php');

        // echo "<script type='text/javascript'>window.top.location='https://service.prothomalo.com/mpaward/awards.php';</script>";exit;

    } else {

        $_SESSION['alert'] = "আপনার ইমেইল অথবা পাসওয়ার্ড সঠিক নয়";
    }

}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--====== Title ======-->
    <title>Quiz Admin Panel</title>

    <link rel="stylesheet" href="./assets/css/main.css" />
  </head>
  <body>
    <div class="login-container">
      <div class="title">Login</div>
      <form action="" method="POST">
      <div class="input-container">
        <input
          type="text"
          name="username"
          value=""
          id="username"
          placeholder="Username"
          required="required"
        />
      </div>
      <div class="input-container">
        <input
          type="password"
          name="password"
          value=""
          id="password"
          placeholder="Password"
          required="required"
        />
      </div>
      <div class="input-container">
        <button id="login-button" name="login">Login</button>
      </div>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  </body>
</html>
