<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'];

// Fetch current user's information including first name and u_level
$sqlCurrentUser = "SELECT users_info_tbl.*, users_tbl.u_fname, users_tbl.u_level 
                   FROM users_info_tbl 
                   INNER JOIN users_tbl ON users_info_tbl.u_id = users_tbl.u_id 
                   WHERE users_info_tbl.u_id = $id";
$resultCurrentUser = $conn->query($sqlCurrentUser);

if ($resultCurrentUser && $resultCurrentUser->num_rows > 0) {
    $rowCurrentUser = $resultCurrentUser->fetch_assoc();
    $section = $rowCurrentUser['ui_section'];
    $position = $rowCurrentUser['ui_position'];
    $firstName = $rowCurrentUser['u_fname'];
    $userLevel = $rowCurrentUser['u_level']; // Fetch the user's level
} else {
    die("User not found.");
}

// Determine the link for Form 1 based on user's u_level
function getForm1Link($userLevel, $userId) {
    if ($userLevel == 3) {
        return "view_form1_students.php?id=$userId";
    } elseif ($userLevel == 2) {
        return "view_form1_scad.php?id=$userId";
    } else {
        return "#"; // Handle other cases or errors
    }
}

// Determine the link for Form 2 based on user's u_level
function getForm2Link($userLevel, $userId) {
    if ($userLevel == 3) {
        return "view_form2_student.php?id=$userId";
    } elseif ($userLevel == 2) {
        return "view_form2_scad.php?id=$userId";
    } else {
        return "#"; // Handle other cases or errors
    }
}

function getForm3Link($userLevel, $userId) {
    if ($userLevel == 3) {
        return "view_form3_students.php?id=$userId";
    } elseif ($userLevel == 2) {
        return "view_form3_scad.php?id=$userId";
    } else {
        return "#"; // Handle other cases or errors
    }
}
// Fetch users based on current user's section and position, including the same u_id
$sqlUsers = "SELECT users_tbl.u_id, users_tbl.u_lname, users_tbl.u_fname, users_tbl.u_mname, users_tbl.u_level, users_info_tbl.ui_batch, users_info_tbl.ui_grade, users_info_tbl.ui_section, users_info_tbl.ui_position 
             FROM users_tbl 
             INNER JOIN users_info_tbl ON users_tbl.u_id = users_info_tbl.u_id 
             WHERE users_info_tbl.ui_section = '$section' AND users_tbl.u_id = '$id'";

$resultUsers = $conn->query($sqlUsers);
?>
<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 50px;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            color: #0066cc;
            text-decoration: underline;
        }

        .home-button {
            display: block;
            width: 100px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .home-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($firstName); ?></h1>

    <a href="dashboard.php" class="home-button">Home</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Fullname</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php
        if ($resultUsers && $resultUsers->num_rows > 0) {
            while ($rowUser = $resultUsers->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($rowUser['u_id']); ?></td>
                    <td><?php echo htmlspecialchars($rowUser['u_lname'] . ", " . $rowUser['u_fname'] . " " . $rowUser['u_mname']); ?></td>
                    <td><a href="<?php echo getForm1Link($rowUser['u_level'], $rowUser['u_id']); ?>">FORM1</a></td>
                    <td><a href="<?php echo getForm2Link($rowUser['u_level'], $rowUser['u_id']); ?>">FORM2</a></td>
                    <td><a href="<?php echo getForm3Link($rowUser['u_level'], $rowUser['u_id']); ?>">FORM3</a></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='5'>No results found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
