<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$club = $_POST['txtCname'];
$position = $_POST['txtPosition'];
$membership = $_POST['txtMembership'];

$sql = "INSERT INTO sout_clubs_tbl (sout_id, sout_name, sout_position, sout_length, u_id)
VALUES (null, '$club', '$position', '$membership','$id')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form1_students.php")

</script>