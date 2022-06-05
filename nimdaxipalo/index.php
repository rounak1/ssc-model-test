
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

        header('Location:dashboard.php');

        echo "<script type='text/javascript'>window.top.location='dashboard.php';</script>";exit;

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

    <title>এসএসসি মডেল টেস্ট ২০২২</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/font-awesome-pro.css">
    <link rel="stylesheet" href="assets/css/spacing.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <script src="assets/js/vendor/jquery.js"></script>

    <body>

    <!-- <?php // require 'header-v2.php';?> -->

      <main>

         <!-- sign up area start -->
         <section class="signup__area p-relative z-index-1 pt-100 pb-145">
            <div class="sign__shape">
               <img class="man-1" src="assets/img/icon/sign/man-1.png" alt="">
               <img class="man-2" src="assets/img/icon/sign/man-2.png" alt="">
               <img class="circle" src="assets/img/icon/sign/circle.png" alt="">
               <img class="zigzag" src="assets/img/icon/sign/zigzag.png" alt="">
               <img class="dot" src="assets/img/icon/sign/dot.png" alt="">
               <img class="bg" src="assets/img/icon/sign/sign-up.png" alt="">
            </div>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                     <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">লগইন</h2>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="sign__wrapper white-bg">
                        <?php
if (isset($_SESSION['success'])) {?>
                                  <div class="col-md-12 message-container">
                                    <div class="alert alert-success" role="alert">
                              <?php echo $_SESSION['success']; ?>
                            </div>
                                    </div>
                            <?php unset($_SESSION['success']);}

if (isset($_SESSION['alert'])) {?>
                              <div class="col-md-12 message-container">
                                    <div class="alert alert-warning" role="alert">

                                <?php
echo $_SESSION['alert'];

    unset($_SESSION['alert']); ?>
                            </div>
                                    </div>
                            <?php }
?>
                        <div class="sign__form">
                           <form id="login_form_submit" name="login" action="" method="POST">
                              <div class="sign__input-wrapper mb-25">
                                 <h5>Username</h5>
                                 <div class="sign__input">
                                    <input type="text" name="username" placeholder="Username" required>
                                    <i class="fal fa-user"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <h5>Password</h5>
                                 <div class="sign__input">
                                    <input type="password" name="password" placeholder="Password" required>
                                    <i class="fal fa-lock"></i>
                                 </div>
                              </div>
                              <button name="login" class="tp-btn  w-100"> <span></span> লগইন</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>

      </main>

      <script src="assets/js/bootstrap-bundle.js"></script>

      <?php require 'footer-v2.php';?>

    </body>
  </head>
</html>
