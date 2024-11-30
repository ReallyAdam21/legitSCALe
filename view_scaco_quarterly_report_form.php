<?php

session_start();
include 'connect.php';

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';


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
					<?php
					$queryActivities = "Select count(activities_tbl.a_title) AS total_students,a_type, activities_tbl.a_title AS activities_title, a_strand_s, a_strand_c, a_strand_a, a_strand_l, individual_activity_tbl.a_implement_date_start AS date_start, individual_activity_tbl.a_implement_date_end AS date_end, s_c_beneficiaries, s_c_publicity, s_c_remarks FROM activities_tbl 
					LEFT JOIN individual_activity_tbl
					ON individual_activity_tbl.a_id = activities_tbl.a_id
					LEFT JOIN scale_coordinator_report_tbl
					ON scale_coordinator_report_tbl.a_title =activities_tbl.a_title AND scale_coordinator_report_tbl.a_implement_date_start=individual_activity_tbl.a_implement_date_start AND scale_coordinator_report_tbl.a_implement_date_end=individual_activity_tbl.a_implement_date_end
					group by activities_tbl.a_title,a_type,  a_strand_s, a_strand_c, a_strand_a, a_strand_l, individual_activity_tbl.a_implement_date_start, individual_activity_tbl.a_implement_date_end";
					$resultActivities = $conn->query($queryActivities);
            if ($resultActivities->num_rows > 0) {
                while($rowActivities = $resultActivities->fetch_assoc()) {
					$strands = array();
					if ($rowActivities["a_strand_s"]) $strands[] = "S";
					if ($rowActivities["a_strand_c"]) $strands[] = "C";
					if ($rowActivities["a_strand_a"]) $strands[] = "A";
					if ($rowActivities["a_strand_l"]) $strands[] = "L";
					
					$studentCount = 0;
					
					if($rowActivities["a_type"] =='I'){
						$studentCount=1;
						
					}else{
						$studentCount= $rowActivities["total_students"];
					}
					
					
                    echo "<tr>";
                    echo "<td><a href='insert_scaco_quarterly_report.php?a_title=".$rowActivities["activities_title"]."&start_date=".$rowActivities["date_start"]."&end_date=".$rowActivities["date_end"]."'>" . htmlspecialchars($rowActivities['activities_title']) . "</a></td>";
                    echo "<td>".implode(" ", $strands)."</td>";
                    echo "<td>".$rowActivities["date_start"]."-".$rowActivities["date_end"]."</td>";
					echo "<td>".$studentCount."</td>";
					echo "<td>".$rowActivities["s_c_beneficiaries"]."</td>";
					echo "<td>".$rowActivities["s_c_publicity"]."</td>";
					echo "<td>".$rowActivities["s_c_remarks"]."</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Nothing added yet.</td></tr>";
            }
					?>
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
					<?php 
					$Gr11 = 0;
					$sqlCountGr11="Select COUNT(*) AS total_gr11 FROM users_info_tbl where ui_position ='Student' AND ui_grade =11";
					$stmt =$conn->prepare($sqlCountGr11);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$Gr11=$details['total_gr11'];
						
					}
					
					$Gr11Complete = 0;
					$sqlCountGr11Complete="Select DISTINCT u_id FROM student_report_tbl";
					$stmt =$conn->prepare($sqlCountGr11Complete);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$Gr11Complete=$result->num_rows;
						
					}
					
					
					$Gr12 = 0;
					$sqlCountGr12="Select COUNT(*) AS total_gr12 FROM users_info_tbl where ui_position ='Student' AND ui_grade =12";
					$stmt =$conn->prepare($sqlCountGr12);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$Gr12=$details['total_gr12'];
						
					}
					
					$Gr12Complete = 0;
					$sqlCountGr12Complete="Select DISTINCT u_id FROM student_report_tbl";
					$stmt =$conn->prepare($sqlCountGr12Complete);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$Gr12Complete=$result->num_rows;
						
					}
					
					$ScaleGr11 =0;
					$sql="Select DISTINCT individual_activity_tbl.u_id AS individual_id FROM individual_activity_tbl
					LEFT JOIN users_info_tbl
					ON individual_activity_tbl.u_id = users_info_tbl.u_id
					WHERE users_info_tbl.ui_grade = 11
					";
					
					$stmt =$conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$ScaleGr11=$result->num_rows;
						
					}
					
					
					$ScaleGr12 =0;
					$sql="Select DISTINCT individual_activity_tbl.u_id AS individual_id FROM individual_activity_tbl
					LEFT JOIN users_info_tbl
					ON individual_activity_tbl.u_id = users_info_tbl.u_id
					WHERE users_info_tbl.ui_grade = 12
					";
					
					$stmt =$conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$ScaleGr12=$result->num_rows;
						
					}
					$outcome1 = 0 ;
					$outcome2 = 0 ;
					$outcome3 = 0 ;
					$outcome4 = 0 ;
					$outcome5 = 0 ;
					$outcome6 = 0 ;
					$outcome7 = 0 ;
					$outcome8 = 0 ;
					
					$sql="SELECT 
    SUM(COALESCE(a_outcome_1, 0)) AS t_outcome1,
    SUM(COALESCE(a_outcome_2, 0)) AS t_outcome2,
    SUM(COALESCE(a_outcome_3, 0)) AS t_outcome3,
    SUM(COALESCE(a_outcome_4, 0)) AS t_outcome4,
    SUM(COALESCE(a_outcome_5, 0)) AS t_outcome5,
    SUM(COALESCE(a_outcome_6, 0)) AS t_outcome6,
    SUM(COALESCE(a_outcome_7, 0)) AS t_outcome7,
    SUM(COALESCE(a_outcome_8, 0)) AS t_outcome8
