<?php
require('subwrite.php');

session_start();
include 'connect.php';
$id = $_SESSION['id'];

function getActivityCount($conn, $id) {
    $sqlCountActivities = "SELECT COUNT(a_id) as activity_count FROM activities_tbl WHERE u_id = '$id'";
    $resultCount = $conn->query($sqlCountActivities);

    if ($resultCount && $resultCount->num_rows > 0) {
        $rowCount = $resultCount->fetch_assoc();
        return $rowCount['activity_count'];
    }
    return 0;
}

// Count the number of activities the student already has
$activityCount = getActivityCount($conn, $id);

// Fetch activities for the current user
$sqlActivities = "SELECT * FROM activities_tbl WHERE u_id = '$id'";
$resultActivities = $conn->query($sqlActivities);

// Initialize variables for adviser name and submission date
$adviserName = '';
$subDate = '';

// Fetch adviser's name with u_level 2
$sqlAdviser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_level = 2 LIMIT 1";
$resultAdviser = $conn->query($sqlAdviser);

$studentName = htmlspecialchars($_SESSION['lname'] . ", " . $_SESSION['fname'] . " " . $_SESSION['mname']);
$studentsName = strtoupper($studentName);
if ($resultAdviser && $resultAdviser->num_rows > 0) {
    $rowAdviser = $resultAdviser->fetch_assoc();
    $adviserName = $rowAdviser['u_lname'] . ' ' . $rowAdviser['u_fname'] . ' ' . $rowAdviser['u_mname'];
	$advisersName = strtoupper($adviserName);
}

// Fetch submission date (assuming it's stored in activities_tbl for the user)
$sqlSubmissionDate = "SELECT u_subdate FROM activities_tbl WHERE u_id = '$id' LIMIT 1";
$resultSubmissionDate = $conn->query($sqlSubmissionDate);

if ($resultSubmissionDate && $resultSubmissionDate->num_rows > 0) {
    $rowSubmissionDate = $resultSubmissionDate->fetch_assoc();
    $subDate = $rowSubmissionDate['u_subdate'];
}

// Suppress warnings by using proper error handling
$remarks = "SELECT a_sa_remarks, a_status FROM activities_tbl WHERE u_id ='$id' LIMIT 1";
$resultRemarks = $conn->query($remarks);



/////END OF SQL

// Variables
$title = 'Philippine Science High School';
$campus = 'Central Luzon Campus';
$formname = 'SCALE PROGRAM PROPOSAL FORM';

// Create a new PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(20, 10, 20);
$pdf->SetAutoPageBreak(true, 10);

// Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, $title, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 10, $campus, 0, 1, 'C');
$pdf->Cell(0, 10, $formname, 0, 1, 'C');
$pdf->Ln(5);

// Student Information Section
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 10, 'Name of Student: ' . $studentsName, 0, 0);
$pdf->Cell(50, 10, 'Batch: ', 0, 1);
$pdf->Cell(90, 10, 'Name of Adviser: ' . $advisersName, 0, 1);
$pdf->Cell(90, 10, 'Date of Submission: ' . $subDate, 0, 1);
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 15, 'Title of Activity', 1, 0, 'C');
$pdf->Cell(30, 15, 'Strand', 1, 0, 'C');
$pdf->Cell(30, 15, 'Type', 1, 0, 'C');
$pdf->Cell(50, 7.5, 'Target Schedule', 1, 1, 'C');

// Subheaders for Start and End Dates under "Target Schedule"
$pdf->SetX(140);
$pdf->Cell(25, 7.5, 'Start', 1, 0, 'C');
$pdf->Cell(25, 7.5, 'End', 1, 1, 'C');

if ($resultActivities && $resultActivities->num_rows > 0) {
    while ($row = $resultActivities->fetch_assoc()) {
        $title = $row["a_title"] ?? 'N/A'; // Use 'N/A' if key does not exist
        
        $type = $row["a_type"] ?? 'N/A';
        $startDate = $row["a_start"] ?? 'N/A';
        $endDate = $row["a_end"] ?? 'N/A';
		$strands = array();
			if ($row["a_strand_s"]) $strands[] = "S";
			if ($row["a_strand_c"]) $strands[] = "C";
			if ($row["a_strand_a"]) $strands[] = "A";
			if ($row["a_strand_l"]) $strands[] = "L";
			// Convert strands array to a string
				$strandString = implode(" ", $strands);

		$pdf->Cell(60, 10, $title, 1, 0); 
		$pdf->Cell(30, 10, $strandString, 1, 0); 
		$pdf->Cell(30, 10, $type, 1, 0); 
		$pdf->Cell(25, 10, $startDate, 1, 0); 
		$pdf->Cell(25, 10, $endDate, 1, 1); 
	
        
    }
} else {
    // Add placeholder rows
    for ($i = 0; $i < 5; $i++) {
        $pdf->Cell(60, 10, '', 1, 0);
        $pdf->Cell(30, 10, '', 1, 0);
        $pdf->Cell(30, 10, '', 1, 0);
        $pdf->Cell(25, 10, '', 1, 0);
        $pdf->Cell(25, 10, '', 1, 1);
    }
}

$pdf->Ln(5);

// Approval Section with Checkboxes
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, 'Appropriate Action:', 0, 0);

// Checkboxes
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 10, 'o', 0, 0); // Empty checkbox
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, 'Approved', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 10, 'o', 0, 0); // Empty checkbox
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, 'For Revision', 0, 1);
$pdf->Ln(5);

// Signatures
$pdf->Cell(0, 10, 'Reviewed by: ______________________________________                      _______________________', 0, 1);
$pdf->Cell(0, 10, '                             Name and Signature of SCALE Adviser                                         Date Reviewed', 0, 1);
$pdf->Ln(5);
$pdf->Cell(0, 10, 'Noted by: _________________________________________', 0, 1);
$pdf->Cell(0, 10, '                       Name and Signature of SCALE Coordinator', 0, 1);

// Output PDF
$pdf->Output();
?>
