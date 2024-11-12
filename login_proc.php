<?php
session_start();
include 'connect.php';
// Example of setting $_SESSION["level"] after successful login
$_SESSION["level"] = $user_level_from_database; // Assign the appropriate user level here

$email = $_POST['txtEmail'];
$pword = $_POST['txtPword'];

$sql = "SELECT * FROM users_tbl WHERE u_email = '$email'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    if ($email == $row['u_email'] && $pword == $row['u_pword']) {
        $_SESSION["id"] = $row['u_id'];
        $_SESSION["lname"] = $row['u_lname'];
        $_SESSION["fname"] = $row['u_fname'];
        $_SESSION["mname"] = $row['u_mname'];
        $_SESSION["email"] = $row['u_email'];
        $_SESSION["level"] = $row['u_level'];
?>
        <script>
          alert("Login Successful");
          location.replace("dashboard.php");
        </script>
<?php
    } else {
?>
        <script>
          alert("Incorrect password");
          location.replace("index.php");
        </script>
<?php
    }
} else {
?>
    <script>
      alert("User not found");
      location.replace("index.php");
    </script>
<?php
}
?>