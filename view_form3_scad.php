<?php
session_start();
include 'connect.php';

$query_string_id =isset($_GET['u_id']) ? (int)$_GET['u_id'] : null;
// Check if the u_id is provided via GET
if (isset($_GET['u_id']) && !empty($_GET['u_id'])) {
    $u_id = intval($_GET['u_id']); // Ensure it's an integer for security
    $_SESSION['u_id'] = $u_id; // Optionally, store it in the session
} elseif (isset($_SESSION['u_id'])) {
    $u_id = $_SESSION['u_id']; // Fallback to session value if available
} else {
    // Redirect or handle error if u_id is not provided
    header('Location: error.php?error=missing_u_id');
    exit();
}

$sqlStudent = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_id = ?";
$stmt = $conn->prepare($sqlStudent);
$stmt->bind_param('i', $u_id); // Use the validated $u_id
$stmt->execute();
$resultStudent = $stmt->get_result();

if ($resultStudent->num_rows > 0) {
    $rowStudent = $resultStudent->fetch_assoc();
    $studentName = htmlspecialchars($rowStudent['u_lname'] . ', ' . $rowStudent['u_fname'] . ' ' . $rowStudent['u_mname']);
}

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';

// Fetch adviser's name for the user
$sqlAdviser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_level = 2 LIMIT 1";
$resultAdviser = $conn->query($sqlAdviser);

$adviserName = '';
if ($resultAdviser->num_rows > 0) {
    $rowAdviser = $resultAdviser->fetch_assoc();
    $adviserName = $rowAdviser['u_lname'] . ' ' . $rowAdviser['u_fname'] . ' ' . $rowAdviser['u_mname'];
}

// Fetch student's name
$studentName = htmlspecialchars($lname . ", " . $fname . " " . $mname);

// Fetch adviser's remarks and activity status
$sqlRemarks = "SELECT a_sa_remarks, a_status FROM activities_tbl WHERE u_id = '$id' LIMIT 1";
$resultRemarks = $conn->query($sqlRemarks);
$remarks = '';
$status = '';

$sqlActivityDetails = "SELECT a_type, a_strand_s, a_strand_c, a_strand_a, a_strand_l, a_description, a_title 
                       FROM activities_tbl WHERE a_id = 'a_id'";
$resultActivityDetails = $conn->query($sqlActivityDetails);

$batch = $activityType = $description = "";
$strandService = $strandCreativity = $strandAction = $strandLeadership = "";

if ($resultActivityDetails->num_rows > 0) {
    $rowActivity = $resultActivityDetails->fetch_assoc();-
    $activityType = htmlspecialchars($rowActivity['a_type']);
    $description = htmlspecialchars($rowActivity['a_description']);
    $strandService = $rowActivity['a_strand_s'] ? "checked" : "";
    $strandCreativity = $rowActivity['a_strand_c'] ? "checked" : "";
    $strandAction = $rowActivity['a_strand_a'] ? "checked" : "";
    $strandLeadership = $rowActivity['a_strand_l'] ? "checked" : "";
}

$sqlBatch = "SELECT ui_batch FROM users_info_tbl WHERE u_id = '$id'";
$resultBatch = $conn->query($sqlBatch);



$activityID = isset($_POST['txtActivityTitle']) ? (int)$_POST['txtActivityTitle'] : null;
$outcome1 = isset($_POST['outcome1']) ? 1 :0 ;
$outcome2 = isset($_POST['outcome2']) ? 1 :0 ;
$outcome3 = isset($_POST['outcome3']) ? 1 :0 ;
$outcome4 = isset($_POST['outcome4']) ? 1 :0 ;
$outcome5 = isset($_POST['outcome5']) ? 1 :0 ;
$outcome6 = isset($_POST['outcome6']) ? 1 :0 ;
$outcome7 = isset($_POST['outcome7']) ? 1 :0 ;
$outcome8 = isset($_POST['outcome8']) ? 1 :0 ;
$venue =isset($_POST['txtVenue']) ? $_POST['txtVenue'] : '';
$planning_start =isset($_POST['planning_start']) ? $_POST['planning_start'] : '';
$planning_end =isset($_POST['planning_end']) ? $_POST['planning_end'] : '';
$implementation_start =isset($_POST['implementation_start']) ? $_POST['implementation_start'] : '';
$implementation_end =isset($_POST['implementation_end']) ? $_POST['implementation_end'] : '';
$objectives = isset($_POST['txtObjectives']) ? $_POST['txtObjectives'] : '';

