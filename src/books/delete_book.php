<?php

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
    echo '<script>alert("Can\'t delete this book, because there is at least one student who has borrowed this book !");</script>';
    // Redirect using JavaScript to go back 1 page
    echo '<script language="JavaScript" type="text/javascript">history.go(-1);</script>';
    // echo "<p style='text-align: center;'>Can't delete this book, because there is at least one student who has borrowed this book !</p>";
}

$conn->close();
?>
