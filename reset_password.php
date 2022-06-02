<?php
$msg = [];
$user_email = "";
error_reporting(1);
require 'connection.php';
require 'header-home.php';

if (isset($_POST['reset_password'])) {

// require 'fb-init.php';

    $email = $_POST['email'];

    if (empty($_POST["pass"]) || strlen($_POST["pass"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $pass = md5(input_field_validation($_POST["pass"]));
    }

    if (empty($_POST["retype_password"]) || strlen($_POST["retype_password"]) < 6) {
        array_push($msg, "পাসওয়ার্ড ৫ ডিজিটের বেশি হতে হবে");
    } else {
        $retype_password = md5(input_field_validation($_POST["retype_password"]));
    }

    if ($pass != $retype_password) {
        array_push($msg, "পাসওয়ার্ড ম্যাচ করে নাই। আবার চেষ্টা করুন ");
    } else {

        $query = "UPDATE `model_students` SET  `pass`='$pass', `token` = '' WHERE `email`='$email'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            array_push($msg, "আপনার নতুন পাসওয়ার্ডটি সেট করা হয়েছে।");
            echo "<script type='text/javascript'>window.top.location='login';</script>";exit;
        }

    } //code if password match and form submit

} // if new password set and form submit

if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT `email` FROM `model_students` WHERE `token` = '$token'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        foreach ($result as $res) {
            $user_email = $res['email'];
        }
    }

    require 'header.php';
// require 'fb-init.php';

    ?>
	<!--page title section-->
	<section class="inner_cover parallax-window" data-parallax="scroll" data-image-src="assets/img/bg/bg-img.png">
	    <div class="overlay_dark"></div>
	    <div class="container">
	        <div class="row justify-content-center align-items-center">
	            <div class="col-12">
	                <div class="inner_cover_content">
	                    <h3>
	                       রিসেট পাসওয়ার্ড
	                    </h3>
	                </div>
	            </div>
	        </div>

	        <div class="breadcrumbs">
	            <ul>
	                <li><a href="<?=$base_url?>">মেরিল-প্রথম আলো</a>  |   </li>
	                <li><span>রিসেট পাসওয়ার্ড</span></li>
	            </ul>
	        </div>
	    </div>
	</section>

	<section class="pb100 pt50">
		<div class="container">
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
			<div class="row justify-content-center mt100">

			<div class="col-md-4">



					<?php

    if (isset($_SESSION['logged_session']) && $_SESSION['logged_session'] == true) {
        ?>
						<h2><?php echo $_SESSION['user_name']; ?></h2>


				<?php
header('Location: https://service.prothomalo.com/mpaward/awards.php');
    } else {
        ?>
						<!-- <a href="<?php //$base_url?>palo-login.php" style="margin-right: 20px;">
							<img src="<?php //$base_url?>/images/btn_palo.png">
						</a> -->


		<h3 class="text-center">রিসেট পাসওয়ার্ড </h3>

			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
			<form action= "" method= "post">

            <input type="hidden" class="form-control" name="email"
             value="<?=$user_email?>">

			<div class="form-group">
				<label for="pwd">নতুন পাসওয়ার্ড দিন</label>
				<input type="password" class="form-control" placeholder="Enter password" id="pwd" name="pass">
			</div>

            <div class="form-group">
				<label for="pwd">পুনরায় পাসওয়ার্ড টাইপ করুন</label>
				<input type="password" class="form-control" placeholder="Re-type password" id="pwd" name="retype_password">
			</div>
			<button type="submit" class="btn btn-primary" name= "reset_password">পাসওয়ার্ড সেট করুন </button>

			</form>




				<?php
}
    ?>

			</div>
			</div>
		</div>
	</section>

<?php
require 'footer.php';
} else {
    echo " Token not found";
}
