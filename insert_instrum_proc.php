<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$instrum = $_POST['txtInstrum'];


$sql = "INSERT INTO instruments_tbl (u_instrument_id, u_instrument_name,  u_id)
VALUES (null, '$instrum', '$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>