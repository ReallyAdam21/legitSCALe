<?php

session_start();
include 'connect.php';

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';

$queryActivities = "SELECT u_fname, u_mname, u_lname, ui_section, SUM(a_strand_s) AS strand_s, SUM( a_strand_c) AS strand_c, SUM(a_strand_a) AS strand_a, SUM(a_strand_l) AS strand_l, SUM(a_outcome_1) AS outcome_1, SUM(a_outcome_2) AS outcome_2, SUM(a_outcome_3) AS outcome_3, SUM(a_outcome_4) AS outcome_4, SUM(a_outcome_5) AS outcome_5, SUM(a_outcome_6) AS outcome_6, SUM(a_outcome_7) AS outcome_7, SUM(a_outcome_8) AS outcome_8
			FROM users_tbl 
			INNER JOIN users_info_tbl
			ON users_tbl.u_id = users_info_tbl.u_id
			LEFT JOIN activities_tbl
			ON users_tbl.u_id = activities_tbl.u_id
			LEFT JOIN individual_activity_tbl
			ON users_tbl.u_id = individual_activity_tbl.u_id
			WHERE u_level =3
			GROUP BY users_tbl.u_id, u_fname, u_mname, u_lname";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scale Coordinators Quarterly Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transform: scale(0.9);
            transform-origin: top;
        }
        h1, h2 {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 6px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .label-col {
            width: 30%;
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
            padding-left: 10px;
        }
        .input-col {
            width: 70%;
            text-align: left;
        }
        textarea, input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 4px;
            box-sizing: border-box;
            font-size: 0.9em;
        }
        .compact-table td, .compact-table th {
            padding: 4px;
            font-size: 0.85em;
        }
        .section-header {
            font-size: 1.1em;
            font-weight: bold;
            background-color: #eee;
            padding: 6px;
            text-align: center;
            border: 1px solid #333;
        }
        button {
            font-size: 1em;
            padding: 8px 16px;
            margin-top: 20px;
            cursor: pointer;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Philippine Science High School System</h1>
        <h2>SCALE Coordinators Quarterly Report</h2>

        <form id="reportForm" action="submit_report.php" method="POST">

            <!-- Part I: Updates on Institutional SCALE Performance -->
            <div class="section-header">I. Updates on Institutional SCALE Performance</div>
            <table>
				<thead>
					  <tr>
						<th>Student SCALE Activities Implemented</th>
						<th>Strand (S/C/A/L)</th>
						<th>Dates/ Duration</th>
						<th>No. of PSHS Students Involved</th>
						<th>Beneficiaries/ Other Persons Involved</th>
						<th>Form of Publicity/ Reporting</th>
						<th>Remarks</th>
					  </tr>
				</thead>
					<tbody>
					  <tr>
						<td></td>
						<td></td>
						<td></td>
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
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr>
						<td></td>
						<td></td>
						<td></td>
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
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr>
						<td></td>
						<td></td>
						<td></td>
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
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr>
						<td></td>
						<td></td>
						<td></td>
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
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					  <tr>
						<td></td>
						<td></td>
						<td></td>
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
						<td></td>
						<td></td>
						<td></td>
					  </tr>
					</tbody>
			</table>

            <!-- Part II: Updates on Student SCALE Performance -->
            <div class="section-header">II. Updates on Student SCALE Performance</div>
            <table>
				<thead>
					  <tr>
						<th colspan="2"></th>
						<th colspan="2">Grade 11</th>
						<th colspan="2">Grade 12</th>
						<th colspan="2">Total</th>
					  </tr>
				</thead>
					<tbody>
					  <tr>
						<td colspan="2">No. of Students</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<td colspan="2">No. of Students who completed</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<tr>
						<td rowspan="3">Overall Student Progress</td>
						<td>As Scheduled</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<td>Ahead of Time</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<td>Delayed</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<td colspan="4">Usual Causes of Delay in SCALe</td>
						<td colspan="4">Action to be taken to improve SCALe</td>
					  </tr>
					   <tr>
						<th colspan="2"></th>
						<th colspan="2">Grade 11</th>
						<th colspan="2">Grade 12</th>
						<th colspan="2">Total</th>
					  </tr>
					  <tr>
						<td colspan="2">No. of Student-Initiated SCALe</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<td colspan="2">Learning Outcome of Concern (least no. achieved)</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<td colspan="2">Strands of Concern (least no. achieved)</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					  </tr>
					</tbody>
				</table>

            <!-- Part III: Coordinator Information -->
            <div class="section-header">Coordinator Information</div>
            <table>
                <tr>
                    <td class="label-col">Name of SCALE Coordinator:</td>
                    <td class="input-col"><input type="text" id="coordinatorName" name="coordinatorName" required></td>
                </tr>
                <tr>
                    <td class="label-col">Date of Submission:</td>
                    <td class="input-col"><input type="date" id="submissionDate" name="submissionDate" required></td>
                </tr>
            </table>

            <div style="text-align: center;">
                <button type="submit">Submit Report</button>
            </div>
        </form>
    </div>

</body>
</html>
