<?php
error_reporting(1);
require 'connection.php';
require 'admin-header.php';
$todays_date = date('Y-m-d');

?>


    <style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  /* background-color: #f1f1f1; */
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>

<div class="container">
    <div class="quiz-container">



<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'todays_participants')" id="defaultOpen">Todays participants</button>
  <button class="tablinks" onclick="openCity(event, 'all_participants')">All participants</button>
</div>



      <section>

      <div id="todays_participants" class="tabcontent">
      <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Total Marks</th>
                <th>Time to complete(S)</th>
              </tr>
            </thead>
            <tbody class="participants-information-body-1">
                <?php
$query = "SELECT model_students.name, model_students.phone, quiz_histories.total_marks, quiz_histories.completion_time, quiz_histories.created_at FROM `model_students` INNER JOIN `quiz_histories` on model_students.id = quiz_histories.user_id WHERE `quiz_date` = '$todays_date' ;";

$result = mysqli_query($conn, $query);
$i = 1;

foreach ($result as $row) {?>

    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['total_marks']; ?></td>
        <td><?php echo $row['completion_time']; ?></td>

    </tr>

<?php }
?>
            </tbody>
          </table>
</div>

<div id="all_participants" class="tabcontent">
<table>
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Total Marks</th>
                <th>Time to complete(S)</th>
              </tr>
            </thead>
            <tbody class="participants-information-body-1">
                <?php
$query = "SELECT model_students.name, model_students.phone, quiz_histories.total_marks, quiz_histories.completion_time, quiz_histories.created_at FROM `model_students` INNER JOIN `quiz_histories` on model_students.id = quiz_histories.user_id";

$result = mysqli_query($conn, $query);
$i = 1;

foreach ($result as $row) {?>

    <tr>
        <td><?php echo $i++; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td><?php echo $row['total_marks']; ?></td>
        <td><?php echo $row['completion_time']; ?></td>

    </tr>

<?php }
?>
            </tbody>
          </table>
</div>



      </section>

</div>
</div>


    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <!-- <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase-database.js"></script> -->

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
document.getElementById("defaultOpen").click();
function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
    <!-- <script src="./assets/js/main.js"></script> -->
  </body>
</html>
