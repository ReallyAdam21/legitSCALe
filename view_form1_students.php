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

$id = $_SESSION['id'];

// Fetch batch and grade from users_info_tbl
$sqlUserInfo = "SELECT ui_batch, ui_grade FROM users_info_tbl WHERE u_id = '$id'";
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
$sqlIn = "SELECT * FROM sin_clubs_tbl WHERE u_id = '$id'";
$resultIn = $conn->query($sqlIn);

// Fetch outside clubs data
$sqlOut = "SELECT * FROM sout_clubs_tbl WHERE u_id = '$id'";
$resultOut = $conn->query($sqlOut);

$sqlSpearhead = "SELECT * FROM spearhead_tbl WHERE u_id = '$id'";
$resultSpearhead = $conn->query($sqlSpearhead); 

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
            PHILIPPINE SCIENCE HIGH SCHOOL SYSTEM <br> CAMPUS: Central Luzon <br> <br> SCALE PROGRAM PROPOSAL FORM
        </header>
        <br>
        <table>
            <tr>
                <td>Name: <?php echo $_SESSION['lname'] . ", " . $_SESSION['fname'] . " " . $_SESSION['mname']?></td> 
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
            <tr>
                <td colspan="3"><a href="insert_inclub.php"><button type="button">ADD INSIDE CLUB</button></a></td>
            </tr>
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
            <tr>
                <td colspan="3"><a href="insert_outclub.php"><button type="button">ADD OUTSIDE CLUB</button></a></td>
            </tr>
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
    $sqlSports = "SELECT * FROM sport_tbl WHERE u_id = '$id'";
    $resultSports = $conn->query($sqlSports);

    // Fetch instruments data
    $sqlInstruments = "SELECT * FROM instruments_tbl WHERE u_id = '$id'";
    $resultInstruments = $conn->query($sqlInstruments);

    // Fetch art data
    $sqlArt = "SELECT * FROM arts_tbl WHERE u_id = '$id'";
    $resultArt = $conn->query($sqlArt);

    // Fetch hobby data
    $sqlHobby = "SELECT * FROM hobbies_tbl WHERE u_id = '$id'";
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
    <tr>
        <td><a href="insert_sport.php"><button type="button">ADD SPORT</button></a></td>
        <td><a href="insert_instrum.php"><button type="button">ADD INSTRUMENT</button></a></td>
        <td><a href="insert_art.php"><button type="button">ADD ART</button></a></td>
        <td><a href="insert_hobbies.php"><button type="button">ADD HOBBY</button></a></td>
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
    $sqlInterest = "SELECT * FROM interests_tbl WHERE u_id = '$id'";
    $resultInterest = $conn->query($sqlInterest);

    while ($rowInterest = $resultInterest->fetch_assoc()) {
        $interest[] = $rowInterest["u_interests_name"];
    }
    ?>
    <tr>
        <td colspan="4"><?php echo implode(", ", $interest); ?></td>
    </tr>
    <tr>
        <td colspan="4"><a href="insert_interests.php"><button type="button">ADD INTEREST</button></a></td>
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
		<td width=100%><a href="insert_spearhead.php"><button type="button">ADD ACTIVITIES</button></a></td>
    </tr>
</table>
</form>
</body>
</html>