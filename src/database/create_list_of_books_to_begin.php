<?php

// Database configuration and connection
include 'database_connection.php';

// Insert user into the database
$sql = "INSERT INTO Books (title, author, copies_available) VALUES 
('Shahrukh Hussain', 'The widsom of mulla nasruddin', '1'), 
('Deepa Agarwal', 'The tricky tales of vikram and the veta', '2'),
('Anupa lal', 'Birbal the clever cduriter', '3'), 
('classic advanture', 'stories', '6'), 
('Anurima Chanda', 'As you like it', '8'), 
('Lasantha rodrigo', 'much ado about nothing', '2'), 
('R.L. Stine', 'Adhi raat ka hauwa', '5'), 
('R.L. Stine', 'Katputli ka badla', '6'), 
('R.L. Stine', 'shaitani khoon ka nashta', '2'), 
('R.L. Stine', 'Daba hua dar', '1'), 
('Guljar', 'Gopi gayen baga bayen', '0'), 
('Frizzle liz', 'The maguc school bus the wild leaf ride', '3'), 
('Frizzle liz', 'The magic school bus and the butterfly bunch', '5'),
('Frizzle liz', 'The magic school bus fixes a bone', '3'),
('Frizzle liz', 'The magic school bus whethers the storm', '10')";

// INSERT INTO EmailsRecebidos (De, Assunto, Data)
//    VALUES (@_DE, @_ASSUNTO, @_DATA)
//    WHERE NOT EXISTS ( SELECT * FROM EmailsRecebidos 
//                    WHERE title = @_DE
//                    AND author = @_ASSUNTO

if ($conn->query($sql) === TRUE) 
{
    echo '<p style="text-align: center;"> List of books created successfully </p>';

    // Fetch all Books created
    $sql = "SELECT * FROM Books";
    $result_books = $conn->query($sql);

    include '../books/show_available_books.php';
} 
else 
{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

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
