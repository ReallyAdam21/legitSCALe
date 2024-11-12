<?php
include ('connect.php');
?>

<html>
<head>
	<style>
		body {
			background-color: #f4f4f4;
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 5px;
			overflow: hidden;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
		}

		th, td {
			padding: 15px;
			border: 1px solid #ccc;
			text-align: left;
		}

		th {
			background-color: #005caa;
			color: #fff;
			font-weight: bold;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}

		input[type="text"], select {
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 5px;
			box-sizing: border-box;
			margin-bottom: 10px;
		}

		input[type="submit"], input[type="button"] {
			background-color: #005caa;
			color: #fff;
			border: none;
			border-radius: 5px;
			padding: 10px;
			cursor: pointer;
		}

		input[type="submit"]:hover, input[type="button"]:hover {
			background-color: #003d74;
		}

		a {
			color: #005caa;
			text-decoration: none;
			border: 1px solid #005caa;
			padding: 5px 10px;
			border-radius: 5px;
			display: inline-block;
			margin-right: 10px;
			margin-top: 10px;
			transition: background-color 0.3s ease;
		}

		a:hover {
			background-color: #005caa;
			color: #fff;
		}

		a.add-btn {
			float: right;
			margin-top: 0;
		}

		.container {
			max-width: 800px;
			margin: 0 auto;
			padding: 20px;
			box-shadow: 0 0 10px rgba(0,0,0,0.1);
			background-color: #fff;
			border-radius: 5px;
			margin-top: 50px;
			text-align: center;
		}

		@media (max-width: 600px) {
			table, thead, tbody, th, td, form {
				display: block;
				width: 100%;
			}

			td, th {
				padding: 10px;
			}

			input[type="text"], select {
				width: 100%;
				margin-bottom: 10px;
	
	
	
	
	
	</style>
</head>

<body>
<form method ='POST'> 
<input type= 'text' name ='txtSearch'/> 
<input type = 'submit' name = 'btnSubmit'/>
</form>

<table border='1'>
<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$search = isset($_POST['txtSearch']) ? $_POST['txtSearch'] : '';

		$sql = "select a.u_lname,a.u_fname,a.u_mname,a.u_level,b.u_hobbies_name from users_tbl a left join hobbies_tbl b on a.u_id=b.u_id where b.u_hobbies_name like '%$search%'";

		$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						while ($row = $result->fetch_assoc()) {
		
		
					?>
			
						<tr>
							<td><?php echo $row["u_fname"]?></td>
							<td><?php echo $row["u_mname"]?></td>
							<td><?php echo $row["u_lname"]?></td>
						</tr>
						<?php
						}
					}
		}
?>
	
<?php
/*
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
*/
?>
		
<?php
/*
}
} else {
  echo "0 results";
}*/
?>		

		<tr>
			<td><a href="view_students.php"><input type="button" value="BACK"></a></td>
		</tr>
	</table>


</body>
</html>