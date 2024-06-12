<?php

// Database configuration and connection
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    // Get POST data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $copies_available = $_POST['copies_available'];
}

// Insert user into the database
$sql = "INSERT INTO Books (title, author, copies_available) VALUES ('$title', '$author' , '$copies_available')";

if ($conn->query($sql) === TRUE) 
{
    // Redirect two pages back
    echo '<script language="JavaScript" type="text/javascript">history.go(-2);</script>';
    exit();
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

exit();
?>
