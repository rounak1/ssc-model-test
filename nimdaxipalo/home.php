<?php
error_reporting(1);
require 'connection.php';
require 'admin-header.php';
?>
    <div class="container">
      <div class="participants-container">
        <h2>All Participants (<span id="total_all_participants"></span>)</h2>
        <div id="contentData"></div>
      </div>
    </div>

    <div class="pc-tab">
      <section>
        <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>District</th>
                <th>Upazila</th>

              </tr>
            </thead>
            <tbody class="participants-information-body-3">
            <?php

$query = "SELECT `name`, `phone`, `email`, `district`, `thana` FROM `model_students` WHERE `status` = '1'";

$result = mysqli_query($conn, $query);

$i = 1;

foreach ($result as $row) {?>

                <tr>
                    <td><?php echo $i++; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['district']; ?></td>
                <td><?php echo $row['thana']; ?></td>

                </tr>

        <?php }?>
            </tbody>
          </table>
      </section>
    </div>

    <!-- The core Firebase JS SDK is always required and must be listed first -->


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="./assets/js/main.js?v=1.000"></script>
  </body>
</html>