$isSubmit= isset($_POST['btnSubmit']) ? $_POST['btnSubmit'] : '';
if ($_SERVER['REQUEST_METHOD']=='POST'){
	//check if the required fields are filled

	if($activityID){
		if($isSubmit){
		
		
		$query ="SELECT * FROM individual_activity_tbl WHERE u_id =? AND a_id = ?";
		$stmt =$conn->prepare($query);
		$stmt->bind_param('ii', $query_string_id, $activityID );
		$stmt->execute();
		$result = $stmt->get_result();
		$details= $result->fetch_assoc();
		
		if ($details){
			$outcome1 = $details['a_outcome_1'];
			$outcome2 = $details['a_outcome_2'];
			$outcome3 = $details['a_outcome_3'];
			$outcome4 = $details['a_outcome_4'];
			$outcome5 = $details['a_outcome_5'];
			$outcome6 = $details['a_outcome_6'];
			$outcome7 = $details['a_outcome_7'];
			$outcome8 = $details['a_outcome_8'];
			$venue = $details['a_venue'];
			$planning_start = $details['a_plan_date_start'];
			$planning_end = $details['a_plan_date_end'];
			$implementation_start = $details['a_implement_date_start'];
			$implementation_end = $details['a_implement_date_end'];
			$objectives = $details['a_objectives'];
		}
			if($result->num_rows >0){
				$update_query = "UPDATE individual_activity_tbl set
				a_venue =?, a_objectives=?, a_plan_date_start=?, a_plan_date_end=?, a_implement_date_start=?, a_implement_date_end=?,a_outcome_1=?,  a_outcome_2=?, a_outcome_3=?, a_outcome_4=?, a_outcome_5=?, a_outcome_6=?, a_outcome_7=?, a_outcome_8=? WHERE u_id =? AND a_id =?";
				
				
				$stmt_update=$conn->prepare($update_query);
				$stmt_update->bind_param('ssssssiiiiiiiiii', $venue, $objectives, $planning_start, $planning_end, $implementation_start, $implementation_end, $outcome1, $outcome2, $outcome3, $outcome4, $outcome5,$outcome6, $outcome7, $outcome8, $query_string_id, $activityID);
				
				if ($stmt_update->execute()){
					$message = "Record has been updated successfully";
				}else{
					$message = "Error updating record: " .$stmt_update->error;
				}
			}else{
				
				$query = "INSERT INTO individual_activity_tbl ( u_id, a_id, a_objectives, a_plan_date_start, a_plan_date_end, a_implement_date_start, a_implement_date_end, a_outcome_1, a_outcome_2, a_outcome_3, a_outcome_4, a_outcome_5, a_outcome_6, a_outcome_7, a_outcome_8, a_venue)
					  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
					  
			
				$stmt =$conn->prepare($query);
				$stmt->bind_param('iisssssiiiiiiiis',  $query_string_id, $activityID, $objectives, $planning_start, $planning_end, $implementation_start, $implementation_end, $outcome1, $outcome2, $outcome3, $outcome4, $outcome5, $outcome6, $outcome7, $outcome8, $venue);
			
				if ($stmt->execute()){
					$message = "Data has been saved successfully";
				}
				else{
					$message = "Error saving data: " .$stmt->error;
				
				}
			}
		}else{
		
			$query ="SELECT * FROM individual_activity_tbl WHERE u_id =? AND a_id = ?";
		$stmt =$conn->prepare($query);
		$stmt->bind_param('ii', $query_string_id, $activityID );
		$stmt->execute();
		$result = $stmt->get_result();
		$details= $result->fetch_assoc();
		
			if ($details){
				$outcome1 = $details['a_outcome_1'];
				$outcome2 = $details['a_outcome_2'];
				$outcome3 = $details['a_outcome_3'];
				$outcome4 = $details['a_outcome_4'];
				$outcome5 = $details['a_outcome_5'];
				$outcome6 = $details['a_outcome_6'];
				$outcome7 = $details['a_outcome_7'];
				$outcome8 = $details['a_outcome_8'];
				$venue = $details['a_venue'];
				$planning_start = $details['a_plan_date_start'];
				$planning_end = $details['a_plan_date_end'];
				$implementation_start = $details['a_implement_date_start'];
				$implementation_end = $details['a_implement_date_end'];
				$objectives = $details['a_objectives'];
			}
		}
	}else{
		$message ="Please fill all the required fields";
	}
	
}
if($activityID) {
	
	$query = "SELECT a_type, a_id, a_strand_s, a_strand_c, a_strand_a, a_strand_l, a_description FROM activities_tbl WHERE a_id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param('i', $activityID);
	$stmt->execute();
	$result = $stmt->get_result();
	$activityDetails = $result->fetch_assoc();
	
	if ($activityDetails) {
		$a_service = $activityDetails['a_strand_s'];
		$a_creativity = $activityDetails['a_strand_c'];
		$a_action = $activityDetails['a_strand_a'];
		$a_leadership = $activityDetails['a_strand_l'];
		$activity_type = $activityDetails['a_type'];
		$a_description = $activityDetails['a_description'];
	
	}else {
		$a_service = 0;
		$a_creativity = 0;
		$a_action = 0;
		$a_leadership = 0;
		$activity_type = '';
		$a_description ='';
	}
	
	
}else {
	$a_service = 0;
	$a_creativity = 0;
	$a_action = 0;
	$a_leadership = 0;
	$activity_type = '';
	$a_description ='';
}



