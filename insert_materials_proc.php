<?php
session_start();
include 'connect.php';

$query_string_id =isset($_GET['a_id']) ? (int)$_GET['a_id'] : null;
$id = $_SESSION['id'] ?? null;

if ($id && isset($_POST['intQuantity'], $_POST['txtItems'], $_POST['doubleUnit_cost'], $_POST['doubleAmount'])) {
    $qty = (int)$_POST['intQuantity'];
    $items = $conn->real_escape_string($_POST['txtItems']);
    $unit_cost = (float)$_POST['doubleUnit_cost'];
    $amount = (float)$_POST['doubleAmount'];

    $sql = "INSERT INTO materials_tbl (m_id, u_id, m_qty, m_items, m_unit_cost, m_amount, a_id) VALUES (null, '$id', '$qty', '$items', '$unit_cost', '$amount','$query_string_id')";
    if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 
}else{
	echo $query_string_id;
}
?>

<script>

  location.replace("view_form3_students.php")

</script>