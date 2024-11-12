<?php

include 'connect.php';
include 'links.php'; // Ensure this is included at the top

?>

<html>

<head>
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
        .submit-button, .back-button {
            background-color: #71a5c5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .submit-button:hover, .back-button:hover {
            background-color: #5a8fb0;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <form action="insert_art_proc.php" method="POST">
            <table border="1">
                <tr>
                    <td>Art:</td>
                    <td><input type="text" name="txtArt" required></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Submit" class="submit-button"></td>
                    <td><a href="view_form1_students.php"><button type="button" class="back-button">BACK</button></a></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>