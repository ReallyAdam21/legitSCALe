<?php
session_start();
include 'connect.php';

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';
// Fetch student's name
$query_string_id =isset($_GET['u_id']) ? (int)$_GET['u_id'] : null;
//$studentName = htmlspecialchars($lname . ", " . $fname . " " . $mname);
$queryStudent = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_id=".$query_string_id;
$statement =$conn->prepare($queryStudent);
$statement->execute();
		$result = $statement->get_result();
		$details= $result->fetch_assoc();
		if($details){
				$studentName = $details['u_lname'].','. $details['u_fname'].' '. $details['u_mname'] ;
			}
$activityID = isset($_POST['txtActivityTitle']) ? (int)$_POST['txtActivityTitle'] : null;
$isSubmit= isset($_POST['btnSubmit']) ? $_POST['btnSubmit'] : '';

$section = '';
$querySection ="SELECT ui_section FROM users_info_tbl WHERE u_id=?";
$stmt =$conn->prepare($querySection);
		$stmt->bind_param('i', $query_string_id );
		$stmt->execute();
		$result = $stmt->get_result();
		$details= $result->fetch_assoc();
			if($details){
				$section = $details['ui_section'];
			}
$a_service='';
$a_creativity ='';
$a_action = '';
$a_leadership ='';
$outcome1 ='';
$outcome2 ='';
$outcome3 ='';
$outcome4 ='';
$outcome5 ='';
$outcome6 ='';
$outcome7 ='';
$outcome8 ='';

$serviceEvidence =isset($_POST['txtServiceEvidence']) ? $_POST['txtServiceEvidence'] : '';
$creativityEvidence =isset($_POST['txtCreativityEvidence']) ? $_POST['txtCreativityEvidence'] : '';
$actionEvidence =isset($_POST['txtActionEvidence']) ? $_POST['txtActionEvidence'] : '';
$leadershipEvidence =isset($_POST['txtLeadershipEvidence']) ? $_POST['txtLeadershipEvidence'] : '';
$outcomeEvidence1 = isset($_POST['txtOutcome1']) ? $_POST['txtOutcome1'] : '';
$outcomeEvidence2 = isset($_POST['txtOutcome2']) ? $_POST['txtOutcome2'] : '';
$outcomeEvidence3 = isset($_POST['txtOutcome3']) ? $_POST['txtOutcome3'] : '';
$outcomeEvidence4 = isset($_POST['txtOutcome4']) ? $_POST['txtOutcome4'] : '';
$outcomeEvidence5 = isset($_POST['txtOutcome5']) ? $_POST['txtOutcome5'] : '';
$outcomeEvidence6 = isset($_POST['txtOutcome6']) ? $_POST['txtOutcome6'] : '';
$outcomeEvidence7 = isset($_POST['txtOutcome7']) ? $_POST['txtOutcome7'] : '';
$outcomeEvidence8 = isset($_POST['txtOutcome8']) ? $_POST['txtOutcome8'] : '';
$activityDescription = isset($_POST['txtActivityDescription']) ? $_POST['txtActivityDescription'] : '';
$selfReflection = isset($_POST['txtSelfReflection']) ? $_POST['txtSelfReflection'] : '';
$checkboxSCALeForms = isset($_POST['checkboxSCALeForms']) ? $_POST['checkboxSCALeForms'] : 0;
$checkboxPictures = isset($_POST['checkboxPictures']) ? $_POST['checkboxPictures'] : 0;
$checkboxDSAForms = isset($_POST['checkboxDSAForms']) ? $_POST['checkboxDSAForms'] : 0;
$checkboxVideos = isset($_POST['checkboxVideos']) ? $_POST['checkboxVideos'] : 0;
$checkboxWeeklyLogs =isset($_POST['checkboxWeeklyLogs']) ? $_POST['checkboxWeeklyLogs'] : 0;
$checkboxInnovatedWorksheets =isset($_POST['checkboxInnovatedWorksheets']) ? $_POST['checkboxInnovatedWorksheets'] : 0;
$checkboxForm5ReflectionPaper =isset($_POST['checkboxForm5ReflectionPaper']) ? $_POST['checkboxForm5ReflectionPaper'] : 0; 
$checkboxRatingEvaluation = isset($_POST['checkboxRatingEvaluation']) ? $_POST['checkboxRatingEvaluation'] : 0;
$checkboxOthers =isset($_POST['checkboxOthers']) ? $_POST['checkboxPictures'] : 0;
$checkboxFinancialReportAcknowledgementReceipts =isset($_POST['checkboxFinancialReportAcknowledgementReceipts']) ? $_POST['checkboxFinancialReportAcknowledgementReceipts'] : 0;
$checkboxOther=isset($_POST['checkboxOther']) ? $_POST['checkboxOther'] : 0;
$checkboxAdsPosters = isset($_POST['checkboxAdsPosters']) ? $_POST['checkboxAdsPosters'] : 0;

