<?php

// Database configuration and connection
include 'database_connection.php';


// Insert user into the database
$sql = "INSERT INTO Admins (username, password) VALUES ('admin', 'admin')";

if ($conn->query($sql) === TRUE) {
    echo '<p style="text-align: center;"> Admin account created successfully </p>';
    echo '<p style="text-align: center;"> Username: <b>admin</b> , password: <b>admin</b> </p>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Create Admin account for testing</title>
</head>
<body>
    <main>
        <p style="text-align: center;"> <a href="../../index.php">Go Back</a> </p>
    </main>
</body>
</html>
