<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--====== Title ======-->
    <title>লগইন | জিততে হলে, পড়তে হবে</title>

    <!-- <link
      rel="stylesheet"
      href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
    /> -->

    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css"
      rel="stylesheet"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>



    <link rel="stylesheet" href="css/style.css?v=4.3" />

    <link rel="stylesheet" href="./assets/css/main.css?v=4.3" />

    <link rel="icon" type="image/png" sizes="32x32" href="favicon.png" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-11355905-12"
    ></script> -->
    <!-- <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag("js", new Date());

      gtag("config", "UA-11355905-12");
    </script> -->
  </head>
  <body>
    <nav
      class="navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
      id="ftco-navbar"
    >
      <div class="container">
        <div id="logo"><a class="navbar-brand" href="index.html"><img src="logo.svg?v=3" class="logo"></a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation"><span class="oi oi-menu"></span> মেনু</button></div>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <?php
if ((isset($_SESSION['logged_in']) === 'true')) {
    echo '<ul class="navbar-nav ml-auto"><li class="nav-item active"><a class="nav-link" href="index.html">হোমপেজ</a></li><li class="nav-item active"><a class="nav-link" href="leaderboard.html">লিডারবোর্ড</a></li><li class="nav-item active"><a class="nav-link" href="faq.html">ব্যবহারবিধি</a></li><li class="nav-item active"><a class="nav-link" href="myprofile.html">প্রোফাইল</a></li><li class="nav-item cta"><a class="nav-link" href="logout"><span>লগ আউট</span></a></li></ul>';
} else {
    echo '<ul class="navbar-nav ml-auto"><li class="nav-item active"><a class="nav-link" href="index.html">হোমপেজ</a></li><li class="nav-item active"><a class="nav-link" href="leaderboard.html">লিডারবোর্ড</a></li><li class="nav-item active"><a class="nav-link" href="faq.html">ব্যবহারবিধি</a></li><li class="nav-item cta"><a class="nav-link" href="login"><span>লগইন</span></a></li></ul>';
}
?>
        </div>
      </div>
    </nav>
    <!-- END nav -->
