<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scale Individual Program Report</title>
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
            padding: 8px;
            text-align: left;
        }
        .header, .footer {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .input-field {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="landscape">
        <div class="form-container">
            <div class="header">
                PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM<br>
                SCALE INDIVIDUAL PROGRAM REPORT
            </div>

            <form>
                <label for="campus">Campus:</label>
                <input type="text" id="campus" class="input-field"><br><br>

                <label for="studentName">Name of Student:</label>
                <input type="text" id="studentName" class="input-field"><br><br>

                <label for="batch">Batch:</label>
                <input type="text" id="batch" class="input-field"><br><br>

                <label for="adviserName">Name of Adviser:</label>
                <input type="text" id="adviserName" class="input-field"><br><br>

                <label for="strandsType">Strands Type (I = Individual, G = Group):</label>
                <input type="text" id="strandsType" class="input-field"><br><br>

                <label for="evidence">Attached Evidence:</label>
                <input type="text" id="evidence" placeholder="Narrative Reports (N), Reflection Paper (R), Photo/Video (P/V), Certification (C), Others" class="input-field"><br><br>

                <table>
                    <thead>
                        <tr>
                            <th>Title of Activity</th>
                            <th>Learning Outcomes</th>
                            <th>Date of Completion</th>
                            <th>Submitted Evidence</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="input-field"></td>
                            <td><input type="text" class="input-field"></td>
                            <td><input type="date" class="input-field"></td>
                            <td><input type="text" class="input-field"></td>
                            <td><input type="text" class="input-field"></td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>

                <br><br>
                <div class="footer">
                    <label for="studentSignature">Signature of Student:</label>
                    <input type="text" id="studentSignature" class="input-field"><br><br>

                    <label for="adviserSignature">Signature of Adviser:</label>
                    <input type="text" id="adviserSignature" class="input-field"><br><br>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
