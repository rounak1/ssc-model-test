<?php
session_start();
if (!isset($_SESSION['logged_session'])) {
    header('Location: index.php');
}
error_reporting(1);
require 'connection.php';
require '../settings.php';
require 'header-v2.php';
require '../BanglaConverter.php';

$r_total = mysqli_query($conn, "select count(*) FROM `model_students` WHERE `status` = '1'");
$total_row = mysqli_fetch_array($r_total);

?>
    <div class="container">
      <div class="participants-container">
        <div class="quiz-header">


        <h4>সর্বমোট নিবন্ধন করেছে: <?=BanglaConverter::en2bn($total_row[0])?> জন</h4>
        </div>

        <section>
        <div class="table-content table-responsive">
        <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>নাম</th>
                <th>ফোন</th>
                <th>ইমেইল</th>
                <th>জেলা</th>
                <th>উপজেলা</th>

              </tr>
            </thead>
            <tbody class="participants-information-body-3">
            <?php

$query = "SELECT `name`, `phone`, `email`, `district`, `thana` FROM `model_students` WHERE `status` = '1' ORDER BY `id` DESC Limit 100";

$result = mysqli_query($conn, $query);

$i = 1;

foreach ($result as $row) {?>

                <tr>
                    <td><?php echo BanglaConverter::en2bn($i++); ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['thana']; ?></td>

                </tr>

        <?php }?>
            </tbody>
          </table>
</div>
      </section>

      </div>
    </div>





    <!-- The core Firebase JS SDK is always required and must be listed first -->

     <!-- <?php // require 'footer-v2.php';?> -->


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- <script src="./assets/js/main.js?v=1.000"></script> -->
    <?php require 'footer-v2.php';?>