FROM individual_activity_tbl
LEFT JOIN users_info_tbl
    ON individual_activity_tbl.u_id = users_info_tbl.u_id
WHERE ui_grade = 11
    AND ui_position = 'Student'";
					$stmt =$conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						
					$outcome1 = $details['t_outcome1'] ;
					$outcome2 = $details['t_outcome2'] ;
					$outcome3 = $details['t_outcome3'];
					$outcome4 = $details['t_outcome4'] ;
					$outcome5 = $details['t_outcome5'] ;
					$outcome6 = $details['t_outcome6'];
					$outcome7 = $details['t_outcome7'];
					$outcome8 = $details['t_outcome8'] ;	
						
					}
					
								$outcomes = [
				'1' => $outcome1,
				'2' => $outcome2,
				'3' => $outcome3,
				'4' => $outcome4,
				'5' => $outcome5,
				'6' => $outcome6,
				'7' => $outcome7,
				'8' => $outcome8,
			];
					
					
					$minOutcomeKey = array_search(min($outcomes), $outcomes);
					
					$Gr12outcome1 = 0 ;
					$Gr12outcome2 = 0 ;
					$Gr12outcome3 = 0 ;
					$Gr12outcome4 = 0 ;
					$Gr12outcome5 = 0 ;
					$Gr12outcome6 = 0 ;
					$Gr12outcome7 = 0 ;
					$Gr12outcome8 = 0 ;
					
					$sql = "Select sum(a_outcome_1) AS t_outcome1 , sum(a_outcome_2) AS t_outcome2, sum(a_outcome_3) AS t_outcome3, sum(a_outcome_4)  AS t_outcome4, sum(a_outcome_5) AS t_outcome5, sum(a_outcome_6) AS t_outcome6, sum(a_outcome_7) AS t_outcome7, sum(a_outcome_8) AS t_outcome8 FROM individual_activity_tbl
					LEFT JOIN users_info_tbl
					ON individual_activity_tbl.u_id = users_info_tbl.u_id WHERE ui_grade =12 AND ui_position='Student'
					
					";
					$stmt =$conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						
					$Gr12outcome1 = $details['t_outcome1'] ;
					$Gr12outcome2 = $details['t_outcome2'] ;
					$Gr12outcome3 = $details['t_outcome3'];
					$Gr12outcome4 = $details['t_outcome4'] ;
					$Gr12outcome5 = $details['t_outcome5'] ;
					$Gr12outcome6 = $details['t_outcome6'];
					$Gr12outcome7 = $details['t_outcome7'];
					$Gr12outcome8 = $details['t_outcome8'] ;	
						
					}
					
								$Gr12outcomes = [
				'1' => $Gr12outcome1,
				'2' => $Gr12outcome2,
				'3' => $Gr12outcome3,
				'4' => $Gr12outcome4,
				'5' => $Gr12outcome5,
				'6' => $Gr12outcome6,
				'7' => $Gr12outcome7,
				'8' => $Gr12outcome8,
				
				
			];
			
			$Gr12minOutcomeKey = array_search(min($Gr12outcomes), $Gr12outcomes);
					
					
					
					$strand_s = 0;
					$strand_c = 0;
					$strand_a = 0;
					$strand_l = 0;

					$sql ="Select sum(a_strand_s) AS strand_s, sum(a_strand_c) AS strand_c, sum(a_strand_a) AS strand_a, sum(a_strand_l) AS strand_l 
					FROM activities_tbl 
					INNER JOIN users_info_tbl
					ON activities_tbl.u_id = users_info_tbl.u_id
					WHERE ui_grade=11 AND ui_position='Student'";
					$stmt =$conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$strand_s = $details['strand_s'];
						$strand_c = $details['strand_c'];
						$strand_a = $details['strand_a'];
						$strand_l = $details['strand_l'];
						
					}
					
					
					$strands = [
				'S' => $strand_s,
				'C' => $strand_c,
				'A' => $strand_a,
				'L' => $strand_l,
				
				];
				
				
				$minStrandKey = array_search(min($strands), $strands);
			
					$Gr12Strand_s = 0;
					$Gr12Strand_c = 0;
					$Gr12Strand_a = 0;
					$Gr12Strand_l = 0;
			
			
			
			
			$sql ="Select sum(a_strand_s) AS strand_s, sum(a_strand_c) AS strand_c, sum(a_strand_a) AS strand_a, sum(a_strand_l) AS strand_l 
					FROM activities_tbl 
					INNER JOIN users_info_tbl
					ON activities_tbl.u_id = users_info_tbl.u_id
					WHERE ui_grade=12 AND ui_position='Student'";
					$stmt =$conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$Gr12Strand_s = $details['strand_s'];
						$Gr12Strand_c = $details['strand_c'];
						$Gr12Strand_a = $details['strand_a'];
						$Gr12Strand_l = $details['strand_l'];
						
					}
					
					
					$Gr12Strands = [
				'S' => $Gr12Strand_s,
				'C' => $Gr12Strand_c,
				'A' => $Gr12Strand_a,
				'L' => $Gr12Strand_l,
				
				];
				
				
				$Gr12MinStrandKey = array_search(min($Gr12Strands), $Gr12Strands);

					
					?>
					  <tr>
						<td colspan="2">No. of Students</td>
						<td colspan="2"><?php echo $Gr11 ?></td>
						<td colspan="2"><?php echo $Gr12 ?></td>
						<td colspan="2"><?php echo $Gr11+$Gr12 ?></td>
					  </tr>
					  <tr>
						<td colspan="2">No. of Students who completed</td>
						<td colspan="2"><?php echo $Gr11Complete ?></td>
						<td colspan="2"><?php echo $Gr12Complete ?></td>
						<td colspan="2"><?php echo $Gr11Complete+$Gr12Complete ?></td>
					  </tr>
					  <tr>
						<?php
						$Gr11Scheduled=0;
						$Gr12Scheduled=0;
						$Gr11Ahead=0;
						$Gr12Ahead=0;
						$Gr11Delayed=0;
						$Gr12Delayed=0;
						$sqlProgress = "Select s_c_scheduledGrade11, s_c_scheduledGrade12, s_c_aheadGrade11, s_c_aheadGrade12, s_c_delayedGrade11, s_c_delayedGrade12 FROM scale_coordinator_report_tbl
					";
					
					$stmt =$conn->prepare($sqlProgress);
					$stmt->execute();
					$result = $stmt->get_result();
					$details= $result->fetch_assoc();
					
					if($result->num_rows >0){
						$Gr11Scheduled=$details['s_c_scheduledGrade11'];
						$Gr12Scheduled=$details['s_c_scheduledGrade12'];
						$Gr11Ahead=$details['s_c_aheadGrade11'];
						$Gr12Ahead=$details['s_c_aheadGrade12'];
						$Gr11Delayed=$details['s_c_delayedGrade11'];
						$Gr12Delayed=$details['s_c_delayedGrade12'];
						
					}
						
						
					echo"<tr>";
					echo	"<td rowspan=3>Overall Student Progress</td>";
					echo	"<td>As Scheduled</td>";
					echo	"<td colspan=2>" . $Gr11Scheduled . "</td>";
					echo	"<td colspan=2>" . $Gr12Scheduled . "</td>";
					echo	"<td colspan=2>".$Gr11Scheduled + $Gr12Scheduled."</td>";
					echo "</tr>";
					echo  "<tr>";
					echo	"<td>Ahead of Time</td>";
					echo	"<td colspan=2>" . $Gr11Ahead . "</td>";
					echo	"<td colspan=2>" . $Gr12Ahead . "</td>";
					echo	"<td colspan=2>" . $Gr11Ahead + $Gr12Ahead . "</td>";
					 echo "</tr>";
					  
					  echo "<tr>";
						echo "<td>Delayed</td>";
						echo "<td colspan=2>" . $Gr11Delayed . "</td>";
						echo "<td colspan=2>" . $Gr12Delayed . "</td>";
						echo "<td colspan=2>" . $Gr11Delayed +$Gr12Delayed. "</td>";
					  echo "</tr>";
					  
					  ?>
					  <tr>
						<td colspan="4">Usual Causes of Delay in SCALe</td>
						<td colspan="4">Action to be taken to improve SCALe</td>
					  </tr>
					  <tr>
						 <td colspan="8"><a href="insert_student_progress.php"><input type="button" value="Edit"></a></td>
					 </tr>
					   <tr>
						<th colspan="2"></th>
						<th colspan="2">Grade 11</th>
						<th colspan="2">Grade 12</th>
						<th colspan="2">Total</th>
					  </tr>
					  <tr>
						<td colspan="2">No. of Student-Initiated SCALe</td>
						<td colspan="2"><?php echo $ScaleGr11?></td>
						<td colspan="2"><?php echo $ScaleGr12?></td>
						<td colspan="2"><?php echo $ScaleGr11+$ScaleGr12?></td>
					  </tr>
					  <tr>
						<td colspan="2">Learning Outcome of Concern (least no. achieved)</td>
						<td colspan="2"><?php echo $minOutcomeKey;?></td>
						<td colspan="2"><?php echo $Gr12minOutcomeKey;?></td>
						<td colspan="2"></td>
					  </tr>
					  <tr>
						<td colspan="2">Strands of Concern (least no. achieved)</td>
						<td colspan="2"><?php echo $minStrandKey; ?></td>
						<td colspan="2"><?php echo $Gr12MinStrandKey; ?></td>
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
