<?php
session_start();

include '../database/database_connection.php';


if (!isset($_SESSION['first_load'])) {
    // This is the first load
    $_SESSION['first_load'] = true;
    
    // Reload the page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


// Fetch all Books created
$sql = "SELECT * FROM Books";
$result_books = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link rel="stylesheet" href="../css/style.css">
        <style type="text/css">
            html {
                background-image: none;
            }
        </style>

</head>
<body>
    <div class="container-fluid">

        <table border='1' style='margin-left: auto; margin-right: auto; width:100%;'>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Copies Available</th>
                <th>Actions</th>
            </tr>
            <?php 
                if ($result_books->num_rows > 0) 
                { 
                    while($row = $result_books->fetch_assoc()) 
                    { 
                        echo "<tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['title'] . "</td>
                                <td>" . $row['author'] . "</td>
                                <td>" . $row['copies_available'] . "</td>
                                <td>
                                    <a href='./delete_book.php?book_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a> |
                                    <a href='./admin_borrow_book_for_student.php?book_id=" . $row['id']."'>Borrow For A Student</a> 
                                </td>
                            </tr>";
                    }
                } 
                else 
                {
                    echo "<p style='text-align: center; color: black;'>No books found !</p>";
                }

            ?>
        </table>
    </div>

</body>
</html>
<!-- DONE -->
 