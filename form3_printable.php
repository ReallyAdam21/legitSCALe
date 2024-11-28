<?php
require('fpdf/fpdf.php');

class PDF extends FPDF{
// Custom function for creating checkboxes
function drawCheckbox($pdf, $x, $y, $label) {
    $pdf->SetXY($x, $y);
    $pdf->SetFont('ZapfDingbats', '', 10); // Smaller checkbox font
    $pdf->Cell(5, 5, 'o', 1, 0); // Empty checkbox
    $pdf->SetFont('Arial', '', 9); // Smaller label font
    $pdf->Cell(0, 5, ' ' . $label, 0, 1);
}

// Function to handle 4 columns in a row for hobbies, arts, instruments, and sports
    function FourColumnRow($w1, $w2, $w3, $w4, $txt1, $txt2, $txt3, $txt4, $borderTopBottom = 1)
    {
        $this->SetFont('Arial', '', 8);  // Reduced font size for this section
        // Add text in each column using MultiCell for wrapping with left and right borders
        // Apply top and bottom borders if needed
        $this->Cell($w1, 6, $txt1, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w2, 6, $txt2, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w3, 6, $txt3, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w4, 6, $txt4, ($borderTopBottom ? 'LRT' : 'LR'), 1, 'L');
    }
}

// Variables
$title = 'Philippine Science High School System';
$formTitle = 'SCALE INDIVIDUAL ACTIVITY PLAN';


// Create a new PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(15, 10, 15); // Reduced side margins
$pdf->SetAutoPageBreak(true, 10); // Reduced bottom margin

// Header
$pdf->SetFont('Arial', 'B', 11); // Slightly smaller header font
$pdf->Cell(0, 8, $title, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Campus:___________', 0, 1, 'C');
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 8, $formTitle, 0, 1, 'C');
$pdf->Ln(3); // Reduced space after header

// Campus and Student Details
$pdf->SetFont('Arial', '', 9); // Reduced font size for details
$pdf->Cell(80, 6, 'Name of Student: ___________________________', 0, 0);
$pdf->Cell(50, 6, 'Batch: _______', 0, 1);
$pdf->Cell(0, 6, 'Name of Adviser: ___________________________', 0, 1);
$pdf->Ln(3); // Reduced line spacing

// Title and Type of Activity
$pdf->Cell(0, 6, 'Title of Activity: ___________________________________________', 0, 1);
$pdf->Cell(0, 6, 'Type of Activity: ', 0, 1);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 6, 'o', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 6, 'Individual', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 6, 'o', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 6, 'Group', 0, 1);
$pdf->Ln(2); // Reduced line spacing

// Strand Section
$pdf->Cell(0, 6, 'Strand (Please check all applicable):', 0, 1);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 6, 'o', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 6, 'Service', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 6, 'o', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 6, 'Action', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 6, 'o', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 6, 'Creativity', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 6, 'o', 0, 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(30, 6, 'Leadership', 0, 1);
$pdf->Ln(3); // Reduced line spacing

// Learning Outcomes
$pdf->Cell(0, 6, 'Learning Outcomes (Please check all applicable):', 0, 1);
$learning_outcomes = [
    '1. Increased awareness of their own strengths and areas for growth',
    '2. Undertaken new challenges',
    '3. Introduced and managed activities',
    '4. Contributed actively in group activities',
    '5. Demonstrated perseverance and commitment in their activities',
    '6. Engaged with issues of global importance',
    '7. Reflected on the ethical consequence of their actions',
    '8. Developed new skills',
];
foreach ($learning_outcomes as $outcome) {
    $pdf->SetFont('ZapfDingbats', '', 10);
    $pdf->Cell(10, 6, 'o', 0, 0);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(0, 6, $outcome, 0, 1);
}

// Dates and Venue Section
$pdf->Ln(3);

// Header Row (Start and End)
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 6, '', 0, 0); // Empty space to align headers
$pdf->Cell(40, 6, 'Start', 0, 0, 'C');
$pdf->Cell(40, 6, 'End', 0, 1, 'C');

// Planning Dates Row
$pdf->Cell(50, 6, 'Planning Dates (mm-dd-yyyy):', 0, 0);
$pdf->Cell(10, 6, '', 0, 0); // Additional padding
$pdf->Cell(40, 6, '________________', 0, 0, 'C');
$pdf->Cell(40, 6, '________________', 0, 1, 'C');

// Implementation Dates Row
$pdf->Cell(50, 6, 'Implementation Dates (mm-dd-yyyy):', 0, 0);
$pdf->Cell(10, 6, '', 0, 0); // Additional padding
$pdf->Cell(40, 6, '________________', 0, 0, 'C');
$pdf->Cell(40, 6, '________________', 0, 1, 'C');

// Venue Row
$pdf->Cell(50, 6, 'Venue:__________________________', 0, 0);


$pdf->Ln(7);


// General Description and Objectives
$pdf->Cell(0, 6, 'I. General Description of Activity', 0, 1);
$pdf->Cell(0, 30, '', 1, 1); // Placeholder with reduced height
$pdf->Cell(0, 6, 'II. Objectives', 0, 1);
$pdf->Cell(0, 30, '', 1, 1); // Placeholder with reduced height

