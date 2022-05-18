<?php
session_start();
// require 'EmailService.php';
error_reporting(1);
require 'connection.php';
require 'header-home.php';

$name = $phone = $email = $password = $retype_password = $school_name = $district = $thana = "";

$msg = [];

if (isset($_POST['register'])) {

    if (empty($_POST["name"]) || strlen($_POST["name"]) < 2) {
        array_push($msg, "আপনার নাম লিখুন");
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["phone"]) || strlen($_POST["phone"]) < 5) {
        array_push($msg, "ফোন নম্বর দিন");
    } else {
        $phone = test_input($_POST["phone"]);
    }

    if (empty($_POST["email"])) {
        array_push($msg, "আপনার ইমেইল লিখুন");
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["password"]) || strlen($_POST["password"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $password = md5(test_input($_POST["password"]));
    }

    if (empty($_POST["retype_password"]) || strlen($_POST["retype_password"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $retype_password = md5(test_input($_POST["retype_password"]));
    }

    if ($password != $retype_password) {
        array_push($msg, "পাসওয়ার্ড ম্যাচ করে নাই। আবার চেষ্টা করুন ");
    }

    if (empty($_POST["school_name"]) || strlen($_POST["school_name"]) < 2) {
        array_push($msg, "স্কুলের নাম লিখুন");
    } else {
        $school_name = test_input($_POST["school_name"]);
    }

    if (empty($_POST["district"]) || strlen($_POST["district"]) < 2) {
        array_push($msg, "আপনার জেলা সিলেক্ট করুন");
    } else {
        $district = test_input($_POST["district"]);
    }

    if (empty($_POST["thana"]) || strlen($_POST["thana"]) < 2) {
        array_push($msg, "আপনার উপজেলা টাইপ করুন");
    } else {
        $thana = test_input($_POST["thana"]);
    }

    $sql = "SELECT `email` FROM `model_students` WHERE `email` = " . "'$email'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        array_push($msg, "আপনি আগেই রেজিস্ট্রেশন করেছেন। পাসওয়ার্ড ভুলে গেলে পাসওয়ার্ড পুনরায় সেট করুন");

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

                $_SESSION['success'] = "রেজিস্ট্রেশন সফলভাবে সম্পন্ন হয়েছে। মডেল টেস্ট দিতে লগইন করুন";

                header('Location: login.php');

            }

        } else {

            $_SESSION['alert'] = $msg;

        } // end of error
    } // end of NO registraion before

} // end of post submit

?>


    <section class="ftco-login ftco-section testimony-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">

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



          <div class="col-md-8 col-lg-5">
            <div class="login-container">
              <div class="col-md-12 text-center heading-section">
                <h2 class="mb-2">নিবন্ধন ফরম</h2>
              </div>

              <div class="col-md-12">
                <div class="form-container">
                  <form id="register_form_submit" name="register" action="" method="post">
                    <div class="input-container">
                        <input
                          type="text"
                          name="name"
                          value="<?php echo $name; ?>"
                          id="name"
                          placeholder="নাম *"
                          required="required"
                        />
                      </div>

                      <div class="input-container">
                        <input
                          type="text"
                          name="phone"
                          value="<?php echo $phone; ?>"
                          id="phone"
                          placeholder="ফোন নম্বর *"
                          required="required"
                        />
                      </div>



                    <div class="input-container">
                      <input
                        type="email"
                        name="email"
                        value="<?php echo $email; ?>"
                        id="email"
                        placeholder="ইমেইল *"
                        required="required"
                      />
                    </div>
                    <div class="input-container">
                      <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="পাসওয়ার্ড দিন *"
                        required="required"
                      />
                      <input
                        type="password"
                        name="retype_password"
                        id="retype_password"
                        placeholder="পুনরায় পাসওয়ার্ড দিন *"
                        required="required"
                      />
                    </div>
                    <div class="input-container">
                        <input
                          type="text"
                          name="school_name"
                          value="<?php echo $school_name; ?>"
                          id="school_name"
                          placeholder="স্কুলের নাম *"
                          required="required"
                        />
                      </div>

                      <div class="input-container">
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
                    </div>
                    <div class="input-container">
                      <input
                        type="text"
                        name="thana"
                        value="<?php echo $thana; ?>"
                        id="thana"
                        placeholder="থানা *"
                        required="required"
                      />
                    </div>

                    <!-- <div class="input-container terms-container">
                      <input
                        type="checkbox"
                        name="termsConditions"
                        value="yes"
                        id="terms_conditions"
                        required="required"
                        id="terms_conditions"
                      />
                      <label for="terms_conditions"
                        >নিবন্ধনের তথ্যসমূহ প্রথম
                        আলোর নিকট সংরক্ষিত থাকবে।</label
                      >
                    </div> -->
                    <div class="input-container submit-container">
                      <button id="register-button" name="register">
                        <span class="content">সাবমিট</span>
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          style="margin: auto, background: none"
                          width="34"
                          height="34"
                          display="block"
                          preserveAspectRatio="xMidYMid"
                          viewBox="0 0 100 100"
                          class="loader"
                        >
                          <g transform="translate(84 50)">
                            <circle
                              r="3"
                              fill="#635f5f"
                              transform="scale(1.90075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.9285714285714286s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.9285714285714286s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(80.633 64.752) rotate(25.714)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.929"
                              transform="scale(1.97075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.8571428571428571s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.8571428571428571s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(71.199 76.582) rotate(51.429)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.857"
                              transform="scale(1.06075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.7857142857142857s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.7857142857142857s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(57.566 83.148) rotate(77.143)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.786"
                              transform="scale(1.13075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.7142857142857143s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.7142857142857143s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(42.434 83.148) rotate(102.857)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.714"
                              transform="scale(1.20075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.6428571428571429s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.6428571428571429s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(28.801 76.582) rotate(128.571)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.643"
                              transform="scale(1.27075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.5714285714285714s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.5714285714285714s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(19.367 64.752) rotate(154.286)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.571"
                              transform="scale(1.34075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.5s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.5s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g transform="translate(16 50) rotate(180)">
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.5"
                              transform="scale(1.41075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.42857142857142855s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.42857142857142855s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(19.367 35.248) rotate(205.714)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.429"
                              transform="scale(1.48075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.35714285714285715s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.35714285714285715s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(28.801 23.418) rotate(231.429)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.357"
                              transform="scale(1.55075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.2857142857142857s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.2857142857142857s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(42.434 16.852) rotate(257.143)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.286"
                              transform="scale(1.62075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.21428571428571427s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.21428571428571427s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(57.566 16.852) rotate(282.857)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.214"
                              transform="scale(1.69075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.14285714285714285s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.14285714285714285s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(71.199 23.418) rotate(308.571)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.143"
                              transform="scale(1.76075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="-0.07142857142857142s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="-0.07142857142857142s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                          <g
                            transform="translate(80.633 35.248) rotate(334.286)"
                          >
                            <circle
                              r="3"
                              fill="#635f5f"
                              fillOpacity="0.071"
                              transform="scale(1.83075)"
                            >
                              <animateTransform
                                attributeName="transform"
                                begin="0s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                type="scale"
                                values="1.98 1.98;1 1"
                              ></animateTransform>
                              <animate
                                attributeName="fill-opacity"
                                begin="0s"
                                dur="1s"
                                keyTimes="0;1"
                                repeatCount="indefinite"
                                values="1;0"
                              ></animate>
                            </circle>
                          </g>
                        </svg>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include 'footer-home.php'?>