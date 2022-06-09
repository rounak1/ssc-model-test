<?php
session_start();
error_reporting(1);
$site_title = "মডেল টেস্টের ফলাফল :: মডেল টেস্ট - প্রথম আলো";
require 'check-login.php';
require 'header-v2.php';
require 'BanglaConverter.php';
include_once 'settings.php';

$query_quiz_result = "SELECT * FROM `quiz_histories` WHERE `user_id` = '$user_id' ORDER BY `id` DESC";

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

	<section class="course__area grey-bg-2 pt-115 pb-90">
	  <div class="container">
	    <div class="row">

	    	<div class="col-12">
        		<div class="course__wrapper">
        			<?php
						if (!empty($result)) {
					?>
							<div class="row">
								<div class="col-12 col-md-4">
					               <?php require 'menu.php';?>
					            </div>

					            <div class="col-12 col-md-8">

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
					<?php } else { ?>
						<div class="alert alert-primary text-center" role="alert">
			              তুমি এখনো কোনো মডেল টেস্টে অংশগ্রহণ করোনি।
			            </div>
					<?php } ?>
        		</div>
        	</div>

	    </div>
	  </div>
	</section>


<?php 
	require 'footer-v2.php';
?>