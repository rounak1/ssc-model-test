<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index');
}
error_reporting(0);
$site_title = "প্রোফাইল এডিট :: এসএসসি মডেল টেস্ট ২০২২";
require 'connection.php';
require 'header-v2.php';
$email = $_SESSION['email'];

$query = "select * from model_students where email = '$email'";

$result = mysqli_query($conn, $query);

$user_data = mysqli_fetch_assoc($result);

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

            header('Location: dashboard');

            echo "<script type='text/javascript'>window.top.location='dashboard';</script>";exit;

        }

    }

} // end of post submit

?>

<main>

  <section class="profile__menu pt-120 grey-bg-2 pb-45">
    <div class="container">
      <div class="row">

        <div class="col-xxl-4 col-md-4">
           <?php require 'menu.php'; ?>
        </div>

        <div class="col-xxl-8 col-md-8">

          <div class="sign__wrapper white-bg" style="margin: 0;">
            <h3 class="section__title-2 text-center pb-20">প্রোফাইল এডিট</h3>

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
            <?php 
              }
            ?>

            <div class="sign__form">
                <form id="register_form_submit" name="register" action="" method="post">

                  <div class="form-group row mb-10">
                    <label for="name" class="col-sm-3 col-form-label edit_profile_label">নাম: </label>
                    <div class="col-sm-9">
                      <div class="input-container">
                      <input
                        type="text"
                        name="name"
                        value="<?php echo $user_data['name']; ?>"
                        id="name"
                        placeholder="নাম *"
                        required="required" 
                        class="form-control"
                      />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-10">
                    <label for="name" class="col-sm-3 col-form-label edit_profile_label">ফোন: </label>
                    <div class="col-sm-9">
                      <div class="input-container">
                        <input
                          type="text"
                          name="phone"
                          value="<?php echo $user_data['phone']; ?>"
                          id="phone"
                          placeholder="ফোন নম্বর *"
                          required="required"
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-10">
                    <label for="name" class="col-sm-3 col-form-label edit_profile_label">ইমেইল: </label>
                    <div class="col-sm-9">
                      <div class="input-container">
                        <input
                          type="email"
                          name="email"
                          value="<?php echo $user_data['email']; ?>"
                          id="email"
                          placeholder="ইমেইল *"
                          disabled
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-10">
                    <label for="name" class="col-sm-3 col-form-label edit_profile_label">স্কুলের নাম: </label>
                    <div class="col-sm-9">
                      <div class="input-container">
                        <input
                          type="text"
                          name="school_name"
                          value="<?php echo $user_data['school_name']; ?>"
                          id="school_name"
                          placeholder="স্কুলের নাম *"
                          required="required"
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="form-group row mb-10">
                    <label for="name" class="col-sm-3 col-form-label edit_profile_label">জেলা: </label>
                    <div class="col-sm-9">

                        <div class="input-container">
                        <select name="district" id="district" required="required" class="form-control">
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
                    </div>
                  </div>

                  <div class="form-group row mb-30">
                    <label for="name" class="col-sm-3 col-form-label edit_profile_label">থানা: </label>
                    <div class="col-sm-9">
                      <div class="input-container">
                        <input
                          type="text"
                          name="thana"
                          value="<?php echo $user_data['thana']; ?>"
                          id="thana"
                          placeholder="থানা *"
                          required="required"
                          class="form-control"
                        />
                      </div>
                    </div>
                  </div>

                  <div class="text-center">
                    <button class="tp-btn" name="edit-profile">
                      <span class="content">আপডেট প্রোফাইল</span>
                    </button>
                  </div>

                </form>
            </div>

          </div>

        </div>

      </div>
    </div>
  </section>


</main>

<?php include 'footer-v2.php'?>