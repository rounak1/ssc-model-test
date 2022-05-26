<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
error_reporting(1);
require 'check-login.php';
require 'header-home.php';
require 'BanglaConverter.php';

include_once 'settings1.php';
include_once 'settings.php';

$query_quiz_result = "SELECT * FROM `quiz_histories` WHERE `user_id` = '$user_id'";

$result_quiz_data = mysqli_query($conn, $query_quiz_result);

$result = [];
$result_single_array = [];

if (!empty($result_quiz_data)) {
    while ($row = mysqli_fetch_array($result_quiz_data)) {
        $result[$row['exam_id']]['exam_id'] = $row['exam_id'];
        $result[$row['exam_id']]['id'] = $row['id'];
        $result[$row['exam_id']]['exam_name'] = $model_test_list[$row['exam_id']]['subject'];
        $result[$row['exam_id']]['total_marks'] = $row['total_marks'];

        $result_single_array[$row['exam_id']] = $model_test_list[$row['exam_id']]['subject'];
    }
}

?>

    <section class="testimony-section">
      <div class="container">

        <div
          id="myprofile_section"
          class="row justify-content-center mb-5 pb-3"
        >
          <div class="col-md-12 text-center heading heading-section">
            <h2 class="mb-2">ড্যাশবোর্ড</h2>
          </div>

          <div class="col-md-12">
            <div class="profile-container myprofile-body-portion">
              <div class="account-information">

              <div class="students-personal-info">
                <p class="profile-info"> <strong> <?php echo $user_data['name']; ?></strong></p>
                <p class="profile-info"><?php echo $user_data['school_name']; ?></p>
                <p class="profile-info"> <?php echo $user_data['district']; ?></p>
                <a href="editprofile.php" class="profile-edit-btn">এডিট প্রোফাইল</a>
              </div>

              <?php if (count($result_single_array) > 0) {?>
  <div class="recent-model-test">
    <h4>মডেল টেস্টের ফলাফল</h4>




    <div class="test-results-container">
     <?php
foreach (array_unique($result_single_array) as $sub_key => $subject) {
    ?>
            <h6><?=$subject?></h6>
            <?php
foreach ($result as $data) {
        if ($data['exam_name'] == $subject) {
            ?>
              <p>
                <a href="result.php?id=<?=$data['id']?>">
                  <?=$model_test_list[$data['exam_id']]['test']?> - স্কোর <?=BanglaConverter::en2bn($data['total_marks'])?>
                </a>
              </p>
            <?php
}
    }
    ?>
      <?php
}?>


    </div>


  </div>

  <?php }

