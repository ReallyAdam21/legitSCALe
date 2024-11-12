<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCALE Individual Program Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .signature-section {
            margin-top: 20px;
        }
        .signature-section div {
            display: inline-block;
            width: 30%;
        }
    </style>
</head>
<body>

    <h2>PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM</h2>
    <h3>CAMPUS: _____________________________</h3>
    <h3>SCALE INDIVIDUAL PROGRAM REPORT</h3>

    <form action="process_form.php" method="POST">
        <label for="student_name">Name of Student:</label>
        <input type="text" id="student_name" name="student_name"><br><br>

        <label for="adviser_name">Name of Adviser:</label>
        <input type="text" id="adviser_name" name="adviser_name"><br><br>

        <label for="batch">Batch:</label>
        <input type="text" id="batch" name="batch"><br><br>

        <table>
            <thead>
                <tr>
                    <th>Title of Activity</th>
                    <th>Strands</th>
                    <th>Learning Outcomes</th>
                    <th>Type (I/G)</th>
                    <th>Date of Completion</th>
                    <th>Submitted Evidence</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="activity_title_1"></td>
                    <td><input type="text" name="strands_1"></td>
                    <td><input type="text" name="learning_outcomes_1"></td>
                    <td><input type="text" name="type_1"></td>
                    <td><input type="date" name="completion_date_1"></td>
                    <td>
                        <select name="evidence_1">
                            <option value="N">Narrative Reports (N)</option>
                            <option value="P/V">Photo/Video Documentation (P/V)</option>
                            <option value="R">Reflection Paper (R)</option>
                            <option value="C">Certification (C)</option>
                            <option value="others">Others</option>
                        </select>
                    </td>
                    <td><input type="text" name="remarks_1"></td>
                </tr>
                <!-- You can add more rows as needed -->
            </tbody>
        </table>

        <div class="signature-section">
            <div>
                <label for="student_signature">Signature of Student:</label><br>
                <input type="text" id="student_signature" name="student_signature"><br><br>
            </div>
            <div>
                <label for="date_prepared">Date Prepared:</label><br>
                <input type="date" id="date_prepared" name="date_prepared"><br><br>
            </div>
            <div>
                <label for="adviser_signature">Signature of Adviser:</label><br>
                <input type="text" id="adviser_signature" name="adviser_signature"><br><br>
            </div>
            <div>
                <label for="date_approved">Date Approved:</label><br>
                <input type="date" id="date_approved" name="date_approved"><br><br>
            </div>
        </div>

        <input type="submit" value="Submit">

    </form>

</body>
</html>
