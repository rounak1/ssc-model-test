
<?php
session_start();
error_reporting(1);
require 'connection.php';
require 'admin-header.php';
unset($_SESSION['logged_session']);
header('Location: index.php');
?>

