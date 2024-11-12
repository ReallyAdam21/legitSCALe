<?php
include ('connect.php');
$id = $_GET['id'];
$sql = "SELECT * FROM users_tbl WHERE u_id = '$id'";
$result = $conn->query($sql);

?>
<html>
<head>
	<title></title>
</head>
<body>
<form action="update_users_process.php" method="POST">
	<table border='1'>
<?php 
while($row = $result->fetch_assoc()) {
	
	?>
		<tr>
			<td>ID</td>
			<td><input type="text" name="txtId" value="<?php echo $row['u_id']; ?>" ></td>
		</tr>
		<tr>
			<td>PASSWORD</td>
			<td><input type="text" name="txtPword" value="<?php echo $row['u_pword']; ?>"></td>
		</tr>
		<tr>
			<td>RETYPE PASSWORD</td>
			<td><input type="text" name="txtRpword"></td>
		</tr>
		<tr>
			<td>LASTNAME</td>
			<td><input type="text" name="txtLname" value="<?php echo $row['u_lname']; ?>"></td>
		</tr>
		<tr>
			<td>FIRSTNAME</td>
			<td><input type="text" name="txtFname" value="<?php echo $row['u_fname']; ?>"></td>
		</tr>
		<tr>
			<td>MIDDLENAME</td>
			<td><input type="text" name="txtMname" value="<?php echo $row['u_mname']; ?>"></td>
		</tr>
		<tr>
			<td>EMAIL</td>
			<td><input type="text" name="txtEmail" value="<?php echo $row['u_email']; ?>"></td>
		</tr>
		<tr>
			<td>POSITION</td>
			<td><select name="drpPosition" value="<?php echo $row['u_position']; ?>">
				  <option value="1">Coordinator</option>
				  <option value="2">Adviser</option>
				  <option value="3">Student</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><a href="view_users.php"><input type="button" value="BACK"></a></td>
			<td><input type="SUBMIT"></td>
		</tr>
<?php 
}
?>
	</table>


</body>
</html>