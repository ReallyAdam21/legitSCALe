<?php
session_start();
include 'connect.php';

$query_string_id =isset($_GET['a_id']) ? (int)$_GET['a_id'] : null;

$id = $_SESSION['id'] ?? null;

if ($id && isset($_POST['txtSupervisor'], $_POST['txtDesignation'], $_POST['txtCompany'], $_POST['txtContact'])) {
    $supervisor = $conn->real_escape_string($_POST['txtSupervisor']);
    $designation = $conn->real_escape_string($_POST['txtDesignation']);
    $company = $conn->real_escape_string($_POST['txtCompany']);
    $contact = $conn->real_escape_string($_POST['txtContact']);

    $sql = "INSERT INTO persons_tbl (p_id, u_id, p_supervisor, p_designation, p_company, p_contact, a_id) VALUES (null, '$id', '$supervisor', '$designation', '$company', '$contact', $query_string_id)";
}
        if ($conn->query($sql) === TRUE) {
  echo "Added Successfully";
} 

?>

<script>

  location.replace("view_form3_students.php")

</script>

        
}