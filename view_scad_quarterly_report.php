<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCALE Advisers Quarterly Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px; /* Wider width for landscape orientation */
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
            font-size: 1.5em;
            width: 100%;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-header, .form-section, .submit-section {
            display: flex;
            width: 100%;
            justify-content: space-between;
            gap: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }

        input[type="text"],
        input[type="date"],
        .dropdown {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-button {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f0f0;
            cursor: pointer;
            text-align: left;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 100%;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            padding: 10px;
            z-index: 1;
            border: 1px solid #ddd;
            max-height: 150px;
            overflow-y: auto;
        }

        .dropdown.active .dropdown-content {
            display: block;
        }

        .dropdown-content label {
            display: block;
            margin: 5px 0;
            cursor: pointer;
        }

        .submit-section {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Philippine Science High School System</h2>
    <h3>SCALE Advisers Quarterly Report</h3>

    <div class="form-container">
        <form action="submit_form.php" method="post">
            <div class="form-header">
                <div>
                    <label for="school-year">School Year (SY):</label>
                    <input type="text" id="school-year" name="school-year" placeholder="e.g., 2023-2024">
                </div>

                <div>
                    <label for="quarter">Quarter:</label>
                    <input type="text" id="quarter" name="quarter" placeholder="e.g., Q1, Q2, etc.">
                </div>

                <div>
                    <label for="campus">Campus:</label>
                    <input type="text" id="campus" name="campus" placeholder="Campus Name">
                </div>
            </div>

            <div id="activityReportContainer">
                <table>
                    <thead>
                        <tr>
                            <th>Names</th>
                            <th>Activity No.</th>
                            <th>Remarks</th>
                            <th>Achieved Learning Outcomes</th>
                            <th>Strands Undertaken</th>
                        </tr>
                    </thead>
                    <tbody id="activityRows">
                        <!-- Rows will be dynamically inserted here -->
                    </tbody>
                </table>
            </div>
            
            <div class="form-section">
                <div>
                    <label for="adviser-name">Name and Signature of SCALE Adviser:</label>
                    <input type="text" id="adviser-name" name="adviser-name" placeholder="Adviser's Name">
                </div>
    
                <div>
                    <label for="submission-date">Date Submitted:</label>
                    <input type="date" id="submission-date" name="submission-date">
                </div>
            </div>

            <div class="submit-section">
                <input type="submit" value="Submit Report" id="submitBtn">
            </div>
        </form>
    </div>

    <script>
        const students = 12; // Adjust this to set the number of students dynamically

        function populateRows() {
            const activityRows = document.getElementById('activityRows');

            for (let i = 1; i <= students; i++) {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="text" name="name${i}" placeholder="Student Name"></td>
                    <td><input type="text" name="activity_no${i}" placeholder="Activity No."></td>
                    <td><input type="text" name="remarks${i}" placeholder="Remarks"></td>
                    <td>
                        <div class="dropdown">
                            <span class="dropdown-button">Select Learning Outcomes</span>
                            <div class="dropdown-content">
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O1">O1 - Awareness of strengths</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O2">O2 - New challenges</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O3">O3 - Managed activities</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O4">O4 - Group contribution</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O5">O5 - Perseverance</label>
                                <label><input type="checkbox" name="learning_outcomes${i}[]" value="O6">O6 - Global issues</label>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="dropdown">
                            <span class="dropdown-button">Select Strands</span>
                            <div class="dropdown-content">
                                <label><input type="checkbox" name="strands${i}[]" value="S">S - Service</label>
                                <label><input type="checkbox" name="strands${i}[]" value="C">C - Creativity</label>
                                <label><input type="checkbox" name="strands${i}[]" value="A">A - Action</label>
                                <label><input type="checkbox" name="strands${i}[]" value="L">L - Leadership</label>
                            </div>
                        </div>
                    </td>
                `;
                activityRows.appendChild(row);
            }
        }

        document.addEventListener('click', function(event) {
            const isDropdownButton = event.target.matches('.dropdown-button');
            const activeDropdowns = document.querySelectorAll('.dropdown.active');
            
            if (isDropdownButton) {
                const dropdown = event.target.closest('.dropdown');
                dropdown.classList.toggle('active');
            } else {
                activeDropdowns.forEach(dropdown => {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('active');
                    }
                });
            }
        });

        window.onload = populateRows;
    </script>
</body>
</html>
