<?php
session_start();
// if (!isset($_SESSION['username'])) {
//     header("Location: login.html");
//     exit();
// }

// Database configuration and connection 
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Get user ID from URL
$book_id = intval($_GET['book_id']);

// Delete user
$sql = "DELETE FROM Books WHERE id='$book_id'";

if ($conn->query($sql) === TRUE) 
{
    // Redirect using JavaScript to go back 1 page
    echo '<script type="text/javascript"> window.history.go(-1); </script>';
    exit();
} 
else 
{
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
