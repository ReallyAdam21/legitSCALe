<?php
session_start(); // Ensure session is started
include 'connect.php'; // Include database connection

// Check if $_SESSION['id'] is set and not empty
if (isset($_GET['a_id'])) {
  $a_id = $_GET['a_id'];
}

$id = $_SESSION['id'];

// Fetch current user's information including first name and u_level



// Fetch advisers from the database
$sqlActivity = "SELECT * FROM activities_tbl  WHERE a_id = $a_id";
$resultActivity = $conn->query($sqlActivity);


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
    <form action="delete_activities_proc.php" method="POST" onsubmit="return confirm('Do you really want to delete the form?');">
        <table border="1">
		<?php
		while($row = $resultActivity->fetch_assoc()) {
			?>
			<input type="hidden" name="a_id" value="<?php echo $row['a_id']; ?>">
            <tr>
                <td>SUBMISSION DATE:</td>
                <td><input type="text" name="submissionDate" readonly value="<?php echo $row['u_subdate']; ?>"></td>
            </tr>
            <tr>
                <td>TITLE OF ACTIVITY:</td>
                <td><input type="text" name="txtTa" readonly value="<?php echo $row['a_title']; ?>"></td>
            </tr>
            <tr>
                <td>DESCRIPTION:</td>
                <td>
                    <input type="text" name="txtDesc" rows="4" cols="50" readonly value="<?php echo $row['a_description']; ?>">
                </td>
            </tr>
            <tr>
                <td>STRAND:</td>
                <td>
                    <p><input type="checkbox" name="cbService" class="profileStyle" <?php echo $row["a_strand_s"]=="1"? 'checked':''?>>SERVICE</p>
					<p><input type="checkbox" name="cbCreativity" class="profileStyle" <?php echo $row["a_strand_c"]=="1"? 'checked':''?>>CREATIVITY</p>
					<p><input type="checkbox" name="cbAction" class="profileStyle" <?php echo $row["a_strand_a"]=="1"? 'checked':''?>>ACTION</p>
					<p><input type="checkbox" name="cbLeadership" class="profileStyle" <?php echo $row["a_strand_l"]=="1"? 'checked':''?>>LEADERSHIP</p>
                </td>
            </tr>
            <tr>
                <td>TYPE:</td>
                <td>
                    <input type="text" name="txtTa" readonly value="<?php echo $row['a_type']; ?>">
                </td>
            </tr>
            <tr>
                <td>START:</td>
                <td><input type="date" name="dateStart" readonly value="<?php echo $row['a_start']; ?>"td>
            </tr>
            <tr>
                <td>END:</td>
                <td><input type="date" name="dateEnd" readonly value="<?php echo $row['a_end']; ?>"></td>
            </tr>
            <tr>
                <td><input type="SUBMIT" value="Delete"></td>
                <td><a href="view_form2_student.php"><input type="button" value="BACK"></a></td>
            </tr>
			<?php
		}
		?>
        </table>
    </form>
</body>
</html>

