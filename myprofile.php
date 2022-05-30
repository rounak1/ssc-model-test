<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
error_reporting(1);
require 'check-login.php';
require 'header-v2.php';
require 'BanglaConverter.php';

include_once 'settings1.php';
include_once 'settings.php';

$query_quiz_result = "SELECT * FROM `quiz_histories` WHERE `user_id` = '$user_id' ORDER BY `id` DESC";

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
  <main>

    <section class="profile__menu pt-120 grey-bg-2">
      <div class="container">
         <div class="row">

            <div class="col-xxl-4 col-md-4">
               <div class="profile__menu-left white-bg mb-50">
                  <h3 class="profile__menu-title">
                    <strong> <?php echo $user_data['name']; ?></strong><br/>
                    <span><?php echo $user_data['school_name']; ?></span><br/>
                    <span><?php echo $user_data['district']; ?></span>
                  </h3>
                  <div class="profile__menu-tab">
                     <div class="nav nav-tabs flex-column justify-content-start text-start" >
                        <a class="nav-link" href="editprofile.php"> <i class="fa-regular fa-user"></i> এডিট প্রোফাইল</a>
                        
                        <a class="nav-link" href="logout.php"> <i class="fa-regular fa-arrow-right-from-bracket"></i> লগ আউট</a>
                     </div>

                   </div>
               </div>
            </div>

            <div class="col-xxl-8 col-md-8">
                <div class="profile__menu-right">
                  <div class="tab-content" id="nav-tabContent">
                      <div class="tab-pane fade show active" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">
                        <div class="profile__info">

                          <div class="profile__info-wrapper white-bg">

                            <div class="quiz-play-information pt-30 pb-20">
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

                              <h3 class="postbox__title mb-0">
                                 এসএসসি মডেল টেস্ট ২০২২
                              </h3>
                              <p>মডেল টেস্ট শুরু করতে বিভাগ, বিষয় ও মডেল টেস্টের নাম সিলেক্ট করো</p>
                              
                              <form action="exam.php" method="POST" name="subject_selection">

                                <div class="exam-selection-container">
                      
                                  <?php

                                    $science_subjects = $exam_list['ssc'][0]['science']['subjects'];
                                    $arts_subjects = $exam_list['ssc'][1]['arts']['subjects'];
                                    $commerce_subjects = $exam_list['ssc'][2]['commerce']['subjects'];

                                  ?>
                                  <div class="form-group row mb-15">
                                    <h3 class="col-sm-2 col-form-label mt-label">বিভাগ</h3>
                                    <div class="col-sm-10">
                                    <select name="group" id="group" class="form-control">
                                        <option value=""></option>
                                        <option value="science">বিজ্ঞান</option>
                                        <option value="arts">মানবিক</option>
                                        <option value="commerce">ব্যবসায়</option>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row mb-15">
                                    <h3 class="col-sm-2 col-form-label mt-label subject_label">বিষয়</h3>

                                    <div class="col-sm-10">

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


                                  <div class="form-group row test_container mb-15">
                                    <h3 class="col-sm-2 col-form-label mt-label test_number_label">মডেল টেস্ট</h3>
                                    <div class="col-sm-10">

                                      <select name="" class="model_test_no form-control" id="ban_p1">
                                        <option value=""></option>

                                        <?php
                                          $bangla_p1 = $exam_list['ssc'][0]['science']['subjects'][0]['test'];

                                          for ($i = 0; $i < count($bangla_p1); $i++) {?>
                                            <option value="<?php echo $bangla_p1[$i]['id']; ?>"><?php echo $bangla_p1[$i]['test_name']; ?></option>
                                          <?php }

                                        ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="ban_p2">
                                        <option value=""></option>

                                        <?php
                                          $bangla_p2 = $exam_list['ssc'][0]['science']['subjects'][1]['test'];

                                          for ($i = 0; $i < count($bangla_p2); $i++) {?>
                                            <option value="<?php echo $bangla_p2[$i]['id']; ?>"><?php echo $bangla_p2[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>


                                      <select name="" class="model_test_no form-control" id="agri">
                                        <option value=""></option>
                                        <?php
                                          $agri = $exam_list['ssc'][0]['science']['subjects'][2]['test'];

                                          for ($i = 0; $i < count($agri); $i++) {?>
                                            <option value="<?php echo $agri[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="gah">
                                        <option value=""></option>
                                        <?php
                                          $gah = $exam_list['ssc'][0]['science']['subjects'][3]['test'];

                                          for ($i = 0; $i < count($gah); $i++) {?>
                                            <option value="<?php echo $gah[$i]['id']; ?>"><?php echo $gah[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="physics">
                                        <option value=""></option>
                                        <?php
                                          $phy = $exam_list['ssc'][0]['science']['subjects'][4]['test'];

                                          for ($i = 0; $i < count($phy); $i++) {?>
                                            <option value="<?php echo $phy[$i]['id']; ?>"><?php echo $phy[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="biology">
                                        <option value=""></option>
                                        <?php
                                          $biology = $exam_list['ssc'][0]['science']['subjects'][5]['test'];

                                          for ($i = 0; $i < count($biology); $i++) {?>
                                            <option value="<?php echo $biology[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="chemistry">
                                        <option value=""></option>
                                        <?php
                                          $chem = $exam_list['ssc'][0]['science']['subjects'][6]['test'];

                                          for ($i = 0; $i < count($chem); $i++) {?>
                                            <option value="<?php echo $chem[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="bangladesh_history">
                                        <option value=""></option>

                                        <?php
                                          $bangladesh_history = $exam_list['ssc'][1]['arts']['subjects'][4]['test'];

                                          for ($i = 0; $i < count($bangladesh_history); $i++) {?>
                                            <option value="<?php echo $bangladesh_history[$i]['id']; ?>"><?php echo $bangladesh_history[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="geography">
                                        <option value=""></option>

                                        <?php
                                          $geography = $exam_list['ssc'][1]['arts']['subjects'][5]['test'];

                                          for ($i = 0; $i < count($geography); $i++) {?>
                                            <option value="<?php echo $geography[$i]['id']; ?>"><?php echo $geography[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>


                                      <select name="" class="model_test_no form-control" id="pouroniti">
                                        <option value=""></option>

                                        <?php
                                          $pouroniti = $exam_list['ssc'][1]['arts']['subjects'][6]['test'];

                                          for ($i = 0; $i < count($pouroniti); $i++) {?>
                                            <option value="<?php echo $pouroniti[$i]['id']; ?>"><?php echo $pouroniti[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="accounting">
                                        <option value=""></option>

                                        <?php
                                          $accounting = $exam_list['ssc'][2]['commerce']['subjects'][4]['test'];

                                          for ($i = 0; $i < count($accounting); $i++) {?>
                                            <option value="<?php echo $accounting[$i]['id']; ?>"><?php echo $accounting[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="finance">
                                        <option value=""></option>

                                        <?php
                                          $finance = $exam_list['ssc'][2]['commerce']['subjects'][5]['test'];

                                          for ($i = 0; $i < count($finance); $i++) {?>
                                            <option value="<?php echo $finance[$i]['id']; ?>"><?php echo $finance[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="bab_uddog">
                                        <option value=""></option>

                                        <?php
                                          $bab_uddog = $exam_list['ssc'][2]['commerce']['subjects'][6]['test'];

                                          for ($i = 0; $i < count($bab_uddog); $i++) {?>
                                            <option value="<?php echo $bab_uddog[$i]['id']; ?>"><?php echo $bab_uddog[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="economics">
                                        <option value=""></option>

                                        <?php
                                          $economics = $exam_list['ssc'][2]['commerce']['subjects'][7]['test'];

                                          for ($i = 0; $i < count($economics); $i++) {?>
                                            <option value="<?php echo $economics[$i]['id']; ?>"><?php echo $economics[$i]['test_name']; ?></option>
                                          <?php } ?>

                                      </select>


                                    </div>
                                    <input type="hidden" name="test_number" class="put_model_test_number">
                                  </div>


                                  <div class="start-exam-from-dashboard mt-15">
                                     <input type="submit" value="মডেল টেস্ট শুরু করো" class="tp-btn" id="start_exam_container" name="subject_selection" />
                                  </div>

                                </div>
                              </form>

                            </div>

                          </div>

                        </div>
                      </div>
                  </div>
                </div>
            </div>

         </div>
       </div>
    </section>

    <section class="event__area pb-30 grey-bg-2">
      <div class="container">

        <div class="row">
          <div class="col-xxl-12">
             <div class="section__title-wrapper-2 text-center mb-30">
                <h3 class="section__title-2">মডেল টেস্ট রুটিন</h3>
             </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xxl-12">

            <div class="event__item white-bg mb-10 transition-3 p-relative d-lg-flex align-items-center justify-content-between">
              <div class="event__left d-sm-flex align-items-center">
                 <div class="event__date">
                    <h4>02</h4>
                    <p>October, 2022</p>
                 </div>
                 <div class="event__content">
                    <div class="event__meta">
                       <ul>
                          <li>
                             <a href="#"><svg width="17" height="17" viewbox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8.49992 9.51253C9.72047 9.51253 10.7099 8.52308 10.7099 7.30253C10.7099 6.08198 9.72047 5.09253 8.49992 5.09253C7.27937 5.09253 6.28992 6.08198 6.28992 7.30253C6.28992 8.52308 7.27937 9.51253 8.49992 9.51253Z" stroke="#5F6160" stroke-width="1.5"></path>
                                <path d="M2.56416 6.01334C3.95958 -0.120822 13.0475 -0.113738 14.4358 6.02043C15.2504 9.61876 13.0121 12.6646 11.05 14.5488C9.62625 15.9229 7.37375 15.9229 5.94291 14.5488C3.98791 12.6646 1.74958 9.61168 2.56416 6.01334Z" stroke="#5F6160" stroke-width="1.5"></path>
                                </svg>
                                New York, US</a>
                          </li>
                       </ul>
                    </div>
                    <h3 class="event__title">
                       <a href="event-details.html">Global education fall meeting for everyone</a>
                    </h3>

                    <div class="event__person">
                       <ul>
                          <li>
                             <a href="#">
                                <img src="assets/img/event/event-person-1.jpg" alt="">
                                <img src="assets/img/event/event-person-2.jpg" alt="">
                                <span>David Karry</span>
                             </a>
                          </li>
                       </ul>
                    </div>
                 </div>
              </div>
              <div class="event__right d-sm-flex align-items-center">
                 <div class="event__time">
                    <span>
                       <svg width="15" height="15" viewbox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M13.75 7.50024C13.75 10.9502 10.95 13.7502 7.5 13.7502C4.05 13.7502 1.25 10.9502 1.25 7.50024C1.25 4.05024 4.05 1.25024 7.5 1.25024C10.95 1.25024 13.75 4.05024 13.75 7.50024Z" stroke="#258E46" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                          <path d="M9.8188 9.48735L7.8813 8.3311C7.5438 8.1311 7.2688 7.64985 7.2688 7.2561V4.6936" stroke="#258E46" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                       </svg>
                       10:30am - 12:30pm
                    </span>
                 </div>
                 <div class="event__more ml-30">
                    <a href="event-details.html" class="tp-btn-5 tp-btn-7">View Events </a>
                 </div>
              </div>
           </div>

           

          </div>
        </div>

      </div>
    </section>

  </main>

    <section class="testimony-section">
      <div class="container">

        <div
          id="myprofile_section"
          class="row justify-content-center mb-5 pb-3"
        >

          <div class="col-md-12">
            <div class="profile-container myprofile-body-portion">
              <div class="account-information">

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



              </div>
              <div class="quiz-play-information">

                
              </div>
                  <div class="row profile-bottom-content">
                    <div class="col-md-6">
                      <div class="rules-container">
                        <h2>নিয়মাবলি</h2>
                        <ul>
                          <li>১. প্রতিটি মডেল টেস্টে মোট ৩০টি অথবা ২৫টি MCQ প্রশ্ন থাকবে, প্রতিটি প্রশ্নের পূর্ণমান ১ এবং প্রতিটি প্রশ্নের জন্য সময় থাকবে ১ মিনিট।</li>
                          <li>২. একই মডেল টেস্ট শুধু একবার দেওয়ার সুযোগ থাকবে। মডেল টেস্ট শুরু করার পর ট্যাব পরিবর্তন করলে কিংবা, ট্যাব বন্ধ করে ফেললে স্বয়ংক্রিয়ভাবে সাবমিট হয়ে যাবে। সে ক্ষেত্রে টেস্টটি পুনরায় দেওয়া কিংবা পুনঃনিরীক্ষণের কোনো সুযোগ নেই।</li>
                          <li>৩. মডেল টেস্ট নিয়ে কোনো জিজ্ঞাসা থাকলে পড়াশোনা - প্রথম আলোর  ফেসবুক পেজের মেসেঞ্জারে যোগাযোগ করো।</li>
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
              <li>১। মোট ১৪ টি বিষয়ে মডেল টেস্ট রয়েছে এবং প্রতিটি বিষয়ে চারটি করে মডেল টেস্ট রয়েছে। </li>
              <li>২। যেসব বিষয়ে মডেল টেস্ট থাকছেঃ বাংলা ১ম পত্র, বাংলা ২য় পত্র, পদার্থবিজ্ঞান, রসায়ন, জীববিজ্ঞান, হিসাববিজ্ঞান, ব্যবসায় উদ্যোগ, ফিন্যান্স ও ব্যাংকিং, বাংলাদেশের ইতিহাস ও বিশ্ব সভ্যতা, ভূগোল ও পরিবেশ, পৌরনীতি ও নাগরিকতা, অর্থনীতি, কৃষিশিক্ষা ও গার্হস্থ্য বিজ্ঞান। গণিত, উচ্চতর গণিত ও ইংরেজি বিষয়ে কোনো মডেল টেস্ট থাকছে না।</li>

              <li>৩। তোমরা যেন সময় নিয়ে অনুশীলন করতে পারো সে জন্য ১ জুন থেকে প্রতিদিন ধাপে ধাপে মডেল টেস্টগুলো প্রকাশ করা হবে। সে ক্ষেত্রে প্রতিদিন সাতটি বিষয়ের প্রতিটিতে একটি করে মোট সাতটি মডেল টেস্ট প্রকাশিত হবে। একই মডেল টেস্ট শুধু একবার দেওয়ার সুযোগ থাকবে। পূর্বের মডেল টেস্টের প্রশ্ন ও উত্তরগুলো প্রোফাইলের ফলাফল অংশে দেখা যাবে।</li>

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
      $("#ban_p2").val($("#ban_p1 option:first").val());
      $("#agri").val($("#agri option:first").val());
      $("#gah").val($("#gah option:first").val());
      $("#physics").val($("#physics option:first").val());
      $("#biology").val($("#biology option:first").val());
      $("#chemistry").val($("#chemistry option:first").val());


      $("#bangladesh_history").val($("#bangladesh_history option:first").val());
      $("#geography").val($("#geography option:first").val());
      $("#pouroniti").val($("#pouroniti option:first").val());


      $("#accounting").val($("#accounting option:first").val());
      $("#finance").val($("#finance option:first").val());
      $("#bab_uddog").val($("#bab_uddog option:first").val());
      $("#economics").val($("#economics option:first").val());

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
      $("#ban_p2").val($("#ban_p1 option:first").val());
      $("#agri").val($("#agri option:first").val());
      $("#gah").val($("#gah option:first").val());

      $("#physics").val($("#physics option:first").val());
      $("#biology").val($("#biology option:first").val());
      $("#chemistry").val($("#chemistry option:first").val());

      $("#bangladesh_history").val($("#bangladesh_history option:first").val());
      $("#geography").val($("#geography option:first").val());
      $("#pouroniti").val($("#pouroniti option:first").val());

      $("#accounting").val($("#accounting option:first").val());
      $("#finance").val($("#finance option:first").val());
      $("#bab_uddog").val($("#bab_uddog option:first").val());
      $("#economics").val($("#economics option:first").val());

    }

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#ban_p2, #agri, #physics, #gah, #biology, #chemistry").hide();
    $("#ban_p1, .test_number_label").show();
  }

  if (selectedSubject == 'বাংলা ২য় পত্র'){
    $("#ban_p1, #agri, #physics, #gah, #biology, #chemistry").hide();
    $("#ban_p2, .test_number_label").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #ban_p2, #physics, #gah, #biology, #chemistry").hide();
    $("#agri, .test_number_label").show();
  }
  if (selectedSubject == 'গার্হস্থ্য বিজ্ঞান'){
    $("#ban_p1, #ban_p2, #agri, #physics, #biology, #chemistry").hide();
    $("#gah, .test_number_label").show();
  }

  if (selectedSubject == 'পদার্থবিজ্ঞান'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #biology, #chemistry").hide();
    $("#physics, .test_number_label").show();
  }

  if (selectedSubject == 'জীববিজ্ঞান'){
    $("#ban_p1, #ban_p2, #agri, #physics, #gah,  #chemistry").hide();
    $("#biology, .test_number_label").show();
  }

  if (selectedSubject == 'রসায়ন'){
    $("#ban_p1, #ban_p2, #agri, #physics, #gah, #biology").hide();
    $("#chemistry, .test_number_label").show();
  }


});

// End Science Subjects

$("#arts_subject").change(function() {
  var selectedSubject = $("#arts_subject option:selected").val();

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #bangladesh_history, #geography, #pouroniti").hide();
    $("#ban_p1, .test_number_label").show();
  }

  if (selectedSubject == 'বাংলা ২য় পত্র'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #bangladesh_history, #geography, #pouroniti").hide();
    $("#ban_p1, .test_number_label").show();
  }


  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #ban_p2,  #gah, #bangladesh_history, #geography, #pouroniti").hide();
    $("#agri, .test_number_label").show();
  }

  if (selectedSubject == 'গার্হস্থ্য বিজ্ঞান'){
    $("#ban_p1, #ban_p2, #agri,  #bangladesh_history, #geography, #pouroniti").hide();
    $("#gah, .test_number_label").show();
  }

  if (selectedSubject == 'বাংলাদেশের ইতিহাস ও বিশ্বসভ্যতা'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #geography, #pouroniti").hide();
    $("#bangladesh_history, .test_number_label").show();
  }

  if (selectedSubject == 'ভূগোল ও পরিবেশ'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #bangladesh_history, #pouroniti").hide();
    $("#geography, .test_number_label").show();
  }

  if (selectedSubject == 'পৌরনীতি ও নাগরিকতা'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #bangladesh_history, #geography").hide();
    $("#pouroniti, .test_number_label").show();
  }
});

$("#commerce_subject").change(function() {
  var selectedSubject = $("#commerce_subject option:selected").val();

  if (selectedSubject == 'বাংলা ১ম পত্র'){
    $("#ban_p2, #agri,  #gah, #accounting, #finance, #bab_uddog, #economics").hide();
    $("#ban_p1, .test_number_label").show();
  }

  if (selectedSubject == 'বাংলা ২য় পত্র'){
    $("#ban_p1,  #agri,  #gah, #accounting, #finance, #bab_uddog, #economics").hide();
    $("#ban_p2, .test_number_label").show();
  }

  if (selectedSubject == 'কৃষি শিক্ষা'){
    $("#ban_p1, #ban_p2,  #gah, #accounting, #finance, #bab_uddog, #economics").hide();
    $("#agri, .test_number_label").show();
  }

  if (selectedSubject == 'গার্হস্থ্য বিজ্ঞান'){
    $("#ban_p1, #ban_p2, #agri, #accounting, #finance, #bab_uddog, #economics").hide();
    $("#gah, .test_number_label").show();
  }


  if (selectedSubject == 'হিসাববিজ্ঞান'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #finance, #bab_uddog, #economics").hide();
    $("#accounting, .test_number_label").show();
  }

  if (selectedSubject == 'ফিন্যান্স ও ব্যাংকিং'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #accounting, #bab_uddog, #economics").hide();
    $("#finance, .test_number_label").show();
  }

  if (selectedSubject == 'ব্যবসায় উদ্যোগ'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #accounting, #finance,  #economics").hide();
    $("#bab_uddog, .test_number_label").show();
  }

  if (selectedSubject == 'অর্থনীতি'){
    $("#ban_p1, #ban_p2, #agri,  #gah, #accounting, #bab_uddog, #finance").hide();
    $("#economics, .test_number_label").show();
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
<?php require 'footer-v2.php';?>