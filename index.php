<html>
	<head>
	<style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        form {
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
            max-width: 400px;
            margin: 50px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            padding: 8px 20px;
            background-color: #71a5c5;
            color: white;
            border: none;
            cursor: pointer;
            margin-right: 10px;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #71a5c5;
        }
    </style>
	</head>
<body>
<form action="login_proc.php" method="post"> 
	<table border = "1">
		<tr>
			<td>email</td>
			<td><input type="text" name="txtEmail"></td>
		</tr>
		<tr>
			<td>password</td>
			<td><input type="password" name="txtPword"></td>
		</tr>
		<tr>
			<td><input type="submit"></td>
			<td><input type="reset" value="Reset"></td>
		</tr>
	</table>

</body>
</html>