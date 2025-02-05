<?php
require('fpdf/fpdf.php');
include 'connect.php'; // Include your database connection file

if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];
} else {
    echo "Error: u_id not provided.";
    exit();
}

$id = (int)$_POST['u_id']; // Sanitize input to prevent SQL injection

// Fetch batch and grade from users_info_tbl
$sqlUserInfo = "SELECT ui_batch, ui_grade FROM users_info_tbl WHERE u_id = '$u_id'";
$resultUserInfo = $conn->query($sqlUserInfo);

$batch = '';
$grade = '';
if ($resultUserInfo && $resultUserInfo->num_rows > 0) {
    $rowUserInfo = $resultUserInfo->fetch_assoc();
    $batch = htmlspecialchars($rowUserInfo['ui_batch']);
    $grade = htmlspecialchars($rowUserInfo['ui_grade']);
}

// Fetch user details
$sqlUser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_id = '$u_id'";
$resultUser = $conn->query($sqlUser);

$fullName = 'Unknown';
if ($resultUser && $resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $fullName = htmlspecialchars($rowUser['u_lname']) . ", " . 
                htmlspecialchars($rowUser['u_fname']) . " " . 
                htmlspecialchars($rowUser['u_mname']);
}

// Fetch inside clubs data
$sqlIn = "SELECT * FROM sin_clubs_tbl WHERE u_id = '$u_id'";
$resultIn = $conn->query($sqlIn);

// Fetch outside clubs data
$sqlOut = "SELECT * FROM sout_clubs_tbl WHERE u_id = '$u_id'";
$resultOut = $conn->query($sqlOut);

// Fetch spearheaded activities
$sqlSpearhead = "SELECT * FROM spearhead_tbl WHERE u_id = '$u_id'";
$resultSpearhead = $conn->query($sqlSpearhead);

// Fetch sports data
$sqlSports = "SELECT * FROM sport_tbl WHERE u_id = '$u_id'";
$resultSports = $conn->query($sqlSports);

// Fetch instruments data
$sqlInstruments = "SELECT * FROM instruments_tbl WHERE u_id = '$u_id'";
$resultInstruments = $conn->query($sqlInstruments);

// Fetch art data
$sqlArt = "SELECT * FROM arts_tbl WHERE u_id = '$u_id'";
$resultArt = $conn->query($sqlArt);

// Fetch hobby data
$sqlHobby = "SELECT * FROM hobbies_tbl WHERE u_id = '$u_id'";
$resultHobby = $conn->query($sqlHobby);

$sports = [];
$instrum = [];
$art = [];
$hobby = [];

while ($rowSports = $resultSports->fetch_assoc()) {
    $sports[] = $rowSports["u_sport_name"];
}
while ($rowInstruments = $resultInstruments->fetch_assoc()) {
    $instrum[] = $rowInstruments["u_instrument_name"];
}
while ($rowArt = $resultArt->fetch_assoc()) {
    $art[] = $rowArt["u_arts_name"];
}
while ($rowHobby = $resultHobby->fetch_assoc()) {
    $hobby[] = $rowHobby["u_hobbies_name"];
}

$sqlInterests = "SELECT u_interests_name FROM interests_tbl WHERE u_id = '$u_id'";
$resultInterests = $conn->query($sqlInterests);

$interests = [];
if ($resultInterests && $resultInterests->num_rows > 0) {
    while ($rowInterests = $resultInterests->fetch_assoc()) {
        $interests[] = htmlspecialchars($rowInterests["u_interests_name"]);
    }
}

$sqlSpearhead = "SELECT u_activities_name FROM spearhead_tbl WHERE u_id = '$u_id'";
$resultSpearhead = $conn->query($sqlSpearhead);

$spearhead = [];
if ($resultSpearhead && $resultSpearhead->num_rows > 0) {
    while ($rowSpearhead = $resultSpearhead->fetch_assoc()) {
        $spearhead[] = htmlspecialchars($rowSpearhead["u_activities_name"]);
    }
}

class PDF extends FPDF
{
    function formatMultiRow($data, $maxPerRow = 3) {
        $chunks = array_chunk($data, $maxPerRow);
        $formattedRows = [];
        foreach ($chunks as $chunk) {
            $formattedRows[] = implode(", ", $chunk);
        }
        return $formattedRows;
    }

    function header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, 'PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 7, 'Campus: Central Luzon', 0, 1, 'C');
        $this->Ln(7);
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 6, 'SCALE PERSONAL INFORMATION SHEET', 0, 1, 'C');
        $this->Ln(7);
    }

    function footer()
    {
        $this->SetY(-30);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
    }

    // Custom MultiCell with borders and wrapping
    function MultiCellWithBorders($w, $h, $txt, $border = 0, $align = 'L')
    {
        $this->SetFont('Arial', '', 10);
        $this->MultiCell($w, $h, $txt, $border, $align);
    }

    // Function to handle 4 columns in a row for hobbies, arts, instruments, and sports
    function FourColumnRow($w1, $w2, $w3, $w4, $txt1, $txt2, $txt3, $txt4, $borderTopBottom = 1)
    {
        $this->SetFont('Arial', '', 8);  // Reduced font size for this section
        $this->Cell($w1, 6, $txt1, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w2, 6, $txt2, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w3, 6, $txt3, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w4, 6, $txt4, ($borderTopBottom ? 'LRT' : 'LR'), 1, 'L');
    }
}

