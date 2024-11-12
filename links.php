<?php
// Check if a session is already active
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it's not already started
}
?>

<h2>
    <a href="dashboard.php">HOME</a> |

    <?php
    // Check if $_SESSION is set and $_SESSION['level'] is also set
    if (isset($_SESSION['level'])) {
        $level = $_SESSION['level'];

        // Check the value of $_SESSION['level'] for conditional links
        if ($level == 0 || $level == 1) {
            echo '<a href="view_users.php">USERS</a> | ';
        }
		if ($level == 3) {
			echo '<a href="search_students.php">SEARCH STUDENTS</a> | ';
			
		}
        // Display the "Students" tab only if $_SESSION['level'] is not 0
        if ($level == 2) {
            echo '<a href="view_students.php">STUDENTS</a> | ';
        }
		

    } 
	
	else {
        // Handle case where $_SESSION['level'] is not set
        // For example, redirect users or show a specific message
        // Here, we're redirecting to a login page as an example
        header("Location: login.php");
        exit; // Make sure to exit after redirect
    }
    ?>

    <a href="view_form.php">FORMS</a>
</h2>
