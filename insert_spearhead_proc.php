<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$activities = $_POST['txtActivities'];
$description = $_POST['txtDescription'];


$sql = "INSERT INTO spearhead_tbl (u_activities_id, u_activities_name, u_description, u_id)
VALUES (null, '$activities', '$description','$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>