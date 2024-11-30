<?php
session_start();
include 'connect.php';

$isSubmit= isset($_POST['btnSubmit']) ? $_POST['btnSubmit'] : '';
// New variables for student counts
$scheduledGrade11 = isset($_POST['scheduledGrade11']) ? $_POST['scheduledGrade11'] : 0;
$scheduledGrade12 = isset($_POST['scheduledGrade12']) ? $_POST['scheduledGrade12'] : 0;
$aheadGrade11 = isset($_POST['aheadGrade11']) ? $_POST['aheadGrade11'] : 0;
$aheadGrade12 = isset($_POST['aheadGrade12']) ? $_POST['aheadGrade12'] : 0;
$delayedGrade11 = isset($_POST['delayedGrade11']) ? $_POST['delayedGrade11'] : 0;
$delayedGrade12 = isset($_POST['delayedGrade12']) ? $_POST['delayedGrade12'] : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($isSubmit) {
        $sql = "SELECT * FROM scale_coordinator_report_tbl";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            // Update query if record already exists
            $sqlUpdate = "UPDATE scale_coordinator_report_tbl 
                          SET  s_c_scheduledGrade11 = ?, s_c_scheduledGrade12 = ?, s_c_aheadGrade11 = ?, s_c_aheadGrade12 = ?, s_c_delayedGrade11 = ?, s_c_delayedGrade12 = ?
                          ";
            
            $stmt_update = $conn->prepare($sqlUpdate);
            $stmt_update->bind_param('iiiiii',  $scheduledGrade11, $scheduledGrade12, $aheadGrade11, $aheadGrade12, $delayedGrade11, $delayedGrade12);
            
            if ($stmt_update->execute()) {
                $message = "Record has been updated successfully";
            } else {
                $message = "Error updating record: " . $stmt_update->error;
            }
        } else {
            // Insert new record if no record exists
            $sqlInsert = "INSERT INTO scale_coordinator_report_tbl (s_c_scheduledGrade11, s_c_scheduledGrade12, s_c_aheadGrade11, s_c_aheadGrade12, s_c_delayedGrade11, s_c_delayedGrade12) 
                          VALUES (?, ?, ?, ?, ?, ?)";
            
            $stmt_insert = $conn->prepare($sqlInsert);
            $stmt_insert->bind_param('iiiiii',$scheduledGrade11, $scheduledGrade12, $aheadGrade11, $aheadGrade12, $delayedGrade11, $delayedGrade12);
            
            if ($stmt_insert->execute()) {
                $message = "Record has been inserted successfully";
            } else {
                $message = "Error inserting record: " . $stmt_insert->error;
            }
        }
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

            <!-- New fields for student counts -->
            <tr>
                <td>On Schedule Grade 11 Students:</td>
                <td><input type="number" name="scheduledGrade11" value="<?php echo $scheduledGrade11; ?>" required></td>
            </tr>
            <tr>
                <td>On Schedule Grade 12 Students:</td>
                <td><input type="number" name="scheduledGrade12" value="<?php echo $scheduledGrade12; ?>" required></td>
            </tr>
            <tr>
                <td>Ahead of Time Grade 11 Students:</td>
                <td><input type="number" name="aheadGrade11" value="<?php echo $aheadGrade11; ?>" required></td>
            </tr>
            <tr>
                <td>Ahead of Time Grade 12 Students:</td>
                <td><input type="number" name="aheadGrade12" value="<?php echo $aheadGrade12; ?>" required></td>
            </tr>
            <tr>
                <td>Delayed Grade 11 Students:</td>
                <td><input type="number" name="delayedGrade11" value="<?php echo $delayedGrade11; ?>" required></td>
            </tr>
            <tr>
                <td>Delayed Grade 12 Students:</td>
                <td><input type="number" name="delayedGrade12" value="<?php echo $delayedGrade12; ?>" required></td>
            </tr>

            <tr>
                <td><input name="btnSubmit" id="btnSubmit" type="submit" value="SUBMIT"></td>
                <td><a href="view_scaco_quarterly_report_form.php"><input type="button" value="BACK"></a></td>
            </tr>
        </table>
        
    </form>
</body>
</html>
