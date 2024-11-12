<?php
include ('connect.php');
$id = $_POST['txtId'];
$pword = $_POST['txtPword'];
$lname = $_POST['txtLname'];
$fname = $_POST['txtFname'];
$mname = $_POST['txtMname'];
$email = $_POST['txtEmail'];
$position = $_POST['drpPosition'];

$sql = "UPDATE users_tbl SET  u_pword = '$pword', u_lname = '$lname', u_fname = '$fname', u_mname = '$mname', u_email = '$email', u_level = '$position' WHERE u_id = '$id'";

if ($conn->query($sql) === TRUE) {
  echo "Updated successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<script>
  location.replace("view_users.php")

</script>