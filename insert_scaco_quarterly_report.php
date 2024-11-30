<?php
session_start();
include 'connect.php';

$isSubmit= isset($_POST['btnSubmit']) ? $_POST['btnSubmit'] : '';
$title = isset($_POST['title_hidden']) ? $_POST['title_hidden'] : '';
$start = isset($_POST['start_hidden']) ? $_POST['start_hidden'] : '';
$end = isset($_POST['end_hidden']) ? $_POST['end_hidden'] : '';
$beneficiaries = isset($_POST['txtBeneficiaries']) ? $_POST['txtBeneficiaries'] : '';
$publicity = isset($_POST['txtPublicity']) ? $_POST['txtPublicity'] : '';
$remarks = isset($_POST['txtRemarks']) ? $_POST['txtRemarks'] : '';
if ($_SERVER['REQUEST_METHOD']=='POST'){
	//check if the required fields are filled

	
		if($isSubmit){
				$sql= "Select * from scale_coordinator_report_tbl WHERE a_title ='$title' AND a_implement_date_start='$start' AND a_implement_date_end ='$end'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
						$sqlUpdate ="UPDATE scale_coordinator_report_tbl set s_c_beneficiaries = ?, s_c_publicity = ?, s_c_remarks=? WHERE a_title =? AND a_implement_date_start=? AND a_implement_date_end=?";
						
						$stmt_update=$conn->prepare($sqlUpdate);
								$stmt_update->bind_param('ssssss', $beneficiaries, $publicity, $remarks, $title, $start, $end);
								
								if ($stmt_update->execute()){
									$message = "Record has been updated successfully";
								}else{
									$message = "Error updating record: " .$stmt_update->error;
								}		
				}else{
					$sqlInsert ="Insert into scale_coordinator_report_tbl (a_title, a_implement_date_start, a_implement_date_end, s_c_beneficiaries, s_c_publicity, s_c_remarks )
								Values (?, ?, ?, ?, ?, ?)
					";
						
						$stmt_insert=$conn->prepare($sqlInsert);
								$stmt_insert->bind_param('ssssss', $title, $start, $end, $beneficiaries, $publicity, $remarks);
								
								if ($stmt_insert->execute()){
									$message = "Record has been updated successfully";
								}else{
									$message = "Error updating record: " .$stmt_insert->error;
								}		
					}
		}
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
                
            </tr>
            
            <tr>
                <td>TITLE OF ACTIVITY:</td>
                <td><?php echo isset ($_GET["a_title"])? $_GET["a_title"]:'' ?></td>
            </tr>
            <tr>
                <td>Beneficiaries:</td>
                <td>
                    <textarea name="txtBeneficiaries" rows="4" cols="50" required></textarea>
                </td>
            </tr>
            
            </tr>
            <tr>
                <td>Form of publicity/ reporting:</td>
                <td>
                    <textarea name="txtPublicity" rows="4" cols="50" required></textarea>
                </td>
            </tr>
			<tr>
                <td>Remarks:</td>
                <td>
                    <textarea name="txtRemarks" rows="4" cols="50" required></textarea>
                </td>
            </tr>
            <tr>
                <td><input name="btnSubmit" id="btnSubmit" type="submit" value="SUBMIT"></td>
                <td><a href="view_scaco_quarterly_report_form.php"><input type="button" value="BACK"></a></td>
            </tr>
        </table>
		<input type="hidden" id="title_hidden" name="title_hidden" value="<?php echo isset ($_GET['a_title'])? $_GET['a_title']:''?>" >
		<input type="hidden" id="start_hidden" name="start_hidden" value="<?php echo isset ($_GET['start_date'])? $_GET['start_date']:''?>" >
		<input type="hidden" id="end_hidden" name="end_hidden" value="<?php echo isset ($_GET['end_date'])? $_GET['end_date']:''?>" >
    </form>
</body>
</html>