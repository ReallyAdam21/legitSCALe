<?php
session_start();
include 'connect.php';

// Check if the necessary session variables are set
$id = $_SESSION['id'] ?? null;
$lname = $_SESSION['lname'] ?? '';
$fname = $_SESSION['fname'] ?? '';
$mname = $_SESSION['mname'] ?? '';

// Fetch adviser's name for the user
$sqlAdviser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_level = 2 LIMIT 1";
$resultAdviser = $conn->query($sqlAdviser);

$adviserName = '';
if ($resultAdviser->num_rows > 0) {
    $rowAdviser = $resultAdviser->fetch_assoc();
    $adviserName = htmlspecialchars($rowAdviser['u_lname'] . ' ' . $rowAdviser['u_fname'] . ' ' . $rowAdviser['u_mname']);
}

// Fetch student's name
$studentName = htmlspecialchars($lname . ", " . $fname . " " . $mname);

// Fetch submission date, status, and adviser remarks if available
$subDate = '';
$remarks = '';
$sqlSubmission = "SELECT u_subdate, a_status, a_sa_remarks FROM activities_tbl WHERE u_id = '$id' LIMIT 1";
$resultSubmission = $conn->query($sqlSubmission);

if ($resultSubmission->num_rows > 0) {
    $rowSubmission = $resultSubmission->fetch_assoc();
    $subDate = htmlspecialchars($rowSubmission['u_subdate']);
    $remarks = htmlspecialchars($rowSubmission['a_sa_remarks']);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $comment = isset($_POST['comment']) ? htmlspecialchars($_POST['comment']) : '';

    if ($action == 'approve') {
        // Update status to approved in the database
        $sqlUpdate = "UPDATE activities_tbl SET a_status = 'Approved' WHERE u_id = '$id'";
        if ($conn->query($sqlUpdate) === TRUE) {
            header('Location: view_students.php');
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } elseif ($action == 'revision') {
        // Update status to for revision and add comment in the database
        $sqlUpdate = "UPDATE activities_tbl SET a_status = 'For Revision', a_sa_remarks = '$comment' WHERE u_id = '$id'";
        if ($conn->query($sqlUpdate) === TRUE) {
            header('Location: view_students.php');
            exit();
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCALE Individual Activity Plan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        form {
            background-color: white;
            border: 1px solid black;
            border-radius: 5px;
            padding: 20px;
            max-width: 800px;
            margin: 50px auto;
            height: 600px;
            overflow: auto;
        }
        header { text-align: center; }
        th { font-size: 15px; }
        .add-button { margin-top: 10px; display: block; }
    </style>
</head>
<body>
    <form action="submit_activity.php" method="post">
        <header>
            PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM<br>
            SCALE INDIVIDUAL ACTIVITY PLAN
        </header>

        <!-- Student and Adviser Info -->
        <table>
            <tr>
                <th>Name of Student:</th>
                <td><?php echo $studentName; ?></td>
            </tr>
            <tr>
                <th>Name of Adviser:</th>
                <td><?php echo htmlspecialchars($adviserName); ?></td>
            </tr>
            <tr>
                <th>Date of Submission:</th>
                <td><?php echo $subDate; ?></td>
            </tr>
            <tr>
                <th>Status:</th>
                <td><?php echo $remarks; ?></td>
            </tr>
            <tr>
                <th>Batch:</th>
                <td><input type="text" name="batch" /></td>
            </tr>
        </table>

        <!-- Activity Details -->
       <div class="section-title">Activity Details</div>
        <table>
            <tr>
                <th>Title of Activity:</th>
                <td><input type="text" name="activity_title" /></td>
            </tr>
            <tr>
                <th>Type of Activity:</th>
                <td>
                    <input type="radio" name="activity_type" value="Individual"> Individual
                    <input type="radio" name="activity_type" value="Group"> Group
                </td>
            </tr>
            <tr>
                <th>Strand:</th>
                <td>
                    <input type="checkbox" name="strand[]" value="Service"> Service
                    <input type="checkbox" name="strand[]" value="Action"> Action
                    <input type="checkbox" name="strand[]" value="Creativity"> Creativity
                    <input type="checkbox" name="strand[]" value="Leadership"> Leadership
                </td>
            </tr>
        </table>

        <!-- Objectives -->
        <div class="section-title">Objectives</div>
        <table>
            <tr>
                <th><input type="checkbox" name="objective[]" value="Increased awareness"> Increased awareness of strengths</th>
            </tr>
            <tr>
                <th><input type="checkbox" name="objective[]" value="Undertaken challenges"> Undertaken new challenges</th>
            </tr>
        </table>

        <!-- Planning and Implementation Dates -->
        <div class="section-title">Planning and Implementation Dates</div>
        <table>
            <tr>
                <th>Planning Dates (Start-End):</th>
                <td><input type="date" name="planning_start" /> to <input type="date" name="planning_end" /></td>
            </tr>
            <tr>
                <th>Implementation Dates (Start-End):</th>
                <td><input type="date" name="implementation_start" /> to <input type="date" name="implementation_end" /></td>
            </tr>
            <tr>
                <th>Venue:</th>
                <td><input type="text" name="venue" /></td>
            </tr>
        </table>

        <!-- Persons Involved -->
        <div class="section-title">Persons Involved</div>
        <table id="personsInvolved">
            <tr>
                <th>Adult Supervisor/Collaborator</th>
                <th>Designation/Position</th>
                <th>Company/Affiliation</th>
                <th>Contact Info</th>
            </tr>
            <?php
            // Query to get persons involved data
            $sqlPersons = "SELECT * FROM persons_tbl WHERE u_id = '$id'";
            $resultPersons = $conn->query($sqlPersons);
            if ($resultPersons->num_rows > 0) {
                while($rowPersons = $resultPersons->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_supervisor']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_designation']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_company']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowPersons['p_contact']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No persons added yet.</td></tr>";
            }
            ?>
        </table>
        <a href="insert_persons.php"><button type="button" class="add-button">Add Person</button></a>

        <!-- Materials Needed -->
        <div class="section-title">Materials and Resources Needed</div>
        <table id="materialsNeeded">
            <tr>
                <th>Qty</th>
                <th>Items</th>
                <th>Unit Cost</th>
                <th>Amount</th>
            </tr>
            <?php
            // Query to get materials data
            $sqlMaterials = "SELECT * FROM materials_tbl WHERE u_id = '$id'";
            $resultMaterials = $conn->query($sqlMaterials);
            if ($resultMaterials->num_rows > 0) {
                while($rowMaterials = $resultMaterials->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_qty']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_items']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_unit_cost']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowMaterials['m_amount']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No materials added yet.</td></tr>";
            }
            ?>
        </table>
        <a href="insert_materials.php"><button type="button" class="add-button">Add Material</button></a>

        <!-- Activity Risk Assessment -->
        <div class="section-title">Activity Risk Assessment</div>
        <table id="riskAssessment">
            <tr>
                <th>Potential Hazards</th>
                <th>Safety Precautions</th>
            </tr>
            <?php
            // Query to get risk assessment data
            $sqlRisks = "SELECT * FROM risks_tbl WHERE u_id = '$id'";
            $resultRisks = $conn->query($sqlRisks);
            if ($resultRisks->num_rows > 0) {
                while($rowRisks = $resultRisks->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($rowRisks['m_hazards']) . "</td>";
                    echo "<td>" . htmlspecialchars($rowRisks['m_precautions']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No risks added yet.</td></tr>";
            }
            ?>
        </table>
        <a href="insert_risks.php"><button type="button" class="add-button">Add Risk</button></a>

        
        <!-- Appropriate Action Section -->
        <p>Appropriate Action: 
            <label>
                <input type="radio" name="action" value="approve"> Approved
            </label>
            <label>
                <input type="radio" name="action" value="revision"> For Revision
            </label>
        </p>
        <p>If For Revision, please provide comments:</p>
        <textarea name="comment" rows="4" cols="50"></textarea>
        <br><br>
        
        <div class="action-buttons">
            <button type="submit">Submit</button>
        </div>
    </form>
</body>
</html>
