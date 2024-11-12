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
<form action="delete_users_proc.php" method="POST" onsubmit="return confirm('Do you really want to delete the form?');">
	<table border='1'>
<?php 
while($row = $result->fetch_assoc()) {
	
	?>
		<tr>
			<td>ID</td>
			<td><input type="text" name="txtId" readonly value="<?php echo $row['u_id']; ?>" ></td>
		</tr>
		<tr>
			<td>PASSWORD</td>
			<td><input type="text" name="txtPword" readonly value="<?php echo $row['u_pword']; ?>"></td>
		</tr>
		<tr>
			<td>RETYPE PASSWORD</td>
			<td><input type="text" name="txtRpword"></td>
		</tr>
		<tr>
			<td>LASTNAME</td>
			<td><input type="text" name="txtLname" readonly value="<?php echo $row['u_lname']; ?>"></td>
		</tr>
		<tr>
			<td>FIRSTNAME</td>
			<td><input type="text" name="txtFname" readonly value="<?php echo $row['u_fname']; ?>"></td>
		</tr>
		<tr>
			<td>MIDDLENAME</td>
			<td><input type="text" name="txtMname" readonly value="<?php echo $row['u_mname']; ?>"></td>
		</tr>
		<tr>
			<td>EMAIL</td>
			<td><input type="text" name="txtEmail" readonly value="<?php echo $row['u_email']; ?>"></td>
		</tr>
		<tr>
			<td>POSITION</td>
			<td><select name="drpPosition" readonly value="<?php echo $row['u_position']; ?>">
				  <option value="1">Coordinator</option>
				  <option value="2">Adviser</option>
				  <option value="3">Student</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><a href="view_users.php"><input type="button" value="BACK"></a></td>
			<td><input type="SUBMIT" value="Delete"></td>
		</tr>
<?php 
}
?>
	</table>


</body>
</html>