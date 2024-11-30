<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'];


function getActivityCount($conn, $id) {
    $sqlCountActivities = "SELECT COUNT(a_id) as activity_count FROM activities_tbl WHERE u_id = '$id'";
    $resultCount = $conn->query($sqlCountActivities);

    if ($resultCount->num_rows > 0) {
        $rowCount = $resultCount->fetch_assoc();
        return $rowCount['activity_count'];
    }
    return 0;
}
// Count the number of activities the student already has
$activityCount = getActivityCount($conn, $id);

// Fetch activities for the current user
$sqlActivities = "SELECT * FROM activities_tbl WHERE u_id = '$id'";
$resultActivities = $conn->query($sqlActivities);

// Initialize variables for adviser name and submission date
$adviserName = '';
$subDate = '';

// Fetch adviser's name with u_level 2
$sqlAdviser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_level = 2 LIMIT 1";
$resultAdviser = $conn->query($sqlAdviser);

$studentName = htmlspecialchars($_SESSION['lname'] . ", " . $_SESSION['fname'] . " " . $_SESSION['mname']);

if ($resultAdviser->num_rows > 0) {
    $rowAdviser = $resultAdviser->fetch_assoc();
    $adviserName = $rowAdviser['u_lname'] . ' ' . $rowAdviser['u_fname'] . ' ' . $rowAdviser['u_mname'];
}

// Fetch submission date (assuming it's stored in activities_tbl for the user)
$sqlSubmissionDate = "SELECT u_subdate FROM activities_tbl WHERE u_id = '$id' LIMIT 1";
$resultSubmissionDate = $conn->query($sqlSubmissionDate);

if ($resultSubmissionDate->num_rows > 0) {
    $rowSubmissionDate = $resultSubmissionDate->fetch_assoc();
    $subDate = $rowSubmissionDate['u_subdate'];
}
$remarks = "SELECT a_sa_remarks, a_status FROM activities_tbl WHERE u_id ='$id' limit 1";
$resultRemarks = $conn->query($remarks);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
         body{
            font-family: 'Poppins';
        }
        #pshs{
            border-left:none; border-right:none; border-top:none;
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
        header{
            text-align:center;
        }
        th{
            font-size: 15px;
        }
        #toptags{
            border-left:none; border-right:none; border-top:none;
        }
        #eminem{
            border-left:none; border-right:none; border-top:none; width:250px; text-align: center; margin-right:50px;
        }
        #drake{
            border-left:none; border-right:none; border-top:none; width:150px; text-align: center;
        }
        #kendrick{
            border-left:none; border-right:none; border-top:none; width:275px; text-align: center;
        }
    </style>
</head>
<?php include 'links.php'; ?>
<body>
    <form method="POST" target="_blank" action="report.php">
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
                <td><?php echo htmlspecialchars($adviserName); ?></td>
            </tr>
            <tr>
                <th>Date of Submission:</th>
                <td><?php echo htmlspecialchars($subDate); ?></td>
            </tr>
        </table>
        <br>
        <table border="2px"  height="50px">
            <tr>
                <th width="300px" rowspan="2" colspan="2">Title of Activity</th>
                <td width="100px" rowspan="2">Description</td>
                <th width="75px" rowspan="2">Strand <sup>1</sup></th>
                <th width="75px" rowspan="2">Type <sup>2</sup></th>
                <th width="300px" colspan="2">Target Schedule(mm-yyyy)</th>
				<th></th>
				
            </tr>
            <tr>
                <th>Start</th>
                <th>End</th>
            </tr>
            <?php
            if ($resultActivities->num_rows > 0) {
                while($row = $resultActivities->fetch_assoc()) {
            ?>
                <tr>
                    <th height="30px"></th>
                    <td><?php echo htmlspecialchars($row["a_title"]); ?></td>
                    <td><?php echo htmlspecialchars($row["a_description"]); ?></td>
                    <td>
    <?php
    $strands = array();
    if ($row["a_strand_s"]) $strands[] = "S";
    if ($row["a_strand_c"]) $strands[] = "C";
    if ($row["a_strand_a"]) $strands[] = "A";
    if ($row["a_strand_l"]) $strands[] = "L";
    echo implode(" ", $strands);
    ?>
</td>
                    <td><?php echo htmlspecialchars($row["a_type"]); ?></td>
                    <td><?php echo htmlspecialchars($row["a_start"]); ?></td>
                    <td><?php echo htmlspecialchars($row["a_end"]); ?></td>
                    <td><a href ="delete_activities.php?a_id=<?php echo htmlspecialchars($row["a_id"]); ?>">Delete</a></td>
					
            <?php
                }
            } else {
                echo "<tr><td colspan='7'>0 results</td></tr>";
            }
            ?>
            <!-- Display "Add" button if activity count is less than 5 -->
            <?php if ($activityCount < 5) { ?>
                <tr>
                    <td colspan="8"><a href="insert_form2.php"><input type="button" value="ADD"></a></td>
                </tr>
				<tr>
                    <td colspan="8"><a href="join_group.php"><input type="button" value="Join"></a></td>
                </tr>
            <?php } ?>
        </table>
		
		 <?php
            if ($resultRemarks->num_rows > 0) {
                $row = $resultRemarks->fetch_assoc();

				
			}
            ?>
        <p><sup>1 </sup>S = Service, C = Creativity, A = Action, L = Leadership<br> <sup>2 </sup>I = Individual, G = Group</p>
        <br><br><br>
        <p>Appropriate Action: <input type="checkbox" name="Approved" disabled class="profileStyle" <?php echo $row["a_status"]=="Approved"? 'checked':''?>> Approved</p>
        <p><input type="checkbox" name="For Revision" disabled class="profileStyle" style="margin-left: 162px;" <?php echo $row["a_status"]=="For Revision"? 'checked':''?>> For Revision</p>
        <br><br><br>
		 Remarks:
		<?php echo htmlspecialchars($row["a_sa_remarks"]); ?>
			
			
		
        <p><b>Reviewed by: </b>Name and Signature of SCALE Adviser      <b>     Date Reviewed: </b>Date</p>
        <br><br>
        <p><b>Noted by: </b>Name and Signature of SCALE Coordinator</p>
        <br><br><br>
		
		<a href="form2_printable.php"><input type="submit" name="btnSubmit" id="btnSubmit">PRINT</a>
    </form>
</body>
</html>

