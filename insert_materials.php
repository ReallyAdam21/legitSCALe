<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'] ?? null;
echo $id;
$query_string_id =isset($_GET['a_id']) ? (int)$_GET['a_id'] : null;
if (!$id) {
    echo "Please log in to add materials.";
    exit;
	
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Material</title>
</head>
<body>
    <form action="insert_materials_proc.php?a_id=<?php echo $query_string_id?>" method="post">
        <label for="qty">Quantity:</label>
        <input type="number" name="intQuantity" required><br>

        <label for="items">Item:</label>
        <input type="text" name="txtItems" required><br>

        <label for="unit_cost">Unit Cost:</label>
        <input type="number" step="0.01" name="doubleUnit_cost" required><br>

        <label for="amount">Amount:</label>
        <input type="number" step="0.01" name="doubleAmount" required><br>

        <button type="submit">Add Material</button>
    </form>
</body>
</html>
