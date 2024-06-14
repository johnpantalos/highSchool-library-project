<?php

// Database configuration and connection
include 'database_connection.php';

// Insert user into the database
$sql = "INSERT INTO Admins (name, username, password) VALUES ('admin', 'admin', 'admin')";

if ($conn->query($sql) === TRUE) 
{
    echo '<p style="text-align: center; color: white; font-weight:"> Admin account created successfully </p>';
    echo '<p style="text-align: center; color: white; font-weight:">Name: <b>admin</b> , Username: <b>admin</b> , password: <b>admin</b> </p>';
}
 else 
{
    echo '<p style="text-align: center; color: white; font-weight: bold;">Error: ' . $sql . '<br>' . $conn->error . '</p>';
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Create Admin account for testing</title>
</head>
<body>
    <main>
        <p style="text-align: center;"> <a href="../../index.php">Go Back</a> </p>
    </main>
</body>
</html>
