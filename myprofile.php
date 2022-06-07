<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
error_reporting(1);
$site_title = "ড্যাশবোর্ড :: এসএসসি মডেল টেস্ট ২০২২";
require 'check-login.php';
require 'header-v2.php';
require 'BanglaConverter.php';

include_once 'settings1.php';
include_once 'settings.php';

$query_quiz_result = "SELECT * FROM `quiz_histories` WHERE `user_id` = '$user_id' ORDER BY `id` DESC limit 8";

$result_quiz_data = mysqli_query($conn, $query_quiz_result);

$result = [];

if (!empty($result_quiz_data)) {
    while ($row = mysqli_fetch_array($result_quiz_data)) {
        $result[$row['exam_id']]['exam_id'] = $row['exam_id'];
        $result[$row['exam_id']]['id'] = $row['id'];
        $result[$row['exam_id']]['exam_name'] = $model_test_list[$row['exam_id']]['subject'];
        $result[$row['exam_id']]['total_marks'] = $row['total_marks'];
        $result[$row['exam_id']]['wrong_answers'] = $row['wrong_answers'];
        $result[$row['exam_id']]['not_given_answers'] = $row['not_given_answers'];
        $result[$row['exam_id']]['completion_time'] = $row['completion_time'];
    }
}
?>
  <main class="dashboard">

    <section class="profile__menu pt-120 grey-bg-2">
      <div class="container">
         <div class="row">

            <div class="col-xxl-4 col-md-4">
               <?php require 'menu.php';?>
            </div>

            <div class="col-xxl-8 col-md-8">
                <div class="profile__menu-right mb-20">
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
                                          <?php }?>

                                      </select>


                                      <select name="" class="model_test_no form-control" id="agri">
                                        <option value=""></option>
                                        <?php
$agri = $exam_list['ssc'][0]['science']['subjects'][2]['test'];

