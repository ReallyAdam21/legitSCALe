<?php
include ('connect.php');
$field = $_POST['drpField'];
$search = $_POST['txtSearch'];

$sql = "SELECT * FROM users_tbl WHERE $field = '$search'";
$result = $conn->query($sql);

?>

<html>
<head>
	<title></title>
</head>
<body>

	<table border='1'>
		<tr>
			<td>ID</td>
			<td>USERNAME</td>
			<td>PASSWORD</td>
			<td>LASTNAME</td>
			<td>FIRSTNAME</td>
			<td>MIDDLENAME</td>
			<td>EMAIL</td>
			<td>POSITION</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
<?php
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {

?>
		<tr>
			<td><?php echo $row['u_id']; ?></td>
			<td><?php echo $row['u_uname']; ?></td>
			<td><?php echo $row['u_pword']; ?></td>
			<td><?php echo $row['u_lname']; ?></td>
			<td><?php echo $row['u_fname']; ?></td>
			<td><?php echo $row['u_mname']; ?></td>
			<td><?php echo $row['u_email']; ?></td>
			<td><?php echo $row['u_position']; ?></td>
			<td><a href="update_users.php?id=<?php echo $row['u_id']; ?>">EDIT</a></td>
			<td><a href="delete_users.php?id=<?php echo $row['u_id']; ?>">DELETE</a></td>
		</tr>
<?php

}
} else {
  echo "0 results";
}
?>		

		<tr>
			<td><a href="view_users.php"><input type="button" value="BACK"></a></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
	</table>


</body>
</html>