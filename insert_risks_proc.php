<?php
session_start();
include 'connect.php';
$query_string_id =isset($_GET['a_id']) ? (int)$_GET['a_id'] : null;
$id = $_SESSION['id'] ?? null;

if ($id && isset($_POST['txtHazards'], $_POST['txtPrecautions'])) {
    $hazards = $conn->real_escape_string($_POST['txtHazards']);
    $precautions = $conn->real_escape_string($_POST['txtPrecautions']);

    $sql = "INSERT INTO risks_tbl (r_id, u_id, r_hazards, r_precautions, a_id) VALUES (null, '$id', '$hazards', '$precautions', '$query_string_id')";
     if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 
}
?>

<script>

  location.replace("view_form3_students.php?id=<?php echo $id?>")

</script>
