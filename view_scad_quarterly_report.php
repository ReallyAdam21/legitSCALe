<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCALE Advisers Quarterly Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px; /* Wider width for landscape orientation */
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
            font-size: 1.5em;
            width: 100%;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-header, .form-section, .submit-section {
            display: flex;
            width: 100%;
            justify-content: space-between;
            gap: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        .dropdown {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-button {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f0f0;
            cursor: pointer;
            text-align: left;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100%;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            padding: 10px;
            z-index: 1;
            border: 1px solid #ddd;
            max-height: 150px;
            overflow-y: auto;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }

        .dropdown-content label {
            display: block;
            margin: 5px 0;
            cursor: pointer;
        }

        .submit-section {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
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

</head>
<body>
    <h2>Philippine Science High School System</h2>
    <h3>SCALE Advisers Quarterly Report</h3>

    <div class="form-container">
        <form action="submit_form.php" method="post">
            <div class="form-header">
				
                <div>
                    <label for="school-year">School Year (SY):</label>
                    <input type="text" id="school-year" name="school-year" placeholder="e.g., 2023-2024">
                </div>

                <div>
                    <label for="quarter">Quarter:</label>
                    <input type="text" id="quarter" name="quarter" placeholder="e.g., Q1, Q2, etc.">
                </div>

                <div>
                    <label for="campus">Campus:</label>
                    <input type="text" id="campus" name="campus" placeholder="Campus Name">
                </div>
            </div>

            <div id="activityReportContainer">
			<table><thead>
						  <tr>
							<th rowspan="2">Student Name</th>
							<th colspan="5">Activity No.</th>
							<th rowspan="2">Remarks</th>
							<th rowspan="2">Achieved Learning Outcomes</th>
							<th rowspan="2">Achieved Strands</th>
						  </tr>
						  <tr>
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
						  </tr>
						  </thead>
						<tbody>
						<?php 
					
           $sqlInfo = "SELECT users_tbl.u_id AS user_id, u_fname, u_mname, u_lname, ui_section, a_strand_s, a_strand_c, a_strand_a, a_strand_l, COUNT(i_a_id) AS activity_count
            FROM users_tbl 
            INNER JOIN users_info_tbl
            ON users_tbl.u_id = users_info_tbl.u_id
            LEFT JOIN individual_activity_tbl
            ON users_tbl.u_id = individual_activity_tbl.u_id
            LEFT JOIN activities_tbl
            ON users_tbl.u_id = activities_tbl.u_id
            WHERE ui_section = '$section' AND u_level = '3'
            GROUP BY users_tbl.u_id, u_fname, u_mname, u_lname, ui_section";

            $resultInfo = $conn->query($sqlInfo);
            if ($resultInfo->num_rows > 0) {
                while($rowInfo = $resultInfo->fetch_assoc()) {
					$str1="";
					$str2="";
					$str3="";
					$str4="";
					$str5="";
					$service = '';
					$creativity = '';
					$action = '';
					$leadership = '';
					$outcome1 ="";
					$outcome2 ="";
					$outcome3 ="";
					$outcome4 ="";
					$outcome5 ="";
					$outcome6 ="";
					$outcome7 ="";
					$outcome8 ="";					
					
					if($rowInfo['activity_count'] >=1){
						$str1="X";
					}
					if($rowInfo['activity_count'] >=2){
						$str2="X";
					}
					if($rowInfo['activity_count'] >=1){
						$str3="X";
					}
					if($rowInfo['activity_count'] >=2){
						$str4="X";
					}
					if($rowInfo['activity_count'] >=1){
						$str5="X";
					}
					
					
					if($rowInfo['a_strand_s'] ==1){
						$service="S ";
					}
					
					if($rowInfo['a_strand_c'] ==1){
						$creativity=",C ";
					}
					if($rowInfo['a_strand_a'] ==1){
						$action=",A ";
					}
					if($rowInfo['a_strand_l'] ==1){
						$leadership=",L";
					}
				
				
					
					
				  $strand = $service . $creativity . $action . $leadership ;
				  $outcome = $outcome1 . $outcome2 . $outcome3 . $outcome4 . $outcome5 . $outcome6 . $outcome7 . $outcome8 ;
					
					echo "<tr>";
							echo "<td>" . strtoupper(htmlspecialchars($rowInfo['u_fname'])) . " " . strtoupper(htmlspecialchars($rowInfo['u_mname'])) . ". " . strtoupper(htmlspecialchars($rowInfo['u_lname'])) . "</td>";
							echo "<td>".$str1."</td>";
							echo "<td>".$str2."</td>";
							echo "<td>".$str3."</td>";
							echo "<td>".$str4."</td>";
							echo "<td>".$str5."</td>";
							echo "<td></td>";
							echo "<td>";
							 $sqlActivities ="SELECT a_outcome_1, a_outcome_2, a_outcome_3, a_outcome_4, a_outcome_5, a_outcome_6, a_outcome_7, a_outcome_8, a_title
							 FROM individual_activity_tbl
							 LEFT JOIN activities_tbl
							 ON individual_activity_tbl.a_id = activities_tbl.a_id
							 WHERE individual_activity_tbl.u_id= ".$rowInfo['user_id'];
							 
							 $resultActivities = $conn->query($sqlActivities);
								if ($resultActivities->num_rows > 0) {
									while($rowActivities = $resultActivities->fetch_assoc()) {
										
										$outcome1 ="";
										$outcome2 ="";
										$outcome3 ="";
										$outcome4 ="";
										$outcome5 ="";
										$outcome6 ="";
										$outcome7 ="";
										$outcome8 ="";
										
										if($rowActivities['a_outcome_1'] ==1){
											$outcome1="1 ";
										}
										
										if($rowActivities['a_outcome_2'] ==1){
											$outcome2=",2 ";
										}
										if($rowActivities['a_outcome_3'] ==1){
											$outcome3=",3 ";
										}
										if($rowActivities['a_outcome_4'] ==1){
											$outcome4=",4";
											
										}if($rowActivities['a_outcome_5'] ==1){
											$outcome5=",5";
										}
										
										if($rowActivities['a_outcome_6'] ==1){
											$outcome6=",6 ";
										}
										if($rowActivities['a_outcome_7'] ==1){
											$outcome7=",7 ";
										}
										if($rowActivities['a_outcome_8'] ==1){
											$outcome8=",8";
													}
							echo "<p>".$rowActivities['a_title']. ":" . $outcome1 . $outcome2 . $outcome3 . $outcome4 . $outcome5 . $outcome6. $outcome7 .$outcome8."</p>";
							} 
							 
							 
							
							
							
							
							
							"</td>";
							echo "<td>".$strand."</td>";
						    echo " </tr>";
								}
                }
            } else {
                echo "<tr><td colspan='4'>No materials added yet.</td></tr>";
            }
						?>
						 
						  <tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						  </tr>
						 
	  
				</tbody></table>
               
                
            </div>
            
            <div class="form-section">
                <div>
                    <label for="adviser-name">Name and Signature of SCALE Adviser:</label>
                    <input type="text" id="adviser-name" name="adviser-name" placeholder="Adviser's Name">
                </div>
    
                <div>
                    <label for="submission-date">Date Submitted:</label>
                    <input type="date" id="submission-date" name="submission-date">
                </div>
            </div>

            <div class="submit-section">
                <input type="submit" value="Submit Report" id="submitBtn">
            </div>
        </form>
    </div>

    <script>
        const students = 12; // Adjust this to set the number of students dynamically

        function populateRows() {
            const activityRows = document.getElementById('activityRows');

            for (let i = 1; i <= students; i++) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="text" name="name${i}" placeholder="Student Name"></td>
                    <td><input type="text" name="activity_no${i}" placeholder="Activity No."></td>
                    <td><input type="text" name="remarks${i}" placeholder="Remarks"></td>
                    <td>
                        <div class="dropdown">
                            <span class="dropdown-button">Select Learning Outcomes</span>
                            <div class="dropdown-content">
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O1">O1 - Awareness of strengths</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O2">O2 - New challenges</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O3">O3 - Managed activities</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O4">O4 - Group contribution</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O5">O5 - Perseverance</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O6">O6 - Global issues</label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="dropdown">
                            <span class="dropdown-button">Select Strands</span>
                            <div class="dropdown-content">
                                <label><input type="checkbox" name="strands${i}[]" value="S">S - Service</label>
                                <label><input type="checkbox" name="strands${i}[]" value="C">C - Creativity</label>
                                <label><input type="checkbox" name="strands${i}[]" value="A">A - Action</label>
                                <label><input type="checkbox" name="strands${i}[]" value="L">L - Leadership</label>
                            </div>
                        </div>
                    </td>
                `;
                activityRows.appendChild(row);
            }
        }

        document.addEventListener('click', function(event) {
            const isDropdownButton = event.target.matches('.dropdown-button');
            const activeDropdowns = document.querySelectorAll('.dropdown.active');
            
            if (isDropdownButton) {
                const dropdown = event.target.closest('.dropdown');
                dropdown.classList.toggle('active');
            } else {
                activeDropdowns.forEach(dropdown => {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('active');
                    }
                });
            }
        });

        window.onload = populateRows;
    </script>
</body>
</html>
