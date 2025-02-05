<?php

include 'links.php';
include 'connect.php'; // Include your database connection file

// Check if 'id' is set in $_SESSION
if (!isset($_SESSION['id'])) {
    // Handle case where 'id' is not set (redirect or display error)
    // For example:
    header("Location: login.php"); // Redirect to login page
    exit; // Ensure script stops execution after redirection
}

$u_id =isset($_GET['u_id']) ? (int)$_GET['u_id'] : null;

// Fetch batch and grade from users_info_tbl
$sqlUserInfo = "SELECT ui_batch, ui_grade FROM users_info_tbl WHERE u_id = '$u_id'";
$resultUserInfo = $conn->query($sqlUserInfo);

// Initialize variables to hold batch and grade
$batch = '';
$grade = '';

// Fetch batch and grade values if there are rows
if ($resultUserInfo->num_rows > 0) {
    $rowUserInfo = $resultUserInfo->fetch_assoc();
    $batch = isset($rowUserInfo['ui_batch']) ? $rowUserInfo['ui_batch'] : '';
    $grade = isset($rowUserInfo['ui_grade']) ? $rowUserInfo['ui_grade'] : '';
}

// Fetch inside clubs data
$sqlIn = "SELECT * FROM sin_clubs_tbl WHERE u_id = '$u_id'";
$resultIn = $conn->query($sqlIn);

// Fetch outside clubs data
$sqlOut = "SELECT * FROM sout_clubs_tbl WHERE u_id = '$u_id'";
$resultOut = $conn->query($sqlOut);

$sqlSpearhead = "SELECT * FROM spearhead_tbl WHERE u_id = '$u_id'";
$resultSpearhead = $conn->query($sqlSpearhead); 


$sqlUser = "SELECT u_lname, u_fname, u_mname FROM users_tbl WHERE u_id = '$u_id'";
$resultUser = $conn->query($sqlUser);

$fullName = '';
if ($resultUser->num_rows > 0) {
    $rowUser = $resultUser->fetch_assoc();
    $fullName = htmlspecialchars($rowUser['u_lname']) . ", " . 
                htmlspecialchars($rowUser['u_fname']) . " " . 
                htmlspecialchars($rowUser['u_mname']) . ".";
}

?>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>       
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
        
        body {
            font-family: 'Poppins';
        }
    </style>
</head>

