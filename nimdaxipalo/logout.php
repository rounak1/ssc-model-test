
<?php
error_reporting(1);
require 'connection.php';
require 'admin-header.php';?>

<script>
    localStorage.removeItem("key");
    window.location.href = "index.html";
</script>
