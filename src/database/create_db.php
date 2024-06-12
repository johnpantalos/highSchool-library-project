<?php

// Database configuration and connection
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password is empty
$dbname = "highschool_library";
// You can easily change these variables and work with your own login parameters

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo '<p style="text-align: center;"> Database created successfully </p>';
} else {
    echo '<p style="text-align: center;"> Database already exist or throw an error ' . $conn->error . '</p>';
}

// Select the database
$conn->select_db($dbname);

include 'create_tables.php';

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Create Database</title>
</head>
<body>
    <main>
        <p style="text-align: center;"> <a href="./index.php">Go Back</a> </p>
    </main>
</body>
</html>
