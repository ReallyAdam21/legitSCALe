<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'] ?? null;

if (!$id) {
    echo "Please log in to add risks.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Risk</title>
</head>
<body>
    <form action="insert_risks_proc.php" method="post">
        <label for="hazards">Potential Hazards:</label>
        <input type="text" name="txtHazards" required><br>

        <label for="precautions">Safety Precautions:</label>
        <input type="text" name="txtPrecautions" required><br>

        <button type="submit">Add Risk</button>
    </form>
</body>
</html>
