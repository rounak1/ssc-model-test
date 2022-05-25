<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--====== Title ======-->
    <title>এসএসসি মডেল টেস্ট ২০২২</title>

    <!-- Primary Meta Tags -->
    <meta name="title" content="এসএসসি মডেল টেস্ট ২০২২" />
    <meta name="description" content="এসএসসি মডেল টেস্ট ২০২২" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta
      property="og:url"
      content="https://www.prothomalo.com/event/quiz/index.html"
    />
    <meta property="og:title" content="এসএসসি মডেল টেস্ট ২০২২" />
    <meta
      property="og:description"
      content='এসএসসি মডেল টেস্ট ২০২২'
    />
    <meta property="og:image" content="assets/images/ogImage.png" />

    <!-- Twitter -->
    <meta
      property="twitter:url"
      content="https://www.prothomalo.com/event/quiz/index.html"
    />
    <meta property="twitter:title" content="এসএসসি মডেল টেস্ট ২০২২" />
    <meta
      property="twitter:description"
      content='এসএসসি মডেল টেস্ট ২০২২'
    />
    <meta property="twitter:image" content="assets/images/ogImage.png" />



    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">

    <!-- <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css"> -->
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">


    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css?v=5.4">

    <link rel="stylesheet" href="./assets/css/main.css?v=5.6" />

    <link rel="icon" type="image/png" sizes="32x32" href="favicon.png">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11355905-12"></script>
    <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'UA-11355905-12');
    </script> -->

  </head>
  <body>

<div class="container-fluid header-logo-container">
  <div class="container">
    <div class="row">
      <div class=" col-6">
      <div class="logo">
        <a class="navbar-brand exam-running" href="<?php echo isset($_SESSION['logged_session']) ? 'myprofile.php' : 'index.php' ?>"><img src="./images/logo.svg" class="logo" height="40"></a>
      </div>
      </div>
      <div class=" col-6">
      <div class="logo">
        <a href="https://www.prothomalo.com/" class="navbar-brand float-right exam-running" target="_blank"><img src="https://assets.prothomalo.com/prothomalo/assets/palo-bangla-bb996cdb70d2e0ccec8c.svg" class="logo exam-running" width="260" height="46"></a>
      </div>
      </div>

    </div>

  </div>
</div>



  <!-- <div id="accomplishTime"></div> -->
  <!-- <div class="container">
    <div class="quiz-container">
      <form id="quiz_submit">
        <div id="quiz_data"></div>
      </form>
    </div>
  </div> -->
