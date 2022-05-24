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

// Here append the common URL characters.
$full_link .= "://";

// Append the host(domain name, ip) to the URL.
$full_link .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL
$full_link .= $_SERVER['REQUEST_URI'];

function test_input($data)
{
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    // $data = addslashes($data);
    return $data;
}
