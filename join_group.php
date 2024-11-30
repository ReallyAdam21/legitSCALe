<?php
session_start();
include 'connect.php';

$id = $_SESSION['id'] ?? null;

$isSubmit= isset($_POST['btnSubmit']) ? $_POST['btnSubmit'] : '';
$activityID = isset($_POST['txtActivityTitle']) ? $_POST['txtActivityTitle'] : '';
echo $activityID;
if ($_SERVER['REQUEST_METHOD']=='POST'){
	//check if the required fields are filled
	if ($isSubmit){
		$sql = "INSERT INTO activities_tbl ( m_a_id, a_title, a_description, a_strand_s, a_strand_c, a_strand_a, a_strand_l, a_type, a_start, a_end, a_submission, u_id, a_sa_name, a_status, a_sa_remarks, a_sa_date, u_subdate)
        Select  a_id, a_title, a_description, a_strand_s, a_strand_c, a_strand_a, a_strand_l, a_type, a_start, a_end, a_submission, ".$id.", a_sa_name, a_status, a_sa_remarks, a_sa_date, u_subdate 
		from activities_tbl
		WHERE a_id =".$activityID;


		if ($conn->query($sql) === TRUE) {
			echo "Added Successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
}
function getActivity (){
	global $conn; 
	global $activityID;
	global $id;
$sqlQueryActivity = "SELECT a_id, a_title FROM activities_tbl WHERE a_type ='G' AND u_id!=".$id;
$resultActivity = $conn->query($sqlQueryActivity);


$dropdown = '<select name = "txtActivityTitle" id = "txtActivityTitle" >';
$dropdown .= '<option value="">Select Activity</option>';

while ($row = $resultActivity->fetch_assoc()){
	$id =$row['a_id'];
	$activity_title = $row['a_title'];
	$selected = ($id== $activityID) ? 'selected' : '';
	$dropdown .= "<option value='$id' $selected>$activity_title</option>";
}
$dropdown.= '</select>';

return $dropdown;
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins';
        }
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
        }
        input[type="text"], input[type="date"], textarea, select {
            width: 100%;
            padding: 5px;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        input[type="submit"], input[type="button"] {
            padding: 10px 20px;
            margin: 10px 0;
        }
        input[type="button"] {
            background-color: #ccc;
            border: 1px solid #999;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <table border="1">
            <tr>
                <td>TITLE OF ACTIVITY:</td>
				<td><?php
				echo getActivity();
				?>
				</td>
            </tr>
            
            <tr>
                <td><input name = "btnSubmit" id= "btnSubmit" type="submit" value="SUBMIT"></td>
                <td><a href="view_form2_student.php"><input type="button" value="BACK"></a></td>
            </tr>
        </table>
    </form>
</body>
</html>