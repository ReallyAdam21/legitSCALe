<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'] ?? null;

if ($id && isset($_POST['txtHazards'], $_POST['txtPrecautions'])) {
    $hazards = $conn->real_escape_string($_POST['txtHazards']);
    $precautions = $conn->real_escape_string($_POST['txtPrecautions']);

    $sql = "INSERT INTO risks_tbl (r_id, u_id, r_hazards, r_precautions) VALUES (null, '$id', '$hazards', '$precautions')";
     if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form3_students.php")

</script>
