<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$description = $_POST['txtDescription'];


$sql = "INSERT INTO spearhead_description_tbl ( u_description_id, u_activities_description,  u_id)
VALUES ( null, '$description', '$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>