// Create a new PDF instance
$pdf = new PDF();
// Format sports, instruments, arts, and hobbies into groups of 3 per row
$sportsRows = $pdf->formatMultiRow($sports);
$instrumRows = $pdf->formatMultiRow($instrum);
$artRows = $pdf->formatMultiRow($art);
$hobbyRows = $pdf->formatMultiRow($hobby);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(20, 10, 20); // Margins
$pdf->SetAutoPageBreak(true, 30); // Auto page break with spacing

// Set X to align the Name field with the start of the table
$x = $pdf->GetX();  // Get the current X position

// Adjusting the Name field to align with the start of the table
$pdf->SetX(20);  // Set the X position for Name field
// Student Information Section
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 6, 'Name: ' . $fullName, 0, 0);
$pdf->Cell(45, 6, 'Batch: ' . $batch, 0, 0);
$pdf->Cell(40, 6, 'Grade: ' . $grade, 0, 1);
$pdf->Ln(7);

// Clubs/Associations Joined in PSHS
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 6, 'Name of Club/Association joined in PSHS', 1, 0, 'C');
$pdf->Cell(60, 6, 'Position/Designation', 1, 0, 'C');
$pdf->Cell(40, 6, 'Length of Membership', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$rowCount = 0; // Counter for the number of rows

// Check if there are results
if ($resultIn->num_rows > 0) {
    while ($rowCount < 4 && $rowIn = $resultIn->fetch_assoc()) {
        $pdf->Cell(70, 6, htmlspecialchars($rowIn["sin_name"]), 1, 0);
        $pdf->Cell(60, 6, htmlspecialchars($rowIn["sin_position"]), 1, 0);
        $pdf->Cell(40, 6, htmlspecialchars($rowIn["sin_length"]), 1, 1);
        $rowCount++;
    }
}

// Fill remaining rows with empty cells if there are fewer than 4 rows
while ($rowCount < 4) {
    $pdf->Cell(70, 6, '', 1, 0);
    $pdf->Cell(60, 6, '', 1, 0);
    $pdf->Cell(40, 6, '', 1, 1);
    $rowCount++;
}

$pdf->Ln(7);

//Clubs/ Associations joined outside of PSHS
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 6, 'Name of Club/Association joined outside PSHS', 1, 0, 'C');
$pdf->Cell(60, 6, 'Position/Designation', 1, 0, 'C');
$pdf->Cell(40, 6, 'Length of Membership', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$rowCount = 0; // Counter for the number of rows

// Check if there are results
if ($resultOut->num_rows > 0) {
    while ($rowCount < 3 && $rowOut = $resultOut->fetch_assoc()) {
        $pdf->Cell(70, 6, htmlspecialchars($rowOut["sout_name"]), 1, 0);
        $pdf->Cell(60, 6, htmlspecialchars($rowOut["sout_position"]), 1, 0);
        $pdf->Cell(40, 6, htmlspecialchars($rowOut["sout_length"]), 1, 1);
        $rowCount++;
    }
}

// Fill remaining rows with empty cells if there are fewer than 4 rows
while ($rowCount < 3) {
    $pdf->Cell(70, 6, '', 1, 0);
    $pdf->Cell(60, 6, '', 1, 0);
    $pdf->Cell(40, 6, '', 1, 1);
    $rowCount++;
}

$pdf->Ln(7);

// Set the maximum number of rows (this will depend on the largest dataset, so you can adjust it accordingly)
$maxRows = max(count($sportsRows), count($instrumRows), count($artRows), count($hobbyRows));

// First row headers
$pdf->SetFont('Arial', '', 8);
$pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, 'Sports you have played:', 'Musical instruments you have', 'Arts and crafts you have skill in:', 'Other hobbies/ interests:');

// Loop through rows, ensuring each cell contains at most 3 values
for ($i = 0; $i < $maxRows; $i++) {
    // Ensure each column has valid data (or set to an empty string if data is missing)
    $txt1 = isset($sportsRows[$i]) ? $sportsRows[$i] : '';
    $txt2 = isset($instrumRows[$i]) ? $instrumRows[$i] : '';
    $txt3 = isset($artRows[$i]) ? $artRows[$i] : '';
    $txt4 = isset($hobbyRows[$i]) ? $hobbyRows[$i] : '';

    // Apply bottom border only on the last row
    $borderType = ($i == $maxRows - 1) ? 1 : 0;

    // Output the row
    $pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, $txt1, $txt2, $txt3, $txt4, $borderType);
}

$pdf->Ln(7);

// Activities interested in
$pdf->Cell(0, 6, 'Activities interested in learning:', 1, 1, 'L');
for ($i = 0; $i < 3; $i++) {
    $pdf->Cell(0, 6, $interests[$i] ?? '', 'LR', 1);
}
$pdf->Cell(0, 0, '', 'T', 1);
$pdf->Ln(7);

// Activities spearheaded
$pdf->Cell(0, 6, 'Activities spearheaded:', 1, 1, 'L');
for ($i = 0; $i < 3; $i++) {
    $pdf->Cell(0, 6, $spearhead[$i] ?? '', 'LR', 1);
}
$pdf->Cell(0, 0, '', 'T', 1);

$pdf->Ln(20);

// Signature Section
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, 'Signature of Student: _____________________________    Date Prepared: ______________', 0, 1);
$pdf->Ln(10);

// Output PDF
$pdf->Output();
?>