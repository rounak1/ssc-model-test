<?php
session_start();
error_reporting(1);
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
require 'connection.php';
require '../settings.php';
require 'header-v2.php';
require '../BanglaConverter.php';
?>

<main>

	<section class="event__area pt-60 pb-30 grey-bg-2">
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
	             <div class="course__filter text-center mb-30">
	                <nav>
	                   <div class="nav nav-tabs justify-content-center" id="course-tab" role="tablist">
	                     <button class="nav-link active" id="nav-todays-tab" data-bs-toggle="tab" data-bs-target="#nav-todays" type="button" role="tab" aria-controls="nav-todays" aria-selected="true">আজকের</button>

	                     <button class="nav-link" id="nav-previous-tab" data-bs-toggle="tab" data-bs-target="#nav-previous" type="button" role="tab" aria-controls="nav-previous" aria-selected="false">গত দিনের</button>

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
                                        					<div class="event__item white-bg mb-10 transition-3 p-relative d-lg-flex align-items-center justify-content-between">

                                        						<div class="event__left d-sm-flex align-items-center">
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
                                             							<a href="quiz.php?specific_questions=<?=$value['id']?>" class="tp-btn-5 tp-btn-7">বিস্তারিত</a>
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


            						?>
												<div class="col-12">
                                      				<div class="event__item white-bg mb-10 transition-3 p-relative d-lg-flex align-items-center justify-content-between">

                                      					<div class="event__left d-sm-flex align-items-center">
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
                                 							<a href="quiz.php?specific_questions=<?=$value['id']?>" class="tp-btn-5 tp-btn-7">বিস্তারিত</a>
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
                                      <div class="event__item white-bg mb-10 transition-3 p-relative d-lg-flex align-items-center justify-content-between">
                                        <div class="event__left d-sm-flex align-items-center">
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
                     							<a href="quiz.php?specific_questions=<?=$value['id']?>" class="tp-btn-5 tp-btn-7">বিস্তারিত</a>
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
		                    <h3 class="section__title-2 pb-25">ফলাফল</h3>
		                </div>

		                <?php
							$sort_by_date = array_column($model_test_list, 'date');
							array_multisort($sort_by_date, SORT_DESC, $model_test_list);

							if (!empty($model_test_list)) {
							    foreach ($model_test_list as $value) {
							        $exam_date = explode("-", $value['date']);
							        $current_date = Date('Y-m-d');

							        if ($current_date == $value['date']) {
							        	$exam_id = $value['id'];
							        	$sql = "select (count(*)) as total_count from quiz_histories WHERE `exam_id` = '$exam_id'";

    									$res = mysqli_query($conn, $sql);
    									$exam_data = mysqli_fetch_assoc($res);

						?>
									<div class="course__member-item my-result-each">
			                          <a href="participants.php?specific_questions=<?=$value['id']?>">
			                            <div class="row align-items-center">
			                              <div class="col-8">
			                                 <div class="course__member-thumb d-flex align-items-center">
			                                    <img class="my-p-r-iccon" src="assets/img/thumb2.svg?v=1.0" alt="">
			                                    <div class="course__member-name ml-20">
			                                       <h5><?=$value['test']?></h5>
			                                       <span><?=$value['subject']?></span>
			                                    </div>
			                                 </div>
			                              </div>
			                              <div class="col-4">
			                                 <div class="course__member-info">
			                                    <h5 style="font-size: 24px;"><?=BanglaConverter::en2bn($exam_data['total_count']);?> জন</h5>
			                                    <span>অংশগ্রহণ</span>
			                                 </div>
			                              </div>
			                           </div>
			                          </a>
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
  	</section>

</main>
<?php require 'footer-v2.php';?>