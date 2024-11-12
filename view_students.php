<?php
session_start();
include 'connect.php';

// Check if the user is logged in and has a session level set
if (!isset($_SESSION["level"])) {
    // If session level is not set, redirect to index.php or login page
    header("Location: index.php");
    exit();
}

// Retrieve the user's level and id from session
$level = $_SESSION["level"];
$id = $_SESSION["id"]; // Assuming the user's id is stored in session

// Initialize SQL query based on user level
$sql = "";

if ($level == 0 || $level == 1 || $level == 2 ||$level ==3) {
    if ($level == 2 && $level ==3) {
        // Fetch users with u_level=3 (students) and matching ui_section for u_level 2
        // Use JOIN instead of subquery for better performance and to avoid multiple rows issue
        $sql = "SELECT u.u_id, u.u_lname, u.u_fname, u.u_mname
                FROM users_tbl u
                INNER JOIN users_info_tbl ui ON u.u_id = ui.u_id
                WHERE u.u_level = 3 AND ui.ui_section = (
                    SELECT ui_section FROM users_info_tbl WHERE u_id = $id LIMIT 1
                )";
    } 
	
	else {
        // Fetch all users with u_level=3 for levels 0 and 1
        $sql = "SELECT u.u_id, u.u_lname, u.u_fname, u.u_mname
                FROM users_tbl u
                WHERE u.u_level = 3";
    }
}

// Perform the query
if (!empty($sql)) {
    $result = $conn->query($sql);

    if ($result) {
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
                <h2>Students List</h2>
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
                                <td><a href="update_user.php?id=<?php echo $row["u_id"] ?>" class="action-link">Form 1</a></td>
                                <td><a href="view_form2_scad.php?u_id=<?php echo $row["u_id"] ?>" class="action-link">Form 2</a></td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>0 results</td></tr>";
                    }
                    ?>
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
