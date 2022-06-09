<?php
session_start();
error_reporting(0);
$site_title = "লগইন :: মডেল টেস্ট - প্রথম আলো";
require 'connection.php';
require 'header-v2.php';
$email = $pass = "";

$msg = [];

if (isset($_POST['login'])) {

    if (empty($_POST["email"])) {
        array_push($msg, "তোমার ইমেইল লিখো");
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["pass"]) || strlen($_POST["pass"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $pass = md5(test_input($_POST["pass"]));
    }

    $sql = "SELECT `email`, `password` FROM `model_students` WHERE `email` = '$email' AND `password` = '$pass' and `status` = 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $_SESSION['logged_session'] = true;
        $_SESSION['email'] = $email;

        header('Location:dashboard');

        echo "<script type='text/javascript'>window.top.location='dashboard';</script>";exit;

    } else {

        $_SESSION['alert'] = "তোমার ইমেইল অথবা পাসওয়ার্ড সঠিক নয়";

    }

}

?>


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
                                 <h5>ইমেইল</h5>
                                 <div class="sign__input">
                                    <input type="email" name="email" placeholder="ইমেইল" required>
                                    <i class="fal fa-envelope"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <h5>পাসওয়ার্ড</h5>
                                 <div class="sign__input">
                                    <input type="password" name="pass" placeholder="পাসওয়ার্ড" required>
                                    <i class="fal fa-lock"></i>
                                 </div>
                              </div>
                              <div class="sign__action d-sm-flex justify-content-between mb-30">
                                 <div class="sign__forgot">
                                    <a href="forget_password">পাসওয়ার্ড ভুলে গিয়েছো?</a>
                                 </div>
                              </div>
                              <button name="login" class="tp-btn  w-100"> <span></span> লগইন</button>
                              <div class="sign__new text-center mt-20">
                                 <p>নিবন্ধন করতে <a href="register">ক্লিক করো</a></p>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- sign up area end -->


      </main>


<?php require 'footer-v3.php';?>