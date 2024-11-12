<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$interests = $_POST['txtInterests'];


$sql = "INSERT INTO interests_tbl (u_interests_id, u_interests_name,  u_id)
VALUES (null, '$interests', '$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>