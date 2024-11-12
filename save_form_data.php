<?php
session_start();
include 'connect.php';

// Assuming $_SESSION['id'] contains the user's ID
$id = $_SESSION['id'];

// Function to sanitize and validate input data
function sanitizeInput($conn, $data) {
    // Ensure no SQL injection
    $cleanData = [];
    foreach ($data as $key => $value) {
        $cleanData[$key] = $conn->real_escape_string($value);
    }
    return $cleanData;
}

// Check if form data was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean and validate form data
    $formData = sanitizeInput($conn, $_POST);

    // Extract form data
    $a_title = $formData['a_title'];
    $a_description = $formData['a_description'];
    $a_strand_s = $formData['a_strand_s'];
    $a_strand_c = $formData['a_strand_c'];
    $a_strand_a = $formData['a_strand_a'];
    $a_strand_l = $formData['a_strand_l'];
    $a_type = $formData['a_type'];
    $a_start = $formData['a_start'];
    $a_end = $formData['a_end'];
    $a_status = $formData['a_status'];

    // Insert form data into database
    $sqlInsert = "INSERT INTO activities_tbl (u_id, a_title, a_description, a_strand_s, a_strand_c, a_strand_a, a_strand_l, a_type, a_start, a_end, a_status) 
                  VALUES ('$id', '$a_title', '$a_description', '$a_strand_s', '$a_strand_c', '$a_strand_a', '$a_strand_l', '$a_type', '$a_start', '$a_end', '$a_status')";

    if ($conn->query($sqlInsert) === TRUE) {
        // Redirect to a success page or back to the form with a success message
        header("Location: view_form.php?success=true");
        exit();
    } else {
        // Handle database insertion error
        echo "Error: " . $sqlInsert . "<br>" . $conn->error;
    }
}

// Close database connection
$conn->close();
?>
