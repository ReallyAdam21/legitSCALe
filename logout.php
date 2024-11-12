<?php
session_start();

// Only proceed with the logout if the confirmation is received
if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
    // Unset all session variables
    $_SESSION = [];

    // Destroy the session
    session_destroy();

    // Redirect to index.php or login page after logout
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout Confirmation</title>
    <script>
        // Function to show confirmation dialog
        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "logout.php?confirm=yes";
            } else {
                window.location.href = "dashboard.php"; // Redirect to dashboard or desired page if cancel
            }
        }

        // Trigger the confirmation dialog on page load
        window.onload = function() {
            confirmLogout();
        };
    </script>
</head>
<body>
    <!-- The body remains empty as the confirmation logic is handled by JavaScript -->
</body>
</html>
