<?php 
$site_title = "মডেল টেস্ট - প্রথম আলো";
   require 'header-v2.php';
?>


      <main>

         <!-- slider area start -->
         <section class="slider__area slider__height-2 include-bg d-flex align-items-center" data-background="assets/img/slider/2/slider-2-bg.jpg">
            <div class="container">
               <div class="row align-items-center">
                  <div class="col-xxl-6 col-lg-6">
                     <div class="slider__content-2 mt-30">
                        <span>এসএসসি পরীক্ষার প্রস্তুতি ২০২২</span>
                        <h3 class="slider__title-2">যদি দাও মডেল টেস্ট<br/> পরীক্ষা তোমার হবে বেস্ট</h3>
                        <p>এসএসসি পরীক্ষা দোড়গোড়ায়। শেষ মুহূর্তের প্রস্তুতি নিশ্চিত করতে
মাস্টার ট্রেইনার ও দেশসেরা বিশেষজ্ঞ শিক্ষকদের সমন্বয়ে সাজানো হয়েছে ‘এসএসসি মডেল টেস্ট ২০২২’।</p>
                        <a href="<?php echo isset($_SESSION['logged_session']) ? 'dashboard' : 'login' ?>" class="tp-btn-green">মডেল টেস্ট দিতে ক্লিক করো</a>
                     </div>
                  </div>
                  <div class="col-xxl-6 col-lg-6">
                     <div class="slider__thumb-2 p-relative">
                        <span class="slider__thumb-mask">
                           <img src="assets/img/slider-thumb1.png" alt="">
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- slider area end -->

      </main>

<?php require 'footer-v2.php';?>