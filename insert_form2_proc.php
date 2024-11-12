<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'];

$title = $_POST['txtTa'];
$description = $_POST['txtDesc'];
$service = isset($_POST['cbService']);
$creativity = isset($_POST['cbCreativity']);
$action = !isset($_POST['cbAction']); // Assuming checkbox is checked when not set
$leadership = isset($_POST['cbLeadership']);
$type = $_POST['drpType'];
$start = $_POST['dateStart'];
$end = $_POST['dateEnd'];

$subDate = $_POST['submissionDate']; // Assuming u_subdate is the current date/time

$sql = "INSERT INTO activities_tbl (a_id, a_title, a_description, a_strand_s, a_strand_c, a_strand_a, a_strand_l, a_type, a_start, a_end, a_submission, u_id, a_sa_name, a_status, a_sa_remarks, a_sa_date, u_subdate)
        VALUES (null,'$title','$description','$service','$creativity','$action','$leadership','$type','$start','$end',null,'$id','0','Pending','0','0','$subDate')";

if ($conn->query($sql) === TRUE) {
    echo "Added Successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

<script>
    location.replace("view_form2_student.php");
</script>
