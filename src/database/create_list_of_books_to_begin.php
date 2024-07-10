<?php

// Database configuration and connection
include 'database_connection.php';

// Insert user into the database
$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'The tricky tales of vikram and the veta', 'Deepa Agarwal',2
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'The tricky tales of vikram and the veta')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available)
SELECT 'The magic school bus weathers the storm', 'Frizzle Liz', 10
WHERE NOT EXISTS (
    SELECT 1 
    FROM books 
    WHERE title = 'The magic school bus weathers the storm'
)";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'Birbal the clever cduriter', 'Anupa lal', 3
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'Birbal the clever cduriter')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'stories', 'classic advanture', 6
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'stories')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'As you like it', 'Anurima Chanda', 8
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'As you like it')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'much ado about nothing', 'Lasantha rodrigo', 2
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'much ado about nothing')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'Adhi raat ka hauwa', 'R.L. Stine', 5
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'Adhi raat ka hauwa')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'shaitani khoon ka nashta', 'R.L. Stine',  2
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'shaitani khoon ka nashta')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'Daba hua dar', 'R.L. Stine', 1
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'Daba hua dar')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'Gopi gayen baga bayen', 'Guljar', ' 0
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'Gopi gayen baga bayen')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'The maguc school bus the wild leaf ride', 'Frizzle liz', 3
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'The maguc school bus the wild leaf ride')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'The magic school bus and the butterfly bunch', 'Frizzle liz', 5
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'The magic school bus and the butterfly bunch')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'The magic school bus fixes a bone', 'Frizzle liz', 3
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'The magic school bus fixes a bone')";
$conn->query($sql);

$sql = "INSERT INTO books (title, author, copies_available) 
SELECT 'The magic school bus whethers the storm', 'Frizzle liz', 10
WHERE NOT EXISTS (
SELECT 1
FROM books 
WHERE title = 'The magic school bus whethers the storm')";

if ($conn->query($sql) === TRUE) 
{
    echo '<p style="text-align: center; color: white; font-weight: bold;"> List of books created successfully </p>';

    // Fetch all books created
    $sql = "SELECT * FROM books";
    $result_books = $conn->query($sql);

    // include '../books/show_available_books.php';
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Create a list of books for testing</title>
</head>
<body>
    <main>
        <p style="text-align: center;"> <a href="../../index.php">Go Back</a> </p>
    </main>
</body>
</html>
