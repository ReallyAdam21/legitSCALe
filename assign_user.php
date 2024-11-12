<?php
session_start();
include 'connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM users_tbl WHERE u_id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign User</title>
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
        input[type="submit"] {
            background-color: #71a5c5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
        input[type="submit"]:hover {
            background-color: #5a8fb0;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <?php include 'links.php'; ?>
    <div class="container">
        <h2><?php echo $row['u_lname'] . ", " . $row['u_fname'] . " " . $row['u_mname']; ?></h2>
        <form action="assign_user_proc.php" method="post">
            <table>
                <tr>
                    <td><input type="hidden" name="txtId" value="<?php echo $id; ?>">Batch:</td>
                    <td>
                        <select name="drpBatch">
                            <option value="n/a">N/A</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Grade:</td>
                    <td>
                        <select name="drpGrade">
                            <option value="n/a">N/A</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Section:</td>
                    <td>
                        <select name="drpSection">
                            <option value="n/a">N/A</option>
                            <option value="Curie A">Curie A</option>
                            <option value="Curie B">Curie B</option>
                            <option value="Darwin A">Darwin A</option>
                            <option value="Darwin B">Darwin B</option>
                            <option value="Einstein A">Einstein A</option>
                            <option value="Einstein B">Einstein B</option>
                            <option value="Pascal A">Pascal A</option>
                            <option value="Pascal B">Pascal B</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" value="Assign"></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
