<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Insert User</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #71a5c5;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        input[type="text"], input[type="password"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"], input[type="button"] {
            background-color: #71a5c5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #5a8fb0;
        }
        .action-buttons {
            text-align: right;
        }
        .action-buttons a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php include 'links.php'; ?>
    <div class="container">
        <form action="insert_user_proc.php" method="POST">
            <table>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="txtLname"></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="txtFname"></td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td><input type="text" name="txtMname"></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="txtEmail"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="txtPword"></td>
                </tr>
                <tr>
                    <td>Position</td>
                    <td>
                        <select name="drpLevel">
                            <option value="1">SCALE Coordinator</option>
                            <option value="2">SCALE Adviser</option>
                            <option value="3">Students</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit"></td>
                    <td class="action-buttons">
                        <a href="view_users.php"><input type="button" value="BACK"></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>