<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, 'PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM', 0, 1, 'C');
        $this->Cell(0, 8, 'SCALE REFLECTION PAPER', 0, 1, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 8, 'S.Y. 2023 - 2024', 0, 1, 'C');
        $this->Ln(5);
    }

    function footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Function to handle 4 columns in a row for hobbies, arts, instruments, and sports
    function ThreeColumnRow($w1, $w2, $w3, $txt1, $txt2, $txt3, $border = 'LR')
    {
        $this->SetFont('Arial', '', 8);  // Reduced font size for this section
        // Add text in each column using MultiCell for wrapping with left and right borders
        // Apply the borders based on the specified string ('LR' for left and right, 'LTR' for top, left, right, etc.)
        $this->Cell($w1, 6, $txt1, $border, 0, 'L');
        $this->Cell($w2, 6, $txt2, $border, 0, 'L');
        $this->Cell($w3, 6, $txt3, $border, 0, 'L');
    }
}

// Create a new PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(15, 10, 15);
$pdf->SetAutoPageBreak(true, 10);

// Document Title
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 8, 'SCALE REFLECTION PAPER', 0, 1, 'C');
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 8, 'S.Y. 2023 - 2024', 0, 1, 'C');
$pdf->Ln(5);

// Section: Student Information
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'Name of Student and Section', 0, 1, 'L');
$pdf->Ln(3);

// Create 2x2 Table
$pdf->SetFont('Arial', '', 10);
$cellWidth = 90; // Width of each cell
$cellHeight = 10; // Height of each cell

// Row 1
$pdf->Cell($cellWidth, $cellHeight, 'Name of Student: __________________________', 1, 0, 'L');
$pdf->Cell($cellWidth, $cellHeight, '', 1, 1, 'L');

// Row 2
$pdf->Cell($cellWidth, $cellHeight, 'Section: ____________________', 1, 0, 'L'); // Empty row for spacing
$pdf->Cell($cellWidth, $cellHeight, '', 1, 1, 'L');

$pdf->Ln(5);

// Section: I. Overall Program Progress
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'I. Overall Program Progress', 0, 1, 'L');
$pdf->Ln(3);

// Add paragraph
$pdf->SetFont('Arial', '', 10);
$paragraph = "Fill the table with the necessary information with regard to your implemented SCALE activities. Put a checkmark () next to the Strands and Learning Outcomes that you achieved and indicate a type of evidence as per your attachments or an explanation of how the outcome was achieved. Repeat parts I to III for each completed SCALE Activity.";
$pdf->MultiCell(0, 6, $paragraph);
$pdf->Ln(5);

// Table: Form 2 Activity No.
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'FORM 2 ACTIVITY NO. ___', 1, 1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 6, 'Title of Activity', 1, 0, 'C');
$pdf->Cell(90, 6, '', 1, 0, 'C');
$pdf->Ln(6);

// Table Header for SCALE Strands
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(60, 6, 'SCALE STRANDS (LETTER CODES)', 1, 0, 'C');
$pdf->Cell(20, 6, 'MET?', 1, 0, 'C');
$pdf->Cell(100, 6, 'EVIDENCE/EXPLANATION', 1, 1, 'C');

// Rows for strands
$strands = ['SERVICE (S)', 'CREATIVITY (C)', 'ACTION (A)', 'LEADERSHIP (L)'];
foreach ($strands as $strand) {
    $pdf->Cell(60, 6, $strand, 1, 0, 'L');
    $pdf->Cell(20, 6, '', 1, 0, 'C');
    $pdf->Cell(100, 6, '', 1, 1, 'L');
}

// Nature and Duration
$pdf->Cell(60, 6, 'NATURE (INDIVIDUAL/GROUP)', 1, 0, 'L');
$pdf->Cell(120, 6, '', 1, 1, 'L');
$pdf->Cell(60, 6, 'DURATION (NUMBER OF HOURS)', 1, 0, 'L');
$pdf->Cell(120, 6, '', 1, 1, 'L');

// Section: Learning Outcomes
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'LEARNING OUTCOMES', 'LTR',1, 'L', 0, 'B');
$pdf->SetFont('Arial', 'B', 10);

// First row: Add bordered columns for hobbies, arts, instruments, and sports with wrapped text
$pdf->SetFont('Arial', 'B', 9);  // Reduced font size for the four columns
$pdf->ThreeColumnRow(60, 20, 100, 'Learning Outcomes', 'Met?', 'Evidence/Explanation','LTR');

// Second row: Remove bottom borders for this row only
$pdf->SetFont('Arial', '', 10); // Reset to default font size
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'increase awareness of strengths', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'and areas for growth', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'Undertake new challenges', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, '', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'Introduce and manage', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);

$pdf->ThreeColumnRow(60, 20, 100, 'activities', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'Contribute actively in', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'group activities', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);


$pdf->Ln(0);

// Add borders to close the bottom of the last row for these fields
$pdf->Cell(60, 0, '', 'T', 0); 
$pdf->Cell(20, 0, '', 'T', 0); 
$pdf->Cell(100, 0, '', 'T', 0); 
$pdf->Ln(7);


$pdf->AddPage();

$pdf->SetFont('Arial', '', 10); // Reset to default font size
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'Demonstrate perseverance and', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'commitment in their activities', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'Engage with issues of global', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'importance', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'Reflect on the ethical consequences', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);

$pdf->ThreeColumnRow(60, 20, 100, 'of ones actions', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'Develop new skills', '', '', 'LTR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);
$pdf->ThreeColumnRow(60, 20, 100, 'group activities', '', '', 'LR');  // Keep top, left, right borders; remove bottom
$pdf->Ln(6);


$pdf->Ln(0);

// Add borders to close the bottom of the last row for these fields
$pdf->Cell(60, 0, '', 'T', 0); 
$pdf->Cell(20, 0, '', 'T', 0); 
$pdf->Cell(100, 0, '', 'T', 0); 

$pdf->Ln(8);

// Section: II. Activity No. ____ Description',
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'II. Activity No. ____ Description', 0, 1, 'L');
$pdf->Ln(9);

$pdf->Cell(0, 1, '', 'B', 1); // Top border for the section
for ($i = 0; $i < 8; $i++) {
    $pdf->Cell(0, 6, '', 'B', 1); // Left and right borders for empty rows
}


// Section: III. Portfolio and Self-Reflection',
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 6, 'III. Portfolio and Self-Reflection', 0, 1, 'L');
$pdf->Ln(5);

// Add paragraph
$pdf->SetFont('Arial', '', 10);
$newParagraph = "  This is also to be reflected in Google Drive. Student's portfolio for Activity No. ___ contains the following";
$pdf->MultiCell(0, 6, $newParagraph);
$pdf->Ln(5);

//Portfolio and self reflection Table
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 6, 'Forms', 'LTR',1, 'C', 0);
$pdf->Cell(90, 6, 'Evidences', 'LTR',1, 'C', 0);


$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 6, 'Forms', 'LBR', 1, 'C', 0);
$pdf->Cell(90, 6, 'Evidences', 'LBR', 1, 'C', 0);
// Output the PDF
$pdf->Output();
?>
