
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
    <title>SCALE Coordinators Program Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            height: 100vh;
            overflow: hidden;
            transform: scale(0.9); /* Zoom out */
            transform-origin: top center;
        }

        .container {
            width: 80%; /* Increase the container width to make it more compact */
            background-color: #fff;
            padding: 15px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            font-size: 0.9em; /* Smaller font size */
        }

        .top-section {
            margin-bottom: 10px;
            text-align: center;
        }

        .top-section p {
            margin: 3px 0;
            font-weight: bold;
            font-size: 1em;
        }

        .form-inline-group {
            display: flex;
            gap: 5px;
            align-items: center;
            justify-content: center;
            margin-top: 5px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="date"], textarea {
            width: calc(100% - 10px);
            padding: 5px;
            font-size: 0.85em;
            margin-top: 3px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 0.8em;
        }

        table, th, td {
            border: 1px solid black;
            text-align: left;
        }

        th, td {
            padding: 3px;
            text-align: center;
        }

        .signature-section {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            font-size: 0.85em;
        }

        .signature-section div {
            width: 45%;
            text-align: center;
        }

        
    </style>
</head>

<body>

    <div class="container">
        <div class="top-section">
		
		<?php include 'links.php'; ?>
            <p>PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM</p>
            <p>CAMPUS: __________________________</p>
            <p>SCALE COORDINATORS PROGRAM REPORT</p>

            <div class="form-inline-group">
                <label for="schoolYear">SY:</label>
                <input type="text" id="schoolYear" name="schoolYear" placeholder="e.g., 2023-2024" required style="width: 100px;">
                <span>,</span>
                <span>3rd Quarter</span>
            </div>
        </div>

        <form id="scaleForm" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="campus">Campus:</label>
            </div>

            <p>To the DSA Chief:</p>
            <p>This is to report that of the students of Batch 
                <input type="text" id="batch" name="batch" placeholder="e.g., 2024" style="width: 50px;" required>
                who have undertaken the SCALE Program since their 11th Grade, have satisfactorily completed the Program.</p>

            <p>The following students have yet to satisfactorily complete the Program and will have the 4th quarter to do so:</p>

        <table><thead>
			  <tr>
				<th>Name of Student</th>
				<th>Name of SCALe Adviser</th>
				<th>Strands that need to be addressed</th>
				<th>Learning outcomes that need to be addressed</th>
			  </tr></thead>
			<tbody>
			<?php 
			$sqlStudents = "SELECT u_fname, u_mname, u_lname, ui_section, SUM(a_strand_s) AS strand_s, SUM( a_strand_c) AS strand_c, SUM(a_strand_a) AS strand_a, SUM(a_strand_l) AS strand_l, SUM(a_outcome_1) AS outcome_1, SUM(a_outcome_2) AS outcome_2, SUM(a_outcome_3) AS outcome_3, SUM(a_outcome_4) AS outcome_4, SUM(a_outcome_5) AS outcome_5, SUM(a_outcome_6) AS outcome_6, SUM(a_outcome_7) AS outcome_7, SUM(a_outcome_8) AS outcome_8
			FROM users_tbl 
			INNER JOIN users_info_tbl
			ON users_tbl.u_id = users_info_tbl.u_id
			LEFT JOIN activities_tbl
			ON users_tbl.u_id = activities_tbl.u_id
			LEFT JOIN individual_activity_tbl
			ON users_tbl.u_id = individual_activity_tbl.u_id
			WHERE u_level =3
			GROUP BY users_tbl.u_id, u_fname, u_mname, u_lname, ui_section";
			
			
			 $resultStudents = $conn->query($sqlStudents);
            if ($resultStudents->num_rows > 0) {
                while($rowStudents = $resultStudents->fetch_assoc()) {
					$str1= '';
					$str2= '';
					$str3= '';
					$str4= '';
					$outcome1 ="";
					$outcome2 ="";
					$outcome3 ="";
					$outcome4 ="";
					$outcome5 ="";
					$outcome6 ="";
					$outcome7 ="";
					$outcome8 ="";
					
					if($rowStudents['strand_s'] == 0){
						$str1='S ';
					}
					if($rowStudents['strand_c'] == 0){
						$str2='C ';
					}
					if($rowStudents['strand_a'] == 0){
						$str3='A ';
						
					}if($rowStudents['strand_l'] == 0){
						$str4='L';
					}
					
					if($rowStudents['outcome_1'] ==0){
						$outcome1="1 ";
					}
					
					if($rowStudents['outcome_2'] ==0){
						$outcome2="2 ";
					}
					if($rowStudents['outcome_3'] ==0){
						$outcome3="3 ";
					}
					if($rowStudents['outcome_4'] ==0){
						$outcome4="4 ";
						
					}if($rowStudents['outcome_5'] ==0){
						$outcome5="5 ";
					}
					
					if($rowStudents['outcome_6'] ==0){
						$outcome6="6 ";
					}
					if($rowStudents['outcome_7'] ==0){
						$outcome7="7 ";
					}
					if($rowStudents['outcome_8'] ==0){
						$outcome8="8 ";
								}
				 $outcomes = $outcome1 . $outcome2 . $outcome3 . $outcome4 . $outcome5 . $outcome6. $outcome7 .$outcome8;				
				 $strand = $str1 . $str2 . $str3 . $str4 ;
				 if ($strand !='' || $outcomes !=''){
					echo "<tr>";
							echo "<td>". strtoupper(htmlspecialchars($rowStudents['u_fname'])) . " " . strtoupper(htmlspecialchars($rowStudents['u_mname'])) . ". " . strtoupper(htmlspecialchars($rowStudents['u_lname'])) . "</a></td>";
							echo "<td>";
							
							$sqlAdviser="SELECT u_fname, u_mname, u_lname,ui_section 
							FROM users_tbl 
							INNER JOIN users_info_tbl
							ON users_tbl.u_id = users_info_tbl.u_id
							WHERE u_level =2 AND ui_section ='".$rowStudents['ui_section']."'";
							
							 $resultAdviser = $conn->query($sqlAdviser);
							if ($resultAdviser->num_rows > 0) {
				
								($rowAdviser = $resultAdviser->fetch_assoc());
				
								echo strtoupper(htmlspecialchars($rowAdviser['u_fname'])) . " " . strtoupper(htmlspecialchars($rowAdviser['u_mname'])) . ". " . strtoupper(htmlspecialchars($rowAdviser['u_lname']));

							}
							echo "</td>";
							echo "<td>$strand</td>";
							echo "<td>$outcomes</td>";
							echo "</tr>";		
				}
				
			}}
			
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

            <button type="button" class="add-row-button" onclick="addRow()">Add Row (Max 15)</button>

            <div class="signature-section">
                <div>
                    <label for="coordinatorName">Name and Signature of SCALE Coordinator</label>
                    <input type="text" id="coordinatorName" name="coordinatorName" required>
                </div>
                <div>
                    <label for="submissionDate">Date of Submission</label>
                    <input type="date" id="submissionDate" name="submissionDate" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

    <script>
        let rowCount = 10;

        function addRow() {
            if (rowCount >= 15) {
                alert("Maximum number of rows reached (15).");
                return;
            }

            rowCount++;
            const table = document.getElementById("studentTable");
            const row = document.createElement("tr");

            row.innerHTML = `
                <td><input type="text" name="studentName${rowCount}"></td>
                <td><input type="text" name="scaleAdviser${rowCount}"></td>
                <td><input type="text" name="strands${rowCount}"></td>
                <td><input type="text" name="learningOutcomes${rowCount}"></td>
            `;

            table.appendChild(row);
        }
    </script>

</body>
</html>
