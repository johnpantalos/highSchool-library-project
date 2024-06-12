<?php

include '../database/database_connection.php';

// // Check if the page has been reloaded
// if (!isset($_SESSION['reloaded'])) 
// {
//     $_SESSION['reloaded'] = true;
//     // Embed JavaScript to reload the page on load (helps showing the changes when edit users)
//     echo '<script type="text/javascript"> location.reload(); </script>';
// } 
// else 
// {
//     // Unset the session variable to avoid infinite loop
//     unset($_SESSION['reloaded']);
// }

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

</head>
<body>
        <table border='1' style='margin-left: auto; margin-right: auto;'>
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
                                <a href='./admin_borrow_book_for_student.php?book_id=" . $row['id']."'>Borrow For A Student (maybe and for admin)</a> 
                            </td>
                        </tr>";
                }
            } 
            else 
            {
                echo "<tr><td colspan='4'>No users found</td></tr>";
            }

        ?>
    </table>
</body>
</html>
