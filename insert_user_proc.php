<?php
include 'connect.php';

$lname = $_POST['txtLname'];
$fname = $_POST['txtFname'];
$mname = $_POST['txtMname'];
$email = $_POST['txtEmail'];
$pword = $_POST['txtPword'];
$level = $_POST['drpLevel'];


$sql = "INSERT INTO users_tbl (u_id, u_lname, u_fname, u_mname,u_email,u_pword,u_level)
VALUES (null, '$lname', '$fname', '$mname', '$email', '$pword', '$level')";

if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_users.php")

</script>