function getActivity (){
	global $conn; 
	global $activityID;
$sqlQueryActivity = "SELECT a_id, a_title FROM activities_tbl";
$resultActivity = $conn->query($sqlQueryActivity);


$dropdown = '<select name = "txtActivityTitle" id = "txtActivityTitle" onchange="submitFormOnChange()">';
$dropdown .= '<option value="">Select Activity</option>';

while ($row = $resultActivity->fetch_assoc()){
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
    <title>SCALE Individual Activity Plan</title>
	<script type="text/javascript">
	function submitFormOnChange(){
		document.getElementById('activityForm').submit();
	}
	
	</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        form {
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
            max-width: 800px;
            margin: 50px auto;
            height: 600px;
            overflow: auto;
        }
        header { text-align: center; }
        th { font-size: 15px; }
        .add-button { margin-top: 10px; display: block; }
    </style>
</head>
<?php include 'links.php'; ?>
<body>
   <form action="view_form3_scad.php?u_id=<?php echo $query_string_id; ?>" method="post" id="activityForm">
    <input type="hidden" name="u_id" value="<?php echo $u_id; ?>"> <!-- Hidden u_id input -->
        <header>
            PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM<br>
            SCALE INDIVIDUAL ACTIVITY PLAN
        </header>

        <!-- Student and Adviser Info -->
        <table>
            <tr>
                <th>Name of Student:</th>
                <td><?php echo $studentName; ?></td>
            </tr>
            <tr>
                <th>Name of Adviser:</th>
                <td><?php echo htmlspecialchars($adviserName); ?></td>
            </tr>
        </table>
<!-- Activity Details -->
        <div class="section-title">Activity Details</div>
		<?php if (isset($message)):?>
			<p><?php echo $message; ?></p>
			<?php endif; ?>
        <table>
            <tr>
                <th>Title of Activity:</th>
			<td><?php
			echo getActivity();
			?>
			</td>
            </tr>
            <tr>
                <th>Type of Activity:</th>
                <td>
                   <label> <input disabled type="radio" name="activity_type" value="I" <?php echo ($activity_type == 'I') ? 'checked': '';?>> Individual</label>
                    <label><input disabled type="radio" name="activity_type" value="G"<?php echo ($activity_type == 'G') ? 'checked': '';?>> Group</label>
                </td>
            </tr>
            <tr>
                <th>Strand:</th>
                <td>
                   <label> <input disabled type="checkbox" name="a_service" value="1" <?php echo ($a_service !=0) ? 'checked': '';?>>  Service</label>
                    <label> <input disabled type="checkbox" name="a_creativity" value="1" <?php echo ($a_creativity !=0) ? 'checked': '';?>> Creativity </label>
                     <label><input disabled type="checkbox" name="a_action" value="1" <?php echo ($a_action !=0) ? 'checked': '';?>> Action </label>
                     <label><input disabled type="checkbox" name="a_leadership" value="1"  <?php echo ($a_leadership !=0) ? 'checked': '';?>> Leadership </label>
                </td>
            </tr>
        </table>

        <!-- Objectives -->
        <div class="section-title">Learning Outcomes</div>
        <table>
            <tr>
                <th><input readonly type="checkbox" name="outcome1" id ="outcome1" value="1"<?php echo ($outcome1 == 1) ? 'checked' : ''; ?>> Increased awareness of strengths</th>
            </tr>
            <tr>
                <th><input readonly type="checkbox" name="outcome2" id ="outcome2" value="1"<?php echo ($outcome2 == 1) ? 'checked' : ''; ?>> Undertaken new challenges</th>
            </tr>
			<tr>
                <th><input readonly type="checkbox" name="outcome3" id ="outcome3" value="1"<?php echo ($outcome3 == 1) ? 'checked' : ''; ?>> Introduced and managed activities</th>
            </tr>
			<tr>
                <th><input readonly type="checkbox" name="outcome4" id ="outcome4" value="1"<?php echo ($outcome4 == 1) ? 'checked' : ''; ?>> Contributed actively in group activities</th>
            </tr>
			<tr>
                <th><input readonly type="checkbox" name="outcome5" id ="outcome5" value="1"<?php echo ($outcome5 == 1) ? 'checked' : ''; ?>> Demonstrated perseverance and commitment in their activities</th>
            </tr>
			<tr>
                <th><input readonly type="checkbox" name="outcome6" id ="outcome6" value="1"<?php echo ($outcome6 == 1) ? 'checked' : ''; ?>> Engaged with issues of global importance</th>
            </tr>
			<tr>
                <th><input readonly type="checkbox" name="outcome7" id ="outcome7" value="1"<?php echo ($outcome7 == 1) ? 'checked' : ''; ?>> Reflected on the ethical consequence of their actions</th>
            </tr>
			<tr>
                <th><input readonly type="checkbox" name="outcome8" id ="outcome8" value="1"<?php echo ($outcome8 == 1) ? 'checked' : ''; ?>> Developed new skills</th>
            </tr>
        </table>

        <!-- Planning and Implementation Dates -->
        <div class="section-title">Planning and Implementation Dates</div>
        <table>
            <tr>
                <th>Planning Dates (Start-End):</th>
                <td><input readonly type="txt" name="planning_start" id="planning_start" value="<?php echo htmlspecialchars($planning_start);?>" /> to <input  disabled type="txt" name="planning_end" id="planning_end" value="<?php echo htmlspecialchars($planning_end);?>" /></td>
            </tr>
            <tr>
                <th>Implementation Dates (Start-End):</th>
                <td><input readonly type="txt" name="implementation_start" id="implementation_start" value="<?php echo htmlspecialchars($implementation_start);?>" /> to <input disabled type="txt" name="implementation_end" id="implementation_end" value="<?php echo htmlspecialchars($implementation_end);?>" /></td>
            </tr>
            <tr>
                <th>Venue:</th>
                <td><input readonly style ="width:420px" type="text" name="txtVenue" id="txtVenue" value="<?php echo htmlspecialchars($venue);?>" /></td>
            </tr>
        </table>
		
	
		<table style ="text-align:left;" border=2px width ="100%" id="generalDescription">
			<tr>
				<th>
				I.General Description of the Activity
				
				
				</th>
			</tr>	
			<tr>
				<td disabled style="vertical-align:top;" rowspan='4' height="125"><?php echo $a_description ?> </td>
			</tr>
		</table>	


		<table style="text-align:left;" border=2px width ="100%" >
			<tr>
				<th>
				II.Objectives
				
				
				</th>
			</tr>	
			<tr>
				<td style="vertical-align:top;" rowspan='4' height="125"> 
			<textarea readonly style="width:99%; height:99%;" name ="txtObjectives" id="txtObjectives" rows="4"><?php echo htmlspecialchars($objectives);?></textarea>
				</td>
			
			</tr>
		</table>	
		
        <!-- Persons Involved -->
        <div class="section-title">Persons Involved</div>
        <table border =5px id="personsInvolved">
            <tr>
                <th>Adult Supervisor/Collaborator</th>
                <th>Designation/Position</th>
                <th>Company/Affiliation</th>
                <th>Contact Info</th>
            </tr>
            <?php
            // Query to get persons involved data
            $sqlPersons = "SELECT * FROM persons_tbl WHERE u_id = '$u_id' AND a_id='$activityID'";
            $resultPersons = $conn->query($sqlPersons);
            if ($resultPersons->num_rows > 0) {
                while($rowPersons = $resultPersons->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_supervisor']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_designation']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_company']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_contact']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No persons added yet.</td></tr>";
            }
            ?>
        </table>
        <a href="insert_persons.php"><button type="button" class="add-button">Add Person</button></a>

        <!-- Materials Needed -->
        <div class="section-title">Materials and Resources Needed</div>
        <table border = 5px id="materialsNeeded">
            <tr>
                <th>Qty</th>
                <th>Items</th>
                <th>Unit Cost</th>
                <th>Amount</th>
            </tr>
            <?php
            // Query to get materials data
            $sqlMaterials = "SELECT * FROM materials_tbl WHERE u_id = '$u_id' AND a_id='$activityID'";
            $resultMaterials = $conn->query($sqlMaterials);
            if ($resultMaterials->num_rows > 0) {
                while($rowMaterials = $resultMaterials->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_qty']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_items']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_unit_cost']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_amount']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No materials added yet.</td></tr>";
            }
            ?>
        </table>
        <a href="insert_materials.php"><button type="button" class="add-button">Add Material</button></a>

        <!-- Activity Risk Assessment -->
        <div class="section-title">Activity Risk Assessment</div>
        <table border = 5px id="riskAssessment">
            <tr>
                <th>Potential Hazards</th>
                <th>Safety Precautions</th>
            </tr>
            <?php
            // Query to get risk assessment data
            $sqlRisks = "SELECT * FROM risks_tbl WHERE u_id = '$u_id' AND a_id='$activityID'";
            $resultRisks = $conn->query($sqlRisks);
            if ($resultRisks->num_rows > 0) {
                while($rowRisks = $resultRisks->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($rowRisks['r_hazards']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowRisks['r_precautions']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No risks added yet.</td></tr>";
            }
            ?>
        </table>
        <a href="insert_risks.php"><button type="button" class="add-button">Add Risk</button></a>

        <!-- Certification -->
        <div class="section-title">Certification</div>
        <p>
            I certify that I have understood the potential hazards and risks...<br><br>
            Signature of Student: ________________________ Date: ____________<br><br>
            Name and Signature of Parent/Guardian: ________________________ Date: ____________<br><br>
            Name and Signature of SCALE Adviser: ________________________ Date: ____________
        </p>
        <!-- Adviser Remarks and Status -->
        <div class="section-title">Adviser Remarks</div>
        <table>
            <tr>
                <th>Remarks:</th>
                <td><?php echo $remarks ? $remarks : 'No remarks available'; ?></td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>
                    <input type="checkbox" disabled <?php echo ($status == "approved") ? 'checked' : ''; ?>> Approved
                    <input type="checkbox" disabled <?php echo ($status == "For Revision") ? 'checked' : ''; ?> style="margin-left: 10px;"> For Revision
                </td>
            </tr>
        </table>

  
        <div class="action-buttons">
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
