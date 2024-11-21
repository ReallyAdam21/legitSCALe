<?php
session_start();
include 'connect.php';

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';
$level =$_SESSION['level'] ?? '';
$activityID = isset($_POST['txtActivityTitle']) ? (int)$_POST['txtActivityTitle'] : null;
$query_string_id =isset($_GET['id']) ? (int)$_GET['id'] : null;
$userInfo = "SELECT ui_batch, ui_section FROM users_info_tbl WHERE u_id=?" ;
$isSubmit= isset($_POST['btnSubmit']) ? $_POST['btnSubmit'] : '';
$stmt =$conn->prepare($userInfo);
		$stmt->bind_param('i', $query_string_id );
		$stmt->execute();
		$result = $stmt->get_result();
		$info= $result->fetch_assoc();
			if($info){
				$batch = $info['ui_batch'];
				$section =$info['ui_section'];
				
			}

$querySection = "SELECT 
    users_info_tbl.ui_batch, 
    users_info_tbl.ui_grade, 
    users_info_tbl.ui_section, 
    users_info_tbl.ui_position, 
    users_tbl.u_fname, 
    users_tbl.u_lname, 
    users_tbl.u_mname 
FROM 
    users_info_tbl 
INNER JOIN 
    users_tbl 
ON 
    users_info_tbl.u_id = users_tbl.u_id 
WHERE 
    users_tbl.u_level = 2 
    AND users_info_tbl.ui_section = ?";
$stmt = $conn->prepare($querySection);
$stmt->bind_param('s', $section);
$stmt->execute();
$result = $stmt->get_result();
$info = $result->fetch_assoc();
if ($info) {
    $advlname = $info['u_lname'];
    $advmname = $info['u_mname'];
    $advfname = $info['u_fname'];
}

$query ="SELECT a_type FROM activities_tbl WHERE u_id =?";
		$stmt =$conn->prepare($query);
		$stmt->bind_param('i', $query_string_id  );
		$stmt->execute();
		$result = $stmt->get_result();
		$details= $result->fetch_assoc();

$adviserName = htmlspecialchars($advlname . ", " . $advfname . " " . $advmname);
// Fetch student's name
$studentName = htmlspecialchars($lname . ", " . $fname . " " . $mname);



