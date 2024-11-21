<?php
session_start();
include 'connect.php';

$query_string_id =isset($_GET['s_id']) ? (int)$_GET['s_id'] : null;
$u_id= isset($_GET['u_id']) ? (int)$_GET['u_id'] : null;
echo $u_id;
echo $query_string_id;
if ($u_id && isset($_POST['txtRemarks'])) {
    $remarks = $_POST['txtRemarks'];
   $query= "SELECT * FROM scale_adviser_report_tbl WHERE student_u_id=? AND adviser_u_id=?";
   $stmt =$conn->prepare($query);
		$stmt->bind_param('ii', $query_string_id, $u_id );
		$stmt->execute();
		$result = $stmt->get_result();
		$details= $result->fetch_assoc();
			if($result->num_rows >0){
				$sql="UPDATE scale_adviser_report_tbl set s_a_r_remarks=? WHERE student_u_id = ? AND adviser_u_id=?";
				
				$stmt_update=$conn->prepare($sql);
				$stmt_update->bind_param('sii',  $remarks, $query_string_id, $u_id)
				;
				
				if ($stmt_update->execute()){
					$message = "Record has been updated successfully";
				}else {
						$message = "Error updating record: " .$stmt_update->error;
					}
			}else{
				$sql = "INSERT INTO scale_adviser_report_tbl (s_a_r_remarks,student_u_id, adviser_u_id) VALUES (?, ?, ?)";
    $statement =$conn->prepare($sql);
				$statement->bind_param('sii',$remarks,$query_string_id, $u_id );
				
				if ($statement->execute()){
					$message = "Data has been saved successfully";
				}
				else{
					$message = "Error saving data: " .$stmt->error;
				
				}

    
}
}
?>

<script>

  location.replace("view_scad_quarterly_report.php")

</script>