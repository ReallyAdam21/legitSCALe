<?php
session_start();
include 'connect.php';

// Check if the u_id is provided via GET or POST (assuming it's passed from a previous page)
if (isset($_GET['u_id'])) {
    $u_id = $_GET['u_id'];
} else {
    // Redirect or handle error if u_id is not provided
    header('Location: error.php');
    exit();
}

// Fetch activities for the specified user
$sqlActivities = "SELECT * FROM activities_tbl WHERE u_id = '$u_id'";
$resultActivities = $conn->query($sqlActivities);

// Initialize variables for adviser name and submission date
$adviserName = '';
$subDate = '';
$studentName = '';

// Fetch student name from the users_tbl (assuming it's linked with activities_tbl)
$sqlStudent = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_id = '$u_id'";
$resultStudent = $conn->query($sqlStudent);

if ($resultStudent->num_rows > 0) {
    $rowStudent = $resultStudent->fetch_assoc();
    $studentName = htmlspecialchars($rowStudent['u_lname'] . ', ' . $rowStudent['u_fname'] . ' ' . $rowStudent['u_mname']);
}

// Fetch adviser's name with u_level 2
$sqlAdviser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_level = 2 LIMIT 1";
$resultAdviser = $conn->query($sqlAdviser);

if ($resultAdviser->num_rows > 0) {
    $rowAdviser = $resultAdviser->fetch_assoc();
    $adviserName = htmlspecialchars($rowAdviser['u_lname'] . ' ' . $rowAdviser['u_fname'] . ' ' . $rowAdviser['u_mname']);
}

// Fetch submission date from activities_tbl for the specific user
$sqlSubmissionDate = "SELECT u_subdate FROM activities_tbl WHERE u_id = '$u_id' LIMIT 1";
$resultSubmissionDate = $conn->query($sqlSubmissionDate);

if ($resultSubmissionDate->num_rows > 0) {
    $rowSubmissionDate = $resultSubmissionDate->fetch_assoc();
    $subDate = htmlspecialchars($rowSubmissionDate['u_subdate']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';

    if ($action == 'approve') {
        // Update status to approved in the database
        $sqlUpdate = "UPDATE activities_tbl SET a_status = 'Approved' WHERE u_id = '$u_id'";
        if ($conn->query($sqlUpdate) === TRUE) {
            // Redirect to a confirmation or success page
            header('Location: success.php');
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif ($action == 'revision') {
        // Update status to for revision and add comment in the database
        $sqlUpdate = "UPDATE activities_tbl SET a_status = 'For Revision', a_comment = '$comment' WHERE u_id = '$u_id'";
        if ($conn->query($sqlUpdate) === TRUE) {
            // Redirect to a confirmation or success page
            header('Location: revision.php');
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Styles and other head elements -->
    <style>
        body {
            font-family: 'Poppins';
        }
        form {
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            margin-top: 50px;
            height: 600px;
            overflow: auto;
        }
        header {
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="post">
        <header>
            PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM <br> CAMPUS: Philippine Science High School <br> <br> SCALE PROGRAM PROPOSAL FORM
        </header>
        <table>
            <tr>
                <th style="text-align: right;">Name: </th>
                <td><?php echo $studentName; ?></td>
            </tr>
            <tr>
                <th>Name of Adviser:</th>
                <td><?php echo $adviserName; ?></td>
            </tr>
            <tr>
                <th>Date of Submission:</th>
                <td><?php echo $subDate; ?></td>
            </tr>
        </table>
        <br>
        <table border="2px" height="50px">
            <tr>
                <th width="300px" rowspan="2" colspan="2">Title of Activity</th>
                <td width="100px" rowspan="2">Description</td>
                <th width="75px" rowspan="2">Strand <sup>1</sup></th>
                <th width="75px" rowspan="2">Type <sup>2</sup></th>
                <th width="300px" colspan="2">Target Schedule(mm-yyyy)</th>
            </tr>
            <tr>
                <th>Start</th>
                <th>End</th>
            </tr>
            <?php
            if ($resultActivities->num_rows > 0) {
                while ($row = $resultActivities->fetch_assoc()) {
            ?>
                    <tr>
                        <th height="30px"></th>
                        <td><?php echo htmlspecialchars($row["a_title"]); ?></td>
                        <td><?php echo htmlspecialchars($row["a_description"]); ?></td>
                        <td><?php echo htmlspecialchars($row["a_strand_s"] . " " . $row["a_strand_c"] . " " . $row["a_strand_a"] . " " . $row["a_strand_l"]); ?></td>
                        <td><?php echo htmlspecialchars($row["a_type"]); ?></td>
                        <td><?php echo htmlspecialchars($row["a_start"]); ?></td>
                        <td><?php echo htmlspecialchars($row["a_end"]); ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>0 results</td></tr>";
            }
            ?>
            <tr>
                <td colspan="7"><a href="insert_form2.php"><input type="button" value="ADD"></a></td>
            </tr>
        </table>
        <p><sup>1</sup> S = Service, C = Creativity, A = Action, L = Leadership<br><sup>2</sup> I = Individual, G = Group</p>
        <br>
        <p>Appropriate Action: 
            <label>
                <input type="radio" name="action" value="approve" class="profileStyle"> Approved
            </label>
            <label>
                <input type="radio" name="action" value="revision" class="profileStyle"> For Revision
            </label>
        </p>
        <p>If For Revision, please provide comments:</p>
        <textarea name="comment" rows="4" cols="50"></textarea>
        <br><br>
        <input type="submit" value="Submit">
        <br><br>
        <p><b>Reviewed by: </b>Name and Signature of SCALE Adviser      <b>     Date Reviewed: </b>Date</p>
        <br><br>
        <p><b>Noted by: </b>Name and Signature of SCALE Coordinator</p>
        <br><br><br>
    </form>
</body>
</html>


