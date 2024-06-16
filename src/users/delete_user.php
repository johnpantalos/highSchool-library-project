<?php
session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: login.html");
//     exit();
// }

// Database configuration and connection 
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Get user ID from URL
$id = intval($_GET['id']);

// Delete user
$sql = "DELETE FROM Students WHERE id='$id'";

if ($conn->query($sql) === TRUE) 
{
    // Redirect using JavaScript to go back 1 page
    echo '<script type="text/javascript"> window.history.go(-1); </script>';
    exit();
} 
else 
{
    echo '<script>alert("Can\'t delete this student, because he has borrowed books !");</script>';
    echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
    // echo "<p style='text-align: center;'>Can't delete this student, because he has borrowed books !</p>";
}

$conn->close();
?>
