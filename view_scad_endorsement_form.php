<?php
session_start();
include 'connect.php';

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';
$section= $_SESSION["section"] ?? '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SCALE Advisers Endorsement Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        font-size: 14px;
        max-width: 1200px;
        margin: auto;
    }
    h1 {
        text-align: center;
        font-size: 18px;
        text-decoration: underline;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 6px;
        text-align: center;
        font-size: 12px;
    }
    .multiselect-container {
        position: relative;
    }
    .multiselect-button {
        padding: 4px 8px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }
    .multiselect-button:hover {
        background-color: #0056b3;
    }
    .multiselect-dropdown {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        max-height: 150px;
        overflow-y: auto;
        z-index: 1;
        width: 180px;
        padding: 8px;
    }
    .multiselect-checkbox {
        display: flex;
        align-items: center;
        margin: 4px 0;
        font-size: 12px;
    }
    .form-footer {
        margin-top: 20px;
    }
    .form-footer label {
        font-weight: bold;
    }
    .form-footer input {
        padding: 5px;
        font-size: 12px;
    }
    button[type="submit"] {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button[type="submit"]:hover {
        background-color: #45a049;
    }
    .show {
        display: block !important;
    }
</style>

</head>
<body>
<?php include 'links.php'; ?>
<h1>SCALE Advisers Endorsement Form</h1>

<form action="#" method="post">
   <table><thead>
	  <tr>
		<th>Name of Student</th>
		<th>No. of SCALe Activities Implemented</th>
		<th>Final Date of Completion of SCALe Activities</th>
		<th>Remarks</th>
	  </tr></thead>
	<tbody>
	<?php 
					
           $sqlInfo = "SELECT users_tbl.u_id AS user_id,s_a_endorsement_remarks, u_fname, u_mname, u_lname, ui_section, COUNT(i_a_id) AS activity_count, MAX(a_implement_date_end) as end_date
            FROM users_tbl 
            INNER JOIN users_info_tbl
            ON users_tbl.u_id = users_info_tbl.u_id
            LEFT JOIN individual_activity_tbl
            ON users_tbl.u_id = individual_activity_tbl.u_id
			LEFT JOIN scale_adviser_report_tbl
			ON users_tbl.u_id =scale_adviser_report_tbl.student_u_id
			AND scale_adviser_report_tbl.adviser_u_id = $id
            WHERE ui_section = '$section' AND u_level = '3'
            GROUP BY users_tbl.u_id, u_fname, u_mname, u_lname, ui_section,s_a_endorsement_remarks";

            $resultInfo = $conn->query($sqlInfo);
            if ($resultInfo->num_rows > 0) {
                while($rowInfo = $resultInfo->fetch_assoc()) {
					
					echo "<tr>";
							echo "<td><a href=update_endorsement_remarks.php?u_id=".$rowInfo['user_id']." >". strtoupper(htmlspecialchars($rowInfo['u_fname'])) . " " . strtoupper(htmlspecialchars($rowInfo['u_mname'])) . ". " . strtoupper(htmlspecialchars($rowInfo['u_lname'])) . "</a></td>";
							echo "<td>".$rowInfo['activity_count']."</td>";
							echo "<td>".$rowInfo['end_date']."</td>";
							echo "<td>".$rowInfo['s_a_endorsement_remarks']."</td>";
							
				}
				
			}
			?>
	  <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
	  <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	  </tr>
</tbody>
</table>
   

    
    <div class="form-footer">
        <label for="adviserName">Name of SCALE Adviser:</label>
        <input type="text" id="adviserName" name="adviserName" required><br>

        <label for="adviserSignature">Signature:</label>
        <input type="text" id="adviserSignature" name="adviserSignature" required><br>

        <label for="submissionDate">Date of Submission:</label>
        <input type="date" id="submissionDate" name="submissionDate" required><br><br>

        <button type="submit">Submit</button>
    </div>
</form>

</body>
</html>
