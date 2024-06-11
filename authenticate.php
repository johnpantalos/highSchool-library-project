<?php

// Database configuration and connection
include "database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

$username = $_POST['username'];
$password = $_POST['password'];

// Check Students table
$sql_student = "SELECT * FROM Students WHERE username='$username' AND password='$password'";
$result_student = $conn->query($sql_student);

if ($result_student->num_rows > 0) {
    // Student found
    $row = $result_student->fetch_assoc();
    header("Location: student_dashboard.php?id=" . $row['id']);
    exit();
}

// Check admins table
$sql_admin = "SELECT * FROM Admins WHERE username='$username' AND password='$password'";
$result_admin = $conn->query($sql_admin);

if ($result_admin->num_rows > 0) {
    // admin found
    $row = $result_admin->fetch_assoc();
    header("Location: admin_dashboard.php?id=" . $row['id']);
    exit();
}

// If no user found
echo "Invalid email or password";

$conn->close();
?>
