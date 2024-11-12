<?php
session_start();
include 'connect.php';

// Fetch student ID
$id = $_SESSION['id'] ?? null;

if (!$id) {
    echo "Please log in to add a person.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Person</title>
</head>
<body>
    <form action="insert_persons_proc.php" method="post">
        <label for="supervisor">Adult Supervisor/Collaborator:</label>
        <input type="text" name="txtSupervisor" required><br>

        <label for="designation">Designation/Position:</label>
        <input type="text" name="txtDesignation" required><br>

        <label for="company">Company/Affiliation:</label>
        <input type="text" name="txtCompany" required><br>

        <label for="contact">Contact Info:</label>
        <input type="text" name="txtContact" required><br>

        <button type="submit">Add Person</button>
    </form>
</body>
</html>
