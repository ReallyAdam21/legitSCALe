<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 8, 'PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12);
		$this->Cell(0, 7, 'Campus:______________________', 0, 1, 'C');
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
        // Add text in each column using MultiCell for wrapping with left and right borders
        // Apply top and bottom borders if needed
        $this->Cell($w1, 6, $txt1, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w2, 6, $txt2, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w3, 6, $txt3, ($borderTopBottom ? 'LRT' : 'LR'), 0, 'L');
        $this->Cell($w4, 6, $txt4, ($borderTopBottom ? 'LRT' : 'LR'), 1, 'L');
    }
}

// Create a new PDF instance
$pdf = new PDF();
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
$pdf->Cell(95, 6, 'Name: ________________________________________', 0, 0);
$pdf->Cell(45, 6, 'Batch: _______', 0, 0);
$pdf->Cell(40, 6, 'Grade: _______', 0, 1);
$pdf->Ln(7);

// Clubs/Associations Joined in PSHS
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 6, 'Club/Association', 1, 0, 'C');
$pdf->Cell(60, 6, 'Position/Designation', 1, 0, 'C');
$pdf->Cell(40, 6, 'Length of Membership', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
for ($i = 0; $i < 3; $i++) {
    $pdf->Cell(70, 6, '', 1, 0);
    $pdf->Cell(60, 6, '', 1, 0);
    $pdf->Cell(40, 6, '', 1, 1);
}
$pdf->Ln(7);

// Clubs/Associations Outside PSHS
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 6, 'Club/Association', 1, 0, 'C');
$pdf->Cell(60, 6, 'Position/Designation', 1, 0, 'C');
$pdf->Cell(40, 6, 'Length of Membership', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
for ($i = 0; $i < 3; $i++) {
    $pdf->Cell(70, 6, '', 1, 0);
    $pdf->Cell(60, 6, '', 1, 0);
    $pdf->Cell(40, 6, '', 1, 1);
}
$pdf->Ln(7);

// Hobbies, Arts, Instruments, Sports Section
$pdf->Cell(0, 6, 'Other hobbies/interests, arts and crafts, musical instruments, and sports you have played:', 1, 1, 'L');

// First row: Add bordered columns for hobbies, arts, instruments, and sports with wrapped text
$pdf->SetFont('Arial', '', 8);  // Reduced font size for the four columns
$pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, 'Sports you have played', 'Musical instruments you have', 'Arts and crafts you have skill in:', 'Other hobbies/ interests:');

// Second row: Remove top and bottom borders for this row
$pdf->SetFont('Arial', '', 10); // Reset to default font size
$pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, '', 'played:', '', '', 0); // No borders for the second row
$pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, '', '', '', '', 0); // No borders for the second row
$pdf->FourColumnRow(42.5, 42.5, 42.5, 42.5, '', '', '', '', 0); // No borders for the second row
$pdf->Ln(0);

// Add borders to close the bottom of the last row for these fields
$pdf->Cell(42.5, 0, '', 'T', 0); // Hobbies
$pdf->Cell(42.5, 0, '', 'T', 0); // Arts
$pdf->Cell(42.5, 0, '', 'T', 0); // Instruments
$pdf->Cell(42.5, 0, '', 'T', 1); // Sports
$pdf->Ln(7);

// Activities of Interest
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, 'Activities that you are interested in learning about (could be a sport, art, music, skill, etc.):', 1, 1, 'L');

// Create bordered rows dynamically
$pdf->Cell(0, 1, '', 'LR', 1); // Top border for the section
for ($i = 0; $i < 3; $i++) {
    $pdf->Cell(0, 6, '', 'LR', 1); // Left and right borders for empty rows
}
$pdf->Cell(0, 0, '', 'T', 1); // Bottom border to close the block
$pdf->Ln(7);

// Activities Spearheaded
$pdf->Cell(0, 6, 'Activities that you have spearheaded (give a brief description of each activity):', 1, 1, 'L');

// Create bordered rows dynamically
$pdf->Cell(0, 1, '', 'LR', 1); // Top border for the section
for ($i = 0; $i < 3; $i++) {
    $pdf->Cell(0, 6, '', 'LR', 1); // Left and right borders for empty rows
}
$pdf->Cell(0, 0, '', 'T', 1); // Bottom border to close the block

$pdf->Ln(20);

// Signature Section
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 6, 'Signature of Student: _____________________________    Date Prepared: ______________', 0, 1);
$pdf->Ln(10);

// Output PDF
$pdf->Output();
?>
