<?php
$conn = mysqli_connect('localhost', 'root', '', 'adiservicedb');
// $conn = mysqli_connect('127.0.0.1', 'root', '6LME7r70sXnluwws', 'adiservicedb');
mysqli_set_charset($conn, 'utf8');
if (!$conn) {
    mysqli_connect_error('Connection Problem. Try again');
}

// $base_url = 'http://localhost/mpaward/';
// $base_url = 'https://service.prothomalo.com/mpaward/';

// return current full url
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $full_link = "https";
} else {
    $full_link = "http";
}



function url_match($full_link = '', $current = '')
{
    if (strpos($full_link, $current) == false) {
        return false;
    } else {
        return true;
    }
}

function test_input($data)
{
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}
