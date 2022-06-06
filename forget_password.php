<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-v2.php';
require 'EmailService.php';

$email = "";

$msg = [];
if (isset($_POST['forget_password'])) {

    if (empty($_POST["email"])) {
        array_push($msg, "আপনার ইমেইল লিখুন");
    } else {
        $email = test_input($_POST["email"]);
        $_SESSION['email'] = $email;

    }

    $email_sent = new EmailService();
    $email_address = $email;

    $token = bin2hex(random_bytes(20));

    $verifyEmailLink = "https://service.prothomalo.com/modeltest/reset_password?token=" . $token;

    $message = '<style type="text/css">
    body {
      margin: 0 auto;
      padding: 0;
    }

    .footer__social ul li:not(:last-child) {
      margin-right: 7px;
    }
    .footer__social ul li {
      display: inline-block;
    }
    .footer__widget ul li {
      list-style: none;
      line-height: 1;
      margin-bottom: 12px;
    }
    .footer__social ul li a {
      display: inline-block;
      line-height: 40px;
      text-align: center;
    }

    .footer__social ul li a:hover {
      background-color: var(--tp-theme-1);
      color: var(--tp-common-white);
    }

    @media only screen and (max-width: 660px) {
      table[class="first_tbl"] {
        width: 100% !important;
        display: block !important;
      }
    }

    @media only screen and (max-width: 510px) {
      table[class="footer_first_item"] {
        width: 100% !important;
        display: block !important;
      }
    }
  </style>



  <table
    width="660"
    class="first_tbl"
    border="0"
    align="center"
    cellspacing="0"
    cellpadding="0"
    bgcolor="#e5efe7"
    style="
      border-collapse: collapse;
      font-family: Arial, Helvetica, sans-serif;
      font-size: 12px;
    "
  >
    <tr>
      <td align="center" valign="top" style="padding: 16px 0">
        <img
          src="https://images.prothomalo.com/prothomalo-bangla/2022-06/e446f8f5-1f44-47b8-b595-4e7272371d31/porasona_removebg_preview.png"
          height="36"
          alt=""
        />
      </td>
    </tr>
    <tr>
      <td>
        <table width="95%" align="center">
          <tr>
            <td>
              <div
                style="background-color: #fff; padding: 3%; margin-top: 3px"
              >
                <p
                  style="
                    font-size: 18px;
                    font-weight: normal;
                    line-height: 1.6;
                    color: #333;
                  "
                >
                  প্রিয় শিক্ষার্থী বন্ধু,
                  <br />
                  এসএসসি মডেল টেস্ট ২০২২ - এ তোমাকে স্বাগতম।
                </p>

                <p
                  style="
                    font-size: 18px;
                    font-weight: normal;
                    line-height: 1.6;
                    color: #333;
                  "
                >
                  <a href="' . $verifyEmailLink . '">এই লিংকে ক্লিক </a>করে
                  তোমার পাসওয়ার্ডটি পুনরায় সেট করো।
                </p>
              </div>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>
        <table
          width="95%"
          border="0"
          align="center"
          cellpadding="0"
          cellspacing="0"
        >
          <tr>
            <td>
              <table
                class="footer_first_item"
                border="0"
                cellspacing="0"
                cellpadding="0"
                align="left"
              >
                <tr>
                  <td align="left" valign="top">
                    <div
                      class="footer__social footer__widget"
                      style="padding: 5px 0 20px 6px"
                    >
                      <h4
                        style="
                          font-weight: bold;
                          font-family: Arial, Helvetica, sans-serif;
                          font-size: 18px;
                          padding: 0;
                          margin: 0;
                          padding: 0px 0px 0px 0px;
                          display: inline-block;
                        "
                      >
                        আমাদের সাথে যোগাযোগ:
                      </h4>

                      <a
                        href="https://www.facebook.com/prothomalo.porasona/"
                        target="_blank"
                        style="margin-right: 6px"
                        ><img
                          src="https://images.prothomalo.com/prothomalo-bangla/2022-06/a51365e6-8135-41ef-b257-63fa3c74f55a/59439.png"
                          alt=""
                          height="22"
                      /></a>

                      <a href="mailto:porasona@prothomalo.com" target="_blank"
                        ><img
                          src="https://images.prothomalo.com/prothomalo-bangla/2022-06/9b794221-6c8b-4eb8-8087-57294873c2ea/er.png"
                          alt=""
                          height="25"
                      /></a>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>';

    if (!empty($email_address)) {
        //Store token in table

        $query = "UPDATE `model_students` SET  `token` = '$token' WHERE `email`='$email_address'";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $from = 'noreply@prothomalo.com';
            $data = [
                'to' => $email_address,
                'from' => $from,
                'subject' => 'এসএসসি মডেল টেস্ট দেওয়ার জন্য পাসওয়ার্ড রিসেট',
                'html' => $message,
                'fromName' => 'SSC model test',
            ];

            $email_sent->send($data);
        }

    } else {
        $_SESSION['alert'] = "email not found";
    }

    $_SESSION['success'] = "তোমার ই-মেইলে পাসওয়ার্ড পুনরায় সেট করার জন্য একটি লিংক পাঠানো হয়েছে। লিংকে ক্লিক করে পাসওয়ার্ড পুনরায় সেট করো।";
}
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
                        <h2 class="section__title">পাসওয়ার্ড ভুলে গিয়েছ?</h2>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                     <div class="sign__wrapper white-bg">
                        <?php
if (isset($_SESSION['success'])) {?>
                                <div class="col-md-12 message-container">
                                  <div class="alert alert-success" role="alert">
                                    <?php echo $_SESSION['success']; ?>
                                  </div>
                                </div>
                          <?php
unset($_SESSION['success']);
}
?>
                        <div class="sign__form">
                           <form action= "" method= "post">
                              <div class="sign__input-wrapper mb-25">
                                 <h5>পাসওয়ার্ড পরিবর্তন করতে তোমার ই-মেইল অ্যাড্রেসটি দাও</h5>
                                 <div class="sign__input">
                                    <input type="email" name="email" placeholder="ইমেইল" required>
                                    <i class="fal fa-envelope"></i>
                                 </div>
                              </div>
                              <button name="forget_password" class="tp-btn  w-100"> <span></span> পাঠাও</button>
                              <div class="sign__new text-center mt-20">
                                 <p>অ্যাকাউন্ট নেই? <a href="<?php $base_url?>register">নিবন্ধন করো</a></p>
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
require 'footer-v2.php';
?>