<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 50px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            color: #0066cc;
            text-decoration: underline;
        }

        .home-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .home-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<?php include 'links.php'; ?>
    <h1>Welcome, </h1>

    <a href="dashboard.php" class="home-button">Home</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Fullname</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
		 <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th><a href="view_scaco_quarterly_report_form.php">Coordinator's Quarterly Report</a></th>
            <th><a href="view_scaco_program_report_form.php">Coordinator's Program Report</a></th>
          
        </tr>
	</table>
</body>
</html>
