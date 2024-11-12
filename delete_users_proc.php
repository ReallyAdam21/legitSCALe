<?php
include ('connect.php');
$id = $_POST['txtId'];
$pword = $_POST['txtPword'];
$lname = $_POST['txtLname'];
$fname = $_POST['txtFname'];
$mname = $_POST['txtMname'];
$email = $_POST['txtEmail'];
$position = $_POST['drpPosition'];

$sql = "DELETE FROM users_tbl WHERE u_id = '$id'";

if ($conn->query($sql) === TRUE) {
  echo "Deleted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<script>
  location.replace("view_users.php")

</script>