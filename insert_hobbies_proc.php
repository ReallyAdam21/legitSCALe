<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$hobbies = $_POST['txtHobbies'];


$sql = "INSERT INTO hobbies_tbl (u_hobbies_id, u_hobbies_name,  u_id)
VALUES (null, '$hobbies', '$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>