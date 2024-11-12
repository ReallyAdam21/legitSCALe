<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$art = $_POST['txtArt'];


$sql = "INSERT INTO arts_tbl (u_arts_id, u_arts_name,  u_id)
VALUES (null, '$art', '$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>