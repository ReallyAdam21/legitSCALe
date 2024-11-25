<?php
require('subwrite.php');

// Variables
$title = 'Philippine Science High School';
$campus = 'Central Luzon Campus';
$formname = 'SCALE PROGRAM PROPOSAL FORM';

// Create a new PDF instance
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(20, 10, 20); // Adjust left and right margins
$pdf->SetAutoPageBreak(true, 10); // Add bottom margin

// Header
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, $title, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(0, 10, $campus, 0, 1, 'C');
$pdf->Cell(0, 10, $formname, 0, 1, 'C');
$pdf->Ln(5);

// Student Information Section
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 10, 'Name of Student: _________________________', 0, 0);
$pdf->Cell(50, 10, 'Batch: _________', 0, 1);
$pdf->Cell(90, 10, 'Name of Adviser: ______________________________', 0, 1);
$pdf->Cell(90, 10, 'Date of Submission: _______________________', 0, 1);
$pdf->Ln(5);

// Table Header
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 15, 'Title of Activity', 1, 0, 'C');
$pdf->Cell(30, 15, 'Strand', 1, 0, 'C');
$pdf->Cell(30, 15, 'Type', 1, 0, 'C');
$pdf->Cell(50, 7.5, 'Target Schedule', 1, 1, 'C');

// Subheaders for Start and End Dates under "Target Schedule"
$pdf->SetX(140); // Move the X position to align with "Target Schedule"
$pdf->Cell(25, 7.5, 'Start', 1, 0, 'C');
$pdf->Cell(25, 7.5, 'End', 1, 1, 'C');

// Table Rows (Empty for manual filling or later data injection)
$pdf->SetFont('Arial', '', 10);
for ($i = 0; $i < 5; $i++) { // 5 Rows
    $pdf->Cell(60, 10, '', 1, 0); // Title of Activity
    $pdf->Cell(30, 10, '', 1, 0); // Strand
    $pdf->Cell(30, 10, '', 1, 0); // Type
    $pdf->Cell(25, 10, '', 1, 0); // Start Date
    $pdf->Cell(25, 10, '', 1, 1); // End Date
}
$pdf->Ln(5);

// Legends (Positioned below the table)
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(0, 5, '1 S = Service, C = Creativity, A = Action, L = Leadership', 0, 1);
$pdf->Cell(0, 5, '2 I = Individual, G = Group', 0, 1);
$pdf->Ln(5);

// Approval Section with Checkboxes
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 10, 'Appropriate Action:', 0, 0);

// Checkboxes aligned to the right
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 10, 'o', 0, 0); // Empty checkbox
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, 'Approved', 0, 0);
$pdf->SetFont('ZapfDingbats', '', 10);
$pdf->Cell(10, 10, 'o', 0, 0); // Empty checkbox
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 10, 'For Revision', 0, 1);
$pdf->Ln(5);

// Review and Approval Signatures
$pdf->Cell(0, 10, 'Reviewed by: ______________________________________                      _______________________', 0, 1);
$pdf->Cell(0, 10, '                             Name and Signature of SCALE Adviser                                         Date Reviewed', 0, 1);
$pdf->Ln(5);
$pdf->Cell(0, 10, 'Noted by: _________________________________________', 0, 1);
$pdf->Cell(0, 10, '                       Name and Signature of SCALE Coordinator', 0, 1);

// Output PDF
$pdf->Output();
?>
