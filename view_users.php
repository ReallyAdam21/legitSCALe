<?php
session_start();
include 'connect.php';

// Check if the user is logged in and has a session level set
if (!isset($_SESSION["level"])) {
    // If session level is not set, redirect to index.php or login page
    header("Location: index.php");
    exit();
}

// Retrieve the user's level from session
$level = $_SESSION["level"];

// Initialize SQL query based on user level
$sql = "";
if ($level == 0) {
    // If user is ADMIN, fetch all users
    $sql = "SELECT * FROM users_tbl";
} elseif ($level == 1) {
    // If user is SCALE COORDINATOR, fetch users with level 1, 2, or 3
    $sql = "SELECT * FROM users_tbl WHERE u_level IN (1, 2, 3)";
}

// Perform the query
if (!empty($sql)) {
    $result = $conn->query($sql);

    if ($result) {
        // Display users
?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>User Management</title>
            <style>
                body {
                    font-family: 'Poppins', sans-serif;
                    background-color: #f0f0f0;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    max-width: 800px;
                    margin: 50px auto;
                    background-color: white;
                    border: 1px solid black;
                    border-radius: 5px;
                    padding: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                table, th, td {
                    border: 1px solid black;
                }
                th, td {
                    padding: 10px;
                    text-align: left;
                }
                th {
                    background-color: #71a5c5;
                    color: white;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                .add-button {
                    margin-top: 10px;
                    text-align: right;
                }
                .add-button a {
                    text-decoration: none;
                    background-color: #71a5c5;
                    color: white;
                    padding: 8px 15px;
                    border-radius: 5px;
                }
                .add-button a:hover {
                    background-color: #71a5c5;
                }
                .action-link {
                    text-decoration: none;
                    color: #1e90ff;
                }
                .action-link:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <?php include 'links.php'; ?>

            <div class="container">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>FULLNAME</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $row["u_id"] ?></td>
                                <td><?php echo $row["u_lname"] . " " . $row["u_fname"] . " " . $row["u_mname"] ?></td>
                                <td><a href="update_users.php?id=<?php echo $row["u_id"] ?>" class="action-link">UPDATE</a></td>
                                <td><a href="assign_user.php?id=<?php echo $row["u_id"] ?>" class="action-link">ASSIGN</a></td>
                                <td><a href="delete_users.php?id=<?php echo $row["u_id"] ?>" class="action-link">DELETE</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                    ?>
                    <tr>
                        <td colspan="4" class="add-button"><a href="insert_user.php">ADD</a></td>
                    </tr>
                </table>
            </div>

        </body>
        </html>
<?php
    } else {
        echo "Error executing query: " . $conn->error;
    }
} else {
    echo "SQL query is empty.";
}

$conn->close();
?>