$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);

// New section: III. Persons Involved
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'III. Persons Involved', 0, 1);
$pdf->Ln(3);

// Table Header for Persons
// First row: Add bordered columns for Name, Designation, Company, and Contact with wrapped text
$pdf->SetFont('Arial', 'B', 8);  // Reduced font size for the four columns
$pdf->Cell(42.5, 0, '', 'T', 0); 
$pdf->Cell(42.5, 0, '', 'T', 0); 
$pdf->Cell(42.5, 0, '', 'T', 0); 
$pdf->Cell(42.5, 0, '', 'T', 1); 
// Make the header bold
$pdf->SetFont('Arial', 'B', 10); // Bold font for the header
$pdf->Cell(170, 6, 'Adult Supervisor/s and Collaborators', 'LR', 1, 'C');

// First row with bold text for the columns
$pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, 
    'Name (mark with * if', 
    'Designation/', 
    'Company/ Organization/ ', 
    'Contact Number and'
);

// Second row: Bold font for the text
$pdf->SetFont('Arial', 'B', 10);
$pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, 
    'adult supervisor', 
    'Position', 
    'Affiliation', 
    'Email', 0
);


// Table Rows for Persons (5 empty rows for input)
$pdf->SetFont('Arial', '', 9);
for ($i = 0; $i < 3; $i++) {
  $pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, '', '', '', '', 1); 
}

$pdf->Ln(0);

// Add borders to close the bottom of the last row for these fields
$pdf->Cell(42.5, 0, '', 'T', 0); 
$pdf->Cell(42.5, 0, '', 'T', 0); 
$pdf->Cell(42.5, 0, '', 'T', 0); 
$pdf->Cell(42.5, 0, '', 'T', 1); 
$pdf->Ln(0);

// Subsection: Other PSHS students involved

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(170, 6, 'Other PSHS students involved (at most 5 students)', 'LR', 1, 'C');


// Table Header for Students
$pdf->Cell(56.66, 6, 'Name', 1, 0, 'C');
$pdf->Cell(56.66, 6, 'Designation/Position', 1, 0, 'C');
$pdf->Cell(56.66, 6, 'Affiliation/Organization', 1, 1, 'C');

// Table Rows for Students (5 empty rows for input)
$pdf->SetFont('Arial', '', 9);
for ($i = 0; $i < 5; $i++) {
    $pdf->Cell(56.66, 6, '', 1, 0);
    $pdf->Cell(56.66, 6, '', 1, 0);
    $pdf->Cell(56.66, 6, '', 1, 1);
}
$pdf->Ln(7);

// Section: Materials and Resources Needed
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'IV. Materials and Resources Needed', 0, 1);
$pdf->Ln(2);

// Table Header
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 6, 'Qty', 1, 0, 'C');
$pdf->Cell(65, 6, 'Items', 1, 0, 'C');
$pdf->Cell(35, 6, 'Unit Cost', 1, 0, 'C');
$pdf->Cell(45, 6, ' Amount', 1, 1, 'C');

// Table Rows (5 empty rows for input)
$pdf->SetFont('Arial', '', 9);
for ($i = 0; $i < 7; $i++) {
    $pdf->Cell(25, 6, '', 1, 0);
    $pdf->Cell(65, 6, '', 1, 0);
    $pdf->Cell(35, 6, '', 1, 0);
    $pdf->Cell(45, 6, '', 1, 1);
}
//Table Footer or Total
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(125, 6, 'Total', 1, 0, 'R');
$pdf->Cell(45, 6, ' ', 1, 1, 'C');
$pdf->Ln(7);

// Page 3
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 6, 'V. Activity Risk Assessment', 0, 1);
$pdf->Ln(3);

// Risk Assessment Table Header
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(60, 6, 'Potential Hazards', 1, 0, 'C');
$pdf->Cell(60, 6, 'Safety Precautions', 1, 0, 'C');
$pdf->Cell(60, 6, 'Identified Risks', 1, 1, 'C');

// Table Rows (5 empty rows for input)
$pdf->SetFont('Arial', '', 9);
for ($i = 0; $i < 3; $i++) {
    $pdf->Cell(60, 6, '', 1, 0);
    $pdf->Cell(60, 6, '', 1, 0);
    $pdf->Cell(60, 6, '', 1, 1);
}
$pdf->Ln(5);

// Certification Section
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 6, 'CERTIFICATION:', 0, 1);
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(0, 6, "I certify that I have understood the potential hazards and risks that may be encountered by my child/ward, as well as the benefits that my child/ward will be getting from the said SCALE activity.");
$pdf->Ln(3);
$pdf->MultiCell(0, 6, "I certify that I have understood the projected expenses that will be incurred, as well as the benefits that my child/ward will be getting from the said SCALE activity.");
$pdf->Ln(5);

// Signatures
$pdf->Cell(0, 6, 'Name and Signature of Parent/Guardian: __________________________', 0, 1);
$pdf->Cell(0, 6, 'Signature of Student: __________________________________________', 0, 1);

// Output PDF
$pdf->Output();
?>
