<?php
session_start();

// Check if the user is logged in and has a session level set
if (!isset($_SESSION["level"])) {
    // If session level is not set, redirect to index.php or login page
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
            text-align: center;
        }
        .links {
            margin-bottom: 20px;
        }
        .logout-btn {
            margin-top: 20px;
        }
        input[type="submit"] {
            padding: 8px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="links">
            <?php include 'links.php'; ?>
        </div>

        <h2>Welcome <?php 
            // Display user role based on session level
            if ($_SESSION["level"] == 0) {
                echo "ADMIN";
            } elseif ($_SESSION["level"] == 1) {
                echo "SCALE COORDINATOR";
            } elseif ($_SESSION["level"] == 2) {
                echo "SCALE ADVISER";
            } elseif ($_SESSION["level"] == 3) {
                echo "STUDENT";
            }
        ?></h2>

        <!-- Logout button -->
        <form action="logout.php" method="post" class="logout-btn">
            <input type="submit" value="Logout">
        </form>
    </div>
</body>
</html>
