<?php
session_start();
date_default_timezone_set('Asia/Dhaka');
require 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--====== Title ======-->
    <title><?=$site_title?></title>

    <link rel="icon" type="image/png" href="./favicon.png" />

    <!-- Primary Meta Tags -->
    <meta name="title" content="মডেল টেস্ট - প্রথম আলো" />
    <meta name="description" content="যদি দাও মডেল টেস্ট, পরীক্ষা তোমার হবে বেস্ট" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta
      property="og:url"
      content="https://service.prothomalo.com/modeltest/"
    />
    <meta property="og:title" content="মডেল টেস্ট - প্রথম আলো" />
    <meta
      property="og:description"
      content='যদি দাও মডেল টেস্ট, পরীক্ষা তোমার হবে বেস্ট'
    />
    <meta property="og:image" content="assets/img/og-image-model-test-3.png" />

    <!-- Twitter -->
    <meta
      property="twitter:url"
      content="https://service.prothomalo.com/modeltest"
    />
    <meta property="twitter:title" content="মডেল টেস্ট - প্রথম আলো" />
    <meta
      property="twitter:description"
      content='যদি দাও মডেল টেস্ট, পরীক্ষা তোমার হবে বেস্ট'
    />
    <meta property="twitter:image" content="assets/img/og-image-model-test-3.png" />

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/backtotop.css">
    <link rel="stylesheet" href="assets/css/font-awesome-pro.css">
    <link rel="stylesheet" href="assets/css/spacing.css">
    <link rel="stylesheet" href="assets/css/style.css?v=2.0">

    <!-- JS here -->

    <script src="assets/js/vendor/jquery.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-11355905-12"></script>
    <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'UA-11355905-12');
    </script>
    <script>
     window.dataLayer = window.dataLayer || [];
     function gtag(){dataLayer.push(arguments);}
     gtag('js', new Date());

     gtag('config', 'UA-11355905-1');
    </script>

  </head>
  <body>

    <!-- pre loader area start -->
     <!--  <div id="loading">
         <div id="loading-center">
            <div id="loading-center-absolute">
               <svg id="loader">
                  <path id="corners" d="m 0 12.5 l 0 -12.5 l 50 0 l 0 50 l -50 0 l 0 -37.5"></path>
               </svg>
               <img src="assets/img/favicon.png" alt="">
            </div>
         </div>
      </div> -->
      <!-- pre loader area end -->

      <!-- back to top start -->
      <!-- <div class="progress-wrap">
         <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
         </svg>
      </div> -->
      <!-- back to top end -->

      <!-- header area start -->
      <header>
         <div id="header-sticky" class="header__area header__transparent">
            <div class="header__bottom">
               <div class="container">
                  <div class="row align-items-center">
                     <div class="col-xxl-8 col-xl-9 col-lg-10 col-md-6 col-6">
                        <div class="header__bottom-left d-flex align-items-center">
                           <div class="logo">
                              <a href="<?php echo isset($_SESSION['logged_session']) ? 'dashboard' : $site_link ?>">
                                 <img class="exam-running" src="assets/img/porasona.svg" alt="logo">
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-xxl-4 col-xl-3 col-lg-2 col-md-6 col-6">
                        <div class="header__bottom-right d-flex justify-content-end align-items-center pl-30">

                            <div class="logo">
                              <a target="_blank" href="https://www.prothomalo.com/">
                                 <img src="assets/img/palo.svg" alt="logo">
                              </a>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- header area end -->
