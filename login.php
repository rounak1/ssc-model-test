<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-home.php';
$email = $pass = "";

$msg = [];

if (isset($_POST['login'])) {

    if (empty($_POST["email"])) {
        array_push($msg, "তোমার ইমেইল লিখো");
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["pass"]) || strlen($_POST["pass"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $pass = md5(test_input($_POST["pass"]));
    }

    $sql = "SELECT `email`, `password` FROM `model_students` WHERE `email` = '$email' AND `password` = '$pass' and `status` = 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        $_SESSION['logged_session'] = true;
        $_SESSION['email'] = $email;

        header('Location:myprofile.php');

        // echo "<script type='text/javascript'>window.top.location='https://service.prothomalo.com/mpaward/awards.php';</script>";exit;

    } else {

        $_SESSION['alert'] = "তোমার ইমেইল অথবা পাসওয়ার্ড সঠিক নয়";
    }

}

?>

    <section class="ftco-login ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">

        <?php
if (isset($_SESSION['success'])) {?>
      <div class="col-md-12 message-container">
        <div class="alert alert-success" role="alert">
  <?php echo $_SESSION['success']; ?>
</div>
        </div>
<?php unset($_SESSION['success']);}

if (isset($_SESSION['alert'])) {?>
  <div class="col-md-12 message-container">
        <div class="alert alert-warning" role="alert">

    <?php
echo $_SESSION['alert'];

    unset($_SESSION['alert']); ?>
</div>
        </div>
<?php }
?>
          <div class="col-md-8 col-lg-5">
            <div class="login-container">
              <div class="col-md-12 text-center heading-section">
                <h2 class="mb-2">লগইন</h2>
              </div>

              <div class="col-md-12">
                <div class="form-container">
                  <form id="login_form_submit" name="login" action="" method="POST">
                    <div class="input-container">
                      <input
                        type="email"
                        name="email"
                        value=""
                        id="email"
                        placeholder="ইমেইল"
                        required="required"
                      />
                    </div>
                    <div class="input-container">
                      <input
                        type="password"
                        name="pass"
                        value=""
                        id="password"
                        placeholder="পাসওয়ার্ড"
                        required="required"
                      />
                    </div>
                    <div class="forget-password">
                      <a href="forget_password.php">পাসওয়ার্ড ভুলে গিয়েছো?</a>
                    </div>
                    <div class="input-container submit-container">
                      <button id="login-button" name="login">
                        <span class="content">লগইন</span>
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

                <div class="or">অথবা</div>
                <div class="login-register-text">
                  নিবন্ধন করতে <a href="register.php">ক্লিক করুন</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php require 'footer-home.php';?>