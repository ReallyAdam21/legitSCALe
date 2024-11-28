<?php 
require('fpdf/fpdf.php');

class PDF extends FPDF {
    // Header function
    function Header() {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 7, 'PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM', 0, 1, 'C');
        $this->Cell(0, 7, 'SCALE INDIVIDUAL PROGRAM REPORT', 0, 1, 'C');
        $this->Cell(0, 7, 'Campus:_________________________', 0, 1, 'C');
        $this->Ln(5);
    }

    // Footer function
    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 5, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Function to create bullet points
    function BulletPoint($x, $y, $text) {
        $this->SetXY($x, $y);
        $this->SetFont('ZapfDingbats', '', 9);
        $this->Cell(5, 5, chr(108), 0, 0); // Bullet symbol
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, $text, 0, 1);
    }
}

// Create a new PDF instance
$pdf = new PDF('L', 'mm', 'A4');
$pdf->SetMargins(10, 10, 10); // Set left, top, and right margins
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 10);

// Student Details Section
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 6, 'Name of Student:', 0, 0);
$pdf->Cell(90, 6, '', 0, 0, 'L'); // Placeholder for the student's name
$pdf->Cell(30, 6, 'Batch:', 0, 0);
$pdf->Cell(30, 6, '', 0, 1, 'L'); // Placeholder for the batch

$pdf->Cell(50, 6, 'Name of Adviser:', 0, 0);
$pdf->Cell(150, 6, '', 0, 1, 'L'); // Placeholder for the adviser's name
$pdf->Ln(5);

// Table Section
$pdf->SetFont('Arial', 'B', 9);
$table_headers = [
    'Title of Activity', 
    'Strands', 
    'Learning Outcomes', 
    'Type', 
    'Date of Completion', 
    'Evidence', 
    'Remarks'
];
$table_widths = [50, 20, 50, 20, 50, 50, 40];

// Add table headers
foreach ($table_headers as $index => $header) {
    $pdf->Cell($table_widths[$index], 6, $header, 1, 0, 'C');
}
$pdf->Ln();

// Add table rows
$pdf->SetFont('Arial', '', 8);
for ($i = 0; $i < 6; $i++) { // Create 6 rows for data
    foreach ($table_widths as $width) {
        $pdf->Cell($width, 6, '', 1); // Empty cells
    }
    $pdf->Ln();
}
$pdf->Ln(5);

// Attached Evidence Section
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(0, 6, 'I = Individual, G = Group', 0, 1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(0, 6, 'Attached Evidence:', 0, 1);
$pdf->SetFont('Arial', '', 9);

// Add bullet points for evidence
$first_column_x = 15;
$second_column_x = 110;
$line_spacing = 5;

// First column bullet points
$pdf->BulletPoint($first_column_x, $pdf->GetY(), 'Narrative Reports (N)');
$pdf->BulletPoint($first_column_x, $pdf->GetY(), 'Photo / Video Documentation (P / V)');
$pdf->BulletPoint($first_column_x, $pdf->GetY(), 'Others _______________');

// Second column bullet points
$pdf->BulletPoint($second_column_x, 113, 'Reflection Paper (R)');
$pdf->BulletPoint($second_column_x, 118, 'Certification (C)');

$pdf->Ln(20);

// Signature Section
$pdf->SetFont('Arial', '', 9);

// First row (Prepared by and Approved by)
$pdf->Cell(60, 6, 'Prepared by:', '', 0);
$pdf->Cell(60, 6, 'Approved by:', '', 0);
$pdf->Ln(20);

// Lines above the signature and date prepared fields
$pdf->Cell(60, 6, '__________________', 0, 0);
$pdf->Cell(60, 6, '____________', 0, 0);
$pdf->Cell(60, 6, '__________________', 0, 0);
$pdf->Cell(60, 6, '____________', 0, 0);
$pdf->Ln(5);
// Second row (Signature of Student, Signature of Adviser, Date Prepared)
$pdf->Cell(60, 6, 'Signature of Student:', 0, 0);
$pdf->Cell(60, 6, 'Date Prepared', 0, 0);
$pdf->Cell(60, 6, 'Signature of Adviser:', 0, 0);
$pdf->Cell(60, 6, 'Date Prepared:', 0, 0);

// Output PDF
$pdf->Output('Scale_Individual_Program_Report.pdf', 'I');
?>
