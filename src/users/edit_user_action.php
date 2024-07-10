<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Database configuration and connection
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Get user ID from URL
$id = $_GET['id'];

// Fetch user details
$sql = "SELECT * FROM students WHERE id='$id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update user details
    $sql = "UPDATE Students SET name='$name', username='$username', password='$password' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        
        // echo "<p style='text-align: center; color: black;'>Account changed successfully !</p>";
        echo '<script>alert("Account changed successfully !");</script>';
        // Redirect using JavaScript to go back 1 page
        echo '<script type="text/javascript">history.go(-1);</script>';
        exit();
    } else {
        echo '<script>alert("Error !");</script>';
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>