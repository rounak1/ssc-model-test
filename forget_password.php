<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-v2.php';
require 'EmailService.php';

$email = "";

$msg = [];

if (isset($_POST['forget_password'])) {

    if (empty($_POST["email"])) {
        array_push($msg, "আপনার ইমেইল লিখুন");
    } else {
        $email = test_input($_POST["email"]);
        $_SESSION['email'] = $email;

    }

    $email_sent = new EmailService();
    $email_address = $email;

    $token = bin2hex(random_bytes(20));

    $verifyEmailLink = "https://service.prothomalo.com/modeltest/reset_password.php?token=" . $token;

    $message = '<div><div>প্রিয় শিক্ষার্থী বন্ধু,  এসএসসি মডেল টেস্ট ২০২২ - এ তোমাকে স্বাগতম।
    </div> <a href="' . $verifyEmailLink . '">এই লিংকে ক্লিক</a> করে তোমার পাসওয়ার্ডটি পুনরায় সেট করো।</div>';

    if (!empty($email_address)) {
        //Store token in table

        $query = "UPDATE `model_students` SET  `token` = '$token' WHERE `email`='$email_address'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $from = 'noreply@prothomalo.com';
            $data = [
                'to' => $email_address,
                'from' => $from,
                'subject' => 'এসএসসি মডেল টেস্ট দেওয়ার জন্য পাসওয়ার্ড রিসেট',
                'html' => $message,
                'fromName' => 'porasona SSC model test',
            ];

            $email_sent->send($data);
        }

    } else {
        echo "email not found";
    }

    array_push($msg, "তোমার ই-মেইলে পাসওয়ার্ড পুনরায় সেট করার জন্য একটি লিংক পাঠানো হয়েছে। লিংকে ক্লিক করে পাসওয়ার্ড পুনরায় সেট করো।");

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
                        <h2 class="section__title">পাসওয়ার্ড ভুলে গিয়েছ?</h2>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="sign__wrapper white-bg">
                        <?php
                        if (count($msg) > 0) {?>
                            <div class="alert alert-warning" role="alert">
                                <?php
                                    foreach ($msg as $message) {
                                        echo $message . "<br>";
                                    }
                                ?>
                            </div>
                        <?php }?>
                        <div class="sign__form">
                           <form action= "" method= "post">
                              <div class="sign__input-wrapper mb-25">
                                 <h5>পাসওয়ার্ড পরিবর্তন করতে তোমার ই-মেইল অ্যাড্রেসটি দাও</h5>
                                 <div class="sign__input">
                                    <input type="email" name="email" placeholder="ইমেইল" required>
                                    <i class="fal fa-envelope"></i>
                                 </div>
                              </div>
                              <button name="login" class="tp-btn  w-100"> <span></span> পাঠাও</button>
                              <div class="sign__new text-center mt-20">
                                 <p>অ্যাকাউন্ট নেই? <a href="<?php $base_url?>register.php">নিবন্ধন করো</a></p>
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

<?php
    require 'footer-v2.php';
?>