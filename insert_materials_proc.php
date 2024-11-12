<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'] ?? null;

if ($id && isset($_POST['IntQuantity'], $_POST['txtItems'], $_POST['doubleUnit_cost'], $_POST['doubleAmount'])) {
    $qty = (int)$_POST['intQuantity'];
    $items = $conn->real_escape_string($_POST['txtitems']);
    $unit_cost = (float)$_POST['doubleUnit_cost'];
    $amount = (float)$_POST['doubleAmount'];

    $sql = "INSERT INTO materials_tbl (m_id, u_id, m_qty, m_items, m_unit_cost, m_amount) VALUES (null, '$id', '$qty', '$items', '$unit_cost', '$amount')";
    if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form3_students.php")

</script>