function getActivity (){
	global $conn; 
	global $activityID;
	global $query_string_id;
$sqlQueryActivity = "SELECT a_id, a_title FROM activities_tbl WHERE u_id=?";
$stmt =$conn->prepare($sqlQueryActivity);
		$stmt->bind_param('i', $query_string_id );
		$stmt->execute();
		$result = $stmt->get_result();
		
		

$dropdown = '<select name = "txtActivityTitle" id = "txtActivityTitle" onchange="submitFormOnChange()">';
$dropdown .= '<option value="">Select Activity</option>';

while ($row = $result->fetch_assoc()){
	
	$id =$row['a_id'];
	$activity_title = $row['a_title'];
	$selected = ($id== $activityID) ? 'selected' : '';
	$dropdown .= "<option value='$id' $selected>$activity_title</option>";
}
$dropdown.= '</select>';

return $dropdown;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scale Individual Program Report</title>
	<script type="text/javascript">
	function submitFormOnChange(){
		document.getElementById('activityForm').submit();
	}
	</script>
    <style>
        body {
            font-family: Arial, sans-serif;
			
        }
        .landscape {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            
            transform-origin: center;
        }
        .form-container {
            width: 80vw;
            padding: 20px;
            border: 1px solid #000;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .header, .footer {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .input-field {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<?php include 'links.php'; ?>
<body>
    <div class="landscape">
        <div class="form-container">
            <div class="header">
                PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM<br>
                SCALE INDIVIDUAL PROGRAM REPORT
            </div>

            <form>
                <label for="campus">Campus:</label>
                <input type="text" name= "Campus" id="campus" class="input-field"><br><br>

                <label for="studentName">Name of Student:</label>
                <input type="text" name= "studentName" id="studentName" class="input-field" value="<?php echo strtoupper($studentName) ?>"><br><br>

                <label for="batch">Batch:</label>
                <input type="text" name= "batch" id="batch" class="input-field" value ="<?php echo $batch ?> "><br><br>

                <label for="adviserName">Name of Adviser:</label>
                <input type="text" name="adviserName" id="adviserName" class="input-field" value="<?php echo strtoupper($adviserName) ?>"><br><br>
                <label for="evidence">Attached Evidence:</label>
                <input type="text" name="evidence" id="evidence" placeholder="Narrative Reports (N), Reflection Paper (R), Photo/Video (P/V), Certification (C), Others" class="input-field"><br><br>
				
                <table>
                    <thead>
                        <tr>
                            <th>Title of Activity</th>
							<th>Strands</th>
                            <th>Learning Outcomes</th>
							<th>Type</th>
                            <th>Date of Completion</th>
                            <th>Submitted Evidence</th>
                            <th>Remarks</th>
							<th></th>
                        </tr>
                    </thead>
                    <tbody>
					<?php 
						$queryActivities = "SELECT 
							individual_activity_tbl.a_id AS individual_a_id,
							individual_activity_tbl.a_outcome_1,
							individual_activity_tbl.a_outcome_2,
							individual_activity_tbl.a_outcome_3,
							individual_activity_tbl.a_outcome_4,
							individual_activity_tbl.a_outcome_5,
							individual_activity_tbl.a_outcome_6,
							individual_activity_tbl.a_outcome_7,
							individual_activity_tbl.a_outcome_8,
							individual_activity_tbl.i_a_completion_date,
							individual_activity_tbl.i_a_evidence,
							individual_activity_tbl.i_a_remarks,
							activities_tbl.a_title AS activity_title,
							activities_tbl.a_type AS activity_type,
							activities_tbl.a_strand_s AS strand_s,
							activities_tbl.a_strand_c AS strand_c,
							activities_tbl.a_strand_a AS strand_a,
							activities_tbl.a_strand_l AS strand_l
						FROM individual_activity_tbl 
						INNER JOIN activities_tbl
							ON individual_activity_tbl.a_id = activities_tbl.a_id
						WHERE individual_activity_tbl.u_id = ?";
					
					$stmt =$conn->prepare($queryActivities);
					$stmt->bind_param('i', $query_string_id );
					$stmt->execute();
					$result = $stmt->get_result();
								while ($row = $result->fetch_assoc()) {
					$a_service = $row['strand_s'] ?? 0;
					$a_creativity = $row['strand_c'] ?? 0;
					$a_action = $row['strand_a'] ?? 0;
					$a_leadership = $row['strand_l'] ?? 0;
					$activity_type = $row['activity_type'] ?? '';
					$outcome1 = $row['a_outcome_1'] ?? 0;
					$outcome2 = $row['a_outcome_2'] ?? 0;
					$outcome3 = $row['a_outcome_3'] ?? 0;
					$outcome4 = $row['a_outcome_4'] ?? 0;
					$outcome5 = $row['a_outcome_5'] ?? 0;
					$outcome6 = $row['a_outcome_6'] ?? 0;
					$outcome7 = $row['a_outcome_7'] ?? 0;
					$outcome8 = $row['a_outcome_8'] ?? 0;
					$activities = (($a_service != 0) ? 'S' : '') . (($a_creativity != 0) ? 'C' : '') . (($a_action != 0) ? 'A' : '') . (($a_leadership != 0) ? 'L' : '');
					$outcomes = (($outcome1 != 0) ? '1' : '') . (($outcome2 != 0) ? ',2' : '') . (($outcome3 != 0) ? ',3' : '') . (($outcome4 != 0) ? ',4' : '').(($outcome5 != 0) ? ',5' : ''). (($outcome6 != 0) ? ',6' : ''). (($outcome7 != 0) ? ',7' : ''). (($outcome8 != 0) ? ',8' : '');
				
				?>
                        <tr>
                            <td><a href ="insert_form4.php?u_id=<?php echo $query_string_id; ?>&a_id=<?php echo $row['individual_a_id']; ?>"><?php echo $row['activity_title']; ?></a></td>
                            <td><?php echo $activities; ?></td>
                            <td><?php echo $outcomes ?></td>
                            <td><?php echo $row['activity_type']; ?></td>
                            <td><?php echo $row['i_a_completion_date'];?></td>
							<td><?php  echo $row['i_a_evidence'] ? : ''; ?></td> 
							<td><?php  echo $row['i_a_remarks'] ? : ''; ?></td> 
                        </tr>
					<?php }
					?>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
				
                <br><br>
                <div class="footer">
                    <label for="studentSignature">Signature of Student:</label>
                    <input type="text" id="studentSignature" class="input-field"><br><br>

                    <label for="adviserSignature">Signature of Adviser:</label>
                    <input type="text" id="adviserSignature" class="input-field"><br><br>
                </div>
				<button type = "submit" id="btnSubmit" name="btnSubmit" value="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