if($activityID){
	if($isSubmit){
		
		$query ="SELECT * FROM student_report_tbl WHERE u_id =? AND a_id = ?";
		$stmt =$conn->prepare($query);
		$stmt->bind_param('ii', $query_string_id, $activityID );
		$stmt->execute();
		$result = $stmt->get_result();
		$details= $result->fetch_assoc();
			if($result->num_rows >0){
				$update_query = "UPDATE student_report_tbl set
				 s_r_service_evidence=?, 
				 s_r_creativity_evidence=?, 
				 s_r_action_evidence=?,
				 s_r_leadership_evidence=?,  
				 s_r_outcome1_evidence=?,
				 s_r_outcome2_evidence=?,
				 s_r_outcome3_evidence=?,
				 s_r_outcome4_evidence=?,
				 s_r_outcome5_evidence=?,
				 s_r_outcome6_evidence=?,
				 s_r_outcome7_evidence=?,
				 s_r_outcome8_evidence=? ,
				s_r_activity_description=?,
				s_r_self_reflection=?,
				s_r_checkboxSCALeForms=?,
				s_r_checkboxPictures=?,
				s_r_checkboxDSAForms=?, 
				s_r_checkboxVideos=?,
				s_r_ads_posters=?,
				s_r_checkboxWeeklyLogs=?,
				s_r_checkboxInnovatedWorksheets=?,
				s_r_checkboxForm5ReflectionPaper=?,
				s_r_checkboxRatingEvaluation=?,
				s_r_checkboxOthers=?,
				s_r_checkboxFinancialReportAcknowledgementReceipts=?,
				s_r_checkboxOther=?
				WHERE u_id =? AND a_id =?";
				
				
				$stmt_update=$conn->prepare($update_query);
				$stmt_update->bind_param('ssssssssssssssssssssssssssii', 
				$serviceEvidence,
				$creativityEvidence, 
				$actionEvidence, 
				$leadershipEvidence,
				$outcomeEvidence1,
				$outcomeEvidence2, 
				$outcomeEvidence3,
				$outcomeEvidence4,
				$outcomeEvidence5,
				$outcomeEvidence6,
				$outcomeEvidence7, 
				$outcomeEvidence8, 
				$activityDescription, 
				$selfReflection, 
				$checkboxSCALeForms,
				$checkboxPictures,
				$checkboxDSAForms,
				$checkboxVideos,
				$checkboxAdsPosters,
				$checkboxWeeklyLogs,
				$checkboxInnovatedWorksheets,
				$checkboxForm5ReflectionPaper,
				$checkboxRatingEvaluation,
				$checkboxOthers,
				$checkboxFinancialReportAcknowledgementReceipts,
				$checkboxOther, 
				$query_string_id, 
				$activityID);
				
				if ($stmt_update->execute()){
					$message = "Record has been updated successfully";
				}else {
						$message = "Error updating record: " .$stmt_update->error;
					}
			}else{
				$query ="INSERT into student_report_tbl (
				 s_r_service_evidence, 
				 s_r_creativity_evidence,
				 s_r_action_evidence,
				 s_r_leadership_evidence,
				 s_r_outcome1_evidence, 
				 s_r_outcome2_evidence,
				 s_r_outcome3_evidence,
				 s_r_outcome4_evidence,
				 s_r_outcome5_evidence,
				 s_r_outcome6_evidence,
				 s_r_outcome7_evidence,
				 s_r_outcome8_evidence, 
				s_r_activity_description,
				s_r_self_reflection,
				s_r_checkboxSCALeForms,
				s_r_checkboxPictures,
				s_r_checkboxDSAForms,
				s_r_checkboxVideos,
				s_r_ads_posters, 
				s_r_checkboxWeeklyLogs, 
				s_r_checkboxInnovatedWorksheets,
				s_r_checkboxForm5ReflectionPaper,
				s_r_checkboxRatingEvaluation, 
				s_r_checkboxOthers, 
				s_r_checkboxFinancialReportAcknowledgementReceipts,
				s_r_checkboxOther,
				u_id, 
				a_id) 
				VALUES(?,?,?,?,?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				
				
				$stmt =$conn->prepare($query);
				$stmt->bind_param('ssssssssssssssssssssssssssii', 
				$serviceEvidence,
				$creativityEvidence,
				$actionEvidence,
				$leadershipEvidence,
				$outcomeEvidence1,
				$outcomeEvidence2,
				$outcomeEvidence3,
				$outcomeEvidence4,
				$outcomeEvidence5,
				$outcomeEvidence6,
				$outcomeEvidence7,
				$outcomeEvidence8, 
				$activityDescription,
				$selfReflection,
				$checkboxSCALeForms,
				$checkboxPictures,
				$checkboxDSAForms,
				$checkboxVideos,
				$checkboxAdsPosters,
				$checkboxWeeklyLogs,
				$checkboxInnovatedWorksheets,
				$checkboxForm5ReflectionPaper, 
				$checkboxRatingEvaluation,
				$checkboxOthers,
				$checkboxFinancialReportAcknowledgementReceipts,
				$checkboxOther,
				$query_string_id,
				$activityID);
				
				if ($stmt->execute()){
					$message = "Data has been saved successfully";
				}
				else{
					$message = "Error saving data: " .$stmt->error;
				
				}
			}
	}else{
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
							activities_tbl.a_strand_l AS strand_l,
							student_report_tbl.s_r_service_evidence, 
						    student_report_tbl.s_r_creativity_evidence,
							student_report_tbl.s_r_action_evidence,
							student_report_tbl.s_r_leadership_evidence,
							student_report_tbl.s_r_outcome1_evidence, 
							student_report_tbl.s_r_outcome2_evidence,
							student_report_tbl.s_r_outcome3_evidence,
							student_report_tbl.s_r_outcome4_evidence,
							student_report_tbl.s_r_outcome5_evidence,
							student_report_tbl.s_r_outcome6_evidence,
							student_report_tbl.s_r_outcome7_evidence,
							student_report_tbl.s_r_outcome8_evidence, 
							student_report_tbl.s_r_activity_description,
							student_report_tbl.s_r_self_reflection,
							student_report_tbl.s_r_checkboxSCALeForms,
							student_report_tbl.s_r_checkboxPictures,
							student_report_tbl.s_r_checkboxDSAForms,
							student_report_tbl.s_r_checkboxVideos,
							student_report_tbl.s_r_ads_posters, 
							student_report_tbl.s_r_checkboxWeeklyLogs, 
							student_report_tbl.s_r_checkboxInnovatedWorksheets,
							student_report_tbl.s_r_checkboxForm5ReflectionPaper,
							student_report_tbl.s_r_checkboxRatingEvaluation, 
							student_report_tbl.s_r_checkboxOthers, 
							student_report_tbl.s_r_checkboxFinancialReportAcknowledgementReceipts,
							student_report_tbl.s_r_checkboxOther
						FROM individual_activity_tbl 
						INNER JOIN activities_tbl
							ON individual_activity_tbl.a_id = activities_tbl.a_id
							INNER JOIN student_report_tbl
							ON individual_activity_tbl.a_id = student_report_tbl.a_id AND individual_activity_tbl.u_id= student_report_tbl.u_id
						WHERE individual_activity_tbl.u_id = ? AND individual_activity_tbl.a_id=?" ;
		$stmt =$conn->prepare($queryActivities);
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
				$a_service = $details['strand_s'];
				$a_creativity = $details['strand_c'];
				$a_action = $details['strand_a'];
				$a_leadership = $details['strand_l'];
				$serviceEvidence = $details['s_r_service_evidence'];
			    $creativityEvidence = $details['s_r_creativity_evidence'];
				$actionEvidence = $details['s_r_action_evidence'];
				$leadershipEvidence = $details['s_r_leadership_evidence'];
				$outcomeEvidence1 =$details['s_r_outcome1_evidence'];
				$outcomeEvidence2 =$details['s_r_outcome2_evidence'];
				$outcomeEvidence3 =$details['s_r_outcome3_evidence'];
				$outcomeEvidence4 =$details['s_r_outcome4_evidence'];
				$outcomeEvidence5 =$details['s_r_outcome5_evidence'];
				$outcomeEvidence6 =$details['s_r_outcome6_evidence'];
				$outcomeEvidence7 =$details['s_r_outcome7_evidence'];
				$outcomeEvidence8 =$details['s_r_outcome8_evidence'];
				$activityDescription =$details['s_r_activity_description'];
				$selfReflection=$details['s_r_self_reflection'];
				$checkboxSCALeForms =$details['s_r_checkboxSCALeForms'];
				$checkboxPictures=$details['s_r_checkboxPictures'];
				$checkboxDSAForms=$details['s_r_checkboxDSAForms'];
				$checkboxVideos=$details['s_r_checkboxVideos'];
				$checkboxAdsPosters=$details['s_r_ads_posters'];
				$checkboxWeeklyLogs=$details['s_r_checkboxWeeklyLogs'];
				$checkboxInnovatedWorksheets=$details['s_r_checkboxInnovatedWorksheets'];
				$checkboxForm5ReflectionPaper =$details['s_r_checkboxForm5ReflectionPaper'];
				$checkboxRatingEvaluation=$details['s_r_checkboxRatingEvaluation'];
				$checkboxOthers =$details['s_r_checkboxOthers'];
				$checkboxFinancialReportAcknowledgementReceipts =$details['s_r_checkboxFinancialReportAcknowledgementReceipts'];
				$checkboxOther =$details['s_r_checkboxOther'];
				
			}else{
				
			}
		
	}
}
function getActivity (){
	global $conn; 
	global $activityID;
	global $query_string_id;
						$queryActivities = "SELECT 
							individual_activity_tbl.a_id AS individual_a_id,
							
							activities_tbl.a_title AS activity_title
							
						FROM individual_activity_tbl 
						INNER JOIN activities_tbl
							ON individual_activity_tbl.a_id = activities_tbl.a_id
						WHERE individual_activity_tbl.u_id = ?";
$stmt =$conn->prepare($queryActivities);
$stmt->bind_param('i', $query_string_id);
$stmt->execute();
$result = $stmt->get_result();






$dropdown = '<select name = "txtActivityTitle" id = "txtActivityTitle" onchange="submitFormOnChange()">';
$dropdown .= '<option value="">Select Activity</option>';

while ($row = $result->fetch_assoc()){
	$id =$row['individual_a_id'];
	$activity_title = $row['activity_title'];
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
    <title>Reflection Paper Form</title>
	<script type="text/javascript">
	function submitFormOnChange(){
		document.getElementById('activityForm').submit();
	}
	
	</script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-size: 14px; /* Reduces the font size to make it feel more compact */
        }
        h1, h2 {
            text-align: center;
            font-size: 18px; /* Smaller header font */
        }
        .form-container {
            width: 70vw; /* Slightly narrower form width */
            max-width: 800px; /* Sets a max width to prevent too wide form */
            padding: 15px;
            border: 1px solid #000;
            background-color: #f9f9f9;
            box-sizing: border-box;
            font-size: 14px; /* Ensures input text is smaller */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            font-size: 12px; /* Smaller font size for table */
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
            font-size: 13px; /* Slightly smaller input text */
        }
        .section {
            margin-bottom: 15px; /* Reduces space between sections */
        }
        .checkbox-group, .signatures {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 13px; /* Smaller font for checkboxes */
        }
        .signature {
            flex: 1;
            min-width: 180px;
        }
        h3, h4 {
            font-size: 16px; /* Smaller sub-header font size */
        }
        ul {
            padding-left: 20px;
            font-size: 13px; /* Smaller font for the list items */
        }
		.add-button { margin-top: 10px; display: block; }
    </style>
</head>
<?php include 'links.php'; ?>
<body>
	<form action="view_form5_students.php?id=<?php echo $query_string_id; ?>" method="post" id="activityForm">
    <div class="form-container">
        <h1>PHILIPPINE SCIENCE HIGH SCHOOL - CENTRAL LUZON CAMPUS</h1>
        <h2>SCALE REFLECTION PAPER<br>S.Y. 2023 – 2024</h2>

        <div class="section">
            <label for="studentName">Name of Student:</label>
            <input type="text" id="studentName" class="input-field" value="<?php echo strtoupper($studentName)?>">

            <label for="section">Section:</label>
            <input type="text" id="section" class="input-field" value="<?php echo $section?>">
        </div>

        <h3>I. Overall Program Progress</h3>
		<table>
			<div class="section">
				<tr>
					<td> FORM 2 ACTIVITY NO.:</td>
						<td colspan =2><?php echo getActivity(); ?></td>
				<tr >
					<td>Title</td>
					<td colspan = 2></td>
					
				</tr>
				<tr>
					<td>SCALe Strands</td>
					<td>Met?</td>
					<td>Evidence/ Explanation</td>
				
				</tr>
				
				<tr>
					<td>Service (S)</td>
					<td><input disabled type="checkbox" name="checkboxService" id="checkboxService" value="1" <?php echo ($a_service !=0) ? 'checked': '';?>></td>
					<td><input size=50 type="text" name="txtServiceEvidence" id="txtServiceEvidence" value="<?php echo $serviceEvidence?>"></td>
				</tr>
				
				<tr>
					<td>Creativity (C)</td>
					<td><input disabled type="checkbox" name="checkboxCreativity" id="checkboxCreativity" value="1" <?php echo ($a_creativity !=0) ? 'checked': '';?>></td>
					<td><input size=50 type="text" name="txtCreativityEvidence" id="txtCreativityEvidence" value="<?php echo $creativityEvidence?>"></td>
				</tr>
				
				<tr>
					<td>Action (A)</td>
					<td><input disabled type="checkbox" name="checkboxLeadership" id="checkboxLeadership" value="1" <?php echo ($a_action !=0) ? 'checked': '';?>></td>
					<td><input size=50 type="text" name="txtActionEvidence" id="txtActionEvidence" value="<?php echo $actionEvidence?>"></td>
				</tr>
				
				<tr>
					<td>Leadership (L)</td>
					<td><input disabled type="checkbox" name="checkboxLeadership" id="checkboxLeadership" value="1"  <?php echo ($a_leadership !=0) ? 'checked': '';?>></td>
					<td><input size=50 type="text" name="txtLeadershipEvidence" id="txtLeadershipEvidence" value="<?php echo $leadershipEvidence?>"></td>
				</tr>
				
				<tr>
					<td>Nature (INDIVIDUAL OR GROUP)</td>
					<td colspan = 2></td>
					
				</tr>
				
				<tr>
					<td>Duration (NUMBER OF HOURS</td>
					<td colspan = 2></td>
					
				</tr>
				
				<tr>
					<td>Learning Outcomes</td>
					<td>Met?</td>
					<td>Evidence/Explanation</td>
				</tr>
				
				<tr>
					<td><p>1. Increase awareness of strengths and areas for growth</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome1" id="checkboxOutcome1" value="1"<?php echo ($outcome1 == 1) ? 'checked' : ''; ?>></td>
					<td><input size=50 type="text" name="txtOutcome1" id="txtOutcome1" value="<?php echo $outcomeEvidence1?>"></td>
				</tr>
				
				<tr>
					<td><p>2. Undertake new challenges</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome2" id="checkboxOutcome2" value="1"<?php echo ($outcome2 == 1) ? 'checked' : ''; ?>></td>
					<td><input size=50 type="text" name="txtOutcome2" id="txtOutcome2" value="<?php echo $outcomeEvidence2?>"></td>
				</tr>
				
				<tr>
					<td><p>3. Introduce and manage activities</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome3" id="checkboxOutcome3" value="1"<?php echo ($outcome3 == 1) ? 'checked' : ''; ?>></td>
					<td><input size=50 type="text" name="txtOutcome3" id="txtOutcome3" value="<?php echo $outcomeEvidence3?>"></td>
				</tr>
				
				<tr>
					<td><p>4. Contribute actively in group activities</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome4" id="checkboxOutcome4" value="1"<?php echo ($outcome4 == 1) ? 'checked' : ''; ?>></td>
					<td><input size=50 type="text" name="txtOutcome4" id="txtOutcome4" value="<?php echo $outcomeEvidence4?>"></td>
				</tr>
				<tr>
					<td><p>5. Demonstrate perseverance and commitment in their activities</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome5" id="checkboxOutcome5" value="1"<?php echo ($outcome5 == 1) ? 'checked' : ''; ?>></td>
					<td><input size=50 type="text" name="txtOutcome5" id="txtOutcome5" value="<?php echo $outcomeEvidence5?>"></td>
				</tr>
				
				<tr>
					<td><p>6. Engage with issues of global importance</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome6" id="checkboxOutcome6" value="1"<?php echo ($outcome6 == 1) ? 'checked' : ''; ?>></td>
					<td><input size=50 type="text" name="txtOutcome6" id="txtOutcome6" value="<?php echo $outcomeEvidence6?>"  ></td>
				</tr>
				
				<tr>
					<td><p>7. Reflect on the ethical consequences of one's actions</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome7" id="checkboxOutcome7" value="1"<?php echo ($outcome7 == 1) ? 'checked' : ''; ?>></td>
					<td><input size=50 type="text" name="txtOutcome7" id="txtOutcome7" value="<?php echo $outcomeEvidence7?>"></td>
				</tr>
				
				<tr>
					<td><p>8. Develop new skills</p></td>
					<td><input disabled type="checkbox" name="checkboxOutcome8" id="checkboxOutcome8" value="1"<?php echo ($outcome8 == 1) ? 'checked' : ''; ?>></td>
					<td ><input size=50 type="text" name="txtOutcome8" id="txtOutcome8" value="<?php echo $outcomeEvidence8?>"></td>
				</tr>

			</div>
			</tr>
		</table>
        <h3>II. Activity Description</h3>
			<textarea class="input-field" rows="5" name = "txtActivityDescription" id="txtActivityDescription"></textarea>

        <h3>III. Portfolio and Self-Reflection</h3>
			<table>
				<tr>
					<td colspan = 2><div style="text-align:center"><h4>Forms</h4><p>(tick only those applicable)</p></div></td>
					<td colspan = 2><div style="text-align:center"><h4>Evidences</h4><p>(tick only those applicable)</p></div></td>
				</tr>
				
				<tr>
					<td><input type="checkbox" name="checkboxSCALeForms" id="checkboxSCALeForms"></td>
					<td width = 300><p>SCALe Forms 1,2, and 3</p></td>
					<td><input type="checkbox" name="checkboxPictures" id="checkboxPictures"></td>
					<td width = 300><p>Pictures</p></td>
				</tr>
				
				<tr>
					<td ><input type="checkbox" name="checkboxDSAForms"id="checkboxDSAForms"> </td>
					<td width = 300><p>DSA Forms (e.g. Activity proposal, Request for the use of school facilities, when applicable)</p></td>
					<td ><input type="checkbox" name="checkboxVideos" id="checkboxVideos"></td>
					<td width = 300><p>Videos</p></td>
				</tr>
				
				<tr rowspan = 2>
					<td><input type="checkbox" name="checkboxWeeklyLogs" id="checkboxWeeklyLogs"></td>
					<td width = 300><p>Weekly Logs</p></td>
					<td><input type="checkbox" name="checkboxInnovatedWorksheets" id="checkboxInnovatedWorksheets"></td>
					<td width = 300><p>Innovated Worksheets</p></td>
				</tr>
				
				<tr>
					<td><input type="checkbox" name="checkboxForm5ReflectionPaper" id="checkboxForm5ReflectionPaper"></td>
					<td width = 300><p>Form 5 Reflection Paper</p></td>
					<td><input type="checkbox" name="checkboxRatingEvaluation" id="checkboxRatingEvaluation"></td>
					<td width = 300><p>Ratings/ Evaluation Sheets</p></td>
				</tr>
				
				<tr>
					<td><input type="checkbox"name="checkboxOthers:" id="checkboxOthers"></td>
					<td width = 300><p>Others:______________</p></td>
					<td><input type="checkbox" name="checkboxFinancialReportAcknowledgementReceipts" id="checkboxFinancialReportAcknowledgementReceipts"></td>
					<td width = 300><p>Financial Report/ Acknowledgement Receipts</p></td>
				</tr>
				
				<tr>
					<td></td>
					<td width = 300><p></p></td>
					<td><input type="checkbox" name="checkboxOther" id="checkboxOther"></td>
					<td width = 300><p>Others:______________</p></td>
				</tr>
		
				<tr>
					<td></td>
					<td></td>
					<td><input type="checkbox" name="checkboxAdsPosters" id="checkboxAdsPosters"</td>
					<td>posters</td>
				</tr>
		
		
		
			</table>
      
        <h3>Self-Reflection for Activity</h3>
        <textarea class="input-field" rows="10" name="txtSelfReflection" id="txtSelfReflection"></textarea>

        <div class="signatures">
            <div class="signature">
                <label for="supervisorName">Reviewed by:</label><br>
                <input type="text" id="supervisorName" class="input-field" placeholder="Signature over printed name of Adult Supervisor">
                <input type="date" class="input-field">
            </div>
            
            <div class="signature">
                <label for="adviserName">Submitted to:</label><br>
                <input type="text" id="adviserName" class="input-field" placeholder="Signature over printed name of SCALE Adviser">
                <input type="date" class="input-field">
            </div>

            <div class="signature">
                <label for="coordinatorName">Noted by:</label><br>
                <input type="text" id="coordinatorName" class="input-field" placeholder="Signature over printed name of SCALE Coordinator">
                <input type="date" class="input-field">
            </div>
        </div>
		<div class="action-buttons">
            <button type="submit" id="btnSubmit" name= "btnSubmit" value="submit">Submit</button>
        </div>
    </div>
	 
</form>
</body>
</html>
