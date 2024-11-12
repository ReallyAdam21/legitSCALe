<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reflection Paper Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-size: 14px; /* Reduces the font size to make it feel more compact */
        }
        h1, h2 {
            text-align: center;
            font-size: 18px; /* Smaller header font */
        }
        .form-container {
            width: 70vw; /* Slightly narrower form width */
            max-width: 800px; /* Sets a max width to prevent too wide form */
            padding: 15px;
            border: 1px solid #000;
            background-color: #f9f9f9;
            box-sizing: border-box;
            font-size: 14px; /* Ensures input text is smaller */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: left;
            font-size: 12px; /* Smaller font size for table */
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
            font-size: 13px; /* Slightly smaller input text */
        }
        .section {
            margin-bottom: 15px; /* Reduces space between sections */
        }
        .checkbox-group, .signatures {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            font-size: 13px; /* Smaller font for checkboxes */
        }
        .signature {
            flex: 1;
            min-width: 180px;
        }
        h3, h4 {
            font-size: 16px; /* Smaller sub-header font size */
        }
        ul {
            padding-left: 20px;
            font-size: 13px; /* Smaller font for the list items */
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h1>PHILIPPINE SCIENCE HIGH SCHOOL - CENTRAL LUZON CAMPUS</h1>
        <h2>SCALE REFLECTION PAPER<br>S.Y. 2023 – 2024</h2>

        <div class="section">
            <label for="studentName">Name of Student:</label>
            <input type="text" id="studentName" class="input-field">

            <label for="section">Section:</label>
            <input type="text" id="section" class="input-field">
        </div>

        <h3>I. Overall Program Progress</h3>

        <div class="section">
            <label for="form2No">FORM 2 ACTIVITY NO.:</label>
            <input type="text" id="form2No" class="input-field">

            <label for="activityTitle">Title:</label>
            <input type="text" id="activityTitle" class="input-field">

            <h4>SCALE Strands Met</h4>
            <div class="checkbox-group">
                <label><input type="checkbox"> Service (S)</label>
                <label><input type="checkbox"> Creativity (C)</label>
                <label><input type="checkbox"> Action (A)</label>
                <label><input type="checkbox"> Leadership (L)</label>
            </div>

            <label for="nature">Nature (Individual/Group):</label>
            <div class="checkbox-group">
                <label><input type="checkbox" id="natureIndividual"> Individual</label>
                <label><input type="checkbox" id="natureGroup"> Group</label>
            </div>

            <label for="duration">Duration (Number of Hours):</label>
            <input type="text" id="duration" class="input-field">

            <h4>Learning Outcomes Met</h4>
            <div class="checkbox-group">
                <label><input type="checkbox" id="outcome1"> Increase awareness of strengths and areas for growth</label>
                <label><input type="checkbox" id="outcome2"> Undertake new challenges</label>
                <label><input type="checkbox" id="outcome3"> Introduce and manage activities</label>
                <label><input type="checkbox" id="outcome4"> Contribute actively in group activities</label>
                <label><input type="checkbox" id="outcome5"> Demonstrate perseverance and commitment in activities</label>
                <label><input type="checkbox" id="outcome6"> Engage with issues of global importance</label>
                <label><input type="checkbox" id="outcome7"> Reflect on ethical consequences of one's actions</label>
                <label><input type="checkbox" id="outcome8"> Develop new skills</label>
            </div>
        </div>

        <h3>II. Activity Description</h3>
        <textarea class="input-field" rows="5"></textarea>

        <h3>III. Portfolio and Self-Reflection</h3>
        <div class="section">
            <h4>Portfolio for Activity</h4>
            <div class="checkbox-group">
                <label><input type="checkbox"> SCALE Forms 1, 2, and 3</label>
                <label><input type="checkbox"> DSA Forms</label>
                <label><input type="checkbox"> Weekly Logs</label>
                <label><input type="checkbox"> Form 5 Reflection Paper</label>
            </div>

            <h4>Evidences</h4>
            <div class="checkbox-group">
                <label><input type="checkbox"> Pictures</label>
                <label><input type="checkbox"> Videos</label>
                <label><input type="checkbox"> Ads/Posters</label>
                <label><input type="checkbox"> Innovated Worksheets</label>
                <label><input type="checkbox"> Ratings/Evaluation Sheets</label>
                <label><input type="checkbox"> Financial Report/Acknowledgment Receipt</label>
            </div>
        </div>

        <h3>Self-Reflection for Activity</h3>
        <textarea class="input-field" rows="10"></textarea>

        <div class="signatures">
            <div class="signature">
                <label for="supervisorName">Reviewed by:</label><br>
                <input type="text" id="supervisorName" class="input-field" placeholder="Signature over printed name of Adult Supervisor">
                <input type="date" class="input-field">
            </div>
            
            <div class="signature">
                <label for="adviserName">Submitted to:</label><br>
                <input type="text" id="adviserName" class="input-field" placeholder="Signature over printed name of SCALE Adviser">
                <input type="date" class="input-field">
            </div>

            <div class="signature">
                <label for="coordinatorName">Noted by:</label><br>
                <input type="text" id="coordinatorName" class="input-field" placeholder="Signature over printed name of SCALE Coordinator">
                <input type="date" class="input-field">
            </div>
        </div>
    </div>

</body>
</html>