?>

  <div class="logout-btn-container">
            <a href="logout.php" class="profile-logout-btn">লগ আউট</a>
            </div>

            <div class="footer-contact-container">
      <p class="contact">আমাদের সাথে যোগাযোগ <br>
      <span class="footer-icon profile-contact-icon"><a href="https://www.facebook.com/prothomalo.porasona/" target="_blank"> <i class="fa-brands fa-facebook-square"></i></a></span>
      <span class="footer-icon profile-contact-icon"><a href="mailto:porasona@prothomalo.com" target="_blank"><i class="fa-solid fa-envelope"></i></a></span>
      </p>
      </div>


              </div>
              <div class="quiz-play-information">

                <form action="exam.php" method="POST" name="subject_selection">

                  <div class="exam-selection-container">
                    <?php if (isset($_SESSION['success'])) {?>
                        <div class="col-md-12 message-container">
                          <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['success']; ?>
                          </div>
                        </div>
                    <?php 
                        unset($_SESSION['success']);
                      }
                    ?>

                    <?php if (isset($_SESSION['alert'])) {?>
                        <div class="col-md-12 message-container">
                          <div class="alert alert-warning" role="alert">
                            <?php echo $_SESSION['alert']; ?>
                          </div>
                        </div>
                    <?php 
                        unset($_SESSION['alert']);
                      }
                    ?>

                    <h2>এসএসসি মডেল টেস্ট ২০২২</h2>
                    <h3>মডেল টেস্ট শুরু করতে বিভাগ, বিষয় ও মডেল টেস্টের নাম সিলেক্ট করো</h3>


                    <?php

                      $science_subjects = $exam_list['ssc'][0]['science']['subjects'];
                      $arts_subjects = $exam_list['ssc'][1]['arts']['subjects'];
                      $commerce_subjects = $exam_list['ssc'][2]['commerce']['subjects'];

                    ?>



                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label myprofile_label">বিভাগ</label>
                        <div class="col-sm-9">
                        <select name="group" id="group" class="form-control">
                            <option value=""></option>
                            <option value="science">বিজ্ঞান</option>
                            <option value="arts">মানবিক</option>
                            <option value="commerce">ব্যবসায়</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label myprofile_label subject_label">বিষয়</label>

                        <div class="col-sm-9">

                          <select name="science_subject" class="subject_box form-control" id="science_subject">
                            <option value=""></option>


                             <?php

                              foreach ($science_subjects as $science_subject) {?>
                                <option value="<?php echo ($science_subject['name']) ?>"> <?php echo ($science_subject['name']) ?> </option>

                            <?php }?>

                          </select>

                          <!-- Start Arts Subject Loading  -->
                          <select name="arts_subject" class="subject_box form-control" id="arts_subject">
                            <option value=""></option>
                            <?php

                              foreach ($arts_subjects as $arts_subject) {?>
                                <option value="<?php echo ($arts_subject['name']) ?>"> <?php echo ($arts_subject['name']) ?> </option>

                            <?php }?>
                          </select>

                          <!-- End Arts Subject Loading  -->

                          <!-- Start Commerce Subject Loading  -->

                          <select name="commerce_subject" class="subject_box form-control" id="commerce_subject">
                            <option value=""></option>
                            <?php
                              foreach ($commerce_subjects as $commerce_subject) {
                            ?>
                              <option value="<?php echo ($commerce_subject['name']) ?>"> <?php echo ($commerce_subject['name']) ?> </option>

                            <?php }?>
                          </select>
                        </div>

                      </div>

                      <!-- End Commerce Subject Loading  -->


                      <div class="form-group row">
                        <label for="staticEmail" class="col-sm-3 col-form-label myprofile_label test_number_label">মডেল টেস্ট</label>
                        <div class="col-sm-9">
                          <select name="" class="model_test_no form-control" id="">
                            <option value=""></option>


                            <?php
                              $bangla_p1 = $exam_list['ssc'][0]['science']['subjects'][0]['test'];

                              for ($i = 0; $i < count($bangla_p1); $i++) {?>
                                <option value="<?php echo $bangla_p1[$i]['id']; ?>"><?php echo $bangla_p1[$i]['test_name']; ?></option>
                              <?php }

                              ?>

                          </select>

                          <select name="" class="model_test_no form-control" id="ban_p1">
                            <option value=""></option>

                            <?php
                              $bangla_p1 = $exam_list['ssc'][0]['science']['subjects'][0]['test'];

                              for ($i = 0; $i < count($bangla_p1); $i++) {?>
                                <option value="<?php echo $bangla_p1[$i]['id']; ?>"><?php echo $bangla_p1[$i]['test_name']; ?></option>
                              <?php }

                              ?>

                          </select>

                          <select name="" class="model_test_no form-control" id="agri">
                            <option value=""></option>
                            <?php
                              $bangla_p2 = $exam_list['ssc'][0]['science']['subjects'][1]['test'];

                              for ($i = 0; $i < count($bangla_p2); $i++) {?>
                                <option value="<?php echo $bangla_p2[$i]['id']; ?>"><?php echo $bangla_p2[$i]['test_name']; ?></option>
                              <?php }

                              ?>

                          </select>

                          <select name="" class="model_test_no form-control" id="physics">
                            <option value=""></option>
                            <?php
                              $agri = $exam_list['ssc'][0]['science']['subjects'][2]['test'];

                              for ($i = 0; $i < count($agri); $i++) {?>
                                <option value="<?php echo $agri[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                              <?php }

                            ?>


                          </select>

                          <select name="" class="model_test_no form-control" id="biology">
                            <option value=""></option>
                            <?php
                              $biology = $exam_list['ssc'][0]['science']['subjects'][3]['test'];

                              for ($i = 0; $i < count($biology); $i++) {?>
                                <option value="<?php echo $biology[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                              <?php }

                            ?>

                          </select>

                          <select name="" class="model_test_no form-control" id="bangladesh_history">
                            <option value=""></option>

                            <?php
                              $bangladesh_history = $exam_list['ssc'][1]['arts']['subjects'][2]['test'];

                              for ($i = 0; $i < count($bangladesh_history); $i++) {?>
                                <option value="<?php echo $bangladesh_history[$i]['id']; ?>"><?php echo $bangladesh_history[$i]['test_name']; ?></option>
                              <?php }

                              ?>

                          </select>



                          <select name="" class="model_test_no form-control" id="accounting">
                            <option value=""></option>

                            <?php
                              $accounting = $exam_list['ssc'][2]['commerce']['subjects'][2]['test'];

                              for ($i = 0; $i < count($accounting); $i++) {?>
                                <option value="<?php echo $accounting[$i]['id']; ?>"><?php echo $accounting[$i]['test_name']; ?></option>
                              <?php }

                              ?>

                          </select>

                          <select name="" class="model_test_no form-control" id="finance">
                            <option value=""></option>

                            <?php
                              $finance = $exam_list['ssc'][2]['commerce']['subjects'][3]['test'];

                              for ($i = 0; $i < count($finance); $i++) {?>
                                <option value="<?php echo $finance[$i]['id']; ?>"><?php echo $finance[$i]['test_name']; ?></option>
                              <?php }

                            ?>

                          </select>
                        </div>
                        <input type="hidden" name="test_number" class="put_model_test_number">
                      </div>
                      

                      <div class="start-exam-from-dashboard">
                        <div
                          class="btn px-4 py-3"> <input type="submit" value="মডেল টেস্ট শুরু করো"  id="start_exam_container" name="subject_selection" />

                        </div>

                      </div>


                  </form>
              </div>
                  <div class="row profile-bottom-content">
                    <div class="col-md-6">
                      <div class="rules-container">
                        <h2>নিয়মাবলী</h2>
                        <ul>
                          <li>১. মোট তিরিশটি MCQ প্রশ্ন থাকবে, প্রতিটি প্রশ্নের পূর্ণমান ১ এবং প্রতিটি প্রশ্নের জন্য সময় থাকবে ১ মিনিট।</li>
                          <li>২. মডেল টেস্ট শুরু করার পর ট্যাপ পরিবর্তন করলে কিংবা, ট্যাব বন্ধ করে ফেললে স্বয়ংক্রিয়ভাবে সাবমিট হয়ে যাবে। সেক্ষেত্রে টেস্টটি পুনরায় দেয়া কিংবা পুননিরীক্ষণের কোনো সুযোগ নেই। অর্থাৎ একই মডেল টেস্ট শুধুমাত্র একবার দেয়ার সুযোগ থাকবে।</li>
                          <li>৩. মডেল টেস্ট নিয়ে কোনো জিজ্ঞাসা থাকলে পড়াশোনা প্রথম আলোর ফেসবুক পেজের মেসেঞ্জারে যোগাযোগ করো।</li>
                        </ul>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="exam-routine-container">
                        <div class="exam-routine-header">
                          <h2>মডেল টেস্ট রুটিন</h2>
                          <select name="routine_select_list" id="routine_select_list">
                            <option value="first_day_routine">২৫ মে ২০২২</option>
                            <option value="second_day_routine">২৬ মে ২০২২</option>
                            <option value="third_day_routine">২৭ মে ২০২২</option>
                            <option value="fourth_day_routine">২৮ মে ২০২২</option>
                            <option value="fifth_day_routine">২৯ মে ২০২২</option>
                            <option value="sixth_day_routine">৩০ মে ২০২২</option>
                            <option value="seventh_day_routine">৩১ মে ২০২২</option>
                            <option value="eighth_day_routine">০১ জুন ২০২২</option>
                          </select>
                        </div>

                        <div class="exam-routine-list first_day_routine">
                          <p><a href="exam.php?id=ssc_ban1_t001">বাংলা ১ম পত্র-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_agr_t001">কৃষি শিক্ষা-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_phy_t001">পদার্থবিজ্ঞান-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_bio_t001">জীববিজ্ঞান -মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_acc_t001">হিসাববিজ্ঞান-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_fin_t001">ফিন্যান্স ও ব্যাংকিং-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_bah_t001">বাংলাদেশের ইতিহাস ও বিশ্ব সভ্যতা-মডেল টেস্ট ১</a></p>
                        </div>
                        <div class="exam-routine-list second_day_routine">
                          <p><a href="exam.php?id=ssc_ban2_t001">বাংলা ২য় পত্র-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_gah_t001">গার্হস্থ্য বিজ্ঞান-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_che_t001">রসায়ন-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_bau_t001">ব্যবসায় উদ্যোগ -মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_eco_t001">অর্থনীতি-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_geo_t001">ভূগোল ও পরিবেশ-মডেল টেস্ট ১</a></p>
                          <p><a href="exam.php?id=ssc_pou_t001">পৌরনীতি ও নাগরিকতা-মডেল টেস্ট ১</a></p>
                        </div>
                        <div class="exam-routine-list third_day_routine">
                          <p><a href="exam.php?id=ssc_ban1_t002">বাংলা ১ম পত্র-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_agr_t002">কৃষি শিক্ষা-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_phy_t002">পদার্থবিজ্ঞান-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_bio_t002">জীববিজ্ঞান -মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_acc_t002">হিসাববিজ্ঞান-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_fin_t002">ফিন্যান্স ও ব্যাংকিং-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_bah_t002">বাংলাদেশের ইতিহাস ও বিশ্ব সভ্যতা-মডেল টেস্ট ২</a></p>
                        </div>

                        <div class="exam-routine-list fourth_day_routine">
                          <p><a href="exam.php?id=ssc_ban2_t002">বাংলা ২য় পত্র-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_gah_t002">গার্হস্থ্য বিজ্ঞান-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_che_t002">রসায়ন-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_bau_t002">ব্যবসায় উদ্যোগ -মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_eco_t002">অর্থনীতি-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_geo_t002">ভূগোল ও পরিবেশ-মডেল টেস্ট ২</a></p>
                          <p><a href="exam.php?id=ssc_pou_t002">পৌরনীতি ও নাগরিকতা-মডেল টেস্ট ২</a></p>
                        </div>

                        <div class="exam-routine-list fifth_day_routine">
                          <p><a href="exam.php?id=ssc_ban1_t003">বাংলা ১ম পত্র-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_agr_t003">কৃষি শিক্ষা-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_phy_t003">পদার্থবিজ্ঞান-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_bio_t003">জীববিজ্ঞান -মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_acc_t003">হিসাববিজ্ঞান-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_fin_t003">ফিন্যান্স ও ব্যাংকিং-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_bah_t003">বাংলাদেশের ইতিহাস ও বিশ্ব সভ্যতা-মডেল টেস্ট ৩</a></p>
                        </div>

                        <div class="exam-routine-list sixth_day_routine">
                          <p><a href="exam.php?id=ssc_ban2_t003">বাংলা ২য় পত্র-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_gah_t003">গার্হস্থ্য বিজ্ঞান-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_che_t003">রসায়ন-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_bau_t003">ব্যবসায় উদ্যোগ -মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_eco_t003">অর্থনীতি-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_geo_t003">ভূগোল ও পরিবেশ-মডেল টেস্ট ৩</a></p>
                          <p><a href="exam.php?id=ssc_pou_t003">পৌরনীতি ও নাগরিকতা-মডেল টেস্ট ৩</a></p>
                        </div>

                        <div class="exam-routine-list seventh_day_routine">
                          <p><a href="exam.php?id=ssc_ban1_t004">বাংলা ১ম পত্র-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_agr_t004">কৃষি শিক্ষা-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_phy_t004">পদার্থবিজ্ঞান-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_bio_t004">জীববিজ্ঞান -মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_acc_t004">হিসাববিজ্ঞান-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_fin_t004">ফিন্যান্স ও ব্যাংকিং-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_bah_t004">বাংলাদেশের ইতিহাস ও বিশ্ব সভ্যতা-মডেল টেস্ট ৪</a></p>
                        </div>

                        <div class="exam-routine-list eighth_day_routine">
                          <p><a href="exam.php?id=ssc_ban2_t004">বাংলা ২য় পত্র-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_gah_t004">গার্হস্থ্য বিজ্ঞান-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_che_t004">রসায়ন-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_bau_t004">ব্যবসায় উদ্যোগ -মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_eco_t004">অর্থনীতি-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_geo_t004">ভূগোল ও পরিবেশ-মডেল টেস্ট ৪</a></p>
                          <p><a href="exam.php?id=ssc_pou_t004">পৌরনীতি ও নাগরিকতা-মডেল টেস্ট ৪</a></p>
                        </div>

                      </div>
                    </div>
                  </div>




            </div>


          </div>
        </div>
      </div>
    </section>

    <div class="container-fluid">
    <div class="container">
        <div class="row">


            <div class="col-md-12">
                <div class="myprofile_margin_reduce profile-bottom-text">
                  <h3>পড়াশোনার এসএসসি মডেল টেস্ট ২০২২ সম্পর্কে গুরুত্বপূর্ণ কিছু তথ্য</h3>

            <ul>
              <li>১। মোট ১৪ টি বিষয়ে মডেল টেস্ট থাকবে। প্রতিটি বিষয়ে চারটি করে মডেল টেস্ট রয়েছে। </li>
              <li>২। যেসব বিষয়ে মডেল টেস্ট থাকছে- বাংলা ১ম পত্র, বাংলা ২য় পত্র, পদার্থবিজ্ঞান, রসায়ন, জীববিজ্ঞান, হিসাববিজ্ঞান, ব্যবসায় উদ্যোগ, ফিন্যান্স ও ব্যাংকিং, বাংলাদেশের ইতিহাস ও বিশ্ব সভ্যতা, ভূগোল ও পরিবেশ, পৌরনীতি ও নাগরিকতা, অর্থনীতি, কৃষি শিক্ষা ও গার্হস্থ্য বিজ্ঞান। গণিত, উচ্চতর গণিত ও ইংরেজি বিষয়ে কোনো মডেল টেস্ট থাকছে না।</li>

              <li>৩। তোমরা যেন সময় নিয়ে অনুশীলন করতে পারো সেজন্য ২৫ মে থেকে প্রতিদিন ধাপে ধাপে মডেল টেস্ট গুলো প্রকাশ করা হবে। সেক্ষেত্রে প্রতিদিন সাতটি বিষয়ে সাতটি মডেল টেস্ট প্রকাশিত হবে। একই মডেল টেস্ট শুধুমাত্র একবার দেয়ার সুযোগ থাকবে। পূর্বের মডেল টেস্টের প্রশ্ন এবং উত্তরগুলো প্রোফাইলের ফলাফল অংশে দেখা যাবে।</li>

              <li>৪। প্রতিদিন বিজ্ঞান, মানবিক, ব্যবসায় প্রতিটি বিভাগ থেকে সর্বোচ্চ নম্বরধারী একজনের নাম, ছবি, এবং বিদ্যালয়ের নাম প্রকাশিত হবে প্রথম আলোর ছাপা কাগজে। আমরা তোমার মোবাইল নম্বরে যোগাযোগ করে তোমার ছবি নিব, সেক্ষেত্রে তোমার নিজের বা অভিভাবকের মোবাইল নম্বরটি দিতে হবে।</li>


            </ul>





 </p>

  </div>
            </div>

        </div>
    </div>
</div>

    <script>

$(document).ready(function() {
  $(".subject_box, .model_test_no, .subject_label, .test_number_label").hide();



	$("#group").change(function() {
		// var selectedVal = $("#myselect option:selected").text();
		var selectedGroup = $("#group option:selected").val();

    if (selectedGroup == ''){
      $("#science_subject").val($("#science_subject option:first").val());
      $("#arts_subject").val($("#arts_subject option:first").val());
      $("#commerce_subject").val($("#commerce_subject option:first").val());
      $("#ban_p1").val($("#ban_p1 option:first").val());
      $("#agri").val($("#agri option:first").val());
      $("#physics").val($("#physics option:first").val());
      $("#biology").val($("#biology option:first").val());
      $("#bangladesh_history").val($("#bangladesh_history option:first").val());
      $("#accounting").val($("#accounting option:first").val());
      $("#finance").val($("#finance option:first").val());

    }

		if (selectedGroup == 'science'){
      $(".subject_box, .model_test_no, .test_number_label").hide();
      $("#arts_subject").val($("#arts_subject option:first").val());
      $("#commerce_subject").val($("#commerce_subject option:first").val());
      $("#science_subject, .subject_label").show();
    }
    if (selectedGroup == 'arts'){
      $(".subject_box, .model_test_no, .test_number_label").hide();
      $("#science_subject").val($("#arts_subject option:first").val());
      $("#commerce_subject").val($("#commerce_subject option:first").val());
      $("#arts_subject, .subject_label").show();
    }

    if (selectedGroup == 'commerce'){
      $(".subject_box, .model_test_no, .test_number_label").hide();
      $("#science_subject").val($("#arts_subject option:first").val());
      $("#arts_subject").val($("#commerce_subject option:first").val());
      $("#commerce_subject, .subject_label").show();
    }

	});

// Start Science Subjects
$("#science_subject").change(function() {
  var selectedSubject = $("#science_subject option:selected").val();

  if (selectedSubject == ''){
      $("#group").val($("#group option:first").val());

      $("#ban_p1").val($("#ban_p1 option:first").val());
      $("#agri").val($("#agri option:first").val());
      $("#physics").val($("#physics option:first").val());
      $("#biology").val($("#biology option:first").val());
      $("#bangladesh_history").val($("#bangladesh_history option:first").val());
      $("#accounting").val($("#accounting option:first").val());
      $("#finance").val($("#finance option:first").val());

    }

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#agri, #physics, #biology").hide();
    $("#ban_p1, .test_number_label").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #physics, #biology").hide();
    $("#agri, .test_number_label").show();
  }
  if (selectedSubject == 'পদার্থবিজ্ঞান'){
    $("#ban_p1, #agri, #biology").hide();
    $("#physics, .test_number_label").show();
  }

  if (selectedSubject == 'জীববিজ্ঞান'){
    $("#ban_p1, #agri, #physics").hide();
    $("#biology, .test_number_label").show();
  }


});

// End Science Subjects

$("#arts_subject").change(function() {
  var selectedSubject = $("#arts_subject option:selected").val();

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#agri, #bangladesh_history").hide();
    $("#ban_p1, .test_number_label").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #bangladesh_history").hide();
    $("#agri, .test_number_label").show();
  }

  if (selectedSubject == 'বাংলাদেশের ইতিহাস ও বিশ্বসভ্যতা'){
    $("#ban_p1, #agri").hide();
    $("#bangladesh_history, .test_number_label").show();
  }
});

$("#commerce_subject").change(function() {
  var selectedSubject = $("#commerce_subject option:selected").val();

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#agri, #accounting, #finance").hide();
    $("#ban_p1, .test_number_label").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #accounting, #finance").hide();
    $("#agri, .test_number_label").show();
  }


  if (selectedSubject == 'হিসাববিজ্ঞান'){
    $("#ban_p1, #agri, #finance").hide();
    $("#accounting, .test_number_label").show();
  }

  if (selectedSubject == 'ফিন্যান্স ও ব্যাংকিং'){
    $("#ban_p1, #agri, #accounting").hide();
    $("#finance, .test_number_label").show();
  }



});

$(".model_test_no").change(function(){
    var selectedModelTest = $(this).children("option:selected").val();
    $(".put_model_test_number").val(selectedModelTest);
    $('.start-exam-from-dashboard').show();
});

$(".second_day_routine, .third_day_routine, .fourth_day_routine, .fifth_day_routine, .sixth_day_routine, .seventh_day_routine, .eighth_day_routine").hide();

$("#routine_select_list").change(function() {
// var selectedVal = $("#myselect option:selected").text();
var selectedGroup = $("#routine_select_list option:selected").val();

if (selectedGroup == 'first_day_routine'){
  $(".second_day_routine, .third_day_routine, .fourth_day_routine, .fifth_day_routine, .sixth_day_routine, .seventh_day_routine, .eighth_day_routine").hide();
  $(".first_day_routine").show();
}

if (selectedGroup == 'second_day_routine'){
  $(".first_day_routine, .third_day_routine, .fourth_day_routine, .fifth_day_routine, .sixth_day_routine, .seventh_day_routine, .eighth_day_routine").hide();
  $(".second_day_routine").show();
}
if (selectedGroup == 'third_day_routine'){
  $(".first_day_routine, .second_day_routine,  .fourth_day_routine, .fifth_day_routine, .sixth_day_routine, .seventh_day_routine, .eighth_day_routine").hide();
  $(".third_day_routine").show();
}
if (selectedGroup == 'fourth_day_routine'){
  $(".first_day_routine, .second_day_routine, .third_day_routine,  .fifth_day_routine, .sixth_day_routine, .seventh_day_routine, .eighth_day_routine").hide();
  $(".fourth_day_routine").show();
}
if (selectedGroup == 'fifth_day_routine'){
  $(".first_day_routine, .second_day_routine, .third_day_routine, .fourth_day_routine, .sixth_day_routine, .seventh_day_routine, .eighth_day_routine").hide();
  $(".fifth_day_routine").show();
}
if (selectedGroup == 'sixth_day_routine'){
  $(".first_day_routine, .second_day_routine, .third_day_routine, .fourth_day_routine, .fifth_day_routine, .seventh_day_routine, .eighth_day_routine").hide();
  $(".sixth_day_routine").show();
}
if (selectedGroup == 'seventh_day_routine'){
  $(".first_day_routine, .second_day_routine, .third_day_routine, .fourth_day_routine, .fifth_day_routine, .sixth_day_routine, .eighth_day_routine").hide();
  $(".seventh_day_routine").show();
}
if (selectedGroup == 'eighth_day_routine'){
  $(".first_day_routine, .second_day_routine, .third_day_routine, .fourth_day_routine, .fifth_day_routine, .sixth_day_routine, .seventh_day_routine").hide();
  $(".eighth_day_routine").show();
}
});

if(!!window.performance && window.performance.navigation.type === 2)
{

    window.location.reload();
}






});
</script>
<?php require 'footer-home.php';?>