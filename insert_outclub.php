<!DOCTYPE html>
<html>
<head>
    <title>Insert Outclub</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
	
	<style>    
	body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    text-align: left;
}

input[type="text"], input[type="password"], input[type="submit"], input[type="button"] {
    padding: 8px;
    width: calc(100% - 16px);
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 3px;
    font-size: 14px;
}

input[type="submit"], input[type="button"] {
    cursor: pointer;
    background-color: #71a5c5;
    color: white;
    border: none;
}

input[type="submit"]:hover, input[type="button"]:hover {
    background-color: #4b87ad;
}

a {
    text-decoration: none;
    color: #1e90ff;
}

a:hover {
    text-decoration: underline;
    color: #0a6ebd;
}

	
	</style>
</head>
<body>
    <?php include 'links.php'; ?>

    <div class="container">
        <form action="insert_outclub_proc.php" method="POST">
            <table border="1">
                <tr>
                    <td>CLUB NAME:</td>
                    <td><input type="text" name="txtCname"></td>
                </tr>
                <tr>
                    <td>POSITION:</td>
                    <td><input type="text" name="txtPosition"></td>
                </tr>
                <tr>
                    <td>LENGTH OF MEMBERSHIP:</td>
                    <td><input type="text" name="txtMembership"></td>
                </tr>
                <tr>
                    <td><input type="submit"></td>
                    <td><a href="view_form1_students.php"><input type="button" value="BACK"></a></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>