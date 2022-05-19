<?php
	session_start();

	$email = $_SESSION['email'];
	if(empty($email)) {
		header("Location: login.php");
        exit();
	}
?>