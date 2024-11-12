<?php
session_start();
include 'connect.php';
$id = $_SESSION['id'];
$sqlIn = "SELECT * FROM sin_clubs_tbl WHERE u_id = '$id'";
$resultIn = $conn->query($sqlIn);

$sqlOut = "SELECT * FROM sout_clubs_tbl WHERE u_id = '$id'";
$resultOut = $conn->query($sqlOut);

?>
<html>
<head>

<link rel="stylesheet" type="text/css" href="form1.css">

</head>
<?php include 'links.php'; ?>
<body>

	<table border="1">
		<tr>
			<td>Name: <?php echo $_SESSION['lname'] . " " . $_SESSION['fname'] . " " . $_SESSION['mname']?></td>
			<td>Batch:</td>
			<td>Grade:</td>
		</tr>
	</table>
	<table border="1">
		<tr>
			<td>Name of club/association joined in PSHS</td>
			<td>Position / designation</td>
			<td>Length of membership</td>
		</tr>
<?php

if ($resultIn->num_rows > 0) {
		 while($row = $resultIn->fetch_assoc()) {
?>
		<tr>
			<td><?php echo $row["sin_name"] ?></td>
			<td><?php echo $row["sin_position"] ?></td>
			<td><?php echo $row["sin_length"] ?></td>
		</tr>
		<?php
		} 
}
else {
	echo "0 results";
}

?>
		<tr>
			<td colspan="3"><a href="insert_inclub.php"><button type="button">ADD INSIDE CLUB</button></a></td>
		</tr>
	</table>

	<table border="1">
		<tr>
			<td>Name of club/association joined outside PSHS</td>
			<td>Position / designation</td>
			<td>Length of membership</td>
		</tr>
<?php

if ($resultOut->num_rows > 0) {
		 while($row = $resultOut->fetch_assoc()) {
?>
		<tr>
			<td><?php echo $row["sout_name"] ?></td>
			<td><?php echo $row["sout_position"] ?></td>
			<td><?php echo $row["sout_length"] ?></td>
		</tr>
		<?php
		} 
}
else {
	echo "0 results";
}

$conn->close();
?>
		<tr>
			<td colspan="3"><a href="insert_outclub.php"><button type="button">ADD OUTSIDE CLUB</button></a></td>
		</tr>
	</table>
	
	<table border="1">
		<tr>
			<td>Sports you have played:</td>
			<td>Musical instruments that you have played:</td>
			<td>Arts and crafts you have skill in:</td>
			<td>Other hobbies/interests:</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="4">Activities that you are interested in learning about (could be a sport, art, music, skill, etc.):<br>
			<br><br><br><br></td>

		</tr>
		<tr>
			<td colspan="4">Activities that you have spearheaded (give a brief description of each activity):<br>
			<br><br><br><br></td>

		</tr>
	</table>
</body>
</html>