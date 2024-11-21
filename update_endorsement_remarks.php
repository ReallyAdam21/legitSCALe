<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'] ?? null;

$query_string_id =isset($_GET['u_id']) ? (int)$_GET['u_id'] : null;
if (!$id) {
    echo "Please log in to update remarks.";
    exit;
	
	echo $id;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Remarks</title>
</head>
<body>
    <form action="update_endorsement_remarks_proc.php?s_id=<?php echo $query_string_id ?>&u_id=<?php echo $id?>" method="post">
        <label for="txtRemarks">Remarks:</label>
        <input type="text" name="txtRemarks" required><br>


        <button type="submit">Add Remarks</button>
    </form>
</body>
</html>
