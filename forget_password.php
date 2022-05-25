<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'header-home.php';
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

    $verifyEmailLink = "https://service.prothomalo.com/modeltest/reset_password.php?token=" . $token;

    $message = '<div><div>প্রিয় শিক্ষার্থী বন্ধু,  এসএসসি মডেল টেস্ট ২০২২ - এ তোমাকে স্বাগতম।
    </div> <a href="' . $verifyEmailLink . '">এই লিংকে ক্লিক</a> করে তোমার পাসওয়ার্ডটি পুনরায় সেট করো।</div>';

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
                'fromName' => 'porasona SSC model test',
            ];

            $email_sent->send($data);
        }

    } else {
        echo "email not found";
    }

    array_push($msg, "তোমার ই-মেইলে পাসওয়ার্ড পুনরায় সেট করার জন্য একটি লিংক পাঠানো হয়েছে। লিংকে ক্লিক করে পাসওয়ার্ড পুনরায় সেট করো");

}
?>
	<!--page title section-->

	<section class="ftco-login ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-8 col-lg-5">
            <div class="login-container">
              <div class="col-md-12 text-center heading-section">
                <h2 class="mb-2">
	                       পাসওয়ার্ড ভুলে গেছ?
	                    </h2>
              </div>

              <div class="col-md-12">
                <div class="form-container">
				<?php
if (count($msg) > 0) {?>
					<div class="alert alert-warning" role="alert">
						<?php
foreach ($msg as $message) {
    echo $message . "<br>";
}
    ?>

					</div>
					<?php }?>

					<form action= "" method= "post">
			<div class="form-group">
				<label for="email">ই-মেইল এড্রেস </label>
				<input type="email" class="form-control" placeholder="Type email Address" id="email" name="email">
			</div>

			<button type="submit" class="btn btn-primary btn-special" name= "forget_password">পাঠাও</button>

            <div class="sign-up">
				একাউন্ট নেই? <a href="<?php $base_url?>register.php">নিবন্ধন কর</a>
				</div>
			</form>
                </div>



              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


<?php
require 'footer-home.php';
?>

