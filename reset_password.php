<?php
session_start();
$msg = [];
$user_email = "";
error_reporting(1);
$site_title = "রিসেট পাসওয়ার্ড :: এসএসসি মডেল টেস্ট ২০২২";
require 'connection.php';
require 'header-v2.php';

if (isset($_POST['reset_password'])) {


    $email = $_POST['email'];

    if (empty($_POST["pass"]) || strlen($_POST["pass"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $pass = md5(test_input($_POST["pass"]));
    }

    if (empty($_POST["retype_password"]) || strlen($_POST["retype_password"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $retype_password = md5(test_input($_POST["retype_password"]));
    }

    if ($pass != $retype_password) {

        array_push($msg, "পাসওয়ার্ড ম্যাচ করে নাই। আবার চেষ্টা করুন ");
    } else {

        $query = "UPDATE `model_students` SET  `password`='$pass', `token` = '' WHERE `email`='$email'";
        $result = mysqli_query($conn, $query);
       
        if ($result) { 
            $_SESSION['success'] = "আপনার নতুন পাসওয়ার্ডটি সেট করা হয়েছে";
            echo "<script type='text/javascript'>window.top.location='login';</script>";exit;
        }

    } //code if password match and form submit

} // if new password set and form submit

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT `email` FROM `model_students` WHERE `token` = '$token'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $res) {
            $user_email = $res['email'];
        }
    }


    ?>

     <main>
     	<section class="signup__area p-relative z-index-1 pt-150 pb-145">
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
                        <h2 class="section__title">রিসেট পাসওয়ার্ড</h2>
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
	                          <?php 
	                            unset($_SESSION['success']);
	                            }
	                          ?>

							<div class="sign__form">
                           		<form action= "" method= "post">
                           			<div class="sign__input-wrapper mb-25">
	                               	 <input type="hidden" class="form-control" name="email"
             value="<?=$user_email?>">

	                                 <div class="sign__input mb-25">
	                                    <input type="password" name="pass" placeholder="নতুন পাসওয়ার্ড দিন" required>
	                                    <i class="fal fa-envelope"></i>
	                                 </div>

	                                 <div class="sign__input mb-25">
	                                    <input type="password" name="retype_password" placeholder="পুনরায় পাসওয়ার্ড টাইপ করুন" required>
	                                    <i class="fal fa-envelope"></i>
	                                 </div>

	                                 <button name="reset_password" class="tp-btn pt-20  w-100"> <span></span> পাসওয়ার্ড সেট করুন</button>
	                                 <div class="sign__new text-center mt-20">
		                                 <p>আগেই নিবন্ধন করা থাকলে <br/>  <a href="login">লগইন করো</p>
		                              </div>
	                              </div>
                           		</form>
                           	</div>

                     	</div>
                 	</div>
             	</div>

            </div>
     	</section>
     </main>
	

<?php
require 'footer-v2.php';
} else {
    echo " Token not found";
}
