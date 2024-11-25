<?php
require_once __DIR__ . '/vendor/autoload.php'; // Ensure mPDF is installed via Composer

// Initialize mPDF
$mpdf = new \Mpdf\Mpdf();

// HTML content
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h4 style="text-align: center;">PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM</h4>
    <h4 style="text-align: center;">CAMPUS: CENTRAL LUZON</h4>
    <h4 style="text-align: center;">SCALE PERSONAL INFORMATION SHEET</h4>
    <br>

    <table>
        <thead>
            <tr>
                <th>Name of club/association joined in PSHS</th>
                <th>Position / designation</th>
                <th>Length of membership</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>28</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Jane Smith</td>
                <td>34</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Sam Wilson</td>
                <td>23</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
';

// Write HTML to mPDF
$mpdf->WriteHTML($html);

// Output the PDF
$mpdf->Output('table.pdf', \Mpdf\Output\Destination::INLINE); // INLINE to display in the browser
?>
