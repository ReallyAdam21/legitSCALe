<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SCALE Advisers Endorsement Form</title>
<style>
    body {
        font-family: Arial, sans-serif;
        padding: 20px;
        font-size: 14px;
        max-width: 1200px;
        margin: auto;
    }
    h1 {
        text-align: center;
        font-size: 18px;
        text-decoration: underline;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 5px;
    }
    table, th, td {
        border: 1px solid black;
    }
    th, td {
        padding: 6px;
        text-align: center;
        font-size: 12px;
    }
    .multiselect-container {
        position: relative;
    }
    .multiselect-button {
        padding: 4px 8px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }
    .multiselect-button:hover {
        background-color: #0056b3;
    }
    .multiselect-dropdown {
        display: none;
        position: absolute;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        max-height: 150px;
        overflow-y: auto;
        z-index: 1;
        width: 180px;
        padding: 8px;
    }
    .multiselect-checkbox {
        display: flex;
        align-items: center;
        margin: 4px 0;
        font-size: 12px;
    }
    .form-footer {
        margin-top: 20px;
    }
    .form-footer label {
        font-weight: bold;
    }
    .form-footer input {
        padding: 5px;
        font-size: 12px;
    }
    button[type="submit"] {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button[type="submit"]:hover {
        background-color: #45a049;
    }
    .show {
        display: block !important;
    }
</style>
<script>
    function toggleDropdown(id) {
        document.getElementById(id).classList.toggle("show");
    }

    function addRow(page) {
        const table = document.getElementById(`table-page-${page}`);
        const row = table.insertRow();
        
        if (page === 1) {
            row.innerHTML = `
                <td><input type="text" name="studentName"></td>
                <td><input type="number" name="activitiesImplemented"></td>
                <td><input type="date" name="completionDate"></td>
                <td><input type="text" name="remarks"></td>
            `;
        } else {
            row.innerHTML = `
                <td><input type="text" name="studentName"></td>
                <td><input type="number" name="activitiesImplemented"></td>
                <td>
                    <div class="multiselect-container">
                        <button type="button" class="multiselect-button" onclick="toggleDropdown('outcomes-dropdown-${table.rows.length}')">Select Outcomes</button>
                        <div id="outcomes-dropdown-${table.rows.length}" class="multiselect-dropdown">
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O1"> O1 - Awareness of Strengths</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O2"> O2 - New Challenges</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O3"> O3 - Managed Activities</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O4"> O4 - Group Contribution</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O5"> O5 - Perseverance</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O6"> O6 - Global Issues</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O7"> O7 - Ethical Reflection</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="outcome" value="O8"> O8 - New Skills</label>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="multiselect-container">
                        <button type="button" class="multiselect-button" onclick="toggleDropdown('strands-dropdown-${table.rows.length}')">Select Strands</button>
                        <div id="strands-dropdown-${table.rows.length}" class="multiselect-dropdown">
                            <label class="multiselect-checkbox"><input type="checkbox" name="strand" value="S"> S - Service</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="strand" value="C"> C - Creativity</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="strand" value="A"> A - Action</label>
                            <label class="multiselect-checkbox"><input type="checkbox" name="strand" value="L"> L - Leadership</label>
                        </div>
                    </div>
                </td>
                <td><input type="text" name="remarks"></td>
            `;
        }
    }
    
    window.onclick = function(event) {
        if (!event.target.matches('.multiselect-button') && !event.target.closest('.multiselect-dropdown')) {
            const dropdowns = document.getElementsByClassName("multiselect-dropdown");
            for (let i = 0; i < dropdowns.length; i++) {
                dropdowns[i].classList.remove('show');
            }
        }
    }
</script>
</head>
<body>

<h1>SCALE Advisers Endorsement Form</h1>

<form action="#" method="post">
    <!-- Page 1 Table -->
    <div class="table-container">
        <table id="table-page-1">
            <tr>
                <th>Name of Student</th>
                <th>No. of SCALE Activities Implemented</th>
                <th>Final Date of Completion of SCALE Activities</th>
                <th>Remarks</th>
            </tr>
            <!-- 30 rows initially -->
            <script>
                for (let i = 0; i < 30; i++) addRow(1);
            </script>
        </table>
    </div>

    <!-- Page 2 Table -->
    <div class="table-container">
        <table id="table-page-2">
            <tr>
                <th>Name of Student</th>
                <th>No. of SCALE Activities Implemented</th>
                <th>Unachieved Learning Outcomes</th>
                <th>Strands Not Undertaken</th>
                <th>Remarks</th>
            </tr>
            <!-- 10 rows initially -->
            <script>
                for (let i = 0; i < 10; i++) addRow(2);
            </script>
        </table>
        <button type="button" onclick="addRow(2)">Add More Rows</button>
    </div>

    <!-- Adviser Information and Submit Button -->
    <div class="form-footer">
        <label for="adviserName">Name of SCALE Adviser:</label>
        <input type="text" id="adviserName" name="adviserName" required><br>

        <label for="adviserSignature">Signature:</label>
        <input type="text" id="adviserSignature" name="adviserSignature" required><br>

        <label for="submissionDate">Date of Submission:</label>
        <input type="date" id="submissionDate" name="submissionDate" required><br><br>

        <button type="submit">Submit</button>
    </div>
</form>

</body>
</html>
