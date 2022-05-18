<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--====== Title ======-->
    <title>Quiz Admin Panel</title>

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css"
      rel="stylesheet"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <link rel="stylesheet" href="./assets/css/main.css" />
  </head>
  <body>
    <?php require '../settings.php';?>
    <div class="header-container">
      <div class="container">
        <div class="logo-container">Prothom alo Quiz</div>
        <div class="logout_container">
          <a href="participants.php">All participants</a>
          <a href="quiz.php">All quiz</a>
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </div>
