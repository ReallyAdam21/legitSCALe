<?php

session_start();
include 'connect.php';

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scale Coordinators Quarterly Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        .form-container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transform: scale(0.9);
            transform-origin: top;
        }
        h1, h2 {
            text-align: center;
            margin: 10px 0;
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 6px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .label-col {
            width: 30%;
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
            padding-left: 10px;
        }
        .input-col {
            width: 70%;
            text-align: left;
        }
        textarea, input[type="text"], input[type="number"], input[type="date"], select {
            width: 100%;
            padding: 4px;
            box-sizing: border-box;
            font-size: 0.9em;
        }
        .compact-table td, .compact-table th {
            padding: 4px;
            font-size: 0.85em;
        }
        .section-header {
            font-size: 1.1em;
            font-weight: bold;
            background-color: #eee;
            padding: 6px;
            text-align: center;
            border: 1px solid #333;
        }
        button {
            font-size: 1em;
            padding: 8px 16px;
            margin-top: 20px;
            cursor: pointer;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>Philippine Science High School System</h1>
        <h2>SCALE Coordinators Quarterly Report</h2>

        <form id="reportForm" action="submit_report.php" method="POST">

            <!-- Part I: Updates on Institutional SCALE Performance -->
            <div class="section-header">I. Updates on Institutional SCALE Performance</div>
            <table>
                <tr>
                    <td class="label-col">SY:</td>
                    <td class="input-col"><input type="text" id="schoolYear" name="schoolYear" required></td>
                    <td class="label-col">Quarter:</td>
                    <td class="input-col">
                        <select id="quarter" name="quarter" required>
                            <option value="1">1st Quarter</option>
                            <option value="2">2nd Quarter</option>
                            <option value="3">3rd Quarter</option>
                            <option value="4">4th Quarter</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table class="compact-table">
                <tr>
                    <th>Student SCALE Activities Implemented</th>
                    <th>Strand (S/C/A/L)</th>
                    <th>Dates/Duration</th>
                    <th>No. of PSHS Students Involved</th>
                    <th>Beneficiaries/Other Persons Involved</th>
                    <th>Form of Publicity/Reporting</th>
                    <th>Remarks</th>
                </tr>
                <tr>
                    <td><textarea name="activitiesImplemented" rows="2"></textarea></td>
                    <td><input type="text" name="strand" /></td>
                    <td><input type="text" name="datesDuration" /></td>
                    <td><input type="number" name="studentsInvolved" /></td>
                    <td><textarea name="beneficiariesInvolved" rows="2"></textarea></td>
                    <td><textarea name="publicityForm" rows="2"></textarea></td>
                    <td><textarea name="remarks" rows="2"></textarea></td>
                </tr>
            </table>

            <!-- Part II: Updates on Student SCALE Performance -->
            <div class="section-header">II. Updates on Student SCALE Performance</div>
            <table class="compact-table">
                <tr>
                    <th rowspan="2">No. of Students</th>
                    <th colspan="3">No. of Students who completed</th>
                    <th colspan="3">Overall Student Progress</th>
                    <th rowspan="2">Usual Causes of Delay in SCALE</th>
                    <th rowspan="2">Action to be Taken to Improve SCALE</th>
                </tr>
                <tr>
                    <th>Grade 11</th>
                    <th>Grade 12</th>
                    <th>Total</th>
                    <th>As Scheduled</th>
                    <th>Ahead of Time</th>
                    <th>Delayed</th>
                </tr>
                <tr>
                    <td><input type="number" id="noOfStudentsGrade11" name="noOfStudentsGrade11" min="0"></td>
                    <td><input type="number" id="noOfStudentsGrade12" name="noOfStudentsGrade12" min="0"></td>
                    <td><input type="number" id="noOfStudentsTotal" name="noOfStudentsTotal" min="0"></td>
                    <td><input type="number" id="scheduled" name="scheduled" min="0"></td>
                    <td><input type="number" id="ahead" name="ahead" min="0"></td>
                    <td><input type="number" id="delayed" name="delayed" min="0"></td>
                    <td><textarea id="causesOfDelay" name="causesOfDelay" rows="2"></textarea></td>
                    <td><textarea id="actionsToImprove" name="actionsToImprove" rows="2"></textarea></td>
                </tr>
            </table>

            <!-- Compact Table for Student-Initiated SCALE, Learning Outcomes, and Strands of Concern -->
            <table class="compact-table">
                <tr>
                    <th colspan="4">Additional Metrics</th>
                </tr>
                <tr>
                    <th>Metric</th>
                    <th>Grade 11</th>
                    <th>Grade 12</th>
                    <th>Total</th>
                </tr>
                <tr>
                    <td>No. of Student-Initiated SCALE</td>
                    <td><input type="number" id="grade11StudentInitiated" name="grade11StudentInitiated" min="0"></td>
                    <td><input type="number" id="grade12StudentInitiated" name="grade12StudentInitiated" min="0"></td>
                    <td><input type="number" id="totalStudentInitiated" name="totalStudentInitiated" min="0"></td>
                </tr>
                <tr>
                    <td>Learning Outcomes of Concern (least no. achieved)</td>
                    <td><textarea id="grade11LearningOutcomes" name="grade11LearningOutcomes" rows="2"></textarea></td>
                    <td><textarea id="grade12LearningOutcomes" name="grade12LearningOutcomes" rows="2"></textarea></td>
                    <td><textarea id="totalLearningOutcomes" name="totalLearningOutcomes" rows="2"></textarea></td>
                </tr>
                <tr>
                    <td>Strands of Concern (least no.)</td>
                    <td><textarea id="grade11StrandsOfConcern" name="grade11StrandsOfConcern" rows="2"></textarea></td>
                    <td><textarea id="grade12StrandsOfConcern" name="grade12StrandsOfConcern" rows="2"></textarea></td>
                    <td><textarea id="totalStrandsOfConcern" name="totalStrandsOfConcern" rows="2"></textarea></td>
                </tr>
            </table>

            <!-- Part III: Coordinator Information -->
            <div class="section-header">Coordinator Information</div>
            <table>
                <tr>
                    <td class="label-col">Name of SCALE Coordinator:</td>
                    <td class="input-col"><input type="text" id="coordinatorName" name="coordinatorName" required></td>
                </tr>
                <tr>
                    <td class="label-col">Date of Submission:</td>
                    <td class="input-col"><input type="date" id="submissionDate" name="submissionDate" required></td>
                </tr>
            </table>

            <div style="text-align: center;">
                <button type="submit">Submit Report</button>
            </div>
        </form>
    </div>

</body>
</html>