<body>
    <form>
        <header>
            PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM <br> CAMPUS: Central Luzon <br> <br> SCALE PERSONAL INFORMATION SHEET
        </header>
        <br>
        <table>
            <tr>
                <td>Name: <?php echo $fullName; ?></td> 
            </tr>
        </table>
        <br>
        <table> 
            <tr>
                <td>Batch:</td>
                <td><?php echo htmlspecialchars($batch); ?></td>
                <td>Grade:</td>
                <td><?php echo htmlspecialchars($grade); ?></td>
            </tr>
        </table>
        <br>
        <table border="1">
            <tr>
                <td>Name of club/association joined in PSHS</td>
                <td width="250px">Position / designation</td>
                <td width="200px">Length of membership</td>
            </tr>
            <?php
            if ($resultIn->num_rows > 0) {
                while($rowIn = $resultIn->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo isset($rowIn["sin_name"]) ? htmlspecialchars($rowIn["sin_name"]) : ''; ?></td>
                        <td><?php echo isset($rowIn["sin_position"]) ? htmlspecialchars($rowIn["sin_position"]) : ''; ?></td>
                        <td><?php echo isset($rowIn["sin_length"]) ? htmlspecialchars($rowIn["sin_length"]) : ''; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }
            ?>
        </table>
        <br>
        <table border="1">
            <tr>
                <td>Name of club/association joined outside PSHS</td>
                <td width="200px">Position / designation</td>
                <td width="200px">Length of membership</td>
            </tr>
            <?php
            if ($resultOut->num_rows > 0) {
                while($rowOut = $resultOut->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo isset($rowOut["sout_name"]) ? htmlspecialchars($rowOut["sout_name"]) : ''; ?></td>
                        <td><?php echo isset($rowOut["sout_position"]) ? htmlspecialchars($rowOut["sout_position"]) : ''; ?></td>
                        <td><?php echo isset($rowOut["sout_length"]) ? htmlspecialchars($rowOut["sout_length"]) : ''; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='3'>0 results</td></tr>";
            }
            ?>
            
        </table>
        <br>
       <table border="1">
    <tr>
        <td>Sports you have played:</td>
        <td>Musical instruments that you have played:</td>
        <td>Arts and crafts you have skill in:</td>
        <td>Other hobbies/interests:</td>
    </tr>
    <?php
    // Fetch sports data
    $sqlSports = "SELECT * FROM sport_tbl WHERE u_id = '$u_id'";
    $resultSports = $conn->query($sqlSports);

    // Fetch instruments data
    $sqlInstruments = "SELECT * FROM instruments_tbl WHERE u_id = '$u_id'";
    $resultInstruments = $conn->query($sqlInstruments);

    // Fetch art data
    $sqlArt = "SELECT * FROM arts_tbl WHERE u_id = '$u_id'";
    $resultArt = $conn->query($sqlArt);

    // Fetch hobby data
    $sqlHobby = "SELECT * FROM hobbies_tbl WHERE u_id = '$u_id'";
    $resultHobby = $conn->query($sqlHobby);

    while ($rowSports = $resultSports->fetch_assoc()) {
        $sports[] = $rowSports["u_sport_name"];
    }
    while ($rowInstruments = $resultInstruments->fetch_assoc()) {
        $instrum[] = $rowInstruments["u_instrument_name"];
    }
    while ($rowArt = $resultArt->fetch_assoc()) {
        $art[] = $rowArt["u_arts_name"];
    }
    while ($rowHobby = $resultHobby->fetch_assoc()) {
        $hobby[] = $rowHobby["u_hobbies_name"];
    }
    ?>
    <tr>
        <td><?php echo implode(", ", $sports); ?></td>
        <td><?php echo implode(", ", $instrum); ?></td>
        <td><?php echo implode(", ", $art); ?></td>
        <td><?php echo implode(", ", $hobby); ?></td>
    </tr>
</table>

<br>
<table border="1" width="783px">   
    <tr>
        <td colspan="4">Activities that you are interested in learning about (could be a sport, art, music, skill, etc.):<br>
        <br><br><br><br></td>
    </tr>
    <?php
    // Fetch interest data
    $sqlInterest = "SELECT * FROM interests_tbl WHERE u_id = '$u_id'";
    $resultInterest = $conn->query($sqlInterest);

    while ($rowInterest = $resultInterest->fetch_assoc()) {
        $interest[] = $rowInterest["u_interests_name"];
    }
    ?>
    <tr>
        <td colspan="4"><?php echo implode(", ", $interest); ?></td>
    </tr>
</table>

<br>
<table border="1" width="783px">   
        <tr>
            <td colspan="4">Activities that you have spearheaded (give a brief description of each activity):<br>
            
			
			<?php
        if ($resultSpearhead->num_rows > 0) {
		?>
          
		  <table border = 1, width=100%>
		  <th> Activity Name</th>
		  <th> Description</th>
<?php				
			while($rowSpearhead = $resultSpearhead->fetch_assoc()) {
		?>
				<tr>
				<td>
		<?php		   echo $rowSpearhead["u_activities_name"];?>
				
				</td>
				<td>
				<?php		   echo $rowSpearhead["u_description"];?>
				</td>
				</tr>
		<?php
			}
		}
        ?>
    </tr>
</table>

<div style="text-align: center; margin-top: 20px;">
    <form method="post" action="form1_printable.php" target="_blank">
        <input type="hidden" name="u_id" value="<?php echo $id; ?>">
        <button type="submit">PRINT</button>
    </form>
    <a href="form1_printable.php?u_id=<?php echo $u_id; ?>" target="_blank">Open in New Tab</a>
</div>
</form>
</body>
</html>