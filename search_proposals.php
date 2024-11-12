<?php
include ('connect.php');
$field = $_POST['drpField'];
$search = $_POST['txtSearch'];

$sql = "SELECT * FROM proposalform_tbl WHERE $field = '$search'";
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
			<td>Name</td>
			<td>Adviser</td>
			<td>Submission Date</td>
			<td>Activity Title</td>
			<td>Strand</td>
			<td>Type</td>
			<td>Start Date</td>
			<td>End Date</td>
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
			<td><?php echo $row['u_name']; ?></td>
			<td><?php echo $row['u_adviser']; ?></td>
			<td><?php echo $row['u_submissiondate']; ?></td>
			<td><?php echo $row['u_activitytitle']; ?></td>
			<td><?php echo $row['u_strand']; ?></td>
			<td><?php echo $row['u_type']; ?></td>
			<td><?php echo $row['u_startdate']; ?></td>
			<td><?php echo $row['u_enddate']; ?></td>
			<td><a href="update_proposals.php?id=<?php echo $row['u_id']; ?>">EDIT</a></td>
			<td><a href="delete_proposals.php?id=<?php echo $row['u_id']; ?>">DELETE</a></td>
		</tr>
<?php

}
} else {
  echo "0 results";
}
?>		

		<tr>
			<td><a href="view_proposals.php"><input type="button" value="BACK"></a></td>
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