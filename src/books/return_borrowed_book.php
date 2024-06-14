<?php

// Database configuration
include "../database/database_connection.php"; // Defines the variables :  $servername, $username, $password, $dbname

// Get user ID from URL
$id = $_GET['id'];

// Fetch borrowed book details
$sql = "SELECT * FROM BorrowRecords WHERE id='$id'";
$result_bor_book = $conn->query($sql);
$borr_book = null;
if($result_bor_book->num_rows > 0) $borr_book = $result_bor_book->fetch_assoc();

// Get current date 
$currentDateTime = new DateTime('now'); 
$currentDate = $currentDateTime->format('Y-m-d'); 
// Update details
$sql = "UPDATE BorrowRecords SET return_date='$currentDate' WHERE id='$id'";

if ($conn->query($sql) === TRUE) 
{
    $book_id = $borr_book['book_id'];

    // Fetch borrowed book details
    $sql_b = "SELECT * FROM Books WHERE id='$book_id'";
    $result_book = $conn->query($sql_b);
    if($result_book->num_rows > 0) $book = $result_book->fetch_assoc();

    $updated_copies = intval($book['copies_available']) + 1;
    $sql_bb = "UPDATE Books SET copies_available='$updated_copies' WHERE id='$book_id'";

    if ($conn->query($sql_bb) === TRUE) 
    {
        // Redirect using JavaScript to go back 2 pages
        // echo '<script type="text/javascript"> window.history.go(-2); </script>';
        echo "<p style='text-align: center;'>Book successfully returned !</p>";
        exit();
    }
    else
    {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();

exit();
?>
<!-- DONE -->
