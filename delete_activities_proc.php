<?php
include ('connect.php');
$id = $_POST['a_id'];


$sql = "DELETE FROM activities_tbl WHERE a_id = '$id'";

if ($conn->query($sql) === TRUE) {
  echo "Deleted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<script>
  location.replace("view_form2_student.php")

</script>