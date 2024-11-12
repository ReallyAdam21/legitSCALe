<?php
session_start();
include 'connect.php';

$level = $_SESSION['level'];

$id = $_POST['txtId'];
$batch = $_POST['drpBatch'];
$grade = $_POST['drpGrade'];
$section = $_POST['drpSection'];

if ($level == 2){
$position = "Scale Adviser";

}
else if ($level == 3){
$position = "Student";
}

$sql = "INSERT INTO users_info_tbl (ui_id, ui_batch, ui_grade, ui_section, u_id, ui_position)
VALUES (null, '$batch', '$grade', '$section','$id', '$position')";

if ($conn->query($sql) === TRUE) {
  echo "Assigned Successfully";
} 

?>

<script>

  location.replace("view_users.php")

</script>

