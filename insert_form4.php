<?php
session_start(); // Ensure session is started
include 'connect.php'; // Include database connection

// Check if $_SESSION['id'] is set and not empty
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    die("Session ID not set.");
}

$id = $_SESSION['id'];

// Fetch current user's information including first name and u_level
$sqlCurrentUser = "SELECT users_info_tbl.*, users_tbl.u_fname, users_tbl.u_level 
                   FROM users_info_tbl 
                   INNER JOIN users_tbl ON users_info_tbl.u_id = users_tbl.u_id 
                   WHERE users_info_tbl.u_id = $id";
$resultCurrentUser = $conn->query($sqlCurrentUser);

if (!$resultCurrentUser) {
    die("Error fetching user information: " . $conn->error);
}

if ($resultCurrentUser->num_rows > 0) {
    $rowCurrentUser = $resultCurrentUser->fetch_assoc();
    $section = $rowCurrentUser['ui_section'];
    $position = $rowCurrentUser['ui_position'];
    $firstName = $rowCurrentUser['u_fname'];
    $userLevel = $rowCurrentUser['u_level']; // Fetch the user's level
} else {
    die("User not found.");
}

// Fetch advisers from the database
$sqlAdvisers = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_level = 2";
$resultAdvisers = $conn->query($sqlAdvisers);

if (!$resultAdvisers) {
    die("Error fetching advisers: " . $conn->error);
}

$activityID = isset($_GET['a_id']) ? (int)$_GET['a_id'] : null;
$user_id =isset($_GET['u_id']) ? (int)$_GET['u_id'] : null;

$completionDate = isset($_POST['txtCompletionDate']) ? $_POST['txtCompletionDate'] : null;
$evidence = isset($_POST['txtEvidence']) ? $_POST['txtEvidence'] : null;


 if(isset($_POST['btnSubmit'])) {
    $completionDate = $_POST['txtCompletionDate'] ?? '';
    $evidence = $_POST['txtEvidence'] ?? '';

    $sql = "UPDATE individual_activity_tbl 
            SET i_a_completion_date = '$completionDate', i_a_evidence = '$evidence' 
            WHERE u_id = '$user_id' AND a_id = '$activityID'";
	

if ($conn->query($sql) === TRUE) {
 header('Location: view_form4_students.php?id='.$user_id); 
  die(); 
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins';
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
        }
        input[type="text"], input[type="date"], textarea, select {
            width: 100%;
            padding: 5px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        input[type="submit"], input[type="button"] {
            padding: 10px 20px;
            margin: 10px 0;
        }
        input[type="button"] {
            background-color: #ccc;
            border: 1px solid #999;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <table border="1">
            <tr>
               
            <tr>
                <td>Date of Completion</td>
                <td><input type="date" name="txtCompletionDate" id="txtCompletionDate" required></td>
            </tr>
            <tr>
                <td>Submitted Evidence:</td>
                <td><input type="text" name="txtEvidence" id="txtEvidence" required></td>
            </tr>
            <tr>
                <td><input type="submit" id= "btnSubmit" name ="btnSubmit" value="SUBMIT"></td>
                <td><a href="view_form4_students.php"><input type="button" value="BACK"></a></td>
            </tr>
        </table>
    </form>
</body>
</html>