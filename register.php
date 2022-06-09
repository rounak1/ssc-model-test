<?php
session_start();
// require 'EmailService.php';
error_reporting(1);
$site_title = "নিবন্ধন ফরম :: মডেল টেস্ট - প্রথম আলো";
require 'connection.php';
require 'header-v2.php';

$name = $phone = $email = $password = $retype_password = $school_name = $district = $thana = "";

$msg = [];

if (isset($_POST['register'])) {

    if (empty($_POST["name"]) || strlen($_POST["name"]) < 2) {
        array_push($msg, "তোমার নাম লিখো");
        $_SESSION['alert'] = "তোমার নাম লিখো";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["phone"]) || strlen($_POST["phone"]) < 5) {
        array_push($msg, "ফোন নম্বর দাও");
        $_SESSION['alert'] = "ফোন নম্বর দাও";
    } else {
        $phone = test_input($_POST["phone"]);
    }

    if (empty($_POST["email"])) {
        array_push($msg, "তোমার ইমেইল লিখো");
        $_SESSION['alert'] = "তোমার ইমেইল লিখো";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["password"]) || strlen($_POST["password"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
        $_SESSION['alert'] = "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে";
    } else {
        $password = md5(test_input($_POST["password"]));
    }

    if (empty($_POST["retype_password"]) || strlen($_POST["retype_password"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
        $_SESSION['alert'] = "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে";
    } else {
        $retype_password = md5(test_input($_POST["retype_password"]));
    }

    if ($password != $retype_password) {
        array_push($msg, "পাসওয়ার্ড ম্যাচ করে নাই। আবার চেষ্টা করো");
        $_SESSION['alert'] = "পাসওয়ার্ড ম্যাচ করে নাই। আবার চেষ্টা করো";
    }

    if (empty($_POST["school_name"]) || strlen($_POST["school_name"]) < 2) {
        array_push($msg, "স্কুলের নাম লিখো");
        $_SESSION['alert'] = "স্কুলের নাম লিখো";

    } else {
        $school_name = test_input($_POST["school_name"]);
    }

    if (empty($_POST["district"]) || strlen($_POST["district"]) < 2) {
        array_push($msg, "তোমার জেলা সিলেক্ট করো");
        $_SESSION['alert'] = "তোমার জেলা সিলেক্ট করো";
    } else {
        $district = test_input($_POST["district"]);
    }

    if (empty($_POST["thana"]) || strlen($_POST["thana"]) < 2) {
        array_push($msg, "তোমার উপজেলা টাইপ করো");
        $_SESSION['alert'] = "তোমার উপজেলা টাইপ করো";
    } else {
        $thana = test_input($_POST["thana"]);
    }

    $sql = "SELECT `email` FROM `model_students` WHERE `email` = " . "'$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        array_push($msg, "আপনি আগেই রেজিস্ট্রেশন করেছেন। পাসওয়ার্ড ভুলে গেলে পাসওয়ার্ড পুনরায় সেট করো");
        $_SESSION['alert'] = "আপনি আগেই রেজিস্ট্রেশন করেছেন। পাসওয়ার্ড ভুলে গেলে পাসওয়ার্ড পুনরায় সেট করো";

    } else {
        if ((count($msg) < 1)) {

            $query = "INSERT INTO `model_students`
                (`name`, `phone`,  `email`, `password`, `school_name`, `district`, `thana`)
              VALUES ('$name', '$phone',  '$email', '$password', '$school_name', '$district',  '$thana')";

            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Error:" . mysqli_error($conn);
            }

            if ($result) {
                // Send Mail

                $_SESSION['success'] = "রেজিস্ট্রেশন সফলভাবে সম্পন্ন হয়েছে। মডেল টেস্ট দিতে লগইন করো";

                header('Location: login');

                echo "<script type='text/javascript'>window.top.location='login';</script>";exit;

            }

        } else {

            $_SESSION['alert'] = $msg;

        } // end of error
    } // end of NO registraion before

} // end of post submit

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
                        <h2 class="section__title">নিবন্ধন ফরম</h2>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="sign__wrapper white-bg">
                        <?php

                          if (isset($_SESSION['alert'])) {?>
                            <div class="col-md-12 message-container">
                                  <div class="alert alert-warning" role="alert">
                            <?php foreach ($msg as $display_error) {
                              echo $display_error;
                          }

                              unset($_SESSION['alert']);?>
                          </div>
                                  </div>
                          <?php }
                          ?>
                        <div class="sign__form">
                           <form id="register_form_submit" name="register" action="" method="post">
                              <div class="sign__input-wrapper mb-10">
                                <div class="sign__input">
                                    <input 
                                      type="text"
                                      name="name"
                                      value="<?php echo $name; ?>"
                                      id="name"
                                      placeholder="নাম *" 
                                      required="required" 
                                    />
                                    <i class="fal fa-user"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <div class="sign__input">
                                    <input 
                                      type="text"
                                      name="phone"
                                      value="<?php echo $phone; ?>"
                                      id="phone"
                                      placeholder="ফোন নম্বর *" 
                                      required="required"
                                    />
                                    <i class="fal fa-mobile"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <div class="sign__input">
                                    <input 
                                      type="email"
                                      name="email"
                                      value="<?php echo $email; ?>"
                                      id="email"
                                      placeholder="ইমেইল *" 
                                      required="required"
                                    />
                                    <i class="fal fa-envelope"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <div class="sign__input">
                                    <input 
                                      type="password"
                                      name="password"
                                      id="password"
                                      placeholder="পাসওয়ার্ড দাও *" 
                                      required="required"
                                    />
                                    <i class="fal fa-lock"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <div class="sign__input">
                                    <input 
                                      type="password"
                                      name="retype_password"
                                      id="retype_password"
                                      placeholder="পুনরায় পাসওয়ার্ড দাও *" 
                                      required="required"
                                    />
                                    <i class="fal fa-lock"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <div class="sign__input">
                                    <input 
                                      type="text"
                                      name="school_name"
                                      id="school_name"
                                      value="<?php echo $school_name; ?>"
                                      placeholder="স্কুলের নাম *" 
                                      required="required"
                                    />
                                    <i class="fal fa-school"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <div class="sign__input">
                                    <select name="district" id="district" required="required">
                                      <option value="">জেলা *</option>
                                      <option value="ঢাকা">ঢাকা</option>
                                      <option value="গাজীপুর">গাজীপুর</option>
                                      <option value="নারায়ণগঞ্জ">নারায়ণগঞ্জ</option>
                                      <option value="কিশোরগঞ্জ">কিশোরগঞ্জ</option>
                                      <option value="মাদারীপুর">মাদারীপুর</option>
                                      <option value="গোপালগঞ্জ">গোপালগঞ্জ</option>
                                      <option value="ফরিদপুর">ফরিদপুর</option>
                                      <option value="টাঙ্গাইল">টাঙ্গাইল</option>
                                      <option value="রাজবাড়ী">রাজবাড়ী</option>
                                      <option value="মানিকগঞ্জ">মানিকগঞ্জ</option>
                                      <option value="মুন্সিগঞ্জ">মুন্সিগঞ্জ</option>
                                      <option value="নরসিংদী">নরসিংদী</option>
                                      <option value="শরীয়তপুর">শরীয়তপুর</option>
                                      <option value="রংপুর">রংপুর</option>
                                      <option value="দিনাজপুর">দিনাজপুর</option>
                                      <option value="নীলফামারী">নীলফামারী</option>
                                      <option value="ঠাকুরগাঁও">ঠাকুরগাঁও</option>
                                      <option value="কুড়িগ্রাম">কুড়িগ্রাম</option>
                                      <option value="গাইবান্ধা">গাইবান্ধা</option>
                                      <option value="লালমনিরহাট">লালমনিরহাট</option>
                                      <option value="পঞ্চগড">পঞ্চগড়</option>
                                      <option value="সিলেট">সিলেট</option>
                                      <option value="মৌলভীবাজার">মৌলভীবাজার</option>
                                      <option value="সুনামগঞ্জ">সুনামগঞ্জ</option>
                                      <option value="হবিগঞ্জ">হবিগঞ্জ</option>
                                      <option value="বরিশাল">বরিশাল</option>
                                      <option value="বরগুনা">বরগুনা</option>
                                      <option value="পিরোজপুর">পিরোজপুর</option>
                                      <option value="ভোলা">ভোলা</option>
                                      <option value="ঝালকাঠি">ঝালকাঠি</option>
                                      <option value="পটুয়াখালী">পটুয়াখালী</option>
                                      <option value="খুলনা">খুলনা</option>
                                      <option value="যশোর">যশোর</option>
                                      <option value="নড়াইল">নড়াইল</option>
                                      <option value="মেহেরপুর">মেহেরপুর</option>
                                      <option value="কুষ্টিয়া">কুষ্টিয়া</option>
                                      <option value="সাতক্ষীরা">সাতক্ষীরা</option>
                                      <option value="বাগেরহাট">বাগেরহাট</option>
                                      <option value="ঝিনাইদহ">ঝিনাইদহ</option>
                                      <option value="চুয়াডাঙ্গা">চুয়াডাঙ্গা</option>
                                      <option value="মাগুরা">মাগুরা</option>
                                      <option value="রাজশাহী">রাজশাহী</option>
                                      <option value="বগুড়া">বগুড়া</option>
                                      <option value="নওগাঁ">নওগাঁ</option>
                                      <option value="সিরাজগঞ্জ">সিরাজগঞ্জ</option>
                                      <option value="জয়পুরহাট">জয়পুরহাট</option>
                                      <option value="পাবনা">পাবনা</option>
                                      <option value="চাঁপাইনবাবগঞ্জ">চাঁপাইনবাবগঞ্জ</option>
                                      <option value="নাটোর">নাটোর</option>
                                      <option value="চট্টগ্রাম">চট্টগ্রাম</option>
                                      <option value="কুমিল্লা">কুমিল্লা</option>
                                      <option value="চাঁদপুর">চাঁদপুর</option>
                                      <option value="রাঙামাটি">রাঙামাটি</option>
                                      <option value="কক্সবাজার">কক্সবাজার</option>
                                      <option value="নোয়াখালী">নোয়াখালী</option>
                                      <option value="ব্রাহ্মণবাড়িয়া">
                                        ব্রাহ্মণবাড়িয়া
                                      </option>
                                      <option value="ফেনী">ফেনী</option>
                                      <option value="খাগড়াছড়ি">খাগড়াছড়ি</option>
                                      <option value="বান্দরবান">বান্দরবান</option>
                                      <option value="লক্ষ্মীপুর">লক্ষ্মীপুর</option>
                                      <option value="নেত্রকোনা">নেত্রকোনা</option>
                                      <option value="ময়মনসিংহ">ময়মনসিংহ</option>
                                      <option value="শেরপুর">শেরপুর</option>
                                      <option value="জামালপুর">জামালপুর</option>
                                    </select>
                                    <i class="fal fa-location"></i>
                                 </div>
                              </div>
                              <div class="sign__input-wrapper mb-10">
                                 <div class="sign__input">
                                    <input 
                                      type="text"
                                      name="thana"
                                      id="thana"
                                      value="<?php echo $thana; ?>"
                                      placeholder="থানা *" 
                                      required="required"
                                    />
                                    <i class="fal fa-location"></i>
                                 </div>
                              </div>
                              <div class="sign__action d-flex justify-content-between mb-30">
                                <div class="sign__agree d-flex align-items-center">
                                  <input class="m-check-input" type="checkbox" id="m-agree" required="required">
                                  <label class="m-check-label" for="m-agree">আমি কুইজ পদ্ধতি মেনে নিবন্ধন করছি। নিবন্ধনের তথ্যসমূহ প্রথম আলোর নিকট সংরক্ষিত থাকবে।
                                     </label>
                                </div>
                              </div>
                              <button name="register" class="tp-btn  w-100"> <span></span> সাবমিট</button>
                              <div class="sign__new text-center mt-20">
                                 <p>আগেই নিবন্ধন করা থাকলে <br/>  <a href="login">লগইন করো</a></p>
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
    require 'footer-v3.php';
?>