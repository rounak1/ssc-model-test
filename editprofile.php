<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
error_reporting(1);
require 'connection.php';
require 'header-home.php';
$email = $_SESSION['email'];

$query = "select * from model_students where email = '$email'";

$result = mysqli_query($conn, $query);

$user_data = mysqli_fetch_assoc($result);

// $name = $phone = $email = $password = $retype_password = $school_name = $district = $thana = "";

$msg = [];

if (isset($_POST['edit-profile'])) {

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

    if ((count($msg) < 1)) {

        $sql = "UPDATE `model_students` SET `name`='$name',`phone`='$phone',`school_name`='$school_name',`district`='$district',`thana`='$thana' WHERE `email` = '$email'";

        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "Error:" . mysqli_error($conn);
        }

        if ($result) {
            // Send Mail

            $_SESSION['success'] = "প্রোফাইল আপডেট করা হয়েছে";

            header('Location: myprofile.php');

        }

    }

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
                <h2 class="mb-2">প্রোফাইল এডিট</h2>
              </div>

              <div class="col-md-12">
                <div class="form-container">
                  <form id="register_form_submit" name="register" action="" method="post">
                    <div class="input-container">
                        <input
                          type="text"
                          name="name"
                          value="<?php echo $user_data['name']; ?>"
                          id="name"
                          placeholder="নাম *"
                          required="required"
                        />
                      </div>

                      <div class="input-container">
                        <input
                          type="text"
                          name="phone"
                          value="<?php echo $user_data['phone']; ?>"
                          id="phone"
                          placeholder="ফোন নম্বর *"
                          required="required"
                        />
                      </div>



                    <div class="input-container">
                      <input
                        type="email"
                        name="email"
                        value="<?php echo $user_data['email']; ?>"
                        id="email"
                        placeholder="ইমেইল *"
                        disabled
                      />
                    </div>



                    <div class="input-container">
                        <input
                          type="text"
                          name="school_name"
                          value="<?php echo $user_data['school_name']; ?>"
                          id="school_name"
                          placeholder="স্কুলের নাম *"
                          required="required"
                        />
                      </div>

                      <div class="input-container">
                      <select name="district" id="district" required="required">
                        <option value="">জেলা *</option>
                        <option value="ঢাকা" <?=$user_data['district'] == 'ঢাকা' ? "selected" : "";?>>ঢাকা</option>
                        <option value="গাজীপুর" <?=$user_data['district'] == 'গাজীপুর' ? "selected" : "";?>>গাজীপুর</option>
                        <option value="নারায়ণগঞ্জ" <?=$user_data['district'] == 'নারায়ণগঞ্জ' ? "selected" : "";?>>নারায়ণগঞ্জ</option>
                        <option value="কিশোরগঞ্জ" <?=$user_data['district'] == 'কিশোরগঞ্জ' ? "selected" : "";?>>কিশোরগঞ্জ</option>
                        <option value="মাদারীপুর" <?=$user_data['district'] == 'মাদারীপুর' ? "selected" : "";?>>মাদারীপুর</option>
                        <option value="গোপালগঞ্জ" <?=$user_data['district'] == 'গোপালগঞ্জ' ? "selected" : "";?>>গোপালগঞ্জ</option>
                        <option value="ফরিদপুর" <?=$user_data['district'] == 'ফরিদপুর' ? "selected" : "";?>>ফরিদপুর</option>
                        <option value="টাঙ্গাইল" <?=$user_data['district'] == 'টাঙ্গাইল' ? "selected" : "";?>>টাঙ্গাইল</option>
                        <option value="রাজবাড়ী" <?=$user_data['district'] == 'রাজবাড়ী' ? "selected" : "";?>>রাজবাড়ী</option>
                        <option value="মানিকগঞ্জ" <?=$user_data['district'] == 'মানিকগঞ্জ' ? "selected" : "";?>>মানিকগঞ্জ</option>
                        <option value="মুন্সিগঞ্জ" <?=$user_data['district'] == 'মুন্সিগঞ্জ' ? "selected" : "";?>>মুন্সিগঞ্জ</option>
                        <option value="নরসিংদী" <?=$user_data['district'] == 'নরসিংদী' ? "selected" : "";?>>নরসিংদী</option>
                        <option value="শরীয়তপুর" <?=$user_data['district'] == 'শরীয়তপুর' ? "selected" : "";?>>শরীয়তপুর</option>
                        <option value="রংপুর" <?=$user_data['district'] == 'রংপুর' ? "selected" : "";?>>রংপুর</option>
                        <option value="দিনাজপুর" <?=$user_data['district'] == 'দিনাজপুর' ? "selected" : "";?>>দিনাজপুর</option>
                        <option value="নীলফামারী" <?=$user_data['district'] == 'নীলফামারী' ? "selected" : "";?>>নীলফামারী</option>
                        <option value="ঠাকুরগাঁও" <?=$user_data['district'] == 'ঠাকুরগাঁও' ? "selected" : "";?>>ঠাকুরগাঁও</option>
                        <option value="কুড়িগ্রাম" <?=$user_data['district'] == 'কুড়িগ্রাম' ? "selected" : "";?>>কুড়িগ্রাম</option>
                        <option value="গাইবান্ধা" <?=$user_data['district'] == 'গাইবান্ধা' ? "selected" : "";?>>গাইবান্ধা</option>
                        <option value="লালমনিরহাট" <?=$user_data['district'] == 'লালমনিরহাট' ? "selected" : "";?>>লালমনিরহাট</option>
                        <option value="পঞ্চগড়" <?=$user_data['district'] == 'পঞ্চগড়' ? "selected" : "";?>>পঞ্চগড়</option>
                        <option value="সিলেট" <?=$user_data['district'] == 'সিলেট' ? "selected" : "";?>>সিলেট</option>
                        <option value="মৌলভীবাজার" <?=$user_data['district'] == 'মৌলভীবাজার' ? "selected" : "";?>>মৌলভীবাজার</option>
                        <option value="সুনামগঞ্জ" <?=$user_data['district'] == 'সুনামগঞ্জ' ? "selected" : "";?>>সুনামগঞ্জ</option>
                        <option value="হবিগঞ্জ" <?=$user_data['district'] == 'হবিগঞ্জ' ? "selected" : "";?>>হবিগঞ্জ</option>
                        <option value="বরিশাল" <?=$user_data['district'] == 'বরিশাল' ? "selected" : "";?>>বরিশাল</option>
                        <option value="বরগুনা" <?=$user_data['district'] == 'বরগুনা' ? "selected" : "";?>>বরগুনা</option>
                        <option value="পিরোজপুর" <?=$user_data['district'] == 'পিরোজপুর' ? "selected" : "";?>>পিরোজপুর</option>
                        <option value="ভোলা" <?=$user_data['district'] == 'ভোলা' ? "selected" : "";?>>ভোলা</option>
                        <option value="ঝালকাঠি" <?=$user_data['district'] == 'ঝালকাঠি' ? "selected" : "";?>>ঝালকাঠি</option>
                        <option value="পটুয়াখালী" <?=$user_data['district'] == 'পটুয়াখালী' ? "selected" : "";?>>পটুয়াখালী</option>
                        <option value="খুলনা" <?=$user_data['district'] == 'খুলনা' ? "selected" : "";?>>খুলনা</option>
                        <option value="যশোর" <?=$user_data['district'] == 'যশোর' ? "selected" : "";?>>যশোর</option>
                        <option value="নড়াইল" <?=$user_data['district'] == 'নড়াইল' ? "selected" : "";?>>নড়াইল</option>
                        <option value="মেহেরপুর" <?=$user_data['district'] == 'মেহেরপুর' ? "selected" : "";?>>মেহেরপুর</option>
                        <option value="কুষ্টিয়া" <?=$user_data['district'] == 'কুষ্টিয়া' ? "selected" : "";?>>কুষ্টিয়া</option>
                        <option value="সাতক্ষীরা" <?=$user_data['district'] == 'সাতক্ষীরা' ? "selected" : "";?>>সাতক্ষীরা</option>
                        <option value="বাগেরহাট" <?=$user_data['district'] == 'বাগেরহাট' ? "selected" : "";?>>বাগেরহাট</option>
                        <option value="ঝিনাইদহ" <?=$user_data['district'] == 'ঝিনাইদহ' ? "selected" : "";?>>ঝিনাইদহ</option>
                        <option value="চুয়াডাঙ্গা" <?=$user_data['district'] == 'চুয়াডাঙ্গা' ? "selected" : "";?>>চুয়াডাঙ্গা</option>
                        <option value="মাগুরা" <?=$user_data['district'] == 'মাগুরা' ? "selected" : "";?>>মাগুরা</option>
                        <option value="রাজশাহী" <?=$user_data['district'] == 'রাজশাহী' ? "selected" : "";?>>রাজশাহী</option>
                        <option value="বগুড়া" <?=$user_data['district'] == 'বগুড়া' ? "selected" : "";?>>বগুড়া</option>
                        <option value="নওগাঁ" <?=$user_data['district'] == 'নওগাঁ' ? "selected" : "";?>>নওগাঁ</option>
                        <option value="সিরাজগঞ্জ" <?=$user_data['district'] == 'সিরাজগঞ্জ' ? "selected" : "";?>>সিরাজগঞ্জ</option>
                        <option value="জয়পুরহাট" <?=$user_data['district'] == 'জয়পুরহাট' ? "selected" : "";?>>জয়পুরহাট</option>
                        <option value="পাবনা" <?=$user_data['district'] == 'পাবনা' ? "selected" : "";?>>পাবনা</option>
                        <option value="চাঁপাইনবাবগঞ্জ" <?=$user_data['district'] == 'চাঁপাইনবাবগঞ্জ' ? "selected" : "";?>>চাঁপাইনবাবগঞ্জ</option>
                        <option value="নাটোর" <?=$user_data['district'] == 'নাটোর' ? "selected" : "";?>>নাটোর</option>
                        <option value="চট্টগ্রাম" <?=$user_data['district'] == 'চট্টগ্রাম' ? "selected" : "";?>>চট্টগ্রাম</option>
                        <option value="কুমিল্লা" <?=$user_data['district'] == 'কুমিল্লা' ? "selected" : "";?>>কুমিল্লা</option>
                        <option value="চাঁদপুর" <?=$user_data['district'] == 'চাঁদপুর' ? "selected" : "";?>>চাঁদপুর</option>
                        <option value="রাঙামাটি" <?=$user_data['district'] == 'রাঙামাটি' ? "selected" : "";?>>রাঙামাটি</option>
                        <option value="কক্সবাজার" <?=$user_data['district'] == 'কক্সবাজার' ? "selected" : "";?>>কক্সবাজার</option>
                        <option value="নোয়াখালী" <?=$user_data['district'] == 'নোয়াখালী' ? "selected" : "";?>>নোয়াখালী</option>
                        <option value="ব্রাহ্মণবাড়িয়া" <?=$user_data['district'] == 'ব্রাহ্মণবাড়িয়া' ? "selected" : "";?>>
                          ব্রাহ্মণবাড়িয়া
                        </option>
                        <option value="ফেনী" <?=$user_data['district'] == 'ফেনী' ? "selected" : "";?>>ফেনী</option>
                        <option value="খাগড়াছড়ি" <?=$user_data['district'] == 'খাগড়াছড়ি' ? "selected" : "";?>>খাগড়াছড়ি</option>
                        <option value="বান্দরবান" <?=$user_data['district'] == 'বান্দরবান' ? "selected" : "";?>>বান্দরবান</option>
                        <option value="লক্ষ্মীপুর" <?=$user_data['district'] == 'লক্ষ্মীপুর' ? "selected" : "";?>>লক্ষ্মীপুর</option>
                        <option value="নেত্রকোনা" <?=$user_data['district'] == 'নেত্রকোনা' ? "selected" : "";?>>নেত্রকোনা</option>
                        <option value="ময়মনসিংহ" <?=$user_data['district'] == 'ময়মনসিংহ' ? "selected" : "";?>>ময়মনসিংহ</option>
                        <option value="শেরপুর" <?=$user_data['district'] == 'শেরপুর' ? "selected" : "";?>>শেরপুর</option>
                        <option value="জামালপুর" <?=$user_data['district'] == 'জামালপুর' ? "selected" : "";?>>জামালপুর</option>
                      </select>
                    </div>
                    <div class="input-container">
                      <input
                        type="text"
                        name="thana"
                        value="<?php echo $user_data['thana']; ?>"
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
                      <button id="register-button" name="edit-profile">
                        <span class="content">এডিট প্রোফাইল</span>
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