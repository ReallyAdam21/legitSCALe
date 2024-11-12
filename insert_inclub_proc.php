<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$club = $_POST['txtCname'];
$position = $_POST['txtPosition'];
$membership = $_POST['txtMembership'];

$sql = "INSERT INTO sin_clubs_tbl (sin_id, sin_name, sin_position, sin_length, u_id)
VALUES (null, '$club', '$position', '$membership','$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>