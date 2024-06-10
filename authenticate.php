<?php

// Database configuration
include "database_config.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Check Students table
$sql_student = "SELECT * FROM Students WHERE username='$username' AND password='$password'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    // Student found
    header("Location: student_dashboard.php");
    exit();
}

// Check admins table
$sql_admin = "SELECT * FROM GramUsers WHERE username='$username' AND password='$password'";
$result_admin = $conn->query($sql_admin);

if ($result_admin->num_rows > 0) {
    // admin found
    header("Location: admin_dashboard.php");
    exit();
}

// If no user found
echo "Invalid email or password";

$conn->close();
?>
