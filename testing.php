<?php
session_start();
include 'connect.php';

// Assuming student ID and user info are stored in session
$id = $_SESSION['id'];

// Fetch adviser's name
$sqlAdviser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_level = 2 LIMIT 1";
$resultAdviser = $conn->query($sqlAdviser);
$adviserName = $resultAdviser->num_rows > 0
    ? $resultAdviser->fetch_assoc()['u_lname'] . " " . $resultAdviser->fetch_assoc()['u_fname'] . " " . $resultAdviser->fetch_assoc()['u_mname']
    : '';

// Fetch submission date
$sqlSubmissionDate = "SELECT u_subdate FROM activities_tbl WHERE u_id = '$id' LIMIT 1";
$resultSubmissionDate = $conn->query($sqlSubmissionDate);
$subDate = $resultSubmissionDate->num_rows > 0
    ? $resultSubmissionDate->fetch_assoc()['u_subdate']
    : '';

// Fetch activities dynamically
$sqlActivities = "SELECT * FROM activities_tbl WHERE u_id = '$id'";
$resultActivities = $conn->query($sqlActivities);

// Fetch remarks and status
$sqlRemarks = "SELECT a_sa_remarks, a_status FROM activities_tbl WHERE u_id = '$id' LIMIT 1";
$resultRemarks = $conn->query($sqlRemarks);
$remarksData = $resultRemarks->num_rows > 0 ? $resultRemarks->fetch_assoc() : ['a_sa_remarks' => '', 'a_status' => ''];

// Fetch user details for header
$studentName = htmlspecialchars($_SESSION['lname'] . ", " . $_SESSION['fname'] . " " . $_SESSION['mname']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f9f9f9; margin: 0; padding: 0; }
        form {
            background-color: white;
            border: 1px solid #000;
            border-radius: 5px;
            padding: 20px;
            max-width: 1000px;
            margin: 50px auto;
            height: auto;
        }
        header {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        p { margin: 15px 0; }
    </style>
    <title>Scale Program Proposal Form</title>
</head>
<body>
    <form method="POST" action="report.php" target="_blank">
        <header>
            PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM<br>
            CAMPUS: Philippine Science High School<br><br>
            SCALE PROGRAM PROPOSAL FORM
        </header>
        <table>
            <tr>
                <th>Name:</th>
                <td colspan="2"><?php echo $studentName; ?></td>
            </tr>
            <tr>
                <th>Name of Adviser:</th>
                <td colspan="2"><?php echo htmlspecialchars($adviserName); ?></td>
            </tr>
            <tr>
                <th>Date of Submission:</th>
                <td colspan="2"><?php echo htmlspecialchars($subDate); ?></td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Title of Activity</th>
                    <th rowspan="2">Description</th>
                    <th rowspan="2">Strand</th>
                    <th rowspan="2">Type</th>
                    <th colspan="2">Target Schedule (mm-yyyy)</th>
                    <th rowspan="2">Actions</th>
                </tr>
                <tr>
                    <th>Start</th>
                    <th>End</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultActivities->num_rows > 0): ?>
                    <?php while ($row = $resultActivities->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['a_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['a_description']); ?></td>
                            <td><?php
                                $strands = [];
                                if ($row['a_strand_s']) $strands[] = 'S';
                                if ($row['a_strand_c']) $strands[] = 'C';
                                if ($row['a_strand_a']) $strands[] = 'A';
                                if ($row['a_strand_l']) $strands[] = 'L';
                                echo implode(', ', $strands);
                            ?></td>
                            <td><?php echo htmlspecialchars($row['a_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['a_start']); ?></td>
                            <td><?php echo htmlspecialchars($row['a_end']); ?></td>
                            <td><a href="delete_activities.php?a_id=<?php echo htmlspecialchars($row['a_id']); ?>">Delete</a></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No activities found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <p><strong>Remarks:</strong> <?php echo htmlspecialchars($remarksData['a_sa_remarks']); ?></p>
        <p>
            <strong>Status:</strong><br>
            <input type="checkbox" disabled <?php echo $remarksData['a_status'] === 'Approved' ? 'checked' : ''; ?>> Approved<br>
            <input type="checkbox" disabled <?php echo $remarksData['a_status'] === 'For Revision' ? 'checked' : ''; ?>> For Revision
        </p>
        <p>
            <strong>Reviewed by:</strong> Name and Signature of SCALE Adviser<br>
            <strong>Date Reviewed:</strong> ___________________________
        </p>
        <p>
            <strong>Noted by:</strong> Name and Signature of SCALE Coordinator
        </p>
        <button type="submit">Print</button>
    </form>
</body>
</html>