for ($i = 0; $i < count($agri); $i++) {?>
                                            <option value="<?php echo $agri[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="gah">
                                        <option value=""></option>
                                        <?php
$gah = $exam_list['ssc'][0]['science']['subjects'][3]['test'];

for ($i = 0; $i < count($gah); $i++) {?>
                                            <option value="<?php echo $gah[$i]['id']; ?>"><?php echo $gah[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="physics">
                                        <option value=""></option>
                                        <?php
$phy = $exam_list['ssc'][0]['science']['subjects'][4]['test'];

for ($i = 0; $i < count($phy); $i++) {?>
                                            <option value="<?php echo $phy[$i]['id']; ?>"><?php echo $phy[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="biology">
                                        <option value=""></option>
                                        <?php
$biology = $exam_list['ssc'][0]['science']['subjects'][5]['test'];

for ($i = 0; $i < count($biology); $i++) {?>
                                            <option value="<?php echo $biology[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="chemistry">
                                        <option value=""></option>
                                        <?php
$chem = $exam_list['ssc'][0]['science']['subjects'][6]['test'];

for ($i = 0; $i < count($chem); $i++) {?>
                                            <option value="<?php echo $chem[$i]['id']; ?>"><?php echo $agri[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="bangladesh_history">
                                        <option value=""></option>

                                        <?php
$bangladesh_history = $exam_list['ssc'][1]['arts']['subjects'][4]['test'];

for ($i = 0; $i < count($bangladesh_history); $i++) {?>
                                            <option value="<?php echo $bangladesh_history[$i]['id']; ?>"><?php echo $bangladesh_history[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="geography">
                                        <option value=""></option>

                                        <?php
$geography = $exam_list['ssc'][1]['arts']['subjects'][5]['test'];

for ($i = 0; $i < count($geography); $i++) {?>
                                            <option value="<?php echo $geography[$i]['id']; ?>"><?php echo $geography[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>


                                      <select name="" class="model_test_no form-control" id="pouroniti">
                                        <option value=""></option>

                                        <?php
$pouroniti = $exam_list['ssc'][1]['arts']['subjects'][6]['test'];

for ($i = 0; $i < count($pouroniti); $i++) {?>
                                            <option value="<?php echo $pouroniti[$i]['id']; ?>"><?php echo $pouroniti[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="accounting">
                                        <option value=""></option>

                                        <?php
$accounting = $exam_list['ssc'][2]['commerce']['subjects'][4]['test'];

for ($i = 0; $i < count($accounting); $i++) {?>
                                            <option value="<?php echo $accounting[$i]['id']; ?>"><?php echo $accounting[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="finance">
                                        <option value=""></option>

                                        <?php
$finance = $exam_list['ssc'][2]['commerce']['subjects'][5]['test'];

for ($i = 0; $i < count($finance); $i++) {?>
                                            <option value="<?php echo $finance[$i]['id']; ?>"><?php echo $finance[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="bab_uddog">
                                        <option value=""></option>

                                        <?php
$bab_uddog = $exam_list['ssc'][2]['commerce']['subjects'][6]['test'];

for ($i = 0; $i < count($bab_uddog); $i++) {?>
                                            <option value="<?php echo $bab_uddog[$i]['id']; ?>"><?php echo $bab_uddog[$i]['test_name']; ?></option>
                                          <?php }?>

                                      </select>

                                      <select name="" class="model_test_no form-control" id="economics">
                                        <option value=""></option>

                                        <?php
$economics = $exam_list['ssc'][2]['commerce']['subjects'][7]['test'];

for ($i = 0; $i < count($economics); $i++) {?>
                                            <option value="<?php echo $economics[$i]['id']; ?>"><?php echo $economics[$i]['test_name']; ?></option>
                                          <?php }?>

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
          <div class="col-12 col-md-6 mb-30">
            <div class="row">
              <div class="col-xxl-12">
                 <div class="section__title-wrapper-2 text-center mb-30">
                    <h3 class="section__title-2">রুটিন</h3>
                 </div>
              </div>
            </div>

            <div class="row">
             <div class="course__filter text-center mb-10">
                <nav>
                   <div class="nav nav-tabs justify-content-center" id="course-tab" role="tablist">
                     <button class="nav-link" id="nav-previous-tab" data-bs-toggle="tab" data-bs-target="#nav-previous" type="button" role="tab" aria-controls="nav-previous" aria-selected="false">বিগত দিনের</button>

                     <button class="nav-link active" id="nav-todays-tab" data-bs-toggle="tab" data-bs-target="#nav-todays" type="button" role="tab" aria-controls="nav-todays" aria-selected="true">আজকের</button>

                     <button class="nav-link" id="nav-next-tab" data-bs-toggle="tab" data-bs-target="#nav-next" type="button" role="tab" aria-controls="nav-next" aria-selected="false">আগামী দিনের</button>
                   </div>
                </nav>
             </div>
            </div>
            <div class="row">
                <div class="col-xxl-12">
                   <div class="tab-content course__tab-content" id="course-tabContent">
                      <div class="tab-pane fade show active" id="nav-todays" role="tabpanel" aria-labelledby="nav-todays-tab">
                         <div class="course__tab-wrapper">
                            <div class="row">

                              <?php
$sort_by_date = array_column($model_test_list, 'date');
array_multisort($sort_by_date, SORT_ASC, $model_test_list);

if (!empty($model_test_list)) {
    foreach ($model_test_list as $value) {
        $exam_date = explode("-", $value['date']);
        $current_date = Date('Y-m-d');

        if ($current_date == $value['date']) {
            ?>
                                      <div class="col-12">
                                        <div class="event__item white-bg mb-10 transition-3 p-relative d-flex align-items-center justify-content-between">
                                          <div class="event__left d-flex align-items-center">
                                             <div class="event__date">
                                                <h4><?=BanglaConverter::en2bn($exam_date[2])?></h4>
                                                <p><?=$monthsObj[$exam_date[1]]?>, <?=BanglaConverter::en2bn($exam_date[0])?></p>
                                             </div>
                                             <div class="event__content">
                                                <div class="event__meta">
                                                   <ul>
                                                      <li>
                                                        <?=$value['subject']?>
                                                      </li>
                                                   </ul>
                                                </div>
                                                <h3 class="event__title">
                                                  <?=$value['test']?>
                                                </h3>
                                             </div>
                                          </div>
                                          <div class="event__right d-flex align-items-center">
                                             <div class="event__more ml-30">
                                                <?php
if (!empty($find_already_attend) && count($find_already_attend) > 0) {
                ?>

                                                      <a href="result?id=<?=$find_already_attend['id']?>" class="tp-btn-5 tp-btn-7">ফলাফল দেখো</a>
                                                <?php
} else {
                ?>
                                                      <a href="exam?id=<?=$value['id']?>" class="tp-btn-5 tp-btn-7">শুরু করো</a>

                                                <?php
}
            ?>
                                             </div>
                                          </div>
                                       </div>
                                     </div>
                                <?php
}
    }
}
?>

                            </div>
                         </div>
                      </div>
                      <div class="tab-pane fade" id="nav-previous" role="tabpanel" aria-labelledby="nav-previous-tab">
                         <div class="row">

                            <?php
$sort_by_date = array_column($model_test_list, 'date');
array_multisort($sort_by_date, SORT_DESC, $model_test_list);

if (!empty($model_test_list)) {
    foreach ($model_test_list as $value) {
        $exam_date = explode("-", $value['date']);
        $current_date = Date('Y-m-d');

        if ($current_date > $value['date']) {

            $find_already_attend = $result[$value['id']];

            ?>
                                      <div class="col-12">
                                        <div class="event__item white-bg mb-10 transition-3 p-relative d-flex align-items-center justify-content-between">
                                          <div class="event__left d-flex align-items-center">
                                             <div class="event__date">
                                                <h4><?=BanglaConverter::en2bn($exam_date[2])?></h4>
                                                <p><?=$monthsObj[$exam_date[1]]?>, <?=BanglaConverter::en2bn($exam_date[0])?></p>
                                             </div>
                                             <div class="event__content">
                                                <div class="event__meta">
                                                   <ul>
                                                      <li>
                                                        <?=$value['subject']?>
                                                        </li>
                                                   </ul>
                                                </div>
                                                <h3 class="event__title">
                                                  <?=$value['test']?>
                                                </h3>
                                             </div>
                                          </div>
                                          <div class="event__right d-sm-flex align-items-center">
                                             <div class="event__more ml-30">
                                              <?php
if ( !empty($find_already_attend) && count($find_already_attend) > 0) {
                ?>

                                                    <a href="result?id=<?=$find_already_attend['id']?>" class="tp-btn-5 tp-btn-7">ফলাফল দেখো</a>
                                              <?php
} else {
                ?>
                                                    <a href="exam?id=<?=$value['id']?>" class="tp-btn-5 tp-btn-7">শুরু করো</a>

                                              <?php
}
            ?>

                                             </div>
                                          </div>
                                       </div>
                                     </div>
                                <?php
}
    }
}
?>

                         </div>
                      </div>
                      <div class="tab-pane fade" id="nav-next" role="tabpanel" aria-labelledby="nav-next-tab">
                         <div class="row">

                            <?php
$sort_by_date = array_column($model_test_list, 'date');
array_multisort($sort_by_date, SORT_ASC, $model_test_list);

if (!empty($model_test_list)) {
    foreach ($model_test_list as $value) {
        $exam_date = explode("-", $value['date']);
        $current_date = Date('Y-m-d');

        if ($current_date < $value['date']) {
            ?>
                                    <div class="col-12">
                                      <div class="event__item white-bg mb-10 transition-3 p-relative d-flex align-items-center justify-content-between">
                                        <div class="event__left d-flex align-items-center">
                                           <div class="event__date">
                                              <h4><?=BanglaConverter::en2bn($exam_date[2])?></h4>
                                              <p><?=$monthsObj[$exam_date[1]]?>, <?=BanglaConverter::en2bn($exam_date[0])?></p>
                                           </div>
                                           <div class="event__content">
                                              <div class="event__meta">
                                                 <ul>
                                                    <li>
                                                        <?=$value['subject']?>
                                                    </li>
                                                 </ul>
                                              </div>
                                              <h3 class="event__title">
                                                <?=$value['test']?>
                                              </h3>
                                           </div>
                                        </div>
                                     </div>
                                   </div>
                              <?php
}
    }
}
?>

                         </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>

          <div class="col-12 col-md-6">

            <div class="row">
              <div class="col-12">
                <div class="course__member mb-45">
                  <div class="text-center">
                    <h3 class="section__title-2 pb-25">আমার ফলাফল</h3>
                  </div>

                  <?php
if (!empty($result)) {
    foreach ($result as $data) {
        ?>

                        <div class="course__member-item my-result-each">
                          <a href="result.php?id=<?=$data['id']?>">
                            <div class="row align-items-center">
                              <div class="col-5">
                                 <div class="course__member-thumb d-flex align-items-center">
                                    <img class="my-p-r-iccon" src="assets/img/thumb2.svg?v=1.0" alt="">
                                    <div class="course__member-name ml-20 pr-10">
                                       <h5><?=$model_test_list[$data['exam_id']]['test']?></h5>
                                       <span><?=$data['exam_name']?></span>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-2">
                                 <div class="course__member-info">
                                    <h5><?=BanglaConverter::en2bn($data['total_marks'] + $data['wrong_answers'] + $data['not_given_answers']);?></h5>
                                    <span>পূর্ণমান</span>
                                 </div>
                              </div>
                              <div class="col-2">
                                 <div class="course__member-info">
                                    <h5><?=BanglaConverter::en2bn($data['total_marks'])?></h5>
                                    <span>সঠিক</span>
                                 </div>
                              </div>
                              <div class="col-3">
                                 <div class="course__member-info">
                                    <h5>
                                      <?php
$init = $data['completion_time'];
        $minutes = BanglaConverter::en2bn(floor(($init / 60) % 60));
        $seconds = BanglaConverter::en2bn($init % 60);
        echo "$minutes:$seconds মিনিট";
        ?>
                                    </h5>
                                    <span>সময়</span>

                                 </div>
                              </div>
                           </div>
                          </a>
                        </div>

                  <?php
}
}
?>

               </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="event__area pb-30 pt-30">
      <div class="container">
          <div class="row">
              <div class="col-12 col-md-6">
                <div class="grey-bg-2 pt-30 pl-30 pr-30 pb-1 ">

                  <div class="course__description-list mb-45">
                     <h4>নিয়মাবলি</h4>
                     <ul>
                        <li> <i class="fa-solid fa-check"></i> প্রতিটি মডেল টেস্টে মোট ৩০টি অথবা ২৫টি MCQ প্রশ্ন থাকবে এবং প্রতিটি প্রশ্নের মান ১।</li>
                        <li> <i class="fa-solid fa-check"></i> একই মডেল টেস্ট শুধু একবার দেওয়ার সুযোগ থাকবে।</li>
                        <li> <i class="fa-solid fa-check"></i> কোনো ভুল উত্তরের জন্য অতিরিক্ত নম্বর কাটা হবে না।</li>
                        <li> <i class="fa-solid fa-check"></i> মডেল টেস্ট শুরু করার পর ট্যাব পরিবর্তন করলে কিংবা ট্যাব বন্ধ করে ফেললে স্বয়ংক্রিয়ভাবে সাবমিট হয়ে যাবে। সে ক্ষেত্রে টেস্টটি পুনরায় দেওয়ার কোনো সুযোগ নেই।</li>
                        <li> <i class="fa-solid fa-check"></i> মডেল টেস্ট নিয়ে কোনো জিজ্ঞাসা থাকলে ‘পড়াশোনা-প্রথম আলো’র ফেসবুক পেজের মেসেঞ্জারে যোগাযোগ করো।</li>
                     </ul>
                  </div>

                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="grey-bg-2 pt-30 pl-30 pr-30 pb-1 ">

                  <div class="course__description-list mb-45">
                     <h4>গুরুত্বপূর্ণ কিছু তথ্য</h4>
                     <ul>
                        <li> <i class="fa-solid fa-check"></i> মোট ১৪ টি বিষয়ে মডেল টেস্ট রয়েছে এবং প্রতিটি বিষয়ে চারটি করে মডেল টেস্ট রয়েছে।</li>
                        <li> <i class="fa-solid fa-check"></i>যেসব বিষয়ে মডেল টেস্ট থাকছে: বাংলা ১ম পত্র, বাংলা ২য় পত্র, পদার্থবিজ্ঞান, রসায়ন, জীববিজ্ঞান, হিসাববিজ্ঞান, ব্যবসায় উদ্যোগ, ফিন্যান্স ও ব্যাংকিং, বাংলাদেশের ইতিহাস ও বিশ্ব সভ্যতা, ভূগোল ও পরিবেশ, পৌরনীতি ও নাগরিকতা, অর্থনীতি, কৃষিশিক্ষা ও গার্হস্থ্য বিজ্ঞান।</li>
                        <li> <i class="fa-solid fa-check"></i> গণিত, উচ্চতর গণিত ও ইংরেজি বিষয়ে কোনো মডেল টেস্ট থাকছে না।</li>
                        <li> <i class="fa-solid fa-check"></i> তোমরা যেন সময় নিয়ে অনুশীলন করতে পারো, সে জন্য ৯ জুন থেকে প্রতিদিন ধাপে ধাপে মডেল টেস্টগুলো প্রকাশ করা হবে। সে ক্ষেত্রে প্রতিদিন সাতটি বিষয়ের প্রতিটিতে একটি করে মোট সাতটি মডেল টেস্ট প্রকাশিত হবে। তোমাদের সুবিধামতো যেকোনো দিন মডেল টেস্ট দিতে পারবে, তবে একই মডেল টেস্ট শুধু একবার দেওয়ার সুযোগ থাকবে। </li>
                        <li> <i class="fa-solid fa-check"></i> পূর্বের মডেল টেস্টের প্রশ্ন ও উত্তরগুলো প্রোফাইলের ফলাফল অংশে দেখা যাবে। </li>
                     </ul>
                  </div>

                </div>
              </div>
          </div>
      </div>
    </section>

  </main>


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