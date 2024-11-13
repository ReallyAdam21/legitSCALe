<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCALE Coordinators Program Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f9f9f9;
            height: 100vh;
            overflow: hidden;
            transform: scale(0.9); /* Zoom out */
            transform-origin: top center;
        }

        .container {
            width: 80%; /* Increase the container width to make it more compact */
            background-color: #fff;
            padding: 15px 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            font-size: 0.9em; /* Smaller font size */
        }

        .top-section {
            margin-bottom: 10px;
            text-align: center;
        }

        .top-section p {
            margin: 3px 0;
            font-weight: bold;
            font-size: 1em;
        }

        .form-inline-group {
            display: flex;
            gap: 5px;
            align-items: center;
            justify-content: center;
            margin-top: 5px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="date"], textarea {
            width: calc(100% - 10px);
            padding: 5px;
            font-size: 0.85em;
            margin-top: 3px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 0.8em;
        }

        table, th, td {
            border: 1px solid black;
            text-align: left;
        }

        th, td {
            padding: 3px;
            text-align: center;
        }

        .add-row-button {
            display: block;
            width: 100%;
            padding: 6px;
            font-size: 0.9em;
            background-color: #2196F3;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 8px;
        }

        .add-row-button:hover {
            background-color: #1976D2;
        }

        .signature-section {
            margin-top: 15px;
            display: flex;
            justify-content: space-between;
            font-size: 0.85em;
        }

        .signature-section div {
            width: 45%;
            text-align: center;
        }

        .btn-submit {
            display: block;
            width: 100%;
            padding: 6px;
            font-size: 0.9em;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="top-section">
            <p>PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM</p>
            <p>CAMPUS: __________________________</p>
            <p>SCALE COORDINATORS PROGRAM REPORT</p>

            <div class="form-inline-group">
                <label for="schoolYear">SY:</label>
                <input type="text" id="schoolYear" name="schoolYear" placeholder="e.g., 2023-2024" required style="width: 100px;">
                <span>,</span>
                <span>3rd Quarter</span>
            </div>
        </div>

        <form id="scaleForm" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="campus">Campus:</label>
                <input type="text" id="campus" name="campus" required>
            </div>

            <p>To the DSA Chief:</p>
            <p>This is to report that of the students of Batch 
                <input type="text" id="batch" name="batch" placeholder="e.g., 2024" style="width: 50px;" required>
                who have undertaken the SCALE Program since their 11th Grade, have satisfactorily completed the Program.</p>

            <p>The following students have yet to satisfactorily complete the Program and will have the 4th quarter to do so:</p>

            <table id="studentTable">
                <tr>
                    <th>Name of Student</th>
                    <th>Name of SCALE Adviser</th>
                    <th>Strands that need to be addressed</th>
                    <th>Learning Outcomes that need to be addressed</th>
                </tr>
                <!-- Initial 10 rows for student entries -->
                <tr><td><input type="text" name="studentName1"></td><td><input type="text" name="scaleAdviser1"></td><td><input type="text" name="strands1"></td><td><input type="text" name="learningOutcomes1"></td></tr>
                <tr><td><input type="text" name="studentName2"></td><td><input type="text" name="scaleAdviser2"></td><td><input type="text" name="strands2"></td><td><input type="text" name="learningOutcomes2"></td></tr>
                <tr><td><input type="text" name="studentName3"></td><td><input type="text" name="scaleAdviser3"></td><td><input type="text" name="strands3"></td><td><input type="text" name="learningOutcomes3"></td></tr>
                <tr><td><input type="text" name="studentName4"></td><td><input type="text" name="scaleAdviser4"></td><td><input type="text" name="strands4"></td><td><input type="text" name="learningOutcomes4"></td></tr>
                <tr><td><input type="text" name="studentName5"></td><td><input type="text" name="scaleAdviser5"></td><td><input type="text" name="strands5"></td><td><input type="text" name="learningOutcomes5"></td></tr>
                <tr><td><input type="text" name="studentName6"></td><td><input type="text" name="scaleAdviser6"></td><td><input type="text" name="strands6"></td><td><input type="text" name="learningOutcomes6"></td></tr>
                <tr><td><input type="text" name="studentName7"></td><td><input type="text" name="scaleAdviser7"></td><td><input type="text" name="strands7"></td><td><input type="text" name="learningOutcomes7"></td></tr>
                <tr><td><input type="text" name="studentName8"></td><td><input type="text" name="scaleAdviser8"></td><td><input type="text" name="strands8"></td><td><input type="text" name="learningOutcomes8"></td></tr>
                <tr><td><input type="text" name="studentName9"></td><td><input type="text" name="scaleAdviser9"></td><td><input type="text" name="strands9"></td><td><input type="text" name="learningOutcomes9"></td></tr>
                <tr><td><input type="text" name="studentName10"></td><td><input type="text" name="scaleAdviser10"></td><td><input type="text" name="strands10"></td><td><input type="text" name="learningOutcomes10"></td></tr>
            </table>

            <button type="button" class="add-row-button" onclick="addRow()">Add Row (Max 15)</button>

            <div class="signature-section">
                <div>
                    <label for="coordinatorName">Name and Signature of SCALE Coordinator</label>
                    <input type="text" id="coordinatorName" name="coordinatorName" required>
                </div>
                <div>
                    <label for="submissionDate">Date of Submission</label>
                    <input type="date" id="submissionDate" name="submissionDate" required>
                </div>
            </div>

            <button type="submit" class="btn-submit">Submit</button>
        </form>
    </div>

    <script>
        let rowCount = 10;

        function addRow() {
            if (rowCount >= 15) {
                alert("Maximum number of rows reached (15).");
                return;
            }

            rowCount++;
            const table = document.getElementById("studentTable");
            const row = document.createElement("tr");

            row.innerHTML = `
                <td><input type="text" name="studentName${rowCount}"></td>
                <td><input type="text" name="scaleAdviser${rowCount}"></td>
                <td><input type="text" name="strands${rowCount}"></td>
                <td><input type="text" name="learningOutcomes${rowCount}"></td>
            `;

            table.appendChild(row);
        }
    </script>

</body>
</html>
