<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Header function
    function Header()
    {
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 6, 'PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM', 0, 1, 'C');
        $this->SetFont('Arial', 'B', 11);
        $this->Cell(0, 6, 'Campus:______________________', 0, 1, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'SCALE ADVISERS ENDORSEMENT FORM', 0, 1, 'C');
        $this->Ln(5);
    }

    // Footer function
    function Footer()
    {
        $this->SetY(-20);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . ' of {nb}', 0, 0, 'C');
    }

    // Function to add form sections
    function AddFormSection()
    {
        $this->SetFont('Arial', '', 9);
        $this->Cell(0, 5, 'To the SCALE Coordinator:', 0, 1);
        $this->Ln(4);

        $this->MultiCell(0, 4, "This is to certify that the following students have satisfactorily completed the SCALE Program by accomplishing", 0, 'C'); // Center
        $this->MultiCell(0, 4, "their planned activities and demonstrating the desired learning", 0, 'C'); // Center
        $this->MultiCell(0, 4, "outcomes within the specified period of time.", 0, 'C'); // Center
        $this->Ln(5);

        // Table Header
        $this->SetFont('Arial', 'B', 8);
        $table_headers = ['Name of Student', 'No. of SCALE Activities Implemented', 'Final Date of Completion'];
        $table_widths = [55, 60, 55]; // Adjusted column widths to fit margins

        foreach ($table_headers as $index => $header) {
            $this->Cell($table_widths[$index], 5, $header, 1, 0, 'C');
        }
        $this->Ln();

        // Table Rows
        $this->SetFont('Arial', '', 8); // Smaller font for content
        for ($i = 1; $i <= 30; $i++) {
            $this->Cell($table_widths[0], 5, $i . '.', 1, 0, 'L');
            $this->Cell($table_widths[1], 5, '', 1, 0);
            $this->Cell($table_widths[2], 5, '', 1, 1);
        }
    }

    // Outcomes Section (Page 2)
    function AddOutcomesSection()
    {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 8);

        // Table Header with Two Rows
        $table_headers = [
            ["Name of Student", ""], 
            ["No. of SCALE Activities", "Implemented"], 
            ["Unachieved Learning", "Outcomes"], 
            ["Strands Not", "Undertaken"], 
            ["Remarks", ""]
        ];
        $table_widths = [34, 34, 34, 34, 34];

        // First row of headers
        foreach ($table_headers as $index => $header) {
            $this->Cell($table_widths[$index], 6, $header[0], 'LTR', 0, 'C'); // Top border
        }
        $this->Ln();

        // Second row of headers
        foreach ($table_headers as $index => $header) {
            $this->Cell($table_widths[$index], 6, $header[1], 'LR', 0, 'C'); // No top border
        }
        $this->Ln();

        // Table Rows
        $this->SetFont('Arial', '', 8); // Smaller font for compact layout
        for ($i = 1; $i <= 10; $i++) {
            foreach ($table_widths as $width) {
                $this->Cell($width, 5, '', 1);
            }
            $this->Ln();
        }

        // Outcome Legend
        $this->Ln(5);
        $this->SetFont('Arial', '', 8);
        $this->MultiCell(0, 4, 
            " Outcomes: O1 = Increased awareness of their own strengths and areas for growth\n" .
            "   O2 = Undertaken new challenges\n" .
            "   O3 = Introduced and managed activities\n" .
            "   O4 = Contributed actively in group activities\n" .
            "   O5 = Demonstrated perseverance and commitment in their activities\n" .
            "   O6 = Engaged with issues of global importance\n" .
            "   O7 = Reflected on the ethical consequence of their actions\n" .
            "   O8 = Developed new skills\n\n" .
            " Strands: S = Service, C = Creativity, A = Action, L = Leadership"
        );
    }

    // Signature Section (Page 2)
    function AddSignatureSection()
    {
        $this->Ln(10);
        $this->Cell(0, 5, '____________________________________ _________________', 0, 1);
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 4, 'Name and Signature of SCALE Adviser              Date of Submission', 0, 1);
    }
}

// Create a new PDF instance
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetMargins(20, 10, 20); // Ensure equal left and right margins
$pdf->SetAutoPageBreak(true, 10); // Adjust for smaller row heights
$pdf->AddPage();

// Add Form Section (Page 1)
$pdf->AddFormSection();

// Add Outcomes Section (Page 2)
$pdf->AddOutcomesSection();

// Add Signature Section (Page 2)
$pdf->AddSignatureSection();

// Output PDF
$pdf->Output('I', 'Scale_Advisers_Endorsement_Form.pdf');
?>
