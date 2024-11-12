<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$sport = $_POST['txtSport'];


$sql = "INSERT INTO sport_tbl (u_sport_id, u_sport_name,  u_id)
VALUES (null, '$sport', '$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>